!function(a){var n={};function r(e){if(n[e])return n[e].exports;var t=n[e]={i:e,l:!1,exports:{}};return a[e].call(t.exports,t,t.exports,r),t.l=!0,t.exports}r.m=a,r.c=n,r.d=function(e,t,a){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(r.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)r.d(a,n,function(e){return t[e]}.bind(null,n));return a},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s="./app/main.js")}({"./app/history.js":
/*!************************!*\
  !*** ./app/history.js ***!
  \************************/
/*! no static exports found */function(e,t,a){"use strict";var n,r=a(/*! jquery */"jquery");(0,((n=r)&&n.__esModule?n:{default:n}).default)(document).on("click","[data-clear-history-toggle]",function(e){e.preventDefault(),window.sessionStorage.clear(),window.location.reload()})},"./app/main.js":
/*!*********************!*\
  !*** ./app/main.js ***!
  \*********************/
/*! no static exports found */function(e,t,a){"use strict";var n,r=a(/*! jquery */"jquery"),i=(n=r)&&n.__esModule?n:{default:n};a(/*! ./utils */"./app/utils/index.js"),a(/*! ./toc */"./app/toc.js"),a(/*! ./history */"./app/history.js"),a(/*! ./search */"./app/search.js"),a(/*! ./nav */"./app/nav.js"),(0,i.default)(window).on("load",function(){for(var e in window.sessionStorage.setItem((0,i.default)("body").data("url"),"1"),window.sessionStorage)"1"===window.sessionStorage.getItem(e)&&(0,i.default)('[data-nav-id="'+e+'"]').addClass("visited");(0,i.default)(".highlightable").highlight(window.sessionStorage.getItem("search-value"),{element:"mark"})})},"./app/nav.js":
/*!********************!*\
  !*** ./app/nav.js ***!
  \********************/
/*! no static exports found */function(e,t,a){"use strict";var n,r=a(/*! jquery */"jquery"),i=(n=r)&&n.__esModule?n:{default:n};window.sessionStorage.getItem("search-value")&&((0,i.default)(document.body).removeClass("searchbox-hidden"),(0,i.default)("[data-search-input]").val(sessionStorage.getItem("search-value")).trigger("input")),(0,i.default)(document).on("click",".nav-prev, .nav-next",function(e){var t=(0,i.default)(e.currentTarget);window.location.href=t.attr("href")}),(0,i.default)(document).on("keydown",function(e){var t=37===e.which?(0,i.default)("a.nav-prev"):39===e.which?(0,i.default)("a.nav-next"):null;t&&t.click()})},"./app/search.js":
/*!***********************!*\
  !*** ./app/search.js ***!
  \***********************/
/*! no static exports found */function(e,t,a){"use strict";var n,r=a(/*! jquery */"jquery"),s=(n=r)&&n.__esModule?n:{default:n};var l=void 0;(0,s.default)(document).on("input","[data-search-input]",function(e){var t=(0,s.default)(e.currentTarget),a=t.val(),n=(0,s.default)("[data-nav-id]");n.removeClass("search-match");var r=(0,s.default)("ul.topics"),i=(0,s.default)(".highlightable");if(!a.length)return r.removeClass("searched"),n.css("display","block"),window.sessionStorage.removeItem("search-value"),void i.unhighlight({element:"mark"});window.sessionStorage.setItem("search-value",a),i.unhighlight({element:"mark"}).highlight(a,{element:"mark"}),l&&l.abort&&l.abort(),l=s.default.ajax({url:t.data("search-input")+":"+a}).done(function(e){e&&e.results&&e.results.length&&(n.css("display","none"),r.addClass("searched"),e.results.forEach(function(e){var t=(0,s.default)('[data-nav-id="'+e+'"]');t.css("display","block").addClass("search-match"),t.parents("li").css("display","block")}))})}),(0,s.default)(document).on("click","[data-search-clear]",function(){(0,s.default)("[data-search-input]").val("").trigger("input"),window.sessionStorage.removeItem("search-input"),(0,s.default)(".highlightable").unhighlight({element:"mark"})})},"./app/toc.js":
/*!********************!*\
  !*** ./app/toc.js ***!
  \********************/
/*! no static exports found */function(e,t,a){"use strict";var n,r=a(/*! jquery */"jquery"),i=(n=r)&&n.__esModule?n:{default:n};(0,i.default)(document).on("click",".toc-toggle",function(){(0,i.default)(".page-toc").toggleClass("toc-closed")})},"./app/utils/highlight.js":
/*!********************************!*\
  !*** ./app/utils/highlight.js ***!
  \********************************/
/*! no static exports found */function(e,t,a){"use strict";var n,r=a(/*! jquery */"jquery"),u=(n=r)&&n.__esModule?n:{default:n};u.default.extend({highlight:function(e,t,a,n){if(3===e.nodeType){var r=e.data.match(t);if(r){var i=document.createElement(a||"span");i.className=n||"highlight";var s=e.splitText(r.index);s.splitText(r[0].length);var l=s.cloneNode(!0);return i.appendChild(l),s.parentNode.replaceChild(i,s),1}}else if(1===e.nodeType&&e.childNodes&&!/(script|style)/i.test(e.tagName)&&(e.tagName!==a.toUpperCase()||e.className!==n))for(var o=0;o<e.childNodes.length;o++)o+=u.default.highlight(e.childNodes[o],t,a,n);return 0}}),u.default.fn.unhighlight=function(e){var t={className:"highlight",element:"span"};return u.default.extend(t,e),this.find(t.element+"."+t.className).each(function(){var e=this.parentNode;e.replaceChild(this.firstChild,this),e.normalize()}).end()},u.default.fn.highlight=function(e,t){var a={className:"highlight",element:"span",caseSensitive:!1,wordsOnly:!1};if(u.default.extend(a,t),e){if(e.constructor===String&&(e=[e]),e=u.default.grep(e,function(e){return""!==e}),0===(e=u.default.map(e,function(e){return e.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&")})).length)return this;var n=a.caseSensitive?"":"i",r="("+e.join("|")+")";a.wordsOnly&&(r="\\b"+r+"\\b");var i=new RegExp(r,n);return this.each(function(){u.default.highlight(this,i,a.element,a.className)})}}},"./app/utils/index.js":
/*!****************************!*\
  !*** ./app/utils/index.js ***!
  \****************************/
/*! no static exports found */function(e,t,a){"use strict";a(/*! ./highlight */"./app/utils/highlight.js"),a(/*! ./progress */"./app/utils/progress.js")},"./app/utils/progress.js":
/*!*******************************!*\
  !*** ./app/utils/progress.js ***!
  \*******************************/
/*! no static exports found */function(e,t,a){"use strict";var n=document.documentElement,r=document.body,i="scrollTop",s="scrollHeight",l=document.querySelector(".progress"),o=void 0;document.addEventListener("scroll",function(){o=(n[i]||r[i])/((n[s]||r[s])-n.clientHeight)*100,l.style.setProperty("--scroll",o+"%")})},jquery:
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/*! no static exports found */function(e,t){e.exports=jQuery}});