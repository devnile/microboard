<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body mb--4">
                {!! Form::argonInput('display_name', 'text', $role->display_name, [
                    'title' => trans('microboard::roles.fields.display_name')
                ]) !!}

                {!! Form::argonInput('name', 'text', $role->name, [
                    'title' => trans('microboard::roles.fields.name')
                ]) !!}
            </div>

            @include('microboard::roles.permissions_table', ['editable' => true, 'role' => $role])
        </div>
    </div>
</div>

