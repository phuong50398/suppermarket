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
            <form action="{{(isset($action)) ? route('sale.update', $sale->id) : route('sale.store')}}" method="POST" class=" w-100">
            @csrf
            {{(isset($action)) ? method_field('PUT') : ""}}
                 <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Tên chương trình (*)</label>
                            <input required type="text" class="form-control" name="name" value="{{(isset($action)) ? old('name', $sale->name) : ""}}">
                        </div>
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Mã chương trình (*)</label>
                            <input required type="text" class="form-control" name="code" value="{{(isset($action)) ? old('code', $sale->code) : ""}}">
                        </div>
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Phương thức khuyến mãi (*)</label>
                            <select name="type" id="" class="form-control method_sale">
                                <option value="">------Chọn phương thức khuyến mãi------</option>
                                <option value="2" {{(isset($action) && old('type', $sale->type) == 2) ? "selected" : ""}}>Chiết khấu theo từng sản phẩm</option>
                                <option value="4" {{(isset($action) && old('type', $sale->type) == 4) ? "selected" : ""}}>Chiết khấu theo nhà sản xuất</option>
                                <option value="5" {{(isset($action) && old('type', $sale->type) == 5) ? "selected" : ""}}>Chiết khấu theo nhà cung cấp</option>
                              
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 p-l-50">
                        <div class="form-group">
                            <label for="fname" class="control-label col-form-label">Số lượng áp dụng (*)</label>
                            <div class="row">
                                <div class="col-md-7">
                                    <input type="number" class="form-control" name="amount_applied" value="{{(isset($action) && $sale->amount_applied !="unlimit") ? old('amount_applied', $sale->amount_applied) : ''}}">
                                </div>
                                <div class="col-md-5">
                                    <div class="custom-control custom-checkbox m-t-5">
                                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing1" name="unlimit" value="1" {{(isset($action) && $sale->amount_applied =="unlimit") ? "checked" : ""}}>
                                        <label class="custom-control-label" for="customControlAutosizing1">Không giới hạn</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Từ ngày (*)</label>
                            <input required type="text" class="form-control datetime" name="start_time"  value="{{(isset($action)) ? old('start_time', $sale->start_time) : ""}}">
                        </div>
                        <div class="form-group">
                            <label for="fname" class=" control-label col-form-label">Đến ngày (*)</label>
                            <input required type="text" class="form-control datetime" name="end_time"  value="{{(isset($action)) ? old('end_time', $sale->end_time) : ""}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row selectsp m-b-10">
                        @if (isset($action) && ($sale->type == 2))
                            <div class="col-sm-10 flex">
                                <label class="lblsp">Chọn sản phẩm</label>
                                <select name="" id="selectsp" class="form-control select2" {{($sale->sale_all == 'all') ? 'disabled="disabled"' : ''}}>
                                <option value="" data-name="">----- Chọn sản phẩm -----</option>
                                    @foreach ($dssp as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 custom-control custom-checkbox m-t-5">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1" {{($sale->sale_all == 'all') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>
                            </div>
                        @endif
                        @if (isset($action) && ($sale->type == 3))
                            <div class="col-sm-10 flex">
                                <label class="lblsp">Chọn loại danh mục</label>
                                <select name="" id="selectsp" class="form-control select2" {{($sale->sale_all == 'all') ? 'disabled="disabled"' : ''}}>
                                    <option value="" >----- Chọn loại danh mục -----</option>
                                    @foreach ($categoryType as $c)
                                        <optgroup  label="{{$c->name}}">
                                            @foreach ($c->categoryType as $ct)
                                                <option value="{{$ct->id}}">{{$ct->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 custom-control custom-checkbox m-t-5">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1"  {{($sale->sale_all == 'all') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>
                            </div>
                        @endif
                        @if (isset($action) && ($sale->type == 4))
                            <div class="col-sm-10 flex">
                                <label class="lblsp">Chọn nhà sản xuất</label>
                                <select name="" id="selectsp" class="form-control select2">
                                <option value="" >----- Chọn nhà sản xuất -----</option>
                                @foreach ($producer as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 custom-control custom-checkbox m-t-5">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1"  {{($sale->sale_all == 'all') ? 'checked' : ''}} >
                                <label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>
                            </div>
                        @endif
                        @if (isset($action) && ($sale->type == 5))
                            <div class="col-sm-10 flex">
                                <label class="lblsp">Chọn nhà cung cấp</label>
                                <select name="" id="selectsp" class="form-control select2">
                                <option value="" >----- Chọn nhà cung cấp -----</option>
                                @foreach ($provider as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 custom-control custom-checkbox m-t-5">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1"  {{($sale->sale_all == 'all') ? 'checked' : ''}} >
                                <label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>
                            </div>
                        @endif
                        @if (isset($action) && ($sale->type == 6))
                            <div class="col-sm-10 flex">
                                <label class="lblsp">Chọn sản phẩm</label>
                                <select name="" id="selectsp" class="form-control select2" {{($sale->sale_all == 'all') ? 'disabled="disabled"' : ''}}>
                                <option value="" data-name="">----- Chọn sản phẩm -----</option>
                                    @foreach ($dssp as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 custom-control custom-checkbox m-t-5">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1" {{($sale->sale_all == 'all') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>
                            </div>
                        @endif
                    </div>
                    <table class="table table-bordered" id="tblRender">
                        @if (isset($action) && ($sale->type == 1))
                            <thead>
                               <th>Giá từ</th><th>Đến</th><th>Chiết khấu</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="price_form" class="form-control" value="{{$sale->price_form}}"></td>
                                    <td><input type="text" name="price_to"  class="form-control" value="{{$sale->price_to}}"></td>
                                    <td class = "flex">
                                        <input type="text" name="discount"  class="form-control" value="{{$sale->discount}}">
                                        <button class="btn switch {{($sale->unit == 'percent') ? 'btn-warning' : ''}}" type="button" name="percent" value="percent">%</button>
                                        <button class="btn switch {{($sale->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                        <input type="hidden" name="unit" class="form-control unit" value="{{$sale->unit}}">
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                        @if (isset($action) && ($sale->type == 2))
                            <thead>
                               <th>Mã</th><th>Tên sản phẩm</th><th>Chiết khấu</th>
                            </thead>
                            <tbody>
                                @if ($sale->sale_all == 'all')
                                    <tr>
                                        <td></td>
                                        <td>Tất cả</td>
                                        <td class = "flex">
                                            <input type="text" name="discount"  class="form-control" value="{{$sale->discount}}">
                                            <button class="btn switch {{($sale->unit == 'percent') ? 'btn-warning' : ''}}" type="button" name="percent" value="percent">%</button>
                                            <button class="btn switch {{($sale->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                            <input type="hidden" name="unit" class="form-control unit" value="{{$sale->unit}}">
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($sale->saleProduct as $item)
                                        <tr>
                                            <td><input type="hidden" name="product[]" value="{{$item->product_id}}"  class="form-control"> <button type="button" class="btn btn-outline-danger btn-xs delete"><i class=" fas fa-trash-alt"></i></button></td>
                                            <td>{{$listtensp[$item->product_id]}}</td>
                                            <td class = "flex">
                                                <input type="text" name="discount[]"  class="form-control" value="{{$item->discount}}">
                                                <button class="btn  {{($item->unit == 'percent') ? 'btn-warning' : ''}} switch" type="button" name="percent" value="percent">%</button>
                                                <button class="btn switch  {{($item->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                                <input type="hidden" name="unit[]" class="form-control unit" value="{{$item->unit}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        @endif
                        @if (isset($action) && ($sale->type == 3))
                            <thead>
                                <th>Mã</th>
                                <th>Tên loại danh mục</th>
                                <th>Chiết khấu</th>
                            </thead>
                            <tbody>
                                @if ($sale->sale_all == 'all')
                                    <tr>
                                        <td></td>
                                        <td>Tất cả</td>
                                        <td class = "flex">
                                            <input type="text" name="discount"  class="form-control" value="{{$sale->discount}}">
                                            <button class="btn switch {{($sale->unit == 'percent') ? 'btn-warning' : ''}}" type="button" name="percent" value="percent">%</button>
                                            <button class="btn switch {{($sale->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                            <input type="hidden" name="unit" class="form-control unit" value="{{$sale->unit}}">
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($sale->saleProduct as $item)
                                        <tr>
                                            <td><input type="hidden" name="product[]" value="{{$item->category_type_id}}"  class="form-control"> <button type="button" class="btn btn-outline-danger btn-xs delete"><i class=" fas fa-trash-alt"></i></button></td>
                                            <td>{{$listCategoryType[$item->category_type_id]}}</td>
                                            <td class = "flex">
                                                <input type="text" name="discount[]"  class="form-control" value="{{$item->discount}}">
                                                <button class="btn  {{($item->unit == 'percent') ? 'btn-warning' : ''}} switch" type="button" name="percent" value="percent">%</button>
                                                <button class="btn switch  {{($item->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                                <input type="hidden" name="unit[]" class="form-control unit" value="{{$item->unit}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        @endif
                        @if (isset($action) && ($sale->type == 4))
                            <thead>
                                <th>Mã</th>
                                <th>Tên nhà sản xuất</th>
                                <th>Chiết khấu</th>
                            </thead>
                            <tbody>
                                @if ($sale->sale_all == 'all')
                                    <tr>
                                        <td></td>
                                        <td>Tất cả</td>
                                        <td class = "flex">
                                            <input type="text" name="discount"  class="form-control" value="{{$sale->discount}}">
                                            <button class="btn switch {{($sale->unit == 'percent') ? 'btn-warning' : ''}}" type="button" name="percent" value="percent">%</button>
                                            <button class="btn switch {{($sale->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                            <input type="hidden" name="unit" class="form-control unit" value="{{$sale->unit}}">
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($sale->saleProduct as $item)
                                        <tr>
                                            <td><input type="hidden" name="product[]" value="{{$item->producer_id}}"  class="form-control"> <button type="button" class="btn btn-outline-danger btn-xs delete"><i class=" fas fa-trash-alt"></i></button></td>
                                            <td>{{$listproducer[$item->producer_id]}}</td>
                                            <td class = "flex">
                                                <input type="text" name="discount[]"  class="form-control" value="{{$item->discount}}">
                                                <button class="btn  {{($item->unit == 'percent') ? 'btn-warning' : ''}} switch" type="button" name="percent" value="percent">%</button>
                                                <button class="btn switch  {{($item->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                                <input type="hidden" name="unit[]" class="form-control unit" value="{{$item->unit}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        @endif
                        @if (isset($action) && ($sale->type == 5))
                            <thead>
                                <th>Mã</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Chiết khấu</th>
                            </thead>
                            <tbody>
                                @if ($sale->sale_all == 'all')
                                    <tr>
                                        <td></td>
                                        <td>Tất cả</td>
                                        <td class = "flex">
                                            <input type="text" name="discount"  class="form-control" value="{{$sale->discount}}">
                                            <button class="btn switch {{($sale->unit == 'percent') ? 'btn-warning' : ''}}" type="button" name="percent" value="percent">%</button>
                                            <button class="btn switch {{($sale->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                            <input type="hidden" name="unit" class="form-control unit" value="{{$sale->unit}}">
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($sale->saleProduct as $item)
                                        <tr>
                                            <td><input type="hidden" name="product[]" value="{{$item->provider_id}}"  class="form-control"> <button type="button" class="btn btn-outline-danger btn-xs delete"><i class=" fas fa-trash-alt"></i></button></td>
                                            <td>{{$listprovider[$item->provider_id]}}</td>
                                            <td class = "flex">
                                                <input type="text" name="discount[]"  class="form-control" value="{{$item->discount}}">
                                                <button class="btn  {{($item->unit == 'percent') ? 'btn-warning' : ''}} switch" type="button" name="percent" value="percent">%</button>
                                                <button class="btn switch  {{($item->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                                <input type="hidden" name="unit[]" class="form-control unit" value="{{$item->unit}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        @endif
                        @if (isset($action) && ($sale->type == 6))
                            <thead>
                                <th>Mã</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng từ</th>
                                <th>Số lượng đến</th>
                                <th>Chiết khấu</th>
                            </thead>
                            <tbody>
                                @if ($sale->sale_all == 'all')
                                    <tr>
                                        <td></td>
                                        <td>Tất cả</td>
                                        <td><input type="text" name="amount_from" class="form-control" value="{{$sale->amount_from}}"></td>
                                        <td><input type="text" name="amount_to"  class="form-control" value="{{$sale->amount_to}}"></td>
                                        <td class = "flex">
                                            <input type="text" name="discount"  class="form-control" value="{{$sale->discount}}">
                                            <button class="btn switch {{($sale->unit == 'percent') ? 'btn-warning' : ''}}" type="button" name="percent" value="percent">%</button>
                                            <button class="btn switch {{($sale->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                            <input type="hidden" name="unit" class="form-control unit" value="{{$sale->unit}}">
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($sale->saleProduct as $item)
                                        <tr>
                                            <td><input type="hidden" name="product[]" value="{{$item->product_id}}"  class="form-control"> <button type="button" class="btn btn-outline-danger btn-xs delete"><i class=" fas fa-trash-alt"></i></button> {{$item->product_id}}</td>
                                            <td>{{$listtensp[$item->product_id]}}</td>
                                            <td><input type="text" name="amount_from[]" class="form-control" value="{{$item->amount_from}}"></td>
                                            <td><input type="text" name="amount_to[]"  class="form-control" value="{{$item->amount_to}}"></td>
                                            <td class = "flex">
                                                <input type="text" name="discount"  class="form-control" value="{{$item->discount}}">
                                                <button class="btn switch {{($item->unit == 'percent') ? 'btn-warning' : ''}}" type="button" name="percent" value="percent">%</button>
                                                <button class="btn switch {{($item->unit == 'dong') ? 'btn-warning' : ''}}" type="button"  name="dong" value="dong">₫</button>
                                                <input type="hidden" name="unit" class="form-control unit" value="{{$item->unit}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        @endif
                    </table>
                </div>
                <div class="col-md-12 text-right m-t-40">
                    <button type="submit" class="btn btn-info" name="sale" value="0" {{isset($action) && ($sale->sale ==1) ? 'disabled' : ''}} ><i class=" fas fa-save" aria-hidden="true"></i> Lưu</button>
                    <button type="submit" class="btn btn-success" name="sale" value="1" {{isset($action) && ($sale->sale ==1) ? 'disabled' : ''}} ><i class=" fas fa-check" aria-hidden="true"></i> Lưu và áp dụng</button>
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
        format: 'Y-m-d H:i',
        formatTime: 'H:i',
        formatDate: 'Y-m-d',
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
