function $(id) {
	return document.getElementById(id);
}
// AJAX INIT
function khoitao_ajax()
{
	var x;
	try 
	{
		x	=	new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
    	try 
		{
			x	=	new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(f) { x	=	null; }
  	}
	if	((!x)&&(typeof XMLHttpRequest!="undefined"))
	{
		x=new XMLHttpRequest();
  	}
	return  x;
}
//	Sieu thi dia oc function
function	Forward(url)
{
	window.location.href = url;
}
function	_postback()
{
	return void(1);
}
/*14-8-2013 Author: Dieu*/
function selectOnList()
{
	var objChBox=document.getElementsByName("tik[]");
	for(var i=0;i<objChBox.length;i++)
	{
		objChBox[i].checked=true;		
	}
	var slCheckAll=document.getElementById("slChkAll");
	console.log(slCheckAll);
	slCheckAll.value='Bỏ chọn';
	slCheckAll.setAttribute("onClick","unSelectOnList()");
}
function unSelectOnList()
{
	var objChBox=document.getElementsByName("tik[]");
	for(var i=0;i<objChBox.length;i++)
	{
		objChBox[i].checked=false;
	}
	var slCheckAll=document.getElementById("slChkAll");
	
	slCheckAll.value='Chọn hết';
	slCheckAll.setAttribute("onClick","selectOnList()");
}