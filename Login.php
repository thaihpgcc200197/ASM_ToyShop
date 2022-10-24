<link rel="stylesheet" type="text/css" href="style.css"/>

<?php
if(session_id() == '') {
    session_start();
}
if (isset($_POST['btnLogin']))
{
    $us = $_POST['txtUsername'];
    $pa = $_POST['txtPass'];

    $err = "";
    if($us=="")
    {
        $err.= "Enter Username, please<br>";
    }
    if($pa=="")
    {
        $err.= "Enter Password, please<br>";
    }
    if($err =="")
    {
        include_once("connection.php");
        $pass = md5($pa);
        $res = pg_query($conn, "SELECT username, state,  shop_id,password FROM Customer WHERE Username='$us' AND Password='$pass'")
        or die(pg_result_error($conn));
        $row = pg_fetch_array($res, null,PGSQL_ASSOC);
        if(pg_num_rows($res)==1){
            $_SESSION["us"] = $us;
            $_SESSION["role"] = $row['state'];
            $_SESSION["shop"] = $row['shop_id'];
            echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
        }
        else{
            $err.= "<p style='color: red; text-align: center'>Username or password wrong!</p>";
        }
    }

}
?>
<div class="" style="padding: 18% 39% 6% 31%;">
    <div class="content" style="transform: translateX(40%);">
        <h2>Login</h2>
        <h2>Login</h2>
    </div>
    <form id="form1" name="form1" method="POST" action="">
    <div class="">
        <div class="form-group">
            <label for="txtUsername" class="col-sm-2 control-label">Username(*):  </label>
            <div class="col">
                  <input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="Username"
                  value="<?php if(isset($_POST['txtUsername'])) echo $_POST['txtUsername'];?>" required>
            </div>
          </div>
        <div class="form-group">
            <label for="txtPass" class="col-sm-2 control-label">Password(*):  </label>
            <div class="col">
                    <input type="password" name="txtPass" id="txtPass" class="form-control" placeholder="Password" value="" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col"></div>
            <div class="col" style="text-align: end">
                <input type="submit" name="btnLogin"  class="btn btn-primary" id="btnLogin" value="Login"/>
            </div>
        </div>
     </div>
    </form>
    <?php if(isset($err) && $err != ''){
        echo $err;
    } ?>
</div>
   