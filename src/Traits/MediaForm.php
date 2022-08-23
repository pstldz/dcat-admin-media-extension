<?php

namespace Pstldz\MediaExtension\Traits;

use Dcat\Admin\Admin;
use Pstldz\MediaExtension\MediaManager;

trait MediaForm
{

    protected $pageSize = 120;
    protected $path = '';


    /**
     * 设置每页数量
     *
     * @param int $pageSize
     * @return $this
     */
    public function pageSize($pageSize = 120)
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * 设置当前可用目录
     *
     * @param string $path
     * @return $this
     */
    public function path($path = '')
    {
        $this->path = $path;

        return $this;
    }


    /**
     * 设置类型
     *
     * 类型包括：blend、image、xls、word、ppt、pdf、code、zip、text、audio、video
     * 其中 blend 为全部类型
     *
     * @param string $type
     * @return $this
     */
    public function type($type = 'image')
    {
        $this->type = $type;

        return $this;
    }

    public function beforeRender()
    {
        Admin::requireAssets('@pstldz.media-extension');
        $this->view = 'media_extension::index';
        $rootpath = MediaManager::create()
            ->defaultDisk()
            ->buildUrl('');

        $this->addVariables([
            'formOptions' => [
                'path' => $this->path,
                'limit' => $this->limit ?? null,
                'remove' => $this->remove ?? true,
                'type' => $this->type ?? 'image',
                'disk' => config('admin.upload.disk'),

                'pagesize' => $this->pageSize,

                'showtitle' => $this->showTitle??1,
                'multiplechoice' => $this->multipleChoice ?? 0,


                'get_files_url'=> admin_route('admin.media-extension.get-files'),
                'rootpath' => $rootpath,

            ],
        ]);
    }

}
