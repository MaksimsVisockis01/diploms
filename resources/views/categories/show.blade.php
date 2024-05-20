@extends('layouts.base')

@section('page.title', 'Category')

@section('content')
<div class="container">
    <h1 class="my-4">{{ $category->title }}</h1>
    <p>{{ $category->description }}</p>

    <div class="row">
        <div class="col-md-12">
            <h3>Content</h3>
            <ul class="list-group">
                @php
                    $content = collect();

                    // Add questions to the content
                    foreach($category->questions->sortByDesc('created_at') as $question) {
                        $content->push([
                            'type' => 'question',
                            'item' => $question
                        ]);
                    }

                    // Add files to the content
                    foreach($category->files->sortByDesc('created_at') as $file) {
                        $content->push([
                            'type' => 'file',
                            'item' => $file
                        ]);
                    }

                    // Sort content by created_at
                    $content = $content->sortByDesc(function($item) {
                        return $item['item']->created_at;
                    });
                @endphp

                @foreach($content as $item)
                    @if($item['type'] === 'question')
                        <li class="list-group-item">
                            <h5>{{ $item['item']->title }}</h5>
                            <p>{{ $item['item']->content }}</p>
                        </li>
                    @elseif($item['type'] === 'file')
                        <li class="list-group-item">
                            <h5>{{ $item['item']->title }}</h5>
                            <p>{{ $item['item']->description }}</p>
                            <a href="{{ $item['item']->file_path }}" class="btn btn-primary">Download</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
