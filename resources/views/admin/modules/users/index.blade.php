@extends('admin.layouts.layout')
@section('title', 'Quản lý người dùng')
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
                            <h3 class="card-label">Danh sách người dùng</h3>

                        </div>
                        <div class="card-content m-5">
                            <form action="{{ route('admin.users.search')}}" method="get">
                                <div class="row">
                                    <div class="col">
                                        <input value="{{ request()->input('search_name') }}" type="text"
                                            class="form-control" name="search_name" placeholder="Name" />
                                        <div class="col"><input value="{{ request()->input('phone_number') }}"
                                                type="text" class="form-control" name="phone_number"
                                                placeholder="Số điện thoại" /></div>
                                        <div class="col"><select name="search_status" class="form-control">
                                                <option value="">Chọn</option>
                                                @foreach(config('common.status') as $key => $value)
                                                <option value="{{ $key }}"> {{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-info font-weight-bolder font-size-sm mr-3">Tìm
                                            kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-toolbar">

                            <a href="{{ route('admin.users.create') }}"
                                class="btn btn-info font-weight-bolder font-size-sm mr-3">Thêm người dùng</a>
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
                                    <th scope="col">Họ và tên</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Tuổi</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Trạng thái</th>
                                    <th colspan="2">Hành động</th>
                                </tr>
                            </thead>
                            @php
                            $i = 1;
                            @endphp
                            @if($getUser->count())
                            @foreach ($getUser as $u )
                            <tbody>
                                <tr id="tr_{{$u->id}}" class="format-table">
                                    <td><input type="checkbox" class="checkbox" data-id="{{$u->id}}"></td>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $u->full_name }}</td>
                                    <td>{{ $u->phone_number }}</td>
                                    <td>{{ $u->old }}</td>
                                    <td>{{ $u->address }}</td>
                                    <td style="width: 10%;"><img style="width:80%"
                                            src="{{ asset('public/img/' . $u->image) }}" alt=""></td>
                                    <td>
                                        <button class="label label-inline label-light-primary submit-pending"
                                            data-id="{{ $u->id }}"
                                            data-status="{{ $u->status }}">{{ $u->status==1 ? 'Pending' : 'Rejected' }}</button>
                                    </td>
                                    <td class="action-button">
                                        <a href="{{ route('admin.users.edit',['id' => $u->id]) }}"
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
                                        <a href="">
                                            <button type="submit" data-id="{{ $u->id }}"
                                                class="btn btn-icon btn-light btn-hover-primary btn-sm btn-submit">
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

                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                        {{ $getUser->links() }}
                        <!--end::Example-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
                        url: "{{ route('admin.users.deleteAll') }}",
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

        $(".btn-submit").click(function (e) {
            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                $(this).parents("tr").remove();
                e.preventDefault()
                var id = $(this).data("id");
                $.ajax({
                    url: "users/destroy/" + id,
                    type: 'POST',
                    data: id,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (data) {

                    }
                });
            }
        });

        $(".submit-pending").on("click", function () {
            var currentStatus = $(this).attr("data-status") //lay status cu 
            var id = $(this).attr("data-id") // id status
            var status = 1
            if (currentStatus == 1) {
                status = 2;
            }
            var text = '';
            if (status == 1) {
                text = 'Pending'
            } else {
                text = 'Rejected'
            }
            $.ajax({
                url: "users/deActive/" + id,
                type: 'POST',
                data: {
                    'id': id,
                    'status': status
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response.success)
                }
            })
            $(this).text(text)
            $(this).attr("data-status", status)


        })
    })

</script>
@endsection
