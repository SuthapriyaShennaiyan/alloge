(()=>{"use strict";var t={4232:t=>{t.exports=jQuery}},e={};function r(i){var n=e[i];if(void 0!==n)return n.exports;var o=e[i]={exports:{}};return t[i](o,o.exports,r),o.exports}r.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return r.d(e,{a:e}),e},r.d=(t,e)=>{for(var i in e)r.o(e,i)&&!r.o(t,i)&&Object.defineProperty(t,i,{enumerable:!0,get:e[i]})},r.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{var t=r(4232),e=r.n(t);document.addEventListener("DOMContentLoaded",(function(){i.init()}));const i={isInit:!1,init:function(){this.holder=document.querySelectorAll(".qi-block-tabs-vertical"),this.holder.length&&[...this.holder].map((t=>{i.initItem(t)}))},getRealCurrentItem:function(t){return"string"==typeof t&&""!==t&&(t=qiBlocksEditor.qodefGetCurrentBlockElement.get(t)),t},initItem:function(t,r){if(!(t=i.getRealCurrentItem(t)))return;const n=t.querySelectorAll(".qodef-tabs-vertical-content");n.length&&n.forEach(((e,r)=>{r+=1;let i=e.getAttribute("id"),n=t.querySelector(".qodef-tabs-vertical-navigation li:nth-child("+r+") a"),o=n.getAttribute("href");i="#"+i,i.indexOf(o)>-1&&n.setAttribute("href",i)})),t.classList.contains("qodef--init")?r&&i.isInit&&(i.isInit.tabs("destroy"),i.isInit=e()(t).tabs()):(t.classList.add("qodef--init"),i.isInit=e()(t).tabs())}}})()})();