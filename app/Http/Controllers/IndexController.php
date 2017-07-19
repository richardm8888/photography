<?php

namespace App\Http\Controllers;

use JeroenG\Flickr\Flickr;
use JeroenG\Flickr\Api as FlickrAPI;

class IndexController extends Controller
{
    public function indexAction(){
      $flickr = new Flickr(new FlickrAPI(env('FLICKR_API'), 'php_serial')); //, env('FLICKR_SECRET')));

      $galleries = $flickr->request('flickr.photosets.getList', [
        'user_id' => '150429213@N04',
        'per_page' => 20,
        'page' => 1,
        'primary_photo_extras' => 'url_m'
      ]);

      return view('home', [
        'galleries' => $galleries->photosets['photoset']
      ]);

      /*
      foreach ( $galleries->photosets['photoset'] as $g ) {
        echo "<a href='/gallery/" . $g['id'] . "'>";
        echo "<img src='{$g['primary_photo_extras']['url_m']}' />";
        //echo "<br />{$g['title']['_content']}";
        echo "</a>";
      }
      */
      
      //$flickr->echoThis('helloworld');
    }
}
