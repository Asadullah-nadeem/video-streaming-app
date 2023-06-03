<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <style>
h1 {text-align: center;}
</style>
</head>
<body>
<nav class="navbar navbar-default">
</nav>
<div class="col-md-3"></div>
<div class="col-md-6 well">

    <h1 class="text-primary" style="color:red;" >Video Upload</h1>
    <hr style="border-top:5px dotted #000000;"/>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add Video</button>
    <br /><br />
    <hr style="border-top:3px solid #ccc;"/>
    <?php
    require 'conn.php';

    $query = mysqli_query($conn, "SELECT * FROM `video` ORDER BY `video_id` ASC") or die(mysqli_error());
    while($fetch = mysqli_fetch_array($query)){
        ?>
       <div class="col-md-12">
    <div class="col-md-4" style="word-wrap:break-word;">
        <br />
        <h4>Video Name</h4>
        <h5 class="text-primary"><?php echo $fetch['video_name']?></h5>
    </div>
    <div class="col-md-8">
        <video width="100%" height="240" controls>
            <source src="<?php echo $fetch['location']?>">
        </video>
    </div>
    <div class="col-md-12">
        <form action="delete_video.php" method="POST">
            <input type="hidden" name="video_id" value="<?php echo $fetch['video_id']; ?>">
            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
        </form>
    </div>
    <br style="clear:both;"/>
    <hr style="border-top:1px groovy #000;"/>
</div>

        <?php
    }
    ?>
</div>
<div class="modal fade" id="form_modal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="save_video.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Video Name</label>
                            <input type="text" name="video_name" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Video File</label>
                            <input type="file" name="video" class="form-control-file" required/>
                        </div>
                    </div>
                </div>
             
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
