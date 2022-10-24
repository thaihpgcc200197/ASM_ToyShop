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
    <script language="javascript">
        function deleteConfirm()
        {
            if(confirm("Are you sure to delete!"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        </script>


<?php
include_once("connection.php");
if(isset($_GET["function"])=="del")
    {
        if(isset($_GET["id"]))
        {
            $id = $_GET["id"];
            pg_query($conn, "DELETE FROM category WHERE cat_id='$id'");
            echo '<meta http-equiv="refresh" content="0;URL=?page=category_management"/>';
        }
    }
?>
  <div style="padding: 2rem 2rem 0 2rem;">
        <form name="frm" method="post" action="">
        <p style="text-align: end">
        <img src="images/add.png" alt="Add new" width="16" height="16" border="0" /> <a href="?page=add_category" style="color: black!important;"> Add</a>
        </p>
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%" style="text-align: center">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Category Name</strong></th>
                    <th><strong>Desscription</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
                
                $No=1;
                $result = pg_query($conn, "SELECT * FROM category");
                while($row=pg_fetch_array($result, null,PGSQL_ASSOC))
                {
            ?>  
            <tr>
              <td class="cotCheckBox"><?php echo $No; ?></td>
              <td><?php echo $row["cat_name"]; ?></td>
              <td><?php echo $row["cat_des"]; ?></td>
              <td style='text-align:center'><a href="?page=update_category&&id=<?php echo $row["cat_id"]; ?>">
	            <img src='images/edit.png' border='0'/> </a></td>
              <td style='text-align:center'>
              <a href="?page=category_management&&function=del&&id=<?php echo $row["cat_id"]; ?>" onclick="return deleteConfirm()">
              <img src='images/delete.png' border='0' /></a></td>
            </tr>
            <?php
                $No++;      
                }
                ?>
			</tbody>
        </table>  
    
        
        
        <!--Nut them moi nut xoa tat ca->
        <div class="row" style="background-color:#FFF">Nut chuc nang -->
            <div class="col-md-12">
            	
            </div>
        </div>
 </form>
</div>
<?php
    }
    }
?>
 
   