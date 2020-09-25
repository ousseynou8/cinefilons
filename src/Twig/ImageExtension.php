<?php

namespace App\Twig;

use App\Service\ResizeImageManager;
use Symfony\Component\Asset\Packages;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ImageExtension extends AbstractExtension
{
    private $resizeManager;
    /**
     *
     * @var Packages
     */
    private $packages;

    private $_imagesSize;

    public function __construct(ResizeImageManager $resizeManager, Packages $packages)
    {
        $this->resizeManager = $resizeManager;
        $this->packages = $packages;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('resize', array($this, 'resizeImage')),
            new TwigFunction('image_size', array($this, 'imageSize')),
            new TwigFunction('image_width', array($this, 'imageWidth')),
            new TwigFunction('image_height', array($this, 'imageHeight')),
        ];
    }

    public function resizeImage($src, $width, $height = null, $crop = true)
    {
        return $this->packages->getUrl($this->resizeManager->imageresize($src, $width, $height, $crop));
    }

    public function imageSize($src)
    {
        if(empty($this->_imagesSize[$src])){
            $size =  getimagesize($src);
            $this->_imagesSize[$src] = [
                'width' => $size[0],
                'height' => $size[1]
            ];
        }
        return $this->_imagesSize[$src];
    }

    public function imageWidth($src)
    {
        return $this->imageSize($src)['width'];
    }

    public function imageHeight($src)
    {
        return $this->imageSize($src)['height'];
    }
}
