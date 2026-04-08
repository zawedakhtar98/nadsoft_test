<?php

include('../config/connection.php');

if ($_POST['id']) {
    try {

        $id = $_POST['id'];
        $stmt = $conn->prepare("SELECT * FROM businesses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        echo json_encode(['status'=>true,'data'=>$result->fetch_assoc()]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['status'=>false,'message'=>'Something went wrong!']);
    }
}
