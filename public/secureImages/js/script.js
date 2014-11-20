var uploadModule = (function() {
    var s;

    function initDropzone() {
        Dropzone.options.myDropzone = {
            maxFilesize: '2',
            //acceptedFiles: "image/*",
            init: function() {
                this.on("success", function(file, response) {
                    self = this;
                    s.imageContainer.prepend(s.imageTemplate);
                    var fileName = file.name.toLocaleLowerCase();
                    alert(fileName);
                    $('.image:first').attr('data-id', response.id).css("background-image", "url('uploads/" + fileName + "')");

                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        window.setTimeout(function() { dropzoneSlideToggle(); }, 1000);
                        window.setTimeout(function() { self.removeAllFiles(); }, 1500);
                    }

                    $(document).trigger('imageUploaded');
                });
            }
        }
    }

    function dropzoneSlideToggle() {
        s.dropzoneContainer.slideToggle('slow');
    }

    function bindUIactions() {
        s.uploadButton.on('click', function(event) {
            event.preventDefault();
            dropzoneSlideToggle();
        });
    }

    return {
        settings: {
            uploadContainer: $('.uploadContainer'),
            uploadButton: $('.uploadButton'),
            dropzoneContainer: $('.dropzoneContainer'),
            imageContainer: $('.image-container'),
            imageTemplate: '<div class="image-wrap"><div class="image" data-toggle="modal" data-target="#imageModal"></div></div>'
        },
        init: function() {
            s = this.settings;
            bindUIactions();
            initDropzone();
        }
    }
})();

var imageModule = (function() {
    var s;

    function bindUIactions() {
        s.image.on('click', function(event) {
            event.preventDefault();
            createModal(this);
        });
        s.modalDeleteButton.on('click', function(event) {
            event.preventDefault();
            var image = $(this).closest('.modal-content').find('.image')
            deleteImage(image);
        });
    }

    function imageUploaded() {
        $(document).bind('imageUploaded', function() {
            $('.image').on('click', function(event) {
                event.preventDefault();
                createModal(this);
            });
        })
    }

    function createModal(self) {
        var image = $(self).clone();
        s.modalImageWrap.html(image);
    }

    function deleteImage(image) {
        $.get("?delete&id=" + image.data("id"));
        setTimeout('location.reload()', 50);
    }

    return {
        settings: {
            imageContainer: $('.image-container'),
            imageWrap: $('image-wrap'),
            image: $('.image'),
            modal: $('#imageModal'),
            modalImageWrap: $('.modal-image-wrap'),
            modalDeleteButton: $('.modal-delete-button')
        },
        init: function() {
            s = this.settings;
            bindUIactions();
            imageUploaded();
        }
    }
})();

(function() {
    uploadModule.init();
    imageModule.init();

}());
