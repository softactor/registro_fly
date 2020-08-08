<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleName">Image File</label>
                    <input type="file" class="form-control" id="image_file" placeholder="Add Image" name="image_file">
                    <span class="text-danger">Max file size below 8MB</span>
                </div>
            </div>
            <div class="col-md-6">
                <?php if (isset($editData->image_file) && !empty($editData->image_file)) { ?>
                    <a class="btn btn-app" id="file_view_id_i">
                        <span class="badge bg-red" onclick="delete_multimedia_file('<?php echo $editData->id; ?>', 'i')"><i class="fa fa-close"></i></span>
                        <img src="../resource/image/<?php echo $editData->image_file; ?>" width="50" />
                    </a>
                <?php }
                ?>
            </div>
        </div>                                    
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleName">Audio File</label>
                    <input type="file" class="form-control" id="audio_file" placeholder="Add Audio" name="audio_file">
                    <span class="text-danger">Max file size below 8MB</span>
                </div>
            </div>
            <div class="col-md-6">
                <?php if (isset($editData->audio_file) && !empty($editData->audio_file)) { ?>
                    <a class="btn btn-app" id="file_view_id_a">
                        <span class="badge bg-red" onclick="delete_multimedia_file('<?php echo $editData->id; ?>', 'a')"><i class="fa fa-close"></i></span>
                        <i class="fa fa-file-audio-o" aria-hidden="true"></i> Audio
                    </a>
<?php }
?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleName">Video File</label>
                    <input type="file" class="form-control" id="video_file" placeholder="Add Video" name="video_file">
                    <span class="text-danger">Max file size below 8MB</span>
                </div>
            </div>
            <div class="col-md-6">
<?php if (isset($editData->video_file) && !empty($editData->video_file)) { ?>
                    <a class="btn btn-app" id="file_view_id_v">
                        <span class="badge bg-red" onclick="delete_multimedia_file('<?php echo $editData->id; ?>', 'v')"><i class="fa fa-close"></i></span>
                        <i class="fa fa-file-video-o" aria-hidden="true"></i> Video
                    </a>
<?php }
?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="comment">Header:</label><span class="text-danger">&nbsp;Required</span>
            <textarea class="form-control" rows="2" id="header" name="header"><?php if (isset($editData->header) && !empty($editData->header)) {
    echo $editData->header;
} ?></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="comment">Footer:</label><span class="text-danger">&nbsp;Required</span>
            <textarea class="form-control" rows="2" id="footer" name="footer"><?php if (isset($editData->footer) && !empty($editData->footer)) {
    echo $editData->footer;
} ?></textarea>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="comment">Body:</label><span class="text-danger">&nbsp;Required</span>
    <textarea class="form-control" rows="6" id="body" name="body"><?php if (isset($editData->body) && !empty($editData->body)) {
    echo $editData->body;
} ?></textarea>
</div>