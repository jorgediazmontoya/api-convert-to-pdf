<?php

namespace Src\Controllers;

use \ConvertApi\ConvertApi;

/**
 * HomeController
 */
class HomeController {

    /**
     * __construct
     *
     * @return void
     */
    public function __construct () {
        ConvertApi::setApiSecret('eXki3UThS9egBP6T');
    }

    /**
     * index
     *
     * Gretting
     * @return void
     */
    public function home () {
        require_once __DIR__.'/../../resources/views/index.php';
    }

    /**
     * upload
     *
     * Upload files
     * @return void
     */
    public function upload () {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);

        $result = ConvertApi::convert('pdf', ['File' => $_FILES["file_upload"]["tmp_name"]]);
        # save to file
        $result->getFile()->save("/uploads"."/".$_FILES["file_upload"]["name"].'.pdf');

        if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["file_upload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
