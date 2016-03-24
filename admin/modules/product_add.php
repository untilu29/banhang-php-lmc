<div class="page-header">
    <h1>
        Add new product
    </h1>
</div><!-- /.page-header -->

<fieldset>
    <form action="controllers/category.php" id="form" class="form-horizontal" method="POST">
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
                    <?php while ($row = mysql_fetch_array($vResult_PL)) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php }?>
                </select>
                <span class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">SKU</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="sku" placeholder="SKU" type="text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Price</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="price" type="number" placeholder="Price"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Operating System</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="os" placeholder="Operating System" type="text"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Screen</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="screen" placeholder="Screen" type="text"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">CPU</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="cpu" placeholder="CPU" type="text"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Ram</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="ram" placeholder="RAM" type="text"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Camera</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="camera" placeholder="Camera" type="text"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Pin</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="pin" placeholder="PIN" type="text"/>
            </div>
        </div>

        <div class="form-group"><div>
                <label class="col-sm-2 control-label no-padding-right" for="content">Hình ảnh</label>
                <div class="col-sm-3">
                    <input name="image" type="file" multiple="" id="file" />
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

<script src="../assets/js/jquery.js"></script>        
<script src="../assets/js/ace/elements.fileinput.js"></script>
<script>
    //Upload anh drop/ace
    jQuery(function ($) {
        var $form = $("#form");
        var file_input = $form.find('input[type=file]');
        var upload_in_progress = false;

        file_input.ace_file_input({
            style: 'well',
            btn_choose: 'Select or drop files here',
            btn_change: null,
            droppable: true,
            thumbnail: 'large',
            maxSize: 1100000, //bytes
            allowExt: ["jpeg", "jpg", "png", "gif"],
            allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"],
            before_remove: function () {
                if (upload_in_progress)
                    return false;//if we are in the middle of uploading a file, don't allow resetting file input
                return true;
            },
            preview_error: function (filename, code) {
                //code = 1 means file load error
                //code = 2 image load error (possibly file is not an image)
                //code = 3 preview failed
            }
        })
        file_input.on('file.error.ace', function (ev, info) {
            if (info.error_count['ext'] || info.error_count['mime'])
                alert('Invalid file type! Please select an image!');
            if (info.error_count['size'])
                alert('Invalid file size! Maximum 1MB');

            //you can reset previous selection on error
            //ev.preventDefault();
            //file_input.ace_file_input('reset_input');
        });


        //when "reset" button of form is hit, file field will be reset, but the custom UI won't
        //so you should reset the ui on your own
        $form.on('reset', function () {
            $(this).find('input[type=file]').ace_file_input('reset_input_ui');
        });


        if (location.protocol == 'file:')
            alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");
    });
</script>