<?php
include('template/head.php');
include('lib/connectdatabase.php');
?>
<!--NAVBAR-->
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Strona główna</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Kontakt<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">O nas <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <!-- Button trigger modal -->
        <button id="cart_icon" type="button" class="btn btn-success" data-toggle="modal" data-target="#modelId">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        </button>
        <form class="form-inline my-2 my-lg-0">
            <a href="lib/logout.php" class="btn btn-primary logout" role="button">Wyloguj</a>
        </form>

    </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelTitleId">Twój koszyk:</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <table class="table table-inverse">
                        <thead>
                        <tr>
                            <th>ID produktu</th>
                            <th>Ilośc</th>
                            <th>cena za szt</th>
                            <th>nazwa</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                            $query = "SELECT cart_products.product_id, cart_products.quantity, cart_products.price, products.name, cart_products.id 
                            FROM cart_products, products WHERE product_id= products.id ORDER BY cart_products.id";
                            $result = mysqli_query($db, $query); ?>
                            <?php if (mysqli_num_rows($result) > 0) :?>
                                <?php while ($row = mysqli_fetch_array($result)) : ?>
                                    <tr>
                                        <td><?php echo $row["product_id"] ?></td>
                                        <td><?php echo $row["quantity"] ?></td>
                                        <td><?php echo $row["price"] ?></td>
                                        <td><?php echo $row["name"] ?></td>
                                       <td>
                                           <form method="post" action="lib/functions/delete_from_cart.php">
                                               <input type="hidden" name="id" value="<?php echo $row["id"] ?>">

                                               <input type="submit" name="delete" class="btn" value="X">
                                           </form>
                                       </td>
                                    </tr>
                                 <?php endwhile; ?>
                             <?php endif; ?>

                        </tbody>
                    </table>
                    <h5>Do zapłaty w sumie:
                        <?php
                        $cart_id = $_SESSION['cart_id'];
                        $query = "SELECT sum(cart_products.quantity*cart_products.price)
                            FROM cart_products WHERE cart_id = $cart_id";
                        $result = mysqli_query($db, $query);
                        $summary = mysqli_fetch_array($result);
//                        print_r($summary);
                        echo $summary[0]; ?> zł</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <form method="post" action="lib/functions/createorder.php">
                        <input type="submit" class="btn btn-info" name="order">
                     </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', event = > {
        var button = $(event.relatedTarget);
    var modal = $(this);
    // Use above variables to manipulate the DOM
    })
    ;
</script>


<div>
    <?php
    var_dump($_SESSION['cart_id']);
    if (isset($_SESSION['user_id'])) ; ?>
    <p>Witaj<strong><?php echo $_SESSION['user_id'] ?></strong></p>
</div>


<div class="container table-bordered" id="cart-tbl">
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
                    <form method="post" action="lib/functions/add_to_cart.php">
                        <div>
                            <img src="img/<?php echo $row["photo"]; ?>" class="photos">
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
</div>

<a href="orderlist.php" class="btn btn-info" id="ordersbutton" role="button">Moje zamówienia</a>


<?php
include('template/footer.php');
?>
