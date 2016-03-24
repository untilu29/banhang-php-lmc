<div class="page-header">
    <h1>
        Add new product
    </h1>
</div><!-- /.page-header -->

<fieldset>
    <form action="controllers/category.php" class="form-horizontal" method="POST">
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="name">Category name<span class="required">(*)</span></label>
            <div class="col-sm-9">
                <input type="text" class="col-xs-10 col-sm-5" name="name" placeholder="Product name" required/>
            </div>
        </div>    

        <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="category_id">Category</label>
                <div class="col-sm-9">
                    <select name="category_id" class="col-xs-10 col-sm-5">
                        <?php while ($category= mysql_fetch_array($vResult_PL))?>
                        <option value="<?=$category['id']?>"><?=$category['name']?></option>
                    </select>
                    <span class="error"></span>
                </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">SKU</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="sku" placeholder="SKU"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Price</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="price" type="number" placeholder="Price"/>
            </div>
        </div>
        
        <div class="form-group"><div>
                <label class="col-sm-2 control-label no-padding-right" for="content">Hình ảnh</label>
                    <div class="col-sm-9">
                        <form action="../dummy.html" class="dropzone" id="dropzone">
										<div class="fallback">
											<input name="file" type="file" multiple="" />
										</div>
									</form>

                    </div>
                </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Description</label>
            <div class="col-sm-9">
                <textarea class="col-xs-10 col-sm-5" rows="5" name="description" placeholder="Category description"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"> Actived </label>
            <div class="col-sm-9">
                <input type="checkbox" class="ace" value="1" checked="true" name="actived"/> 
                <span class="lbl"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"></label>
            <div class="col-sm-9">
                <button class="btn btn-success " type="submit" value="add" name="submit">Save</button>        
                <button class="btn btn-info" type="reset" name="" >Reset</button>
            </div>
        </div>
    </form>
    <a href="javascript:history.back();" class="btn btn-grey" title="Trở về trang trước"><span>Go back</span></button></a>
</fieldset>