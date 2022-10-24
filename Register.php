<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />

<?php
if(isset($_POST['btnRegister']))
{
    $us = $_POST['txtUsername'];
    $pass1 = $_POST['txtPass1'];
    $pass2 = $_POST['txtPass2'];
    $fullname = $_POST['txtFullname'];
    $email = $_POST['txtEmail'];
    $address = $_POST['txtAddress'];
    $tel = $_POST['txtTel'];

    if(isset($_POST['grpRender']))
    {
        $sex = $_POST['grpRender'];
    }
    $date = $_POST['slDate'];
    $month = $_POST['slMonth'];
    $year = $_POST['slYear'];

    $err = "";
    if($us=="" || $pass1=="" || $pass2=="" || $fullname =="" || $email=="" ||
     $address=="" || !isset($sex))
    {
        $err .= "<li style='color: red'>Enter fields with mark (*), please</li>";
    }
    if(strlen($pass1)<=5)
    {
    $err .="<li style='color: red'>Password must be greater than 5 chars</li>";
    }

    if($pass1!=$pass2)
    {
        $err .="<li style='color: red'>Password and confirm password are the same</li>";
    }

    if($_POST['slYear']==0)
    {
        $err .="<li style='color: red'>Choose Year of Birth, please</li>";
    }

    if($err=="")
    {
        include_once("connection.php");
        $pass = md5($pass1);
        $sq= "SELECT * FROM customer WHERE username= '$us' OR email= '$email'";
        $res = pg_query($conn,$sq);
        if(pg_num_rows($res)==0)
        {
            pg_query($conn, "INSERT INTO customer (username, password, custname, gender, address, telephone,
            email, cusdate, cusmonth, cusyear, state)
            VALUES ('$us', '$pass', '$fullname', $sex, '$address', '$tel', '$email',
            $date, $month, $year, 0)") or die("error");
            $err .= "<li style='color: green'>You have registered successfully</li>";
        }
        else{
            $err .= "<li style='color: red'>Username or email already exists</li>";
        }
    }

}


?>
<div class="" style="padding: 14% 22% 6% 20%;">
            <div class="content" style="transform: translateX(28%);">
                <h2>Member Registration</h2>
                <h2>Member Registration</h2>
            </div>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
						    
                            <label for="txtTen" class="col control-label">Username(*):  </label>
							<div class="col">
							      <input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="Username" value=""/>
							</div>
                      </div>  
                      
                       <div class="form-group">   
                            <label for="" class="col control-label">Password(*):  </label>
							<div class="col">
							      <input type="password" name="txtPass1" id="txtPass1" class="form-control" placeholder="Password"/>
							</div>
                       </div>     
                       
                       <div class="form-group"> 
                            <label for="" class="col control-label">Confirm Password(*):  </label>
							<div class="col">
							      <input type="password" name="txtPass2" id="txtPass2" class="form-control" placeholder="Confirm your Password"/>
							</div>
                       </div>     
                       
                       <div class="form-group">                               
                            <label for="lblFullName" class="col control-label">Full name(*):  </label>
							<div class="col">
							      <input type="text" name="txtFullname" id="txtFullname" value="" class="form-control" placeholder="Enter Fullname"/>
							</div>
                       </div> 
                       
                       <div class="form-group">      
                            <label for="lblEmail" class="col control-label">Email(*):  </label>
							<div class="col">
							      <input type="text" name="txtEmail" id="txtEmail" value="" class="form-control" placeholder="Email"/>
							</div>
                       </div>  
                       
                        <div class="form-group">   
                             <label for="lblDiaChi" class="col control-label">Address(*):  </label>
							<div class="col">
							      <input type="text" name="txtAddress" id="txtAddress" value="" class="form-control" placeholder="Address"/>
							</div>
                        </div>  
                        
                         <div class="form-group">  
                            <label for="lblDienThoai" class="col control-label">Telephone(*):  </label>
							<div class="col">
							      <input type="text" name="txtTel" id="txtTel" value="" class="form-control" placeholder="Telephone" />
							</div>
                         </div> 
                         
                          <div class="form-group">  
                            <label for="lblGioiTinh" class="col control-label">Gender(*):  </label>
							<div class="col">
                                      <label class="radio-inline"><input type="radio" name="grpRender" value="0" id="grpRender"  />
                                      Male</label>
                                    
                                      <label class="radio-inline"><input type="radio" name="grpRender" value="1" id="grpRender" />
                                      
                                      Female</label>

							</div>
                          </div> 
                          
                          <div class="form-group"> 
                            <label for="lblNgaySinh" class="col control-label">Date of Birth(*):  </label>
                            <div class="col input-group">
                                <span class="input-group-btn">
                                  <select name="slDate" id="slDate" class="form-control" >
                						<option value="0">Choose Date</option>
										<?php
                                            for($i=1;$i<=31;$i++)
                                             {                                                
                                                 echo "<option value='".$i."'>".$i."</option>";
                                             }
                                        ?>
                				 </select>
                                </span>
                                <span class="input-group-btn">
                                  <select name="slMonth" id="slMonth" class="form-control">
                					<option value="0">Choose Month</option>
									<?php
                                        for($i=1;$i<=12;$i++)
                                         {
                                             echo "<option value='".$i."'>".$i."</option>";
                                         }
                          
                                    ?>
                				</select>
                                </span>
                                <span class="input-group-btn">
                                  <select name="slYear" id="slYear" class="form-control">
                                    <option value="0">Choose Year</option>
                                    <?php
                                        for($i=1970;$i<=2020;$i++)
                                         {
                                             echo "<option value='".$i."'>".$i."</option>";
                                         }
                                    ?>
                                </select>
                                </span>
                           </div>
                      </div>	
					<div class="form-group">
						<div class="col-sm-offset-2 col" style="text-align: end">
						      <input type="submit"  class="btn btn-primary" name="btnRegister" id="btnRegister" value="Register"/>

						</div>
                     </div>
				</form>
                <ul style="text-align: center">
                    <?php
                       if(isset($err) && $err != ''){

                    ?>
                     <?php echo $err ?>
                    <?php
                       }
                    ?>
                </ul>
</div>
    

