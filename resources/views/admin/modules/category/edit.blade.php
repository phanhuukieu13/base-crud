@extends('admin.layouts.layout')

@section('title', 'Sửa danh mục sản phẩm')

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
                    <form  enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" id="id_cate" value="{{ $cate->id }}">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="category_name" id="category_name" value="{{ $cate->category_name }}" placeholder="Nhập họ và tên" class="form-control">
                                        <p class="error-message text-danger" id="err-category_name"></p>
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
        $(document).ready(function(){

            $('.cancel').click(function(){
                const url = route('admin.cates.index');
                window.location.href = url;
            })
        });


        $(document).ready(function(){
            $(".btn-submit").click(function(e){
            e.preventDefault();
            var data = {
                'id_cate': $("#id_cate").val(),
                'category_name': $("#category_name").val(),
            }
            console.log(data);
            const routes = route('admin.cates.update')
            $.ajax({
            type: 'POST',
            url: routes,
            data: data,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log(response);
                if (response.mess == "Success") {
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

        })
        })
        
          
    })
    </script>
@endsection
