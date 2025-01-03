<!DOCTYPE html>
<html lang = "en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="audience" content="general" />
	<meta name="resource-type" content="document" />
	<meta name="abstract" content="Thông tin nhà đất Việt Nam" />
	<meta name="classification" content="Bất động sản Việt Nam" />
	<meta name="area" content="Nhà đất và bất động sản" />
	<meta name="placename" content="Việt Nam" />
	<meta name="author" content="nhadatancu.com" />
	<meta name="copyright" content="©2024 nhadatancu.com" />
	<meta name="owner" content="nhadatancu.com" />
	<meta name="distribution" content="Global" />
	<meta name="description" content="<?=$product->Title?>">
	<meta name="keywords" content="<?=keyword_maker($product->Title)?>">
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="follow" />
	<title><?php echo $product->Title?></title>
	<?php $this->load->view('common_header')?>
	<link rel="stylesheet" href="<?=base_url('/css/jquery.mCustomScrollbar.min.css')?>" />
	<link rel="stylesheet" href="<?=base_url('/css/carousel-custom.css')?>" />
	<script src="<?=base_url('/js/jquery.mCustomScrollbar.min.js')?>"></script>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container-fluid">
<?php $this->load->view('/theme/header')?>

<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb always">
	<?php
		$position = 1;
		if(isset($category->Parent)){
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.base_url().seo_url($category->Parent->CatName).'-c'.$category->Parent->CategoryID.'.html"><span itemprop="name">'.$category->Parent->CatName.'</span></a><meta itemprop="position" content="'.$position++.'" /></li>';
		}
	?>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo base_url().seo_url($category->CatName).'-c'.$category->CategoryID?>.html"><span itemprop="name"><?php echo $category->CatName?></span></a><meta itemprop="position" content="<?=$position++?>" /></li>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active mobile-hide"><span itemprop="item"><span itemprop="name"><?php echo $product->Title?></span></span><meta itemprop="position" content="<?=$position++?>" /></li>
