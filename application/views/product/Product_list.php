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
	<meta name="description" content="<?=$category->CatName?>">
	<meta name="keywords" content="<?=keyword_maker($category->CatName)?>">
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="follow" />
	<title><?php echo $category->CatName?></title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container-fluid">

<?php $this->load->view('/theme/header')?>

<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
	<?php
		$position = 1;
		if(isset($category->Parent)){
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.base_url().seo_url($category->Parent->CatName).'-c'.$category->Parent->CategoryID.'.html"><span itemprop="name">'.$category->Parent->CatName.'</span></a><meta itemprop="position" content="'.$position++.'" /></li>';
		}
	?>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name"><?php echo $category->CatName?></span></span><meta itemprop="position" content="<?=$position++?>" /></li>
	<?php $this->load->view('/common/quick-search')?>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">

		<?php
		 // Same categories levels
		 if(count($sameLevels) > 0){
			 echo '<div class="category-panel col-md-12 affix-top"  data-spy="affix" data-offset-top="90">';
			 echo '<div class="container mcontainer">';
			 foreach ($sameLevels as $level){
				 echo '<div class="col-md-4"><a href="'.base_url().seo_url($level->CatName).'-c'.$level->CategoryID.'.html">'.$level->CatName. ' </a></div>';
			 }
			 echo '<div class="clear-both"></div></div></div>';
		 }

		?>

		<div class="product-panel col-md-12  no-margin no-padding">
			<?php
				foreach ($products as $product){
					?>
					<div itemscope itemtype="http://schema.org/Product" class="row product-list vip<?=$product->Vip?>">
						<div class="row product-title">
							<a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html">
								<?php if($product->Vip < PRODUCT_STANDARD){?>
									<?php if($product->Vip == PRODUCT_VIP_0){?>
										<span class="pvip glyphicon glyphicon-star"></span>
									<?php } else{ ?>
										<span class="pvip"><?='v'.$product->Vip?></span>
									<?php } ?>
								<?php } ?>
								<h3 itemprop="name"><?=$product->Title?></h3>
							</a>
						</div>
						<div class="row product-content">
							<div class="col-md-2 col-xs-3 no-padding"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="width100pc product-thumbnail" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
							<div class="col-md-10 col-xs-9">
								<div class="row pos-relative">
									<div class="productTop">
										<div class="col-md-10 col-xs-12 no-padding"><span><span class="mobile-hide">Giá: </span><span class="color bold price"><?=$product->PriceString?></span><span class="margin-left-10"><span class="mobile-hide">Diện tích: </span><span class="color bold"><?=is_numeric($product->Area) ? $product->Area.' m²' : $product->Area?></span></span><span class="margin-left-10"><span class="mobile-hide">Quận/Huyện: </span><span class="color bold mobile-block"><a href="<?=base_url(seo_url($product->district.' '.$product->city)).'-dt'.$product->DistrictID.'.html'?>"><?=$product->district.', '.$product->city?></a></span></div>
										<div class="col-md-2 color bold relative-time no-padding text-right mobile-block"><?=date('d/m/Y', strtotime($product->ModifiedDate))?></div>
										<div class="clear-both"></div>
									</div>
									<div class="col-md-12 col-xs-12 product-brief no-padding mobile-hide">
										<div class="no-margin no-padding col-md-12 col-xs-12" itemprop="description"><?=$product->Brief?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
			?>
			<div class="row text-center">
				<?php echo $pagination ?>
			</div>
		</div>
		<div class="text-center mobile-hide">
			<a href="<?=base_url('/dang-tin.html')?>"><img src="<?=base_url('/img/bottom_banner.jpg')?>" alt="bottom banner"/></a>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right no-padding-left-mobile">
		<?php $this->load->view('/common/city-cat-left-link')?>
		<?php $this->load->view('/common/news_plot')?>
		<?php
		if(isset($BANNER_CAT_1) && strlen($BANNER_CAT_1->Image) > 0){
			?>
			<a href="<?=base_url('/redirect-adv-' . $BANNER_CAT_1->BannerID .'.html')?>">
				<img class="width100pc margin-bottom-20 mobile-hide" src="<?=base_url('/img/banner/'.$BANNER_CAT_1->Image)?>" alt="Middle horizontal banner">
			</a>
			<?php
		}else{
			?>
			<img class="width100pc margin-bottom-20 mobile-hide" src="<?=base_url('/img/some.jpg')?>" alt="Hoa Trao Tay"/>
			<?php
		}
		?>
		<?php $this->load->view('/Subscrible') ?>

		<div class="clear-both"></div>

	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
