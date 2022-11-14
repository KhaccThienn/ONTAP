<?php
include "connection/connect.php";
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT product.id, product.name, product.image, product.price, category.name AS 'Category', product.desscription, product.status FROM product JOIN category ON category.id = product.category_id WHERE product.name LIKE '%$search%'";
$result = $connect->query($sql);
?>

<!doctype html>
<html lang="en">

<head>
  <title>List Products Page</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php include "layouts/header.php" ?>
  <div>
    <div class="text-center">
      <h3 class="text-success"> All Result For: '<?= $search ?>' (<?= $result -> num_rows." "."Data returned" ?>) </h3>
    </div>
    <table class="table table-bordered table-dark table-striped table-hover">
      <thead>
        <tr>
          <th>STT</th>
          <th>ID</th>
          <th>Name</th>
          <th>Image</th>
          <th>Price</th>
          <th>Category</th>
          <th>Description</th>
          <th>Status</th>
          <th>Handle Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0) { ?>
          <?php foreach ($result as $key => $value) { ?>
            <tr>
              <th scope="row"><?= $key + 1 ?></th>
              <td><?= $value['id'] ?></td>
              <td><?= $value['name'] ?></td>
              <td style="width: 10%;">
                <img src="uploads/<?= $value['image'] ?>" alt="" class="card-img">
              </td>
              <td>
                <?= '$' . number_format($value['price'], 2, ',', '.') ?>
              </td>
              <td><?= $value['Category'] ?></td>
              <td>
                <?= $value['desscription'] ?>
              </td>
              <td>
                <?= ($value['status'] == 1) ? "Show" : "Hidden" ?>
              </td>
              <td>
                <a href="updateProd.php?id=<?= $value['id'] ?>" class="btn btn-warning">Update</a>
                <a href="deleteProd.php?id=<?= $value['id'] ?>" class="btn btn-danger" onclick="return confirm('Are You Sure ??')">Delete</a>
              </td>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <h1 class="text-danger">0 Data Returned</h1>
        <?php } ?>

      </tbody>
    </table>
  </div>
  <?php include "layouts/footer.php" ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>