<?php

namespace Pstldz\MediaExtension\Form;

use Dcat\Admin\Form\Field\MultipleFile;
use Pstldz\MediaExtension\Traits\MediaForm;

class Videos extends MultipleFile
{
    use MediaForm;

    protected $type = 'video';
    protected $multipleChoice = 1;
    protected $remove = true;

    public function render()
    {
        if (! isset($this->options['accept'])) {
            $this->options['accept'] = [];
        }
        $this->options['accept']['mimeTypes'] = 'video/*';
        $this->beforeRender();
        return parent::render();
    }
}
