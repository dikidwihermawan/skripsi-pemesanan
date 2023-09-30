@if ($order->count() > 0)
    @foreach ($order as $item => $value)
        <tr style="font-size: 14px;">
            <td>{{ $item + 1 }}</td>
            <td class="w-25">{{ $value->translation->name }}</td>
            <td>{{ ucfirst($value->status == "in_progress" ? 'In Progress' : $value->status) }}</td>
            <td>{{ $value->pages == null ? 'Not Verified' : $value->pages }}
            </td>
            <td>
                {{ $value->total_price == null ? 'Not Verified' : 'Rp. ' . number_format($value->total_price) }}</td>
            <td style="width: 145px;">
                @if ($value->status == 'pending')
                    <button class="btn btn-sm btn-danger" onclick="destroy({{ $value->id }})"><i
                            class="fas fa-fw fa-trash"></i> &nbsp; <small>Delete</small> </button>
                @elseif ($value->status == 'in_progress' && $value->payment_id == null)
                    <button class="btn btn-sm btn-primary" onclick="payment({{ $value->id }})"><i
                            class="fas fa-fw fa-credit-card"></i> &nbsp; <small>Payment</small> </button>
                @elseif ($value->status == 'in_progress' && $value->payment_id != null)
                    <button class="btn btn-sm btn-primary" onclick="view({{ $value->id }})"><i
                            class="fas fa-fw fa-eye"></i> &nbsp; <small>View</small> </button>
                @else
                    <button class="btn btn-sm btn-success" onclick="view({{ $value->id }})"><i
                            class="fas fa-fw fa-check"></i> &nbsp; <small>Complete</small> </button>
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
