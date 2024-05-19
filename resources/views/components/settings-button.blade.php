@if(auth()->check())
<div class=" btn-group position-absolute btn-clipboard top-0 end-0">
    <button  type="button" class="btn border-0" data-bs-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
        </svg>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="menu1">
        {{ $slot }}
    </ul>
</div>
@endif