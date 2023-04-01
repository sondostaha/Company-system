<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeProject;
use App\Models\Employees;
use App\Models\Images;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
  {
    $projects = Projects::with('client')->get();
    return response()->json($projects);
  }
    public function create(Request $request)
    {
        
      $validatedate = Validator::make($request->all(),[
        'name'=>'required|string',
        'description'=>'required|string',
        'images'=>'required|array',
        'document'=>'required|file',
        'status'=>'required',
        'start_date'=>'required|date',
        'end_date'=>'required',
      ]);
      
      if($validatedate->failed())
      {
          return response()->json(['error'=>true , 'message'=>'please check your data'],200); 
      }

      $file = $request->file('document');
      $extintion = $file->getClientOriginalExtension();
      $project_name = $request->name;
      $file_name = uniqid().".".$extintion;
      $file->move(public_path('projects/file/'.$project_name), "$file_name");

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
            $image_n = $imagefile;
            $extintion = $image_n->getClientOriginalExtension();
            $project_name = $request->name;
            $image_name = uniqid().".".$extintion;

            $image = new Images;
            $image_n->move(public_path('projects/images/'.$project_name), "$image_name");
            
            $image->project_id = $project_id;
            $image->image = $image_name;
            $image->save();
            
            Images::create([
                'project_id'=>$project_id,
                'image'=>$image_name
            ]);
           
          }

        return response()->json(['message'=>'project created successfully']);
    }

    public function edite($id , Request $request)
    {
        $validatedate = Validator::make($request->all(),[
            'name'=>'required|string',
            'description'=>'required|string',
            'images'=>'required|array',
            'document'=>'required|file',
            'status'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required',
      ]);

      if($validatedate->failed())
      {
          return response()->json(['error'=>true , 'message'=>'please check your data'],200); 
      }
      
      $project = Projects::findOrFail($id);
      $file = $request->file('document');
      $extintion = $file->getClientOriginalExtension();
      $project_name = $request->name;
      $file_name = uniqid().".".$extintion;
      $file->move(public_path('projects/files/'.$project_name), "$file_name");

    $project_update =  $project->update([
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

       $image_n = $imagefile;
       $extintion = $image_n->getClientOriginalExtension();
       $project_name = $request->name;
       $image_name = uniqid().".".$extintion;

       $image = new Images;
       $image_n->move(public_path('projects/'.$project_name), "$image_name");
       
    
      $image->update([
        'project_id'=>$project_id,
        'image'=> $image_name
      ]);

     }

     return response()->json(['message'=>'project updated successfully',$project_update]);
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

  return response()->json(['message'=>'project deleted successfully']);

}

  public function newProject()
  {
    $projects = Projects::where('status','new')->get();
    return response()->json($projects);
  }
  public function startedProject()
  {
    $projects = Projects::where('status','started')->get();
    return response()->json($projects);
  }
  public function pendingProject()
  {
    $projects = Projects::where('status','pending')->get();
    return response()->json($projects);
  }
  
  public function add_employee($employee_id,$project_id)
  {

     EmployeeProject::create([
      'employee_id'=>$employee_id,
      'project_id'=>$project_id
     ]);
     return response()->json(['message'=>'employee added in to your project successfully']);
  }
 
  public function add_client($client_id  , $project_id)
  {
    $clients = Projects::where('client_id', $client_id)
    ->exists();
    if($clients){
    return response()->json(['message'=>'this client already exist']);

    }
    Projects::whereIn('id',[$project_id])->update([
      'client_id'=>$client_id,
    ]);
    return response()->json(['message'=>'employee added in your project successfully']);
 
  }
 

  public function project_employees($id)
  {
    $project_employees= EmployeeProject::select('employee_id')->where('project_id',$id)->get()->pluck('employee_id');

      $employees = Employees::whereIn('id',$project_employees)->get();

      return response()->json($employees);

  }

  public function delete_employee($id)
  {
    $delete_employee = EmployeeProject::where([
      'employee_id'=>$id
    ]);
    $delete_employee->delete($id);
    return response()->json(['message'=>'employee deleted from your project successfully']);

  }

  public function show($id)
   {
    $projects = Projects::with('employees','images','client')->findOrFail($id)->first();
    return response()->json($projects);

    
  }
}
