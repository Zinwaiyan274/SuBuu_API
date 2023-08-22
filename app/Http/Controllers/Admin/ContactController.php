<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function maanContacts()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.pages.contact.contact',compact('contacts'));
    }

    public function maanNewContact(Request $request)
    {
        $request->validate([
            'message'  => 'required|string|max:500',
            'name'     => 'required|string|max:20',
            'email'    => 'required|email',
            'phone'    => 'required|string|max:20|min:5',
        ]);
        Contact::addContact($request);
        return redirect()->back()->with('message', 'Message sent successfully.');
    }
    public function maanDeleteContact($id)
    {
        $this->contact = Contact::find($id);
        $this->contact->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }
    public function maanContactStatus($id)
    {
        $this->statusContact = Contact::findOrFail($id);
        $this->statusContact->status = $this->statusContact->status == 1 ? 0 : 1;
        $this->statusContact->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }
}
