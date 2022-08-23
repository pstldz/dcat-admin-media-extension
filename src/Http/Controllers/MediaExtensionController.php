<?php

namespace Pstldz\MediaExtension\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Routing\Controller;
use Pstldz\MediaExtension\MediaManager;

class MediaExtensionController extends Controller
{
    protected $storage;
    protected $path='';

    public function getFiles()
    {
        $path = request()->input('path', '/');

        $currentPage = (int) request()->input('page', 1);
        $perPage = (int) request()->input('pageSize', 120);

        $manager = MediaManager::create()
            ->defaultDisk()
            ->setPath($path);

        // 驱动磁盘
        $disk = request()->input('disk', '');
        if (! empty($disk)) {
            $manager = $manager->withDisk($disk);
        }

        $type = (string) request()->input('type', 'image');
        $order = (string) request()->input('order', 'time');

        $files = $manager->ls($type, $order);
        $list = collect($files)
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->values();

        $totalPage = count(collect($files)->chunk($perPage));

        $data = [
            'list' => $list, // 数据
            'total_page' => $totalPage, // 数量
            'current_page' => $currentPage, // 当前页码
            'per_page' => $perPage, // 每页数量
            'nav' => $manager->navigation()  // 导航
        ];

        return $this->renderJson(trans('admin.succeeded'), 200, $data);
    }

    protected function renderJson($msg, $code = 200, $data = [])
    {
        return response()->json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
    }

}
