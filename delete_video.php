<?php
require_once 'conn.php';

if (isset($_POST['delete'])) {
    $video_id = $_POST['video_id'];

    // Perform the deletion of the video entry in the database
    mysqli_query($conn, "DELETE FROM `video` WHERE `video_id` = '$video_id'") or die(mysqli_error());

    // Additional actions after deletion, such as deleting the corresponding file from the server

    // Redirect to the index.php page or any other desired location
    header("Location: index.php");
    exit();
}
?>
