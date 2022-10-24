<?php
$conn = pg_connect("postgres://fwcnpexbdurcpw:d5d0954f88d724e0d8a067b8f1edf482cc941ba5698fabd2031ec8cd77fc107e@ec2-52-49-201-212.eu-west-1.compute.amazonaws.com:5432/davgkm8ds3p7nh");
if (!$conn) {
    die("Connection failed");
}
?>