<?php
if(session_id() == '') {
    session_start();
}
session_destroy();
echo '<meta http-equiv="refresh" content="0;URL=?page=login"/>';
?>