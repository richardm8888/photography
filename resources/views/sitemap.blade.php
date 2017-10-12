<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://www.mossphotography.co.uk</loc>
    </url>
    <url>
        <loc>http://www.mossphotography.co.uk/contact</loc>
    </url>
    <url>
        <loc>http://www.mossphotography.co.uk/galleries</loc>
    </url>
    @foreach($galleries as $gallery)
        <url>
            <loc>http://www.mossphotography.co.uk/gallery/{{ $gallery->slug }}</loc>
        </url>
    @endforeach
    @foreach($posts as $post)
        <url>
            <loc>http://www.mossphotography.co.uk/gallery/{{ $post->slug }}</loc>
        </url>
    @endforeach
</urlset>
