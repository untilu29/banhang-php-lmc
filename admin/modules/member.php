<?php
mysql_query("SET NAMES utf8");
$sql="select * from member";
$query=mysql_query($sql);
if(mysql_num_rows($query) == 0){
	echo "Chua co du lieu";
}
else{
	?>
	<table border="solid">
	<tr>
		<th>STT</th>
		<th>Tên đăng nhập</th>
        <th>Họ tên</th>
        <th>Địa chỉ</th>
        <th>Điện thoại</th>
        <th>Email</th>
		<th>Thao tác</th>
	</tr>
	<?php
	while($row=mysql_fetch_array($query)){
		?>
		<tr>
			<td><?php echo $row['mathanhvien'] ?></td>
			<td><?php echo $row['tendangnhap'] ?></td>
            <td><?php echo $row['hoten'] ?></td>
            <td><?php echo $row['diachi'] ?></td>
            <td><?php echo $row['dienthoai'] ?></td>
            <td><?php echo $row['email'] ?></td>
			<td>
				<a href="?mod=user_update&ID=<?php echo $row['mathanhvien'] ?>">Sửa</a>
				<a href="?mod=user_delete&ID=<?php echo $row['mathanhvien'] ?>">Xóa</a>
			</td>
		</tr>
		<?php
	}
	?>
	</table>
	<?php
}
?>

<script type="text/javascript">
    document.getElementById("mn_users").setAttribute("class","active");
</script>