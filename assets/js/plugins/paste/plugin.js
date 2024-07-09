!function(){var a={},b=function(b){for(var c=a[b],e=c.deps,f=c.defn,g=e.length,h=new Array(g),i=0;i<g;++i)h[i]=d(e[i]);var j=f.apply(null,h);if(void 0===j)throw"module ["+b+"] returned undefined";c.instance=j},c=function(b,c,d){if("string"!=typeof b)throw"module id must be a string";if(void 0===c)throw"no dependencies for "+b;if(void 0===d)throw"no definition function for "+b;a[b]={deps:c,defn:d,instance:void 0}},d=function(c){var d=a[c];if(void 0===d)throw"module ["+c+"] was undefined";return void 0===d.instance&&b(c),d.instance},e=function(a,b){for(var c=a.length,e=new Array(c),f=0;f<c;++f)e[f]=d(a[f]);b.apply(null,e)},f={};f.bolt={module:{api:{define:c,require:e,demand:d}}};var g=c,h=function(a,b){g(a,[],function(){return b})};g("1",[],function(){var a=function(b){var c=b,d=function(){return c},e=function(a){c=a},f=function(){return a(d())};return{get:d,set:e,clone:f}};return a}),h("c",tinymce.util.Tools.resolve),g("2",["c"],function(a){return a("tinymce.PluginManager")}),g("3",[],function(a){var b=function(a,b){return{clipboard:a,quirks:b}};return{get:b}}),g("l",[],function(){var a=function(a,b,c,d){return a.fire("PastePreProcess",{content:b,internal:c,wordContent:d})},b=function(a,b,c,d){return a.fire("PastePostProcess",{node:b,internal:c,wordContent:d})},c=function(a,b){return a.fire("PastePlainTextToggle",{state:b})},d=function(a,b){return a.fire("paste",{ieFake:b})};return{firePastePreProcess:a,firePastePostProcess:b,firePastePlainTextToggle:c,firePaste:d}}),g("u",[],function(){var a=function(a){return a.getParam("paste_plaintext_inform",!0)},b=function(a){return a.getParam("paste_block_drop",!1)},c=function(a){return a.getParam("paste_data_images",!1)},d=function(a){return a.getParam("paste_filter_drop",!0)},e=function(a){return a.getParam("paste_preprocess")},f=function(a){return a.getParam("paste_postprocess")},g=function(a){return a.getParam("paste_webkit_styles")},h=function(a){return a.getParam("paste_remove_styles_if_webkit",!0)},i=function(a){return a.getParam("paste_merge_formats",!0)},j=function(a){return a.getParam("smart_paste",!0)},k=function(a){return a.getParam("paste_retain_style_properties")},l=function(a){var b="-strong/b,-em/i,-u,-span,-p,-ol,-ul,-li,-h1,-h2,-h3,-h4,-h5,-h6,-p/div,-a[href|name],sub,sup,strike,br,del,table[width],tr,td[colspan|rowspan|width],th[colspan|rowspan|width],thead,tfoot,tbody";return a.getParam("paste_word_valid_elements",b)},m=function(a){return a.getParam("paste_convert_word_fake_lists",!0)},n=function(a){return a.getParam("paste_enable_default_filters",!0)};return{shouldPlainTextInform:a,shouldBlockDrop:b,shouldPasteDataImages:c,shouldFilterDrop:d,getPreProcess:e,getPostProcess:f,getWebkitStyles:g,shouldRemoveWebKitStyles:h,shouldMergeFormats:i,isSmartPasteEnabled:j,getRetainStyleProps:k,getWordValidElements:l,shouldConvertWordFakeLists:m,shouldUseDefaultFilters:n}}),g("d",["l","u"],function(a,b){var c=function(a,c){return c.get()||b.shouldPlainTextInform(a)},d=function(a,b){a.notificationManager.open({text:a.translate(b),type:"info"})},e=function(b,e,f){"text"===e.pasteFormat?(e.pasteFormat="html",a.firePastePlainTextToggle(b,!1)):(e.pasteFormat="text",a.firePastePlainTextToggle(b,!0),c(b,f)||(d(b,"Paste is now in plain text mode. Contents will now be pasted as plain text until you toggle this option off."),f.set(!0))),b.focus()};return{togglePlainTextPaste:e}}),g("4",["d"],function(a){var b=function(b,c,d){b.addCommand("mceTogglePlainTextPaste",function(){a.togglePlainTextPaste(b,c,d)}),b.addCommand("mceInsertClipboardContent",function(a,b){b.content&&c.pasteHtml(b.content,b.internal),b.text&&c.pasteText(b.text)})};return{register:b}}),h("e",Image),h("f",navigator),h("g",window),g("h",["c"],function(a){return a("tinymce.Env")}),g("i",["c"],function(a){return a("tinymce.util.Delay")}),g("j",["c"],function(a){return a("tinymce.util.Tools")}),g("k",["c"],function(a){return a("tinymce.util.VK")}),g("m",[],function(){var a="x-tinymce/html",b="<!-- "+a+" -->",c=function(a){return b+a},d=function(a){return a.replace(b,"")},e=function(a){return a.indexOf(b)!==-1};return{mark:c,unmark:d,isMarked:e,internalHtmlMime:function(){return a}}}),g("x",["c"],function(a){return a("tinymce.html.Entities")}),g("n",["j","x"],function(a,b){var c=function(a){return!/<(?:\/?(?!(?:div|p|br|span)>)\w+|(?:(?!(?:span style="white-space:\s?pre;?">)|br\s?\/>))\w+\s[^>]+)>/i.test(a)},d=function(a){return a.replace(/\r?\n/g,"<br>")},e=function(a,c){var d,e=[],f="<"+a;if("object"==typeof c){for(d in c)c.hasOwnProperty(d)&&e.push(d+'="'+b.encodeAllRaw(c[d])+'"');e.length&&(f+=" "+e.join(" "))}return f+">"},f=function(b,c,d){var f=b.split(/\n\n/),g=e(c,d),h="</"+c+">",i=a.map(f,function(a){return a.split(/\n/).join("<br />")}),j=function(a){return g+a+h};return 1===i.length?i[0]:a.map(i,j).join("")},g=function(a,b,c){return b?f(a,b,c):d(a)};return{isPlainText:c,convert:g,toBRs:d,toBlockElements:f}}),g("o",["j","h"],function(a,b){return function(c){var d,e="%MCEPASTEBIN%",f=function(){function a(a){var b,c,e,f=a.startContainer;if(b=a.getClientRects(),b.length)return b[0];if(a.collapsed&&1===f.nodeType){for(e=f.childNodes[d.startOffset];e&&3===e.nodeType&&!e.data.length;)e=e.nextSibling;if(e)return"BR"===e.tagName&&(c=h.doc.createTextNode("\ufeff"),e.parentNode.insertBefore(c,e),a=h.createRng(),a.setStartBefore(c),a.setEndAfter(c),b=a.getClientRects(),h.remove(c)),b.length?b[0]:void 0}}var f,g,h=c.dom,i=c.getBody(),j=c.dom.getViewPort(c.getWin()),k=j.y,l=20;if(d=c.selection.getRng(),c.inline&&(g=c.selection.getScrollContainer(),g&&g.scrollTop>0&&(k=g.scrollTop)),d.getClientRects){var m=a(d);if(m)l=k+(m.top-h.getPos(i).y);else{l=k;var n=d.startContainer;n&&(3===n.nodeType&&n.parentNode!==i&&(n=n.parentNode),1===n.nodeType&&(l=h.getPos(n,g||i).y))}}f=c.dom.add(c.getBody(),"div",{id:"mcepastebin",contentEditable:!0,"data-mce-bogus":"all",style:"position: absolute; top: "+l+"px; width: 10px; height: 10px; overflow: hidden; opacity: 0"},e),(b.ie||b.gecko)&&h.setStyle(f,"left","rtl"===h.getStyle(i,"direction",!0)?65535:-65535),h.bind(f,"beforedeactivate focusin focusout",function(a){a.stopPropagation()}),f.focus(),c.selection.select(f,!0)},g=function(){if(h()){for(var a;a=c.dom.get("mcepastebin");)c.dom.remove(a),c.dom.unbind(a);d&&c.selection.setRng(d)}d=null},h=function(){return c.dom.get("mcepastebin")},i=function(){var b,d,e,f,g,h=function(a,b){a.appendChild(b),c.dom.remove(b,!0)};for(d=a.grep(c.getBody().childNodes,function(a){return"mcepastebin"===a.id}),b=d.shift(),a.each(d,function(a){h(b,a)}),f=c.dom.select("div[id=mcepastebin]",b),e=f.length-1;e>=0;e--)g=c.dom.create("div"),b.insertBefore(g,f[e]),h(g,f[e]);return b?b.innerHTML:""},j=function(){return d},k=function(a){return a===e},l=function(a){return a&&"mcepastebin"===a.id},m=function(){var a=h();return l(a)&&k(a.innerHTML)};return{create:f,remove:g,getEl:h,getHtml:i,getLastRng:j,isDefault:m,isDefaultContent:k}}}),g("y",["c"],function(a){return a("tinymce.html.DomParser")}),g("z",["c"],function(a){return a("tinymce.html.Node")}),g("10",["c"],function(a){return a("tinymce.html.Schema")}),g("11",["c"],function(a){return a("tinymce.html.Serializer")}),g("r",["f","y","10","j"],function(a,b,c,d){function e(a,b){return d.each(b,function(b){a=b.constructor===RegExp?a.replace(b,""):a.replace(b[0],b[1])}),a}function f(a){function f(a){var b=a.name,c=a;if("br"===b)return void(i+="\n");if(j[b]&&(i+=" "),k[b])return void(i+=" ");if(3===a.type&&(i+=a.value),!a.shortEnded&&(a=a.firstChild))do f(a);while(a=a.next);l[b]&&c.next&&(i+="\n","p"===b&&(i+="\n"))}var g=new c,h=new b({},g),i="",j=g.getShortEndedElements(),k=d.makeMap("script noscript style textarea video audio iframe object"," "),l=g.getBlockElements();return a=e(a,[/<!\[[^\]]+\]>/g]),f(h.parse(a)),i}function g(a){function b(a,b,c){return b||c?"\xa0":" "}return a=e(a,[/^[\s\S]*<body[^>]*>\s*|\s*<\/body[^>]*>[\s\S]*$/gi,/<!--StartFragment-->|<!--EndFragment-->/g,[/( ?)<span class="Apple-converted-space">\u00a0<\/span>( ?)/g,b],/<br class="Apple-interchange-newline">/g,/<br>$/i])}function h(a){var b=0;return function(){return a+b++}}var i=function(){return a.userAgent.indexOf(" Edge/")!==-1};return{filter:e,innerText:f,trimHtml:g,createIdGenerator:h,isMsEdge:i}}),g("v",["y","z","10","11","j","u","r"],function(a,b,c,d,e,f,g){function h(a){return/<font face="Times New Roman"|class="?Mso|style="[^"]*\bmso-|style='[^'']*\bmso-|w:WordDocument/i.test(a)||/class="OutlineElement/.test(a)||/id="?docs\-internal\-guid\-/.test(a)}function i(a){var b,c;return c=[/^[IVXLMCD]{1,2}\.[ \u00a0]/,/^[ivxlmcd]{1,2}\.[ \u00a0]/,/^[a-z]{1,2}[\.\)][ \u00a0]/,/^[A-Z]{1,2}[\.\)][ \u00a0]/,/^[0-9]+\.[ \u00a0]/,/^[\u3007\u4e00\u4e8c\u4e09\u56db\u4e94\u516d\u4e03\u516b\u4e5d]+\.[ \u00a0]/,/^[\u58f1\u5f10\u53c2\u56db\u4f0d\u516d\u4e03\u516b\u4e5d\u62fe]+\.[ \u00a0]/],a=a.replace(/^[\u00a0 ]+/,""),e.each(c,function(c){if(c.test(a))return b=!0,!1}),b}function j(a){return/^[\s\u00a0]*[\u2022\u00b7\u00a7\u25CF]\s*/.test(a)}function k(a){function c(a){var b="";if(3===a.type)return a.value;if(a=a.firstChild)do b+=c(a);while(a=a.next);return b}function d(a,b){if(3===a.type&&b.test(a.value))return a.value=a.value.replace(b,""),!1;if(a=a.firstChild)do if(!d(a,b))return!1;while(a=a.next);return!0}function e(a){if(a._listIgnore)return void a.remove();if(a=a.firstChild)do e(a);while(a=a.next)}function f(a,c,f){var i=a._listLevel||k;i!==k&&(i<k?g&&(g=g.parent.parent):(h=g,g=null)),g&&g.name===c?g.append(a):(h=h||g,g=new b(c,1),f>1&&g.attr("start",""+f),a.wrap(g)),a.name="li",i>k&&h&&h.lastChild.append(g),k=i,e(a),d(a,/^\u00a0+/),d(a,/^\s*([\u2022\u00b7\u00a7\u25CF]|\w+\.)/),d(a,/^\u00a0+/)}for(var g,h,k=1,l=[],m=a.firstChild;"undefined"!=typeof m&&null!==m;)if(l.push(m),m=m.walk(),null!==m)for(;"undefined"!=typeof m&&m.parent!==a;)m=m.walk();for(var n=0;n<l.length;n++)if(a=l[n],"p"===a.name&&a.firstChild){var o=c(a);if(j(o)){f(a,"ul");continue}if(i(o)){var p=/([0-9]+)\./.exec(o),q=1;p&&(q=parseInt(p[1],10)),f(a,"ol",q);continue}if(a._listLevel){f(a,"ul",1);continue}g=null}else h=g,g=null}function l(a,c,d,g){var h,i={},j=a.dom.parseStyle(g);return e.each(j,function(b,e){switch(e){case"mso-list":h=/\w+ \w+([0-9]+)/i.exec(g),h&&(d._listLevel=parseInt(h[1],10)),/Ignore/i.test(b)&&d.firstChild&&(d._listIgnore=!0,d.firstChild._listIgnore=!0);break;case"horiz-align":e="text-align";break;case"vert-align":e="vertical-align";break;case"font-color":case"mso-foreground":e="color";break;case"mso-background":case"mso-highlight":e="background";break;case"font-weight":case"font-style":return void("normal"!==b&&(i[e]=b));case"mso-element":if(/^(comment|comment-list)$/i.test(b))return void d.remove()}return 0===e.indexOf("mso-comment")?void d.remove():void(0!==e.indexOf("mso-")&&("all"===f.getRetainStyleProps(a)||c&&c[e])&&(i[e]=b))}),/(bold)/i.test(i["font-weight"])&&(delete i["font-weight"],d.wrap(new b("b",1))),/(italic)/i.test(i["font-style"])&&(delete i["font-style"],d.wrap(new b("i",1))),i=a.dom.serializeStyle(i,d.name),i?i:null}var m=function(b,h){var i,j;i=f.getRetainStyleProps(b),i&&(j=e.makeMap(i.split(/[, ]/))),h=g.filter(h,[/<br class="?Apple-interchange-newline"?>/gi,/<b[^>]+id="?docs-internal-[^>]*>/gi,/<!--[\s\S]+?-->/gi,/<(!|script[^>]*>.*?<\/script(?=[>\s])|\/?(\?xml(:\w+)?|img|meta|link|style|\w:\w+)(?=[\s\/>]))[^>]*>/gi,[/<(\/?)s>/gi,"<$1strike>"],[/&nbsp;/gi,"\xa0"],[/<span\s+style\s*=\s*"\s*mso-spacerun\s*:\s*yes\s*;?\s*"\s*>([\s\u00a0]*)<\/span>/gi,function(a,b){return b.length>0?b.replace(/./," ").slice(Math.floor(b.length/2)).split("").join("\xa0"):""}]]);var m=f.getWordValidElements(b),n=new c({valid_elements:m,valid_children:"-li[p]"});e.each(n.elements,function(a){a.attributes["class"]||(a.attributes["class"]={},a.attributesOrder.push("class")),a.attributes.style||(a.attributes.style={},a.attributesOrder.push("style"))});var o=new a({},n);o.addAttributeFilter("style",function(a){for(var c,d=a.length;d--;)c=a[d],c.attr("style",l(b,j,c,c.attr("style"))),"span"===c.name&&c.parent&&!c.attributes.length&&c.unwrap()}),o.addAttributeFilter("class",function(a){for(var b,c,d=a.length;d--;)b=a[d],c=b.attr("class"),/^(MsoCommentReference|MsoCommentText|msoDel)$/i.test(c)&&b.remove(),b.attr("class",null)}),o.addNodeFilter("del",function(a){for(var b=a.length;b--;)a[b].remove()}),o.addNodeFilter("a",function(a){for(var b,c,d,e=a.length;e--;)if(b=a[e],c=b.attr("href"),d=b.attr("name"),c&&c.indexOf("#_msocom_")!==-1)b.remove();else if(c&&0===c.indexOf("file://")&&(c=c.split("#")[1],c&&(c="#"+c)),c||d){if(d&&!/^_?(?:toc|edn|ftn)/i.test(d)){b.unwrap();continue}b.attr({href:c,name:d})}else b.unwrap()});var p=o.parse(h);return f.shouldConvertWordFakeLists(b)&&k(p),h=new d({validate:b.settings.validate},n).serialize(p)},n=function(a,b){return f.shouldUseDefaultFilters(a)?m(a,b):b};return{preProcess:n,isWordContent:h}}),g("p",["l","v"],function(a,b){var c=function(a,b){return{content:a,cancelled:b}},d=function(b,d,e,f){var g=b.dom.create("div",{style:"display:none"},d),h=a.firePastePostProcess(b,g,e,f);return c(h.node.innerHTML,h.isDefaultPrevented())},e=function(b,e,f,g){var h=a.firePastePreProcess(b,e,f,g);return b.hasEventListeners("PastePostProcess")&&!h.isDefaultPrevented()?d(b,h.content,f,g):c(h.content,h.isDefaultPrevented())},f=function(a,c,d){var f=b.isWordContent(c),g=f?b.preProcess(a,c):c;return e(a,g,d,f)};return{process:f}}),g("q",["j","u"],function(a,b){var c=function(a){return/^https?:\/\/[\w\?\-\/+=.&%@~#]+$/i.test(a)},d=function(a){return c(a)&&/.(gif|jpe?g|png)$/.test(a)},e=function(a,b,c){return a.undoManager.extra(function(){c(a,b)},function(){a.insertContent('<img src="'+b+'">')}),!0},f=function(a,b,c){return a.undoManager.extra(function(){c(a,b)},function(){a.execCommand("mceInsertLink",!1,b)}),!0},g=function(a,b,d){return!(a.selection.isCollapsed()!==!1||!c(b))&&f(a,b,d)},h=function(a,b,c){return!!d(b)&&e(a,b,c)},i=function(a,c){return a.insertContent(c,{merge:b.shouldMergeFormats(a),paste:!0}),!0},j=function(b,c){a.each([g,h,i],function(a){return a(b,c,i)!==!0})},k=function(a,c){b.isSmartPasteEnabled(a)===!1?i(a,c):j(a,c)};return{isImageUrl:d,isAbsoluteUrl:c,insertContent:k}}),g("5",["e","f","g","h","i","j","k","l","m","n","o","p","q","r"],function(a,b,c,d,e,f,g,h,i,j,k,l,m,n){return function(o){function p(a,b){var c=b?b:i.isMarked(a),d=l.process(o,i.unmark(a),c);d.cancelled===!1&&m.insertContent(o,d.content)}function q(a){a=o.dom.encode(a).replace(/\r\n/g,"\n"),a=j.convert(a,o.settings.forced_root_block,o.settings.forced_root_block_attrs),p(a,!1)}function r(a){var b={};if(a){if(a.getData){var c=a.getData("Text");c&&c.length>0&&c.indexOf(H)===-1&&(b["text/plain"]=c)}if(a.types)for(var d=0;d<a.types.length;d++){var e=a.types[d];try{b[e]=a.getData(e)}catch(a){b[e]=""}}}return b}function s(a){var b=r(a.clipboardData||o.getDoc().dataTransfer);return n.isMsEdge()?f.extend(b,{"text/html":""}):b}function t(a){return A(a,"text/html")||A(a,"text/plain")}function u(a){var b;return b=a.indexOf(","),b!==-1?a.substr(b+1):null}function v(a,b){return!a.images_dataimg_filter||a.images_dataimg_filter(b)}function w(a){var b=a.match(/([\s\S]+?)\.(?:jpeg|jpg|png|gif)$/i);return b?o.dom.encode(b[1]):null}function x(b,c,d){b&&(o.selection.setRng(b),b=null);var e=c.result,f=u(e),g=I(),h=o.settings.images_reuse_filename&&d.name?w(d.name):g,i=new a;if(i.src=e,v(o.settings,i)){var j,k,l=o.editorUpload.blobCache;k=l.findFirst(function(a){return a.base64()===f}),k?j=k:(j=l.create(g,d,f,h),l.add(j)),p('<img src="'+j.blobUri()+'">',!1)}else p('<img src="'+e+'">',!1)}function y(a,b){function d(d){var e,f,g,h=!1;if(d)for(e=0;e<d.length;e++)if(f=d[e],/^image\/(jpeg|png|gif|bmp)$/.test(f.type)){var i=f.getAsFile?f.getAsFile():f;g=new c.FileReader,g.onload=x.bind(null,b,g,i),g.readAsDataURL(i),a.preventDefault(),h=!0}return h}var e=a.clipboardData||a.dataTransfer;if(o.settings.paste_data_images&&e)return d(e.items)||d(e.files)}function z(a){var c=a.clipboardData;return b.userAgent.indexOf("Android")!==-1&&c&&c.items&&0===c.items.length}function A(a,b){return b in a&&a[b].length>0}function B(a){return g.metaKeyPressed(a)&&86===a.keyCode||a.shiftKey&&45===a.keyCode}function C(){function a(a,b,c,d){var e,f;return A(a,"text/html")?e=a["text/html"]:(e=G.getHtml(),d=d?d:i.isMarked(e),G.isDefaultContent(e)&&(c=!0)),e=n.trimHtml(e),G.remove(),f=d===!1&&j.isPlainText(e),e.length&&!f||(c=!0),c&&(e=A(a,"text/plain")&&f?a["text/plain"]:n.innerText(e)),G.isDefaultContent(e)?void(b||o.windowManager.alert("Please use Ctrl+V/Cmd+V keyboard shortcuts to paste contents.")):void(c?q(e):p(e,d))}o.on("keydown",function(a){function c(a){B(a)&&!a.isDefaultPrevented()&&G.remove()}if(B(a)&&!a.isDefaultPrevented()){if(D=a.shiftKey&&86===a.keyCode,D&&d.webkit&&b.userAgent.indexOf("Version/")!==-1)return;if(a.stopImmediatePropagation(),F=(new Date).getTime(),d.ie&&D)return a.preventDefault(),void h.firePaste(o,!0);G.remove(),G.create(),o.once("keyup",c),o.once("paste",function(){o.off("keyup",c)})}});var c=function(){return G.getLastRng()||o.selection.getRng()};o.on("paste",function(b){var f=(new Date).getTime(),g=s(b),h=(new Date).getTime()-f,j=(new Date).getTime()-F-h<1e3,k="text"===E.pasteFormat||D,l=A(g,i.internalHtmlMime());return D=!1,b.isDefaultPrevented()||z(b)?void G.remove():!t(g)&&y(b,c())?void G.remove():(j||b.preventDefault(),!d.ie||j&&!b.ieFake||A(g,"text/html")||(G.create(),o.dom.bind(G.getEl(),"paste",function(a){a.stopPropagation()}),o.getDoc().execCommand("Paste",!1,null),g["text/html"]=G.getHtml()),void(A(g,"text/html")?(b.preventDefault(),l||(l=i.isMarked(g["text/html"])),a(g,j,k,l)):e.setEditorTimeout(o,function(){a(g,j,k,l)},0)))})}var D,E=this,F=0,G=new k(o),H="data:text/mce-internal,",I=n.createIdGenerator("mceclip");E.pasteHtml=p,E.pasteText=q,E.pasteImageData=y,E.getDataTransferItems=r,E.hasHtmlOrText=t,E.hasContentType=A,o.on("preInit",function(){C(),o.parser.addNodeFilter("img",function(a,b,c){function e(a){return a.data&&a.data.paste===!0}function f(a){a.attr("data-mce-object")||j===d.transparentSrc||a.remove()}function g(a){return 0===a.indexOf("webkit-fake-url")}function h(a){return 0===a.indexOf("data:")}if(!o.settings.paste_data_images&&e(c))for(var i=a.length;i--;){var j=a[i].attributes.map.src;j&&(g(j)?f(a[i]):!o.settings.allow_html_data_urls&&h(j)&&f(a[i]))}})})}}),h("s",setTimeout),g("6",["s","h","m","r"],function(a,b,c,d){var e=function(){},f=function(a){return b.iOS===!1&&void 0!==a&&"function"==typeof a.setData&&d.isMsEdge()!==!0},g=function(a,b,d){if(!f(a))return!1;try{return a.clearData(),a.setData("text/html",b),a.setData("text/plain",d),a.setData(c.internalHtmlMime(),b),!0}catch(a){return!1}},h=function(a,b,c,d){g(a.clipboardData,b.html,b.text)?(a.preventDefault(),d()):c(b.html,d)},i=function(b){return function(d,e){var f=c.mark(d),g=b.dom.create("div",{contenteditable:"false","data-mce-bogus":"all"}),h=b.dom.create("div",{contenteditable:"true"},f);b.dom.setStyles(g,{position:"fixed",left:"-3000px",width:"1000px",overflow:"hidden"}),g.appendChild(h),b.dom.add(b.getBody(),g);var i=b.selection.getRng();h.focus();var j=b.dom.createRng();j.selectNodeContents(h),b.selection.setRng(j),a(function(){g.parentNode.removeChild(g),b.selection.setRng(i),e()},0)}},j=function(a){return{html:a.selection.getContent({contextual:!0}),text:a.selection.getContent({format:"text"})}},k=function(b){return function(c){b.selection.isCollapsed()===!1&&h(c,j(b),i(b),function(){a(function(){b.execCommand("Delete")},0)})}},l=function(a){return function(b){a.selection.isCollapsed()===!1&&h(b,j(a),i(a),e)}},m=function(a){a.on("cut",k(a)),a.on("copy",l(a))};return{register:m}}),g("t",["c"],function(a){return a("tinymce.dom.RangeUtils")}),g("7",["t","i","u","m","r"],function(a,b,c,d,e){var f=function(b,c){return a.getCaretRangeFromPoint(c.clientX,c.clientY,b.getDoc())},g=function(a){var b=a["text/plain"];return!!b&&0===b.indexOf("file://")},h=function(a,b){a.focus(),a.selection.setRng(b)},i=function(a,i,j){c.shouldBlockDrop(a)&&a.on("dragend dragover draggesture dragdrop drop drag",function(a){a.preventDefault(),a.stopPropagation()}),c.shouldPasteDataImages(a)||a.on("drop",function(a){var b=a.dataTransfer;b&&b.files&&b.files.length>0&&a.preventDefault()}),a.on("drop",function(k){var l,m;if(m=f(a,k),!k.isDefaultPrevented()&&!j.get()){l=i.getDataTransferItems(k.dataTransfer);var n=i.hasContentType(l,d.internalHtmlMime());if((i.hasHtmlOrText(l)&&!g(l)||!i.pasteImageData(k,m))&&m&&c.shouldFilterDrop(a)){var o=l["mce-internal"]||l["text/html"]||l["text/plain"];o&&(k.preventDefault(),b.setEditorTimeout(a,function(){a.undoManager.transact(function(){l["mce-internal"]&&a.execCommand("Delete"),h(a,m),o=e.trimHtml(o),l["text/html"]?i.pasteHtml(o,n):i.pasteText(o)})}))}}}),a.on("dragstart",function(a){j.set(!0)}),a.on("dragover dragend",function(b){c.shouldPasteDataImages(a)&&j.get()===!1&&(b.preventDefault(),h(a,f(a,b))),"dragend"===b.type&&j.set(!1)})};return{setup:i}}),g("8",["u"],function(a){var b=function(b){var c=b.plugins.paste,d=a.getPreProcess(b);d&&b.on("PastePreProcess",function(a){d.call(c,c,a)});var e=a.getPostProcess(b);e&&b.on("PastePostProcess",function(a){e.call(c,c,a)})};return{setup:b}}),g("9",["h","j","u","r","v"],function(a,b,c,d,e){function f(a,b){a.on("PastePreProcess",function(c){c.content=b(a,c.content,c.internal,c.wordContent)})}function g(a,b){a.on("PastePostProcess",function(c){b(a,c.node)})}function h(a,c){if(!e.isWordContent(c))return c;var f=[];b.each(a.schema.getBlockElements(),function(a,b){f.push(b)});var g=new RegExp("(?:<br>&nbsp;[\\s\\r\\n]+|<br>)*(<\\/?("+f.join("|")+")[^>]*>)(?:<br>&nbsp;[\\s\\r\\n]+|<br>)*","g");return c=d.filter(c,[[g,"$1"]]),c=d.filter(c,[[/<br><br>/g,"<BR><BR>"],[/<br>/g," "],[/<BR><BR>/g,"<br>"]])}function i(a,b,d,e){if(e||d)return b;var f=c.getWebkitStyles(a);if(c.shouldRemoveWebKitStyles(a)===!1||"all"===f)return b;if(f&&(f=f.split(/[, ]/)),f){var g=a.dom,h=a.selection.getNode();b=b.replace(/(<[^>]+) style="([^"]*)"([^>]*>)/gi,function(a,b,c,d){var e=g.parseStyle(g.decode(c),"span"),i={};if("none"===f)return b+d;for(var j=0;j<f.length;j++){var k=e[f[j]],l=g.getStyle(h,f[j],!0);/color/.test(f[j])&&(k=g.toHex(k),l=g.toHex(l)),l!==k&&(i[f[j]]=k)}return i=g.serializeStyle(i,"span"),i?b+' style="'+i+'"'+d:b+d})}else b=b.replace(/(<[^>]+) style="([^"]*)"([^>]*>)/gi,"$1$3");return b=b.replace(/(<[^>]+) data-mce-style="([^"]+)"([^>]*>)/gi,function(a,b,c,d){return b+' style="'+c+'"'+d})}function j(a,b){a.$("a",b).find("font,u").each(function(b,c){a.dom.remove(c,!0)})}var k=function(b){a.webkit&&f(b,i),a.ie&&(f(b,h),g(b,j))};return{setup:k}}),h("12",Array),h("13",Error),g("w",["12","13"],function(a,b){var c=function(){},d=function(a,b){return function(){return a(b.apply(null,arguments))}},e=function(a){return function(){return a}},f=function(a){return a},g=function(a,b){return a===b},h=function(b){for(var c=new a(arguments.length-1),d=1;d<arguments.length;d++)c[d-1]=arguments[d];return function(){for(var d=new a(arguments.length),e=0;e<d.length;e++)d[e]=arguments[e];var f=c.concat(d);return b.apply(null,f)}},i=function(a){return function(){return!a.apply(null,arguments)}},j=function(a){return function(){throw new b(a)}},k=function(a){return a()},l=function(a){a()},m=e(!1),n=e(!0);return{noop:c,compose:d,constant:e,identity:f,tripleEquals:g,curry:h,not:i,die:j,apply:k,call:l,never:m,always:n}}),g("a",["w"],function(a){var b=function(a,b,c){var d=c.control;d.active("text"===b.pasteFormat),a.on("PastePlainTextToggle",function(a){d.active(a.state)})},c=function(c,d){var e=a.curry(b,c,d);c.addButton("pastetext",{icon:"pastetext",tooltip:"Paste as text",cmd:"mceTogglePlainTextPaste",onPostRender:e}),c.addMenuItem("pastetext",{text:"Paste as text",selectable:!0,active:d.pasteFormat,cmd:"mceTogglePlainTextPaste",onPostRender:e})};return{register:c}}),g("b",["g","2"],function(a,b){var c=function(c){return!(!/(^|[ ,])tinymcespellchecker([, ]|$)/.test(c.settings.plugins)||!b.get("tinymcespellchecker"))&&("undefined"!=typeof a.console&&a.console.log&&a.console.log("Spell Checker Pro is incompatible with Spell Checker plugin! Remove 'spellchecker' from the 'plugins' option."),!0)};return{hasProPlugin:c}}),g("0",["1","2","3","4","5","6","7","8","9","a","b"],function(a,b,c,d,e,f,g,h,i,j,k){var l=a(!1);return b.add("paste",function(b){var m=new e(b),n=i.setup(b),o=a(!1);return k.hasProPlugin(b)===!1&&(j.register(b,m),d.register(b,m,l),h.setup(b),f.register(b),g.setup(b,m,o)),c.get(m,n)}),function(){}}),d("0")()}();