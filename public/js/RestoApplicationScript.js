/**
 * RestoActionHandler.js
 * Script ini HANYA menangani klik pada tombol 'Accept' dan 'Decline'.
 */
document.addEventListener('DOMContentLoaded', function () {

    // Cari semua tombol yang memiliki atribut 'data-action'
    const actionButtons = document.querySelectorAll('button[data-action]');

    // Loop melalui setiap tombol dan tambahkan event listener
    actionButtons.forEach(button => {
        button.addEventListener('click', handleApplicationAction);
    });

    async function handleApplicationAction(event) {
        // 'this' merujuk pada tombol yang diklik
        const button = this;
        const action = button.dataset.action;
        const applicationId = button.dataset.id;

        // Tentukan metode HTTP dan URL berdasarkan aksi
        const method = (action === 'accept') ? 'POST' : 'DELETE';
        const actionUrl = `/admin/applications/${applicationId}/${action}`;

        if (!confirm(`Are you sure you want to ${action} this application?`)) {
            return; // Batalkan jika pengguna menekan 'Cancel'
        }

        // Beri feedback visual ke pengguna
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Processing...';

        try {
            // Ambil CSRF token yang disimpan oleh Laravel di meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Kirim request ke server
            const response = await fetch(actionUrl, {
                method: method,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
            });

            const result = await response.json();

            if (!response.ok) {
                // Jika server mengembalikan error (misal: 409, 500)
                throw new Error(result.message || 'An unknown error occurred.');
            }

            // Jika sukses
            alert(result.message);

            // Hapus kartu dari halaman dengan animasi fade-out
            const cardToRemove = document.getElementById(`card-${applicationId}`);
            if (cardToRemove) {
                cardToRemove.style.transition = 'opacity 0.5s';
                cardToRemove.style.opacity = '0';
                setTimeout(() => cardToRemove.remove(), 500);
            }

        } catch (error) {
            console.error('Action failed:', error);
            alert(`Error: ${error.message}`);
            
            // Kembalikan tombol ke keadaan semula jika gagal
            button.disabled = false;
            // Kita perlu menyimpan teks asli, atau setel ulang secara manual
            if(action === 'accept') button.innerHTML = 'Accept <i class="bi bi-check-circle"></i>';
            else button.innerHTML = 'Decline <i class="bi bi-x-circle"></i>';
        }
    }
});