<?php

declare(strict_types=1);

namespace randomhost\Image\Webcam;

use randomhost\Image\Color;
use randomhost\Image\Image;
use randomhost\Image\Text;

/**
 * Provides overlays for webcam images.
 *
 * This class takes the original image as uploaded by the camera from the file
 * system (e.g. an FTP upload directory) and uses the GD library to modify the
 * image on the fly before sending in to the HTTP client.
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2022 Random-Host.tv
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD License (3 Clause)
 *
 * @see https://github.random-host.tv
 */
class Overlay
{
    /**
     * Places the overlay image in the top left corner.
     */
    public const IMAGE_TOP_LEFT = 'top-left';

    /**
     * Places the overlay image in the top right corner.
     */
    public const IMAGE_TOP_RIGHT = 'top-right';

    /**
     * Places the overlay image in the bottom left corner.
     */
    public const IMG_BOTTOM_LEFT = 'bottom-left';

    /**
     * Places the overlay image in the bottom right corner.
     */
    public const IMG_BOTTOM_RIGHT = 'bottom-right';

    /**
     * Places the overlay image in the center.
     */
    public const IMG_CENTER = 'center';

    /**
     * Output image instance.
     *
     * @var Image
     */
    protected $outputImage;

    /**
     * Output image scale (percent) based on webcam source image.
     *
     * @var int
     */
    protected $outputImageScale = 100;

    /**
     * Webcam source image instance.
     *
     * @var Image
     */
    protected $webcamImage;

    /**
     * Webcam source image path.
     *
     * Supported image formats: GIF, JPEG, PNG
     *
     * @var string
     */
    protected $webcamImagePath = '';

    /**
     * Enable/disable watermark feature.
     *
     * @var bool
     */
    protected $watermarkEnabled = false;

    /**
     * Watermark image instance.
     *
     * @var Image
     */
    protected $watermarkImage;

    /**
     * Watermark image path.
     *
     * Supported image formats: GIF, JPEG, PNG
     *
     * @var string
     */
    protected $watermarkImagePath = '';

    /**
     * Watermark image position.
     *
     * @var string
     */
    protected $watermarkImagePostion = self::IMAGE_TOP_RIGHT;

    /**
     * Enable/disable downtime feature.
     *
     * @var bool
     */
    protected $downtimeEnabled = false;

    /**
     * Downtime image instance.
     *
     * @var Image
     */
    protected $downtimeImage;

    /**
     * Downtime image path.
     *
     * Supported image formats: GIF, JPEG, PNG
     *
     * @var string
     */
    protected $downtimeImagePath = '';

    /**
     * Downtime image position.
     *
     * @var string
     */
    protected $downtimeImagePosition = self::IMAGE_TOP_RIGHT;

    /**
     * Downtime start.
     *
     * Format: HH:MM:SS
     *
     * @var string
     */
    protected $downtimeStart = '';

    /**
     * Downtime end.
     *
     * Format: HH:MM:SS
     *
     * @var string
     */
    protected $downtimeEnd = '';

    /**
     * Enable/disable informational text feature.
     *
     * @var bool
     */
    protected $infoTextEnabled = false;

    /**
     * Informational text content.
     *
     * @var string
     */
    protected $infoTextContent = '';

    /**
     * Informational text font file.
     *
     * @var string
     */
    protected $infoTextFont = __DIR__.'/../data/vera.ttf';

    /**
     * Informational text font size in pixels.
     *
     * @var int
     */
    protected $infoTextFontSize = 10;

    /**
     * Informational text X position.
     *
     * @var int
     */
    protected $infoTextPositionX = 5;

    /**
     * Informational text Y position.
     *
     * @var int
     */
    protected $infoTextPositionY = 235;

    /**
     * Informational text color.
     *
     * Format: array( (int) $red, (int) $green, (int) $blue )
     * Valid integer values: 0-255
     *
     * @var array
     */
    protected $infoTextColor = [255, 255, 255];

