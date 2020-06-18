<?php

if (! function_exists('setting')) {
    function setting($key = null, $default = null) {
        if ($key === null) {
            return new Microboard\Models\Setting;
        }

        return \Microboard\Models\Setting::getValueFor($key, $default);
    }
}

if (! function_exists('addMediaTo')) {
    function addMediaTo(\Spatie\MediaLibrary\HasMedia $model, $collection = 'default') {
        if (request()->has('file')) {
            $file = request()->input('file');

            if (is_array($file)) {
                foreach ($file as $_file) {
                    $model->addMedia(storage_path("tmp/{$_file}"))->toMediaCollection($collection);
                }
            } else {
                $model->addMedia(storage_path("tmp/{$file}"))->toMediaCollection($collection);
            }
        }
    }
}
