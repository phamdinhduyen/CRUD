<?php

$product = $this->data;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#btn_update").click(function(e) {
            e.preventDefault();
            var id = $("#id").val();
            var ten_sp = $("#ten_sp").val();
            var ma_sp = $("#ma_sp").val();
            var ngay_sx = $("#ngay_sx").val();
            $.get("http://localhost/User/product/validate_form", {
                ten_sp: ten_sp,
                ngay_sx: ngay_sx,
                ma_sp: ma_sp,
                id: id
            }, function(data) {
                data = JSON.parse(data)
                console.log(data);
                if (!isEmptyObject(data) && (data.length != 0)) {
                    if (data.ten_sp) {
                        $('#ten_sp_err').text(data.ten_sp)
                    } else {
                        $('#ten_sp_err').text("")
                    }
                    if (data.ma_sp) {
                        $('#ma_sp_err').text(data.ma_sp)
                    } else {
                        $('#ma_sp_err').text("")
                    }
                    if (data.ngay_sx) {
                        $('#ngay_sx_err').text(data.ngay_sx)
                    } else {
                        $('#ngay_sx_err').text("")
                    }
                } else {
                    $('#form_edit_product').submit()
                }
            })
        })
    })

    function isEmptyObject(obj) {
        return JSON.stringify(obj) === '{}';
    }
    </script>
</head>

<body>

    <div class="container">
        <form action="http://localhost/User/product/update" method="POST" id="form_edit_product">
            <div class="form-group" style="display:none">
                <label for="tensp">Ten SP:</label>
                <input type="text" class="form-control" id="id" placeholder="Enter ten sp" name="id"
                    value="<?= $product['id']?>">
            </div>
            <div class="form-group">
                <label for="tensp">Ten SP:</label>
                <input type="text" class="form-control" id="ten_sp" placeholder="Enter ten sp" name="ten_sp"
                    value="<?= $product['ten_sp']?>">
                <span id="ten_sp_err" style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="masp">Ma san pham:</label>
                <input type="text" class="form-control" id="ma_sp" placeholder="Enter ma sp" name="ma_sp"
                    value="<?= $product['ma_sp']?>">
                <span id="ma_sp_err" style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="ngaysx">Ngay san xuat</label>
                <input type="text" class="form-control" id="ngay_sx" placeholder="Enter ngay sx" name="ngay_sx"
                    value="<?= $product['ngay_sx']?>">
                <span id="ngay_sx_err" style="color: red"></span>
            </div>

            <button type="submit" class="btn btn-default" id="btn_update">Submit</button>
        </form>
    </div>

</body>

</html>