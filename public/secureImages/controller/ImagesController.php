<?php

class ImagesController {

    /**
     * @var View
     */
    private $view;

    /**
     * @var PDO
     */
    private $connection;

    /**
     * @param PDO $connection
     * @param View $view
     */
    public function __construct(PDO $connection, View $view)
    {
        $this->connection = $connection;
        $this->view = $view;
    }

    public function upload()
    {
        $storage = new \Upload\Storage\FileSystem('uploads');
        $file = new \Upload\File('file', $storage);

        $data = [
            'path' => 'uploads/' . strtolower($file->getNameWithExtension())
        ];

        $file->addValidations(array(
            new \Upload\Validation\Mimetype(['image/png', 'image/gif', 'image/jpeg', 'image/jpg', 'image/tiff']),

            new \Upload\Validation\Size('2M')
        ));


        // Try to upload file
        try {
            $file->upload();
            $image = new Image($this->connection, $data);
            $image->insert();
            header('Content-type: application/json');
            exit(json_encode(array('id' => $image->id)));
        } catch (\Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-type: text/plain');
            $errors = $file->getErrors();
            exit($errors[0]);
        }

    }

    public function delete($id) {
        $image = Image::find($this->connection, $id);
        try {
            $image->delete();
            unlink($image->path);
        } catch (\Exception $e) {
            return false;
        }

    }

}