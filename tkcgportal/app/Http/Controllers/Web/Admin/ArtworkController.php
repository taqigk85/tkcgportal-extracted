<?php
namespace App\Http\Controllers\Web\Admin;
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

        $table_data = [];

        $rows = range(13, 25);
        $cols = range(3, 9);

        foreach ($rows as $row) {
            foreach ($cols as $col) {
                $key = "XLEW_3_{$row}_{$col}";
                if ($request->has($key)) {
                    $table_data[$key] = $request->input($key);
                }
            }
        }

        session(['table_data' => $table_data]);
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

}
