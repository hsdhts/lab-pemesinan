/**
 * Lazy Loading Images Implementation
 * Optimizes image loading performance by loading images only when they're visible
 */

class LazyImageLoader {
    constructor(options = {}) {
        this.options = {
            rootMargin: '50px 0px',
            threshold: 0.01,
            loadingClass: 'lazy-loading',
            loadedClass: 'lazy-loaded',
            errorClass: 'lazy-error',
            ...options
        };
        
        this.imageObserver = null;
        this.init();
    }
    
    init() {
        // Check if Intersection Observer is supported
        if ('IntersectionObserver' in window) {
            this.imageObserver = new IntersectionObserver(
                this.onIntersection.bind(this),
                {
                    rootMargin: this.options.rootMargin,
                    threshold: this.options.threshold
                }
            );
            
            this.observeImages();
        } else {
            // Fallback for older browsers
            this.loadAllImages();
        }
        
        // Re-observe images when new content is added
        this.setupMutationObserver();
    }
    
    observeImages() {
        const lazyImages = document.querySelectorAll('img[data-src]:not(.lazy-loaded)');
        lazyImages.forEach(img => {
            this.imageObserver.observe(img);
        });
    }
    
    onIntersection(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                this.loadImage(entry.target);
                this.imageObserver.unobserve(entry.target);
            }
        });
    }
    
    loadImage(img) {
        const src = img.dataset.src;
        const srcset = img.dataset.srcset;
        
        if (!src) return;
        
        // Add loading class
        img.classList.add(this.options.loadingClass);
        
        // Create a new image to preload
        const imageLoader = new Image();
        
        imageLoader.onload = () => {
            // Update the actual image
            img.src = src;
            if (srcset) {
                img.srcset = srcset;
            }
            
            // Remove data attributes
            delete img.dataset.src;
            delete img.dataset.srcset;
            
            // Update classes
            img.classList.remove(this.options.loadingClass);
            img.classList.add(this.options.loadedClass);
            
            // Trigger custom event
            img.dispatchEvent(new CustomEvent('lazyloaded', {
                detail: { src: src }
            }));
        };
        
        imageLoader.onerror = () => {
            img.classList.remove(this.options.loadingClass);
            img.classList.add(this.options.errorClass);
            
            // Set fallback image
            img.src = this.createPlaceholderDataUrl('Error loading image');
            
            // Trigger custom event
            img.dispatchEvent(new CustomEvent('lazyerror', {
                detail: { src: src }
            }));
        };
        
        // Start loading
        imageLoader.src = src;
        if (srcset) {
            imageLoader.srcset = srcset;
        }
    }
    
    loadAllImages() {
        // Fallback method for browsers without Intersection Observer
        const lazyImages = document.querySelectorAll('img[data-src]:not(.lazy-loaded)');
        lazyImages.forEach(img => this.loadImage(img));
    }
    
    setupMutationObserver() {
        if ('MutationObserver' in window) {
            const mutationObserver = new MutationObserver(mutations => {
                mutations.forEach(mutation => {
                    mutation.addedNodes.forEach(node => {
                        if (node.nodeType === 1) { // Element node
                            // Check if the node itself is a lazy image
                            if (node.tagName === 'IMG' && node.dataset.src && !node.classList.contains('lazy-loaded')) {
                                this.imageObserver?.observe(node);
                            }
                            
                            // Check for lazy images within the added node
                            const lazyImages = node.querySelectorAll?.('img[data-src]:not(.lazy-loaded)');
                            lazyImages?.forEach(img => {
                                this.imageObserver?.observe(img);
                            });
                        }
                    });
                });
            });
            
            mutationObserver.observe(document.body, {
                childList: true,
                subtree: true
            });
        }
    }
    
    createPlaceholderDataUrl(text = 'Loading...') {
        const svg = `
            <svg width="400" height="300" xmlns="http://www.w3.org/2000/svg">
                <rect width="100%" height="100%" fill="#f8f9fa"/>
                <text x="50%" y="50%" font-family="Arial, sans-serif" font-size="16" 
                      fill="#6c757d" text-anchor="middle" dy=".3em">${text}</text>
            </svg>
        `;
        return `data:image/svg+xml;base64,${btoa(svg)}`;
    }
    
    // Public method to manually load an image
    loadImageById(imageId) {
        const img = document.getElementById(imageId);
        if (img && img.dataset.src) {
            this.loadImage(img);
            this.imageObserver?.unobserve(img);
        }
    }
    
    // Public method to refresh lazy loading for new content
    refresh() {
        this.observeImages();
    }
}

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        window.lazyLoader = new LazyImageLoader();
    });
} else {
    window.lazyLoader = new LazyImageLoader();
}

// CSS for loading states
const style = document.createElement('style');
style.textContent = `
    .lazy-image {
        transition: opacity 0.3s ease;
    }
    
    .lazy-loading {
        opacity: 0.6;
        background: #f8f9fa;
    }
    
    .lazy-loaded {
        opacity: 1;
    }
    
    .lazy-error {
        opacity: 0.5;
        filter: grayscale(100%);
    }
    
    .responsive-image {
        max-width: 100%;
        height: auto;
    }
    
    .placeholder-image {
        background-color: #f8f9fa;
        border: 1px dashed #dee2e6;
    }
`;
document.head.appendChild(style);