<table class="table">
    <thead>
        <tr>
            <th>
                <h6>User Type</h6>
            </th>
            <th>
                <h6>Name</h6>
            </th>
            <th>
                <h6>Email</h6>
            </th>
            <th>
                <h6>Phone No</h6>
            </th>
            <!-- <th>
                <h6>Status</h6>
            </th> -->
            <th>
                <h6>Action</h6>
            </th>
        </tr>
        <!-- end table row-->
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr>
            <td><p>{{ucfirst($item->role)}}</p></td>
            <td><p>{{ucfirst($item->name)}}</p></td>
            <td><p>{{$item->email}}</p></td>
            <td><p>{{$item->phone_no}}</p></td>
            <!-- <td>
                @if($item->is_active == 1)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Deactive</span>
                @endif
            </td> -->
            <td>
                <div class="action">
                    <a href="{{route('editUser',['id'=>$item->id])}}"><button class="text-info"><i class="lni lni-pencil-alt"></i></button></a>
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