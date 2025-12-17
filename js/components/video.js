/**
 * Video Player Component
 * Handles video player functionality with modal playback
 */
(function() {
    'use strict';
    
    function initVideoPlayers() {
        const videoContainers = document.querySelectorAll('[data-video-player]');
        
        videoContainers.forEach(container => {
            const playButton = container.querySelector('[data-video-play]');
            const componentId = container.closest('[id^="video-player-"]')?.id || container.closest('section')?.id;
            const modal = document.querySelector(`[data-video-modal="${componentId}"]`);
            
            if (!playButton || !modal) return;
            
            const modalOverlay = modal.querySelector('[data-modal-overlay]');
            const modalClose = modal.querySelector('[data-modal-close]');
            const modalContent = modal.querySelector('[data-modal-content]');
            const iframe = modal.querySelector('iframe');
            const video = modal.querySelector('video');
            
            // Open modal on play button click
            playButton.addEventListener('click', function(e) {
                e.preventDefault();
                openModal();
            });
            
            // Close modal handlers
            if (modalClose) {
                modalClose.addEventListener('click', closeModal);
            }
            
            if (modalOverlay) {
                modalOverlay.addEventListener('click', closeModal);
            }
            
            // Close modal on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
            
            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                
                // Trigger reflow for transition
                void modal.offsetWidth;
                
                setTimeout(function() {
                    modal.classList.add('opacity-100');
                    modalContent.classList.remove('scale-90');
                    modalContent.classList.add('scale-100');
                    
                    // Load and play video
                    if (iframe) {
                        const src = iframe.getAttribute('data-src');
                        if (src && !iframe.src.includes('autoplay=1')) {
                            const separator = src.includes('?') ? '&' : '?';
                            iframe.src = src + separator + 'autoplay=1';
                        }
                    } else if (video) {
                        video.play();
                    }
                }, 10);
            }
            
            function closeModal() {
                modal.classList.remove('opacity-100');
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-90');
                
                // Pause video/iframe before closing
                if (iframe) {
                    iframe.src = '';
                } else if (video) {
                    video.pause();
                    video.currentTime = 0;
                }
                
                setTimeout(function() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = '';
                }, 300);
            }
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initVideoPlayers);
    } else {
        initVideoPlayers();
    }
})();

