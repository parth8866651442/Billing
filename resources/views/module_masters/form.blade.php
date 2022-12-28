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
                        <a href="#">Module Masters</a>
                    </li>
                    <li class="breadcrumb-item active">Add Module Master</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('moduleMasterList')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Module Master</h4>
                    <form method="POST"
                        action="{{(isset($item)) ? route('updateModuleMaster',['id'=>$item->id]) : route('storeModuleMaster')}}" id="moduleMastersForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Panel<span class="asterisk">*</span></label>
                                    <select class="select select2" name="panel_id" id="panel_id">
                                        <option value="">Select Panel</option>
                                        @foreach($panels as $panel)
                                            <option value="{{$panel->id}}" {{isset($item->panel_id) && $item->panel_id === $panel->id? 'selected' :'' }}> {{$panel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="@isset($item->name){{$item->name}}@endisset" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>URL<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="url" id="url" placeholder="url" value="@isset($item->url){{$item->url}}@endisset" />
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">Add Module Master</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var addModuleMastersForm = $("#moduleMastersForm");
    var validator = addModuleMastersForm.validate({
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-control').removeClass('has-success').addClass('has-error');     
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-control').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2') && element.next('.select2-container').length) {
                error.insertAfter(element.next('.select2-container'));
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            panel_id: {
                required: true
            },
            name: {
                required: true,
                remote: {
                    url: "{{route('checkSubMenuNameRepeat')}}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        action: '{{isset($item->id) ? "edit" :"add"}}',
                        id: '{{isset($item->id) ? $item->id :""}}'
                    }
                }
            },
            url: {
                required: true
            }
        },
        messages: {
            panel_id: {
                required: "This field is required",
            },
            name: {
                required: "This field is required",
                remote: "Name already taken"
            },
            url: {
                required: "This field is required",
            }
        }
    });
});
</script>
@endpush