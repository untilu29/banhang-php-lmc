<?php
$vSQL_Edit = "SELECT * FROM category WHERE id=$vID";
$vResult_Edit = mysql_query($vSQL_Edit);
$vRow_Edit = mysql_fetch_array($vResult_Edit);
$eDescription = $vRow_Edit["description"];
$eProductTypeID = $vRow_Edit["id"];
?>
<div class="page-header">
    <h1>
        Edit a category
    </h1>
</div><!-- /.page-header -->
<fieldset>
    <form action="controllers/category.php" class="form-horizontal" method="POST">
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="name">Category name<span class="required">(*)</span></label>
            <div class="col-sm-9">
                <input type="text" class="col-xs-10 col-sm-5" name="name" placeholder="Category name" value="<?=$vRow_Edit["name"] ?>"  required/>
                <input type="hidden" name="id" value="<?=$vRow_Edit["id"]?>"/>
            </div>
        </div>    

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Position</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" type="number" name="position" placeholder="Position" value="<?= $vRow_Edit["position"] ?>"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Description</label>
            <div class="col-sm-9">
                <textarea class="col-xs-10 col-sm-5" rows="5" name="description" placeholder="Category description ..."><?= $vRow_Edit["description"] ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Actived </label>
            <div class="col-sm-9">
                <input type="checkbox" class="ace" value="1" <?=$vRow_Edit["actived"]==1? 'checked="true"':''?> name="actived"/> 
                <span class="lbl"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right"></label>
            <div class="col-sm-9">
                <button class="btn btn-success " type="submit" value="edit" name="submit">Save</button>        
                <button class="btn btn-info" type="reset" name="" >Reset</button>
            </div>
        </div>
    </form>
    <a href="javascript:history.back();" class="btn btn-grey" title="Trở về trang trước"><span>Go back</span></button></a>
</fieldset>
</div><!-- /.row -->