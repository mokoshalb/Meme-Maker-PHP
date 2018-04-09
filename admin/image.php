<?php require_once('header.php'); ?>
<style>
			html {
				-webkit-transition: background-color 1s;
				transition: background-color 1s;
			}
			.loading { min-height: 100%; position: fixed;}
			html.loading {
				background: #333 url('https://code.jquery.com/mobile/1.3.1/images/ajax-loader.gif') no-repeat 50% 50%;
				-webkit-transition: background-color 0;
				transition: background-color 0;
				height: 100%;
    				width: 100%;
			}
			body {
				-webkit-transition: opacity 1s ease-in;
				transition: opacity 1s ease-in;
			}
			html.loading body {
				opacity: 0;
				-webkit-transition: opacity 0;
				transition: opacity 0;
			}
			button {
				background: #00A3FF;
				color: white;
				padding: 0.2em 0.5em;
				font-size: 1.5em;
			}
</style>
<section class="content-header">
	<div class="content-header-left">
		<h1>View Images</h1>
	</div>
	<div class="content-header-right">
		<a href="image-add.php" class="btn btn-primary btn-sm">Add New</a>
		<input type="submit" class="delete_all btn btn-danger" name="bulk_delete_submit" value="Delete Selected"/>
	</div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-body table-responsive">
          <table id="example2" class="table table-bordered table-striped">
			<thead>
			    <tr>
			        <th><input type="checkbox" name="select_all" id="select_all" value=""/> S/N</th>
			        <th>Image</th>
			        <th>Action</th>
			    </tr>
			</thead>
            <tbody>
            	<?php
//get all images from database
$statement = $pdo->prepare("SELECT * FROM mokomeme_images ORDER BY images_id DESC");
$statement->execute();
$i=0;
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
//getting each image details
$i++;
$image_id = $row['images_id'];
$image_title = $row['images_title'];
$image_ext = $row['images_ext'];
?>
					<tr class="<?php echo $image_id; ?>">
	                    <td><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $image_id; ?>"/><?php echo $i; ?></td>
	                    <td><img src="../assets/images/<?php echo $image_title.'.'.$image_ext; ?>" alt="Image" class="img-responsive" style="height:80px"></td>
	                    <td>
<a href="#" class="btn btn-danger btn-xs" data-href="image-delete.php?id=<?php echo $image_id; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
	                    </td>
	                </tr>
            		<?php } ?>
            </tbody>
          </table>
        </div>
      </div>
</section>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
jQuery('.delete_all').on('click', function(e) { 
		var allVals = [];  
		$(".checkbox:checked").each(function() {  
			allVals.push($(this).attr('value'));
		});  
		if(allVals.length <=0)  
		{  
			alert("Please select atleast an image to delete.");  
		}  
		else {  
			WRN_PROFILE_DELETE = "Are you sure you want to delete these images?";  
			var check = confirm(WRN_PROFILE_DELETE);  
			if(check == true){  
				var join_selected_values = allVals.join(",");
				var html = document.getElementsByTagName('html')[0];
				html.className = 'loading';
				$.ajax({   
					type: "POST",  
					url: "image-delete-all.php",  
					cache:false,  
					data: 'ids='+join_selected_values,  
					success: function(response)  
					{
					html.className = html.className.replace(/loading/, '');
					location.reload();
					}   
				});
			}  
		}  
	});
</script>
<?php require_once('footer.php'); ?>