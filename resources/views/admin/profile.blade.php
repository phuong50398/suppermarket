@extends('layouts/admin')
@section('content')
<div class="page-wrapper  p-b-100">
    <div class="container-fuid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Thông tin khách hàng</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Quản lý bán hàng</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thông tin khách hàng</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xlg-12 p-t-30 row p-r-50 p-l-50">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Ảnh đại diện</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Email</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col" style="width: 20%">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                        @foreach ($user as $item)
                            <tr>
                                <td class="text-center">
                                    @if ($item->avatar)
                                    <img src="{{url('public/'.$item->avatar)}}" alt="avatar" width="50px" >
                                    @else
                                        <img src="{{url('custom/images/icon/user.png')}}" alt="avatar" width="50px" >
                                    @endif
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{date('d/m/Y', strtotime($item->birth))}}</td>
                                <td>{{$item->gender}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->dc}}</td>
                                
                                <td>
                                    <button onclick="addInput({{$item->id}})" data-id = '{{$item->id}}' class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#Modal2">Đổi mật khẩu</button>
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
                    @for ($i = 1; $i <= $user->lastPage(); $i++)
                        <li class="{{($user->currentPage()==$i) ? 'active' : ''}} page-item"><a class="page-link" href="{{url()->current()}}?page={{$i}}" >{{$i}}</a></li>
                    @endfor
                <li  class="page-item"><a class="page-link" href="{{url()->current()}}?page={{$user->lastPage()}}"><span aria-hidden="true">»</span></span></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm phân loại</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('adminprofile.update',1)}}">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class=" control-label col-form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label class=" control-label col-form-label">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" name="repassword">
                    </div>
                    <p class="text-danger"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
                <div id="input-id"></div>
            </form>
        </div>
    </div>
</div>
<script src="{{url('custom/admin/assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
@endsection
<script>
    function addInput(id){
        $('#input-id').html('<input type="hidden" name="id" value="'+id+'">');
    }
</script>