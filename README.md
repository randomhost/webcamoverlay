PHP_Webcam_Overlay
==================

This package was developed to compensate for the lack of image overlay
capabilities of some less sophisticated IP cameras. It takes the original image
as uploaded by the camera from the web server and uses the GD library to modify
the image on the fly before displaying it to the website visitor.

**Features:**

- picture watermarking with configurable image positions
- text watermarking (original image "modified" date + freely configurable text)
- configurable timed overlay image ("downtime" picture)
- Yahoo Weather API integration

System-Wide Installation
------------------------

PHP_Webcam_Overlay should be installed using the [PEAR Installer](http://pear.php.net).
This installer is the PHP community's de-facto standard for installing PHP
components.

    sudo pear channel-discover pear.random-host.com
    sudo pear install --alldeps randomhost/PHP_Webcam_Overlay

As A Dependency On Your Component
---------------------------------

If you are creating a component that relies on PHP_Webcam_Overlay, please make
sure that you add PHP_Webcam_Overlay to your component's package.xml file:

```xml
<dependencies>
  <required>
    <package>
      <name>PHP_Webcam_Overlay</name>
      <channel>pear.random-host.com</channel>
      <min>1.0.0</min>
      <max>1.999.9999</max>
    </package>
  </required>
</dependencies>
```

Usage
-----

A basic approach at using this package could look like this:

```php
<?php
namespace randomhost\Image;

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

Development Environment
-----------------------

If you want to patch or enhance this component, you will need to create a
suitable development environment. The easiest way to do that is to install
phix4componentdev:

    # phix4componentdev
    sudo apt-get install php5-xdebug
    sudo apt-get install php5-imagick
    sudo pear channel-discover pear.phix-project.org
    sudo pear -D auto_discover=1 install -Ba phix/phix4componentdev

You can then clone the git repository:

    # PHP_Webcam_Overlay
    git clone https://github.com/Chi-Yu/PHP_Webcam_Overlay.git

Then, install a local copy of this component's dependencies to complete the
development environment:

    # build vendor/ folder
    phing build-vendor

To make life easier for you, common tasks (such as running unit tests,
generating code review analytics, and creating the PEAR package) have been
automated using [phing](http://phing.info).  You'll find the automated steps
inside the build.xml file that ships with the component.

Run the command 'phing' in the component's top-level folder to see the full list
of available automated tasks.

License
-------

See LICENSE.txt for full license details.
