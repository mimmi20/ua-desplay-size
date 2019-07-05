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
namespace UaDisplaySize;

use BrowserDetector\Loader\NotFoundException;

final class TypeLoader implements TypeLoaderInterface
{
    private const OPTIONS = [
        Cga::TYPE => Cga::class,
        Custom48x100::TYPE => Custom48x100::class,
        Custom60x96::TYPE => Custom60x96::class,
        Custom64x101::TYPE => Custom64x101::class,
        Custom65x96::TYPE => Custom65x96::class,
        Custom72x96::TYPE => Custom72x96::class,
        Custom72x120::TYPE => Custom72x120::class,
        Custom80x101::TYPE => Custom80x101::class,
        Custom92x96::TYPE => Custom92x96::class,
        Custom96x252::TYPE => Custom96x252::class,
        Custom120x120::TYPE => Custom120x120::class,
        Custom120x130::TYPE => Custom120x130::class,
        Custom128x128::TYPE => Custom128x128::class,
        Custom128x160::TYPE => Custom128x160::class,
        Custom132x160::TYPE => Custom132x160::class,
        Custom132x176::TYPE => Custom132x176::class,
        Custom136x176::TYPE => Custom136x176::class,
        Custom144x176::TYPE => Custom144x176::class,
        Custom144x192::TYPE => Custom144x192::class,
        Custom144x256::TYPE => Custom144x256::class,
        Custom164x176::TYPE => Custom164x176::class,
        Custom176x208::TYPE => Custom176x208::class,
        Custom176x220::TYPE => Custom176x220::class,
        Custom192x256::TYPE => Custom192x256::class,
        Custom200x640::TYPE => Custom200x640::class,
        Custom208x320::TYPE => Custom208x320::class,
        Custom240x240::TYPE => Custom240x240::class,
        Custom240x260::TYPE => Custom240x260::class,
        Custom240x427::TYPE => Custom240x427::class,
        Custom272x480::TYPE => Custom272x480::class,
        Custom280x280::TYPE => Custom280x280::class,
        Custom280x400::TYPE => Custom280x400::class,
        Custom312x390::TYPE => Custom312x390::class,
        Custom320x320::TYPE => Custom320x320::class,
        Custom320x400::TYPE => Custom320x400::class,
        Custom320x533::TYPE => Custom320x533::class,
        Custom324x352::TYPE => Custom324x352::class,
        Custom345x800::TYPE => Custom345x800::class,
        Custom352x416::TYPE => Custom352x416::class,
        Custom352x800::TYPE => Custom352x800::class,
        Custom360x360::TYPE => Custom360x360::class,
        Custom360x400::TYPE => Custom360x400::class,
        Custom360x480::TYPE => Custom360x480::class,
        Custom368x448::TYPE => Custom368x448::class,
        Custom400x800::TYPE => Custom400x800::class,
        Custom432x800::TYPE => Custom432x800::class,
        Custom470x800::TYPE => Custom470x800::class,
        Custom480x690::TYPE => Custom480x690::class,
        Custom480x696::TYPE => Custom480x696::class,
        Custom480x840::TYPE => Custom480x840::class,
        Custom480x845::TYPE => Custom480x845::class,
        Custom480x1024::TYPE => Custom480x1024::class,
        Custom540x897::TYPE => Custom540x897::class,
        Custom544x960::TYPE => Custom544x960::class,
        Custom600x750::TYPE => Custom600x750::class,
        Custom640x1024::TYPE => Custom640x1024::class,
        Custom640x1136::TYPE => Custom640x1136::class,
        Custom640x1280::TYPE => Custom640x1280::class,
        Custom720x720::TYPE => Custom720x720::class,
        Custom720x960::TYPE => Custom720x960::class,
        Custom720x1024::TYPE => Custom720x1024::class,
        Custom720x1152::TYPE => Custom720x1152::class,
        Custom720x1200::TYPE => Custom720x1200::class,
        Custom720x1440::TYPE => Custom720x1440::class,
        Custom720x1480::TYPE => Custom720x1480::class,
        Custom720x1512::TYPE => Custom720x1512::class,
        Custom720x1520::TYPE => Custom720x1520::class,
        Custom720x1528::TYPE => Custom720x1528::class,
        Custom720x1560::TYPE => Custom720x1560::class,
        Custom720x1820::TYPE => Custom720x1820::class,
        Custom736x1280::TYPE => Custom736x1280::class,
        Custom750x1334::TYPE => Custom750x1334::class,
        Custom752x1280::TYPE => Custom752x1280::class,
        Custom768x960::TYPE => Custom768x960::class,
        Custom768x968::TYPE => Custom768x968::class,
        Custom768x976::TYPE => Custom768x976::class,
        Custom768x1336::TYPE => Custom768x1336::class,
        Custom800x1024::TYPE => Custom800x1024::class,
        Custom800x1200::TYPE => Custom800x1200::class,
        Custom828x1792::TYPE => Custom828x1792::class,
        Custom864x1280::TYPE => Custom864x1280::class,
        Custom864x1536::TYPE => Custom864x1536::class,
        Custom900x1200::TYPE => Custom900x1200::class,
        Custom960x1136::TYPE => Custom960x1136::class,
        Custom960x1280::TYPE => Custom960x1280::class,
        Custom1032x1920::TYPE => Custom1032x1920::class,
        Custom1072x1448::TYPE => Custom1072x1448::class,
        Custom1080x1440::TYPE => Custom1080x1440::class,
        Custom1080x1620::TYPE => Custom1080x1620::class,
        Custom1080x1800::TYPE => Custom1080x1800::class,
        Custom1080x2040::TYPE => Custom1080x2040::class,
        Custom1080x2160::TYPE => Custom1080x2160::class,
        Custom1080x2220::TYPE => Custom1080x2220::class,
        Custom1080x2240::TYPE => Custom1080x2240::class,
        Custom1080x2244::TYPE => Custom1080x2244::class,
        Custom1080x2246::TYPE => Custom1080x2246::class,
        Custom1080x2248::TYPE => Custom1080x2248::class,
        Custom1080x2280::TYPE => Custom1080x2280::class,
        Custom1080x2310::TYPE => Custom1080x2310::class,
        Custom1080x2316::TYPE => Custom1080x2316::class,
        Custom1080x2340::TYPE => Custom1080x2340::class,
        Custom1080x2400::TYPE => Custom1080x2400::class,
        Custom1080x2520::TYPE => Custom1080x2520::class,
        Custom1080x2560::TYPE => Custom1080x2560::class,
        Custom1080x3840::TYPE => Custom1080x3840::class,
        Custom1125x2436::TYPE => Custom1125x2436::class,
        Custom1152x1920::TYPE => Custom1152x1920::class,
        Custom1242x2688::TYPE => Custom1242x2688::class,
        Custom1280x1920::TYPE => Custom1280x1920::class,
        Custom1312x2560::TYPE => Custom1312x2560::class,
        Custom1440x2160::TYPE => Custom1440x2160::class,
        Custom1440x2560::TYPE => Custom1440x2560::class,
        Custom1440x2880::TYPE => Custom1440x2880::class,
        Custom1440x2960::TYPE => Custom1440x2960::class,
        Custom1440x3040::TYPE => Custom1440x3040::class,
        Custom1440x3120::TYPE => Custom1440x3120::class,
        Custom1536x2560::TYPE => Custom1536x2560::class,
        Custom1644x3840::TYPE => Custom1644x3840::class,
        Custom1668x2224::TYPE => Custom1668x2224::class,
        Custom1800x2560::TYPE => Custom1800x2560::class,
        Custom1824x2736::TYPE => Custom1824x2736::class,
        Custom2000x3000::TYPE => Custom2000x3000::class,
        Custom2048x2732::TYPE => Custom2048x2732::class,
        Custom2048x2736::TYPE => Custom2048x2736::class,
        Custom3000x4500::TYPE => Custom3000x4500::class,
        Dci2k::TYPE => Dci2k::class,
        Dci4k::TYPE => Dci4k::class,
        Dvga::TYPE => Dvga::class,
        Fhd::TYPE => Fhd::class,
        Fwqvga1::TYPE => Fwqvga1::class,
        Fwqvga2::TYPE => Fwqvga2::class,
        Fwvga1::TYPE => Fwvga1::class,
        Fwvga2::TYPE => Fwvga2::class,
        Fwxga::TYPE => Fwxga::class,
        Fwxgaplus::TYPE => Fwxgaplus::class,
        Hdplus::TYPE => Hdplus::class,
        Hdwxga::TYPE => Hdwxga::class,
        Hqvga::TYPE => Hqvga::class,
        Hsxga::TYPE => Hsxga::class,
        Huxga::TYPE => Huxga::class,
        Hvga::TYPE => Hvga::class,
        Hxga::TYPE => Hxga::class,
        K4uhd::TYPE => K4uhd::class,
        K5uhd::TYPE => K5uhd::class,
        K8uhd::TYPE => K8uhd::class,
        Nhd::TYPE => Nhd::class,
        Qhd::TYPE => Qhd::class,
        Qhdq::TYPE => Qhdq::class,
        Qqvga::TYPE => Qqvga::class,
        Qsxga::TYPE => Qsxga::class,
        Quxga::TYPE => Quxga::class,
        Qvga::TYPE => Qvga::class,
        Qwxga::TYPE => Qwxga::class,
        Qwxgaplus::TYPE => Qwxgaplus::class,
        Qxga::TYPE => Qxga::class,
        Svga::TYPE => Svga::class,
        Sxga::TYPE => Sxga::class,
        Sxgaplus::TYPE => Sxgaplus::class,
        Unknown::TYPE => Unknown::class,
        Uvga::TYPE => Uvga::class,
        Uw5k::TYPE => Uw5k::class,
        Uw8k::TYPE => Uw8k::class,
        Uwqhd::TYPE => Uwqhd::class,
        Uwuxga::TYPE => Uwuxga::class,
        Uxga::TYPE => Uxga::class,
        Vga::TYPE => Vga::class,
        Whsxga::TYPE => Whsxga::class,
        Whuxga::TYPE => Whuxga::class,
        Wqsxga::TYPE => Wqsxga::class,
        Wquxga::TYPE => Wquxga::class,
        Wqvga1::TYPE => Wqvga1::class,
        Wqvga2::TYPE => Wqvga2::class,
        Wqvga3::TYPE => Wqvga3::class,
        Wqvga4::TYPE => Wqvga4::class,
        Wqxga::TYPE => Wqxga::class,
        Wsvga1::TYPE => Wsvga1::class,
        Wsvga2::TYPE => Wsvga2::class,
        Wsxga::TYPE => Wsxga::class,
        Wsxgaplus::TYPE => Wsxgaplus::class,
        Wuxga::TYPE => Wuxga::class,
        Wvga1::TYPE => Wvga1::class,
        Wvga2::TYPE => Wvga2::class,
        Wvga3::TYPE => Wvga3::class,
        Wxga1::TYPE => Wxga1::class,
        Wxga2::TYPE => Wxga2::class,
        Wxga3::TYPE => Wxga3::class,
        Wxgaplus::TYPE => Wxgaplus::class,
        Xga::TYPE => Xga::class,
        Xgaplus::TYPE => Xgaplus::class,
    ];

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, self::OPTIONS);
    }

    /**
     * @param string $key
     *
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return \UaDisplaySize\DisplayTypeInterface
     */
    public function load(string $key): DisplayTypeInterface
    {
        if (!$this->has($key)) {
            throw new NotFoundException('the display type type with key "' . $key . '" was not found');
        }

        $className = self::OPTIONS[$key];

        return new $className();
    }

    /**
     * @param int|null $height
     * @param int|null $width
     *
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return \UaDisplaySize\DisplayTypeInterface
     */
    public function loadByDiemsions(?int $height, ?int $width): DisplayTypeInterface
    {
        $options = self::OPTIONS;
        unset($options[Unknown::TYPE]);
        $maxWidth  = max($height, $width);
        $minHeight = min($height, $width);

        foreach ($options as $key => $className) {
            /** @var DisplayTypeInterface $class */
            $class = new $className();

            if ($minHeight === $class->getHeight() && $maxWidth === $class->getWidth()) {
                return $this->load($key);
            }
        }

        return $this->load(Unknown::TYPE);
    }
}
