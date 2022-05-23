<?php
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM tenant WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['national_id'] )&& isset($_POST['house_kind']) ) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $national_id = $_POST['national_id'];
  $house_kind = $_POST['house_kind'];
  $sql = 'UPDATE tenant SET name=?, email=? ,phone_number=? , national_id =? , house_kind =? WHERE id=?';
  $statement = $connection->prepare($sql);
  if (!$statement->execute([$name,$email,$phone_number,$national_id,$house_kind,$id])) {
    
    echo "not updated";
  }else {
    # code...
   header("Location: index.php");
  }

}

 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update Tenants information</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Tenant's Name</label>
          <input value="<?= $person->name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="phone_number">phone_number</label>
          <input type="phone_number" value="<?= $person->phone_number; ?>" name="phone_number" id="phone_number" class="form-control">
        </div>
        <div class="form-group">
          <label for="national_id">national_id</label>
          <input type="national_id" value="<?= $person->national_id; ?>" name="national_id" id="national_id" class="form-control">
        </div>
        <div class="form-group">
          <label for="house_kind">house_kind</label>
          <input type="house_kind" value="<?= $person->house_kind; ?>" name="house_kind" id="house_kind" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Tenant</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
