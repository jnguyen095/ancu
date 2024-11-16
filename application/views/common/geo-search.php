<?php
/**
 * Created by Khang Nguyen
 * User: nguyennhukhangvn@gmail.com
 * Date: 11/16/2024
 * Time: 3:44 PM
 */
?>

<div class="product-panel col-md-12 horizontal-search">

	<div class="col-md-3 col-sm-6">
		<select class="form-control" id="cmCityId" name="cmCityId">
			<option value="-1">Chọn tỉnh/thành phố</option>
			<?php
			if($cities != null && count($cities) > 0){
				foreach ($cities as $city){
					?>
					<option value="<?=$city->CityID?>" <?=(isset($cmCityId) && $cmCityId == $city->CityID)?'selected':''?>><?=$city->CityName?></option>
					<?php
				}
			}
			?>
		</select>
	</div>
	<div class="col-md-3 col-sm-6">
		<select class="form-control" id="cmDistrictId" name="cmDistrictId">
			<option value="-1">Chọn quận/huyện</option>
			<?php
			if($districts != null && count($districts) > 0) {
				foreach ($districts as $dt) {
					?>
					<option
						value="<?= $dt->DistrictID ?>" <?= (isset($cmDistrictId) && $cmDistrictId == $dt->DistrictID) ? ' selected' : '' ?> ><?= $dt->DistrictName ?></option>
					<?php
				}
			}
			?>
		</select>
	</div>

	<div class="col-md-2 col-sm-6">
		<select class="form-control" id="cmPrice" name="cmPrice">
			<option value="-1">Tất cả giá</option>
			<option value="0" <?=(isset($cmPrice) && $cmPrice == 0) ? 'selected' : ''?>>Thỏa thuận</option>
			<option value="1" <?=(isset($cmPrice) && $cmPrice == 1) ? 'selected' : ''?>>< 500 triệu</option>
			<option value="2" <?=(isset($cmPrice) && $cmPrice == 2) ? 'selected' : ''?>><1 tỷ</option>
			<option value="3" <?=(isset($cmPrice) && $cmPrice == 3) ? 'selected' : ''?>>1 - 2 tỷ</option>
			<option value="4" <?=(isset($cmPrice) && $cmPrice == 4) ? 'selected' : ''?>>2 - 3 tỷ</option>
			<option value="5" <?=(isset($cmPrice) && $cmPrice == 5) ? 'selected' : ''?>>3 - 5 tỷ</option>
			<option value="6" <?=(isset($cmPrice) && $cmPrice == 6) ? 'selected' : ''?>>5 - 7 tỷ</option>
			<option value="7" <?=(isset($cmPrice) && $cmPrice == 7) ? 'selected' : ''?>>7 - 10 tỷ</option>
			<option value="8" <?=(isset($cmPrice) && $cmPrice == 8) ? 'selected' : ''?>>10 - 20 tỷ</option>
			<option value="9" <?=(isset($cmPrice) && $cmPrice == 9) ? 'selected' : ''?>>> 20 tỷ</option>
		</select>
	</div>

	<div class="col-md-2 col-sm-6">
		<select class="form-control" id="cmArea" name="cmArea">
			<option value="-1">Tất cả diện tích</option>
			<option value="0" <?=(isset($cmArea) && $cmArea == 0) ? 'selected' : ''?>>Không xác định</option>
			<option value="1" <?=(isset($cmArea) && $cmArea == 1) ? 'selected' : ''?>><= 30 m2</option>
			<option value="2" <?=(isset($cmArea) && $cmArea == 2) ? 'selected' : ''?>>30  - 50 m2</option>
			<option value="3" <?=(isset($cmArea) && $cmArea == 3) ? 'selected' : ''?>>50  - 80 m2</option>
			<option value="4" <?=(isset($cmArea) && $cmArea == 4) ? 'selected' : ''?>>80  - 100 m2</option>
			<option value="5" <?=(isset($cmArea) && $cmArea == 5) ? 'selected' : ''?>>100 - 150 m2</option>
			<option value="6" <?=(isset($cmArea) && $cmArea == 6) ? 'selected' : ''?>>150 - 200 m2</option>
			<option value="7" <?=(isset($cmArea) && $cmArea == 7) ? 'selected' : ''?>>>= 200 m2</option>
		</select>
	</div>

	<div class="col-md-2 col-sm-6">
		<a data-toggle="tooltip" title="Đặt lại giá trị"><i class="glyphicon glyphicon-refresh"></i></a>
	</div>
</div>

