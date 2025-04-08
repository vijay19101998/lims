<?php
// Include the QR code library
include "vendor/phpqrcode/qrlib.php";

// Data for the QR code
$data = "... uhfvu ...";

// Generate a unique filename for the QR code image
$filename = uniqid() . ".png";

// Directory to save the QR code image
$saveDirectory = "qrcode/";

// Ensure that the directory exists, create it if necessary
if (!is_dir($saveDirectory)) {
    mkdir($saveDirectory, 0777, true);
}

// Path to save the QR code image on the local machine
$savePath = $saveDirectory . $filename;

// Generate and save the QR code image to the local machine
QRcode::png($data, $savePath, QR_ECLEVEL_H, 10);

// Check if the QR code image was successfully generated and saved
if (file_exists($savePath)) {
    echo "QR code saved as: " . $savePath;
//    echo ' <img src="/qrcode/picture.jpg">';
} else {
    echo "Failed to generate and save the QR code.";
}


?>