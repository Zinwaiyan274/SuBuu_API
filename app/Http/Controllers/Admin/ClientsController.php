<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function maanClients()
    {
        $clients = Client::paginate(10);
        return view('admin.pages.client.client',compact('clients'),[
            'clients' => Client::all()]);
    }

    public function maanNewClients(Request $request)
    {
        $request->validate([
            'name'           => 'required|string',
            'company'        => 'required|string',
            'title'          => 'required|string',
            'description'    => 'required|string',
            'rating'         => 'required|numeric',
            'image'          => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
        ]);
        Client ::addClient($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteClients($id)
    {
        $this->client = Client::find($id);
        $this->client->delete();
        if (file_exists($this->client->image))
        {
            unlink($this->client->image);
        }
        return redirect()->back()->with('error', 'Data Deleted');
    }

    public function maanClientsStatus($id)
    {
        $this->statusClient = Client::findOrFail($id);
        $this->statusClient->status = $this->statusClient->status == 1 ? 0 : 1;
        $this->statusClient->save();
        return redirect()->back()->with('message','Status changed successfully');
    }
    public function maanEditClients ($id)

    {
        return view('admin.pages.client.edit_client', [
            'info'       => Client::find($id),
            'clients'    => Client::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateClients (Request $request, $id)
    {
        $request->validate([
            'name'           => 'required|string',
            'company'        => 'required|string',
            'title'          => 'required|string',
            'description'    => 'required|string',
            'rating'         => 'required|numeric',
        ]);
        if ($request->image) {
            $request->validate([
                'image'          => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            ]);
        }
        Client::updateClient($request, $id);
        return redirect('/clients')->with('message', 'Data updated successfully.');
    }
}
