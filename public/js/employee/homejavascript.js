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

// Image array containing the image filenames
const images = [
    '../images/city-hall-image.jpg',
    '../images/city-hall-image 2.jpg',
    '../images/city-hall-image 3.jpg'
];

let currentIndex = 0; // Initialize the current index

function changeImage() {
    // Get the image element by ID
    const imageElement = document.getElementById('cityHallImage');

    // Update the image source to the next one in the array
    currentIndex = (currentIndex + 1) % images.length; // Cycle through the images
    imageElement.src = images[currentIndex]; // Change the image source
}

// Change the image every 5 seconds (5000 milliseconds)
setInterval(changeImage, 5000);

