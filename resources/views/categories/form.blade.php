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
                        <a href="#">Category</a>
                    </li>
                    <li class="breadcrumb-item active">Add Category</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('categoryList')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category</h4>
                    <form method="POST"
                        action="{{(isset($item)) ? route('updateCategory',['id'=>$item->id]) : route('storeCategory')}}" id="categoryForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="@isset($item->name){{$item->name}}@endisset" />
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary"> {{isset($item) ? 'Update' : 'Add'}} Category </button>
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
    var addCategoryForm = $("#categoryForm");
    var validator = addCategoryForm.validate({
        rules: {
            name: {
                required: true,
                remote: {
                    url: "{{route('checkCategoryNameRepeat')}}",
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