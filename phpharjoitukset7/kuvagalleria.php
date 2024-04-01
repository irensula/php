<?php require "header.php"; ?>

<style type="text/css">
.galery-image {
  width: 300px;
}
.gallery-img-div {
  height: 500px;
}

</style>

<body id="galery-body">
  <div class="container">
    <h2 class="title">Kuvagalleria</h2>
    <form action="kuvagalleria.php" method="post" enctype="multipart/form-data">
        Select image to upload:
            <label for="fileToUpload"></label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input class="button-orange" type="submit" value="Upload Image" name="submit">    
    </form>
  </div>


<?php

    //  UPLOADING IMAGES

  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
  
  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

    
    // SHOW IMAGES ON PAGE 

    // Define the directory where your images are stored
    $imageDirectory = 'images/';

    // Get all files in the directory
    $files = scandir($imageDirectory);

    // Remove . and .. from the list
    $files = array_diff($files, array('.', '..'));

    // Loop through each file and display as an image
    foreach ($files as $file) {
        // Check if it's an image file 
        if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif', 'avif'))) {
            echo '<img src="' . $imageDirectory . $file . '" alt="' . $file . '" width="300">';
        }
    }
?>
</body>
</html>
