<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use Auth;

class ProjectController extends Controller
{
    //
    public function ProjectList(){
        $Projects = Projects::all();
        return view('pages.admin.projects.list',compact('Projects'));
    }

    public function ProjectView(Request $request, $id){
        $project = Projects::whereId($id)->first();
        return view('pages.admin.projects.table', compact('project'));
    }

    public function ProjectArtwork(Request $request, $id){
        $project = Projects::whereId($id)->first();
        return view('pages.admin.projects.artwork',compact('project'));
    }
}
