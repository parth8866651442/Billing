<table class="table">
    <thead>
        <tr>
            <th>
                <h6>Module Name</h6>
            </th>
            <th>
                <h6>Panel Name</h6>
            </th>
            <th>
                <h6>URL</h6>
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
            <td><p>{{ucfirst($item->name)}}</p></td>
            <td><p>{{ucfirst($item->panelDetail->name)}}</p></td>
            <td><p>{{$item->url}}</p></td>
            <td>
                <a href="{{route('editModuleMaster',['id'=>$item->id])}}" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a>
                <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger me-2" onclick="remove_row(this)" data-id="{{ $item->id }}"><i class="far fa-trash-alt me-1"></i>Delete</a>
            </td>
        </tr>
        @empty
            <tr class="text-center">
                <td colspan="4">No data available</td>
            </tr>
        @endforelse
        <!-- end table row -->
    </tbody>
</table>
<!-- end table -->
{{ $items->links() }}