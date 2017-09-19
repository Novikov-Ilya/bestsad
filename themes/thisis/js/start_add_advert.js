function redirect_adv() {


var val_1 = document.getElementById('type_of_advert').value;

switch (val_1) {
	case "Аксесуары":
	window.location.href = "/";
	break;

	case "Подгузники":
	window.location.href = "/about";
	break;

	case "Игрушки":
	window.location.href = "/";
	break;

	case "Коляски":
	window.location.href = "/";
	break;

	case "Прочее":
	window.location.href = "/";
	break;
	}
}