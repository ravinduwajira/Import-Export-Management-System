<!DOCTYPE html>
<html>
<head>
    <title>Buyer Request Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
require_once('./../config.php');

// Initialize the variable to store the popup message
$popupMessage = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $requestName = $_POST['requestName'];
    $buyerName = $_POST['buyerName'];
    $contactNo = $_POST['contactNo'];
    $description = $_POST['description'];
    $expectedPrice = $_POST['expectedPrice'];
    $importer_id = $_POST['importer_id'];

    // Perform server-side validation (you can add more validation checks as needed)
    if (empty($requestName) || empty($buyerName) || empty($contactNo) || empty($description) || empty($expectedPrice)) {
        $popupMessage = "Please fill out all required fields.";
    } else {
        // Prepare and execute the database insert query
        $stmt = $conn->prepare("INSERT INTO buyerreq_list (requestName, buyerName, contactNo, description, price, importer_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdi", $requestName, $buyerName, $contactNo, $description, $expectedPrice, $importer_id);

        if ($stmt->execute()) {
            // Insertion was successful
            $popupMessage = "Buyer request successfully added!";
			header("Location: ");
        } else {
            // Insertion failed
            $popupMessage = "Error adding buyer request.";
        }
    }
}
?>
<div class="container-fluid">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="product-form" method="post">
        <input type="hidden" name="importer_id" value="<?= $_settings->userdata('id') ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="requestName" class="control-label">Request Name</label>
                    <input name="requestName" id="requestName" type="text" class="form-control form-control-sm form-control-border" value="<?php echo isset($requestName) ? $requestName : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="buyerName" class="control-label">Buyer Name</label>
                    <input name="buyerName" id="buyerName" type="text" class="form-control form-control-sm form-control-border" value="<?php echo isset($buyerName) ? $buyerName : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="contactNo" class="control-label">Contact Number</label>
                    <input name="contactNo" id="contactNo" type="number" class="form-control form-control-sm form-control-border" value="<?php echo isset($contactNo) ? $contactNo : ''; ?>" required pattern="[0-9]{10}">
                </div>
                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control form-control-sm rounded-0 summernote" required><?php echo isset($description) ? html_entity_decode($description) : ''; ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="expectedPrice" class="control-label">Expected Price</label>
                    <input name="expectedPrice" id="expectedPrice" type="number" step="any" class="form-control form-control-sm form-control-border" value="<?php echo isset($price) ? $price : ''; ?>" required>
                </div>
            </div>
        </div>
   
    </form>
</div>

<!-- Bootstrap Modal for showing the popup message -->
<div class="modal" id="successModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p><?php echo $popupMessage; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="okButton" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#submitBtn").click(function () {
            // Trigger form submission
            $("#product-form").submit();
        });

        <?php if (!empty($popupMessage)) { ?>
            $('#successModal').modal('show');
        <?php } ?>

        // Add event listener to the OK button
        $("#okButton").click(function () {
            // Redirect to the desired URL
            window.location.href = "http://localhost/BIT-GroupProject-BugMinions/?page=buyeerrequest";
        });
    });
</script>
</body>
</html>
