// Ensure the sidebar is minimized on load
window.onload = function() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.add('minimized');
};

// Toggle sidebar on button click
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('minimized');

    // Keep the hamburger icon regardless of the state
    const minimizeBtn = document.querySelector('.minimize-btn');
    minimizeBtn.innerHTML = ''; // Always display hamburger icon
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

// Function to go back
function goBack() {
    window.history.back(); // Navigate to the previous page
}

// Function to toggle the menu
function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block'; // Toggle visibility
}

// Close the menu when clicking outside of it
window.onclick = function(event) {
    const menu = document.getElementById('menu');
    if (!menu.contains(event.target) && !event.target.matches('.menu-btn')) {
        menu.style.display = 'none'; // Hide the menu if clicked outside
    }
};

function openSearch() {
    document.getElementById("search").style.display = "block";
}

function openExportPopup() {
    document.getElementById("exportPopup").style.display = "block";
}

function closePopup(popupId) {
    document.getElementById(popupId).style.display = "none";
}

// Open the popup
function openPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex';
}

// Close the popup
function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}

// Attach event listener for the "New" button
document.querySelector('.action-btn').addEventListener('click', function () {
    openPopup('formPopup');
});