<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Information System</title>
    <link rel="stylesheet" href="{{ asset('css/employee/ticketing/ticketingstyle.css') }}">
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
                <button class="search-btn">🔍</button>
            </div>
            <div class="nav-links">
                <div class="nav-item">
                    <a href="/employee/home" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-home nav-logo"></i> <!-- Home icon -->
                            <span class="nav-label">HOME</span> <!-- Home label -->
                        </div>
                        <span class="nav-text">HOME</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/employee/profile" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-user nav-logo"></i> <!-- Profile icon -->
                            <span class="nav-label">PROFILE</span> <!-- Profile label -->
                        </div>
                        <span class="nav-text">PROFILE</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/employee/contact" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-envelope nav-logo"></i> <!-- Contact icon -->
                            <span class="nav-label">CONTACT</span> <!-- Contact label -->
                        </div>
                        <span class="nav-text">CONTACT</span>
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
                <button class="menu-btn" onclick="toggleMenu()">⋮</button>
            </div>

            <!-- Functional Button Section -->
            <div class="functional-button-section">
                <div class="button-container">
                    <button class="action-btn" onclick="window.location.href='Report and Monitoring.html';">
                        <i class="fas fa-chart-bar"></i>
                        <span>REPORT AND MONITORING</span>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-ticket-alt"></i>
                        <span>TICKETING</span>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-bell"></i>
                        <span>NOTICE</span>
                    </button>
                </div>
            </div>
            
            <!-- Ticket Form Container -->
            <div class="content-wrapper">
                <div class="ticket-form-container">
                    <h2>Technical Service Slip</h2> <!-- New heading added here -->
                    <div class="control-number" id="controlNumber">TS-2024-0001</div>
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
                                    <option value="hardware">Hardware Issue</option>
                                    <option value="software">Software Issue</option>
                                    <option value="file-transfer">File Transfer</option>
                                    <option value="network">Network Connectivity</option>
                                    <option value="other">Other: Specify</option>
                                </select>

                                <div id="otherConcernContainer" style="display: none;">
                                    <label for="otherConcern">Please Specify:</label>
                                    <input type="text" id="otherConcern" name="otherConcern" placeholder="Specify your concern">
                                </div>

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
                                        <!-- Check if there are available technicians -->
                                        @if($techSupport->isEmpty())
                                            <option disabled>No available tech support at the moment.</option>
                                        @else
                                            <!-- Loop through techSupport and populate the dropdown -->
                                            @foreach($techSupport as $support)
                                                <option value="{{ $support->EmployeeID }}" 
                                                        @if($support->EmployeeID == session('lastAssignedTech')) 
                                                            disabled
                                                        @endif>
                                                    {{ $support->FirstName }} {{ $support->LastName }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <!-- Display message if no tech support is available -->
                            @if($noTechMessage)
                                <p>{{ $noTechMessage }}</p>
                            @endif
                                <div class="time-container">
                                    <div class="support-details-field">
                                        <label for="timeIn">Time In:</label>
                                        <input type="datetime-local" id="timeIn" name="timeIn" required>
                                    </div>
                                    <div class="support-details-field">
                                        <label for="timeOut">Time Out:</label>
                                        <input type="datetime-local" id="timeOut" name="timeOut">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <button type="submit" class="submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Menu (hidden by default) -->
    <div class="menu" id="menu" style="display: none;">
        <ul>
            <li><a href="/employee/profile">Profile</a></li>
            <li><a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
    </div>

    <!-- Hidden Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="{{ asset('js/employee/ticketing/ticketingjavascript.js')}}"></script>
</body>
</html>
