<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug){
        $page = Page::findBySlug($slug);
        return view('backend.pages', compact('page'));
    }
}
