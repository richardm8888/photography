<?php

namespace App\Http\Controllers;

use JeroenG\Flickr\Flickr;
use JeroenG\Flickr\Api as FlickrAPI;
use Corcel\Post as Post;

class IndexController extends Controller
{
    public function indexAction(){
      $flickr = new Flickr(new FlickrAPI(env('FLICKR_API'), 'php_serial')); //, env('FLICKR_SECRET')));

      $websiteGalleries = Post::status('private')->get();

      /*$collections = $flickr->request('flickr.collections.getTree', [
        'user_id' => '150429213@N04',
      ]);
      $websiteGalleries = [];
      foreach ( $collections->collections['collection'] as $c ) {
        if ( $c['title'] == 'Website Galleries' ) {
          foreach ( $c['set'] as $gallery ) {
            $websiteGalleries[] = $gallery['id'];
          }
        }
      }*/

      $carousel = $flickr->request('flickr.photos.search', [
        'user_id' => '150429213@N04',
        'tags'  => 'cover_photo',
        'per_page' => 5,
        'extras' => 'url_l'
      ]);

      /*$galleries = $flickr->request('flickr.photosets.getList', [
        'user_id' => '150429213@N04',
        'per_page' => 20,
        'page' => 1,
        'primary_photo_extras' => 'url_m,url_l'
      ]);*/

      $posts = Post::type('post')->status('publish')->get();
      $cover_blogs = [];
      $blogs = [];
      foreach ( $posts as $p ) {
        if ( $p->meta->fifu_image_url ) {
          $cover_blogs[] = [
            'title' => $p->post_title,
            'slug' => $p->slug,
            'gallery_id' => $p->meta->gallery_id,
            'img'   => $p->meta->fifu_image_url,
            'snippet' => $p->meta->snippet,
            'date'  => date("dS F Y", strtotime($p->post_date)),
          ];
        } else {
          $blogs[] = [
            'title' => $p->post_title,
            'slug' => $p->slug,
            'gallery_id' => $p->meta->gallery_id,
            'date'  => date("dS F Y", strtotime($p->post_date)),
          ];
        }
      }

      return view('home', [
        //'galleries' => $galleries->photosets['photoset'],
        'carousel'  => $carousel->photos['photo'],
        'cover_blogs' => $cover_blogs,
        'blogs'     => $blogs,
        'websiteGalleries' => $websiteGalleries,
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
