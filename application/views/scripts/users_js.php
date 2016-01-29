
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo asset_backend() ?>plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo asset_backend() ?>plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo asset_backend() ?>plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->


<script src="<?php echo asset_backend() ?>pages/datatables.js"></script>

<script>
jQuery(document).ready(function() {       
   App.init();
   TableAjax.init();
});
</script>