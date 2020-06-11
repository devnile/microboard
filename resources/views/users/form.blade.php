<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body mb--4">
                {!! Form::argonInput('name', 'text', $user->name, [
                    'title' => trans('microboard::users.fields.name'),
                    'autoComplete' => 'name',
                ]) !!}

                {!! Form::argonInput('email', 'email', $user->email, [
                    'title' => trans('microboard::users.fields.email'),
                    'autoComplete' => 'email',
                ]) !!}

                @if ($user->exists)
                    <hr>

                    {!! Form::argonInput('auth_password', 'password', null, [
                       'title' => trans('microboard::users.fields.current_password.label'),
                       'help' => trans('microboard::users.fields.current_password.help')
                   ]) !!}
                @endif
                {!! Form::argonInput('password', 'password', null, [
                    'title' => trans('microboard::users.fields.password'),
                    'autoComplete' => 'current-password',
                ]) !!}

                {!! Form::argonInput('password_confirmation', 'password', null, [
                    'title' => trans('microboard::users.fields.password_confirmation'),
                ]) !!}
                @if ($user->exists)
                    <hr>
                @endif

                {!! Form::argonSelect('role_id', \Microboard\Models\Role::pluck('display_name', 'id'), $user->role_id, [
                    'title' => trans('microboard::users.fields.role_id'),
                ]) !!}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            {!! Form::avatar(null, [
                'title' => trans('microboard::users.fields.select_avatar')
            ]) !!}
        </div>
    </div>
</div>
