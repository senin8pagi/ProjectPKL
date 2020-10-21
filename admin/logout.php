<?php
/**
 * Short description here.
 *
 * PHP version 5
 *
 * @category Foo
 */

session_start();
session_destroy();

header("location:../index.php?alert=logout");
?>
