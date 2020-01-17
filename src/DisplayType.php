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

trait DisplayType
{
    /**
     * Returns the type name of the display
     *
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * Returns the Width of the Display
     *
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return self::WIDTH;
    }

    /**
     * Returns the Height of the Display
     *
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return self::HEIGHT;
    }
}
