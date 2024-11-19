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

function toggleSearchPopup() {
    const sidebar = document.querySelector('.sidebar');
    const searchPopup = document.getElementById('searchPopup');

    // Check if the sidebar is minimized
    if (sidebar.classList.contains('minimized')) {
        if (searchPopup.style.display === 'none' || searchPopup.style.display === '') {
            searchPopup.style.display = 'block';
        } else {
            searchPopup.style.display = 'none';
        }
    } else {
        console.log('Search popup is only available when the sidebar is minimized.');
    }
}

function closeSearchPopup() {
    const searchPopup = document.getElementById('searchPopup');
    searchPopup.style.display = 'none';
}

// Close the popup when clicking outside
window.addEventListener('click', function (e) {
    const searchPopup = document.getElementById('searchPopup');
    if (
        searchPopup.style.display === 'block' &&
        !searchPopup.contains(e.target) &&
        !e.target.classList.contains('search-btn') &&
        !e.target.classList.contains('search-popup-close')
    ) {
        searchPopup.style.display = 'none';
    }
});

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
