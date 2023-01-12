function moveModule(o_col, d_col)
{
	o_sl = document.editform[o_col].selectedIndex;
	d_sl = document.editform[d_col].length;

	if (o_sl != -1 && document.editform[o_col].options[o_sl].value > "") {
		oText = document.editform[o_col].options[o_sl].text;
		oValue = document.editform[o_col].options[o_sl].value;
		document.editform[d_col].options[d_sl] = new Option (oText, oValue, false, true);
	} else {
		alert("Выберите элемент");
	}
	selectList(d_col);
}

function deleteModule(o_col)
{
	o_sl = document.editform[o_col].selectedIndex;
	if (o_sl != -1 && document.editform[o_col].options[o_sl].value > "") {
		document.editform[o_col].options[o_sl] = null;
	} else {
		alert("Выберите элемент");
	}
}

function selectList(col)
{
	for (j=0; j<document.editform[col].length; j++) {
		if (document.editform[col].options[j].value > "") document.editform[col].options[j].selected = true;
	}
}


