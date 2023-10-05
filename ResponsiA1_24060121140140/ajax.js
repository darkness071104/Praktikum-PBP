// Nama : Fauzan Ramadhan Putra
// Nim  : 24060121140140
// lab  : A1
function getXMLHttpRequest() {
	if (window.XMLHttpRequest) {
		//code for modern browser
		return new XMLHttpRequest();
	} else {
		//code for old IE browser
		return new ActiveXObject('Microsoft.XMLHTTP');
	}
}

function getUser() {
	var email = encodeURI(document.forms["daftar"]["email"].value);
	var inner = "error_email";
	var url = "get_user.php?email=" + email;
	//TODO 8 : write ajax request to url
	var ajax = getXMLHttpRequest();
	ajax.open('GET', url, true);
	ajax.send();
	// Set response
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			if (!ajax.responseText) {
				document.getElementById(inner).innerHTML =
					"<p style='color: green;'>Email tersedia</p>";
				document.getElementById('submit').disabled = false;
			} else {
				document.getElementById(inner).innerHTML =
					"<p style='color: red;'>Email sudah digunakan</p>";
				document.getElementById('submit').disabled = true;
			}
		}
	};
}

function getKabupaten(kode_prov) {
	var inner = "kabupaten";
	var url = "get_kabupaten.php?kode_prov=" + kode_prov;
	//TODO 9 : write ajax request to url
	var ajax = getXMLHttpRequest();
	ajax.open('GET', url, true);
	ajax.send();
	// Set response
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			document.getElementById(inner).innerHTML = ajax.responseText;
		}
	};
}