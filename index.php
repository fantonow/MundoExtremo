
<!DOCTYPE HTML>
<html>
	<head>
		<title>World fact</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		
	</head>
	<body>

		<!-- Header -->
			<section id="header">
				<header class="major">
					<h1><a href="index.php">Mundo Extremo</a></h1>
					<p>There are several Matrix. Why not try to find a fault? Type something to search...</a></p>
					</br/>
					<form action="" method="get">
					<ul class="actions">
						<li>							
								<input type="text"  name='search_p'  id='search_p' placeholder='Type here...' required class="header searchbox" size="40" >
								<input type="hidden" name='search' value="search">
								
						</li>
						<li>
								<input type="submit" value="Search" class="header">
						</li>	
						
						
					</ul>
					</form>
				</header>
				<div class="container">
					<ul class="actions">
						<li><a href="#one" class="button special scrolly" id='begin_result'>Begin</a></li>
					</ul>
				</div>
			</section>

	  
		<!-- One -->
			<section id="one" class="main special">
				<div class="container">
					
					<div class="content">
						  <?php
        						require_once('dinamico/index.php');
      					  ?>	
					
					</div>
				
				</div>
			</section>

		

	
	

		<!-- Footer -->
			<section id="footer">
				<?php

				if(!isset($_GET['search']) or ($_GET['search']=="")){
					$url_atual =(isset($_SERVER["HTTPS"]) ? "https" : "http") . "://$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]";
					echo '
						<div class="container">
							<header class="major">
								<h2>Get in touch</h2>
							</header>
							<form method="post" action="email.php">
								<input type="hidden" name="url" value="'.$url_atual.'" />
								<div class="row uniform">
									<div class="6u 12u$(xsmall)"><input type="text" name="name" id="name" placeholder="Name" required /></div>
									<div class="6u$ 12u$(xsmall)"><input type="email" name="email" id="email" placeholder="Email"  required/></div>
									<div class="12u$"><textarea name="message" id="message" placeholder="Message" rows="4" required></textarea></div>
									<div class="6u 12u$(xsmall)">
										<input type="text" name="captcha" id="captcha" placeholder="I\'m robo?" maxlength="4" required 
										style="background-image:url(dinamico/lib/captcha/captcha.php);background-repeat:no-repeat;background-position: 96% center; "/>	
									</div>
									<div class="6u$ 12u$(xsmall)">
										<ul class="actions">
											<li><input type="submit" value="Send Message" class="special" /></li>
										</ul>
									</div>
								</div>
							</form>
						</div>
						';
					}


				?>
				<footer>
					<ul class="icons">
						<li>Never stop looking for knowledge</li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled</li><li>Design: <a href="?search=exact&search_p=1">Felipe Antonow</a></li><li><a href="http://www.mundoextremo.com.br">World fact</a></li>
					</ul>
				</footer>
			</section>
			<style type="text/css">
				@import url(https://fonts.googleapis.com/css?family=Raleway:400,400italic,700,800);
			</style>

			<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
			<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
			<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
			<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<link rel="stylesheet" href="assets/js/jquery-ui.css" />
			<script src="assets/js/jquery-ui.min.js"></script>

			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<script type="text/javascript">
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

				ga('create', 'UA-81247165-1', 'auto');
				ga('send', 'pageview');
					
				$(".searchbox").autocomplete({
					source: function(request, response) {
						$.ajax({
							url: "http://en.wikipedia.org/w/api.php",
							dataType: "jsonp",
							data: {
								'action': "opensearch",
								'format': "json",
								'search': request.term
							},
							success: function(data) {
								response(data[1]);
							}
						});
					},
				select: function(event, ui) {
						if(ui.item){
							$(event.target).val(ui.item.value);
						}
						$(event.target.form).submit();
					}
				});
				
				
				(adsbygoogle = window.adsbygoogle || []).push({
					google_ad_client: "ca-pub-2477486217847028",
					enable_page_level_ads: true
				});
		
				$(document).ready(function() {
					$.each( $('.voting_wrapper'), function(){
						var unique_id = $(this).attr("id");
						post_data = {'unique_id':unique_id, 'vote':'fetch'};
						$.post('vote/vote_process.php', post_data,  function(response) {
								$('#'+unique_id+'up_votes').text(response.vote_up); 
								$('#'+unique_id+'down_votes').text(response.vote_down);
							},'json');
					});

					
					$(".voting_wrapper .voting_btn").click(function (e) {
						var clicked_button = $(this).children().attr('class');
						var unique_id 	= $(this).parent().attr("id"); 
						
						if(clicked_button==='down_button'){
							post_data = {'unique_id':unique_id, 'vote':'down'};
							$.post('vote/vote_process.php', post_data, function(response) {
								$('#'+unique_id+'up_votes').text(response.vote_up); 
								$('#'+unique_id+'down_votes').text(response.vote_down);
							},'json').fail(function(err) { 
							});
						}
						else if(clicked_button==='up_button') {
							post_data = {'unique_id':unique_id, 'vote':'up'};
							$.post('vote/vote_process.php', post_data, function(response) {
								$('#'+unique_id+'up_votes').text(response.vote_up); 
								$('#'+unique_id+'down_votes').text(response.vote_down);
							},'json').fail(function(err) { 

							});
						}
						
					});

					$(".more_images").click(function (e) {
						$('#more_images').text('I\'m looking, wait ...');
						$.post('dinamico/more_img/more.php?id='+$(this).attr("id"), post_data, function(response) {
								$('#more_images').html(response); 
						}).fail(function(err) { });
					});
				});

			</script>


	</body>
</html>