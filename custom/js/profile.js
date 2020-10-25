$(document).ready(function() {
    function readURL(input, next, i) {
        if (input.files && input.files[i]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(next).html('<a href="' + e.target.result + '" class="thumbnail"><img src="' + e.target.result + '"></a>');
            }
            reader.readAsDataURL(input.files[i]);
        }
    }
    $(".fileimg").change(function() {
        readURL(this, $(this).prev(), 0);
    });

    $("select[name='tinh']").change(function() {
        $.ajax({
            type: "post",
            url: location.origin + '/suppermarket/ajaxGetAndress',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                value: $(this).val(),
                type: 'huyen'
            },
            success: function(list_huyen) {
                console.log(list_huyen);
                // $("select[name='huyen']").val(null).trigger('change');
                html = '<option value="">-----Chọn quận/huyện-----</option>';
                if (list_huyen.length > 0) {
                    list_huyen.forEach(e => {
                        html += '<option value="' + e['id'] + '">' + e['name_district'] + '</option>';
                    });
                }
                $("select[name='huyen']").html(html).trigger('change');
            }
        });
    });

    $("select[name='huyen']").change(function() {
        $.ajax({
            type: "post",
            url: location.origin + '/suppermarket/ajaxGetAndress',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                value: $(this).val(),
                type: 'xa'
            },
            success: function(list_xa) {
                console.log(list_xa);
                // $("select[name='xa']").val(null).trigger('change');
                html = '<option value="">-----Chọn phường/xã-----</option>';
                if (list_xa.length > 0) {
                    list_xa.forEach(e => {
                        html += '<option value="' + e['id'] + '">' + e['name_town'] + '</option>';
                    });
                }
                $("select[name='xa']").html(html).trigger('change');


            }
        });
    });
});