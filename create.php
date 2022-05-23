<?php
require 'db.php';
$message = '';
if (isset ($_POST['name'])  && isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['national_id'])&& isset($_POST['house_kind'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $national_id = $_POST['national_id'];
  $house_kind = $_POST['house_kind'];
  $sql = 'INSERT INTO tenant(name, email,phone_number,national_id,house_kind) VALUES(:name, :email,:phone_number,:national_id,:house_kind)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email, ':phone_number' => $phone_number, ':national_id' => $national_id,':house_kind' => $house_kind])) {
    $message = 'data inserted successfully';
  }
}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Add Tenants</h2>
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
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">phone_number</label>
          <input type="phone_number" name="phone_number" id="phone_number" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">national_id</label>
          <input type="national_id" name="national_id" id="national_id" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">house_kind</label>
          <input type="house_kind" name="house_kind" id="house_kind" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Add Tenant</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>
