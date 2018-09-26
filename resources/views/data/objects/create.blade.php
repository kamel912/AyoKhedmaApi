@extends('layouts.app')
@section('head')
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>--}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 40px">{{$items_list_title}}</div>

                    <div class="panel-body">
                        <div class="col-md-12 order-md-1">

                            <h1>إضافة {{$item_type}}</h1>
                            {!! Form::open(['route' => $url_segment.'.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                            <div class="col-md-8 pull-right">
                                {{Form::label('name' ,'إسم ال'.$item_type.' :')}}
                                {{Form::text('name','',['class' => 'form-control', 'placeholder' => 'إسم ال'.$item_type])}}
                            </div>

                            <div class="col-md-8 pull-right">
                                {{Form::label('category' ,'الوصف :')}}
                                {{Form::textarea('description','',['class' => 'form-control', 'placeholder' => 'الوصف'])}}
                            </div>

                            <div class="col-md-8 pull-right">
                                {{Form::label('category' ,'الفئة :')}}
                                {{Form::select('category', $categories, null,['class' => 'form-control', 'placeholder' => 'أختر فئة'])}}
                            </div>

                            <div class="col-md-8 pull-right">
                                <h4>العنوان :</h4>

                                <div class="col-md-3 pull-right">
                                    {{Form::select('region', $regions, null,['class' => 'form-control', 'placeholder' => 'أختر المنطقة', 'id' => 'region'])}}
                                </div>
                                <div class="col-md-3 pull-right">
                                    {{Form::select('street', $streets, null,['class' => 'form-control', 'placeholder' => 'أختر الشارع', 'id' => 'street'])}}
                                </div>
                                <div class="col-md-6 pull-right">
                                    {{Form::text('beside','',['class' => 'form-control', 'placeholder' => 'بجوار'])}}
                                </div>
                            </div>

                            <div class="col-md-8 pull-right">
                                <h4>فترات العمل :</h4>
                                <div class="form-group">
                                    {{Form::label('holiday' ,'يوم العطلة :')}}
                                    {{Form::select('holiday', $days, null,['class' => 'form-control', 'placeholder' => 'لا يوجد يوم عطلة'])}}
                                </div>
                                <div class="table" id="working_hours">
                                    <tr>
                                        <th style="width: 45%">
                                            <div class="col-md-5 pull-right">
                                                {{Form::label('open_time', 'بداية العمل :')}}
                                            </div>
                                        </th>
                                        <th style="width: 45%">
                                            <div class="col-md-5 pull-right">
                                                {{Form::label('open_time', 'نهاية العمل :')}}
                                            </div>
                                        </th>
                                        <th style="width: 10%">

                                        </th>
                                    </tr>
                                    <tr>
                                        <div id="working_hours1">
                                            <td>
                                                <div class="col-md-5 pull-right">
                                                    {{Form::time('open_time[]','08:00:00', ['class' => 'form-control open_times_list', 'id' => 'open_time'])}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-md-5 pull-right">
                                                    {{Form::time('close_time[]','01:00:00',['class' => 'form-control', 'id' => 'close_time'])}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-md-2 pull-right">
                                                    {{
                                                    Form::button('+', [
                                                    'class' => 'btn btn-success',
                                                     'id'=>'add_working_hours',
                                                     'name'=>'add_working_hours',
                                                     ])
                                                     }}
                                                </div>
                                            </td>
                                        </div>
                                    </tr>
                                </div>
                            </div>


                            <div class="col-md-8 pull-right" id="phones">
                                <h4>أرقام الهاتف :</h4>
                                <div id="phone1">
                                    <div class="col-md-10 pull-right">

                                        {{Form::tel('number[]','',['class' => 'form-control', 'placeholder' => 'رقم الهاتف', 'id' => 'number'])}}

                                    </div>
                                    <div class="col-md-2 pull-right">
                                        {{Form::button('+', ['class' => 'btn btn-success', 'id' => 'add_phone', 'name' => 'add_phone'])}}
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-8 pull-right">
                                {{Form::file('image')}}
                            </div>

                            <div class="col-md-8 center-block">
                                {{Form::submit('إضافة', ['class' => 'btn btn-primary center-block'])}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script language="JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"
        type="text/javascript"></script>

<script>
    $(document).ready(function () {
        var i = 1;
        var f = 1;

        $('#add_working_hours').click(function () {
            if (i < 2) {
                i++;
                $('#working_hours').append(
                    '<div id = "working_hours' + i + '">' +
                    '<div class="col-md-5 pull-right">' +
                    '<input type="time" value="16:00:00" name="open_time[]" class = "form-control open_times_list" id = "open_time ' + i + '">' +
                    '</div>' +
                    '<div class="col-md-5 pull-right">' +
                    '<input type="time" value="00:00:00" name="close_time[]" class ="form-control open_times_list" id = "close_time ' + i + '">' +
                    '</div>' +
                    '<div class="col-md-2 pull-right form-group">' +
                    '<button type="button" class = "btn btn-danger " id = "remove_working_hours' + i + '" name = "remove_working_hours">' +
                    '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>' +
                    '</button>' +
                    '</div>' +
                    '</div>'
                );
            } else {
                return;
            }

            $('#remove_working_hours' + i).click(function () {
                $('#working_hours' + i).remove();
                i--;
            });
        });

        $('#add_phone').click(function () {
            f++;
            $('#phones').append(
                '<div id="phone' + f + '">' +
                '<div class="col-md-10 pull-right">' +
                '<input type="tel" name="number[]" class = "form-control" placeholder = "رقم الهاتف" id = "number' + f + '">' +
                '</div>' +
                '<div class="col-md-2 pull-right">' +
                '<button type="button" class = "btn btn-danger form-group" id = "remove_phone' + f + '" name = "remove_phone">' +
                '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>' +
                '</button>' +
                '</div>' +
                '</div>'
            );

            $('#remove_phone' + f).click(function () {
                $('#phone' + f).remove();
                f--;
            });
        });



        $('#region').change(function(){
            $.get("{{ url('streets/data')}}",
                { region: $(this).val() },
                function(data) {
                    var street = $('#street');
                    street.empty();

                    street.append("<option value=''>أختر الشارع</option>");
                    $.each(data, function(index, element) {
                        street.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                    });
                });
        });
    });
</script>