$(document).ready(function() {
    var href = location.origin + '/suppermarket'
        // hàm để chạy cái sile
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
    });

    // gọi ajax khi click vào nút add to cart
    $('.my-cart-btn').on('click', function() {
        $.ajax({
            type: "post",
            url: href + '/ajaxGetProduct',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'id': $(this).data('id')
            },
            async: !1,
            success: function(res) {
                var res = res[0];
                // lấy dữ liệu ajax trả về để đổ vào cái popup hiển thị 1 sp
                // để đổ các thông tin ảnh, tên, giá
                $('#myModal .p-image').html(`<img src="${href}/public/${res.images}" class="img-responsive" alt="">`);
                $('#myModal .p-name').html(`<a href="${href}/${res.slug}">${res.name}</a>`);
                $('#myModal .p-price').html(res.price.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' đ');
                // đổ các phân loại
                if (res.product_classify.length > 0) {
                    var html = '';
                    res.product_classify.forEach(e => {
                        html += `<span class="label label-info item-classify" data-classifyid='${e.id}'>${e.classify.type} - ${e.classify.value}</span>`;

                    });

                    $('#myModal .p-js-classify').html(`<h4 class="quick">Phân loại</h4>
                    <p class="quick_desc p-classify"> ${html}</p>`);

                    // sự ku=iện chọn phân loại sp để thêm giỏ hàng
                    $('.p-classify .label').on('click', function() {
                        $('.p-classify .label').removeClass('active');
                        $(this).addClass('active');
                    });
                } else {
                    $('#myModal .p-js-classify').html('');
                }
                $('#myModal .add-to').html(`<button class="btn btn-danger my-cart-btn my-cart-btn1 js-addcart" data-id="${res.id}" >Add to Cart</button>`);
                /// sự kiện click vào nút thêm giỏ hàng ở popup thì thêm giỏ hàng
                $('.js-addcart').on('click', function() {
                    var id = $(this).data('id');
                    var product_classify_id = 0;
                    // if ($('#myModal .item-classify').length > 0) {
                    if ($('#myModal .item-classify.active').length == 0) {
                        alert('Vui lòng chọn phân loại sản phẩm');
                        return;
                    } else {
                        product_classify_id = $('#myModal .item-classify.active').data('classifyid');
                    }
                    // }
                    var cart = localStorage.getItem('cart');
                    if (cart) {
                        cart = JSON.parse(cart);
                        var item = cart.find(e => {
                            return e.id == id && e.classify_id == product_classify_id;
                        });
                        if (item) {
                            item.amount = parseInt(item.amount) + 1;
                        } else {
                            cart.push({ id: id, product_classify_id: product_classify_id, amount: 1 })
                        }
                    } else {
                        cart = [{ id: id, product_classify_id: product_classify_id, amount: 1 }];
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    countCart();
                    $('#myModal').modal('hide');
                    $('.added-car').css('display', 'block');

                    // hiển thị thêm thành công
                    var mess = setInterval(function() {
                        $('.added-car').css('display', 'none');
                        clearInterval(mess);
                    }, 3000);
                })
            }
        });
    });

    // lấy số lượng giỏ hàng nếu k đăng nhập
    function countCart() {
        cart = localStorage.getItem('cart');
        if (cart) {
            $('.my-cart-badge').html(JSON.parse(cart).length);
        }

    }

    // $('.remove-cart').on('click', function() {
    //     var selector = $(this);
    //     var cf = confirm("Bạn có chắc chắn muốn xóa sản phẩm?");
    //     if (cf) {
    //         $.ajax({
    //             type: "post",
    //             url: href + '/ajaxRemoveProduct',
    //             data: {
    //                 _token: $('meta[name="csrf-token"]').attr('content'),
    //                 'product_id': selector.data('product'),
    //                 'cart_id': selector.data('cart'),
    //                 'product_classification_id': selector.data('classify'),
    //             },
    //             async: !1,
    //             success: function(res) {
    //                 selector.parents("tr.cross").remove();
    //             }
    //         });
    //     }
    // });

    // sự kiện ấn tăng số lượng sp ở giỏ hàng (hình như k dùng nữa, dùng hàm bên file cart.js)
    $('.quantity-select .value-plus').on('click', function() {
        var selector = $(this);
        var amount = parseInt(selector.parents("tr.cross").find('.quantity-select .span-1').html());
        if (amount >= 0) {
            $.ajax({
                type: "post",
                url: href + '/ajaxChangeAmount',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'product_id': selector.data('product'),
                    'cart_id': selector.data('cart'),
                    'product_classification_id': selector.data('classify'),
                    'amount': amount + 1
                },
                async: !1,
                success: function(res) {
                    selector.parents("tr.cross").find('.quantity-select .span-1').html(amount + 1);
                    selector.parents("tr.cross").find('.pay').html((parseInt(amount + 1) * parseFloat($('.cross .price').data('price'))).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' đ');
                }
            });
        }
    });

    // sự kiện ấn giảm số lượng sp ở giỏ hàng(hình như k dùng nữa, dùng hàm bên file cart.js)
    $('.quantity-select .value-minus').on('click', function() {
        var selector = $(this);
        var amount = parseInt(selector.parents("tr.cross").find('.quantity-select .span-1').html());
        if (amount > 1) {
            $.ajax({
                type: "post",
                url: href + '/ajaxChangeAmount',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'product_id': selector.data('product'),
                    'cart_id': selector.data('cart'),
                    'product_classification_id': selector.data('classify'),
                    'amount': amount - 1
                },
                async: !1,
                success: function(res) {
                    selector.parents("tr.cross").find('.quantity-select .span-1').html(amount - 1);
                    selector.parents("tr.cross").find('.pay').html((parseInt(amount - 1) * parseFloat($('.cross .price').data('price'))).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' đ');
                }
            });
        }
    });
    // $('.quantity-select .value-minus').on('click', function() {
    //     var selector = $(this);
    //     var amount = parseInt(selector.parents("tr.cross").find('.quantity-select .span-1').html());
    //     if (amount > 1) {
    //         $.ajax({
    //             type: "post",
    //             url: href + '/ajaxChangeAmount',
    //             data: {
    //                 _token: $('meta[name="csrf-token"]').attr('content'),
    //                 'product_id': selector.data('product'),
    //                 'cart_id': selector.data('cart'),
    //                 'product_classification_id': selector.data('classify'),
    //                 'amount' : amount-1
    //             },
    //             async: !1,
    //             success: function(res) {
    //                 selector.parents("tr.cross").find('.quantity-select .span-1').html(amount-1);
    //                 selector.parents("tr.cross").find('.pay').html((parseInt(amount-1)*parseFloat($('.cross .price').data('price'))).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' đ');
    //             }
    //         });
    //     }
    // });
    // $('#cart-dathang').on('click', function() {
    //         $.ajax({
    //             type: "post",
    //             url: href + '/ajaxCartOrder',
    //             data: {
    //                 _token: $('meta[name="csrf-token"]').attr('content')
    //             },
    //             async: !1,
    //             success: function(res) {
    //                 selector.parents("tr.cross").find('.quantity-select .span-1').html(amount-1);
    //                 selector.parents("tr.cross").find('.pay').html((parseInt(amount-1)*parseFloat($('.cross .price').data('price'))).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' đ');
    //             }
    //         });
    // });


});