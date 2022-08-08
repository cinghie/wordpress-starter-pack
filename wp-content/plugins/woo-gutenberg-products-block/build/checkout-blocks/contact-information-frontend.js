(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[31],{25:function(e,t,c){"use strict";var n=c(0),a=c(4),l=c.n(a);t.a=e=>{let t,{label:c,screenReaderLabel:a,wrapperElement:r,wrapperProps:s={}}=e;const o=null!=c,i=null!=a;return!o&&i?(t=r||"span",s={...s,className:l()(s.className,"screen-reader-text")},Object(n.createElement)(t,s,a)):(t=r||n.Fragment,o&&i&&c!==a?Object(n.createElement)(t,s,Object(n.createElement)("span",{"aria-hidden":"true"},c),Object(n.createElement)("span",{className:"screen-reader-text"},a)):Object(n.createElement)(t,s,c))}},262:function(e,t){},263:function(e,t){},266:function(e,t,c){"use strict";var n=c(12),a=c.n(n),l=c(0),r=c(4),s=c.n(r);c(267),t.a=e=>{let{children:t,className:c,headingLevel:n,...r}=e;const o=s()("wc-block-components-title",c),i="h"+n;return Object(l.createElement)(i,a()({className:o},r),t)}},267:function(e,t){},273:function(e,t){},274:function(e,t,c){"use strict";c.d(t,"a",(function(){return l}));var n=c(0),a=c(200);c(262);const l=e=>{let{errorMessage:t="",propertyName:c="",elementId:l=""}=e;const{getValidationError:r,getValidationErrorId:s}=Object(a.b)();if(!t||"string"!=typeof t){const e=r(c)||{};if(!e.message||e.hidden)return null;t=e.message}return Object(n.createElement)("div",{className:"wc-block-components-validation-error",role:"alert"},Object(n.createElement)("p",{id:s(l)},t))}},276:function(e,t,c){"use strict";var n=c(1);t.a=e=>{let{defaultTitle:t=Object(n.__)("Step","woo-gutenberg-products-block"),defaultDescription:c=Object(n.__)("Step description text.","woo-gutenberg-products-block"),defaultShowStepNumber:a=!0}=e;return{title:{type:"string",default:t},description:{type:"string",default:c},showStepNumber:{type:"boolean",default:a}}}},295:function(e,t,c){"use strict";var n=c(0),a=c(4),l=c.n(a),r=c(266);c(273);const s=e=>{let{title:t,stepHeadingContent:c}=e;return Object(n.createElement)("div",{className:"wc-block-components-checkout-step__heading"},Object(n.createElement)(r.a,{"aria-hidden":"true",className:"wc-block-components-checkout-step__title",headingLevel:"2"},t),!!c&&Object(n.createElement)("span",{className:"wc-block-components-checkout-step__heading-content"},c))};t.a=e=>{let{id:t,className:c,title:a,legend:r,description:o,children:i,disabled:d=!1,showStepNumber:u=!0,stepHeadingContent:b=(()=>{})}=e;const p=r||a?"fieldset":"div";return Object(n.createElement)(p,{className:l()(c,"wc-block-components-checkout-step",{"wc-block-components-checkout-step--with-step-number":u,"wc-block-components-checkout-step--disabled":d}),id:t,disabled:d},!(!r&&!a)&&Object(n.createElement)("legend",{className:"screen-reader-text"},r||a),!!a&&Object(n.createElement)(s,{title:a,stepHeadingContent:b()}),Object(n.createElement)("div",{className:"wc-block-components-checkout-step__container"},!!o&&Object(n.createElement)("p",{className:"wc-block-components-checkout-step__description"},o),Object(n.createElement)("div",{className:"wc-block-components-checkout-step__content"},i)))}},298:function(e,t,c){"use strict";var n=c(12),a=c.n(n),l=c(0),r=c(1),s=c(5),o=c(4),i=c.n(o),d=c(200),u=c(274),b=c(9),p=c(52),m=c(25);c(263);var g=Object(s.forwardRef)((e,t)=>{let{className:c,id:n,type:r="text",ariaLabel:s,ariaDescribedBy:o,label:d,screenReaderLabel:u,disabled:b,help:p,autoCapitalize:g="off",autoComplete:h="off",value:j="",onChange:O,required:f=!1,onBlur:w=(()=>{}),feedback:k,...E}=e;const[v,_]=Object(l.useState)(!1);return Object(l.createElement)("div",{className:i()("wc-block-components-text-input",c,{"is-active":v||j})},Object(l.createElement)("input",a()({type:r,id:n,value:j,ref:t,autoCapitalize:g,autoComplete:h,onChange:e=>{O(e.target.value)},onFocus:()=>_(!0),onBlur:e=>{w(e.target.value),_(!1)},"aria-label":s||d,disabled:b,"aria-describedby":p&&!o?n+"__help":o,required:f},E)),Object(l.createElement)(m.a,{label:d,screenReaderLabel:u||d,wrapperElement:"label",wrapperProps:{htmlFor:n},htmlFor:n}),!!p&&Object(l.createElement)("p",{id:n+"__help",className:"wc-block-components-text-input__help"},p),k)});t.a=Object(b.withInstanceId)(e=>{let{className:t,instanceId:c,id:n,ariaDescribedBy:o,errorId:b,focusOnMount:m=!1,onChange:h,showError:j=!0,errorMessage:O="",value:f="",...w}=e;const[k,E]=Object(s.useState)(!0),v=Object(s.useRef)(null),{getValidationError:_,hideValidationError:N,setValidationErrors:C,clearValidationError:S,getValidationErrorId:A}=Object(d.b)(),y=void 0!==n?n:"textinput-"+c,B=void 0!==b?b:y,F=Object(s.useCallback)((function(){let e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];const t=v.current||null;if(!t)return;t.value=t.value.trim();const c=t.checkValidity();c?S(B):C({[B]:{message:t.validationMessage||Object(r.__)("Invalid value.","woo-gutenberg-products-block"),hidden:e}})}),[S,B,C]);Object(s.useEffect)(()=>{var e;k&&m&&(null===(e=v.current)||void 0===e||e.focus()),E(!1)},[m,k,E]),Object(s.useEffect)(()=>{var e,t;(null===(e=v.current)||void 0===e||null===(t=e.ownerDocument)||void 0===t?void 0:t.activeElement)!==v.current&&F(!0)},[f,F]),Object(s.useEffect)(()=>()=>{S(B)},[S,B]);const I=_(B)||{};Object(p.a)(O)&&""!==O&&(I.message=O);const x=I.message&&!I.hidden,L=j&&x&&A(B)?A(B):o;return Object(l.createElement)(g,a()({className:i()(t,{"has-error":x}),"aria-invalid":!0===x,id:y,onBlur:()=>{F(!1)},feedback:j&&Object(l.createElement)(u.a,{errorMessage:O,propertyName:B}),ref:v,onChange:e=>{N(B),h(e)},ariaDescribedBy:L,value:f},w))})},335:function(e,t,c){"use strict";c.d(t,"a",(function(){return o}));var n=c(2),a=c(0),l=c(36),r=c(67),s=c(66);const o=()=>{const{needsShipping:e}=Object(s.a)(),{useShippingAsBilling:t,setUseShippingAsBilling:c}=Object(l.b)(),{billingAddress:o,setBillingAddress:i,shippingAddress:d,setShippingAddress:u}=Object(r.a)(),b=Object(a.useCallback)(e=>{i({email:e})},[i]),p=Object(a.useCallback)(e=>{i({phone:e})},[i]),m=Object(a.useCallback)(e=>{u({phone:e})},[u]);return{shippingAddress:d,billingAddress:o,setShippingAddress:u,setBillingAddress:i,setEmail:b,setBillingPhone:p,setShippingPhone:m,defaultAddressFields:n.defaultAddressFields,useShippingAsBilling:t,setUseShippingAsBilling:c,showShippingFields:e,showBillingFields:!e||!t}}},431:function(e,t,c){"use strict";c.r(t);var n=c(0),a=c(4),l=c.n(a),r=c(120),s=c(295),o=c(36),i=c(1),d=c(298),u=c(335),b=c(59),p=c(2),m=c(10),g=e=>{let{allowCreateAccount:t}=e;const{customerId:c,shouldCreateAccount:a,setShouldCreateAccount:l}=Object(o.b)(),{billingAddress:r,setEmail:s}=Object(u.a)(),{dispatchCheckoutEvent:g}=Object(b.a)(),h=!c&&t&&Object(p.getSetting)("checkoutAllowsGuest",!1)&&Object(p.getSetting)("checkoutAllowsSignup",!1)&&Object(n.createElement)(m.CheckboxControl,{className:"wc-block-checkout__create-account",label:Object(i.__)("Create an account?","woo-gutenberg-products-block"),checked:a,onChange:e=>l(e)});return Object(n.createElement)(n.Fragment,null,Object(n.createElement)(d.a,{id:"email",type:"email",label:Object(i.__)("Email address","woo-gutenberg-products-block"),value:r.email,autoComplete:"email",onChange:e=>{s(e),g("set-email-address")},required:!0}),h)},h=c(276),j={...Object(h.a)({defaultTitle:Object(i.__)("Contact information","woo-gutenberg-products-block"),defaultDescription:Object(i.__)("We'll use this email to send you details and updates about your order.","woo-gutenberg-products-block")}),className:{type:"string",default:""},lock:{type:"object",default:{remove:!0,move:!0}}};const O=`${c(47).e}?redirect_to=${encodeURIComponent(window.location.href)}`;var f=()=>{const{customerId:e}=Object(o.b)();return!Object(p.getSetting)("checkoutShowLoginReminder",!0)||e?null:Object(n.createElement)(n.Fragment,null,Object(i.__)("Already have an account? ","woo-gutenberg-products-block"),Object(n.createElement)("a",{href:O},Object(i.__)("Log in.","woo-gutenberg-products-block")))},w=c(140);t.default=Object(r.withFilteredAttributes)(j)(e=>{let{title:t,description:c,showStepNumber:a,children:r,className:i}=e;const{isProcessing:d}=Object(o.b)(),{allowCreateAccount:u}=Object(w.b)();return Object(n.createElement)(s.a,{id:"contact-fields",disabled:d,className:l()("wc-block-checkout__contact-fields",i),title:t,description:c,showStepNumber:a,stepHeadingContent:()=>Object(n.createElement)(f,null)},Object(n.createElement)(g,{allowCreateAccount:u}),r)})}}]);