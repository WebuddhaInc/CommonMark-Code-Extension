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

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;

class ImageRenderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        if (!($block instanceof Image)) {
            throw new \InvalidArgumentException('Incompatible block type: '.get_class($block));
        }
        return new HtmlElement('img', $block->data);
    }
}
