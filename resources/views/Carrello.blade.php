@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ url('css/carrello.css') }}">
@endsection

@section('js')
<script src='{{url("js/scriptCarrello.js")}}' defer></script>
@parent
@endsection 


@section('preferiti')
@endsection

 @section('search')
<div class="searchbox">
<h1>Elementi nel carrello</h1>
</div>
@endsection

@section('divParticular')
<div id="divErroreAcquistaContainer">
</div>
@endsection

@section('modalview')
@endsection

