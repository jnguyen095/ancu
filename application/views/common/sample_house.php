<?php
/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 9/14/2017
 * Time: 10:05 AM
 */

if(isset($sampleHouses)) {
	?>

	<div class="inews-l">
		<div class="inews-l-title">
			<img class="imgIcon" src="<?=base_url('/img/nhadep1.png')?>" alt="Nhà đẹp">
			<h2 class="title"><a href="/khong-gian-song.html" title="Tin Bất Động Sản">Thiết kế đẹp</a></h2>
			<div class="clear-both"></div>
		</div>
		<div class="inews-l-content">
			<div class="inews-l-content-hot">
				<a href="<?=seo_url($sampleHouses[0]->Title).'-n'.$sampleHouses[0]->SampleHouseID.'.html'?>">
					<img alt="<?=$sampleHouses[0]->Title?>" src="<?=$sampleHouses[0]->Thumb?>"/>
				</a>
				<h3>
					<a href="<?=seo_url($sampleHouses[0]->Title).'-n'.$sampleHouses[0]->SampleHouseID.'.html'?>"><?=$sampleHouses[0]->Title?></a>
				</h3>
			</div>
			<div class="clear"></div>
			<ul>
				<?php
				foreach ($sampleHouses as $sampleHouse) {
					?>
					<li>
						<a href="<?=seo_url($sampleHouse->Title).'-s'.$sampleHouse->SampleHouseID.'.html'?>"><?=$sampleHouse->Title?></a>
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
