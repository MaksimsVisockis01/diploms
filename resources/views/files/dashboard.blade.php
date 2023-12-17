<div class="file-list-container">
    <h2>Files</h2>

    @if(isset($files) && auth()->check())
        @if ($files->count() > 0)
            <ul class="file-list">
                @foreach ($files as $file)
                    <li class="file-item">
                        <strong class="title">Title:</strong> {{ $file->title }}<br>
                        <strong class="author">Author:</strong> {{ $file->author }}
                        <p class="description">{{ $file->description }}</p>
                        <a href="{{ Storage::url('files/' . $file->file_path) }}" class="download-link" target="_blank">
                            Download File: {{ $file->file_path }}.{{ pathinfo($file->file_path, PATHINFO_EXTENSION) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No files available.</p>
        @endif
    @else
        <p>You need to be logged in to view files.</p>
    @endif
</div>