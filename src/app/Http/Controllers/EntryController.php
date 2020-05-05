<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $retrieveUser = Auth::user();
        $username = $retrieveUser ? $retrieveUser->username : "test";
        $time  = Carbon::now();
        return view('index', compact(['username', 'time']));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function submit(Request $request) {
        $this->validate($request, [
            'username' => 'required|string',
            'email' => 'required|email',
        ]);

        $users = User::all();

        foreach ($users as $user) {
            if ($user->email === $request->email) {
                return response()->json('no repeat email', 200);
            }
        }

        User::create([
           'username' => $request ? $request->username : "none set",
            'email' => $request->email,
            'password' => "test"
        ]);

        /*
          Add mail functionality here.
        */

        return response()->json(null, 200);
    }
    public function user() {
        $retrieveUser = Auth::user();
        $username = $retrieveUser ? $retrieveUser->username : "test";
        $time  = Carbon::now();
        return response()->json('username');
    }
}
