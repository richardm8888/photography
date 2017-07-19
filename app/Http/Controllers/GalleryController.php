<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JeroenG\Flickr\Flickr;
use JeroenG\Flickr\Api as FlickrAPI;

class GalleryController extends Controller
{
    public function galleryAction(Request $req, $id){

      $flickr = new Flickr(new FlickrAPI(env('FLICKR_API'), 'php_serial')); //, env('FLICKR_SECRET')));

      $photos = $flickr->request('flickr.photosets.getPhotos', [
        'user_id' => '150429213@N04',
        'photoset_id' => $id,
        'per_page' => 20,
        'page' => 1,
        'extras' => 'url_sq,url_t,url_s,url_m,url_o'
      ]);

      foreach ( $photos->photoset['photo'] as $p ) {
        if ( $p['isprimary'] ) {
            echo "<img src='{$p['url_o']}' /><br /><br />";          
        }
      }

      foreach ( $photos->photoset['photo'] as $p ) {
        echo "<img src='{$p['url_s']}' /><br />";
      }
      //$flickr->echoThis('helloworld');
    }
}
