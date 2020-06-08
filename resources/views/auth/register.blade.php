@extends('microboard::layout.auth')

@section('title', trans('microboard::pages.register.title'))

@section('content')
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary mb-0 shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>@lang('microboard::pages.register.title')</small>
                </div>
                <form role="form" method="POST" action="{{ route('register') }}">
                    @csrf

                    @component('microboard::input', [
                        'name' => 'name',
                        'type' => 'text',
                        'title' => trans('microboard::users.fields.name'),
                        'icon' => 'ni ni-circle-08',
                        'value' => null,
                        'alternative' => true,
                        'autoComplete' => 'name'
                    ])@endcomponent

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

                    @component('microboard::input', [
                        'name' => 'password_confirmation',
                        'type' => 'password',
                        'title' => trans('microboard::users.fields.password_confirmation'),
                        'icon' => 'ni ni-lock-circle-open',
                        'value' => false,
                        'alternative' => true,
                    ])@endcomponent

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">@lang('microboard::pages.register.submit')</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-6 mt-3">
                <a href="{{ route('login') }}" class="text-light">
                    <small>@lang('microboard::pages.login.title')</small>
                </a>
            </div>
        </div>
    </div>
@endsection
