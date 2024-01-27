<?php

$conn=mysqli_connect("localhost","root","","junior");
if(!$conn){
  die("no connection");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
  // var_dump($_POST);
  $first_name=$_POST["first_name"];
  $last_name=$_POST["last_name"];
  $position=$_POST["position"];
  $gender=$_POST["gender"];
  $query="INSERT INTO users(first_name,last_name,position,gender) VALUES (?, ?, ?, ?);";
  $stmt= mysqli_prepare($conn,$query);
  $stmt->bind_param("sssi",$first_name,$last_name,$position,$gender);
  $stmt->execute();
  $stmt->close();
  header("Location: index.php");
  exit();


}


// $result=$conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <style>
    td,
    th {
      vertical-align: middle;
      text-align: center;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">User Management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./index.php">All Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./create.php">Create User</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="card mt-3 mx-3 p-3">
    <form method="POST" action="create.php" enctype="multipart/form-data"> 
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" />
      </div>
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" />
      </div>
      <div class="form-group">
        <label for="position">Position</label>
        <select class="form-control" name="position" id="position">
          <option value="Junior">Junior</option>
          <option value="Senior">Senior</option>
          <option value="Bureau">Bureau</option>
          <option value="Alumini">Alumini</option>
        </select>
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select class="form-control" name="gender" id="gender">
          <option value="0">Male</option>
          <option value="1">Female</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Add User</button>
    </form>
  </div>
</body>

</html>