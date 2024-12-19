<?php

namespace App\Controllers;

class WebsiteController extends BaseController
{
    public function videohome_website()
    {
        $data = [
            'title' => 'Website',
        ];
        return view('website/video_home', $data);
    }
}