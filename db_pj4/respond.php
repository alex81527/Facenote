<?php $a=159 ?>
<form action="test.php" method="get">
Respond: <input type="text" name="respond" size="80" > <br>
<input type="hidden" name="test" value= <?php echo $a; ?> >
<input type="submit" value="submit"><br><br>
</form>