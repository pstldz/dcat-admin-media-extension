<?php

namespace Pstldz\MediaExtension;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Pstldz\MediaExtension\Form\SingleFile;
use Pstldz\MediaExtension\Form\Photo;
use Pstldz\MediaExtension\Form\Files;
use Pstldz\MediaExtension\Form\Photos;
use Pstldz\MediaExtension\Form\Video;
use Pstldz\MediaExtension\Form\Videos;

class MediaExtensionServiceProvider extends ServiceProvider
{
    protected $css = [
        'css/index.css'
    ];

    protected $js = [
        'js/index.js',
        'js/jquery.dragsort.js'
    ];

	public function init()
	{
		parent::init();
        if($views=$this->getViewPath()){
            $this->loadViewsFrom($views, 'media_extension');
        }
        Admin::requireAssets('@pstldz.media-extension');
        Admin::booting(function (){
            Form::extend('photo',Photo::class);
            Form::extend('singleFile', SingleFile::class);
            Form::extend('files', Files::class);
            Form::extend('photos', Photos::class);
            Form::extend('video', Video::class);
            Form::extend('videos', Videos::class);
        });

        Admin::booting(function () {
            $script = "
            window.LakeFormMediaLang = {
                'empty': '" . static::trans('form-media.js_empty') . "',
                'system_tip': '" . static::trans('form-media.js_system_tip') . "',
                'remove_tip': '" . static::trans('form-media.js_remove_tip') . "',
                'select_type': '" . static::trans('form-media.js_select_type') . "',
                'page_render': '" . static::trans('form-media.js_page_render') . "',
                'dir_not_empty': '" . static::trans('form-media.js_dir_not_empty') . "',
                'create_dir_error': '" . static::trans('form-media.js_create_dir_error') . "',
                'upload_error': '" . static::trans('form-media.js_upload_error') . "',
                'selected_error': '" . static::trans('form-media.js_selected_error') . "',
                'getdata_error': '" . static::trans('form-media.js_getdata_error') . "',
                'preview_title': '" . static::trans('form-media.js_preview_title') . "',
                'preview': '" . static::trans('form-media.js_preview') . "',
                'remove': '" . static::trans('form-media.js_remove') . "',
                'dragsort': '" . static::trans('form-media.js_dragsort') . "',
                'copy_success': '" . static::trans('form-media.js_copy_success') . "',
                'copy_error': '" . static::trans('form-media.js_copy_error') . "',
            };
            ";
            Admin::script($script);
        });

	}

}
