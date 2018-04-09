</div>
<footer class="main-footer">
<strong>Developed by MokoWeb</strong>
</footer>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/app.min.js"></script>
<script src="js/demo.js"></script>
<script>
	  $(function () {
	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": false,
	      "info": true,
	      "autoWidth": true
	    });
	    $('#confirm-delete').on('show.bs.modal', function(e) {
	      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	    });
	  });    
</script>
</body>
</html>