$(document).ready(function() {
    var origin = 'http://localhost/suppermarket';
    // $('.datatable').DataTable();
    // $(".select2").select2();
    changeTotal();

    function formatState(state) {
        if (!state.id) {
            // return state.text;
        } else {
            var $state = $(
                '<p class="slectimg m-b-0"><img src="/suppermarket/public/' + $(state.element).attr('data-img') + '" class="img-flag" width="50px" /> <span class="p-l-10">' + state.text + ' <br/> <small>' + $(state.element).attr('data-price') + '₫</small></span> </p>'
            );
            return $state;
        }
    };
    $("select[name='product[]']").select2({
        placeholder: " Tìm kiếm sản phẩm",
        templateResult: formatState,
        escapeMarkup: function(m) {
            return m;
        }
    });

    $('select[name="product[]"]').on('change', function() {
        arr = $("select[name='product[]'] option:selected");
        html = '';
        totalAmount = 0;
        totalPrice = 0;
        for (let i = 0; i < arr.length; i++) {
            html += '<tr>';
            html += '<td>' + arr.eq(i).html() + '</td>';
            html += '<td><input type="text" data-type="currency" name="price[]" class="form-control currency text-right"></td>';
            html += '<td><input type="number" name="amount[]" class="form-control text-right" ></td>';
            html += '<td class="total text-right"></td>';
            html += '</tr>';
            // totalPrice += parseInt(arr.eq(i).attr('data-priceInt'));
            // totalAmount++;
        }

        $('.list_product').html(html);
        $('.totalPrice').html(formatNumber(totalPrice + ""));
        $('.totalAmount').html(totalAmount);
        totalPrice += parseInt($('.transport').val().replace(/\,/g, ''));
        $('.sumAll').html(formatNumber(totalPrice + ""));
        currency();
        changeTotal();
    });

    function changeTotal() {
        $('input[name="price[]"]').on('change', function() {
            price = $(this).val().replace(/\,/g, '');
            total = parseInt(price) * parseInt($(this).parent().next().find('input[name="amount[]"]').val());
            $(this).parent().next().next().html(formatNumber(total + ""));
            updateTotal();

        });
        $('input[name="amount[]"]').on('change', function() {
            price = $(this).parent().prev().find('input[name="price[]"]').val().replace(/\,/g, '') || 0;
            total = parseInt(price) * parseInt($(this).val());
            $(this).parent().next().html(formatNumber(total + ""));
            updateTotal();
        });
    }

    $('.transport').on('change', function() {
        sumTotal = parseInt($('.transport').val().replace(/\,/g, '')) + parseInt($('.totalPrice').html().replace(/\,/g, ''));
        $('.sumAll').html(formatNumber(sumTotal + ""));
    });

    $(".transport").on('keyup', function() {
        formatCurrency($(this));
    });

    function updateTotal() {
        arramount = $('input[name="amount[]"');
        arrtotal = $('.total');
        sumTotal = 0;
        sumAmount = 0;
        for (let i = 0; i < arrtotal.length; i++) {
            el = arrtotal.eq(i).html().replace(/\,/g, '');
            sumTotal += parseInt(el);
            el = arramount.eq(i).val().replace(/\,/g, '') || 0;
            sumAmount += parseInt(el);
        }
        $('.totalPrice').html(formatNumber(sumTotal + "")+'&nbsp');
        $('.totalAmount').html(sumAmount+'&nbsp');
        sumTotal += parseInt($('.transport').val().replace(/\,/g, ''));
        $('.sumAll').html(formatNumber(sumTotal + "")+'&nbsp');
    }

    $('#saveProvider').on('click', function() {
        name = $('input[name=name]').val();
        if (name == "") {
            $('.text-danger').html("Vui lòng nhập đầy đủ thông tin");
        } else {
            $.ajax({
                type: "post",
                url: origin + "/admin/ajaxSaveProvider",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'name': name,
                    'email': $('input[name=email]').val(),
                    'sdt': $('input[name=sdt]').val(),
                    'andress': $('input[name=andress]').val()
                },
                success: function(response) {
                    if (response != 'fail') {
                        var option = new Option(response.name + ' - ' + response.code, response.id);
                        option.selected = true;

                        $("select[name=provider]").append(option);
                        $("select[name=provider]").trigger("change");
                        // $("select[name='classifies[]']").select2('data', { id: response, text: type + ' - ' + value }).trigger('change');
                        toastr.success("Thêm thành công", 'Thông báo!');
                        $('#Modal2').modal('toggle');
                    } else {
                        toastr.error("Có lỗi xảy ra!", 'Thông báo!');
                    }
                }
            });
        }
    });

    function currency() {
        $(".currency").on('keyup', function() {
            formatCurrency($(this));
        });
    }

    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") { return; }

        // original length
        var original_len = input_val.length;

        // initial caret position
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = input_val;

            // final formatting
            if (blur === "blur") {
                input_val += ".00";
            }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }


});