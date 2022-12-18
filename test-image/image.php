
<?php include_once ('C:\xampp\htdocs\test-json\includes\config.php'); ?>
<?php

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the file information
    $imglink = ['image'];
    $fileName = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $fileError = $_FILES['image']['error'];
    $fileContent = file_get_contents($_FILES['image']['tmp_name']);

    // Set the target directory for the image
    $targetDir = 'C:\xampp\htdocs\test-json\upload\category';

    // Generate a unique file name for the image
    $fileName = uniqid() . '-' . $fileName;

    // Create the full path to the target file
    $filePath = $targetDir . $fileName;

    // Check if the file was successfully uploaded
    if ($fileError === UPLOAD_ERR_OK) {
        // Move the uploaded file to the target directory
        $didUpload = move_uploaded_file($_FILES['image']['tmp_name'], $filePath);

        // Check if the file was successfully moved
        if ($didUpload) {
            // Get the image URL
            $imageUrl = 'http://your-website.com' . $filePath;

            // Do something with the image URL (e.g. store it in a database, display it on the page, etc.)
        } else {
            // Display an error message
            echo 'Error uploading file';
        }
    } else {
        // Display an error message
        echo 'Error uploading file';
    }
    $qry = insert into images values (1, $imglink); 
}


?>
<section class="content">

<form method="post" enctype="multipart/form-data">
    <input type="file" name="image" />
    <input type="submit" name="submit" value="Upload" />
</form>
<!-- Table to display the uploaded images -->
<table>
  <tr>
    <th>Image</th>
  </tr>
  <?php
  // Open the folder
  $folder = opendir('C:\xampp\htdocs\test-json\upload\category');
  // Loop through the files in the folder
  while($file = readdir($folder)){
    // Check if the file is an image
    if(preg_match("/.(gif|jpg|png)$/i", $file)){
      // Display the image in a table cell
      echo "<tr><td><img src='uploads/$file'></td></tr>";
    }
  }
  // Close the folder
  closedir($folder);
  ?>
</table>
</section>





