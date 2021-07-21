<?php

namespace Src\Controllers;

// use Ilovepdf\CompressTask;
// use Ilovepdf\Ilovepdf;

/**
 * HomeController
 */
class HomeController {

    /**
     * __construct
     *
     * @return void
     */
    // private $ilovepdf;

    public function __construct () {
        // $this->ilovepdf = new Ilovepdf('project_public_47b70ceef8a4e453c83af06a2676229c_YKgg4caeb4d47c7a09834040c941e889f2e4b','secret_key_b5d70996232d86e38144dd786a60b02f_kH0xo7fd473da073f652e8696ad818617ae44');
        // ConvertApi::setApiSecret('eXki3UThS9egBP6T');
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

        // print_r($_FILES['file_upload']['name']);
        // die;


        // $result = ConvertApi::convert('pdf', ['File' => $_FILES["file_upload"]["tmp_name"]]);
        # save to file
        // $result->getFile()->save("/uploads"."/".$_FILES["file_upload"]["name"].'.pdf');

        if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
            // Create a new task
            // $myTaskCompress = $this->ilovepdf->newTask('compress');

            // $myTaskCompress = new CompressTask('project_public_47b70ceef8a4e453c83af06a2676229c_YKgg4caeb4d47c7a09834040c941e889f2e4b','secret_key_b5d70996232d86e38144dd786a60b02f_kH0xo7fd473da073f652e8696ad818617ae44');

            // $myTaskCompress->addFile(__DIR__.'/../../uploads/'.$_FILES["file_upload"]['name']);

            /*
            $myTask = $this->ilovepdf->newTask('officepdf');

            $myTask->addFile(__DIR__.'/../../uploads/'.$_FILES["file_upload"]['name']);

            // Execute the task
            $myTask->execute();

            $myTask->download();
            */
            $path = __DIR__.'/../../uploads/'.$_FILES["file_upload"]['name'];

            shell_exec(escapeshellcmd("python word.py -pf {$path}"));

            echo "The file ". htmlspecialchars( basename( $_FILES["file_upload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
