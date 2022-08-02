<?php $this->load->view("hvwheader"); ?>

<div class="container-fluid hlp-wrp">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="src-bxs">
					<form action="/action_page.php">
				      <input type="text" placeholder="Search.." class="sk-gte" name="search">
				      <button class="btn gt-btns1" type="submit">Search</button>
				    </form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid hlp-wrp1">
	<div class="container">
		<div class="hlp-hdngs">
			<h2>Help Categories </h2>
		</div>
		<div class="row ct-rw">
			<div class="col-md-2">
				<div class="ctg-bx1">
					<a href="#">
						<div class="ctg-bxs">
							<i class="fa fa-shopping-cart"></i>
							<p>Order Related</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="ctg-bx1">
					<a href="#">
						<div class="ctg-bxs">
							<i class="fa fa-truck"></i>
							<p>Shopping</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="ctg-bx1">
					<a href="#">
						<div class="ctg-bxs">
							<i class="fa fa-user"></i>
							<p>Nykaa Account </p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="ctg-bx1">
					<a href="#">
						<div class="ctg-bxs">
							<i class="fa fa-credit-card"></i>
							<p>Payments </p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="ctg-bx1">
					<a href="#">
						<div class="ctg-bxs">
							<i class="fa fa-info-circle"></i>
							<p>Others </p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="ctg-bx1">
					<a href="#">
						<div class="ctg-bxs">
							<i class="fa fa-shopping-cart"></i>
							<p>Sell on 9Gates </p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="ctg-bx1">
					<a href="#">
						<div class="ctg-bxs">
							<i class="fa fa-life-ring"></i>
							<p>Write to us </p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view("footer"); ?>