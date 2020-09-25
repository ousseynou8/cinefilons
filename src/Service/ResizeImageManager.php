<?php

namespace App\Service;

use App\Model\Picture;

/**
 * Description of CropImageManager
 *
 * @author cevantime
 */
class ResizeImageManager
{

    private $cacheFolder;

    public function __construct($cacheFolder)
    {
        $this->cacheFolder = $cacheFolder;
    }

    public function imageresize($src, $width, $height = null, $crop = true)
    {
        $remote = true;

        //verification qu'on charge bien une image
//        $mimes_allowed = array('image/jpeg', 'image/gif', 'image/png');
//
//        if (!in_array(mime_content_type($src), $mimes_allowed)) {
//            return $src;
//        }


        $pict = new Picture();

        //emplacement de mise en cache
        $filename = $pict->makeFilename( $width . 'x' . $height . (($crop) ? '.crop.' : '.') . $src);
        $searchfilename = $this->cacheFolder. DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($searchfilename)) {
            $pict->init(array('filename' => $src, 'remote' => $remote));
            if (!$pict->getWidth()) {
                return $src;
            }
            if ($crop)
                $pict->cropTo($width, $height);
            else
                $pict->dimensionTo($width, $height);

            $pict->toFile($searchfilename, $quality = 90);
        }

        $src = $this->cacheFolder . DIRECTORY_SEPARATOR . $filename;

        return $src;
    }

    /**
     * @return mixed
     */
    public function getCacheFolder()
    {
        return $this->cacheFolder;
    }

    /**
     * @param mixed $cacheFolder
     */
    public function setCacheFolder($cacheFolder): void
    {
        $this->cacheFolder = $cacheFolder;
    }
}