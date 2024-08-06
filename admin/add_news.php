<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sell newss</title>
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<style>	

.imageThumb {
	max-height: 75px;
	border: 0px solid;
	padding: 1px;
	cursor: pointer;
}
.pip {
	display: inline-block;
	margin: 10px 10px 0 0;
}
.remove {
	display: block;
	background: #444;
	border: 1px solid #444;
	color: white;
	text-align: center;
	cursor: pointer;
}
.remove:hover {
	background: white;
	color: black;
}
.img-thumbnail {
	padding: 4px;
	line-height: 1.42857;
	background-color: #fff;
	border: 1px solid #ddd;
	border-radius: 3px;
	-webkit-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
	display: inline-block;
	max-width: 100%;
	height: auto;
}
img {
	vertical-align: middle;
}

</style>
</head>
<?php
include 'db.php';
$page = isset($_GET['page']) ? $_GET['page'] : '';if(isset($_GET['status'])){
	$status = $_GET['status'];
	$status_id = $_GET['statusid'];
	if($status=='block')
	{
		mysqli_query($conn,"update news set status='unblock' where id='$status_id'");
	}
	else if($status=='unblock')
	{
		mysqli_query($conn,"update news set status='block' where id='$status_id'");
	}
}
// Retrieve the form data from the database
$stmt = $conn->prepare("SELECT * FROM news");
$stmt->execute();
$result = $stmt->get_result();

// Get the column names
$field_names = array();
while ($field_info = $result->fetch_field()) {
    $field_names[] = $field_info->name;
}

// Store the results in an array
$submissions = array();
while ($row = $result->fetch_assoc()) {
    $submissions[] = $row;
}
?>
<body>
	<?php include 'admin_nav.php';?>
	<?php if($page=='') { ?>
	<div class="px-3">
        <!-- Start Content-->
		<div class="container-fluid">			
			<!-- start page title -->
			<div class="py-3 py-lg-4">
				<div class="row">
					<div class="col-lg-10">
					</div>
					<div class="col-lg-2">
					   <div class="d-none d-lg-block">
						<a href="add_news.php?page=add" class="btn btn-outline-primary waves-effect waves-light">Add news</a>
					   </div>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="header-title pb-2">Add news </h4>
							<div class="table-responsive">
							<table id="selling-car-info" class="table dt-responsive contextual table-bordered nowrap w-100 selling-news-info">
								<thead>
									<tr>
        							    <?php foreach ($field_names as $field_name) {?>
        							        <th id="selling-news-info"><?= ucfirst($field_name)?></th>
        							    <?php }?>
        							    <th>Action</th>
        							</tr>
								</thead>						
								<tbody>
								<?php
								$a=1;
									$sql_about="Select * from news order by id desc";
									$result_about=mysqli_query($conn,$sql_about);							
									while($row_about=mysqli_fetch_assoc($result_about))
									{							
									$id       		 	= $row_about['id']; 			
             						$news_date			= $row_about['news_date'];    	
             						$image	   	 		= $row_about['image'];
             						$title				= $row_about['title'];
             						$sub_title	   	 	= $row_about['sub_title'];
             						$description	   	= $row_about['description'];
             						$status  		 	= $row_about['status'];			
								?>
								<tr>
									<td><?php echo $a; ?></td>							
									<td><?php echo $news_date; ?></td>
									<td>
								    <div class="image-container">
								        <?php if ($image) { ?>
								            <a href="<?php echo 'Add news/'.$image?>" data-fancybox="images-<?php echo $row_about['id']?>" data-caption="<?php echo $image?>">
								                <img src="<?php echo 'Add news/'.$image?>" width="100" height="100" alt="img">
								            </a>
								            <script>
								                $(document).ready(function() {
								                    $('[data-fancybox="images-<?php echo $row_about['id']?>"]').fancybox({
								                        loop: true,
								                        toolbar: true,
								                        buttons: [
								                            "slideShow",
								                            "fullScreen",
								                            "thumbs",
								                            "close"
								                        ]
								                    });
								                });
								            </script>
								        <?php } else { ?>
								            <p>No images uploaded.</p>
								        <?php } ?>
								    </div>
									</td>
									<td><?php echo $title; ?></td>
									<td><?php echo $sub_title; ?></td>
									<td><?php echo $description; ?></td>
									<td>
									    <?php if($status == 'unblock'){ ?>
									        <a href="add_news.php?status=<?php echo $status; ?>&statusid=<?php echo $id; ?>" class="badge bg-success">Approved</a>
									    <?php } elseif($status == 'block'){ ?>
									        <a href="add_news.php?status=<?php echo $status; ?>&statusid=<?php echo $id; ?>" class="badge bg-danger">Denied</a>
									    <?php } else { ?>
									        <span class="badge bg-warning">Pending</span>
									    <?php } ?>
									</td>								
									<td>
										<a class="btn btn-primary btn-sm" href="add_news.php?page=edit&edit_id=<?php echo $id; ?>" title="Edit">Edit</a>
										<a class="btn btn-danger btn-sm" href="add_news.php?page=delete&delete_id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to Remove?');" title="Delete">Delete</a>
									</td>
								</tr>
								<?php $a++; } ?>
								</tbody>
							</table>
							</div>
						</div> <!-- end newsd body-->
					</div> <!-- end newsd -->
				</div><!-- end col-->
			</div>
			<!-- end row-->
		</div><!-- end col-->
	</div>
	<?php } ?>
	<?php if($page=='add') { ?>
	
        <!-- Start Content-->
		<div class="container-fluid">			
			<div class="py-3 py-lg-4">
				<div class="row">
					<div class="col-lg-6">
						<h4 class="page-title mb-0">Add news</h4>
					</div>
					<div class="col-lg-6">
					   <div class="d-none d-lg-block">
						<ol class="breadcrumb m-0 float-end">
							<li class="breadcrumb-item"><a href="add_news.php">add_news</a></li>
							<li class="breadcrumb-item active">adding news</li>
						</ol>
					   </div>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<h2 class=" text-center pb-2">Add news</h2>
							<hr>
							<form class="needs-validation" method="post" action="add_news.php?page=insert" enctype="multipart/form-data">
								<div class="mb-3">
								  <label for="news_date" class="form-label fw-bold">News Date</label>
								  <input type="date" class="form-control" name="news_date" id="news_date">
								</div>								
								<div class="mb-3">
									<label for="image" class="form-label fw-bold">News Image</label>
									<input type="file" class="form-control" name="image" id="image">
								</div>
								<div class="mb-5">
									<label for="title" class="form-label fw-bold">News Title</label>
									<textarea class="form-control ckeditor" name="title" id="title"></textarea>
								</div>
								<div class="mb-5">
									<label for="sub_title" class="form-label fw-bold">News Sub-Title</label>
									<textarea class="form-control ckeditor" name="sub_title" id="sub_title"></textarea>
								</div>
								<div class="mb-5">
									<label for="description" class="form-label fw-bold">News Description</label>
									<textarea class="form-control ckeditor" name="description" id="description"></textarea>
								</div>
								<div class="mt-4">
		                        	<button class="btn btn-primary" type="submit">Update News</button>
		                        	<a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="btn btn-primary">Back</a>
		                        </div>
							</form>
						</div> <!-- end newsd-body-->
					</div> <!-- end newsd-->
				</div> <!-- end col-->
			</div><!-- end row-->
		</div>
	</div>
	<?php }?>
	
