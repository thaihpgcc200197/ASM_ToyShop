<?php
include_once("connection.php");
 if(isset($_GET['page']) && $_GET['page'] = 'view_detail_product' && isset($_GET['id'])){
        $proId = $_GET['id'];
        $query = "SELECT p.product_name, p.price, p.pro_qty, p.pro_image, c.cat_name, sp.sup_name, s.shop_name
                            FROM product as p, category as c, supplier as sp, shop as s
                            WHERE p.cat_id= c.cat_id
                            and p.sup_id = sp.sup_id
                            and p.shop_id = s.shop_id
                            and p.product_id = '$proId'";
        $result = pg_query($conn, $query);
        $row = pg_fetch_array($result, null,PGSQL_ASSOC);
        $proName = $row['product_name'];
        $proPrice = $row['price'];
        $qty = $row['pro_qty'];
        $img = $row['pro_image'];
        $cateName = $row['cat_name'];
        $supName = $row['sup_name'];
        $shopName = $row['shop_name'];
 }
?>


<div style="min-height: 43rem; padding-top: 7rem; text-align: center">
        <div style="display: inline-block;">
            <img src="product-imgs/<?php echo $img ?>" style="width: 20rem;height: 25rem; border-radius: 1rem">
        </div>
        <div style="display: inline-block; text-align: left; margin-left: 4rem">
            <div class="content">
                <h2><?php echo $proName ?></h2>
                <h2><?php echo $proName ?></h2>
            </div>
            <h6 class="product-carousel-price">Price: <ins><?php echo $proPrice ?></ins></h6>
            <h6 class="product-carousel-price">Quantity: <ins><?php echo $qty ?></ins></h6>
            <h6 class="product-carousel-price">Category: <ins><?php echo $cateName ?></ins></h6>
            <h6 class="product-carousel-price">Supplier: <ins><?php echo $supName ?></ins></h6>
            <h6 class="product-carousel-price">Shop: <ins><?php echo $shopName ?></ins></h6>
        </div>
</div>
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
