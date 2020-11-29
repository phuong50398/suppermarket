
<link href="{{url('custom/admin/dist/css/style.min.css')}}" rel="stylesheet">
<script src="{{url('custom/admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>

<h2>Hóa đơn xuất hàng ngày {{date('d/m/Y', strtotime($billExport->date_of_export))}}</h2>
<table class="table table-bordered m-t-20">
    <tr class="th-table">
        <th class="t-head head-it text-center">Hình ảnh</th>
        <th class="t-head">Sản phẩm</th>
        <th class="t-head text-center">Giá</th>
        <th class="t-head text-center">Số lượng</th>
    </tr>
    @foreach ($billExport->billDetail as $detail)
        <tr class="cross">
            <td class="ring-in t-data">
                <img width='60px' src="{{url('public/'.$arrProduct[$detail->product_id]->images)}}" class="img-responsive" alt="">                                        
            </td>
            <td class="t-data">
                {{$arrProduct[$detail->product_id]->name}}
            </td>
            <td class="t-data text-center">{{number_format($detail->price_export)}} đ</td>
            <td class="t-data text-center">{{$detail->amount_export}}</td>
        </tr>
    @endforeach
</table>
<p><i>Ghi chú: {{$billExport->note}}</i> </p>
<h4 class="phivanchuyen text-right">Phí vận chuyển: {{number_format($billExport->cost)}} đ</h4>
<h3 class="tongtien text-right">
    Thanh toán: {{number_format($billExport->payments)}} đ
</h3>
<script>
    $(function() {
        window.print();
    });
</script>