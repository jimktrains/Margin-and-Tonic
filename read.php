<?php 
	if(!isset($_COOKIE['user_name'])) {
		// get out of here, stalker
		$home = 'http://' . preg_replace('/\/[^\/]*$/', '', $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		header("Location: $home");
	}

	include "utils.php";
?><!DOCTYPE html>
<html>
<head>
	<title>Margin Tonic: Comments in the margins of your favorite books</title>
	<link type="text/css" href="css/smoothness/jquery-ui-1.8.11.custom.css" rel="Stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/colorbox.css" />	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.colorbox.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
</head>
<body>
<div class="dictionary">
	<?php include "pane/dictionary.html"; ?>
</div>
<div class="colmask threecol">
	<div class="colright">
	<div class="colmid">
		<div class="colleft">
			<p style="top:1%;" class="triangle-isosceles right">The entire appearance is created only with CSS.</p>
			<div class="col1">
				<!-- Column 1 start -->
				<?php show_book(); ?>
				<!-- Column 1 end -->
			</div>
			<div class="col2">
				<!-- Column 2 start -->
				<?php //show_comments(); ?>
				<p class="triangle-isosceles small">10</p>
				<!-- Column 2 end -->
			</div>
			<div class="col3" id="nav">
				<!-- Column 3 start -->
				<img src="images/tools.png" alt="tools" id="tools"/><br/>
				<img src="images/define.png" alt="define" id="define"/><br/>
				<img src="images/library.png" alt="library" id="library"/>
				<!-- Column 3 end -->
			</div>
		</div>
	</div>
	</div>
</div>
<!-- colorbox forms -->
<div style="display:none">
<form id="comment_form" action="/api/comment" method="post">
    <input type="hidden" name="user_id" value="<?=$_COOKIE['user_name']?>"/>
    <input type="hidden" name="book_id" value="2" />
    <input type="hidden" name="y_percent" id="y_pos" value="39.54" />
    Comment: <textarea name="comment"></textarea><br />
    <button>Scribble</button>
</form>
</div>
<script>
	$("#define").click(function () { 
		if($(".dictionary").is(":hidden")){
			$(".dictionary").slideDown("slow");
		} else {
			$(".dictionary").hide();
		}
	});

    $("p").click(function() {
    	//finds ypos in pixels
    	var element = $(this).get(0);
		$("#ypos").val(findYPos(element));
    	$.colorbox({
    		inline: true,
    		href: "#comment_form",
    		transition: "none",
    		opacity: 0.5
    	})
    });

    $(window).scroll( function () {
    	$.colorbox.close();
    });

    function findYPos(obj) {
    	var ypos = 0;

    	if(obj.offsetParent) {
    		do {
    			ypos += obj.offsetTop;
    		} while (obj = obj.offsetParent);
    	}

    	return ypos;
    }

	/*var pressTimer;

	$("span").mouseup(function(){
		clearTimeout(pressTimer);
		// Clear timeout
		return false;
	}).mousedown(function(){
		// Set timeout
		pressTimer = window.setTimeout(function() { 
			alert($(this).val());
		},1000);
		return false; 
	});*/

</script>
</body>
</html>
