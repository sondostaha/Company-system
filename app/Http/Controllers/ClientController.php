<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clients= Clients::all();
        return view('client.clients',compact('clients'));
    }
    public function create()
    {
        $client = Clients::all();
        return view('client.add',compact('client'));
    }
    public function store(Request $request)
    {
    
        $request->validate([
            'frist_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
        ]);
        Clients::create([
            'company_id'=> Auth::id(),
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone
        ]);

        session()->flash('Add','Client Added Successfully');
        return back();
    }

    public function edite($id)
    {
        $client = Clients::findOrFail($id);
        return view('client.edite', compact('client'));
    }

    public function update($id , Request $request)
    {
        $client = Clients::findOrFail($id);

        $client->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone
        ]);

        
        session()->flash('Edite','Client Added Successfully');
        return back();
        
    }
    public function delete($id)
    {
        $client = Clients::findOrFail($id);
        $client->delete($id);
        session()->flash('Delete','Client Deleted Successfully');
        return back();
    }

}

