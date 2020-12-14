var img = "url(app.img/homepage#.jpg)";
var n = 1;

$(document).ready(function(){
	$('.home-panel li').click(function(event){
		clearInterval(timer);
		n = parseInt(event.target.innerText);
		console.log(n);
		$('.home-panel').css('background-image', img.replace('#', n));
		$('.home-panel li').css('background-color', 'rgba(255, 255, 255, 0.5');
		$(event.target).css('background-color', 'rgba(255, 255, 255, 1');
		timer = setInterval(homepanel, 5000);
	});

	function homepanel(){
		$('.home-panel').css('background-image', img.replace("#", n));
		$('.home-panel li').css('background-color', 'rgba(255, 255, 255, 0.5');
		selector = '.home-panel li:nth-child(#)'.replace('#', n);
		$(selector).css('background-color', 'rgba(255, 255, 255, 1');
		if(n < 3){
			n = n + 1;
		}
		else{
			n = 1;
		}
	}
	timer = setInterval(homepanel, 5000);
});