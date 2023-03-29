<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $clients= Clients::all();
        return response()->json($clients);

    }
    public function create(Request $request)
    {
    
        $validatedate = Validator::make($request->all(),
        [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
        ]);
        $clients =  Clients::create([
            'company_id'=> Auth::id(),
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone
        ]);

        return response()->json(['massage'=>'client created successfully' , $clients]);

    }
    public function edite($id , Request $request)
    {
        $client = Clients::findOrFail($id);

       $validatedate = Validator::make($request->all(),[
        
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
        ]);
        if($validatedate->failed())
        {
            return response()->json(['error'=>true , 'message'=>'please check your data'],200); 
        }
       $client_update = $client->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone
        ]);

        
        return response()->json(['massage'=>'client updated successfully' , $client_update]);
        
    }
    public function delete($id)
    {
        $client = Clients::findOrFail($id);
        $client->delete($id);
        return response()->json(['massage'=>'client deleted successfully']);
    }
}
