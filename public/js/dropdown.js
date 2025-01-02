document.querySelector('.img-dropdown').addEventListener('click', function () {
    const dropdownMenu = this.querySelector('.dropdown-menu');
    dropdownMenu.style.display = dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
});

document.addEventListener('click', function (e) {
    const dropdown = document.querySelector('.img-dropdown');
    if (!dropdown.contains(e.target)) {
        const menu = dropdown.querySelector('.dropdown-menu');
        menu.style.display = 'none';
    }
});
