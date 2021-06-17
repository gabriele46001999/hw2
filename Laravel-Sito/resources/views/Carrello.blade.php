@extends('layouts.OtherPages')
@section('css')
<link rel="stylesheet" href="{{ url('css/carrello.css') }}">
@endsection

@section('js')
<script src='{{url("js/scriptCarrello.js")}}' defer></script>
@parent
@endsection 


@section('divMore')
<div id="divErroreAcquistaContainer">
</div>
@endsection

@section('text','ELEMENTI NEL CARRELLO')
