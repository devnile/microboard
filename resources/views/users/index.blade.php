@extends('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::users.resource')]
    ]
])

@section('title', trans('microboard::users.resource'))

@section('actions')
    @can('create', new \App\User)
        <a href="{{ route('microboard.users.create') }}" class="btn  btn-neutral">
            @lang('microboard::users.create.title')
        </a>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/datatables.net/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/microboard/vendor/datatables.net/buttons.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/microboard/vendor/datatables.net/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/microboard/vendor/datatables.net/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/microboard/vendor/datatables.net/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/microboard/vendor/datatables.net/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    {!! $dataTable->scripts() !!}
@endpush
