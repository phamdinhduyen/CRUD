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
        $("#btn_create").click(function(e) {
            e.preventDefault();
            var ten_sp = $("#ten_sp").val();
            var ma_sp = $("#ma_sp").val();
            var ngay_sx = $("#ngay_sx").val();
            console.log(ten_sp);

            const data = {
                ten_sp: ten_sp,
                ngay_sx: ngay_sx,
                ma_sp: ma_sp,
            }
            $.post('http://localhost/User/product/validate_form', data, function(data) {
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
                    $('#createProduct').submit()
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
    <div class="them" style="width:500px; margin-left:50px; margin-top:30px">
        <form action="http://localhost/User/product/postProduct" method="POST" id="createProduct">
            <div class="form-group">
                <label for="tensp">Ten SP:</label>
                <input type="text" class="form-control" id="ten_sp" type="text" name="ten_sp">
                <span id="ten_sp_err" style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="tensp">Ma SP:</label>
                <input type="text" class="form-control" id="ma_sp" type="text" name="ma_sp">
                <span id="ma_sp_err" style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="tensp">Ngay sx:</label>
                <input type="date" class="form-control" id="ngay_sx" type="date" name="ngay_sx">
                <span id="ngay_sx_err" style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="tensp">Nha Sx:</label>
                <select id="ma_nsx" name="ma_nsx">
                    <?php
                $products = ($this->data);
                foreach ($products as $product) { ?>
                    <option VALUE=<?php echo $product['ma_nsx']?>> <?php echo $product['ten_nsx']?>
                    </option>
                    <?php }
                ?>
                </select>
            </div>
            <button id="btn_create" type="submit">Submit</button>
        </form>
    </div>
</body>

</html>