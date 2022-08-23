<?php

namespace Pstldz\MediaExtension\Form;

use Dcat\Admin\Form\Field\MultipleFile as BaseMultipleFile;
use Pstldz\MediaExtension\Traits\MediaForm;

class Files extends BaseMultipleFile
{
    use MediaForm;

    protected $type = 'blend';
    protected $multipleChoice = 1;

    public function render()
    {
        $this->beforeRender();
        return parent::render();
    }
}
