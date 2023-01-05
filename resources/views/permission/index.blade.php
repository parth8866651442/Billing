@extends('layouts.app')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <!-- <h3 class="page-title">Users</h3> -->
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Permissions</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('home')}}"><button class="btn btn-primary btn-sm" type="button"><i
                                class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Permissions</h5>
                </div>
                <div class="card-body">
                    @foreach (config('constants.userType') as $i => $uType)
                    <div class="faq-tab{{$i == 1 ? ' mt-2' : ''}}">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="{{$uType['value']}}">
                                <p class="panel-title">
                                    <a class="{{$i == 0 ? '' : 'collapsed'}}" data-bs-toggle="collapse" data-bs-parent="#accordion" href="#{{$uType['value'].'_'.$i}}" aria-expanded="false" aria-controls="{{$uType['value'].'_'.$i}}">
                                        <i class="fas fa-plus-circle me-1"></i>
                                        {{$uType['label']}}
                                    </a>
                                </p>
                            </div>
                            <div id="{{$uType['value'].'_'.$i}}" class="panel-collapse collapse {{$i == 0 ? 'show' : ''}}" role="tabpanel" aria-labelledby="{{$uType['value']}}" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <form id="permissionsForm" class="permissions_form">
                                        <input type="hidden" name="user_type" value="{{$uType['value']}}">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th width="200px">View</th>
                                                        <th width="200px">Edit</th>
                                                        <th width="200px">Add</th>
                                                        <th width="200px">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($panelData as $panel)
                                                    <tr>
                                                        <td colspan="5">{{$panel->name}}</td>
                                                    </tr>
                                                    @if($panel->sup_page)
                                                    @foreach($panel->sup_page as $module)
                                                    @php  $select_module = isset($permissionsData[$uType['value']]) ? json_decode(json_encode($permissionsData[$uType['value']]), TRUE) : '' @endphp
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="module[{{$module->id}}][panel_id]" value="{{$module->panel_id}}">
                                                            <input type="hidden" name="module[{{$module->id}}][module_id]" value="{{$module->id}}">
                                                            <span class="ps-4">{{$module->name}}</span>
                                                        </td>
                                                        <td>
                                                            <div class="status-toggle">
                                                                <input type="checkbox" id="view_{{$uType['value'].'_'.$module->id}}" class="check" name="module[{{$module->id}}][view]" value="1" {{checkOrNo((my_array_search($select_module,'module_id',$module->id)),'view')}}>
                                                                <label for="view_{{$uType['value'].'_'.$module->id}}" class="checktoggle checkbox-bg ms-0">checkbox</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="status-toggle">
                                                                <input id="edit_{{$uType['value'].'_'.$module->id}}" class="check" type="checkbox" name="module[{{$module->id}}][edit]" value="1" {{checkOrNo((my_array_search($select_module,'module_id',$module->id)),'edit')}}>
                                                                <label for="edit_{{$uType['value'].'_'.$module->id}}" class="checktoggle checkbox-bg ms-0">checkbox</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="status-toggle">
                                                                <input id="add_{{$uType['value'].'_'.$module->id}}" class="check" type="checkbox" name="module[{{$module->id}}][add]" value="1" {{checkOrNo((my_array_search($select_module,'module_id',$module->id)),'add')}}>
                                                                <label for="add_{{$uType['value'].'_'.$module->id}}" class="checktoggle checkbox-bg ms-0">checkbox</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="status-toggle">
                                                                <input id="delete_{{$uType['value'].'_'.$module->id}}" class="check" type="checkbox" name="module[{{$module->id}}][delete]" value="1" {{checkOrNo((my_array_search($select_module,'module_id',$module->id)),'delete')}}>
                                                                <label for="delete_{{$uType['value'].'_'.$module->id}}" class="checktoggle checkbox-bg ms-0">checkbox</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-start mt-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(".permissions_form").submit(function(stay){
   var formdata = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: "{{ route('saveAssignModule') }}",
        data: formdata,
        success: function (res) {
            if (res.status) {
                toastr.success(res.message);
            } else {
                toastr.error(res.message);
            }
        },
    });
    stay.preventDefault(); 
});
</script>
@endpush