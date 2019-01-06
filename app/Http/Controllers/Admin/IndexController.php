<?php

namespace App\Http\Controllers\Admin;

//命令创建 自动出现这个空间
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index.index');
    }
}
