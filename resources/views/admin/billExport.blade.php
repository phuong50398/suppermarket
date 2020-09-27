@extends('layouts/admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('custom/admin/assets/extra-libs/multicheck/multicheck.css')}}">
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Danh sách đơn chuyển hàng</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách đơn chuyển hàng</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row p-r-50 p-l-50">
            <div class="col-md-12 text-right p-b-10">
                <a href="billExport/create"><button class="btn btn-primary">Thêm đơn chuyển hàng</button></button></a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <label class="customcheckbox m-b-20">
                                    <input type="checkbox" id="mainCheckbox" />
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <th scope="col">Ngày chuyển</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số sản phẩm</th>
                            <th scope="col">Chi phí</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col" style="width: 17%">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                        @foreach ($listBillExport as $item)
                            <tr>
                                <th>
                                    <label class="customcheckbox">
                                        <input type="checkbox" class="listCheckbox" />
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <td>{{date('d/m/Y', strtotime($item->date_of_export))}}</td>
                                <td>{!! ($item->status == 1) ? "<label class='badge badge-success'>Đã chuyển hàng</label>" : "<label class='badge badge-secondary'>Đang chuyển hàng</label>" !!}</td>
                                <td>{{$item->bill_detail_count}}</td>
                                <td>{{number_format($item->cost)}}</td>
                                <td>{{number_format($item->payments)}}</td>
                                <td>
                                    @if ($item->status==1)
                                        <a href="{{url('admin/billExport/'.$item->id.'/edit')}}"><button class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Xem</button></a>
                                    @else
                                        <form action="{{route('billExport.update', $item->id)}}" method="POST" style="display: contents;">
                                            @method('PUT')
                                            @csrf
                                            <button name="status" value="chuyenhang" type="submit" class="btn btn-success btn-sm">Đã chuyển</button>
                                        </form>
                                        <a href="{{url('admin/billExport/'.$item->id.'/edit')}}"><button class="btn btn-warning btn-sm">Sửa</button></a>
                                        <form action="{{route('billExport.destroy', $item->id)}}" method="POST" style="display: contents;">
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
            <ul class="pagination" style="float: right">
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}"><span aria-hidden="true">«</span></span></a></li>
                    @for ($i = 1; $i <= $listBillExport->lastPage(); $i++)
                        <li class="{{($listBillExport->currentPage()==$i) ? 'active' : ''}} page-item"><a class="page-link" href="{{url()->current()}}?page={{$i}}" >{{$i}}</a></li>
                    @endfor
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}?page={{$listBillExport->lastPage()}}"><span aria-hidden="true">»</span></span></a></li>
            </ul>
        </div>
    </div>
</div>
{{-- <script src="{{url('custom/admin/product.js')}}"></script> --}}
<script src="{{url('custom/admin/assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>

<script src="{{url('custom/admin/assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
@endsection
