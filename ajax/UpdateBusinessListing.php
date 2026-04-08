<?php
include '../config/connection.php';

$action = $_POST['action'] ?? '';

if ($action == 'update_business') {
    try {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $id = $_POST['id'] ?? '';

        if ($id) {
            $stmt = $conn->prepare("UPDATE businesses SET name=?, address=?, phone=?, email=? WHERE id=?");
            $stmt->bind_param("ssssi", $name, $address, $phone, $email, $id);
        }
        $stmt->execute();
        echo json_encode(['status' => true, 'message' => 'Record update successfully!']);
    } catch (Exception $e) {
        $errorMsg = $e->getMessage();
        echo json_encode(['status' => false, 'message' => $errorMsg]);
    }
}