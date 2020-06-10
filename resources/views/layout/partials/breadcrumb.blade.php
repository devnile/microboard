<nav aria-label="breadcrumb" class="d-none d-md-inline-block{{ config('microboard.view.enable_global_search') ? ' ml-md-4' : '' }}">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="{{ route('microboard.home') }}"><i class="fas fa-home"></i></a></li>
        @isset($breadcrumbs)
            @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item{{ isset($breadcrumb['url']) ? '' : ' active' }}">
                    @isset($breadcrumb['url'])
                        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                        @else
                        <span>{{ $breadcrumb['name'] }}</span>
                    @endisset
                </li>
            @endforeach
        @endisset
    </ol>
</nav>
