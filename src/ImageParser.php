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

    const REGEXP_DEFINITION = '/^\!\[(.*)\]\((.*?)\)$/';

    public function parse(ContextInterface $context, Cursor $cursor)
    {
        $match = RegexHelper::matchAll(self::REGEXP_DEFINITION, trim($cursor->getLine()), $cursor->getFirstNonSpacePosition());
        if ($match) {
            $extra = array();
            $src = $match[2];
            if (preg_match('/^(.*?)\s(.*)$/', $src, $smatch)) {
                $src = $smatch[1];
                $extra = (array)json_decode($smatch[2]);
                if (empty($extra) && strlen($smatch[2]))
                    $extra = array('title' => $smatch[2]);
            }
            $image = new Image(array_merge(array(
                'alt' => $match[1],
                'src' => $src
                ), $extra));
            $context->addBlock($image);
        }
        return false;
    }

}
