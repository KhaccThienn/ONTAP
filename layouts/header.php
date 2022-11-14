<?php
include "connection/connect.php";
$sqlCates = "SELECT * FROM category";
$results = $connect->query($sqlCates);
?>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <a class="navbar-brand" href="#">ONTAP</a>
  <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
  <div class="collapse navbar-collapse" id="collapsibleNavId">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="list.php">Show List Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_product.php">Add Products</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Category ?
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="list.php">
            All Products
          </a>
          <?php foreach ($results as $key => $value) { ?>
            <a class="dropdown-item" href="list.php?category_id=<?= $value['id'] ?>">
              <?= $value['name'] ?>
            </a>
          <?php } ?>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="search.php">
      <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>