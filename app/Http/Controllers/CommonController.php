<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function breadcrumbData($page_slug)
    {
        $data = config('breadcrumb');
        return json_decode(json_encode($data[$page_slug], FALSE));
    }
}
