@props(['uid', 'userId', 'published_at'])

<div class="position-absolute align-self-end bottom-0 end-0 d-flex">
    <span class="fs-6">
        <a href="{{ route('profile.show', $userId) }}">{{ $uid }}</a>
    </span>
    <span class="fs-6 fw-light">
        {{ $published_at ? \Carbon\Carbon::parse($published_at)->diffForHumans() : 'null' }}
    </span>
</div>