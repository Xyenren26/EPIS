<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Information System</title>
    <link rel="stylesheet" href="css/profilestyle.css">
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
                            <i class="fas fa-home nav-logo"></i>
                            <span class="nav-label">HOME</span>
                        </div>
                        <span class="nav-text">HOME</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/inventory" class="nav-link">
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
                <h1>PROFILE</h1>
                <button class="menu-btn" onclick="toggleMenu()">⋮</button>
            </div>

            <div class="button">
                <button class="nav-button active" id="infoButton" onclick="showInfo()">
                    <i class="fas fa-building"></i> Information
                </button>
                <button class="nav-button inactive" id="securityButton" onclick="showSecurity()">
                    <i class="fas fa-lock"></i> Security
                </button>
            </div>

            <!-- Profile Information Section -->
            <div class="profile-info-container">
                <div class="profile-info" id="infoSection">
                    <div class="form-group row">
                        <div class="form-item">
                            <label for="firstname">First Name:</label>
                            <input type="text" id="firstname" name="firstname" value="{{ $account->FirstName }}" readonly />
                        </div>
                        <div class="form-item">
                            <label for="lastname">Last Name:</label>
                            <input type="text" id="lastname" name="lastname" value="{{ $account->LastName }}" readonly />
                        </div>
                        <div class="form-item">
                            <label for="suffix">Suffix:</label>
                            <input type="text" id="suffix" name="suffix" value="{{ $account->Suffix }}" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-item">
                            <label for="birthdate">Birthdate:</label>
                            <input type="text" id="birthdate" name="birthdate" value="{{ $account->BirthDate }}" readonly />
                        </div>
                        <div class="form-item">
                            <label for="age">Age:</label>
                            <input type="text" id="age" name="age" value="{{ $account->Age }}" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-item">
                            <label for="gender">Gender:</label>
                            <input type="text" id="gender" name="gender" value="{{ $account->Gender }}" readonly />
                        </div>
                        <div class="form-item">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" value="{{ $account->Email }}" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="{{ $account->Address }}" readonly />
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" id="phone" name="phone" value="{{ $account->PhoneNumber }}" readonly />
                    </div>
                </div>

                <!-- Profile Picture Section -->
                <div class="profile-picture-container">
                    <img src="data:image/png;base64,{{ base64_encode($account->ProfilePicture) }}" alt="Profile Picture" class="profile-picture" id="profile-picture" />
                    <label for="profile-picture" id="profile-label">Profile Picture:</label>
                </div>
            </div>

            <div class="action-button">
                <button class="edit-button" id="edit-button">
                    <i class="fas fa-edit"></i> EDIT
                </button>
                <button class="remove-button" id="remove-button">
                    <i class="fas fa-trash"></i> REMOVE
                </button>
            </div>

            <!-- Security Information Section -->
            <div id="securityInfo" style="display: none; margin-top: 20px;">
                <div class="profile-info">
                    <div class="form-group row">
                        <div class="form-item">
                            <label for="employeeId">Employee ID:</label>
                            <input type="text" id="employeeId" name="employeeId" value="{{ $account->EmployeeID }}" readonly />
                        </div>
                        <div class="form-item">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" value="{{ $account->Username }}" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-item">
                            <label for="password">Password:</label>
                            <input type="text" id="password" name="password" value="********" readonly /> <!-- Masked password -->
                        </div>
                        <div class="form-item">
                            <label for="accountType">Account Type:</label>
                            <input type="text" id="accountType" name="accountType" value="{{ $account->AccountType }}" readonly />
                        </div>
                    </div>
                    <div class="action-button">
                        <button class="edit-button">
                            <i class="fas fa-edit"></i> EDIT
                        </button>
                        <button class="remove-button">
                            <i class="fas fa-key"></i> CHANGE PASSWORD 
                        </button>
                    </div>   
                </div>
            </div>

            <!-- Menu (hidden by default) -->
            <div class="menu" id="menu" style="display: none;">
                <ul>
                    <li><a href="/home">Home</a></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <script src="js/profilejavascript.js"></script>
</body>
</html>
