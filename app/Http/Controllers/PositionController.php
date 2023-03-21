<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    public function index()
    {
        $position = Position::all();
        return view('positions.positions',compact('position'));
    }
    public function create()
    {
        return view('positions.add');
    }
    public function store(Request $request)
    {
        Position::create([
            'name'=>$request->name,
            'salary'=>$request->salary
        ]);

        session()->flash('Add','position added sussesfully');
        return back();
    }

    public function edit($id)
    {
        $position = Position::where('id',$id)->first();
        return view('positions.edit',compact('position'));
    }

    public function update($id , Request $request)
    {
        $position= Position::findOrFail($id); 
        $request->validate([
            'name'=>'required',
            'salary'=>'required|numeric',
        ]);
        $position->update([
            'name'=>$request->name,
            'salary'=>$request->salary
        ]);
        session()->flash('Edite','Position Edited Successfully');
        return redirect(route('all_postions'));
    }

    public function delete($id)
    {
        $position = Position::findOrFail($id);
        $position->delete($id);

        session()->flash('Delete','Position Deleted Successfully');
        return back();
    }

    public function get_position_salary($id)
    {
        
        $position = Position::where('id',$id)->pluck('salary','id');

        return json_encode($position);
    }
}
