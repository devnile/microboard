@if (true)
    <a href="#" class="table-action" data-toggle="tooltip" data-original-title="{{ trans('microboard::pages.resources.actions.view') }}">
        <i class="fas fa-eye"></i>
    </a>
@endif

@if (true)
    <a href="#" class="table-action" data-toggle="tooltip" data-original-title="{{ trans('microboard::pages.resources.actions.edit') }}">
        <i class="fas fa-edit"></i>
    </a>
@endif

@if (true)
    <form action="#" method="post" class="d-inline-block">
        @csrf
        @method('DELETE')

        <button
                type="submit"
                class="bg-transparent border-0 p-0 table-action table-action-delete"
                data-toggle="tooltip"
                data-original-title="{{ trans('microboard::pages.resources.actions.delete.tooltip') }}"
                data-modal-title="{{ trans('microboard::pages.resources.actions.delete.title') }}"
                data-modal-text="{{ trans('microboard::pages.resources.actions.delete.text') }}"
                data-confirm="{{ trans('microboard::pages.resources.actions.delete.confirm') }}"
                data-cancel="{{ trans('microboard::pages.resources.actions.delete.cancel') }}"
        >
            <i class="fas fa-trash"></i>
        </button>
    </form>
@endif
