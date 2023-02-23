<?php
$products = $this->data;

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
        $(".deleteProduct").click(function(e) {
            console.log("aaa");
            if (confirm("ban muon xoa ?!\ OK or Cancel.")) {
                return true;
            }
            return false;
        })


        $("#show_more").click(function(e) {

            e.preventDefault()
            $.get("http://localhost/User/product?page=2", {
                    page: 2
                },
                function(data) {
                    const products = JSON.parse(data);
                    let htmlProduct = '';
                    products.forEach(product => {
                        htmlProduct += `
                    <tr>
                        <td>${product.ten_sp}</td>
                        <td>${product.ngay_sx}</td>
                        <td>${product.ma_sp}</td>
                        <td>
                            <button style="background: blue;">
                                <a style="color:black"
                                    href="http://localhost/User/product/edit?id= ${product["id"]}">
                                    Edit</a>
                            </button>
                            <button style="background: red;">
                                <a class="deleteProduct" style="color:black"
                                    href="http://localhost/User/product/delete?id=${product["id"]}">Delete</a>
                            </button>
                        </td>
                    </tr>
                `
                    });
                    $("#tblProduct").append(htmlProduct);
                })
        })
    })
    </script>
</head>

<body>
    <div class="container">
        <h2>Basic Table</h2>
        <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Ten san pham</th>
                    <th>Ngay san xuat</th>
                    <th>Ma SP</th>
                    <th>Action</th>
                </tr>
            </thead>
            <div>
                <tbody id="tblProduct">
                    <?php
                foreach ($products as $product) {    ?>
                    <tr>
                        <td><?php echo $product["ten_sp"] ?></td>
                        <td><?php echo $product["ngay_sx"] ?></td>
                        <td><?php echo $product["ma_sp"] ?></td>
                        <td>
                            <button style="background: blue;">
                                <a style="color:black"
                                    href="http://localhost/User/product/edit?id=<?php echo $product["id"]?>">
                                    Edit</a>
                            </button>
                            <button style="background: red;">
                                <a class="deleteProduct" style="color:black"
                                    href="http://localhost/User/product/delete?id=<?php echo $product["id"]?>">Delete</a>
                            </button>
                        </td>
                    </tr>
                    <?php }?>
                    </tr>
                </tbody>
            </div>
        </table>
        <div style="text-align:center; color: green" id="show_more"> Show_more</div>

    </div>

</body>

</html>