<?php
//using the class that has been created
use PhpSolutions\File\Upload;

    //set the maximum size in byte
    $max = 51200; //which is equivalent to 50KB (51200 bytes)
    if(isset($_POST['upload'])){
        //define the path to the uploaded path
        $destination = './images/';
        //move the file to the uploaded folder folder and rename it
        //move_uploaded_file($_FILES['image']['tmp_name'], $destination.$_FILES['image']['name']);
        require_once 'PhpSolutions\File\Upload.php';
        
        try {
            $loader = new Upload($destination);
            $loader->setMaxSize($max);
            $loader->allowAllTypes();
            $loader->Upload();
            $result = $loader->getMessages();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta  charset="utf-8">
    <title>Upload File</title>
</head>

<body>
    <?php
        if(isset($result)){
            echo '<ul>';
            foreach ($result as $message) { 
                echo "<li>$message</li>";
            }
            echo '<ul>';
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data" id="uploadImage">
        <p>
            <label for="image">Upload image:</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?= $max; ?>">
            <input type="file"  name="image" id="image">
            
        </p>
        <p>
            <input type="submit" name="upload" id="upload" value="Upload">
        </p>
    </form>
         <!--<form action="" method="POST">
            <p>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </p>
            <p>
                <input type="submit" name="submit" value="Submit">
            </p>
         </form>-->
        <pre>
                  <?php
                        /*if(isset($_POST['upload'])){
                        print_r($_FILES);
                    }*/
                  ?>
        </pre>
</body>
</html>