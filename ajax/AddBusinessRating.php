<?php

include '../config/connection.php';

$action = $_POST['action'] ?? '';

if ($action == 'submit_rating') {

        $b_id = $_POST['business_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $rating = $_POST['score'];

        $check = $conn->prepare("SELECT id FROM ratings WHERE business_id=? AND (email=? OR phone=?)");
        $check->bind_param("iss", $b_id, $email, $phone);
        $check->execute();
        $res = $check->get_result();
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $stmt = $conn->prepare("UPDATE ratings SET rating=?, name=? WHERE id=?");
            $stmt->bind_param("dsi", $rating, $name, $row['id']);
        } else {
            $stmt = $conn->prepare("INSERT INTO ratings (business_id, name, email, phone, rating) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isssd", $b_id, $name, $email, $phone, $rating);
        }
        $stmt->execute();
        echo json_encode(['status' => true, 'message' => 'Record save successfully!']);
}
