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
                    <a href="/out-inventory" class="nav-link">
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
                <a href="/out-inventory" class="inventory-tab active">OUT INVENTORY</a>
                <a href="/deployment" class="inventory-tab">DEPLOYMENT</a>
                <a href="/all-inventory" class="inventory-tab">ALL</a>

                <!-- Action Buttons and Logo -->
                <div class="action-buttons">
                    <button class="action-btn" onclick="openPopup('formPopup')">New</button>
                    <button class="action-btn" onclick="openSearch()">Search</button>
                    <button class="action-btn export-btn" onclick="openExportPopup()">Export</button>
                    <img src="images/LoginImages/pasiglogo.png" alt="Pasig Logo" class="pasig-logo">
                </div>
                
                <!-- Form new Popup -->
                <div id="formPopup" class="form-popup-container" style="display: none;">
                    <div class="form-popup-content">
                        <span class="form-popup-close-btn" onclick="closePopup('formPopup')">×</span>
                        <div class="form-popup-form-container">

                            <header class="form-popup-header">
                                <div class="form-popup-logo">
                                    <img src="images/LoginImages/pasiglogo.png" alt="Logo">
                                </div>
                                <h1>ICT Equipment Service Request Form</h1>
                                <div class="form-popup-form-info">
                                    <span>Form No.: SP4-2024-004A</span>
                                </div>
                            </header>

                            <!-- Walk-In or Pull-Out Section -->
                            <section class="form-popup-section">
                                <label><input type="radio" name="service_type" value="walk_in"> Walk-In</label>
                                <label><input type="radio" name="service_type" value="pull_out"> Pull-Out</label>
                            </section>

                            <form>
                                <!-- General Information Section -->
                                <section class="form-popup-section">
                                    <h3 class="form-popup-title">General Information</h3>
                                    <div class="form-popup-input-group">
                                        <label class="form-popup-label">Department / Office / Unit:</label>
                                        <input class="form-popup-input" type="text" name="department" required>
                                    </div>
                                    <div class="form-popup-input-group">
                                        <label class="form-popup-label">Brand:</label>
                                        <input class="form-popup-input" type="text" name="brand" required>
                                    </div>
                                    <div class="form-popup-checkbox-group">
                                        <label class="form-popup-label">Condition of Equipment:</label>
                                        <label><input type="checkbox" name="condition" value="working"> Working</label>
                                        <label><input type="checkbox" name="condition" value="not-working"> Not Working</label>
                                        <label><input type="checkbox" name="condition" value="needs-repair"> Needs Repair</label>
                                    </div>
                                </section>

                                <!-- Equipment Description Section -->
                                <section class="form-popup-section">
                                    <h3 class="form-popup-title">Equipment Description</h3>
                                    <table class="form-popup-table">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Motherboard</th>
                                                <th>RAM</th>
                                                <th>HDD</th>
                                                <th>Accessories</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>System Unit</td>
                                                <td><input type="checkbox" name="system_motherboard"></td>
                                                <td><input type="checkbox" name="system_ram"></td>
                                                <td><input type="checkbox" name="system_hdd"></td>
                                                <td><input type="checkbox" name="system_accessories"></td>
                                                <td><input class="form-popup-input" type="text" name="system_remarks"></td>
                                            </tr>
                                            <tr>
                                                <td>Laptop</td>
                                                <td><input type="checkbox" name="laptop_motherboard"></td>
                                                <td><input type="checkbox" name="laptop_ram"></td>
                                                <td><input type="checkbox" name="laptop_hdd"></td>
                                                <td><input type="checkbox" name="laptop_accessories"></td>
                                                <td><input class="form-popup-input" type="text" name="laptop_remarks"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="form-popup-subheader">Printer and UPS</td>
                                            </tr>
                                            <tr>
                                                <td>Printer</td>
                                                <td colspan="5"><input class="form-popup-input" type="text" name="printer_remarks" placeholder="Remarks"></td>
                                            </tr>
                                            <tr>
                                                <td>UPS</td>
                                                <td colspan="5"><input class="form-popup-input" type="text" name="ups_remarks" placeholder="Remarks"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>

                                <!-- Pre-repair Section -->
                                <section class="form-popup-section">
                                    <h3 class="form-popup-title">Pre Repair</h3>
                                    <div class="form-popup-input-group">
                                        <label class="form-popup-label">Date / Time:</label>
                                        <input class="form-popup-input" type="datetime-local" name="pre_repair_date">
                                    </div>
                                    <div class="form-popup-input-group">
                                        <label class="form-popup-label">Department / Office / Unit Head:</label>
                                        <input class="form-popup-input" type="text" name="unit_head" required>
                                    </div>
                                    <div class="form-popup-input-group">
                                        <label class="form-popup-label">Remarks:</label>
                                        <input class="form-popup-input" type="text" name="pre_repair_remarks">
                                    </div>
                                    <div class="form-popup-input-group">
                                        <label class="form-popup-label">Signature:</label>
                                        <input class="form-popup-input" type="text" name="pre_repair_signature">
                                    </div>
                                </section>

                                <!-- Post-repair Section -->
                                <section class="form-popup-section">
                                    <h3 class="form-popup-title">Post Repair</h3>
                                    <div class="form-popup-input-group">
                                        <label class="form-popup-label">Date / Time:</label>
                                        <input class="form-popup-input" type="datetime-local" name="post_repair_date">
                                    </div>
                                    <div class="form-popup-input-group">
                                        <label class="form-popup-label">Remarks:</label>
                                        <input class="form-popup-input" type="text" name="post_repair_remarks">
                                    </div>
                                    <div class="form-popup-input-group">
                                        <label class="form-popup-label">Signature:</label>
                                        <input class="form-popup-input" type="text" name="post_repair_signature">
                                    </div>
                                </section>

                                <!-- Rating Section -->
                                <section class="form-popup-section">
                                    <h3 class="form-popup-title">Rating</h3>
                                    <p class="form-popup-description">Rate the service (1 - Lowest, 5 - Highest):</p>
                                    <div class="form-popup-radio-group">
                                        <label><input type="radio" name="rating" value="1"> 1</label>
                                        <label><input type="radio" name="rating" value="2"> 2</label>
                                        <label><input type="radio" name="rating" value="3"> 3</label>
                                        <label><input type="radio" name="rating" value="4"> 4</label>
                                        <label><input type="radio" name="rating" value="5"> 5</label>
                                    </div>
                                </section>

                                <button class="form-popup-button" type="submit">Submit</button>
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

