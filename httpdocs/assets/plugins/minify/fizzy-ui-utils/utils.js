!function(a,b){"function"==typeof define&&define.amd?define(["desandro-matches-selector/matches-selector"],function(c){return b(a,c)}):"object"==typeof module&&module.exports?module.exports=b(a,require("desandro-matches-selector")):a.fizzyUIUtils=b(a,a.matchesSelector)}(window,function(a,b){"use strict";var c={};c.extend=function(a,b){for(var c in b)a[c]=b[c];return a},c.modulo=function(a,b){return(a%b+b)%b},c.makeArray=function(a){var b=[];if(Array.isArray(a))b=a;else if(a&&"number"==typeof a.length)for(var c=0;c<a.length;c++)b.push(a[c]);else b.push(a);return b},c.removeFrom=function(a,b){var c=a.indexOf(b);c!=-1&&a.splice(c,1)},c.getParent=function(a,c){for(;a!=document.body;)if(a=a.parentNode,b(a,c))return a},c.getQueryElement=function(a){return"string"==typeof a?document.querySelector(a):a},c.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},c.filterFindElements=function(a,d){a=c.makeArray(a);var e=[];return a.forEach(function(a){if(a instanceof HTMLElement){if(!d)return void e.push(a);b(a,d)&&e.push(a);for(var c=a.querySelectorAll(d),f=0;f<c.length;f++)e.push(c[f])}}),e},c.debounceMethod=function(a,b,c){var d=a.prototype[b],e=b+"Timeout";a.prototype[b]=function(){var a=this[e];a&&clearTimeout(a);var b=arguments,f=this;this[e]=setTimeout(function(){d.apply(f,b),delete f[e]},c||100)}},c.docReady=function(a){var b=document.readyState;"complete"==b||"interactive"==b?setTimeout(a):document.addEventListener("DOMContentLoaded",a)},c.toDashed=function(a){return a.replace(/(.)([A-Z])/g,function(a,b,c){return b+"-"+c}).toLowerCase()};var d=a.console;return c.htmlInit=function(b,e){c.docReady(function(){var f=c.toDashed(e),g="data-"+f,h=document.querySelectorAll("["+g+"]"),i=document.querySelectorAll(".js-"+f),j=c.makeArray(h).concat(c.makeArray(i)),k=g+"-options",l=a.jQuery;j.forEach(function(a){var c,f=a.getAttribute(g)||a.getAttribute(k);try{c=f&&JSON.parse(f)}catch(h){return void(d&&d.error("Error parsing "+g+" on "+a.className+": "+h))}var i=new b(a,c);l&&l.data(a,e,i)})})},c});