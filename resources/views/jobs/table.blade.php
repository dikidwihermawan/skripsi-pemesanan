@if ($jobs->count() > 0)
    @foreach ($jobs as $item => $value)
        <tr style="font-size: 14px;">
            <td>{{ $item + 1 }}</td>
            <td class>{{ $value->user->name }}</td>
            <td class>{{ $value->translation->name }}</td>
            <td>{{ $value->pages == null ? 'Not Verified' : $value->pages }}</td>
            <td>
                {{ $value->total_price == null ? 'Not Verified' : 'Rp. ' . number_format($value->total_price) }}</td>
            </td>
            <td>
                {{ ucfirst($value->payment_id == null ? 'Unpaid' : 'Paid') }}</td>
            <td>
                @if ($value->status == 'in_progress' && $value->payment_id == null)
                    <button class="btn btn-sm btn-primary" onclick="view({{ $value->id }})"><i
                            class="fas fa-fw fa-eye"></i>&nbsp;View</button>
                @elseif($value->status == 'in_progress' && $value->payment_id != null)
                    <button class="btn btn-sm btn-primary" onclick="view_confirm({{ $value->id }})"><i
                            class="fas fa-fw fa-upload"></i>&nbsp;Upload Now</button>
                @else
                    <button class="btn btn-sm btn-primary" onclick="view({{ $value->id }})"><i
                            class="fas fa-fw fa-eye"></i>&nbsp;View</button>
                @endif
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
