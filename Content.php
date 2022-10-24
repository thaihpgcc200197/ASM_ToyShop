  
<?php
include_once("connection.php");


?>
<!--slider-->
<div class="slider-area">
    <!-- Slider -->
    <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
            <li>
                <img src="./images/baner1.png" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                    </h2>
                </div>
            </li>
            <li><img src="./images/baner2.png" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                    </h2>
                </div>
            </li>
            <li><img src="./images/baner3.png" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                    </h2>
                </div>
            </li>
        </ul>
    </div>
    <!-- ./Slider -->
</div> <!-- End slider area -->
    
    <!--Gioi thieu cac chuc nang-->
    
    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>Refunds on delivery of incorrect models or damaged during delivery.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>There are many coupon events and free shipping events.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Payment security</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>New Product, Products are constantly updated. Don't worry about running out of products.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Product</h2>
                        <div id="search-area" style="position: absolute;right: 0">
                             <div id="search_box_product" role="search">
                                 <form action="" method="post">
                                      <input class="" style="height: 2.7rem;padding: 1rem;" name="txtSearch" type="search" placeholder="Search" aria-label="Search">
                                      <input style="vertical-align: baseline" class="btn btn-outline-success" type="submit" name="btnSearchPro" value="Search">
                                 </form>
                             </div>
                        </div>
                        <div class="product-carousel" style="margin-top: 6rem">
                        
                        <!--Load san pham tu DB -->
                           <?php
                            if(isset($_POST['btnSearchPro'])){
                                $proName = $_POST['txtSearch'];
                                $result = pg_query($conn, "SELECT * FROM product where product_name like '%$proName%'");
                            } else{
                                $result = pg_query($conn, "SELECT * FROM product");
                            }
			                if (!$result) {
                                die('Invalid query: ' . pg_result_error($conn));
                            }
			                while($row = pg_fetch_array($result,null, PGSQL_ASSOC)){
				            ?>

				            <!--One product -->
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="product-imgs/<?php echo $row['pro_image']?>" style="height: 13rem;width: 13rem;">
                                    <div class="product-hover">
                                        <a href="?page=view_detail_product&id=<?php echo  $row['product_id']?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>
                                <h2><?php echo  $row['product_name']?></h2>
                                
                                <div class="product-carousel-price">
                                    <ins><?php echo  $row['price']?></ins>
                                </div> 
                            </div>
                <?php
				}
				?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    
    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <img src="images/demo1.png" alt="">
                            <img src="images/demo2.png" alt="">
                            <img src="images/demo3.png" alt="">
                            <img src="images/demo4.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
    
    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="images/demo6.png" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Excavator</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$200</ins> <del>$300</del>
                            </div>                            
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="images/demo7.png" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Boat</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$300</ins> <del>$370</del>
                            </div>                            
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="images/demo8.png" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Lumine</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400</ins> <del>$530</del>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="images/demo9.png" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Songohan</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$300</ins> <del>$380</del>
                            </div>                            
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="images/demo10.png" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Batman</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$200</ins> <del>$245</del>
                            </div>                            
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="images/demo11.png" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Songoku</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$199</ins><del>$400</del>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="images/demo12.png" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">The Flash</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$285</ins> <del>$400</del>
                            </div>                            
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="images/demo13.png" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Pikachu</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$199</ins> <del>$290</del>
                            </div>                            
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="images/demo5.png" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Samuraise</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$265</ins> <del>$400</del>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End product widget area -->
    
   
  