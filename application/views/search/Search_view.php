<!DOCTYPE html>
<html lang = "en">
<?php
	$searchBy = "";
	if(isset($category) && !isset($cat_city) && !isset($cat_city_dic)){
		$searchBy = $category->CatName;
	} else if(isset($city)){
		if(isset($district)){
			$searchBy = 'Nhà đất tại quận '.$district->DistrictName.', '. $city->CityName;
		}else{
			$searchBy = 'Nhà đất tại '.$city->CityName;
		}
	}else if(isset($cat_city)){
		$searchBy = $cat_city;
	}else if(isset($cat_city_dic)){
		$searchBy = $cat_city_dic;
	}else if(isset($branch)){
		$searchBy = $branch->BrandName;
	}else if(isset($userAuthor)){
		$searchBy = "Bất động sản của ".$userAuthor->FullName;
	}else{
		$searchBy = "Tìm kiếm";
	}
	?>
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
	<meta name="description" content="<?=$searchBy?>">
	<meta name="keywords" content="<?=keyword_maker($searchBy)?>">
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="follow" />
	<title><?=$searchBy?></title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container-fluid">

<?php $this->load->view('/theme/header')?>

<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?=base_url().'trang-chu.html'?>"><span itemprop="name">Trang Chủ</span></a><meta itemprop="position" content="1" /></li>
	<?php
	if(isset($district)){
		if(isset($city)){
			?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Tìm theo quận <?php echo $district->DistrictName ?>, <?php echo $city->CityName ?></span></span><meta itemprop="position" content="2" /></li>
			<?php
		}else{
			?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Tìm theo quận <?php echo $district->DistrictName ?></span></span><meta itemprop="position" content="2" /></li>
			<?php
		}
	}else if(isset($city)) {
		?>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Tìm theo thành phố <?php echo $city->CityName ?></span></span><meta itemprop="position" content="2" /></li>
		<?php
	}else if(isset($branch)){
		?>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Tìm theo dự án <?php echo $branch->BrandName ?></span></span><meta itemprop="position" content="2" /></li>
		<?php
	}else if(isset($cat_city)){
		?>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name"><?php echo $cat_city ?></span></span><meta itemprop="position" content="2" /></li>
		<?php
	}else if(isset($userAuthor)){
		?>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name"><?php echo "Bất động sản của ".$userAuthor->FullName ?></span></span><meta itemprop="position" content="2" /></li>
		<?php
	}else{
		?>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Tìm kiếm</span></span><meta itemprop="position" content="2" /></li>
		<?php
	}
	?>
