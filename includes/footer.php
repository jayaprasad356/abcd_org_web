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

<script>
$("#checkall").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});
</script> 
</body>
</html>