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
            $.get("http://localhost/User/product?page=2"), {
                    page: 2
                },
                function(data) {
                    const products = JSON.parse(data);
                    const htmlProduct = '';
                    products.forEach(product => {
                        htmlProduct += `
                        <tr>
                        <td>${product.name}</td>
                        <td>${product.name}</td>
                        <td>${product.name}</td>
                        <td>
                            <a href="http://localhost/User/product/edit?id=${product.id}"> Sua</a>
                            <a class="delete"
                                href="http://localhost/User/product/delete?id=${product.id}">Xoa</a>
                        </td>
                        </tr>
                        `
                    })
                    $('#tblProduct').append(htmlProduct);
                }
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
                <tbody>
                    <?php
                foreach ($products as $product) {    ?>
                    <tr>
                        <td><?php echo $product["ten_sp"] ?></td>
                        <td><?php echo $product["ngay_sx"] ?></td>
                        <td><?php echo $product["ma_sp"] ?></td>
                        <td>
                            <a href="http://localhost/User/product/edit?id=<?php echo $product["id"]?>"> Sua</a>
                            <a class="deleteProduct"
                                href="http://localhost/User/product/delete?id=<?php echo $product["id"]?>">Xoa</a>
                        </td>
                    </tr>
                    <?php }?>
                    </tr>
                </tbody>
            </div>
        </table>
        <div id="tblProduct">....................</div>
        <div id="show_more"> Show_more</div>

    </div>

</body>

</html>