// Function to open a specific tab
function openTab(evt, tabName) {
    // Hide all tab content
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active");
    }

    // Remove active class from all links
    var tablinks = document.querySelectorAll('.tab button');
    tablinks.forEach(function(link) {
        link.classList.remove("active");
    });

    // Show the current tab and add an "active" class to the button that opened the tab
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");

    // Scroll to the top of the page when the tab is clicked
    window.scrollTo(0, 0);
}

// Alert box for Login
document.addEventListener('DOMContentLoaded', function () {
    window.scrollTo(0, 0);

    const loginForm = document.querySelector('.login-container form');
    if (loginForm) {
        loginForm.addEventListener('submit', function (event) {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            if (!username || !password) {
                event.preventDefault();
                alert("Both username and password are required.");
            }
        });
    }
});

