@extends('admin.layouts.layout')

@section('title', 'Thêm danh mục sản phẩm')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Thêm danh muc</h3>
                        </div>
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="col-xl-12 form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="category_name" id="category_name"
                                            placeholder="Nhập danh mục" class="form-control">
                                        <p class="error-message text-danger" id="err-category_name"></p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ml-4 btn-submit">Submit</button>
                            <button type="button" class="btn btn-secondary ml-2 cancel">Cancel</button>
                        </div>
                        @if (session('status'))
                        <div class="alert alert-info">{{session('status')}}</div>
                        @endif
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
    $(document).ready(function () {
        $(".btn-submit").click(function (e) {
            e.preventDefault();

            var category_name = $("#category_name").val();

            $.ajax({
                url: "{{ route('admin.cates.store') }}",
                type: 'POST',
                data: {
                    category_name: category_name
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response.success)
                    if (response.success == 1) {
                        window.location.href = "{{route('admin.cates.index')}}";
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
