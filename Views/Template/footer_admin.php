    <script>
        const base_url = "<?= base_url(); ?>";
        const smoney = "<?= SMONEY; ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script type="text/javascript" src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/fontawesome.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <!-- Data tinymce plugin-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/tinymce/tinymce.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="<?= media(); ?>/js/plugins/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/jszip.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/buttons.html5.min.js"></script> -->
    <!-- Bootstrap Select -->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/bootstrap-select.min.js"></script>
    <!-- Grafics -->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/highcharts.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/exporting.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/export-data.js"></script>
    <!-- Datepicker-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/jquery-ui.min.js"></script>
    <!-- <script type="text/javascript" src="<?= media(); ?>/js/plugins/moment.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/moment.es.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/bootstrap-datetimepicker.min.js"></script> -->
    <!-- Sweet Alert plugin-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?= media(); ?>/js/functions_admin.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
  </body>
</html>