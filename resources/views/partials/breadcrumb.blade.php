<div class="row single-section mx-auto my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (isset($breadcrumb['link']))
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['name'] }}</a></li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
