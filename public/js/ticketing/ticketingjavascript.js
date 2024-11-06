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

// Function to update the Time In field in real-time
function updateTimeIn() {
    const timeInInput = document.getElementById('timeIn');
    const now = new Date();
    
    // Get the current date and time
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    
    // Format the datetime-local value as YYYY-MM-DDTHH:MM
    const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
    
    // Set the value to the Time In field
    timeInInput.value = formattedDateTime;
}

// Update Time In every minute
setInterval(updateTimeIn, 60000);

// Initialize the Time In field immediately
updateTimeIn();

// Function to toggle the "Please Specify" input field
function toggleOtherInput() {
    const concernSelect = document.getElementById("concern");
    const otherConcernContainer = document.getElementById("otherConcernContainer");

    // Check if the selected option is "other"
    if (concernSelect.value === "other") {
        otherConcernContainer.style.display = "block"; // Show the additional input
    } else {
        otherConcernContainer.style.display = "none"; // Hide the additional input
    }
}

// Function to open the export popup
function openExportPopup() {
    document.getElementById("exportPopup").style.display = "block";
}

// Function to close the export popup
function closeExportPopup() {
    document.getElementById("exportPopup").style.display = "none";
}

// Function to export the form content to a PDF with adjustable height
// Function to export the form content to a PDF with date and time formatted
function exportToPDF() {
    const element = document.querySelector('.content-wrapper');
    const timeInField = document.querySelector('#timeIn');
    const timeOutField = document.querySelector('#timeOut');

    // Get the datetime values from the fields
    const timeInValue = timeInField.value ? new Date(timeInField.value).toLocaleString() : 'N/A';
    const timeOutValue = timeOutField.value ? new Date(timeOutField.value).toLocaleString() : 'N/A';

    // Temporarily replace datetime fields with formatted date and time text for export
    const timeInText = document.createElement('span');
    timeInText.textContent = timeInValue; // Display the formatted date and time
    timeInText.style.border = '2px solid #007bff'; // Match the input border
    timeInText.style.padding = '10px';
    timeInText.style.borderRadius = '5px';
    timeInText.style.backgroundColor = '#f0f8ff'; // Light blue background
    timeInText.style.color = '#333'; // Dark text color
    timeInText.style.fontSize = '16px'; // Match font size
    timeInField.parentNode.replaceChild(timeInText, timeInField);

    const timeOutText = document.createElement('span');
    timeOutText.textContent = timeOutValue; // Display the formatted date and time
    timeOutText.style.border = '2px solid #007bff'; // Match the input border
    timeOutText.style.padding = '10px';
    timeOutText.style.borderRadius = '5px';
    timeOutText.style.backgroundColor = '#f0f8ff'; // Light blue background
    timeOutText.style.color = '#333'; // Dark text color
    timeOutText.style.fontSize = '16px'; // Match font size
    timeOutField.parentNode.replaceChild(timeOutText, timeOutField);

    // Set options for pdf generation
    const options = {
        margin: 0.5,
        filename: 'Technical_Service_Slip.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    // Use html2pdf to create the PDF
    html2pdf().set(options).from(element).save().then(() => {
        // Revert fields back to original input elements after export
        timeInText.parentNode.replaceChild(timeInField, timeInText);
        timeOutText.parentNode.replaceChild(timeOutField, timeOutText);
    });
}

