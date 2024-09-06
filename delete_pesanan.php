<?php
include_once 'koneksi.php';

// Make sure it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the request
    $id = $_POST['id'];

    // Delete the record from the database
    $query_delete = "DELETE FROM pesanan WHERE id = $id";
    $result_delete = mysqli_query($koneksi, $query_delete);

    if ($result_delete) {
        // Return success response (you can customize the response as needed)
        echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully.']);
    } else {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => 'Error deleting record.']);
    }

    // Close the database connection
    mysqli_close($koneksi);
} else {
    // If it's not a POST request, return an error response
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
