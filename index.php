<?php
  $db = mysqli_connect("localhost", "nitish", "nitish123", "photos");
  $msg = "";

  if (isset($_POST['upload'])) {

    $image = $_FILES['image']['name'];

    $target = "images/".basename($image);

    $sql = "INSERT INTO images (image) VALUES ('$image')";
    mysqli_query($db, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Done";
    }else{
      $msg = "Nopes";
    }
  }
  $result = mysqli_query($db, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<div id="content">
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='display_img'>";
        echo "<img src='images/".$row['image']."' >";
      echo "</div>";
    }
  ?>


 <form method="POST" action="index.php"  enctype="multipart/form-data">
    <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" name="image">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
       <div>
    </div>
  </div>
  <div>
    <button class="btn-floating btn-large waves-effect waves-light red" type="submit" name="upload">  <i class="material-icons">add</i></button>
    </div>
  </form>
        
</div>
</body>
</html>