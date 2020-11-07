@extends('layouts/admin')
@section('content')
<link href="{{url('custom/admin/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
<link href="{{url('custom/admin/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Đơn xuất hàng</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đơn xuất hàng</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row p-r-50 p-l-50">
            <form action="{{(isset($action)) ? route('billExport.update', $billExport->id) : route('billExport.store')}}" method="POST" class=" w-100">
                @csrf
                {{(isset($action)) ? method_field('PUT') : ""}}
                {{-- <div class="form-group">
                    <div class="row">
                        <label class=" control-label col-form-label p-l-10">Nhà cung cấp (*)</label>
                        <div class="col-md-11">
                            <select required name="provider" class="select2 form-control" style="width: 100%; height:auto;">
                                <option value="">----Chọn nhà cung cấp----</option>
                                @foreach ($provider as $item)
                                    <option {{(isset($action) && $billImport->provider_id == $item->id) ? "selected" : ""}} value="{{$item->id}}">{{$item->name}} - {{$item->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#Modal2"><i class="fas fa-plus"></i> Thêm mới</button>
                    </div>
                </div> --}}
                <div class="form-group">
                    <label class=" control-label col-form-label">Sản phẩm (*)</label>
                    <select multiple required name="product[]" class="form-control" style="width: 100%; height:auto;">
                        <option value="">----Chọn sản phẩm----</option>
                        @if (isset($action))
                            @foreach ($product as $item)
                                <option {{(in_array($item->id, $arrIdProduct)) ? "selected" : ""}} data-img = "{{$item->images}}" data-price = "{{number_format($item->price)}}" data-priceInt = "{{$item->price}}" value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        @else
                            @foreach ($product as $item)
                                <option data-img = "{{$item->images}}" data-price = "{{number_format($item->price)}}" data-priceInt = "{{$item->price}}" value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th style="width: 20%">Giá xuất</th>
                                <th style="width: 10%">Số lượng</th>
                                <th style="width: 20%">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="list_product">
                            @if (isset($action))
                                @foreach ($billExport->billDetail as $item)
                                    <tr>
                                        <td>{{$arrProduct[$item->product_id]}}</td>
                                        <td><input type="text" data-type="currency" name="price[]" class="form-control currency text-right" value="{{number_format($item->price_export)}}"></td>
                                        <td><input type="number" name="amount[]" class="form-control text-right"  value="{{$item->amount_export}}"></td>
                                        <td  class="total text-right">{{number_format($item->price_export*$item->amount_export)}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <p>Số lượng:</p>
                            <p>Tổng tiền sản phẩm:</p>
                            <p>Chi phí <small>(phí vận chuyển...)</small>:</p>
                            <p class="p-t-15"><b>Tổng tiền:</b></p>
                        </div>
                        @if (isset($action))
                            <div class="col-md-2">
                                <p class="totalAmount">{{array_sum(array_column($billExport->billDetail->toArray(), 'amount_export'))}}</p>
                                <p class="totalPrice">{{number_format($sumPrice)}}</p>
                                <p><input type="text" class="form-control transport" name="cost" value="{{number_format($billExport->cost)}}"></p>
                                <p><b class="sumAll">{{number_format($sumPrice+$billExport->cost)}}</b></p>
                            </div>
                        @else
                            <div class="col-md-2">
                                <p class="totalAmount"><br></p>
                                <p class="totalPrice"><br></p>
                                <p><input type="text" class="form-control transport" name="cost" value="0"></p>
                                <p><b class="sumAll"></b></p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class=" control-label col-form-label">Ghi chú</label>
                    <textarea name="note" class="form-control" rows="5">{{(isset($billExport->note)) ? $billExport->note : ""}}</textarea>
                </div>
                <div class="col-md-12 text-right m-t-30 p-r-50">
                    @if (isset($action))
                    <button type="submit" class="btn btn-info" name="status" value="0" {{($billExport->status==1) ? "disabled" : ""}}><i class=" fas fa-save" aria-hidden="true"></i> Cập nhật đơn chuyển hàng</button>
                    <button type="submit" class="btn btn-success" name="status" value="1" {{($billExport->status==1) ? "disabled" : ""}}><i class="fas fa-check" aria-hidden="true"></i> Cập nhật đơn chuyển hàng và Xác nhận chuyển xong</button>
                    @else
                    <button type="submit" class="btn btn-info" name="status" value="0"><i class=" fas fa-save" aria-hidden="true"></i> Tạo đơn chuyển hàng</button>
                    <button type="submit" class="btn btn-success" name="status" value="1"><i class="fas fa-check" aria-hidden="true"></i> Tạo đơn chuyển hàng và Xác nhận chuyển xong</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{url('custom/admin/assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{url('custom/admin/format_number.js')}}"></script>
@endsection
