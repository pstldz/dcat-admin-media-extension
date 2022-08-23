<?php

namespace Pstldz\MediaExtension\Form;

use Dcat\Admin\Form\Field\Image as BaseImage;
use Pstldz\MediaExtension\Traits\MediaForm;

class Photo extends BaseImage
{
    use MediaForm;

    protected $type = 'image';
    protected $multipleChoice = 0;
    protected $remove=true;
    protected $limit=1;

    public function render()
    {
        $this->beforeRender();
        return parent::render();
    }

}

