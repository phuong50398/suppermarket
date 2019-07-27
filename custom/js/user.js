$(document).ready(function() {
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
    });
    $('.themgiohang').on('click', function() {
        var id = $(this).attr('data-id');
        arrCart = [];
        if (localStorage.getItem("mycart")) {
            arrCart = JSON.parse(localStorage.getItem("mycart"));
        }
        mySet = new Set(arrCart);
        found = Array.from(mySet).find(e => e.id == id);
        if (found) {
            arrCart[arrCart.indexOf(found)].soluong++;
        } else {
            arrCart.push({ soluong: 1, id: id });
        }

        localStorage.setItem("mycart", JSON.stringify(arrCart));
        // console.log(Object.keys(obj).find(id => arrCart[id] == id));
        $('.my-cart-badge').html(arrCart.length);
    });
});
