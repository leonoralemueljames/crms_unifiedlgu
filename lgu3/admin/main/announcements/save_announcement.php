<?php
include '../../../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the data from the POST request
    $announcementId = isset($_POST['announcementId']) ? intval($_POST['announcementId']) : null;
    $description = $_POST['description'];
    $upload_date = $_POST['upload_date'];

    // Handle file upload
    $photo_url = '';
    if (isset($_FILES['photo_url']) && $_FILES['photo_url']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo_url']['tmp_name'];
        $fileName = $_FILES['photo_url']['name'];
        $fileSize = $_FILES['photo_url']['size'];
        $fileType = $_FILES['photo_url']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Specify the directory where you want to save the uploaded file
        $uploadFileDir = '../../../uploads/';
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension; // Create a unique file name
        $dest_path = $uploadFileDir . $newFileName;

        // Move the file to the destination directory
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $photo_url = $dest_path; // Save the file path to the database
        } else {
            echo json_encode(['success' => false, 'message' => 'There was an error moving the uploaded file.']);
            exit;
        }
    }

    // Check if we are updating or inserting
    if ($announcementId) {
        // Update existing announcement
        $stmt = $conn->prepare("UPDATE system_announcements SET photo_url = ?, description = ?, upload_date = ? WHERE id = ?");
        $stmt->bind_param("sssi", $photo_url, $description, $upload_date, $announcementId);
    } else {
        // Insert new announcement
        $stmt = $conn->prepare("INSERT INTO system_announcements (photo_url, description, upload_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $photo_url, $description, $upload_date);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Announcement saved successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error saving announcement: ' . $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Handle the case where the request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>