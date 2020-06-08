@extends('microboard::layout.auth')

@section('title', trans('microboard::pages.verify.title'))

@section('content')
    <div class="col-md-8">
        <div class="card bg-secondary mb-0 shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>@lang('microboard::pages.verify.title')</small>
                </div>

                <p>@lang('microboard::pages.verify.text')</p>

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf

                    <button type="submit" class="btn btn-default btn-block">
                        @lang('microboard::pages.verify.submit')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
