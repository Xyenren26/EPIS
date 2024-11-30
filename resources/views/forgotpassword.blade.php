<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/forgotpassstyle.css">
</head>
<body>

<h1 class="main-heading">WELCOME TO MANAGMENT INFORMATION SYSTEM OFFICE <br>
TECHNICAL SUPPORT DIVISION</h1>
    <div class="header">
        <h1 class="subheading">
            <span class="epis">E</span>-<span>IMS</span>: <span>E</span>lectronic <span>I</span>nventory <span>M</span>anagement <span>S</span>ystem
        </h1>
        <img src="images/LoginImages/pasiglogo.png" alt="Pasig Logo" class="logo">
    </div>
    
    <!-- Forgot Password Container -->
<div class="forgot-password-container" data-aos="fade-up">
    <h2>Forgot Password</h2>
    <form id="forgotPasswordForm" action="#" method="post">
        <div class="input-group" data-aos="fade-up">
            <label for="identifier">Enter your email or phone number</label>
            <input type="text" id="identifier" name="identifier" required>
        </div>
        <span id="error-message" style="color:red; display:none;">Please enter a valid email or phone number</span>
        <button type="submit" class="btn forgot-password-btn" data-aos="fade-up">Send Reset Link</button>
    </form>

    <!-- Link to login page -->
    <div class="links">
        <p>Remember your password? <a href="/" class="login">Login</a></p>
    </div>
</div>

<script src="js/loginjavascript.js"></script>
<script> AOS.init(); </script>

</body>
</html>
