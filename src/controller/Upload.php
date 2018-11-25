<?php

namespace  techadmin\controller;

use techadmin\support\controller\AbstractController;
use techadmin\service\upload\contract\Factory as Uploader;
use think\Request;

class Upload extends AbstractController
{
    public function image(Request $request, Uploader $uploader)
    {
        $data = [];

        $files = $uploader->multiple(...array_keys($_FILES));

        return json([
            'errno' => 0,
            'data' => array_column(array_values($files), 'save_name'),
        ]);
    }
}
