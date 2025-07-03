document.addEventListener('DOMContentLoaded', () => {

    // JavaScript untuk menampilkan/menyembunyikan tombol clear search
    const searchInput = document.getElementById('searchInput');
    const clearSearchButton = document.getElementById('clearSearchButton');

    if (searchInput && clearSearchButton) {
        const form = searchInput.closest('form');

        const toggleClearButton = () => {
            if (searchInput.value) {
                clearSearchButton.style.opacity = '1';
                clearSearchButton.style.pointerEvents = 'auto';
            } else {
                clearSearchButton.style.opacity = '0';
                clearSearchButton.style.pointerEvents = 'none';
            }
        };

        searchInput.addEventListener('input', toggleClearButton);
        searchInput.addEventListener('focus', toggleClearButton);

        searchInput.addEventListener('blur', () => {
            setTimeout(() => {
                if (!searchInput.value && document.activeElement !== clearSearchButton && !clearSearchButton.contains(document.activeElement)) {
                    if (document.activeElement !== searchInput){
                        toggleClearButton();
                    }
                }
            }, 150);
        });


        if (form) {
            form.addEventListener('reset', () => {
                setTimeout(() => {
                    toggleClearButton();
                    searchInput.focus();
                }, 0);
            });
        }

        toggleClearButton();
    }
});