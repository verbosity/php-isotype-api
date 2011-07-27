<?php
// a quick form for building isotypes using the isotype php api
?>

<form method="post" action="isotype.php" >
title: <input type="text" name="title">
<br />
icon type:  
	<select name="type">
		<option name="man">man</option>
	</select>
<br />
value:< input type="text" name="value">
<br />
colour sets
<input type="radio" name="colour" value="1" /> 1 <br/>
<input type="radio" name="colour" value="2" /> 2 <br/>
<input type="radio" name="colour" value="3" /> 3 <br/>
<br/>
<input type="submit" name="submit" value="submit">

</form>


