!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(r,o,function(e){return t[e]}.bind(null,o));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=9)}([function(t,e){t.exports=wp.element},function(t,e){t.exports=wp.autop},function(t,e){t.exports=wp.blocks},function(t,e){t.exports=wp.i18n},function(t,e){t.exports=wp.data},function(t,e){t.exports=wp.components},function(t,e,n){},,,function(t,e,n){"use strict";n.r(e);n(6);var r=n(2),o=n(3),u=n(0),i=n(4),c=n(5);function a(t){return(a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function l(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}function p(t){return(p=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}function f(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}function s(t,e){return(s=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}var b=function(t){function e(){var t,n,r,o,u,i,c;!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,e);for(var l=arguments.length,s=new Array(l),b=0;b<l;b++)s[b]=arguments[b];return r=this,o=(t=p(e)).call.apply(t,[this].concat(s)),n=!o||"object"!==a(o)&&"function"!=typeof o?f(r):o,u=f(n),c=function(t){n.props.setAttributes({postName:t})},(i="onChangeHanler")in u?Object.defineProperty(u,i,{value:c,enumerable:!0,configurable:!0,writable:!0}):u[i]=c,n}var n,r,o;return function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&s(t,e)}(e,t),n=e,(r=[{key:"render",value:function(){var t=this,e=this.props,n=e.documents,r=e.attributes.postName;return wp.element.createElement(wp.element.Fragment,null,wp.element.createElement(c.SelectControl,{label:"Select A Office Document",value:r,onChange:function(e){return t.props.setAttributes({postName:e})},options:n&&n.map((function(t){return{value:t.id,label:t.title.raw}}))}))}}])&&l(n.prototype,r),o&&l(n,o),e}(u.Component),y=Object(i.withSelect)((function(t){return{documents:t("core").getEntityRecords("postType","officeviewer")}}))(b);var m=n(1),d={from:[{type:"shortcode",tag:"[a-z][a-z0-9_-]*",attributes:{postName:{type:"string",shortcode:function(t,e){var n=e.content;return Object(m.removep)(Object(m.autop)(n))}}},priority:20}]};Object(r.registerBlockType)("ovp-kit/kahf-banner-k27f",{title:Object(o.__)("Office Viewer",
"ovp-kit"),icon:"media-document",category:"common",transforms:d,supports:{customClassName:!1,className:!1,html:!1},edit:y,save:function(t){var e=t.attributes;return console.log(e.postName),wp.element.createElement(u.RawHTML,null,"[office_doc id=".concat(e.postName,"]"))}})}]);
//# sourceMappingURL=editor-script.js.map