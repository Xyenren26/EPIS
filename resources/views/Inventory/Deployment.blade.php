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
                    <a href="/deployment" class="nav-link">
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
                <a href="/in-inventory" class="inventory-tab">IN INVENTORY</a>
                <a href="/out-inventory" class="inventory-tab">OUT INVENTORY</a>
                <a href="/deployment" class="inventory-tab active">DEPLOYMENT</a>
                <a href="/all-inventory" class="inventory-tab">ALL</a>

                <!-- Action Buttons and Logo -->
                <div class="action-buttons">
                    <button class="action-btn" onclick="openFormPopup()">New</button>
                    <button class="action-btn" onclick="openSearch()">Search</button>
                    <button class="action-btn export-btn" onclick="openExportPopup()">Export</button>
                    <img src="images/LoginImages/pasiglogo.png" alt="Pasig Logo" class="pasig-logo">
                </div>

                <!-- Form Popup -->
<div id="formPopup" class="form-popup-container">
    <div class="form-popup-content">
        <span class="form-popup-close-btn" onclick="closePopup('formPopup')">×</span>
        <div class="form-container">
            <header>
                <div class="logo">
                    <img src="images/LoginImages/pasiglogo.png" alt="Logo">
                </div>
                <div class="title">
                    <h1>IT EQUIPMENT / SOFTWARE / I.S. ACKNOWLEDGEMENT RECEIPT FORM</h1>
                    <p>Management Information System Office</p>
                </div>
            </header>
            <form>
                <table>
                    <tr>
                        <th colspan="4">Purpose</th>
                        <td colspan="4">
                            <textarea name="purpose" placeholder="Enter purpose here..." rows="2"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Control Number:</th>
                        <td colspan="3"><input type="text" placeholder="Enter Control Number"></td>
                        <th>Status:</th>
                        <td><input type="checkbox"> New</td>
                        <td><input type="checkbox"> Used</td>
                    </tr>
                    <tr>
                        <th>Components:</th>
                        <td><input type="checkbox"> CPU</td>
                        <td><input type="checkbox"> Monitor</td>
                        <td><input type="checkbox"> Printer</td>
                        <td><input type="checkbox"> UPS</td>
                        <td><input type="checkbox"> Switch</td>
                        <td><input type="checkbox"> Keyboard</td>
                        <td><input type="checkbox"> Mouse</td>
                    </tr>
                    <tr>
                        <th colspan="2">Software / I.S.</th>
                        <td colspan="6">
                            <input type="checkbox"> Google Workspace
                            <input type="checkbox"> MS Office
                            <input type="checkbox"> Others
                        </td>
                    </tr>
                    <tr>
                        <th>Brand/Name</th>
                        <td colspan="7"><input type="text" placeholder="Enter brand/model"></td>
                    </tr>
                    <tr>
                        <th>Specification</th>
                        <td colspan="7"><textarea placeholder="Enter specifications"></textarea></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <th>Serial Number</th>
                        <th>Quantity</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="description" placeholder="Enter description"></td>
                        <td><input type="text" name="serial_number" placeholder="Enter serial number"></td>
                        <td><input type="number" name="quantity" placeholder="Enter quantity"></td>
                    </tr>
                    <tr>
                        <th>Received By</th>
                        <td>
                            <input type="text" name="received_by" placeholder="Enter Name">
                            <br>
                            <span>Signature over printed name</span>
                        </td>
                        <th>Issued By</th>
                        <td>
                            <input type="text" name="issued_by" placeholder="Enter Name">
                            <br>
                            <span>Signature over printed name</span>
                        </td>
                        <th>Noted By</th>
                        <td>
                            <input type="text" name="noted_by" placeholder="Enter Name">
                            <br>
                            <span>Signature over printed name</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><input type="date" name="received_date"></td>
                        <th>Date</th>
                        <td><input type="date" name="issued_date"></td>
                        <th>Date</th>
                        <td><input type="date" name="noted_date"></td>
                    </tr>
                </table>
                <div class="submit-btn">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
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

