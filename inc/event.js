function fade(id, data, delay) {
	$(id).fadeOut(delay, function() {
		$(id).text(data).fadeIn(delay);
	});
}

function changeDate(dateId, timeId, number, singular, plural) {
	var time = number == 1 ? singular : plural;
	number = ('0' + number).substr(-2);
	if ($(dateId).text() != number) {
		fade(dateId, number, 50);
		if ($(timeId).text() != time) {
			fade(timeId, time, 50);
		}
	}
}

function updateDate(date) {
	var actual = (new Date()).getTime();
	var seconds = Math.floor((actual - date.getTime()) / 1000);
	if (actual < date.getTime()) {
		seconds = Math.floor((date.getTime() - actual) / 1000);
	}
	const months = Math.abs(Math.floor(seconds / (60 * 60 * 24 * 30)));
	seconds -= months * 60 * 60 * 24 * 30;
	const days = Math.abs(Math.floor(seconds / (60 * 60 * 24)));
	seconds -= days * 60 * 60 * 24;
	const hours = Math.abs(Math.floor(seconds / (60 * 60)));
	seconds -= hours * 60 * 60;
	const minutes = Math.abs(Math.floor(seconds / 60));
	seconds -= Math.abs(minutes * 60);
	changeDate('#ds', '#ts', seconds, 'segundo', 'segundos');
	changeDate('#dn', '#tn', minutes, 'minuto', 'minutos');
	changeDate('#dh', '#th', hours, 'hora', 'horas');
	changeDate('#dd', '#td', days, 'dia', 'dias');
	changeDate('#dm', '#tm', months, 'mês', 'meses');
}

var pos = 0;
function changePhrase(ps) {
	fade('#phrases', ps[pos][0], 500)
	fade('#authors', ps[pos][1], 500)
	pos = ++pos % ps.length;
}

function changeEvent(sender) {
	if (sender.value) {
		$('#loader-wrapper').fadeIn('fast', function() {
			window.location.href = sender.value;
		});
	}
}

$(document).ready(function() {
	$('.carousel').carousel({pause: 'false'});
	$(window).scroll(function() {
		$(".carousel-indicators").css("opacity", 1 - $(window).scrollTop() / 500);
	});
	$('.smooth-anchor').click(function(){
		$('html, body').stop().animate({
			scrollTop: $($(this).attr('href')).offset().top - ($(this).data('anchor') ? $(window).height() / 2 : 60)
		}, 300);
		return false;
	});
	$('.parallax').paroller();
});