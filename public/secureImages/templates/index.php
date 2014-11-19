<div class="uploadContainer">
    <button class="uploadButton btn btn-primary">Upload Images</button>
    <div class="dropzoneContainer">
        <form action="index.php" class="dropzone" id="myDropzone"></form>
    </div>

</div>

<div class="image-container">

<?php if (isset($this->data['images'])): ?>
<?php foreach ($this->data['images'] as $image): ?>
    <div class="image-wrap">

        <div class="image" data-toggle="modal" data-target="#imageModal" data-id="<?= $image->id; ?>" style="background-image: url(<?= $image->path; ?>)"></div>
    </div>
<?php endforeach; ?>
<?php endif; ?>

</div>




<div class="modal fade" id="imageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-image-wrap"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger modal-delete-button">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



