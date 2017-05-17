<?php
    require "vendor/autoload.php";

    $app = new \Slim\Slim();
    $app->get('/hello',function (){
        echo "hello";
    });

    $app->post('/upload',function (){
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $length = 5;
        $filename = '';
        for($i = 0; $i < $length; $i++)
        {
            $filename.=$chars[mt_rand(0, 36)];
        }
        $allowedExts = array("mp3", "mp4", "wma");

        $target_dir = "uploads/";
        $target_file = $target_dir .$filename.basename($_FILES["fileToUpload"]["name"]);
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
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if(!!!in_array($imageFileType,$allowedExts)){
            echo "Sorry, only video files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            /*$video = $ffmpeg->open($_FILES["fileToUpload"]["tmp_name"]);
            $video
                ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
                ->save('frame.jpg');*/
            var_dump( $_FILES["fileToUpload"]["name"]);
            /*if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }*/
        }
    });

    $app->run();

?>