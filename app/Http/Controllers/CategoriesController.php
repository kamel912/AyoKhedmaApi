<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{

    var $items_list_title;
    var $url_segment;
    var $item_type;

    public function __construct()
    {
        $this->items_list_title = 'فئات';
        $this->url_segment = 'categories';
        $this->item_type = 'فئة';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $categories = Category::all();
            return view('data.index')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'items_list' => $categories,
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $this->validate($request, [
                'name' => 'required',
                'single_unit' => 'required',
                'image' => 'required|image|max:1999'
            ]);


            $category = Category::create([
                'name' => $request->name,
                'single_unit' => $request->single_unit,
            ]);

            // Get just file name
            $fileName = $category->id;
            // Get just the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Path to store Image
            $path = 'public/';
            // Upload Image
            $request->file('image')->storeAs($path . $this->url_segment, $fileNameToStore);


            $category->image = $fileNameToStore;
            $category->save;

            return redirect($this->url_segment)->with('success', 'تم إضافة ' . $this->item_type);
        } else {
            return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return redirect($this->url_segment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            return view('data.edit')->with([
                'items_list_title' => $this->items_list_title,
                'url_segment' => $this->url_segment,
                'item_type' => $this->item_type,
                'item' => $category,
            ]);
        } else {
            return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $this->validate($request, [
                'name' => 'required',
                'single_unit' => 'required',
                'image' => 'image|nullable|max:1999',
            ]);


            if ($request->hasFile('image')) {
                // Get just file name
                $fileName = $category->id;
                // Get just the extension
                $extension = $request->file('image')->getClientOriginalExtension();
                // File name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Path to store Image
                $path = 'public/';
                // Upload Image
                $request->file('image')->storeAs($path . $this->url_segment, $fileNameToStore);

                // Delete the last uploaded Image
                if ($category->image != null) {
                    Storage::delete($path . $this->url_segment . '/' . $category->image);
                }

                $category->image = $fileNameToStore;
                $category->save();

            }

            $category->update([
                'name' => $request->name,
                'single_unit' => $request->single_unit,
            ]);

            return redirect($this->url_segment)->with('success', 'تم تعديل ال' . $this->item_type . ' بنجاح');
        } else {
            return redirect('/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isEditor()) {
            $category->delete();
            return redirect('streets')->with('success', 'تم حذف الشارع بنجاح');
        } else {
            return redirect('/home');
        }
    }
}
