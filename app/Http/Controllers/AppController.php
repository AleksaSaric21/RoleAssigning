<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        $users = User::all();
        return view('adminPanel',['users'=>$users]);
    }
    public function moderatorRole(Request $request, User $user)
    {
        $moderatorRole = Role::where('name','Moderator')->get();
        $request->toggleModerator ? $user->roles()->attach($moderatorRole) : $user->roles()->detach($moderatorRole);
        return redirect('/admin');
    }
    public function AuthorRole(Request $request, User $user)
    {
        $authorRole = Role::where('name','Author')->get();
        $request->toggleAuthor ? $user->roles()->attach($authorRole) : $user->roles()->detach($authorRole);
        return redirect('/admin');
    }
}
