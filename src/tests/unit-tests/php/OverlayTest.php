<?php
namespace randomhost\Image\Webcam;

/**
 * Unit test for Overlay
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://PEAR Packages.random-host.com
 */
class OverlayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Overlay::setOutputImageScale().
     */
    public function testSetOutputImageScaleImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setOutputImageScale(100)
        );
    }

    /**
     * Tests Overlay::setWebcamImagePath().
     */
    public function testSetWebcamImagePathImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setWebcamImagePath('')
        );
    }

    /**
     * Tests Overlay::setWatermarkEnabled().
     */
    public function testSetWatermarkEnabledImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setWatermarkEnabled(true)
        );
    }

    /**
     * Tests Overlay::setWatermarkImagePath().
     */
    public function testSetWatermarkImagePathImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setWatermarkImagePath('')
        );
    }

    /**
     * Tests Overlay::getValidImagePositions().
     */
    public function testGetValidImagePositionsReturnsArray()
    {
        $overlay = new Overlay();

        $this->assertInternalType(
            'array',
            $overlay->getValidImagePositions()
        );
    }

    /**
     * Tests Overlay::setWatermarkImagePosition() with a valid position.
     *
     * @param string $position Image position string.
     *
     * @dataProvider providerValidImagePositions
     */
    public function testSetWatermarkImagePositionWithValidPosition($position)
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setWatermarkImagePosition($position)
        );
    }

    /**
     * Tests Overlay::setWatermarkImagePosition() with a valid position.
     *
     * @param string $position Image position string.
     *
     * @dataProvider providerValidImagePositions
     */
    public function testSetWatermarkImagePositionWithInvalidPositionThrowsExcetion(
    )
    {
        $position = md5(time());

        $overlay = new Overlay();

        $this->setExpectedException(
            '\UnexpectedValueException',
            sprintf(
                'Invalid image position \'%1$s\'. Valid positions are: %2$s',
                $position,
                implode(', ', $overlay->getValidImagePositions())
            )
        );

        $overlay->setWatermarkImagePosition($position);
    }

    /**
     * Tests Overlay::setDowntimeEnabled().
     */
    public function testSetDowntimeEnabledImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setDowntimeEnabled(true)
        );
    }

    /**
     * Tests Overlay::setDowntimeImagePath().
     */
    public function testSetDowntimeImagePathImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setDowntimeImagePath('')
        );
    }

    /**
     * Tests Overlay::setDowntimeImagePosition() with a valid position.
     *
     * @param string $position Image position string.
     *
     * @dataProvider providerValidImagePositions
     */
    public function testSetDowntimeImagePositionWithValidPosition($position)
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setDowntimeImagePosition($position)
        );
    }

    /**
     * Tests Overlay::setDowntimeImagePosition() with a valid position.
     *
     * @param string $position Image position string.
     *
     * @dataProvider providerValidImagePositions
     */
    public function testSetDowntimeImagePositionWithInvalidPositionThrowsExcetion(
    )
    {
        $position = md5(time());

        $overlay = new Overlay();

        $this->setExpectedException(
            '\UnexpectedValueException',
            sprintf(
                'Invalid image position \'%1$s\'. Valid positions are: %2$s',
                $position,
                implode(', ', $overlay->getValidImagePositions())
            )
        );

        $overlay->setDowntimeImagePosition($position);
    }

    /**
     * Tests Overlay::setDowntimeStart() with a valid time.
     */
    public function testSetDowntimeStartWithValidTime()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setDowntimeStart('22:00:00')
        );
    }

    /**
     * Tests Overlay::setDowntimeStart() with an invalid time.
     */
    public function testSetDowntimeStartWithInvalidTimeThrowsException()
    {
        $time = md5(time());

        $overlay = new Overlay();

        $this->setExpectedException(
            '\InvalidArgumentException',
            sprintf(
                'Invalid time \'%1$s\'. Expected format: HH:MM:SS',
                $time
            )
        );

        $overlay->setDowntimeStart($time);
    }

    /**
     * Tests Overlay::setDowntimeEnd() with a valid time.
     */
    public function testSetDowntimeEndWithValidTime()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setDowntimeEnd('22:00:00')
        );
    }

    /**
     * Tests Overlay::setDowntimeEnd() with an invalid time.
     */
    public function testSetDowntimeEndWithInvalidTimeThrowsException()
    {
        $time = md5(time());

        $overlay = new Overlay();

        $this->setExpectedException(
            '\InvalidArgumentException',
            sprintf(
                'Invalid time \'%1$s\'. Expected format: HH:MM:SS',
                $time
            )
        );

        $overlay->setDowntimeEnd($time);
    }

    /**
     * Tests Overlay::setInfoTextEnabled().
     */
    public function testSetInfoTextEnabledImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setInfoTextEnabled(true)
        );
    }

    /**
     * Tests Overlay::setInfoTextContent().
     */
    public function testSetInfoTextContentImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setInfoTextContent('')
        );
    }

    /**
     * Tests Overlay::setInfoTextFont().
     */
    public function testSetInfoTextFontImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setInfoTextFont('')
        );
    }

    /**
     * Tests Overlay::setInfoTextFontSize().
     */
    public function testSetInfoTextFontSizeImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setInfoTextFontSize(12)
        );
    }

    /**
     * Tests Overlay::setInfoTextPositionX().
     */
    public function testSetInfoTextPositionXImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setInfoTextPositionX(14)
        );
    }

    /**
     * Tests Overlay::setInfoTextPositionY().
     */
    public function testSetInfoTextPositionYImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setInfoTextPositionY(14)
        );
    }

    /**
     * Tests Overlay::setInfoTextColor() with a valid color.
     */
    public function testSetInfoTextColorWithValidColor()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setInfoTextColor(array(1, 2, 3))
        );
    }

    /**
     * Tests Overlay::setInfoTextColor() with an invalid color.
     */
    public function testSetInfoTextColorWithInvalidColorThrowsException()
    {
        $overlay = new Overlay();

        $this->setExpectedException(
            '\InvalidArgumentException',
            'Invalid color array format.'
        );

        $overlay->setInfoTextColor(array());
    }

    /**
     * Tests Overlay::setInfoTextBorderEnabled().
     */
    public function testSetInfoTextBorderEnabledImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setInfoTextBorderEnabled(true)
        );
    }

    /**
     * Tests Overlay::setInfoTextBorderColor() with a valid color.
     */
    public function testSetInfoTextBorderColorWithValidColor()
    {
        $overlay = new Overlay();

        $this->assertSame(
            $overlay,
            $overlay->setInfoTextBorderColor(array(1, 2, 3))
        );
    }

    /**
     * Tests Overlay::setInfoTextBorderColor() with an invalid color.
     */
    public function testSetInfoTextBorderColorWithInvalidColorThrowsException()
    {
        $overlay = new Overlay();

        $this->setExpectedException(
            '\InvalidArgumentException',
            'Invalid color array format.'
        );

        $overlay->setInfoTextBorderColor(array());
    }

    /**
     * Tests Image::render() with a valid webcam image and no downtime.
     *
     * @dataProvider providerValidImagePositions
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testRenderWithValidWebcamImageWithoutDowntime($overlayPos)
    {
        $dataDirPath = realpath(APP_TOPDIR . '/../data');

        $overlay = new Overlay();

        $overlay
            ->setWebcamImagePath($dataDirPath . '/webcam.jpg')
            ->setOutputImageScale(1);

        $overlay
            ->setWatermarkEnabled(true)
            ->setWatermarkImagePath($dataDirPath . '/watermark.png')
            ->setWatermarkImagePosition($overlayPos);

        $overlay
            ->setDowntimeEnabled(false);

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

        ob_start();

        $result = $overlay->render();
        $imageData = ob_get_contents();
        ob_end_clean();

        $this->assertSame($overlay, $result);
    }

    /**
     * Tests Image::render() with a valid webcam image, downtime and current time.
     *
     * @dataProvider providerValidImagePositions
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testRenderWithValidWebcamImageWithDowntime($overlayPos)
    {
        $dataDirPath = realpath(APP_TOPDIR . '/../data');

        $overlay = new Overlay();

        $overlay
            ->setWebcamImagePath($dataDirPath . '/webcam.jpg')
            ->setOutputImageScale(1);

        $overlay
            ->setDowntimeEnabled(true)
            ->setDowntimeImagePath($dataDirPath . '/offline.png')
            ->setDowntimeImagePosition('center')
            ->setDowntimeStart('22:00:00')
            ->setDowntimeEnd('08:00:00');

        ob_start();

        $result = $overlay->render();
        $imageData = ob_get_contents();
        ob_end_clean();

        $this->assertSame($overlay, $result);
    }

    /**
     * Tests Image::render() with a valid webcam image, downtime and fake time.
     *
     * This is done to cover all cases of different times without relying on
     * the test running at a certain time of day.
     *
     * @param string $downtimeStart    Downtime start in H:i:s format.
     * @param string $downtimeEnd      Downtime end in H:i:s format.
     * @param string $fakedCurrentTime Faked current time in His format.
     *
     * @dataProvider providerDownTimes
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testRenderWithValidWebcamImageWithFakeDowntime(
        $downtimeStart,
        $downtimeEnd,
        $fakedCurrentTime
    ) {

        $dataDirPath = realpath(APP_TOPDIR . '/../data');

        /**
         * @var Overlay $overlay
         */
        $overlay = $this->getMockedOverlayForTime($fakedCurrentTime);

        $overlay
            ->setWebcamImagePath($dataDirPath . '/webcam.jpg')
            ->setOutputImageScale(1);

        $overlay
            ->setDowntimeEnabled(true)
            ->setDowntimeImagePath($dataDirPath . '/offline.png')
            ->setDowntimeImagePosition('center')
            ->setDowntimeStart($downtimeStart)
            ->setDowntimeEnd($downtimeEnd);

        ob_start();

        $result = $overlay->render();
        $imageData = ob_get_contents();
        ob_end_clean();

        $this->assertSame($overlay, $result);
    }


    /**
     * Tests Image::render() with an invalid webcam image.
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testRenderWithInvalidWebcamImageThrowsException()
    {
        $dataDirPath = realpath(APP_TOPDIR . '/../data');

        $overlay = new Overlay();

        $overlay
            ->setWebcamImagePath($dataDirPath . '/webcam-error.jpg')
            ->setOutputImageScale(1);


        $this->setExpectedException(
            '\RuntimeException',
            "Couldn't read image at"
        );

        $overlay->render();
    }

    /**
     * Tests Image::render() with an invalid webcam image and a downtime image.
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testRenderWithInvalidWebcamImageAndDownTimeImage()
    {
        $dataDirPath = realpath(APP_TOPDIR . '/../data');

        $overlay = new Overlay();

        $overlay
            ->setWebcamImagePath($dataDirPath . '/webcam-error.jpg')
            ->setOutputImageScale(1)
            ->setDowntimeImagePath($dataDirPath . '/offline.png');

        ob_start();

        $result = $overlay->render();
        $imageData = ob_get_contents();
        ob_end_clean();

        $this->assertSame($overlay, $result);
    }

    /**
     * Data provider for image positions.
     *
     * @return array
     */
    public function providerValidImagePositions()
    {
        $data = array();

        $overlay = new Overlay();
        foreach ($overlay->getValidImagePositions() as $position) {
            $data[] = array($position);
        }

        return $data;
    }

    /**
     * Data provider for down times.
     *
     * @return array
     */
    public function providerDownTimes()
    {
        return array(
            array('08:00:00', '10:00:00', '090000'),
            array('08:00:00', '09:00:00', '100000'),
            array('22:00:00', '08:00:00', '230000'),
            array('22:00:00', '08:00:00', '210000'),
        );
    }

    /**
     * Returns a mocked Overlay instance where Overlay::getTime() returns the
     * given $time.
     *
     * @param int $time Time in His format.
     *
     * @return Overlay
     */
    protected function getMockedOverlayForTime($time)
    {
        $mock = $this->getMockBuilder('randomhost\\Image\\Webcam\\Overlay')
            ->setMethods(array('getTime'))
            ->getMock();

        $mock->expects($this->atLeastOnce())
            ->method('getTime')
            ->willReturn($time);

        return $mock;
    }
}
