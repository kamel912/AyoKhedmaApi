<?php

namespace App\Http\Controllers;

use App\BusinessHours;
use ArrayIterator;
use Illuminate\Http\Request;
use MultipleIterator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('test');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $open_times = $request->get('open_time');
        $close_times = $request->get('close_time');

        $iterator = new MultipleIterator();
        $iterator->attachIterator(new ArrayIterator($open_times),'open_time');
        $iterator->attachIterator(new ArrayIterator($close_times), 'close_time');
        foreach ($iterator as $working_hours){
            BusinessHours::create([
                'open_time' => $working_hours[0],
                'close_time' => $working_hours[1],
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessHours  $businessHours
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessHours $businessHours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessHours  $businessHours
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessHours $businessHours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessHours  $businessHours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessHours $businessHours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessHours  $businessHours
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessHours $businessHours)
    {
        //
    }
}
