<?php
/**
 * Short description here.
 *
 * PHP version 5
 */

session_start();
session_destroy();

header("location:../index.php?alert=logout");
?>
