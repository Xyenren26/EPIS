<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Information System</title>
    <link rel="stylesheet" href="css/homestyle.css">
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
                <button class="search-btn">🔍</button> <!-- Search button -->
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
                    <a href="/inventory" class="nav-link">
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
            </button> <!-- Back button -->
                <h1>MANAGEMENT INFORMATION SYSTEM</h1>
                <button class="menu-btn" onclick="toggleMenu()">⋮</button> <!-- Three vertical dots -->
            </div>
            <div class="image-container">
                <img src="images/city-hall-image.jpg" alt="City Hall" class="city-hall-image" id="cityHallImage">
                <h2 class="overlay-title">
                    PASIG CITY<br>
                    <span class="subtitle">INVENTORY SYSTEM</span>
                </h2>
            </div>

            <div class="buttons">
                <button class="icon-button">
                    <i class="fas fa-tasks"></i> <!-- Task icon -->
                    Monitoring
                </button>
                <a href="/ticketing/ticketing">
                    <button class="icon-button">
                        <i class="fas fa-ticket-alt"></i> <!-- Ticket icon -->
                        Ticketing
                    </button>
                </a>
                <button class="icon-button">
                    <i class="fas fa-check-circle"></i> <!-- Monitoring icon -->
                    Task
                </button>
            </div>

           <!-- Recent items section -->
            <div class="recent-items">
                <h2 class="recent-title">Recent</h2> <!-- Add this line -->
                <div class="recent-item">
                    <img src="images/computer-screen-image.jpg" alt="Computer Screen">
                    <div class="recent-item-details">
                        <h3>Computer Screen</h3>
                        <p>Date Appointed: September 02, 2024</p>
                        <p>Details about the computer information</p>
                    </div>
                </div>
                <div class="recent-item">
                    <img src="images/processing-unit-image.jpg" alt="Processing Unit">
                    <div class="recent-item-details">
                        <h3>Processing Unit</h3>
                        <p>Date Appointed: September 02, 2024</p>
                        <p>Details about the processing unit information</p>
                    </div>
                </div>
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
    <script src="js/homejavascript.js"></script>
</body>
</html>
