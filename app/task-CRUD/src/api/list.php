<?php
include('DB.php');
$database = new Database();
$connect = $database->getConnection();
$query = "SELECT * FROM student ORDER BY id DESC";
$statement = $connect->prepare($query);
$data = [];
if($statement->execute()) {
  while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
  }
}
echo json_encode($data);
?>
