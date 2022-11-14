<?php
include "connection/connect.php";
$errors = [];

$sqlCate = "SELECT * FROM category";
$categories = $connect->query($sqlCate);

$id = isset($_GET['id']) ? $_GET['id'] : false;

$sqlOld = "SELECT * FROM product WHERE id = '$id'";
$result = $connect->query($sqlOld);
$row = $result->fetch_assoc();

if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $category_id = $_POST['category_id'];
  $desscription = $_POST['desscription'];
  $status = $_POST['status'];

  if (empty($name) && empty($price)) {
    $errors['required'] = "All Fields are Required !";
  }

  if (empty($name)) {
    $errors['name_required'] = "Name is Required !";
  }

  if (empty($price)) {
    $errors['price_required'] = "Price is Required !";
  } elseif (!is_numeric($price)) {
    $errors['price_invalid'] = "Price must be number!";
  }

  if (!empty($_FILES['image']['name'])) {
    $file = $_FILES['image'];
    $file_name = time().$file['name'];
    move_uploaded_file($file['tmp_name'], "uploads/".$file_name);
    unlink("uploads/".$row['image']);
  } else {
    $file_name = $row['image'];
  }

  if (!$errors) {
    $sql = "UPDATE product SET name = '$name', image = '$file_name', price = $price, category_id = $category_id, desscription = '$desscription', status = $status WHERE id = '$id'";

    $query = $connect->query($sql);

    if (!$query) {
      $errors['invalid_query'] = "Invalid Query";
    }

    header('location: list.php');
    exit;
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Update Product Page</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php include "layouts/header.php" ?>
  <div class="container-fluid p-5">
    <?php if ($errors) { ?>
      <?php foreach ($errors as $value) { ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
          <strong>
            <?php echo $value ?>
          </strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } ?>

    <?php } ?>

    <div class="header">
      <h3>Update Product: <?= $row['name'] ?></h3>
    </div>
    <hr>
    <form class="main" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-8">
          <div class="card p-4">
            <input type="hidden" name="id" id="name" value="<?= $id ?>">
            <div class="form-group">
              <label for="name">Product's Name</label>
              <input type="text" name="name" class="form-control" placeholder="Product's Name" id="name" value="<?= $row['name'] ?>">
            </div>

            <div class="form-group">
              <label for="desscription">Product's Description</label>
              <textarea name="desscription" id="desscription" cols="40" rows="20" class="form-control" placeholder="Product's Description"><?= $row['desscription'] ?></textarea>
            </div>

          </div>
        </div>
        <div class="col-lg-4">
          <div class="card p-4">

            <div class="form-group">
              <label for="image">Product's Image</label>
              <input type="file" name="image" id="image" class="form-control">
              <div class="image" style="width: 20%;">
                <img src="uploads/<?= $row['image'] ?>" class="card-img" alt="">
              </div>
            </div>

            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" class="form-control" id="price" name="price" placeholder="Product's Price" value="<?= $row['price'] ?>">
            </div>

            <div class="form-group">
              <label for="category_id">Category</label>
              <select name="category_id" id="category_id" class="form-control">
                <?php foreach ($categories as $key => $value) { ?>
                  <?php if ($value['id'] == $row['category_id']) { ?>
                    <option value="<?= $value['id'] ?>" selected>
                      <?= $value['name'] ?> - <?= $value['id'] ?>
                    </option>
                  <?php } else { ?>
                    <option value="<?= $value['id'] ?>">
                      <?= $value['name'] ?> - <?= $value['id'] ?>
                    </option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="status">Status</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="1" id="status1" <?= ($row['status'] == 1) ? 'checked' : '' ?>>
                <label class="form-check-label" for="status1">
                  Show
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="0" id="status2" <?= ($row['status'] == 0) ? 'checked' : '' ?>>
                <label class="form-check-label" for="status2">
                  Hidden
                </label>
              </div>
            </div>

            <button type="submit" name="submit" class="btn btn-outline-dark">ADD</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <?php include "layouts/footer.php" ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>