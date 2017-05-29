<!-- http://fancyapps.com/fancybox/ -->
<script type="text/javascript">
<?php  
$content = preg_replace( "/\r|\n/", "", $popupmessage);
?>

var content='<?php echo $content;?>';
$(document).ready(function() { 
	 $.fancybox({ 
        'padding' : 15,
        'content' : content
    });
});
</script>

