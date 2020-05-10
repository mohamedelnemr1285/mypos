<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients = Client::when($request->search , function($q) use ($request) {


            return $q->where('name','like','%'.$request->search.'%')
                    ->orwhere('phone','like','%'.$request->search.'%')
                    ->orwhere('address','like','%'.$request->search.'%');

        })->latest()->paginate(3);

        return view('dashboard.clients.index',compact('clients'));
    }


    public function create()
    {
        return view('dashboard.clients.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',

        ]);


        Client::create($request->all());

        session()->flash('message',trans('site.add_success'));
         return redirect()->route('dashboard.clients.index');
    }





    public function edit(Client $client)
    {
        return view('dashboard.clients.edit',compact('client'));
    }


    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',

        ]);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
        $client->update($request_data);

        session()->flash('message',trans('Update Success'));
         return redirect()->route('dashboard.clients.index');
    }


    public function destroy(Client $client)
    {
        $client->delete();

        session()->flash('message',trans('Delete Success'));
         return redirect()->route('dashboard.clients.index');

    }
}
