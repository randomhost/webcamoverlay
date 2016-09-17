<?php
/**
 * Overlay sample script
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://php-image.random-host.com
 */
namespace randomhost\Image\Webcam;

require_once realpath(__DIR__ . '/../../vendor') . '/autoload.php';

$dataDirPath = realpath(__DIR__ . '/../data');

// get Overlay instance
$overlay = new Overlay();

// set basic webcam image properties
$overlay
    ->setWebcamImagePath($dataDirPath . '/webcam.jpg')
    ->setOutputImageScale(80);

// set watermark properties
$overlay
    ->setWatermarkEnabled(true)
    ->setWatermarkImagePath($dataDirPath . '/watermark.png')
    ->setWatermarkImagePosition('topright');

// set downtime properties
$overlay
    ->setDowntimeEnabled(true)
    ->setDowntimeImagePath($dataDirPath . '/offline.png')
    ->setDowntimeImagePosition('center')
    ->setDowntimeStart('02:00:00')
    ->setDowntimeEnd('08:00:00');

// set informational text properties
$overlay
    ->setInfoTextEnabled(true)
    ->setInfoTextContent(' © example.com')
    ->setInfoTextFont($dataDirPath . '/vera.ttf')
    ->setInfoTextFontSize(9)
    ->setInfoTextPositionX(3)
    ->setInfoTextPositionY(188)
    ->setInfoTextColor(array(255, 255, 255))
    ->setInfoTextBorderEnabled(true)
    ->setInfoTextBorderColor(array(50, 50, 50));

// render image
$overlay->render();
