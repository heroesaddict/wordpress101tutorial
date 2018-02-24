<article id = "post-<?php the_ID(); ?>"   <?php post_class();?>
	<h3>Image Post:<?php the_title(); ?></h3>
	<a href="<?php the_permalink()?>"?>Read more...</a>
	<div class="thumbnail-img"><?php the_post_thumbnail('thumbnail'); ?></div>
</article>
<hr>
