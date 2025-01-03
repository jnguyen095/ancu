<?php
/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 9/14/2017
 * Time: 10:05 AM
 */

if(isset($sampleHouses)) {
	?>

	<div class="inews-l brief mobile-hide">
		<div class="inews-l-title">
			<img class="imgIcon" src="<?=base_url('/img/nhadep1.png')?>" alt="Nhà đẹp">
			<h3 class="title"><a href="/khong-gian-song.html" title="Tin Bất Động Sản">Thiết kế đẹp</a></h3>
			<div class="clear-both"></div>
		</div>
		<div class="inews-l-content">
			<ul>
				<?php
				foreach ($sampleHouses as $sampleHouse) {
					?>
					<li>
						<div class="row">
							<div class="col-md-3 col-xm-12 no-padding-right">
								<img class="width100pc" alt="<?=$sampleHouse->Title?>" src="<?=$sampleHouse->Thumb?>"/>
							</div>
							<div class="col-md-9 col-xm-12">
								<h3 class="margin-top-5"><a href="<?=seo_url($sampleHouse->Title).'-s'.$sampleHouse->SampleHouseID.'.html'?>"><?=$sampleHouse->Title?></a></h3>
							</div>
						</div>
					</li>
					<?php
				}
				?>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<?php
}
?>
