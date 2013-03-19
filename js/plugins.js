jQuery(document).ready(function($){
	
	// Modernizr test for HTML5 Placeholder support and polyfill
	(function(){if(!Modernizr.input.placeholder){$(this).find('[placeholder]').each(function(){$(this).val($(this).attr('placeholder'))});$('[placeholder]').focus(function(){if($(this).val()==$(this).attr('placeholder')){$(this).val('');$(this).removeClass('placeholder')}}).blur(function(){if($(this).val()==''||$(this).val()==$(this).attr('placeholder')){$(this).val($(this).attr('placeholder'));$(this).addClass('placeholder')}});$('[placeholder]').closest('form').submit(function(){$(this).find('[placeholder]').each(function(){if($(this).val()==$(this).attr('placeholder')){$(this).val('')}})})}});
	  
	// StyleFix 1.0.1 & PrefixFree 1.0.4 / by Lea Verou / MIT license
	//(function(){function b(a,b){return[].slice.call((b||document).querySelectorAll(a))}if(!window.addEventListener)return;var a=window.StyleFix={link:function(b){try{if(b.rel!=="stylesheet"||!b.sheet.cssRules||b.hasAttribute("data-noprefix"))return}catch(c){return}var d=b.href||b.getAttribute("data-href"),e=d.replace(/[^\/]+$/,""),f=b.parentNode,g=new XMLHttpRequest;g.open("GET",d),g.onreadystatechange=function(){if(g.readyState===4){var c=g.responseText;if(c&&b.parentNode){c=a.fix(c,!0,b),e&&(c=c.replace(/url\((?:'|")?(.+?)(?:'|")?\)/gi,function(a,b){return/^([a-z]{3,10}:|\/|#)/i.test(b)?a:'url("'+e+b+'")'}),c=c.replace(RegExp("\\b(behavior:\\s*?url\\('?\"?)"+e,"gi"),"$1"));var d=document.createElement("style");d.textContent=c,d.media=b.media,d.disabled=b.disabled,d.setAttribute("data-href",b.getAttribute("href")),f.insertBefore(d,b),f.removeChild(b)}}},g.send(null),b.setAttribute("data-inprogress","")},styleElement:function(b){var c=b.disabled;b.textContent=a.fix(b.textContent,!0,b),b.disabled=c},styleAttribute:function(b){var c=b.getAttribute("style");c=a.fix(c,!1,b),b.setAttribute("style",c)},process:function(){b('link[rel="stylesheet"]:not([data-inprogress])').forEach(StyleFix.link),b("style").forEach(StyleFix.styleElement),b("[style]").forEach(StyleFix.styleAttribute)},register:function(b,c){(a.fixers=a.fixers||[]).splice(c===undefined?a.fixers.length:c,0,b)},fix:function(b,c){for(var d=0;d<a.fixers.length;d++)b=a.fixers[d](b,c)||b;return b},camelCase:function(a){return a.replace(/-([a-z])/g,function(a,b){return b.toUpperCase()}).replace("-","")},deCamelCase:function(a){return a.replace(/[A-Z]/g,function(a){return"-"+a.toLowerCase()})}};(function(){setTimeout(function(){b('link[rel="stylesheet"]').forEach(StyleFix.link)},10),document.addEventListener("DOMContentLoaded",StyleFix.process,!1)})()})(),function(a,b){if(!window.StyleFix||!window.getComputedStyle)return;var c=window.PrefixFree={prefixCSS:function(a,b){function e(b,d,e,f){b=c[b];if(b.length){var g=RegExp(d+"("+b.join("|")+")"+e,"gi");a=a.replace(g,f)}}var d=c.prefix;e("functions","(\\s|:|,)","\\s*\\(","$1"+d+"$2("),e("keywords","(\\s|:)","(\\s|;|\\}|$)","$1"+d+"$2$3"),e("properties","(^|\\{|\\s|;)","\\s*:","$1"+d+"$2:");if(c.properties.length){var f=RegExp("\\b("+c.properties.join("|")+")(?!:)","gi");e("valueProperties","\\b",":(.+?);",function(a){return a.replace(f,d+"$1")})}return b&&(e("selectors","","\\b",c.prefixSelector),e("atrules","@","\\b","@"+d+"$1")),a=a.replace(RegExp("-"+d,"g"),"-"),a},prefixSelector:function(a){return a.replace(/^:{1,2}/,function(a){return a+c.prefix})},prefixProperty:function(a,b){var d=c.prefix+a;return b?StyleFix.camelCase(d):d}};(function(){var a={},b=[],d={},e=getComputedStyle(document.documentElement,null),f=document.createElement("div").style,g=function(c){if(c.charAt(0)==="-"){b.push(c);var d=c.split("-"),e=d[1];a[e]=++a[e]||1;while(d.length>3){d.pop();var f=d.join("-");h(f)&&b.indexOf(f)===-1&&b.push(f)}}},h=function(a){return StyleFix.camelCase(a)in f};if(e.length>0)for(var i=0;i<e.length;i++)g(e[i]);else for(var j in e)g(StyleFix.deCamelCase(j));var k={uses:0};for(var l in a){var m=a[l];k.uses<m&&(k={prefix:l,uses:m})}c.prefix="-"+k.prefix+"-",c.Prefix=StyleFix.camelCase(c.prefix),c.properties=[];for(var i=0;i<b.length;i++){var j=b[i];if(j.indexOf(c.prefix)===0){var n=j.slice(c.prefix.length);h(n)||c.properties.push(n)}}c.Prefix=="Ms"&&!("transform"in f)&&!("MsTransform"in f)&&"msTransform"in f&&c.properties.push("transform","transform-origin"),c.properties.sort()})(),function(){function e(a,b){return d[b]="",d[b]=a,!!d[b]}var a={"linear-gradient":{property:"backgroundImage",params:"red, teal"},calc:{property:"width",params:"1px + 5%"},element:{property:"backgroundImage",params:"#foo"}};a["repeating-linear-gradient"]=a["repeating-radial-gradient"]=a["radial-gradient"]=a["linear-gradient"];var b={initial:"color","zoom-in":"cursor","zoom-out":"cursor",box:"display",flexbox:"display","inline-flexbox":"display"};c.functions=[],c.keywords=[];var d=document.createElement("div").style;for(var f in a){var g=a[f],h=g.property,i=f+"("+g.params+")";!e(i,h)&&e(c.prefix+i,h)&&c.functions.push(f)}for(var j in b){var h=b[j];!e(j,h)&&e(c.prefix+j,h)&&c.keywords.push(j)}}(),function(){function f(a){return e.textContent=a+"{}",!!e.sheet.cssRules.length}var b={":read-only":null,":read-write":null,":any-link":null,"::selection":null},d={keyframes:"name",viewport:null,document:'regexp(".")'};c.selectors=[],c.atrules=[];var e=a.appendChild(document.createElement("style"));for(var g in b){var h=g+(b[g]?"("+b[g]+")":"");!f(h)&&f(c.prefixSelector(h))&&c.selectors.push(g)}for(var i in d){var h=i+" "+(d[i]||"");!f("@"+h)&&f("@"+c.prefix+h)&&c.atrules.push(i)}a.removeChild(e)}(),c.valueProperties=["transition","transition-property"],a.className+=" "+c.prefix,StyleFix.register(c.prefixCSS)}(document.documentElement);

  	// Basic jQuery Slider - v1.1 -added on Sunday, 4th of March 2012
  	(function(a){a.fn.bjqs=function(b){var c={},d={width:700,height:300,animation:"fade",animationDuration:450,automatic:true,rotationSpeed:4e3,hoverPause:true,showControls:true,centerControls:true,nextText:"Next",prevText:"Prev",showMarkers:true,centerMarkers:true,keyboardNav:true,useCaptions:true},e=this,f=e.find(".bjqs"),g=f.children("li"),h=g.length,i=false,j=false,k=0,l=1,m=0,n=g.eq(k),o="forward",p="backward";c=a.extend({},d,b);g.css({height:c.height,width:c.width});f.css({height:c.height,width:c.width});e.css({height:c.height,width:c.width});g.addClass("bjqs-slide");if(c.showControls&&h>1){var q=a('<ul class="bjqs-controls"></ul>'),r=a('<li><a href="#" class="bjqs-next" class="controls">'+c.nextText+"</a></li>"),s=a('<li><a href="#" class="bjqs-prev" class="controls">'+c.prevText+"</a></li>");r.click(function(a){a.preventDefault();if(!i){A(o,false)}});s.click(function(a){a.preventDefault();if(!i){A(p,false)}});r.appendTo(q);s.appendTo(q);q.appendTo(e);if(c.centerControls){var t=r.children("a"),u=(e.height()-t.height())/2;r.children("a").css("top",u).show();s.children("a").css("top",u).show()}}if(c.showMarkers&&h>1){var v=a('<ol class="bjqs-markers"></ol>'),w,x,u;a.each(g,function(b,d){if(c.animType==="slide"){if(b!==0&&b!==h-1){w=a('<li><a href="#"><span>'+b+"</span></a></li>")}}else{b++;w=a('<li><a href="#"><span>'+b+"</span></a></li>")}w.click(function(c){c.preventDefault();if(!a(this).hasClass("active-marker")&&!i){A(false,b)}});w.appendTo(v)});x=v.children("li");x.eq(k).addClass("active-marker");v.appendTo(e);if(c.centerMarkers){u=(c.width-v.width())/2;v.css("left",u)}}if(c.keyboardNav&&h>1){a(document).keyup(function(a){if(!j){clearInterval(z);j=true}if(!i){if(a.keyCode===39){a.preventDefault();A(o,false)}else if(a.keyCode===37){a.preventDefault();A(p,false)}}if(j&c.automatic){z=setInterval(function(){A(o)},c.rotationSpeed);j=false}})}if(c.useCaptions){a.each(g,function(b,c){var d=a(c);var e=d.children("img:first-child");var f=e.attr("title");if(f){var g=a('<p class="bjqs-caption">'+f+"</p>");g.appendTo(d)}})}if(c.hoverPause&&c.automatic){e.hover(function(){if(!j){clearInterval(z);j=true}},function(){if(j){z=setInterval(function(){A(o)},c.rotationSpeed);j=false}})}if(c.animation==="slide"&&h>1){$first=g.eq(0);$last=g.eq(h-1);$first.clone().addClass("clone").removeClass("slide").appendTo(f);$last.clone().addClass("clone").removeClass("slide").prependTo(f);g=f.children("li");h=g.length;$wrapper=a('<div class="bjqs-wrapper"></div>').css({width:c.width,height:c.height,overflow:"hidden",position:"relative"});f.css({width:c.width*h,left:-c.width});g.css({"float":"left",position:"relative",display:"list-item"});$wrapper.prependTo(e);f.appendTo($wrapper)}var y=function(a){if(c.animation==="fade"){if(a===o){!n.next().length?m=0:m++}else if(a===p){!n.prev().length?m=h-1:m--}}if(c.animation==="slide"){if(a===o){m=l+1}if(a===p){m=l-1}}return m};if(c.automatic&&h>1){var z=setInterval(function(){A(o,false)},c.rotationSpeed)}g.eq(k).show();f.show();var A=function(a,b){if(!i){if(a){m=y(a)}else if(b&&c.animation==="fade"){m=b-1}else{m=b}i=true;if(c.animation==="fade"){if(c.showMarkers){x.eq(k).removeClass("active-marker");x.eq(m).addClass("active-marker")}r=g.eq(m);n.fadeOut(c.animationDuration);r.fadeIn(c.animationDuration,function(){n.hide();k=m;n=r;i=false})}else if(c.animation==="slide"){if(c.showMarkers){x.eq(l-1).removeClass("active-marker");if(m===h-1){x.eq(0).addClass("active-marker")}else if(m===0){x.eq(h-3).addClass("active-marker")}else{x.eq(m-1).addClass("active-marker")}}f.animate({left:-m*c.width},c.animationDuration,function(){if(m===0){l=h-2;f.css({left:-l*c.width})}else if(m===h-1){l=1;f.css({left:-c.width})}else{l=m}i=false})}}};return this}})(jQuery)

});