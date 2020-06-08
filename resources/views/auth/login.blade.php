@extends('microboard::layout.auth')

@section('title', trans('microboard::pages.login.title'))

@section('content')
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary mb-0 shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>@lang('microboard::pages.login.title')</small>
                </div>
                <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf

                    @component('microboard::input', [
                        'name' => 'email',
                        'type' => 'email',
                        'title' => trans('microboard::users.fields.email'),
                        'icon' => 'ni ni-email-83',
                        'value' => null,
                        'alternative' => true,
                        'autoComplete' => 'email'
                    ])@endcomponent

                    @component('microboard::input', [
                        'name' => 'password',
                        'type' => 'password',
                        'title' => trans('microboard::users.fields.password'),
                        'icon' => 'ni ni-lock-circle-open',
                        'value' => false,
                        'alternative' => true,
                        'autoComplete' => 'current-password'
                    ])@endcomponent

                    @component('microboard::checkbox', [
                        'name' => 'remember',
                        'title' => trans('microboard::pages.login.remember'),
                        'alternative' => true
                    ])@endcomponent

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">@lang('microboard::pages.login.submit')</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @if (Route::has('password.request'))
                <div class="col-6 mt-3">
                    <a href="{{ route('password.request') }}" class="text-light">
                        <small>@lang('microboard::pages.reset.title')</small>
                    </a>
                </div>
            @endif

            @if (Route::has('register'))
                <div class="col-6 mt-3 text-right">
                    <a href="{{ route('register') }}" class="text-light">
                        <small>@lang('microboard::pages.register.title')</small>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
