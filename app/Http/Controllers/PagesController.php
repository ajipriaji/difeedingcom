<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function form()
    {
        return view('form_isian');
    }
    public function login()
    {
        return view('login/login');
    }
    public function register()
    {
        return view('login/register');
    }
    public function trial()
    {
        return view('tes');
    }
    public function show_histori()
    {
        return view('history/show');
    }
}
