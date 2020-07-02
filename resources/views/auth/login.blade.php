@extends('microboard::layouts.auth')

@section('title', trans('microboard::pages.login.title'))

@section('content')
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary mb-0 shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>@lang('microboard::pages.login.title')</small>
                </div>
                {!! Form::open([
                    'route'=> 'login',
                    'method' => 'post',
                    'id' => 'login'
                ]) !!}
                {!! Form::argonInput('email', 'email', null, [
                    'title' => trans('microboard::users.fields.email'),
                    'icon' => 'ni ni-email-83',
                    'alternative' => true,
                    'autoComplete' => 'email',
                    'hideLabel' => true
                ]) !!}

                {!! Form::argonInput('password', 'password', null, [
                    'title' => trans('microboard::users.fields.password'),
                    'icon' => 'ni ni-lock-circle-open',
                    'alternative' => true,
                    'autoComplete' => 'current-password',
                    'hideLabel' => true
                ]) !!}
                {!! Form::argonCheckbox('remember', 1, false, [
                    'title' => trans('microboard::pages.login.remember'),
                    'alternative' => true,
                ]) !!}

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4 action-submit" data-form="#login">
                        @lang('microboard::pages.login.submit')
                    </button>
                </div>
                {!! Form::close() !!}
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
