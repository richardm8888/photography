<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JeroenG\Flickr\Flickr;
use JeroenG\Flickr\Api as FlickrAPI;
use Corcel\Post as Post;

class GalleryController extends Controller
{
    public function galleryAction(Request $req, $slug){

      $flickr = new Flickr(new FlickrAPI(env('FLICKR_API'), 'php_serial')); //, env('FLICKR_SECRET')));

      $post = Post::slug($slug)->first();
      $id = $post->meta->gallery_id;

      $postTags = $post->taxonomies()->get();

      $tags = [];
      $related = [];
      $relatedPostIds = [];
      foreach ( $postTags as $t ){
        if ( $t->taxonomy == 'post_tag' ) {
          $tags[] = ['tag' => $t->name, 'slug' => $t->slug];

          $relatedPosts = Post::taxonomy('post_tag', $t->name)->get();
          foreach ( $relatedPosts as $p ) {
            if ( $p->ID != $post->ID && !in_array($p->ID, $relatedPostIds) ) {
              $relatedPostIds[] = $p->ID;
              $related[] = [
                'title' => $p->post_title,
                'slug' => $p->slug,
              ];
            }
          }
        }
      }

      $photos = $flickr->request('flickr.photosets.getPhotos', [
        'user_id' => '150429213@N04',
        'photoset_id' => $id,
        'per_page' => 50,
        'page' => 1,
        'extras' => 'url_sq,url_t,url_s,url_m,url_l,url_o'
      ]);

      $displayPhotos = [];
      $carousel = [];
      foreach ( $photos->photoset['photo'] as $p ) {
        if ( $p['isprimary'] ) {
          $carousel[] = $p;
        } else {
          $displayPhotos[] = $p;
        }
      }

      foreach ( $photos->photoset['photo'] as $p ) {
        //echo "<img src='{$p['url_s']}' /><br />";
      }
      //$flickr->echoThis('helloworld');

      return view('gallery', [
        'carousel'  => $carousel,
        'displayPhotos' => $displayPhotos,
        'title' => $post->post_title,
        'tags' => $tags,
        'related' => $related,
      ]);

    }
}
