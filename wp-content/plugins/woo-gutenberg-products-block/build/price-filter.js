this.wc=this.wc||{},this.wc.blocks=this.wc.blocks||{},this.wc.blocks["price-filter"]=function(e){function t(t){for(var c,i,l=t[0],a=t[1],s=t[2],b=0,p=[];b<l.length;b++)i=l[b],Object.prototype.hasOwnProperty.call(r,i)&&r[i]&&p.push(r[i][0]),r[i]=0;for(c in a)Object.prototype.hasOwnProperty.call(a,c)&&(e[c]=a[c]);for(u&&u(t);p.length;)p.shift()();return o.push.apply(o,s||[]),n()}function n(){for(var e,t=0;t<o.length;t++){for(var n=o[t],c=!0,l=1;l<n.length;l++){var a=n[l];0!==r[a]&&(c=!1)}c&&(o.splice(t--,1),e=i(i.s=n[0]))}return e}var c={},r={27:0},o=[];function i(t){if(c[t])return c[t].exports;var n=c[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,i),n.l=!0,n.exports}i.m=e,i.c=c,i.d=function(e,t,n){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(i.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var c in e)i.d(n,c,function(t){return e[t]}.bind(null,c));return n},i.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="";var l=window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[],a=l.push.bind(l);l.push=t,l=l.slice();for(var s=0;s<l.length;s++)t(l[s]);var u=a;return o.push([364,0]),n()}({0:function(e,t){e.exports=window.wp.element},1:function(e,t){e.exports=window.wp.i18n},106:function(e,t,n){"use strict";var c=n(0),r=(n(10),n(7)),o=n(9),i=n(1);n(143),t.a=Object(o.withInstanceId)(e=>{let{className:t,headingLevel:n,onChange:o,heading:l,instanceId:a}=e;const s="h"+n;return Object(c.createElement)(s,{className:t},Object(c.createElement)("label",{className:"screen-reader-text",htmlFor:"block-title-"+a},Object(i.__)("Block title","woo-gutenberg-products-block")),Object(c.createElement)(r.PlainText,{id:"block-title-"+a,className:"wc-block-editor-components-title",value:l,onChange:o}))})},108:function(e,t,n){"use strict";n.d(t,"a",(function(){return r}));var c=n(8);function r(e,t){const n=Object(c.useRef)();return Object(c.useEffect)(()=>{n.current===e||t&&!t(e,n.current)||(n.current=e)},[e,t]),n.current}},113:function(e,t,n){"use strict";n.d(t,"a",(function(){return a}));var c=n(16),r=n(13),o=n(0),i=n(40),l=n(93);const a=e=>{const{namespace:t,resourceName:n,resourceValues:a=[],query:s={},shouldSelect:u=!0}=e;if(!t||!n)throw new Error("The options object must have valid values for the namespace and the resource properties.");const b=Object(o.useRef)({results:[],isLoading:!0}),p=Object(i.a)(s),d=Object(i.a)(a),m=Object(l.a)(),g=Object(r.useSelect)(e=>{if(!u)return null;const r=e(c.COLLECTIONS_STORE_KEY),o=[t,n,p,d],i=r.getCollectionError(...o);return i&&m(i),{results:r.getCollection(...o),isLoading:!r.hasFinishedResolution("getCollection",o)}},[t,n,d,p,u]);return null!==g&&(b.current=g),b.current}},12:function(e,t){e.exports=window.wp.blocks},120:function(e,t,n){"use strict";var c=n(0),r=n(18);const o=Object(c.createElement)(r.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)("mask",{id:"external-mask",width:"24",height:"24",x:"0",y:"0",maskUnits:"userSpaceOnUse"},Object(c.createElement)("path",{fill:"#fff",d:"M6.3431 6.3431v1.994l7.8984.0072-8.6055 8.6054 1.4142 1.4143 8.6055-8.6055.0071 7.8984h1.994V6.3431H6.3431z"})),Object(c.createElement)("g",{mask:"url(#external-mask)"},Object(c.createElement)("path",{d:"M0 0h24v24H0z"})));t.a=o},13:function(e,t){e.exports=window.wp.data},133:function(e,t,n){"use strict";var c=n(0),r=n(1),o=(n(10),n(4)),i=n.n(o),l=n(30);n(169);const a=e=>{let{className:t,disabled:n,label:
/* translators: Submit button text for filters. */
o=Object(r.__)("Go","woo-gutenberg-products-block"),onClick:a,screenReaderLabel:s=Object(r.__)("Apply filter","woo-gutenberg-products-block")}=e;return Object(c.createElement)("button",{type:"submit",className:i()("wc-block-filter-submit-button","wc-block-components-filter-submit-button",t),disabled:n,onClick:a},Object(c.createElement)(l.a,{label:o,screenReaderLabel:s}))};a.defaultProps={disabled:!1},t.a=a},138:function(e,t){},143:function(e,t){},16:function(e,t){e.exports=window.wc.wcBlocksData},169:function(e,t){},18:function(e,t){e.exports=window.wp.primitives},2:function(e,t){e.exports=window.wc.wcSettings},205:function(e,t,n){"use strict";var c=n(0),r=n(18);const o=Object(c.createElement)(r.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24"},Object(c.createElement)("path",{fill:"none",d:"M0 0h24v24H0V0z"}),Object(c.createElement)("path",{d:"M11 17h2v-1h1c.55 0 1-.45 1-1v-3c0-.55-.45-1-1-1h-3v-1h4V8h-2V7h-2v1h-1c-.55 0-1 .45-1 1v3c0 .55.45 1 1 1h3v1H9v2h2v1zm9-13H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4V6h16v12z"}));t.a=o},25:function(e,t){e.exports=window.wp.isShallowEqual},26:function(e,t,n){"use strict";n.d(t,"o",(function(){return o})),n.d(t,"m",(function(){return i})),n.d(t,"l",(function(){return l})),n.d(t,"n",(function(){return a})),n.d(t,"j",(function(){return s})),n.d(t,"e",(function(){return u})),n.d(t,"f",(function(){return b})),n.d(t,"g",(function(){return p})),n.d(t,"k",(function(){return d})),n.d(t,"c",(function(){return m})),n.d(t,"d",(function(){return g})),n.d(t,"h",(function(){return O})),n.d(t,"a",(function(){return f})),n.d(t,"i",(function(){return h})),n.d(t,"b",(function(){return w}));var c,r=n(2);const o=Object(r.getSetting)("wcBlocksConfig",{buildPhase:1,pluginUrl:"",productCount:0,defaultAvatar:"",restApiRoutes:{},wordCountType:"words"}),i=o.pluginUrl+"images/",l=o.pluginUrl+"build/",a=o.buildPhase,s=null===(c=r.STORE_PAGES.shop)||void 0===c?void 0:c.permalink,u=r.STORE_PAGES.checkout.id,b=r.STORE_PAGES.checkout.permalink,p=r.STORE_PAGES.privacy.permalink,d=(r.STORE_PAGES.privacy.title,r.STORE_PAGES.terms.permalink),m=(r.STORE_PAGES.terms.title,r.STORE_PAGES.cart.id),g=r.STORE_PAGES.cart.permalink,O=(r.STORE_PAGES.myaccount.permalink?r.STORE_PAGES.myaccount.permalink:Object(r.getSetting)("wpLoginUrl","/wp-login.php"),Object(r.getSetting)("shippingCountries",{})),f=Object(r.getSetting)("allowedCountries",{}),h=Object(r.getSetting)("shippingStates",{}),w=Object(r.getSetting)("allowedStates",{})},267:function(e,t,n){"use strict";n.d(t,"a",(function(){return u}));var c=n(0),r=n(243),o=n(6),i=n(40),l=n(71),a=n(113),s=n(48);const u=e=>{let{queryAttribute:t,queryPrices:n,queryStock:u,queryState:b}=e,p=Object(s.a)();p+="-collection-data";const[d]=Object(l.a)(p),[m,g]=Object(l.b)("calculate_attribute_counts",[],p),[O,f]=Object(l.b)("calculate_price_range",null,p),[h,w]=Object(l.b)("calculate_stock_status_counts",null,p),j=Object(i.a)(t||{}),_=Object(i.a)(n),v=Object(i.a)(u);Object(c.useEffect)(()=>{"object"==typeof j&&Object.keys(j).length&&(m.find(e=>e.taxonomy===j.taxonomy)||g([...m,j]))},[j,m,g]),Object(c.useEffect)(()=>{O!==_&&void 0!==_&&f(_)},[_,f,O]),Object(c.useEffect)(()=>{h!==v&&void 0!==v&&w(v)},[v,w,h]);const[k,E]=Object(c.useState)(!1),[y]=Object(r.a)(k,200);k||E(!0);const x=Object(c.useMemo)(()=>(e=>{const t=e;return e.calculate_attribute_counts&&(t.calculate_attribute_counts=Object(o.sortBy)(e.calculate_attribute_counts.map(e=>{let{taxonomy:t,queryType:n}=e;return{taxonomy:t,query_type:n}}),["taxonomy","query_type"])),t})(d),[d]);return Object(a.a)({namespace:"/wc/store",resourceName:"products/collection-data",query:{...b,page:void 0,per_page:void 0,orderby:void 0,order:void 0,...x},shouldSelect:y})}},3:function(e,t){e.exports=window.wp.components},30:function(e,t,n){"use strict";var c=n(0),r=n(4),o=n.n(r);t.a=e=>{let t,{label:n,screenReaderLabel:r,wrapperElement:i,wrapperProps:l={}}=e;const a=null!=n,s=null!=r;return!a&&s?(t=i||"span",l={...l,className:o()(l.className,"screen-reader-text")},Object(c.createElement)(t,l,r)):(t=i||c.Fragment,a&&s&&n!==r?Object(c.createElement)(t,l,Object(c.createElement)("span",{"aria-hidden":"true"},n),Object(c.createElement)("span",{className:"screen-reader-text"},r)):Object(c.createElement)(t,l,n))}},35:function(e,t){e.exports=window.wc.priceFormat},364:function(e,t,n){e.exports=n(440)},365:function(e,t){},366:function(e,t){},40:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var c=n(0),r=n(25),o=n.n(r);function i(e){const t=Object(c.useRef)(e);return o()(e,t.current)||(t.current=e),t.current}},41:function(e,t,n){"use strict";var c=n(5),r=n.n(c),o=n(0),i=n(132),l=n(4),a=n.n(l);n(138);const s=e=>({thousandSeparator:e.thousandSeparator,decimalSeparator:e.decimalSeparator,decimalScale:e.minorUnit,fixedDecimalScale:!0,prefix:e.prefix,suffix:e.suffix,isNumericString:!0});t.a=e=>{let{className:t,value:n,currency:c,onValueChange:l,displayType:u="text",...b}=e;const p="string"==typeof n?parseInt(n,10):n;if(!Number.isFinite(p))return null;const d=p/10**c.minorUnit;if(!Number.isFinite(d))return null;const m=a()("wc-block-formatted-money-amount","wc-block-components-formatted-money-amount",t),g={...b,...s(c),value:void 0,currency:void 0,onValueChange:void 0},O=l?e=>{const t=+e.value*10**c.minorUnit;l(t)}:()=>{};return Object(o.createElement)(i.a,r()({className:m,displayType:u},g,{value:d,onValueChange:O}))}},43:function(e,t,n){"use strict";var c=n(0);t.a=function(e){let{srcElement:t,size:n=24,...r}=e;return Object(c.isValidElement)(t)?Object(c.cloneElement)(t,{width:n,height:n,...r}):null}},440:function(e,t,n){"use strict";n.r(t);var c=n(5),r=n.n(c),o=n(0),i=n(1),l=n(12),a=n(4),s=n.n(a),u=n(43),b=n(205),p=n(7),d=n(3),m=n(2),g=n(26),O=n(89),f=n(106),h=n(55),w=n(120),j=n(108),_=n(71),v=n(267),k=n(41),E=n(85);n(366);const y=function(e,t,n){let c=arguments.length>3&&void 0!==arguments[3]?arguments[3]:1,r=arguments.length>4&&void 0!==arguments[4]&&arguments[4],[o,i]=e;const l=e=>Number.isFinite(e);return l(o)||(o=t||0),l(i)||(i=n||c),l(t)&&t>o&&(o=t),l(n)&&n<=o&&(o=n-c),l(t)&&t>=i&&(i=t+c),l(n)&&n<i&&(i=n),!r&&o>=i&&(o=i-c),r&&i<=o&&(i=o+c),[o,i]};var x=n(133),S=e=>{let{minPrice:t,maxPrice:n,minConstraint:c,maxConstraint:r,onChange:l=(()=>{}),step:a,currency:u,showInputFields:b=!0,showFilterButton:p=!1,isLoading:d=!1,onSubmit:m=(()=>{})}=e;const g=Object(o.useRef)(null),O=Object(o.useRef)(null),f=a||10*10**u.minorUnit,[h,w]=Object(o.useState)(t),[j,_]=Object(o.useState)(n);Object(o.useEffect)(()=>{w(t)},[t]),Object(o.useEffect)(()=>{_(n)},[n]);const v=Object(o.useMemo)(()=>isFinite(c)&&isFinite(r),[c,r]),S=Object(o.useMemo)(()=>isFinite(t)&&isFinite(n)&&v?{"--low":Math.round((t-c)/(r-c)*100)-.5+"%","--high":Math.round((n-c)/(r-c)*100)+.5+"%"}:{"--low":"0%","--high":"100%"},[t,n,c,r,v]),C=Object(o.useCallback)(e=>{if(d||!v||!g.current||!O.current)return;const t=e.target.getBoundingClientRect(),n=e.clientX-t.left,c=g.current.offsetWidth,o=+g.current.value,i=O.current.offsetWidth,l=+O.current.value,a=c*(o/r),s=i*(l/r);Math.abs(n-a)>Math.abs(n-s)?(g.current.style.zIndex="20",O.current.style.zIndex="21"):(g.current.style.zIndex="21",O.current.style.zIndex="20")},[d,r,v]),N=Object(o.useCallback)(e=>{const o=e.target.classList.contains("wc-block-price-filter__range-input--min"),i=+e.target.value,a=o?[Math.round(i/f)*f,n]:[t,Math.round(i/f)*f],s=y(a,c,r,f,o);l(s)},[l,t,n,c,r,f]),F=Object(o.useCallback)(e=>{if(e.relatedTarget&&e.relatedTarget.classList&&e.relatedTarget.classList.contains("wc-block-price-filter__amount"))return;const t=e.target.classList.contains("wc-block-price-filter__amount--min"),n=y([h,j],null,null,f,t);l(n)},[l,f,h,j]),P=s()("wc-block-price-filter","wc-block-components-price-slider",b&&"wc-block-price-filter--has-input-fields",b&&"wc-block-components-price-slider--has-input-fields",p&&"wc-block-price-filter--has-filter-button",p&&"wc-block-components-price-slider--has-filter-button",d&&"is-loading",!v&&"is-disabled"),T=Object(E.b)(g.current)?g.current.ownerDocument.activeElement:void 0,R=T&&T===g.current?f:1,V=T&&T===O.current?f:1,L=String(h/10**u.minorUnit),B=String(j/10**u.minorUnit);return Object(o.createElement)("div",{className:P},Object(o.createElement)("div",{className:"wc-block-price-filter__range-input-wrapper wc-block-components-price-slider__range-input-wrapper",onMouseMove:C,onFocus:C},v&&Object(o.createElement)("div",{"aria-hidden":b},Object(o.createElement)("div",{className:"wc-block-price-filter__range-input-progress wc-block-components-price-slider__range-input-progress",style:S}),Object(o.createElement)("input",{type:"range",className:"wc-block-price-filter__range-input wc-block-price-filter__range-input--min wc-block-components-price-slider__range-input wc-block-components-price-slider__range-input--min","aria-label":Object(i.__)("Filter products by minimum price","woo-gutenberg-products-block"),"aria-valuetext":L,value:Number.isFinite(t)?t:c,onChange:N,step:R,min:c,max:r,ref:g,disabled:d,tabIndex:b?-1:0}),Object(o.createElement)("input",{type:"range",className:"wc-block-price-filter__range-input wc-block-price-filter__range-input--max wc-block-components-price-slider__range-input wc-block-components-price-slider__range-input--max","aria-label":Object(i.__)("Filter products by maximum price","woo-gutenberg-products-block"),"aria-valuetext":B,value:Number.isFinite(n)?n:r,onChange:N,step:V,min:c,max:r,ref:O,disabled:d,tabIndex:b?-1:0}))),Object(o.createElement)("div",{className:"wc-block-price-filter__controls wc-block-components-price-slider__controls"},b&&Object(o.createElement)(o.Fragment,null,Object(o.createElement)(k.a,{currency:u,displayType:"input",className:"wc-block-price-filter__amount wc-block-price-filter__amount--min wc-block-form-text-input wc-block-components-price-slider__amount wc-block-components-price-slider__amount--min","aria-label":Object(i.__)("Filter products by minimum price","woo-gutenberg-products-block"),onValueChange:e=>{e!==h&&w(e)},onBlur:F,disabled:d||!v,value:h}),Object(o.createElement)(k.a,{currency:u,displayType:"input",className:"wc-block-price-filter__amount wc-block-price-filter__amount--max wc-block-form-text-input wc-block-components-price-slider__amount wc-block-components-price-slider__amount--max","aria-label":Object(i.__)("Filter products by maximum price","woo-gutenberg-products-block"),onValueChange:e=>{e!==j&&_(e)},onBlur:F,disabled:d||!v,value:j})),!b&&!d&&Number.isFinite(t)&&Number.isFinite(n)&&Object(o.createElement)("div",{className:"wc-block-price-filter__range-text wc-block-components-price-slider__range-text"},Object(i.__)("Price","woo-gutenberg-products-block"),":  ",Object(o.createElement)(k.a,{currency:u,value:t})," – ",Object(o.createElement)(k.a,{currency:u,value:n})),p&&Object(o.createElement)(x.a,{className:"wc-block-price-filter__button wc-block-components-price-slider__button",disabled:d||!v,onClick:m,screenReaderLabel:Object(i.__)("Apply price filter","woo-gutenberg-products-block")})))},C=n(116),N=(n(10),n(35));const F=(e,t,n)=>{const c=10*10**t;let r;"ROUND_UP"===n?r=isNaN(e)?null:Math.ceil(parseFloat(e,10)/c)*c:"ROUND_DOWN"===n&&(r=isNaN(e)?null:Math.floor(parseFloat(e,10)/c)*c);const o=Object(j.a)(r,Number.isFinite);return Number.isFinite(r)?r:o};var P=e=>{let{attributes:t,isEditor:n=!1}=e;const[c,r]=Object(_.b)("min_price",null),[i,l]=Object(_.b)("max_price",null),[a]=Object(_.a)(),{results:s,isLoading:u}=Object(v.a)({queryPrices:!0,queryState:a}),[b,p]=Object(o.useState)(),[d,m]=Object(o.useState)(),g=Object(N.getCurrencyFromPriceResponse)(s.price_range),{minConstraint:O,maxConstraint:f}=(e=>{let{minPrice:t,maxPrice:n,minorUnit:c}=e;return{minConstraint:F(t,c,"ROUND_DOWN"),maxConstraint:F(n,c,"ROUND_UP")}})({minPrice:s.price_range?s.price_range.min_price:void 0,maxPrice:s.price_range?s.price_range.max_price:void 0,minorUnit:g.minorUnit}),h=Object(o.useCallback)((e,t)=>{r(e===O?void 0:e),l(t===f?void 0:t)},[O,f,r,l]),w=Object(C.a)(h,500),k=Object(o.useCallback)(e=>{e[0]!==b&&p(e[0]),e[1]!==d&&m(e[1])},[b,d,p,m]);Object(o.useEffect)(()=>{t.showFilterButton||w(b,d)},[b,d,t.showFilterButton,w]);const E=Object(j.a)(c),y=Object(j.a)(i),x=Object(j.a)(O),P=Object(j.a)(f);if(Object(o.useEffect)(()=>{(!Number.isFinite(b)||c!==E&&c!==b||O!==x&&O!==b)&&p(Number.isFinite(c)?c:O),(!Number.isFinite(d)||i!==y&&i!==d||f!==P&&f!==d)&&m(Number.isFinite(i)?i:f)},[b,d,c,i,O,f,x,P,E,y]),!u&&(null===O||null===f||O===f))return null;const T="h"+t.headingLevel;return Object(o.createElement)(o.Fragment,null,!n&&t.heading&&Object(o.createElement)(T,{className:"wc-block-price-filter__title"},t.heading),Object(o.createElement)("div",{className:"wc-block-price-slider"},Object(o.createElement)(S,{minConstraint:O,maxConstraint:f,minPrice:b,maxPrice:d,currency:g,showInputFields:t.showInputFields,showFilterButton:t.showFilterButton,onChange:k,onSubmit:()=>h(b,d),isLoading:u})))};n(365),Object(l.registerBlockType)("woocommerce/price-filter",{title:Object(i.__)("Filter Products by Price","woo-gutenberg-products-block"),icon:{src:Object(o.createElement)(u.a,{srcElement:b.a,className:"wc-block-editor-components-block-icon"})},category:"woocommerce",keywords:[Object(i.__)("WooCommerce","woo-gutenberg-products-block")],description:Object(i.__)("Allow customers to filter the products by choosing a lower or upper price limit. Works in combination with the All Products block.","woo-gutenberg-products-block"),supports:{html:!1,multiple:!1},example:{},attributes:{showInputFields:{type:"boolean",default:!0},showFilterButton:{type:"boolean",default:!1},heading:{type:"string",default:Object(i.__)("Filter by price","woo-gutenberg-products-block")},headingLevel:{type:"number",default:3}},edit:function(e){let{attributes:t,setAttributes:n}=e;const{className:c,heading:r,headingLevel:l,showInputFields:a,showFilterButton:s}=t;return Object(o.createElement)(o.Fragment,null,0===g.o.productCount?Object(o.createElement)(d.Placeholder,{className:"wc-block-price-slider",icon:Object(o.createElement)(u.a,{srcElement:b.a}),label:Object(i.__)("Filter Products by Price","woo-gutenberg-products-block"),instructions:Object(i.__)("Display a slider to filter products in your store by price.","woo-gutenberg-products-block")},Object(o.createElement)("p",null,Object(i.__)("Products with prices are needed for filtering by price. You haven't created any products yet.","woo-gutenberg-products-block")),Object(o.createElement)(d.Button,{className:"wc-block-price-slider__add-product-button",isSecondary:!0,href:Object(m.getAdminLink)("post-new.php?post_type=product")},Object(i.__)("Add new product","woo-gutenberg-products-block")+" ",Object(o.createElement)(u.a,{srcElement:w.a})),Object(o.createElement)(d.Button,{className:"wc-block-price-slider__read_more_button",isTertiary:!0,href:"https://docs.woocommerce.com/document/managing-products/"},Object(i.__)("Learn more","woo-gutenberg-products-block"))):Object(o.createElement)("div",{className:c},Object(o.createElement)(p.InspectorControls,{key:"inspector"},Object(o.createElement)(d.PanelBody,{title:Object(i.__)("Block Settings","woo-gutenberg-products-block")},Object(o.createElement)(h.a,{label:Object(i.__)("Price Range","woo-gutenberg-products-block"),value:a?"editable":"text",options:[{label:Object(i.__)("Editable","woo-gutenberg-products-block"),value:"editable"},{label:Object(i.__)("Text","woo-gutenberg-products-block"),value:"text"}],onChange:e=>n({showInputFields:"editable"===e})}),Object(o.createElement)(d.ToggleControl,{label:Object(i.__)("Filter button","woo-gutenberg-products-block"),help:s?Object(i.__)("Products will only update when the button is pressed.","woo-gutenberg-products-block"):Object(i.__)("Products will update when the slider is moved.","woo-gutenberg-products-block"),checked:s,onChange:()=>n({showFilterButton:!s})}),Object(o.createElement)("p",null,Object(i.__)("Heading Level","woo-gutenberg-products-block")),Object(o.createElement)(O.a,{isCollapsed:!1,minLevel:2,maxLevel:7,selectedLevel:l,onChange:e=>n({headingLevel:e})}))),Object(o.createElement)(f.a,{className:"wc-block-price-filter__title",headingLevel:l,heading:r,onChange:e=>n({heading:e})}),Object(o.createElement)(d.Disabled,null,Object(o.createElement)(P,{attributes:t,isEditor:!0}))))},save(e){let{attributes:t}=e;const{className:n,showInputFields:c,showFilterButton:i,heading:l,headingLevel:a}=t,u={"data-showinputfields":c,"data-showfilterbutton":i,"data-heading":l,"data-heading-level":a};return Object(o.createElement)("div",r()({className:s()("is-loading",n)},u),Object(o.createElement)("span",{"aria-hidden":!0,className:"wc-block-product-categories__placeholder"}))}})},48:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var c=n(0);const r=Object(c.createContext)("page"),o=()=>Object(c.useContext)(r);r.Provider},55:function(e,t,n){"use strict";var c=n(5),r=n.n(c),o=n(0),i=n(6),l=n(4),a=n.n(l),s=n(3),u=n(9);n(82);class b extends o.Component{constructor(){super(...arguments),this.onClick=this.onClick.bind(this)}onClick(e){this.props.onChange&&this.props.onChange(e.target.value)}render(){const{label:e,checked:t,instanceId:n,className:c,help:l,options:u,value:b}=this.props,p="inspector-toggle-button-control-"+n;let d;return l&&(d=Object(i.isFunction)(l)?l(t):l),Object(o.createElement)(s.BaseControl,{id:p,help:d,className:a()("components-toggle-button-control",c)},Object(o.createElement)("label",{id:p+"__label",htmlFor:p,className:"components-toggle-button-control__label"},e),Object(o.createElement)(s.ButtonGroup,{"aria-labelledby":p+"__label"},u.map((t,n)=>{const c={};return b===t.value?(c.isPrimary=!0,c["aria-pressed"]=!0):(c.isSecondary=!0,c["aria-pressed"]=!1),Object(o.createElement)(s.Button,r()({key:`${t.label}-${t.value}-${n}`,value:t.value,onClick:this.onClick,"aria-label":e+": "+t.label},c),t.label)})))}}t.a=Object(u.withInstanceId)(b)},6:function(e,t){e.exports=window.lodash},7:function(e,t){e.exports=window.wp.blockEditor},71:function(e,t,n){"use strict";n.d(t,"a",(function(){return b})),n.d(t,"b",(function(){return p})),n.d(t,"c",(function(){return d}));var c=n(16),r=n(13),o=n(0),i=n(25),l=n.n(i),a=n(40),s=n(108),u=n(48);const b=e=>{const t=Object(u.a)();e=e||t;const n=Object(r.useSelect)(t=>t(c.QUERY_STATE_STORE_KEY).getValueForQueryContext(e,void 0),[e]),{setValueForQueryContext:i}=Object(r.useDispatch)(c.QUERY_STATE_STORE_KEY);return[n,Object(o.useCallback)(t=>{i(e,t)},[e,i])]},p=(e,t,n)=>{const i=Object(u.a)();n=n||i;const l=Object(r.useSelect)(r=>r(c.QUERY_STATE_STORE_KEY).getValueForQueryKey(n,e,t),[n,e]),{setQueryValue:a}=Object(r.useDispatch)(c.QUERY_STATE_STORE_KEY);return[l,Object(o.useCallback)(t=>{a(n,e,t)},[n,e,a])]},d=(e,t)=>{const n=Object(u.a)();t=t||n;const[c,r]=b(t),i=Object(a.a)(c),p=Object(a.a)(e),d=Object(s.a)(p),m=Object(o.useRef)(!1);return Object(o.useEffect)(()=>{l()(d,p)||(r(Object.assign({},i,p)),m.current=!0)},[i,p,d,r]),m.current?[c,r]:[e,r]}},8:function(e,t){e.exports=window.React},82:function(e,t){},85:function(e,t,n){"use strict";n.d(t,"a",(function(){return c})),n.d(t,"c",(function(){return r})),n.d(t,"b",(function(){return o})),n.d(t,"d",(function(){return i}));const c=e=>"number"==typeof e,r=e=>"string"==typeof e,o=e=>!(e=>null===e)(e)&&e instanceof Object&&e.constructor===Object;function i(e,t){return o(e)&&t in e}},89:function(e,t,n){"use strict";var c=n(0),r=n(6),o=n(1),i=n(3);function l(e){let{level:t}=e;const n={1:"M9 5h2v10H9v-4H5v4H3V5h2v4h4V5zm6.6 0c-.6.9-1.5 1.7-2.6 2v1h2v7h2V5h-1.4z",2:"M7 5h2v10H7v-4H3v4H1V5h2v4h4V5zm8 8c.5-.4.6-.6 1.1-1.1.4-.4.8-.8 1.2-1.3.3-.4.6-.8.9-1.3.2-.4.3-.8.3-1.3 0-.4-.1-.9-.3-1.3-.2-.4-.4-.7-.8-1-.3-.3-.7-.5-1.2-.6-.5-.2-1-.2-1.5-.2-.4 0-.7 0-1.1.1-.3.1-.7.2-1 .3-.3.1-.6.3-.9.5-.3.2-.6.4-.8.7l1.2 1.2c.3-.3.6-.5 1-.7.4-.2.7-.3 1.2-.3s.9.1 1.3.4c.3.3.5.7.5 1.1 0 .4-.1.8-.4 1.1-.3.5-.6.9-1 1.2-.4.4-1 .9-1.6 1.4-.6.5-1.4 1.1-2.2 1.6V15h8v-2H15z",3:"M12.1 12.2c.4.3.8.5 1.2.7.4.2.9.3 1.4.3.5 0 1-.1 1.4-.3.3-.1.5-.5.5-.8 0-.2 0-.4-.1-.6-.1-.2-.3-.3-.5-.4-.3-.1-.7-.2-1-.3-.5-.1-1-.1-1.5-.1V9.1c.7.1 1.5-.1 2.2-.4.4-.2.6-.5.6-.9 0-.3-.1-.6-.4-.8-.3-.2-.7-.3-1.1-.3-.4 0-.8.1-1.1.3-.4.2-.7.4-1.1.6l-1.2-1.4c.5-.4 1.1-.7 1.6-.9.5-.2 1.2-.3 1.8-.3.5 0 1 .1 1.6.2.4.1.8.3 1.2.5.3.2.6.5.8.8.2.3.3.7.3 1.1 0 .5-.2.9-.5 1.3-.4.4-.9.7-1.5.9v.1c.6.1 1.2.4 1.6.8.4.4.7.9.7 1.5 0 .4-.1.8-.3 1.2-.2.4-.5.7-.9.9-.4.3-.9.4-1.3.5-.5.1-1 .2-1.6.2-.8 0-1.6-.1-2.3-.4-.6-.2-1.1-.6-1.6-1l1.1-1.4zM7 9H3V5H1v10h2v-4h4v4h2V5H7v4z",4:"M9 15H7v-4H3v4H1V5h2v4h4V5h2v10zm10-2h-1v2h-2v-2h-5v-2l4-6h3v6h1v2zm-3-2V7l-2.8 4H16z",5:"M12.1 12.2c.4.3.7.5 1.1.7.4.2.9.3 1.3.3.5 0 1-.1 1.4-.4.4-.3.6-.7.6-1.1 0-.4-.2-.9-.6-1.1-.4-.3-.9-.4-1.4-.4H14c-.1 0-.3 0-.4.1l-.4.1-.5.2-1-.6.3-5h6.4v1.9h-4.3L14 8.8c.2-.1.5-.1.7-.2.2 0 .5-.1.7-.1.5 0 .9.1 1.4.2.4.1.8.3 1.1.6.3.2.6.6.8.9.2.4.3.9.3 1.4 0 .5-.1 1-.3 1.4-.2.4-.5.8-.9 1.1-.4.3-.8.5-1.3.7-.5.2-1 .3-1.5.3-.8 0-1.6-.1-2.3-.4-.6-.2-1.1-.6-1.6-1-.1-.1 1-1.5 1-1.5zM9 15H7v-4H3v4H1V5h2v4h4V5h2v10z",6:"M9 15H7v-4H3v4H1V5h2v4h4V5h2v10zm8.6-7.5c-.2-.2-.5-.4-.8-.5-.6-.2-1.3-.2-1.9 0-.3.1-.6.3-.8.5l-.6.9c-.2.5-.2.9-.2 1.4.4-.3.8-.6 1.2-.8.4-.2.8-.3 1.3-.3.4 0 .8 0 1.2.2.4.1.7.3 1 .6.3.3.5.6.7.9.2.4.3.8.3 1.3s-.1.9-.3 1.4c-.2.4-.5.7-.8 1-.4.3-.8.5-1.2.6-1 .3-2 .3-3 0-.5-.2-1-.5-1.4-.9-.4-.4-.8-.9-1-1.5-.2-.6-.3-1.3-.3-2.1s.1-1.6.4-2.3c.2-.6.6-1.2 1-1.6.4-.4.9-.7 1.4-.9.6-.3 1.1-.4 1.7-.4.7 0 1.4.1 2 .3.5.2 1 .5 1.4.8 0 .1-1.3 1.4-1.3 1.4zm-2.4 5.8c.2 0 .4 0 .6-.1.2 0 .4-.1.5-.2.1-.1.3-.3.4-.5.1-.2.1-.5.1-.7 0-.4-.1-.8-.4-1.1-.3-.2-.7-.3-1.1-.3-.3 0-.7.1-1 .2-.4.2-.7.4-1 .7 0 .3.1.7.3 1 .1.2.3.4.4.6.2.1.3.3.5.3.2.1.5.2.7.1z"};return n.hasOwnProperty(t)?Object(c.createElement)(i.SVG,{width:"20",height:"20",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},Object(c.createElement)(i.Path,{d:n[t]})):null}class a extends c.Component{createLevelControl(e,t,n){const r=e===t;return{icon:Object(c.createElement)(l,{level:e}),title:Object(o.sprintf)(
/* translators: %s: heading level e.g: "2", "3", "4" */
Object(o.__)("Heading %d","woo-gutenberg-products-block"),e),isActive:r,onClick:()=>n(e)}}render(){const{isCollapsed:e=!0,minLevel:t,maxLevel:n,selectedLevel:o,onChange:a}=this.props;return Object(c.createElement)(i.ToolbarGroup,{isCollapsed:e,icon:Object(c.createElement)(l,{level:o}),controls:Object(r.range)(t,n).map(e=>this.createLevelControl(e,o,a))})}}t.a=a},9:function(e,t){e.exports=window.wp.compose},93:function(e,t,n){"use strict";n.d(t,"a",(function(){return r}));var c=n(0);const r=()=>{const[,e]=Object(c.useState)();return Object(c.useCallback)(t=>{e(()=>{throw t})},[])}}});