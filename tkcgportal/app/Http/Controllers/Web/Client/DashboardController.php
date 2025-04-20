<?php 
namespace App\Http\Controllers\Web\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Projects;
use App\Models\User;
use Helper;
class DashboardController extends Controller
{
     public function Dashboard(){
       
        $Projects = Projects::where('userId', Auth::user()->id)->limit(7)->get();
        $countAllPojects = Projects::where('userId', Auth::id())->count();
        return view('pages.dashboards.client.dashboard',compact('Projects','countAllPojects'));
     }
     
}