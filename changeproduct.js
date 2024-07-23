document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.brand-list input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkboxes.forEach(cb => {
                    if (cb !== this) {
                        cb.checked = false;
                    }
                });
                const brandId = this.id;
                let url = '';
                switch (brandId) {
                    case 'nike':
                        url = 'https://example.com/nike';
                        break;
                    case 'adidas':
                        url = 'https://example.com/adidas';
                        break;
                    case 'puma':
                        url = 'https://example.com/puma';
                        break;
                    case 'mizuno':
                        url = 'https://example.com/mizuno';
                        break;
                    case 'kamito':
                        url = 'https://example.com/kamito';
                        break;
                    case 'zocker':
                        url = 'https://example.com/zocker';
                        break;
                }
                if (url) {
                    window.location.href = url;
                }
            }
        });
    });
});
