<section class="my-5 border p-4 mx-auto w-50">
    <div class="file-list-container">
        <h2 class="mb-4">Files</h2>

        @if(isset($files) && auth()->check())
            @if ($files->count() > 0)
                <ul class="list-group">
                    @foreach ($files as $file)
                        <li class="list-group-item">
                            <span class="text-uppercase fs-5">{{ $file->title }}</span><br>
                            <span class="text-capitalize font-weight-bold">{{ $file->author }}</span>
                            <p>{{ $file->description }}</p>
                            <a href="{{ Storage::url('files/' . $file->file_path) }}" class="btn btn-primary btn-sm" target="_blank">
                                Download File: {{ $file->file_path }}.{{ pathinfo($file->file_path, PATHINFO_EXTENSION) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No files available.</p>
            @endif
        @else
            <div class="alert alert-info border border-primary rounded p-2" role="alert">
                <p class="mb-0">You need to be logged in to view files.</p>
            </div>
        @endif
    </div>
</section>
