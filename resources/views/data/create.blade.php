@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 40px">{{$items_list_title}}</div>

                    <div class="panel-body">

                        <h1>إضافة {{$item_type}}</h1>
                        {!! Form::open(['route' => $url_segment.'.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        <div class="form-group">
                            {{Form::label('name' ,'إسم ال'.$item_type.' :')}}
                            {{Form::text('name','',['class' => 'form-control', 'placeholder' => 'إسم ال'.$item_type])}}
                            {{--<div class="valid-feedback"/>--}}
                        </div>
                        @if($url_segment == 'categories')
                            <div class="form-group">
                                {{Form::label('category' ,'مفرد ال'.$item_type.' :')}}
                                {{Form::text('single_unit','',['class' => 'form-control', 'placeholder' => 'مفرد ال'.$item_type])}}
                            </div>
                        @elseif($url_segment == 'streets')
                            {{Form::label('name' ,'المنطقة :')}}
                            <div class="form-group">
                                {{Form::select('region',$regions,null,['class' => 'form-control', 'placeholder' => 'المنطقة'])}}
                            </div>
                        @endif
                        {{Form::submit('إضافة', ['class' => 'btn btn-primary center-block'])}}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

