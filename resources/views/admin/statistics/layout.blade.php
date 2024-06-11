@extends('layouts.base')

@section('page.title', 'Admin Statistics')

@section('content')
    <div class="container mt-5">
        <h1>@yield('page.title')</h1>

        <x-filter :dateFilter="$dateFilter" :date="$date" />

        <div class="chart-container">
            @yield('charts')
        </div>

        <div class="pagination mt-3">
            {{ $data->links() }}
        </div>
    </div>
@endsection
