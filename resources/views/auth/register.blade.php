@extends('microboard::layouts.auth')

@section('title', trans('microboard::pages.register.title'))

@section('content')
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary mb-0 shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>@lang('microboard::pages.register.title')</small>
                </div>
                {!! Form::open([
                    'route' => 'register',
                    'method' => 'post',
                    'id' => 'register'
                ]) !!}
                    {!! Form::argonInput('name', 'text', null, [
                        'title' => trans('microboard::users.fields.name'),
                        'icon' => 'ni ni-circle-08',
                        'alternative' => true,
                        'autoComplete' => 'name',
                        'hideLabel' => true
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
                        'autoComplete' => 'new-password',
                        'hideLabel' => true
                    ]) !!}
                    {!! Form::argonInput('password_confirmation', 'password', null, [
                        'title' => trans('microboard::users.fields.password_confirmation'),
                        'icon' => 'ni ni-lock-circle-open',
                        'alternative' => true,
                        'hideLabel' => true
                    ]) !!}

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4 action-submit" data-form="#register">
                            @lang('microboard::pages.register.submit')
                        </button>
                    </div>
                {!! Form::close() !!}
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
