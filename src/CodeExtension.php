<?php

/*
 * This is part of the webuddhainc/commonmark-code-extension package.
 *
 * (c) Webuddha, Holodyn Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WebuddhaInc\CommonMark\CodeExtension;

use League\CommonMark\Extension\Extension;

class CodeExtension extends Extension
{

    public function getName()
    {
        return 'code';
    }


    public function getBlockParsers()
    {
        return [
            new CodeParser(),
            ];
    }

    public function getBlockRenderers()
    {
        return [
            __NAMESPACE__.'\\Code' => new CodeRenderer()
        ];
    }

}
