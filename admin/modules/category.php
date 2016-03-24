<?php
//1. xác định số hàng hiển thị
$sohanghienthi = 10;

//2. xác định trang hiện hành
$tranghienhanh = isset($_GET["page"]) ? ($_GET["page"] > 0 ? $_GET["page"] : 1 ) : 1;
if ($tranghienhanh < 1) header("Location: ?mod=$vModule&page=1");

//Tìm kiếm
$vSQL_Search = "";

if (isset($_POST["search_submit"])) {
    $searchtext = $_POST["search"];
    $vSQL_Search = "WHERE (name LIKE '%$searchtext%')"
            . "or (description LIKE '%$searchtext%')";
}

//3. xác định tổng số bảng ghi
$vSQL_1 = "SELECT * FROM category $vSQL_Search";
$tongsobanghi = mysql_num_rows(mysql_query($vSQL_1));

//4. Xác định tổng số trang (chia lấy cận trên)
$tongsotrang = ceil($tongsobanghi / $sohanghienthi);

//5. Xác định bản ghi bắt đầu
$banghibatdau = ($tranghienhanh - 1) * $sohanghienthi;

//Trường hợp lấp danh sách sản phẩm (theo phân trang)
$vSQL_Sel = "SELECT * FROM category
	$vSQL_Search
	ORDER BY name ASC
    LIMIT $banghibatdau, $sohanghienthi";
$vResult_Sel = mysql_query($vSQL_Sel);
?>

