<?php
require 'capture.php'; // Most of the code that logs the user's IP address is on the required file
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Loading...</title>
        <meta name="author" content="miguel456">
    </head>
    <body>
        <div align="center">
            <?php logAddress(); ?>
            <p>Logging <?php $_SERVER['REMOTE_ADDR']; ?>nbsp;... </p>
            <p>Attempting to cleanse logs...</p>
            <?php deleteBigFile(); // Check log file and determine whether it is elegible for deletion ?>
        </div>
    </body>
</html>
