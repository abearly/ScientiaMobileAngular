@extends('layouts.application_master')

@section('header')
@stop

@section('content')
<div class="row">
    <base href="{!!URL::to('')!!}/" />
    <div ui-view></div>
</div>
@stop

@section('footer')
@stop
