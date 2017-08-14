<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JeroenG\Flickr\Flickr;
use JeroenG\Flickr\Api as FlickrAPI;
use Corcel\Post as Post;

class TagController extends Controller
{
    public function tagAction(Request $req, $slug){

      $flickr = new Flickr(new FlickrAPI(env('FLICKR_API'), 'php_serial'));

      $related = [];
      $relatedPosts = Post::taxonomy('post_tag', $slug)->get();
      foreach ( $relatedPosts as $p ) {
        $photos = $flickr->request('flickr.photosets.getPhotos', [
          'user_id' => '150429213@N04',
          'photoset_id' => $p->meta->gallery_id,
          'per_page' => 1,
          'page' => 1,
          'extras' => 'url_sq,url_t,url_s,url_m,url_l,url_o'
        ]);

        $related[] = [
          'title' => $p->post_title,
          'slug' => $p->slug,
          'img' => $photos->photoset['photo'][0]['url_m'],
        ];
      }


      return view('tag', [
        'title' => $slug,
        'related' => $related,
      ]);

    }
}
