var Input_Validator = {
	inputArray : [],
	newInput(data) {
		this.inputArray.push (data.split('#'));
	},
	submitForm(formID){
		let id, type, name, min, max, id2, value, array = this.inputArray;
		var thisInput, len, elem, elem2, error=[];
		for (thisInput of array) {
			elem = document.getElementById(thisInput[0]);
			[id, type, name, min, max, id2, type] = thisInput;
			if (elem){
				len = elem.value.trim().length;
				min = thisInput[3]; max = thisInput[4];name=thisInput[2];
				if ((len < min) || (len>max)){
					error.push(len === 0 ? 'A \''+name+'\' mezőt ki kell tölteni' : name+' legalább '+min+'-'+max+' karakter kell, hogy legyen!');
				}
				if (thisInput[5] != ""){
					elem2 = document.getElementById(thisInput[5]);
					if (elem2){
						if (elem2.value != elem.value){
							error.push('A \''+name+'\' mezők nem egyeznek');
						}
					}else{
						error.push(thisInput[5]+' element not exist!');
					}
				}
			}
			
		}
		//event.preventDefault();
		document.getElementById("errorBox").innerHTML = error.join("<br>");
		let valid = error.length === 0 ? true : false; 
		if (valid){document.getElementById(formID).submit();}
		return valid;
	}

};