    /**
     * Enable/disable informational text border feature.
     *
     * @var bool
     */
    protected $infoTextBorderEnabled = true;

    /**
     * Informational text border color.
     *
     * Format: array( (int) $red, (int) $green, (int) $blue )
     * Valid integer values: 0-255
     *
     * @var array
     */
    protected $infoTextBorderColor = [50, 50, 50];

    /**
     * Valid image position values.
     *
     * @var array
     */
    protected $validImagePositions = [
        self::IMAGE_TOP_LEFT,
        self::IMAGE_TOP_RIGHT,
        self::IMG_BOTTOM_LEFT,
        self::IMG_BOTTOM_RIGHT,
        self::IMG_CENTER,
    ];

    /**
     * Sets the output image scale (percent), based on the source image.
     *
     * @param int $scale Output image scale (percent).
     *
     * @return $this
     */
    public function setOutputImageScale(int $scale): self
    {
        $this->outputImageScale = $scale;

        return $this;
    }

    /**
     * Sets the webcam source image path.
     *
     * @param string $path Webcam source image path.
     *
     * @return $this
     */
    public function setWebcamImagePath(string $path): self
    {
        $this->webcamImagePath = $path;

        return $this;
    }

    /**
     * Enables/disables the watermark feature.
     *
     * @param bool $bool true/false
     *
     * @return $this
     */
    public function setWatermarkEnabled(bool $bool): self
    {
        $this->watermarkEnabled = $bool;

        return $this;
    }

    /**
     * Sets the watermark image path.
     *
     * @param string $path Watermark image path.
     *
     * @return $this
     */
    public function setWatermarkImagePath(string $path): self
    {
        $this->watermarkImagePath = $path;

        return $this;
    }

    /**
     * Sets the watermark image position.
     *
     * @param string $position Image position string.
     *
     * @return $this
     *
     * @throws \UnexpectedValueException Thrown if an invalid image position
     *                                   string was given.
     */
    public function setWatermarkImagePosition(string $position): self
    {
        $this->validateImagePosition($position);
        $this->watermarkImagePostion = $position;

        return $this;
    }

    /**
     * Enable/disables the downtime feature.
     *
     * @param bool $bool true/false
     *
     * @return $this
     */
    public function setDowntimeEnabled(bool $bool): self
    {
        $this->downtimeEnabled = $bool;

        return $this;
    }

    /**
     * Sets the downtime image path.
     *
     * @param string $path Downtime image path.
     *
     * @return $this
     */
    public function setDowntimeImagePath(string $path): self
    {
        $this->downtimeImagePath = $path;

        return $this;
    }

