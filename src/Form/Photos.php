<?php

namespace Pstldz\MediaExtension\Form;

use Dcat\Admin\Form\Field\MultipleImage as BaseMultipleImage;
use Pstldz\MediaExtension\Traits\MediaForm;

class Photos extends BaseMultipleImage
{
    use MediaForm;

    protected $type = 'image';
    protected $multipleChoice = 1;
    protected $remove = true;

    public function render()
    {
        $this->beforeRender();
        return parent::render();
    }
}
