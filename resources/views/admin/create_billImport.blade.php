@extends('layouts/admin')
@section('content')
<link href="{{url('custom/admin/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
<link href="{{url('custom/admin/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Nhập hàng</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Nhập hàng</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row p-r-50 p-l-50">
            <form action="{{(isset($action)) ? route('billImport.update', $billImport->id) : route('billImport.store')}}" method="POST" class=" w-100">
                @csrf
                {{(isset($action)) ? method_field('PUT') : ""}}
                <div class="form-group">
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
                </div>
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
                                <th style="width: 20%">Giá nhập</th>
                                <th style="width: 10%">Số lượng</th>
                                <th style="width: 20%">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="list_product">
                            @if (isset($action))
                                @foreach ($billImport->billDetail as $item)
                                    <tr>
                                        <td>{{$arrProduct[$item->product_id]}}</td>
                                        <td><input type="text" data-type="currency" name="price[]" class="form-control currency text-right" value="{{number_format($item->price_import)}}"></td>
                                        <td><input type="number" name="amount[]" class="form-control text-right"  value="{{$item->amount_import}}"></td>
                                        <td  class="total text-right">{{number_format($item->price_import*$item->amount_import)}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <p>Số lượng:</p>
                            <p>Tổng tiền:</p>
                            <p>Chi phí <small>(phí vận chuyển...)</small>:</p>
                            <p class="p-t-15"><b>Tổng tiền thanh toán:</b></p>
                        </div>
                        @if (isset($action))
                            <div class="col-md-2">
                                <p class="totalAmount">{{array_sum(array_column($billImport->billDetail->toArray(), 'amount_import'))}}</p>
                                <p class="totalPrice">{{number_format($sumPrice)}}</p>
                                <p><input type="text" class="form-control transport" name="cost" value="{{number_format($billImport->cost)}}"></p>
                                <p><b class="sumAll">{{number_format($sumPrice+$billImport->cost)}}</b></p>
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
                    <textarea name="note" class="form-control" rows="5">{{(isset($action)) ? $billImport->note : ""}}</textarea>
                </div>
                <div class="col-md-12 text-right m-t-30 p-r-50">
                    @if (isset($action))
                        @if (!isset($nhapkho))
                        <button type="submit" class="btn btn-info" name="status" value="0" {{($billImport->status==1) ? "disabled" : ""}}><i class=" fas fa-save" aria-hidden="true"></i> Cập nhật đơn nhập hàng</button>
                        @endif
                        <button type="submit" class="btn btn-success" name="status" value="1" {{($billImport->status==1) ? "disabled" : ""}}><i class="fas fa-check" aria-hidden="true"></i> Cập nhật đơn nhập hàng và Nhập kho</button>
                    @else

                        @if (!isset($nhapkho))
                        <button type="submit" class="btn btn-info" name="status" value="0"><i class=" fas fa-save" aria-hidden="true"></i> Tạo đơn nhập hàng</button>
                        @endif
                        <button type="submit" class="btn btn-success" name="status" value="1"><i class="fas fa-check" aria-hidden="true"></i> Tạo đơn nhập hàng và Nhập kho</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm nhà cung cấp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class=" control-label col-form-label">Tên nhà cung cấp (*)</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label class=" control-label col-form-label">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label class=" control-label col-form-label">SĐT</label>
                    <input type="text" class="form-control" name="sdt">
                </div>
                <div class="form-group">
                    <label class=" control-label col-form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="andress">
                </div>
                <p class="text-danger"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="saveProvider">Lưu</button>
            </div>
        </div>
    </div>
</div>
<script src="{{url('custom/admin/assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{url('custom/admin/format_number.js')}}"></script>
@endsection
