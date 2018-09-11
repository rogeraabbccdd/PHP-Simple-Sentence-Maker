<head>
	<title>Title</title>
</head>

<body>
	<div id="sounds"></div>
	<div id="audios"></div>
	<br>
	<input type="button" onclick="playsnd()" value="Play">
	<input type="button" onclick="remall()" value="Remove">
	<input type="button" onclick="exp()" value="Export">
	<hr>
	<?php
		// scan dir
		$files = scandir('./sounds/');
		foreach($files as $f) {
			// ignore "." are ".." and remove ".mp3"
			if($f != "." && $f != ".." ) 
				echo "<input type='button' onclick='addsnd(\"".substr($f, 0, -4)."\")' value='".substr($f, 0, -4)."'>";
		}
	?>
	<script type="text/javascript" src="./jquery-3.1.1.min.js"></script>
	<script>
		// sound id
		var sounds = 0;
		
		<?php
			// import and export
			$snds = 0;
			if(!empty($_GET["s"]))
			{
				$snd = explode(";", $_GET["s"]);
				
				foreach($snd as $s)
				{
					if(!empty($s))	echo "addsnd('".$s."');";
				}
			}
		?>
		
		// add sound to play query
		function addsnd(s)
		{
			sounds++;
			
			var add = "<input type='button' onclick='remsnd(\""+sounds+"\")' value='"+s+"' class='audio-list' id='snd"+sounds+"'>";
			$("#sounds").append(add);
			
			add = "<audio src='sounds/"+s+".mp3' class='audio' onended='playsnd()' id='aud"+sounds+"'>";
			$("#audios").append(add);
		}
		
		// remove
		function remsnd(s)
		{
			$("#snd"+s).remove();
			$("#aud"+s).remove();
		}
		
		// playing id
		var play = 0;
		function playsnd()
		{
			var snd = $(".audio")[play];
			if(snd)	
			{
				snd.play();
				play++;
			}
			else play = 0;
		}
		
		// remove all
		function remall()
		{
			$(".audio").each(function(){
				$(this).remove();
			})
			
			$(".audio-list").each(function(){
				$(this).remove();
			})			
		}
		
		function exp()
		{
			var s = "";
			$(".audio").each(function(){
				var src = $(this).attr("src").slice(7,-4);
				s+=src+";";
			})
			//console.log(s);
			window.location="?s="+s;
		}
	</script>
</body>
</html>