@if (true)
    <a href="#" class="table-action" data-toggle="tooltip" data-original-title="Show">
        <i class="fas fa-eye"></i>
    </a>
@endif

@if (true)
    <a href="#" class="table-action" data-toggle="tooltip" data-original-title="Edit">
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
                data-original-title="Delete"
                data-modal-title="هل أنت متأكد؟"
                data-modal-text="في حال حذف السجل، سيتم حذفه وجميع معلوماته نهائياً!"
                data-confirm="نعم، قم بالحذف"
                data-cancel="إلغاء الأمر"
        >
            <i class="fas fa-trash"></i>
        </button>
    </form>
@endif
