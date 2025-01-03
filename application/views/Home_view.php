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
	<meta name="description" content="Thông tin mua bán bất động sản, đăng tin miễn phí. Mua bán nhà đất, cho thuê nhà đất, văn phòng, căn hộ, biệt thự, chung cư, tin tức bất động sản, thiết kế đẹp, nhà mẫu, tin thị trường">
	<meta name="keywords" content="Bất, động, sản, bán, nhà, chung, cư, mua, đất, real, estate">
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Bất Động Sản, Mua Bán Chung Cư, Nhà Đất</title>
	<link rel="icon" sizes="48x48" href="<?=base_url('/img/favicon.ico')?>">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/mcustome.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/mobile.min_v2.1.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/home.min_v1.7.css">
	<!-- jQuery library -->
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
	<?php $this->load->view('/common/googleadsense')?>
</head>

<body>
<?php $this->load->view('/common/analyticstracking')?>
<?php $this->load->view('/theme/header')?>


<div class="container-fluid">


<div class="home-page row">
	<div class="home-first-row">
		<div class="col-md-3 col-sm-5 col-xs-12">
			<?php $this->load->view('/common/Search_filter') ?>
		</div>
		<div class="col-md-6 col-sm-7 hidden-xs">
			<div class="fix-height">
				<div class="news-view">
					<div class="col-md-5 col-sm-5 no-padding-left">
						<a href="<?=seo_url($topNews[0]->Title).'-n'.$topNews[0]->NewsID.'.html'?>">
							<img class="width100pc" alt="<?=$topNews[0]->Title?>" src="<?=str_replace("132x100", "210x160", $topNews[0]->Thumb)?>"/>
						</a>
					</div>
					<div class="col-md-7 col-sm-7 no-padding-right">
						<h2><a href="<?=seo_url($topNews[0]->Title).'-n'.$topNews[0]->NewsID.'.html'?>"><?=$topNews[0]->Title?></a></h2>
						<div class="news-description"><?=$topNews[0]->Brief?></div>
						<div class="news-date text-right"><?=date('d/m/Y', strtotime($topNews[0]->CreatedDate))?></div>
					</div>
					<div class="clear-both"></div>
				</div>
				<div class="news-links mCustomScrollbar">
					<ul class="">
						<?php
						$index = 1;
						foreach ($topNews as $topNew) {
							if ($index > 1) {
								?>
								<li>
									<a href="<?= seo_url($topNew->Title) . '-n' . $topNew->NewsID . '.html' ?>"><?= $topNew->Title ?></a>
								</li>
								<?php
							}
							$index++;
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-3 hidden-sm hidden-xs">
			<div id='carousel-custom' class='carousel slide hot-product fix-height-standard' data-interval="7000" data-ride='carousel'>
				<img class="post-star" src="<?=base_url('/img/3d-yellow-star.png')?>"/>
				<div class='carousel-outer'>
					<h1 class="cooperateRealEstate">NHÀ ĐẸP</h1>
					<!-- Wrapper for slides -->
					<div class='carousel-inner'>
						<?php
						$counter = 0;
						foreach ($sampleHouses as $sampleHouse) {
							?>
							<div class="item <?=$counter++ == 0 ? 'active' : ''?>">
								<div><a href="<?=seo_url($sampleHouse->Title).'-s'.$sampleHouse->SampleHouseID.'.html'?>"><img class="width100pc" src="<?=$sampleHouse->Thumb?>" alt="<?=$sampleHouse->Title?>"/></a></div>
								<div class="cooperate-title">
									<a href="<?=seo_url($sampleHouse->Title).'-s'.$sampleHouse->SampleHouseID.'.html'?>"><?=$sampleHouse->Title?></a>
								</div>
								<div class="news-date text-right">
									<?=date('d/m/Y', strtotime($sampleHouse->CreatedDate))?>
								</div>
							</div>
							<?php
						}
						?>
					</div>
					<div class="seemore-coop"><a href="<?=base_url('/khong-gian-song.html')?>">&#187; Xem thêm</a></div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear-both"></div>

	<?php
	if(isset($hotBranches) && count($hotBranches) > 0) {
		?>
		<div class="home-second-row">
			<?php
			foreach ($hotBranches as $branch) {
				?>
				<div class="col-md-3 col-sm-6">
					<div class="item">
						<div class="listing-card ">
							<a href="<?=base_url() . seo_url($branch->BrandName) . '-b' . $branch->BrandID ?>.html" title="<?=$branch->BrandName?>" class="listing-card-link listing-img-a">
								<img alt="<?=$branch->BrandName?>" src="<?=$branch->Thumb?>">
							</a>
							<div class="listing-card-info">
								<h3><a href="<?=base_url() . seo_url($branch->BrandName) . '-b' . $branch->BrandID ?>.html" title="<?=$branch->BrandName?>"
									   class="listing-card-link"><?=$branch->BrandName?></a></h3>
								<p class="listing-location"><?=$branch->Description?></p>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			<div class="clear-both"></div>
		</div>
		<div class="clear-both"></div>
		<?php
	}
	?>


	<div class="nha-dat-ban">
		<div class="col-md-9">
			<div class="row no-padding">
				<div class="col-md-6 col-sm-12">
					<div class="home-group">
						<div class="block-header text-left"><a href="<?=base_url('/nha-dat-ban-c257.html')?>"><h1 class="h1Class">NHÀ ĐẤT BÁN</h1></a></div>
						<?php
						foreach ($nhadatban as $product){
							?>
							<div itemscope itemtype="http://schema.org/Product" class="row product-list">
								<div class="col-md-3 col-sm-2 col-xs-3 no-padding"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="width100pc margin-left-2" style="max-width: 120px" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
								<div class="col-md-9 col-sm-10 col-xs-9 no-padding-right">
									<div class="row pos-relative">
										<div class="productTop">
											<div class="row product-title"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html" title="<?=$product->Title?>"><h3 itemprop="name"><?=substr_at_middle($product->Title, 80)?></h3></a> </div>
											<div class="row no-padding">
												<div>
													<span class="price"><?=$product->PriceString?></span>, <?=is_numeric($product->Area) ? $product->Area.' m²' : $product->Area?>
												</div>
												<div>
													<div class="float-left color"><a href="<?=base_url(seo_url($product->district.' '.$product->city)).'-dt'.$product->DistrictID.'.html'?>"><?=$product->district.', '.$product->city?></a></div>
													<div class="float-right postdate"><?=date('d/m/Y', strtotime($product->ModifiedDate))?></div>
													<div class="clear-both"></div>
												</div>
											</div>
											<div class="clear-both"></div>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
						?>
						<div class="text-right"><a href="<?=base_url('/nha-dat-ban-c257.html')?>">&#187; Xem thêm</a></div>
					</div>
				</div>

				<div class="col-md-6 col-sm-12">
					<div class="home-group">
						<div class="block-header text-left"><a href="<?=base_url('/nha-dat-cho-thue-c267.html')?>"><h1 class="h1Class">NHÀ ĐẤT CHO THUÊ</h1></a></div>
						<?php
						foreach ($nhadatchothue as $product){
							?>
							<div itemscope itemtype="http://schema.org/Product" class="row product-list">
								<div class="col-md-3 col-sm-2 col-xs-3 no-padding"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="width100pc margin-left-2" style="max-width: 120px" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
								<div class="col-md-9 col-sm-10 col-xs-9 no-padding-right">
									<div class="row pos-relative">
										<div class="productTop">
											<div class="row product-title"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html" title="<?=$product->Title?>"><h3 itemprop="name"><?=substr_at_middle($product->Title, 80)?></h3></a> </div>
											<div class="row no-padding">
												<div>
													<span class="price"><?=$product->PriceString?></span>, <?=is_numeric($product->Area) ? $product->Area.' m²' : $product->Area?>
												</div>
												<div>
													<div class="float-left color"><a href="<?=base_url(seo_url($product->district.' '.$product->city)).'-dt'.$product->DistrictID.'.html'?>"><?=$product->district.', '.$product->city?></a></div>
													<div class="float-right postdate"><?=date('d/m/Y', strtotime($product->ModifiedDate))?></div>
													<div class="clear-both"></div>
												</div>
											</div>
											<div class="clear-both"></div>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
						?>
						<div class="text-right"><a href="<?=base_url('/nha-dat-cho-thue-c267.html')?>">&#187; Xem thêm</a></div>
					</div>
					<div class="clear-both"></div>
				</div>
			</div>

			<div class="row no-margin">
				<?php
				if(isset($BANNER_HOME_1) && strlen($BANNER_HOME_1->Image) > 0){
					?>
					<a href="<?=base_url('/redirect-adv-'.$BANNER_HOME_1->BannerID.'.html')?>">
						<img class="middleHorizontalBanner" src="<?=base_url('/img/banner/'.$BANNER_HOME_1->Image)?>" alt="Middle horizontal banner">
					</a>
					<?php
				}else{
					?>
					<img class="middleHorizontalBanner" src="<?=base_url('/img/banner_leaf.jpg')?>" alt="Middle horizontal banner">
					<?php
				}
				?>
			</div>

			<div class="row home-group">
				<div class="col-md-6 col-xs-12">
					<div class="block-header text-left"><a href="<?=base_url('/nha-dat-duoi-mot-ty.html')?>"><h1 class="h1Class">NHÀ ĐẤT DƯỚI 1 TỶ</h1></a></div>
					<?php
					foreach ($underOneBillion as $product){
						?>
						<div itemscope itemtype="http://schema.org/Product" class="briefHome row">
							<div class="col-md-2 col-sm-1 col-xs-2 no-padding"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="imgBrief" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
							<div class="col-md-10 col-sm-11 col-xs-10 no-padding-right">
								<div class="product-title"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html" title="<?=$product->Title?>"><h3 itemprop="name"><?=substr_at_middle($product->Title, 80)?></h3></a> </div>
								<div class="product-info">
									<div><span class="price"><?=$product->PriceString?></span> <span class="color"><a href="<?=base_url(seo_url($product->district.' '.$product->city)).'-dt'.$product->DistrictID.'.html'?>"><?=$product->district.', '.$product->city?></a></span></div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
					<div class="text-right"><a href="<?=base_url('/nha-dat-duoi-mot-ty.html')?>">&#187; Xem thêm</a></div>
					<div class="clear-both"></div>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="block-header text-left"><a href="<?=base_url('/bat-dong-san-moi-cap-nhat.html')?>"><h1 class="h1Class">MỚI CẬP NHẬT</h1></a></div>
					<?php
					foreach ($justUpdates as $product){
						?>
						<div itemscope itemtype="http://schema.org/Product" class="briefHome row">
							<div class="col-md-2 col-sm-1 col-xs-2 no-padding"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="imgBrief" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
							<div class="col-md-10 col-sm-11 col-xs-10 no-padding-right">
								<div class="product-title"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html" title="<?=$product->Title?>"><h3 itemprop="name"><?=substr_at_middle($product->Title, 80)?></h3></a> </div>
								<div class="product-info">
									<div><span class="price"><?=$product->PriceString?></span> <span class="color"><a href="<?=base_url(seo_url($product->district.' '.$product->city)).'-dt'.$product->DistrictID.'.html'?>"><?=$product->district.', '.$product->city?></a></span></div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
					<div class="text-right"><a href="<?=base_url('/bat-dong-san-moi-cap-nhat.html')?>">&#187; Xem thêm</a></div>
					<div class="clear-both"></div>
				</div>
			</div>

			<div class="text-center mobile-hide">
				<?php
				if(isset($BANNER_HOME_2) && strlen($BANNER_HOME_2->Image) > 0){
					?>
					<a href="<?=base_url('/redirect-adv-' . $BANNER_HOME_2->BannerID .'.html')?>">
						<img class="middleHorizontalBanner" src="<?=base_url('/img/banner/'.$BANNER_HOME_2->Image)?>" alt="Middle horizontal banner">
					</a>
					<?php
				}else{
					?>
					<a href="<?=base_url('/dang-tin.html')?>"><img src="<?=base_url('/img/bottom_banner.jpg')?>" alt="bottom banner"/></a>
					<?php
				}
				?>
			</div>
		</div>

		<!-- begin left side -->
		<div class="col-md-3">
			<?php $this->load->view('/common/sample_house_plot')?>
			<?php $this->load->view('/common/city-left-link')?>
			<?php
			if(isset($BANNER_HOME_4) && strlen($BANNER_HOME_4->Image) > 0){
				?>
				<a href="<?=base_url('/redirect-adv-' . $BANNER_HOME_4->BannerID .'.html')?>">
					<img class="width100pc margin-bottom-20 mobile-hide" src="<?=base_url('/img/banner/'.$BANNER_HOME_4->Image)?>" alt="Middle horizontal banner">
				</a>
				<?php
			}else{
				?>
				<img class="width100pc margin-bottom-20 mobile-hide" src="<?=base_url('/img/hoatraotay.jpg')?>" alt="Hoa Trao Tay"/>
				<?php
			}
			?>

			<?php $this->load->view('/common/branch-left-link')?>
			<?php $this->load->view('/common/fan-page')?>
		</div>
		<!-- end left side -->

	</div>
</div>

<script src="<?php echo base_url()?>js/homeland.js"></script>
<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
