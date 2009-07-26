function getXmlHttpRequestObject() { 
	if (window.XMLHttpRequest) { 
		return new XMLHttpRequest(); 
	} else if(window.ActiveXObject) { 
		return new ActiveXObject("Microsoft.XMLHTTP"); 
	} else { 
		alert('Status: Cound not create XmlHttpRequest Object. Consider upgrading your browser.'); 
	} 
} 
function doAjaxLoadingTextNoCache(url,method,getStr,postStr,divtag,loading,loadingtext,functionname,functionnameonly,redirect) {
	if(divtag) {
		elem = getElementIdRef(divtag);
	} else {
		return false;
	}
	var Req = getXmlHttpRequestObject(); 
	if(loading=="yes") {  
		if(loadingtext) {
			var newdiv = document.createElement("div");
			newdiv.innerHTML = loadingtext;
			elem.innerHTML = '';
			elem.appendChild(newdiv); 
		} else { 
			var newdiv = document.createElement("div");
			newdiv.innerHTML = "Loading ...";
			elem.innerHTML = '';
			elem.appendChild(newdiv); 
		}
	} 
	if (Req.readyState == 4 || Req.readyState == 0) {  
		if(method=="GET") { 
			Req.open("GET", url+"?"+getStr, true);  
		} else if(method=="POST") { 
			Req.open("POST", url+"?"+getStr, true);  
			Req.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 
		} else { 
			Req.open("GET", url+"?"+getStr, true);  
		} 
		Req.onreadystatechange = function() { 
			if (Req.readyState == 4) {  
				var xmldoc = Req.responseText;  
				if(functionname) {
					if(xmldoc=="1") {						
						if(elem) { 
							var newdiv = document.createElement("div");
							newdiv.innerHTML = xmldoc;
							elem.innerHTML = '';
							elem.appendChild(newdiv); 
						}
						eval(functionname);
					} else if(elem) { 
						var newdiv = document.createElement("div");						
						newdiv.innerHTML = xmldoc;
						elem.innerHTML = '';
						elem.appendChild(newdiv); 
					} 
				} else if(functionnameonly) {
					if(elem) { 	
						var newdiv = document.createElement("div");					
						newdiv.innerHTML = xmldoc;
						elem.innerHTML = '';
						elem.appendChild(newdiv); 
					}
					eval(functionnameonly);
				} else {
					if(redirect) {
						if(xmldoc=="1") {
							location.href=HTTPPath+redirect;
						} else if(elem) { 		
							var newdiv = document.createElement("div");					
							newdiv.innerHTML = xmldoc;
							elem.innerHTML = '';
							elem.appendChild(newdiv); 
						}
					} else { 
						if(elem) { 	
							var newdiv = document.createElement("div");						
							newdiv.innerHTML = xmldoc;
							elem.innerHTML = '';
							elem.appendChild(newdiv); 
						} 
					}
				}
			}  
		}  
		if(method=="GET") { 
			Req.send(null);   
		} else if(method=="POST") { 
			Req.send(postStr);  
		} else { 
			Req.send(null);  
		} 
	} 
}
function doAjaxLoadingText(url,method,getStr,postStr,divtag,loading,loadingtext,functionname,functionnameonly,redirect,cache_key,cacheyes) {
	if(divtag) {
		elem = getElementIdRef(divtag);
	} else {
		return false;
	}
	if(cacheyes=="1") {
		if($.jCache.hasItem(cache_key)) {
			if(elem) { 
				var newdiv = document.createElement("div");
				newdiv.innerHTML = $.jCache.getItem(cache_key);
				elem.innerHTML = '';
				elem.appendChild(newdiv); 
				if(functionnameonly) {
					eval(functionnameonly);
				}
				return false;
			} 
		}
	}
	var Req = getXmlHttpRequestObject(); 
	if(loading=="yes") {  
		if(loadingtext) {
			var newdiv = document.createElement("div");
			newdiv.innerHTML = loadingtext;
			elem.innerHTML = '';
			elem.appendChild(newdiv); 
		} else { 
			var newdiv = document.createElement("div");
			newdiv.innerHTML = "Loading ...";
			elem.innerHTML = '';
			elem.appendChild(newdiv); 
		}
	} 
	if (Req.readyState == 4 || Req.readyState == 0) {  
		if(method=="GET") { 
			Req.open("GET", url+"?"+getStr, true);  
		} else if(method=="POST") { 
			Req.open("POST", url+"?"+getStr, true);  
			Req.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 
		} else { 
			Req.open("GET", url+"?"+getStr, true);  
		} 
		Req.onreadystatechange = function() { 
			if (Req.readyState == 4) {  
				var xmldoc = Req.responseText;  
				if(cacheyes=="1") {
					$.jCache.setItem(cache_key, xmldoc);
				}
				if(functionname) {
					if(xmldoc=="1") {						
						if(elem) { 
							var newdiv = document.createElement("div");
							newdiv.innerHTML = xmldoc;
							elem.innerHTML = '';
							elem.appendChild(newdiv); 
						}
						eval(functionname);
					} else if(elem) { 
						var newdiv = document.createElement("div");						
						newdiv.innerHTML = xmldoc;
						elem.innerHTML = '';
						elem.appendChild(newdiv); 
					} 
				} else if(functionnameonly) {
					if(elem) { 	
						var newdiv = document.createElement("div");					
						newdiv.innerHTML = xmldoc;
						elem.innerHTML = '';
						elem.appendChild(newdiv); 
					}
					eval(functionnameonly);
				} else {
					if(redirect) {
						if(xmldoc=="1") {
							location.href=HTTPPath+redirect;
						} else if(elem) { 		
							var newdiv = document.createElement("div");					
							newdiv.innerHTML = xmldoc;
							elem.innerHTML = '';
							elem.appendChild(newdiv); 
						}
					} else { 
						if(elem) { 	
							var newdiv = document.createElement("div");						
							newdiv.innerHTML = xmldoc;
							elem.innerHTML = '';
							elem.appendChild(newdiv); 
						} 
					}
				}
			}  
		}  
		if(method=="GET") { 
			Req.send(null);   
		} else if(method=="POST") { 
			Req.send(postStr);  
		} else { 
			Req.send(null);  
		} 
	} 
} 
function getFormElements(frm) { 
	var getstr = ""; 
	for (i=0; i<frm.length; i++) { 
		//alert(frm.elements[i].tagName+" "+frm.elements[i].name+" "+frm.elements[i].value); 
		if (frm.elements[i].tagName == "INPUT") { 
			if (frm.elements[i].type == "text") { 
				getstr += frm.elements[i].name + "=" + encodeURIComponent(frm.elements[i].value) + "&"; 
			} 
			if (frm.elements[i].type == "password") { 
				getstr += frm.elements[i].name + "=" + encodeURIComponent(frm.elements[i].value) + "&"; 
			} 

			if (frm.elements[i].type == "hidden") { 
				getstr += frm.elements[i].name + "=" + encodeURIComponent(frm.elements[i].value) + "&"; 
			} 
			if (frm.elements[i].type == "button") { 
				getstr += frm.elements[i].name + "=" + encodeURIComponent(frm.elements[i].value) + "&"; 
			} 
			if (frm.elements[i].type == "checkbox") { 
				if (frm.elements[i].checked) { 
					getstr += frm.elements[i].name + "=" + encodeURIComponent(frm.elements[i].value) + "&"; 
				} else { 
					getstr += frm.elements[i].name + "=&"; 
				} 
			} 
			if (frm.elements[i].type == "radio") { 
				if (frm.elements[i].checked) { 
					getstr += frm.elements[i].name + "=" + encodeURIComponent(frm.elements[i].value) + "&"; 
				} 
			} 
		} 
		if (frm.elements[i].tagName == "SELECT") { 
			var sel = frm.elements[i]; 
			if(sel.options.length>0) { 
				for (var j=sel.options.length-1; j >= 0;j--) { 
					if (sel.options[j].selected) { 
						getstr += sel.name + "=" + sel.options[j].value + "&"; 
					} 
				} 
			} else { 
				if(sel.selectedIndex>=0) {
					if(sel.options[sel.selectedIndex].value) {
						getstr += sel.name + "=" + sel.options[sel.selectedIndex].value + "&"; 
					}
				}
			} 
		}  
		if (frm.elements[i].tagName == "TEXTAREA") { 
			getstr += frm.elements[i].name + "=" + encodeURIComponent(frm.elements[i].value) + "&"; 
		} 
	} 
	return getstr; 
} 
function tog(divID)
{
	theDiv = document.getElementById(divID);
	theDiv.style.display = theDiv.style.display == 'block' ? 'none' : 'block';
}
function confirmDelete(msg) {
	str=confirm(msg);
	if(str)
		return true;
	else 
		return false;
}
function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
  //onclick="GP_popupConfirmMsg('Are you sure you want to delete this record?');return document.MM_returnValue"
}
function doAjaxXMLSelectBox(url,method,getStr,postStr,selectBox) { 
	var Req = getXmlHttpRequestObject(); 
	removeAllOptions(selectBox);
	addOption(selectBox, "Loading....","0");
	if (Req.readyState == 4 || Req.readyState == 0) {  
		if(method=="GET") { 
			Req.open("GET", url+"?"+getStr, true);  
		} else if(method=="POST") { 
			Req.open("POST", url+"?"+getStr, true);  
			Req.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 
		} else { 
			Req.open("GET", url+"?"+getStr, true);  
		} 
		Req.onreadystatechange = function() { 
			if (Req.readyState == 4) {  
				var xmldoc = Req.responseXML; 
    			if(xmldoc) {      
     				var message_nodes = xmldoc.getElementsByTagName("message");  
     				var n_messages = message_nodes.length;
					removeAllOptions(selectBox);
					addOption(selectBox, "Select","0");
					for (i = 0; i < n_messages; i++) { 
      					name1 = message_nodes[i].getElementsByTagName("name"); 
      					id1 = message_nodes[i].getElementsByTagName("id"); 
						name = name1[0].firstChild.nodeValue;
						id = id1[0].firstChild.nodeValue;			
						addOption(selectBox, name, id);
					}
				}
			}  
		}  
		if(method=="GET") { 
			Req.send(null);   
		} else if(method=="POST") { 
			Req.send(postStr);  
		} else { 
			Req.send(null);  
		} 
	} 
} 

