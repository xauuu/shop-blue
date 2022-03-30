$(document).ready(function () {
    $.validator.addMethod("endGreaterThanBegin", function (value, element) {
        var price = $("input[id=price]").val();
        var discount = $("input[id=discount]").val();
        console.log(price);
        console.log(discount);
        if (Number(price) < Number(discount)) {
            return false;
        }
        return true;
    }, "Giá giảm không được lớn hơn giá gốc");
    $("#addproduct").validate({
        rules: {
            product_price: {
                required: true
            },
            product_discount: {
                endGreaterThanBegin: true
            },
            product_img: {
                required: true,
                extension: "png|jpeg|jpg",
                filesize: 2048576
            }
        },
        messages: {
            product_img: {
                required: "Bạn chưa chọn ảnh",
                extension: "File bạn chọn không đúng định dạng (png, jpeg, jpg)",
                filesize: "Ảnh quá lớn"
            }
        }
    });
});
