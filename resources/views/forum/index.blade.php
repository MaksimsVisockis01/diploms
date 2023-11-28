@extends('layouts.base')

@section('page.title')
    forum
@endsection

@section('content')
     {{-- @if (auth()->check())
         <p>Hello, {{ auth()->user()->name }}</p>
     @endif --}}
     <p>
          forum
     </p>
     <p><a href="{{ route('question') }}">create question</a></p>
     
@endsection
