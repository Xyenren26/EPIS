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

function openPendingModal() {
    document.getElementById('pendingModal').style.display = 'block';
}

function closePendingModal() {
    document.getElementById('pendingModal').style.display = 'none';
}

function acceptAccount(employeeID) {
    if (confirm("Are you sure you want to accept this account?")) {
        fetch(`/admin/accept/${employeeID}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                closePendingModal(); // Close the modal
                location.reload(); // Reload the page to see updated status
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function voidAccount(employeeID) {
    if (confirm("Are you sure you want to void this account? This action cannot be undone.")) {
        fetch(`/admin/void/${employeeID}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                closePendingModal(); // Close the modal
                location.reload(); // Reload the page to see the updated list
            }
        })
        .catch(error => console.error('Error:', error));
    }
}


