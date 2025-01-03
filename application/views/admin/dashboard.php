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
	<title>Nhà Đất An Cư | Dashboard</title>
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
				Tổng quan Nhà Đất An Cư
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">

			<!--------------------------
              | Your Page Content Here |
              -------------------------->
			<!-- Info boxes -->
			<div class="row">
				<!-- fix for small devices only -->
				<div class="clearfix visible-sm-block"></div>

				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="info-box">
						<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

						<div class="info-box-content">
							<span class="info-box-text"><a href="<?=base_url('/admin/user/list.html')?>">Người Dùng</a> </span>
							<span class="info-box-number"><?=number_format($totalUser)?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="info-box">
						<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Bài Đăng Chính Chủ</span>
							<span class="info-box-number"><?=number_format($totalPost)?>/<?=number_format($postDisabled)?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="info-box">
						<span class="info-box-icon bg-aqua"><i class="fa fa-product-hunt"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Crawler</span>
							<span class="info-box-number"><?=number_format($totalCrawler)?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<!-- /.col -->
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="info-box">
						<span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Subscribe</span>
							<span class="info-box-number"><?=number_format($totalSubscribe)?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="box box-success box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Gói VIP</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<span class="col-sm-4 bg-red">Vip-1: <strong><?=$postVip1?></strong></span>
							<span class="col-sm-4 bg-blue">Vip-2: <strong><?=$postVip2?></strong></span>
							<span class="col-sm-4 bg-aqua">Vip-3: <strong><?=$postVip3?></strong></span>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="box box-info box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Bài hôm nay</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<span class="col-sm-3 no-padding text-center"><strong><?=$postCurrentDate?></strong></span>
							<span class="col-sm-3 no-padding">Create: <strong><?=$postCreateCurrentDate?></strong></span>
							<span class="col-sm-3 no-padding">Crawler: <strong><?=$postCrawlerCurrentDate?></strong></span>
							<span class="col-sm-3 no-padding">Update: <strong><?=$countPostPushToday?></strong></span>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="box box-info box-solid">
						<div class="box-header with-border">
							<h3 class="box-title"><a href="<?=base_url('/admin/feedback/list.html')?>">Feedback</a></h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<span class="col-sm-6">All: <strong><?=$feedbackAll?></strong></span>
							<span class="col-sm-6">Today: <strong><?=$feedbackToday?></strong></span>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="box box-warning box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Source</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
						
							<?php
								foreach ($sourceCountAll as $source) {
								?>
								<div class="row">
									<span class="col-sm-8"><?=empty($source->Source) ? 'User created' : $source->Source?></span>
									<span class="col-sm-4 text-right"><?=number_format($source->Total)?></span>
								</div>
							<?php
							}
							?>
							
						</div>
					</div>
				</div>


			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Xử lý nhanh</h3>
						</div>
						<div class="box-body">
							<a id="updateVip" data-vip="<?=$postVipPreviousDate?>" class="btn btn-app">
								<span id="previousVipPost" class="badge <?=$postVipPreviousDate > 0 ? 'bg-red' : 'bg-green'?>"><?=$postVipPreviousDate?></span>	
								<i class="fa fa-remove"></i> Delete Crawler Vip
							</a>

							<a id="deleteCaptchaImgs" data-captcha="<?=$captchaImgs?>" class="btn btn-app">
								<span id="captchaImgs" class="badge <?=$captchaImgs > 0 ? 'bg-red' : 'bg-green'?>"><?=$captchaImgs?></span>
								<i class="fa fa-remove"></i> Delete Captcha Img
							</a>

							<a id="replaceThumbnails" data-thumb="<?=$thumbNoImages?>" class="btn btn-app">
								<span id="thumbImgs" class="badge <?=$thumbNoImages > 0 ? 'bg-red' : 'bg-green'?>"><?=$thumbNoImages?></span>
								<i class="fa fa-copy"></i> Replace Default Img
							</a>

							<a id="retainCrawlerVip" data-vip="<?=$postVipPreviousDate?>" class="btn btn-app">
								<span id="previousCrawlerVipPost" class="badge <?=$postVipPreviousDate > 0 ? 'bg-red' : 'bg-green'?>"><?=$postVipPreviousDate?></span>
								<i class="fa fa-exchange"></i> Retain Crawler Vip
							</a>

							<a id="retainAuthorVip" data-vip="<?=$postVipPreviousDateAuthor?>" class="btn btn-app">
								<span id="previousCrawlerVipPost" class="badge <?=$postVipPreviousDateAuthor > 0 ? 'bg-red' : 'bg-green'?>"><?=$postVipPreviousDateAuthor?></span>
								<i class="fa fa-exchange"></i> Retain Author Vip
							</a>

							<a id="authorPostExpired" class="btn btn-app">
								<span id="authorPostExpiredCount" class="badge <?=$expiredPostAuthor > 0 ? 'bg-red' : 'bg-green'?>"><?=number_format($expiredPostAuthor)?></span>
								<i class="fa fa-trash"></i> Post Author hết hạn
							</a>
							<a id="crawlerPostExpired" class="btn btn-app">
								<span id="crawlerPostExpiredCount" class="badge <?=$expiredPostCrawler > 0 ? 'bg-red' : 'bg-green'?>"><?=number_format($expiredPostCrawler)?></span>
								<i class="fa fa-trash"></i> Post Crawler hết hạn
							</a>

						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title"><a href="<?=base_url('/admin/user/list.html')?>">Đăng nhập hôm nay</a> <span class="label label-<?=count($loginToday) > 0 ? 'success' : 'default'?>"><?=count($loginToday)?></span> </h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
										<tr>
											<th>#</th>
											<th>Họ Tên</th>
											<th>SĐT</th>
											<th>Ngày Tạo</th>
											<th>Đăng Nhập</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$index = 1;
									foreach ($loginToday as $user) {
										?>
										<tr>
											<td><?=$index++?></td>
											<td><a href="<?=base_url('/admin/product/list.html?createdById='.$user->Us3rID)?>" data-toggle="tooltip" title="Xem tin rao"><?=$user->FullName?></a></td>
											<td><?=$user->Phone?></td>
											<td><?=date('d/m/Y H:i', strtotime($user->CreatedDate))?></td>
											<td><?=date('H:i', strtotime($user->LastLogin))?></td>
										</tr>
										<?php
									}
									if(count($loginToday) < 1){
										echo '<td colspan="5" class="text-center">Không có dữ liệu</td>';
									}
									?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>
					</div>
					<!-- /.box -->
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title"><a href="<?=base_url('/admin/user/list.html')?>">User đăng ký hôm nay</a> <span class="label label-<?=count($createdToday) > 0 ? 'success' : 'default'?>"><?=count($createdToday)?></span></h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
									<tr>
										<th>#</th>
										<th>Họ Tên</th>
										<th>SĐT</th>
										<th>Tạo lúc</th>
									</tr>
									</thead>
									<tbody>
									<?php
									$index = 1;
									foreach ($createdToday as $user) {
										?>
										<tr>
											<td><?=$index++?></td>
											<td><a href="<?=base_url('/admin/product/list.html?createdById='.$user->Us3rID)?>" data-toggle="tooltip" title="Xem tin rao"><?=$user->FullName?></a></td>
											<td><?=$user->Phone?></td>
											<td><?=date('H:i', strtotime($user->CreatedDate))?></td>
										</tr>
										<?php
									}
									if(count($createdToday) < 1){
										echo '<td colspan="5" class="text-center">Không có dữ liệu</td>';
									}
									?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>

					</div>
					<!-- /.box -->
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title"><a href="<?=base_url('/admin/product/list.html')?>">Bài đăng hôm nay</a> <span class="label label-<?=count($postToday) > 0 ? 'success' : 'default'?>"><?=count($postToday)?></span></h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
										<tr>
											<th>#</th>
											<th>Tiêu Đề</th>
											<th>Loại Tin</th>
											<th>Tạo Lúc</th>
											<th>Lượt View</th>
											<th>Người Tạo</th>
											<th>Ip Address</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$index = 1;
									foreach ($postToday as $post) {
										?>
										<tr>
											<td><?=$index++?></td>
											<td><?=$post->Title?></td>
											<td class="vip<?=$post->Vip?>">
												<?php
												if($post->Vip == PRODUCT_STANDARD){
													echo 'Tin thường';
												}else if($post->Vip == PRODUCT_VIP_0){
													echo 'SIÊU VIP';
												}else if($post->Vip == PRODUCT_VIP_1){
													echo 'Vip 1';
												}else if($post->Vip == PRODUCT_VIP_2){
													echo 'Vip 2';
												}else if($post->Vip == PRODUCT_VIP_3){
													echo 'Vip 3';
												}
												?>
											</td>
											<td><?=date('d/m/Y H:i', strtotime($post->PostDate))?></td>
											<td><?=$post->View?></td>
											<td><a href="<?=base_url('/admin/product/list.html?createdById='.$post->CreatedByID)?>" data-toggle="tooltip" title="Xem tin rao"><?=$post->FullName?></a></td>
											<td><?=$post->IpAddress?></td>
										</tr>
										<?php
									}
									if(count($postToday) < 1){
										echo '<td colspan="5" class="text-center">Không có dữ liệu</td>';
									}
									?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>

					</div>
					<!-- /.box -->



				</div>

			</div>

			<?php /*
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title">Biến thiên User đăng ký</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body" style="height: 450px;">
							<div id="placeholder" class="demo-placeholder" style="width: 100%;height: 100%"></div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Biến thiên bài đăng</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body" style="height: 450px;">
							<div id="postholder" class="demo-placeholder" style="width: 100%;height: 100%"></div>
						</div>
					</div>
				</div>
			</div>
 			*/ ?>

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<?php $this->load->view('/admin/common/admin-footer')?>

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
<script src="<?=base_url('/admin/js/jquery.flot.js')?>"></script>
<script src="<?=base_url('/admin/js/jquery.flot.categories.js')?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#updateVip").click(function(){
			if($(this).data('vip') > 0){
				bootbox.confirm("Chuyển crawler VIP những ngày trước sang Standard?", function(r){
				if(r){
					jQuery.ajax({
						type: "POST",
						url: '<?=base_url("/admin/admin_controller/updateStandardForPreviousPost")?>',
						dataType: 'json',
						data: {},
						success: function(res){
							if(res == 'success'){
								bootbox.alert("Cập nhật thành công");
							}
						}
					});
				}
			});
			}
			
		});

		$("#deleteCaptchaImgs").click(function(){
			if($(this).data('captcha') > 0){
				bootbox.confirm("Xóa hết hình captcha trong thư mục?", function(r){
					if(r){
						jQuery.ajax({
							type: "POST",
							url: '<?=base_url("/admin/admin_controller/deleteAllCaptcha")?>',
							dataType: 'json',
							data: {},
							success: function(res){
								if(res == 'success'){
									$("#captchaImgs").removeClass('bg-red').addClass('bg-green').html('0');
									// bootbox.alert("Xóa thành công");
								}
							}
						});
					}
				});
			}

		});

		$("#replaceThumbnails").click(function(){
			if($(this).data('thumb') > 0){
				bootbox.confirm("Thay hêt thumbnail?", function(r){
					if(r){
						jQuery.ajax({
							type: "POST",
							url: '<?=base_url("/admin/admin_controller/replaceThumbs")?>',
							dataType: 'json',
							data: {},
							success: function(res){
								if(res == 'success'){
									$("#thumbImgs").removeClass('bg-red').addClass('bg-green').html('0');
									// bootbox.alert("Thay hình thành công");
								}
							}
						});
					}
				});
			}
		});

		$("#retainCrawlerVip").click(function(){
			if($(this).data('vip') > 0){
				bootbox.confirm("Giữ lại tin Crawler Vip ngày trước?", function(r){
					if(r){
						jQuery.ajax({
							type: "POST",
							url: '<?=base_url("/admin/admin_controller/retainCrawlerVip")?>',
							dataType: 'json',
							data: {},
							success: function(res){
								if(res == 'success'){
									$("#previousCrawlerVipPost").removeClass('bg-red').addClass('bg-green').html('0');
									// bootbox.alert("Update thành công");
								}
							}
						});
					}
				});
			}
		});

		$("#retainAuthorVip").click(function(){
			if($(this).data('vip') > 0){
				bootbox.confirm("Giữ lại tin Vip chính chủ ngày trước?", function(r){
					if(r){
						jQuery.ajax({
							type: "POST",
							url: '<?=base_url("/admin/admin_controller/retainOwnerVip")?>',
							dataType: 'json',
							data: {},
							success: function(res){
								if(res == 'success'){
									$("#previousCrawlerVipPost").removeClass('bg-red').addClass('bg-green').html('0');
									// bootbox.alert("Update thành công");
								}
							}
						});
					}
				});
			}
		});

		$("#increasePostView").click(function(){
			bootbox.prompt({
				title: "Tăng View thêm trong khoảng bao nhiêu? Random từ 1 đến:",
				inputType: 'number',
				callback: function (result) {
					jQuery.ajax({
						type: "POST",
						url: '<?=base_url("/admin/admin_controller/addRandomNumber2PostView")?>',
						dataType: 'json',
						data: {'range': result},
						success: function(res){
							if(res == 'success'){
								bootbox.alert("Cập nhật thành công");
							}
						}
					});
				}
			});
		});

		<?php /*
		var userdata = [];
		<?php
		foreach ($userRegistByDate as $userDate){
			?>
				var child = ["<?=date('d/m', strtotime($userDate->ForDate))?>", <?=$userDate->Total?>];
				userdata.push(child);
			<?php
		}
		?>

		// User registed
		userdata.reverse();
		$.plot("#placeholder", [ userdata ], {
			series: {
				bars: {
					show: true,
					barWidth: 0.6,
					align: "center"
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			},grid: {
				hoverable: true,
				borderWidth: 1,
				backgroundColor: { colors: ["#ffffff", "#ebebeb"] }
			}

		});


		// Post registed
		var postdata = [];
		<?php
		foreach ($postRegistByDate as $postDate){
		?>
			var childPost = ["<?=date('d/m', strtotime($postDate->ForDate))?>", <?=$postDate->Total?>];
			postdata.push(childPost);
		<?php
		}
		?>

		postdata.reverse();
		$.plot("#postholder", [ postdata ], {
			series: {
				bars: {
					show: true,
					barWidth: 0.6,
					align: "center"
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			},grid: {
				hoverable: true,
				borderWidth: 1,
				backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
			}
		});
 		*/ ?>
	});
</script>
</body>
</html>
