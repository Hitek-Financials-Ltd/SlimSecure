<?php

namespace Hitek\Slimez\Payments\Core;

use Hitek\Slimez\Payments\Configs\Env;

class FileUploader {
    public static function uploadFile($dirName, $uploadedfiles) {
        // Sanitize the file input
        $file = $uploadedfiles;
        $fileName = Security::kenProtectFunc($file['name']);
        $fileTmpName = $file['tmp_name'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Use MIME type for determining file type for more reliability
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $fileMimeType = $finfo->file($fileTmpName);
        $fileType = self::getExtensionFromMimeType($fileMimeType);

        // Proceed with further processing and return the result
        return self::processFile($dirName, $fileTmpName, $fileName, $fileType);
    }

    private static function processFile($dirName, $fileTmpName, $fileName, $fileType) {
        $allowedImageTypes = Env::SUPPORED_IMAGES;
        $vpnConfigType = 'ovpn';

        if (in_array($fileType, $allowedImageTypes)) {
            return self::convertAndSaveImage($dirName, $fileTmpName, $fileName);
        } elseif ($fileType === $vpnConfigType) {
            return self::saveVpnConfig($dirName, $fileTmpName, $fileName);
        } else {
            echo "Error: Unsupported file type.";
            return false;
        }
    }

    private static function convertAndSaveImage($dirName, $fileTmpName, $fileName) {
        $targetDirectory = dirname(__DIR__)."/public/Images/" . $dirName;
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        $newFileName = pathinfo($fileName, PATHINFO_FILENAME) . ".webp";
        $targetFilePath = $targetDirectory . "/" . $newFileName;
        // Convert the image to webp and return the result
        if (self::convertImageToWebP($fileTmpName, $targetFilePath)) {
            
            echo "Image uploaded successfully.";
            return true;
        } else {
            return false;
        }
    }

    // Additional method to map MIME types to file extensions
    private static function getExtensionFromMimeType($mimeType) {
        $mimeMap = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            // Add more MIME types and corresponding extensions as needed
        ];

        return isset($mimeMap[$mimeType]) ? $mimeMap[$mimeType] : '';
    }

    private static function saveVpnConfig($dirName, $fileTmpName, $fileName) {
        $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . Env::VPN_CONFIGS_DIR;
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        $targetFilePath = $targetDirectory . "/" . $fileName; // Ensure the path is correctly formed
        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            echo "VPN configuration uploaded successfully.";
            return true;
        } else {
            echo "Error: Failed to upload VPN configuration.";
            return false;
        }
    }

    private static function convertImageToWebP($sourceImagePath, $targetImagePath) {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $fileMimeType = $finfo->file($sourceImagePath);
    
        switch ($fileMimeType) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($sourceImagePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($sourceImagePath);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($sourceImagePath);
                break;
            default:
                echo "Error: Unsupported source MIME type for conversion: $fileMimeType";
                return false;
        }
    
        $conversionResult = imagewebp($image, $targetImagePath, 100);
        imagedestroy($image);
    
        return $conversionResult ? true : false;
    }
}
