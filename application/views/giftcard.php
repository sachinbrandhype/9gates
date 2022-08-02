<?php $this->load->view("hvwheader"); ?>


<div class="container-fluid gft-wrp">
	<div class="container">
		<div class="hlp-hdngs">
			<h2>Gifts Cards </h2>
		</div>
		<div class="row">
		    
		    
		    <?php if(!empty($gift)){
		            foreach($gift as $g){?>
			<div class="col-md-3">
				<div class="gft-bxs">
					<img src="<?=base_url()?>uploads/<?=$g->image?>" alt="" class="img-responsive">
					<div class="gft-cnts">
						<h3><?=$g->heading?> </h3>
						<p><?=$g->content?>. </p>
						<a href="#">Send <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
			
			<?php }} ?>
			
		</div>
	</div>
</div>

<?php $this->load->view("footer"); ?>