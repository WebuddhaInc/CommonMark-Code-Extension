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

class CodeRenderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        if (!($block instanceof Code)) {
            throw new \InvalidArgumentException('Incompatible block type: '.get_class($block));
        }
        $attrs = [
            'class' => 'file'
            ];
        foreach ($block->getData('attributes', []) as $key => $value) {
            $attrs[$key] = $htmlRenderer->escape($value, true);
        }
        $file = $block->getData('file');
        $content = $file . ' not found';
        $localDir = defined('LOCAL_DIR') ? LOCAL_DIR : '';
        if (is_readable($localDir . $file)) {
            $content = file_get_contents($localDir . $file);
        }
        $separator = $htmlRenderer->getOption('inner_separator', "\n");
        return new HtmlElement('pre', $attrs, new HtmlElement('code', [], $separator.$htmlRenderer->escape($content).$separator));
    }
}
