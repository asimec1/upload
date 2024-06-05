
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>PRIJENOS DATOTEKE</title>
  </head>
  <style>
	body { margin: 10px;}
    
	h1 { font-size:24px;  }

    hr { border: 1px solid green; }
  </style>
<body>
<div class="container">
	<h1>PRIJENOS DATOTEKE</h1>
	<?php 
    session_start();
    include("config.php");

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }

    print '
    
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:*</label>
                <input class="form-control" type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Choose your file:*</label>
                <input class="form-control" type="file" name="image_doc" id="image_doc" required>
                <small id="emailHelp" class="form-text text-muted">Upload your file.</small>
            </div>
            <div class="form-group">
                <input class="btn btn-primary mb-2" type="submit" value="Prenesi" name="submit">
            </div>
        </form>';


        echo '
        <div class="container">
            <h2 class="alert alert-info">Galerija slika</h2>
            <div class="row">';
                $query  = "SELECT gallery_name, gallery_title FROM gallery order by id desc";
                $result = @mysqli_query($MySQL, $query);
                while($row = @mysqli_fetch_array($result)) {
                    echo '
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="images/'. $row['gallery_name'] .'" title="'. $row['gallery_title'] .'" alt="'. $row['gallery_title'] .'" style="width:100%">
                        </div>
                    </div>';
                }
            echo '
            </div>
        </div>';
	   
	 ?>
</div>
</body>
</html>
