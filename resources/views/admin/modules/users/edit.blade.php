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
                    <form action="{{ Route('admin.users.update',['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Họ và tên</label>
                                        <input type="text" name="full_name" value="{{ $user->full_name }}" placeholder="Nhập họ và tên" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Số điện thoại</label>
                                        <input type="text" name="phone_number" value="{{ $user->phone_number }}" placeholder="Nhập số điện thoại" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tuổi</label>
                                        <input type="text" name="old" value="{{ $user->old }}" placeholder="Nhập tuổi" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="address" value="{{ $user->address }}" placeholder="Nhập địa chỉ" class="form-control">
                                    </div>
                                </div>
                            </div><div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Ảnh</label>
                                        <input type="file" name="image" value="{{ $user->image }}"  class="form-control">
                                        <br>
                                        <img style="width:80%" src="{{ asset('images/' . $user->image) }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ml-4">Submit</button>
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
    </script>
@endsection
