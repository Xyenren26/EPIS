function checkRole() {
    const accountType = document.getElementById('AccountType').value;
    const statusField = document.getElementById('status');
    
    if (accountType === 'technical-administrator') {
        statusField.value = 'pending';
    } else {
        statusField.value = 'active'; // or however you want to handle other roles
    }
}

// Ensure the DOM is fully loaded before running any scripts
document.addEventListener('DOMContentLoaded', function () {
    // Scroll position reset
    window.scrollTo(0, 0);

    // Alert box for Sign Up
    const signupForm = document.querySelector('.signup-container form');
    if (signupForm) {
        signupForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission
            const username = document.getElementById('new-username').value;
            const privacyCheckbox = document.getElementById('privacy-checkbox');

            // Check if the privacy policy checkbox is checked
            if (!privacyCheckbox.checked) {
                alert("You must agree to the Privacy Policy to sign up.");
            } else {
                alert("Thank you for signing up, " + username + "!");
                // Add actual form submission logic if needed.
                signupForm.submit(); // Uncomment to submit the form.
            }
        });
    }

    // Modal functionality
    const modal = document.getElementById("privacyPolicyModal");
    const link = document.getElementById("privacy-policy-link");
    const span = document.getElementsByClassName("close")[0];

    link.onclick = function(event) {
        event.preventDefault(); // Prevent the default anchor behavior
        modal.style.display = "block"; // Show the modal
    }

    span.onclick = function() {
        modal.style.display = "none"; // Hide the modal
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none"; // Hide the modal
        }
    }

    // Password validation
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("confirm-password");
    const signupButton = document.querySelector(".signup-btn");
    const passwordMatchMessage = document.createElement("p");
    const passwordCriteriaMessage = document.createElement("p");

    // Set styling for messages
    passwordMatchMessage.style.color = "red";
    passwordMatchMessage.style.fontSize = "0.9em";
    passwordCriteriaMessage.style.color = "orange";
    passwordCriteriaMessage.style.fontSize = "0.9em";

    // Append messages to the DOM
    confirmPasswordField.parentNode.appendChild(passwordMatchMessage);
    passwordField.parentNode.appendChild(passwordCriteriaMessage);

    // Password validation criteria
    function validatePasswordStrength() {
        const password = passwordField.value;
        const criteria = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!criteria.test(password)) {
            passwordCriteriaMessage.textContent = 
                "Password must be at least 8 characters, contain uppercase, lowercase, a number, and a special character.";
            signupButton.disabled = true;
        } else {
            passwordCriteriaMessage.textContent = "";
            signupButton.disabled = false; // Enable temporarily until matching check is done
        }
    }

    // Real-time password match check
    function validatePasswordMatch() {
        if (passwordField.value !== confirmPasswordField.value) {
            passwordMatchMessage.textContent = "Passwords do not match.";
            signupButton.disabled = true;
        } else {
            passwordMatchMessage.textContent = "";
            if (passwordCriteriaMessage.textContent === "") {
                signupButton.disabled = false;
            }
        }
    }

    // Event listeners to trigger validation on input
    passwordField.addEventListener("input", () => {
        validatePasswordStrength();
        validatePasswordMatch();
    });
    confirmPasswordField.addEventListener("input", validatePasswordMatch);

    // Email and phone number validation functions
    function validateEmail(input) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(input);
    }

    function validatePhoneNumber(input) {
        const phonePattern = /^[0-9]{10,15}$/; // Basic phone number pattern
        return phonePattern.test(input);
    }

    // Function to open a specific tab
    window.openTab = function(evt, tabName) {
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
    };
});
