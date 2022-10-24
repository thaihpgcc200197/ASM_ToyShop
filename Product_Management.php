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
    else{
    ?>

    <script>
        function deleteConfirm() {
            if (confirm("Are you sure to delete!")) {
                return true;
            } else {
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
            $result = pg_query($conn, "select pro_image FROM product  WHERE product_id='$id'");
            $row = pg_fetch_array($result, null, PGSQL_ASSOC);
            $img = $row['pro_image'];
            unlink('product-imgs/'.$img);
            pg_query($conn, "DELETE FROM product  WHERE product_id='$id'");
            echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';
        }
    }
?>
 <!-- Bootstrap -->
    <div style="padding: 2rem 2rem 0 2rem;">
        <form name="frm" method="post" action="">
            <?php
                if(isset($_SESSION['shop'])){
                    $shopId = $_SESSION['shop'];
                    $result =  pg_query($conn, "select * from shop where shop_id ='$shopId'");
                    $row= pg_fetch_array($result, null, PGSQL_ASSOC);
                    $shopName = $row['shop_name'];
                    $shopAddress = $row['shop_address'];
                }
            ?>
            <div style="color: red">
                <i class="bi-shop" ></i> Shop: <?php echo $shopName ?>
         </div>
         <div style="color: saddlebrown">
             <i class="bi-geo-alt" ></i> Address: <?php echo $shopAddress ?>
         </div>
        <p style="text-align: end">
        	<img src="images/add.png" alt="Add new" width="16" height="16" border="0" /><a href="?page=add_product" style="color: black!important;"> Add new</a>
        </p>
        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Name</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Quantity</strong></th>
                    <th><strong>Category</strong></th>
                    <th><strong>Supplier</strong></th>
                    <th><strong>Image</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
                include_once("connection.php");
				$No=1;
                $query = "SELECT p.product_id, p.product_name, p.price, p.pro_qty, p.pro_image, c.cat_name, sp.sup_name
                            FROM product as p, category as c, supplier as sp
                            WHERE p.cat_id= c.cat_id
                            and p.sup_id = sp.sup_id
                            and p.shop_id = '$shopId'";
                $result = pg_query($conn, $query);

                While($row=pg_fetch_array($result, null, PGSQL_ASSOC)){
			?>
			<tr>
              <td ><?php echo $No;  ?></td>
              <td ><?php echo $row["product_name"]; ?></td>
              <td><?php  echo $row["price"];?></td>
              <td><?php  echo $row["pro_qty"];?></td>
              <td ><?php echo $row["cat_name"]; ?></td>
              <td ><?php echo $row["sup_name"]; ?></td>
              <td align='center' class='cotNutChucNang'>
                 <img src='product-imgs/<?php echo $row['pro_image'] ?>' border='0' width="50" height="50"  /></td>
              <td align='center' class='cotNutChucNang'><a href="?page=update_product&&id=<?php echo $row['product_id']; ?>"><img src='images/edit.png' border='0'/></a></td>
              <td align='center' class='cotNutChucNang'><a href="?page=product_management&&function=del&&id=<?php echo $row["product_id"]; ?>" onclick="return deleteConfirm()"><img src='images/delete.png' border='0' /></a></td>
            </tr>
            <?php
               $No++;
                }
			?>
			</tbody>
        
        </table>  
        <div class="col-md-12">
            	
                </div>
            </div>
 </form>
    </div>
<?php
        }
}
?>