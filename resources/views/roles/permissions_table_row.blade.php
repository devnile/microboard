<td class="text-center">
    @isset($editable)
        {!! Form::argonToggle('permissions[]', $permission->id, $role->permissions->contains($permission), [
            'id' => "permissions-{$permission->id}-{$permission->name}"
        ]) !!}
    @else
        @if ($role->permissions->contains($permission))
            <span class="badge badge-pill badge-success"><i class="fa fa-check"></i></span>
        @else
            <span class="badge badge-pill badge-danger"><i class="fa fa-times"></i></span>
        @endif
    @endisset
</td>
