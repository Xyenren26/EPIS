<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Information System</title>
    <link rel="stylesheet" href="{{ asset('css/ticketing/reportstyle.css') }}">
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
                <h1>REPORT AND MONITORING</h1>
                <button class="menu-btn" onclick="toggleMenu()">⋮</button>
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
            
            <!-- Accordion and Date Picker -->
            <fieldset class="accordion-datepicker-container">
                <div class="accordion-container">
                    <div class="accordion">
                        <h3>TICKETING</h3>
                        <div class="accordion-content">
                            <p>Details of the activity go here...</p>
                        </div>
                        <h3>IN AND OUT INVENTORY</h3>
                        <div class="accordion-content">
                            <p>Details of past activities go here...</p>
                        </div>
                        <h3>DEPLOYMENT</h3>
                        <div class="accordion-content">
                            <p>Details of past activities go here...</p>
                        </div>
						<h3>OPTIONAL</h3>
                        <div class="accordion-content">
                            <p>Details of the activity go here...</p>
                        </div>
						<h3>OPTIONAL</h3>
                        <div class="accordion-content">
                            <p>Details of the activity go here...</p>
                        </div>
                    </div>
                </div>

				<!-- Date Picker Section -->
				<div class="date-selection-container">
					<fieldset class="date-input-container">
						<input type="text" id="selectedDate" class="selected-date-input" placeholder="Select a date" readonly />
					</fieldset>
					<div class="datepicker">
						<div class="datepicker-header">

							<!-- Year Navigation Buttons -->
							<button id="prevYear" class="calendar-btn prev-year"> &lt; </button>
							<select id="yearSelect" class="year-select"></select>
							<button id="nextYear" class="calendar-btn next-year"> &gt; </button>

							<!-- Month Navigation Buttons -->
							<button id="prevMonth" class="calendar-btn prev-month"> &lt; </button>
							<select id="monthSelect" class="month-select"></select>
							<button id="nextMonth" class="calendar-btn next-month"> &gt; </button>
						</div>
						<div class="datepicker-calendar"></div>
						<div class="datepicker-footer">
							<button class="cancel">Cancel</button>
							<button class="ok">OK</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

    <script src="../js/ticketing/reportjavascript.js"></script>
</body>
</html>
