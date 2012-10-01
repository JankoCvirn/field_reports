<?php

$target_path  = "/var/www/html/signature/";
$target_path = $target_path . basename( $_FILES['file']['name']);
if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
 echo "The file ".  basename( $_FILES['file']['name']).
 " has been uploaded";
} else{
 	
 $target_path="./";
 $target_path = $target_path . basename( $_FILES['file']['name']);
 	move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
 echo "There was an error uploading the file to main storage!";
}

?>
