@extends('admin.layouts.layout')
@section('title', 'Danh sách sản phẩm')
@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--end::Notice-->
        <div class="row">
            <div class="col-xl-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Danh sách sản phẩm</h3>
                            <form class="col lg-6" action="{{ route('admin.pros.search')}}" method="get">
                                <select name="search_category" class="form-control">
                                    <option value="">Chọn</option>
                                    @foreach ($viewCate as $item)
                                    <option value="{{$item->id}}">{{$item->category_name}}
                                    </option>
                                    @endforeach

                                </select>
                                <select name="search_status" class="form-control">
                                    <option value="">Chọn</option>
                                    @foreach(config('common.status') as $key => $value)
                                    <option value="{{ $key }}"> {{ $value }}</option>
                                    @endforeach
                                </select>
                                <input value="{{ request()->input('search_name') }}" type="text" class=""
                                    name="search_name" placeholder="Name" />
                                <button type="submit" class="btn btn-info font-weight-bolder font-size-sm mr-3">Tìm
                                    kiếm</button>
                            </form>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.pros.create') }}"
                                class="btn btn-info font-weight-bolder font-size-sm mr-3">Thêm sản phẩm</a>
                        </div>

                    </div>
                    <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete
                        All</button>
                    <div class="card-body">
                        <!--begin::Example-->
                        <table class="table">
                            <thead>
                                <tr class="format-table">
                                    <th><input type="checkbox" id="check_all"></th>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Màu sắc</th>
                                    <th scope="col">Size</th>
                                    <td scope="co1">Số lượng</td>
                                    <td scope="col">Giá</td>
                                    <td scope="col">Chi tiết</td>
                                    <th scope="col">Trạng thái</th>
                                    <th colspan="2">Hành động</th>
                                </tr>
                            </thead>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($products as $item)
                            <tbody>
                                <tr id="tr_{{$item->id}}" class="format-table">
                                    <td><input type="checkbox" class="checkbox" data-id="{{$item->id}}"></td>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->color }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->detail }}</td>
                                    @if($item->status == 1)
                                    <form action="{{ route('admin.pros.DeActive',['id' => $item->id]) }}" method="post">
                                        @csrf
                                        <td>
                                            <button class="label label-inline label-light-primary ">Pending</button>
                                        </td>
                                    </form>
                                    @elseif($item->status ==2)
                                    <form action="{{ route('admin.pros.active',['id' => $item->id]) }}" method="post">
                                        @csrf
                                        <td>
                                            <button
                                                class="label label-lg label-light-danger label-inline">Rejected</button>
                                        </td>
                                    </form>
                                    @endif
                                    <td class="action-button">
                                        <a href="{{ route('admin.pros.edit',['id'=>$item->id]) }}"
                                            class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                            d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                        </path>
                                                        <path
                                                            d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </a>
                                        <form action="{{ route('admin.pros.destroy',['id' => $item->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-icon btn-light btn-hover-primary btn-sm"
                                                onclick="confirm('Bạn có chắc chắn muốn xóa?')">
                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path
                                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                fill="#000000" fill-rule="nonzero"></path>
                                                            <path
                                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                fill="#000000" opacity="0.3"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                                </a>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        <div class="">
                            {{-- {{ $products->links() }} --}}
                        </div>

                        <!--end::Example-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#check_all').on('click', function (e) {
            if ($(this).is(':checked', true)) {
                $(".checkbox").prop('checked', true);
            } else {
                $(".checkbox").prop('checked', false);
            }
        });
        $('.checkbox').on('click', function () {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#check_all').prop('checked', true);
            } else {
                $('#check_all').prop('checked', false);
            }
        });
        $('.delete-all').on('click', function (e) {
            var idsArr = [];
            $(".checkbox:checked").each(function () {
                idsArr.push($(this).attr('data-id'));
            });

            if (idsArr.length <= 0) {
                alert("Please select atleast one record to delete.");
            } else {
                if (confirm("Ban chac chan muon xoa het tat ca ?")) {
                    var strIds = JSON.stringify(idsArr)
                    //  console.log(strIds)
                    //  console.log(JSON.parse(strIds))
                    $.ajax({
                        url: "{{ route('admin.pros.deleteAll') }}",
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            'id': strIds
                        },
                        success: function (data) {
                            if (data['status'] == true) {
                                $(".checkbox:checked").each(function () {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                }
            }
        });
        // $('[data-toggle=confirmation]').confirmation({
        //     rootSelector: '[data-toggle=confirmation]',
        //     onConfirm: function (event, element) {
        //         element.closest('form').submit();
        //     }
        // });   

    });

</script>
@endsection
