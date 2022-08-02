<script src="<?=site_url()?>private/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    
    <!-- Sidebar jquery-->
    <script src="<?=site_url()?>private/assets/js/sidebar-menu.js"></script>
    <script src="<?=site_url()?>private/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="<?=site_url()?>private/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?=site_url()?>private/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    
    
	
    <script src="<?=site_url()?>private/assets/js/datatable/datatable-extension/custom.js"></script>
	<script src="<?=site_url()?>private/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=site_url()?>private/assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
	
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?=site_url()?>private/assets/js/script.js"></script>

<script type="text/javascript" src="<?php echo site_url();?>public/editor/cazary.js"></script>
<script type="text/javascript" src="<?php echo site_url();?>public/editor/cazary.js"></script>
<script type="text/javascript">
    (function($, window){
        $(function($){
            $("textarea#id_cazary").cazary();
            $("textarea#id_cazary_minimal").cazary({
                commands: "MINIMAL"
            });
            $("textarea#id_cazary_full").cazary({
                commands: "FULL"
            });
        });
    })(jQuery, window);

</script>
   