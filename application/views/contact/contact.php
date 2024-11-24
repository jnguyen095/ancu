<?php
/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 11/18/2017
 * Time: 6:16 PM
 */
?>
<!-- Modal -->
<div class="modal-dialog">
	<div class="modal-content">
		<!-- Modal Header -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">
				<span aria-hidden="true">&times;</span>
				<span class="sr-only">Đóng</span>
			</button>
			<h4 class="modal-title h4" id="myModalLabel">Liên Hệ Với Nhà Đất An Cư</h4>
		</div>

		<!-- Modal Body -->
		<div class="modal-body">
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

			<p class="statusMsg">Vui lòng để lại thông tin bên dưới!</p>
			<div class="form-group">
				<label for="inputName">Họ tên<span class="required">*</span></label>
				<input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo set_value('fullName', $fullName); ?>" placeholder="Nhập họ tên"/>
				<span class="text-danger"><?php echo form_error('fullName'); ?></span>
			</div>
			<div class="form-group">
				<label for="inputPhone">Số điện thoại<span class="required">*</span></label>
				<input name="phoneNumber" type="text" class="form-control" id="inputPhone" value="<?php echo set_value('phoneNumber', $phoneNumber); ?>" placeholder="Nhập số điện thoại"/>
				<span class="text-danger"><?php echo form_error('phoneNumber'); ?></span>
			</div>
			<div class="form-group">
				<label for="inputEmail">Email</label>
				<input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo set_value('email', $email); ?>" placeholder="Nhập địa chỉ email"/>
			</div>
			<div class="form-group">
				<label for="inputMessage">Nội dung<span class="required">*</span></label>
				<textarea name="content" class="form-control" id="inputMessage" placeholder="Nhập nội dung"><?php echo set_value('content', $content);?></textarea>
				<span class="text-danger"><?php echo form_error('content'); ?></span>
			</div>
			<div class="form-group">
				<label for="inputMessage">Mã xác nhận<span class="required">*</span></label>
				<div class="row">
					<div class="col-md-4">
						<input id="txtCaptcha" name="txt_captcha" class="form-control" value="<?=(isset($txt_captcha) ? $txt_captcha : '')?>"/>
						<span class="text-danger"><?php echo form_error('txt_captcha'); ?></span>
					</div>
					<div class="col-md-8">
						<span id="captchaImg"><?=$capchaImg?></span>
						<a id="changeCaptcha" data-toggle="tooltip" title="Đổi mã xác thực khác" class="margin-left-10"><i class="glyphicon glyphicon-refresh"></i> </a>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Footer -->
		<div class="modal-footer">
			<input type="hidden" name="crudaction" value="insert"/>
			<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			<button id="btnSendFeedBack" type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">Gửi</button>
		</div>
	</div>
</div>
