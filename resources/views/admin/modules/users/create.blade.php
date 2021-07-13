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
                    <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Họ Tên : </label>
                                        <input type="text" id="full_name"  name="full_name" placeholder="Nhập họ và tên" class="form-control">
                                        <p class="error-message" id="err-full_name"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Số điện thoại</label>
                                        <input type="text" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại" class="form-control">
                                        <p class="error-message" id="err-phone_number"></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tuổi</label>
                                        <input type="text" id="old" name="old" placeholder="Nhập Tuổi" class="form-control">
                                        <p class="error-message" id="err-old"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Địa chỉ</label>
                                        <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" class="form-control">
                                        <p class="error-message" id="err-address"></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="text" id="email" name="email" placeholder="Nhập Email" class="form-control">
                                        <p class="error-message" id="err-email"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Passwpord</label>
                                        <input type="password" id = "password" name="password" placeholder="Nhập mật khẩu" class="form-control">
                                        <p class="error-message" id="err-password"></p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <label>Ảnh</label>
                                        <input type="file" id ="image" name="image"  class="form-control">
                                        <p class="error-message" id="err-image"></p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"   onclick="submitAddUser()" class="btn btn-primary ml-4">Submit</button>
                            <button type="button" class="btn btn-secondary ml-2 cancel">Cancel</button>
                        </div>
                            
                    </form>
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
        function submitAddUser(){
            var data = {
                'full_name': $('full_name').val(),
                'phone_number': $('phone_number').val(),
                'old': $('old').val(),
                'address': $('address').val(),
                'email': $('email').val(),
                'password': $('password').val(),
                'image': $('image').val(),
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
                    window.location.href = "{{route('admin.users.index')}}";
                } else {
                    if (response.error) {
                        $.each(response.error, function (key, value) {
                            var idElement = '#err-' + key
                            $(idElement).html(value)
                        });
                    }
                }
            }

        })
        }
    </script>
@endsection