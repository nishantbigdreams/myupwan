!function(e){"use strict";var t="iCheck",i=t+"-helper",a="checkbox",s="radio",n="checked",r="un"+n,o="disabled",d="determinate",c="in"+d,l="update",u="type",f="click",p="touchbegin.i touchend.i",h="addClass",v="removeClass",b="trigger",g="label",y="cursor",m=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent);function k(e,t,i){var a=e[0],r=/er/.test(i)?c:/bl/.test(i)?o:n,f=i==l?{checked:a[n],disabled:a[o],indeterminate:"true"==e.attr(c)||"false"==e.attr(d)}:a[r];if(/^(ch|di|in)/.test(i)&&!f)C(e,r);else if(/^(un|en|de)/.test(i)&&f)w(e,r);else if(i==l)for(var p in f)f[p]?C(e,p,!0):w(e,p,!0);else t&&"toggle"!=i||(t||e[b]("ifClicked"),f?a[u]!==s&&w(e,r):C(e,r))}function C(a,l,f){var p=a[0],b=a.parent(),g=l==n,m=l==c,k=l==o,C=m?d:g?r:"enabled",x=A(a,C+H(p[u])),D=A(a,l+H(p[u]));if(!0!==p[l]){if(!f&&l==n&&p[u]==s&&p.name){var P=a.closest("form"),T='input[name="'+p.name+'"]';(T=P.length?P.find(T):e(T)).each(function(){this!==p&&e(this).data(t)&&w(e(this),l)})}m?(p[l]=!0,p[n]&&w(a,n,"force")):(f||(p[l]=!0),g&&p[c]&&w(a,c,!1)),j(a,g,l,f)}p[o]&&A(a,y,!0)&&b.find("."+i).css(y,"default"),b[h](D||A(a,l)||""),b.attr("role")&&!m&&b.attr("aria-"+(k?o:n),"true"),b[v](x||A(a,C)||"")}function w(e,t,a){var s=e[0],l=e.parent(),f=t==n,p=t==c,b=t==o,g=p?d:f?r:"enabled",m=A(e,g+H(s[u])),k=A(e,t+H(s[u]));!1!==s[t]&&(!p&&a&&"force"!=a||(s[t]=!1),j(e,f,g,a)),!s[o]&&A(e,y,!0)&&l.find("."+i).css(y,"pointer"),l[v](k||A(e,t)||""),l.attr("role")&&!p&&l.attr("aria-"+(b?o:n),"false"),l[h](m||A(e,g)||"")}function x(i,a){i.data(t)&&(i.parent().html(i.attr("style",i.data(t).s||"")),a&&i[b](a),i.off(".i").unwrap(),e(g+'[for="'+i[0].id+'"]').add(i.closest(g)).off(".i"))}function A(e,i,a){if(e.data(t))return e.data(t).o[i+(a?"":"Class")]}function H(e){return e.charAt(0).toUpperCase()+e.slice(1)}function j(e,t,i,a){a||(t&&e[b]("ifToggled"),e[b]("ifChanged")[b]("if"+H(i)))}e.fn[t]=function(r,d){var y='input[type="'+a+'"], input[type="'+s+'"]',A=e(),H=function(t){t.each(function(){var t=e(this);A=t.is(y)?A.add(t):A.add(t.find(y))})};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(r))return r=r.toLowerCase(),H(this),A.each(function(){var t=e(this);"destroy"==r?x(t,"ifDestroyed"):k(t,!0,r),e.isFunction(d)&&d()});if("object"!=typeof r&&r)return this;var j=e.extend({checkedClass:n,disabledClass:o,indeterminateClass:c,labelHover:!0},r),D=j.handle,P=j.hoverClass||"hover",T=j.focusClass||"focus",F=j.activeClass||"active",I=!!j.labelHover,L=j.labelHoverClass||"hover",M=0|(""+j.increaseArea).replace("%","");return D!=a&&D!=s||(y='input[type="'+D+'"]'),M<-50&&(M=-50),H(this),A.each(function(){var r=e(this);x(r);var d,c=this,y=c.id,A=-M+"%",H=100+2*M+"%",D={position:"absolute",top:A,left:A,display:"block",width:H,height:H,margin:0,padding:0,background:"#fff",border:0,opacity:0},N=m?{position:"absolute",visibility:"hidden"}:M?D:{position:"absolute",opacity:0},Q=c[u]==a?j.checkboxClass||"i"+a:j.radioClass||"i"+s,S=e(g+'[for="'+y+'"]').add(r.closest(g)),U=!!j.aria,Z=t+"-"+Math.random().toString(36).substr(2,6),$='<div class="'+Q+'" '+(U?'role="'+c[u]+'" ':"");U&&S.each(function(){$+='aria-labelledby="',this.id?$+=this.id:(this.id=Z,$+=Z),$+='"'}),$=r.wrap($+"/>")[b]("ifCreated").parent().append(j.insert),d=e('<ins class="'+i+'"/>').css(D).appendTo($),r.data(t,{o:j,s:r.attr("style")}).css(N),j.inheritClass&&$[h](c.className||""),j.inheritID&&y&&$.attr("id",t+"-"+y),"static"==$.css("position")&&$.css("position","relative"),k(r,!0,l),S.length&&S.on(f+".i mouseover.i mouseout.i "+p,function(t){var i=t[u],a=e(this);if(!c[o]){if(i==f){if(e(t.target).is("a"))return;k(r,!1,!0)}else I&&(/ut|nd/.test(i)?($[v](P),a[v](L)):($[h](P),a[h](L)));if(!m)return!1;t.stopPropagation()}}),r.on(f+".i focus.i blur.i keyup.i keydown.i keypress.i",function(e){var t=e[u],i=e.keyCode;return t!=f&&("keydown"==t&&32==i?(c[u]==s&&c[n]||(c[n]?w(r,n):C(r,n)),!1):void("keyup"==t&&c[u]==s?!c[n]&&C(r,n):/us|ur/.test(t)&&$["blur"==t?v:h](T)))}),d.on(f+" mousedown mouseup mouseover mouseout "+p,function(e){var t=e[u],i=/wn|up/.test(t)?F:P;if(!c[o]){if(t==f?k(r,!1,!0):(/wn|er|in/.test(t)?$[h](i):$[v](i+" "+F),S.length&&I&&i==P&&S[/ut|nd/.test(t)?v:h](L)),!m)return!1;e.stopPropagation()}})})}}(window.jQuery||window.Zepto);