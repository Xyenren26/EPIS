<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Management Information System</title>
    <link rel="stylesheet" href="css/adminstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar minimized">
            <div class="sidebar-header">
                <button class="minimize-btn" onclick="toggleSidebar()"></button> <!-- Hamburger icon for minimize button -->
            </div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search..." />
                <button class="search-btn" onclick="toggleSearchPopup()">🔍</button> <!-- Search button -->
            </div>
            <div class="nav-links">
                <div class="nav-item">
                    <a href="/home" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-home nav-logo"></i> <!-- Home icon -->
                            <span class="nav-label">HOME</span> <!-- Home label -->
                        </div>
                        <span class="nav-text">HOME</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/in-inventory" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-boxes nav-logo"></i> <!-- Inventory icon -->
                            <span class="nav-label">INVENTORY</span> <!-- Inventory label -->
                        </div>
                        <span class="nav-text">INVENTORY</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/profile" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-user nav-logo"></i> <!-- Profile icon -->
                            <span class="nav-label">PROFILE</span> <!-- Profile label -->
                        </div>
                        <span class="nav-text">PROFILE</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/contact" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-envelope nav-logo"></i> <!-- Contact icon -->
                            <span class="nav-label">CONTACT</span> <!-- Contact label -->
                        </div>
                        <span class="nav-text">CONTACT</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/admin" class="nav-link">
                        <div class="nav-logo-container">
                            <i class="fas fa-cog nav-logo"></i> <!-- Admin icon -->
                            <span class="nav-label">ADMIN</span> <!-- Admin label -->
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
                <h1>MANAGEMENT INFORMATION SYSTEM</h1>
                <button class="menu-btn" onclick="toggleMenu()">⋮</button>
            </div>
            <!-- Employee List Section -->
            <div class="employee-list">
                <div class="employee-list-header">
                    <h2>EMPLOYEE LIST</h2>
                    <div class="buttons">
                        <button class="icon-button" onclick="openPendingModal()">
                            <i class="fas fa-pending"></i> 
                            PENDING
                        </button>
                        <button class="icon-button" onclick="togglePopup()" >
                            <i class="fas fa-ticket-search"></i> 
                            SEARCH
                        </button>
                        <button class="icon-button export" onclick="toggleExportPopup()">
                            <i class="fas fa-check-export"></i> 
                            EXPORT
                        </button>
                    </div>
                </div>

                <!-- Search Popup -->
                <div id="search" class="popup" style="display: none;">
                    <div class="popup-content">
                        <span class="close-btn" onclick="closePopup('search')">×</span>
                        <h3>Search</h3>
                        <div class="input-container">
                            <input type="text" class="search-input" placeholder="Enter search query">
                            <button class="search-submit-btn">Search</button>
                        </div>
                    </div>
                </div>

                <!-- Export Popup -->
                <div id="exportPopup" class="popup" style="display: none;">
                    <div class="popup-content">
                        <span class="close-btn" onclick="closePopup('exportPopup')">×</span>
                        <h3>Export</h3>
                        <div class="button-container">
                            <button class="export-option-btn">Export to CSV</button>
                            <button class="export-option-btn">Export to Excel</button>
                        </div>
                    </div>
                </div>


                
            <!-- Active Accounts Section -->
            @if($activeAccounts->isNotEmpty())
                @foreach($activeAccounts as $account)
                    <div class="employee-container">
                        <div class="employee-photo">
                            <img src="data:image/jpeg;base64,{{ base64_encode($account->ProfilePicture) }}" alt="Profile Picture">
                        </div>
                        <div class="employee-info">
                            <h3>{{ $account->FirstName }} {{ $account->LastName }}</h3>
                            <p>ID: {{ $account->EmployeeID }}</p>
                            <p>User: {{ $account->Username }}</p>
                            <p>Account Type: {{ $account->AccountType }}</p>
                            <p>Status: {{ $account->status }}</p>
                            <p>Time In: {{ $account->time_in ?? 'Not logged in' }}</p>
                            <p>Time out: {{ $account->time_out ?? 'Not logged out' }}</p>
                        </div>
                        <button class="view-btn">View</button>
                    </div>
                @endforeach
            @else
                <p>No active employee data available.</p>
            @endif
        </div>
            <!-- Pending Modal -->
            <div id="pendingModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closePendingModal()">&times;</span>
                    <h2>Pending Administrator Accounts</h2>
                    <ul id="pendingList" class="pending-list">
                        <!-- Populate this list with pending accounts from the database -->
                        @foreach($pendingAccounts as $account)
                        <li class="pending-item">
                            <div class="pending-info">
                                <strong>{{ $account->FirstName }} {{ $account->LastName }}</strong>
                                <p class="username">Username: {{ $account->Username }}</p>
                            </div>
                            <div class="pending-actions">
                                <button onclick="acceptAccount('{{ $account->EmployeeID }}')" class="accept-button">
                                    <i class="fas fa-check"></i> Accept
                                </button>
                                <button onclick="voidAccount('{{ $account->EmployeeID }}')" class="void-button">
                                    <i class="fas fa-trash"></i> Void
                                </button>
                            </div>
                        </li>
                        @endforeach
                    </ul>
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
        </div>
    </div>

    <script src="{{ asset('js/adminjavascript.js') }}"></script>
</body>
</html>