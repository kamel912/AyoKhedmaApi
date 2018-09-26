<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionsController extends Controller
{

    var $items_list_title;
    var $url_segment;
    var $item_type;
    public function __construct()
    {
        $this->items_list_title = 'مناطق';
        $this->url_segment = 'regions';
        $this->item_type = 'منطقة';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()){
            $regions = Region::all(['id', 'name']);
            return view('data.index')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'items_list' => $regions,
                'item_type' => $this->item_type,
            ]);
        }
        else{
            return redirect('/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            return view('data.create')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'item_type' => $this->item_type,
            ]);
        } else {
            return redirect('/home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $this->validate($request, [
                'name' => 'required'
            ]);

            Region::create([
                'name' => $request->name,
            ]);
            return redirect($this->url_segment)->with('success', 'تم إضافة '.$this->item_type);
        } else {
            return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return redirect($this->url_segment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            return view('data.edit')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'item_type' => $this->item_type,
                'item' => $region,
            ]);
        } else {
            return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $this->validate($request, [
                'name' => 'required'
            ]);

            $region->update([
                'name' => $request->name,
            ]);
            return redirect($this->url_segment)->with('success', 'تم تعديل ال'.$this->item_type.' بنجاح');
        } else {
            return redirect('/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region $region
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Region $region)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $region->delete();
            return redirect('streets')->with('success', 'تم حذف الشارع بنجاح');
        } else {
            return redirect('/home');
        }
    }
}
