(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[35],{105:function(e,t,n){"use strict";var c=n(1),r=(n(10),n(6)),o=n.n(r),a=(n(181),n(138));t.a=function(e){var t=e.children,n=e.className,r=e.screenReaderLabel,s=e.showSpinner,l=void 0!==s&&s,i=e.isLoading,u=void 0===i||i;return React.createElement("div",{className:o()(n,{"wc-block-components-loading-mask":u})},u&&l&&React.createElement(a.a,null),React.createElement("div",{className:o()({"wc-block-components-loading-mask__children":u}),"aria-hidden":u},t),u&&React.createElement("span",{className:"screen-reader-text"},r||Object(c.__)("Loading…","woo-gutenberg-products-block")))}},138:function(e,t,n){"use strict";n(180),t.a=function(){return React.createElement("span",{className:"wc-block-components-spinner","aria-hidden":"true"})}},175:function(e,t,n){"use strict";var c=n(14),r=n.n(c),o=n(23),a=n.n(o),s=n(6),l=n.n(s),i=(n(10),n(248),["children","className","headingLevel"]);t.a=function(e){var t=e.children,n=e.className,c=e.headingLevel,o=a()(e,i),s=l()("wc-block-components-title",n),u="h".concat(c);return React.createElement(u,r()({className:s},o),t)}},180:function(e,t){},181:function(e,t){},212:function(e,t,n){"use strict";var c=n(4),r=n.n(c),o=n(5),a=n.n(o),s=n(1),l=n(318),i=n(187),u=n(0),m=n(36),p=n(173),b=n(45),d=n.n(b),E=n(213);function O(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var c=Object.getOwnPropertySymbols(e);t&&(c=c.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,c)}return n}function g(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?O(Object(n),!0).forEach((function(t){r()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):O(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}t.a=function(){var e=Object(m.a)().isEditor,t=Object(p.b)(),n=t.setActivePaymentMethod,c=t.setExpressPaymentError,r=t.activePaymentMethod,o=t.paymentMethodData,b=t.setPaymentStatus,O=Object(l.a)(),k=Object(i.a)().paymentMethods,f=Object(u.useRef)(r),h=Object(u.useRef)(o),j=Object(u.useCallback)((function(e){return function(){f.current=r,h.current=o,b().started({}),n(e)}}),[r,o,n,b]),y=Object(u.useCallback)((function(){b().pristine(),n(f.current),h.current.isSavedToken&&b().started(h.current)}),[n,b]),v=Object(u.useCallback)((function(e){b().error(e),c(e),n(f.current),h.current.isSavedToken&&b().started(h.current)}),[n,b,c]),w=Object(u.useCallback)((function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";d()("Express Payment Methods should use the provided onError handler instead.",{alternative:"onError",plugin:"woocommerce-gutenberg-products-block",link:"https://github.com/woocommerce/woocommerce-gutenberg-products-block/pull/4228"}),e?v(e):c("")}),[c,v]),R=Object.entries(k),_=R.length>0?R.map((function(t){var n=a()(t,2),c=n[0],r=n[1],o=e?r.edit:r.content;return Object(u.isValidElement)(o)?React.createElement("li",{key:c,id:"express-payment-method-".concat(c)},Object(u.cloneElement)(o,g(g({},O),{},{onClick:j(c),onClose:y,onError:v,setExpressPaymentError:w}))):null})):React.createElement("li",{key:"noneRegistered"},Object(s.__)("No registered Payment Methods","woo-gutenberg-products-block"));return React.createElement(E.a,{isEditor:e},React.createElement("ul",{className:"wc-block-components-express-payment__event-buttons"},_))}},248:function(e,t){},264:function(e,t){},417:function(e,t,n){"use strict";n.r(t);var c=n(32),r=n(1),o=n(187),a=n(35),s=n(48),l=n(173),i=n(36),u=n(103),m=n(175),p=n(105),b=n(2),d=n(212),E=(n(264),function(){var e=Object(s.b)(),t=e.isCalculating,n=e.isProcessing,c=e.isAfterProcessing,E=e.isBeforeProcessing,O=e.isComplete,g=e.hasError,k=Object(l.b)().currentStatus,f=Object(o.a)(),h=f.paymentMethods,j=f.isInitialized,y=Object(i.a)().isEditor,v=Object(a.c)().noticeContexts;if(!j||j&&0===Object.keys(h).length)return y||b.CURRENT_USER_IS_ADMIN?React.createElement(u.a,{context:v.EXPRESS_PAYMENTS}):null;var w=n||c||E||O&&!g;return React.createElement(React.Fragment,null,React.createElement(p.a,{isLoading:t||w||k.isDoingExpressPayment},React.createElement("div",{className:"wc-block-components-express-payment wc-block-components-express-payment--checkout"},React.createElement("div",{className:"wc-block-components-express-payment__title-container"},React.createElement(m.a,{className:"wc-block-components-express-payment__title",headingLevel:"2"},Object(r.__)("Express checkout","woo-gutenberg-products-block"))),React.createElement("div",{className:"wc-block-components-express-payment__content"},React.createElement(u.a,{context:v.EXPRESS_PAYMENTS},React.createElement("p",null,Object(r.__)("In a hurry? Use one of our express checkout options:","woo-gutenberg-products-block")),React.createElement(d.a,null))))),React.createElement("div",{className:"wc-block-components-express-payment-continue-rule wc-block-components-express-payment-continue-rule--checkout"},Object(r.__)("Or continue below","woo-gutenberg-products-block")))});t.default=function(){return Object(c.a)().cartNeedsPayment?React.createElement(E,null):null}}}]);