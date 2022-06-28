<!DOCTYPE html>
<html>
  <head>
    <title>Full Stack | Dashboard</title>
    <!-- meta -->
    <?php echo @$_meta; ?>

    <!-- css --> 
    <?php echo @$_css; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/datepicker.min.js"></script>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- header -->
      <?php echo @$_header; ?> <!-- nav -->
      
      <!-- sidebar -->
      <?php echo @$_sidebar; ?>
      
      <!-- content -->
      <?php echo @$_content; ?> <!-- headerContent --><!-- mainContent -->
    
      <!-- footer -->
      <?php echo @$_footer; ?>
    
      <div class="control-sidebar-bg"></div>
    </div>

    <!-- js -->
    <?php echo @$_js; ?>
  </body>
  
</html>