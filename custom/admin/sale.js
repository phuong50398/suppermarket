$(function() {
    var localtion = 'http://localhost/market/';
    switchClick();
    selectspChange();
    allCheck();
    deleteClick();
    $('.method_sale').on('change', function() {
        method = $(this).val();
        $('.selectsp').html('');
        html = '';
        switch (method) {
            case '1':
                html += '<thead>';
                html += '<th>Giá từ</th><th>Đến</th><th>Chiết khấu</th>';
                html += '</thead>';
                html += '<tbody><tr>';
                html += '<td><input type="text" name="price_form" class="form-control"></td>';
                html += '<td><input type="text" name="price_to"  class="form-control"></td>';
                html += '<td class = "flex"><input type="text" name="discount"  class="form-control"><button class="btn btn-warning switch" type="button" name="percent" value="percent">%</button><button class="btn switch" type="button"  name="dong" value="dong">₫</button><input type="hidden" name="unit" value="percent" class="form-control unit"></td>';
                html += '</tr></tbody>';
                break;
            case '2':
                html += '<thead>';
                html += '<th>Mã</th><th>Tên sản phẩm</th><th>Chiết khấu</th>';
                html += '</thead><tbody></tbody>';
                selectsp = '<div class="col-sm-10 flex">';
                selectsp += '<label class="lblsp">Chọn sản phẩm</label>';
                selectsp += '<select name="" id="selectsp" class="form-control select2">';
                selectsp += '<option value="" data-name="">----- Chọn sản phẩm -----</option>';
                var opt = '';
                getSanPham(function(dssp) {
                    for (let i = 0; i < dssp.length; i++) {
                        opt += '<option value="' + dssp[i]['id'] + '">' + dssp[i]['name'] + '</option>';
                    }
                }, '');
                selectsp += opt;
                selectsp += '</select></div>';
                selectsp += '<div class="col-sm-2 custom-control custom-checkbox m-t-5">';
                selectsp += '<input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1" >';
                selectsp += '<label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>';
                selectsp += '</div>';
                $('.selectsp').html(selectsp);
                $(".select2").select2();
                break;
            case '3':
                html += '<thead>';
                html += '<th>Mã</th><th>Tên loại danh mục</th><th>Chiết khấu</th>';
                html += '</thead><tbody></tbody>';
                getLoaiDanhMuc();
                break;
            case '4':
                html += '<thead>';
                html += '<th>Mã</th><th>Tên nhà sản xuất</th><th>Chiết khấu</th>';
                html += '</thead><tbody></tbody>';
                getNhaSanXuat();
                break;
            case '5':
                html += '<thead>';
                html += '<th>Mã</th><th>Tên nhà cung cấp</th><th>Chiết khấu</th>';
                html += '</thead><tbody></tbody>';
                getNhaCungCap();
                break;
            case '6':
                html += '<thead>';
                html += '<th>Mã</th><th>Tên sản phẩm</th><th>Số lượng từ</th><th>Số lượng đến</th><th>Chiết khấu</th>';
                html += '</thead><tbody></tbody>';
                selectsp = '<div class="col-sm-10 flex">';
                selectsp += '<label class="lblsp">Chọn sản phẩm</label>';
                selectsp += '<select name="" id="selectsp" class="form-control select2">';
                selectsp += '<option value="" data-name="">----- Chọn sản phẩm -----</option>';
                var opt = '';
                getSanPham(function(dssp) {
                    for (let i = 0; i < dssp.length; i++) {
                        opt += '<option value="' + dssp[i]['id'] + '">' + dssp[i]['name'] + '</option>';
                    }
                }, '');
                selectsp += opt;
                selectsp += '</select></div>';
                selectsp += '<div class="col-sm-2 custom-control custom-checkbox m-t-5">';
                selectsp += '<input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1" >';
                selectsp += '<label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>';
                selectsp += '</div>';
                $('.selectsp').html(selectsp);
                $(".select2").select2();
                break;
            default:
                break;
        }
        $('#tblRender').html(html);
        selectspChange();
        switchClick();
        allCheck();
        // searchKeyUp();
    });

    function switchClick() {
        $('.switch').on('click', function() {
            $(this).parent().find('.switch').removeClass('btn-warning');
            $(this).addClass('btn-warning');
            $(this).parent().find('.unit').val($(this).val());
        });
    }

    function selectspChange() {
        $('#selectsp').on('change', function() {
            if ($('.method_sale').val() == '6') {
                html = '';
                html += '<tr>';
                html += '<td><input type="hidden" name="product[]" value="' + $(this).val() + '"  class="form-control"> <button type="button" class="btn btn-outline-danger btn-xs delete"><i class=" fas fa-trash-alt"></i></button> ' + $(this).val() + '</td>';
                html += '<td>' + $("#selectsp option:selected").text() + '</td>';
                html += '<td><input type="text" name="amount_from[]" class="form-control"></td>';
                html += '<td><input type="text" name="amount_to[]"  class="form-control"></td>';
                html += '<td class = "flex"><input type="text" name="discount[]"  class="form-control"><button class="btn btn-warning switch" type="button" name="percent" value="percent">%</button><button class="btn switch" type="button"  name="dong" value="dong">₫</button><input type="hidden" name="unit[]" value="percent" class="form-control unit"></td>';
                html += '</tr>';
                $('#tblRender tbody').append(html);
                switchClick();
                deleteClick();
            } else {
                html = '';
                html += '<tr>';
                html += '<td><input type="hidden" name="product[]" value="' + $(this).val() + '"  class="form-control"> <button type="button" class="btn btn-outline-danger btn-xs delete"><i class=" fas fa-trash-alt"></i></button> ' + $(this).val() + '</td>';
                html += '<td>' + $("#selectsp option:selected").text() + '</td>';
                html += '<td class = "flex"><input type="text" name="discount[]"  class="form-control"><button class="btn btn-warning switch" type="button" name="percent" value="percent">%</button><button class="btn switch" type="button"  name="dong" value="dong">₫</button><input type="hidden" name="unit[]" value="percent" class="form-control unit"></td>';
                html += '</tr>';
                $('#tblRender tbody').append(html);
                switchClick();
                deleteClick();
            }

        });
    }

    function allCheck() {
        $('#customControlAutosizing2').on('click', function() {
            if ($('#customControlAutosizing2')[0].checked) {
                $('#selectsp').attr('disabled', 'disabled');
                if ($('.method_sale').val() == '2' || $('.method_sale').val() == '3' || $('.method_sale').val() == '4' || $('.method_sale').val() == '5') {
                    html = '';
                    html += '<tr>';
                    html += '<td></td>';
                    html += '<td>Tất cả</td>';
                    html += '<td class = "flex"><input type="text" name="discount"  class="form-control"><button class="btn btn-warning switch" type="button" name="percent" value="percent">%</button><button class="btn switch" type="button"  name="dong" value="dong">₫</button><input type="hidden" name="unit" value="percent" class="form-control unit"></td>';
                    html += '</tr>';
                    $('#tblRender tbody').html(html);
                    switchClick();
                }
                if ($('.method_sale').val() == '6') {
                    html = '';
                    html += '<tr>';
                    html += '<td></td>';
                    html += '<td>Tất cả</td>';
                    html += '<td><input type="text" name="amount_from" class="form-control"></td>';
                    html += '<td><input type="text" name="amount_to"  class="form-control"></td>';
                    html += '<td class = "flex"><input type="text" name="discount"  class="form-control"><button class="btn btn-warning switch" type="button" name="percent" value="percent">%</button><button class="btn switch" type="button"  name="dong" value="dong">₫</button><input type="hidden" name="unit" value="percent" class="form-control unit"></td>';
                    html += '</tr>';
                    $('#tblRender tbody').html(html);
                    switchClick();
                }
            } else {
                $('#selectsp').removeAttr('disabled');
                $('#tblRender tbody').html('');
            }
        });
    }

    $('#customControlAutosizing1').on('click', function() {
        if ($('#customControlAutosizing1')[0].checked) {
            $('input[name="amount_applied"]').attr('disabled', 'disabled');
        } else {
            $('input[name="amount_applied"]').removeAttr('disabled');
        }
    });

    function deleteClick() {
        $('.delete').on('click', function() {
            $(this).parent().parent().remove();
        });
    }

    function searchKeyUp() {
        $('body').on('keyup', '.select2-search__field', function() {
            $('#selectsp').empty().trigger("change");
            getSanPham(function(dssp) {
                for (let i = 0; i < dssp.length; i++) {
                    var data = {
                        id: dssp[i]['id'],
                        text: dssp[i]['name']
                    };

                    var newOption = new Option(data.text, data.id, false, false);
                    $('#selectsp').append(newOption).trigger('change');
                    console.log(data);
                }
            }, $(this).val());

        });
    }

    function getSanPham(handleData, tensp) {
        $.ajax({
            type: "post",
            url: localtion + 'admin/sale/create/ajaxSanPham',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'tensanpham': tensp
            },
            async: !1,
            success: function(response) {
                handleData(response);
                // console.log(response);
            }
        });
    }

    function getSanPham(handleData, tensp) {
        $.ajax({
            type: "post",
            url: localtion + 'admin/sale/create/ajaxSanPham',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'tensanpham': tensp
            },
            async: !1,
            success: function(response) {
                handleData(response);
                // console.log(response);
            }
        });
    }

    function getLoaiDanhMuc() {
        $.ajax({
            type: "post",
            url: localtion + 'admin/sale/create/ajaxCategoryType',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                selectsp = '<div class="col-sm-10 flex">';
                selectsp += '<label class="lblsp">Chọn loại danh mục</label>';
                selectsp += '<select name="" id="selectsp" class="form-control select2">';
                var opt = '<option value="" >----- Chọn loại danh mục -----</option>';
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    opt += '<optgroup  label="' + response[i]['name'] + '">';
                    for (let ct = 0; ct < response[i]['category_type'].length; ct++) {
                        opt += '<option value="' + response[i]['category_type'][ct]['id'] + '">' + response[i]['category_type'][ct]['name'] + '</option>';
                    }
                    opt += '</optgroup>';
                }
                selectsp += opt;
                selectsp += '</select></div>';
                selectsp += '<div class="col-sm-2 custom-control custom-checkbox m-t-5">';
                selectsp += '<input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1" >';
                selectsp += '<label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>';
                selectsp += '</div>';
                $('.selectsp').html(selectsp);
                $('.select2').select2();
                selectspChange();
                switchClick();
                allCheck();
            }
        });
    }

    function getNhaSanXuat() {
        $.ajax({
            type: "post",
            url: localtion + 'admin/sale/create/ajaxProducer',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                selectsp = '<div class="col-sm-10 flex">';
                selectsp += '<label class="lblsp">Chọn nhà sản xuất</label>';
                selectsp += '<select name="" id="selectsp" class="form-control select2">';
                var opt = '<option value="" >----- Chọn nhà sản xuất -----</option>';
                for (let i = 0; i < response.length; i++) {
                    opt += '<option value="' + response[i]['id'] + '">' + response[i]['name'] + '</option>';
                }
                selectsp += opt;
                selectsp += '</select></div>';
                selectsp += '<div class="col-sm-2 custom-control custom-checkbox m-t-5">';
                selectsp += '<input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1" >';
                selectsp += '<label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>';
                selectsp += '</div>';
                $('.selectsp').html(selectsp);
                $('.select2').select2();
                selectspChange();
                switchClick();
                allCheck();
            }
        });
    }

    function getNhaCungCap() {
        $.ajax({
            type: "post",
            url: localtion + 'admin/sale/create/ajaxProvider',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                selectsp = '<div class="col-sm-10 flex">';
                selectsp += '<label class="lblsp">Chọn nhà cung cấp</label>';
                selectsp += '<select name="" id="selectsp" class="form-control select2">';
                var opt = '<option value="" >----- Chọn nhà cung cấp -----</option>';
                for (let i = 0; i < response.length; i++) {
                    opt += '<option value="' + response[i]['id'] + '">' + response[i]['name'] + '</option>';
                }
                selectsp += opt;
                selectsp += '</select></div>';
                selectsp += '<div class="col-sm-2 custom-control custom-checkbox m-t-5">';
                selectsp += '<input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="all" value="1" >';
                selectsp += '<label class="custom-control-label" for="customControlAutosizing2">Tất cả</label>';
                selectsp += '</div>';
                $('.selectsp').html(selectsp);
                $('.select2').select2();
                selectspChange();
                switchClick();
                allCheck();
            }
        });
    }

});