@can('view-dashboard')
    <li class="nav-item">
        <a class="nav-link{{ request()->is(config('microboard.routes.prefix')) ? ' active' : '' }}"
           href="{{ route('microboard.home') }}"
        >
            <i class="ni ni-app text-primary"></i>
            <span class="nav-link-text">@lang('microboard::pages.dashboard')</span>
        </a>
    </li>
@endcan

@can('viewAny', new \Microboard\Models\Setting)
    <li class="nav-item">
        <a class="nav-link{{ request()->is('*settings*') ? ' active' : '' }}"
           href="{{ route('microboard.settings.index') }}"
        >
            <i class="ni ni-ui-04 text-primary"></i>
            <span class="nav-link-text">@lang('microboard::settings.resource')</span>
        </a>
    </li>

    <li class="px-4">
        <hr class="my-3">
    </li>
@endcan

@can('viewAny', new \App\User)
    <li class="nav-item">
        <a class="nav-link{{ request()->is('*users*') ? ' active' : '' }}"
           href="{{ route('microboard.users.index') }}"
        >
            <i class="ni ni-single-02 text-primary"></i>
            <span class="nav-link-text">@lang('microboard::users.resource')</span>
        </a>
    </li>
@endcan


@can('viewAny', new \Microboard\Models\Role)
    <li class="nav-item">
        <a class="nav-link{{ request()->is('*roles*') ? ' active' : '' }}"
           href="{{ route('microboard.roles.index') }}"
        >
            <i class="ni ni-key-25 text-primary"></i>
            <span class="nav-link-text">@lang('microboard::roles.resource')</span>
        </a>
    </li>
@endcan

<li class="px-4">
    <hr class="my-3">
</li>
