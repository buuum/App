var App;App=function(){function a(){this.kuv=new Kuv,this.controller=new Controller,this.controllers_page=["menu","datatables","actions","posts"]}return a.prototype.ini=function(){this.kuv.buildMyEvents("Controller"),this.kuv.buildAllEvents(this.controllers_page)},a}();var Utils,hasProp={}.hasOwnProperty;Utils=function(){function a(){}return a.getObjJson=function(a){var b;return b=!1,a&&(b=$.extend({},a,Config.get("lang_obj"))),Config.get("user_storage")&&b?b=$.extend({},b,Config.get("user_storage")):Config.get("user_storage")&&(b=$.extend({},Config.get("user_storage"),Config.get("lang_obj"))),b||(b=Config.get("lang_obj")),b},a.merge=function(a,b){return null==a&&(a={}),null==b&&(b={}),$.extend({},a,b)},a.blockload=function(a){var b;a.addClass("disabled"),b=a.find("span").text(),a.find("span").text(a.data("disabledtext")),a.data("disabledtext",b)},a.unblockload=function(a){var b;b=a.find("span").text(),a.find("span").text(a.data("disabledtext")),a.data("disabledtext",b),a.removeClass("disabled")},a.scrollanimate=function(b,c){var d,e;d="all 300ms ease-out",e="translateX("+c+"px)",a.setStyles(b,{"-webkit-transition":"-webkit-"+d,"-moz-transition":"-moz-"+d,"-ms-transition":"-ms-"+d,"-o-transition":"-o-"+d,transition:d,"-webkit-transform":e,"-moz-transform":e,"-ms-transform":e,"-o-transform":e,transform:e}),null!=b[0]?b.one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(){a.setStyles(b,{"-webkit-transition":"","-moz-transition":"","-ms-transition":"","-o-transition":"",transition:""})}):b.addEventListener("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(c){c.target.removeEventListener(c.type,function(){},!1),a.setStyles(b,{"-webkit-transition":"","-moz-transition":"","-ms-transition":"","-o-transition":"",transition:""})},!1)},a.scrollanimateopacity=function(b,c){var d,e;d="all 300ms ease-out",e=c,a.setStyles(b,{"-webkit-transition":"-webkit-"+d,"-moz-transition":"-moz-"+d,"-ms-transition":"-ms-"+d,"-o-transition":"-o-"+d,transition:d,opacity:e}),b.one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(){a.setStyles(b,{"-webkit-transition":"","-moz-transition":"","-ms-transition":"","-o-transition":"",transition:""})}),0===c&&b.css("display","hidden")},a.setStyles=function(a,b){var c,d;for(c in b)hasProp.call(b,c)&&(d=b[c],b.hasOwnProperty(c)&&(d=b[c],"marginTop"===c&&(d+="px"),void 0===a[0]?a.style[c]=d:a[0].style[c]=d));return a},a.scroll=function(b,c){var d;d="translateX("+c+"px)",a.setStyles(b,{"-webkit-transform":d,"-moz-transform":d,"-ms-transform":d,"-o-transform":d,transform:d})},a.round=function(a,b,c){var d,e,f,g,h;return b|=0,f=Math.pow(10,b),a*=f,g=a>0|-(a<0),e=a%1===.5*g,d=Math.floor(a),e&&(a="PHP_ROUND_HALF_DOWN"===c?d+(g<0):"PHP_ROUND_HALF_EVEN"===c?d+d%2*g:"PHP_ROUND_HALF_ODD"===c?d+!(d%2):d+(g>0)),h=e?a:Math.round(a),h/f},a.isset=function(){var a,b,c;if(a=arguments,c=a.length,b=0,0!==c){for(;b!==c;){if(void 0===a[b]||null===a[b])return!1;b++}return!0}},a.realSizes=function(a,b){var c,d,e,f,g;return null==b&&(b=!1),g=window.innerWidth,e=window.innerHeight,c=a.clone(),c.css("visibility","hidden"),c.css("display","inline-block"),$("body").append(c),b?(f=c.find(b).outerWidth(),d=c.find(b).outerHeight()):(f=c.outerWidth(),d=c.outerHeight()),c.remove(),{window_w:g,window_h:e,width:f,height:d}},a.get_class_methods=function(a){var b,c,d,e;if(c=void 0,e=[],d="","function"==typeof a)c=a,b=""+c.name;else if("string"==typeof a)c=this.window[a],b=""+a;else if("object"==typeof a){c=a,b=""+c.constructor.name;for(d in c.constructor)d=d,"function"==typeof c.constructor[d]&&e.push(d)}for(d in c)d=d,"function"==typeof c[d]&&e.push(d);for(d in c.prototype)d=d,"function"==typeof c.prototype[d]&&e.push(d);return{classname:b,functions:e}},a.serializeObject=function(a){var b,c;return c={},b=a.serializeArray(),$.each(b,function(){null!=c[this.name]?(c[this.name].push||(c[this.name]=[c[this.name]]),c[this.name].push(this.value||"")):c[this.name]=this.value||""}),c},a.renumerar=function(a,b){var c,d;return d=new RegExp(b),c=0,$.each(a,function(a){return function(a,b){return $.each($(b).find("[name]"),function(a,b){var e,f;e=$(b).attr("name"),f=e.match(d),f&&(e=e.replace(d,"$1"+c+"$2"),$(b).attr("name",e))}),c++}}(this))},a.iniSummernote=function(){$(".summernote").summernote({styleWithSpan:!1,height:300})},a}();var Config;Config=function(){function a(){this.varconfigs={version:"0.0.1"}}return a.prototype.get=function(a){return this.varconfigs[a]},a.prototype.set=function(a,b){this.varconfigs[a]=b},a}(),Config=new Config;var actionsController;actionsController=function(){function a(){this.events={"click .showdelete":"showmodal","click .deleteitem":"removeItem","click .cancelitem":"closeModal"},this.modal=!1}return a.prototype.showmodal=function(a){this.modal=new modalbox,this.modal.setOptions({ajax:a.attr("href"),show:"show_buuummodal_from_top",close:"hide_buuummodal_top"}),this.modal.ini()},a.prototype.removeItem=function(a){Api.deleteData({url:a.attr("href")},function(a){return function(b){b.error||($("#item"+b.id).remove(),a.modal.close())}}(this))},a.prototype.closeModal=function(a){this.modal.close()},a}();var Controller;Controller=function(){function a(){this.events={"click .blockload notpreventdefault":"Utils.blockload"}}return a}();var datatablesController;datatablesController=function(){function a(){this.events=this.initialize()}return a.prototype.initialize=function(){var a,b,c;$("#items_list").length>0&&(b=$("#items_list"),a=b.attr("data-sort")?b.attr("data-sort"):"true",a="true"===a,c=$("#items_list").dataTable({iDisplayLength:100,bSort:Boolean(a),sDom:"<'row no-gutter'<'col-sm-6'l><'col-sm-6'f>><'table-responsive'<'row no-gutter'<'col-sm-12'tr>>><'row no-gutter'<'col-sm-5'i><'col-sm-7'p>>",sWrapper:"dataTables_wrapper form-inline dt-bootstrap",sFilterInput:"form-control input-sm",sLengthSelect:"form-control input-sm",sPaginationType:"full_numbers",renderer:"bootstrap",oLanguage:{sEmptyTable:"No hay datos",sInfo:"_START_ hasta _END_ de _TOTAL_",sInfoEmpty:"0 registros",sInfoFiltered:"(_MAX_ en total)",sInfoPostFix:"",sInfoThousands:",",sLengthMenu:"Mostrar _MENU_",sLoadingRecords:"Cargando...",sProcessing:"Procesando...",sSearch:"Buscar:",sZeroRecords:"No se encontraron resultados",oPaginate:{sFirst:"Primero",sLast:"Último",sNext:"Siguiente",sPrevious:"Anterior"},oAria:{sSortAscending:": activar para Ordenar Ascendentemente",sSortDescending:": activar para Ordendar Descendentemente"}}})),a&&c.fnSort([[0,"desc"]])},a}();var imagesController;imagesController=function(){function a(){this.events={"click a#uploadimage_":"uploadimage_","click a.deleteimage":"delete"},$(".uploadimagemultiple").length>0&&this.iniuploadmultiple($(".uploadimagemultiple")),$(".uploadimage").length>0&&this.iniupload($(".uploadimage"))}return a.prototype.iniupload=function(a){a.liteUpload({script:a.next("a").attr("href"),onClick:function(a){return!0},onBefore:function(a){return a.next("img").attr("src",""),a.nextAll("input").first().val(""),!0},onEnd:function(a){},onSuccess:function(a,b,c){return a.error?alert(a.message):(c.next("img").attr("src",a.url["default"]),c.nextAll("input").first().val(a.url["default"]))}})},a.prototype.iniuploadmultiple=function(a){a.liteUpload({script:a.next("a").attr("href"),onClick:function(a){return!0},onSelectFiles:function(a){return $("#showimage").attr("src",""),$('input[name="url"]').val(""),!0},onProgress:function(a,b,c){return!0},onEnd:function(a){},onSuccess:function(a){return function(a,b,c){return a.error?alert(a.message):$.get(c.data("url"),function(b){var d,e,f,g;return d=$(b),d.find("img").attr("src",a.url["default"]),d.find("input").val(a.url["default"]),$(".listuploads").append(d),g=c.attr("data-schema"),f=new RegExp(g),e=c.next(".listuploads").find(".image"),Utils.renumerar(e,g)})}}(this)})},a.prototype["delete"]=function(a){console.log("Eliminar"),a.parent().remove()},a}();var menuController;menuController=function(){function a(){this.events={"click .openmenu":"showsidebar"}}return a.prototype.showsidebar=function(a){$(".sidebar").position().left<0?($(".sidebar").css("left",0),$(".navbar").css("padding-left","260px"),$(".main-container").css("padding-left","260px")):($(".sidebar").css("left",-270),$(".navbar").css("margin-left",0),$(".navbar").css("padding-left",0),$(".main-container").css("padding-left",0))},a}();var postsController;postsController=function(){function a(){this.events={"click a.additem":"additem","click a.delete_item":"removeitem"}}return a.prototype.removeitem=function(a){a.closest(".item_list").remove()},a.prototype.additem=function(a){var b;return b=a.parents(".item_list"),$.get(a.attr("href"),function(c){return function(d){var e,f,g;if(g=a.attr("data-schema"),f=a.closest(".list_items"),f.find(".content-items").eq(0).append($(d)),e=f.find(".content-items").eq(0).find("> .item_list"),c.renumerar(e,g),b.length>0)return $.each(b,function(a,b){var d;e=$(b).find(".content-items").eq(0).find("> .item_list"),g=$(b).closest(".list_items").find(".additem").last().attr("data-schema"),d=$(b).closest(".content-items").find("> .item_list").index($(b)),c.renumerar(e,g,d)})}}(this))},a.prototype.renumerar=function(a,b,c){var d;return null==c&&(c=null),d=new RegExp(b),$.each(a,function(a){return function(a,b){return $.each($(b).find("[name]"),function(b,e){var f;f=$(e).attr("name"),null!==c&&(a=c),f=f.replace(d,"$1"+a+"$3"),$(e).attr("name",f)})}}(this))},a}();var testsController,bind=function(a,b){return function(){return a.apply(b,arguments)}};testsController=function(){function a(){this.addtext=bind(this.addtext,this),this.events={"click a.addfase":"addfase","click a.deleterelation":"deleterelation","click a.addtext":"addtext"}}return a.prototype.deleterelation=function(a){a.closest(".fasetext").find(".addtext").removeClass("hidden"),a.closest(".relation").remove()},a.prototype.addfase=function(a){return $.get(a.data("url"),function(b){return function(b){var c,d;c=$(b),$(".fases").append(c),d=a.attr("data-schema"),Utils.renumerar($(".fases").find(".fase"),d)}}(this))},a.prototype.addtext=function(a){$.get(a.data("url"),function(b){return function(b){var c,d,e;return c=$(b),a.closest("div").prepend(c),e=a.closest(".fase").find(".texts"),d=a.attr("data-schema"),Utils.renumerar(e,d),d=$(".addfase").attr("data-schema"),console.log(d),Utils.renumerar($(".fases").find(".fase"),d),a.addClass("hidden"),Utils.iniSummernote()}}(this))},a}();var Kuv;Kuv=function(){function a(){this.alias=[]}return a.prototype.getAllControllers=function(){return App.controllers},a.prototype.getAllModels=function(){return App.models},a.prototype.getAliasFunctions=function(){$.each(this.getAllModels(),function(a){return function(b,c){var d;d=Utils.get_class_methods(window[c]),a.alias[""+c]=d.functions}}(this))},a.prototype.getAliasName=function(a){return $.each(this.getAllModels(),function(b){return function(c,d){return $.each(b.alias[""+d],function(b,c){if(c===a)return d})}}(this))},a.prototype.getFunction=function(a){var b;return b=a.split("."),2===b.length?window[b[0]][b[1]]:3===b.length?window[b[0]][b[1]][b[2]]:4===b.length?window[b[0]][b[1]][b[2]][b[3]]:5===b.length?window[b[0]][b[1]][b[2]][b[3]][b[4]]:6===b.length?window[b[0]][b[1]][b[2]][b[3]][b[4]][b[5]]:void 0},a.prototype.buildEvent=function(a,b,c){var d,e,f,g;d=a.split(" "),g=!0,"notpreventdefault"===d[d.length-1]?(g=!1,e=d.slice(1,d.length-1).join(" ")):e=d.slice(1).join(" "),f=b.split("."),"resize"===d[0]?this.createResize(e,f,b,c):this.createEvent(d,e,f,g,b,c)},a.prototype.createResize=function(a,b,c,d){"window"===a?$(window).resize(function(a){return function(){return a.searchFunction(b,c,d)}}(this)):$(a).resize(function(a){return function(){return a.searchFunction(b,c,d)}}(this))},a.prototype.createEvent=function(a,b,c,d,e,f){$("body").on(a[0],b,function(a){return function(b){d&&b.preventDefault(),a.searchFunctionEvent(c,e,b,f)}}(this))},a.prototype.searchFunctionEvent=function(a,b,c,d){if(a[1]){if("Utils"!==a[0]&&"App"!==a[0]&&("Controller"===d?a.unshift("App","controller"):a[0]!==d&&a.unshift(d)),2===a.length)return window[a[0]][a[1]]($(c.currentTarget),c);if(3===a.length)return window[a[0]][a[1]][a[2]]($(c.currentTarget),c);if(4===a.length)return window[a[0]][a[1]][a[2]][a[3]]($(c.currentTarget),c);if(5===a.length)return window[a[0]][a[1]][a[2]][a[3]][a[4]]($(c.currentTarget),c);if(6===a.length)return window[a[0]][a[1]][a[2]][a[3]][a[4]][a[5]]($(c.currentTarget),c)}else{if("Controller"===d)return App.controller[b]($(c.currentTarget),c);if(null!=window[d])return window[d][b]($(c.currentTarget),c);if(null!=App[d])return App[d][b]($(c.currentTarget),c)}},a.prototype.searchFunction=function(a,b){if(a[1]){if("Utils"!==a[0]&&"App"!==a[0]&&("Controller"===name?a.unshift("App","controller"):a[0]!==name&&a.unshift(name)),2===a.length)return window[a[0]][a[1]]();if(3===a.length)return window[a[0]][a[1]][a[2]]();if(4===a.length)return window[a[0]][a[1]][a[2]][a[3]]();if(5===a.length)return window[a[0]][a[1]][a[2]][a[3]][a[4]]();if(6===a.length)return window[a[0]][a[1]][a[2]][a[3]][a[4]][a[5]]()}else{if("Controller"===name)return App.controller[b]();if(null!=window[name])return window[name][b]();if(null!=App[name])return App[name][b]()}},a.prototype.setEvents=function(){var a;null!=App.controller.events&&(a=App.controller.events,$.each(a,function(a){return function(b,c){a.buildEvent(b,c,"Controller")}}(this))),$.each(this.getAllControllers(),function(b){return function(c,d){if(a=!1,null!=window[d].events&&(a=window[d].events),a)return $.each(a,function(a,c){return b.buildEvent(a,c,d)})}}(this))},a.prototype.buildAllEvents=function(a){a.length>0&&$.each(a,function(a){return function(b,c){var d,e;d=c+"C",e=c+"Controller",App[d]=new window[e],a.buildMyEvents(d)}}(this))},a.prototype.buildMyEvents=function(a){var b;b=!1,"Controller"===a?null!=App.controller.events&&(b=App.controller.events,$.each(b,function(a){return function(b,c){a.buildEvent(b,c,"Controller")}}(this))):(null!=window[a]?b=window[a].events:null!=App[a]&&(b=App[a].events),b&&$.each(b,function(b){return function(c,d){return b.buildEvent(c,d,a)}}(this)))},a}();var Model;Model=function(){function a(){}return a.prototype.setTimeout=function(a){this.timeout=a},a}();var Api,ApiService;ApiService=function(){function a(){this.cache=[]}return a.prototype.call=function(a,b){var c;return null==b&&(b={}),c={timeout:0,headers:!1,method:"POST",url:!1},b=Utils.merge(c,b),Config.set("ajaxLoad",$.ajax({type:b.method,url:b.url?b.url:Config.get("server"),data:a,dataType:"json",timeout:b.timeout,beforeSend:function(a){return function(a){b.headers&&a.setRequestHeader(""+b.headers.name,"Bearer "+b.headers.value)}}(this)})),Config.get("ajaxLoad")},a.prototype.call2=function(a){return Config.set("ajaxLoad",$.ajax({type:a.method,url:a.url?a.url:Config.get("server"),data:a.params,dataType:"json",timeout:a.timeout,beforeSend:function(b){return function(b){a.headers&&b.setRequestHeader(""+a.headers.name,"Bearer "+a.headers.value)}}(this)})),Config.get("ajaxLoad")},a.prototype.callAjax=function(a,b){return this.call2(a).success(function(c){return function(d){return a.cache.save&&c.saveCahe(a.cache,d),b?b(d):d}}(this)).error(function(a){return function(a){return b?b(a):a}}(this))},a.prototype.clearAllLocalData=function(){localStorage.clear()},a.prototype.removeLocalData=function(a){localStorage.removeItem(a)},a.prototype.setLocalData=function(a,b,c){null==c&&(c=!1),c?localStorage.setItem(a,b):localStorage.setItem(a,JSON.stringify(b))},a.prototype.getLocalData=function(a,b){var c,d;return null==b&&(b=!1),c=localStorage.getItem(a),d=null!==c&&void 0!==c&&(b?c:JSON.parse(c))},a.prototype.getData=function(a,b){var c,d;return c={timeout:0,headers:!1,method:"GET",url:Config.get("server"),cache:{save:!1,name:!1,sublist:!1},params:{}},a=Utils.merge(c,a),a.cache.name&&this.cache.hasOwnProperty(a.cache.name)?(d=this.cache[a.cache.name],b?b(d):d):this.callAjax(a,b)},a.prototype.setData=function(a,b){var c;return c={timeout:0,headers:!1,method:"POST",url:Config.get("server"),cache:{save:!1,name:!1,sublist:!1},params:{}},a=Utils.merge(c,a),this.callAjax(a,b)},a.prototype.updateData=function(a,b){var c;return c={timeout:0,headers:!1,method:"PUT",url:Config.get("server"),cache:{save:!1,name:!1,sublist:!1},params:{}},a=Utils.merge(c,a),this.callAjax(a,b)},a.prototype.deleteData=function(a,b){var c;return c={timeout:0,headers:!1,method:"DELETE",url:Config.get("server"),cache:{save:!1,name:!1,sublist:!1},params:{}},a=Utils.merge(c,a),this.callAjax(a,b)},a.prototype.saveCahe=function(a,b){this.cache[a.name]=b,a.sublist&&this.saveSublist(a,b)},a.prototype.saveSublist=function(a,b){var c,d,e,f;d=b[a.sublist[0]],e=a.sublist[1][1],c=a.sublist[1][0],f=!!a.sublist[1][2]&&a.sublist[1][2],$.each(d,function(a){return function(b,d){var g;f?a.cache[c+d[""+e]]=(g={},g[""+f]=d[f],g):a.cache[c+d[""+e]]=d}}(this))},a}(),Api=new ApiService;