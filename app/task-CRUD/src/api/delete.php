<?php
include('DB.php');
$database = new Database();
$connect = $database->getConnection();
$message = '';
$data = json_decode(file_get_contents("php://input"));
$id = htmlspecialchars(strip_tags($data->id));
$query = "DELETE FROM student WHERE id = :id";
$statement = $connect->prepare($query);
$statement->bindParam(':id', $id);
if($statement->execute()) {
  $message = 'Данные удалены';
} else {
  $message = 'Ошибка';
}
echo json_encode(['message' => $message]);
?>
