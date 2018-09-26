<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignRolesController extends Controller
{
    var $user;

    public function __construct()
    {
        $this->user = '';
    }

    public function assignRole(User $user){
        return view('assign')->with('user', $user);
    }

    public function assign(Request $request, User $user){
        if (Auth::user()->isAdmin()){
            $user->update([
                'role_id' => $request->role_id
            ]);
        }
    }
}
