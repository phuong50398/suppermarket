$(document).ready(function() {
    var href = location.origin + '/suppermarket'
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
    });
    countCart();
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
                $('#myModal .p-image').html(`<img src="${href}/public/${res.images}" class="img-responsive" alt="">`);
                $('#myModal .p-name').html(`<a href="${href}/${res.slug}">${res.name}</a>`);
                $('#myModal .p-price').html(res.price.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' đ');
                if (res.product_classify.length > 0) {
                    var html = '';
                    res.product_classify.forEach(e => {
                        html += `<span class="label label-info item-classify" data-classifyid='${e.classify.id}'>${e.classify.type} - ${e.classify.value}</span>`;

                    });
                    $('#myModal .p-js-classify').html(`<h4 class="quick">Phân loại</h4>
                    <p class="quick_desc p-classify"> ${html}</p>`);
                    $('.p-classify .label').on('click', function() {
                        $('.p-classify .label').removeClass('active');
                        $(this).addClass('active');
                    });
                } else {
                    $('#myModal .p-js-classify').html('');
                }
                $('#myModal .add-to').html(`<button class="btn btn-danger my-cart-btn my-cart-btn1 js-addcart" data-id="${res.id}" >Add to Cart</button>`);
                /// thêm giỏ hàng
                $('.js-addcart').on('click', function() {
                    var id = $(this).data('id');
                    var classify_id = 0;
                    if ($('#myModal .item-classify').length > 0) {
                        if ($('#myModal .item-classify.active').length == 0) {
                            alert('Vui lòng chọn phân loại sản phẩm');
                            return;
                        } else {
                            classify_id = $('#myModal .item-classify.active').data('classifyid');
                        }
                    }
                    var cart = localStorage.getItem('cart');
                    if (cart) {
                        cart = JSON.parse(cart);
                        var item = cart.find(e => {
                            return e.id == id && e.classify_id == classify_id;
                        });
                        if (item) {
                            item.amount = parseInt(item.amount) + 1;
                        } else {
                            cart.push({ id: id, classify_id: classify_id, amount: 1 })
                        }
                    } else {
                        cart = [{ id: id, classify_id: classify_id, amount: 1 }];
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    countCart();
                    alert('Thêm giỏ hàng thành công');
                    $('#myModal').modal('hide');
                })
            }
        });
    });

    function countCart() {
        cart = localStorage.getItem('cart');
        if (cart) {
            $('.my-cart-badge').html(JSON.parse(cart).length);
        }

    }

});