// Arrays for nodes and icons
var nodes		= new Array();;
var openNodes	= new Array();
var icons		= new Array(6);
var cur_id = 0;
var cur_type = 0;
var cur_cid = 0;
var cur_color = 0;

// Select by cid && type
function select_byCid(cid, type) {
	for (i=0; i<nodes.length; i++) 
	{
		var nodeValues = nodes[i].split("|");
		if (nodeValues[5] == cid && nodeValues[4] == type)
		{
			select(document.getElementById('link'+nodeValues[0]), type, cid);
		}
	}
}

function select(id, type, cid){
	if (cur_id)
	{
		cur_id.style.background='#DCEBF6';
		cur_id.style.color=cur_color;
	}

	cur_color = id.style.color;

	id.style.background="#142C6C"; 
	id.style.color="white";

	cur_id = id;
	cur_cid = cid;
	cur_type = type;
};

// Loads all icons that are used in the tree
function preloadIcons() {
	icons[0] = new Image();
	icons[0].src = "/cms/img/plus.gif";
	icons[1] = new Image();
	icons[1].src = "/cms/img/plusbottom.gif";
	icons[2] = new Image();
	icons[2].src = "/cms/img/minus.gif";
	icons[3] = new Image();
	icons[3].src = "/cms/img/minusbottom.gif";
	icons[4] = new Image();
	icons[4].src = "/cms/img/folder.gif";
	icons[5] = new Image();
	icons[5].src = "/cms/img/folderopen.gif";
}
// Create the tree
function createTree(arrName, openNode, name, root_cid) {
	nodes = arrName;
//	if (nodes.length > 0) {
		preloadIcons();
		if (openNode != 0 || openNode != null) setOpenNodes(openNode);
	
		document.write("<a id=\"icon0\" onclick='select(this, \"folder\", "+root_cid+")'" + "  href=\"#\" onmouseover=\"window.status='" + name + "';return true;\" onmouseout=\"window.status=' ';return true;\">"+name+"</a><br>");
	
		var recursedNodes = new Array();
		addNode(0, recursedNodes);
//	}
}
// Returns the position of a node in the array
function getArrayId(node) {
	for (i=0; i<nodes.length; i++) {
		var nodeValues = nodes[i].split("|");
		if (nodeValues[0]==node) return i;
	}
}
// Puts in array nodes that will be open
function setOpenNodes(openNode) {
	for (i=0; i<nodes.length; i++) {
		var nodeValues = nodes[i].split("|");
		if (nodeValues[0]==openNode) {
			openNodes.push(nodeValues[0]);
			setOpenNodes(nodeValues[1]);
		}
	} 
}
// Checks if a node is open
function isNodeOpen(node) {
	for (i=0; i<openNodes.length; i++)
		if (openNodes[i]==node) return true;
	return false;
}
// Checks if a node has any children
function hasChildNode(parentNode) {
	if(parentNode == nodes.length) {return false;}
	var nodeValues = nodes[parentNode].split("|");
	if (nodeValues[1] == parentNode) return true;

	return false;
}
// Checks if a node is the last sibling
function lastSibling (node, parentNode) {
	if(node == nodes.length) {return true;}

	var nodeValues = nodes[node].split("|");
	if (nodeValues[1] == parentNode) {return false;}

	return true;
}
// Adds a new node in the tree
function addNode(parentNode, recursedNodes) {
	for (var i = parentNode; i < nodes.length; i++) {
		var nodeValues = nodes[i].split("|");
		if (nodeValues[1] == parentNode) {
			
			var ls	= lastSibling(nodeValues[0], nodeValues[1]);
			var hcn	= hasChildNode(nodeValues[0]);
			var ino = isNodeOpen(nodeValues[0]);

			// Write out line & empty icons
			for (g=0; g<recursedNodes.length; g++) {
				if (recursedNodes[g] == 1) document.write("<img src=\"/cms/img/line.gif\" align=\"absbottom\" alt=\"\" />");
				else  document.write("<img src=\"/cms/img/empty.gif\" align=\"absbottom\" alt=\"\" />");
			}

			// put in array line & empty icons
			if (ls) recursedNodes.push(0);
			else recursedNodes.push(1);

			// Write out join icons
			if (hcn) {
				if (ls) {
					document.write("<a href=\"javascript: oc(" + nodeValues[0] + ", 1);\"><img id=\"join" + nodeValues[0] + "\" src=\"/cms/img/");
					 	if (ino) document.write("minus");
						else document.write("plus");
					document.write("/cms/bottom.gif\" align=\"absbottom\" alt=\"Open/Close node\" /></a>");
				} else {
					document.write("<a href=\"javascript: oc(" + nodeValues[0] + ", 0);\"><img id=\"join" + nodeValues[0] + "\" src=\"/cms/img/");
						if (ino) document.write("minus");
						else document.write("plus");
					document.write(".gif\" align=\"absbottom\" alt=\"Open/Close node\" /></a>");
				}
			} else {
				if (ls) document.write("<img src=\"/cms/img/join.gif\" align=\"absbottom\" alt=\"\" />");
				else document.write("<img src=\"/cms/img/joinbottom.gif\" align=\"absbottom\" alt=\"\" />");
			}

			// Start link
			document.write("<a href=\"javascript://\" onmouseover=\"window.status='" + nodeValues[2] + "';return true;\" onmouseout=\"window.status=' ';return true;\">");
			
			// Write out folder & page icons
//			if (hcn) {
			if (nodeValues[4] == 'folder') {
				document.write("<img id=\"icon" + nodeValues[0] + "\" src=\"/cms/img/folder")
					if (ino) document.write("open");
				document.write(".gif\" align=\"absbottom\" alt=\"Folder\" />");
			} else document.write("<img id=\"icon" + nodeValues[0] + "\" src=\"/cms/img/page.gif\" align=\"absbottom\" alt=\"Page\" />");
			
			// Start link
			document.write("<a id=\"link" + nodeValues[0] + "\" onclick='select(this, \""+nodeValues[4]+"\", "+nodeValues[5]+")'" + "  href=\"javascript://\" onmouseover=\"window.status='" + nodeValues[2] + "';return true;\" onmouseout=\"window.status=' ';return true;\" style=\"color: "+nodeValues[3]+"\">");

			// Write out node name
			if (nodeValues[4] == 'folder') {
				document.write(nodeValues[2]);
			} else if (nodeValues[4] == 'item') {
				document.write(nodeValues[2]);
			} else {
				document.write(nodeValues[5]+'.html');
			}

			// End link
			document.write("</a><br />");
			
			// If node has children write out divs and go deeper
			if (hcn) {
				document.write("<div id=\"div" + nodeValues[0] + "\"");
					if (!ino) document.write(" style=\"display: none;\"");
				document.write(">");
				addNode(nodeValues[0], recursedNodes);
				document.write("</div>");
			}
			
			// remove last line or empty icon 
			recursedNodes.pop();
		}
	}
}
// Opens or closes a node
function oc(node, bottom) {
	var theDiv = document.getElementById("div" + node);
	var theJoin	= document.getElementById("join" + node);
	var theIcon = document.getElementById("icon" + node);
	
	if (theDiv.style.display == 'none') {
		if (bottom==1) theJoin.src = icons[3].src;
		else theJoin.src = icons[2].src;
		theIcon.src = icons[5].src;
		theDiv.style.display = '';
	} else {
		if (bottom==1) theJoin.src = icons[1].src;
		else theJoin.src = icons[0].src;
		theIcon.src = icons[4].src;
		theDiv.style.display = 'none';
	}
}

// Push and pop not implemented in IE(crap!    don´t know about NS though)
if(!Array.prototype.push) {
	function array_push() {
		for(var i=0;i<arguments.length;i++)
			this[this.length]=arguments[i];
		return this.length;
	}
	Array.prototype.push = array_push;
}
if(!Array.prototype.pop) {
	function array_pop(){
		lastElement = this[this.length-1];
		this.length = Math.max(this.length-1,0);
		return lastElement;
	}
	Array.prototype.pop = array_pop;
}
