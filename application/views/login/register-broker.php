<!DOCTYPE html>
<html>
<head>
	<head>
		<meta charset = "utf-8">
		<title>Nhà Đất An Cư | Đăng Ký Chuyên Viên</title>
		<?php $this->load->view('common_header')?>
		<?php $this->load->view('/common/googleadsense')?>
	</head>
</head>
<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container-fluid">
	<?php $this->load->view('/theme/header')?>

	<div class="row no-margin">
		<div class="col-lg-6 col-lg-offset-3 col-sm-6 no-background well login-panel">
			<?php if(!empty($error_response)){
				echo '<div class="alert alert-danger">';
				echo $error_response;
				echo '</div>';
			}?>

			<?php if(!empty($message_response)){
				echo '<div class="alert alert-success">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>';
				echo $message_response;
				echo '</div>';
			}?>

			<?php
				$attributes = array("enctype" => "multipart/form-data", "class" => "form-horizontal", "id" => "registerBroker", "name" => "register");
				echo form_open("dang-ky-chuyen-vien", $attributes);
			?>
			<fieldset>
				<legend class="text-center">ĐĂNG KÝ TÀI KHOẢN CHUYÊN VIÊN</legend>
				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_fullname" class="control-label">Mã giới thiệu <span class="required">*</span> </label>
						</div>
						<div class="col-lg-4 col-sm-6">
							<input class="form-control" id="txt_procode" name="txt_procode" placeholder="Mã giới thiệu" type="text" value="<?php echo set_value('txt_procode'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_procode'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_fullname" class="control-label">Họ tên <span class="required">*</span> </label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_fullname" name="txt_fullname" placeholder="Họ tên" type="text" value="<?php echo set_value('txt_fullname'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_fullname'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_phone" class="control-label">Số điện thoại <span class="required">*</span> </label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_phone" name="txt_phone" placeholder="Số điện thoại" type="text" value="<?php echo set_value('txt_phone'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_phone'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_password" class="control-label">Mật khẩu <span class="required">*</span></label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_password" name="txt_password" placeholder="******" type="password" value="<?php echo set_value('txt_password'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_password'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_email" class="control-label">Hình đại diện</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<?php
							if (isset($txt_avatar) && $txt_avatar != null) {
								?>
								<div>
									<img src="<?= base_url($txt_avatar) ?>" class="img-responsive img-thumbnail" style="max-width:100px; margin-bottom: 5px;">
								</div>
								<input type="hidden" name="txt_currentAvatar" value="<?=$txt_avatar?>" />
								<?php
							}
							?>
							<input type="file" id="txt_avatar" name="txt_avatar">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_email" class="control-label">Giới thiệu</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_bio" name="txt_bio" placeholder="Giới thiệu" type="text" value="<?php echo set_value('txt_bio', $txt_bio); ?>" />
							<span class="text-danger"><?php echo form_error('txt_bio'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_email" class="control-label">Email</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_email" name="txt_email" placeholder="Email" type="text" value="<?php echo set_value('txt_email'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_email'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_address" class="control-label">Địa chỉ</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_address" name="txt_address" placeholder="Địa chỉ" type="text" value="<?php echo set_value('txt_address'); ?>" />
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-8 col-sm-8 col-lg-offset-4 text-left">
						<input type="hidden" name="crudaction" value="register"/>
						<input id="btn_login" name="btn_login" type="submit" class="btn btn-info" value="Đăng Ký" /> | <a href="<?=base_url('dang-nhap.html')?>">Đăng Nhập</a>
					</div>
				</div>

			</fieldset>
			<?php echo form_close(); ?>
		</div>

	</div>
	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
