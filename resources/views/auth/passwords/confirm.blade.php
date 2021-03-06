@extends('microboard::layouts.auth')

@section('title', trans('microboard::pages.confirm.title'))

@section('content')
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary mb-0 shadow border-0">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                             class="rounded-circle border-secondary">
                    </div>
                </div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center mb-4">
                    <h3>{{ auth()->user()->name }}</h3>
                </div>

                {!! Form::open([
                    'route' => 'password.confirm',
                    'method' => 'post',
                    'id' => 'confirm'
                ]) !!}
                {!! Form::argonInput('password', 'password', null, [
                    'title' => trans('microboard::users.fields.password'),
                    'icon' => 'ni ni-lock-circle-open',
                    'alternative' => true,
                    'autoComplete' => 'current-password',
                    'hideLabel' => true
                ]) !!}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4 action-submit" data-form="#confirm">
                        @lang('microboard::pages.confirm.submit')
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
