<?php

include('header.php');

?>
<script src="capture.js"></script>
<div id="wrapper">
<video id="video"></video>
<img id="image" height="640px" width="480px" style="display: none;"/>

<button id="takepic" onclick="screenshot()">Take</button>
<div id="canvasvideo"></div>
 <input type='file' accept="image/*" onchange="readURL(this);" />
    <br/>
    <img id="image" height="640px" width="480px" style="display: none;"/>
</div>
<form id="img_filter">
	<label for="moustache" class="moustache">
	  <input type="radio" name="img_filter" value="photos/1.jpg" id="moustache" onchange="myimage('moustache')">
	  <img class="img" src="photos/1.jpg" height="128" width="128">
	</label>
	<label for="god" class="god">
	  <input type="radio" name="img_filter" value="photos/2.jpg" id="god" onchange="myimage('god')">
	  <img class="img" src="photos/2.jpg" height="128" width="128">
	</label>
	<label for="batman" class="batman">
	  <input type="radio" name="img_filter" value="photos/3.jpg" id="batman" onchange="myimage('batman')">
	  <img class="img" src="photos/3.jpg" height="128" width="128">
	</label>
	<label for="caca" class="caca">
	  <input type="radio" name="img_filter" value="photos/4.jpg" id="caca" onchange="myimage('caca')">
	  <img class="img" src="photos/4.jpg" height="128" width="128">
	</label>
	<br/>
   </form>

    <div class="videobox">
    <div id="canvas"></div>
    <form method='post' accept-charset='utf-8' name='form'>
      <input name='img' id='img' type='hidden'/>
      <input name='user' id='user' type='hidden' value='<?=$_SESSION['login'];?>'/>
    </form>
  </div>

<?php 

include_once('footer.php');

?>