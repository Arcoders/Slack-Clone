@extends('layouts.app_chat')

@section('content')
        <div class="col-md-12">

            <router-view :user="{{Auth::user()}}"></router-view>

        </div>
@endsection
