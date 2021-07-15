@extends('admin.layouts.layout')

@section('title', 'Sửa người dùng')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Sửa thông tin</h3>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Họ và tên</label>
                                        <input type="hidden" name="id" id="edit_id" value="{{ $user->id }}">
                                        <input type="text" name="full_name" id="edit_fullName" value="{{ $user->full_name }}" placeholder="Nhập họ và tên" class="form-control">
                                        <p class="error-message text-danger" id="err-full_name"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Số điện thoại</label>
                                        <input type="text" name="phone_number" id="edit_phoneNumber" value="{{ $user->phone_number }}" placeholder="Nhập số điện thoại" class="form-control">
                                        <p class="error-message text-danger" id="err-phone_number"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tuổi</label>
                                        <input type="text" name="old" id="edit_old" value="{{ $user->old }}" placeholder="Nhập tuổi" class="form-control">
                                        <p class="error-message text-danger" id="err-old"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="address" id="edit_address" value="{{ $user->address }}" placeholder="Nhập địa chỉ" class="form-control">
                                        <p class="error-message text-danger" id="err-address"></p>
                                    </div>
                                </div>
                            </div><div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Ảnh</label>
                                        <input class="form-control" type="file"  id="image" accept="image/png, image/jpeg">
                                        <br>
                                        <img src="" id="profile-img-tag" width="200px" />
                                        <img style="width:80%" src="{{ asset('public/img/' . $user->image) }}" alt="">
                                        <input multipart type="hidden" value="{{ $user->image }}" name='image' id="file_name">
                                        <p class="error-message text-danger" id="err-image"></p>
                                    </div>
                                </div>
                            </div>
                            <button type="button"  class="btn btn-primary ml-4 btn-submit ">Submit</button>
                            <button type="button" class="btn btn-secondary ml-2 cancel">Cancel</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
        $(document).ready(function(){

            $('.cancel').click(function(){
                const url = route('admin.users.index');
                window.location.href = url;
            })
        });
        $(document).ready(function () {
        $(".btn-submit").click(function (e) {
            e.preventDefault()
            var data = {
                'id' : $("#edit_id").val(),
                'full_name' : $("#edit_fullName").val(),
                'old': $("#edit_old").val(),
                'phone_number': $("#edit_phoneNumber").val(),
                'address': $("#edit_address").val(),
                'image': $("#file_name").val(),
            }
            $.ajax({
                url: "{{ route('admin.users.update') }}",
                type: 'POST',
                data: data,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response.success)
                    if (response.success == 1) {
                        window.location.href = "{{route('admin.users.index')}}";
                    } else {
                        if (response.errors) {
                            $.each(response.errors, function (key, value) {
                                var idElement = '#err-' + key
                                $(idElement).html(value)
                            });
                        }
                    }
                }
            });
            
        });
    });
        $('#image').on('change', function (e) {
        var files = e.target.files
        var dataUpload = files[0]
        var formData = new FormData();
        formData.append('image', dataUpload)
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.users.uploadFile') }}",
            dateType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.dir) {
                    $("#profile-img-tag").attr("src", response.dir);
                }
                if (response.file_name) {
                    $("#file_name").val(response.file_name);
                }
            }
        })
    });
</script>
@endsection
