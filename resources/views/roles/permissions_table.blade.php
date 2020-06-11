<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead-light">
        <tr>
            <th style="width: 30%"></th>
            <th class="text-center">@lang('microboard::roles.fields.permissions.viewAny')</th>
            <th class="text-center">@lang('microboard::roles.fields.permissions.view')</th>
            <th class="text-center">@lang('microboard::roles.fields.permissions.create')</th>
            <th class="text-center">@lang('microboard::roles.fields.permissions.update')</th>
            <th class="text-center">@lang('microboard::roles.fields.permissions.delete')</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\Microboard\Models\Permission::groupByModel() as $model => $permissions)
            <tr>
                <th>
                    @if(in_array($model, ['users', 'roles', 'settings']))
                        @lang('microboard::' . $model . '.resource')
                    @elseif($model === 'dashboard')
                        @lang('microboard::pages.' . $model)
                    @else
                        @lang($model . '.resource')
                    @endif
                </th>
                @foreach(['viewAny', 'view', 'create', 'update', 'delete'] as $ability)
                    @php
                        /** @var \Illuminate\Database\Eloquent\Collection $permissions */
                        $permission = $permissions->filter(function($permission) use($ability) {
                            return \Illuminate\Support\Str::endsWith($permission->name, $ability);
                        })->first();
                    @endphp

                    @if ($permission)
                        @include('microboard::roles.permissions_table_row')
                    @else
                        <td class="text-center text-muted">—</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
