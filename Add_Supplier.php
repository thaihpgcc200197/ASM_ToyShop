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
    } else{
?>

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<?php
include_once("connection.php");
if(isset($_POST["btnAdd"]))
{
    $name = $_POST["txtName"];
    $address = $_POST["txtAddress"];
    $err="";
    if($name=="")
    {
        $err.="<li style='color: red'>Enter Supplier name<li>";
    }

    if($address=="")
    {
        $err.="<li style='color: red'>Enter Supplier address<li>";
    }

    if($err=="")
    {
        $sq="Select * from supplier where  sup_name='$name'";
        $result= pg_query($conn,$sq);
        if(pg_num_rows($result)==0)
        {
            pg_query($conn, "INSERT INTO supplier (sup_name, sup_address) VALUES('$name','$address')");
            echo '<meta http-equiv="refresh" content="0;URL=?page=supplier_management"/>';
        }
        else
        {
            $err.= "<li style='color: red'>Duplicate name<li>";
        }
    }
}
?>

<div class="" style="padding: 5% 10% 6% 18%;">
    <h3 style="text-align: start; padding-left: 1rem">Adding Supplier</h3>
    <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="txtTen" class="col-sm-2 control-label">Supplier Name(*):  </label>
            <div class="col-sm-10">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Supplier Name" value='<?php echo isset($_POST["txtName"])?($_POST["txtName"]):"";?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="txtMoTa" class="col-sm-2 control-label">Address(*):  </label>
            <div class="col-sm-10">
                <input type="text" name="txtAddress" id="txtDes" class="form-control" placeholder="Address" value='<?php echo isset($_POST["txtAddress"])?($_POST["txtAddress"]):"";?>'>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" style="text-align: end">
                <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
            </div>
        </div>
    </form>
    <div style="text-align: center">
        <ul id="error_add">
        </ul>
    </div>

</div>

<?php
if(isset($err) && $err !== ''){
    ?>
    <script>
        $(document).ready(function (){
            $('#error_add').append("<?php echo $err ?>")
        })
    </script>
    <?php
}
?>

<?php
    }
    }
?>
