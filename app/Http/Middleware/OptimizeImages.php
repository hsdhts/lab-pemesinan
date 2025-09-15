<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OptimizeImages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Only process HTML responses
        if (!$response instanceof Response || 
            !str_contains($response->headers->get('Content-Type', ''), 'text/html')) {
            return $response;
        }
        
        $content = $response->getContent();
        
        // Add lazy loading attributes to images
        $content = $this->addLazyLoadingAttributes($content);
        
        // Add responsive image attributes
        $content = $this->addResponsiveAttributes($content);
        
        // Add WebP support detection
        $content = $this->addWebPSupport($content);
        
        $response->setContent($content);
        
        return $response;
    }
    
    /**
     * Add lazy loading attributes to images
     *
     * @param string $content
     * @return string
     */
    private function addLazyLoadingAttributes(string $content): string
    {
        // Pattern to match img tags that don't already have loading attribute
        $pattern = '/<img(?![^>]*loading=)([^>]*src=["\']([^"\'>]+)["\'][^>]*)>/i';
        
        return preg_replace_callback($pattern, function ($matches) {
            $imgTag = $matches[0];
            $src = $matches[2];
            
            // Skip if it's a data URL or already has lazy loading
            if (strpos($src, 'data:') === 0 || strpos($imgTag, 'loading=') !== false) {
                return $imgTag;
            }
            
            // Add lazy loading attributes
            $imgTag = str_replace('<img', '<img loading="lazy"', $imgTag);
            
            // Add lazy loading class if not present
            if (strpos($imgTag, 'class=') !== false) {
                $imgTag = preg_replace('/class=["\']([^"\'>]*)["\']/', 'class="$1 lazy-image"', $imgTag);
            } else {
                $imgTag = str_replace('<img', '<img class="lazy-image"', $imgTag);
            }
            
            return $imgTag;
        }, $content);
    }
    
    /**
     * Add responsive image attributes
     *
     * @param string $content
     * @return string
     */
    private function addResponsiveAttributes(string $content): string
    {
        // Pattern to match img tags that don't already have responsive classes
        $pattern = '/<img(?![^>]*class=["\'][^"\'>]*(?:img-fluid|img-responsive))([^>]*)>/i';
        
        return preg_replace_callback($pattern, function ($matches) {
            $imgTag = $matches[0];
            
            // Add responsive class if not present
            if (strpos($imgTag, 'class=') !== false) {
                $imgTag = preg_replace('/class=["\']([^"\'>]*)["\']/', 'class="$1 img-fluid"', $imgTag);
            } else {
                $imgTag = str_replace('<img', '<img class="img-fluid"', $imgTag);
            }
            
            return $imgTag;
        }, $content);
    }
    
    /**
     * Add WebP support detection script
     *
     * @param string $content
     * @return string
     */
    private function addWebPSupport(string $content): string
    {
        // Check if WebP detection script is already present
        if (strpos($content, 'webp-support-detection') !== false) {
            return $content;
        }
        
        $webpScript = '
<script id="webp-support-detection">
(function() {
    function supportsWebP(callback) {
        var webP = new Image();
        webP.onload = webP.onerror = function () {
            callback(webP.height == 2);
        };
        webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
    }
    
    supportsWebP(function(supported) {
        if (supported) {
            document.documentElement.classList.add("webp-supported");
        } else {
            document.documentElement.classList.add("webp-not-supported");
        }
    });
})();
</script>';
        
        // Insert before closing head tag
        if (strpos($content, '</head>') !== false) {
            $content = str_replace('</head>', $webpScript . '\n</head>', $content);
        } else {
            // Fallback: insert at the beginning of body
            $content = str_replace('<body', $webpScript . '\n<body', $content);
        }
        
        return $content;
    }
}