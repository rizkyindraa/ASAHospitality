<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact_index()
    {
        $contact = Contact::first();
        return view('admin.contact.index', compact('contact'));
    }

    public function contact_update(Request $request, Contact $contact)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
            'office_address' => 'required',
            'villa_address' => 'required',
            'map' => 'required'
        ],
        [
            'phone.required' => 'Masukkan Nomor Telepon',
            'email.required' => 'Masukkan Email',
            'office_address.required' => 'Masukkan Alamat Kantor',
            'villa_address.required' => 'Masukkan Alamat Villa',
            'map.required' => 'Masukkan Map'
        ]);

        Contact::where('id', $contact->id)
            ->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'office_address' => $request->office_address,
                'villa_address' => $request->villa_address,
                'map' => $request->map
            ]);

        return back()->with('status', 'Contact Telah Berhasil Terupdate');
    }
}
