<table class="table">
    <thead>
        <tr>
            <th>
                <h6>Invoice No</h6>
            </th>
            <th>
                <h6>Full Name</h6>
            </th>
            <th>
                <h6>Invoice Type</h6>
            </th>
            <th>
                <h6>Order Date</h6>
            </th>
            <th>
                <h6>Action</h6>
            </th>
        </tr>
        <!-- end table row-->
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr>
            <td><p>{{$item->invoice_no}}</p></td>
            <td><p>{{ucfirst($item->fullname)}}</p></td>
            <td><p>{{ucfirst($item->type)}}</p></td>
            <td><p>{{date('d/m/Y', strtotime($item->date))}}</p></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-sm btn-white text-info me-2" data-bs-toggle="modal" data-bs-target="#receive-payment-modal" onclick="receivePaymentModalRow({{$item->id}})"><i class="fas fa-credit-card me-1"></i>Receive Payment</a>
                <a href="{{route('invoice',['id'=>$item->id])}}" class="btn btn-sm btn-white text-primary me-2"><i class="fas fa-print me-1"></i> Print</a>
                @if(Helper::check_user_assess('edit',ORDER_MODULE))
                <a href="{{route('editOrder',['id'=>$item->id])}}" class="btn btn-sm btn-white text-success me-2 {{$item->clientDetail->is_deleted ? 'disabled' : ''}}"><i class="far fa-edit me-1"></i> Edit</a>
                @endif
                
                @if(Helper::check_user_assess('delete',ORDER_MODULE))
                <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2 {{$item->clientDetail->is_deleted ? 'disabled' : ''}}" onclick="remove_row(this)" data-id="{{ $item->id }}"><i class="far fa-trash-alt me-1"></i>Delete</a>
                @endif
            </td>
        </tr>
        @empty
            <tr class="text-center">
                <td colspan="5">No data available</td>
            </tr>
        @endforelse
        <!-- end table row -->
    </tbody>
</table>
<!-- end table -->
{{ $items->links() }}