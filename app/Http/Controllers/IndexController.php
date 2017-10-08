<?php

namespace App\Http\Controllers;

use JeroenG\Flickr\Flickr;
use JeroenG\Flickr\Api as FlickrAPI;
use Corcel\Post as Post;
use Corcel\Page;

class IndexController extends Controller
{
    public function indexAction(){
      $flickr = new Flickr(new FlickrAPI(env('FLICKR_API'), 'php_serial')); //, env('FLICKR_SECRET')));

      $mainGalleries = Post::status('private')->get();

      $websiteGalleries = [];
      foreach ( $mainGalleries as $mg ) {
        if ( isset($mg->attachment[0]) ) {
          $websiteGalleries[] = [
            'slug' => $mg->slug,
            'post_title' => $mg->post_title,
            'img' => $mg->attachment[0]->guid,
          ];
        }
      }

      $carousel = $flickr->request('flickr.photos.search', [
        'user_id' => '150429213@N04',
        'tags'  => 'cover_photo',
        'per_page' => 5,
        'extras' => 'url_l'
      ]);

      $carousel = $flickr->request('flickr.photosets.getPhotos', [
        'user_id' => '150429213@N04',
        'photoset_id' => env('FLICKR_COVER_PHOTO_ALBUMID'),
        'per_page' => 10,
        'page' => 1,
        'extras' => 'url_l,url_o'
      ]);

      $posts = [];
      $rawPosts = Post::type('post')->status('publish')->get();
      foreach ( $rawPosts as $rp ) {

        $img = false;
        if ( isset($rp->attachment[0]) ) {
            $img = $rp->attachment[0]->guid;
        }
        $posts[] = [
          'title' => $rp->post_title,
          'slug' => $rp->slug,
          'gallery_id' => $rp->meta->gallery_id,
          'img'   => $img, //$rp->meta->fifu_image_url,
          'snippet' => $rp->meta->snippet,
          'date'  => date("dS F Y", strtotime($rp->post_date)),
          'rawDate' => $rp->post_date,
        ];
      }
      usort($posts, [$this, 'sortPostsByDate']);


      $cover_blogs = [];
      $blogs = [];
      foreach ( $posts as $p ) {
        if ( $p['img'] && count($cover_blogs) < 2 ) {
          $cover_blogs[] = $p;
        } else {
          if ( count($blogs) < 5 ) {
            $blogs[] = $p;
          }
        }
      }

      $about = Page::slug('about')->first();
      $carousel_images = Page::slug('home-carousel')->first();
      $carousel = [];
      foreach ( $carousel_images->attachment as $img ) {
        $carousel[] = ['url_l' => $img->guid];
      }

      return view('home', [
        'meta_title' => 'Moss Photography',
        //'galleries' => $galleries->photosets['photoset'],
        'carousel'  => $carousel, //->photoset['photo'],
        'about_me' => $about->post_content,
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

    function sortPostsByDate($a, $b) {
      if ($a['rawDate'] == $b['rawDate']) {
        return 0;
      } else {
        return $a['rawDate'] < $b['rawDate'] ? 1 : -1;
      }
    }
}
