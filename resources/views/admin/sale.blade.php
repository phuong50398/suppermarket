@extends('layouts/admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('custom/admin/assets/extra-libs/multicheck/multicheck.css')}}">
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Khuyến mãi</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Khuyến mãi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách khuyến mãi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row p-r-50 p-l-50">
            <div class="table-responsive">
                <table class="table table-bordered datatable fs-13">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center">STT</th>
                            <th scope="col" class="text-center">Mã chương trình</th>
                            <th scope="col" class="text-center">Tên chương trình</th>
                            <th scope="col" class="text-center">Phương thức khuyến mãi</th>
                            <th scope="col" class="text-center">Số lượng áp dụng</th>
                            <th scope="col" class="text-center">Trạng thái</th>
                            <th scope="col" class="text-center">Từ ngày</th>
                            <th scope="col" class="text-center">Đến ngày</th>
                            <th scope="col" class="text-center" style="width: 18%">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                        @foreach ($listsale as $k => $item)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->method}}</td>
                                <td class="text-center">{{$item->amount_applied}}</td>
                                <td class="text-center">{!! ($item->sale ==1) ? ((date(strtotime($item->end_time)) > time()) ? "<label class='badge badge-success'>đang áp dụng</label>" : "<label class='badge badge-secondary'>hết hạn</label>") : "<label class='badge badge-info'>chưa áp dụng</label>" !!}</td>
                                <td class="text-center">{{date('d/m/Y H:i',strtotime($item->start_time))}}</td>
                                <td class="text-center">{{date('d/m/Y H:i',strtotime($item->end_time))}}</td>
                                <td>
                                    @if ($item->sale != 1)
                                        <form action="{{route('sale.update', $item->id)}}" method="POST" style="display: contents;">
                                            @method('PUT')
                                            @csrf
                                            <button name="apdung" value="apdung" type="submit" class="btn btn-success btn-sm">Áp dụng</button>
                                        </form>
                                    @endif
                                    <a href="{{route('sale.edit', $item->id)}}"><button type="button" class="btn btn-warning btn-sm">Sửa/Xem</button></a>
                                    @if ($item->sale != 1)
                                        <form action="{{route('sale.destroy', $item->id)}}" method="POST" style="display: contents;">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Xóa</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 p-r-60 p-t-20">
            {{-- <ul class="pagination" style="float: right">
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}"><span aria-hidden="true">«</span></span></a></li>
                    @for ($i = 1; $i <= $warehouse->lastPage(); $i++)
                        <li class="{{($warehouse->currentPage()==$i) ? 'active' : ''}} page-item"><a class="page-link" href="{{url()->current()}}?page={{$i}}" >{{$i}}</a></li>
                    @endfor
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}?page={{$warehouse->lastPage()}}"><span aria-hidden="true">»</span></span></a></li>
            </ul> --}}
        </div>
    </div>
</div>
@endsection
