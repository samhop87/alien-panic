<?php

namespace App\Http\Controllers;

class EntryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('welcome');
    }
}
