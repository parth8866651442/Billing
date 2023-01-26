<table class="table">
    <thead>
        <tr>
            <th>
                <h6>Order No</h6>
            </th>
            <th>
                <h6>Due Amount</h6>
            </th>
            <th>
                <h6>Amount</h6>
            </th>
            <th>
                <h6>Total Amount</h6>
            </th>
            <th>
                <h6>Payment Type</h6>
            </th>
            <th>
                <h6>Payment Date</h6>
            </th>
        </tr>
        <!-- end table row-->
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr>
            <td><p class="invoice-link">#{{$item->orderDetail->invoice_no}}</p></td>
            <td>{{$item->due_amount}}</td>
            <td>{{$item->amount}}</td>
            <td>{{$item->orderDetail->total}}</td>
            <td><p>{{$item->payment_type}}</p></td>
            <td>{{$item->date}}</td>
        </tr>
        @empty
            <tr class="text-center">
                <td colspan="6">No data available</td>
            </tr>
        @endforelse
        <!-- end table row -->
    </tbody>
</table>
<!-- end table -->
{{ $items->links() }}