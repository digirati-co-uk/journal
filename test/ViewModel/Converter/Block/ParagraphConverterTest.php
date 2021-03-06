<?php

namespace test\eLife\Journal\ViewModel\Converter\Block;

use eLife\ApiSdk\Model\Block;
use eLife\Journal\ViewModel\Converter\Block\ParagraphConverter;
use eLife\Patterns\ViewModel;

final class ParagraphConverterTest extends BlockConverterTestCase
{
    protected $blockClass = Block\Paragraph::class;
    protected $viewModelClasses = [ViewModel\Paragraph::class];

    /**
     * @before
     */
    public function setUpConverter()
    {
        $this->converter = new ParagraphConverter();
    }
}
