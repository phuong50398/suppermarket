$(function() {
    $('.method_sale').on('change', function() {
        method = $(this).val();
        html = '';
        switch (method) {
            case '1':
                html += '<thead>';
                html += '<th>Giá từ</th><th>Đến</th><th>Chiết khấu</th>';
                html += '</thead>';
                html += '<tbody><tr>';
                html += '<td><input type="text" name="price_form" class="form-control"></td>';
                html += '<td><input type="text" name="price_to"  class="form-control"></td>';
                html += '<td class = "flex"><input type="text" name="unit"  class="form-control"><button class="btn btn-warning switch" type="button">%</button><button class="btn btn-secondary switch" type="button">₫</button></td>';
                html += '</tr></tbody>';
                break;
            case '2':
                html += '<thead>';
                html += '<th>Mã</th><th>Tên sản phẩm</th><th>Chiết khấu</th>';
                html += '</thead>';
                // html += '<tbody><tr>';
                // html += '<td><input type="text" name="price_form" class="form-control"></td>';
                // html += '<td><input type="text" name="price_to"  class="form-control"></td>';
                // html += '<td class = "flex"><input type="text" name="unit"  class="form-control"><button class="btn btn-warning switch" type="button">%</button><button class="btn btn-secondary switch" type="button">₫</button></td>';
                // html += '</tr></tbody>';
                selectsp = '<div class="col-sm-10 flex">';
                selectsp += '<label class="lblsp">Chọn sản phẩm</label>';
                selectsp += '<select name="" id="selctsp" class="form-control select2"></select>';
                selectsp += '</div>';
                selectsp += '<div class="col-sm-2 custom-control custom-checkbox m-t-5">';
                selectsp += '<input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="active" value="1" >';
                selectsp += '<label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>';
                selectsp += '</div>';
                $('.selectsp').html(selectsp);
                break;
            case 3:

                break;
            case 4:

                break;
            case 5:

                break;
            default:
                break;
        }
        $('#tblRender').html(html);
    });
});