<?php
switch ($vAct) {
    case 'add' : include_once 'category_add.php';
        break;
    case 'edit' : include_once 'category_edit.php';
        break;
    default :
        ?>
        <div class="page-header">
            <h1>
                Categories management
            </h1>
        </div><!-- /.page-header -->

        <!--Flash message-->
        <div class="row">
            <div class="col-xs-12">
                <div id="flash_message">
                    <?php if (isset($_SESSION['message']) && isset($_SESSION['alert-class'])) { ?>
                        <div class="alert <?= getFlash('alert-class') ?>">
                            <button data-dismiss="alert" class="close" type="button"><i class="ace-icon fa fa-times"></i></button>
                            <?= getFlash('message'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--/.Flash message-->

        <div class="row">
            <div class="col-sm-6">
                <a href="?mod=<?= $vModule; ?>&act=add" class = "btn btn-info" title="Thêm mới loại sản phẩm" ><i class="fa fa-plus-square bigger-130"></i> Add category</a>
                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="delete_multi_item()" class ="btn btn-info" title="Xóa nhiều hàng"><i class="ace-icon fa fa-trash-o bigger-130"></i>Delete</a>
            </div>
            <div class="col-sm-6 pull-right">
                <form method="POST" class='form-horizontal pull-right'>
                    <input type="text" name="search" class="search_table" placeholder="Search" value="" />
                    <button type="submit" name= "search_submit"class="btn btn-info"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <!-- div.table-responsive -->
                        <!-- div.dataTables_borderWrap -->
                        <div>
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" id="select_all" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th class="hidden-480"><a href="#">Name</a></th>
                                        <th class="hidden-480"><a href="#">Description</a></th>
                                        <th class="hidden-480"><a href="#">Status</a></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    if (mysql_num_rows($vResult_Sel) > 0) {
                                        while ($category = mysql_fetch_array($vResult_Sel)) {
                                            ?>
                                            <tr>
                                                <td class="center">
                                                    <label class="pos-rel">
                                                        <input type="checkbox"  class="ace" value="<?= $category['id'] ?>" />
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="#"><?= $category['name'] ?></a>
                                                </td>
                                                <td>
                                                    <a href="#"><?= $category['description'] ?></a>
                                                </td>
                                                <td class="hidden-480 center">
                                                    <a class="hide_show" href="javascript:;" showid="<?php echo $category['id']; ?>" showac="<?php echo $category['actived']; ?>">
                                                        <?php if ($category['actived']) { ?>
                                                            <span class="green" href="#">
                                                                <i class="ace-icon fa fa-check-circle bigger-130"></i>
                                                            </span>
                                                        <?php } else { ?>
                                                            <span class="red" href="#">
                                                                <i class="ace-icon fa fa-times-circle bigger-130"></i>
                                                            </span>
                                                        <?php } ?>
                                                    </a>
                                                </td>
                                                <td class="center">
                                                    <div class="hidden-sm hidden-xs action-buttons">
                                                        <a class="green" <a href="?mod=<?php echo $vModule; ?>&act=edit&id=<?php echo $category["id"]; ?>" title="Edit">
                                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                            </a>

                                                            <a data-toggle="modal" data-target="#deleteModal" onclick="delete_item(<?=$category['id']?>)" class="red" href="javascript:;" title="Delete">
                                                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                            </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr><td colspan="5"><i>Không tồn tại dữ liệu!!</i></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!--PHÂN TRANG BEGIN-->
                        <div class="pull-right">        
                            <ul class="pagination">
                                <?php
                                $trangbatdau = 1;
                                $trangketthuc = $sohanghienthi;

                                if ($tranghienhanh >= ceil($sohanghienthi / 2)) {
                                    $trangbatdau = $tranghienhanh - ceil($sohanghienthi / 2) + 1;
                                    $trangketthuc = $tranghienhanh + ceil($sohanghienthi / 2);
                                }
                                if ($tranghienhanh > $tongsotrang - ceil($sohanghienthi / 2)) {
                                    $trangketthuc = $tongsotrang;
                                }

                                echo $tranghienhanh == 1 ? '<li class="disabled">' : '<li class="">';
                                echo '<a href=?mod=' . $vModule . '&page=1> <span>«</span></a></li>';

                                for ($i = $trangbatdau; $i <= $trangketthuc; $i++) {
                                    if ($i == $tranghienhanh) {
                                        echo '<li class="active"><span>' . $i . '</span></li>';
                                    } else {
                                        echo '<li> <a href="?mod=' . $vModule . '&page=' . $i . '" >' . $i . '</a> </li>';
                                    }
                                }
                                echo $tranghienhanh == $trangketthuc ? '<li class="disabled">' : '<li class="">';
                                echo '<a href="?mod=' . $vModule . '&page=' . $tongsotrang . '" rel="next">»</a></li>';
                                ?>
                            </ul>
                        </div>
                        <!--/PHÂN TRANG END-->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
        </div><!-- /.row -->
<?php } ?>
<!-- Modal hiện thông báo xóa hay không -->
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="controllers/category.php" method="POST" class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete item confirmation!</h4>
            </div>
            <div class="modal-body" >
                <input type="hidden" name="id" id="value_del_id" />
                <input type="hidden" name="type" id="type_del" />
                <p><i class="fa fa-exclamation-triangle"></i>Bạn có chắc chắn muốn xóa?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="submit" value="del">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- end modal -->
<script src="../assets/js/jquery.js"></script>        
<script type="text/javascript">
//    Set active menu
    document.getElementById("mn_categories").setAttribute("class", "active");
    
    
    function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

//   Xác nhận xóa 1 hàng đã chọn
    function delete_item($id){
        document.getElementById("value_del_id").setAttribute("value",$id);
        document.getElementById("type_del").setAttribute("value","one");
    }
  
//   Xác nhận xóa nhiều hàng đã chọn
    function delete_multi_item(){
        arr_id=[]; i=0;
        $("#tbody input:checkbox").each(function(){
            if ($(this).prop('checked')){
                arr_id[i]=$(this).val();
                i++;
            }
        })
        document.getElementById("type_del").setAttribute("value","multi");
        document.getElementById("value_del_id").setAttribute("value",arr_id);
    }

    $(document).ready(function(){
//        Làm mất đi flash message sau khi hiện
        $('#flash_message').delay(5000).fadeOut("slow",function(){});
        
//        Chọn tất cả các bảng
        $('#select_all').change(function(){
            $("input:checkbox").prop('checked',$(this).prop("checked"));
        }); 
        
//  ------------------Thao tác click actived và bỏ active
        $('#dynamic-table .hide_show').click(function(){
            id=$(this).attr("showid"); actived=$(this).attr("showac");
//        Xóa hình ảnh active bỏ chữ loading    
            $(this).html('<img src="../assets/images/loading.gif" width="16px" height="16px"/>');
//       Ajax để active hoặc unactived 1 bảng ghi
            $.ajax({
                type: "POST",
                url: "controllers/category.php",
                data: { 'submit':'actived', 'id': id, 'actived': actived },
                error: function(){
                    alert('Xảy ra lỗi');
                },
                success: setTimeout(function(){
                    if (actived==0){
                        $('#dynamic-table .hide_show[showid="'+id+'"]').html('<span class="green" href="#"><i class="ace-icon fa fa-check-circle bigger-130"></i></span>');
                        $('#dynamic-table .hide_show[showid="'+id+'"]').attr("showac",1);
                    } else {
                        $('#dynamic-table .hide_show[showid="'+id+'"]').html('<span class="red" href="#"><i class="ace-icon fa fa-times-circle bigger-130"></i></span>');
                        $('#dynamic-table .hide_show[showid="'+id+'"]').attr("showac",0);
                    };
                },500)});
            });

//       ---------------Kết thúc actived-----------------
    })
</script>