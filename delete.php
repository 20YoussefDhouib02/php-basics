<?php
$conn = mysqli_connect("localhost", "root", "", "junior");
if (!$conn) {
    die("no connection");
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $user_id = $_GET["id"];
    $query = "DELETE FROM users WHERE id=" . $user_id;
    $conn->query($query);
}

header("Location: index.php");
exit();
?>
