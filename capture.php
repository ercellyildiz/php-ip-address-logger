<?php

/**
* PHP Address Logger - The PHP IP logger and Honeypot - Copyright (C) 2016 miguel456
*
* This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses/.
* Full license: LICENSE.md within this repo.
* Author may be reached via e-mail: miguel456@worldofdiamondsmail.us.to
*/

require  'database.php';
require_once 'config.php'; // DON'T CHANGE THIS REQUIRE_ONCE TO REQUIRE, IT WILL BREAK THE ENTIRE APP
// Define all necessary variables for use, including some statements, but not all
//FIXME: This doesn't work; try to fix first

if($debugMode == true) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_WARNING | E_ERROR);
    // Please don't turn display_errors to on your php.ini! It's not needed!
    echo "WARNING! DEBUG MODE IS ACTIVE. PLEASE TURN IT OFF IT YOU ARE FINISHED WITH DEBUGGING.";
    echo "<br>";
    echo "Note: PHP will create a low-level warning when the script is executed for someone who's not whitelisted. Please dismiss it.";
}
// whitelist check
$useDatabase = "USE iplogger;";
$grabStuff = "SELECT * FROM whitelist LIMIT 10";
$subjectIP = $_SERVER['REMOTE_ADDR'];
$youAreWhitelisted = "You're whitelisted, silly! We're not going to tell anyone...";
mysqli_query($connection, $useDatabase); // May be obsolete but better safe than sorry (Tells the server to use that DB, database.php already does that)
mysqli_query($connection, $grabStuff); // "SELECT * FROM whitelist LIMIT 10;";
$result = mysqli_query($connection, $grabStuff);
$string = mysqli_fetch_array($result);
$stringToSearch = $subjectIP;

if(in_array($stringToSearch, $string)) {
    exit($youAreWhitelisted);
}


/**
 * The below code will take the subject's IP address and insert it into the database, assuming the code above hasn't aborted the script.
 * Also, include dirbname incase the user is using multiple traps
 */
 // database add

if(isset($_SERVER['HTTP_REFERER'])) { // get referer if it exists
    if($debugMode == true) {
        echo "Client did send an http referer. Inserting into DB.";
    }
    $refererNonSanitized = $_SERVER['HTTP_REFERER']; // put referer in a var for later use
    $refererAlreadySanitized = htmlspecialchars($refererNonSanitized); // Strip referer of any html tags
    $refererAlreadySanitizedRealStr = mysqli_real_escape_string($connection, $refererAlreadySanitized); // escape any left-over special mysql elements
}
elseif($debugMode == true) {
    echo "<br>";
    echo "Client didn't send an http referer. The site has either been accessed directly or he/she is using a referer cleaner.";
    echo "<br>";
} else { // defines the variable in case the data necessary to define it above was not available (or didn't exist). This prevents the undefined variable warning.
    if(!isset($refererAlreadySanitizedRealStr)) {
        $refererAlreadySanitizedRealStr = NULL;
    }   
}
    
 
$createDatabase = "CREATE DATABASE IF NOT EXISTS iplogger;";
$address = "$_SERVER[REMOTE_ADDR]"; // Fetch user's IP address
mysqli_query($connection, $useDatabase);
mysqli_query($connection, $createDatabase);
$insertLoc = __DIR__;
$sanitizedInsertLoc = mysqli_real_escape_string($connection, $insertLoc); // This isn't Injection prevention; just to escape special chars from dirnames, so its fine to use this altought it would be still dangerous for user input.
$sanitizedInsertLocSpecChars = htmlspecialchars($sanitizedInsertLoc);
$unifiedQuery = "INSERT INTO `addresses` (`addresses`, `httpreferer`, `location`, `time`)
VALUES ('$address', '$refererAlreadySanitizedRealStr', '$sanitizedInsertLocSpecChars', now());";
mysqli_query($connection, $unifiedQuery);

if($debugMode == true) {
    echo "<br>";
    echo "Current SQLSTATE is: " . mysqli_sqlstate($connection);
}

mysqli_close($connection); // Closes the connection


/**
 * This function will delete the text log file in case it exceeds 10 megabytes. This is here as there is a concern for trolls that
 * may spam a page therefore making the log as big as they want.
 * The function is rarely called, except when a database connection has failed and fallback() is called as well.
 */
function deleteBigFile() {
    $getLogFile = 'addresses.txt';
    if(file_exists($getLogFile) && filesize($getLogFile) > 10000000) {
        unlink($getLogFile);
    }
    else {
        // do nothing
    }
    if($debugMode == true) {
        echo "<br>";
        echo "Function deleteBigFile() was called. Assuming the app has fallen back to default logging methods.";
    }
}
/**
 * This function is called when no database connection is available. The function calls the legacy function subjectIsWhitelisted().
 * This function does exactly the same as the MySQL code above, in exception that it writes to a file as a direct result of
 * connecting to the database not being available.
 * NOTE: This code will only be executed as per user option in the config file. They can either turn it off (which will kill the script if no DB conn is available)
 * or turn it on, which will allow the script to keep running, but with errors.
 */

function fallback() { // Formerly logAddress()
    subjectIsWhitelistedLegacy();
    deleteBigFile();
    date_default_timezone_set('UTC');
    $getDate = date('l jS \of F Y h:i:s A');
    $subjectIP = '$_SERVER["REMOTE_ADDR"]';
    $logAddress = fopen('addresses.txt', 'a+'); // Open file
    fwrite($logAddress, $getDate . " - " . $subjectIP);
    fclose($logAddress);
}


function subjectIsWhitelistedLegacy() { // For exclusive use in this file only; shouldn't be called elsewhere
    $whitelisted = "You are whitelisted. Not logging address.";
    $getWhitelist = fopen('whitelist.txt', 'r');
    $readData = fread($getWhitelist, 40);
    fclose($getWhitelist);
    
}
?>
