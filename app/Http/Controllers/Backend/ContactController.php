<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('backend.pages.contacts.index', compact('contacts'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        notify()->success('Contact deleted successfully.');
        return redirect()->route('contacts.index');
    }

    public function recycleBin()
    {
        $contacts = Contact::onlyTrashed()->get();
        return view('backend.pages.Recycle.contact', compact('contacts'));
    }

    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();

        notify()->success('Contact restored successfully.');
        return redirect()->route('contacts.recycleBin');
    }

    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();

        notify()->success('Contact permanently deleted.');
        return redirect()->route('contacts.recycleBin');
    }
}
