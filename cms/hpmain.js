//--Global declaration
var gxmlDoc = null;
var garrLayoutParts = new Array();
var arrParts = new Array("HPFrameHL", "HPFrameDL");
var blnIE5    = false;
var blnBorder = false;
var blnTrack  = false;
var blnDebug  = false;
var blnMoved  = false;

function setCookie(name, value, expires, path, domain, secure) {
	var curCookie = name + "=" + escape(value) +
		((expires) ? "; expires=" + expires.toGMTString() : "") +
		((path) ? "; path=" + path : "") +
		((domain) ? "; domain=" + domain : "") +
		((secure) ? "; secure" : "")
	document.cookie = curCookie
}

function getCookie(name) {
	var prefix = name + "="
	var cookieStartIndex = document.cookie.indexOf(prefix)
	if (cookieStartIndex == -1)
		return null
	var cookieEndIndex = document.cookie.indexOf(";", cookieStartIndex + prefix.length)
	if (cookieEndIndex == -1)
		cookieEndIndex = document.cookie.length
	return unescape(document.cookie.substring(cookieStartIndex + prefix.length, cookieEndIndex))
}


function showHideContent(id,first)
{
	var bMO = false;
	var oContent = document.all.item(id+"Content");
	var oImage   = document.all.item(id+"Tab3");
	if (!oContent || !oImage) return;

	if (getCookie(id) != null)
	{
		bMO = (getCookie(id) != "true");
		bOn = bMO;

		if (first) {
			bMO = !bMO;
			bOn = !bOn;
		}
	} else {
//		bMO = (event.srcElement.src.toLowerCase().indexOf("_mo.gif") != -1);
//		bOn = (oContent.style.display.toLowerCase() == "none");
		bMO = true;
		bOn = true;
	}
	setCookie(id, bOn);

	if (bOn == false)
	{
		oContent.style.display = "none";
                oImage.src = "/cms/img/expand" + (bMO? "_mo.gif" : ".gif");
	}
	else
	{
		oContent.style.display = "";
                oImage.src = "/cms/img/collapse" + (bMO? "_mo.gif" : ".gif");
	}

	for (var i = 0; i < garrLayoutParts.length; i++)
	{
		if (id == garrLayoutParts[i].name)
			garrLayoutParts[i].state = bOn ? "EXPAND" : "COLLAPSE";
	}

//        if (event.srcElement)
//                saveState();
}

function setBorder(id,bOn)
{
	var oTab    = document.all.item(id+"Tab");
	var oTab1   = document.all.item(id+"Tab1");
	var oTab2   = document.all.item(id+"Tab2");
	var oTab3   = document.all.item(id+"Tab3");
	var oBorder = document.all.item(id+"Content");

	if (!oTab || !oTab1 || !oTab2 || !oTab3 || !oBorder)
		return;

	if (bOn)
	{
		oBorder.style.borderColor = "#cccccc";
                oTab.bgColor = "#ffcc00";
                oTab1.src    = "/cms/img/info.gif";
		oTab2.color  = "#FFFFFF";
		if (oBorder.style.display == "none")
                        oTab3.src = "/cms/img/expand_mo.gif";
		else
                        oTab3.src = "/cms/img/collapse_mo.gif";
	}
	else
	{
		oBorder.style.borderColor = blnBorder? "#cccccc" : "#ffffff";
		oTab.bgColor = "#CCCCCC";
                oTab1.src        = "/cms/img/info.gif";
                oTab2.color  = "#000000";
		if (oBorder.style.display == "none")
                        oTab3.src = "/cms/img/expand.gif";
		else
                        oTab3.src = "/cms/img/collapse.gif";
	}
}

function go( page )
{
	menu.page.value=page;
	menu.from.value = menu.from_ts_year.value+menu.from_ts_month.value+menu.from_ts_day.value+'000000';
	menu.to.value = menu.till_ts_year.value+menu.till_ts_month.value+menu.till_ts_day.value+'235959';
	
	menu.submit();	
	return false;
}