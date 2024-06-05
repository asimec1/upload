<?php
    include("config.php");
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ext = strtolower(strrchr($_FILES['image_doc']['name'], "."));
        $picture = $_POST['title'] . '-' . rand(1,80).$ext;
                
        if(isset($_POST["submit"])) {

            $check = getimagesize($_FILES["image_doc"]["tmp_name"]);
            if ($_FILES["image_doc"]["size"] > 10000000) {
                echo "<p>Document is too big</p>";
            }

            if($check !== false) {
                $_SESSION['message'] = "
                <div id='hide'>
                    <h1 class='alert alert-success'>File Successfully Uploaded!</h1>

                    <p><b>Document: </b>" . $check["mime"] . ".</p>
                    <p><b>File to be uploaded: </b>" . $picture . "</p>
                    <p><b>Type: </b>" . $_FILES["image_doc"]["type"] . "</p>
                    <p><b>File Size: </b>" . $_FILES["image_doc"]["size"]/1024 . "</p>
                    <p><b>Store in: </b>" . $_FILES["image_doc"]["tmp_name"] . "</p>
                </div>
                <hr>";

                copy($_FILES['image_doc']['tmp_name'], "images/" . $picture);

                $query  = "INSERT INTO gallery (gallery_title, gallery_name) VALUES ('" . $_POST['title'] . "', '" . $picture . "')"; 
                $result = @mysqli_query($MySQL, $query);
            
            } 
        }
        header("Location: index.php");
    } else {
        echo "<h1 class='alert alert-danger'>Hack!</h1>";
    }
?>