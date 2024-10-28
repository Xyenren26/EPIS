<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="css/signupstyle.css"> <!-- Link to your external CSS -->
</head>
<body>
    <h1 class="main-heading">WELCOME to MIS - TECHNICAL SUPPORT DIVISION</h1>
        <div class="header">
            <h1 class="subheading">
                <span class="epis">E</span>-<span>PIS</span>: <span>E</span>nhance <span>P</span>asig <span>I</span>nventory <span>S</span>ystem
            </h1>
            <img src="images/LoginImages/pasiglogo.png" alt="Pasig Logo" class="logo">
        </div>

    <div class="signup-container" data-aos="fade-up">
        <h2>Sign Up</h2>
        <form action="{{ url('/signup') }}" method="post" id="signupForm">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-sections">
                <fieldset class="account-info">
                    <legend>Account Information</legend>
                    <div class="form-container" data-aos="fade-up">
                        <div class="input-group">
                            <label for="new-username">Username</label>
                            <input type="text" id="new-username" name="username" required>
                        </div>
                        <div class="input-group">
                            <label for="employee-id">Employee ID</label>
                            <input type="text" id="employee-id" name="employee-id" required pattern="[0-9\-]+" title="Only numbers and hyphens (-) are allowed.">
                        </div>
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="input-group">
                            <label for="phone-number">Phone Number</label>
                            <input type="tel" id="phone-number" name="phone-number" required>
                        </div>
                        <div class="input-group">
                            <label for="AccountType">Role</label>
                            <select id="AccountType" name="AccountType" required>
                                <option value="">Select a role</option>
                                <option value="technical-support">Technical Support</option>
                                <option value="technical-administrator">Technical Administrator</option>
                                <option value="employee">Employee</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="personal-info">
                    <legend>Personal Information</legend>
                    <div class="form-container" data-aos="fade-up">
                        <div class="input-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first-name" required>
                        </div>
                        <div class="input-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last-name" required>
                        </div>
                        <div class="input-group">
                            <label for="suffix">Suffix (optional)</label>
                            <input type="text" id="suffix" name="suffix">
                        </div>
                        <div class="input-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" required>
                        </div>
                        <div class="input-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" required>
                        </div>
                    </div>
                </fieldset>
            </div>

            <!-- Security Information Section -->
            <fieldset class="security-info">
                <legend>Security Information</legend>
                <div class="form-container" data-aos="fade-up">
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                </div>
            </fieldset>

            <!-- Privacy policy section -->
            <div class="privacy-policy" data-aos="fade-up">
                <input type="checkbox" id="privacy-checkbox" name="privacy-policy" required>
                <label for="privacy-checkbox">I agree to the <a href="#" id="privacy-policy-link">Privacy Policy</a></label>
            </div>

            <button type="submit" class="signup-btn" data-aos="fade-up">Sign Up</button>
        </form>
        <p>Already have an account? <a href='/' class="login">Login</a></p>
    </div>

    <!-- Privacy Policy Modal -->
    <div id="privacyPolicyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Privacy Policy</h2>
            <p>This Privacy Policy describes how Pasig City Hall's Management Information Systems Office (MISO) collects, uses, discloses, and protects your personal information when you use the E-PIS (Enhanced Pasig Inventory System) and related services. We are devoted to protecting your privacy and handling your personal information responsibly.</p>
            <h3>1. Data Collection Methods</h3>
            <p>MISO gathers personal information that you submit while using our services, as well as data about how you access and interact with the platform. This data is collected through forms, user activities, and automated techniques such as cookies and server logs. The information gathered is utilized to improve platform functionality, user experience, and ensure effective service delivery and support.</p>
            <h3>2. Personal Data Gathering</h3>
            <p>The collection of personal information is completely from you when you register or use our services. This information could include your name, email address, phone number, employee ID, and address. The information we gather allows us to verify your identity, manage your account, and provide personalized features and support, resulting in a secure and efficient experience on our platform.</p>
            <h3>3. Service Usage Analytics</h3>
            <p>Collection of usage data is used to better understand how you interact with our services. This includes information on your device's Internet Protocol (IP) address, browser type, operating system, the pages you view, and the date and time you visit. This information allows us to analyze trends, optimize the operation of our system, and provide a more personalized user experience.</p>
            <h3>4. Cookies and Monitoring Technologies</h3>
            <p>We use cookies and other tracking technologies to improve your user experience on our platform. Cookies are little data files that stored on your device to help us remember your choices, understand how you use our site, and improve the performance of our services. You can manage or deactivate cookies in your browser settings, but this may block certain service functionalities.</p>
            <h3>5. Information Usage Practices</h3>
            <p>We use the data we collect to provide, maintain, and enhance our services. This includes utilizing your data to address requests, manage user accounts, and improve general functionality. Additionally, we may use your information to connect with you, reply to requests, provide customer support, and send crucial service updates or notifications.</p>
            <h3>6. Disclosure of Personal Data</h3>
            <p>We prioritize your privacy and are committed to safeguarding your information. We may disclose your data in specific situations, including: Service Providers, Legal Requirements, Business Transfers, and with your explicit Consent.</p>
            <h3>7. Data Privacy Protection</h3>
            <p>We prioritize the protection of your private information by deploying encryption, firewalls, and conducting regular security reviews. However, despite our efforts to protect your data, we cannot guarantee total security owing to the fundamental hazards of data transfer and storage.</p>
            <h3>8. Personal Data Rights</h3>
            <p>As a user, you have certain rights regarding your personal information. You have the right to view, change, or remove any data we have about you, as well as object to or limit the processing of your data. If you believe your rights have been violated, you may register a complaint with the applicable data protection authorities.</p>
            <h3>9. Changes to This Privacy Policy</h3>
            <p>We may update our Privacy Policy from time to time. We encourage you to review this Privacy Policy periodically for any changes.</p>
            <h3>10. Contact Us</h3>
            <p>If you have any questions about this Privacy Policy, please contact us: Email: pasigmiso@pasig.city.com, Phone: 63+123-2131, Address: Pasig City</p>
        </div>
    </div>

    <script src="js/signupjavascript.js"></script>
    <script> AOS.init(); </script>
</body>
</html>
