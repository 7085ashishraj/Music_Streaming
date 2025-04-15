<?php
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Clear local storage data via JavaScript and redirect
echo '
<script>
    localStorage.removeItem("username");
    localStorage.removeItem("user_id");
    window.location.href = "../index.html";
</script>
';
exit;
?>