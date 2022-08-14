<?php

namespace App\Http\Controllers;

use App\Models\Text;

class AdminController extends Controller
{
    public function index()
    {
        $posts = Text::latest()->paginate(5);
        return view('admin.index', compact('posts'));
    }
}
