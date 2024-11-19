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
				Quản lý trang sử dụng mã khuyến mãi
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Quản lý mã khuyến mãi</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Mã khuyến mãi chi tiết</h3>
				</div>

				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Người sử dụng</th>
								<th>Ngày sử dụng</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(isset($proDetails) && count($proDetails) > 0) {
							foreach ($proDetails as $detail) {
								?>
								<tr>
									<td><?=$detail->FullName?></td>
									<td><?=date('d/m/Y H:m:i', strtotime($detail->CreatedDate))?></td>
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
					<div class="top-buttons" style="margin-top:5px"><a class="btn btn-primary" href="<?=base_url('/admin/pro-code/list.html')?>">Trở lại</a> </div>
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

<!-- jQuery 3 -->
<script src="<?=base_url('/admin/js/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('/admin/js/bootstrap.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('/admin/js/adminlte.min.js')?>"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
