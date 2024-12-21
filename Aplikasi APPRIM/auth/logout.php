<?php
session_start();
session_destroy(); // Hapus semua sesi
header("Location: ../auth/login.php");
exit();
?>
