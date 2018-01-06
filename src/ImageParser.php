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


use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\Block\Parser\AbstractBlockParser;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;
use League\CommonMark\Util\RegexHelper;

class ImageParser extends AbstractBlockParser
{

    const REGEXP_DEFINITION = '/\!\[(.*)\]\((.*?)[\)\s](.*?)\)*$/';

    public function parse(ContextInterface $context, Cursor $cursor)
    {
        $match = RegexHelper::matchAll(self::REGEXP_DEFINITION, trim($cursor->getLine()), $cursor->getFirstNonSpacePosition());
        if ($match) {
            $extra = (array)json_decode($match[3]);
            if (empty($extra) && strlen($match[3]))
                $extra = array('title' => $match[3]);
            $image = new Image(array_merge(array(
                'alt' => $match[1],
                'src' => $match[2]
                ), $extra));
            $context->addBlock($image);
        }
        return false;
    }

}
