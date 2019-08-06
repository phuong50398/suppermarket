@extends('layouts/admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('custom/admin/jquery.datetimepicker.css')}}"/>
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Thêm khuyến mãi</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Khuyến mãi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thêm khuyến mãi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row p-r-50 p-l-50">
            <form action="{{(isset($action)) ? route('sale.update', $billImport->id) : route('sale.store')}}" method="POST" class=" w-100">
            @csrf
            {{(isset($action)) ? method_field('PUT') : ""}}
                 <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Tên chương trình (*)</label>
                            <input required type="text" class="form-control" name="name" value="{{(isset($action)) ? old('name', $product->name) : ""}}">
                        </div>
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Mã chương trình (*)</label>
                            <input required type="text" class="form-control" name="code">
                        </div>
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Phương thức khuyến mãi (*)</label>
                            <select name="type" id="" class="form-control method_sale">
                                <option value="">------Chọn phương thức khuyến mãi------</option>
                                <option value="1">Chiết khấu theo tổng giá trị đơn hàng</option>
                                <option value="2">Chiết khấu theo từng sản phẩm</option>
                                <option value="3">Chiết khấu theo từng loại sản phẩm</option>
                                <option value="4">Chiết khấu theo nhà sản xuất</option>
                                <option value="5">Chiết khấu theo nhà cung cấp</option>
                                <option value="6">Chiết khấu theo số lượng mua</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 p-l-50">
                        <div class="form-group">
                            <label for="fname" class="control-label col-form-label">Số lượng áp dụng (*)</label>
                            <div class="row">
                                <div class="col-md-7">
                                    <input type="number" class="form-control" name="amount_applied">
                                </div>
                                <div class="col-md-5">
                                    <div class="custom-control custom-checkbox m-t-5">
                                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing1" name="unlimit" value="1" {{(isset($action) && old('active', $categoryType->active)==1) ? "checked" : ""}}>
                                        <label class="custom-control-label" for="customControlAutosizing1">Không giới hạn</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Từ ngày (*)</label>
                            <input required type="text" class="form-control datetime" name="start_time" >
                        </div>
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Đến ngày (*)</label>
                            <input required type="text" class="form-control datetime" name="end_time" >
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row selectsp m-b-10">
                    </div>
                    <table class="table table-bordered" id="tblRender">
                        {{-- <thead>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                        </thead> --}}

                    </table>
                </div>
                <div class="col-md-12 text-center m-t-20">
                    <button type="submit" class="btn btn-success"><i class=" fas fa-save" aria-hidden="true"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{url('custom/admin/jquery.datetimepicker.js')}}"></script>
<script src="{{url('custom/admin/sale.js')}}"></script>
<script>
    $('.datetime').datetimepicker({
        ownerDocument: document,
        contentWindow: window,
        format: 'd/m/Y H:i',
        formatTime: 'H:i',
        formatDate: 'd/m/Y',
    });
</script>
<style>
    .select2-container--default .select2-selection--multiple, .select2-container--default .select2-selection--single {
        line-height: 1.5;
        height: 35px;
    }
    .lblsp{
        min-width: 115px;
        margin: auto;
    }
    .btn-outline-danger{
        padding: 4px;
        padding-bottom: 0px;
    }
</style>
@endsection
