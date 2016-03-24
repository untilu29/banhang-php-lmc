<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
                        <?php
									$vSQL = "SELECT * FROM product WHERE ProductTypeID=".$_GET["type"];
									$vResult = mysql_query($vSQL);
									while($row = mysql_fetch_array($vResult)) { ?>
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
						<ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul>
					</div>