<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/loginstyle.css">
</head>
<body>

	<h1 class="main-heading">MIS - Technical Support Division</h1>
	
   <img src="C:\Users\rogelio\OneDrive\Documents\Homepage\picture\pasiglogo.png" alt="Logo" class="logo">
    
    <!-- Forgot Password Container -->
    <div class="forgot-password-container"data-aos="fade-up">
        <h2>Forgot Password</h2>
        <form id="forgotPasswordForm" action="#" method="post">
            <div class="input-group"data-aos="fade-up">
                <label for="identifier">Enter your email or phone number</label>
                <input type="text" id="identifier" name="identifier" required>
            </div>
            <span id="error-message" style="color:red; display:none;">Please enter a valid email or phone number</span>
           <button type="submit" class="btn forgot-password-btn"data-aos="fade-up">Send Reset Link</button>
        </form>

        <!-- Link to login page -->
        <div class="links">
            <p>Remember your password? <a href="homepage.html" class="login">Login</a></p>
        </div>
    </div>

<script src="js/loginjavascript.js"></script>
<script> AOS.init(); </script>

</body>
</html>