<?php 
	if($page=='insert'){ 
		$news_date 			= $_POST['news_date'];
		$title				= $_POST['title'];
		$sub_title			= $_POST['sub_title'];
		$description		= $_POST['description'];		
		$file_type1 		= $_FILES['image']['type'];
		$file_tmp1 			= $_FILES['image']['tmp_name'];
		$file_nm1 			= $_FILES['image']['name'];
		$file_nm1 			= str_replace(" ","-",$file_nm1);
		if($file_nm1){
			$mimetype = @mime_content_type($_FILES['image']['tmp_name']);
			if(in_array($mimetype, array('image/jpeg', 'image/JPEG', 'image/JPG', 'image/jpg', 'image/gif', 'image/png', 'image/PNG')))
			{
				$folder1 = "Add news/";
				$img_filename1 = $folder1.time().$file_nm1;
				$image = time().$file_nm1;
				move_uploaded_file($file_tmp1,$img_filename1);
			} else {
				$image = '';
			}
		} else {
			$image = '';
		}		
		$sql_insert = "INSERT into news SET 
			`news_date` 			= '".$news_date."', 
			`image` 		= '".$image."', 
			`title` 		= '".$title."',
			`sub_title` 	= '".$sub_title."',
			`description` 	= '".$description."'";
		
		$result = mysqli_query($conn,$sql_insert);
		echo "<script>alert('Row inserted successfully.'); window.location.href='add_news.php';</script>";
	}?>

