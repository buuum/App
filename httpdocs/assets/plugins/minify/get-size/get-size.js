!function(a,b){"use strict";"function"==typeof define&&define.amd?define(function(){return b()}):"object"==typeof module&&module.exports?module.exports=b():a.getSize=b()}(window,function(){"use strict";function a(a){var b=parseFloat(a),c=a.indexOf("%")==-1&&!isNaN(b);return c&&b}function b(){}function c(){for(var a={width:0,height:0,innerWidth:0,innerHeight:0,outerWidth:0,outerHeight:0},b=0;b<j;b++){var c=i[b];a[c]=0}return a}function d(a){var b=getComputedStyle(a);return b||h("Style returned "+b+". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"),b}function e(){if(!k){k=!0;var b=document.createElement("div");b.style.width="200px",b.style.padding="1px 2px 3px 4px",b.style.borderStyle="solid",b.style.borderWidth="1px 2px 3px 4px",b.style.boxSizing="border-box";var c=document.body||document.documentElement;c.appendChild(b);var e=d(b);f.isBoxSizeOuter=g=200==a(e.width),c.removeChild(b)}}function f(b){if(e(),"string"==typeof b&&(b=document.querySelector(b)),b&&"object"==typeof b&&b.nodeType){var f=d(b);if("none"==f.display)return c();var h={};h.width=b.offsetWidth,h.height=b.offsetHeight;for(var k=h.isBorderBox="border-box"==f.boxSizing,l=0;l<j;l++){var m=i[l],n=f[m],o=parseFloat(n);h[m]=isNaN(o)?0:o}var p=h.paddingLeft+h.paddingRight,q=h.paddingTop+h.paddingBottom,r=h.marginLeft+h.marginRight,s=h.marginTop+h.marginBottom,t=h.borderLeftWidth+h.borderRightWidth,u=h.borderTopWidth+h.borderBottomWidth,v=k&&g,w=a(f.width);w!==!1&&(h.width=w+(v?0:p+t));var x=a(f.height);return x!==!1&&(h.height=x+(v?0:q+u)),h.innerWidth=h.width-(p+t),h.innerHeight=h.height-(q+u),h.outerWidth=h.width+r,h.outerHeight=h.height+s,h}}var g,h="undefined"==typeof console?b:function(a){console.error(a)},i=["paddingLeft","paddingRight","paddingTop","paddingBottom","marginLeft","marginRight","marginTop","marginBottom","borderLeftWidth","borderRightWidth","borderTopWidth","borderBottomWidth"],j=i.length,k=!1;return f});