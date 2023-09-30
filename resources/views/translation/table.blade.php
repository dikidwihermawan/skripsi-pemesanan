@if ($translation->count() > 0)
    @foreach ($translation as $item => $value)
        <tr style="font-size: 14px;">
            <td>{{ $item + 1 }}</td>
            <td class="w-25">{{ $value->name }}</td>
            <td>{{ ucfirst($value->description) }}</td>
            <td>Rp. {{ number_format($value->price) }}</td>
            <td>{{ ucfirst($value->type) }}</td>
            <td>{{ $value->process }} Work Days</td>
            @if (auth()->user()->role != 'client')
                <td>
                    <button type="button" onclick="edit({{ $value->id }})" class="btn btn-sm btn-primary"><i
                            class="fas fa-fw fa-edit"></i>&nbsp;Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="destroy({{ $value->id }})"><i
                            class="fas fa-fw fa-trash"></i>&nbsp;Delete</button>
                </td>
            @endif
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" align="center">
            <h5>No data here, please add new data</h5>
        </td>
    </tr>
@endif
