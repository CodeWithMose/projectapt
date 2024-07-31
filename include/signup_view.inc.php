<?php

declare(strict_types=1);



function check_signup_errors() {
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];
        $output = '';

        foreach ($errors as $error) {
            $output .= '<p class="form-error">' . htmlspecialchars($error) . '</p>';
        }

        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                const errorsDiv = document.getElementById("errors-div");
                if (errorsDiv) {
                    errorsDiv.innerHTML = ' . json_encode($output) . ';
                }
            });
        </script>';

        unset($_SESSION['errors_signup']);
    } elseif (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                const errorsDiv = document.getElementById("errors-div");
                if (errorsDiv) {
                    errorsDiv.innerHTML = "<p class=\"form-success\">Signup success!</p>";
                }
            });
        </script>';
    }
}
