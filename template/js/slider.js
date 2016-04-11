$(document).ready(function(e) {
var interval = 3000;
var i =2;
var count = $('#slider div.s').size();
for(a=0;a<count;a++){
	$('#nav').prepend("<div class='nB'></div>");
	}
$('#slider div:nth-child('+(i-1)+')').fadeIn(1000);
$('#nav div:nth-child('+(i-1)+')').removeClass('nB').addClass('nA');
var move = setInterval(slide, interval);
function slide(a,b) {
		if(i>count){$('#nav div:nth-child('+(i-1)+')').removeClass('nA').addClass('nB');i=1;}
		$('#slider div').fadeOut(1000);
		$('#slider div:nth-child('+i+')').fadeIn(1000);
		$('#nav div').removeClass('nA').addClass('nB');
		$('#nav div:nth-child('+i+')').removeClass('nB').addClass('nA');
		i++;
		$('#nav div').click(function(e) {
			$('#nav div').removeClass('nA').addClass('nB');
			var now = $(this).index();
			i = now+1;j=now+1;
			$('#nav div:nth-child('+i+')').removeClass('nB').addClass('nA');
		});
}
		$('#slider').hover(function(){clearInterval(move);}, function(){move=setInterval(slide, interval);});
});
