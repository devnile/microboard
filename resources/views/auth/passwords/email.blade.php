@extends('microboard::layout.auth')

@section('title', trans('microboard::pages.reset.title'))

@section('content')
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary mb-0 shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>@lang('microboard::pages.reset.title')</small>
                </div>
                {!! Form::open([
                    'route' => 'password.email',
                    'method' => 'post',
                    'id' => 'reset'
                ]) !!}
                {!! Form::argonInput('email', 'email', null, [
                    'title' => trans('microboard::users.fields.email'),
                    'icon' => 'ni ni-email-83',
                    'alternative' => true,
                    'autoComplete' => 'email',
                    'hideLabel' => true
                ]) !!}

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4 action-submit" data-form="#reset">
                        @lang('microboard::pages.reset.submit')
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
