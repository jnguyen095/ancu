<?php
/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 8/9/2017
 * Time: 2:19 PM
 */
?>
<!DOCTYPE html>
<html>
<head>
	<head>
		<meta charset = "utf-8">
		<meta name="description" content="Tin Bất động sản, Rao tin miễn phí, tin bất động sản miễn phí">
		<meta name="keywords" content="Tin Bất động sản, Rao tin miễn phí, tin bất động sản miễn phí">
		<title>Nhà Đất An Cư | Đăng Tin Rao Miễn Phí | Tạo Tin Bất Động Sản</title>
		<?php $this->load->view('common_header')?>
		<link rel="stylesheet" href="<?=base_url('/css/stepbar.css')?>">
		<?php $this->load->view('/common/googleadsense')?>
</head>
</head>
<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container-fluid">
	<?php $this->load->view('/theme/header')?>

	<ul class="breadcrumb">
		<li><a href="<?=base_url('/trang-chu.html')?>">Trang chủ</a> </li>
		<li class="active">Đăng tin</li>
	</ul>

	<div class="row no-margin">
		<div class="col-lg-12 col-sm-12">
			<h1 class="h2title">GỬI BĐS THÀNH CÔNG</h1>
			<hr/>

			<!-- content -->
			<div class="col-md-12 no-margin no-padding text-center">
				<div class="alert alert-success">
					<strong class="title">Bạn đã gửi BĐS đến sàn thành công!</strong>
				</div>

				<div class="post-success">
					<div>
						<i>
							<ol>
								<li>Cảm ơn bạn đã đăng tin, chuyên viên sẻ liên hệ để làm rõ yêu cầu và cách thức hợp tác với bạn sớm nhất có thể.</li>
								<li>Bạn có thể tìm kiếm bđs phù hợp tại đây: <a href="<?=base_url("tim-kiem.html")?>">Tìm Kiếm</a> </li>
							</ol>

						</i>
					</div>
				</div>
			</div>
			<!-- end content -->

			<div class="clear-both"></div>
		</div>
	</div>

	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
