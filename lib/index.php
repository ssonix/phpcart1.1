<?php
include ('../template/head.php');
?>


<div class="container table-bordered">
    <h1 class="header">Wybierz telefon:</h1>
    <p></p>
    <div class="row">
        <?php
        $query = "SELECT * FROM `products` ORDER BY id ASC";
        $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="col-md-4 col-sm-6">
                    <form method="post" >
                        <div>
                            <img src="../img/<?php echo $row["photo"]; ?>" class="photos">

                            <h5 class="text-info"><?php echo $row["name"] ?></h5>
                            <h5 class="text-danger"><?php echo $row["price"] ?></h5>
                            <input type="text" name="quantity" class="form-control" value="1">
                            <p></p>
                            <input type="submit" name="add" class="btn btn-info" value="Dodaj do koszyka">
<!--                            hidden-->
                            <input type="hidden" name="hidden_name" value="<?php echo $row["name"] ?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"] ?>">
                            <input type="hidden" name="hidden_id" value="<?php echo $row["id"] ?>">
                        </div>
                    </form>
                </div>
            <?php
            }
        }

             ?>
    </div>

    <?php

    if(isset($_POST['add'])){
        $sql = "INSERT INTO `cart_products` (`product_id`, `quantity`, `price`)
      VALUES(" . intval($_POST["hidden_id"]) . ", " . intval($_POST["quantity"]) . ", " . intval($_POST["hidden_price"]) . ")";
        $result = mysqli_query($db, $sql);
    };
    var_dump($_POST)


    ?>














<?php
include ('../template/footer.php');
?>
