<?php
    function uploadImage($file, $path) {
        $filename = pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME);
        $ext = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);

        $encryptedFilename = hash('md5', uniqid(time() . $filename));
        $encryptedFilename = $encryptedFilename . '.' . $ext;
        $tempFile = $_FILES[$file]['tmp_name'];
        
        if (move_uploaded_file($tempFile, $path . $encryptedFilename)) 
            return $encryptedFilename;
        
        return false;
    }
?>