<?php
if ($page == 'edit') {
    $edit_id = $_GET['edit_id'];
    $sql_select = "SELECT * FROM news WHERE id = '$edit_id'";
    $result_add_news = mysqli_query($conn, $sql_select);
    $row_add_news = mysqli_fetch_assoc($result_add_news);
    $news_date = $row_add_news['news_date'];
    $image = $row_add_news['image'];
    $title = $row_add_news['title'];
    $sub_title = $row_add_news['sub_title'];
    $description = $row_add_news['description'];
?>
<div class="container-fluid">
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Edit news</h4>
            </div>
            <div class="col-lg-6">
               <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="add_news.php">Add news</a></li>
                    <li class="breadcrumb-item active">Edit news</li>
                </ol>
               </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center pb-2">Edit News</h2>
                    <hr>
                    <form class="needs-validation" method="post" action="add_news.php?page=update&update_id=<?php echo $edit_id;?>" enctype="multipart/form-data">
                        <div class="mb-3">
						    <label for="news_date" class="form-label fw-bold">News Date</label>
						    <input type="date" class="form-control" name="news_date" id="news_date" value="<?php if(isset($news_date)) echo $news_date; ?>">
						</div>
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">News Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <?php if ($image) { ?>
                                <img src="<?php echo 'Add news/'.$image ?>" width="100" height="100" alt="current image">
                            <?php } ?>
                        </div>
                        <div class="mb-5">
                            <label for="title" class="form-label fw-bold">News Title</label>
                            <textarea class="form-control ckeditor" name="title" id="title"><?php echo htmlspecialchars($title); ?></textarea>
                        </div>
                        <div class="mb-5">
                            <label for="sub_title" class="form-label fw-bold">News Sub-Title</label>
                            <textarea class="form-control ckeditor" name="sub_title" id="sub_title"><?php echo htmlspecialchars($sub_title); ?></textarea>
                        </div>
                        <div class="mb-5">
                            <label for="description" class="form-label fw-bold">News Description</label>
                            <textarea class="form-control ckeditor" name="description" id="description"><?php echo htmlspecialchars($description); ?></textarea>
                        </div>
                        <div class="mt-4">
                        	<button class="btn btn-primary" type="submit">Update News</button>
                        	<a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

<?php
if ($page == 'update') {
    $update_id = $_GET['update_id'];
    $news_date = $_POST['news_date'];
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $description = $_POST['description'];
    $file_type1 = $_FILES['image']['type'];
    $file_tmp1 = $_FILES['image']['tmp_name'];
    $file_nm1 = $_FILES['image']['name'];
    $file_nm1 = str_replace(" ","-",$file_nm1);

    if ($file_nm1) {
        $mimetype = @mime_content_type($_FILES['image']['tmp_name']);
        if (in_array($mimetype, array('image/jpeg', 'image/JPEG', 'image/JPG', 'image/jpg', 'image/gif', 'image/png', 'image/PNG'))) {
            $folder1 = "Add news/";
            $img_filename1 = $folder1.time().$file_nm1;
            $image = time().$file_nm1;
            move_uploaded_file($file_tmp1, $img_filename1);
        } else {
            $image = '';
        }
    } else {
        $image = '';
    }

    if ($image == '') {
        $sql_update = "UPDATE news SET 
            `news_date` = '".$news_date."',
            `title` = '".$title."', 
            `sub_title` = '".$sub_title."', 
            `description` = '".$description."' 
            WHERE id = '".$update_id."'";
    } else {
        $sql_update = "UPDATE news SET 
            `news_date` = '".$news_date."', 
            `image` = '".$image."', 
            `title` = '".$title."', 
            `sub_title` = '".$sub_title."', 
            `description` = '".$description."' 
            WHERE id = '".$update_id."'";
    }
    
    $result = mysqli_query($conn, $sql_update);
    echo "<script>alert('Row updated successfully.'); window.location.href='add_news.php';</script>";
}
?>

<!---delete -->
<?php if($page=='delete'){
	$delete_id = $_GET['delete_id'];
	$sql = "DELETE FROM news WHERE id = '$delete_id'";
	$result_library = mysqli_query($conn,$sql);
	echo "<script>window.location.href='add_news.php'</script>";
}?>
<?php include('footer.php');?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor', {
    height: 300,
    filebrowserUploadUrl: 'upload.php'
  });
</script>
<script>
  CKEDITOR.replace('description', {
    enterMode: CKEDITOR.ENTER_BR
  });
  CKEDITOR.replace('title', {
    enterMode: CKEDITOR.ENTER_BR
  });
  CKEDITOR.replace('sub_title', {
    enterMode: CKEDITOR.ENTER_BR
  });
</script>
<script>
$(document).ready(function() {
	if (window.File && window.FileList && window.FileReader) {
		$("#blog_image").on("change", function(e) {
			var files = e.target.files,
			filesLength = files.length;
			for (var i = 0; i < filesLength; i++) {
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				var file = e.target;
				$("<span class=\"pip\">" +
					"<img class=\"imageThumb img-thumbnail\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +"<span class=\"remove\">Remove</span>" +
					"</span>").insertAfter("#blog_image");
					$(".remove").click(function(){
						$(this).parent(".pip").remove();
					});
				});
				fileReader.readAsDataURL(f);
			}
		});
	} else {
		alert("Your browser doesn't support to File API")
	}
	/* image preview end */	
});

function deleteImage(imageName, imageType) {
    if (confirm("Are you sure you want to delete this image?")) {
        // Send an AJAX request to delete the image
        $.ajax({
            type: "POST",
            url: "delete_image2.php",
            data: { image: imageName, type: imageType },
            success: function(response) {
                // Remove the image from the page
                $('img[src="Add news/' + imageName + '"]').remove();
                $('button[onclick="deleteImage(\'' + imageName + '\', \'' + imageType + '\')"]').remove();
                alert(response);
            }
        });
    }
}
</script>
</body>