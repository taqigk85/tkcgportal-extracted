<?php 
namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\States;
use Auth;
use Session;

class PublicController extends Controller
{

    public function index() {
        if (Auth::check()) {
            $user = auth()->user();
            $role = optional($user->roles->first())->name;
    
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'client') {
                return redirect()->route('client.dashboard');
            } else {
                return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
            }
        }
        return view('pages.auth.login');
    }

    public function welcome() {
        $getStates = States::select('state')->distinct()->get();

        if (empty($getStates)) {
            return response()->json(['message' => 'No data found']);
        }

        return view('welcome', compact('getStates'));
    }
    
public function getCitiesByState(Request $request){
    $cities = States::where('state', $request->stateName)
                    ->pluck('cities')
                    ->toArray();

    if (empty($cities)) {
        return response()->json(['message' => 'No data found']);
    }

    $citiesArray = [];
    foreach ($cities as $cityList) {
        if (is_string($cityList)) {
            $decoded = json_decode($cityList, true);
            $cityList = is_array($decoded) ? $decoded : [$cityList]; 
        }
        $citiesArray = array_merge($citiesArray, (array) $cityList);
    }


    $uniqueCities = array_values(array_unique($citiesArray));

    return response()->json($uniqueCities);
}


public function importRiskCategories(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
    ]);

    $filePath = $request->file('file')->store('temp');
    $file = fopen(storage_path("app/{$filePath}"), "r");
    $rowIndex = 0;
    
    while (($row = fgetcsv($file)) !== false) {
        $rowIndex++;
        if ($rowIndex > 2) {
                States::create([
                    'state' => $row[0],
                    'cities' => $row[1],
                    'risk_1' => json_encode(array('wind' => $row[2], 'ice' => $row[3], 'snow' => $row[4])),
                    'risk_2' => json_encode(array('wind' => $row[5], 'ice' => $row[6], 'snow' => $row[7])),
                    'risk_3' => json_encode(array('wind' => $row[8], 'ice' => $row[9], 'snow' => $row[10])),
                    'risk_4' => json_encode(array('wind' => $row[11], 'ice' => $row[12], 'snow' => $row[13])),
                    'building_code' => $row[14],
                    'ASCE_code' => $row[15]
                ]);
            }
    }
}
}