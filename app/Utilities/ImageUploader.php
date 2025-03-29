<?php

namespace App\Utilities;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    /**
     * آپلود تصویر و ذخیره آن در مسیر مشخص
     *
     * @param \Illuminate\Http\UploadedFile $image فایل تصویر آپلود شده
     * @param string $folder پوشه مقصد برای ذخیره تصویر
     * @return string مسیر فایل ذخیره شده
     */
    public static function upload($image, $folder)
    {
        // بررسی وجود فایل و پوشه
        if (!$image || !$folder) {
            throw new \InvalidArgumentException('تصویر یا پوشه معتبر نیست.');
        }

        // نام فایل را با زمان فعلی ترکیب می‌کند تا یکتا باشد
        $fileName = time() . '_' . $image->getClientOriginalName();

        // ذخیره فایل در پوشه مشخص‌شده در ذخیره‌سازی public
        $filePath = $image->storeAs($folder, $fileName, 'public_storage');

        // برگرداندن مسیر فایل ذخیره شده
        return $filePath;
    }
}