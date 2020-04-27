<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $users = User::all();
        $time  = Carbon::now();
        return view('index', compact(['users', 'time']));
    }

    public function saveGame() {
        dd("hit");
    }

    public function submit(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $users = User::all();

        foreach ($users as $user) {
            if ($user->email == $request->email) {
                return response()->json('no repeat email', 200);
            }
        }

        User::create([
           'name' => $request->name,
            'email' => $request->email,
            'password' => "test"
        ]);

        /*
          Add mail functionality here.
        */

        return response()->json(null, 200);
    }
}
