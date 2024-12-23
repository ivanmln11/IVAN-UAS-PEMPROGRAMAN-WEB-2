<?php
session_start();
include 'koneksi.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die('Unauthorized access');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    // Sanitize input
    $value = $conn->real_escape_string($value);

    // Update query
    $query = "UPDATE tb_pelanggan SET $field = '$value' WHERE id_pelanggan = $id";
    if ($conn->query($query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>