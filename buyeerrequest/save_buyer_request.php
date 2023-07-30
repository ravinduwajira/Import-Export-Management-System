<?php
require_once('./../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $requestName = $_POST['requestName'];
    $buyerName = $_POST['buyerName'];
    $contactNo = $_POST['contactNo'];
    $description = $_POST['description'];
    $expectedPrice = $_POST['expectedPrice'];

    // File upload logic here (if needed)

    if (!empty($id)) {
        // Update existing record
        $conn->query("UPDATE `buyerreq_list` SET `requestName` = '$requestName', `buyerName` = '$buyerName', `contactNo` = '$contactNo', `description` = '$description', `expectedPrice` = '$expectedPrice' WHERE `id` = '$id'");
        if ($conn->affected_rows > 0) {
            $response = array('status' => 'success', 'message' => 'Buyer Request updated successfully.');
        } else {
            $response = array('status' => 'failed', 'message' => 'Failed to update Buyer Request.');
        }
    } else {
        // Insert new record
        $conn->query("INSERT INTO `buyerreq_list` (`requestName`, `buyerName`, `contactNo`, `description`, `expectedPrice`) VALUES ('$requestName', '$buyerName', '$contactNo', '$description', '$expectedPrice')");
        if ($conn->affected_rows > 0) {
            $response = array('status' => 'success', 'message' => 'Buyer Request added successfully.');
        } else {
            $response = array('status' => 'failed', 'message' => 'Failed to add Buyer Request.');
        }
    }

    echo json_encode($response);
    exit;
}
?>
