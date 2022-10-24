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
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
<?php
    include_once("connection.php");
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
		$result = pg_query($conn, "SELECT * FROM category WHERE cat_id='$id'");
		$row = pg_fetch_array($result, null,PGSQL_ASSOC);
		$cat_name = $row['cat_name'];
		$cat_des = $row['cat_des'];
	}
?>

<div class="" style="padding: 4rem 23rem 1rem 33rem;">
	<h3 style="text-align: start; padding-left: 1rem">Updating Category</h3>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
                    <input type="hidden" value='<?php echo $id ;?>' name="txtId">
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Category Name(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" 
								  value='<?php echo $cat_name ;?>'>
							</div>
					</div>
                    
                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Description(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" 
								  value='<?php echo $cat_des ;?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10" style="text-align: end">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
						</div>
					</div>
				</form>
                <div style="text-align: center">
                    <ul id="error_cate">
                    </ul>
                </div>
	</div>



<?php
   if(isset($_POST["btnUpdate"])) {
       $id = $_POST["txtId"];
       $name = $_POST["txtName"];
       $des = $_POST["txtDes"];
       $err = "";
       if ($name == "") {
           $err .= "<li style='color: red'>Enter Category name<li>";
       }
       if ($des == "") {
           $err .= "<li style='color: red'>Enter Category description<li>";
       }
       if ($err == "") {
           $sq = "Select * from category where cat_name='$name'";
           $result = pg_query($conn, $sq);
           $err =  pg_num_rows($result);
           if (pg_num_rows($result) == 1 || pg_num_rows($result) == 0) {
               pg_query($conn, "UPDATE category SET cat_name = '$name', cat_des='$des' WHERE cat_id='$id'");
               echo '<meta http-equiv="refresh" content="0;URL=?page=category_management"/>';
           } else {
               $err .=  "<li style='color: red'>Duplicate category Name</li>";
           }
       }
   }
?>

     <?php
     if(isset($err) && $err != ''){
         ?>
         <script>
             $(document).ready(function (){
                 $('#error_cate').append("<?php echo $err ?>")
             })
         </script>
         <?php
     }
     ?>
<?php }} ?>

