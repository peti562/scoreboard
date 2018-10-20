<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RenderController extends Controller
{
    public function execute()
    {
      exec('cd ~/code/scoreboard/video_render; node start.js');

      return redirect('admin');
    }
}
