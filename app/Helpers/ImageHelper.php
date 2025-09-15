<?php

namespace App\Helpers;

use App\Services\ImageOptimizationService;

class ImageHelper
{
    /**
     * Generate optimized image HTML with lazy loading
     *
     * @param string|null $imagePath
     * @param string $alt
     * @param array $attributes
     * @param bool $useThumbnail
     * @return string
     */
    public static function lazyImage(
        ?string $imagePath,
        string $alt = '',
        array $attributes = [],
        bool $useThumbnail = false
    ): string {
        $imageService = new ImageOptimizationService();
        
        if (!$imagePath) {
            return self::placeholderImage($alt, $attributes);
        }

        $imageUrl = $imageService->getImageUrl($imagePath, $useThumbnail);
        
        if (!$imageUrl) {
            return self::placeholderImage($alt, $attributes);
        }

        // Default attributes
        $defaultAttributes = [
            'loading' => 'lazy',
            'class' => 'img-fluid lazy-image',
            'data-src' => $imageUrl,
            'src' => 'data:image/svg+xml;base64,' . base64_encode(self::getPlaceholderSvg()),
        ];

        // Merge with custom attributes
        $attributes = array_merge($defaultAttributes, $attributes);
        $attributes['alt'] = $alt;

        // Build HTML attributes string
        $attributeString = '';
        foreach ($attributes as $key => $value) {
            $attributeString .= sprintf(' %s="%s"', $key, htmlspecialchars($value));
        }

        return sprintf('<img%s>', $attributeString);
    }

    /**
     * Generate responsive image HTML with multiple sizes
     *
     * @param string|null $imagePath
     * @param string $alt
     * @param array $attributes
     * @return string
     */
    public static function responsiveImage(
        ?string $imagePath,
        string $alt = '',
        array $attributes = []
    ): string {
        $imageService = new ImageOptimizationService();
        
        if (!$imagePath) {
            return self::placeholderImage($alt, $attributes);
        }

        $imageUrl = $imageService->getImageUrl($imagePath);
        $thumbnailUrl = $imageService->getImageUrl($imagePath, true);
        
        if (!$imageUrl) {
            return self::placeholderImage($alt, $attributes);
        }

        // Default attributes
        $defaultAttributes = [
            'loading' => 'lazy',
            'class' => 'img-fluid responsive-image',
            'sizes' => '(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 33vw',
        ];

        // Build srcset
        $srcset = $imageUrl;
        if ($thumbnailUrl) {
            $srcset = $thumbnailUrl . ' 300w, ' . $imageUrl . ' 1200w';
        }

        $attributes = array_merge($defaultAttributes, $attributes);
        $attributes['alt'] = $alt;
        $attributes['src'] = $thumbnailUrl ?: $imageUrl;
        $attributes['srcset'] = $srcset;

        // Build HTML attributes string
        $attributeString = '';
        foreach ($attributes as $key => $value) {
            $attributeString .= sprintf(' %s="%s"', $key, htmlspecialchars($value));
        }

        return sprintf('<img%s>', $attributeString);
    }

    /**
     * Generate placeholder image HTML
     *
     * @param string $alt
     * @param array $attributes
     * @return string
     */
    private static function placeholderImage(string $alt, array $attributes = []): string
    {
        $defaultAttributes = [
            'class' => 'img-fluid placeholder-image',
            'src' => 'data:image/svg+xml;base64,' . base64_encode(self::getPlaceholderSvg()),
            'alt' => $alt ?: 'Image not available',
        ];

        $attributes = array_merge($defaultAttributes, $attributes);

        $attributeString = '';
        foreach ($attributes as $key => $value) {
            $attributeString .= sprintf(' %s="%s"', $key, htmlspecialchars($value));
        }

        return sprintf('<img%s>', $attributeString);
    }

    /**
     * Get placeholder SVG
     *
     * @return string
     */
    private static function getPlaceholderSvg(): string
    {
        return '<svg width="400" height="300" xmlns="http://www.w3.org/2000/svg">' .
               '<rect width="100%" height="100%" fill="#f8f9fa"/>' .
               '<text x="50%" y="50%" font-family="Arial, sans-serif" font-size="18" ' .
               'fill="#6c757d" text-anchor="middle" dy=".3em">Loading...</text>' .
               '</svg>';
    }

    /**
     * Format file size for display
     *
     * @param int $bytes
     * @return string
     */
    public static function formatFileSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, 2) . ' ' . $units[$pow];
    }
}