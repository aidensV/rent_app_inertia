<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\KritikSaranMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class KritikController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Admin/Kritik/Create', compact("user"));
    }

    public function store(Request $request)
    {
        $username = $request->username;
        $course = $request->course_user;
        $text = $request->description;
        Mail::to('testreceiver@gmail.com')->send(new KritikSaranMail($username,$course,$text));
        return back()->with('message', __('Kritik & Saran berhasil dikirim ke email admin'));
    }
}
