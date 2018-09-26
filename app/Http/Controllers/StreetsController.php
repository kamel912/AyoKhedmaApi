<?php

namespace App\Http\Controllers;

use App\Region;
use App\Street;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreetsController extends Controller
{
    var $items_list_title;
    var $url_segment;
    var $item_type;

    public function __construct()
    {
        $this->items_list_title = 'شوارع';
        $this->url_segment = 'streets';
        $this->item_type = 'شارع';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $streets = Street::all();
            return view('data.index')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'items_list' => $streets,
                'item_type' => $this->item_type,
            ]);
        } else {
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
        $regions = Region::pluck('name', 'id');
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            return view('data.create')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'item_type' => $this->item_type,
                'regions' => $regions,
            ]);
        } else {
            return redirect('/home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $this->validate($request, [
                'name' => 'required',
                'region' => 'required',
            ]);

            Street::create([
                'name' => $request->name,
                'region_id' => $request->region,
            ]);
            return redirect($this->url_segment)->with('success', 'تم إضافة '.$this->item_type);
        } else {
            return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Street $street
     * @return \Illuminate\Http\Response
     */
    public function show(Street $street)
    {
        return redirect($this->url_segment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Street $street
     * @return \Illuminate\Http\Response
     */
    public function edit(Street $street)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $regions = Region::pluck('name', 'id');
            return view('data.edit')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'item_type' => $this->item_type,
                'regions' => $regions,
                'item' => $street,
            ]);
        } else {
            return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Street $street
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Street $street)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $this->validate($request, [
                'name' => 'required',
                'region' => 'required',
            ]);

            $street->update([
                'name' => $request->name,
                'region_id' => $request->region,
            ]);
            return redirect($this->url_segment)->with('success', 'تم تعديل ال'.$this->item_type.' بنجاح');
        } else {
            return redirect('/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Street $street
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Street $street)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $street->delete();
            return redirect('streets')->with('success', 'تم حذف الشارع بنجاح');
        } else {
            return redirect('/home');
        }
    }
}
