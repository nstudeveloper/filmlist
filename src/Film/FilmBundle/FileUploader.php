<?php

namespace Film\FilmBundle;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file, $imageDir)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        if ($this->isExist($fileName, $imageDir)) {
            throw new Exception('Image with this name already exist');
        }

        $file->move($this->targetDir, $fileName);
        return $fileName;
    }

    public function isExist($fileName, $imageDir)
    {
        // check if the file exists
        if (is_file($imageDir . '/' . $fileName)) {
            return true;
        }

        return false;
    }
}