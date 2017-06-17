
<div class="container">
	<p>view file: /application/views/home.php</p>

    <?php foreach($blogposts as $blog):


    echo $blog->content;
echo "<br/>";
echo "<br/>";

    endforeach;
?>
</div>