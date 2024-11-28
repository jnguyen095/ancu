<?php
/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 10/3/2017
 * Time: 9:33 AM
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Nhà Đất An Cư | Quản lý nhân viên</title>
	<?php $this->load->view('/admin/common/header-js') ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<!-- Main Header -->
	<?php $this->load->view('/admin/common/admin-header')?>
	<!-- Left side column. contains the logo and sidebar -->
	<?php $this->load->view('/admin/common/left-menu') ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Quản lý nhân viên
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Quản lý nhân viên</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách nhân viên</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">

				<div class="top-buttons"><a class="btn btn-primary" href="<?=base_url('/admin/user/add.html')?>">Thêm Mới</a> </div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Loại NV</th>
								<th>Họ tên</th>
								<th>Số đt</th>
								<th>Email</th>
								<th>Kích hoạt</th>
								<th>Số bài đăng</th>
								<th>Đăng nhập</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(isset($staffs) && count($staffs) > 0) {
							foreach ($staffs as $staff) {
								?>
								<tr>
									<td><?=($staff->UserGroupID == USER_GROUP_BROKER ? 'Môi giới' : 'Nhân viên')?></td>
									<td><?=$staff->FullName?></td>
									<td><?=$staff->Phone?></td>
									<td><?=$staff->Email?></td>
									<td>
									<?php
										if($staff->Status == ACTIVE){
											echo '<span class="label label-success">Hoạt động</span>';
										} else {
											echo '<span class="label label-danger">Tạm ngưng</span>';
										}
									?>
									</td>
									<td class="text-center"><?=number_format($staff->TotalPost)?></td>
									<td><?=date('d/m/Y m:s', strtotime($staff->LastLogin)) ?></td>
									<td>
										<a data-toggle="tooltip" title="Chỉnh sửa thông tin" href="<?=base_url('/admin/user/add-'.$staff->Us3rID.'.html')?>"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;|&nbsp;
										<a data-toggle="tooltip" title="Xóa Người dùng" class="remove-user" data-userid="<?=$staff->Us3rID?>"><i class="glyphicon glyphicon-remove"></i></a>
									</td>
								</tr>
								<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>
			</div>

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<?php $this->load->view('/admin/common/admin-footer')?>

	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="<?=base_url('/admin/js/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('/admin/js/bootstrap.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('/admin/js/adminlte.min.js')?>"></script>
<script src="<?=base_url('/js/bootbox.min.js')?>"></script>
<script src="<?=base_url('/admin/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?=base_url('/admin/js/tindatdai_admin.js')?>"></script>

<script type="text/javascript">
	function deleteUserHandler(){
		$('.remove-user').click(function(){
			var userId = $(this).data('userid');
			bootbox.confirm("Bạn đã chắc chắn xóa user này chưa?", function(result){
				if(result){
					jQuery.ajax({
						type: "POST",
						url: '<?=base_url("/admin/UserManagement_controller/deleteUser")?>',
						dataType: 'json',
						data: {userId: userId},
						success: function(res){
							if(res.result == true){
								bootbox.alert("Xóa thành công");
								location.reload();
							}
						}
					});
				}
			});
		});
	}

	$(document).ready(function(){
		deleteUserHandler();
	});
</script>

</body>
</html>
