(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[37],{152:function(e,t,n){"use strict";var c=n(0);n(220),t.a=()=>Object(c.createElement)("span",{className:"wc-block-components-spinner","aria-hidden":"true"})},220:function(e,t){},289:function(e,t,n){"use strict";var c=n(15),a=n.n(c),s=n(0),r=n(49),o=n(5),i=n.n(o),l=n(152);n(290),t.a=e=>{let{className:t,showSpinner:n=!1,children:c,variant:o="contained",...u}=e;const b=i()("wc-block-components-button",t,o,{"wc-block-components-button--loading":n});return Object(s.createElement)(r.a,a()({className:b},u),n&&Object(s.createElement)(l.a,null),Object(s.createElement)("span",{className:"wc-block-components-button__text"},c))}},290:function(e,t){},309:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return l}));var c=n(31),a=n(18),s=n(7),r=n(4);const o=function(){let e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];const{paymentMethodsInitialized:t,expressPaymentMethodsInitialized:n,availablePaymentMethods:o,availableExpressPaymentMethods:i}=Object(s.useSelect)(e=>{const t=e(r.PAYMENT_STORE_KEY);return{paymentMethodsInitialized:t.paymentMethodsInitialized(),expressPaymentMethodsInitialized:t.expressPaymentMethodsInitialized(),availableExpressPaymentMethods:t.getAvailableExpressPaymentMethods(),availablePaymentMethods:t.getAvailablePaymentMethods()}}),l=Object.values(o).map(e=>{let{name:t}=e;return t}),u=Object.values(i).map(e=>{let{name:t}=e;return t}),b=Object(a.getPaymentMethods)(),d=Object(a.getExpressPaymentMethods)(),m=Object.keys(b).reduce((e,t)=>(l.includes(t)&&(e[t]=b[t]),e),{}),p=Object.keys(d).reduce((e,t)=>(u.includes(t)&&(e[t]=d[t]),e),{}),h=Object(c.a)(m),O=Object(c.a)(p);return{paymentMethods:e?O:h,isInitialized:e?n:t}},i=()=>o(!1),l=()=>o(!0)},31:function(e,t,n){"use strict";n.d(t,"a",(function(){return r}));var c=n(0),a=n(13),s=n.n(a);function r(e){const t=Object(c.useRef)(e);return s()(e,t.current)||(t.current=e),t.current}},321:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var c=n(4),a=n(7),s=n(88),r=n(309);const o=()=>{const{isCalculating:e,isBeforeProcessing:t,isProcessing:n,isAfterProcessing:o,isComplete:i,hasError:l}=Object(a.useSelect)(e=>{const t=e(c.CHECKOUT_STORE_KEY);return{isCalculating:t.isCalculating(),isBeforeProcessing:t.isBeforeProcessing(),isProcessing:t.isProcessing(),isAfterProcessing:t.isAfterProcessing(),isComplete:t.isComplete(),hasError:t.hasError()}}),{activePaymentMethod:u,isExpressPaymentMethodActive:b}=Object(a.useSelect)(e=>{const t=e(c.PAYMENT_STORE_KEY);return{activePaymentMethod:t.getActivePaymentMethod(),isExpressPaymentMethodActive:t.isExpressPaymentMethodActive()}}),{onSubmit:d}=Object(s.b)(),{paymentMethods:m={}}=Object(r.b)(),p=n||o||t,h=i&&!l;return{paymentMethodButtonLabel:(m[u]||{}).placeOrderButtonLabel,onSubmit:d,isCalculating:e,isDisabled:n||b,waitingForProcessing:p,waitingForRedirect:h}}},395:function(e,t,n){"use strict";var c=n(0),a=n(12);const s=Object(c.createElement)(a.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(a.Path,{d:"M16.7 7.1l-6.3 8.5-3.3-2.5-.9 1.2 4.5 3.4L17.9 8z"}));t.a=s},423:function(e,t){},424:function(e,t){},463:function(e,t,n){"use strict";n.r(t);var c=n(140),a=n(0),s=n(5),r=n.n(s),o=n(2),i=n(1),l=n(36),u=n(94),b=n(12),d=Object(a.createElement)(b.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(a.createElement)(b.Path,{d:"M20 10.8H6.7l4.1-4.5-1.1-1.1-5.8 6.3 5.8 5.8 1.1-1.1-4-3.9H20z"}));n(424);var m=e=>{let{link:t}=e;const n=t||l.c;return n?Object(a.createElement)("a",{href:n,className:"wc-block-components-checkout-return-to-cart-button"},Object(a.createElement)(u.a,{icon:d}),Object(i.__)("Return to Cart","woo-gutenberg-products-block")):null},p=n(321),h=n(395),O=n(289),g=e=>{let{label:t}=e;const{onSubmit:n,isCalculating:c,isDisabled:s,waitingForProcessing:r,waitingForRedirect:o}=Object(p.a)();return Object(a.createElement)(O.a,{className:"wc-block-components-checkout-place-order-button",onClick:n,disabled:c||s||r||o,showSpinner:r},o?Object(a.createElement)(u.a,{icon:h.a}):t)},j=n(11);n(423);const P=Object(i.__)("Place Order","woo-gutenberg-products-block");var w={cartPageId:{type:"number",default:0},showReturnToCart:{type:"boolean",default:!0},className:{type:"string",default:""},lock:{type:"object",default:{move:!0,remove:!0}},placeOrderButtonLabel:{type:"string",default:P}};t.default=Object(c.withFilteredAttributes)(w)(e=>{let{cartPageId:t,showReturnToCart:n,className:c,placeOrderButtonLabel:s}=e;const{paymentMethodButtonLabel:i}=Object(p.a)(),l=Object(j.__experimentalApplyCheckoutFilter)({filterName:"placeOrderButtonLabel",defaultValue:i||s||P});return Object(a.createElement)("div",{className:r()("wc-block-checkout__actions",c)},n&&Object(a.createElement)(m,{link:Object(o.getSetting)("page-"+t,!1)}),Object(a.createElement)(g,{label:l}))})}}]);