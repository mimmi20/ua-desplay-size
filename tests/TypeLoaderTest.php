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
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @return void
     */
    public function testHasUnknown(): void
    {
        static::assertTrue($this->object->has('unknown'));
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @return void
     */
    public function testHasNotWong(): void
    {
        static::assertFalse($this->object->has('does not exist'));
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return void
     */
    public function testLoadUnknown(): void
    {
        $type = $this->object->load('unknown');

        static::assertInstanceOf(Unknown::class, $type);
        static::assertNull($type->getWidth());
        static::assertNull($type->getHeight());
    }

    /**
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return void
     */
    public function testLoadNotAvailable(): void
    {
        $this->expectException(\BrowserDetector\Loader\NotFoundException::class);
        $this->expectExceptionMessage('the display type type with key "does not exist" was not found');

        $this->object->load('does not exist');
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return void
     */
    public function testLoadByDimensions(): void
    {
        $width  = 1280;
        $height = 720;

        $type = $this->object->loadByDiemsions($height, $width);

        static::assertInstanceOf(Hdwxga::class, $type);
        static::assertSame($width, $type->getWidth());
        static::assertSame($height, $type->getHeight());
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return void
     */
    public function testLoadByUnknownDimensions(): void
    {
        $width  = 2;
        $height = 1;

        $type = $this->object->loadByDiemsions($height, $width);

        static::assertInstanceOf(Unknown::class, $type);
        static::assertNull($type->getWidth());
        static::assertNull($type->getHeight());
    }
}
