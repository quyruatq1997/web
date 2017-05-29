<h3><?php echo $heading_title; ?> (<fb:comments-count href=<?php echo $url; ?>></fb:comments-count>)</h3>
<div class="row">
  <div class="col-sm-12">
	<div class="fb-comments" data-href="<?php echo $url; ?>" data-colorscheme="<?php echo $color_scheme; ?>" data-numposts="<?php echo $num_posts; ?>" data-order-by="<?php echo $order_by; ?>" data-width="100%"></div>
  </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $app_id; ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>