@if ($breadcrumbs)
    <div class="ui breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$breadcrumb->last)
                <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                <i class="right angle icon divider"></i>
            @else
                <div class="active section">{{ $breadcrumb->title }}</div>
            @endif
        @endforeach
    </div>
@endif