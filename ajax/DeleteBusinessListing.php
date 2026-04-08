<?php
include '../config/connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM businesses WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Something went wrong!'
        ]);
        exit;
    }
    $stmt->close();
    echo json_encode([
        'status' => true,
        'message' => 'Record deleted successfully!'
    ]);
    exit;
}
