@extends('layouts/admin')
@section('content')
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Thêm sản phẩm</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{(isset($action)) ? route('product.update', $product->id) : route('product.store')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                {{(isset($action)) ? method_field('PUT') : ""}}
            <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row p-r-50 p-l-50">
                <div class="col-md-7 box-border">
                    <div class="form-group">
                        <label for="fname" class=" control-label col-form-label">Tên sản phẩm (*)</label>
                        <input required type="text" class="form-control" name="name" value="{{(isset($action)) ? old('name', $product->name) : ""}}">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="fname" class=" control-label col-form-label">Giá bán (*)</label>
                            <div class="pos-r">
                                <input required type="text" class="form-control" name="price" value="{{(isset($action)) ? old('price', $product->price) : ""}}">
                                <span class="currency-input">₫</span>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="form-group col-md-5">
                            <label for="fname" class=" control-label col-form-label">Trạng thái</label>
                            <div class="custom-control custom-checkbox m-t-5">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing1" name="active" value="1" {{(isset($action) && old('active', $product->active)==1) ? "checked" : ""}}>
                                <label class="custom-control-label" for="customControlAutosizing1">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fname" class=" control-label col-form-label">Phân loại</label>
                        <div class="row">
                            <div class=" col-md-10">
                                <select name="classifies[]" class="select2 form-control m-t-15" multiple="multiple" style="height: auto;width: 100%;">
                                    @if (isset($action))
                                        @foreach ($classifies as $item)
                                            <option {{(in_array($item->id,$arrclassifies)) ? "selected" : ""}} value="{{$item->id}}">{{$item->type}} - {{$item->value}}</option>
                                        @endforeach
                                    @else
                                        @foreach ($classifies as $item)
                                            <option value="{{$item->id}}">{{$item->type}} - {{$item->value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <button class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#Modal2"><i class="fas fa-plus"></i> Thêm mới</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fname" class=" control-label col-form-label">Mô tả (*)</label>
                        <textarea name="description" id="editor1" >{{(isset($action)) ? old('description', $product->description) : ""}}</textarea>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4 box-border">
                    <div class="form-group">
                        <label for="fname" class=" control-label col-form-label">Loại danh mục (*)</label>
                        <select required name="categoryType" class="select2 form-control custom-select" style="width: 100%; height:auto;">
                            <option value="">----Chọn loại danh mục----</option>
                            @if (isset($action))
                                @foreach ($categoryType as $ct)
                                    <optgroup label="{{$ct->name}}">
                                        @foreach ($ct->categoryType as $item)
                                            <option  {{($item->id == $product->category_type_id) ? "selected" : ""}} value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            @else
                                @foreach ($categoryType as $ct)
                                    <optgroup label="{{$ct->name}}">
                                        @foreach ($ct->categoryType as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fname" class=" control-label col-form-label">Nhà sản xuất (*)</label>
                        <select required name="producer" class="select2 form-control custom-select" style="width: 100%; height:auto;">
                            <option value="">----Chọn nhà sản xuất----</option>
                            @if (isset($action))
                                @foreach ($producers as $item)
                                    <option {{($item->id == $product->producer_id) ? "selected" : ""}} value="{{$item->id}}">{{$item->name}} ({{$item->code}})</option>
                                @endforeach
                            @else
                                @foreach ($producers as $item)
                                    <option value="{{$item->id}}">{{$item->name}} ({{$item->code}})</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fname" class=" control-label col-form-label">Ảnh đại diện (*) <small>Max size: 2047MB</small></label>
                        <div class=" khoianh">
                            <i class="fas fa-file-image" aria-hidden="true"></i>
                            <input type="file" name="images"  {{(!isset($action)) ? "required" : ""}}>
                            <div class="previmg text-center">
                                @if (isset($action))
                                <img src='{{asset("public/".$product->images)}}' alt="" class="img-thumbnail">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fname" class=" control-label col-form-label">Album ảnh  <small>Max size: 2047MB</small></label>
                        <div class=" khoianh">
                            <img src="{{url('custom/admin/images/album.png')}}" alt="">
                            <input type="file" name="album[]" multiple data-edit='{{(isset($action)) ? "edit" : "insert"}}'>
                            <div class="previmg text-center">
                            </div>
                            <div class="previmg text-center">
                                @if (isset($action))
                                    @foreach ($arralbum as $item)
                                    <img src='{{asset("public/".$item->link)}}' alt="" class="img-thumbnail">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-right m-t-30 p-r-50">
                <button type="reset" class="btn btn-secondary">Hủy</button>
                <button type="submit" class="btn btn-success"><i class=" fas fa-save" aria-hidden="true"></i> {{!isset($action) ? "Lưu" : "Cập nhật"}}  sản phẩm</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm phân loại</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class=" control-label col-form-label">Loại <small>(Size, Màu sắc...)</small></label>
                    <input type="text" class="form-control" name="type">
                </div>
                <div class="form-group">
                    <label class=" control-label col-form-label">Giá trị <small>(S, M, L...)</small></label>
                    <input type="text" class="form-control" name="value">
                </div>
                <p class="text-danger"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="saveClassify">Lưu</button>
            </div>
        </div>
    </div>
</div>
<script>

</script>
<script src="{{url('custom/admin/product.js')}}"></script>
@endsection
