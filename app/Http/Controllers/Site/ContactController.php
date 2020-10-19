<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\Contact;

// use Illuminate\Http\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function receveEmail(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required',
            'nom' => 'required|string|max:100',
            'telephone' => 'required|string|max:15',
            'prestation' => 'required|string|max:50|min:5',
            'nombre_persone' => 'required|numeric|min:1|max:56',
        ]);
        $details = [
            'from' => $request->email,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'prestation' => $request->prestation,
            'date_prestation' => $request->date_prestation,
            'nombre_persone' => $request->nombre_persone,
            'message' => $request->subject,
        ];

        Mail::to('contact@shuttlemarrakech.ma')->send(new Contact($details));
        session()->flash('success', "Votre message a été envoyer,Nous nous engageons à vous répondre rapidement ");
        toast(session('success'), 'success');
        return redirect()->route('home');
    }
}
