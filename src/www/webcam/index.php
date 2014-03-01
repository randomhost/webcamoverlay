<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * WebcamOverlay sample script
 *
 * PHP version 5
 *
 * @category  Image
 * @package   PHP_Webcam_Overlay
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      https://pear.random-host.com/
 */
namespace randomhost\Image;

/**
 * Dependencies:
 */
require 'psr0.autoloader.php';

// get WebcamOverlay instance
$overlay = new WebcamOverlay();

// set basic webcam image properties
$overlay
    ->setWebcamImagePath('webcam.jpg')
    ->setOutputImageScale(75);

// set watermark properties
$overlay
    ->enableWatermark(true)
    ->setWatermarkImagePath('watermark.png')
    ->setWatermarkImagePosition('topright');

// set downtime properties
$overlay
    ->enableDowntime(true)
    ->setDowntimeImagePath('offline.png')
    ->setDowntimeImagePosition('center')
    ->setDowntimeStart('20:00:00')
    ->setDowntimeEnd('08:00:00');

// set informational text properties
$overlay
    ->enableInfotext(true)
    ->setInfotextContent(' (c) example.com')
    ->setInfotextFont('vera.ttf')
    ->setInfotextFontSize(9)
    ->setInfotextPositionX(3)
    ->setInfotextPositionY(178)
    ->setInfotextColor(array(255, 255, 255))
    ->enableInfotextBorder(true)
    ->setInfotextBorderColor(array(50, 50, 50));

// render image
$overlay->render();
