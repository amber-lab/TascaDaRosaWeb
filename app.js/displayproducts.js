
$(document).ready(function() {
	$('.triangle').click(function(event){
		var $target = $(event.target);
		var $classtype = $(event.target).attr('class');
		var $classtype = $classtype.split(' ')[0];
		var $selector = '.products ul.'+$classtype;
		var $ulist = $($selector);


		var $allulists = $('.products ul');
		var $alltriangles = $('.products .triangle');

		if($target.hasClass('downtriangle')){
			$allulists.each(function(index, value){
				if(!($(this).hasClass('hide'))){
					$(this).toggleClass('hide');
					$alltriangles.eq(index).toggleClass('uptriangle');
					$alltriangles.eq(index).toggleClass('downtriangle');
				};
			});
		};

		if($(window).width() >= 820){
			var $h = $ulist.height();

			if($h < 500 || $target.hasClass('uptriangle')){
				$h = 400;
			}

			$('.productsarticle').height($h + 100);
		}
		

		$target.toggleClass('uptriangle');
		$target.toggleClass('downtriangle');
		$ulist.toggleClass('hide');
	});
});

