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

function togglePopup() {
    document.getElementById("search").style.display = "block";
}

function toggleExportPopup() {
    document.getElementById("exportPopup").style.display = "block";
}

function closePopup(popupId) {
    document.getElementById(popupId).style.display = "none";
}

// Function to show the employee details modal
function showEmployeeDetails(details) {
    document.getElementById('employeeName').innerText = `${details.FirstName} ${details.LastName}`;
    document.getElementById('employeeID').innerText = details.EmployeeID;
    document.getElementById('employeeAccountType').innerText = details.AccountType;
    document.getElementById('employeeAddress').innerText = details.Address;
    document.getElementById('employeeEmail').innerText = details.Email;
    document.getElementById('employeePhoneNumber').innerText = details.PhoneNumber;
    document.getElementById('employeeUsername').innerText = details.Username;

    document.getElementById('employeeDetailsModal').style.display = 'block'; // Updated modal ID
}

// Function to close modal
function closePopup(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Attach event listeners to "View" buttons
document.querySelectorAll('.modal-view-btn').forEach((button, index) => { // Updated button class
    button.addEventListener('click', () => {
        const employeeDetails = {
            FirstName: "{{ $account->FirstName }}",
            LastName: "{{ $account->LastName }}",
            EmployeeID: "{{ $account->EmployeeID }}",
            AccountType: "{{ $account->AccountType }}",
            Address: "{{ $account->Address }}",
            Email: "{{ $account->Email }}",
            PhoneNumber: "{{ $account->PhoneNumber }}",
            Username: "{{ $account->Username }}"
        };
        showEmployeeDetails(employeeDetails);
    });
});
