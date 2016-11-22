@extends('template.admin')

@section('title', 'Login')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
@if (Auth::attempt('authority_id'=1)
{
    Your Admin!
}@else{
    fuck!
}
@endif




@endsection