<?php
 require_once 'include\config_session.inc.php';
 require_once 'include\signup_view.inc.php';
 require_once 'include\login_view.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Styles/accounts.css">
</head>
<body>
<div id="errors-div">hello</div>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form id="signupForm" action="include/signup.inc.php" method="post">
                <h1>Create Account</h1>
                <input type="text" name="username" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="tel" name="phone" placeholder="Phone">
                <input type="text" name="location" placeholder="Location">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="confirm_password" placeholder="Password">
                <button id="signupButton">Sign Up</button>
            </form>
           
            <?php 
              check_signup_errors();
            ?>
           
        </div>
        
        <div class="form-container sign-up">
            <form action="include/login.inc.php" method="post"  id="loginForm">
                <h1>Sign In</h1>
                    <input type="email" id="email" name="email" placeholder="Email">
                    <input type="password" id="password" name="pwd" placeholder="Passsword">
                <a href="#">Forgot Your Password</a>
                <button type="submit" id="loginButton">Sign In</button>
            </form>  

            <?php
            check_login_errors();
            ?>
        </div>
        
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                <h1>Hello, Friend!</h1>
                    <p>Register to get access to all our features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
                <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                    <p>Enter your personal details to log in</p>
                    <button class="hidden" id="login">Sign In</button>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="Javascript/accounts.js">
        function getQueryParams() {
            const params = {};
            const queryString = window.location.search.slice(1);
            const queries = queryString.split('&');
            queries.forEach(query => {
                const [key, value] = query.split('=');
                params[key] = value;
            });
            return params;
        }

        // Show alerts based on query parameters
        window.onload = () => {
            const params = getQueryParams();

            if (params.error === 'invalid_credentials') {
                alert('Invalid email or password. Please try again.');
            } else if (params.login === 'success') {
                alert('Login successful!');
            }
        };
    </script>
</body>
</html>