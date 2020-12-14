validations = [];
function formValidation(event){
	if(event){
		var obj = event.target;
		var id = obj.getAttribute('id');
	}
	else{
		return;
	}

	var valid_widget = 0;
	var combob = ['subject', 'type', 'mainplate'];
	var wtext = ['name', 'message', 'locality'];

	if(combob.includes(id)){
		text = $(event.target).val();
		if(parseInt(text)){
			obj.setCustomValidity('');
		}
		else{
			obj.setCustomValidity('Por favor preencha este campo');
			delete validations[validations.indexOf(id)];
			return;
		}
	}


	else if(wtext.includes(id)){
		if(obj.value.length > 1){
			obj.setCustomValidity('');
		}
		else{
			obj.setCustomValidity('Por favor preencha este campo');
			delete validations[validations.indexOf(id)];
			return;
		}
		names = obj.value.split(' ');

		if((id == 'name') && (names.length >= 2) && (names[1].length >= 1)) {
			obj.setCustomValidity('');
		}
		else if(id == 'message'){

		}
		else if(id == 'locality'){
			if($(event.target).val().length > 1){
				obj.setCustomValidity('');
			}
			else{
				obj.setCustomValidity('Por favor preencha este campo');
				return;
			}
		}
		else{
			obj.setCustomValidity('Dados insuficientes');
			delete validations[validations.indexOf(id)];
			return;
		}
	}

	else if(id == 'phone'){
		if(/^[0-9]{9}$/.test(obj.value)){
			obj.setCustomValidity('');
		}
		else{
			obj.setCustomValidity('Por favor preencha este campo');
			return
		}
	}

	else if(id == 'number'){
		n = parseInt(obj.value);
		if(n > 500){
			obj.setCustomValidity('25-500');
			return
		}
		else{
			obj.setCustomValidity('');
		}
	}

	else if(id == 'date'){
		if(obj.value){
			obj.setCustomValidity('');
		}
		else{
			obj.setCustomValidity('Por favor preencha este campo');
			return;
		}
	}

	else if(id == 'email'){
		if(obj.value){
			obj.setCustomValidity('');
		}
		else{
			obj.setCustomValidity('Por favor preencha este campo');
			return;
		}

		if(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(obj.value)){
			obj.setCustomValidity('');
		}

		else{
			obj.setCustomValidity('Esta informação não corresponde a um email');
			delete validations[validations.indexOf(id)];
			return;
		}
	}
	else{
		return
	}

	//

	/*verificar existencia de elemento na lista de validos
	+1 pq o index pode ser 0*/

	if(!(validations.indexOf(id) + 1)){
		validations.push(id);
	}
}

function activateValidation(event){
	var $event = $(event.target)
	var $id = $event.attr('id');
	var $not_required = ['secondplate', 'soup'];
	if(!($event.attr('type') == 'checkbox')){
		if(!($not_required.includes($id))){
			event.target.required = true;
		}
	}
}

function validationTimer(event){
	valid_c = 0;
	if($('input[type="date"]').val()){
		widgets = ['name', 'locality', 'email', 'phone', 'type', 'number', 'date', 'mainplate'];
	}
	else{
		widgets = ['name', 'email', 'subject', 'message'];
	}
	widgets.forEach(isValid);
	selector = $('.tascaform input[type=submit]');
	if(valid_c == widgets.length){
		selector.removeAttr('disabled');
	}
	else{
		selector.prop('disabled', true);
	}
}

function isValid(item, index){
	if(validations.indexOf(item) + 1){
		valid_c += 1;
	}
	else{
		return false;
	}
}

selector = $('.tascaform input, .tascaform textarea, .tascaform select');
selector.mousedown(activateValidation);
selector.mouseup(formValidation);
selector.keyup(formValidation);
selector.change(formValidation);
selector.focusout(formValidation);

timer = setInterval(validationTimer, 20);

