@extends('adminlte::page')

@section('title', 'Blog J2Fotográfos')

@section('content_header')
    <h1>Lista de usuario</h1>
@stop

@section('content')
    @livewire('admin.users-update')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop