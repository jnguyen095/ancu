<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<meta name="description" content="Tin tức bất động sản, nhà đất, chung cư">
	<meta name="keywords" content="Bất động sản, bán nhà, chung cư, mua đất, bán đất, real estate">
	<title>Tin Tức Về Bất Động Sản</title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body class="news">
<?php $this->load->view('/common/analyticstracking')?>
<div class="container-fluid">

<?php $this->load->view('/theme/header')?>

<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?=base_url().'trang-chu.html'?>"><span itemprop="name">Trang Chủ</span></a><meta itemprop="position" content="1" /></li>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Tin Tức</span></span><meta itemprop="position" content="2" /></li>
	<?php $this->load->view('/common/quick-search')?>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
		<div class="search-result-panel col-md-12">Tin Tức Về Bất Động Sản</div>
		<div class="product-panel col-md-7  no-margin no-padding">
			<?php

			?>
			<iframe  src="https://quyhoach.hanoi.vn/"></iframe>
		</div>
		<div class="product-panel col-md-5 no-padding-right no-padding-left-mobile">
			<?php $this->load->view('/common/city-left-link')?>
			<?php $this->load->view('/common/product-just-updated') ?>
			<img class="width100pc margin-bottom-20" src="<?=base_url('/img/img_1.jpg')?>" alt="Hoa Trao Tay"/>
			<?php $this->load->view('/common/branch-left-link')?>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right no-padding-left-mobile">
		<?php $this->load->view('/common/sample_house') ?>
		<?php $this->load->view('/common/Search_filter') ?>
	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
