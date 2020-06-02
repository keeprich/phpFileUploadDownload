<?php

// connecting to database

$connectionToDb = mysqli_connect('localhost', 'keeprich', 'keeprich', 'phpFileUploadDownload');

// getting all data from the database

$sql = "SELECT * FROM fileUploads";

$result = mysqli_query($connectionToDb, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

if(isset($_POST['save'])){
    // echo 'all connected';

    $dowmloads = 0;

    $filename = $_FILES['myfile']['name'];

    $destination = 'uploads/'.$filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $_FILES['myfile']['tmp_name'];

    $size = $_FILES['myfile']['size'];

    $fileExtensions= array("zip", "pdf", "jpeg","jpg","png");


    if(!in_array($extension, $fileExtensions)) {
        echo 'Your file extention must ne .zip, .pdf or .png';
    }elseif($_FILES['myfile']['size'] > 5000000) {
        echo 'File size too large';
    }else {
        if(move_uploaded_file($file, $destination)) {


            $sql = "INSERT INTO fileUploads (name, size, downloads)
VALUES ('$filename', '$size', '$dowmloads')";


            if (mysqli_query($connectionToDb, $sql)){
                echo 'File uploaded successfully';
            }else{
                // echo 'File failed to upload';
                echo "Error: " . $sql . "<br>" . mysqli_error($connectionToDb);

            }

        }
    }

}



if(isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    $sql = "SELECT * FROM fileUploads WHERE id=$id";

    $result = mysqli_query($connectionToDb, $sql);

    $file = mysqli_fetch_assoc($result);


    $filePath = 'uploads/' .$file['name'];


    // checking if file exist before downloading

    if(file_exists($filePath)) {
        header( 'Content-Type: application/octet-stream' );
        header( 'Content-Description: File Transfere' );
        header( 'Content-Disposition: attachment; filename=' .basename($filePath) );
        header( 'Expires: 0' );
        header( 'Cache-Control: must-revalidate' );
        header( 'Pragma: Public' );
        header( 'Content-Lenght:' . filesize('uploads/'.$file['name']) );

        readfile('uploads/' . $file['name']);

        $newCount = $file['downloads'] + 1;

        $updateQuery = "UPDATE fileUploads  SET downloads=$newCount WHERE id=$id";

        mysqli_query($connectionToDb, $$updateQuery);

        exit;

    }
}

?>