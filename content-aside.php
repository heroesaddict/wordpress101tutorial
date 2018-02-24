<article id = "post-<?php the_ID(); ?>"   <?php post_class();?>
	<h3>Aside Post: <a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
	<small>Posted on:<?php the_time('F j,Y'); ?> at <?php the_time('g:i a'); ?>, in <?php the_category(); ?></small>
</article>
<hr>
