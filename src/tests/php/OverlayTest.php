<?php

declare(strict_types=1);

namespace randomhost\Image\Webcam\Tests;

use PHPUnit\Framework\TestCase;
use randomhost\Image\Webcam\Overlay;

/**
 * Unit test for {@see Overlay}.
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2022 Random-Host.tv
 * @license   https://opensource.org/licenses/BSD-3-Clause BSD License (3 Clause)
 *
 * @see https://github.random-host.tv
 */
class OverlayTest extends TestCase
{
    /**
     * Tests {@see Overlay::setOutputImageScale()}.
     */
    public function testSetOutputImageScaleImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setOutputImageScale(100));
    }

    /**
     * Tests {@see Overlay::setWebcamImagePath()}.
     */
    public function testSetWebcamImagePathImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setWebcamImagePath(''));
    }

    /**
     * Tests {@see Overlay::setWatermarkEnabled()}.
     */
    public function testSetWatermarkEnabledImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setWatermarkEnabled(true));
    }

    /**
     * Tests {@see Overlay::setWatermarkImagePath()}.
     */
    public function testSetWatermarkImagePathImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setWatermarkImagePath(''));
    }

    /**
     * Tests {@see Overlay::getValidImagePositions()}.
     */
    public function testGetValidImagePositionsReturnsArray()
    {
        $overlay = new Overlay();

        $this->assertIsArray($overlay->getValidImagePositions());
    }

    /**
     * Tests {@see Overlay::setWatermarkImagePosition()} with a valid position.
     *
     * @param string $position Image position string.
     *
     * @dataProvider providerValidImagePositions
     */
    public function testSetWatermarkImagePositionWithValidPosition(string $position)
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setWatermarkImagePosition($position));
    }

    /**
     * Tests {@see Overlay::setWatermarkImagePosition()} with a valid position.
     */
    public function testSetWatermarkImagePositionWithInvalidPositionThrowsException()
    {
        $position = md5((string) time());

        $overlay = new Overlay();

        $validPositions = implode(', ', $overlay->getValidImagePositions());

        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(
            "Invalid image position '{$position}'. ".
            "Valid positions are: {$validPositions}"
        );

        $overlay->setWatermarkImagePosition($position);
    }

    /**
     * Tests {@see Overlay::setDowntimeEnabled()}.
     */
    public function testSetDowntimeEnabledImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setDowntimeEnabled(true));
    }

    /**
     * Tests {@see Overlay::setDowntimeImagePath()}.
     */
    public function testSetDowntimeImagePathImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setDowntimeImagePath(''));
    }

    /**
     * Tests {@see Overlay::setDowntimeImagePosition()} with a valid position.
     *
     * @param string $position Image position string.
     *
     * @dataProvider providerValidImagePositions
     */
    public function testSetDowntimeImagePositionWithValidPosition(string $position)
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setDowntimeImagePosition($position));
    }

    /**
     * Tests {@see Overlay::setDowntimeImagePosition()} with a valid position.
     */
    public function testSetDowntimeImagePositionWithInvalidPositionThrowsException(
    ) {
        $position = md5((string) time());

        $overlay = new Overlay();

        $validPositions = implode(', ', $overlay->getValidImagePositions());

        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(
            "Invalid image position '{$position}'. ".
            "Valid positions are: {$validPositions}"
        );

        $overlay->setDowntimeImagePosition($position);
    }

    /**
     * Tests {@see Overlay::setDowntimeStart()} with a valid time.
     */
    public function testSetDowntimeStartWithValidTime()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setDowntimeStart('22:00:00'));
    }

    /**
     * Tests {@see Overlay::setDowntimeStart()} with an invalid time.
     */
    public function testSetDowntimeStartWithInvalidTimeThrowsException()
    {
        $time = md5((string) time());

        $overlay = new Overlay();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Invalid time '{$time}'. Expected format: HH:MM:SS"
        );

        $overlay->setDowntimeStart($time);
    }

    /**
     * Tests {@see Overlay::setDowntimeEnd()} with a valid time.
     */
    public function testSetDowntimeEndWithValidTime()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setDowntimeEnd('22:00:00'));
    }

    /**
     * Tests {@see Overlay::setDowntimeEnd()} with an invalid time.
     */
    public function testSetDowntimeEndWithInvalidTimeThrowsException()
    {
        $time = md5((string) time());

        $overlay = new Overlay();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Invalid time '{$time}'. Expected format: HH:MM:SS"
        );

        $overlay->setDowntimeEnd($time);
    }

    /**
     * Tests {@see Overlay::setInfoTextEnabled()}.
     */
    public function testSetInfoTextEnabledImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setInfoTextEnabled(true));
    }

    /**
     * Tests {@see Overlay::setInfoTextContent()}.
     */
    public function testSetInfoTextContentImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setInfoTextContent(''));
    }

    /**
     * Tests {@see Overlay::setInfoTextFont()}.
     */
    public function testSetInfoTextFontImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setInfoTextFont(''));
    }

    /**
     * Tests {@see Overlay::setInfoTextFontSize()}.
     */
    public function testSetInfoTextFontSizeImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setInfoTextFontSize(12));
    }

    /**
     * Tests {@see Overlay::setInfoTextPositionX()}.
     */
    public function testSetInfoTextPositionXImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setInfoTextPositionX(14));
    }

    /**
     * Tests {@see Overlay::setInfoTextPositionY()}.
     */
    public function testSetInfoTextPositionYImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setInfoTextPositionY(14));
    }

    /**
     * Tests {@see Overlay::setInfoTextColor()} with a valid color.
     */
    public function testSetInfoTextColorWithValidColor()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setInfoTextColor([1, 2, 3]));
    }

    /**
     * Tests {@see Overlay::setInfoTextColor()} with an invalid color.
     */
    public function testSetInfoTextColorWithInvalidColorThrowsException()
    {
        $overlay = new Overlay();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid color array format.');

        $overlay->setInfoTextColor([]);
    }

    /**
     * Tests {@see Overlay::setInfoTextBorderEnabled()}.
     */
    public function testSetInfoTextBorderEnabledImplementsFluidInterface()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setInfoTextBorderEnabled(true));
    }

    /**
     * Tests {@see Overlay::setInfoTextBorderColor()} with a valid color.
     */
    public function testSetInfoTextBorderColorWithValidColor()
    {
        $overlay = new Overlay();

        $this->assertSame($overlay, $overlay->setInfoTextBorderColor([1, 2, 3]));
    }

    /**
     * Tests {@see Overlay::setInfoTextBorderColor()} with an invalid color.
     */
    public function testSetInfoTextBorderColorWithInvalidColorThrowsException()
    {
        $overlay = new Overlay();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid color array format.');

        $overlay->setInfoTextBorderColor([]);
    }

    /**
     * Tests Image::render() with a valid webcam image and no downtime.
     *
     * @dataProvider providerValidImagePositions
     *
     * @runInSeparateProcess
     *
     * @param string $overlayPos Overlay position.
     *
     * @throws \Exception
     */
    public function testRenderWithValidWebcamImageWithoutDowntime(string $overlayPos)
    {
        $dataDirPath = realpath(__DIR__.'/../../data');

        $overlay = new Overlay();

        $overlay
            ->setWebcamImagePath($dataDirPath.'/webcam.jpg')
            ->setOutputImageScale(1)
        ;

        $overlay
            ->setWatermarkEnabled(true)
            ->setWatermarkImagePath($dataDirPath.'/watermark.png')
            ->setWatermarkImagePosition($overlayPos)
        ;

        $overlay
            ->setDowntimeEnabled(false)
        ;

        $overlay
            ->setInfoTextEnabled(true)
            ->setInfoTextContent(' © example.com')
            ->setInfoTextFont($dataDirPath.'/vera.ttf')
            ->setInfoTextFontSize(9)
            ->setInfoTextPositionX(3)
            ->setInfoTextPositionY(188)
            ->setInfoTextColor([255, 255, 255])
            ->setInfoTextBorderEnabled(true)
            ->setInfoTextBorderColor([50, 50, 50])
        ;

        ob_start();
        $result = $overlay->render();
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
     * @throws \Exception
     */
    public function testRenderWithValidWebcamImageWithDowntime()
    {
        $dataDirPath = realpath(__DIR__.'/../../data');

        $overlay = new Overlay();

        $overlay
            ->setWebcamImagePath($dataDirPath.'/webcam.jpg')
            ->setOutputImageScale(1)
        ;

        $overlay
            ->setDowntimeEnabled(true)
            ->setDowntimeImagePath($dataDirPath.'/offline.png')
            ->setDowntimeImagePosition('center')
            ->setDowntimeStart('22:00:00')
            ->setDowntimeEnd('08:00:00')
        ;

        ob_start();
        $result = $overlay->render();
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
     * @throws \Exception
     */
    public function testRenderWithValidWebcamImageWithFakeDowntime(
        string $downtimeStart,
        string $downtimeEnd,
        string $fakedCurrentTime
    ) {
        $dataDirPath = realpath(__DIR__.'/../../data');

        $overlay = $this->getMockedOverlayForTime($fakedCurrentTime);

        $overlay
            ->setWebcamImagePath($dataDirPath.'/webcam.jpg')
            ->setOutputImageScale(1)
        ;

        $overlay
            ->setDowntimeEnabled(true)
            ->setDowntimeImagePath($dataDirPath.'/offline.png')
            ->setDowntimeImagePosition('center')
            ->setDowntimeStart($downtimeStart)
            ->setDowntimeEnd($downtimeEnd)
        ;

        ob_start();

        $result = $overlay->render();
        ob_end_clean();

        $this->assertSame($overlay, $result);
    }

    /**
     * Tests Image::render() with an invalid webcam image.
     *
     * @runInSeparateProcess
     *
     * @throws \Exception
     */
    public function testRenderWithInvalidWebcamImageThrowsException()
    {
        $dataDirPath = realpath(__DIR__.'/../../data');

        $overlay = new Overlay();

        $overlay
            ->setWebcamImagePath($dataDirPath.'/webcam-error.jpg')
            ->setOutputImageScale(1)
        ;

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("Couldn't read image at");

        $overlay->render();
    }

    /**
     * Tests Image::render() with an invalid webcam image and a downtime image.
     *
     * @runInSeparateProcess
     *
     * @throws \Exception
     */
    public function testRenderWithInvalidWebcamImageAndDownTimeImage()
    {
        $dataDirPath = realpath(__DIR__.'/../../data');

        $overlay = new Overlay();

        $overlay
            ->setWebcamImagePath($dataDirPath.'/webcam-error.jpg')
            ->setOutputImageScale(1)
            ->setDowntimeImagePath($dataDirPath.'/offline.png')
        ;

        ob_start();
        $result = $overlay->render();
        ob_end_clean();

        $this->assertSame($overlay, $result);
    }

    /**
     * Data provider for image positions.
     */
    public function providerValidImagePositions(): \Generator
    {
        $overlay = new Overlay();
        foreach ($overlay->getValidImagePositions() as $position) {
            yield [$position];
        }
    }

    /**
     * Data provider for downtimes.
     */
    public function providerDownTimes(): \Generator
    {
        yield ['08:00:00', '10:00:00', '090000'];

        yield ['08:00:00', '09:00:00', '100000'];

        yield ['22:00:00', '08:00:00', '230000'];

        yield ['22:00:00', '08:00:00', '210000'];
    }

    /**
     * Returns a mocked Overlay instance where {@see Overlay::getTime()}
     * returns the given $time.
     *
     * @param string $time Time in His format.
     */
    protected function getMockedOverlayForTime(string $time): Overlay
    {
        $mock = $this->getMockBuilder(Overlay::class)
            ->onlyMethods(['getTime'])
            ->getMock()
        ;

        $mock->expects($this->atLeastOnce())
            ->method('getTime')
            ->willReturn($time)
        ;

        return $mock;
    }
}
