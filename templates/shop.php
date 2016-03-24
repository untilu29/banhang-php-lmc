<?php
//1. xác định số hàng hiển thị
$sohanghienthi = 9;

//2. xác định trang hiện hành
$tranghienhanh = isset($_GET["page"]) ? ($_GET["page"]>0 ? $_GET["page"] : 1  ) : 1;
if($tranghienhanh<1) header("Location: ?mod=$vModule&page=1");

//3. xác định tổng số bảng ghi
$vSQL = "SELECT * FROM product ORDER BY ID DESC";
$vResult = mysql_query($vSQL);
$tongsobanghi = mysql_num_rows($vResult);
    
//4. Xác định tổng số trang (chia lấy cận trên)
$tongsotrang = ceil($tongsobanghi / $sohanghienthi);

//5. Xác định bản ghi bắt đầu
$banghibatdau = ($tranghienhanh - 1) * $sohanghienthi;

//6. Xác định limit
$vSQL_Sel = "SELECT * FROM product ORDER BY ID DESC
		    LIMIT $banghibatdau, $sohanghienthi";
$vResult_Sel = mysql_query($vSQL_Sel);
?>
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
                        <?php	
									while($row = mysql_fetch_array($vResult_Sel)) { ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php echo $row["Image"];?>" alt="" style="max-height:300px; width:auto" />
											<h2><?php echo number_format($row["Price"])." VNĐ";?></h2>
                                            
                                        	<p><?php echo $row["ProductName"];?></p>
											<a href="<?php echo "?mod=detail&id=".$row["ID"];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Details</a>
										</div>
										<div class="product-overlay">
										<div class="overlay-content">
                                              <span>
                                              		<p> Màn hình: <?php echo $row["Manhinh"];?></p>
    											  	<p> CPU: <?php echo $row["CPU"];?></p>
                                                    <p> RAM: <?php echo $row["Ram"];?></p>
                                                    <p> Hệ điều hành: <?php echo $row["Hedieuhanh"];?></p>
                                                    <p> Camera: <?php echo $row["Camera"];?></p>
													<p> Bộ nhớ trong: <?php echo $row["Storage"];?></p>
                                                    <p> Pin: <?php echo $row["Pin"];?></p>

 											  </span>
												<h2><?php echo number_format($row["Price"])." VNĐ";?></h2>
												<p><?php echo $row["ProductName"];?></p>
												<a href="<?php echo "?mod=detail&id=".$row["ID"];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Details</a>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div><?php }?>
                        
                    <div class="page">
<?php 

    $trangbatdau = 1;
    $trangketthuc = $sohanghienthi;
    
    //$trangbatdau = $tranghienhanh - ceil($sohanghienthi / 2);
    if($tranghienhanh >= ceil($sohanghienthi / 2)) {
        $trangbatdau = $tranghienhanh - ceil($sohanghienthi / 2) + 1;
        $trangketthuc = $tranghienhanh + ceil($sohanghienthi / 2);
        }
        if($tranghienhanh > $tongsotrang - ceil($sohanghienthi / 2)) {
            $trangketthuc = $tongsotrang;
    }
    
    //$trangketthuc = $trangketthuc + ceil($sohanghienthi / 2);
    
    
    
    echo "[<a href=\"?mod=$vModule&page=1\" >Đầu</a>]";
    echo "[<a href=\"?mod=$vModule&page=".($tranghienhanh - 1)."\">Trước</a>]";
    for($i=$trangbatdau; $i<=$trangketthuc; $i++) {
        $phancach = "";
        if($i>$trangbatdau) $phancach = " | ";
        
        if($i==$tranghienhanh) {
            echo "$phancach <b>$i</b> | ";
        }else{
            echo "$phancach <a href=\"?mod=$vModule&page=$i\" > $i </a> | ";
        }
        
    }
    echo "[<a href=\"?mod=$vModule&page=".($tranghienhanh + 1)."\">Sau</a>]";
    echo "[<a href=\"?mod=$vModule&page=$tongsotrang\">Cuối</a>]";
    
    
    echo "- Tổng số $tongsotrang";

?>
</div>    
						<ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul>
					</div>