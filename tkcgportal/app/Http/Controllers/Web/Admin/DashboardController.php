<?php 
namespace App\Http\Controllers\Web\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Helper;
use App\Models\Projects;
use App\Models\User;
class DashboardController extends Controller
{
     public function Dashboard(){
        $Projects = Projects::limit(7)->get();
        $countAllPojects = Projects::count();
        $Users = User::where('id', '!=', auth()->user()->id)
         ->whereIn('status', ['active', 'inactive'])
         ->where(function ($query) {
               $query->whereHas('roles', function ($q) {
                  $q->where('name', 'LIKE', 'client');
               });
      })
      ->with('roles')
      ->orderBy('created_at', 'DESC')
      ->limit(7)->get();
      $usersCount = User::where('id', '!=', auth()->user()->id)
    ->whereIn('status', ['active', 'inactive'])
    ->whereHas('roles', function ($q) {
        $q->where('name', 'LIKE', 'client');
    })
    ->count();
        return view('pages.dashboards.admin.dashboard',compact('Projects','countAllPojects','usersCount','Users'));
     }
     
}