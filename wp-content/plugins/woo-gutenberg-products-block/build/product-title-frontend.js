(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[79],{117:function(t,e,n){"use strict";n.d(e,"a",(function(){return r})),n(52);var c=n(36);const r=()=>c.m>1},118:function(t,e,n){"use strict";n.d(e,"a",(function(){return a}));var c=n(25),r=n(19);const a=t=>Object(c.a)(t)?JSON.parse(t)||{}:Object(r.a)(t)?t:{}},19:function(t,e,n){"use strict";n.d(e,"a",(function(){return c})),n.d(e,"b",(function(){return r}));const c=t=>!(t=>null===t)(t)&&t instanceof Object&&t.constructor===Object;function r(t,e){return c(t)&&e in t}},288:function(t,e,n){"use strict";n.d(e,"a",(function(){return s}));var c=n(63),r=n(117),a=n(19),o=n(118);const s=t=>{if(!Object(r.a)())return{className:"",style:{}};const e=Object(a.a)(t)?t:{},n=Object(o.a)(e.style);return Object(c.__experimentalUseColorProps)({...e,style:n})}},294:function(t,e,n){"use strict";n.d(e,"a",(function(){return a}));var c=n(19),r=n(118);const a=t=>{const e=Object(c.a)(t)?t:{},n=Object(r.a)(e.style),a=Object(c.a)(n.typography)?n.typography:{};return{style:{fontSize:e.fontSize?`var(--wp--preset--font-size--${e.fontSize})`:a.fontSize,lineHeight:a.lineHeight,fontWeight:a.fontWeight,fontStyle:a.fontStyle,textTransform:a.textTransform,fontFamily:e.fontFamily}}}},301:function(t,e,n){"use strict";var c=n(15),r=n.n(c),a=n(0),o=n(23),s=n(5),i=n.n(s);n(302),e.a=t=>{let{className:e="",disabled:n=!1,name:c,permalink:s="",target:l,rel:u,style:p,onClick:f,...b}=t;const d=i()("wc-block-components-product-name",e);if(n){const t=b;return Object(a.createElement)("span",r()({className:d},t,{dangerouslySetInnerHTML:{__html:Object(o.decodeEntities)(c)}}))}return Object(a.createElement)("a",r()({className:d,href:s,target:l},b,{dangerouslySetInnerHTML:{__html:Object(o.decodeEntities)(c)},style:p}))}},302:function(t,e){},323:function(t,e,n){"use strict";n.d(e,"a",(function(){return s}));var c=n(63),r=n(117),a=n(19),o=n(118);const s=t=>{if(!Object(r.a)()||"function"!=typeof c.__experimentalGetSpacingClassesAndStyles)return{style:{}};const e=Object(a.a)(t)?t:{},n=Object(o.a)(e.style);return Object(c.__experimentalGetSpacingClassesAndStyles)({...e,style:n})}},338:function(t,e,n){"use strict";n.d(e,"a",(function(){return y}));var c=n(0),r=n(5),a=n.n(r),o=n(51),s=n(117),i=n(140),l=n(301),u=n(69),p=n(288),f=n(323),b=n(294);n(339);const d=t=>{let{children:e,headingLevel:n,elementType:r="h"+n,...a}=t;return Object(c.createElement)(r,a,e)},y=t=>{const{className:e,headingLevel:n=2,showProductLink:r=!0,linkTarget:i,align:y}=t,{parentClassName:m}=Object(o.useInnerBlockLayoutContext)(),{product:j}=Object(o.useProductDataContext)(),{dispatchStoreEvent:O}=Object(u.a)(),g=Object(p.a)(t),h=Object(f.a)(t),v=Object(b.a)(t);return j.id?Object(c.createElement)(d,{headingLevel:n,className:a()(e,g.className,"wc-block-components-product-title",{[m+"__product-title"]:m,["wc-block-components-product-title--align-"+y]:y&&Object(s.a)()}),style:Object(s.a)()?{...h.style,...v.style,...g.style}:{}},Object(c.createElement)(l.a,{disabled:!r,name:j.name,permalink:j.permalink,target:i,onClick:()=>{O("product-view-link",{product:j})}})):Object(c.createElement)(d,{headingLevel:n,className:a()(e,g.className,"wc-block-components-product-title",{[m+"__product-title"]:m,["wc-block-components-product-title--align-"+y]:y&&Object(s.a)()}),style:Object(s.a)()?{...h.style,...v.style,...g.style}:{}})};e.b=Object(i.withProductDataContext)(y)},339:function(t,e){},497:function(t,e,n){"use strict";n.r(e);var c=n(140),r=n(338),a=n(117);let o={headingLevel:{type:"number",default:2},showProductLink:{type:"boolean",default:!0},linkTarget:{type:"string"},productId:{type:"number",default:0}};Object(a.a)()&&(o={...o,align:{type:"string"}});var s=o;e.default=Object(c.withFilteredAttributes)(s)(r.b)},5:function(t,e,n){var c;!function(){"use strict";var n={}.hasOwnProperty;function r(){for(var t=[],e=0;e<arguments.length;e++){var c=arguments[e];if(c){var a=typeof c;if("string"===a||"number"===a)t.push(c);else if(Array.isArray(c)){if(c.length){var o=r.apply(null,c);o&&t.push(o)}}else if("object"===a)if(c.toString===Object.prototype.toString)for(var s in c)n.call(c,s)&&c[s]&&t.push(s);else t.push(c.toString())}}return t.join(" ")}t.exports?(r.default=r,t.exports=r):void 0===(c=function(){return r}.apply(e,[]))||(t.exports=c)}()}}]);