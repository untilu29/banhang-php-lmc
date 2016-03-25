<?php
//Truy vấn các loại sản phẩm đưa ra vào select box
$vSQL_PL = "SELECT * FROM role ORDER BY id ASC";
$vResult_PL = mysql_query($vSQL_PL);
?>
<div class="page-header">
    <h1>
        Add new user
    </h1>
</div><!-- /.page-header -->

<fieldset>
    <form action="controllers/user.php" id="form" class="form-horizontal" method="POST">
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="username">Username<span class="required">(*)</span></label>
            <div class="col-sm-9">
                <input type="text" class="col-xs-10 col-sm-5" name="username" placeholder="Username" required/>
            </div>
        </div>    

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="role_id">Role</label>
            <div class="col-sm-9">
                <select name="role_id" class="col-xs-10 col-sm-5">
                    <?php while ($row = mysql_fetch_array($vResult_PL)) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php } ?>
                </select>
                <span class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Password <span class="required">(*)</span></label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="password" placeholder="Password" type="password" required/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Password confirm<span class="required">(*)</span></label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="password_confirm" placeholder="Password confirmation" type="password" required/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Name</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="name" placeholder="Name" type="text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Email</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" name="email" placeholder="Email" type="text"/>
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
                <button class="btn btn-success " type="submit" value="add" name="submit" id="submit">Save</button>        
                <button class="btn btn-info" type="reset" name="" >Reset</button>
            </div>
        </div>
    </form>
    <a href="javascript:history.back();" class="btn btn-grey" title="Trở về trang trước"><span>Go back</span></button></a>
</fieldset>

<script src="../assets/js/jquery.js"></script>        
<script>
//       Kiem tra password co trung khop
    $('#submit').click(function () {
        a = $('input[name=password]').val();
        b = $('input[name=password_confirm]').val();
        if (a != b){
            alert('Mật khẩu không trùng!!');
                    return false;
        }
    });
</script>