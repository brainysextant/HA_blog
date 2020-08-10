<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class PagesController extends Controller
{
    public function showHome()
    {
        return view("home");
    }

    public function showAbout()
    {
        return view("about");
    }

    public function contact(Request $request)
    {
        Mail::to("hola@ha.edu.uy")->send(new Contact($request->name, $request->email, $request->message));
        return redirect('/');
    }
}
