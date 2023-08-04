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

        return redirect()->route('admin.users.index')->with('success','User has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function login()
    {
        return view('users.login');
    }

    public function authen (Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        // Tìm người dùng dựa trên email
        $user = User::where('email', $email)->first();
        $user->last_login = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $user->save();

        if ($user && $password == $user->password) {
            // Mật khẩu khớp, tiến hành đăng nhập
            session(['user' => $user]);
            return redirect()->route('guests.home');
            // Tiếp tục xử lý hoặc trả về kết quả
        } else {
            return redirect()->route('users.login')->with('error', 'Incorrect account or password');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