</ul>
<div class="row no-margin">
	<div itemscope itemtype="http://schema.org/Product" class="col-md-9 no-margin no-padding product-detail">
		<?php
		if($product->Status == PAYMENT_DELAY){
			?>
			<div class="alert alert-danger">
				<b>Tin chưa thanh toán!</b> Chỉ mình bạn thấy tin này, vui lòng <a href='/bao-gia-dich-vu.html'>thanh toán</a> để tin tiếp cận người mua.
			</div>
		<?php }?>

		<div class="product-title">
			<h1 class="h1Class" itemprop="name"><?php echo $product->Title?></h1>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="price-detail price float-left"><?php echo $product->PriceString?></div>
				<div class="addr-detail row color-gray no-margin no-padding text-right float-right"><span class="mobile-hide">Ngày đăng: </span><?=date('d/m/Y', strtotime($product->ModifiedDate))?></div>
				<div class="clear-both"></div>
			</div>
			<div class="col-md-3 col-sm-12 area-detail">Diện tích: <?=is_numeric($product->Area) ? $product->Area.' m²' : $product->Area?></div>
			<div class="col-md-9 col-sm-12 text-right text-left-mobile addr-detail">
				<span class="glyphicon glyphicon-map-marker"></span><span class="addr-detail">
				<?php
				if(isset($product->Street)){
					echo $product->Street;
					echo ' - ';
				}
				if(isset($product->Ward)){
					echo $product->Ward->WardName;
					echo ' - ';
				}
				if(isset($product->District)){
					echo $product->District->DistrictName;
				}
				if(isset($product->City)){
					echo ' - ';
					echo $product->City->CityName;
				}
				?>
				</span>
			</div>
		</div>

		<?php
		if($product->Assets != null && count($product->Assets) > 0) {
			?>
			<div class="product-assets">
				<div id='carousel-custom' class='carousel slide' data-interval="false" data-ride='carousel'>
					<div class='carousel-outer'>
						<!-- Wrapper for slides -->
						<div class='carousel-inner'>
							<?php
							$isFirst = true;
							foreach ($product->Assets as $asset) {
								if ($isFirst) {
									echo '<div class="item active">';
									$isFirst = false;
								} else {
									echo '<div class="item">';
								}
								echo '<img src="' . str_replace('resize/200x200/', '', $asset->OrgUrl) . '" alt=\'\' />';
								echo '</div>';
							}
							?>
						</div>

						<!-- Controls -->
						<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
							<span class='glyphicon glyphicon-chevron-left'></span>
						</a>
						<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
							<span class='glyphicon glyphicon-chevron-right'></span>
						</a>
					</div>

					<!-- Indicators -->
					<ol class='carousel-indicators mCustomScrollbar'>
						<?php
						$i = 0;
						foreach ($product->Assets as $asset) {
							if ($i == 0) {
								echo '<li data-target="#carousel-custom" data-slide-to="' . $i . '" class="active"><img onclick="ga(\'send\',{hitType: \'event\', eventCategory: \'Thumb Detail Page\',eventAction: \'List thumb detail page\',eventLabel: \'Xem: '.$asset->Url.'\'});" src="' . $asset->Url . '" /></li>';
							} else {
								echo '<li data-target="#carousel-custom" data-slide-to="' . $i . '"><img onclick="ga(\'send\',{hitType: \'event\', eventCategory: \'Thumb Detail Page\',eventAction: \'List thumb detail page\',eventLabel: \'Xem: '.$asset->Url.'\'});" src="' . $asset->Url . '" /></li>';
							}

							$i++;
						}
						?>
					</ol>
				</div>
			</div>
			<?php
		}
		?>


		<div class="h2title">Chi Tiết</div>

		<div id="prDetail" class="product-detail content" itemprop="description">
			<?php echo preg_replace('#<a.*?>([^>]*)</a>#i', '$1', $product->Detail);?>
		</div>

		<div class="row">
			<div class="col-md-6">
				<table class="table tableBorder">
					<tr class="tbHeader">
						<td colspan="2">Đặc Điểm</td>
					</tr>
					<tr>
						<td class="width100">Chiều rộng</td>
						<td><?=$product->WidthSize != null ? $product->WidthSize : 'KXĐ'?></td>
					</tr>
					<tr>
						<td class="width100">Chiều dài</td>
						<td><?=$product->LongSize != null ? $product->LongSize : 'KXĐ'?></td>
					</tr>
					<tr>
						<td class="width100">Số tầng</td>
						<td><?=$product->Floor != null ? $product->Floor : 'KXĐ'?></td>
					</tr>
					<tr>
						<td class="width100">Số phòng</td>
						<td><?=$product->Room != null ? $product->Room : 'KXĐ'?></td>
					</tr>
					<tr>
						<td class="width100">Nhà vệ sinh</td>
						<td><?=$product->Toilet != null ? $product->Toilet : 'KXĐ'?></td>
					</tr>
					<tr>
						<td class="width100">Hướng</td>
						<td><?=(isset($product->Direction) && $product->Direction) ? $product->Direction->DirectionName : 'KXĐ'?></td>
					</tr>
					<?php
						if(isset($product->Brand) && $product->Brand != null){
							?>
							<td class="width100">Thuộc dự án</td>
							<td><a href="<?=base_url() . seo_url($product->Brand->BrandName) . '-b' . $product->Brand->BrandID ?>.html" title="<?=$product->Brand->BrandName?>" class="listing-card-link listing-img-a"><span itemprop="brand"><?=$product->Brand->BrandName?></span></a></td>
						<?php
						}
					?>
				</table>
			</div>
			<div class="col-md-6">
				<table class="table tableBorder">
					<tr class="tbHeader">
						<td colspan="2">Liên Hệ</td>
					</tr>
					<tr>
						<td class="width120">Liên hệ</td>
						<td><?=$product->ContactName != null ? $product->ContactName : '-'?></td>
					</tr>
					<tr>
						<td class="width12">Số ĐT</td>
						<td><a href="tel:<?=$product->ContactPhone?>"><?=$product->ContactPhone != null ? $product->ContactPhone : '-'?></a></td>
					</tr>
					<?php
					if($product->ContactMobile != null) {
						?>
						<tr>
							<td class="width100">Di động</td>
							<td><a href="tel:<?=$product->ContactMobile?>"><?= $product->ContactMobile != null ? $product->ContactMobile : 'KXĐ' ?></a></td>
						</tr>
						<?php
					}
					?>
					<tr>
						<td class="width100">Địa chỉ</td>
						<td><?=$product->ContactAddress != null ? $product->ContactAddress : 'KXĐ'?></td>
					</tr>
					<tr>
						<td class="width100">Email</td>
						<td><?=$product->ContactEmail != null ? $product->ContactEmail : 'KXĐ'?></td>
					</tr>
					<tr>
						<td colspan="2" class="text-center"><a id="btnCallMe" data-postid="<?=$product->ProductID?>" href="javascript:void(0);" class="btn btn-sm btn-primary">Yêu cầu liên hệ lại</a></td>
					</tr>
				</table>
			</div>
		</div>

		<?php /* Map đang expired key
		<?php if($product->Latitude > 0 && $product->Longitude > 0){?>
			<ul id="mapTabs" class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">Bản Đồ</a></li>
				<li><a data-toggle="tab" data-type="school" href="#home">Trường Học</a></li>
				<li><a data-toggle="tab" data-type="hospital" href="#home">Bệnh Viện</a></li>
				<li><a data-toggle="tab" data-type="bank" href="#home">Ngân Hàng, ATM</a></li>
				<li><a data-toggle="tab" data-type="grocery_or_supermarket" href="#home">Chợ, Siêu Thị</a></li>
				<li><a data-toggle="tab" data-type="store" href="#home">Cửa Hàng</a></li>
				<li><a data-toggle="tab" data-type="church" href="#home">Nhà Thờ</a></li>
			</ul>

			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					<?php $this->load->view('/Map_view')?>
				</div>
			</div>
		<?php }?>
		*/ ?>

		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-top-5">
				<?php $this->load->view('/SocialShare') ?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right text-left-mobile">
				<?php
				if(isset($product->Source)){
					?>
					<div class="copy-source row color-gray no-margin no-padding">Nguồn: <?=$product->Source?></div>
					<?php
				}else if(isset($totalProductWithThisUser) && $totalProductWithThisUser > 1){
					?>
					<div class="copy-source row subscrible-success no-margin no-padding">
						<a href="<?=base_url('/bat-dong-san-cua-').seo_url($product->ContactName).'-u'.$product->CreatedByID.'.html'?>">Xem tất cả <?=$totalProductWithThisUser?> tin cùng người đăng</a>
					</div>
					<?php
				}
				?>
			</div>
		</div>


		<?php if(isset($similarProducts) && count($similarProducts) > 0){
			?>
			<hr/>
			<h2 class="h2footer"><a href="<?=base_url(seo_url($category->CatName.'-'.$district->DistrictName.'-c'.$category->CategoryID.'-d'.$district->DistrictID)).'.html'?>" style="color:#fff">&#187; Xem thêm <?=$category->CatName?> tại <?=$district->DistrictName?></a></h2>
			<div class="row no-margin border-right-gray">
			<?php
			foreach ($similarProducts as $similarProduct){
				?>
				<div class="col-md-6 col-xs-12 brief-box">
					<div itemscope itemtype="http://schema.org/Product" class="brief-box-item">
						<div class="content">
							<div class="image col-md-4 col-xs-3 no-padding-mobile">
								<img itemprop="image" class="width100pc" src="<?=$similarProduct->Thumb?>" alt="<?=$product->Title?>"/>
							</div>
							<div class="brief-detail col-md-8 col-xs-9 no-padding-right">
								<a itemprop="url" href="<?=base_url().seo_url($similarProduct->Title).'-p'.$similarProduct->ProductID?>.html" title="<?=$similarProduct->Title?>"><span itemprop="name"><h3><?=substr_at_middle($similarProduct->Title, 80)?></h3></span></a>
								<div class="price"><?=$similarProduct->PriceString?> <span class="color"><?=is_numeric($similarProduct->Area) ? $similarProduct->Area.' m²' : $similarProduct->Area?></span></div>
								<div class="color"><?=date('d/m/Y', strtotime($similarProduct->ModifiedDate))?></div>
							</div>
							<div class="clear-both"></div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			</div>
		<?php
		}
		?>

		<?php if(isset($similarCityProducts) && count($similarCityProducts) > 0){
			?>
			<hr/>
			<h2 class="h2footer"><a href="<?=base_url(seo_url($category->CatName.'-'.$city->CityName.'-cc'.$category->CategoryID.'-'.$city->CityID)).'.html'?>" style="color:#fff">&#187; Xem thêm <?=$category->CatName?> tại <?=$city->CityName?></a></h2>
			<div class="row no-margin border-right-gray">
				<?php
				foreach ($similarCityProducts as $similarProduct){
					?>
					<div class="col-md-6 col-xs-12 brief-box">
						<div itemscope itemtype="http://schema.org/Product" class="brief-box-item">
							<div class="content">
								<div class="image col-md-4 col-xs-3 no-padding-mobile">
									<img itemprop="image" class="width100pc" src="<?=$similarProduct->Thumb?>" alt="<?=$product->Title?>"/>
								</div>
								<div class="brief-detail col-md-8 col-xs-9 no-padding-right">
									<a itemprop="url" href="<?=base_url().seo_url($similarProduct->Title).'-p'.$similarProduct->ProductID?>.html" title="<?=$similarProduct->Title?>"><span itemprop="name"><h3><?=substr_at_middle($similarProduct->Title,90)?></h3></span></a>
									<div class="price"><?=$similarProduct->PriceString?> <span class="color"><?=is_numeric($similarProduct->Area) ? $similarProduct->Area.' m²' : $similarProduct->Area?></span></div>
									<div class="color"><?=date('d/m/Y', strtotime($similarProduct->ModifiedDate))?></div>
								</div>
								<div class="clear-both"></div>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>


		<?php if(isset($sameLevels) && count($sameLevels) > 0) {
			echo "<div class='row no-margin bottom-detail-same-level'>";
			foreach ($sameLevels as $sameLevel) {
				?>
				<div class="col-sm-6 col-xs-12 no-padding-right"><a href="<?=base_url(seo_url($sameLevel->CatName.'-'.$district->DistrictName.'-c'.$sameLevel->CategoryID.'-d'.$district->DistrictID)).'.html'?>" class="narrow-a"><?=$sameLevel->CatName . ' tại '. $district->DistrictName?></a></div>
				<?php
			}
			echo "<div class='clear-both'></div>";
			echo "</div>";
		}
		?>

	</div>
	<div class="col-md-3 no-margin-right no-padding-right no-padding-left-mobile">
		<?php $this->load->view('/common/branch-left') ?>
		<?php $this->load->view('/common/Search_filter') ?>
		<?php $this->load->view('/common/sample_house') ?>
		<div class="clear-both"></div>
		<?php $this->load->view('/Subscrible') ?>
		<div class="clear-both"></div>
		<?php
		if(isset($BANNER_DETAIL_1) && strlen($BANNER_DETAIL_1->Image) > 0){
			?>
			<a href="<?=base_url('/redirect-adv-' . $BANNER_DETAIL_1->BannerID .'.html')?>">
				<img class="width100pc margin-bottom-20 mobile-hide" src="<?=base_url('/img/banner/'.$BANNER_DETAIL_1->Image)?>" alt="Middle horizontal banner">
			</a>
			<?php
		}else{
			?>
			<img class="width100pc margin-bottom-20 mobile-hide" src="<?=base_url('/img/hoatraotay.jpg')?>" alt="Hoa Trao Tay"/>
			<?php
		}
		?>
	</div>

</div>



<?php $this->load->view('/theme/footer')?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".mCustomScrollbar").mCustomScrollbar({axis:"x"});
	});
</script>

<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
</body>

</html>
