<div class="page-header">
    <h1>
        Add new category
    </h1>
</div><!-- /.page-header -->

<fieldset>
    <form action="controllers/category.php" class="form-horizontal" method="POST">
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="name">Category name<span class="required">(*)</span></label>
            <div class="col-sm-9">
                <input type="text" class="col-xs-10 col-sm-5" name="name" placeholder="Category name" required/>
            </div>
        </div>    

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Position</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" type="number" name="position" placeholder="Position"/>
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