function handleKey2(e)  
{ 
  // get the event 
  e = (!e) ? window.event : e; 
  // get the code of the character that has been pressed         
  code = (e.charCode) ? e.charCode : 
         ((e.keyCode) ? e.keyCode : 
         ((e.which) ? e.which : 0)); 
  // handle the keydown event        
  if (e.type == "keydown")  
  { 
    // if enter (code 13) is pressed 
    return code; 
  } 
} 

function getElementIdRef(whichLayer) {
	if (document.getElementById){ 
		refid = document.getElementById(whichLayer); 
	} else if (document.all) { 
		refid = document.all[whichLayer]; 
	} else if (document.layers) { 
		refid = document.layers[whichLayer]; 
	} 
	return refid;
}
function toggleLayer(whichLayer, iState) { 
 if (document.getElementById){ 
  // this is the way the standards work 
  var style2 = document.getElementById(whichLayer).style; 
  style2.display = iState? "":"none"; 
 } else if (document.all) { 
  // this is the way old msie versions work 
  var style2 = document.all[whichLayer].style; 
  style2.display = iState? "":"none"; 
 } else if (document.layers) { 
  // this is the way nn4 works 
  var style2 = document.layers[whichLayer].style; 
  style2.display = iState? "":"none"; 
 } 
} 

