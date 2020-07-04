<?php

use Microboard\Models\Setting;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

if (!function_exists('setting')) {
    /**
     * Get value from settings table.
     *
     * @param null $key
     * @param null $default
     * @return Setting|string|null
     */
    function setting($key = null, $default = null)
    {
        if ($key === null) {
            return new Setting;
        }

        return Setting::getValueFor($key, $default);
    }
}

if (!function_exists('addMediaTo')) {
    /**
     * Add media to collection.
     *
     * @param HasMedia $model
     * @param string $collection
     * @param string $input
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    function addMediaTo(HasMedia $model, $collection = 'default', $input = 'file')
    {
        if (request()->has($input)) {
            $file = request()->input($input);

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
