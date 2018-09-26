<?php

namespace App\Http\Controllers;

use App\BusinessHours;
use App\Category;
use App\Day;
use App\BasicObject;
use App\Phone;
use App\Region;
use App\Street;
use ArrayIterator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use MultipleIterator;

class ObjectsController extends Controller
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
            $Objects = BasicObject::select()->with('category')->get();
            return view('data.index')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'items_list' => $Objects,
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
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $categories = Category::pluck('name', 'id');
            $regions = Region::pluck('name', 'id');
            $streets = Street::pluck('name', 'id');
            $days = Day::pluck('arabic_name', 'id');
            return view('data.objects.create')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'item_type' => $this->item_type,
                'categories' => $categories,
                'regions' => $regions,
                'streets' => $streets,
                'days' => $days,
            ]);
        } else {
            return redirect('/home');
        }
    }

    public function streets()
    {
        $region_id = Input::get('region');
        $region = Region::find($region_id);
        $streets = $region->streets();
        $streets = $streets->get(['id', 'name']);
        return $streets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'beside' => 'required',
            'category' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'number' => 'required',
            'region' => 'required',
            'street' => 'required',
            'image' => 'image|nullable|max:1999',

        ]);

        $category = Category::find($request->get('category'));
        $categoryName = $category->single_unit;
        $objectName =  $request->get('name');
        if ($request->hasFile('image')) {

            // Get file name with the extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Get just file name
//            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileName = $categoryName . '-' .$objectName;
            // Get just the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/objects', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage';
        }

        $object = new BasicObject();
        $object->name = $request->get('name');
        $object->description = $request->get('description');
        if ($request->has('holiday')){
            $object->holiday_id = $request->get('holiday');
        }
        $object->category_id = $request->get('category');
        $object->region_id = $request->get('region');
        $object->street_id = $request->get('street');
        $object->beside = $request->get('beside');
        $object->image = $fileNameToStore;
        $object->save();

        $open_times = $request->get('open_time');
        $close_times = $request->get('close_time');

        $business_hours = [];
        $iterator = new MultipleIterator();
        $iterator->attachIterator(new ArrayIterator($open_times), 'open_time');
        $iterator->attachIterator(new ArrayIterator($close_times), 'close_time');
        foreach ($iterator as $working_hours) {
            $business_hours[] = new BusinessHours([
                'open_time' => $working_hours[0],
                'close_time' => $working_hours[1],
            ]);
        }
        $object->businessHours()->saveMany($business_hours);


        $numbers = $request->get('number');
        $phones = [];
        foreach ($numbers as $number) {
            $phones[] = new Phone([
                'number' => $number,
            ]);
        }
        $object->phones()->saveMany($phones);

        return redirect('objects')->with('success', 'تم إضافة '.$categoryName.' '.$objectName);
    }

    /**
     * Display the specified resource.
     *
     * @param Object $object
     * @return void
     */
    public function show(BasicObject $object)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Object $object
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(BasicObject $object)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $categories = Category::pluck('name', 'id');
            $regions = Region::pluck('name', 'id');
            $streets = Street::pluck('name', 'id');
            $days = Day::pluck('arabic_name', 'id');
            $business_hours = $object->businessHours;
            $phones = $object->phones;

            return view('data.objects.edit')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'item_type' => $this->item_type,
                'categories' => $categories,
                'regions' => $regions,
                'streets' => $streets,
                'days' => $days,
                'item' => $object,
                'business_hours' => $business_hours,
                'phones' => $phones,
            ]);
        } else {
            return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Object $object
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BasicObject $object)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'beside' => 'required',
            'category' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'number' => 'required',
            'region' => 'required',
            'street' => 'required',
            'image' => 'image|nullable|max:1999',

        ]);

        $category = Category::find($request->get('category'));
        $categoryName = $category->single_unit;
        $objectName =  $request->get('name');
        if ($request->hasFile('image')) {

            // Get file name with the extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Get just file name
//            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileName = $categoryName . '-' .$objectName;
            // Get just the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/objects', $fileNameToStore);
        }

        $object->name = $request->get('name');
        $object->description = $request->get('description');
        $object->category_id = $request->get('category');
        $object->region_id = $request->get('region');
        $object->street_id = $request->get('street');
        $object->beside = $request->get('beside');
        if ($request->has('holiday')){
            $object->holiday_id = $request->get('holiday');
        }
        if ($request->hasFile('image')) {
            Storage::delete('public/images/' . $object->cover_image);
            $object->image = $fileNameToStore;
        }
        $object->save();

        $open_times = $request->get('open_time');
        $close_times = $request->get('close_time');

        $business_hours = [];
        $iterator = new MultipleIterator();
        $iterator->attachIterator(new ArrayIterator($open_times), 'open_time');
        $iterator->attachIterator(new ArrayIterator($close_times), 'close_time');
        foreach ($iterator as $working_hours) {
            $business_hours[] = new BusinessHours([
                'open_time' => $working_hours[0],
                'close_time' => $working_hours[1],
            ]);
        }
//        $object->businessHours()->saveMany($business_hours);


        $numbers = $request->get('number');
        $phones = [];
        foreach ($numbers as $number) {
            $phones[] = new Phone([
                'number' => $number,
            ]);
        }
//        $object->phones()->saveMany($phones);

        return redirect('objects')->with('success', 'تم تعديل '.$categoryName.' '.$objectName);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Object $object
     * @return \Illuminate\Http\Response
     */
    public function destroy(BasicObject $object)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $object->delete();
            return redirect('objects')->with('success', 'تم حذف العنصر بنجاح');
        } else {
            return redirect('/home');
        }
    }
}
