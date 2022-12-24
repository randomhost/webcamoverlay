[![Build Status][1]][2]

# randomhost/webcamoverlay

<!-- TOC -->
* [1. Purpose](#1-purpose)
* [2. Example](#2-example)
* [3. Usage](#3-usage)
* [4. License](#4-license)
<!-- TOC -->

## 1. Purpose

This package was developed to compensate for the lack of image overlay
capabilities of some less sophisticated IP cameras. It takes the original image
as uploaded by the camera from the web server and uses the GD library to modify
the image on the fly before displaying it to the website visitor.

**Features:**

- picture watermarking with configurable image positions
- text watermarking (original image "modified" date + freely configurable text)
- configurable timed overlay image ("downtime" picture)
- image scaling

## 2. Example

| Original Image       | Modified Image       |
|----------------------|----------------------|
| ![Original Image][3] | ![Modified Image][4] |

## 3. Usage

A basic approach at using this package could look like this:

```php
<?php

declare(strict_types=1);

use \randomhost\Image\Webcam\Overlay;

require_once '/path/to/vendor/autoload.php';

$overlay = new Overlay();
$overlay->setWebcamImagePath('webcam.jpg');
$overlay->render();
```

This will instantiate the class, set the name of the uploaded webcam image and
just render it without any overlay.

Assuming that you named this file `webcam.php`, you should now be able to
access your webcam image at `https://example.com/webcam.php`

A more detailed example can be found in [`src/www/index.php`](src/www/index.php).

## 4. License

See LICENSE.txt for full license details.


[1]: https://github.com/randomhost/webcamoverlay/actions/workflows/php.yml/badge.svg
[2]: https://github.com/randomhost/webcamoverlay/actions/workflows/php.yml
[3]: src/data/webcam.jpg
[4]: src/data/example.png
