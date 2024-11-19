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


// Toggle the visibility of the chatbox
function openChatBox(employeeName) {
    const chatbox = document.getElementById('chatbox');
    const chatboxHeader = document.getElementById('chatbox-employee-name');

    // Update the chatbox header with the employee's name
    chatboxHeader.textContent = `Chat with ${employeeName}`;

    // Show the chatbox
    chatbox.classList.remove('hidden');
}

function closeChatBox() {
    const chatbox = document.getElementById('chatbox');

    // Hide the chatbox
    chatbox.classList.add('hidden');
}
