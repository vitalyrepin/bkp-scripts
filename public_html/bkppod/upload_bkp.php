<?php

$target_dir = "HOME/bkppod/";
$target_path = $target_dir . basename( $_FILES['uploadedfile']['name']);

echo "Source=" .        $_FILES['uploadedfile']['name'] . "\n";
echo "Target path=" .   $target_path . "\n";
echo "Size=" .          $_FILES['uploadedfile']['size'] . "\n";
echo "Tmp name=" .    $_FILES['uploadedfile']['tmp_name'] . "\n";


if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    $files = glob($target_dir . "/*"); // get all file names
    foreach($files as $file){
    if(is_file($file))
       if(realpath($file) != realpath($target_path)) {
	  echo "Unlinking file " . $file . "\n";
          unlink($file);
       }
    }
    echo "The file ".  basename( $_FILES['uploadedfile']['name']).
    " has been uploaded\n";
} else{
    echo "There was an error uploading the file, please try again!\n";
}

echo "==============================\n"
?>

