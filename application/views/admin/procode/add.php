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
	<title>Nhà Đất An Cư | Quản lý Mã Khuyến Mãi</title>
	<?php $this->load->view('/admin/common/header-js') ?>
	<link rel="stylesheet" href="<?=base_url('/css/iCheck/all.css')?>">
	<link rel="stylesheet" href="<?=base_url('/admin/css/madmin.css')?>">
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
				Thêm/Chỉnh sửa mã khuyến mãi
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?=base_url('/admin/dashboard.html')?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li><a href="<?=base_url('/admin/pro-code/list.html')?>">Quản lý mã khuyến mãi</a></li>
				<li class="active">Thêm/Chỉnh sửa</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<?php if(!empty($error_message)){
				echo '<div class="alert alert-danger">';
				echo $error_message;
				echo '</div>';
			}?>
			<div class="box">
				<!-- /.box-header -->
				<div class="box-body">
					<?php
					$attributes = array("id" => "frmAddProCode", "class" => "form-horizontal");
					echo form_open("admin/pro-code/add".(isset($proCodeID) ? '-'.$proCodeID : ''), $attributes);
					?>
					<div class="form-group">
						<div class="col-md-2">
							<label>Loại mã <span class="required">*</span> </label>
						</div>
						<div class="col-md-4">
							<select name="txt_type" class="form-control">
								<option value="">---Chọn loại---</option>
								<option value="PRO_CODE_BROKER" <?=(isset($txt_type) && $txt_type == 'PRO_CODE_BROKER') ? 'selected' : '' ?>>Làm môi giới sàn</option>
								<option value="PRO_CODE_FREE_POST" <?=(isset($txt_type) && $txt_type == 'PRO_CODE_FREE_POST') ? 'selected' : '' ?>>Tạo bài đăng miễn phí</option>
							</select>
							<span class="text-danger"><?php echo form_error('txt_type'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Mã khuyến mãi <span class="required">*</span></label>
						</div>
						<div class="col-md-4">
							<input type="text" name="txt_code" class="form-control" value="<?php echo set_value('txt_code', $txt_code); ?>">
							<span class="text-danger"><?php echo form_error('txt_code'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Mô tả</label>
						</div>
						<div class="col-md-10">
							<input type="text" name="txt_about" class="form-control" value="<?php echo set_value('txt_about', $txt_about); ?>">
							<span class="text-danger"><?php echo form_error('txt_about'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Chỉ sử dụng 1 lần</label>
						</div>
						<div class="col-md-10">
							<input type="checkbox" name="ch_onetime" value="1" <?=(set_value('ch_onetime', $ch_onetime) == 1) ? "checked" : "" ?> class="form-control minimal">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Kích hoạt</label>
						</div>
						<div class="col-md-10">
							<input type="checkbox" name="ch_status" value="1" <?=(set_value('ch_status', $ch_status) == 1) ? "checked" : "" ?> class="form-control minimal">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Ngày hết hạn</label>
						</div>
						<div class="col-md-2">
							<input type="text" id="exp_date" autocomplete="off" name="exp_date" value="<?=isset($exp_date) ? $exp_date : ''?>" class="form-control exp_date">
						</div>
					</div>


					<div class="form-group">
						<div class="col-md-8 col-md-offset-2">
							<a href="<?=base_url('/admin/pro-code/list.html')?>" class="btn btn-default btn-flat">Trở lại</a>
							<button type="submit" class="btn btn-primary btn-flat">Lưu</button>
						</div>

					</div>
					<input type="hidden" name="proCodeID" value="<?=isset($proCodeID)? $proCodeID : '' ?>">
					<input type="hidden" name="crudaction" value="insert">
					<?php echo form_close(); ?>
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

<script src="<?=base_url('/admin/js/adminlte.min.js')?>"></script>

<script src="<?=base_url('/ckeditor/ckeditor.js')?>"></script>

<script src="<?=base_url('/css/iCheck/icheck.min.js')?>"></script>

<script src="<?=base_url('/admin/js/bootstrap-datepicker.min.js')?>"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

<script>
	$(function () {
		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass   : 'iradio_minimal-blue'
		});

		$(".exp_date").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate: '0'
		});
	})
</script>
</body>
</html>
