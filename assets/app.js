function findGetParameter(parameterName){
	var result = null,
	tmp = [];
	location.search
	.substr(1)
	.split("&")
	.forEach(function (item) {
	tmp = item.split("=");
	if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
	});
	return result;
}

// Remote API URL
// const API_URL = "https://ase220-website.herokuapp.com/API/";

// Local API URL
const API_URL = "API/";

