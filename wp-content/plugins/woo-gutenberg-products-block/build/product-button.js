(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[21],{294:function(t,e,c){"use strict";c.r(e);var o=c(6),n=c.n(o),s=c(0),a=c(4),l=c.n(a),r=c(1),d=c(80),b=c(370),i=c(13),u=c(22),p=c(2),y=c(28),_=c(59),m=(c(324),c(43));const w=t=>{let{product:e,colorStyles:c,borderStyles:o,typographyStyles:a,spacingStyles:y}=t;const{id:_,permalink:m,add_to_cart:w,has_options:k,is_purchasable:j,is_in_stock:O}=e,{dispatchStoreEvent:S}=Object(d.a)(),{cartQuantity:g,addingToCart:h,addToCart:N}=Object(b.a)(_,"woocommerce/single-product/"+(_||0)),f=Number.isFinite(g)&&g>0,C=!k&&j&&O,E=Object(i.decodeEntities)((null==w?void 0:w.description)||""),v=f?Object(r.sprintf)(
/* translators: %s number of products in cart. */
Object(r._n)("%d in cart","%d in cart",g,"woo-gutenberg-products-block"),g):Object(i.decodeEntities)((null==w?void 0:w.text)||Object(r.__)("Add to cart","woo-gutenberg-products-block")),x=C?"button":"a",A={};return C?A.onClick=async()=>{await N(),S("cart-add-item",{product:e});const{cartRedirectAfterAdd:t}=Object(p.getSetting)("productsSettings");t&&(window.location.href=u.d)}:(A.href=m,A.rel="nofollow",A.onClick=()=>{S("product-view-link",{product:e})}),Object(s.createElement)(x,n()({"aria-label":E,className:l()("wp-block-button__link","add_to_cart_button","wc-block-components-product-button__button",c.className,o.className,{loading:h,added:f}),style:{...c.style,...o.style,...a.style,...y.style},disabled:h},A),v)},k=t=>{let{colorStyles:e,borderStyles:c,typographyStyles:o,spacingStyles:n}=t;return Object(s.createElement)("button",{className:l()("wp-block-button__link","add_to_cart_button","wc-block-components-product-button__button","wc-block-components-product-button__button--placeholder",e.className,c.className),style:{...e.style,...c.style,...o.style,...n.style},disabled:!0})};e.default=Object(_.withProductDataContext)(t=>{const{className:e}=t,{parentClassName:c}=Object(y.useInnerBlockLayoutContext)(),{product:o}=Object(y.useProductDataContext)(),n=Object(m.b)(t),a=Object(m.a)(t),r=Object(m.d)(t),d=Object(m.c)(t);return Object(s.createElement)("div",{className:l()(e,"wp-block-button","wc-block-components-product-button",{[c+"__product-add-to-cart"]:c})},o.id?Object(s.createElement)(w,{product:o,colorStyles:n,borderStyles:a,typographyStyles:r,spacingStyles:d}):Object(s.createElement)(k,{colorStyles:n,borderStyles:a,typographyStyles:r,spacingStyles:d}))})},324:function(t,e){}}]);