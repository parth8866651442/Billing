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
                    <li class="breadcrumb-item">
                        <a href="#">Panel Masters</a>
                    </li>
                    <li class="breadcrumb-item active">Add Panel Master</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('panelMasterList')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Panel Master</h4>
                    <form method="POST"
                        action="{{(isset($item)) ? route('updatePanelMaster',['id'=>$item->id]) : route('storePanelMaster')}}" id="panelMastersForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="@isset($item->name){{$item->name}}@endisset" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Icon<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="icon" id="icon" placeholder="icon" value="@isset($item->icon){{$item->icon}}@endisset" />
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary"> {{isset($item) ? 'Update' : 'Add'}} Panel Master </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- <script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script> -->
<script>
$(document).ready(function() {
    var addPanelMastersForm = $("#panelMastersForm");
    var validator = addPanelMastersForm.validate({
        rules: {
            name: {
                required: true,
                remote: {
                    url: "{{route('checkMenuNameRepeat')}}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        action: '{{isset($item->id) ? "edit" :"add"}}',
                        id: '{{isset($item->id) ? $item->id :""}}'
                    }
                }
            }
        },
        messages: {
            name: {
                required: "This field is required",
                remote: "Name already taken"
            }
        }
    });
});
</script>
@endpush