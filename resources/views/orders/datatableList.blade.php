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
            <td><p>{{$item->type}}</p></td>
            <td>
                <div class="action">
                    <a href="{{route('editOrder',['id'=>$item->id])}}"><button class="text-info"><i class="lni lni-pencil-alt"></i></button></a>
                    <button type="submit" class="text-danger" onclick="remove_row(this)" data-id="{{ $item->id }}"><i class="lni lni-trash-can"></i></button>
                </div>
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