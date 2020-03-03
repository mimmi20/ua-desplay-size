<?php
/**
 * This file is part of the ua-display-size package.
 *
 * Copyright (c) 2018-2020, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaDisplaySize;

use BrowserDetector\Loader\LoaderInterface;

interface TypeLoaderInterface extends LoaderInterface
{
    /**
     * @param string $key
     *
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return \UaDisplaySize\DisplayTypeInterface
     */
    public function load(string $key): DisplayTypeInterface;

    /**
     * @param int|null $height
     * @param int|null $width
     *
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return \UaDisplaySize\DisplayTypeInterface
     */
    public function loadByDimensions(?int $height, ?int $width): DisplayTypeInterface;
}
