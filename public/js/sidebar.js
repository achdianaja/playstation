function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('active');
        // content.classList.toggle('shifted');

        sidebar.style.left = sidebar.classList.contains('active') ? '0' : '-250px';
    }
}

function handleResize() {
    const sidebar = document.getElementById('sidebar');
    // const content = document.getElementById('content');

    if (window.innerWidth > 768) {
        sidebar.style.left = '0';
        content.classList.add('shifted');
        sidebar.classList.add('active');
    } else {
        sidebar.style.left = '-250px';
        content.classList.remove('shifted');
        sidebar.classList.remove('active');
    }
}

window.addEventListener('resize', handleResize);
window.addEventListener('DOMContentLoaded', handleResize);
