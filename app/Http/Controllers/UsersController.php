<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    var $items_list_title;
    var $url_segment;
    var $item_type;
    public function __construct()
    {
        $this->items_list_title = 'عناصر';
        $this->url_segment = 'objects';
        $this->item_type = 'عنصر';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $users = User::all();
            return view('data.index')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'items_list' => $users,
                'item_type' => $this->item_type,
            ]);
        } else {
            return redirect('/#');
        }    }



    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
