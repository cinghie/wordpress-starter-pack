this.wc=this.wc||{},this.wc.blocks=this.wc.blocks||{},this.wc.blocks["products-by-attribute"]=function(t){function e(e){for(var o,i,u=e[0],a=e[1],s=e[2],b=0,d=[];b<u.length;b++)i=u[b],Object.prototype.hasOwnProperty.call(n,i)&&n[i]&&d.push(n[i][0]),n[i]=0;for(o in a)Object.prototype.hasOwnProperty.call(a,o)&&(t[o]=a[o]);for(l&&l(e);d.length;)d.shift()();return c.push.apply(c,s||[]),r()}function r(){for(var t,e=0;e<c.length;e++){for(var r=c[e],o=!0,u=1;u<r.length;u++){var a=r[u];0!==n[a]&&(o=!1)}o&&(c.splice(e--,1),t=i(i.s=r[0]))}return t}var o={},n={16:0},c=[];function i(e){if(o[e])return o[e].exports;var r=o[e]={i:e,l:!1,exports:{}};return t[e].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.m=t,i.c=o,i.d=function(t,e,r){i.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},i.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},i.t=function(t,e){if(1&e&&(t=i(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(i.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)i.d(r,o,function(e){return t[e]}.bind(null,o));return r},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="";var u=window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[],a=u.push.bind(u);u.push=e,u=u.slice();for(var s=0;s<u.length;s++)e(u[s]);var l=a;return c.push([564,2,1,0]),r()}({0:function(t,e){!function(){t.exports=this.wp.element}()},1:function(t,e){!function(){t.exports=this.wp.i18n}()},12:function(t,e){!function(){t.exports=this.React}()},13:function(t,e){!function(){t.exports=this.moment}()},16:function(t,e){!function(){t.exports=this.wp.apiFetch}()},17:function(t,e){!function(){t.exports=this.wp.editor}()},18:function(t,e){!function(){t.exports=this.wp.url}()},20:function(t,e){!function(){t.exports=this.wp.compose}()},22:function(t,e){!function(){t.exports=this.wp.blocks}()},3:function(t,e){!function(){t.exports=this.wp.components}()},32:function(t,e){!function(){t.exports=this.wp.keycodes}()},36:function(t,e,r){"use strict";var o=r(19),n=r.n(o),c=r(0),i=r(1),u=(r(2),r(3));function a(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,o)}return r}function s(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?a(r,!0).forEach((function(e){n()(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):a(r).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}e.a=function(t){var e=t.onChange,r=t.settings,o=r.button,n=r.price,a=r.rating,l=r.title;return Object(c.createElement)(c.Fragment,null,Object(c.createElement)(u.ToggleControl,{label:Object(i.__)("Product title","woo-gutenberg-products-block"),help:l?Object(i.__)("Product title is visible.","woo-gutenberg-products-block"):Object(i.__)("Product title is hidden.","woo-gutenberg-products-block"),checked:l,onChange:function(){return e(s({},r,{title:!l}))}}),Object(c.createElement)(u.ToggleControl,{label:Object(i.__)("Product price","woo-gutenberg-products-block"),help:n?Object(i.__)("Product price is visible.","woo-gutenberg-products-block"):Object(i.__)("Product price is hidden.","woo-gutenberg-products-block"),checked:n,onChange:function(){return e(s({},r,{price:!n}))}}),Object(c.createElement)(u.ToggleControl,{label:Object(i.__)("Product rating","woo-gutenberg-products-block"),help:a?Object(i.__)("Product rating is visible.","woo-gutenberg-products-block"):Object(i.__)("Product rating is hidden.","woo-gutenberg-products-block"),checked:a,onChange:function(){return e(s({},r,{rating:!a}))}}),Object(c.createElement)(u.ToggleControl,{label:Object(i.__)("Add to Cart button","woo-gutenberg-products-block"),help:o?Object(i.__)("Add to Cart button is visible.","woo-gutenberg-products-block"):Object(i.__)("Add to Cart button is hidden.","woo-gutenberg-products-block"),checked:o,onChange:function(){return e(s({},r,{button:!o}))}}))}},4:function(t,e){!function(){t.exports=this.lodash}()},43:function(t,e){!function(){t.exports=this.ReactDOM}()},44:function(t,e,r){"use strict";var o=r(0),n=r(1),c=r(4),i=(r(2),r(3)),u=r(5);e.a=function(t){var e=t.columns,r=t.rows,a=t.setAttributes,s=t.alignButtons;return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(i.RangeControl,{label:Object(n.__)("Columns","woo-gutenberg-products-block"),value:e,onChange:function(t){var e=Object(c.clamp)(t,u.MIN_COLUMNS,u.MAX_COLUMNS);a({columns:Object(c.isNaN)(e)?"":e})},min:u.MIN_COLUMNS,max:u.MAX_COLUMNS}),Object(o.createElement)(i.RangeControl,{label:Object(n.__)("Rows","woo-gutenberg-products-block"),value:r,onChange:function(t){var e=Object(c.clamp)(t,u.MIN_ROWS,u.MAX_ROWS);a({rows:Object(c.isNaN)(e)?"":e})},min:u.MIN_ROWS,max:u.MAX_ROWS}),Object(o.createElement)(i.ToggleControl,{label:Object(n.__)("Align Add to Cart buttons","woo-gutenberg-products-block"),help:s?Object(n.__)("Buttons are aligned vertically.","woo-gutenberg-products-block"):Object(n.__)("Buttons follow content.","woo-gutenberg-products-block"),checked:s,onChange:function(){return a({alignButtons:!s})}}))}},45:function(t,e,r){"use strict";var o=r(0),n=r(6),c=r.n(n),i=r(56),u=r.n(i),a=r(5);r.d(e,"a",(function(){return s}));var s=function(t){return function(e){var r=e.attributes,n=r.align,i=r.contentVisibility,s=c()(n?"align".concat(n):"",{"is-hidden-title":!i.title,"is-hidden-price":!i.price,"is-hidden-rating":!i.rating,"is-hidden-button":!i.button});return Object(o.createElement)(o.RawHTML,{className:s},function(t,e){var r=t.attributes,o=r.attributes,n=r.attrOperator,c=r.categories,i=r.catOperator,s=r.orderby,l=r.products,b=r.columns||a.DEFAULT_COLUMNS,d=r.rows||a.DEFAULT_ROWS,p=new Map;switch(p.set("limit",d*b),p.set("columns",b),c&&c.length&&(p.set("category",c.join(",")),i&&"all"===i&&p.set("cat_operator","AND")),o&&o.length&&(p.set("terms",o.map((function(t){return t.id})).join(",")),p.set("attribute",o[0].attr_slug),n&&"all"===n&&p.set("terms_operator","AND")),s&&("price_desc"===s?(p.set("orderby","price"),p.set("order","DESC")):"price_asc"===s?(p.set("orderby","price"),p.set("order","ASC")):"date"===s?(p.set("orderby","date"),p.set("order","DESC")):p.set("orderby",s)),e){case"woocommerce/product-best-sellers":p.set("best_selling","1");break;case"woocommerce/product-top-rated":p.set("orderby","rating");break;case"woocommerce/product-on-sale":p.set("on_sale","1");break;case"woocommerce/product-new":p.set("orderby","date"),p.set("order","DESC");break;case"woocommerce/handpicked-products":if(!l.length)return"";p.set("ids",l.join(",")),p.set("limit",l.length);break;case"woocommerce/product-category":if(!c||!c.length)return"";break;case"woocommerce/products-by-attribute":if(!o||!o.length)return""}var g="[products",f=!0,m=!1,O=void 0;try{for(var h,_=p[Symbol.iterator]();!(f=(h=_.next()).done);f=!0){var j=u()(h.value,2);g+=" "+j[0]+'="'+j[1]+'"'}}catch(t){m=!0,O=t}finally{try{f||null==_.return||_.return()}finally{if(m)throw O}}return g+="]"}(e,t))}}},46:function(t,e){!function(){t.exports=this.wp.viewport}()},5:function(t,e){!function(){t.exports=this.wc["wc-block-settings"]}()},50:function(t,e){!function(){t.exports=this.wp.hooks}()},52:function(t,e){!function(){t.exports=this.wp.htmlEntities}()},53:function(t,e){!function(){t.exports=this.wp.date}()},536:function(t,e,r){var o=r(537);"string"==typeof o&&(o=[[t.i,o,""]]);var n={insert:"head",singleton:!1};r(34)(o,n);o.locals&&(t.exports=o.locals)},537:function(t,e,r){},55:function(t,e,r){"use strict";var o=r(0),n=r(1),c=r(3);r(2);e.a=function(t){var e=t.value,r=t.setAttributes;return Object(o.createElement)(c.SelectControl,{label:Object(n.__)("Order products by","woo-gutenberg-products-block"),value:e,options:[{label:Object(n.__)("Newness - newest first","woo-gutenberg-products-block"),value:"date"},{label:Object(n.__)("Price - low to high","woo-gutenberg-products-block"),value:"price_asc"},{label:Object(n.__)("Price - high to low","woo-gutenberg-products-block"),value:"price_desc"},{label:Object(n.__)("Rating - highest first","woo-gutenberg-products-block"),value:"rating"},{label:Object(n.__)("Sales - most first","woo-gutenberg-products-block"),value:"popularity"},{label:Object(n.__)("Title - alphabetical","woo-gutenberg-products-block"),value:"title"},{label:Object(n.__)("Menu Order","woo-gutenberg-products-block"),value:"menu_order"}],onChange:function(t){return r({orderby:t})}})}},564:function(t,e,r){"use strict";r.r(e);var o=r(0),n=r(1),c=r(27),i=r.n(c),u=r(22),a=r(5),s=(r(536),r(7)),l=r.n(s),b=r(8),d=r.n(b),p=r(9),g=r.n(p),f=r(10),m=r.n(f),O=r(11),h=r.n(O),_=r(17),j=r(3),y=(r(2),r(36)),w=r(44),v=r(60),k=r.n(v),E=r(15),C=r.n(E),S=r(19),P=r.n(S),A=r(14),M=r.n(A),N=r(18),x=r(16),D=r.n(x),L=r(4),T=r(25);r(538);function B(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,o)}return r}function I(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?B(r,!0).forEach((function(e){P()(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):B(r).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}var R=function(t){function e(){var t;return l()(this,e),(t=g()(this,m()(e).apply(this,arguments))).state={list:[],loading:!0,attribute:0,termsList:{},termsLoading:!0},t.debouncedGetTerms=Object(L.debounce)(t.getTerms.bind(M()(t)),200),t.renderItem=t.renderItem.bind(M()(t)),t.onSelectAttribute=t.onSelectAttribute.bind(M()(t)),t}return h()(e,t),d()(e,[{key:"componentDidMount",value:function(){var t=this,e=this.props.selected;D()({path:Object(N.addQueryArgs)("".concat(a.ENDPOINTS.products,"/attributes"),{per_page:-1})}).then((function(r){r=r.map((function(t){return I({},t,{parent:0})})),t.setState((function(t){var o=t.attribute;if(!o&&e.length>0){var n=Object(L.find)(r,{slug:e[0].attr_slug});o=n?n.id:0}return{list:r,attribute:o,loading:!1}}))})).catch((function(){t.setState({list:[],loading:!1})}))}},{key:"componentWillUnmount",value:function(){this.debouncedGetTerms.cancel()}},{key:"componentDidUpdate",value:function(t,e){e.attribute!==this.state.attribute&&this.debouncedGetTerms()}},{key:"getTerms",value:function(){var t=this,e=this.state,r=e.attribute,o=e.termsList;r&&(o[r]||this.setState({termsLoading:!0}),D()({path:Object(N.addQueryArgs)("".concat(a.ENDPOINTS.products,"/attributes/").concat(r,"/terms"),{per_page:-1})}).then((function(e){e=e.map((function(t){return I({},t,{parent:r,attr_slug:t.attribute.slug})})),t.setState((function(t){return{termsList:I({},t.termsList,P()({},r,e)),termsLoading:!1}}))})).catch((function(){t.setState({termsLoading:!1})})))}},{key:"onSelectAttribute",value:function(t){var e=this;return function(){e.props.onChange([]),e.setState({attribute:t.id===e.state.attribute?0:t.id})}}},{key:"renderItem",value:function(t){var e=t.item,r=t.search,c=t.depth,i=void 0===c?0:c,u=this.state,a=u.attribute,s=u.termsLoading,l=["woocommerce-product-attributes__item","woocommerce-search-list__item"];return r.length&&l.push("is-searching"),0===i&&0!==e.parent&&l.push("is-skip-level"),e.breadcrumbs.length?Object(o.createElement)(T.b,C()({className:l.join(" ")},t,{showCount:!0,"aria-label":"".concat(e.breadcrumbs[0],": ").concat(e.name)})):[Object(o.createElement)(T.b,C()({key:"attr-".concat(e.id)},t,{className:l.join(" "),isSelected:a===e.id,onSelect:this.onSelectAttribute,isSingle:!0,disabled:"0"===e.count,"aria-expanded":a===e.id,"aria-label":Object(n.sprintf)(Object(n._n)("%s, has %d term","%s, has %d terms",e.count,"woo-gutenberg-products-block"),e.name,e.count)})),a===e.id&&s&&Object(o.createElement)("div",{key:"loading",className:"woocommerce-search-list__item woocommerce-product-attributes__itemdepth-1 is-loading is-not-active"},Object(o.createElement)(j.Spinner,null))]}},{key:"render",value:function(){var t=this.state,e=t.attribute,r=t.list,c=t.loading,i=t.termsList,u=this.props,a=u.onChange,s=u.onOperatorChange,l=u.operator,b=u.selected,d=i[e]||[],p=[].concat(k()(r),k()(d)),g={clear:Object(n.__)("Clear all product attributes","woo-gutenberg-products-block"),list:Object(n.__)("Product Attributes","woo-gutenberg-products-block"),noItems:Object(n.__)("Your store doesn't have any product attributes.","woo-gutenberg-products-block"),search:Object(n.__)("Search for product attributes","woo-gutenberg-products-block"),selected:function(t){return Object(n.sprintf)(Object(n._n)("%d attribute selected","%d attributes selected",t,"woo-gutenberg-products-block"),t)},updated:Object(n.__)("Product attribute search results updated.","woo-gutenberg-products-block")};return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(T.a,{className:"woocommerce-product-attributes",list:p,isLoading:c,selected:b.map((function(t){var e=t.id;return Object(L.find)(p,{id:e})})).filter(Boolean),onChange:a,renderItem:this.renderItem,messages:g,isHierarchical:!0}),!!s&&Object(o.createElement)("div",{className:b.length<2?"screen-reader-text":""},Object(o.createElement)(j.SelectControl,{className:"woocommerce-product-attributes__operator",label:Object(n.__)("Display products matching","woo-gutenberg-products-block"),help:Object(n.__)("Pick at least two attributes to use this setting.","woo-gutenberg-products-block"),value:l,onChange:s,options:[{label:Object(n.__)("Any selected attributes","woo-gutenberg-products-block"),value:"any"},{label:Object(n.__)("All selected attributes","woo-gutenberg-products-block"),value:"all"}]})))}}]),e}(o.Component);R.defaultProps={operator:"any"};var U=R,F=r(55),W=function(t){function e(){return l()(this,e),g()(this,m()(e).apply(this,arguments))}return h()(e,t),d()(e,[{key:"getInspectorControls",value:function(){var t=this.props.setAttributes,e=this.props.attributes,r=e.attributes,c=e.attrOperator,i=e.columns,u=e.contentVisibility,a=e.orderby,s=e.rows,l=e.alignButtons;return Object(o.createElement)(_.InspectorControls,{key:"inspector"},Object(o.createElement)(j.PanelBody,{title:Object(n.__)("Layout","woo-gutenberg-products-block"),initialOpen:!0},Object(o.createElement)(w.a,{columns:i,rows:s,alignButtons:l,setAttributes:t})),Object(o.createElement)(j.PanelBody,{title:Object(n.__)("Content","woo-gutenberg-products-block"),initialOpen:!0},Object(o.createElement)(y.a,{settings:u,onChange:function(e){return t({contentVisibility:e})}})),Object(o.createElement)(j.PanelBody,{title:Object(n.__)("Filter by Product Attribute","woo-gutenberg-products-block"),initialOpen:!1},Object(o.createElement)(U,{selected:r,onChange:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[],r=e.map((function(t){return{id:t.id,attr_slug:t.attr_slug}}));t({attributes:r})},operator:c,onOperatorChange:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"any";return t({attrOperator:e})}})),Object(o.createElement)(j.PanelBody,{title:Object(n.__)("Order By","woo-gutenberg-products-block"),initialOpen:!1},Object(o.createElement)(F.a,{setAttributes:t,value:a})))}},{key:"renderEditMode",value:function(){var t=this.props,e=t.debouncedSpeak,r=t.setAttributes,c=this.props.attributes;return Object(o.createElement)(j.Placeholder,{icon:Object(o.createElement)(i.a,{icon:"custom-post-type"}),label:Object(n.__)("Products by Attribute","woo-gutenberg-products-block"),className:"wc-block-products-grid wc-block-products-by-attribute"},Object(n.__)("Display a grid of products from your selected attributes.","woo-gutenberg-products-block"),Object(o.createElement)("div",{className:"wc-block-products-by-attribute__selection"},Object(o.createElement)(U,{selected:c.attributes,onChange:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[],e=t.map((function(t){return{id:t.id,attr_slug:t.attr_slug}}));r({attributes:e})},operator:c.attrOperator,onOperatorChange:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"any";return r({attrOperator:t})}}),Object(o.createElement)(j.Button,{isDefault:!0,onClick:function(){r({editMode:!1}),e(Object(n.__)("Showing Products by Attribute block preview.","woo-gutenberg-products-block"))}},Object(n.__)("Done","woo-gutenberg-products-block"))))}},{key:"render",value:function(){var t=this.props,e=t.attributes,r=t.name,c=t.setAttributes,i=e.editMode;return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(_.BlockControls,null,Object(o.createElement)(j.Toolbar,{controls:[{icon:"edit",title:Object(n.__)("Edit"),onClick:function(){return c({editMode:!i})},isActive:i}]})),this.getInspectorControls(),i?this.renderEditMode():Object(o.createElement)(j.Disabled,null,Object(o.createElement)(_.ServerSideRender,{block:r,attributes:e})))}}]),e}(o.Component),V=Object(j.withSpokenMessages)(W),X=r(45);Object(u.registerBlockType)("woocommerce/products-by-attribute",{title:Object(n.__)("Products by Attribute","woo-gutenberg-products-block"),icon:{src:Object(o.createElement)(i.a,{icon:"custom-post-type"}),foreground:"#96588a"},category:"woocommerce",keywords:[Object(n.__)("WooCommerce","woo-gutenberg-products-block")],description:Object(n.__)("Display a grid of products from your selected attributes.","woo-gutenberg-products-block"),supports:{align:["wide","full"],html:!1},attributes:{attributes:{type:"array",default:[]},attrOperator:{type:"string",default:"any"},columns:{type:"number",default:a.DEFAULT_COLUMNS},editMode:{type:"boolean",default:!0},contentVisibility:{type:"object",default:{title:!0,price:!0,rating:!0,button:!0}},orderby:{type:"string",default:"date"},rows:{type:"number",default:a.DEFAULT_ROWS},alignButtons:{type:"boolean",default:!1}},deprecated:[{attributes:{attributes:{type:"array",default:[]},attrOperator:{type:"string",default:"any"},columns:{type:"number",default:a.DEFAULT_COLUMNS},editMode:{type:"boolean",default:!0},contentVisibility:{type:"object",default:{title:!0,price:!0,rating:!0,button:!0}},orderby:{type:"string",default:"date"},rows:{type:"number",default:a.DEFAULT_ROWS}},save:Object(X.a)("woocommerce/products-by-attribute")}],edit:function(t){return Object(o.createElement)(V,t)},save:function(){return null}})},59:function(t,e){!function(){t.exports=this.wp.dom}()},62:function(t,e){},63:function(t,e){},64:function(t,e){},66:function(t,e){},67:function(t,e){}});