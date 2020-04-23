<?php

namespace App\Http\Controllers;

use App\User;
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
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

//        $users = User::all();
//
//        foreach ($users as $user) {
//            if ($user->email == $request->email) {
//                return response()->json('no repeat email', 200);
//            }
//        }

        User::create([
           'name' => $request->name,
            'email' => $request->email,
        ]);

        /*
          Add mail functionality here.
        */

        return response()->json(null, 200);
    }
}
