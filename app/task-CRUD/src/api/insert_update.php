<?php
include('DB.php');
$database = new Database();
$connect = $database->getConnection();
$message = '';
$form_data = json_decode(file_get_contents("php://input"));

if (isset($form_data->id) && $form_data->id == '0') {
  // Вставка новой записи
  $data = array(
    ':firstName' => htmlspecialchars(strip_tags($form_data->firstName)),
    ':LastName' => htmlspecialchars(strip_tags($form_data->LastName)),
    ':Age' => htmlspecialchars(strip_tags($form_data->Age)),
    ':course' => htmlspecialchars(strip_tags($form_data->course))
  );
  $query = "INSERT INTO student (firstName, LastName, Age, course) VALUES (:firstName, :LastName, :Age, :course)";
  $statement = $connect->prepare($query);
  if($statement->execute($data)) {
    $message = 'Data Inserted';
  } else {
    $message = 'Error';
  }
} else {
  // Обновление существующей записи
  $data = array(
    ':firstName' => htmlspecialchars(strip_tags($form_data->firstName)),
    ':LastName' => htmlspecialchars(strip_tags($form_data->LastName)),
    ':Age' => htmlspecialchars(strip_tags($form_data->Age)),
    ':course' => htmlspecialchars(strip_tags($form_data->course)),
    ':id' => htmlspecialchars(strip_tags($form_data->id))
  );
  $query = "UPDATE student SET firstName = :firstName, LastName = :LastName, Age = :Age, course = :course WHERE id = :id";
  $statement = $connect->prepare($query);
  if($statement->execute($data)) {
    $message = 'Data Updated';
  } else {
    $message = 'Error';
  }
}

echo json_encode(['message' => $message]);
?>
