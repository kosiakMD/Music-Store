
window.onerror=function(desc,page,line,chr){
/* alert('JavaScript error occurred! \n'
  +'\nError description: \t'+desc
  +'\nPage address:	  \t'+page
  +'\nLine number:	   \t'+line
 );*/
}

$(function(){
 $('a').focus(function(){this.blur();});
 SI.Files.stylizeAll();
 slider.init();

 $('input.text-default').each(function(){
  $(this).attr('default',$(this).val());
 }).focus(function(){
  if($(this).val()==$(this).attr('default'))
   $(this).val('');
 }).blur(function(){
  if($(this).val()=='')
   $(this).val($(this).attr('default'));
 });

 $('input.text,textarea.text').focus(function(){
  $(this).addClass('textfocus');
 }).blur(function(){
  $(this).removeClass('textfocus');
 });

 var popopenobj=0,popopenaobj=null;
 $('a.popup').click(function(){
  var pid=$(this).attr('rel').split('|')[0],_os=parseInt($(this).attr('rel').split('|')[1]);
  var pobj=$('#'+pid);
  if(!pobj.length)
   return false;
  if(typeof popopenobj=='object' && popopenobj.attr('id')!=pid){
   popopenobj.hide(50);
   $(popopenaobj).parent().removeClass(popopenobj.attr('id').split('-')[1]+'-open');
   popopenobj=null;
  }
  return false;
 });
 $('p.images img').click(function(){
  var newbg=$(this).attr('src').split('bg/bg')[1].split('-thumb')[0];
  $(document.body).css('backgroundImage','url('+_siteRoot+'images/bg/bg'+newbg+'.jpg)');
 
  $(this).parent().find('img').removeClass('on');
  $(this).addClass('on');
  return false;
 });
 $(window).load(function(){
  //$.each(css_im,function(){(new Image()).src=_siteRoot+'css/images/'+this;});
  $.each(css_cims,function(){
   var css_im=this;
   $.each(['blue','purple','pink','red','grey','green','yellow','orange'],function(){
	(new Image()).src=_siteRoot+'css/'+this+'/'+css_im;
   });
  });
 }); 
 $('div.sc-large div.img:has(div.tml)').each(function(){
  $('div.tml',this).hide();
  $(this).append('<a href="#" class="tml_open">&nbsp;</a>').find('a').css({
   left:parseInt($(this).offset().left)+200,top:parseInt($(this).offset().top)+1
  }).click(function(){
   $(this).siblings('div.tml').slideToggle();
   return false;
  }).focus(function(){this.blur();}); 
 });
});
var slider={
 num:-1,
 cur:0,
 cr:[],
 al:null,
 at:10*1000,
 ar:true,
 init:function(){
  if(!slider.data || !slider.data.length)
   return false;

  var d=slider.data;
  slider.num=d.length;
  var pos=Math.floor(Math.random()*1);//slider.num);
  for(var i=0;i<slider.num;i++){
   $('#'+d[i].id).css({left:((i-pos)*530)});
   $('#slide-nav').append('<a id="slide-link-'+i+'" href="#" onclick="slider.slide('+i+');return false;" onfocus="this.blur();"></a>');
  }

  $('img,div#slide-controls',$('div#slide-holder')).fadeIn();
  slider.text(d[pos]);
  slider.on(pos);
  slider.cur=pos;
  window.setTimeout('slider.auto();',slider.at);
 },
 auto:function(){
  if(!slider.ar)
   return false;

  var next=slider.cur+1;
  if(next>=slider.num) next=0;
  slider.slide(next);
 },
 slide:function(pos){
  if(pos<0 || pos>=slider.num || pos==slider.cur)
   return;

  window.clearTimeout(slider.al);
  slider.al=window.setTimeout('slider.auto();',slider.at);

  var d=slider.data;
  for(var i=0;i<slider.num;i++)
   $('#'+d[i].id).stop().animate({left:((i-pos)*530)},1000,'swing');
  slider.on(pos);
  slider.text(d[pos]);
  slider.cur=pos;
 },
 on:function(pos){
  $('#slide-nav a').removeClass('on');
  $('#slide-nav a#slide-link-'+pos).addClass('on');
 },
 text:function(di){
  slider.cr['a']=di.client;
  slider.cr['b']=di.desc;
  slider.ticker('#slide-client span',di.client,0,'a');
  slider.ticker('#slide-desc',di.desc,0,'b');
 },
 ticker:function(el,text,pos,unique){
  if(slider.cr[unique]!=text)
   return false;

  ctext=text.substring(0,pos)+(pos%2?'-':'_');
  $(el).html(ctext);

  if(pos==text.length)
   $(el).html(text);
  else
   window.setTimeout('slider.ticker("'+el+'","'+text+'",'+(pos+1)+',"'+unique+'");',30);
 }
};
// STYLING FILE INPUTS 1.0 | Shaun Inman <http://www.shauninman.com/> | 2007-09-07
if(!window.SI){var SI={};};
SI.Files={
 htmlClass:'SI-FILES-STYLIZED',
 fileClass:'file',
 wrapClass:'cabinet',
 
 fini:false,
 able:false,
 init:function(){
  this.fini=true;
 },
 stylize:function(elem){
  if(!this.fini){this.init();};
  if(!this.able){return;};
  
  elem.parentNode.file=elem;
  elem.parentNode.onmousemove=function(e){
   if(typeof e=='undefined') e=window.event;
   if(typeof e.pageY=='undefined' &&  typeof e.clientX=='number' && document.documentElement){
	e.pageX=e.clientX+document.documentElement.scrollLeft;
	e.pageY=e.clientY+document.documentElement.scrollTop;
   };
   var ox=oy=0;
   var elem=this;
   if(elem.offsetParent){
	ox=elem.offsetLeft;
	oy=elem.offsetTop;
	while(elem=elem.offsetParent){
	 ox+=elem.offsetLeft;
	 oy+=elem.offsetTop;
	};
   };
  };
 },
 stylizeAll:function(){
  if(!this.fini){this.init();};
  if(!this.able){return;};
 }
};

function withTwitter() {
	window.open('http://twitter.com/share?text=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22&amp;url=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire', '_blank', 'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=550, height=440, toolbar=0, status=0');return false
}

function withFacebook() {
	window.open('http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;t=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22', '_blank', 'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=550, height=440, toolbar=0, status=0');return false
}
function addGoogle() {
window.open('https://plusone.google.com/_/+1/confirm?hl=ru&url=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire', '_blank', 'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=550, height=440, toolbar=0, status=0');return false
}

function addMyspace() {
window.open('http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st._surl=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;title=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22', '_blank', 'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=550, height=440, toolbar=0, status=0');return false
}

function addContact() {
window.open('http://vk.com/share.php?url=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire', '_blank', 'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=554, height=421, toolbar=0, status=0');return false
}