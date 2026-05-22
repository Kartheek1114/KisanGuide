<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Pest;
use App\Models\AdvisorQuery;
use Illuminate\Http\Request;

class KisanController extends Controller
{
    /**
     * Display the public landing page.
     */
    public function landing()
    {
        return view('landing');
    }

    /**
     * Display the crop directory page.
     */
    public function crops(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');
        $soil = $request->input('soil');

        // Query Crops with filters
        $cropsQuery = Crop::query();
        if ($search) {
            $cropsQuery->where('name', 'like', '%' . $search . '%')
                       ->orWhere('description', 'like', '%' . $search . '%');
        }
        if ($type) {
            $cropsQuery->where('type', $type);
        }
        if ($soil) {
            $cropsQuery->where('soil_types', 'like', '%' . $soil . '%');
        }
        $crops = $cropsQuery->get();

        // Get unique types and soil types for filter dropdowns
        $cropTypes = Crop::distinct()->pluck('type');
        $allSoils = [];
        foreach (Crop::all() as $c) {
            if (is_array($c->soil_types)) {
                $allSoils = array_merge($allSoils, $c->soil_types);
            }
        }
        $soilTypes = array_values(array_unique($allSoils));

        return view('crops', compact('crops', 'cropTypes', 'soilTypes', 'search', 'type', 'soil'));
    }

    /**
     * Display the NPK calculator page.
     */
    public function calculator()
    {
        $crops = Crop::all();
        return view('calculator', compact('crops'));
    }

    /**
     * Display the weather simulator & mandi price monitor page.
     */
    public function weather()
    {
        $crops = Crop::all();
        $pests = Pest::all();
        return view('weather', compact('crops', 'pests'));
    }

    /**
     * Display the expert help & advisory logs page.
     */
    public function expertHelp()
    {
        $crops = Crop::all();
        $queries = AdvisorQuery::orderBy('created_at', 'desc')->take(10)->get();
        return view('expert-help', compact('crops', 'queries'));
    }

    /**
     * Store a new advisor query and auto-generate an expert response.
     */
    public function storeQuery(Request $request)
    {
        $validated = $request->validate([
            'farmer_name' => 'required|string|max:100',
            'contact_number' => 'required|string|max:15',
            'crop_name' => 'nullable|string|max:50',
            'query_text' => 'required|string|min:10',
        ]);

        $farmerName = $validated['farmer_name'];
        $queryText = strtolower($validated['query_text']);
        $cropName = $validated['crop_name'];

        // Auto-generate a response
        $response = "Thank you for reaching out, Farmer {$farmerName}. Here is the initial diagnostic advice from the KisanGuide Expert system:\n\n";

        // Find relevant crop
        $matchedCrop = null;
        if ($cropName) {
            $matchedCrop = Crop::where('name', 'like', '%' . $cropName . '%')->first();
        } else {
            // Try to detect crop in query text
            $allCrops = Crop::all();
            foreach ($allCrops as $crop) {
                if (str_contains($queryText, strtolower($crop->name))) {
                    $matchedCrop = $crop;
                    break;
                }
            }
        }

        // Find relevant pest/disease
        $matchedPest = null;
        $allPests = Pest::all();
        foreach ($allPests as $pest) {
            if (str_contains($queryText, strtolower($pest->name)) || 
                str_contains($queryText, 'disease') || 
                str_contains($queryText, 'insect') || 
                str_contains($queryText, 'pest') ||
                str_contains($queryText, 'spots') || 
                str_contains($queryText, 'rot') ||
                str_contains($queryText, 'curl')) {
                
                // If it mentions pest/disease keywords, check if it matches pest target crops
                if ($matchedCrop) {
                    if (is_array($pest->target_crops) && in_array($matchedCrop->name, $pest->target_crops)) {
                        $matchedPest = $pest;
                        break;
                    }
                } else {
                    $matchedPest = $pest; // take first matched
                    break;
                }
            }
        }

        if ($matchedCrop) {
            $response .= "🌾 **Crop Profile Detected ({$matchedCrop->name}):**\n";
            $response .= "- Ideal Temperature: {$matchedCrop->optimal_temp_min}°C - {$matchedCrop->optimal_temp_max}°C\n";
            $response .= "- Ideal Soil pH: {$matchedCrop->optimal_ph_min} - {$matchedCrop->optimal_ph_max}\n";
            $response .= "- Recommended NPK Ratio: {$matchedCrop->optimal_n}:{$matchedCrop->optimal_p}:{$matchedCrop->optimal_k} (kg/hectare)\n\n";
        }

        if ($matchedPest) {
            $response .= "⚠️ **Potential Pest/Disease Alert ({$matchedPest->name}):**\n";
            $response .= "- **Symptoms:** {$matchedPest->symptoms}\n";
            $response .= "- **Prevention:** {$matchedPest->prevention_measures}\n";
            $response .= "- **Remedial Action:** {$matchedPest->remedial_measures}\n\n";
        } else {
            $response .= "🌱 **General Recommendations:**\n";
            $response .= "1. Ensure consistent irrigation based on soil dry-ness. Avoid waterlogging.\n";
            $response .= "2. Test your soil health locally to check macronutrient levels (Nitrogen, Phosphorus, Potassium).\n";
            $response .= "3. Keep fields clear of weeds to prevent competition for nutrients.\n\n";
        }

        $response .= "Our agricultural officer has been notified and will verify this advice. If you require further assistance, we will contact you at {$validated['contact_number']}.";

        AdvisorQuery::create([
            'farmer_name' => $validated['farmer_name'],
            'contact_number' => $validated['contact_number'],
            'crop_name' => $matchedCrop ? $matchedCrop->name : ($cropName ?: 'General'),
            'query_text' => $request->input('query_text'),
            'response_text' => $response,
            'status' => 'resolved', // Auto-resolved by system
        ]);

        return redirect()->route('expert-help')->with('success', 'Your query has been submitted. Our expert AI advisor has responded below!');
    }
}
