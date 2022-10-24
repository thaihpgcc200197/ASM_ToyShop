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
    } else {
        ?>
<?php

	include_once("connection.php");
	function bind_Category_List($conn)
	{
		$sqlstring = "select cat_id, cat_name from category";
		$result = pg_query($conn, $sqlstring);
		echo "<select name='CategoryList' class='form-control' required>
			<option value='0'>Choose category</option>";
			while ($row = pg_fetch_array($result, null,PGSQL_ASSOC))
			{
				echo "<option value ='".$row['cat_id']."'>".$row['cat_name']."</option>";
			}
			echo "</select>";
	}

    function bind_Supplier_List($conn)
    {
        $sqlstring = "select sup_id, sup_name from supplier";
        $result = pg_query($conn, $sqlstring);
        echo "<select name='SupplierList' class='form-control' required>
                <option value='0'>Choose supplier</option>";
        while ($row = pg_fetch_array($result, null,PGSQL_ASSOC))
        {
            echo "<option value ='".$row['sup_id']."'>".$row['sup_name']."</option>";
        }
        echo "</select>";
    }


	if(isset($_POST["btnAdd"]))
	{
        $shop = $_SESSION["shop"];
		$proName = $_POST["txtName"];
		$price = $_POST['txtPrice'];
		$qty = $_POST['txtQty'];
		$pic = $_FILES['txtImage'];
		$category = $_POST['CategoryList'];
		$supplier = $_POST['SupplierList'];
		$err="";

		if(trim($proName)=="")
		{
			$err.="<li style='color: red'>Enter product name</li>";
		}
		if($category=="0")
		{
			$err.="<li style='color: red'>Choose product category</li>";
		}
        if($supplier=="0")
        {
            $err.="<li style='color: red'>Choose product supplier</li>";
        }

        if($pic['name'] == ''){
            $err.="<li style='color: red'>Choose product image</li>";
        }

		if($err =="")
		{
            if($pic['type']=="image/jpg" || $pic['type']=="image/jpeg" || $pic['type']=="image/png"
                || $pic['type']=="image.gif")
            {
                if($pic['size'] <= 614400)
                {
                    $sq="Select * from product where Product_Name='$proName'";
                    $result = pg_query($conn,$sq);
                    if(pg_num_rows($result)==0)
                    {
                        $filePic = uniqid().$pic['name'];
                        copy($pic['tmp_name'], "product-imgs/".$filePic);

                        $sqlstring = "INSERT INTO product(product_name, price, pro_qty, pro_image, cat_id, sup_id, shop_id) 
                                        VALUES('$proName','$price','$qty','$filePic', '$category','$supplier', '$shop')";
                        pg_query($conn, $sqlstring);
                        echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';

                    }
                    else
                    {
                        $err.= "<li style='color: red'>Duplicate product name</li>";
                    }
                }
                else
                {
                    $err.= "<li style='color: red'>Size of image too big</li>";
                }
            }
            else
            {
                $err.="<li style='color: red'>Image format is not correct</li>";
            }
		}

	}
	
?>
<div class="" style="padding: 5% 10% 6% 18%;">
	<h3 style="padding-left: 1rem">Adding new Product</h3>
	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group"> 
					<label for="txtTen" class="col-sm-2 control-label">Product Name(*):  </label>
						<div class="col-sm-10">
						<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='' required>
					</div>
                </div>   
                <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Category(*):  </label>
					<div class="col-sm-10">
						<?php bind_Category_List($conn);  ?>
					</div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Supplier(*):  </label>
                    <div class="col-sm-10">
                        <?php bind_Supplier_List($conn);  ?>
                    </div>
                </div>
                <div class="form-group">
                        <label for="lblGia" class="col-sm-2 control-label">Price(*):  </label>
                        <div class="col-sm-10">
                               <input type="number" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='' required>
                        </div>
                </div>
            	<div class="form-group">  
                    <label for="lblSoLuong" class="col-sm-2 control-label">Quantity(*):  </label>
					<div class="col-sm-10">
						<input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="" required>
					</div>
                </div>
				<div class="form-group">  
	                <label for="sphinhanh" class="col-sm-2 control-label">Image(*):  </label>
						<div class="col-sm-10">
                            <img src="./images/preview.jpg" id="img_preview" style="width: 15rem;height: 11rem;border: 1px solid;">
                            <button type="button" class="btn btn-primary" id="btn_open_choose_image" style="display: block">Choose image</button>
						    <input type="file" name="txtImage" id="txtImage" class="form-control" value="" hidden>
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

    <script>
        $(document).ready(function (){

            <?php
            if(isset($err) && $err !== ''){
            ?>
            $('#error_add').append("<?php echo $err ?>")
            <?php
            }
            ?>

            $('#btn_open_choose_image').click(function (){
                $('#txtImage').click()
            })

            $('#txtImage').change(function (){
                previewImage()
            })
            function previewImage(){
                document.getElementById("img_preview").src = 'images/preview.jpg';
                var imageReader = new FileReader();
                imageReader.readAsDataURL(document.getElementById("txtImage").files[0]);
                imageReader.onload = function (oFREvent) {
                    document.getElementById("img_preview").src = oFREvent.target.result;
                };
            }
        })
    </script>
<?php } }?>