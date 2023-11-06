@extends('layouts.base')

@section('page.title')
    Home
@endsection

@section('content')
     @if (auth()->check())
         <p>Hello, {{ auth()->user()->name }}</p>
     @endif
     <p>
          home
     </p>
@endsection
