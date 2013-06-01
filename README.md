PHP-Webcam-Overlay
==================

This PHP script was developed to compensate for the lack of image overlay
capabilities of some less sophisticated IP cameras. It takes the original
image as uploaded by the camera from the web server and uses the GD library
to modify the image on the fly before displaying it to the website visitor.

**Features:**

- picture watermarking with configurable image positions
- text watermarking (original image "modified" date + freely configurable text)
- configurable timed overlay image ("downtime" picture)
- Yahoo Weather API integration

Requirements
------------
- PHP 5.3 or newer
- GD
- SimpleXML

Directory structure
-------------------

The script was designed to run outside the document root of the webserver
so internal files are kept away from the public. Otherwise, someone could
guess the filename of your webcam image and simply open that directly without
any overlay.

All public files are located in the `htdocs` folder while everything else is
kept one level below. In this documentation, we assume the document root to
be the `htdocs` folder and the directory structure to be the same as in the
original setup.

- **fonts** - holds .ttf files of the fonts you want to use for text overlays
- **htdocs** - holds all files which should be accessible from outside
- **images** - holds the uploaded webcam image, overlay and downtime images
- **include** - holds all internal PHP class files used by this script

Usage
-----

A basic approach at using this script could look like this:

```php
<?php
require_once( '../include/class/WebcamOverlay.class.php' );

// get WebcamOverlay instance
$overlay = new WebcamOverlay();

// set basic webcam image properties
$overlay->setWebcamImagePath( 'webcam.jpg' );

// render image
$overlay->render();
```
    
This will instanciate the class, set the name of the uploaded webcam image and
just render it without any overlay.

Assuming that you named this file `overlay.php`, you should now be able to
access your webcam image at `http://example.com/overlay.php`


Advanced Usage
--------------

Take a look at the provided `overlay.php` file which comes with an advanced
example configuration including all available options.

The `htdocs` folder contains a `.htaccess` file which shows how one could write
a rewrite rule (assuming that you are running *apache2* with *mod_rewrite* enabled)
which makes the webcam image avaiblable at `http://example.com/image.png`.

License
-------

<pre>
Copyright (c) 2013 random-host.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
</pre>
