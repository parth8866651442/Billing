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
                <h6>Amount</h6>
            </th>
            <th>
                <h6>Order Date</h6>
            </th>
            <th>
                <h6>Status</h6>
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
            <td><a class="invoice-link">#{{$item->invoice_no}}</a></td>
            <td><p>{{ucfirst($item->fullname).'('.ucfirst($item->clientDetail->name).')'}}</p></td>
            <td><p class="text-primary">&#8377; {{number_format($item->total,2)}}</p></td>
            <td><p>{{date('d/m/Y', strtotime($item->date))}}</p></td>
            <td>
                <!-- primary,warning,danger,success -->
                <span class="badge @if($item->status == 'completed') bg-success-light @elseif($item->status == 'draft') bg-warning-light @elseif($item->status == 'processing') bg-primary-light @elseif($item->status == 'cancelled') bg-danger-light @endif">{{ucfirst($item->status)}}</span>
            </td>
            <td>
                @if($item->status == 'completed')
                <button class="btn btn-sm btn-white text-info me-2" disabled><i class="fas fa-credit-card me-1"></i>Receive Payment</button>
                @else
                <a href="javascript:void(0);" class="btn btn-sm btn-white text-info me-2" data-bs-toggle="modal" data-bs-target="#receive-payment-modal" onclick="receivePaymentModalRow({{$item->id}})"><i class="fas fa-credit-card me-1"></i>Receive Payment</a>
                @endif

                <a href="{{route('invoice',['id'=>$item->id])}}" class="btn btn-sm btn-white text-primary me-2"><i class="fas fa-print me-1"></i> Print</a>
                @if(Helper::check_user_assess('edit',ORDER_MODULE))
                <a href="@if($item->clientDetail->is_deleted)javascript:void(0);@else{{route('editOrder',['id'=>$item->id])}}@endif" class="btn btn-sm btn-white text-success me-2 {{$item->clientDetail->is_deleted ? 'disabled' : ''}}"><i class="far fa-edit me-1"></i> Edit</a>
                @endif
                
                @if(Helper::check_user_assess('delete',ORDER_MODULE))
                <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2 {{$item->clientDetail->is_deleted ? 'disabled' : ''}}" data-id="{{ $item->id }}" @if(!($item->clientDetail->is_deleted)) onclick="remove_row(this)" @endif><i class="far fa-trash-alt me-1"></i>Delete</a>
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