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

final class Hqvga implements DisplayTypeInterface
{
    use DisplayType;

    public const TYPE = 'HQVGA';

    /**
     * the display with
     */
    private const WIDTH = 240;

    /**
     * the display height
     */
    private const HEIGHT = 160;
}
