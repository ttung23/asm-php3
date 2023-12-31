<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'name' => "required|string|max:50|"
//        ]);
        User::create($request->post());

        return redirect()->route('admin.users.index')->with('success', 'User has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function login()
    {
        return view('users.login');
    }

    public function authen(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Tìm người dùng dựa trên email
        $user = User::where('email', $email)->first();
        $user->last_login = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $user->save();

        if ($user && $password == $user->password) {
            session(['user' => $user]);
            return redirect()->route('home');
        }
        return redirect()->route('users.login')->with('error', 'incorrect');
    }
}
