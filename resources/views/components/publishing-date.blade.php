@props(['uid', 'published_at'])

<div class="position-absolute align-self-end bottom-0 end-0">
    <span class="fs-6">
        {{ $uid }}
    </span>
    <span class="fs-6 fw-light">
        {{ $published_at ? \Carbon\Carbon::parse($published_at)->diffForHumans() : 'null' }}
    </span>
</div>