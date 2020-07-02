<div class="row">
    <div class="col">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-flush">
                    <tbody>
                    <tr>
                        <th style="width: 25%">@lang('microboard::roles.fields.display_name')</th>
                        <td>{{ $role->display_name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 25%">@lang('microboard::roles.fields.name')</th>
                        <td>{{ $role->name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            @include('microboard::roles.permissions_table', ['role' => $role])
        </div>
    </div>
</div>
