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
function showInfo() {
    document.getElementById('infoSection').style.display = 'block';
    document.getElementById('securityInfo').style.display = 'none';
    document.getElementById('profile-picture').style.display = 'block';
    document.getElementById('profile-label').style.display = 'block';
    document.getElementById('edit-button').style.display = 'inline-block';
    document.getElementById('remove-button').style.display = 'inline-block';
    
    // Update button states
    document.getElementById('infoButton').classList.add('active');
    document.getElementById('infoButton').classList.remove('inactive');
    document.getElementById('securityButton').classList.add('inactive');
    document.getElementById('securityButton').classList.remove('active');
}

function showSecurity() {
    document.getElementById('infoSection').style.display = 'none';
    document.getElementById('securityInfo').style.display = 'block';
    document.getElementById('profile-picture').style.display = 'none';
    document.getElementById('profile-label').style.display = 'none';
    document.getElementById('edit-button').style.display = 'none';
    document.getElementById('remove-button').style.display = 'none';
    
    // Update button states
    document.getElementById('infoButton').classList.add('inactive');
    document.getElementById('infoButton').classList.remove('active');
    document.getElementById('securityButton').classList.add('active');
    document.getElementById('securityButton').classList.remove('inactive');
}

function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('minimized');
    sidebar.classList.toggle('expanded');
}

function goBack() {
    window.history.back();
}

function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

