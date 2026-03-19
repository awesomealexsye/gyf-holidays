<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Get WebP version of an image path if it exists, otherwise return original.
     */
    public static function webp(string $path): string
    {
        // Skip external URLs
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $webpPath = preg_replace('/\.(png|jpe?g|gif)$/i', '.webp', $path);

        if ($webpPath !== $path && file_exists(public_path(ltrim($webpPath, '/')))) {
            return $webpPath;
        }

        return $path;
    }
}
