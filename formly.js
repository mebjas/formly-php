var formly = {


};

document.onload = function() {
	var d = document.getElementsByClassName('formely-form');
	for(i = 0; i < d.length; i++) {
		d[i].onsubmit = function(e) {
			var _d = d[i];
			var ipts = d.getElementsByTagName('input');
			for (j = 0; j < ipts.length; j++) {
				var r = ipts[j]['data-regex'];
				console.log(r);
			}
			e.preventDefault();
		};
	}
};