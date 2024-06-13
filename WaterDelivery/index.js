const but_kak_zakazat = document.getElementById('but_zakaz');

const div_zakaz = document.getElementById('div_zakaz');


but_kak_zakazat.onclick = function() {
	if (div_zakaz.style.display=="none") div_zakaz.style.display="flex";
	else div_zakaz.style.display="none";
}

const but_contact = document.getElementById('but_contact');
const div_contact = document.getElementById('index_about_block');

but_contact.onclick = function() {
	if (div_contact.style.display!="none") div_contact.style.display="none";
	else div_contact.style.display="flex";
}





const icon_enter = document.getElementById('butEnter');
const modal_div = document.getElementById('window_for_log');
const freez = document.getElementById('freez');

icon_enter.onclick = function(){
	modal_div.style.display="block";
	freez.style.display="flex";

}

const but_log = document.getElementById('but_log');
const but_reg = document.getElementById('but_reg');
const body_enter = document.getElementById('body_enter');
const body_reg = document.getElementById('body_reg');
const close_modal = document.getElementById('close_modal');
but_log.onclick = function(){
	body_reg.style.display="none";
	body_enter.style.display="flex";
	but_log.style.borderBottom="2px solid #02A5E6";
	but_reg.style.border="none"
}

but_reg.onclick = function(){
	body_enter.style.display="none";
	body_reg.style.display="flex";
	but_reg.style.borderBottom="2px solid #02A5E6";
	but_log.style.border="none"
}

close_modal.onclick = function(){
	modal_div.style.display="none";
	freez.style.display="none";
}
