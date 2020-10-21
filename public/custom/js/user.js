$(function() {
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
    });

    // $(document).on('.my-cart-btn', 'click', function() {
    //     console.log($(this).data('id'));
    //     $.ajax({
    //         type: "post",
    //         url: location.href + '/ajaxGetProduct',
    //         data: {
    //             _token: $('meta[name="csrf-token"]').attr('content'),
    //             'id': $(this).data('id')
    //         },
    //         async: !1,
    //         success: function(response) {
    //             handleData(response);
    //             console.log(response);
    //         }
    //     });
    // })
    $('.my-cart-btn').on('click', function() {
        $.ajax({
            type: "post",
            url: location.href + '/ajaxGetProduct',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'id': $(this).data('id')
            },
            async: !1,
            success: function(res) {
                var res = res[0];
                $('#myModal .p-image').html(`<img src="${location.href}/public/${res.images}" class="img-responsive" alt="">`);
                $('#myModal .p-name').html(res.name);
                $('#myModal .p-price').html(res.price);
            }
        });
    });
});