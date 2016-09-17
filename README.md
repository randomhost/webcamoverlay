[![Build Status][0]][1]

randomhost/webcamoverlay
========================

This package was developed to compensate for the lack of image overlay
capabilities of some less sophisticated IP cameras. It takes the original image
as uploaded by the camera from the web server and uses the GD library to modify
the image on the fly before displaying it to the website visitor.

**Features:**

- picture watermarking with configurable image positions
- text watermarking (original image "modified" date + freely configurable text)
- configurable timed overlay image ("downtime" picture)

Usage
-----

A basic approach at using this package could look like this:

```php
<?php
namespace randomhost\Image\Webcam;

require_once '/path/to/vendor/autoload.php';

// get WebcamOverlay instance
$overlay = new Overlay();

// set basic webcam image properties
$overlay->setWebcamImagePath('webcam.jpg');

// render image
$overlay->render();
```

This will instantiate the class, set the name of the uploaded webcam image and
just render it without any overlay.

Assuming that you named this file `webcam.php`, you should now be able to
access your webcam image at `http://example.com/webcam.php`

A more detailed example can be found in `src/www/webcam/index.php`.

License
-------

See LICENSE.txt for full license details.

[0]: https://travis-ci.org/randomhost/webcamoverlay.svg
[1]: https://travis-ci.org/randomhost/webcamoverlay
