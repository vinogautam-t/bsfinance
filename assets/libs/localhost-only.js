(function(){var o;window.cloudspongeProxy=function(){var o,e,n,t,r,a,c,i,s,d;i=function(o){var e;return e={},o.replace(/([^?=&]+)(=([^&]*))?/g,function(o,n,t,r){return e[n]=decodeURIComponent(r)}),e}(window.location.search),r={};for(t in i)d=i[t],"code"!==t&&"state"!==t&&"error"!==t&&"error_code"!==t&&"forward"!==t||(r[t]=d);return o=r.code||r.error||r.error_code,e=o&&r.state&&r.state.match(/_csAuth/),e&&(a=function(){var o;o=[];for(n in r)s=r[n],o.push(n+"="+s);return o}().join("&"),c="https://api.cloudsponge.com/auth?"+a,window.location=c),{}}(),o=function(){function o(){this.location=e(),(window.cloudsponge.config.debug||this.location.queryParams&&this.location.queryParams.debug)&&(this.debug="?debug=true")}var e,n;return o.prototype.scriptId="__cs-script__",o.prototype.debug="",o.prototype.addSentry=function(o,e){var n;return o?(n=window.Raven&&Raven.noConflict(),this.addJavascript("https://cdn.ravenjs.com/3.15.0/raven.min.js","cloudsponge-raven-script",{},function(){var o;try{return cloudsponge.r=Raven,cloudsponge.r.config("https://7ea7da3da02644a3a3063df341cb2c4f@sentry.io/73523",{release:"b49c629b08ab90f25a155a55d35c790a84c2e1e6",environment:"production",whitelistUrls:[/cloudsponge/],tags:{widgetVersion:cloudsponge.version}}).install()}finally{if(window.Raven=n,e)try{e()}catch(e){throw o=e,cloudsponge.r&&cloudsponge.r.captureException(o),o}}})):e()},o.prototype.load=function(){return window.cloudsponge.config.__beforeLoad&&window.cloudsponge.config.__beforeLoad.call(),this.addJavascript(this.location.origin+"/assets/address_books/address_books15-be03d63f8a35946dd738ceeaed052c0b054ea12849d8b735a04a3b7988b46b46.js"+this.debug,this.scriptId,{crossorigin:"anonymous"})},o.prototype.addTrackingPixel=function(){return document.addEventListener("DOMContentLoaded",function(){var o,e;return o="localhost-only",e="k",(new Image).src=cloudsponge.bootstrapper.location.origin+("/wlt?k="+o+"&t="+e+"&v="+window.cloudsponge.version+"&h="+window.location.host)})},o.prototype.launchHashExists=function(){var o,e;if(window.location)return e=/#?\(_cs_import=([^:]+):([^)]+)\)/,o=location.hash.match(e),!!o},o.prototype.addJavascript=function(o,e,n,t){var r,a,c,i,s;r=document.createElement("script"),r.async=1,r.src=o,e&&(r.id=e),i=n||{};for(c in i)s=i[c],r.setAttribute(c,s);return t&&(r.readyState?r.onreadystatechange=function(){if("loaded"===r.readyState||"complete"===r.readyState)return r.onreadystatechange=null,t()}:r.onload=function(){return t()}),a=document.getElementsByTagName("script")[0],a.parentNode.insertBefore(r,a)},o.prototype.addStylesheet=function(o){var e,n;return e=document.createElement("link"),e.rel="stylesheet",e.media="screen",e.type="text/css",e.href=o,n=document.getElementsByTagName("script")[0],n.parentNode.insertBefore(e,n)},n=function(o){var e;return e={},o.replace(new RegExp("([^?=&]+)(=([^&]*))?","g"),function(o,n,t,r){return e[n]=decodeURIComponent(r)}),e},e=function(){var o,e,t,r,a,c,i;for(c={src:null,scheme:window.location.protocol,host:"api.cloudsponge.com",origin:"https://api.cloudsponge.com",port:null,search:"",queryParams:{},anchor:null,path:null},r=/^(https?:)?\/\/([^\/:]+):?([0-9]+)?\/widget(\/v[0-9]+)?\/localhost-only\.js\??([^\#]*)\#?(.*)$/,a=document.getElementsByTagName("script"),o=0,e=a.length;o<e;o++)if(i=a[o],t=r.exec(i.src)){c.src=t[0],c.scheme=t[1]?t[1]:window.location.protocol,c.host=t[2],c.origin=c.scheme+"//"+t[2],t[3]&&(c.port=t[3],c.origin+=":"+t[3]),t[4]&&(c.path=t[4]),t[5]&&(c.search=t[5],c.queryParams=n(t[5])),t[6]&&(c.anchor=t[6]);break}return c},o}(),function(e,n){if(!e.cloudsponge)return e.cloudsponge={loaded:!1,initOptions:{},config:{key:"8b761f8fa34ffc475726c587d6dd869f33a36363"},init:function(o){var n,t,r;if(o){t=[];for(n in o)r=o[n],t.push(e.cloudsponge.initOptions[n]=r);return t}},load:function(o){if(e.cloudsponge.init(o),!e.cloudsponge.loaded)return e.cloudsponge.loaded=!0,n.load()}},e.cloudsponge.version="1.5.1",o.prototype.addSentry(null,function(){return e.cloudsponge.bootstrapper=n=new o,!n.launchHashExists()&&window.csPageOptions&&csPageOptions.lazyLoad||cloudsponge.load(),n.addTrackingPixel()})}(window)}).call(this);