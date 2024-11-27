<?php
/**
 * Created by Khang Nguyen.
 * Email: nguyennhukhangvn@gmail.com
 * Date: 7/19/2017
 * Time: 11:17 AM
 */
?>


<nav class="navbar navbar-default m-navbar navbar-fixed-top"/>
	<div class="container-fluid">
		<a class="navbar-brand brandName ipad-mini-hide hidden-md" href="<?=base_url('/')?>">
			<img src="<?=base_url('/img/ancu-sm.png')?>" atl="Nha Tim Chu Logo"/>
		</a>
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar4">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbar4" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<?php
				foreach($categories as $r) {
					if(count($child[$r->CategoryID]) > 0){
						echo '<li role="presentation" class="dropdown">
							<a  href="'.base_url().seo_url($r->CatName).'-c'.$r->CategoryID. '.html" role="button" aria-haspopup="true" aria-expanded="false">
										'.$r->CatName.' <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">';
						foreach ($child[$r->CategoryID] as $k){
							echo '<li><a href="'.base_url().seo_url($k->CatName).'-c'.$k->CategoryID. '.html">'.$k->CatName.'</a></li>';
						}

						echo '</ul></li>';
					}else{
						echo ' <li><a href="'.seo_url($r->CatName).'-c'.$r->CategoryID. '.html">'.$r->CatName.'</a></li>';
					}
				}
				?>
				<li role="presentation"><a href="<?=base_url('khong-gian-song.html')?>">Không gian sống</a> </li>
				<li role="presentation"><a href="<?=base_url('tin-tuc.html')?>">Tin Tức</a> </li>
				<li role="presentation"><a href="<?=base_url('bao-gia-dich-vu.html')?>">Báo giá</a> </li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?=base_url('/dang-tin.html')?>">Đăng Tin</a></li>
				<li><a href="<?=base_url('/dang-tin-hop-tac.html')?>">Gửi BĐS</a></li>
				<?php
				if($this->session->userdata('phone') != null){
					?>
					<li role="presentation" class="dropdown">
						<a href="<?=base_url('/thong-tin-ca-nhan.html')?>" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="glyphicon glyphicon-user"></i>&nbsp;<?=$this->session->userdata('fullname')?>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<?php
							if($this->session->userdata('avatar') != null && strlen($this->session->userdata('avatar')) > 0) {
								?>
								<li class="avatar text-center gr-<?=$this->session->userdata('usergroup')?>"><img src="<?=base_url($this->session->userdata('avatar'))?>"/> </li>
								<?php
							}?>

							<?php
							if($this->session->userdata('usergroup') != null && ($this->session->userdata('usergroup') == 'BROKER') || $this->session->userdata('usergroup') == 'STAFF') {
								?>
								<li class="ugroup ugroupvip"><i class="glyphicon glyphicon-star"></i>&nbsp;Không Giới Hạn&nbsp;<i class="glyphicon glyphicon-star"></i></li>
							<?php
							} else if($this->session->userdata('usergroup') != null && $this->session->userdata('usergroup') == 'USER'){
							?>
								<li class="ugroup ugroupend"><i class="glyphicon glyphicon-star"></i>&nbsp;Hiệu Quả&nbsp;<i class="glyphicon glyphicon-star"></i></li>
							<?php
							}
							?>
							<?php
							if($this->session->userdata('usergroup') != null && $this->session->userdata('usergroup') == 'ADMIN') {
								?>
								<li class="ugroup ugroupsupper"><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i>&nbsp;Quản Trị&nbsp;<i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i></li>
								<li><a href="<?= base_url('/admin/dashboard.html') ?>">Quản trị</a></li>
								<?php
							}
							?>
							<li><a href="<?= base_url('/quan-ly-tin-rao.html') ?>">Quản lý tin rao</a></li>
							<li><a href="<?= base_url('/quan-ly-giao-dich.html') ?>">Giao dịch</a></li>
							<li><a href="<?= base_url('/thong-tin-ca-nhan.html') ?>">Thông tin cá nhân</a></li>
							<li><a href="<?= base_url('/doi-mat-khau.html') ?>">Đổi mật khẩu</a></li>
							<li><a href="<?=base_url('/dang-xuat.html')?>">Đăng xuất</a></li>
						</ul>
					</li>

					<?php
				}else{
					?>
					<li><a href="<?=base_url('/dang-nhap.html')?>"><i class="glyphicon glyphicon-user"></i>&nbsp;Đăng nhập</a></li>
					<?php
				}
				?>
				
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
	<!--/.container-fluid -->
</nav>
