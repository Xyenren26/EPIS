<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Information System</title>
    <link rel="stylesheet" href="css/Inventory/Inventorystyle.css">
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
            <!-- Inventory Navigation Tabs -->
            <div class="inventory-nav">
                <a href="/in-inventory" class="inventory-tab active">IN INVENTORY</a>
                <a href="/out-inventory" class="inventory-tab">OUT INVENTORY</a>
                <a href="/deployment" class="inventory-tab">DEPLOYMENT</a>
                <a href="/all-inventory" class="inventory-tab">ALL</a>

                <!-- Action Buttons and Logo -->
                <div class="action-buttons">
                    <button class="action-btn">New</button>
                    <button class="action-btn" onclick="openSearch()">Search</button>
                    <button class="action-btn export-btn" onclick="openExportPopup()">Export</button>
                    <img src="images/LoginImages/pasiglogo.png" alt="Pasig Logo" class="pasig-logo">
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
    <script src="js/Inventory/Inventoryjavascript.js"></script>
</body>
</html>

