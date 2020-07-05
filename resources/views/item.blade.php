<!-- index.blade.php -->
@extends('layouts.master')
 
@section('title', 'index')

@section('style')
@parent
@endsection
 
@section('content')
<router-view></router-view>
@endsection
 
@section('script')
@parent
@endsection