<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ObjectResource;
use App\Http\Resources\objectsResource;
use App\BasicObject;
use Illuminate\Http\Request;

class ObjectsController extends Controller
{
    public function index(){
        return ObjectsResource::collection(BasicObject::all());
    }

    public function show(BasicObject $object){
        return new ObjectResource($object);
    }


    public function store(Request $request){
         $object = BasicObject::create($request->all());
        return response()->json($object);
    }


    public function update(Request $request, BasicObject $object)
    {
        $object->update($request->all());

        return response()->json($object);
    }

    public function delete(BasicObject $object)
    {
        $object->delete();

        return response()->json(['message' => 'BasicObject deleted']);
    }




}
