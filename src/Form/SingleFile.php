<?php

namespace Pstldz\MediaExtension\Form;

use Dcat\Admin\Form\Field\File as BaseFile;
use Pstldz\MediaExtension\Traits\MediaForm;

class SingleFile extends BaseFile
{
    use MediaForm;

    protected $type = 'blend';
    protected $multipleChoice = 0;
    protected $limit=1;

    public function render()
    {
        $this->beforeRender();
        return parent::render();
    }
}
