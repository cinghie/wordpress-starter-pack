this.wp=this.wp||{},this.wp.serverSideRender=function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}return n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=327)}({0:function(e,t){!function(){e.exports=this.wp.element}()},1:function(e,t){!function(){e.exports=this.wp.i18n}()},10:function(e,t,n){"use strict";function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}n.d(t,"a",(function(){return r}))},11:function(e,t,n){"use strict";function r(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function o(e,t,n){return t&&r(e.prototype,t),n&&r(e,n),e}n.d(t,"a",(function(){return o}))},12:function(e,t,n){"use strict";function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}n.d(t,"a",(function(){return r}))},13:function(e,t,n){"use strict";n.d(t,"a",(function(){return c}));var r=n(30),o=n(5);function c(e,t){return!t||"object"!==Object(r.a)(t)&&"function"!=typeof t?Object(o.a)(e):t}},14:function(e,t,n){"use strict";function r(e){return(r=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}n.d(t,"a",(function(){return r}))},15:function(e,t,n){"use strict";function r(e,t){return(r=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function o(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&r(e,t)}n.d(t,"a",(function(){return o}))},17:function(e,t,n){"use strict";function r(){return(r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e}).apply(this,arguments)}n.d(t,"a",(function(){return r}))},2:function(e,t){!function(){e.exports=this.lodash}()},20:function(e,t,n){"use strict";function r(e,t){if(null==e)return{};var n,r,o=function(e,t){if(null==e)return{};var n,r,o={},c=Object.keys(e);for(r=0;r<c.length;r++)n=c[r],t.indexOf(n)>=0||(o[n]=e[n]);return o}(e,t);if(Object.getOwnPropertySymbols){var c=Object.getOwnPropertySymbols(e);for(r=0;r<c.length;r++)n=c[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(o[n]=e[n])}return o}n.d(t,"a",(function(){return r}))},27:function(e,t){!function(){e.exports=this.wp.url}()},3:function(e,t){!function(){e.exports=this.wp.components}()},30:function(e,t,n){"use strict";function r(e){return(r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function o(e){return(o="function"==typeof Symbol&&"symbol"===r(Symbol.iterator)?function(e){return r(e)}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":r(e)})(e)}n.d(t,"a",(function(){return o}))},32:function(e,t){!function(){e.exports=this.wp.apiFetch}()},327:function(e,t,n){"use strict";n.r(t);var r=n(17),o=n(7),c=n(20),u=n(0),i=n(4),s=n(34),a=n.n(s),l=n(12),f=n(11),p=n(13),b=n(14),d=n(15),y=n(2),h=n(1),O=n(32),m=n.n(O),j=n(27),v=n(3);var w=function(e){function t(e){var n;return Object(l.a)(this,t),(n=Object(p.a)(this,Object(b.a)(t).call(this,e))).state={response:null},n}return Object(d.a)(t,e),Object(f.a)(t,[{key:"componentDidMount",value:function(){this.isStillMounted=!0,this.fetch(this.props),this.fetch=Object(y.debounce)(this.fetch,500)}},{key:"componentWillUnmount",value:function(){this.isStillMounted=!1}},{key:"componentDidUpdate",value:function(e){Object(y.isEqual)(e,this.props)||this.fetch(this.props)}},{key:"fetch",value:function(e){var t=this;if(this.isStillMounted){null!==this.state.response&&this.setState({response:null});var n=e.block,r=e.attributes,c=void 0===r?null:r,u=e.urlQueryArgs,i=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};return Object(j.addQueryArgs)("/wp/v2/block-renderer/".concat(e),Object(o.a)({context:"edit"},null!==t?{attributes:t}:{},n))}(n,c,void 0===u?{}:u),s=this.currentFetchRequest=m()({path:i}).then((function(e){t.isStillMounted&&s===t.currentFetchRequest&&e&&t.setState({response:e.rendered})})).catch((function(e){t.isStillMounted&&s===t.currentFetchRequest&&t.setState({response:{error:!0,errorMsg:e.message}})}));return s}}},{key:"render",value:function(){var e=this.state.response,t=this.props,n=t.className,o=t.EmptyResponsePlaceholder,c=t.ErrorResponsePlaceholder,i=t.LoadingResponsePlaceholder;return""===e?Object(u.createElement)(o,Object(r.a)({response:e},this.props)):e?e.error?Object(u.createElement)(c,Object(r.a)({response:e},this.props)):Object(u.createElement)(u.RawHTML,{key:"html",className:n},e):Object(u.createElement)(i,Object(r.a)({response:e},this.props))}}]),t}(u.Component);w.defaultProps={EmptyResponsePlaceholder:function(e){var t=e.className;return Object(u.createElement)(v.Placeholder,{className:t},Object(h.__)("Block rendered as empty.")+t)},ErrorResponsePlaceholder:function(e){var t=e.response,n=e.className,r=Object(h.sprintf)(Object(h.__)("Error loading block: %s"),t.errorMsg);return Object(u.createElement)(v.Placeholder,{className:n},r)},LoadingResponsePlaceholder:function(e){var t=e.className;return Object(u.createElement)(v.Placeholder,{className:t},Object(u.createElement)(v.Spinner,null))}};var g=w,S={},P=Object(i.withSelect)((function(e){var t=e("core/editor");if(t){var n=t.getCurrentPostId();if(n)return{currentPostId:n}}return S}))((function(e){var t=e.urlQueryArgs,n=void 0===t?S:t,i=e.currentPostId,s=Object(c.a)(e,["urlQueryArgs","currentPostId"]),a=Object(u.useMemo)((function(){return i?Object(o.a)({post_id:i},n):n}),[i,n]);return Object(u.createElement)(g,Object(r.a)({urlQueryArgs:a},s))}));window&&window.wp&&window.wp.components&&(window.wp.components.ServerSideRender=Object(u.forwardRef)((function(e,t){return a()("wp.components.ServerSideRender",{alternative:"wp.serverSideRender"}),Object(u.createElement)(P,Object(r.a)({},e,{ref:t}))})));t.default=P},34:function(e,t){!function(){e.exports=this.wp.deprecated}()},4:function(e,t){!function(){e.exports=this.wp.data}()},5:function(e,t,n){"use strict";function r(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}n.d(t,"a",(function(){return r}))},7:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var r=n(10);function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{},o=Object.keys(n);"function"==typeof Object.getOwnPropertySymbols&&(o=o.concat(Object.getOwnPropertySymbols(n).filter((function(e){return Object.getOwnPropertyDescriptor(n,e).enumerable})))),o.forEach((function(t){Object(r.a)(e,t,n[t])}))}return e}}}).default;