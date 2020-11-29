
<link href="{{url('custom/admin/dist/css/style.min.css')}}" rel="stylesheet">
<script src="{{url('custom/admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>

<h2>Hóa đơn đặt hàng ngày {{date('d/m/Y', strtotime($purchase->date))}}</h2>
<table class="table table-bordered m-t-20">
    <tr class="th-table">
        <th class="t-head head-it text-center">Hình ảnh</th>
        <th class="t-head">Sản phẩm</th>
        <th class="t-head text-center">Giá</th>
        <th class="t-head text-center">Số lượng</th>
    </tr>
    @foreach ($purchase->purchaseOrderDetail as $detail)
        <tr class="cross">
            <td class="ring-in t-data">
                <img width='60px' src="{{url('public/'.$detail->product->images)}}" class="img-responsive" alt="">                                        
            </td>
            <td class="t-data">
                {{$detail->product->name}}
            </td>
            <td class="t-data text-center">{{number_format($detail->price)}} đ</td>
            <td class="t-data text-center">{{$detail->amount}}</td>
        </tr>
    @endforeach
</table>
<p><i>Khách hàng: {{$purchase->user->name}}</i> </p>
<p><i>Đại chỉ: {{$purchase->delivery_address}}</i> </p>
<h4 class="phivanchuyen text-right">Phí vận chuyển: {{number_format($purchase->transport_fee)}} đ</h4>
<h3 class="tongtien text-right">
    Thanh toán: {{number_format($purchase->total)}} đ
</h3>
<script>
    $(function() {
        window.print();
    });
</script>