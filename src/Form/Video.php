<?php

namespace Pstldz\MediaExtension\Form;

use Dcat\Admin\Form\Field\File;
use Pstldz\MediaExtension\Traits\MediaForm;

class Video extends File
{
    use MediaForm;

    protected $type = 'video';
    protected $multipleChoice = 0;
    protected $limit = 1;
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
