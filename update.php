<?php
$conn = mysqli_connect("localhost", "root", "", "junior");
if (!$conn) {
  die("no connection");
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $user_id = $_GET["id"];
  $query = "SELECT * FROM users WHERE id=" . $user_id;
  $result = $conn->query($query);
  $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_id = $_POST["user_id"];
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $position = $_POST["position"];
  $gender = $_POST["gender"];

  $query = "UPDATE users SET first_name=?, last_name=?, position=?, gender=? WHERE id=?;";
  $stmt = mysqli_prepare($conn, $query);

  $stmt->bind_param("sssii", $first_name, $last_name, $position, $gender, $user_id);

  $stmt->execute();
  $stmt->close();
  header("Location: index.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update User</title>
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
                        <a class="nav-link" href="./create.php">Create User</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="card mt-3 mx-3 p-3">
        <form method="POST" action="update.php" enctype="multipart/form-data">
            <?php if (isset($user)) { ?>
                
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user["first_name"]; ?>" />
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user["last_name"]; ?>" />
                </div>
                <div class="form-group">
                    <label for="position">Position</label>
                    <select class="form-control" id="position" name="position">
                        <option value="Junior" <?php echo ($user["position"] == 'junior') ? 'selected' : ''; ?>>Junior</option>
                        <option value="Bureau" <?php echo ($user["position"] == 'bureau') ? 'selected' : ''; ?>>Bureau</option>
                        <option value="Senior" <?php echo ($user["position"] == 'senior') ? 'selected' : ''; ?>>Senior</option>
                        <option value="Alumini" <?php echo ($user["position"] == 'alumini') ? 'selected' : ''; ?>>Alumini</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="0" <?php echo ($user["gender"] == 0) ? 'selected' : ''; ?>>Male</option>
                        <option value="1" <?php echo ($user["gender"] == 1) ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
                <input type="hidden" name="user_id" value="<?php echo $user["id"]; ?>" />
                <button type="submit" class="btn btn-primary mt-3">Update User</button>
                
            <?php }  ?>
                
        </form>
    </div>
</body>

</html>