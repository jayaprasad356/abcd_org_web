<footer class="app-footer">
      <div class="row">
        <div class="col-xs-12">
          <div class="footer-copyright">Copyright © <?php echo date('Y');?> <a href="https://darwinbark.com/" target="_blank">Darwinbark Technology</a>. All Rights Reserved.</div>
        </div>
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript" src="assets/js/vendor.js"></script> 
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/toastr.min.js"></script>
<!-- overlayScrollbars -->
<script src="https://stockearn.in/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- DataTables -->
<script src="https://stockearn.in/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://stockearn.in/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://stockearn.in/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>


<script>
$("#checkall").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});
</script> 

<script type="text/javascript">
  
$(function() {
    $('#status').change(function() {
        this.form.submit();
    });
});

</script>

</body>
</html>