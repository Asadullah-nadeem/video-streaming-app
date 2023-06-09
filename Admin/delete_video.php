<?php
require_once 'conn.php';

if (isset($_POST['delete'])) {
    $video_id = $_POST['video_id'];

    // Prepare the delete statement
    $stmt = mysqli_prepare($conn, "DELETE FROM `video` WHERE `video_id` = ?");
    mysqli_stmt_bind_param($stmt, "s", $video_id);

    // Execute the delete statement
    mysqli_stmt_execute($stmt);

    // Check if any rows were affected
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    if ($affected_rows > 0) {
        // Deletion was successful
        echo "Record deleted successfully.";
    } else {
        // No rows were deleted
        echo "No record found for deletion.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Redirect to the index.php page or any other desired location
header("Location: index.php");
exit();
?>
