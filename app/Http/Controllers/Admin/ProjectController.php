<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProductType;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function maanProject()
    {
        $projects = Project::paginate(10);
        return view('admin.pages.project.project',compact('projects'), [
            'types'      => ProductType::where('status', 1)->get(),
            'categories' => ServiceCategory::where('status', 1)->get(),
            'projects'   => Project::all()]);

    }

    public function maanNewProject(Request $request)
    {
        $request->validate([
            'project_type_id'   => 'required',
            'service_type_id'   => 'required',
            'clients_name'      => 'required',
            'title'             => 'required',
            'description'       => 'required',
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            'date'              => 'required',
            'location'          => 'required',
        ]);
        Project::addProject($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }
    public function maanDeleteProject($id)
    {
        $this->project = Project::find($id);
        $this->project->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanProjectStatus($id)
    {
        $this->statusProject = Project::findOrFail($id);
        $this->statusProject->status = $this->statusProject->status == 1 ? 0 : 1;
        $this->statusProject->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }
    public function maanEditProject ($id)

    {
        return view('admin.pages.project.edit_project', [
            'info'          => Project::find($id),
            'projects'      => Project::where('status', 1)->get(),
            'types'         => ProductType::where('status', 1)->get(),
            'categories'    => ServiceCategory::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateProject (Request $request, $id)
    {
        Project::updateProject($request, $id);
        return redirect('/project')->with('message', 'Data updated successfully.');
    }
}
