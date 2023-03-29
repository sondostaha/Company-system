<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    
    public function index()
    {
        $position = Position::all();
        return response()->json($position);
    }
    public function create(Request $request)
    {
        $validatedate = Validator::make($request->all(),
        [
            'name' => 'required',
            'salary'=>'required|numeric',
        ]);
        
        if($validatedate->failed())
        {
            return response()->json(['error'=>true , 'message'=>'please check your data'],200); 
        }
       $position = Position::create([
            'name'=>$request->name,
            'salary'=>$request->salary
        ]);
        return response()->json(['massage'=>'position craeted successfully',$position]);
    }


    public function edite($id , Request $request)
    {
        $position= Position::findOrFail($id); 

        $validatedate = Validator::make($request->all(),[
            'name'=>'required',
            'salary'=>'required|numeric',
        ]);

        if($validatedate->failed())
        {
            return response()->json(['error'=>true , 'message'=>'please check your data'],200); 
        }
        $position->update([
            'name'=>$request->name,
            'salary'=>$request->salary
        ]);
        return response()->json(['massage'=>'position edited successfully',$position]);
    }

    public function delete($id)
    {
        $position = Position::findOrFail($id);
        $position->delete($id);

        return response()->json(['massage'=>'position deleted successfully']);
    }

}
