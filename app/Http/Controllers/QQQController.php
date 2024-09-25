<?php

namespace App\Http\Controllers;

use App\Models\Event;

class QQQController extends Controller
{
    public function login()
    {
        return view('api/login');
    }

    public function register()
    {
        return view('api/register');
    }

    public function index()
    {
        return view('api/index');
    }

    public function create()
    {
        return view('api/create');
    }

    public function editView($id)
{
    $event = Event::findOrFail($id);
    return view('api/edit', compact('event'));
}
}
