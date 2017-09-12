<?php
include ('lib/connectdatabase.php');
include ('template/head.php');
?>

    <div>
        <?php
        var_dump($_SESSION['cart_id']);
        if (isset($_SESSION['user_id'])) ; ?>
        <p>Witaj<strong><?php echo $_SESSION['user_id'] ?></strong></p>
    </div>



    <div class="container" id="ordertable">
<table class="table">
  <thead>
    <tr>
      <th>Numer zamowienia</th>
      <th>Produkt</th>
      <th>ilość</th>
      <th>cena</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $query= "SELECT order_products.product_id, order_products.order_id, products.name, order_products.quantity, order_products.price
FROM order_products, products
WHERE product_id= products.id";
  $result = mysqli_query($db, $query);
//  var_dump($result);?>
  <?php if (mysqli_num_rows($result) > 0) :?>
      <?php while ($row = mysqli_fetch_array($result)) : ?>
          <tr>
              <td><?php echo $row["order_id"] ?></td>
              <td><?php echo $row["name"] ?></td>
              <td><?php echo $row["quantity"] ?></td>
              <td><?php echo $row["price"] ?></td>
          </tr>
      <?php endwhile; ?>
  <?php endif; ?>
  </tbody>
</table>
    </div>

   <button> <a href="index.php" class="btn btn-sucess">Wróć do strony głównej</a></button>

<?php
include ('template/footer.php');