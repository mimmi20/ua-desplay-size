<?php
/**
 * This file is part of the ua-display-size package.
 *
 * Copyright (c) 2018-2019, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaDisplaySizeTest;

use PHPUnit\Framework\TestCase;
use UaDisplaySize\Hdwxga;
use UaDisplaySize\TypeLoader;
use UaDisplaySize\Unknown;

/**
 * Test class for \BrowserDetector\Loader\BrowserLoader
 */
final class TypeLoaderTest extends TestCase
{
    /**
     * @var \UaDisplaySize\TypeLoader
     */
    private $object;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->object = new TypeLoader();
    }

    /**
     * @return void
     */
    public function testHasUnknown(): void
    {
        self::assertTrue($this->object->has('unknown'));
    }

    /**
     * @return void
     */
    public function testHasNotWong(): void
    {
        self::assertFalse($this->object->has('does not exist'));
    }

    /**
     * @return void
     */
    public function testLoadUnknown(): void
    {
        $type = $this->object->load('unknown');

        self::assertInstanceOf(Unknown::class, $type);
        self::assertNull($type->getWidth());
        self::assertNull($type->getHeight());
    }

    /**
     * @return void
     */
    public function testLoadNotAvailable(): void
    {
        $this->expectException(\BrowserDetector\Loader\NotFoundException::class);
        $this->expectExceptionMessage('the display type type with key "does not exist" was not found');

        $this->object->load('does not exist');
    }

    /**
     * @return void
     */
    public function testLoadByDimensions(): void
    {
        $width  = 1280;
        $height = 720;

        $type = $this->object->loadByDiemsions($height, $width);

        self::assertInstanceOf(Hdwxga::class, $type);
        self::assertSame($width, $type->getWidth());
        self::assertSame($height, $type->getHeight());
    }

    /**
     * @return void
     */
    public function testLoadByUnknownDimensions(): void
    {
        $width  = 2;
        $height = 1;

        $type = $this->object->loadByDiemsions($height, $width);

        self::assertInstanceOf(Unknown::class, $type);
        self::assertNull($type->getWidth());
        self::assertNull($type->getHeight());
    }
}
