$(document).ready(function () {
    /*------------------
        AJAX
    --------------------*/
    // add cart
    $('.add-card').click(function () {
        var id = $(this).data('id');
        var _token = $('input[name=_token]').val();
        var url = $('input[name=this_url]').val() + '/add-cart-ajax';
        swal({
            title: "Thêm sản phẩm này vào giỏ hàng",
            icon: "warning",
            buttons: {
                cancel: "Không",
                ok: {
                    text: "Có",
                    value: "ok",
                }
            },
            dangerMode: true,
        })
            .then((value) => {
                switch (value) {
                    case "ok":
                        $.ajax({
                            url: url,
                            method: "POST",
                            data: {
                                id: id,
                                _token: _token
                            },
                            dataType: "html",
                            success: function (data) {
                                swal({
                                    title: "Đã thêm vào giỏ hàng",
                                    icon: "success",
                                });
                                document.getElementById('slsp').innerHTML =
                                    data;
                            }
                        });
                        break;
                }
            });
    });
    $('button[id=add-cart-w-qty]').click(function (e) {
        var product_id = $('input[name=product_id]').val();
        var quantity = $('input[name=quantity]').val();
        var url = $('input[name=this_url]').val() + '/add-cart';
        var _token = $('input[name=_token]').val();
        $.ajax({
            type: "post",
            url: url,
            data: {
                product_id: product_id,
                quantity: quantity,
                _token: _token
            },
            success: function (data) {
                if (data == 'Số lượng sản phẩm trong kho không đủ') {
                    swal({
                        text: data,
                        icon: "error",
                        buttons: false,
                        timer: 1500
                    });
                } else {
                    swal({
                        text: "Đã thêm vào giỏ hàng",
                        icon: "success",
                        buttons: false,
                        timer: 1500
                    });
                    document.getElementById('slsp').innerHTML = data;
                }
            }
        });
    });
    // end add cart

    /*-------------------
            Quantity change
    --------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        topbar.config({
            autoRun      : false,
            barThickness : 4,
            barColors    : {
              '0'        : 'rgba(26,  188, 156, .7)',
              '.3'       : 'rgba(41,  128, 185, .7)',
              '1.0'      : 'rgba(231, 76,  60,  .7)'
            },
            shadowBlur   : 5,
            shadowColor  : 'rgba(0, 0, 0, .5)',
            className    : 'topbar',
          })
        topbar.show();
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find('input').val(newVal);
        // ajax
        var url = $('input[name=this_url]').val() + '/update-cart';
        var _token = $('input[name=_token]').val();
        var inp = $button.parent().find('input');
        var total = $button.closest('td').next().find('h4');
        var rowId = inp.attr('name');
        var qty = inp.val();
        $.ajax({
            type: "post",
            url: url,
            data: {
                rowId: rowId,
                qty: qty,
                _token: _token
            },
            dataType: "json",
            success: function (resutl) {
                if (resutl == 0) {
                    $button.parent().find('input').val(oldValue);
                    toastr.warning('Số lượng sản phẩm trong kho không đủ')
                } else {
                    $.each(resutl, function (key, item) {
                        total.html(item['total_col']);
                        $('.subtotal').html(item['total_cost']);
                        toastr.success('Đã cập nhật giỏ hàng');
                        topbar.hide()
                    });
                }
            }
        });
    });
    $('.delete').click(function (e) {
        var tr = $(this).closest('tr');
        var rowId = $(this).data('id');
        var url = $('input[name=this_url]').val() + '/delete-cart';
        var _token = $('input[name=_token]').val();
        swal({
            title: "Bạn có chắc?",
            text: "Muốn xoá sản phẩm này khỏi giỏ hàng",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            rowId: rowId,
                            _token: _token
                        },
                        success: function (result) {
                            tr.remove();
                            swal({
                                title: "Đã xoá!",
                                text: "Sản phẩm đã được xoá khỏi giỏ hàng",
                                icon: "success",
                            });
                            $('.subtotal').html(result);
                        }
                    });
                }
            });

    });
    //
    $('.choose').change(function (e) {
        var action = $(this).attr('id');
        var city_id = $(this).val();
        var _token = $('input[name=_token]').val();
        var url = $('input[name=this_url]').val() + '/select';
        var result = '';
        if (action == 'city') {
            result = 'district';
        } else {
            result = 'wards';
        }
        $.ajax({
            type: "post",
            url: url,
            data: {
                action: action,
                city_id: city_id,
                _token: _token
            },
            success: function (data) {
                $('#' + result).html(data);
            }
        });
    });
    //
    // comment
    $('.btn-cmt').click(function () {
        var product_id = $(this).data('product_id');
        var content = $('textarea#cmt').val();
        var _token = $('input[name=_token]').val();
        var url = $('input[name=this_url]').val() + '/add-comment';
        $.ajax({
            type: "post",
            url: url,
            data: {
                product_id: product_id,
                content: content,
                _token: _token
            },
            success: function (data) {
                $('.blog__details__comment').append(data);
                var content = $('textarea#cmt').val('');
            }
        });
    });

    $('.btn-reply').click(function () {
        var cmt_id = $(this).data('cmt_id');
        var product_id = $('input[name=product_id]').val();
        var _token = $('input[name=_token]').val();
        var content = $('#reply' + cmt_id).val();
        var url = $('input[name=this_url]').val() + '/reply-comment';
        $.ajax({
            type: "post",
            url: url,
            data: {
                cmt_id: cmt_id,
                product_id: product_id,
                content: content,
                _token: _token
            },
            success: function (data) {
                $('#reply' + cmt_id).val('');
                $('#reply-comment' + cmt_id).append(data);
            }
        });

    });
    // end comment

    // search
    $('input[name=search]').keyup(function (e) {
        var _token = $('input[name=_token]').val();
        var search = $(this).val().trim();
        var url = $('input[name=this_url]').val() + '/search-ajax';
        if (search != '') {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    search: search,
                    _token: _token
                },
                success: function (data) {
                    $('#search-list').fadeIn();
                    $('#search-list').html(data);
                }
            });
        }
        else {
            $('#search-list').fadeOut();
        }
    });
    $(document).click(function () {
        $("#search-list").hide();
    })
    // end search
    // pagination
    $('select[name=pagination]').change(function (e) {
        var page = $(this).val();
        var _token = $('input[name=_token]').val();
        var url = $('input[name=this_url]').val() + '/paginate';
        $.ajax({
            type: "post",
            url: url,
            data: {
                page: page,
                _token: _token
            },
            success: function (data) {
                location.reload();
            }
        });
    });
    // rating
    function remove_bg(product_id) {
        for (var count = 1; count <= 5; count++) {
            $('#' + product_id + '-' + count).css('color', '#e6e6e6');
        }
    }
    $('.rating').mouseenter(function () {
        var index = $(this).data("index");
        var product_id = $(this).data("product_id");
        remove_bg(product_id);
        for (var count = 1; count <= index; count++) {
            $('#' + product_id + '-' + count).css('color', '#f51167');
        }
    });
    $('.rating').mouseleave(function () {
        var index = $(this).data("index");
        var product_id = $(this).data("product_id");
        var rating = $(this).data("rating");
        remove_bg(product_id);
        for (var count = 1; count <= rating; count++) {
            $('#' + product_id + '-' + count).css('color', '#f51167');
        }
    });
    $('.rating').click(function (e) {
        var index = $(this).data("index");
        var product_id = $(this).data("product_id");
        var _token = $('input[name=_token]').val();
        var url = $('input[name=this_url]').val() + '/add-rating';
        $.ajax({
            type: "post",
            url: url,
            data: {
                index: index,
                product_id: product_id,
                _token: _token
            },
            success: function (data) {
                if (data) {
                    alert(data);
                } else {
                    $('.rating').data('rating', index);
                }
            }
        });
    });
    // end rating
    // comment blog
    $('#post_cmt').click(function (e) {
        var post_id = $(this).data('post_id');
        var content = $('#cmt').val();
        var _token = $('input[name=_token]').val();
        var url = $('input[name=this_url]').val() + '/add-post-cmt';
        $.ajax({
            type: "post",
            url: url,
            data: {
                post_id: post_id,
                content: content,
                _token: _token
            },
            success: function (result) {
                $('#cmt').val('');
                $('.blog__details__comment').append(result);
            }
        });
    });
    // end comment blog
    // back to top
    var btn = $('#backtotop');
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, '300');
    });

    $('.dropdown').change(function (e) {
        var url = $(this).find(":selected").val();
        console.log(url);
        if (url) {
            window.location = url;
        }
        return false;
    });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
