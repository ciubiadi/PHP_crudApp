<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Crud Application</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
  <?php require_once 'scripts.php'; ?>

  <?php 
    if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">
      <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>
    </div>
     
  <?php endif ?>
  
  <div class="container">
  <?php 
  
    $mysqli = new mysqli('localhost', 'root', '', 'php_crudapp') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM car");

  ?>

  <div class="row justify-content-center">
    <table class="table">
        <thead>
          <tr>
            <th>Car Brand</th>
            <th>Car Model</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['brand']; ?></td>
            <td><?php echo $row['model']; ?></td>
          <td>
              <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-info">Edit</a>
              <a href="index.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
    </table>
  </div>

  <?php 
  
  

  ?>

  <div class="row justify-content-center">
  <form action="scripts.php" method="POST">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <div class="form-group">
          <label for="carBrand">Car Brand</label>
          <input type="text" name="brand" id="brand" class="form-control" value="<?php echo $brand; ?>" placeholder="Enter car's brand"/>
        </div>
        <div class="form-group">
          <label for="carModel">Car Model</label>
          <input type="text" name="model" id="model" class="form-control" value="<?= $model; ?>" placeholder="Enter car's model">
        </div>
        <div class="form-group">
            <?php 
            
              if($update == true):

            ?>
          <button type="submit" name="update" class="btn btn-info">Update</button>
          <?php else: ?>
          <button type="submit" name="save" class="btn btn-primary">Save</button>
          <?php endif; ?>
        </div>
      </form>
  </div>
</div>
</body>
</html>