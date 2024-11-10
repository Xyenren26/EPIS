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

// Toggle between the profile information and security sections
function showInfo() {
    document.getElementById('infoSection').style.display = 'block';
    document.getElementById('securityInfo').style.display = 'none';
    document.getElementById('profile-picture').style.display = 'block';
    document.getElementById('profile-label').style.display = 'block';
    document.getElementById('edit-button').style.display = 'inline-block';
    

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
    document.getElementById('save-button').style.display = 'none';
    document.getElementById('edit-button').style.display = 'none';

    // Update button states
    document.getElementById('infoButton').classList.add('inactive');
    document.getElementById('infoButton').classList.remove('active');
    document.getElementById('securityButton').classList.add('active');
    document.getElementById('securityButton').classList.remove('inactive');
}

// Enable editing for the profile fields
let isEditing = false; // Track if any edits have been made
function enableEditing() {
    // Toggle between editing and viewing mode
    const fields = document.querySelectorAll('#infoSection input');
    fields.forEach(field => field.removeAttribute('readonly'));

    document.getElementById('save-button').style.display = 'inline-block';
    document.getElementById('edit-button').style.display = 'none';

    isEditing = true; // Mark as editing
}

// Save changes made to the profile
function saveChanges() {
    const fields = document.querySelectorAll('#infoSection input');
    fields.forEach(field => field.setAttribute('readonly', true)); // Make fields readonly again

    document.getElementById('save-button').style.display = 'none';
    document.getElementById('edit-button').style.display = 'inline-block';

    // Submit the form after making the fields readonly
    document.getElementById('profile-form').submit();

    // Here you can handle form submission or AJAX call to save changes
    isEditing = false; // Mark as not editing anymore
}

// Open the profile picture in a modal for change
function openImageModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'block'; // Show the modal with the image
}

// Change profile picture
let newImageData = null;

function changeImage() {
    // Trigger the file input to open when the user clicks the "Change" button
    document.getElementById('profile-image-input').click();
}

function previewImage(event) {
    const fileInput = event.target;
    const file = fileInput.files[0];

    if (file) {
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        const maxSizeInBytes = 5 * 1024 * 1024; // 5MB

        if (!validImageTypes.includes(file.type)) {
            alert("Only JPEG, PNG, and GIF files are allowed.");
            return;
        }

        if (file.size > maxSizeInBytes) {
            alert("The image size should be less than 5MB.");
            return;
        }

        // Display the "Save" button after successful selection
        document.getElementById('saveImageButton').style.display = 'inline-block';
        document.querySelector('.modal-button.change').style.display = 'none';

        // Preview the selected image
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-image').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}


function closeImageModal() {
    // Close the modal
    document.getElementById('imageModal').style.display = 'none';
    
    // Reset the modal buttons and image preview
    document.getElementById('saveImageButton').style.display = 'none';
    document.querySelector('.modal-button.change').style.display = 'inline-block';
    document.getElementById('profile-image-input').value = ''; // Clear file input
    document.getElementById('profile-image').src = 'data:image/png;base64,{{ base64_encode($account->ProfilePicture) }}'; // Reset to the original image
    newImageData = null; // Reset the new image data
}

function saveImage() {
    const fileInput = document.getElementById('profile-image-input');
    const file = fileInput.files[0];

    if (!file) {
        alert("Please select an image to upload.");
        return;
    }

    // Submit the form if validation passes
    document.getElementById('imageUploadForm').submit();
}
