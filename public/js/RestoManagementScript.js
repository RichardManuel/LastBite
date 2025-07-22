document.addEventListener('DOMContentLoaded', function () {
    // Tombol "Manage"
    document.querySelectorAll('.btn-manage').forEach(button => {
        button.addEventListener('click', function () {
            const card = this.closest('.management-card');
            card.querySelector('.action-buttons-container').style.display = 'none';
            card.querySelector('.actions-row').style.display = 'flex';
        });
    });

    // Tombol "Close"
    document.querySelectorAll('.btn-close-actions').forEach(button => {
        button.addEventListener('click', function () {
            const card = this.closest('.management-card');
            card.querySelector('.action-buttons-container').style.display = 'block';
            card.querySelector('.actions-row').style.display = 'none';
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const toggleButtons = document.querySelectorAll('.toggle-actions-btn');
    const closeButtons = document.querySelectorAll('.btn-close-actions');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const actions = document.getElementById(`actions-${id}`);
            actions.classList.toggle('show');
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const actions = document.getElementById(`actions-${id}`);
            actions.classList.remove('show');
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-contact').forEach(button => {
        button.addEventListener('click', function () {
            const name = this.dataset.name || 'N/A';
            const phone = this.dataset.phone || 'N/A';
            const email = this.dataset.email || 'N/A';

            // Pastikan ID-nya sesuai dengan isi modal
            document.getElementById('contact-name').textContent = name;
            document.getElementById('contact-phone').textContent = phone;
            document.getElementById('contact-email').textContent = email;
        });
    });
});