    /**
     * Sets the downtime image position.
     *
     * @param string $position Image position string.
     *
     * @return $this
     *
     * @throws \UnexpectedValueException Thrown if an invalid image position
     *                                   string was given.
     */
    public function setDowntimeImagePosition(string $position): self
    {
        $this->validateImagePosition($position);
        $this->downtimeImagePosition = $position;

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
     *
     * @throws \InvalidArgumentException Thrown if an invalid time string was given.
     */
    public function setDowntimeStart(string $time): self
    {
        $this->validateTime($time);
        $this->downtimeStart = $time;

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
     *
     * @throws \InvalidArgumentException Thrown if an invalid time string was given.
     */
    public function setDowntimeEnd(string $time): self
    {
        $this->validateTime($time);
        $this->downtimeEnd = $time;

        return $this;
    }

    /**
     * Enables/disables the informational text feature.
     *
     * @param bool $bool true/false
     *
     * @return $this
     */
    public function setInfoTextEnabled(bool $bool): self
    {
        $this->infoTextEnabled = $bool;

        return $this;
    }

    /**
     * Sets the informational text content.
     *
     * @param string $text Informational text content.
     *
     * @return $this
     */
    public function setInfoTextContent(string $text): self
    {
        $this->infoTextContent = $text;

        return $this;
    }

    /**
     * Set the informational text font file path.
     *
     * @param string $fontPath Absolute path to the TTF font file.
     *
     * @return $this
     */
    public function setInfoTextFont(string $fontPath): self
    {
        $this->infoTextFont = $fontPath;

        return $this;
    }

    /**
     * Sets the informational text font size in pixels.
     *
     * @param int $size Informational text font size in pixels.
     *
     * @return $this
     */
    public function setInfoTextFontSize(int $size): self
    {
        $this->infoTextFontSize = $size;

        return $this;
    }

    /**
     * Set the informational text X position.
     *
     * @param int $position Informational text X position.
     *
     * @return $this
     */
    public function setInfoTextPositionX(int $position): self
    {
        $this->infoTextPositionX = $position;

        return $this;
    }

    /**
     * Sets the informational text Y position.
     *
     * @param int $position Informational text Y position.
     *
     * @return $this
     */
    public function setInfoTextPositionY(int $position): self
    {
        $this->infoTextPositionY = $position;

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
    public function setInfoTextColor(array $color): self
    {
        $this->validateColor($color);
        $this->infoTextColor = $color;

        return $this;
    }

    /**
     * Enables/disables the informational text border feature.
     *
     * @param bool $bool true/false
     *
     * @return $this
     */
    public function setInfoTextBorderEnabled(bool $bool): self
    {
        $this->infoTextBorderEnabled = $bool;

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
    public function setInfoTextBorderColor(array $color): self
    {
        $this->validateColor($color);
        $this->infoTextBorderColor = $color;

        return $this;
    }

    /**
     * Returns all valid image position strings.
     */
    public function getValidImagePositions(): array
    {
        return $this->validImagePositions;
    }

    /**
     * Renders the image and sends it to the browser.
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function render(): self
    {
        // read watermark image
        if (!empty($this->watermarkEnabled)) {
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
             * If there is no downtime image configured, and we fail to load the
             * webcam image, this is a fatal error, and we pass on the exception.
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
                $this->webcamImage->getHeight() * ($this->outputImageScale
                    / 100)
            );
        } else {
            $width = round($this->downtimeImage->getWidth());
            $height = round($this->downtimeImage->getHeight());
        }

        // create output image
        $this->outputImage = Image::getInstanceByCreate(
            (int) $width,
            (int) $height
        );

        /*
         * The following components will not be added if the webcam image failed
         * to load.
         */
        if ($this->webcamImage instanceof Image) {
            // insert webcam source image
            $this->outputImage->merge(
                $this->webcamImage,
                0,
                0,
                Image::MERGE_SCALE_DST
            );

            /*
             * The following components will not be added if we are within the
             * set downtime period.
             */
            if (!$this->isDownTime()) {
                // insert info text
                if ($this->infoTextEnabled) {
                    // insert "Last modified" overlay
                    $lastModified = date(
                        'd.m.Y, H:i:s',
                        $this->webcamImage->getModified()
                    );

                    // set text
                    $text = sprintf(
                        '%1$s%2$s',
                        $lastModified,
                        $this->infoTextContent
                    );

                    // setup generic text object
                    $textOverlay = new Text\Generic($this->outputImage);
                    $textOverlay
                        ->setTextFont($this->infoTextFont)
                        ->setTextSize($this->infoTextFontSize)
                        ->setTextColor(
                            new Color(
                                $this->infoTextColor[0],
                                $this->infoTextColor[1],
                                $this->infoTextColor[2]
                            )
                        )
                    ;

                    // setup border text decorator
                    if ($this->infoTextBorderEnabled) {
                        $textOverlay = new Text\Decorator\Border($textOverlay);
                        $textOverlay->setBorderColor(
                            new Color(
                                $this->infoTextBorderColor[0],
                                $this->infoTextBorderColor[1],
                                $this->infoTextBorderColor[2]
                            )
                        );
                    }

                    // render text
                    $textOverlay->insertText(
                        $this->infoTextPositionX,
                        $this->infoTextPositionY,
                        $text
                    );

                    // clean up
                    unset($textOverlay);
                }

                // insert watermark
                if ($this->watermarkEnabled) {
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
                Image::MERGE_SCALE_DST_NO_UPSCALE
            );

            unset($this->downtimeImage);
        }

        // render image
        $this->outputImage->render();

        unset($this->outputImage);

        return $this;
    }

    /**
     * Validates the image position string against $this->validImagePositions.
     *
     * @param string $position Image position string.
     *
     * @throws \UnexpectedValueException Thrown if an invalid image position
     *                                   string was given.
     */
    protected function validateImagePosition(string $position)
    {
        if (!in_array($position, $this->validImagePositions)) {
            throw new \UnexpectedValueException(
                sprintf(
                    'Invalid image position \'%1$s\'. Valid positions are: %2$s',
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
     * @throws \InvalidArgumentException Thrown if an invalid time string was given.
     */
    protected function validateTime(string $time)
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
     * @throws \InvalidArgumentException Thrown if the color array uses an
     *                                   invalid format.
     */
    protected function validateColor(array $color)
    {
        if (!isset($color[0]) || !isset($color[1]) || !isset($color[2])) {
            throw new \InvalidArgumentException('Invalid color array format.');
        }
    }

    /**
     * Checks if the current time falls into the set downtime period.
     */
    protected function isDownTime(): bool
    {
        if (!$this->downtimeEnabled) {
            return false;
        }

        /*
         * This is a quite confusing hack, and I'd be happy if someone knew a
         * better way to get around the problem that the end time might actually
         * be the next day and therefore smaller than the start time.
         */
        $now = $this->getTime();
        $start = str_replace(':', '', $this->downtimeStart);
        $end = str_replace(':', '', $this->downtimeEnd);

        if ($start < $end) {
            if ($now >= $start && $now <= $end) {
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
     * @return int[] Array containing x and y coordinates.
     */
    protected function determineOverlayPosition(Image $target, Image $overlay, string $position): array
    {
        $coordinates = [
            'x' => 0,
            'y' => 0,
        ];

        /**
         * The overlay image might be bigger than the target image. In this
         * case, we need to use the target image dimensions to determine the
         * positions.
         */
        $overlayWidth = $overlay->getWidth();
        if ($overlayWidth > $target->getWidth()) {
            $overlayWidth = $target->getWidth();
        }
        $overlayHeight = $overlay->getHeight();
        if ($overlayHeight > $target->getHeight()) {
            $overlayHeight = $target->getHeight();
        }

        switch ($position) {
            case self::IMAGE_TOP_LEFT:
                $coordinates['x'] = 0;
                $coordinates['y'] = 0;

                break;

            case self::IMAGE_TOP_RIGHT:
                $coordinates['x'] = $target->getWidth() - $overlayWidth;
                $coordinates['y'] = 0;

                break;

            case self::IMG_BOTTOM_LEFT:
                $coordinates['x'] = 0;
                $coordinates['y'] = $target->getHeight() - $overlayHeight;

                break;

            case self::IMG_BOTTOM_RIGHT:
                $coordinates['x'] = $target->getWidth() - $overlayWidth;
                $coordinates['y'] = $target->getHeight() - $overlayHeight;

                break;

            case self::IMG_CENTER:
                $coordinates['x'] = (int) round(($target->getWidth() / 2) - ($overlayWidth / 2));
                $coordinates['y'] = (int) round(($target->getHeight() / 2) - ($overlayHeight / 2));

                break;
        }

        return $coordinates;
    }

    /**
     * Returns the current time.
     */
    protected function getTime(): string
    {
        return date('His');
    }
}
