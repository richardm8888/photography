<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JeroenG\Flickr\Flickr;
use JeroenG\Flickr\Api as FlickrAPI;
use Corcel\Post as Post;
use Cache;

class GalleryController extends Controller
{
    public function galleriesAction(Request $req){
      $flickr = new Flickr(new FlickrAPI(env('FLICKR_API'), 'php_serial'));

      $posts = Post::type('post')->status('publish')->orderBy('post_date', 'desc')->paginate(12);
      $displayPosts = [];
      foreach ($posts as $p) {

        $photos = $flickr->request('flickr.photosets.getPhotos', [
          'user_id' => '150429213@N04',
          'photoset_id' => $p->meta->gallery_id,
          'per_page' => 1,
          'page' => 1,
          'extras' => 'url_sq,url_t,url_s,url_m,url_l,url_o'
        ]);

        $displayPosts[] = [
          'title' => $p->post_title,
          'slug'  => $p->slug,
          'img' => $photos->photoset['photo'][0]['url_m'],
        ];
      }
      return view('galleries', [
        'meta_title' => 'Moss Photography - Galleries',
        'posts' => $posts,
        'displayPosts' => $displayPosts,
      ]);

    }

    public function galleryAction(Request $req, $slug){

      $page = $req->get('page') ?: 1;
      $page_cache_key = $slug . '_page_' . $page;
      if (Cache::has($page_cache_key)) {
        $view = Cache::get($page_cache_key);
      } else {
        $flickr = new Flickr(new FlickrAPI(env('FLICKR_API'), 'php_serial'));

        $post = Post::slug($slug)->first();
        if ( !$post ) {
          return redirect('/galleries');
        }
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

        $info = $flickr->request('flickr.photosets.getPhotos', [
          'user_id' => '150429213@N04',
          'photoset_id' => $id,
          'per_page' => 500,
        ]);

        $displayPhotos = [];
        $carousel = [];
        for ( $i=1; $i<=$info->photoset['pages']; $i++ ) {

          $cache_key = $slug . '_photos_' . $i;
          if (Cache::has($cache_key)) {
            $photos = Cache::get($cache_key);
          } else {
            $photos = $flickr->request('flickr.photosets.getPhotos', [
              'user_id' => '150429213@N04',
              'photoset_id' => $id,
              'per_page' => 500,
              'page' => $i,
              'extras' => 'url_sq,url_t,url_s,url_m,url_l,url_o'
            ]);

            Cache::add($cache_key, $photos, (60*60*24));
          }

          foreach ( $photos->photoset['photo'] as $p ) {
            if ( $p['isprimary'] ) {
              $carousel[] = $p;
            } else {
              $displayPhotos[] = $p;
            }
          }
        }

        // Most recent photos first
        arsort($carousel);
        arsort($displayPhotos);
        $numPages = ceil(count($displayPhotos)/50);
        $startOffset = ($page-1)*50;
        $displayPhotos = array_splice($displayPhotos, $startOffset, 50);

        if ( $page > 1 ) {
          $carousel = [];
        }

        $pages = [];
        for( $j=1; $j<=$numPages; $j++ ) {
          $pages[] = $j;
        }

        $view = [
          'meta_title' => 'Moss Photography - ' . $post->post_title,
          'carousel'  => $carousel,
          'displayPhotos' => $displayPhotos,
          'title' => $post->post_title,
          'tags' => $tags,
          'related' => $related,
          'content' => $post->post_status == 'private' ? false : $post->meta->snippet,
          'pages' => $pages,
          'page' => $page,
        ];

        Cache::add($page_cache_key, $view, (60*60*24));
      }

      $view['mobile'] = true;
      return view('gallery', $view);

    }
}
