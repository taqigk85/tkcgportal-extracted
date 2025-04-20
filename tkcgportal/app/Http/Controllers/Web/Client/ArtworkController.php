<?php
namespace App\Http\Controllers\Web\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Projects;

class ArtworkController extends Controller
{

    public function ArtworkView(){
        return view('pdf.artwork');
    }

    public function storeTableData(Request $request){
        // dd($request->all());
        $table_data = [];
        $rows = range(13, 25);
        $cols = range(3, 9);

        if (in_array($request->wall_type, ['cabinet', 'channel_letters', 'raceway'])) {
            foreach ($rows as $row) {
                foreach ($cols as $col) {
                    $key = "XLEW_3_{$row}_{$col}";
                    if ($request->has($key)) {
                        $table_data[$key] = $request->input($key);
                    }
                }
            }
            session(['table_data' => $table_data]);
        }

        if (in_array($request->wall_type, [
            'double-post-full-height', 'single-post-full-height',
            'double-post-with-cabinet', 'single-post-with-cabinet', 'post-and-panel',
            'double-post-covered', 'single-post-covered'
        ])) {
            $table_data = [
                "XLEW_1_31_3" => $request->XLEW_1_31_3,
                "XLEW_1_31_5" => $request->XLEW_1_31_5,
                "XLEW_1_32_3" => $request->XLEW_1_32_3,
                "XLEW_1_33_3" => $request->XLEW_1_33_3,
                "XLEW_1_33_5" => $request->XLEW_1_33_5,
                "XLEW_1_34_3" => $request->XLEW_1_34_3,
                "XLEW_1_34_5" => $request->XLEW_1_34_5,
                "XLEW_1_35_3" => $request->XLEW_1_35_3,
                "XLEW_1_36_3" => $request->XLEW_1_36_3,
                "XLEW_1_36_5" => $request->XLEW_1_36_5,
                "XLEW_1_37_3" => $request->XLEW_1_37_3,
                "XLEW_1_37_5" => $request->XLEW_1_37_5,
                "XLEW_1_38_3" => $request->XLEW_1_38_3,
            ];
            session(['table_data' => $table_data]);
            session(['table_data' => $table_data]);
        }

        
        return response()->json([
            'success' => true,
            'message' => 'Data stored successfully!',
            'table_data' => $table_data
        ]);

    }

    public function generatePDF(Request $request, $id){
     $project = Projects::findOrFail($id);
     $table_data = session('table_data');

     $fileName = preg_replace('/\s+/', '-', trim($project->name));
     $fileName = preg_replace('/-+/', '-', $fileName);
     $fileName .= '.pdf';

     $pdf = Pdf::loadView('pdf.art', compact('project', 'table_data'))
        ->setPaper([0, 0, 792, 1224], 'landscape');

      return $pdf->download($fileName);
        // return view('pdf.art',compact('project','table_data'));
    }


    // public function generatePDF(Request $request, $id){
    //     $project = Projects::findOrFail($id);
    //     $table_data = session('table_data');
    //     $pdf = Pdf::loadView('pdf.art', compact('project', 'table_data'));
    //     return $pdf->download('artwork.pdf');
    //     // return view('pdf.art');
    // }
    // public function storeTableData(Request $request)
    // {
    //     $request->validate([
    //         'project_id' => 'required|exists:projects,id'
    //     ]);

    //     // Find project by ID from request
    //     $project = Projects::findOrFail($request->project_id);

    //     // Collect table data dynamically
    //     $table_data = [];
    //     $rows = range(16, 25);
    //     $cols = range(3, 9);

    //     foreach ($rows as $row) {
    //         foreach ($cols as $col) {
    //             $key = "XLEW_3_{$row}_{$col}";
    //             if ($request->has($key)) {
    //                 $table_data[$key] = $request->input($key);
    //             }
    //         }
    //     }
    //     // Generate PDF using received data
    //     $pdf = Pdf::loadView('pdf.artwork', compact('project', 'table_data'));
    //     // Return PDF response for download
    //     return $pdf->download('artwork.pdf');
    // }
}