</ul>
<div class="row no-margin">
	<div class="search-result col-md-9 no-margin no-padding">

	</div>
	<div class="col-md-9 no-margin no-padding">
		<div class="search-result-panel col-md-12">
			<?=number_format($total)?> kết quả<span class="search-total-result">
			<?php
			if(isset($district)){
				if(isset($city)){
					echo ', nhà đất tại quận '.$district->DistrictName.', '. $city->CityName;
				}else{
					echo ', nhà đất tại quận '.$district->DistrictName;
				}
			}else if(isset($city)){
				 echo ', nhà đất tại '.$city->CityName;
			 }else if(isset($branch)){
				 echo ', nhà đất dự án '.$branch->BrandName;
			 }else if(isset($cat_city)){
				 echo ', '.$cat_city;
			 }else{
				 $str = '';
				 if(isset($keyword) && strlen($keyword) > 0){
					 $str .= ' "'.$keyword.'"';
				 }
				 if(isset($category)){
					 if(isset($keyword)){
						 $str .= ', '.$category->CatName;
					 }else {
						 $str .= $category->CatName;
					 }
				 }
				 if(isset($cmPrice) && $cmPrice > -1){
					 switch($cmPrice){
						 case 0: $str .= ', giá thỏa thuận';break;
						 case 1: $str .= ', giá dưới 500 triệu';break;
						 case 2: $str .= ', giá dưới 1 tỷ';break;
						 case 3: $str .= ', giá 1 - 2 tỷ';break;
						 case 4: $str .= ', giá 2 - 3 tỷ';break;
						 case 5: $str .= ', giá 3 - 5 tỷ';break;
						 case 6: $str .= ', giá 5 - 7 tỷ';break;
						 case 7: $str .= ', giá 7 - 10 tỷ';break;
						 case 8: $str .= ', giá 10 - 20 tỷ';break;
						 case 9: $str .= ', giá trên 20 tỷ';break;
					 }
				 }
				 if(isset($cmArea) && $cmArea > -1){
					 switch($cmArea) {
						 case 0:
							 $str .= ', chưa xác định';
							 break;
						 case 1:
							 $str .= ', dưới 30m²';
							 break;
						 case 2:
							 $str .= ', 30 - 50m²';
							 break;
						 case 3:
							 $str .= ', 50 - 80m²';
							 break;
						 case 4:
							 $str .= ', 80 - 100m²';
							 break;
						 case 5:
							 $str .= ', 100 - 150m²';
							 break;
						 case 6:
							 $str .= ', 150 - 200m²';
							 break;
						 case 7:
							 $str .= ', trên 200m²';
							 break;
					 }

				 }
				 if(isset($scity)){
					 if(isset($sdistrict)){
						 $str .= ' tại '.$sdistrict->DistrictName.', '.$scity->CityName;
					 }else{
						 $str .= ' tại '.$scity->CityName;
					 }
				 }
				 echo $str;
			 }
			?>
			</span>
		</div>
		<div class="product-panel col-md-12 no-margin no-padding">
			<?php
				if(isset($products) && count($products) > 0){
					foreach ($products as $product) {
						?>
						<div itemscope itemtype="http://schema.org/Product" class="row product-list vip<?=$product->Vip?>">
							<div class="row product-title">
								<a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html">
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
								<div class="col-md-2 col-xs-3 no-padding"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="width100pc product-thumbnail" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
								<div class="col-md-10 col-xs-9">
									<div class="row pos-relative">
										<div class="productTop">
											<div class="col-md-10 col-xs-12 no-padding"><span><span class="mobile-hide">Giá: </span><span class="color bold price"><?=$product->PriceString?></span><span class="margin-left-10"><span class="mobile-hide">Diện tích: </span><span class="color bold"><?=is_numeric($product->Area) ? $product->Area.' m²' : $product->Area?></span></span><span class="margin-left-10"><span class="mobile-hide">Quận/Huyện: </span><span class="color bold  mobile-block"><a href="<?=base_url(seo_url($product->district.' '.$product->city)).'-dt'.$product->DistrictID.'.html'?>"><?=$product->district.', '.$product->city?></a></span></div>
											<div class="col-md-2 color bold mobile-block relative-time no-padding text-right mobile-hide"><?=date('d/m/Y', strtotime($product->ModifiedDate))?></div>
											<div class="clear-both"></div>
										</div>
										<div class="col-md-12 col-xs-12 product-brief no-padding mobile-hide">
											<div itemprop="description" class="no-margin no-padding col-md-12 col-xs-12"><?=$product->Brief?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				}
			?>
			<?php
			if(isset($products) && count($products) > 0) {
				?>
				<div class="row text-center">
					<?php if (isset($pagination)) echo $pagination ?>
				</div>
				<?php
			}else{
				?>
				<div class="alert alert-warning">Không tìm thấy dữ liệu phù hợp, vui lòng chọn danh mục khác.</div>
				<?php
			}
			?>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right no-padding-left-mobile">
		<?php $this->load->view('/common/user_author') ?>
		<?php $this->load->view('/common/branch-left') ?>
		<?php $this->load->view('/common/district-left-link')?>
		<?php $this->load->view('/common/branch-left-link')?>
		<?php $this->load->view('/common/Search_filter') ?>
		<?php $this->load->view('/Subscrible') ?>
	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
