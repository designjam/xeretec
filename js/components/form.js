/**
 * Form Component
 * Handles form validation for component forms
 */
(function() {
    'use strict';
    
    function initFormValidation() {
        const forms = document.querySelectorAll('[data-component-form]');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                // Reset previous error states
                form.querySelectorAll('.border-red-500').forEach(field => {
                    field.classList.remove('border-red-500');
                });
                
                // Check required fields
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                    }
                });
                
                // Email validation
                const emailFields = form.querySelectorAll('input[type="email"]');
                emailFields.forEach(field => {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (field.value && !emailRegex.test(field.value)) {
                        isValid = false;
                        field.classList.add('border-red-500');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFormValidation);
    } else {
        initFormValidation();
    }
})();

