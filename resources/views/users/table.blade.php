@if ($users->count() > 0)
    @foreach ($users as $item => $value)
        <tr style="font-size: 14px;">
            <td>{{ $item + 1 }}</td>
            <td class="w-25">{{ $value->name }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->role }}</td>
            <td>
                <button type="button" onclick="edit({{ $value->id }})" class="btn btn-sm btn-primary"><i
                        class="fas fa-fw fa-edit"></i>&nbsp;Edit</button>
                <button class="btn btn-sm btn-danger" onclick="destroy({{ $value->id }})"><i
                        class="fas fa-fw fa-trash"></i>&nbsp;Delete</button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" align="center">
            <h5>No data here, please add new data</h5>
        </td>
    </tr>
@endif
