<?php
$conn = pg_connect("postgres://qbcmmnvgjfgcgk:ef0938d2c855a081f0e80af49ae37cc1cc592fa86cdb4e2298eb74732e37a9e5@ec2-44-213-151-75.compute-1.amazonaws.com:5432/d6738vvrnf3llt");
if (!$conn) {
    die("Connection failed");
}
?>