function trim(stringToTrim) { 
 return stringToTrim.replace(/^\s+|\s+$/g,""); 
} 
function ltrim(stringToTrim) { 
 return stringToTrim.replace(/^\s+/,""); 
} 
function rtrim(stringToTrim) { 
 return stringToTrim.replace(/\s+$/,""); 
} 

function tfm_confirmLink(message) { //v1.0 
 if(message == "") message = "Ok to continue?";  
 document.MM_returnValue = confirm(message); 
} 
 
function checkemail(str){ 
 var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i; 
 if (filter.test(str)) 
  testresults=true; 
 else{ 
  alert("Please input a valid email address!"); 
  testresults=false; 
 } 
 return (testresults); 
} 
function fast(ele) 
 { 
 ele.scrollAmount = 2; 
 } 
function slow(ele) 
 { 
 ele.scrollAmount = 0; 
 } 
  
 function clearAll() { 
 clearTimeout(discussionStartsHere); 
} 
function removeAllOptions(selectbox) {
	var i;
	for(i=selectbox.options.length-1;i>=0;i--){
		selectbox.remove(i);
	}
}

function removeOptions(selectbox) {
	var i;
	for(i=selectbox.options.length-1;i>=0;i--) {
		if(selectbox.options[i].selected) {
			selectbox.remove(i);
		}
	}
}

function addOption(selectbox,text,value ) {
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	selectbox.options.add(optn);
}

function addOption_list(selectbox){
	addOption(document.drop_list.SubCat, "One","One");
	addOption(document.drop_list.SubCat, "Two","Two");
	addOption(document.drop_list.SubCat, "Three","Three");
	addOption(document.drop_list.SubCat, "Four","Four");
	addOption(document.drop_list.SubCat, "Five","Five");
	addOption(document.drop_list.SubCat, "Six","Six");
}
function datepicker() {
	jQuery(function($){
		$(".datepick").datepicker();
	});	
}
function datetimepicker() {
	jQuery(function($){
		$(".datepick").datepicker();
		$(".timepick").timePicker();
	});	
}
function loadjscssfile(filename, filetype){
	if (filetype=="js"){ //if filename is a external JavaScript file
		var fileref=document.createElement('script');
		fileref.setAttribute("type","text/javascript");
		fileref.setAttribute("src", filename);
	}
	else if (filetype=="css"){ //if filename is an external CSS file
		var fileref=document.createElement("link");
		fileref.setAttribute("rel", "stylesheet");
		fileref.setAttribute("type", "text/css");
		fileref.setAttribute("href", filename);
	}
	if (typeof fileref!="undefined") {
		document.getElementsByTagName("head")[0].appendChild(fileref);
	}
	// usage
	//loadjscssfile("javascript.php", "js") 
	//loadjscssfile("mystyle.css", "css") 
}