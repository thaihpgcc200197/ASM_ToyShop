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
	function bind_Category_List($conn, $selectValue)
	{
		$sqlstring = "SELECT cat_id, cat_name from category";
		$result = pg_query($conn, $sqlstring);
		echo "<select name='CategoryList' class='form-control' required>";

		while ($row = pg_fetch_array($result, null,PGSQL_ASSOC)) {
			if ($row['cat_id'] == $selectValue) {
				echo "<option value='" . $row['cat_id'] . "' selected>" . $row['cat_name'] . "</option>";
			} else {
				echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_name'] . "</option>";
			}
		}
		echo "</select>";
	}


    function bind_Supplier_List($conn, $selectValue)
    {
        $sqlstring = "select sup_id, sup_name from supplier";
        $result = pg_query($conn, $sqlstring);
        echo "<select name='SupplierList' class='form-control' required>";
        while ($row = pg_fetch_array($result, null,PGSQL_ASSOC))
        {
            if ($row['sup_id'] == $selectValue) {
                echo "<option value='" . $row['sup_id'] . "' selected>" . $row['sup_name'] . "</option>";
            } else {
                echo "<option value='" . $row['sup_id'] . "'>" . $row['sup_name'] . "</option>";
            }
        }
        echo "</select>";
    }
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$sqlstring = "SELECT product_name, price, pro_qty, pro_image, cat_id, sup_id
					FROM product WHERE product_id = '$id'";

		$result = pg_query($conn, $sqlstring);
		$row = pg_fetch_array($result, null,PGSQL_ASSOC);

		$proName = $row["product_name"];
		$price = substr($row["price"], 1);
		$qty = $row["pro_qty"];
		$pic = $row["pro_image"];
		$category = $row["cat_id"];
		$supplier = $row["sup_id"];
	?>
        <div class="" style="padding: 5% 10% 6% 18%;">
    		<h3 style="padding-left: 1rem">Updating Product</h3>
    		<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
                <input type="hidden" value="<?php echo $id; ?>" name="txtID">
                <div class="form-group">
    				<label for="txtTen" class="col-sm-2 control-label">Product Name(*): </label>
    				<div class="col-sm-10">
    					<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='<?php echo $proName; ?>' required>
    				</div>
    			</div>
    			<div class="form-group">
    				<label for="" class="col-sm-2 control-label">Product category(*): </label>
    				<div class="col-sm-10">
    					<?php
						bind_Category_List($conn, $category);
						?>
    				</div>
    			</div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Product category(*): </label>
                    <div class="col-sm-10">
                        <?php
                        bind_Supplier_List($conn, $supplier);
                        ?>
                    </div>
                </div>
    			<div class="form-group">
    				<label for="lblGia" class="col-sm-2 control-label">Price(*): </label>
    				<div class="col-sm-10">
    					<input type="number" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price ?>' required>
    				</div>
    			</div>
    			<div class="form-group">
    				<label for="lblSoLuong" class="col-sm-2 control-label">Quantity(*): </label>
    				<div class="col-sm-10">
    					<input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="<?php echo $qty ?>" required>
    				</div>
    			</div>
                <div class="form-group">
                    <label for="sphinhanh" class="col-sm-2 control-label">Image(*):  </label>
                    <div class="col-sm-10">
                        <input type="hidden" value="<?php echo $pic ?>" name="txtOldImg">
                        <img src="product-imgs/<?php echo $pic ?>" id="img_preview" style="width: 15rem;height: 11rem;border: 1px solid;">
                        <button type="button" class="btn btn-primary" id="btn_open_choose_image" style="display: block">Choose image</button>
                        <input type="file" name="txtImage" id="txtImage" class="form-control" value="" hidden>
                    </div>
                </div>
    			<div class="form-group">
    				<div class="col-sm-offset-2 col-sm-10" style="text-align: end">
    					<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update">
    				</div>
    			</div>
    		</form>
    	</div>

    <?php
	} else {
		echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
	}
	?>
    <?php
	if (isset($_POST["btnUpdate"])) {
		$id = $_POST["txtID"];
		$proName = $_POST["txtName"];
		$price = $_POST["txtPrice"];
		$qty = $_POST["txtQty"];
		$pic = $_FILES["txtImage"];
		$oldImg = $_POST["txtOldImg"];
		$category = $_POST["CategoryList"];
		$supplier = $_POST["SupplierList"];
		$err = "";

		if (trim($id) == "") {
			$err .= "<li style='color: red'>Enter product ID</li>";
		}
		if (trim($proName) == "") {
			$err .= "<li style='color: red'>Enter product Name</li>";
		}
		if ($category == "0") {
			$err .= "<li style='color: red'>Choose product category</li>";
		}
		if (!is_numeric($price)) {
			$err .= "<li style='color: red'>Product price must be number</li>";
		}
		if (!is_numeric($qty)) {
			$err .= "<li style='color: red'>Product quantity must be number</li>";
		}
        else {
			if ($pic['name'] != "") {
				if ($pic["type"] == "image/jpg" || $pic["type"] == "image/jpeg" || $pic["type"] == "image/png" || $pic["type"] == "image/gif") {
					if ($pic["size"] < 614400) {
						$sq = "SELECT * FROM product WHERE product_Name = '$proName'";
						$result = pg_query($conn, $sq);
						if (pg_num_rows($result) == 1 || pg_num_rows($result) == 0) {

                            unlink('product-imgs/'.$oldImg);
                            $filePic = uniqid().$pic['name'];
							copy($pic['tmp_name'], "product-imgs/".$filePic);


							$sqlstring = "UPDATE product SET 
							product_name ='$proName', price='$price', pro_qty='$qty',
							pro_image='$filePic', cat_id='$category', sup_id = '$supplier'
							WHERE product_id='$id'";

							pg_query($conn, $sqlstring);
                            echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';
						} else {
                            $err .=  "<li style='color: red'>Duplicate name</li>";
						}
					} else {
                        $err .=  "<li style='color: red'>Size of image too big</li>";
					}
				} else {
                    $err .=  "<li style='color: red'>Image format is not correct</li>";
				}
			} else {
				$sq = "SELECT * FROM product WHERE product_name = '$proName'";
				$result = pg_query($conn, $sq);
				if (pg_num_rows($result) == 1 || pg_num_rows($result) == 0) {

					$sqlstring = "UPDATE product SET product_name ='$proName', 
					price='$price', pro_qty='$qty', cat_id='$category', sup_id = '$supplier'
					 WHERE product_id='$id'";

					pg_query($conn, $sqlstring);
                    echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';
				} else {
					echo "<li style='color: red'>Duplicate name</li>".pg_num_rows($result).$proName;
				}
			}
		}
	}
	?>
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
    <?php }} ?>