@extends('admin.layouts.layout')
@section('title', 'Thêm người dùng')
@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Thêm người dùng</h3>
                        </div>
                    </div>
                    @csrf
                    <div class="card-body">
                        <div class="col-xl-12 form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Họ Tên : </label>
                                    <input type="text" id="add_fullName" name="full_name" placeholder="Nhập họ và tên"
                                        class="form-control">
                                        <p class="error-message text-danger" id="err-full_name"></p>
                                </div>
                                <div class="col-md-6">
                                    <label>Số điện thoại</label>
                                    <input type="text" id="add_phoneNumber" name="phone_number"
                                        placeholder="Nhập số điện thoại" class="form-control">
                                    <p class="error-message text-danger" id="err-phone_number"></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tuổi</label>
                                    <input type="text" id="add_old" name="old" placeholder="Nhập Tuổi"
                                        class="form-control">
                                    <p class="error-message text-danger" id="err-old"></p>
                                </div>
                                <div class="col-md-6">
                                    <label>Địa chỉ</label>
                                    <input type="text" id="add_address" name="address" placeholder="Nhập địa chỉ"
                                        class="form-control">
                                    <p class="error-message text-danger" id="err-address"></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="text" id="add_email" name="email" placeholder="Nhập Email"
                                        class="form-control">
                                    <p class="error-message text-danger" id="err-email"></p>
                                </div>
                                <div class="col-md-6">
                                    <label>Passwpord</label>
                                    <input type="password" id="add_password" name="password" placeholder="Nhập mật khẩu"
                                        class="form-control">
                                    <p class="error-message text-danger" id="err-password"></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Ảnh</label>
                                    <input class="form-control" type="file" id="image" accept="image/png, image/jpeg">
                                    <img src="" id="profile-img-tag" width="200px" />
                                    <input multipart type="hidden" name='image' id="file_name">
                                    <p class="error-message text-danger" id="err-image"></p>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="submitAddUser()" class="btn btn-primary ml-4">Submit</button>
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
    $(document).ready(function () {
        $('.cancel').click(function () {
            const url = route('admin.users.index');
            window.location.href = url;
        })

    });

    function submitAddUser() {
        var data = {
            'full_name': $('#add_fullName').val(),
            'phone_number': $('#add_phoneNumber').val(),
            'old': $('#add_old').val(),
            'address': $('#add_address').val(),
            'email': $('#add_email').val(),
            'password': $('#add_password').val(),
            'image': $("#file_name").val(),
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.users.store') }}",
            dateType: 'json',
            data: data,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            success: function (response) {
                console.log(response.success)
                if (response.success == 1) {
                    window.location.href = "{{route('admin.users.index')}}";  //khi thêm thành công
                } else {
                    if (response.errors) {
                        $.each(response.errors, function (key, value) { // thêm sai in ra lỗi 
                            var idElement = '#err-' + key
                            $(idElement).html(value)
                        });
                    }
                }
            }

        })
    }

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
