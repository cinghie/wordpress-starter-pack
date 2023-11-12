(()=>{var e,t={4534:(e,t,o)=>{"use strict";o.r(t);const r=window.wp.hooks,c=window.wc.wcSettings;var n=o(9196);const a=window.wp.components;var l=o(5736),s=o(1984),i=o(229);const u=(0,l.__)("Product Title","woo-gutenberg-products-block"),m=((0,n.createElement)(s.Z,{icon:i.Z,className:"wc-block-editor-components-block-icon"}),(0,l.__)("Display the title of a product.","woo-gutenberg-products-block")),d=window.wp.blocks;function p(e,{blockDescription:t,blockIcon:o,blockTitle:r,variationName:c,scope:n}){(0,d.registerBlockVariation)(e,{description:t,name:c,title:r,isActive:e=>e.__woocommerceNamespace===c,icon:{src:o},attributes:{__woocommerceNamespace:c},scope:n})}const b="core/post-title",g="woocommerce/product-query/product-title";p(b,{blockDescription:m,blockIcon:(0,n.createElement)(a.Icon,{icon:i.Z}),blockTitle:u,variationName:g,scope:["block"]});var _=o(897);const w=(0,l.__)("Product Summary","woo-gutenberg-products-block"),k=((0,n.createElement)(s.Z,{icon:_.Z,className:"wc-block-editor-components-block-icon"}),"core/post-excerpt");p(k,{blockDescription:(0,l.__)("Display a short description about a product.","woo-gutenberg-products-block"),blockIcon:(0,n.createElement)(a.Icon,{icon:_.Z}),blockTitle:w,variationName:"woocommerce/product-query/product-summary",scope:["block"]});var h=o(5332);const y="core/post-template",f="woocommerce/product-query/product-template";p(y,{blockDescription:(0,l.__)("Contains the block elements used to render a product, like its name, featured image, rating, and more.","woo-gutenberg-products-block"),blockIcon:(0,n.createElement)(a.Icon,{icon:h.Z}),blockTitle:(0,l.__)("Product template","woo-gutenberg-products-block"),variationName:f,scope:["block","inserter"]});const E=window.wp.blockEditor,v=window.wp.data;var S=o(7286),C=o(6755),N=o(9307);o(4662);const x=({text:e,title:t=(0,l.__)("Feedback?","woo-gutenberg-products-block"),url:o="https://ideas.woocommerce.com/forums/133476-woocommerce?category_id=384565"})=>{const[r,c]=(0,N.useState)(!1);return(0,N.useEffect)((()=>{c(!0)}),[]),(0,n.createElement)(n.Fragment,null,r&&(0,n.createElement)("div",{className:"wc-block-feedback-prompt"},(0,n.createElement)(s.Z,{icon:S.Z}),(0,n.createElement)("h2",{className:"wc-block-feedback-prompt__title"},t),(0,n.createElement)("p",{className:"wc-block-feedback-prompt__text"},e),(0,n.createElement)("a",{href:o,className:"wc-block-feedback-prompt__link",rel:"noreferrer noopener",target:"_blank"},(0,l.__)("Give us your feedback.","woo-gutenberg-products-block"),(0,n.createElement)(s.Z,{icon:C.Z,size:16}))))},I=()=>(0,n.createElement)(x,{text:(0,l.__)("Thanks for trying out the Products block! Help us make it better by sharing your feedback.","woo-gutenberg-products-block"),title:(0,l.__)("Share your feedback!","woo-gutenberg-products-block"),url:"https://airtable.com/shrFX5FAqmCY6hVYI"}),P=e=>"number"==typeof e,O=e=>"boolean"==typeof e,B=e=>"core/query"===e.name&&"woocommerce/product-query"===e.attributes.namespace,A=(e,t)=>{let o=[];return e.forEach((e=>{t(e)&&(o=[...o,e.clientId]),o=[...o,...A(e.innerBlocks,t)]})),o},T=(0,c.getSettingWithCoercion)("postTemplateHasSupportForGridView",!1,O);function L(e,t){const{[t]:o,...r}=e;return r}let q=function(e){return e.GRID="flex",e.STACK="list",e}({});const R=(0,c.getSetting)("stockStatusOptions",[]),j=(0,c.getSetting)("hideOutOfStockItems",!1),F=()=>j?Object.keys(L(R,"outofstock")):Object.keys(R),$={query:{perPage:9,pages:0,offset:0,postType:"product",order:"asc",orderBy:"title",search:"",exclude:[],inherit:null,taxQuery:{},isProductCollectionBlock:!0,woocommerceOnSale:!1,woocommerceStockStatus:F(),woocommerceAttributes:[],woocommerceHandPickedProducts:[]},tagName:"div",displayLayout:{type:q.GRID,columns:3,shrinkColumns:!1}},V=(F(),({name:e,attributes:t})=>"core/post-template"===e&&"woocommerce/product-query/product-template"===t.__woocommerceNamespace),G=e=>"grid"===e?q.GRID:"default"===e?q.STACK:q.GRID,D=e=>e.map((e=>{const{name:t,attributes:o}=e,r=D(e.innerBlocks);return V(e)?((e,t)=>{const{__woocommerceNamespace:o,className:r,layout:c,...n}=e.attributes;return(0,d.createBlock)("woocommerce/product-template",n,t)})(e,r):(({name:e,attributes:t})=>"core/post-title"===e&&"woocommerce/product-query/product-title"===t.__woocommerceNamespace)(e)?((e,t)=>{const{__woocommerceNamespace:o,...r}=e.attributes;return(0,d.createBlock)("core/post-title",{__woocommerceNamespace:"woocommerce/product-collection/product-title",...r},t)})(e,r):(({name:e,attributes:t})=>"core/post-excerpt"===e&&"woocommerce/product-query/product-summary"===t.__woocommerceNamespace)(e)?((e,t)=>{const{__woocommerceNamespace:o,...r}=e.attributes;return(0,d.createBlock)("core/post-excerpt",{__woocommerceNamespace:"woocommerce/product-collection/product-summary",...r},t)})(e,r):(0,d.createBlock)(t,o,r)})),Z=e=>{const t=(0,v.select)("core/block-editor").getBlock(e),o=((e,t)=>{const o=(0,v.select)("core/block-editor").getBlockRootClientId(e)||void 0;return(0,v.select)("core/block-editor").canInsertBlockType("woocommerce/product-collection",o)})(e);if(t&&o){const{attributes:o={},innerBlocks:r=[]}=t,c=((e,t)=>{const o=t.find(V),{layout:r}=(null==o?void 0:o.attributes)||{};return T?(e=>{if(void 0===e)return $.displayLayout;const{type:t,columnCount:o}=e;return{type:G(t),columns:o}})(r):e.displayLayout})(o,r),n=(e=>{const{query:t,namespace:o,...r}=e,{__woocommerceAttributes:c,__woocommerceStockStatus:n,__woocommerceOnSale:a,include:l,...s}=t;return{...r,query:{woocommerceAttributes:c,woocommerceStockStatus:n,woocommerceOnSale:a,woocommerceHandPickedProducts:l,taxQuery:{},isProductCollectionBlock:!0,...s},convertedFromProducts:!0}})({...o,displayLayout:c}),a=D(r),l=(0,d.createBlock)("woocommerce/product-collection",n,a);return(0,v.dispatch)("core/block-editor").replaceBlock(e,l),!0}return!1},M=()=>{var e;e={status:"notseen",time:Date.now(),displayCount:0},window.localStorage.setItem("wc-blocks_upgraded-products-to-product-collection",JSON.stringify(e)),(()=>{if(0===(0,v.select)("core/block-editor").getGlobalBlockCount("core/query"))return;const e=(t=(0,v.select)("core/block-editor").getBlocks(),A(t,B));var t;0!==e.length&&(e=>{const t=e.map(Z);t.length&&t.every((e=>!!e))})(e)})()},H=e=>!(e=>null===e)(e)&&e instanceof Object&&e.constructor===Object;function U(e,t){return H(e)&&t in e}const z=e=>{if(H(e)){const t=e.getEditedPostType();return"wp_template"===t||"wp_template_part"===t}return!1};let W=function(e){return e.SINGLE="single",e.THUMBNAIL="thumbnail",e}({});const Q="woocommerce/product-query",Y="core/query",J=["attributes","presets","productSelector","onSale","stockStatus","wooInherit"],K=["taxQuery","search",...J],X=(0,c.getSetting)("stockStatusOptions",[]),ee=(0,c.getSetting)("hideOutOfStockItems",!1),te={allowedControls:K,displayLayout:{type:"flex",columns:3},query:{perPage:9,pages:0,offset:0,postType:"product",order:"asc",orderBy:"title",author:"",search:"",exclude:[],sticky:"",inherit:!1,__woocommerceAttributes:[],__woocommerceStockStatus:ee?Object.keys(L(X,"outofstock")):Object.keys(X)}},oe=[["core/post-template",{__woocommerceNamespace:f,className:"products-block-post-template",...(0,c.getSettingWithCoercion)("postTemplateHasSupportForGridView",!1,O)&&{layout:{type:"grid",columnCount:3}}},[["woocommerce/product-image",{imageSizing:W.THUMBNAIL}],["core/post-title",{textAlign:"center",level:3,fontSize:"medium",style:{spacing:{margin:{bottom:"0.75rem",top:"0"}}},isLink:!0,__woocommerceNamespace:g}],["woocommerce/product-price",{textAlign:"center",fontSize:"small"}],["woocommerce/product-button",{textAlign:"center",fontSize:"small"}]]],["core/query-pagination",{layout:{type:"flex",justifyContent:"center"}}],["core/query-no-results"]];let re=function(e){return e.PRODUCT_QUERY="woocommerce/product-query",e.RELATED_PRODUCTS="woocommerce/related-products",e}({});function ce(e,t){const{query:o}=e.attributes;e.setAttributes({query:{...o,...t}})}var ne=o(4184),ae=o.n(ne);function le(e,t,o){const r=new Set(t.map((e=>e[o])));return e.filter((e=>!r.has(e[o])))}const se=window.wp.htmlEntities,ie={clear:(0,l.__)("Clear all selected items","woo-gutenberg-products-block"),noItems:(0,l.__)("No items found.","woo-gutenberg-products-block"),
/* Translators: %s search term */
noResults:(0,l.__)("No results for %s","woo-gutenberg-products-block"),search:(0,l.__)("Search for items","woo-gutenberg-products-block"),selected:e=>(0,l.sprintf)(/* translators: Number of items selected from list. */
(0,l._n)("%d item selected","%d items selected",e,"woo-gutenberg-products-block"),e),updated:(0,l.__)("Search results updated.","woo-gutenberg-products-block")},ue=(e,t=e)=>{const o=e.reduce(((e,t)=>{const o=t.parent||0;return e[o]||(e[o]=[]),e[o].push(t),e}),{}),r=("id",t.reduce(((e,t)=>(e[String(t.id)]=t,e)),{}));const c=["0"],n=(e={})=>e.parent?[...n(r[e.parent]),e.name]:e.name?[e.name]:[],a=e=>e.map((e=>{const t=o[e.id];return c.push(""+e.id),{...e,breadcrumbs:n(r[e.parent]),children:t&&t.length?a(t):[]}})),l=a(o[0]||[]);return Object.entries(o).forEach((([e,t])=>{c.includes(e)||l.push(...a(t||[]))})),l},me=(e,t)=>{if(!t)return e;const o=new RegExp(`(${t.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&")})`,"ig");return e.split(o).map(((e,t)=>o.test(e)?(0,n.createElement)("strong",{key:t},e):(0,n.createElement)(N.Fragment,{key:t},e)))},de=({label:e})=>(0,n.createElement)("span",{className:"woocommerce-search-list__item-count"},e),pe=e=>{const{item:t,search:o}=e,r=t.breadcrumbs&&t.breadcrumbs.length;return(0,n.createElement)("span",{className:"woocommerce-search-list__item-label"},r?(0,n.createElement)("span",{className:"woocommerce-search-list__item-prefix"},1===(c=t.breadcrumbs).length?c.slice(0,1).toString():2===c.length?c.slice(0,1).toString()+" › "+c.slice(-1).toString():c.slice(0,1).toString()+" … "+c.slice(-1).toString()):null,(0,n.createElement)("span",{className:"woocommerce-search-list__item-name"},me((0,se.decodeEntities)(t.name),o)));var c},be=({countLabel:e,className:t,depth:o=0,controlId:r="",item:c,isSelected:l,isSingle:s,onSelect:i,search:u="",selected:m,useExpandedPanelId:d,...p})=>{var b,g;const[_,w]=d,k=null!=e&&void 0!==c.count&&null!==c.count,h=!(null===(b=c.breadcrumbs)||void 0===b||!b.length),y=!(null===(g=c.children)||void 0===g||!g.length),f=_===c.id,E=ae()(["woocommerce-search-list__item",`depth-${o}`,t],{"has-breadcrumbs":h,"has-children":y,"has-count":k,"is-expanded":f,"is-radio-button":s}),v=p.name||`search-list-item-${r}`,S=`${v}-${c.id}`,C=(0,N.useCallback)((()=>{w(f?-1:Number(c.id))}),[f,c.id,w]);return y?(0,n.createElement)("div",{className:E,onClick:C,onKeyDown:e=>"Enter"===e.key||" "===e.key?C():null,role:"treeitem",tabIndex:0},s?(0,n.createElement)(n.Fragment,null,(0,n.createElement)("input",{type:"radio",id:S,name:v,value:c.value,onChange:i(c),onClick:e=>e.stopPropagation(),checked:l,className:"woocommerce-search-list__item-input",...p}),(0,n.createElement)(pe,{item:c,search:u}),k?(0,n.createElement)(de,{label:e||c.count}):null):(0,n.createElement)(n.Fragment,null,(0,n.createElement)(a.CheckboxControl,{className:"woocommerce-search-list__item-input",checked:l,...!l&&c.children.some((e=>m.find((t=>t.id===e.id))))?{indeterminate:!0}:{},label:me((0,se.decodeEntities)(c.name),u),onChange:()=>{l?i(le(m,c.children,"id"))():i(function(e,t,o){const r=le(t,e,"id");return[...e,...r]}(m,c.children))()},onClick:e=>e.stopPropagation()}),k?(0,n.createElement)(de,{label:e||c.count}):null)):(0,n.createElement)("label",{htmlFor:S,className:E},s?(0,n.createElement)(n.Fragment,null,(0,n.createElement)("input",{...p,type:"radio",id:S,name:v,value:c.value,onChange:i(c),checked:l,className:"woocommerce-search-list__item-input"}),(0,n.createElement)(pe,{item:c,search:u})):(0,n.createElement)(a.CheckboxControl,{...p,id:S,name:v,className:"woocommerce-search-list__item-input",value:(0,se.decodeEntities)(c.value),label:me((0,se.decodeEntities)(c.name),u),onChange:i(c),checked:l}),k?(0,n.createElement)(de,{label:e||c.count}):null)},ge=be;var _e=o(5430),we=o(4333),ke=o(906);o(5932);const he=({id:e,label:t,popoverContents:o,remove:r,screenReaderLabel:c,className:i=""})=>{const[u,m]=(0,N.useState)(!1),d=(0,we.useInstanceId)(he);if(c=c||t,!t)return null;t=(0,se.decodeEntities)(t);const p=ae()("woocommerce-tag",i,{"has-remove":!!r}),b=`woocommerce-tag__label-${d}`,g=(0,n.createElement)(n.Fragment,null,(0,n.createElement)("span",{className:"screen-reader-text"},c),(0,n.createElement)("span",{"aria-hidden":"true"},t));return(0,n.createElement)("span",{className:p},o?(0,n.createElement)(a.Button,{className:"woocommerce-tag__text",id:b,onClick:()=>m(!0)},g):(0,n.createElement)("span",{className:"woocommerce-tag__text",id:b},g),o&&u&&(0,n.createElement)(a.Popover,{onClose:()=>m(!1)},o),r&&(0,n.createElement)(a.Button,{className:"woocommerce-tag__remove",onClick:r(e),label:(0,l.sprintf)(
// Translators: %s label.
(0,l.__)("Remove %s","woo-gutenberg-products-block"),t),"aria-describedby":b},(0,n.createElement)(s.Z,{icon:ke.Z,size:20,className:"clear-icon"})))},ye=he;o(8462);const fe=e=>(0,n.createElement)(ge,{...e}),Ee=e=>{const{list:t,selected:o,renderItem:r,depth:c=0,onSelect:a,instanceId:l,isSingle:s,search:i,useExpandedPanelId:u}=e,[m]=u;return t?(0,n.createElement)(N.Fragment,null,t.map((t=>{var d,p;const b=null!==(d=t.children)&&void 0!==d&&d.length&&!s?t.children.every((({id:e})=>o.find((t=>t.id===e)))):!!o.find((({id:e})=>e===t.id)),g=(null===(p=t.children)||void 0===p?void 0:p.length)&&m===t.id;return(0,n.createElement)(N.Fragment,{key:t.id},(0,n.createElement)("li",null,r({item:t,isSelected:b,onSelect:a,isSingle:s,selected:o,search:i,depth:c,useExpandedPanelId:u,controlId:l})),g?(0,n.createElement)(Ee,{...e,list:t.children,depth:c+1}):null)}))):null},ve=({isLoading:e,isSingle:t,selected:o,messages:r,onChange:c,onRemove:s})=>{if(e||t||!o)return null;const i=o.length;return(0,n.createElement)("div",{className:"woocommerce-search-list__selected"},(0,n.createElement)("div",{className:"woocommerce-search-list__selected-header"},(0,n.createElement)("strong",null,r.selected(i)),i>0?(0,n.createElement)(a.Button,{isLink:!0,isDestructive:!0,onClick:()=>c([]),"aria-label":r.clear},(0,l.__)("Clear all","woo-gutenberg-products-block")):null),i>0?(0,n.createElement)("ul",null,o.map(((e,t)=>(0,n.createElement)("li",{key:t},(0,n.createElement)(ye,{label:e.name,id:e.id,remove:s}))))):null)},Se=({filteredList:e,search:t,onSelect:o,instanceId:r,useExpandedPanelId:c,...a})=>{const{messages:i,renderItem:u,selected:m,isSingle:d}=a,p=u||fe;return 0===e.length?(0,n.createElement)("div",{className:"woocommerce-search-list__list is-not-found"},(0,n.createElement)("span",{className:"woocommerce-search-list__not-found-icon"},(0,n.createElement)(s.Z,{icon:_e.Z})),(0,n.createElement)("span",{className:"woocommerce-search-list__not-found-text"},t?(0,l.sprintf)(i.noResults,t):i.noItems)):(0,n.createElement)("ul",{className:"woocommerce-search-list__list"},(0,n.createElement)(Ee,{useExpandedPanelId:c,list:e,selected:m,renderItem:p,onSelect:o,instanceId:r,isSingle:d,search:t}))},Ce=e=>{const{className:t="",isCompact:o,isHierarchical:r,isLoading:c,isSingle:s,list:i,messages:u=ie,onChange:m,onSearch:d,selected:p,type:b="text",debouncedSpeak:g}=e,[_,w]=(0,N.useState)(""),k=(0,N.useState)(-1),h=(0,we.useInstanceId)(Ce),y=(0,N.useMemo)((()=>({...ie,...u})),[u]),f=(0,N.useMemo)((()=>((e,t,o)=>{if(!t)return o?ue(e):e;const r=new RegExp(t.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"),"i"),c=e.map((e=>!!r.test(e.name)&&e)).filter(Boolean);return o?ue(c,e):c})(i,_,r)),[i,_,r]);(0,N.useEffect)((()=>{g&&g(y.updated)}),[g,y]),(0,N.useEffect)((()=>{"function"==typeof d&&d(_)}),[_,d]);const E=(0,N.useCallback)((e=>()=>{s&&m([]);const t=p.findIndex((({id:t})=>t===e));m([...p.slice(0,t),...p.slice(t+1)])}),[s,p,m]),v=(0,N.useCallback)((e=>()=>{Array.isArray(e)?m(e):-1===p.findIndex((({id:t})=>t===e.id))?m(s?[e]:[...p,e]):E(e.id)()}),[s,E,m,p]),S=(0,N.useCallback)((e=>{const[t]=p.filter((t=>!e.find((e=>t.id===e.id))));E(t.id)()}),[E,p]);return(0,n.createElement)("div",{className:ae()("woocommerce-search-list",t,{"is-compact":o,"is-loading":c,"is-token":"token"===b})},"text"===b&&(0,n.createElement)(ve,{...e,onRemove:E,messages:y}),(0,n.createElement)("div",{className:"woocommerce-search-list__search"},"text"===b?(0,n.createElement)(a.TextControl,{label:y.search,type:"search",value:_,onChange:e=>w(e)}):(0,n.createElement)(a.FormTokenField,{disabled:c,label:y.search,onChange:S,onInputChange:e=>w(e),suggestions:[],__experimentalValidateInput:()=>!1,value:c?[(0,l.__)("Loading…","woo-gutenberg-products-block")]:p.map((e=>({...e,value:e.name}))),__experimentalShowHowTo:!1})),c?(0,n.createElement)("div",{className:"woocommerce-search-list__list"},(0,n.createElement)(a.Spinner,null)):(0,n.createElement)(Se,{...e,search:_,filteredList:f,messages:y,onSelect:v,instanceId:h,useExpandedPanelId:k}))},Ne=((0,a.withSpokenMessages)(Ce),window.wp.url),xe=window.wp.apiFetch;var Ie,Pe,Oe,Be,Ae,Te,Le,qe,Re,je,Fe=o.n(xe);const $e=(0,c.getSetting)("wcBlocksConfig",{buildPhase:1,pluginUrl:"",productCount:0,defaultAvatar:"",restApiRoutes:{},wordCountType:"words"}),Ve=($e.pluginUrl,$e.pluginUrl,$e.buildPhase,null===(Ie=c.STORE_PAGES.shop)||void 0===Ie||Ie.permalink,null===(Pe=c.STORE_PAGES.checkout)||void 0===Pe||Pe.id,null===(Oe=c.STORE_PAGES.checkout)||void 0===Oe||Oe.permalink,null===(Be=c.STORE_PAGES.privacy)||void 0===Be||Be.permalink,null===(Ae=c.STORE_PAGES.privacy)||void 0===Ae||Ae.title,null===(Te=c.STORE_PAGES.terms)||void 0===Te||Te.permalink,null===(Le=c.STORE_PAGES.terms)||void 0===Le||Le.title,null===(qe=c.STORE_PAGES.cart)||void 0===qe||qe.id,null===(Re=c.STORE_PAGES.cart)||void 0===Re||Re.permalink,null!==(je=c.STORE_PAGES.myaccount)&&void 0!==je&&je.permalink?c.STORE_PAGES.myaccount.permalink:(0,c.getSetting)("wpLoginUrl","/wp-login.php"),(0,c.getSetting)("localPickupEnabled",!1),(0,c.getSetting)("countries",{})),Ge=(0,c.getSetting)("countryData",{}),De=(Object.fromEntries(Object.keys(Ge).filter((e=>!0===Ge[e].allowBilling)).map((e=>[e,Ve[e]||""]))),Object.fromEntries(Object.keys(Ge).filter((e=>!0===Ge[e].allowBilling)).map((e=>[e,Ge[e].states||[]]))),Object.fromEntries(Object.keys(Ge).filter((e=>!0===Ge[e].allowShipping)).map((e=>[e,Ve[e]||""]))),Object.fromEntries(Object.keys(Ge).filter((e=>!0===Ge[e].allowShipping)).map((e=>[e,Ge[e].states||[]]))),Object.fromEntries(Object.keys(Ge).map((e=>[e,Ge[e].locale||[]]))),(e,t)=>{const o=new Map;return e.filter((e=>{const r=t(e);return!o.has(r)&&(o.set(r,e),!0)}))}),Ze=e=>Fe()({path:`wc/store/v1/products/attributes/${e}/terms`});const Me=window.wp.escapeHtml,He=({error:e})=>(0,n.createElement)("div",{className:"wc-block-error-message"},(({message:e,type:t})=>e?"general"===t?(0,n.createElement)("span",null,(0,l.__)("The following error was returned","woo-gutenberg-products-block"),(0,n.createElement)("br",null),(0,n.createElement)("code",null,(0,Me.escapeHTML)(e))):"api"===t?(0,n.createElement)("span",null,(0,l.__)("The following error was returned from the API","woo-gutenberg-products-block"),(0,n.createElement)("br",null),(0,n.createElement)("code",null,(0,Me.escapeHTML)(e))):e:(0,l.__)("An error has prevented the block from being updated.","woo-gutenberg-products-block"))(e)),Ue=({className:e,item:t,isSelected:o,isLoading:r,onSelect:c,disabled:l,...s})=>(0,n.createElement)(n.Fragment,null,(0,n.createElement)(be,{...s,key:t.id,className:e,isSelected:o,item:t,onSelect:c,disabled:l}),o&&r&&(0,n.createElement)("div",{key:"loading",className:ae()("woocommerce-search-list__item","woocommerce-product-attributes__item","depth-1","is-loading","is-not-active")},(0,n.createElement)(a.Spinner,null))),ze=((0,c.getSetting)("attributes",[]).reduce(((e,t)=>{const o=(r=t)&&r.attribute_name?{id:parseInt(r.attribute_id,10),name:r.attribute_name,taxonomy:"pa_"+r.attribute_name,label:r.attribute_label}:null;var r;return o&&o.id&&e.push(o),e}),[]),e=>{const{count:t,id:o,name:r,parent:c}=e;return{count:t,id:o,name:r,parent:c,breadcrumbs:[],children:[],value:(n=e,U(n,"count")&&U(n,"description")&&U(n,"id")&&U(n,"name")&&U(n,"parent")&&U(n,"slug")&&"number"==typeof n.count&&"string"==typeof n.description&&"number"==typeof n.id&&"string"==typeof n.name&&"number"==typeof n.parent&&"string"==typeof n.slug?e.attr_slug:"")};var n});o(9669);const We=(0,we.withInstanceId)((({onChange:e,onOperatorChange:t,instanceId:o,isCompact:r=!1,messages:c={},operator:s="any",selected:i,type:u="text"})=>{const{errorLoadingAttributes:m,isLoadingAttributes:d,productsAttributes:p}=function(e){const[t,o]=(0,N.useState)(null),[r,c]=(0,N.useState)(!1),[n,a]=(0,N.useState)([]),l=(0,N.useRef)(!1);return(0,N.useEffect)((()=>{if(e&&!r&&!l.current)return async function(){c(!0);try{const e=await Fe()({path:"wc/store/v1/products/attributes"}),t=[];for(const o of e){const e=await Ze(o.id);t.push({...o,parent:0,terms:e.map((e=>({...e,attr_slug:o.taxonomy,parent:o.id})))})}a(t),l.current=!0}catch(e){e instanceof Error&&o(await(async e=>{if(!("json"in e))return{message:e.message,type:e.type||"general"};try{const t=await e.json();return{message:t.message,type:t.type||"api"}}catch(e){return{message:e.message,type:"general"}}})(e))}finally{c(!1)}}(),()=>{l.current=!0}}),[r,e]),{errorLoadingAttributes:t,isLoadingAttributes:r,productsAttributes:n}}(!0),b=p.reduce(((e,t)=>{const{terms:o,...r}=t;return[...e,ze(r),...o.map(ze)]}),[]);return c={clear:(0,l.__)("Clear all product attributes","woo-gutenberg-products-block"),noItems:(0,l.__)("Your store doesn't have any product attributes.","woo-gutenberg-products-block"),search:(0,l.__)("Search for product attributes","woo-gutenberg-products-block"),selected:e=>(0,l.sprintf)(/* translators: %d is the count of attributes selected. */
(0,l._n)("%d attribute selected","%d attributes selected",e,"woo-gutenberg-products-block"),e),updated:(0,l.__)("Product attribute search results updated.","woo-gutenberg-products-block"),...c},m?(0,n.createElement)(He,{error:m}):(0,n.createElement)(n.Fragment,null,(0,n.createElement)(Ce,{className:"woocommerce-product-attributes",isCompact:r,isHierarchical:!0,isLoading:d,isSingle:!1,list:b,messages:c,onChange:e,renderItem:e=>{const{item:t,search:r,depth:c=0}=e,a=t.count||0,s=["woocommerce-product-attributes__item","woocommerce-search-list__item",{"is-searching":r.length>0,"is-skip-level":0===c&&0!==t.parent}];if(!t.breadcrumbs.length)return(0,n.createElement)(Ue,{...e,className:ae()(s),item:t,isLoading:d,disabled:0===t.count,name:`attributes-${o}`,countLabel:(0,l.sprintf)(/* translators: %d is the count of terms. */
(0,l._n)("%d term","%d terms",a,"woo-gutenberg-products-block"),a),"aria-label":(0,l.sprintf)(/* translators: %1$s is the item name, %2$d is the count of terms for the item. */
(0,l._n)("%1$s, has %2$d term","%1$s, has %2$d terms",a,"woo-gutenberg-products-block"),t.name,a)});const i=`${t.breadcrumbs[0]}: ${t.name}`;return(0,n.createElement)(be,{...e,name:`terms-${o}`,className:ae()(...s,"has-count"),countLabel:(0,l.sprintf)(/* translators: %d is the count of products. */
(0,l._n)("%d product","%d products",a,"woo-gutenberg-products-block"),a),"aria-label":(0,l.sprintf)(/* translators: %1$s is the attribute name, %2$d is the count of products for that attribute. */
(0,l._n)("%1$s, has %2$d product","%1$s, has %2$d products",a,"woo-gutenberg-products-block"),i,a)})},selected:i.map((({id:e})=>b.find((t=>t.id===e)))).filter(Boolean),type:u}),!!t&&(0,n.createElement)("div",{hidden:i.length<2},(0,n.createElement)(a.SelectControl,{className:"woocommerce-product-attributes__operator",label:(0,l.__)("Display products matching","woo-gutenberg-products-block"),help:(0,l.__)("Pick at least two attributes to use this setting.","woo-gutenberg-products-block"),value:s,onChange:t,options:[{label:(0,l.__)("Any selected attributes","woo-gutenberg-products-block"),value:"any"},{label:(0,l.__)("All selected attributes","woo-gutenberg-products-block"),value:"all"}]})))})),Qe=[{key:"title/asc",name:(0,l.__)("Sorted by title","woo-gutenberg-products-block")},{key:"date/desc",name:(0,l.__)("Newest","woo-gutenberg-products-block")},{key:"popularity/desc",name:(0,l.__)("Best Selling","woo-gutenberg-products-block")},{key:"rating/desc",name:(0,l.__)("Top Rated","woo-gutenberg-products-block")}];function Ye(e){const{query:t}=e.attributes;return(0,n.createElement)(a.PanelBody,{className:"woocommerce-product-query-panel__sort",title:(0,l.__)("Popular Filters","woo-gutenberg-products-block"),initialOpen:!0},(0,n.createElement)("p",null,(0,l.__)("Arrange products by popular pre-sets.","woo-gutenberg-products-block")),(0,n.createElement)(a.CustomSelectControl,{hideLabelFromVision:!0,label:(0,l.__)("Choose among these pre-sets","woo-gutenberg-products-block"),onChange:t=>{var o,r,c;if(null===(o=t.selectedItem)||void 0===o||!o.key)return;const[n,a]=null===(r=t.selectedItem)||void 0===r||null===(c=r.key)||void 0===c?void 0:c.split("/");ce(e,{order:a,orderBy:n})},options:Qe,value:Qe.find((e=>e.key===`${t.orderBy}/${t.order}`))}))}const Je=e=>{const t=(0,N.createInterpolateElement)((0,l.__)("Upgrade all Products (Beta) blocks on this page to <strongText /> for more features!","woo-gutenberg-products-block"),{strongText:(0,n.createElement)("strong",null,(0,l.__)("Product Collection","woo-gutenberg-products-block"))}),o=(0,l.__)("Upgrade to Product Collection","woo-gutenberg-products-block");return(0,n.createElement)(a.Notice,{isDismissible:!1},(0,n.createElement)(n.Fragment,null,t),(0,n.createElement)("br",null),(0,n.createElement)("br",null),(0,n.createElement)(a.Button,{variant:"link",onClick:()=>{e.upgradeBlock()}},o))};o(5067);const Ke=J.map((e=>`__woocommerce${e[0].toUpperCase()}${e.slice(1)}`));function Xe(e){var t;const o="string"==typeof e?e:e.value;return null===(t=Object.entries(X).find((([,e])=>e===o)))||void 0===t?void 0:t[0]}const et={attributes:e=>{const{query:t}=e.attributes,[o,r]=(0,N.useState)([]);return(0,N.useEffect)((()=>{t.__woocommerceAttributes&&r(t.__woocommerceAttributes.map((({termId:e})=>({id:e}))))}),[t.__woocommerceAttributes]),(0,n.createElement)(a.__experimentalToolsPanelItem,{label:(0,l.__)("Product Attributes","woo-gutenberg-products-block"),hasValue:()=>{var e;return null===(e=t.__woocommerceAttributes)||void 0===e?void 0:e.length}},(0,n.createElement)(We,{messages:{search:(0,l.__)("Attributes","woo-gutenberg-products-block")},selected:o,onChange:t=>{const o=t.map((({id:e,value:t})=>({termId:e,taxonomy:t})));ce(e,{__woocommerceAttributes:o})},operator:"any",isCompact:!0,type:"token"}),(0,n.createElement)(a.ExternalLink,{className:"woocommerce-product-query-panel__external-link",href:"/wp-admin/edit.php?post_type=product&page=product_attributes"},(0,l.__)("Manage attributes","woo-gutenberg-products-block")))},onSale:e=>{const{query:t}=e.attributes;return(0,n.createElement)(a.__experimentalToolsPanelItem,{label:(0,l.__)("Sale status","woo-gutenberg-products-block"),hasValue:()=>t.__woocommerceOnSale},(0,n.createElement)(a.ToggleControl,{label:(0,l.__)("Show only products on sale","woo-gutenberg-products-block"),checked:t.__woocommerceOnSale||!1,onChange:t=>{ce(e,{__woocommerceOnSale:t})}}))},productSelector:e=>{const{query:t}=e.attributes,o=function(){const[e,t]=(0,N.useState)([]);return(0,N.useEffect)((()=>{(({selected:e=[],search:t="",queryArgs:o={}})=>{const r=(({selected:e=[],search:t="",queryArgs:o={}})=>{const r=$e.productCount>100,c={per_page:r?100:0,catalog_visibility:"any",search:t,orderby:"title",order:"asc"},n=[(0,Ne.addQueryArgs)("/wc/store/v1/products",{...c,...o})];return r&&e.length&&n.push((0,Ne.addQueryArgs)("/wc/store/v1/products",{catalog_visibility:"any",include:e,per_page:0})),n})({selected:e,search:t,queryArgs:o});return Promise.all(r.map((e=>Fe()({path:e})))).then((e=>{const t=e.flat(),o=De(t,(e=>e.id));return o.map((e=>({...e,parent:0})))})).catch((e=>{throw e}))})({selected:[]}).then((e=>{t(e)}))}),[]),e}();return(0,n.createElement)(a.__experimentalToolsPanelItem,{label:(0,l.__)("Hand-picked Products","woo-gutenberg-products-block"),hasValue:()=>{var e;return null===(e=t.include)||void 0===e?void 0:e.length}},(0,n.createElement)(a.FormTokenField,{disabled:!o.length,displayTransform:e=>{var t;return Number.isNaN(Number(e))?e:(null===(t=o.find((t=>t.id===Number(e))))||void 0===t?void 0:t.name)||""},label:(0,l.__)("Pick some products","woo-gutenberg-products-block"),onChange:t=>{const r=t.map((e=>{var t;return null===(t=o.find((t=>t.name===e||t.id===Number(e))))||void 0===t?void 0:t.id})).filter(Boolean).map(String);if(!r.length&&e.attributes.query.include){const t=L(e.attributes.query,"include");ce({...e,attributes:{...e.attributes,query:t}},{})}else ce(e,{include:r})},suggestions:o.map((e=>e.name)),validateInput:e=>o.find((t=>t.name===e)),value:o.length?(null==t?void 0:t.include)||[]:[(0,l.__)("Loading…","woo-gutenberg-products-block")],__experimentalExpandOnFocus:!0}))},stockStatus:e=>{var t;const{query:o}=e.attributes;return(0,n.createElement)(a.__experimentalToolsPanelItem,{label:(0,l.__)("Stock status","woo-gutenberg-products-block"),hasValue:()=>o.__woocommerceStockStatus},(0,n.createElement)(a.FormTokenField,{label:(0,l.__)("Stock status","woo-gutenberg-products-block"),onChange:t=>{const o=t.map(Xe).filter(Boolean);ce(e,{__woocommerceStockStatus:o})},suggestions:Object.values(X),validateInput:e=>Object.values(X).includes(e),value:(null==o||null===(t=o.__woocommerceStockStatus)||void 0===t?void 0:t.map((e=>X[e])))||[],__experimentalExpandOnFocus:!0}))},wooInherit:e=>{const t=function(e,t){const o=(0,N.useRef)();return(0,N.useEffect)((()=>{o.current===e||t&&!t(e,o.current)||(o.current=e)}),[e,t]),o.current}(e.attributes.query,(e=>!1===e.inherit));return(0,n.createElement)(a.ToggleControl,{className:"woo-inherit-query-toggle",label:(0,l.__)("Inherit query from template","woo-gutenberg-products-block"),help:(0,l.__)("Toggle to use the global query context that is set with the current template, such as variations of the product catalog or search. Disable to customize the filtering independently.","woo-gutenberg-products-block"),checked:e.attributes.query.inherit||!1,onChange:o=>{const r={inherit:o};o&&(r.perPage=(0,c.getSettingWithCoercion)("loopShopPerPage",12,P)),ce(e,{...e.defaultWooQueryParams,...r,...!1===o&&{...t}})}})}},tt=e=>{const t=function(e){const t=(0,v.useSelect)("core/edit-site"),o=(0,v.useSelect)((t=>{var o;return null===(o=t(d.store).getActiveBlockVariation(Y,e))||void 0===o?void 0:o.allowedControls}),[e]);return z(t)?function(e){return e.query.inherit}(e)?o.filter((e=>"wooInherit"===e)):o:o.filter((e=>"wooInherit"!==e))}(e.attributes),o=function(e){const t=(0,v.useSelect)((t=>{var o;return null===(o=t("core/blocks").getBlockVariations(Y).find((t=>t.name===e)))||void 0===o?void 0:o.attributes}));return t?Object.assign({},...Ke.map((e=>({[e]:t.query[e]})))):{}}(e.attributes.namespace);return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(E.InspectorControls,null,(0,n.createElement)(Je,{upgradeBlock:M}),(null==t?void 0:t.includes("presets"))&&(0,n.createElement)(Ye,{...e}),(0,n.createElement)(a.__experimentalToolsPanel,{className:"woocommerce-product-query-toolspanel",label:(0,l.__)("Advanced Filters","woo-gutenberg-products-block"),resetAll:()=>{ce(e,o)}},Object.entries(et).map((([r,c])=>null!=t&&t.includes(r)?(0,n.createElement)(c,{...e,defaultWooQueryParams:o,key:r}):null)))))};(0,r.addFilter)("editor.BlockEdit",Y,(e=>t=>{return(o=t).name===Y&&Object.values(re).includes(o.attributes.namespace)?(0,n.createElement)(n.Fragment,null,(0,n.createElement)(tt,{...t}),(0,n.createElement)(e,{...t}),(0,n.createElement)(E.InspectorControls,null,(0,n.createElement)(I,null))):(0,n.createElement)(e,{...t});var o})),o(9054);var ot=o(444);const rt=(0,n.createElement)(ot.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24"},(0,n.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M4.5 19.375L4.5 7.625C4.5 7.55596 4.55596 7.5 4.625 7.5L16.375 7.5C16.444 7.5 16.5 7.55596 16.5 7.625L16.5 19.375C16.5 19.444 16.444 19.5 16.375 19.5L4.625 19.5C4.55596 19.5 4.5 19.444 4.5 19.375ZM4.625 21C3.72754 21 3 20.2725 3 19.375L3 7.625C3 6.72754 3.72754 6 4.625 6L16.375 6C17.2725 6 18 6.72754 18 7.625L18 19.375C18 20.2725 17.2725 21 16.375 21L4.625 21ZM19 3.75L8 3.75L8 2.25L19 2.25C20.5183 2.25 21.75 3.4796 21.75 4.99891L21.75 18L20.25 18L20.25 4.99891C20.25 4.30909 19.6909 3.75 19 3.75Z"})),ct=["woocommerce/woocommerce//archive-product","woocommerce/woocommerce//taxonomy-product_cat","woocommerce/woocommerce//taxonomy-product_tag","woocommerce/woocommerce//taxonomy-product_attribute","woocommerce/woocommerce//product-search-results"],nt=e=>{(0,d.registerBlockVariation)(Y,{description:(0,l.__)("A block that displays a selection of products in your store.","woo-gutenberg-products-block"),name:Q,
/* translators: “Products“ is the name of the block. */
title:(0,l.__)("Products (Beta)","woo-gutenberg-products-block"),isActive:e=>e.namespace===Q,icon:(0,n.createElement)(a.Icon,{icon:rt,className:"wc-block-editor-components-block-icon wc-block-editor-components-block-icon--stacks"}),attributes:{...e,namespace:Q},allowedControls:K,innerBlocks:oe,scope:["inserter"]})};if((0,c.isWpVersion)("6.1",">=")){let e;(0,v.subscribe)((()=>{const t=e,o=(0,v.select)("core/edit-site");if(e=null==o?void 0:o.getEditedPostId(),t!==e&&z(o)){const t=ct.includes(e),o={inherit:t};t&&(o.perPage=(0,c.getSettingWithCoercion)("loopShopPerPage",12,P));const r={...te,query:{...te.query,...o}};(0,d.unregisterBlockVariation)(Y,Q),nt(r)}}),"core/edit-site");let t=!1;(0,v.subscribe)((()=>{t||(t=!0,nt(te))}),"core/edit-post")}const at=new Set,lt="woocommerce/related-products",st={namespace:lt,allowedControls:[],displayLayout:{type:"flex",columns:5},query:{perPage:5,pages:0,offset:0,postType:"product",order:"asc",orderBy:"title",author:"",search:"",exclude:[],sticky:"",inherit:!1},lock:{remove:!0,move:!0}},it=(0,c.getSettingWithCoercion)("postTemplateHasSupportForGridView",!1,O),ut=[["core/heading",{level:2,content:(0,l.__)("Related products","woo-gutenberg-products-block")}],["core/post-template",{__woocommerceNamespace:f,...it&&{layout:{type:"grid",columnCount:5}}},[["woocommerce/product-image",{productId:0,imageSizing:"cropped"}],["core/post-title",{textAlign:"center",level:3,fontSize:"medium",isLink:!0,__woocommerceNamespace:g},[]],["woocommerce/product-price",{textAlign:"center",fontSize:"small",style:{spacing:{margin:{bottom:"1rem"}}}},[]],["woocommerce/product-button",{textAlign:"center",fontSize:"small",style:{spacing:{margin:{bottom:"1rem"}}}},[]]]]];(({blockName:e,blockMetadata:t,blockSettings:o,isVariationBlock:r=!1,variationName:c,isAvailableOnPostEditor:n})=>{let a="";(0,v.subscribe)((()=>{var n;const l=a,s=(0,v.select)("core/edit-site");a=function(e){const t=P(e)?void 0:e;return null==t?void 0:t.split("//")[1]}(null==s?void 0:s.getEditedPostId());const i=l!==a,u=Boolean(a);if(!i||!u||!e)return;let m=Boolean((0,d.getBlockType)(e));if(m&&(null!==(n=a)&&void 0!==n&&n.includes("single-product")||null!=l&&l.includes("single-product"))&&(r&&c?(0,d.unregisterBlockVariation)(e,c):(0,d.unregisterBlockType)(e),m=!1),!m)if(r)(0,d.registerBlockVariation)(e,o);else{var p;const e=null==(b=null==o?void 0:o.ancestor)||"object"==typeof b&&0===Object.keys(b).length||"string"==typeof b&&0===b.trim().length?["woocommerce/single-product"]:null==o?void 0:o.ancestor;(0,d.registerBlockType)(t,{...o,ancestor:null!==(p=a)&&void 0!==p&&p.includes("single-product")?void 0:e})}var b}),"core/edit-site"),(0,v.subscribe)((()=>{!(Boolean(c)?at.has(c):at.has(e))&&n&&(r?(at.add(c),(0,d.registerBlockVariation)(e,o)):(at.add(e),(0,d.registerBlockType)(t,o)))}),"core/edit-post")})({blockName:Y,blockMetadata:{},blockSettings:{description:(0,l.__)("Display related products.","woo-gutenberg-products-block"),name:"Related Products Controls",title:(0,l.__)("Related Products Controls","woo-gutenberg-products-block"),isActive:e=>e.namespace===lt,icon:(0,n.createElement)(a.Icon,{icon:rt,className:"wc-block-editor-components-block-icon wc-block-editor-components-block-icon--stacks"}),attributes:st,allowedControls:[],innerBlocks:ut,scope:["block"]},isVariationBlock:!0,variationName:lt});const mt=[k,y,b];(0,c.isWpVersion)("6.1",">=")&&(0,r.addFilter)("blocks.registerBlockType","core/custom-class-name/attribute",(function(e,t){return mt.includes(t)&&(e.attributes={...e.attributes,__woocommerceNamespace:{type:"string"}}),e}))},5067:()=>{},9054:()=>{},4662:()=>{},9669:()=>{},8462:()=>{},5932:()=>{},9196:e=>{"use strict";e.exports=window.React},4333:e=>{"use strict";e.exports=window.wp.compose},9307:e=>{"use strict";e.exports=window.wp.element},5736:e=>{"use strict";e.exports=window.wp.i18n},444:e=>{"use strict";e.exports=window.wp.primitives}},o={};function r(e){var c=o[e];if(void 0!==c)return c.exports;var n=o[e]={exports:{}};return t[e].call(n.exports,n,n.exports,r),n.exports}r.m=t,e=[],r.O=(t,o,c,n)=>{if(!o){var a=1/0;for(u=0;u<e.length;u++){for(var[o,c,n]=e[u],l=!0,s=0;s<o.length;s++)(!1&n||a>=n)&&Object.keys(r.O).every((e=>r.O[e](o[s])))?o.splice(s--,1):(l=!1,n<a&&(a=n));if(l){e.splice(u--,1);var i=c();void 0!==i&&(t=i)}}return t}n=n||0;for(var u=e.length;u>0&&e[u-1][2]>n;u--)e[u]=e[u-1];e[u]=[o,c,n]},r.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return r.d(t,{a:t}),t},r.d=(e,t)=>{for(var o in t)r.o(t,o)&&!r.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.j=7844,(()=>{var e={7844:0};r.O.j=t=>0===e[t];var t=(t,o)=>{var c,n,[a,l,s]=o,i=0;if(a.some((t=>0!==e[t]))){for(c in l)r.o(l,c)&&(r.m[c]=l[c]);if(s)var u=s(r)}for(t&&t(o);i<a.length;i++)n=a[i],r.o(e,n)&&e[n]&&e[n][0](),e[n]=0;return r.O(u)},o=self.webpackChunkwebpackWcBlocksJsonp=self.webpackChunkwebpackWcBlocksJsonp||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var c=r.O(void 0,[2869],(()=>r(4534)));c=r.O(c),((this.wc=this.wc||{}).blocks=this.wc.blocks||{})["product-query"]=c})();