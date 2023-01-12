// DHTML Editing Component Constants for JavaScript
// Copyright 1998-1999 Microsoft Corporation.  All rights reserved.
//

//
// Command IDs
//
CMD_BOLD =                      5000
CMD_COPY =                      5002
CMD_CUT =                       5003
CMD_DELETE =                    5004
CMD_DELETECELLS =               5005
CMD_DELETECOLS =                5006
CMD_DELETEROWS =                5007
CMD_FINDTEXT =                  5008
CMD_FONT =                      5009
CMD_GETBACKCOLOR =              5010
CMD_GETBLOCKFMT =               5011
CMD_GETBLOCKFMTNAMES =          5012
CMD_GETFONTNAME =               5013
CMD_GETFONTSIZE =               5014
CMD_GETFORECOLOR =              5015
CMD_HYPERLINK =                 5016
CMD_IMAGE =                     5017
CMD_INDENT =                    5018
CMD_INSERTCELL =                5019
CMD_INSERTCOL =                 5020
CMD_INSERTROW =                 5021
CMD_INSERTTABLE =               5022
CMD_ITALIC =                    5023
CMD_JUSTIFYCENTER =             5024
CMD_JUSTIFYLEFT =               5025
CMD_JUSTIFYRIGHT =              5026
CMD_LOCK_ELEMENT =              5027
CMD_MAKE_ABSOLUTE =             5028
CMD_MERGECELLS =                5029
CMD_ORDERLIST =                 5030
CMD_OUTDENT =                   5031
CMD_PASTE =                     5032
CMD_REDO =                      5033
CMD_REMOVEFORMAT =              5034
CMD_SELECTALL =                 5035
CMD_SEND_BACKWARD =             5036
CMD_BRING_FORWARD =             5037
CMD_SEND_BELOW_TEXT =           5038
CMD_BRING_ABOVE_TEXT =          5039
CMD_SEND_TO_BACK =              5040
CMD_BRING_TO_FRONT =            5041
CMD_SETBACKCOLOR =              5042
CMD_SETBLOCKFMT =               5043
CMD_SETFONTNAME =               5044
CMD_SETFONTSIZE =               5045
CMD_SETFORECOLOR =              5046
CMD_SPLITCELL =                 5047
CMD_UNDERLINE =                 5048
CMD_UNDO =                      5049
CMD_UNLINK =                    5050
CMD_UNORDERLIST =               5051
CMD_PROPERTIES =                5052

//
// Enums
//

// OLECMDEXECOPT  
OLECMDEXECOPT_DODEFAULT =         0 
OLECMDEXECOPT_PROMPTUSER =        1
OLECMDEXECOPT_DONTPROMPTUSER =    2

// DHTMLEDITCMDF
DECMDF_NOTSUPPORTED =             0 
DECMDF_DISABLED =                 1 
DECMDF_ENABLED =                  3
DECMDF_LATCHED =                  7
DECMDF_NINCHED =                  11

// DHTMLEDITAPPEARANCE
DEAPPEARANCE_FLAT =               0
DEAPPEARANCE_3D =                 1 

// OLE_TRISTATE
OLE_TRISTATE_UNCHECKED =          0
OLE_TRISTATE_CHECKED =            1
OLE_TRISTATE_GRAY =               2

function Begin(Comp){
	GeneralContextMenu[0] = new ContextMenuItem("Вырезать", CMD_CUT);
	GeneralContextMenu[1] = new ContextMenuItem("Копировать", CMD_COPY);
	GeneralContextMenu[2] = new ContextMenuItem("Вставить", CMD_PASTE);

	InsertTableContextMenu[0] = new ContextMenuItem(MENU_SEPARATOR, 0);
	InsertTableContextMenu[1] = new ContextMenuItem("Вставить таблицу", CMD_INSERTTABLE);

	TableContextMenu[0] = new ContextMenuItem(MENU_SEPARATOR, 0);
	TableContextMenu[1] = new ContextMenuItem("Добавить строчку", CMD_INSERTROW);
	TableContextMenu[2] = new ContextMenuItem("Удалить строчки", CMD_DELETEROWS);
	TableContextMenu[3] = new ContextMenuItem(MENU_SEPARATOR, 0);
	TableContextMenu[4] = new ContextMenuItem("Добавить колонку", CMD_INSERTCOL);
	TableContextMenu[5] = new ContextMenuItem("Удалить колонки", CMD_DELETECOLS);
	TableContextMenu[6] = new ContextMenuItem(MENU_SEPARATOR, 0);
	TableContextMenu[7] = new ContextMenuItem("Добавить ячейку", CMD_INSERTCELL);
	TableContextMenu[8] = new ContextMenuItem("Удалить ячейки", CMD_DELETECELLS);
	TableContextMenu[9] = new ContextMenuItem("Объединить ячейки", CMD_MERGECELLS);
	TableContextMenu[10] = new ContextMenuItem("Разбить ячейку", CMD_SPLITCELL);
	
	AbsPosContextMenu[0] = new ContextMenuItem(MENU_SEPARATOR, 0);
	AbsPosContextMenu[1] = new ContextMenuItem("Send To Back", CMD_SEND_TO_BACK);
	AbsPosContextMenu[2] = new ContextMenuItem("Bring To Front", CMD_BRING_TO_FRONT);
	AbsPosContextMenu[3] = new ContextMenuItem(MENU_SEPARATOR, 0);
	AbsPosContextMenu[4] = new ContextMenuItem("Send Backward", CMD_SEND_BACKWARD);
	AbsPosContextMenu[5] = new ContextMenuItem("Bring Forward", CMD_BRING_FORWARD);
	AbsPosContextMenu[6] = new ContextMenuItem(MENU_SEPARATOR, 0);
	AbsPosContextMenu[7] = new ContextMenuItem("Send Below Text", CMD_SEND_BELOW_TEXT);
	AbsPosContextMenu[8] = new ContextMenuItem("Bring Above Text", CMD_BRING_ABOVE_TEXT);

	Comp.focus();
	setTimeout("aa()", 100);
};

