@extends('microboard::layout.auth')

@section('content')
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary mb-0 shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>@lang('microboard::pages.reset.update')</small>
                </div>

                {!! Form::open([
                    'route' => 'password.update',
                    'method' => 'post',
                    'id' => 'update'
                ]) !!}
                {!! Form::hidden('token', $token) !!}
                {!! Form::argonInput('email', 'email', ($email ?? old('email')), [
                    'title' => trans('microboard::users.fields.email'),
                    'icon' => 'ni ni-email-83',
                    'alternative' => true,
                    'hideLabel' => true,
                    'readonly'
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
                    <button type="submit" class="btn btn-primary mt-4 action-submit" data-form="#update">
                        @lang('microboard::pages.reset.save')
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
