<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('index');
    }

    public function submit(Request $request) {
        dd("hit");
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        /*
          Add mail functionality here.
        */

        return response()->json(null, 200);
    }
}
