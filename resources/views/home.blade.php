@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 40px">الرئيسية</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(Auth::user()->isUser())
                            <div>
                                <h1 class="text-center ">تنبيه</h1>
                                <h3 class="text-danger text-center">لا تمتلك صلاحيات كافية للدخول إلى هذه المنطقة</h3>
                            </div>
                        @else
                            <div>
                                <h1 class="text-center" style="color: #000000">Welcome {{Auth::user()->name}}</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
