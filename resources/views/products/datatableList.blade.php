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
                <div class="action">
                    <a href="{{route('editProduct',['id'=>$item->id])}}"><button class="text-info"><i class="lni lni-pencil-alt"></i></button></a>
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