function redirect_adv() {


var val_1 = document.getElementById('type_of_advert').value;

switch (val_1) {
	case "wear":
	window.location.href = "/";
	break;

	case "diapers":
	window.location.href = "/about";
	break;

	case "toys":
	window.location.href = "/";
	break;

	case "buggy":
	window.location.href = "/";
	break;

	case "other":
	window.location.href = "/";
	break;
	}
}