@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 40px">{{$items_list_title}}</div>

                    <div class="panel-body">

                        <h3 class="text-center">تعديل {{$item_type}}</h3>
                        {!! Form::open(['route' => [$url_segment.'.update', $item->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        <div class="form-group">
                            {{Form::label('name' ,'إسم ال'.$item_type.' :')}}
                            {{Form::text('name', $item->name, ['class' => 'form-control', 'placeholder' => 'إسم ال'.$item_type])}}
                        </div>

                        @if($url_segment == 'categories')
                            <div class="form-group">
                                {{Form::text('single_unit', $item->single_unit,['class' => 'form-control', 'placeholder' => 'مفرد ال'.$item_type])}}
                            </div>
                            <div class="form-group">
                                {{Form::file('image')}}
                            </div>
                        @elseif($url_segment == 'streets')
                            <div class="form-group">
                                {{Form::label('name' ,'المنطقة :')}}
                                {{Form::select('region',$regions,$item->region->id,['class' => 'form-control', 'placeholder' => 'أختر المنطقة'])}}
                            </div>
                        @endif

                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('تعديل', ['class' => 'btn btn-primary center-block'])}}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

