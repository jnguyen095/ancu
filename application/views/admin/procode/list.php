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
	<title>Nhà Đất An Cư | Quản lý mã khuyến mãi</title>
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
				Quản lý trang mã khuyến mãi
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Quản lý trang mã khuyến mãi</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách mã khuyến mãi</h3>
				</div>

				<?php if(!empty($message_response)){
					echo '<div class="alert alert-success">';
					echo '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>';
					echo $message_response;
					echo '</div>';
				}?>

				<?php
				$attributes = array("id" => "frmProCodes");
				echo form_open("admin/pro-code/list", $attributes);
				?>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="top-buttons"><a class="btn btn-primary" href="<?=base_url('/admin/pro-code/add.html')?>">Thêm Mới</a> </div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Loại KM</th>
								<th>Mã KM</th>
								<th>Dùng một lần</th>
								<th>Status</th>
								<th>Hết hạn</th>
								<th>Đã tham gia</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(isset($codes) && count($codes) > 0) {
							foreach ($codes as $code) {
								?>
								<tr>
									<td><?=($code->Type == 'PRO_CODE_BROKER' ? 'Làm môi giới sàn' : 'Tạo bài đăng miễn phí')?></td>
									<td><?=$code->Code?></td>
									<td><?=($code->OneTime == 1) ? "Chỉ dùng 1 lần" : "Không giới hạn" ?></td>
									<td><?php
										if($code->Status == 1){
											echo '<span class="label label-success">Đang hoạt động</span>';
										}else{
											echo '<span class="label label-danger">Tạm ngưng</span>';
										}
										?>
									</td>
									<td><?=date('d/m/Y', strtotime($code->ExpiredDate)) ?></td>
									<td><?=number_format($code->Involved)?></td>
									<td>
										<a href="<?=base_url('/admin/pro-code/add-'.$code->ProCodeID.'.html')?>" data-toggle="tooltip" title="Chỉnh sửa"><i class="	glyphicon glyphicon-edit"></i></a>&nbsp;|&nbsp;
										<a href="<?=base_url('/admin/pro-code/analytic-'.$code->ProCodeID.'.html')?>" data-toggle="tooltip" title="Xem thống kê"><i class="glyphicon glyphicon-list-alt"></i></a>&nbsp;|&nbsp;
										<a href="#" class="remove-code" data-procode="<?=$code->ProCodeID?>" data-toggle="tooltip" title="Xóa mã KH"><span class="glyphicon glyphicon-remove"></span></a>
									</td>
								</tr>
								<?php
							}
						}
						?>
						</tbody>
					</table>
					<div class="text-center">
						<?php echo $pagination; ?>
					</div>
				</div>
				<input type="hidden" id="crudaction" name="crudaction">
				<input type="hidden" id="proCodeId" name="proCodeID">
				<?php echo form_close(); ?>
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

<!-- jQuery 3 -->
<script src="<?=base_url('/admin/js/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('/admin/js/bootstrap.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('/admin/js/adminlte.min.js')?>"></script>
<script src="<?=base_url('/js/bootbox.min.js')?>"></script>
<script src="<?=base_url('/admin/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?=base_url('/admin/js/tindatdai_admin.js')?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
		deletePostHandler();
	});
	function deletePostHandler(){
		$('.remove-code').click(function(){
			var prId = $(this).data('procode');
			bootbox.confirm("Bạn đã chắc chắn xóa mã khuyến mãi này chưa?", function(result){
				if(result){
					$("#proCodeId").val(prId);
					$("#crudaction").val("delete");
					$("#frmProCodes").submit();
				}
			});
		});
	}
</script>
</body>
</html>
