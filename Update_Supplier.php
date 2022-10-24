<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<?php
    if(session_id() == '') {
        session_start();
    }
    if(!isset($_SESSION['role'])) {
        ?>
        <script>alert("You are not admin")</script>
        <?php
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    } else{
    if( $_SESSION["role"] != 1)
    {
        ?>
        <script>alert("You are not admin")</script>
        <?php
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    }
    else {
?>

<?php
include_once("connection.php");

    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        $result = pg_query($conn, "SELECT * FROM supplier WHERE sup_id='$id'");
        $row = pg_fetch_array($result, null,PGSQL_ASSOC);
        $sup_name = $row['sup_name'];
        $sup_address = $row['sup_address'];
    }
?>

<div class="" style="padding: 5% 10% 6% 18%;">
    <h3 style="text-align: start; padding-left: 1rem">Updating Supplier</h3>
    <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
        <input type="hidden" value='<?php echo $id ;?>' name="txtId">
        <div class="form-group">
            <label for="txtTen" class="col-sm-2 control-label">Supplier Name(*):  </label>
            <div class="col-sm-10">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Supplier Name"
                       value='<?php echo $sup_name ;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="txtMoTa" class="col-sm-2 control-label">Address(*):  </label>
            <div class="col-sm-10">
                <input type="text" name="txtAddress" id="txtDes" class="form-control" placeholder="Address"
                       value='<?php echo $sup_address ;?>'>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" style="text-align: end">
                <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
            </div>
        </div>
    </form>
    <div style="text-align: center">
        <ul id="error_update">
        </ul>
    </div>
</div>



<?php
if(isset($_POST["btnUpdate"])) {
    $id = $_POST["txtId"];
    $name = $_POST["txtName"];
    $address = $_POST["txtAddress"];
    $err = "";
    if ($name == "") {
        $err .= "<li style='color: red'>Enter Supplier name<li>";
    }
    if ($address == "") {
        $err .= "<li style='color: red'>Enter Supplier address<li>";
    }
    if ($err == "") {
        $sq = "Select * from supplier where sup_name='$name'";
        $result = pg_query($conn, $sq);
        if (pg_num_rows($result) == 1 || pg_num_rows($result) == 0) {
            pg_query($conn, "UPDATE supplier SET sup_name = '$name', sup_address='$address' WHERE sup_id='$id'");
            echo '<meta http-equiv="refresh" content="0;URL=?page=supplier_management"/>';
        } else {
            $err .=  "<li style='color: red'>Duplicate supplier name</li>";
        }
    }
}
?>

    <?php
        if(isset($err) && $err != ''){
    ?>
        <script>
            $(document).ready(function (){
                $('#error_update').append("<?php echo $err ?>")
            })
        </script>
    <?php
    }
    ?>

<?php
    }
 }
?>

