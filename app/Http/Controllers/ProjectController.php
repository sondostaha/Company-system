<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\EmployeeProject;
use App\Models\Employees;
use App\Models\Images;
use App\Models\ProjectPending_reason;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
  public function index()
  {
    $projects = Projects::all();
    return view('projects.projects',compact('projects'));
  }
    public function create()
    {
        $project = Projects::all()->first();
        return view('projects.add',compact('project'));
    }
    public function store(Request $request)
    {
        
      $request->validate([
        'name'=>'required|string',
        'description'=>'required|string',
        'images'=>'required|array',
        'document'=>'required|file',
        'status'=>'required',
        'start_date'=>'required|date',
        'end_date'=>'required',
      ]);
      $file = $request->file('document');
      $extintion = $file->getClientOriginalExtension();
      $project_name = $request->name;
      $file_name = uniqid().".".$extintion;
      $file->move(public_path('projects/file'.$project_name), "$file_name");

        Projects::create([
            'company_id'=> Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'document' => $file_name,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $project_id = Projects::latest()->first()->id ;

         foreach ($request->file('images') as $imagefile) 
         {
           // dd($imagefile);
            $image_n = $imagefile;
            $extintion = $image_n->getClientOriginalExtension();
            $project_name = $request->name;
            $image_name = uniqid().".".$extintion;

            $image = new Images;
            $image_n->move(public_path('projects/images/'.$project_name), "$image_name");
            
            $image->project_id = $project_id;
            $image->image = $image_n;
            $image->save();
          }

        session()->flash('Add','Project Added successfully');
        return back();
    }

    public function edit($id)
    {
      $project = Projects::findOrFail($id);
      return view('projects.edit',compact('project'));
    }

    public function update($id , Request $request)
    {

      $project = Projects::findOrFail($id);
      $file = $request->file('document');
      $extintion = $file->getClientOriginalExtension();
      $project_name = $request->name;
      $file_name = uniqid().".".$extintion;
      $file->move(public_path('projects/files'.$project_name), "$file_name");

      $project->update([
        'name' => $request->name,
        'description' => $request->description,
        'document' => $file_name,
        'status' => $request->status,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    $project_id = Projects::latest()->first()->id ;

    foreach ($request->file('images') as $imagefile) 
    {
      // dd($imagefile);
       $image_n = $imagefile;
       $extintion = $image_n->getClientOriginalExtension();
       $project_name = $request->name;
       $image_name = uniqid().".".$extintion;

       $image = new Images;
       $image_n->move(public_path('projects/'.$project_name), "$image_name");
       
    
      $image->update([
        'project_id'=>$project_id,
        'image'=> $image_n
      ]);

     }

   session()->flash('Edite','Project Edited successfully');
   return back();
}
public function delete($id)
{
  $project = Projects::findOrFail($id);
  $project_name = $project->name;
  $image_path = public_path('projects\.'.$project_name);
  if(file_exists($image_path))
       {
         unlink($image_path);
     
       }
  $project->delete($id);

  session()->flash('Delete','Project Deleted successfully');
  return back();
}

  public function newProject()
  {
    $projects = Projects::where('status','new')->get();
    return view('projects.newProject',compact('projects'));
  }
  public function startedProject()
  {
    $projects = Projects::where('status','started')->get();
    return view('projects.startedProject',compact('projects'));
  }
  public function pendingProject()
  {
    $projects = Projects::where('status','pending')->get();
    return view('projects.startedProject',compact('projects'));
  }
  public function Employee($id)
  {
    $project = Projects::findOrFail($id);
    $pro = EmployeeProject::select('project_id')->where('project_id',$id)->get()->pluck('project_id')->toArray();
    $employees = Employees::all()->except($pro);
    return view('projects.selectProject',compact('employees','project'));
  }
  public function add_employee($employee_id,$project_id)
  {

     EmployeeProject::create([
      'employee_id'=>$employee_id,
      'project_id'=>$project_id
     ]);
     session()->flash('Add','employee selected successfully');
     return back();
  }
  public function client($id)
  {

    $clients = Clients::where('project_id', $id)
    ->exists();
    if ($clients == true) {
      session()->flash('Add_another','You already have a client in this project.if you want to replace this client please bek one');
      $project = Projects::findOrFail($id);
      $clients = Clients::where('project_id',$id)->exists();
      $client = Clients::all()->except($clients);
      return view('projects.replaceClinet',compact('client','project'));
    } else
    $project = Projects::findOrFail($id);
    $clients = Clients::where('project_id',$id)->exists();
    $client = Clients::all()->except($clients);
    return  view('projects.addClient',compact('client','project'));
  }

  public function add_client($client_id  , $project_id)
  {
    $clients = Clients::where('project_id', $project_id)
    ->exists();
    if ($clients == true) {
      session()->flash('Add_another','You already have a client in this project.if you want to replace this client please beake one');
      $project = Projects::findOrFail($project_id);
      $clients = Clients::where('project_id',$project_id)->exists();
      $client = Clients::all()->except($clients);
      return view('projects.replaceClinet',compact('client','project'));
    } else
    
    Clients::whereIn('id',[$client_id])->update([
      'project_id'=>$project_id,
    ]);
    session()->flash('Add','client added successfully');
    return back();
 
  }
  public function replace_client($client_id  , $project_id)
  {
    
    Clients::whereIn('id',[$client_id])->update([
      'project_id'=> null,
    ]);
    // Clients::whereIn('id',[$client_id])->update([
    //   'project_id'=> $project_id,
    // ]);
    session()->flash('Add','client replaced  successfully');
    return back();
  }
       
}

