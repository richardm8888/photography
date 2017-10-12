<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Post as Post;

class SitemapController extends Controller
{
    public function xmlAction(Request $req){

      $posts = Post::type('post')->status('publish')->get();
      $galleries = Post::status('private')->get();

      return response()
        ->view('sitemap', ['posts' => $posts, 'galleries' => $galleries])
        ->header('Content-Type', 'text/xml');

    }
}
