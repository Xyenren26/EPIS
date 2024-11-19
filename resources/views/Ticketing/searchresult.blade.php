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
                <h1>TICKETING SYSTEM > RECORDS</h1>
                <button class="menu-btn" onclick="toggleMenu()">⋮</button>
            </div>

            <!-- Sort and Search Section -->
<div class="sort-search-container">
    <div class="sort-container">
        <label for="sortBy">Sort by:</label>
        <select id="sortBy" onchange="sortTickets()">
            <option value="recent">By Recent</option>
            <option value="date">By Date</option>
            <option value="department">By Department</option>
            <option value="employeeID">By Employee ID</option>
            <option value="technicalSupported">By Technical Supported</option>
        </select>
    </div>
    
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search tickets..." />
        <button class="search-btn" onclick="searchTickets()">🔍</button>
    </div>
</div>
<div class="records-container">
    @foreach ($tickets as $ticket)
        <div class="record">
            <div class="record-content">
                <div class="record-header" style="color: red;">CONTROL NO: {{ $ticket->control_no }}</div>
                <div class="record-details">
                    <p style="color: #003067;">{{ $ticket->fname }} {{ $ticket->lname }}</p>
                    <p style="color: #003067;">Department: {{ $ticket->Department }}</p>
                    <p style="color: #003067;">Employee ID: {{ $ticket->EmployeeID }}</p>
                </div>
            </div>
            <!-- Pass the ticket object as JSON -->
            <button class="view-btn" onclick="showDetailsModal({{ json_encode($ticket) }})">View</button>
        </div>
    @endforeach
</div>


<!-- Ticket Details Modal -->
<div id="detailsModal" class="details-modal" style="display: none">
    <div class="modal-content">
        <span class="close-btn" onclick="closeDetailsModal()">×</span>
        <h2>Ticket Details: <span id="modalStatus" class="status"></span></h2>
        <p><strong class="red">Control No:</strong> <span id="modalControlNo"></span></p>
        
        <div class="row">
            <div class="field">
                <p><strong>Name:</strong></p>
                <div class="data-box"><span id="modalName"></span></div>
            </div>
            <div class="field">
                <p><strong>Department:</strong></p>
                <div class="data-box"><span id="modalDepartment"></span></div>
            </div>
        </div>
        
        <div class="row">
            <div class="field">
                <p><strong>Employee ID:</strong></p>
                <div class="data-box"><span id="modalEmployeeID"></span></div>
            </div>
        </div>
        
        <p><strong>Concern:</strong></p>
        <div class="data-box"><span id="modalConcern"></span></div>

        <div class="row">
            <div class="field">
                <p><strong>Tech Support ID:</strong></p>
                <div class="data-box"><span id="modalTechnicalSupported"></span></div>
            </div>
            <div class="field">
                <p><strong>Time In:</strong></p>
                <div class="data-box"><span id="modalTimeIn"></span></div>
            </div>
        </div>
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
