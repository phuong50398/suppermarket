$(document).ready(function() {
    const url = 'http://localhost/suppermarket/';
    const expirationDuration = 1000 * 60 * 60 * 12; // 12 hours
    var saleCart = [];
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-orange',
        radioClass: 'iradio_flat-orange'
    });
    getCart();

    function getCart() {
        // arrCart = JSON.parse(localStorage.getItem("mycart"));
        // timeUpdate = JSON.parse(localStorage.getItem("timeUpdate"));
        // if (parseInt(timeUpdate) + parseInt(expirationDuration) < parseInt(new Date().getTime())) {
           
        // } 
        arrCart = [];
        $.ajax({
            type: "post",
            url: url + 'ajaxGetCart',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                arrCart: arrCart
            },
            success: function(response) {
                ketqua = JSON.parse(response);
                listProduct = ketqua['saleProduct'];
                arrClassify = ketqua['arrClassify'];
                saleCart = ketqua['saleCart'];
                if (listProduct != '') {
                    html = '<tr class="th-table"><th class="t-head text-center"><input type="checkbox" class="icheckbox_flat-orange check-all" checked></th><th class="t-head head-it text-center">Sản phẩm</th><th class="t-head text-center">Giá</th><th class="t-head text-center">Số lượng</th><th class="t-head text-center"></th> </tr>';
                    tongtien = 0;
                    $.each(listProduct, function(index, product) {
                        price = product['price'];
                        html += '<tr class="cross">';
                        html += '<td class="t-data  text-center"><input type="checkbox" class="icheckbox_flat-orange" value="' + product['id'] + '" name="product[]" checked></td>';
                        html += '<td class="ring-in t-data">';
                        html += '<a href="' + url + product['slug'] + '" class="at-in"><img src="' + url + "public/" + product['images'] + '" class="img-responsive" alt=""></a>';
                        if (product['cart_detail'][0]['product_classification_id']) {
                            html += '<div class="sed"><a href="' + url + product['slug'] + '"><h5>' + product['name'] + '</h5></a><span class="label label-info item-classify" >' + arrClassify[product['cart_detail'][0]['product_classification_id']] + '</span></div></td>';
                        } else {
                            html += '<div class="sed"><a href="' + url + product['slug'] + '"><h5>' + product['name'] + '</h5></a></div></td>';
                        }
                        html += '<div class="sed"><a href="' + url + product['slug'] + '"><h5>' + product['name'] + '</h5></a></div><span class="label label-info item-classify" >' + (product['cart_detail'][0]['product_classification_id'] != null) ? arrClassify[product['cart_detail'][0]['product_classification_id']] : '' + '</span></td>';
                        if (product['price_sale']) {
                            price = product['price_sale'];
                            html += '<td class="t-data text-center">' + (product['price_sale'] + "").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' đ</td>';
                        } else {
                            html += '<td class="t-data text-center">' + (product['price'] + "").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' đ</td>';
                        }
                        html += '<td class="t-data text-center"><div class=""> <div class="quantity-select"><div class="entry value-minus" data-price="' + price + '" data-product="' + product['id'] + '" data-product_classification="' + product['cart_detail'][0]['product_classification_id'] + '">&nbsp;</div> <div class="entry value" data-price="' + price + '">' + product['cart_detail'][0]['amount'] + '</div> <div class="entry value-plus active" data-price="' + price + '" data-product="' + product['id'] + '" data-product_classification="' + product['cart_detail'][0]['product_classification_id'] + '">&nbsp;</div> </div> </div></td>';
                        html += '<td class="t-data "> <div class="trash" title="Xóa" data-product="' + product['id'] + '"> <i class="fa fa-trash-o" aria-hidden="true"></i></div></td></tr>';
                        tongtien += price * product['cart_detail'][0]['amount'];
                    });
                    if (saleCart != '') {
                        $('.tong').html('Tổng tiền hàng: ' + (tongtien + "").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' đ');
                        var tong_tam = tongtien;
                        var tonggiam = 0;
                        saleCart.forEach(sale => {
                            if (tongtien >= parseInt(sale['price_form']) && tongtien <= parseInt(sale['price_to'])) {
                                if (sale['unit'] == 'percent') {
                                    tonggiam += tong_tam * (parseInt(sale['discount']) / 100);
                                    // tong_tam -= tong_tam * (parseInt(sale['discount']) / 100);
                                } else {
                                    tonggiam += parseInt(sale['discount']);
                                    // tong_tam -= parseInt(sale['discount']);
                                }
                            }
                        });
                        $('.giamgia').html('Giảm giá: - ' + (parseInt(tonggiam) + "").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' đ');
                        tongtien -= parseInt(tonggiam);
                    }
                    tongtien += parseInt($('.phivanchuyen').attr('data-fee'));
                    $('.table-cart').html(html);
                    $('.tongtien').html("Thanh toán: " + (tongtien + "").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' đ');
                    $('input[type="checkbox"]').iCheck({
                        checkboxClass: 'icheckbox_flat-orange',
                        radioClass: 'iradio_flat-orange'
                    });
                    actionChange();
                    $('.hidden-fee').removeClass('hidden-fee');
                } else {
                    $('.table-cart').parent().append('<h3 class="text-center">Chưa có sản phẩm nào trong giỏ hàng! <a href="' + url + '"><u>Tiếp tục mua hàng</u></a></h3>')
                }

            }
        });
    }

    function actionChange() {
        $(document).on('click', '.value-plus, .value-minus', function() {
            thiss = $(this);
            var amount = parseInt(thiss.parents("tr.cross").find('.quantity-select .value').html());
            if(thiss.hasClass('value-plus') && amount >= 0){
                amount = amount+1;
                thiss.parents("tr.cross").find('.quantity-select .value').html(amount);
            }
            if(thiss.hasClass('value-minus') && amount > 1){
                amount = amount-1;
                thiss.parents("tr.cross").find('.quantity-select .value').html(amount);
            }
            $.ajax({
                type: "post",
                url: url + 'ajaxUpdateAmount',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    amount: thiss.parent().find('.value').html(),
                    product: thiss.attr('data-product'),
                    product_classification: thiss.attr('data-product_classification'),
                },
                success: function(response) {

                }
            });
            updateTotal();
        });
        $(document).on('ifToggled', '.icheckbox_flat-orange', function(event) {
            updateTotal();
        })
        $(document).on('ifToggled', '.check-all', function(event) {
            checked = $('.cross input[name="product[]"]:checked');
            check = $('.cross input[name="product[]"]');
            console.log($(this)[0].checked);
            if ($(this)[0].checked) {
                $('.cross input[name="product[]"]').iCheck('check');
            } else {
                $('.cross input[name="product[]"]').iCheck('uncheck');
            }
            updateTotal();
        })
        $(document).on('click', '.trash', function() {
            if (confirm('Bạn có muốn xóa sản phẩm trong giỏ hàng')) {
                product = $(this).attr('data-product');
                thiss = $(this);
                $.ajax({
                    type: "post",
                    url: url + 'ajaxDeleteProduct',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        product: product
                    },
                    success: function(response) {
                        if (response != 'false') {
                            thiss.parent().parent().remove();
                            updateTotal();
                        } else {

                        }
                    }
                });
            }
        });
    }

    function updateTotal() {
        listChecked = $('.cross input[name="product[]"]:checked');
        listAmount = $('.table-cart .value');
        sum = 0;
        if (listChecked.length > 0) {
            $.each(listChecked, function(index, amount) {
                itemValue = listChecked.eq(index).parent().parent().parent().find('.value');
                sum += parseInt(itemValue.html()) * parseInt(itemValue.attr('data-price'));
            });
            $('.tong').html('Tổng tiền hàng: ' + (sum + "").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' đ');
            if (saleCart != '') {
                var tong_tam = sum;
                var tonggiam = 0;
                saleCart.forEach(sale => {
                    if (sum >= parseInt(sale['price_form']) && sum <= parseInt(sale['price_to'])) {
                        if (sale['unit'] == 'percent') {
                            tonggiam += tong_tam * (parseInt(sale['discount']) / 100);
                            // tong_tam -= tong_tam * (parseInt(sale['discount']) / 100);
                        } else {
                            tonggiam += parseInt(sale['discount']);
                            // tong_tam -= parseInt(sale['discount']);
                        }
                    }
                });
                $('.giamgia').html('Giảm giá: - ' + (parseInt(tonggiam) + "").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' đ');
                sum -= parseInt(tonggiam);
            }
            sum += parseInt($('.phivanchuyen').attr('data-fee'));
        } else {
            $('.tong').html('Tổng tiền hàng: 0 đ');
            $('.giamgia').html('Giảm giá: - 0 đ');
        }
        $('.tongtien').html("Thanh toán: " + (sum + "").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' đ');
    }
});