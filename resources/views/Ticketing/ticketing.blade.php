<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Information System</title>
    <link rel="stylesheet" href="../css/ticketing/ticketingstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar minimized">
            <div class="sidebar-header">
                <button class="minimize-btn" onclick="toggleSidebar()"></button>
            </div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search..." />
                <button class="search-btn" onclick="toggleSearchPopup()">🔍</button> <!-- Search button -->
            </div>
            <div class="nav-links">
                <div class="nav-item">
                    <a href="/home" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-home nav-logo"></i>
                            <span class="nav-label">HOME</span>
                        </div>
                        <span class="nav-text">HOME</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/in-inventory" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-boxes nav-logo"></i>
                            <span class="nav-label">INVENTORY</span>
                        </div>
                        <span class="nav-text">INVENTORY</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/profile" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-user nav-logo"></i>
                            <span class="nav-label">PROFILE</span>
                        </div>
                        <span class="nav-text">PROFILE</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/contact" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-envelope nav-logo"></i>
                            <span class="nav-label">CONTACT</span>
                        </div>
                        <span class="nav-text">CONTACT</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/admin" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-cog nav-logo"></i>
                            <span class="nav-label">ADMIN</span>
                        </div>
                        <span class="nav-text">ADMIN</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <div class="header">
                <button class="back-btn" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i> 
                </button>
                <h1>TICKETING SYSTEM</h1>
                <div class="menu-logo-container">
                    <button class="menu-btn" onclick="toggleMenu()">⋮</button>
                    <img src="{{ asset('images/LoginImages/pasiglogo.png') }}" alt="Pasig Logo" class="pasig-logo">
                </div>
            </div>

            <!-- Functional Button Section -->
            <div class="functional-button-section">
                <div class="button-container">
                    <a href="/report_and_monitoring">
                        <button class="action-btn">
                            <i class="fas fa-chart-bar"></i>
                            <span>REPORT AND MONITORING</span>
                        </button>
                    </a>
                    <a href="/ticketing/ticketing">
                        <button class="action-btn">
                            <i class="fas fa-ticket-alt"></i>
                            <span>TICKETING</span>
                        </button>
                    </a>
                    <a href="/ticketing/task">
                        <button class="action-btn">
                            <i class="fas fa-bell"></i>
                            <span>TASK</span>
                        </button>
                    </a>
                </div>
            </div>


			<!-- Buttons -->
            <div class="form-buttons">
                <button class="action-btn add-btn">New</button>
                <a href="/search-result">
                    <button class="action-btn add-btn">Search</button>
                </a>
                <button class="action-btn export-btn" onclick="openExportPopup()">Export</button>
            </div>
			
			
            <!-- Ticket Form Container -->
            <div class="content-wrapper">
                <div class="ticket-form-container">
                    <h2>Technical Service Slip</h2> <!-- New heading added here -->
                    <div class="control-number" id="controlNumber">{{ $nextControlNo }}</div>
                    <form id="ticketForm" action="/ticket" method="POST">
                        @csrf
                        <!-- Row 1: Personal Information -->
                        <fieldset>
                            <legend>Personal Information</legend>
                            <div class="personal-info-container">
                                <div class="personal-info-field">
                                    <label for="first-name">First Name:</label>
                                    <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
                                </div>
                                <div class="personal-info-field">
                                    <label for="last-name">Last Name:</label>
                                    <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
                                </div>
                                <div class="personal-info-field">
                                    <label for="department">Department:</label>
                                    <select id="department" name="department" required>
                                        <option value="" disabled selected>Select Department</option>
                                        <option>GSO Department</option>
                                        <option>ACCOUNTANCY Department</option>
                                        <option>PUSO Department</option>
                                        <option>MAYORS OFFICE Department</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Row 2: Ticket Details -->
                        <fieldset>
                            <legend>Ticket Details</legend>
                            <div class="form-row">
                                <label for="concern">Concern/Problem:</label>
                                <select id="concern" name="concern" required onchange="toggleOtherInput()">
                                    <option value="" disabled selected>Select Concern</option>
                                    <option value="Hardware Issue">Hardware Issue</option>
                                    <option value="Software Issue">Software Issue</option>
                                    <option value="file-transfer">File Transfer</option>
                                    <option value="Network Connectivity">Network Connectivity</option>
                                    <option value="other">Other: Specify</option>
                                </select>

                                <div id="otherConcernContainer" style="display: none;">
                                    <label for="otherConcern">Please Specify:</label>
                                    <input type="text" id="otherConcern" name="otherConcern" placeholder="Specify your concern">
                                </div>

                                <label for="category">Category:</label>
                                <select id="category" name="category" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="Priority">Priority</option>
                                    <option value="Semi-Urgent">Semi-Urgent</option>
                                    <option value="Non-Urgent">Non-Urgent</option>
                                </select>
                                
                                <label for="employeeId">Employee ID:</label>
                                <input type="text" id="employeeId" name="employeeId" required>
                            </div>
                        </fieldset>

                         <!-- Row 3: Support Details -->
                        <fieldset>
                            <legend>Support Details</legend>
                            <div class="support-details-container">
                                <div class="support-details-field">
                                    <label for="technicalSupport">Technical Support By:</label>
                                    <select id="technicalSupport" name="technicalSupport" required>
                                        <option value="" disabled selected>Select Technical Support</option>
                                        <!-- Loop through techSupport and populate the dropdown -->
                                        @foreach($techSupport as $support)
                                            <option value="{{ $support->EmployeeID }}">{{ $support->FirstName }} {{ $support->LastName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="time-container">
                                    <div class="support-details-field">
                                        <label for="timeIn">Time In:</label>
                                        <input type="datetime-local" id="timeIn" name="timeIn" required readonly>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Error message container -->
                        <div id="errorMessage" style="color: red; display: none; text-align:center; margin-top: 10px;">
                            <p>Please fill in all fields.</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <button type="button" class="submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <h2>Confirmation Details</h2>
            <div id="confirmationDetails">
                <div class="detail-row">
                    <label for="first-name">First Name:</label>
                    <div class="data-box" id="first-name-data"></div>
                    <label for="last-name">Last Name:</label>
                    <div class="data-box" id="last-name-data"></div>
                </div>
                <div class="detail-row">
                    <label for="department">Department:</label>
                    <div class="data-box" id="department-data"></div>
                </div>
                <div class="detail-row">
                    <label for="concern">Concern:</label>
                    <div class="data-box" id="concern-data"></div>
                </div>
                <div class="detail-row">
                    <label for="category">Category:</label>
                    <div class="data-box" id="category-data"></div>
                    <label for="employeeId">Employee ID:</label>
                    <div class="data-box" id="employee-id-data"></div>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" onclick="submitForm()">Submit</button>
                <button type="button" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>




    <!-- Export Popup -->
    <div class="export-popup" id="exportPopup">
        <div class="popup-content">
            <h3>Export Options</h3>
            <button class="popup-btn" onclick="exportToPDF()">Export This File to PDF</button>
            <button class="popup-btn" onclick="exportAllToExcel()">Export All Files to Excel</button>
            <button class="popup-close-btn" onclick="closeExportPopup()">Close</button>
        </div>
    </div>

    <!-- Search Pop-Up (hidden by default) -->
    <div class="search-popup" id="searchPopup">
        <div class="search-popup-header">
            SEARCH
            <button class="search-popup-close" onclick="closeSearchPopup()">×</button> <!-- Close Button -->
        </div>
        <input type="text" class="search-popup-input" placeholder="Enter your query here...">
        <button class="search-popup-submit">Search</button>
    </div>
    
    <!-- Menu (hidden by default) -->
    <div class="menu" id="menu" style="display: none;">
        <ul>
            <li><a href="/profile">Profile</a></li>
            <li><a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
    </div>

    <!-- Hidden Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="../js/ticketing/ticketingjavascript.js"></script>
</body>
</html>
