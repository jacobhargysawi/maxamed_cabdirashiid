<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Dynamic Images</title>
</head>
<body>
    <h1>Upload an Image</h1>
    <form action="dynamic_images.php" method="POST" enctype="multipart/form-data">
        <label for="image">Choose an image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <button type="submit" name="upload">Upload Image</button>
    </form>

    <?php
    // Directory to store uploaded images
    $uploadDir = "uploads/";

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $imageName = basename($image["name"]);
        $targetFilePath = $uploadDir . $imageName;

        // Create the uploads directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move uploaded file to the target directory
        if (move_uploaded_file($image["tmp_name"], $targetFilePath)) {
            echo "<p>Image uploaded successfully! View it below:</p>";
            echo "<img src='$targetFilePath' alt='Uploaded Image' style='max-width: 300px;'>";
        } else {
            echo "<p>Sorry, there was an error uploading your image.</p>";
        }
    }
    ?>
</body>
</html>
