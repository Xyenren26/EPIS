// Ensure the sidebar is minimized on load
window.onload = function () {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.classList.add('minimized');
    }
};

// Toggle sidebar on button click
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const minimizeBtn = document.querySelector('.minimize-btn');

    if (sidebar) {
        sidebar.classList.toggle('minimized');
    }

    // Ensure hamburger icon remains visible
    if (minimizeBtn) {
        minimizeBtn.innerHTML = ''; // Ensure hamburger icon is displayed
    }
}

// Go back function (browser history)
function goBack() {
    window.history.back(); // Navigate to the previous page
}

// Toggle menu visibility on button click
function toggleMenu() {
    const menu = document.getElementById('menu');
    if (menu) {
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
}
