/**
 * =================================================================
 * RestoManagementScript.js
 * 
 * Mengelola semua interaksi di halaman Resto Management.
 * - Menukar visibilitas antara tombol 'Manage' dan baris aksi.
 * - Menangani modal untuk menampilkan info kontak.
 * =================================================================
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // --- Logika untuk Tombol "Manage" & "Close" ---

    document.querySelectorAll('.btn-manage').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.management-card');
            
            // =========================================================
            // === PERUBAHAN DI SINI (1) ===
            // =========================================================
            // BARU: Sembunyikan container dari tombol 'Manage' itu sendiri
            card.querySelector('.action-buttons-container').style.display = 'none';

            // Tampilkan baris aksi
            card.querySelector('.actions-row').style.display = 'flex';
        });
    });

    document.querySelectorAll('.btn-close-actions').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.management-card');
            
            // =========================================================
            // === PERUBAHAN DI SINI (2) ===
            // =========================================================
            // BARU: Tampilkan kembali container dari tombol 'Manage'
            // Menggunakan 'block' akan mengembalikannya ke perilaku default sebagai kolom Bootstrap.
            card.querySelector('.action-buttons-container').style.display = 'block';

            // Sembunyikan baris aksi
            card.querySelector('.actions-row').style.display = 'none';
        });
    });


    // --- Logika untuk Modal "Contact" (Tetap sama, tidak perlu diubah) ---
    const contactModalElement = document.getElementById('contactModal');

    if (contactModalElement) {
        contactModalElement.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const name = button.getAttribute('data-name');
            const phone = button.getAttribute('data-phone');
            const email = button.getAttribute('data-email');

            contactModalElement.querySelector('#modalApplicantName').textContent = name;
            contactModalElement.querySelector('#modalApplicantPhone').textContent = phone;
            contactModalElement.querySelector('#modalApplicantEmail').textContent = email;
        });
    }

    document.querySelectorAll('.btn-suspend').forEach(button => {
        button.addEventListener('click', async function() { // Gunakan async karena kita akan fetch
            const restaurantId = this.dataset.id;
            
            // Konfirmasi sebelum melakukan aksi berbahaya
            if (!confirm(`Are you sure you want to suspend restaurant #${restaurantId}? This action cannot be undone.`)) {
                return;
            }

            const url = `/admin/restaurants/${restaurantId}`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Feedback visual untuk pengguna
            this.disabled = true;
            this.textContent = 'Suspending...';

            try {
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'An unknown error occurred.');
                }
                
                alert(result.message); // Pesan sukses

                // Hapus kartu dari UI dengan animasi
                const cardToRemove = this.closest('.management-card');
                if (cardToRemove) {
                    cardToRemove.style.transition = 'opacity 0.5s';
                    cardToRemove.style.opacity = '0';
                    setTimeout(() => cardToRemove.remove(), 500);
                }

            } catch (error) {
                console.error('Suspend failed:', error);
                alert(`Error: ${error.message}`);
                // Kembalikan tombol ke keadaan semula jika gagal
                this.disabled = false;
                this.textContent = 'Suspend';
            }
        });
    });
});