var Mode = 'text';
function ContextMenuItem(string, cmdId) {
	this.string = string;
	this.cmdId = cmdId;
}

var GeneralContextMenu = new Array();
var ContextMenu = new Array();
var TableContextMenu = new Array();
var InsertTableContextMenu = new Array();
var AbsPosContextMenu = new Array();
var MENU_SEPARATOR = "";

function ShowContextMenu(Comp) {
	var menuStrings = new Array();
	var menuStates = new Array();

	var idx = 0;
	ContextMenu.length = 0;
	for (i=0; i<GeneralContextMenu.length; i++) {
		ContextMenu[idx++] = GeneralContextMenu[i];
	}

	if (Comp.QueryStatus(CMD_INSERTROW) != 1) {
		for (i=0; i<TableContextMenu.length; i++) {
			ContextMenu[idx++] = TableContextMenu[i];
		}
	} else {
		for (i=0; i<InsertTableContextMenu.length; i++) {
			ContextMenu[idx++] = InsertTableContextMenu[i];
		}
	}

	if (Comp.QueryStatus(5027) != 1) {
		for (i=0; i<AbsPosContextMenu.length; i++) {
			ContextMenu[idx++] = AbsPosContextMenu[i];
		}
	}

	for (i=0; i<ContextMenu.length; i++) {
		menuStrings[i] = ContextMenu[i].string;
		if (menuStrings[i] != MENU_SEPARATOR) {
			state = Comp.QueryStatus(ContextMenu[i].cmdId);
		} else {
			state = 3;
		}

		if (state == 1 || state == 0) {
			menuStates[i] = 2;
		} else if (state == 3 || state == 11) {
			menuStates[i] = 0;
		} else {
			menuStates[i] = 1;
		}
	}

	Comp.SetContextMenu(menuStrings, menuStates);
};

function ContextMenuAction(Comp, itemIndex) {
	if (ContextMenu[itemIndex].cmdId == 5022) {	
		addTable();
	} else {
		Comp.ExecCommand(ContextMenu[itemIndex].cmdId, 0);
	}
};

function ChangeMode(Comp){
	if (Mode == 'text') {
		Comp.DOM.body.innerText = Comp.DOM.body.innerHTML;
		Mode = 'html';
	} else {
		Comp.DOM.body.innerHTML = Comp.DOM.body.innerText;
		Mode = 'text';
	}
};

function align_justify(Comp){
	Comp.execCommand(CMD_JUSTIFYLEFT);
	el='Comp.DOM.selection.createRange().parentElement()';
	while (eval(el+'.tagName') != 'P' && eval(el+'.tagName') != 'BODY') { el += '.parentElement()'; }
	if (eval(el+'.tagName') == 'P') { eval(el+'.align = "justify"') }
};

function createTable(cols,rows,border,falign,width){
	var pVar = document.all.ObjTableInfo;
	
	document.all.ObjTableInfo.NumRows = rows;
	document.all.ObjTableInfo.NumCols = cols;
	document.all.ObjTableInfo.TableAttrs = 'border='+border+' align='+falign+' width="'+width+'"';

	Comp.ExecCommand(5022,0,pVar)
};

function addTable(){
	Pop=window.open('create_table.html','Pop','width=300,height=250,locatopn=0,menubar=0,resizable=0,scrollbars=0,status=1,toolbar=0,screenX=300,screenY=250,left=300,top=250');
};


function doc_submit(Comp){
	document.main.text.value=Comp.DOM.body.innerHTML;
	document.main.submit();
};


