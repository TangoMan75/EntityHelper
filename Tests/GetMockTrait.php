<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Tests;

trait GetMockTrait
{
    /**
     * @param string $fileName
     * @param string $folder
     *
     * @return array
     */
    public function getMockItem($fileName, $folder = 'json')
    {
        $content = $this->getMockItemContent($fileName, $folder);

        switch (pathinfo($fileName, PATHINFO_EXTENSION)) {
            case 'xml':
                $result = json_decode(json_encode((array)simplexml_load_string($content)), true);
                break;
            case 'json':
                $result = json_decode($content, true);
                break;
            default:
                $result = $content;
        }

        return $result;
    }

    /**
     * @param string $fileName
     * @param string $folder
     *
     * @return string
     */
    public function getMockItemContent($fileName, $folder = 'json')
    {
        return file_get_contents(__DIR__.'/Fixtures/'.$folder.'/'.$fileName);
    }
}