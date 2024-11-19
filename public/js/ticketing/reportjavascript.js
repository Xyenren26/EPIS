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

// Accordion toggle
document.querySelectorAll('.accordion h3').forEach(header => {
    header.addEventListener('click', () => {
        header.classList.toggle('active');
        const content = header.nextElementSibling;
        if (content.style.display === 'block') {
            content.style.display = 'none';
        } else {
            content.style.display = 'block';
        }
    });
});


//DATE PICKER 

const date = new Date();
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();

const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const daysInMonth = (month, year) => new Date(year, month + 1, 0).getDate();

// Populate month and year dropdowns
const populateMonthYearSelectors = () => {
    const monthSelect = document.getElementById('monthSelect');
    const yearSelect = document.getElementById('yearSelect');

    monthSelect.innerHTML = '';
    monthNames.forEach((month, index) => {
        const option = document.createElement('option');
        option.value = index;
        option.text = month;
        if (index === currentMonth) option.selected = true;
        monthSelect.add(option);
    });

    yearSelect.innerHTML = '';
    for (let year = currentYear - 10; year <= currentYear + 10; year++) {
        const option = document.createElement('option');
        option.value = year;
        option.text = year;
        if (year === currentYear) option.selected = true;
        yearSelect.add(option);
    }
};

// Render the calendar based on the selected month and year
const renderCalendar = () => {
    const calendar = document.querySelector('.datepicker-calendar');
    calendar.innerHTML = '<div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>';
    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const totalDays = daysInMonth(currentMonth, currentYear);

    // Add blank spaces for the first week
    for (let i = 0; i < firstDay; i++) {
        calendar.innerHTML += '<div></div>';
    }

    // Populate the calendar with dates
    for (let i = 1; i <= totalDays; i++) {
        calendar.innerHTML += `<div>${i}</div>`;
    }

    // Add click event to each date in the calendar
    document.querySelectorAll('.datepicker-calendar div').forEach(day => {
        day.addEventListener('click', () => {
            document.querySelectorAll('.datepicker-calendar div').forEach(d => d.classList.remove('selected'));
            day.classList.add('selected');

            const selectedDate = `${monthNames[currentMonth]} ${day.innerText}, ${currentYear}`;
            document.getElementById('selectedDate').value = selectedDate;
        });
    });
};

// Event listener for month dropdown change
document.getElementById('monthSelect').addEventListener('change', (event) => {
    currentMonth = parseInt(event.target.value);
    renderCalendar();
});

// Event listener for year dropdown change
document.getElementById('yearSelect').addEventListener('change', (event) => {
    currentYear = parseInt(event.target.value);
    renderCalendar();
});

// Event listener for "previous month" button
document.getElementById('prevMonth').addEventListener('click', () => {
    if (currentMonth === 0) {
        currentMonth = 11; // December
        currentYear--; // Go to the previous year
    } else {
        currentMonth--;
    }
    updateMonthYearSelectors();
    renderCalendar();
});

// Event listener for "next month" button
document.getElementById('nextMonth').addEventListener('click', () => {
    if (currentMonth === 11) {
        currentMonth = 0; // January
        currentYear++; // Go to the next year
    } else {
        currentMonth++;
    }
    updateMonthYearSelectors();
    renderCalendar();
});

// Event listener for "previous year" button
document.getElementById('prevYear').addEventListener('click', () => {
    currentYear--;
    updateMonthYearSelectors();
    renderCalendar();
});

// Event listener for "next year" button
document.getElementById('nextYear').addEventListener('click', () => {
    currentYear++;
    updateMonthYearSelectors();
    renderCalendar();
});

// Function to update month and year selectors
const updateMonthYearSelectors = () => {
    document.getElementById('monthSelect').value = currentMonth;
    document.getElementById('yearSelect').value = currentYear;
};

// Initial setup and rendering
populateMonthYearSelectors();
renderCalendar();

// Function to handle the "OK" button click
document.querySelector('.datepicker-footer .ok').addEventListener('click', () => {
    const selectedDate = document.getElementById('selectedDate');
    if (selectedDate.value) {
        // Additional logic for OK button (if needed)
    }
});

// Function to handle the "Cancel" (Clear) button click
document.querySelector('.datepicker-footer .cancel').addEventListener('click', () => {
    const selectedDate = document.getElementById('selectedDate');
    selectedDate.value = ''; // Clear the selected date
});

// Show the date picker when the input field is clicked
document.getElementById('selectedDate').addEventListener('click', () => {
    const datepicker = document.querySelector('.datepicker');
    datepicker.style.display = 'block'; // Show the date picker
});
