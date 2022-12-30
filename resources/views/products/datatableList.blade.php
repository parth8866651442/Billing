<table class="table">
    <thead>
        <tr>
            <th>
                <h6>Category Name</h6>
            </th>
            <th>
                <h6>Name</h6>
            </th>
            <th>
                <h6>QTY</h6>
            </th>
            <th>
                <h6>Price</h6>
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
            <td><p>{{ucfirst($item->categoryDetail->name)}}</p></td>
            <td><p>{{ucfirst($item->name)}}</p></td>
            <td><p>{{$item->qty}}</p></td>
            <td><p>{{$item->price}}</p></td>
            <td>
                @if(Helper::check_user_assess('edit',PRODUCT_MODULE))
                <a href="{{route('editProduct',['id'=>$item->id])}}" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a>
                @endif
                
                @if(Helper::check_user_assess('delete',PRODUCT_MODULE))
                <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2" onclick="remove_row(this)" data-id="{{ $item->id }}"><i class="far fa-trash-alt me-1"></i>Delete</a>
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