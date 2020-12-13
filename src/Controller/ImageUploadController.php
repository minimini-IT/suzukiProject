<?php
declare(strict_types=1);

namespace App\Controller;

class ImgUploadController extends AppController
{
    public function index()
    {
        /*
        if(isset($_FILES["upload"]["name"]))
        {
            $uploaddir = WWW_ROOT;
            $file = $_FILES["upload"]["tmp_name"];
            $file_name = $_FILES["upload"]["name"];

            $file_name_array = explode(".", $file_name);
            $extension = end($file_name_array);
            $new_image_name = rand() . "." . $extension;
            chmod($uploaddir."/uploads", 0777);
            $allowed_extension = array("jpg", "gif", "png");

            if(in_array($extension, $allowed_extension))
            {
                move_uploaded_file($file, $uploaddir."/uploads/".$new_imagge_name);
                $function_number = $_GET["CKEditorFuncNum"];
                $url = "/uploads/".$new_image_name;
                $message = "";
                echo "<script type='text/favascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
                return;
            }
        }
         */
    }
}
