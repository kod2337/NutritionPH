<?php
// Script to copy the PNG files to JPG files

// Define source and destination file paths
$files = [
    'uploaded_img/applejuice.png' => 'uploaded_img/applejuice.jpg',
    'uploaded_img/orangejuice.png' => 'uploaded_img/orangejuice.jpg',
    'uploaded_img/calamansijuice.png' => 'uploaded_img/calamansijuice.jpg'
];

// Copy each file
foreach ($files as $source => $destination) {
    if (file_exists($source)) {
        if (copy($source, $destination)) {
            echo "Successfully copied $source to $destination<br>";
        } else {
            echo "Failed to copy $source to $destination<br>";
        }
    } else {
        echo "Source file $source does not exist<br>";
    }
}

echo "Done!";
?> 