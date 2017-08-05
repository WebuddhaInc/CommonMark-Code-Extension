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

class CodeParser extends AbstractBlockParser
{
    const REGEXP_DEFINITION = '/\{code[:\s](.*?)\}/';

    public function parse(ContextInterface $context, Cursor $cursor)
    {
        $match = RegexHelper::matchAll(self::REGEXP_DEFINITION, $cursor->getLine(), $cursor->getFirstNonSpacePosition());
        if (null === $match) {
            return false;
        }
        $code = new Code(array(
            'file' => $match[1]
            ));
        $context->addBlock($code);
    }

}
