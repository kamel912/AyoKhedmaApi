@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 35px">ال{{$items_list_title}}</div>

                    <div class="panel-body">
                        <a href="/{{$url_segment}}/create" class="btn btn-primary center-block"
                           style="width: fit-content">إضافة {{$item_type}}</a>
                        <br>
                        <br>
                        @if(count($items_list) > 0)
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th><h4 class="pull-right">م</h4></th>
                                    @if($url_segment == 'categories')
                                        <th style="width: 45%"><h4 class="pull-right">إسم ال{{$item_type}}</h4></th>
                                        <th style="width: 45%"><h4 class="pull-right">مفرد ال{{$item_type}}</h4></th>
                                    @elseif($url_segment == 'objects')
                                        <th style="width: 45%"><h4 class="pull-right">إسم ال{{$item_type}}</h4></th>
                                        <th style="width: 45%"><h4 class="pull-right">الفئة</h4></th>
                                    @elseif($url_segment == 'streets')
                                        <th style="width: 45%"><h4 class="pull-right">إسم ال{{$item_type}}</h4></th>
                                        <th style="width: 45%"><h4 class="pull-right">المنطقة</h4></th>
                                    @else
                                        <th style="width: 90%"><h4 class="pull-right">إسم ال{{$item_type}}</h4></th>
                                    @endif
                                    <th><h4 class="text-center">تعديل</h4></th>
                                    <th><h4 class="text-center">حذف</h4></th>
                                </tr>
                                @foreach($items_list as $index => $item)
                                    <tr>
                                        <td>
                                            {{$index+1}}
                                        </td>

                                        <td>
                                            @if($url_segment == 'objects')
                                                <a href="{{$url_segment}}/{{$item->id}}">
                                                    {{$item->name}}
                                                </a>
                                            @else
                                                {{$item->name}}
                                            @endif
                                        </td>

                                        @if($url_segment == 'categories')
                                            <td>
                                                {{$item->single_unit}}
                                            </td>
                                        @elseif($url_segment == 'objects')
                                            <td>
                                                {{$item->category->single_unit}}
                                            </td>
                                        @elseif($url_segment == 'streets')
                                            <td>
                                                {{$item->region->name }}
                                            </td>
                                        @endif


                                        <td><a href="/{{$url_segment}}/{{$item->id}}/edit"
                                               class="btn btn-default pull-right">تعديل</a></td>
                                        <td>
                                            {!! Form::open(['route' => [$url_segment.'.destroy', $item->id], 'method' =>'delete', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('حذف', ['class' => 'btn btn-danger'])}}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>لا توجد {{$items_list_title}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
