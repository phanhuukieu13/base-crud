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
                    <form action="{{route('admin.pros.update', ['id'=>$products->id])}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" id="id" value="{{ $products->id}}">
                                        <label>Tên danh mục</label>
                                        <select  name="category_id" id="category_id" class="form-control">
                                            <option>Chọn </option>
                                            @foreach ($nameCate as $item)
                                            <option @if ($products->category_id == $item->id)
                                                {{'selected'}}
                                                @endif value="{{$item->id}}">{{$item->category_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class="error-message text-danger" id="err-category_id"></p>

                                    </div>
                                    <div class="col-md-6">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="name" id='name' value="{{ $products->name }}" placeholder="Nhập tên sản phẩm"
                                            class="form-control">
                                        <p class="error-message text-danger" id="err-name"></p>

                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Màu sắc</label>
                                        <input type="text" name="color" id='color' value="{{ $products->color }}" placeholder="Nhập tên sản phẩm"
                                            class="form-control">
                                        <p class="error-message text-danger" id="err-color"></p>

                                    </div>
                                    <div class="col-md-6">
                                        <label>Size</label>
                                        <input type="text" name="size" id="size" value="{{ $products->size }}" placeholder="Nhập size sản phẩm"
                                        class="form-control">
                                        <p class="error-message text-danger" id="err-size"></p>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Số lượng</label>
                                        <input type="text" name="amount" id='amount'  value="{{ $products->amount }}" placeholder="Nhập số lượng" class="form-control">
                                        <p class="error-message text-danger" id="err-amount"></p>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <label>Giá sản phẩm</label>
                                        <input type="text" name="price" id='price'  value="{{ $products->price }}" placeholder="Nhập giá sản phẩm" class="form-control">
                                        <p class="error-message text-danger" id="err-price"></p>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Mô tả</label>
                                        <input type="text" name="detail" id='detail' value="{{ $products->detail }}" placeholder="Nhập mô tả sản phẩm" class="form-control">
                                        <p class="error-message text-danger" id="err-detail"></p>
                                        
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ml-4 btn-submit">Submit</button>
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
    $(document).ready(function() {
            $(".btn-submit").click(function(e){
            e.preventDefault();

            var data ={
                id : $("#id").val(),
               category_id: $("#category_id").val(),
               name: $("#name").val(),
               color: $("#color").val(),
               size: $("#size").val(),
               amount: $("#amount").val(),
               price: $("#price").val(),
               detail: $("#detail").val(),
            } 
            $.ajax({
                url: "{{ route('admin.pros.update') }}",
                type:'POST',
                data:data,
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                console.log(response.success)
                if (response.success == 1) {
                    window.location.reload();
                } else {
                    if (response.error) {
                        $.each(response.error, function (key, value) {
                            var idElement = '#err-' + key
                            $(idElement).html(value)
                        });
                    }
                }
            }
            });
        }); 
    });
</script>
@endsection
