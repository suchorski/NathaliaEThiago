var phraseCount = 0;
function addPhrase() {
	++phraseCount;
	var $inputPhrase = $('<input>', {
		type: 'text',
		class: 'form-control mb-1',
		name: 'phrases['.concat(phraseCount).concat('][phrase]'),
		placeholder: 'Frase',
		required: 'required'
	});
	var $inputAuthor = $('<input>', {
		type: 'text',
		class: 'form-control',
		name: 'phrases['.concat(phraseCount).concat('][author]'),
		placeholder: 'Autor',
		required: 'required'
	});
	var $small = $('<small>', {
		class: 'form-text text-muted mb-3',
		text: 'Frase e autor '.concat(phraseCount)
	});
	$('#phrases').append($inputPhrase).append($inputAuthor).append($small);
}
function removePhrase() {
	if (phraseCount > 1) {
		for (var i = 0; i < 3; ++i) {
			$('#phrases :last-child').last().remove();
		}
		--phraseCount;
	}
}
$(document).ready(function() {
	addPhrase();
	$('#date').datetimepicker({
		locale: 'pt-br',
		icons: {
			time: 'fa fa-clock',
			date: 'fa fa-calendar',
			up: 'fa fa-arrow-up',
			down: 'fa fa-arrow-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-calendar-check-o',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		}
	});
});