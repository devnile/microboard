@extends ('microboard::layout.app', [
    'breadcrumbs' => [
        ['name' => trans('microboard::settings.resource'), 'url' => route('microboard.settings.index')],
        ['name' => trans('microboard::settings.view.title', ['name' => $setting->name])]
    ]
])

@section('title', trans('microboard::settings.view.title', ['name' => $setting->name]))

@section('actions')
    @can('update', $setting)
        <a href="{{ route('microboard.settings.edit', $setting) }}" class="btn btn-neutral px-4">
            @lang('microboard::settings.edit.action-button')
        </a>
    @endcan

    @can('delete', $setting)
        <form action="{{ route('microboard.settings.destroy', $setting) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger action-delete"
                    data-toggle="tooltip"
                    data-placement="right"
                    data-original-title="{{ trans('microboard::settings.delete.action-button') }}"
                    data-modal-title="{{ trans('microboard::settings.delete.title') }}"
                    data-modal-text="{{ trans('microboard::settings.delete.text') }}"
                    data-confirm="{{ trans('microboard::settings.delete.confirm') }}"
                    data-cancel="{{ trans('microboard::settings.delete.cancel') }}"
            >
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-flush">
                        <tbody>
							<tr>
								<th style="width: 25%;">@lang('microboard::settings.fields.key')</th>
								<td>{{ $setting->key }}</td>
							</tr>
							<tr>
								<th style="width: 25%;">@lang('microboard::settings.fields.value')</th>
								<td>{{ $setting->value }}</td>
							</tr>
							<tr>
								<th style="width: 25%;">@lang('microboard::settings.fields.cast')</th>
								<td>{{ $setting->cast }}</td>
							</tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
