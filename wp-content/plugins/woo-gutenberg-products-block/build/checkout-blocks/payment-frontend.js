(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[43],{135:function(e,t,n){"use strict";var c=n(0);n(196),t.a=()=>Object(c.createElement)("span",{className:"wc-block-components-spinner","aria-hidden":"true"})},136:function(e,t,n){"use strict";var c=n(0),o=n(1),a=n(4),s=n.n(a),r=(n(198),n(135));t.a=e=>{let{children:t,className:n,screenReaderLabel:a,showSpinner:l=!1,isLoading:i=!0}=e;return Object(c.createElement)("div",{className:s()(n,{"wc-block-components-loading-mask":i})},i&&l&&Object(c.createElement)(r.a,null),Object(c.createElement)("div",{className:s()({"wc-block-components-loading-mask__children":i}),"aria-hidden":i},t),i&&Object(c.createElement)("span",{className:"screen-reader-text"},a||Object(o.__)("Loading…","woo-gutenberg-products-block")))}},196:function(e,t){},198:function(e,t){},22:function(e,t,n){"use strict";var c=n(0),o=n(4),a=n.n(o);t.a=e=>{let t,{label:n,screenReaderLabel:o,wrapperElement:s,wrapperProps:r={}}=e;const l=null!=n,i=null!=o;return!l&&i?(t=s||"span",r={...r,className:a()(r.className,"screen-reader-text")},Object(c.createElement)(t,r,o)):(t=s||c.Fragment,l&&i&&n!==o?Object(c.createElement)(t,r,Object(c.createElement)("span",{"aria-hidden":"true"},n),Object(c.createElement)("span",{className:"screen-reader-text"},o)):Object(c.createElement)(t,r,n))}},264:function(e,t){},268:function(e,t,n){"use strict";var c=n(12),o=n.n(c),a=n(0),s=n(4),r=n.n(s);n(269),t.a=e=>{let{children:t,className:n,headingLevel:c,...s}=e;const l=r()("wc-block-components-title",n),i="h"+c;return Object(a.createElement)(i,o()({className:l},s),t)}},269:function(e,t){},270:function(e,t,n){"use strict";var c=n(0),o=n(4),a=n.n(o),s=n(271);t.a=e=>{let{checked:t,name:n,onChange:o,option:r}=e;const{value:l,label:i,description:p,secondaryLabel:d,secondaryDescription:m}=r;return Object(c.createElement)("label",{className:a()("wc-block-components-radio-control__option",{"wc-block-components-radio-control__option-checked":t}),htmlFor:`${n}-${l}`},Object(c.createElement)("input",{id:`${n}-${l}`,className:"wc-block-components-radio-control__input",type:"radio",name:n,value:l,onChange:e=>o(e.target.value),checked:t,"aria-describedby":a()({[`${n}-${l}__label`]:i,[`${n}-${l}__secondary-label`]:d,[`${n}-${l}__description`]:p,[`${n}-${l}__secondary-description`]:m})}),Object(c.createElement)(s.a,{id:`${n}-${l}`,label:i,secondaryLabel:d,description:p,secondaryDescription:m}))}},271:function(e,t,n){"use strict";var c=n(0);t.a=e=>{let{label:t,secondaryLabel:n,description:o,secondaryDescription:a,id:s}=e;return Object(c.createElement)("div",{className:"wc-block-components-radio-control__option-layout"},Object(c.createElement)("div",{className:"wc-block-components-radio-control__label-group"},t&&Object(c.createElement)("span",{id:s&&s+"__label",className:"wc-block-components-radio-control__label"},t),n&&Object(c.createElement)("span",{id:s&&s+"__secondary-label",className:"wc-block-components-radio-control__secondary-label"},n)),Object(c.createElement)("div",{className:"wc-block-components-radio-control__description-group"},o&&Object(c.createElement)("span",{id:s&&s+"__description",className:"wc-block-components-radio-control__description"},o),a&&Object(c.createElement)("span",{id:s&&s+"__secondary-description",className:"wc-block-components-radio-control__secondary-description"},a)))}},274:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var c=n(1),o=n(7),a=n(6),s=n(17),r=n(32),l=n(199);const i=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";const{cartCoupons:t,cartIsLoading:n}=Object(r.a)(),{createErrorNotice:i}=Object(o.useDispatch)("core/notices"),{createNotice:p}=Object(o.useDispatch)("core/notices"),{setValidationErrors:d}=Object(l.b)(),{applyCoupon:m,removeCoupon:b,isApplyingCoupon:u,isRemovingCoupon:h}=Object(o.useSelect)((e,t)=>{let{dispatch:n}=t;const c=e(a.CART_STORE_KEY),o=n(a.CART_STORE_KEY);return{applyCoupon:o.applyCoupon,removeCoupon:o.removeCoupon,isApplyingCoupon:c.isApplyingCoupon(),isRemovingCoupon:c.isRemovingCoupon(),receiveApplyingCoupon:o.receiveApplyingCoupon}},[i,p]),g=t=>{m(t).then(n=>{!0===n&&p("info",Object(c.sprintf)(
/* translators: %s coupon code. */
Object(c.__)('Coupon code "%s" has been applied to your cart.',"woo-gutenberg-products-block"),t),{id:"coupon-form",type:"snackbar",context:e})}).catch(e=>{d({coupon:{message:Object(s.decodeEntities)(e.message),hidden:!1}}),receiveApplyingCoupon("")})},v=t=>{b(t).then(n=>{!0===n&&p("info",Object(c.sprintf)(
/* translators: %s coupon code. */
Object(c.__)('Coupon code "%s" has been removed from your cart.',"woo-gutenberg-products-block"),t),{id:"coupon-form",type:"snackbar",context:e})}).catch(t=>{i(t.message,{id:"coupon-form",context:e}),receiveApplyingCoupon("")})};return{appliedCoupons:t,isLoading:n,applyCoupon:g,removeCoupon:v,isApplyingCoupon:u,isRemovingCoupon:h}}},275:function(e,t){},276:function(e,t){},277:function(e,t,n){"use strict";n.d(t,"a",(function(){return a}));var c=n(0),o=n(199);n(264);const a=e=>{let{errorMessage:t="",propertyName:n="",elementId:a=""}=e;const{getValidationError:s,getValidationErrorId:r}=Object(o.b)();if(!t||"string"!=typeof t){const e=s(n)||{};if(!e.message||e.hidden)return null;t=e.message}return Object(c.createElement)("div",{className:"wc-block-components-validation-error",role:"alert"},Object(c.createElement)("p",{id:r(a)},t))}},278:function(e,t,n){"use strict";n.d(t,"b",(function(){return s})),n.d(t,"a",(function(){return r}));var c=n(31),o=n(207);const a=function(){let e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];const{paymentMethods:t,expressPaymentMethods:n,paymentMethodsInitialized:a,expressPaymentMethodsInitialized:s}=Object(o.b)(),r=Object(c.a)(t),l=Object(c.a)(n);return{paymentMethods:e?l:r,isInitialized:e?s:a}},s=()=>a(!1),r=()=>a(!0)},279:function(e,t,n){"use strict";var c=n(1);t.a=e=>{let{defaultTitle:t=Object(c.__)("Step","woo-gutenberg-products-block"),defaultDescription:n=Object(c.__)("Step description text.","woo-gutenberg-products-block"),defaultShowStepNumber:o=!0}=e;return{title:{type:"string",default:t},description:{type:"string",default:n},showStepNumber:{type:"boolean",default:o}}}},280:function(e,t,n){"use strict";var c=n(12),o=n.n(c),a=n(0),s=n(4),r=n.n(s);const l=e=>"wc-block-components-payment-method-icon wc-block-components-payment-method-icon--"+e;var i=e=>{let{id:t,src:n=null,alt:c=""}=e;return n?Object(a.createElement)("img",{className:l(t),src:n,alt:c}):null},p=n(48);const d=[{id:"alipay",alt:"Alipay",src:p.l+"payment-methods/alipay.svg"},{id:"amex",alt:"American Express",src:p.l+"payment-methods/amex.svg"},{id:"bancontact",alt:"Bancontact",src:p.l+"payment-methods/bancontact.svg"},{id:"diners",alt:"Diners Club",src:p.l+"payment-methods/diners.svg"},{id:"discover",alt:"Discover",src:p.l+"payment-methods/discover.svg"},{id:"eps",alt:"EPS",src:p.l+"payment-methods/eps.svg"},{id:"giropay",alt:"Giropay",src:p.l+"payment-methods/giropay.svg"},{id:"ideal",alt:"iDeal",src:p.l+"payment-methods/ideal.svg"},{id:"jcb",alt:"JCB",src:p.l+"payment-methods/jcb.svg"},{id:"laser",alt:"Laser",src:p.l+"payment-methods/laser.svg"},{id:"maestro",alt:"Maestro",src:p.l+"payment-methods/maestro.svg"},{id:"mastercard",alt:"Mastercard",src:p.l+"payment-methods/mastercard.svg"},{id:"multibanco",alt:"Multibanco",src:p.l+"payment-methods/multibanco.svg"},{id:"p24",alt:"Przelewy24",src:p.l+"payment-methods/p24.svg"},{id:"sepa",alt:"Sepa",src:p.l+"payment-methods/sepa.svg"},{id:"sofort",alt:"Sofort",src:p.l+"payment-methods/sofort.svg"},{id:"unionpay",alt:"Union Pay",src:p.l+"payment-methods/unionpay.svg"},{id:"visa",alt:"Visa",src:p.l+"payment-methods/visa.svg"},{id:"wechat",alt:"WeChat",src:p.l+"payment-methods/wechat.svg"}];var m=n(45);n(275),t.a=e=>{let{icons:t=[],align:n="center",className:c}=e;const s=(e=>{const t={};return e.forEach(e=>{let n={};"string"==typeof e&&(n={id:e,alt:e,src:null}),"object"==typeof e&&(n={id:e.id||"",alt:e.alt||"",src:e.src||null}),n.id&&Object(m.a)(n.id)&&!t[n.id]&&(t[n.id]=n)}),Object.values(t)})(t);if(0===s.length)return null;const l=r()("wc-block-components-payment-method-icons",{"wc-block-components-payment-method-icons--align-left":"left"===n,"wc-block-components-payment-method-icons--align-right":"right"===n},c);return Object(a.createElement)("div",{className:l},s.map(e=>{const t={...e,...(n=e.id,d.find(e=>e.id===n)||{})};var n;return Object(a.createElement)(i,o()({key:"payment-method-icon-"+e.id},t))}))}},290:function(e,t){},291:function(e,t,n){"use strict";var c=n(19),o=n.n(c),a=n(0),s=n(1),r=n(5),l=n(2),i=n(123),p=n(30);class d extends r.Component{constructor(){super(...arguments),o()(this,"state",{errorMessage:"",hasError:!1})}static getDerivedStateFromError(e){return{errorMessage:e.message,hasError:!0}}render(){const{hasError:e,errorMessage:t}=this.state,{isEditor:n}=this.props;if(e){let e=Object(s.__)("This site is experiencing difficulties with this payment method. Please contact the owner of the site for assistance.","woo-gutenberg-products-block");(n||l.CURRENT_USER_IS_ADMIN)&&(e=t||Object(s.__)("There was an error with this payment method. Please verify it's configured correctly.","woo-gutenberg-products-block"));const c=[{id:"0",content:e,isDismissible:!1,status:"error"}];return Object(a.createElement)(i.a,{additionalNotices:c,context:p.c.PAYMENTS})}return this.props.children}}d.defaultProps={isEditor:!1},t.a=d},292:function(e,t,n){"use strict";var c=n(0),o=n(4),a=n.n(o),s=n(9),r=n(270);n(293);const l=e=>{let{className:t="",id:n,selected:o,onChange:i,options:p=[]}=e;const d=Object(s.useInstanceId)(l),m=n||d;return p.length?Object(c.createElement)("div",{className:a()("wc-block-components-radio-control",t)},p.map(e=>Object(c.createElement)(r.a,{key:`${m}-${e.value}`,name:"radio-control-"+m,checked:e.value===o,option:e,onChange:t=>{i(t),"function"==typeof e.onChange&&e.onChange(t)}}))):null};t.a=l},293:function(e,t){},298:function(e,t,n){"use strict";var c=n(0),o=n(4),a=n.n(o),s=n(268);n(276);const r=e=>{let{title:t,stepHeadingContent:n}=e;return Object(c.createElement)("div",{className:"wc-block-components-checkout-step__heading"},Object(c.createElement)(s.a,{"aria-hidden":"true",className:"wc-block-components-checkout-step__title",headingLevel:"2"},t),!!n&&Object(c.createElement)("span",{className:"wc-block-components-checkout-step__heading-content"},n))};t.a=e=>{let{id:t,className:n,title:o,legend:s,description:l,children:i,disabled:p=!1,showStepNumber:d=!0,stepHeadingContent:m=(()=>{})}=e;const b=s||o?"fieldset":"div";return Object(c.createElement)(b,{className:a()(n,"wc-block-components-checkout-step",{"wc-block-components-checkout-step--with-step-number":d,"wc-block-components-checkout-step--disabled":p}),id:t,disabled:p},!(!s&&!o)&&Object(c.createElement)("legend",{className:"screen-reader-text"},s||o),!!o&&Object(c.createElement)(r,{title:o,stepHeadingContent:m()}),Object(c.createElement)("div",{className:"wc-block-components-checkout-step__container"},!!l&&Object(c.createElement)("p",{className:"wc-block-components-checkout-step__description"},l),Object(c.createElement)("div",{className:"wc-block-components-checkout-step__content"},i)))}},332:function(e,t,n){"use strict";var c=n(8),o=n(0),a=n(4),s=n.n(a),r=n(9),l=n(38);t.a=function({icon:e,children:t,label:n,instructions:a,className:i,notices:p,preview:d,isColumnLayout:m,...b}){const[u,{width:h}]=Object(r.useResizeObserver)();let g;"number"==typeof h&&(g={"is-large":h>=480,"is-medium":h>=160&&h<480,"is-small":h<160});const v=s()("components-placeholder",i,g),O=s()("components-placeholder__fieldset",{"is-column-layout":m});return Object(o.createElement)("div",Object(c.a)({},b,{className:v}),u,p,d&&Object(o.createElement)("div",{className:"components-placeholder__preview"},d),Object(o.createElement)("div",{className:"components-placeholder__label"},Object(o.createElement)(l.a,{icon:e}),n),!!a&&Object(o.createElement)("div",{className:"components-placeholder__instructions"},a),Object(o.createElement)("div",{className:O},t))}},337:function(e,t,n){"use strict";var c=n(0),o=n(13);const a=Object(c.createElement)(o.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)(o.Path,{fillRule:"evenodd",d:"M5.5 9.5v-2h13v2h-13zm0 3v4h13v-4h-13zM4 7a1 1 0 011-1h14a1 1 0 011 1v10a1 1 0 01-1 1H5a1 1 0 01-1-1V7z",clipRule:"evenodd"}));t.a=a},342:function(e,t,n){"use strict";n.d(t,"a",(function(){return T}));var c=n(1),o=n(41),a=n(0),s=n(4),r=n.n(s),l=n(13),i=Object(a.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(a.createElement)("g",{fill:"none",fillRule:"evenodd"},Object(a.createElement)("path",{d:"M0 0h24v24H0z"}),Object(a.createElement)("path",{fill:"#000",fillRule:"nonzero",d:"M17.3 8v1c1 .2 1.4.9 1.4 1.7h-1c0-.6-.3-1-1-1-.8 0-1.3.4-1.3.9 0 .4.3.6 1.4 1 1 .2 2 .6 2 1.9 0 .9-.6 1.4-1.5 1.5v1H16v-1c-.9-.1-1.6-.7-1.7-1.7h1c0 .6.4 1 1.3 1 1 0 1.2-.5 1.2-.8 0-.4-.2-.8-1.3-1.1-1.3-.3-2.1-.8-2.1-1.8 0-.9.7-1.5 1.6-1.6V8h1.3zM12 10v1H6v-1h6zm2-2v1H6V8h8zM2 4v16h20V4H2zm2 14V6h16v12H4z"}),Object(a.createElement)("path",{stroke:"#000",strokeLinecap:"round",d:"M6 16c2.6 0 3.9-3 1.7-3-2 0-1 3 1.5 3 1 0 1-.8 2.8-.8"}))),p=Object(a.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(a.createElement)(l.Path,{fillRule:"evenodd",d:"M18.646 9H20V8l-1-.5L12 4 5 7.5 4 8v1h14.646zm-3-1.5L12 5.677 8.354 7.5h7.292zm-7.897 9.44v-6.5h-1.5v6.5h1.5zm5-6.5v6.5h-1.5v-6.5h1.5zm5 0v6.5h-1.5v-6.5h1.5zm2.252 8.81c0 .414-.334.75-.748.75H4.752a.75.75 0 010-1.5h14.5a.75.75 0 01.749.75z",clipRule:"evenodd"})),d=Object(a.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(a.createElement)(l.Path,{d:"M3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zm-1.338 4.877c-.314.22-.412.452-.412.623 0 .171.098.403.412.623.312.218.783.377 1.338.377.825 0 1.605.233 2.198.648.59.414 1.052 1.057 1.052 1.852 0 .795-.461 1.438-1.052 1.852-.41.286-.907.486-1.448.582v.316a.75.75 0 01-1.5 0v-.316a3.64 3.64 0 01-1.448-.582c-.59-.414-1.052-1.057-1.052-1.852a.75.75 0 011.5 0c0 .171.098.403.412.623.312.218.783.377 1.338.377s1.026-.159 1.338-.377c.314-.22.412-.452.412-.623 0-.171-.098-.403-.412-.623-.312-.218-.783-.377-1.338-.377-.825 0-1.605-.233-2.198-.648-.59-.414-1.052-1.057-1.052-1.852 0-.795.461-1.438 1.052-1.852a3.64 3.64 0 011.448-.582V7.5a.75.75 0 011.5 0v.316c.54.096 1.039.296 1.448.582.59.414 1.052 1.057 1.052 1.852a.75.75 0 01-1.5 0c0-.171-.098-.403-.412-.623-.312-.218-.783-.377-1.338-.377s-1.026.159-1.338.377z"})),m=n(337),b=n(117),u=n(45),h=n(18);n(290);const g={bank:p,bill:d,card:m.a,checkPayment:i};var v=e=>{let{icon:t="",text:n=""}=e;const c=!!t,o=Object(a.useCallback)(e=>c&&Object(u.a)(e)&&Object(h.b)(g,e),[c]),s=r()("wc-block-components-payment-method-label",{"wc-block-components-payment-method-label--with-icon":c});return Object(a.createElement)("span",{className:s},o(t)?Object(a.createElement)(b.a,{icon:g[t]}):t,n)},O=n(280),j=n(2),y=n(25),k=n.n(y),_=n(136),w=n(277),E=n(32),f=n(274),S=n(30),C=n(36),N=n(207),P=n(68),M=n(50);const x=(e,t)=>{const n=[],o=(t,n)=>{const c=n+"_tax",o=Object(h.b)(e,n)&&Object(u.a)(e[n])?parseInt(e[n],10):0;return{key:n,label:t,value:o,valueWithTax:o+(Object(h.b)(e,c)&&Object(u.a)(e[c])?parseInt(e[c],10):0)}};return n.push(o(Object(c.__)("Subtotal:","woo-gutenberg-products-block"),"total_items")),n.push(o(Object(c.__)("Fees:","woo-gutenberg-products-block"),"total_fees")),n.push(o(Object(c.__)("Discount:","woo-gutenberg-products-block"),"total_discount")),n.push({key:"total_tax",label:Object(c.__)("Taxes:","woo-gutenberg-products-block"),value:parseInt(e.total_tax,10),valueWithTax:parseInt(e.total_tax,10)}),t&&n.push(o(Object(c.__)("Shipping:","woo-gutenberg-products-block"),"total_shipping")),n};var R=n(66);const T=()=>{const{isCalculating:e,isComplete:t,isIdle:n,isProcessing:s,onCheckoutBeforeProcessing:r,onCheckoutValidationBeforeProcessing:l,onCheckoutAfterProcessingWithSuccess:i,onCheckoutAfterProcessingWithError:p,onSubmit:d,customerId:m}=Object(C.b)(),{currentStatus:b,activePaymentMethod:u,onPaymentProcessing:h,setExpressPaymentError:g,shouldSavePayment:y}=Object(N.b)(),{shippingErrorStatus:T,shippingErrorTypes:A,onShippingRateSuccess:I,onShippingRateFail:z,onShippingRateSelectSuccess:L,onShippingRateSelectFail:$}=Object(P.b)(),{shippingRates:D,isLoadingRates:V,selectedRates:F,isSelectingRate:B,selectShippingRate:H,needsShipping:W}=Object(R.a)(),{billingAddress:Y,shippingAddress:G,setShippingAddress:U}=Object(M.b)(),{cartItems:J,cartFees:K,cartTotals:q,extensions:Q}=Object(E.a)(),{appliedCoupons:X}=Object(f.a)(),{noticeContexts:Z,responseTypes:ee}=Object(S.d)(),te=Object(a.useRef)(x(q,W)),ne=Object(a.useRef)({label:Object(c.__)("Total","woo-gutenberg-products-block"),value:parseInt(q.total_price,10)});Object(a.useEffect)(()=>{te.current=x(q,W),ne.current={label:Object(c.__)("Total","woo-gutenberg-products-block"),value:parseInt(q.total_price,10)}},[q,W]);const ce=Object(a.useCallback)((function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";k()("setExpressPaymentError should only be used by Express Payment Methods (using the provided onError handler).",{alternative:"",plugin:"woocommerce-gutenberg-products-block",link:"https://github.com/woocommerce/woocommerce-gutenberg-products-block/pull/4228"}),g(e)}),[g]);return{activePaymentMethod:u,billing:{appliedCoupons:X,billingAddress:Y,billingData:Y,cartTotal:ne.current,cartTotalItems:te.current,currency:Object(o.getCurrencyFromPriceResponse)(q),customerId:m,displayPricesIncludingTax:Object(j.getSetting)("displayCartPricesIncludingTax",!1)},cartData:{cartItems:J,cartFees:K,extensions:Q},checkoutStatus:{isCalculating:e,isComplete:t,isIdle:n,isProcessing:s},components:{LoadingMask:_.a,PaymentMethodIcons:O.a,PaymentMethodLabel:v,ValidationInputError:w.a},emitResponse:{noticeContexts:Z,responseTypes:ee},eventRegistration:{onCheckoutAfterProcessingWithError:p,onCheckoutAfterProcessingWithSuccess:i,onCheckoutBeforeProcessing:r,onCheckoutValidationBeforeProcessing:l,onPaymentProcessing:h,onShippingRateFail:z,onShippingRateSelectFail:$,onShippingRateSelectSuccess:L,onShippingRateSuccess:I},onSubmit:d,paymentStatus:b,setExpressPaymentError:ce,shippingData:{isSelectingRate:B,needsShipping:W,selectedRates:F,setSelectedRates:H,setShippingAddress:U,shippingAddress:G,shippingRates:D,shippingRatesLoading:V},shippingStatus:{shippingErrorStatus:T,shippingErrorTypes:A},shouldSavePayment:y}}},387:function(e,t){},431:function(e,t,n){"use strict";n.r(t);var c=n(0),o=n(4),a=n.n(o),s=n(32),r=n(30),l=n(119),i=n(298),p=n(36),d=n(278),m=n(1),b=n(22),u=n(207),h=n(332),g=n(42),v=n(76),O=n(117),j=n(337),y=n(2),k=n(29);n(387);const _=()=>Object(c.createElement)(h.a,{icon:Object(c.createElement)(O.a,{icon:j.a}),label:Object(m.__)("Payment methods","woo-gutenberg-products-block"),className:"wc-block-checkout__no-payment-methods-placeholder"},Object(c.createElement)("span",{className:"wc-block-checkout__no-payment-methods-placeholder-description"},Object(m.__)("Your store does not have any payment methods configured that support the checkout block. Once you have configured a compatible payment method it will be shown here.","woo-gutenberg-products-block")),Object(c.createElement)(g.a,{isSecondary:!0,href:y.ADMIN_URL+"admin.php?page=wc-settings&tab=checkout",target:"_blank",rel:"noopener noreferrer"},Object(m.__)("Configure Payment Methods","woo-gutenberg-products-block"))),w=()=>Object(c.createElement)(v.a,{isDismissible:!1,className:a()("wc-block-checkout__no-payment-methods-notice","woocommerce-message","woocommerce-error")},Object(m.__)("There are no payment methods available. This may be an error on our side. Please contact us if you need any help placing your order.","woo-gutenberg-products-block"));var E=()=>{const{isEditor:e}=Object(k.a)();return e?Object(c.createElement)(_,null):Object(c.createElement)(w,null)},f=n(342),S=n(59),C=n(9),N=n(270),P=Object(C.withInstanceId)(e=>{let{className:t,instanceId:n,id:o,selected:s,onChange:r,options:l=[]}=e;const i=o||n;return l.length&&Object(c.createElement)("div",{className:a()("wc-block-components-radio-control",t)},l.map(e=>{const t="object"==typeof e&&"content"in e,n=e.value===s;return Object(c.createElement)("div",{className:"wc-block-components-radio-control-accordion-option",key:e.value},Object(c.createElement)(N.a,{name:"radio-control-"+i,checked:n,option:e,onChange:t=>{r(t),"function"==typeof e.onChange&&e.onChange(t)}}),t&&n&&Object(c.createElement)("div",{className:a()("wc-block-components-radio-control-accordion-content",{"wc-block-components-radio-control-accordion-content-hide":!n})},e.content))}))}),M=n(7),x=n(10),R=n(291),T=e=>{let{children:t,showSaveOption:n}=e;const{isEditor:o}=Object(k.a)(),{shouldSavePayment:a,setShouldSavePayment:s}=Object(u.b)(),{customerId:r}=Object(p.b)();return Object(c.createElement)(R.a,{isEditor:o},t,r>0&&n&&Object(c.createElement)(x.CheckboxControl,{className:"wc-block-components-payment-methods__save-card-info",label:Object(m.__)("Save payment information to my account for future purchases.","woo-gutenberg-products-block"),checked:a,onChange:()=>s(!a)}))},A=()=>{const{setActivePaymentMethod:e,activeSavedToken:t,isExpressPaymentMethodActive:n,customerPaymentMethods:o}=Object(u.b)(),{paymentMethods:s}=Object(d.b)(),{activePaymentMethod:l,...i}=Object(f.a)(),{noticeContexts:p}=Object(r.d)(),{removeNotice:m}=Object(M.useDispatch)("core/notices"),{dispatchCheckoutEvent:b}=Object(S.a)(),{isEditor:h}=Object(k.a)(),g=Object.keys(s).map(e=>{const{edit:t,content:n,label:o,supports:a}=s[e],r=h?t:n;return{value:e,label:"string"==typeof o?o:Object(c.cloneElement)(o,{components:i.components}),name:"wc-saved-payment-method-token-"+e,content:Object(c.createElement)(T,{showSaveOption:a.showSaveOption},Object(c.cloneElement)(r,{activePaymentMethod:l,...i}))}}),v=Object(c.useCallback)(t=>{e(t),m("wc-payment-error",p.PAYMENTS),b("set-active-payment-method",{value:t})},[b,p.PAYMENTS,m,e]),O=0===Object.keys(o).length&&1===Object.keys(s).length,j=a()({"disable-radio-control":O});return n?null:Object(c.createElement)(P,{id:"wc-payment-method-options",className:j,selected:t?null:l,onChange:v,options:g})},I=n(292);const z=e=>{let{method:t,expires:n}=e;return Object(m.sprintf)(
/* translators: %1$s is referring to the payment method brand, %2$s is referring to the last 4 digits of the payment card, %3$s is referring to the expiry date.  */
Object(m.__)("%1$s ending in %2$s (expires %3$s)","woo-gutenberg-products-block"),t.brand,t.last4,n)},L=e=>{let{method:t}=e;return t.brand&&t.last4?Object(m.sprintf)(
/* translators: %1$s is referring to the payment method brand, %2$s is referring to the last 4 digits of the payment card. */
Object(m.__)("%1$s ending in %2$s","woo-gutenberg-products-block"),t.brand,t.last4):Object(m.sprintf)(
/* translators: %s is the name of the payment method gateway. */
Object(m.__)("Saved token for %s","woo-gutenberg-products-block"),t.gateway)};var $=()=>{var e,t;const{customerPaymentMethods:n,activePaymentMethod:o,setActivePaymentMethod:a,activeSavedToken:s}=Object(u.b)(),{paymentMethods:l}=Object(d.b)(),i=Object(f.a)(),{noticeContexts:p}=Object(r.d)(),{removeNotice:m}=Object(M.useDispatch)("core/notices"),{dispatchCheckoutEvent:b}=Object(S.a)(),h=Object(c.useMemo)(()=>Object.keys(n).flatMap(e=>n[e].map(t=>{const n="cc"===e||"echeck"===e,c=t.method.gateway;return{name:"wc-saved-payment-method-token-"+c,label:n?z(t):L(t),value:t.tokenId.toString(),onChange:e=>{a(c,{token:e,payment_method:c,[`wc-${c}-payment-token`]:e.toString(),isSavedToken:!0}),m("wc-payment-error",p.PAYMENTS),b("set-active-payment-method",{paymentMethodSlug:c})}}})).filter(Boolean),[n,a,m,p.PAYMENTS,b]),g=s&&l[o]&&null!==(e=l[o])&&void 0!==e&&e.savedTokenComponent?Object(c.cloneElement)(null===(t=l[o])||void 0===t?void 0:t.savedTokenComponent,{token:s,...i}):null;return h.length>0?Object(c.createElement)(c.Fragment,null,Object(c.createElement)(I.a,{id:"wc-payment-method-saved-tokens",selected:s,options:h,onChange:()=>{}}),g):null},D=()=>{const{isInitialized:e,paymentMethods:t}=Object(d.b)(),{customerPaymentMethods:n}=Object(u.b)();return e&&0===Object.keys(t).length?Object(c.createElement)(E,null):Object(c.createElement)(c.Fragment,null,Object(c.createElement)($,null),Object.keys(n).length>0&&Object(c.createElement)(b.a,{label:Object(m.__)("Use another payment method.","woo-gutenberg-products-block"),screenReaderLabel:Object(m.__)("Other available payment methods","woo-gutenberg-products-block"),wrapperElement:"p",wrapperProps:{className:["wc-block-components-checkout-step__description wc-block-components-checkout-step__description-payments-aligned"]}}),Object(c.createElement)(A,null))},V=()=>Object(c.createElement)(D,null),F=n(279),B={...Object(F.a)({defaultTitle:Object(m.__)("Payment options","woo-gutenberg-products-block"),defaultDescription:""}),className:{type:"string",default:""},lock:{type:"object",default:{move:!0,remove:!0}}},H=n(123);t.default=Object(l.withFilteredAttributes)(B)(e=>{let{title:t,description:n,showStepNumber:o,children:l,className:d}=e;const{isProcessing:m}=Object(p.b)(),{cartNeedsPayment:b}=Object(s.a)(),{noticeContexts:u}=Object(r.d)();return b?Object(c.createElement)(i.a,{id:"payment-method",disabled:m,className:a()("wc-block-checkout__payment-method",d),title:t,description:n,showStepNumber:o},Object(c.createElement)(H.a,{context:u.PAYMENTS}),Object(c.createElement)(V,null),l):null})}}]);