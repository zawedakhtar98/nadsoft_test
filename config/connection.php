<?php
$conn = new mysqli("localhost", "root", "", "business_rating_sys");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>