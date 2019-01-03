<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'testing');
 
/* Attempt to connect to MySQL database */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($connection === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<?php 
if (isset($_POST['submit'])) {
    $preacher_name = $_POST['preacher_name'];
    $sermon_title = $_POST['sermon_title'];
    $sermon_file = $_FILES['image']['name'];
    $sermon_file_temp = $_FILES['image']['tmp_name'];
    $sermon_date = date('d-m-y');
    //image upload function
    move_uploaded_file($sermon_file_temp, "images/$sermon_file");
    
    $query = "INSERT INTO tbl_employee (preacher_name, sermon_file, sermon_title, sermon_date)";
    $query .= "VALUES('{$preacher_name}','{$sermon_file}', '{$sermon_title}', now())";
    $create_post_query = mysqli_query($connection, $query);
    if(!$create_post_query)   {
        die ("QUERY FAILD" . mysqli_error($connection));
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  </head>

<body class="uploadForm">
<div class="container">

  <div class="row">
    <div class="col">
    </div>
    <div class="col">
    <div class ="uploadForm">
    <div class="row" style="padding: 10px 15px 9px;">

    
<form action="" method="post" enctype="multipart/form-data" role="form">
    <h1 class="text-center">Upload Sermon</h1>
    <div class="form-group">
        <input type="text" class="form-control" name="preacher_name" placeholder="Preacher Name">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="sermon_title" placeholder="Sermon Title">
    </div>

   
    <div class="form-group"> 
    <div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-2"> 
    <label>Sermon File</label>
        <input type="file"  name="image" required > 
    </div>
    </div>
    <div class="row text-center" style="padding-left: 20px;padding-right: 20px;">
        <button type="submit"  name="submit" class="btn btn-md btn-block btn btn-dark">Upload</button>
    </div>                                                 
    </div>                                                                                          
</form>
    </div>
    </div>
    </div>
    <div class="col">
    </div>
  </div>
</div>
</body>