(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[73,77],{20:function(t,n,e){"use strict";e.d(n,"a",(function(){return r})),e.d(n,"b",(function(){return c}));var o=e(38);const r=t=>!Object(o.a)(t)&&t instanceof Object&&t.constructor===Object;function c(t,n){return r(t)&&n in t}},286:function(t,n,e){"use strict";e.d(n,"a",(function(){return o}));var o=function(){return o=Object.assign||function(t){for(var n,e=1,o=arguments.length;e<o;e++)for(var r in n=arguments[e])Object.prototype.hasOwnProperty.call(n,r)&&(t[r]=n[r]);return t},o.apply(this,arguments)};Object.create,Object.create},287:function(t,n,e){"use strict";function o(t){return t.toLowerCase()}e.d(n,"a",(function(){return i}));var r=[/([a-z0-9])([A-Z])/g,/([A-Z])([A-Z][a-z])/g],c=/[^A-Z0-9]+/gi;function i(t,n){void 0===n&&(n={});for(var e=n.splitRegexp,i=void 0===e?r:e,a=n.stripRegexp,s=void 0===a?c:a,u=n.transform,d=void 0===u?o:u,f=n.delimiter,v=void 0===f?" ":f,b=l(l(t,i,"$1\0$2"),s,"\0"),g=0,y=b.length;"\0"===b.charAt(g);)g++;for(;"\0"===b.charAt(y-1);)y--;return b.slice(g,y).split("\0").map(d).join(v)}function l(t,n,e){return n instanceof RegExp?t.replace(n,e):n.reduce((function(t,n){return t.replace(n,e)}),t)}},29:function(t,n,e){"use strict";e.d(n,"a",(function(){return o}));const o=t=>"string"==typeof t},290:function(t,n,e){"use strict";e.d(n,"a",(function(){return c}));var o=e(286),r=e(287);function c(t,n){return void 0===n&&(n={}),function(t,n){return void 0===n&&(n={}),Object(r.a)(t,Object(o.a)({delimiter:"."},n))}(t,Object(o.a)({delimiter:"-"},n))}},291:function(t,n,e){"use strict";e.d(n,"a",(function(){return d}));var o=e(4),r=e.n(o),c=e(20),i=e(29),l=e(290),a=e(132);function s(t={}){const n={};return Object(a.getCSSRules)(t,{selector:""}).forEach((t=>{n[t.key]=t.value})),n}function u(t,n){return t&&n?`has-${Object(l.a)(n)}-${t}`:""}const d=t=>{const n=(t=>{const n=Object(c.a)(t)?t:{style:{}};let e=n.style;return Object(i.a)(e)&&(e=JSON.parse(e)||{}),Object(c.a)(e)||(e={}),{...n,style:e}})(t),e=function(t){var n,e,o,i,l,a,d;const{backgroundColor:f,textColor:v,gradient:b,style:g}=t,y=u("background-color",f),p=u("color",v),m=function(t){if(t)return`has-${t}-gradient-background`}(b),O=m||(null==g||null===(n=g.color)||void 0===n?void 0:n.gradient);return{className:r()(p,m,{[y]:!O&&!!y,"has-text-color":v||(null==g||null===(e=g.color)||void 0===e?void 0:e.text),"has-background":f||(null==g||null===(o=g.color)||void 0===o?void 0:o.background)||b||(null==g||null===(i=g.color)||void 0===i?void 0:i.gradient),"has-link-color":Object(c.a)(null==g||null===(l=g.elements)||void 0===l?void 0:l.link)?null==g||null===(a=g.elements)||void 0===a||null===(d=a.link)||void 0===d?void 0:d.color:void 0}),style:s({color:(null==g?void 0:g.color)||{}})}}(n),o=function(t){var n;const e=(null===(n=t.style)||void 0===n?void 0:n.border)||{};return{className:function(t){var n;const{borderColor:e,style:o}=t,c=e?u("border-color",e):"";return r()({"has-border-color":!!e||!(null==o||null===(n=o.border)||void 0===n||!n.color),[c]:!!c})}(t),style:s({border:e})}}(n),l=function(t){var n;return{className:void 0,style:s({spacing:(null===(n=t.style)||void 0===n?void 0:n.spacing)||{}})}}(n),a=(t=>{const n=Object(c.a)(t.style.typography)?t.style.typography:{},e=Object(i.a)(n.fontFamily)?n.fontFamily:"";return{className:t.fontFamily?`has-${t.fontFamily}-font-family`:e,style:{fontSize:t.fontSize?`var(--wp--preset--font-size--${t.fontSize})`:n.fontSize,fontStyle:n.fontStyle,fontWeight:n.fontWeight,letterSpacing:n.letterSpacing,lineHeight:n.lineHeight,textDecoration:n.textDecoration,textTransform:n.textTransform}}})(n);return{className:r()(a.className,e.className,o.className,l.className),style:{...a.style,...e.style,...o.style,...l.style}}}},38:function(t,n,e){"use strict";e.d(n,"a",(function(){return o}));const o=t=>null===t},467:function(t,n,e){"use strict";e.r(n),e.d(n,"Block",(function(){return u}));var o=e(0),r=e(4),c=e.n(r),i=e(60),l=e(291),a=e(1),s=e(145);const u=t=>{const{textAlign:n}=t,e=Object(l.a)(t),{product:r}=Object(i.useProductDataContext)(),s=c()(e.className,"wc-block-components-product-average-rating",{[`has-text-align-${n}`]:n});return Object(o.createElement)("div",{className:s,style:e.style},Number(r.average_rating)>0?r.average_rating:Object(a.__)("No ratings","woo-gutenberg-products-block"))};n.default=Object(s.withProductDataContext)(u)}}]);