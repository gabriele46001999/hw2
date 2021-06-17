@extends('layouts.OtherPages')
@section('css')
<link rel="stylesheet" href="{{ url('css/Acquisti.css') }}">
@endsection

@section('js')
<script src='{{url("js/Acquisti.js")}}' defer></script>
@parent
@endsection 

@section('text','ELEMENTI ACQUISTATI')

