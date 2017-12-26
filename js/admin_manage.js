window.onload = function () {
	
	var level = document.getElementById('level');
	var options = document.getElementsByTagName('option');
	
	if (level) {
		for(i=0;i<options.length;i++) {
			if (options[i].value == level.value) {
				options[i].setAttribute('selected','selected');
			}
		}
	}

	
	var title = document.getElementById('title');
	var ol = document.getElementsByTagName('ol');
	var a = ol[0].getElementsByTagName('a');
    
	for(i=0;i<a.length;i++)
	{
		a[i].className = null;
		
		if(title.innerHTML == a[i].innerHTML)
		{
			a[i].className = 'selected';
		}
	}


};