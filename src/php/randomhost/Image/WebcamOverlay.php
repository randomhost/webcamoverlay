<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * WebcamOverlay class definition
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
 * Webcam Overlay
 *
 * This class takes the original image as uploaded by the camera from the
 * webserver and uses the GD library to modify the image on the fly before
 * displaying it to the website visitor.
 *
 * @category  Image
 * @package   PHP_Webcam_Overlay
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class WebcamOverlay
{
    /**
     * Image directory (relative path)
     *
     * @var string
     */
    const IMAGE_DIR = '../../images/';

    /**
     * Fonts directory (relative path)
     *
     * @var string
     */
    const FONTS_DIR = '../../fonts/';

    /**
     * Output image instance
     *
     * @var Image
     */
    protected $outputImage;

    /**
     * Output image scale (percent) based on webcam source image
     *
     * @var int
     */
    protected $outputImageScale = 100;

    /**
     * Webcam source image instance
     *
     * @var Image
     */
    protected $webcamImage;

    /**
     * Webcam source image path
     *
     * Supported image formats: GIF, JPEG, PNG
     *
     * @var string
     */
    protected $webcamImagePath = '';

    /**
     * Enable/disable watermark feature
     *
     * @var bool
     */
    protected $enableWatermark = false;

    /**
     * Watermark image instance
     *
     * @var Image
     */
    protected $watermarkImage;

    /**
     * Watermark image path
     *
     * Supported image formats: GIF, JPEG, PNG
     *
     * @var string
     */
    protected $watermarkImagePath = '';

    /**
     * Watermark image position
     *
     * @var string
     */
    protected $watermarkImagePostion = 'topright';

    /**
     * Enable/disable downtime feature
     *
     * @var bool
     */
    protected $enableDowntime = false;

    /**
     * Downtime image instance
     *
     * @var Image
     */
    protected $downtimeImage;

    /**
     * Downtime image path
     *
     * Supported image formats: GIF, JPEG, PNG
     *
     * @var string
     */
    protected $downtimeImagePath = '';

    /**
     * Downtime image position
     *
     * @var string
     */
    protected $downtimeImagePosition = 'topright';

    /**
     * Downtime start
     *
     * Format: HH:MM:SS
     *
     * @var string
     */
    protected $downtimeStart = '';

    /**
     * Downtime end
     *
     * Format: HH:MM:SS
     *
     * @var string
     */
    protected $downtimeEnd = '';

    /**
     * Enable/disable informational text feature
     *
     * @var bool
     */
    protected $enableInfotext = false;

    /**
     * Informational text content
     *
     * @var string
     */
    protected $infotextContent = '';

    /**
     * Informational text font file
     *
     * @var string
     */
    protected $infotextFont = 'CALIBRI.TTF';

    /**
     * Informational text font size in pixels
     *
     * @var int
     */
    protected $infotextFontSize = 10;

    /**
     * Informational text X position
     *
     * @var int
     */
    protected $infotextPositionX = 5; // text x-position

    /**
     * Informational text Y position
     *
     * @var int
     */
    protected $infotextPositionY = 235; // text y-position

    /**
     * Informational text color
     *
     * Format: array( (int) $red, (int) $green, (int) $blue )
     * Valid integer values: 0-255
     *
     * @var array
     */
    protected $infotextColor = array(255, 255, 255);

    /**
     * Enable/disable informational text border feature
     *
     * @var bool
     */
    protected $enableInfotextBorder = true;

    /**
     * Informational text border color
     *
     * Format: array( (int) $red, (int) $green, (int) $blue )
     * Valid integer values: 0-255
     *
     * @var array
     */
    protected $infotextBorderColor = array(50, 50, 50);

    /**
     * Valid image position values
     *
     * @var array
     */
    protected $validImagePositions
        = array(
            'topleft',
            'topright',
            'bottomleft',
            'bottomright',
            'center'
        );

    /**
     * Sets the output image scale (percent), based on the source image.
     *
     * @param int $scale Output image scale (percent).
     *
     * @return $this
     */
    public function setOutputImageScale($scale)
    {
        $this->outputImageScale = (int)$scale;

        return $this;
    }

    /**
     * Sets the webcam source image path.
     *
     * @param string $path Webcam source image path.
     *
     * @return $this
     */
    public function setWebcamImagePath($path)
    {
        $this->webcamImagePath = (string)$path;

        return $this;
    }

    /**
     * Enables/disables the watermark feature.
     *
     * @param bool $bool true/false
     *
     * @return $this
     */
    public function enableWatermark($bool)
    {
        $this->enableWatermark = (bool)$bool;

        return $this;
    }

    /**
     * Sets the watermark image path.
     *
     * @param string $path Watermark image path.
     *
     * @return $this
     */
    public function setWatermarkImagePath($path)
    {
        $this->watermarkImagePath = (string)$path;

        return $this;
    }

    /**
     * Sets the watermark image position.
     *
     * @param string $position Image position string.
     *
     * @return $this
     * @throws \UnexpectedValueException Thrown if an invalid image position
     * string was given.
     */
    public function setWatermarkImagePosition($position)
    {
        $this->validateImagePosition($position);
        $this->watermarkImagePostion = (string)$position;

        return $this;
    }

    /**
     * Enable/disables the downtime feature.
     *
     * @param bool $bool true/false
     *
     * @return $this
     */
    public function enableDowntime($bool)
    {
        $this->enableDowntime = (bool)$bool;

        return $this;
    }

    /**
     * Sets the downtime image path.
     *
     * @param string $path Downtime image path.
     *
     * @return $this
     */
    public function setDowntimeImagePath($path)
    {
        $this->downtimeImagePath = (string)$path;

        return $this;
    }

    /**
     * Sets the downtime image position.
     *
     * @param string $position Image position string.
     *
     * @return $this
     * @throws \UnexpectedValueException Thrown if an invalid image position
     * string was given.
     */
    public function setDowntimeImagePosition($position)
    {
        $this->validateImagePosition($position);
        $this->downtimeImagePosition = (string)$position;

        return $this;
    }

    /**
     * Sets the downtime start time.
     *
     * Format: HH:MM:SS
     *
     * @param string $time Downtime start time.
     *
     * @return $this
     * @throws \InvalidArgumentException Thrown if an invalid time string was given.
     */
    public function setDowntimeStart($time)
    {
        $this->validateTime($time);
        $this->downtimeStart = (string)$time;
        return $this;
    }

    /**
     * Sets the downtime end time.
     *
     * Format: HH:MM:SS
     *
     * @param string $time Downtime end time.
     *
     * @return $this
     * @throws \InvalidArgumentException Thrown if an invalid time string was given.
     */
    public function setDowntimeEnd($time)
    {
        $this->validateTime($time);
        $this->downtimeEnd = (string)$time;
        return $this;
    }

    /**
     * Enables/disables the informational text feature.
     *
     * @param bool $bool true/false
     *
     * @return $this
     */
    public function enableInfotext($bool)
    {
        $this->enableInfotext = (bool)$bool;
        return $this;
    }

    /**
     * Sets the informational text content.
     *
     * @param string $text Informational text content.
     *
     * @return $this
     */
    public function setInfotextContent($text)
    {
        $this->infotextContent = (string)$text;
        return $this;
    }

    /**
     * Set the informational text font file path.
     *
     * @param string $fontPath Absolute path to the TTF font file.
     *
     * @return $this
     */
    public function setInfotextFont($fontPath)
    {
        $this->infotextFont = (string)$fontPath;

        return $this;
    }

    /**
     * Sets the informational text font size in pixels.
     *
     * @param int $size Informational text font size in pixels.
     *
     * @return $this
     */
    public function setInfotextFontSize($size)
    {
        $this->infotextFontSize = (int)$size;
        return $this;
    }

    /**
     * Set the informational text X position.
     *
     * @param int $position Informational text X position.
     *
     * @return $this
     */
    public function setInfotextPositionX($position)
    {
        $this->infotextPositionX = (int)$position;
        return $this;
    }

    /**
     * Sets the informational text Y position.
     *
     * @param int $position Informational text Y position.
     *
     * @return $this
     */
    public function setInfotextPositionY($position)
    {
        $this->infotextPositionY = (int)$position;
        return $this;
    }

    /**
     * Set the informational text color.
     *
     * Format: array( (int) $red, (int) $green, (int) $blue )
     * Valid integer values: 0-255
     *
     * @param array $color Informational text color.
     *
     * @return $this
     */
    public function setInfotextColor(array $color)
    {
        $this->validateColor($color);
        $this->infotextColor = $color;
        return $this;
    }

    /**
     * Enables/disables the informational text border feature.
     *
     * @param bool $bool true/false
     *
     * @return $this
     */
    public function enableInfotextBorder($bool)
    {
        $this->enableInfotextBorder = (bool)$bool;
        return $this;
    }

    /**
     * Sets the informational text border color.
     *
     * Format: array( (int) $red, (int) $green, (int) $blue )
     * Valid integer values: 0-255
     *
     * @param array $color Informational text border color.
     *
     * @return $this
     */
    public function setInfotextBorderColor(array $color)
    {
        $this->validateColor($color);
        $this->infotextBorderColor = $color;
        return $this;
    }

    /**
     * Returns all valid image position strings.
     *
     * @return array
     */
    public function getValidImagePositions()
    {
        return $this->validImagePositions;
    }

    /**
     * Renders the image and sends it to the browser.
     *
     * @return void
     * @throws \Exception
     */
    public function render()
    {
        // read watermark image
        if (!empty($this->enableWatermark)) {
            $this->watermarkImage = Image::getInstanceByPath(
                $this->watermarkImagePath
            );
        }

        // read downtime image
        if (!empty($this->downtimeImagePath)) {
            $this->downtimeImage = Image::getInstanceByPath(
                $this->downtimeImagePath
            );
        }

        // read webcam source image
        try {
            $this->webcamImage = Image::getInstanceByPath(
                $this->webcamImagePath
            );
        } catch (\Exception $e) {

            /*
             * If there is no downtime image configured and we fail to load the
             * webcam image, this is a fatal error and we pass on the exception.
             *
             * Else, we render the downtime image instead.
             */
            if (!$this->downtimeImage instanceof Image) {
                throw $e;
            }

        }

        // define output image dimensions
        if ($this->webcamImage instanceof Image) {
            $width = round(
                $this->webcamImage->getWidth() * ($this->outputImageScale / 100)
            );
            $height = round(
                $this->webcamImage->getHeight() * ($this->outputImageScale / 100)
            );
        } else {
            $width = round($this->downtimeImage->getWidth());
            $height = round($this->downtimeImage->getHeight());
        }

        // create output image
        $this->outputImage = Image::getInstanceByCreate(
            $width,
            $height
        );

        /*
         * The following components will not be added if the webcam image failed
         * to load.
         */
        if ($this->webcamImage instanceof Image) {

            // insert webcam source image
            $this->outputImage->merge(
                $this->webcamImage, 0, 0, Image::MERGE_SCALE_DST
            );

            /*
             * The following components will not be added if we are within the
             * set downtime period.
             */
            if (!$this->isDownTime()) {

                // insert infotext
                if ($this->enableInfotext) {

                    // insert "Last modified" overlay
                    $lastModified = date(
                        'd.m.Y, H:i:s', $this->webcamImage->getModified()
                    );

                    // set text
                    $text = sprintf(
                        '%1$s%2$s',
                        $lastModified,
                        $this->infotextContent
                    );

                    // set basic text properties
                    $this->outputImage->setTextFont(
                        $this->infotextFont
                    );
                    $this->outputImage->setTextSize($this->infotextFontSize);
                    $textPosX = $this->infotextPositionX;
                    $textPosY = $this->infotextPositionY;

                    // render border
                    if ($this->enableInfotextBorder) {
                        $this->outputImage->setTextColor(
                            $this->infotextBorderColor
                        );
                        $this->outputImage->insertText(
                            $textPosX - 1, $textPosY - 1, $text
                        );
                        $this->outputImage->insertText(
                            $textPosX - 1, $textPosY, $text
                        );
                        $this->outputImage->insertText(
                            $textPosX - 1, $textPosY + 1, $text
                        );
                        $this->outputImage->insertText(
                            $textPosX, $textPosY - 1, $text
                        );
                        $this->outputImage->insertText(
                            $textPosX, $textPosY + 1, $text
                        );
                        $this->outputImage->insertText(
                            $textPosX + 1, $textPosY - 1, $text
                        );
                        $this->outputImage->insertText(
                            $textPosX + 1, $textPosY, $text
                        );
                        $this->outputImage->insertText(
                            $textPosX + 1, $textPosY + 1, $text
                        );
                    }

                    // render text
                    $this->outputImage->setTextColor($this->infotextColor);
                    $this->outputImage->insertText($textPosX, $textPosY, $text);

                }

                // insert watermark
                if ($this->enableWatermark) {

                    // determine numeric position
                    $position = $this->determineOverlayPosition(
                        $this->outputImage,
                        $this->watermarkImage,
                        $this->watermarkImagePostion
                    );

                    // merge into output image
                    $this->outputImage->merge(
                        $this->watermarkImage,
                        $position['x'],
                        $position['y']
                    );

                    unset($this->watermarkImage);
                }
            }
        }

        // insert downtime image
        if ($this->isDownTime() || !$this->webcamImage instanceof Image) {

            // determine numeric position
            $position = $this->determineOverlayPosition(
                $this->outputImage,
                $this->downtimeImage,
                $this->downtimeImagePosition
            );

            // merge into output image
            $this->outputImage->merge(
                $this->downtimeImage,
                $position['x'],
                $position['y'],
                Image::MERGE_SCALE_DST
            );

            unset($this->downtimeImage);

        }


        // render image
        $this->outputImage->render();

        unset($this->outputImage);
    }

    /**
     * Validates the image position string against $this->validImagePositions.
     *
     * @param string $position Image position string.
     *
     * @return void
     * @throws \UnexpectedValueException Thrown if an invalid image position
     * string was given.
     */
    protected function validateImagePosition($position)
    {
        if (!in_array($position, $this->validImagePositions)) {
            throw new \UnexpectedValueException(
                sprintf(
                    'Invalid image postion \'%1$s\'. Valid postions are: %2$s',
                    $position,
                    implode(', ', $this->validImagePositions)
                )
            );
        }
    }

    /**
     * Validates the time string format.
     *
     * @param string $time time string
     *
     * @return void
     * @throws \InvalidArgumentException Thrown if an invalid time string was given.
     */
    protected function validateTime($time)
    {
        if (!preg_match('/([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]/', $time)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid time \'%1$s\'. Expected format: HH:MM:SS',
                    $time
                )
            );
        }
    }

    /**
     * Validates the color array format.
     *
     * @param array $color color array
     *
     * @return void
     * @throws \InvalidArgumentException Thrown if the color array uses an
     * invalid format.
     */
    protected function validateColor(array $color)
    {
        if (!isset($color[0]) || !isset($color[1]) || !isset($color[2])) {
            throw new \InvalidArgumentException('Invalid color array format.');
        }
    }

    /**
     * Checks if the current time falls into the set downtime period.
     *
     * @return bool
     */
    protected function isDownTime()
    {
        if (!$this->enableDowntime) {
            return false;
        }

        /*
         * This is a quite confusing hack and I'd be happy if someone knew a
         * better way to get around the problem that the end time might actually
         * be the next day and therefore smaller than the start time.
         */
        $now = date('His');
        $start = str_replace(':', '', $this->downtimeStart);
        $end = str_replace(':', '', $this->downtimeEnd);

        if ($start < $end) {

            if (($now >= $start && $now <= $end)) {
                return true;
            }

        } elseif ($start > $end) {

            if (!($now >= $end && $now < $start)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns the numeric coordinates for the given position string, based on
     * the dimensions of the provided Image objects.
     *
     * @param Image  $target   target Image object the overlay should be merged into.
     * @param Image  $overlay  Image object to be merged into the target object.
     * @param string $position One of $this->validImagePositions.
     *
     * @return array Array containing x and y coordinates.
     *
     * @todo This does not work correctly if the overlay image is scaled.
     */
    protected function determineOverlayPosition(
        Image $target, Image $overlay, $position
    ) {

        $coordinates = array();

        switch ($position) {

        case 'topleft':
            $coordinates['x'] = 0;
            $coordinates['y'] = 0;
            break;

        case 'topright':
            $coordinates['x'] = $target->getWidth() - $overlay->getWidth();
            $coordinates['y'] = 0;
            break;

        case 'bottomleft':
            $coordinates['x'] = 0;
            $coordinates['y'] = $target->getHeight() - $overlay->getHeight();
            break;

        case 'bottomright':
            $coordinates['x'] = $target->getWidth() - $overlay->getWidth();
            $coordinates['y'] = $target->getHeight() - $overlay->getHeight();
            break;

        case 'center':
            $coordinates['x'] = $target->getWidth() - ($overlay->getWidth() / 2);
            $coordinates['y'] = $target->getHeight() - ($overlay->getHeight() / 2);
            break;

        default:
            $coordinates['x'] = 0;
            $coordinates['y'] = 0;
            break;
        }

        return $coordinates;
    }
}
