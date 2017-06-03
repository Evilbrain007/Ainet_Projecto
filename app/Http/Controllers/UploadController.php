<?php
/**
 * Created by PhpStorm.
 * User: sorai
 * Date: 25-Apr-17
 * Time: 21:56
 */

namespace App\Http\Controllers;


class UploadController
{
    /*
    $file_destination = destino ode ficheiro ficara armazenado;
    $file_path = caminho do ficheiro a ser carregado -> aceder ao ficheiro que esta no array $_FILES*/
    private $success_flag = 1;
    private $filename;
    private $file_type;

    /**
     * UploadController constructor.
     * @param $filename
     */
    public function __construct()
    {
        $this->filename = $_FILES['upload_file']['name'];
        $this->file_type = pathinfo($this->filename, PATHINFO_EXTENSION);
    }


}