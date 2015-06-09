var vsf={get:function(act,id,options){($("div[id]").each(function(){if(this.id.indexOf('subForm')!=-1)
$("#"+this.id).html('');}));var params={vs:act,ajax:1};params=$.extend({},params,options);var noimage="";if(typeof(noimage)=="undefine"||!noimage&&id!='')
$("#"+id).html('<img src="'+imgurl+'loader.gif"/>');$.get(ajaxfile,params,function(data){if(id!=''){if($("#"+id).length>0)$("#"+id).children().remove();data=data.replace("id=\""+id+"\"","");data=data.replace("id='"+id+"'","");$("#"+id).html(data).css('display','none')
$("#"+id).fadeIn('slow');if($('#page_tabs').html()!=null&&$('#page_tabs').html()!='undefined')
$('#page_tabs').tabs();}});},popupGet:function(act,id,w,h,title){if(!this.isDefined(w))w=500;if(!this.isDefined(h))h=500;if(!title)
title="Thông báo - "+global_website_title;if(!$("#"+id).html()){$("body").append("<div id='"+id+"' class='"+id+"' > </div>");}
vsf.get(act,id);$(document).ready(function(){$("#"+id).dialog({modal:true,width:w,height:h,title:title});$("#"+id).bind("dialogclose",function(event,ui){$(this).remove();});});},popupLightGet:function(act,id,w,h,options){var defaults={resizable:false,width:w,height:h,bgiframe:true,modal:true}
options=$.extend({},defaults,options);if(!this.isDefined(w))w=500;if(!this.isDefined(h))h=500;if(!$("#"+id).html())
$("body").append("<div id='"+id+"' class='"+id+"' > </div>");vsf.get(act,id);$(document).ready(function(){$("#"+id).dialog(options);$("#"+id).bind("dialogclose",function(event,ui){$(this).remove();});var maxZ=Math.max.apply(null,$.map($('body > *'),function(e,n){if($(e).css('position')=='absolute')
return parseInt($(e).css('z-index'))||1;}));$("#"+id+",.ui-dialog,.ac_results").css("z-index",maxZ);});},submitForm:function(obj,act,id,options){var defaults={json:false,sucess:function(data){if(id!=''){data=data.replace("id=\""+id+"\"","");data=data.replace("id='"+id+"'","");$("#"+id).html(data).css('display','none')
$("#"+id).fadeIn('slow');$('#page_tabs').tabs();}}}
options=$.extend({},defaults,options);if(typeof(tinyMCE)!="undefined")tinyMCE.triggerSave();var params={vs:act,ajax:1};var count=0;obj.find("input[type='radio']:checked, input[checked], input[type='text'], input[type='hidden'], input[type='password'], input[type='submit'], option[selected], textarea").each(function(){params[this.name||this.id||this.parentNode.name||this.parentNode.id]=this.value;});$("#"+id).children().remove();if(id!='')
$("#"+id).html('<img src="'+imgurl+'loader.gif"/>');if(options.json){$.post(ajaxfile,params,function(data){options.sucess(data)},"json");}else{$.post(ajaxfile,params,function(data){options.sucess(data)});}},submitFormAllCheckBox:function(obj,act,id){if(typeof(tinyMCE)!="undefined")tinyMCE.triggerSave();if(id!='')
$("#"+id).html('<img src="'+imgurl+'loader.gif"/>');var params={vs:act,ajax:1};var count=0;obj.find("input[type='radio']:checked, input[type='checkbox'], input[type='text'], input[type='hidden'], input[type='password'], input[type='submit'], option[selected], textarea").each(function(){params[this.name||this.id||this.parentNode.name||this.parentNode.id]=this.value;});$.post(ajaxfile,params,function(data){if(id!=''){data=data.replace("id=\""+id+"\"","");data=data.replace("id='"+id+"'","");$("#"+id).html(data).css('display','none')
$("#"+id).fadeIn('slow');$('#page_tabs').tabs();}});},isDefined:function(obj){return(typeof(obj)=="undefined")?false:true;},removeForm:function(id){$("#"+id).html('');},jSelect:function(the_value,idselect){$("#"+idselect+" option").each(function(){if(the_value==$(this).val())
$(this).attr('selected','selected');});},jCheckbox:function(the_value,id){if(!$('#'+id))
return;if(the_value==$('#'+id).val()){$('#'+id).attr('checked','checked');return true;}},jRadio:function(the_value,name){$("[name="+name+"]").each(function(){if(the_value==$(this).val())
{$(this).attr('checked','checked');}});},alert:function(message){jAlert(message,'Hộp thông báo - '+global_website_title);},uploadFile:function(formId,module,action,objIdCallBack,fileFolder,utype,callbackfunction){var countFile=0;if(typeof(utype)=='undefined')utype=1;$("#"+formId).find("input[type='file']").each(function(){if(this.value&&!this.disabled){countFile++;}});if(countFile>0){$('#error-message').ajaxStart(function(){$(this).html("<img src='"+imgurl+"loader.gif' alt='loading' />");});var file="";$("#"+formId).find("input[type='file']").each(function(){if(this.value&&!this.disabled){var name=this.name;var filetitle=$("#"+formId).find("#fileTitle").val();var fileindex=$("#"+formId).find("#fileIndex").val();var uri=baseUrl+"files/files_uploadfile/&ajax=1&uploadName="+name+"&fileFolder="+fileFolder+"&table="+module+"&fileTitle="+filetitle+"&fileIndex="+fileindex+'&utype='+utype;if(this.id==''){this.id=this.name;}
var id=this.id;$.ajaxFileUpload({url:uri,secureuri:false,fileElementId:id,dataType:"json",success:function(data,status){countFile--;if(typeof(data.error)!='undefined'||data.error==null){if(data.error!=''&&data.error!=null){jAlert(data.error,"Vietsol Infomation");}
else{$("#"+formId).append("<input hidden='' name='files["+name+"]' value='"+data.id+"'/>");if(countFile==0){if(typeof(callbackfunction)=='function'){vsf.submitForm($('#'+formId),module+'/'+action+'/','_');if(typeof(callbackfunction)=='function')callbackfunction();}else{vsf.submitForm($('#'+formId),module+'/'+action+'/',objIdCallBack);}
return false;}}}},error:function(data,status,e){countFile--;$('#error-message').ajaxStop(function(){$(this).html(e);});return false;}});}});}
else{$('#error-message').ajaxStop(function(){$(this).html('');});if(typeof(callbackfunction)=='function'){vsf.submitForm($('#'+formId),module+'/'+action+'/','_');if(typeof(callbackfunction)=='function')callbackfunction();}else{vsf.submitForm($('#'+formId),module+'/'+action+'/',objIdCallBack);}
return false;}
$('#error-message').ajaxStop(function(){$(this).html('');});return false;},checkAll:function(clas,ret){if(!clas||typeof(clas)=="undefined")clas='myCheckbox';if(!ret||typeof(ret)=="undefined")ret='checked-obj';var checked_status=$("input[name=all]:checked").length;var checkedString='';$("input[type=checkbox]").each(function(){if($(this).hasClass(clas)){this.checked=checked_status;if(checked_status)checkedString+=$(this).val()+',';}});$("span[acaica="+clas+"]").each(function(){if(checked_status)
this.style.backgroundPosition="0 -50px";else this.style.backgroundPosition="0 0";});checkedString=checkedString.substr(0,checkedString.lastIndexOf(','));$('#'+ret).val(checkedString);},checkObject:function(clas,ret){if(!clas||typeof(clas)=="undefined")clas='myCheckbox';if(!ret||typeof(ret)=="undefined")ret='checked-obj';var checkedString='';$("input[type=checkbox]").each(function(){if($(this).hasClass(clas)){if(this.checked)checkedString+=$(this).val()+',';}});checkedString=checkedString.substr(0,checkedString.lastIndexOf(','));$('#'+ret).val(checkedString);},checkValue:function(ret){if(!ret||typeof(ret)=="undefined")ret='checked-obj';if(!$('#'+ret).val()||$('#'+ret).val()==""){jAlert(global_website_choise,global_website_title+" Dialog");return false;}
return true;}};if($.browser.msie){$(document).ready(function(){$('[placeholder]').each(function(){if($(this).val()==''){$(this).val($(this).attr('placeholder'));$(this).addClass('placeholder');}});});$('[placeholder]').live('focus',function(){var input=$(this);if(input.val()==input.attr('placeholder')){input.val('');input.removeClass('placeholder');}});$('[placeholder]').live('blur',function(){var input=$(this);if(input.val()==''||input.val()==input.attr('placeholder')){input.addClass('placeholder');input.val(input.attr('placeholder'));}});$('form').live('submit',function(){$(this).find('[placeholder]').each(function(){var input=$(this);if(input.val()==input.attr('placeholder')){input.val('');}})});};(function($){$.alerts={verticalOffset:-75,horizontalOffset:0,repositionOnResize:true,overlayOpacity:.01,overlayColor:'#FFF',draggable:true,okButton:'&nbsp;OK&nbsp;',cancelButton:'&nbsp;Cancel&nbsp;',dialogClass:null,alert:function(message,title,callback){if(title==null)title='Alert';$.alerts._show(title,message,null,'alert',function(result){if(callback)callback(result);});},confirm:function(message,title,callback){if(title==null)title='Confirm';$.alerts._show(title,message,null,'confirm',function(result){if(callback)callback(result);});},prompt:function(message,value,title,callback){if(title==null)title='Prompt';$.alerts._show(title,message,value,'prompt',function(result){if(callback)callback(result);});},_show:function(title,msg,value,type,callback){$.alerts._hide();$.alerts._overlay('show');$("BODY").append('<div id="popup_container" style="overflow: hidden; display: block; position: fixed; z-index: 1021; outline-color: -moz-use-text-color; outline-style: none; outline-width: 0px; height: auto; width: 300px; top: 320px; left: 350.5px;" class="ui-dialog ui-widget ui-widget-content ui-corner-all" tabindex="-1">'+'<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" unselectable="on" style="-moz-user-select: none;">'+'<span id="ui-dialog-title-dialog" class="ui-dialog-title" unselectable="on" style="-moz-user-select: none;">'+'</span></div>'+'<div id="popup_content">'+'<div id="popup_message" class="ui-dialog-content ui-widget-content"></div>'+'</div>'+'</div>');if($.alerts.dialogClass)$("#popup_container").addClass($.alerts.dialogClass);var pos=($.browser.msie&&parseInt($.browser.version)<=6)?'absolute':'fixed';$("#popup_container").css({zIndex:9999,width:350,position:pos});$("#ui-dialog-title-dialog").text(title);$('.ui-dialog-titlebar-close').attr('role','button').hover(function(){$(this).addClass('ui-state-hover');},function(){$(this).removeClass('ui-state-hover');}).click(function(){$.alerts._hide();if(callback)callback(false);});$("#popup_content").addClass(type);$("#popup_message").text(msg).css({padding:'5px 10px'});$("#popup_message").html($("#popup_message").text().replace(/\n/g,'<br />'));$("#popup_container").css({minWidth:$("#popup_container").outerWidth(),maxWidth:$("#popup_container").outerWidth()});$.alerts._reposition();$.alerts._maintainPosition(true);switch(type){case'alert':$("#popup_message").after('<div id="popup_panel" class="ui-dialog-buttonpane ui-helper-clearfix"><button type="button"  id="popup_ok" class="ui-state-default ui-corner-all ui-state-focus">'+$.alerts.okButton+'</button></div>');$("#popup_ok").click(function(){$.alerts._hide();callback(true);});$("#popup_ok").focus().keypress(function(e){if(e.keyCode==13||e.keyCode==27)$("#popup_ok").trigger('click');});break;case'confirm':$("#popup_message").after('<div id="popup_panel" class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"><button type="button" id="popup_cancel" class="ui-state-default ui-corner-all ui-state-focus" >'+$.alerts.cancelButton+'</button><button type="button"  id="popup_ok" class="ui-state-default ui-corner-all ui-state-focus">'+$.alerts.okButton+'</button></div> ');$("#popup_ok").click(function(){$.alerts._hide();if(callback)callback(true);});$("#popup_cancel").click(function(){$.alerts._hide();if(callback)callback(false);});$("#popup_ok").focus();$("#popup_ok, #popup_cancel").keypress(function(e){if(e.keyCode==13)$("#popup_ok").trigger('click');if(e.keyCode==27)$("#popup_cancel").trigger('click');});break;case'prompt':$("#popup_message").append('<br /><input type="text" size="30" id="popup_prompt" />').after('<div id="popup_panel" class="ui-dialog-buttonpanel ui-helper-clearfix"><button type="button"  id="popup_ok" class="ui-state-default ui-corner-all ui-state-focus">'+$.alerts.okButton+'</button> <button type="button" id="popup_cancel" class="ui-state-default ui-corner-all ui-state-focus" >'+$.alerts.cancelButton+'</button</div>');$("#popup_prompt").width($("#popup_message").width());$("#popup_ok").click(function(){var val=$("#popup_prompt").val();$.alerts._hide();if(callback)callback(val);});$("#popup_cancel").click(function(){$.alerts._hide();if(callback)callback(null);});$("#popup_prompt, #popup_ok, #popup_cancel").keypress(function(e){if(e.keyCode==13)$("#popup_ok").trigger('click');if(e.keyCode==27)$("#popup_cancel").trigger('click');});if(value)$("#popup_prompt").val(value);$("#popup_prompt").focus().select();break;}
if($.alerts.draggable){try{$("#popup_container").draggable({handle:$(".ui-dialog-titlebars")});$(".ui-dialog-titlebars").css({cursor:'move'});}catch(e){}}},_hide:function(){$("#popup_container").remove();$.alerts._overlay('hide');$.alerts._maintainPosition(false);},_overlay:function(status){switch(status){case'show':$.alerts._overlay('hide');$("BODY").append('<div id="popup_overlay" class="ui-widget-overlay"></div>');$("#popup_overlay").css({position:'absolute',zIndex:1001,top:'0px',left:'0px',width:'100%',height:$(document).height()});break;case'hide':$("#popup_overlay").remove();break;}},_xDef:function(){for(var i=0;i<arguments.length;++i){if(typeof(arguments[i])==""||typeof(arguments[i])=="undefined")return false;}
return true;},_xScrollTop:function(){var offset=0;if($.alerts._xDef(window.pageYOffset))offset=window.pageYOffset;else if(document.documentElement&&document.documentElement.scrollTop)offset=document.documentElement.scrollTop;else if(document.body&&$.alerts._xDef(document.body.scrollTop))offset=document.body.scrollTop;return offset;},_reposition:function(){var top=(($(window).height()/2)-($("#popup_container").outerHeight()/2))+$.alerts.verticalOffset;var left=(($(window).width()/2)-($("#popup_container").outerWidth()/2))+$.alerts.horizontalOffset;if(top<0)top=0;if(left<0)left=0;$("#popup_container").css({top:top+'px',left:left+'px'});$("#popup_overlay").height($(document).height());},_maintainPosition:function(status){if($.alerts.repositionOnResize){switch(status){case true:$(window).bind('resize',function(){$.alerts._reposition();});break;case false:$(window).unbind('resize');break;}}}}
jAlert=function(message,title,callback){$.alerts.alert(message,title,callback);}
jAlertClose=function(){$.alerts._hide();}
jConfirm=function(message,title,callback){$.alerts.confirm(message,title,callback);};jPrompt=function(message,value,title,callback){$.alerts.prompt(message,value,title,callback);};})(jQuery);;var config=new Object();var tt_Debug=true
var tt_Enabled=true
var TagsToTip=true
config.Above=false
config.BgColor='#E2E7FF'
config.BgImg=''
config.BorderColor='#003099'
config.BorderStyle='solid'
config.BorderWidth=1
config.CenterMouse=false
config.ClickClose=false
config.ClickSticky=false
config.CloseBtn=false
config.CloseBtnColors=['#990000','#FFFFFF','#DD3333','#FFFFFF']
config.CloseBtnText='&nbsp;X&nbsp;'
config.CopyContent=true
config.Delay=400
config.Duration=0
config.Exclusive=false
config.FadeIn=100
config.FadeOut=100
config.FadeInterval=30
config.Fix=null
config.FollowMouse=true
config.FontColor='#000044'
config.FontFace='Verdana,Geneva,sans-serif'
config.FontSize='8pt'
config.FontWeight='normal'
config.Height=0
config.JumpHorz=false
config.JumpVert=true
config.Left=false
config.OffsetX=14
config.OffsetY=8
config.Opacity=100
config.Padding=3
config.Shadow=false
config.ShadowColor='#C0C0C0'
config.ShadowWidth=5
config.Sticky=false
config.TextAlign='left'
config.Title=''
config.TitleAlign='left'
config.TitleBgColor=''
config.TitleFontColor='#FFFFFF'
config.TitleFontFace=''
config.TitleFontSize=''
config.TitlePadding=2
config.Width=0
function Tip()
{tt_Tip(arguments,null);}
function TagToTip()
{var t2t=tt_GetElt(arguments[0]);if(t2t)
tt_Tip(arguments,t2t);}
function UnTip()
{tt_OpReHref();if(tt_aV[DURATION]<0&&(tt_iState&0x2))
tt_tDurt.Timer("tt_HideInit()",-tt_aV[DURATION],true);else if(!(tt_aV[STICKY]&&(tt_iState&0x2)))
tt_HideInit();}
var tt_aElt=new Array(10),tt_aV=new Array(),tt_sContent,tt_t2t,tt_t2tDad,tt_musX,tt_musY,tt_over,tt_x,tt_y,tt_w,tt_h;function tt_Extension()
{tt_ExtCmdEnum();tt_aExt[tt_aExt.length]=this;return this;}
function tt_SetTipPos(x,y)
{var css=tt_aElt[0].style;tt_x=x;tt_y=y;css.left=x+"px";css.top=y+"px";if(tt_ie56)
{var ifrm=tt_aElt[tt_aElt.length-1];if(ifrm)
{ifrm.style.left=css.left;ifrm.style.top=css.top;}}}
function tt_HideInit()
{if(tt_iState)
{tt_ExtCallFncs(0,"HideInit");tt_iState&=~(0x4|0x8);if(tt_flagOpa&&tt_aV[FADEOUT])
{tt_tFade.EndTimer();if(tt_opa)
{var n=Math.round(tt_aV[FADEOUT]/(tt_aV[FADEINTERVAL]*(tt_aV[OPACITY]/tt_opa)));tt_Fade(tt_opa,tt_opa,0,n);return;}}
tt_tHide.Timer("tt_Hide();",1,false);}}
function tt_Hide()
{if(tt_db&&tt_iState)
{tt_OpReHref();if(tt_iState&0x2)
{tt_aElt[0].style.visibility="hidden";tt_ExtCallFncs(0,"Hide");}
tt_tShow.EndTimer();tt_tHide.EndTimer();tt_tDurt.EndTimer();tt_tFade.EndTimer();if(!tt_op&&!tt_ie)
{tt_tWaitMov.EndTimer();tt_bWait=false;}
if(tt_aV[CLICKCLOSE]||tt_aV[CLICKSTICKY])
tt_RemEvtFnc(document,"mouseup",tt_OnLClick);tt_ExtCallFncs(0,"Kill");if(tt_t2t&&!tt_aV[COPYCONTENT])
tt_UnEl2Tip();tt_iState=0;tt_over=null;tt_ResetMainDiv();if(tt_aElt[tt_aElt.length-1])
tt_aElt[tt_aElt.length-1].style.display="none";}}
function tt_GetElt(id)
{return(document.getElementById?document.getElementById(id):document.all?document.all[id]:null);}
function tt_GetDivW(el)
{return(el?(el.offsetWidth||el.style.pixelWidth||0):0);}
function tt_GetDivH(el)
{return(el?(el.offsetHeight||el.style.pixelHeight||0):0);}
function tt_GetScrollX()
{return(window.pageXOffset||(tt_db?(tt_db.scrollLeft||0):0));}
function tt_GetScrollY()
{return(window.pageYOffset||(tt_db?(tt_db.scrollTop||0):0));}
function tt_GetClientW()
{return tt_GetWndCliSiz("Width");}
function tt_GetClientH()
{return tt_GetWndCliSiz("Height");}
function tt_GetEvtX(e)
{return(e?((typeof(e.pageX)!=tt_u)?e.pageX:(e.clientX+tt_GetScrollX())):0);}
function tt_GetEvtY(e)
{return(e?((typeof(e.pageY)!=tt_u)?e.pageY:(e.clientY+tt_GetScrollY())):0);}
function tt_AddEvtFnc(el,sEvt,PFnc)
{if(el)
{if(el.addEventListener)
el.addEventListener(sEvt,PFnc,false);else
el.attachEvent("on"+sEvt,PFnc);}}
function tt_RemEvtFnc(el,sEvt,PFnc)
{if(el)
{if(el.removeEventListener)
el.removeEventListener(sEvt,PFnc,false);else
el.detachEvent("on"+sEvt,PFnc);}}
function tt_GetDad(el)
{return(el.parentNode||el.parentElement||el.offsetParent);}
function tt_MovDomNode(el,dadFrom,dadTo)
{if(dadFrom)
dadFrom.removeChild(el);if(dadTo)
dadTo.appendChild(el);}
var tt_aExt=new Array(),tt_db,tt_op,tt_ie,tt_ie56,tt_bBoxOld,tt_body,tt_ovr_,tt_flagOpa,tt_maxPosX,tt_maxPosY,tt_iState=0,tt_opa,tt_bJmpVert,tt_bJmpHorz,tt_elDeHref,tt_tShow=new Number(0),tt_tHide=new Number(0),tt_tDurt=new Number(0),tt_tFade=new Number(0),tt_tWaitMov=new Number(0),tt_bWait=false,tt_u="undefined";function tt_Init()
{tt_MkCmdEnum();if(!tt_Browser()||!tt_MkMainDiv())
return;tt_IsW3cBox();tt_OpaSupport();tt_AddEvtFnc(document,"mousemove",tt_Move);if(TagsToTip||tt_Debug)
tt_SetOnloadFnc();tt_AddEvtFnc(window,"unload",tt_Hide);}
function tt_MkCmdEnum()
{var n=0;for(var i in config)
eval("window."+i.toString().toUpperCase()+" = "+n++);tt_aV.length=n;}
function tt_Browser()
{var n,nv,n6,w3c;n=navigator.userAgent.toLowerCase(),nv=navigator.appVersion;tt_op=(document.defaultView&&typeof(eval("w"+"indow"+"."+"o"+"p"+"er"+"a"))!=tt_u);tt_ie=n.indexOf("msie")!=-1&&document.all&&!tt_op;if(tt_ie)
{var ieOld=(!document.compatMode||document.compatMode=="BackCompat");tt_db=!ieOld?document.documentElement:(document.body||null);if(tt_db)
tt_ie56=parseFloat(nv.substring(nv.indexOf("MSIE")+5))>=5.5&&typeof document.body.style.maxHeight==tt_u;}
else
{tt_db=document.documentElement||document.body||(document.getElementsByTagName?document.getElementsByTagName("body")[0]:null);if(!tt_op)
{n6=document.defaultView&&typeof document.defaultView.getComputedStyle!=tt_u;w3c=!n6&&document.getElementById;}}
tt_body=(document.getElementsByTagName?document.getElementsByTagName("body")[0]:(document.body||null));if(tt_ie||n6||tt_op||w3c)
{if(tt_body&&tt_db)
{if(document.attachEvent||document.addEventListener)
return true;}
else
tt_Err("wz_tooltip.js must be included INSIDE the body section,"
+" immediately after the opening <body> tag.",false);}
tt_db=null;return false;}
function tt_MkMainDiv()
{if(tt_body.insertAdjacentHTML)
tt_body.insertAdjacentHTML("afterBegin",tt_MkMainDivHtm());else if(typeof tt_body.innerHTML!=tt_u&&document.createElement&&tt_body.appendChild)
tt_body.appendChild(tt_MkMainDivDom());if(window.tt_GetMainDivRefs&&tt_GetMainDivRefs())
return true;tt_db=null;return false;}
function tt_MkMainDivHtm()
{return('<div id="WzTtDiV"></div>'+
(tt_ie56?('<iframe id="WzTtIfRm" src="javascript:false" scrolling="no" frameborder="0" style="filter:Alpha(opacity=0);position:absolute;top:0px;left:0px;display:none;"></iframe>'):''));}
function tt_MkMainDivDom()
{var el=document.createElement("div");if(el)
el.id="WzTtDiV";return el;}
function tt_GetMainDivRefs()
{tt_aElt[0]=tt_GetElt("WzTtDiV");if(tt_ie56&&tt_aElt[0])
{tt_aElt[tt_aElt.length-1]=tt_GetElt("WzTtIfRm");if(!tt_aElt[tt_aElt.length-1])
tt_aElt[0]=null;}
if(tt_aElt[0])
{var css=tt_aElt[0].style;css.visibility="hidden";css.position="absolute";css.overflow="hidden";return true;}
return false;}
function tt_ResetMainDiv()
{tt_SetTipPos(0,0);tt_aElt[0].innerHTML="";tt_aElt[0].style.width="0px";tt_h=0;}
function tt_IsW3cBox()
{var css=tt_aElt[0].style;css.padding="10px";css.width="40px";tt_bBoxOld=(tt_GetDivW(tt_aElt[0])==40);css.padding="0px";tt_ResetMainDiv();}
function tt_OpaSupport()
{var css=tt_body.style;tt_flagOpa=(typeof(css.KhtmlOpacity)!=tt_u)?2:(typeof(css.KHTMLOpacity)!=tt_u)?3:(typeof(css.MozOpacity)!=tt_u)?4:(typeof(css.opacity)!=tt_u)?5:(typeof(css.filter)!=tt_u)?1:0;}
function tt_SetOnloadFnc()
{tt_AddEvtFnc(document,"DOMContentLoaded",tt_HideSrcTags);tt_AddEvtFnc(window,"load",tt_HideSrcTags);if(tt_body.attachEvent)
tt_body.attachEvent("onreadystatechange",function(){if(tt_body.readyState=="complete")
tt_HideSrcTags();});if(/WebKit|KHTML/i.test(navigator.userAgent))
{var t=setInterval(function(){if(/loaded|complete/.test(document.readyState))
{clearInterval(t);tt_HideSrcTags();}},10);}}
function tt_HideSrcTags()
{if(!window.tt_HideSrcTags||window.tt_HideSrcTags.done)
return;window.tt_HideSrcTags.done=true;if(!tt_HideSrcTagsRecurs(tt_body))
tt_Err("There are HTML elements to be converted to tooltips.\nIf you"
+" want these HTML elements to be automatically hidden, you"
+" must edit wz_tooltip.js, and set TagsToTip in the global"
+" tooltip configuration to true.",true);}
function tt_HideSrcTagsRecurs(dad)
{var ovr,asT2t;var a=dad.childNodes||dad.children||null;for(var i=a?a.length:0;i;)
{--i;if(!tt_HideSrcTagsRecurs(a[i]))
return false;ovr=a[i].getAttribute?(a[i].getAttribute("onmouseover")||a[i].getAttribute("onclick")):(typeof a[i].onmouseover=="function")?(a[i].onmouseover||a[i].onclick):null;if(ovr)
{asT2t=ovr.toString().match(/TagToTip\s*\(\s*'[^'.]+'\s*[\),]/);if(asT2t&&asT2t.length)
{if(!tt_HideSrcTag(asT2t[0]))
return false;}}}
return true;}
function tt_HideSrcTag(sT2t)
{var id,el;id=sT2t.replace(/.+'([^'.]+)'.+/,"$1");el=tt_GetElt(id);if(el)
{if(tt_Debug&&!TagsToTip)
return false;else
el.style.display="none";}
else
tt_Err("Invalid ID\n'"+id+"'\npassed to TagToTip()."
+" There exists no HTML element with that ID.",true);return true;}
function tt_Tip(arg,t2t)
{if(!tt_db||(tt_iState&0x8))
return;if(tt_iState)
tt_Hide();if(!tt_Enabled)
return;tt_t2t=t2t;if(!tt_ReadCmds(arg))
return;tt_iState=0x1|0x4;tt_AdaptConfig1();tt_MkTipContent(arg);tt_MkTipSubDivs();tt_FormatTip();tt_bJmpVert=false;tt_bJmpHorz=false;tt_maxPosX=tt_GetClientW()+tt_GetScrollX()-tt_w-1;tt_maxPosY=tt_GetClientH()+tt_GetScrollY()-tt_h-1;tt_AdaptConfig2();tt_OverInit();tt_ShowInit();tt_Move();}
function tt_ReadCmds(a)
{var i;i=0;for(var j in config)
tt_aV[i++]=config[j];if(a.length&1)
{for(i=a.length-1;i>0;i-=2)
tt_aV[a[i-1]]=a[i];return true;}
tt_Err("Incorrect call of Tip() or TagToTip().\n"
+"Each command must be followed by a value.",true);return false;}
function tt_AdaptConfig1()
{tt_ExtCallFncs(0,"LoadConfig");if(!tt_aV[TITLEBGCOLOR].length)
tt_aV[TITLEBGCOLOR]=tt_aV[BORDERCOLOR];if(!tt_aV[TITLEFONTCOLOR].length)
tt_aV[TITLEFONTCOLOR]=tt_aV[BGCOLOR];if(!tt_aV[TITLEFONTFACE].length)
tt_aV[TITLEFONTFACE]=tt_aV[FONTFACE];if(!tt_aV[TITLEFONTSIZE].length)
tt_aV[TITLEFONTSIZE]=tt_aV[FONTSIZE];if(tt_aV[CLOSEBTN])
{if(!tt_aV[CLOSEBTNCOLORS])
tt_aV[CLOSEBTNCOLORS]=new Array("","","","");for(var i=4;i;)
{--i;if(!tt_aV[CLOSEBTNCOLORS][i].length)
tt_aV[CLOSEBTNCOLORS][i]=(i&1)?tt_aV[TITLEFONTCOLOR]:tt_aV[TITLEBGCOLOR];}
if(!tt_aV[TITLE].length)
tt_aV[TITLE]=" ";}
if(tt_aV[OPACITY]==100&&typeof tt_aElt[0].style.MozOpacity!=tt_u&&!Array.every)
tt_aV[OPACITY]=99;if(tt_aV[FADEIN]&&tt_flagOpa&&tt_aV[DELAY]>100)
tt_aV[DELAY]=Math.max(tt_aV[DELAY]-tt_aV[FADEIN],100);}
function tt_AdaptConfig2()
{if(tt_aV[CENTERMOUSE])
{tt_aV[OFFSETX]-=((tt_w-(tt_aV[SHADOW]?tt_aV[SHADOWWIDTH]:0))>>1);tt_aV[JUMPHORZ]=false;}}
function tt_MkTipContent(a)
{if(tt_t2t)
{if(tt_aV[COPYCONTENT])
tt_sContent=tt_t2t.innerHTML;else
tt_sContent="";}
else
tt_sContent=a[0];tt_ExtCallFncs(0,"CreateContentString");}
function tt_MkTipSubDivs()
{var sCss='position:relative;margin:0px;padding:0px;border-width:0px;left:0px;top:0px;line-height:normal;width:auto;',sTbTrTd=' cellspacing="0" cellpadding="0" border="0" style="'+sCss+'"><tbody style="'+sCss+'"><tr><td ';tt_aElt[0].style.width=tt_GetClientW()+"px";tt_aElt[0].innerHTML=(''
+(tt_aV[TITLE].length?('<div id="WzTiTl" style="position:relative;z-index:1;">'
+'<table id="WzTiTlTb"'+sTbTrTd+'id="WzTiTlI" style="'+sCss+'">'
+tt_aV[TITLE]
+'</td>'
+(tt_aV[CLOSEBTN]?('<td align="right" style="'+sCss
+'text-align:right;">'
+'<span id="WzClOsE" style="position:relative;left:2px;padding-left:2px;padding-right:2px;'
+'cursor:'+(tt_ie?'hand':'pointer')
+';" onmouseover="tt_OnCloseBtnOver(1)" onmouseout="tt_OnCloseBtnOver(0)" onclick="tt_HideInit()">'
+tt_aV[CLOSEBTNTEXT]
+'</span></td>'):'')
+'</tr></tbody></table></div>'):'')
+'<div id="WzBoDy" style="position:relative;z-index:0;">'
+'<table'+sTbTrTd+'id="WzBoDyI" style="'+sCss+'">'
+tt_sContent
+'</td></tr></tbody></table></div>'
+(tt_aV[SHADOW]?('<div id="WzTtShDwR" style="position:absolute;overflow:hidden;"></div>'
+'<div id="WzTtShDwB" style="position:relative;overflow:hidden;"></div>'):''));tt_GetSubDivRefs();if(tt_t2t&&!tt_aV[COPYCONTENT])
tt_El2Tip();tt_ExtCallFncs(0,"SubDivsCreated");}
function tt_GetSubDivRefs()
{var aId=new Array("WzTiTl","WzTiTlTb","WzTiTlI","WzClOsE","WzBoDy","WzBoDyI","WzTtShDwB","WzTtShDwR");for(var i=aId.length;i;--i)
tt_aElt[i]=tt_GetElt(aId[i-1]);}
function tt_FormatTip()
{var css,w,h,pad=tt_aV[PADDING],padT,wBrd=tt_aV[BORDERWIDTH],iOffY,iOffSh,iAdd=(pad+wBrd)<<1;if(tt_aV[TITLE].length)
{padT=tt_aV[TITLEPADDING];css=tt_aElt[1].style;css.background=tt_aV[TITLEBGCOLOR];css.paddingTop=css.paddingBottom=padT+"px";css.paddingLeft=css.paddingRight=(padT+2)+"px";css=tt_aElt[3].style;css.color=tt_aV[TITLEFONTCOLOR];if(tt_aV[WIDTH]==-1)
css.whiteSpace="nowrap";css.fontFamily=tt_aV[TITLEFONTFACE];css.fontSize=tt_aV[TITLEFONTSIZE];css.fontWeight="bold";css.textAlign=tt_aV[TITLEALIGN];if(tt_aElt[4])
{css=tt_aElt[4].style;css.background=tt_aV[CLOSEBTNCOLORS][0];css.color=tt_aV[CLOSEBTNCOLORS][1];css.fontFamily=tt_aV[TITLEFONTFACE];css.fontSize=tt_aV[TITLEFONTSIZE];css.fontWeight="bold";}
if(tt_aV[WIDTH]>0)
tt_w=tt_aV[WIDTH];else
{tt_w=tt_GetDivW(tt_aElt[3])+tt_GetDivW(tt_aElt[4]);if(tt_aElt[4])
tt_w+=pad;if(tt_aV[WIDTH]<-1&&tt_w>-tt_aV[WIDTH])
tt_w=-tt_aV[WIDTH];}
iOffY=-wBrd;}
else
{tt_w=0;iOffY=0;}
css=tt_aElt[5].style;css.top=iOffY+"px";if(wBrd)
{css.borderColor=tt_aV[BORDERCOLOR];css.borderStyle=tt_aV[BORDERSTYLE];css.borderWidth=wBrd+"px";}
if(tt_aV[BGCOLOR].length)
css.background=tt_aV[BGCOLOR];if(tt_aV[BGIMG].length)
css.backgroundImage="url("+tt_aV[BGIMG]+")";css.padding=pad+"px";css.textAlign=tt_aV[TEXTALIGN];if(tt_aV[HEIGHT])
{css.overflow="auto";if(tt_aV[HEIGHT]>0)
css.height=(tt_aV[HEIGHT]+iAdd)+"px";else
tt_h=iAdd-tt_aV[HEIGHT];}
css=tt_aElt[6].style;css.color=tt_aV[FONTCOLOR];css.fontFamily=tt_aV[FONTFACE];css.fontSize=tt_aV[FONTSIZE];css.fontWeight=tt_aV[FONTWEIGHT];css.textAlign=tt_aV[TEXTALIGN];if(tt_aV[WIDTH]>0)
w=tt_aV[WIDTH];else if(tt_aV[WIDTH]==-1&&tt_w)
w=tt_w;else
{w=tt_GetDivW(tt_aElt[6]);if(tt_aV[WIDTH]<-1&&w>-tt_aV[WIDTH])
w=-tt_aV[WIDTH];}
if(w>tt_w)
tt_w=w;tt_w+=iAdd;if(tt_aV[SHADOW])
{tt_w+=tt_aV[SHADOWWIDTH];iOffSh=Math.floor((tt_aV[SHADOWWIDTH]*4)/3);css=tt_aElt[7].style;css.top=iOffY+"px";css.left=iOffSh+"px";css.width=(tt_w-iOffSh-tt_aV[SHADOWWIDTH])+"px";css.height=tt_aV[SHADOWWIDTH]+"px";css.background=tt_aV[SHADOWCOLOR];css=tt_aElt[8].style;css.top=iOffSh+"px";css.left=(tt_w-tt_aV[SHADOWWIDTH])+"px";css.width=tt_aV[SHADOWWIDTH]+"px";css.background=tt_aV[SHADOWCOLOR];}
else
iOffSh=0;tt_SetTipOpa(tt_aV[FADEIN]?0:tt_aV[OPACITY]);tt_FixSize(iOffY,iOffSh);}
function tt_FixSize(iOffY,iOffSh)
{var wIn,wOut,h,add,pad=tt_aV[PADDING],wBrd=tt_aV[BORDERWIDTH],i;tt_aElt[0].style.width=tt_w+"px";tt_aElt[0].style.pixelWidth=tt_w;wOut=tt_w-((tt_aV[SHADOW])?tt_aV[SHADOWWIDTH]:0);wIn=wOut;if(!tt_bBoxOld)
wIn-=(pad+wBrd)<<1;tt_aElt[5].style.width=wIn+"px";if(tt_aElt[1])
{wIn=wOut-((tt_aV[TITLEPADDING]+2)<<1);if(!tt_bBoxOld)
wOut=wIn;tt_aElt[1].style.width=wOut+"px";tt_aElt[2].style.width=wIn+"px";}
if(tt_h)
{h=tt_GetDivH(tt_aElt[5]);if(h>tt_h)
{if(!tt_bBoxOld)
tt_h-=(pad+wBrd)<<1;tt_aElt[5].style.height=tt_h+"px";}}
tt_h=tt_GetDivH(tt_aElt[0])+iOffY;if(tt_aElt[8])
tt_aElt[8].style.height=(tt_h-iOffSh)+"px";i=tt_aElt.length-1;if(tt_aElt[i])
{tt_aElt[i].style.width=tt_w+"px";tt_aElt[i].style.height=tt_h+"px";}}
function tt_DeAlt(el)
{var aKid;if(el)
{if(el.alt)
el.alt="";if(el.title)
el.title="";aKid=el.childNodes||el.children||null;if(aKid)
{for(var i=aKid.length;i;)
tt_DeAlt(aKid[--i]);}}}
function tt_OpDeHref(el)
{if(!tt_op)
return;if(tt_elDeHref)
tt_OpReHref();while(el)
{if(el.hasAttribute&&el.hasAttribute("href"))
{el.t_href=el.getAttribute("href");el.t_stats=window.status;el.removeAttribute("href");el.style.cursor="hand";tt_AddEvtFnc(el,"mousedown",tt_OpReHref);window.status=el.t_href;tt_elDeHref=el;break;}
el=tt_GetDad(el);}}
function tt_OpReHref()
{if(tt_elDeHref)
{tt_elDeHref.setAttribute("href",tt_elDeHref.t_href);tt_RemEvtFnc(tt_elDeHref,"mousedown",tt_OpReHref);window.status=tt_elDeHref.t_stats;tt_elDeHref=null;}}
function tt_El2Tip()
{var css=tt_t2t.style;tt_t2t.t_cp=css.position;tt_t2t.t_cl=css.left;tt_t2t.t_ct=css.top;tt_t2t.t_cd=css.display;tt_t2tDad=tt_GetDad(tt_t2t);tt_MovDomNode(tt_t2t,tt_t2tDad,tt_aElt[6]);css.display="block";css.position="static";css.left=css.top=css.marginLeft=css.marginTop="0px";}
function tt_UnEl2Tip()
{var css=tt_t2t.style;css.display=tt_t2t.t_cd;tt_MovDomNode(tt_t2t,tt_GetDad(tt_t2t),tt_t2tDad);css.position=tt_t2t.t_cp;css.left=tt_t2t.t_cl;css.top=tt_t2t.t_ct;tt_t2tDad=null;}
function tt_OverInit()
{if(window.event)
tt_over=window.event.target||window.event.srcElement;else
tt_over=tt_ovr_;tt_DeAlt(tt_over);tt_OpDeHref(tt_over);}
function tt_ShowInit()
{tt_tShow.Timer("tt_Show()",tt_aV[DELAY],true);if(tt_aV[CLICKCLOSE]||tt_aV[CLICKSTICKY])
tt_AddEvtFnc(document,"mouseup",tt_OnLClick);}
function tt_Show()
{var css=tt_aElt[0].style;css.zIndex=Math.max((window.dd&&dd.z)?(dd.z+2):0,1010);if(tt_aV[STICKY]||!tt_aV[FOLLOWMOUSE])
tt_iState&=~0x4;if(tt_aV[EXCLUSIVE])
tt_iState|=0x8;if(tt_aV[DURATION]>0)
tt_tDurt.Timer("tt_HideInit()",tt_aV[DURATION],true);tt_ExtCallFncs(0,"Show")
css.visibility="visible";tt_iState|=0x2;if(tt_aV[FADEIN])
tt_Fade(0,0,tt_aV[OPACITY],Math.round(tt_aV[FADEIN]/tt_aV[FADEINTERVAL]));tt_ShowIfrm();}
function tt_ShowIfrm()
{if(tt_ie56)
{var ifrm=tt_aElt[tt_aElt.length-1];if(ifrm)
{var css=ifrm.style;css.zIndex=tt_aElt[0].style.zIndex-1;css.display="block";}}}
function tt_Move(e)
{if(e)
tt_ovr_=e.target||e.srcElement;e=e||window.event;if(e)
{tt_musX=tt_GetEvtX(e);tt_musY=tt_GetEvtY(e);}
if(tt_iState&0x4)
{if(!tt_op&&!tt_ie)
{if(tt_bWait)
return;tt_bWait=true;tt_tWaitMov.Timer("tt_bWait = false;",1,true);}
if(tt_aV[FIX])
{tt_iState&=~0x4;tt_PosFix();}
else if(!tt_ExtCallFncs(e,"MoveBefore"))
tt_SetTipPos(tt_Pos(0),tt_Pos(1));tt_ExtCallFncs([tt_musX,tt_musY],"MoveAfter")}}
function tt_Pos(iDim)
{var iX,bJmpMod,cmdAlt,cmdOff,cx,iMax,iScrl,iMus,bJmp;if(iDim)
{bJmpMod=tt_aV[JUMPVERT];cmdAlt=ABOVE;cmdOff=OFFSETY;cx=tt_h;iMax=tt_maxPosY;iScrl=tt_GetScrollY();iMus=tt_musY;bJmp=tt_bJmpVert;}
else
{bJmpMod=tt_aV[JUMPHORZ];cmdAlt=LEFT;cmdOff=OFFSETX;cx=tt_w;iMax=tt_maxPosX;iScrl=tt_GetScrollX();iMus=tt_musX;bJmp=tt_bJmpHorz;}
if(bJmpMod)
{if(tt_aV[cmdAlt]&&(!bJmp||tt_CalcPosAlt(iDim)>=iScrl+16))
iX=tt_PosAlt(iDim);else if(!tt_aV[cmdAlt]&&bJmp&&tt_CalcPosDef(iDim)>iMax-16)
iX=tt_PosAlt(iDim);else
iX=tt_PosDef(iDim);}
else
{iX=iMus;if(tt_aV[cmdAlt])
iX-=cx+tt_aV[cmdOff]-(tt_aV[SHADOW]?tt_aV[SHADOWWIDTH]:0);else
iX+=tt_aV[cmdOff];}
if(iX>iMax)
iX=bJmpMod?tt_PosAlt(iDim):iMax;if(iX<iScrl)
iX=bJmpMod?tt_PosDef(iDim):iScrl;return iX;}
function tt_PosDef(iDim)
{if(iDim)
tt_bJmpVert=tt_aV[ABOVE];else
tt_bJmpHorz=tt_aV[LEFT];return tt_CalcPosDef(iDim);}
function tt_PosAlt(iDim)
{if(iDim)
tt_bJmpVert=!tt_aV[ABOVE];else
tt_bJmpHorz=!tt_aV[LEFT];return tt_CalcPosAlt(iDim);}
function tt_CalcPosDef(iDim)
{return iDim?(tt_musY+tt_aV[OFFSETY]):(tt_musX+tt_aV[OFFSETX]);}
function tt_CalcPosAlt(iDim)
{var cmdOff=iDim?OFFSETY:OFFSETX;var dx=tt_aV[cmdOff]-(tt_aV[SHADOW]?tt_aV[SHADOWWIDTH]:0);if(tt_aV[cmdOff]>0&&dx<=0)
dx=1;return((iDim?(tt_musY-tt_h):(tt_musX-tt_w))-dx);}
function tt_PosFix()
{var iX,iY;if(typeof(tt_aV[FIX][0])=="number")
{iX=tt_aV[FIX][0];iY=tt_aV[FIX][1];}
else
{if(typeof(tt_aV[FIX][0])=="string")
el=tt_GetElt(tt_aV[FIX][0]);else
el=tt_aV[FIX][0];iX=tt_aV[FIX][1];iY=tt_aV[FIX][2];if(!tt_aV[ABOVE]&&el)
iY+=tt_GetDivH(el);for(;el;el=el.offsetParent)
{iX+=el.offsetLeft||0;iY+=el.offsetTop||0;}}
if(tt_aV[ABOVE])
iY-=tt_h;tt_SetTipPos(iX,iY);}
function tt_Fade(a,now,z,n)
{if(n)
{now+=Math.round((z-now)/n);if((z>a)?(now>=z):(now<=z))
now=z;else
tt_tFade.Timer("tt_Fade("
+a+","+now+","+z+","+(n-1)
+")",tt_aV[FADEINTERVAL],true);}
now?tt_SetTipOpa(now):tt_Hide();}
function tt_SetTipOpa(opa)
{tt_SetOpa(tt_aElt[5],opa);if(tt_aElt[1])
tt_SetOpa(tt_aElt[1],opa);if(tt_aV[SHADOW])
{opa=Math.round(opa*0.8);tt_SetOpa(tt_aElt[7],opa);tt_SetOpa(tt_aElt[8],opa);}}
function tt_OnCloseBtnOver(iOver)
{var css=tt_aElt[4].style;iOver<<=1;css.background=tt_aV[CLOSEBTNCOLORS][iOver];css.color=tt_aV[CLOSEBTNCOLORS][iOver+1];}
function tt_OnLClick(e)
{e=e||window.event;if(!((e.button&&e.button&2)||(e.which&&e.which==3)))
{if(tt_aV[CLICKSTICKY]&&(tt_iState&0x4))
{tt_aV[STICKY]=true;tt_iState&=~0x4;}
else if(tt_aV[CLICKCLOSE])
tt_HideInit();}}
function tt_Int(x)
{var y;return(isNaN(y=parseInt(x))?0:y);}
Number.prototype.Timer=function(s,iT,bUrge)
{if(!this.value||bUrge)
this.value=window.setTimeout(s,iT);}
Number.prototype.EndTimer=function()
{if(this.value)
{window.clearTimeout(this.value);this.value=0;}}
function tt_GetWndCliSiz(s)
{var db,y=window["inner"+s],sC="client"+s,sN="number";if(typeof y==sN)
{var y2;return(((db=document.body)&&typeof(y2=db[sC])==sN&&y2&&y2<=y)?y2:((db=document.documentElement)&&typeof(y2=db[sC])==sN&&y2&&y2<=y)?y2:y);}
return(((db=document.documentElement)&&(y=db[sC]))?y:document.body[sC]);}
function tt_SetOpa(el,opa)
{var css=el.style;tt_opa=opa;if(tt_flagOpa==1)
{if(opa<100)
{if(typeof(el.filtNo)==tt_u)
el.filtNo=css.filter;var bVis=css.visibility!="hidden";css.zoom="100%";if(!bVis)
css.visibility="visible";css.filter="alpha(opacity="+opa+")";if(!bVis)
css.visibility="hidden";}
else if(typeof(el.filtNo)!=tt_u)
css.filter=el.filtNo;}
else
{opa/=100.0;switch(tt_flagOpa)
{case 2:css.KhtmlOpacity=opa;break;case 3:css.KHTMLOpacity=opa;break;case 4:css.MozOpacity=opa;break;case 5:css.opacity=opa;break;}}}
function tt_Err(sErr,bIfDebug)
{if(tt_Debug||!bIfDebug)
alert("Tooltip Script Error Message:\n\n"+sErr);}
function tt_ExtCmdEnum()
{var s;for(var i in config)
{s="window."+i.toString().toUpperCase();if(eval("typeof("+s+") == tt_u"))
{eval(s+" = "+tt_aV.length);tt_aV[tt_aV.length]=null;}}}
function tt_ExtCallFncs(arg,sFnc)
{var b=false;for(var i=tt_aExt.length;i;)
{--i;var fnc=tt_aExt[i]["On"+sFnc];if(fnc&&fnc(arg))
b=true;}
return b;}
tt_Init();;function initMenu(){var i=0;var j=0;if(typeof(urlcate)=='undefined')urlcate=document.location.href;$('#danhmucsanpham ul').hide();($('#danhmucsanpham li a')).each(function(){if(this.href==document.location.href.replace(/\#$/g,"")){j=1;$(this).addClass("active");var checkParent=$(this).parent().parent().prev();$(this).parent().parent().parent().parent().prev().addClass("active");$(this).parent().parent().parent().parent().parent().parent().prev().addClass("active");checkParent.addClass("active");$('#danhmucsanpham li a.active').each(function(){$(this).next().show();});return false;}
if($(this).hasClass("active")){j=1;$(this).addClass("active");var checkParent=$(this).parent().parent().prev();$(this).parent().parent().parent().parent().prev().addClass("active");$(this).parent().parent().parent().parent().parent().parent().prev().addClass("active");checkParent.addClass("active");$('#danhmucsanpham li a.active').each(function(){$(this).next().show();});return false;}});if(j==0){$('#danhmucsanpham ul.abc1').show();}
$('#danhmucsanpham li a').click(function(){var checkElement=$(this).next();var checkParent=$(this).parent().parent();if((checkElement.is('ul'))&&(checkElement.is(':visible'))){document.location.href=this.href;return false;}
if((checkElement.is('ul'))&&(!checkElement.is(':visible'))){checkParent.find('ul:visible').slideUp('normal');checkElement.slideDown('normal');return false;}
document.location.href=this.href;});}
$(document).ready(function(){initMenu();});;var opt
var intVal
(function($){$.fn.imageScroller=function(options){var $this=$(this);var loadImgs=0;opt=$.extend({speed:"6000",loading:"Loading images...",direction:"left"},options||{});$this.children().hide();$this.append("<div style='clear:both; padding: 0px; margin: 0px;'>"+"<div id='loading'>"+opt.loading+"</div>"+"</div>");$("img",$this).each(function(){var img=new Image();var soc=$(this).attr('src');$(img).load(function(){loadImgs++;}).attr("src",soc);});intVal=window.setInterval(function(){if(loadImgs==$("img",$this).length){window.clearInterval(intVal);$("#loading").remove();$this.children().show();var totImg=0;$.each($this.children(":not(div)"),function(){switch(opt.direction){case'left':case'right':if($(this).children().length){$(this).width($(this).children(":eq(0)").width());}
totImg+=$(this).width();break;case'top':case'bottom':$(this).css("display","block");if($(this).children().length){$(this).height($(this).children(":eq(0)").height());}
totImg+=$(this).height();break;}
$(this).css({margin:"0px",padding:"0px",clear:"both"});$(this).bind("mouseover",function(){$("div:eq(0)",$this).stop();}).bind("mouseout",function(){scrollStart($("div:eq(0)",$this),opt);});$("div:eq(0)",$this).append($(this));});switch(opt.direction){case'left':$("div:eq(0)",$this).css("width",totImg+"px");break;case'right':$("div:eq(0)",$this).css("width",totImg+"px");$("div:eq(0)",$this).css({marginLeft:-(totImg-$this.width())+"px"});break;case'top':$("div:eq(0)",$this).css("height",totImg+"px");break;case'bottom':$("div:eq(0)",$this).css("height",totImg+"px");$("div:eq(0)",$this).css({marginTop:-(totImg-$this.height())+"px"});break;}
scrollStart($("div:eq(0)",$this),opt);}},100);function scrollStart($scroll,opt){switch(opt.direction){case'left':var pos=-($scroll.children(":eq(0)").width());var spd=opt.speed-(Math.abs(parseInt($scroll.css("marginLeft")))*(opt.speed/$scroll.children(":eq(0)").width()));break;case'right':var pos=-($scroll.width()-$scroll.parents("div:eq(0)").width())+$scroll.children(":last").width();var spd=opt.speed-(($scroll.children(":last").width()-(Math.abs(parseInt($scroll.css("marginLeft")))-Math.abs(pos)))*(opt.speed/$scroll.children(":last").width()));break;case'top':var tos=-($scroll.children(":eq(0)").height());var spd=opt.speed-(Math.abs(parseInt($scroll.css("marginTop")))*(opt.speed/$scroll.children(":eq(0)").height()));break;case'bottom':var tos=-($scroll.height()-$scroll.parents("div:eq(0)").height())+$scroll.children(":last").height();var spd=opt.speed-(($scroll.children(":last").height()-(Math.abs(parseInt($scroll.css("marginTop")))-Math.abs(tos)))*(opt.speed/$scroll.children(":last").height()));break;}
$scroll.animate({marginLeft:(pos||"0")+"px",marginTop:(tos||"0")+"px"},spd,"linear",function(){switch(opt.direction){case'left':$scroll.append($(this).children(":eq(0)"));$scroll.css("marginLeft","0px");break;case'right':$scroll.prepend($(this).children(":last"));$scroll.css("marginLeft",-($scroll.width()-$scroll.parents("div:eq(0)").width())+"px");break;case'top':$scroll.append($(this).children(":eq(0)"));$scroll.css("marginTop","0px");break;case'bottom':$scroll.prepend($(this).children(":last"));$scroll.css("marginTop",-($scroll.height()-$scroll.parents("div:eq(0)").height())+"px");break;}
scrollStart($scroll,opt);});};$('#pre').click(function(){$("#left div:eq(0)").stop();opt.direction="right";scrollStart($("div:eq(0)",$this),opt);});$('#next').click(function(){$("#left div:eq(0)").stop();opt.direction="left";scrollStart($("div:eq(0)",$this),opt);});};})(jQuery);$(function(){var tt=$("#left").imageScroller({loading:'Wait please...',direction:'left'});});(function($){$.fn.innerfade=function(options){return this.each(function(){$.innerfade(this,options);});};$.innerfade=function(container,options){var settings={'animationtype':'fade','speed':'normal','type':'sequence','timeout':2000,'containerheight':'auto','runningclass':'innerfade','children':null};if(options)
$.extend(settings,options);if(settings.children===null)
var elements=$(container).children();else
var elements=$(container).children(settings.children);if(elements.length>1){$(container).css('position','relative').css('height',settings.containerheight).addClass(settings.runningclass);for(var i=0;i<elements.length;i++){$(elements[i]).css('z-index',String(elements.length-i)).css('position','absolute').hide();};if(settings.type=="sequence"){setTimeout(function(){$.innerfade.next(elements,settings,1,0);},settings.timeout);$(elements[0]).show();}else if(settings.type=="random"){var last=Math.floor(Math.random()*(elements.length));setTimeout(function(){do{current=Math.floor(Math.random()*(elements.length));}while(last==current);$.innerfade.next(elements,settings,current,last);},settings.timeout);$(elements[last]).show();}else if(settings.type=='random_start'){settings.type='sequence';var current=Math.floor(Math.random()*(elements.length));setTimeout(function(){$.innerfade.next(elements,settings,(current+1)%elements.length,current);},settings.timeout);$(elements[current]).show();}else{alert('Innerfade-Type must either be \'sequence\', \'random\' or \'random_start\'');}}};$.innerfade.next=function(elements,settings,current,last){if(settings.animationtype=='slide'){$(elements[last]).slideUp(settings.speed);$(elements[current]).slideDown(settings.speed);}else if(settings.animationtype=='fade'){$(elements[last]).fadeOut(settings.speed);$(elements[current]).fadeIn(settings.speed,function(){removeFilter($(this)[0]);});}else
alert('Innerfade-animationtype must either be \'slide\' or \'fade\'');if(settings.type=="sequence"){if((current+1)<elements.length){current=current+1;last=current-1;}else{current=0;last=elements.length-1;}}else if(settings.type=="random"){last=current;while(current==last)
current=Math.floor(Math.random()*elements.length);}else
alert('Innerfade-Type must either be \'sequence\', \'random\' or \'random_start\'');setTimeout((function(){$.innerfade.next(elements,settings,current,last);}),settings.timeout);};})(jQuery);function removeFilter(element){if(element.style.removeAttribute){element.style.removeAttribute('filter');}};$(document).ready(function(){var ids=new Array();$("vssupport1").each(function(){ids.push(this.id);});if(ids.length>0)
$.getJSON(baseUrl+'supports/supports_check_online?ids='+ids,function(data){var items=[];$.each(data,function(key,val){$("vssupport1#"+val.id+"").replaceWith($("<a href='"+val.url+"'><img src='"+val.img+"'/></a>"));;});});$(".vssupport").each(function(){var element=$(this);$.get(baseUrl+'sources/utils/CheckOnline.Api.php',{typecheck:element.attr('type'),nick:element.attr('nickname')},function(data){var img=element.find("img");if(img.length>0){img.attr("src",img.attr("src").replace("{id}",data));}});});$('.page a:first').addClass('page_prev');$('.page a:last').addClass('page_next');});function addToCart(id){$.ajax({url:baseUrl+'orders/addtocart/'+id,type:'POST',cache:false,data:"json=1&quantity="+$("#input_text").val(),dataType:'json',success:function(data){alert(data.message);$("#lb_quantity_cart").text("("+data.quantity+")");},error:function(){alert('Có lỗi xảy ra');}});return false;};var stickytooltip={tooltipoffsets:[20,-30],fadeinspeed:200,rightclickstick:true,stickybordercolors:["black","darkred"],stickynotice1:["Press \"s\"","or right click","to sticky box"],stickynotice2:"Click outside this box to hide it",isdocked:false,positiontooltip:function($,$tooltip,e){var x=e.pageX+this.tooltipoffsets[0],y=e.pageY+this.tooltipoffsets[1]
var tipw=$tooltip.outerWidth(),tiph=$tooltip.outerHeight(),x=(x+tipw>$(document).scrollLeft()+$(window).width())?x-tipw-(stickytooltip.tooltipoffsets[0]*2):x
y=(y+tiph>$(document).scrollTop()+$(window).height())?$(document).scrollTop()+$(window).height()-tiph-10:y
$tooltip.css({left:x,top:y})},showbox:function($,$tooltip,e){$tooltip.fadeIn(this.fadeinspeed)
this.positiontooltip($,$tooltip,e)},hidebox:function($,$tooltip){if(!this.isdocked){$tooltip.stop(false,true).hide()
$tooltip.css({borderColor:'black'}).find('.stickystatus:eq(0)').css({background:this.stickybordercolors[0]}).html(this.stickynotice1)}},docktooltip:function($,$tooltip,e){this.isdocked=true
$tooltip.css({borderColor:'darkred'}).find('.stickystatus:eq(0)').css({background:this.stickybordercolors[1]}).html(this.stickynotice2)},init:function(targetselector,tipid){jQuery(document).ready(function($){var $targets=$(targetselector)
var $tooltip=$('#'+tipid).appendTo(document.body)
if($targets.length==0)
return
var $alltips=$tooltip.find('div.atip')
if(!stickytooltip.rightclickstick)
stickytooltip.stickynotice1[1]=''
stickytooltip.stickynotice1=stickytooltip.stickynotice1.join(' ')
stickytooltip.hidebox($,$tooltip)
$targets.bind('mouseenter',function(e){$alltips.hide().filter('#'+$(this).attr('data-tooltip')).show()
stickytooltip.showbox($,$tooltip,e)})
$targets.bind('mouseleave',function(e){stickytooltip.hidebox($,$tooltip)})
$targets.bind('mousemove',function(e){if(!stickytooltip.isdocked){stickytooltip.positiontooltip($,$tooltip,e)}})
$tooltip.bind("mouseenter",function(){stickytooltip.hidebox($,$tooltip)})
$tooltip.bind("click",function(e){e.stopPropagation()})
$(this).bind("click",function(e){if(e.button==0){stickytooltip.isdocked=false
stickytooltip.hidebox($,$tooltip)}})
$(this).bind("contextdanhmucsanpham",function(e){if(stickytooltip.rightclickstick&&$(e.target).parents().andSelf().filter(targetselector).length==1){stickytooltip.docktooltip($,$tooltip,e)
return false}})
$(this).bind('keypress',function(e){var keyunicode=e.charCode||e.keyCode
if(keyunicode==115){stickytooltip.docktooltip($,$tooltip,e)}})})}}
stickytooltip.init("*[data-tooltip]","mystickytooltip")