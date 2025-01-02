function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const close = document.getElementById('close');

    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('active');
        sidebar.style.left = sidebar.classList.contains('active') ? '0' : '-250px';

        if (close) {
            close.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
        }
    }
}

function handleResize() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const close = document.getElementById('close');

    if (window.innerWidth > 768) {
        sidebar.style.left = '0';
        sidebar.classList.add('active');
        if (content) content.classList.add('shifted');
        if (close) close.style.display = 'none'; // Sembunyikan tombol close
    } else {
        sidebar.style.left = '-250px';
        sidebar.classList.remove('active');
        if (content) content.classList.remove('shifted');
        if (close) close.style.display = 'block'; // Tampilkan tombol close
    }
}

// Tambahkan event listener
window.addEventListener('resize', handleResize);
window.addEventListener('DOMContentLoaded', handleResize);
