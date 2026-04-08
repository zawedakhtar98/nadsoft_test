<?php
include '../config/connection.php';

$action = $_POST['action'] ?? '';

if ($action == 'save_business') {
    try {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $stmt = $conn->prepare("INSERT INTO businesses (name, address, phone, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $address, $phone, $email);
        $stmt->execute();
        echo json_encode(['status' => true, 'message' => 'Record save successfully!']);
    } catch (Exception $e) {
        $errorMsg = $e->getMessage();
        if (str_contains($errorMsg, 'email')) {
            $msg = "Email already exists!";
        } elseif (str_contains($errorMsg, 'phone')) {
            $msg = "Phone number already exists!";
        } else {
            $msg = "Duplicate entry!";
        }
        echo json_encode(['status' => false, 'message' => $msg]);
    }
}

