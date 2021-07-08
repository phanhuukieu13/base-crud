@extends('admin.layouts.layout')
@section('title', 'Thêm sản phẩm')
@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Thêm sản phẩm</h3>
                        </div>
                    </div>
                    <form action="{{route('admin.pros.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tên danh mục</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">Chọn</option>
                                            @foreach ($cateName as $item)
                                            <option value="{{$item->id}}">{{$item->category_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="name" placeholder="Nhập tên sản phẩm"
                                            class="form-control">
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Màu sắc</label>
                                        <input type="text" name="color" placeholder="Nhập tên sản phẩm"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Size</label>
                                        <input type="text" name="size" placeholder="Nhập size sản phẩm"
                                        class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Số lượng</label>
                                        <input type="text" name="amount" placeholder="Nhập số lượng" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Giá sản phẩm</label>
                                        <input type="text" name="price" placeholder="Nhập giá sản phẩm" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Mô tả</label>
                                        <input type="text" name="detail" placeholder="Nhập mô tả sản phẩm" class="form-control">
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
    $(document).ready(function () {
        $('.cancel').click(function () {
            const url = route('admin.users.index');
            window.location.href = url;
        })

    });

</script>
@endsection
