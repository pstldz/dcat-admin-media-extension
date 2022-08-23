<?php

use Pstldz\MediaExtension\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('media-extension/get-files', Controllers\MediaExtensionController::class.'@getFiles')->name('admin.media-extension.get-files');
