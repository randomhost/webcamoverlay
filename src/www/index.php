<?php
/**
 * Overlay sample script.
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2022 Random-Host.tv
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD License (3 Clause)
 *
 * @see https://github.random-host.tv
 */

declare(strict_types=1);

use randomhost\Image\Webcam\Overlay;

require_once realpath(__DIR__.'/../../vendor').'/autoload.php';

$dataDirPath = realpath(__DIR__.'/../data');

// get Overlay instance
$overlay = new Overlay();

// set basic webcam image properties
$overlay
    ->setWebcamImagePath($dataDirPath.'/webcam.jpg')
    ->setOutputImageScale(80)
;

// set watermark properties
$overlay
    ->setWatermarkEnabled(true)
    ->setWatermarkImagePath($dataDirPath.'/watermark.png')
    ->setWatermarkImagePosition(Overlay::IMAGE_TOP_RIGHT)
;

// set downtime properties
$overlay
    ->setDowntimeEnabled(true)
    ->setDowntimeImagePath($dataDirPath.'/offline.png')
    ->setDowntimeImagePosition(Overlay::IMG_CENTER)
    ->setDowntimeStart('02:00:00')
    ->setDowntimeEnd('08:00:00')
;

// set informational text properties
$overlay
    ->setInfoTextEnabled(true)
    ->setInfoTextContent(' © example.com')
    ->setInfoTextFont($dataDirPath.'/vera.ttf')
    ->setInfoTextFontSize(9)
    ->setInfoTextPositionX(3)
    ->setInfoTextPositionY(188)
    ->setInfoTextColor([0xFF, 0xFF, 0xFF])
    ->setInfoTextBorderEnabled(true)
    ->setInfoTextBorderColor([50, 50, 50])
;

// render image
$overlay->render();
