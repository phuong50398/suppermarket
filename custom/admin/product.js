$(document).ready(function() {

    var origin = 'http://localhost:81/suppermarket';

    function readURL(input, next, i) {
        if (input.files && input.files[i]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(next).append('<img src="' + e.target.result + '" alt="" class="img-thumbnail">');
            }
            reader.readAsDataURL(input.files[i]);
        }
    }

    $("input[name=images]").change(function() {
        $(this).next().html('');
        readURL(this, $(this).next(), 0);
    });
    $("input[name='album[]']").change(function() {
        $(this).next().html('');
        console.log(this.files);
        for (let i = 0; i < this.files.length; i++) {
            readURL(this, $(this).next(), i);
        }

    });

    $('#saveClassify').on('click', function() {
        type = $('input[name=type]').val();
        value = $('input[name=value]').val();
        if (type == "" || value == "") {
            $('.text-danger').html("Vui lòng nhập đầy đủ thông tin");
        } else {
            $.ajax({
                type: "post",
                url: origin + "/admin/ajaxSaveClassify",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'type': type,
                    'value': value
                },
                success: function(response) {
                    if (response != 'fail') {
                        console.log(response);
                        var newOption = new Option(type + ' - ' + value, response, false, false);
                        var selectedItems = $("select[name='classifies[]']").select2("val");
                        selectedItems.push(response);
                        $("select[name='classifies[]']").append(newOption).val(selectedItems).trigger('change');
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
});