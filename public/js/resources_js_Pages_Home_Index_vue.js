"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Home_Index_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Membership.vue?vue&type=script&defer=true&lang=js":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Membership.vue?vue&type=script&defer=true&lang=js ***!
  \**************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  mounted: function mounted() {
    $(document).ready(function () {
      $('.membership .types .heading').click(function () {
        // Deactive other items
        $(this).parent('li').siblings().each(function () {
          $(this).find('ol').removeClass('active');
          $(this).find('i').attr('class', 'fas fa-caret-down');
        });

        // Active current item
        $(this).siblings('ol').addClass('active');
        $(this).find('i').attr('class', 'fas fa-caret-up');
      });
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=script&defer=true&lang=js":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=script&defer=true&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  mounted: function mounted() {
    $(function () {
      $('.img-popup').click(function () {
        openPopUp($('#modal'), $(this).attr('src'), 'Caption');
      });
      $('#modal > .close').click(function () {
        closePopUp();
      });
    });
    function openPopUp(modal, src, alt) {
      $('#modal').css('display', 'block');
      $('#modal > .modal-content').attr('src', src);
      $('#modal > .caption').html(alt);
    }
    function closePopUp() {
      $('#modal').css('display', 'none');
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=script&setup=true&lang=js":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=script&setup=true&lang=js ***!
  \**********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Layouts_App_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../Layouts/App.vue */ "./resources/js/Layouts/App.vue");
/* harmony import */ var _Components_Slider_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Components/Slider.vue */ "./resources/js/Pages/Home/Components/Slider.vue");
/* harmony import */ var _Components_AboutUs_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Components/AboutUs.vue */ "./resources/js/Pages/Home/Components/AboutUs.vue");
/* harmony import */ var _Components_MediaCenter_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Components/MediaCenter.vue */ "./resources/js/Pages/Home/Components/MediaCenter.vue");
/* harmony import */ var _Components_Studio_vue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./Components/Studio.vue */ "./resources/js/Pages/Home/Components/Studio.vue");
/* harmony import */ var _Components_RegulationsAndEvents_vue__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./Components/RegulationsAndEvents.vue */ "./resources/js/Pages/Home/Components/RegulationsAndEvents.vue");
/* harmony import */ var _Components_Membership_vue__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./Components/Membership.vue */ "./resources/js/Pages/Home/Components/Membership.vue");
/* harmony import */ var _Components_Statistics_vue__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./Components/Statistics.vue */ "./resources/js/Pages/Home/Components/Statistics.vue");
/* harmony import */ var _Components_FollowUs_vue__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./Components/FollowUs.vue */ "./resources/js/Pages/Home/Components/FollowUs.vue");

var __default__ = {
  layout: _Layouts_App_vue__WEBPACK_IMPORTED_MODULE_0__["default"],
  mounted: function mounted() {}
};








/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (/*#__PURE__*/Object.assign(__default__, {
  name: 'Index',
  setup: function setup(__props, _ref) {
    var expose = _ref.expose;
    expose();
    var __returned__ = {
      App: _Layouts_App_vue__WEBPACK_IMPORTED_MODULE_0__["default"],
      Slider: _Components_Slider_vue__WEBPACK_IMPORTED_MODULE_1__["default"],
      AboutUs: _Components_AboutUs_vue__WEBPACK_IMPORTED_MODULE_2__["default"],
      MediaCenter: _Components_MediaCenter_vue__WEBPACK_IMPORTED_MODULE_3__["default"],
      Studio: _Components_Studio_vue__WEBPACK_IMPORTED_MODULE_4__["default"],
      RegulationsAndEvents: _Components_RegulationsAndEvents_vue__WEBPACK_IMPORTED_MODULE_5__["default"],
      Membership: _Components_Membership_vue__WEBPACK_IMPORTED_MODULE_6__["default"],
      Statistics: _Components_Statistics_vue__WEBPACK_IMPORTED_MODULE_7__["default"],
      FollowUs: _Components_FollowUs_vue__WEBPACK_IMPORTED_MODULE_8__["default"]
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
}));

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/AboutUs.vue?vue&type=template&id=3a637cae":
/*!****************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/AboutUs.vue?vue&type=template&id=3a637cae ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "section about-organization"
};
var _hoisted_2 = {
  "class": "container"
};
var _hoisted_3 = {
  "class": "row"
};
var _hoisted_4 = {
  "class": "col-lg-6 order-lg-last"
};
var _hoisted_5 = ["alt"];
var _hoisted_6 = {
  "class": "col-lg-6 order-lg-first about-us pt-4"
};
var _hoisted_7 = {
  "class": "read-more"
};
function render(_ctx, _cache) {
  var _component_Link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Link");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    src: "/img/about-organization.jpg",
    alt: _ctx.__('About authority'),
    "class": "img-fluid w-100"
  }, null, 8 /* PROPS */, _hoisted_5)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('About authority')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('The Saudi Journalists Association for Professional Performance in the Kingdom of Saudi Arabia was established according to Article No. 27 of the Press Institutions Law by Royal Decree No. (M / 20) on 05/08/1422 AH, and its regulations were approved at the first meeting of the Association, which was held on the date corresponding to 4/19 / 1425 AH corresponding to 7/7/2004 Minister of Culture and Information, these regulations are in accordance with Resolution No. (M / F / 383) dated 11/8/1425 AH. The establishment of the foundation stems from a real desire to serve membership in the Kingdom of Saudi Arabia.')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
    href: "/about-us"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Read more')), 1 /* TEXT */)];
    }),

    _: 1 /* STABLE */
  })])])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/FollowUs.vue?vue&type=template&id=2d1976fe":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/FollowUs.vue?vue&type=template&id=2d1976fe ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "follow-us"
};
var _hoisted_2 = {
  "class": "container"
};
var _hoisted_3 = {
  "class": "row"
};
var _hoisted_4 = {
  "class": "col-md-6 follow-info"
};
var _hoisted_5 = {
  "class": "mb-1"
};
var _hoisted_6 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"social overflow-hidden\"><a class=\"mx-1\" href=\"#\"><i class=\"fab fa-facebook-square\"></i></a><a class=\"mx-1\" href=\"https://twitter.com/sju_ksa\" target=\"_blank\"><i class=\"fab fa-twitter-square\"></i></a><a class=\"mx-1\" href=\"#\"><i class=\"fab fa-linkedin\"></i></a></div>", 1);
var _hoisted_7 = {
  "class": "mt-4 mb-3"
};
var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<ul class=\"contact\"><li><svg class=\"mx-2\" xmlns=\"http://www.w3.org/2000/svg\" width=\"22.351\" height=\"22.351\" viewBox=\"0 0 22.351 22.351\"><g id=\"email_1_\" data-name=\"email (1)\" transform=\"translate(-0.001 -0.004)\"><g id=\"Group_52\" data-name=\"Group 52\" transform=\"translate(0.001 0.004)\"><g id=\"Group_51\" data-name=\"Group 51\" transform=\"translate(0)\"><path id=\"Path_65\" data-name=\"Path 65\" d=\"M22.348,8.549a.352.352,0,0,0-.015-.076.373.373,0,0,0-.021-.064.334.334,0,0,0-.037-.057.351.351,0,0,0-.05-.058c-.006-.005-.009-.012-.015-.018L18.627,5.495V2.611a1.118,1.118,0,0,0-1.118-1.118H13.472L11.855.238a1.1,1.1,0,0,0-1.359,0L8.88,1.493H4.843A1.118,1.118,0,0,0,3.725,2.611V5.495L.144,8.277c-.006.005-.009.012-.015.018a.349.349,0,0,0-.05.058.333.333,0,0,0-.037.057.368.368,0,0,0-.021.064.353.353,0,0,0-.015.075c0,.008,0,.015,0,.022V21.238A1.105,1.105,0,0,0,.22,21.9s0,.007.005.01l.012.01a1.112,1.112,0,0,0,.881.439H21.235a1.112,1.112,0,0,0,.884-.441s.007,0,.01-.009,0-.007.005-.01a1.105,1.105,0,0,0,.219-.658V8.571C22.352,8.564,22.348,8.557,22.348,8.549ZM10.952.826a.357.357,0,0,1,.444,0l.859.667H10.1ZM1.211,21.61l9.741-7.567a.358.358,0,0,1,.444,0l9.744,7.567Zm20.4-.581-9.752-7.574a1.105,1.105,0,0,0-1.359,0L.745,21.029V9.139l6.1,4.741a.373.373,0,0,0,.457-.589L1.1,8.475,3.725,6.438V9.316a.373.373,0,1,0,.745,0V2.611a.373.373,0,0,1,.373-.373H17.509a.373.373,0,0,1,.373.373V9.316a.373.373,0,1,0,.745,0V6.438l2.621,2.037L15.035,13.3a.373.373,0,1,0,.457.589l6.116-4.749V21.029Z\" transform=\"translate(-0.001 -0.004)\" fill=\"#007c42\"></path><path id=\"Path_66\" data-name=\"Path 66\" d=\"M162.515,74.2v-1.49a4.47,4.47,0,1,0-4.47,4.47.373.373,0,1,0,0-.745,3.725,3.725,0,1,1,3.725-3.725V74.2a.745.745,0,1,1-1.49,0v-1.49a.373.373,0,1,0-.745,0,1.49,1.49,0,1,1-1.49-1.49.373.373,0,1,0,0-.745,2.235,2.235,0,1,0,1.506,3.882,1.486,1.486,0,0,0,2.964-.157Z\" transform=\"translate(-146.869 -65.258)\" fill=\"#007c42\"></path></g></g></g></svg><a href=\"mailto:info@sju.org.sa\">info@sju.org.sa</a></li><li><svg class=\"mx-2\" id=\"Layer_1\" data-name=\"Layer 1\" xmlns=\"http://www.w3.org/2000/svg\" width=\"22.351\" height=\"22.35\" viewBox=\"0 0 22.35 18.33\"><defs></defs><path class=\"twitter-green\" d=\"M427.82,294.88a9,9,0,0,1-2,2.26.34.34,0,0,0-.15.3,13.26,13.26,0,0,1-2.8,8.26,12.19,12.19,0,0,1-6.59,4.43,13.39,13.39,0,0,1-4.63.42,12.88,12.88,0,0,1-5.86-2,1.73,1.73,0,0,1-.28-.26V308a.62.62,0,0,1,.63-.27,8.48,8.48,0,0,0,4.57-.81l.57-.31-.34-.12a4.82,4.82,0,0,1-3-3.07c-.1-.3.05-.51.44-.6l-.16-.15a4.8,4.8,0,0,1-1.84-3.74c0-.47.29-.66.71-.45l.22.1c-.16-.29-.32-.54-.44-.81a4.82,4.82,0,0,1,.17-4.46.45.45,0,0,1,.77-.07c.6.61,1.21,1.22,1.83,1.8.24.23.54.4.8.61a.36.36,0,0,1,.15.46.46.46,0,0,1-.77.16,12.61,12.61,0,0,1-2.12-1.81l-.14-.2a3.79,3.79,0,0,0-.27,1.52,3.9,3.9,0,0,0,1.62,3.13l.16.12a.43.43,0,0,1,.14.49.38.38,0,0,1-.42.28c-.42-.05-.83-.13-1.25-.19a2.19,2.19,0,0,0-.23-.07,3.91,3.91,0,0,0,.73,1.71,4,4,0,0,0,2.31,1.51c.29.07.43.22.43.44s-.15.39-.45.44-.82.12-1.25.18a3,3,0,0,0,.65.89,4.07,4.07,0,0,0,2.71,1.19.42.42,0,0,1,.44.32.47.47,0,0,1-.22.52,9.45,9.45,0,0,1-4.31,1.82l-.28,0a.62.62,0,0,0-.27.09c.38.14.76.3,1.15.43a11.83,11.83,0,0,0,5.25.51,11.56,11.56,0,0,0,9.35-6.67,11.82,11.82,0,0,0,1.23-5.79.65.65,0,0,1,.28-.56c.34-.27.68-.56,1-.85l0-.05-.84.15-.24,0a.42.42,0,0,1-.48-.28.43.43,0,0,1,.2-.53,3.89,3.89,0,0,0,1.14-1.05l-.38.13c-.4.11-.8.21-1.19.34a.56.56,0,0,1-.63-.18,4,4,0,0,0-1.51-1,4,4,0,0,0-5.2,3.17,7.09,7.09,0,0,0,0,1.38c.05.45-.12.69-.57.63-.84-.11-1.67-.25-2.5-.39a.45.45,0,0,1-.42-.57c.06-.25.29-.36.63-.29l1.73.33h.17v-.57a4.8,4.8,0,0,1,3.76-4.66,4.66,4.66,0,0,1,4.2,1,.48.48,0,0,0,.51.12,8.48,8.48,0,0,0,1.9-.76l.25-.13a.42.42,0,0,1,.51,0,.39.39,0,0,1,.11.51c-.19.42-.41.83-.62,1.24a1.4,1.4,0,0,1-.16.23l.65-.25c.39-.15.51-.13.77.19Zm-9.51,12.33a10,10,0,0,0,2.14-1.68,7.2,7.2,0,0,0,.64-.71.42.42,0,0,0,0-.62.43.43,0,0,0-.61,0,1.1,1.1,0,0,0-.15.16,9.84,9.84,0,0,1-2.33,2,1.61,1.61,0,0,0-.3.21.4.4,0,0,0-.1.48.43.43,0,0,0,.46.26Zm-6.42-10.66a.44.44,0,1,0,0,.88.43.43,0,0,0,.43-.42A.47.47,0,0,0,411.89,296.55Zm9.8,6.27a.41.41,0,0,0-.43.42.45.45,0,0,0,.43.45.43.43,0,0,0,.42-.44A.41.41,0,0,0,421.69,302.82Z\" transform=\"translate(-405.47 -292.27)\"></path></svg><a href=\"https://twitter.com/sju_ksa\" target=\"_blank\">sju_ksa</a></li><li><svg class=\"mx-2\" xmlns=\"http://www.w3.org/2000/svg\" width=\"22.351\" height=\"22.35\" viewBox=\"0 0 22.351 22.35\"><g id=\"call\" transform=\"translate(-1 -1.018)\"><g id=\"Group_54\" data-name=\"Group 54\" transform=\"translate(1 1.018)\"><g id=\"Group_53\" data-name=\"Group 53\" transform=\"translate(0 0)\"><path id=\"Path_67\" data-name=\"Path 67\" d=\"M22.765,18.26l-4.524-3.017a1.32,1.32,0,0,0-1.768.287l-1.318,1.694a.563.563,0,0,1-.722.152l-.251-.138a15.149,15.149,0,0,1-3.948-3.1,15.211,15.211,0,0,1-3.1-3.948L7,9.939a.564.564,0,0,1,.149-.725L8.838,7.9a1.321,1.321,0,0,0,.288-1.768L6.108,1.6a1.314,1.314,0,0,0-1.771-.4L2.446,2.342A2.669,2.669,0,0,0,1.229,3.921C.548,6.4,1.06,10.687,7.371,17c5.02,5.019,8.757,6.369,11.325,6.369a6.6,6.6,0,0,0,1.751-.229,2.666,2.666,0,0,0,1.579-1.217l1.138-1.891A1.314,1.314,0,0,0,22.765,18.26Zm-.244,1.389-1.135,1.892a1.925,1.925,0,0,1-1.136.881c-2.291.629-6.295.108-12.353-5.95S1.319,6.41,1.948,4.119a1.928,1.928,0,0,1,.882-1.138L4.721,1.846a.57.57,0,0,1,.768.173l1.639,2.46L8.5,6.543a.573.573,0,0,1-.124.767L6.686,8.627A1.3,1.3,0,0,0,6.341,10.3l.134.244A15.8,15.8,0,0,0,9.7,14.664a15.817,15.817,0,0,0,4.119,3.228l.245.135a1.3,1.3,0,0,0,1.673-.345l1.317-1.694a.574.574,0,0,1,.767-.124l4.524,3.017A.569.569,0,0,1,22.521,19.649Z\" transform=\"translate(-1 -1.018)\" fill=\"#007c42\"></path><path id=\"Path_68\" data-name=\"Path 68\" d=\"M283,70.069a6.339,6.339,0,0,1,6.332,6.332.372.372,0,1,0,.745,0A7.085,7.085,0,0,0,283,69.324a.372.372,0,1,0,0,.745Z\" transform=\"translate(-270.335 -66.343)\" fill=\"#007c42\"></path><path id=\"Path_69\" data-name=\"Path 69\" d=\"M283,121.269a4.1,4.1,0,0,1,4.1,4.1.372.372,0,0,0,.745,0A4.848,4.848,0,0,0,283,120.524a.372.372,0,1,0,0,.745Z\" transform=\"translate(-270.335 -115.308)\" fill=\"#007c42\"></path><path id=\"Path_70\" data-name=\"Path 70\" d=\"M283,172.469a1.865,1.865,0,0,1,1.862,1.862.372.372,0,1,0,.745,0A2.61,2.61,0,0,0,283,171.724a.372.372,0,0,0,0,.745Z\" transform=\"translate(-270.335 -164.273)\" fill=\"#007c42\"></path></g></g></g></svg> 0114878555 – 0114878855 </li><li><svg class=\"mx-2\" id=\"fax\" xmlns=\"http://www.w3.org/2000/svg\" width=\"22.351\" height=\"22.351\" viewBox=\"0 0 22.351 22.351\"><path id=\"Path_71\" data-name=\"Path 71\" d=\"M22.023,13.778a.328.328,0,0,0,.328-.328v-7a1.642,1.642,0,0,0-1.64-1.64h-.263V.328A.328.328,0,0,0,20.12,0H9.423A.328.328,0,0,0,9.1.328V4.81H7.848V4.666a1.2,1.2,0,0,0-1.2-1.2H3.88a1.2,1.2,0,0,0-1.2,1.2V4.81H1.64A1.642,1.642,0,0,0,0,6.45v9.362a.328.328,0,1,0,.656,0V6.45a.985.985,0,0,1,.984-.984H2.677V20.348H1.64a.985.985,0,0,1-.984-.984V17.125a.328.328,0,1,0-.656,0v2.239A1.642,1.642,0,0,0,1.64,21H2.677v.144a1.2,1.2,0,0,0,1.2,1.2H6.645a1.2,1.2,0,0,0,1.2-1.2V21H20.711a1.642,1.642,0,0,0,1.64-1.64v-4.6a.328.328,0,1,0-.656,0v4.6a.985.985,0,0,1-.984.984H7.848V11.131a.328.328,0,0,0-.656,0V21.148a.547.547,0,0,1-.547.547H3.88a.547.547,0,0,1-.547-.547V4.666a.547.547,0,0,1,.547-.547H6.645a.547.547,0,0,1,.547.547V9.819a.328.328,0,1,0,.656,0V5.466H20.711a.985.985,0,0,1,.984.984v7a.328.328,0,0,0,.328.328ZM9.751.656H19.792V4.81H9.751Z\" fill=\"#007c42\"></path><path id=\"Path_72\" data-name=\"Path 72\" d=\"M247.162,158.7v-1.932A.766.766,0,0,0,246.4,156H239.5a.766.766,0,0,0-.765.765V158.7a.766.766,0,0,0,.765.765H246.4A.766.766,0,0,0,247.162,158.7Zm-.656,0a.109.109,0,0,1-.109.109H239.5a.109.109,0,0,1-.109-.109v-1.932a.109.109,0,0,1,.109-.109H246.4a.109.109,0,0,1,.109.109Z\" transform=\"translate(-228.316 -149.188)\" fill=\"#007c42\"></path><path id=\"Path_73\" data-name=\"Path 73\" d=\"M247.938,273.486h-1.274a.328.328,0,0,0,0,.656h1.274a.328.328,0,0,0,0-.656Z\" transform=\"translate(-235.582 -261.547)\" fill=\"#007c42\"></path><path id=\"Path_74\" data-name=\"Path 74\" d=\"M314.72,273.528h-1.274a.328.328,0,0,0,0,.656h1.274a.328.328,0,1,0,0-.656Z\" transform=\"translate(-299.449 -261.587)\" fill=\"#007c42\"></path><path id=\"Path_75\" data-name=\"Path 75\" d=\"M381.5,273.486h-1.274a.328.328,0,0,0,0,.656H381.5a.328.328,0,0,0,0-.656Z\" transform=\"translate(-363.317 -261.547)\" fill=\"#007c42\"></path><path id=\"Path_76\" data-name=\"Path 76\" d=\"M247.938,315.609h-1.274a.328.328,0,1,0,0,.656h1.274a.328.328,0,0,0,0-.656Z\" transform=\"translate(-235.582 -301.831)\" fill=\"#007c42\"></path><path id=\"Path_77\" data-name=\"Path 77\" d=\"M314.72,315.651h-1.274a.328.328,0,1,0,0,.656h1.274a.328.328,0,0,0,0-.656Z\" transform=\"translate(-299.449 -301.871)\" fill=\"#007c42\"></path><path id=\"Path_78\" data-name=\"Path 78\" d=\"M381.5,315.609h-1.274a.328.328,0,1,0,0,.656H381.5a.328.328,0,1,0,0-.656Z\" transform=\"translate(-363.317 -301.831)\" fill=\"#007c42\"></path><path id=\"Path_79\" data-name=\"Path 79\" d=\"M247.938,357.732h-1.274a.328.328,0,1,0,0,.656h1.274a.328.328,0,0,0,0-.656Z\" transform=\"translate(-235.582 -342.115)\" fill=\"#007c42\"></path><path id=\"Path_80\" data-name=\"Path 80\" d=\"M314.72,357.773h-1.274a.328.328,0,0,0,0,.656h1.274a.328.328,0,1,0,0-.656Z\" transform=\"translate(-299.449 -342.155)\" fill=\"#007c42\"></path><path id=\"Path_81\" data-name=\"Path 81\" d=\"M381.5,357.732h-1.274a.328.328,0,0,0,0,.656H381.5a.328.328,0,1,0,0-.656Z\" transform=\"translate(-363.317 -342.115)\" fill=\"#007c42\"></path><path id=\"Path_82\" data-name=\"Path 82\" d=\"M247.938,399.854h-1.274a.328.328,0,1,0,0,.656h1.274a.328.328,0,0,0,0-.656Z\" transform=\"translate(-235.582 -382.399)\" fill=\"#007c42\"></path><path id=\"Path_83\" data-name=\"Path 83\" d=\"M314.72,399.895h-1.274a.328.328,0,1,0,0,.656h1.274a.328.328,0,1,0,0-.656Z\" transform=\"translate(-299.449 -382.438)\" fill=\"#007c42\"></path><path id=\"Path_84\" data-name=\"Path 84\" d=\"M381.5,399.854h-1.274a.328.328,0,1,0,0,.656H381.5a.328.328,0,0,0,0-.656Z\" transform=\"translate(-363.317 -382.399)\" fill=\"#007c42\"></path></svg> 0114878444 </li></ul>", 1);
var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "col-md-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("iframe", {
  src: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1023.7624475266713!2d46.631574088726786!3d24.794504080179525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2ee39d45930e57%3A0xb06fc0fbbbe7d2f3!2z2YfZitim2Kkg2KfZhNi12K3ZgdmK2YrZhiDYp9mE2LPYudmI2K_ZitmK2YY!5e0!3m2!1sar!2ssa!4v1542227466291",
  frameborder: "0",
  allowfullscreen: "",
  style: {
    "border": "0",
    "min-height": "400px"
  },
  "class": "w-100 h-100"
})], -1 /* HOISTED */);

function render(_ctx, _cache) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Follow Us')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Follow us on social media')), 1 /* TEXT */), _hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Contact us')), 1 /* TEXT */), _hoisted_8]), _hoisted_9])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/MediaCenter.vue?vue&type=template&id=71c33412":
/*!********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/MediaCenter.vue?vue&type=template&id=71c33412 ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "section media-center"
};
var _hoisted_2 = {
  "class": "container"
};
var _hoisted_3 = {
  "class": "row"
};
var _hoisted_4 = {
  "class": "col-10"
};
var _hoisted_5 = {
  "class": "row mt-3"
};
var _hoisted_6 = {
  "class": "col-md-4 mb-3"
};
var _hoisted_7 = {
  "class": "post",
  style: {
    "background": "linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7)), url('https://sju.org.sa/data/images/uploads/2022-12-29/a8f54abee6.jpeg')"
  }
};
var _hoisted_8 = {
  "class": "category"
};
var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "desc"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, "فرع هيئة الصحفيين السعوديين بمنطقة الجوف يقيم محاضرة بعنوان \"صناعة المحتوى الإعلامي\""), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Wednesday 28 / 12 / 20221")], -1 /* HOISTED */);

function render(_ctx, _cache) {
  var _component_Link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Link");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Media center')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
    href: "/news",
    "class": "col-2 text-end"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('More')), 1 /* TEXT */)];
    }),

    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(3, function (x) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
      href: "/news/?catid=1"
    }, {
      "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
        return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Uncategorized')), 1 /* TEXT */)];
      }),

      _: 1 /* STABLE */
    })]), _hoisted_9])]);
  }), 64 /* STABLE_FRAGMENT */))])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Membership.vue?vue&type=template&id=46ec9c28":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Membership.vue?vue&type=template&id=46ec9c28 ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "section membership"
};
var _hoisted_2 = {
  "class": "container"
};
var _hoisted_3 = {
  "class": "row mt-5"
};
var _hoisted_4 = {
  "class": "col-md-5 mb-5"
};
var _hoisted_5 = {
  "class": "col-md-7"
};
var _hoisted_6 = {
  "class": "mb-3"
};
var _hoisted_7 = {
  "class": "types"
};
var _hoisted_8 = {
  "class": "heading"
};
var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
  "class": "fas fa-caret-up"
}, null, -1 /* HOISTED */);
var _hoisted_10 = {
  "class": "active"
};
var _hoisted_11 = {
  "class": "heading"
};
var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
  "class": "fas fa-caret-down"
}, null, -1 /* HOISTED */);
var _hoisted_13 = {
  "class": "heading"
};
var _hoisted_14 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
  "class": "fas fa-caret-down"
}, null, -1 /* HOISTED */);

function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_Link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Link");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Authority membership')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Everyone who practices journalistic work has the right to apply for membership in the commission')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
    href: "/members/register"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Apply for a membership')), 1 /* TEXT */)];
    }),

    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", _hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Conditions for applying for membership')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ol", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Full-time member')), 1 /* TEXT */), _hoisted_9]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ol", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Every Saudi journalist is dedicated to the profession of journalism')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Every accredited and full-time journalist to work as a reporter or office manager according to a written agreement for any of the local and non-local media outlets in exchange for a fixed salary and he does not practice any other profession')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('That the media in which he works shall fulfill all the conditions for a journalistic profession and the arts of journalistic editing, chiefly news.')), 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Part-time member')), 1 /* TEXT */), _hoisted_12]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ol", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Every Saudi journalist partially practices journalistic work')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('It includes Saudi journalists who occupy governmental or non-governmental jobs and who work alongside their perpetrators')), 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Affiliate member')), 1 /* TEXT */), _hoisted_14]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ol", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Every non-Saudi journalist residing in the Kingdom and working in the journalistic field under a work contract.')), 1 /* TEXT */)])])])])])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/RegulationsAndEvents.vue?vue&type=template&id=b77ea5ce":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/RegulationsAndEvents.vue?vue&type=template&id=b77ea5ce ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "section regulations-events"
};
var _hoisted_2 = {
  "class": "container"
};
var _hoisted_3 = {
  "class": "row"
};
var _hoisted_4 = {
  "class": "col-lg-7 mb-3"
};
var _hoisted_5 = {
  "class": "row"
};
var _hoisted_6 = {
  "class": "col-10"
};
var _hoisted_7 = {
  "class": "row mt-3"
};
var _hoisted_8 = {
  "class": "col-md-4 mb-2"
};
var _hoisted_9 = {
  "class": "regulation"
};
var _hoisted_10 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"84.001\" height=\"83.183\" viewBox=\"0 0 84.001 83.183\"><g id=\"paper_1_\" data-name=\"paper (1)\" transform=\"translate(0 -2.493)\"><path id=\"Path_7\" data-name=\"Path 7\" d=\"M83.309,12.686,73.392,3.229a2.012,2.012,0,0,0-1.5-.736H32.173a2.107,2.107,0,0,0-2.1,2.1v6.461l-14,2.4a2.074,2.074,0,0,0-1.682,2.392l.711,4.143c-4.551,1.531-9.223,3.11-13.733,4.73A2.083,2.083,0,0,0,.119,27.37l8.972,24.94a1.231,1.231,0,1,0,2.316-.833L2.568,26.906c4.249-1.521,8.65-3.01,12.95-4.458L19.746,47.1l4.865,28.388A2.084,2.084,0,0,0,27,77.173L40.18,74.912l10.3-1.765L34.991,78.713,22.779,83.1l-9.484-26.38a1.23,1.23,0,1,0-2.316.833L20.6,84.312a2.078,2.078,0,0,0,1.947,1.364,2.036,2.036,0,0,0,.7-.124l12.579-4.523L64.386,70.763l5.457-.935H81.9A2.109,2.109,0,0,0,84,67.719V14.072a1.77,1.77,0,0,0-.691-1.387Zm-3.26.291h-6.31c-.295,0-.985.007-1.16-.167a.693.693,0,0,1-.088-.424l-.014-6.631ZM81.54,67.366H32.53V43.386a1.23,1.23,0,0,0-2.461,0V67.719a2.109,2.109,0,0,0,2.1,2.109h23.1L39.764,72.486l-12.794,2.2-4.8-28L16.877,15.816l13.192-2.261V37.676a1.23,1.23,0,1,0,2.461,0V4.954H70.015l.016,7.436a2.93,2.93,0,0,0,.815,2.167,3.763,3.763,0,0,0,2.734.882H81.54Z\" transform=\"translate(0)\" fill=\"#85c72e\"></path><path id=\"Path_8\" data-name=\"Path 8\" d=\"M234.43,112.679a1.231,1.231,0,0,0,1.23,1.23h35.181a1.23,1.23,0,1,0,0-2.461H235.66A1.231,1.231,0,0,0,234.43,112.679Z\" transform=\"translate(-195.969 -91.08)\" fill=\"#85c72e\"></path><path id=\"Path_9\" data-name=\"Path 9\" d=\"M270.842,164.731H235.66a1.23,1.23,0,1,0,0,2.461h35.181a1.23,1.23,0,1,0,0-2.461Z\" transform=\"translate(-195.969 -135.621)\" fill=\"#85c72e\"></path><path id=\"Path_10\" data-name=\"Path 10\" d=\"M270.842,218.013H235.66a1.23,1.23,0,1,0,0,2.461h35.181a1.23,1.23,0,1,0,0-2.461Z\" transform=\"translate(-195.969 -180.161)\" fill=\"#85c72e\"></path><path id=\"Path_11\" data-name=\"Path 11\" d=\"M270.842,271.3H235.66a1.23,1.23,0,1,0,0,2.461h35.181a1.23,1.23,0,1,0,0-2.461Z\" transform=\"translate(-195.969 -224.701)\" fill=\"#85c72e\"></path><path id=\"Path_12\" data-name=\"Path 12\" d=\"M270.842,324.578H235.66a1.23,1.23,0,1,0,0,2.461h35.181a1.23,1.23,0,1,0,0-2.461Z\" transform=\"translate(-195.969 -269.242)\" fill=\"#85c72e\"></path></g></svg>", 1);
var _hoisted_11 = {
  href: "#"
};
var _hoisted_12 = {
  "class": "col-lg-5"
};
var _hoisted_13 = {
  "class": "row"
};
var _hoisted_14 = {
  "class": "col-10"
};
var _hoisted_15 = {
  "class": "row mt-3"
};
var _hoisted_16 = {
  "class": "col-12 event"
};
var _hoisted_17 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "date"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "2"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 12/2 ")], -1 /* HOISTED */);
var _hoisted_18 = {
  "class": "title"
};
var _hoisted_19 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" event name ");
function render(_ctx, _cache) {
  var _component_Link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Link");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Regulations and events')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
    href: "/pages/اللوائح-والأنظمة",
    "class": "col-2 text-end"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('More')), 1 /* TEXT */)];
    }),

    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(3, function (i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [_hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", _hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('The basic bylaw of the Saudi Journalists Association')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('1.5 Miga bytes')), 1 /* TEXT */)])]);
  }), 64 /* STABLE_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_14, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Events')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
    href: "/events",
    "class": "col-2 text-end"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('More')), 1 /* TEXT */)];
    }),

    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(2, function (x) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, [_hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h6", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
      href: "/events/register/1"
    }, {
      "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
        return [_hoisted_19];
      }),
      _: 1 /* STABLE */
    })])]);
  }), 64 /* STABLE_FRAGMENT */))])])])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Slider.vue?vue&type=template&id=8aad069a":
/*!***************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Slider.vue?vue&type=template&id=8aad069a ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  id: "carouselExampleSlidesOnly",
  "class": "carousel slide carousel-fade section news-slider",
  "data-mdb-ride": "carousel"
};
var _hoisted_2 = {
  "class": "container"
};
var _hoisted_3 = {
  "class": "carousel-inner"
};
var _hoisted_4 = {
  "class": "row"
};
var _hoisted_5 = {
  "class": "col-lg-8 order-lg-last"
};
var _hoisted_6 = ["src"];
var _hoisted_7 = {
  "class": "col-lg-4 order-lg-first description"
};
var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h3", null, "Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, veritatis.", -1 /* HOISTED */);
var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, "Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore adipisci suscipit corrupti autem temporibus commodi, placeat quae ad enim magni.", -1 /* HOISTED */);
var _hoisted_10 = {
  href: "#"
};
function render(_ctx, _cache) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(9, function (i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["carousel-item slider", {
        active: i == 1
      }]),
      key: i
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
      src: i == 2 ? 'https://sju.org.sa/data/images/uploads/2022-12-27/abd4885d6a.jpeg' : 'https://sju.org.sa/data/images/uploads/2023-01-01/e93daac93a1.jpeg',
      alt: "Name"
    }, null, 8 /* PROPS */, _hoisted_6)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [_hoisted_8, _hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", _hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Details')), 1 /* TEXT */)])])], 2 /* CLASS */);
  }), 64 /* STABLE_FRAGMENT */))])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Statistics.vue?vue&type=template&id=c0a75216":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Statistics.vue?vue&type=template&id=c0a75216 ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "section stats"
};
var _hoisted_2 = {
  "class": "container"
};
var _hoisted_3 = {
  "class": "mb-5"
};
var _hoisted_4 = {
  "class": "row"
};
var _hoisted_5 = {
  "class": "col-6 col-md-3 stat mb-5"
};
var _hoisted_6 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<svg id=\"group_3_\" data-name=\"group (3)\" xmlns=\"http://www.w3.org/2000/svg\" width=\"90\" height=\"90\" viewBox=\"0 0 90 90\"><g id=\"Group_22\" data-name=\"Group 22\" transform=\"translate(34.5)\"><g id=\"Group_21\" data-name=\"Group 21\"><path id=\"Path_25\" data-name=\"Path 25\" d=\"M194.5,0A10.5,10.5,0,1,0,205,10.5,10.5,10.5,0,0,0,194.5,0Zm0,18a7.5,7.5,0,1,1,7.5-7.5A7.5,7.5,0,0,1,194.5,18Z\" transform=\"translate(-184)\" fill=\"#85c72e\"></path></g></g><g id=\"Group_24\" data-name=\"Group 24\" transform=\"translate(27 22.5)\"><g id=\"Group_23\" data-name=\"Group 23\"><path id=\"Path_26\" data-name=\"Path 26\" d=\"M166.5,120h-9A13.515,13.515,0,0,0,144,133.5V159h6v28.5h3V153h-3v3h-3V133.5A10.512,10.512,0,0,1,157.5,123h9A10.512,10.512,0,0,1,177,133.5V156h-3v-3h-3v34.5h3V159h6V133.5A13.515,13.515,0,0,0,166.5,120Z\" transform=\"translate(-144 -120)\" fill=\"#85c72e\"></path></g></g><g id=\"Group_26\" data-name=\"Group 26\" transform=\"translate(43.5 61.5)\"><g id=\"Group_25\" data-name=\"Group 25\"><rect id=\"Rectangle_20\" data-name=\"Rectangle 20\" width=\"3\" height=\"28\" transform=\"translate(0.5 0.5)\" fill=\"#85c72e\"></rect></g></g><g id=\"Group_28\" data-name=\"Group 28\" transform=\"translate(66 15)\"><g id=\"Group_27\" data-name=\"Group 27\"><path id=\"Path_27\" data-name=\"Path 27\" d=\"M361,80a9,9,0,1,0,9,9A9,9,0,0,0,361,80Zm0,15a6,6,0,1,1,6-6A6,6,0,0,1,361,95Z\" transform=\"translate(-352 -80)\" fill=\"#85c72e\"></path></g></g><g id=\"Group_30\" data-name=\"Group 30\" transform=\"translate(66 34.5)\"><g id=\"Group_29\" data-name=\"Group 29\"><path id=\"Path_28\" data-name=\"Path 28\" d=\"M365.5,184H352v3h13.5a7.509,7.509,0,0,1,7.5,7.5V214h-3v-3h-3v28.5h3V217h6V194.5A10.512,10.512,0,0,0,365.5,184Z\" transform=\"translate(-352 -184)\" fill=\"#85c72e\"></path></g></g><g id=\"Group_32\" data-name=\"Group 32\" transform=\"translate(60 61.5)\"><g id=\"Group_31\" data-name=\"Group 31\"><path id=\"Path_29\" data-name=\"Path 29\" d=\"M326,328v3h-6v3h6v22.5h3V328Z\" transform=\"translate(-320 -328)\" fill=\"#85c72e\"></path></g></g><g id=\"Group_34\" data-name=\"Group 34\" transform=\"translate(73.5 67.5)\"><g id=\"Group_33\" data-name=\"Group 33\"><rect id=\"Rectangle_21\" data-name=\"Rectangle 21\" width=\"3\" height=\"22\" transform=\"translate(0.5 0.5)\" fill=\"#85c72e\"></rect></g></g><g id=\"Group_36\" data-name=\"Group 36\" transform=\"translate(6 15)\"><g id=\"Group_35\" data-name=\"Group 35\"><path id=\"Path_30\" data-name=\"Path 30\" d=\"M41,80a9,9,0,1,0,9,9A9,9,0,0,0,41,80Zm0,15a6,6,0,1,1,6-6A6,6,0,0,1,41,95Z\" transform=\"translate(-32 -80)\" fill=\"#85c72e\"></path></g></g><g id=\"Group_38\" data-name=\"Group 38\" transform=\"translate(0 34.5)\"><g id=\"Group_37\" data-name=\"Group 37\"><path id=\"Path_31\" data-name=\"Path 31\" d=\"M10.5,184A10.512,10.512,0,0,0,0,194.5V217H6v22.5H9V211H6v3H3V194.5a7.509,7.509,0,0,1,7.5-7.5H24v-3Z\" transform=\"translate(0 -184)\" fill=\"#85c72e\"></path></g></g><g id=\"Group_40\" data-name=\"Group 40\" transform=\"translate(21 61.5)\"><g id=\"Group_39\" data-name=\"Group 39\"><path id=\"Path_32\" data-name=\"Path 32\" d=\"M115,331v-3h-3v28.5h3V334h6v-3Z\" transform=\"translate(-112 -328)\" fill=\"#85c72e\"></path></g></g><g id=\"Group_42\" data-name=\"Group 42\" transform=\"translate(13.5 67.5)\"><g id=\"Group_41\" data-name=\"Group 41\"><rect id=\"Rectangle_22\" data-name=\"Rectangle 22\" width=\"3\" height=\"22\" transform=\"translate(0.5 0.5)\" fill=\"#85c72e\"></rect></g></g></svg><h3>2,337</h3>", 2);
var _hoisted_8 = {
  "class": "col-6 col-md-3 stat mb-5"
};
var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"88.864\" height=\"89.844\" viewBox=\"0 0 88.864 89.844\"><g id=\"certificate_1_\" data-name=\"certificate (1)\" transform=\"translate(-2.794)\"><g id=\"Group_20\" data-name=\"Group 20\" transform=\"translate(2.794 0)\"><path id=\"Path_16\" data-name=\"Path 16\" d=\"M94.295,181.506H60.606a1.316,1.316,0,1,0,0,2.632H94.295a1.316,1.316,0,1,0,0-2.632Z\" transform=\"translate(-49.376 -149.656)\" fill=\"#85c72e\"></path><path id=\"Path_17\" data-name=\"Path 17\" d=\"M94.295,234.2H60.606a1.316,1.316,0,0,0,0,2.632H94.295a1.316,1.316,0,1,0,0-2.632Z\" transform=\"translate(-49.376 -193.105)\" fill=\"#85c72e\"></path><path id=\"Path_18\" data-name=\"Path 18\" d=\"M94.295,286.9H60.606a1.316,1.316,0,1,0,0,2.632H94.295a1.316,1.316,0,1,0,0-2.632Z\" transform=\"translate(-49.376 -236.553)\" fill=\"#85c72e\"></path><path id=\"Path_19\" data-name=\"Path 19\" d=\"M95.611,340.91a1.316,1.316,0,0,0-1.316-1.316H60.606a1.316,1.316,0,1,0,0,2.632H94.295A1.316,1.316,0,0,0,95.611,340.91Z\" transform=\"translate(-49.376 -280.003)\" fill=\"#85c72e\"></path><path id=\"Path_20\" data-name=\"Path 20\" d=\"M60.606,416.821a1.316,1.316,0,1,0,0,2.632H77.493a1.316,1.316,0,1,0,0-2.632Z\" transform=\"translate(-49.376 -343.678)\" fill=\"#85c72e\"></path><path id=\"Path_21\" data-name=\"Path 21\" d=\"M190.522,58.927v-4.27a2.953,2.953,0,0,0-2.95-2.95H160.554a2.953,2.953,0,0,0-2.95,2.95v4.27a2.953,2.953,0,0,0,2.95,2.95h2.282a1.316,1.316,0,1,0,0-2.632h-2.282a.318.318,0,0,1-.318-.318v-4.27a.319.319,0,0,1,.318-.318h27.018a.318.318,0,0,1,.318.318v4.27a.318.318,0,0,1-.318.318H168.988a1.316,1.316,0,0,0,0,2.632h18.584A2.953,2.953,0,0,0,190.522,58.927Z\" transform=\"translate(-130.438 -42.634)\" fill=\"#85c72e\"></path><path id=\"Path_22\" data-name=\"Path 22\" d=\"M72.717,80.245A1.316,1.316,0,0,0,71.4,81.561v1.772a3.884,3.884,0,0,1-3.879,3.879H9.305a3.884,3.884,0,0,1-3.879-3.879V20.079a3.906,3.906,0,0,1,.093-.836H17.5a4.542,4.542,0,0,0,4.537-4.537V2.725a3.9,3.9,0,0,1,.836-.093H67.522A3.884,3.884,0,0,1,71.4,6.511v17.52a1.316,1.316,0,1,0,2.632,0V6.511A6.518,6.518,0,0,0,67.522,0H22.873a6.469,6.469,0,0,0-4.6,1.907L4.7,15.475a6.468,6.468,0,0,0-1.907,4.6V83.333a6.518,6.518,0,0,0,6.511,6.511H67.522a6.519,6.519,0,0,0,6.511-6.511V81.561a1.316,1.316,0,0,0-1.316-1.316ZM19.406,4.493V14.707a1.907,1.907,0,0,1-1.9,1.9H7.287Z\" transform=\"translate(-2.794 0)\" fill=\"#85c72e\"></path><path id=\"Path_23\" data-name=\"Path 23\" d=\"M330.295,182.667a5.262,5.262,0,0,0-2.572-7.915,2.615,2.615,0,0,1-1.741-2.4,5.262,5.262,0,0,0-6.733-4.892,2.615,2.615,0,0,1-2.817-.915,5.262,5.262,0,0,0-8.323,0,2.615,2.615,0,0,1-2.816.915,5.262,5.262,0,0,0-6.733,4.892,2.615,2.615,0,0,1-1.741,2.4,5.262,5.262,0,0,0-2.572,7.915,2.615,2.615,0,0,1,0,2.962,5.262,5.262,0,0,0,2.572,7.916,2.615,2.615,0,0,1,1.741,2.4,5.262,5.262,0,0,0,4.544,5.054v11.981a2.793,2.793,0,0,0,4.257,2.378l4.826-2.971a.138.138,0,0,1,.169,0l4.826,2.971a2.793,2.793,0,0,0,4.257-2.379V200.994a5.261,5.261,0,0,0,4.544-5.054,2.615,2.615,0,0,1,1.741-2.4,5.262,5.262,0,0,0,2.572-7.916,2.613,2.613,0,0,1,0-2.961Zm-11.734,30.445-4.826-2.971a2.793,2.793,0,0,0-2.928,0l-4.826,2.971a.16.16,0,0,1-.245-.137V200.744a2.611,2.611,0,0,1,2.374,1,5.262,5.262,0,0,0,8.323,0,2.611,2.611,0,0,1,2.375-1v12.231A.16.16,0,0,1,318.561,213.113Zm9.559-26a2.63,2.63,0,0,1-1.286,3.956,5.232,5.232,0,0,0-3.483,4.794,2.594,2.594,0,0,1-.947,1.943,2.62,2.62,0,0,1-2.418.5,5.233,5.233,0,0,0-5.636,1.831,2.63,2.63,0,0,1-4.16,0,5.228,5.228,0,0,0-4.145-2.045,5.313,5.313,0,0,0-1.49.214,2.619,2.619,0,0,1-2.419-.5,2.592,2.592,0,0,1-.947-1.942,5.232,5.232,0,0,0-3.483-4.794,2.63,2.63,0,0,1-1.285-3.956,5.232,5.232,0,0,0,0-5.925,2.63,2.63,0,0,1,1.285-3.956,5.232,5.232,0,0,0,3.483-4.794,2.63,2.63,0,0,1,3.365-2.445,5.232,5.232,0,0,0,5.635-1.831,2.63,2.63,0,0,1,4.16,0,5.232,5.232,0,0,0,5.635,1.831,2.63,2.63,0,0,1,3.365,2.445,5.232,5.232,0,0,0,3.483,4.794,2.63,2.63,0,0,1,1.286,3.956,5.232,5.232,0,0,0,0,5.926Z\" transform=\"translate(-242.348 -135.64)\" fill=\"#85c72e\"></path><path id=\"Path_24\" data-name=\"Path 24\" d=\"M349.443,213.583a11.029,11.029,0,1,0,11.029,11.029A11.042,11.042,0,0,0,349.443,213.583Zm0,19.427a8.4,8.4,0,1,1,8.4-8.4A8.407,8.407,0,0,1,349.443,233.01Z\" transform=\"translate(-279.52 -176.104)\" fill=\"#85c72e\"></path></g></g></svg><h3>44</h3>", 2);
var _hoisted_11 = {
  "class": "col-6 col-md-3 stat mb-5"
};
var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<svg id=\"conference\" xmlns=\"http://www.w3.org/2000/svg\" width=\"89.844\" height=\"89.844\" viewBox=\"0 0 89.844 89.844\"><g id=\"Group_44\" data-name=\"Group 44\" transform=\"translate(43.663 41.983)\"><g id=\"Group_43\" data-name=\"Group 43\" transform=\"translate(0 0)\"><rect id=\"Rectangle_23\" data-name=\"Rectangle 23\" width=\"2\" height=\"3\" transform=\"translate(0.182 0.017)\" fill=\"#85c72e\"></rect></g></g><g id=\"Group_46\" data-name=\"Group 46\" transform=\"translate(40.304 47.861)\"><g id=\"Group_45\" data-name=\"Group 45\" transform=\"translate(0 0)\"><rect id=\"Rectangle_24\" data-name=\"Rectangle 24\" width=\"10\" height=\"3\" transform=\"translate(-0.46 0.139)\" fill=\"#85c72e\"></rect></g></g><g id=\"Group_48\" data-name=\"Group 48\" transform=\"translate(4.492 67.376)\"><g id=\"Group_47\" data-name=\"Group 47\"><path id=\"Path_33\" data-name=\"Path 33\" d=\"M95.953,367.452a8.942,8.942,0,0,0-1.688.153,8.971,8.971,0,0,0-17.744,0,8.559,8.559,0,0,0-3.219,0,8.971,8.971,0,0,0-17.744,0,8.559,8.559,0,0,0-3.219,0,8.971,8.971,0,0,0-17.744,0A8.947,8.947,0,0,0,24,376.439v4.492a1.5,1.5,0,0,0,1.5,1.5H40.471a1.5,1.5,0,0,0,1.5-1.5v-4.492a8.986,8.986,0,0,0-.135-1.5H45.1a8.986,8.986,0,0,0-.135,1.5v4.492a1.5,1.5,0,0,0,1.5,1.5H61.435a1.5,1.5,0,0,0,1.5-1.5v-4.492a8.986,8.986,0,0,0-.135-1.5h3.264a8.986,8.986,0,0,0-.135,1.5v4.492a1.5,1.5,0,0,0,1.5,1.5H82.4a1.5,1.5,0,0,0,1.5-1.5v-4.492a8.986,8.986,0,0,0-.135-1.5h3.264a8.985,8.985,0,0,0-.135,1.5v4.492a1.5,1.5,0,0,0,1.5,1.5h14.974a1.5,1.5,0,0,0,1.5-1.5v-4.492A8.947,8.947,0,0,0,95.953,367.452Zm-56.98,11.982H26.994v-2.995a5.99,5.99,0,1,1,11.979,0Zm7.206-7.487H40.753a9.029,9.029,0,0,0-3.249-3.26,5.967,5.967,0,0,1,11.925,0A9.029,9.029,0,0,0,46.179,371.947Zm13.758,7.487H47.958v-2.995a5.99,5.99,0,1,1,11.979,0Zm7.206-7.487H61.716a9.029,9.029,0,0,0-3.249-3.26,5.967,5.967,0,0,1,11.925,0A9.029,9.029,0,0,0,67.143,371.947ZM80.9,379.434H68.922v-2.995a5.99,5.99,0,1,1,11.979,0Zm7.206-7.487H82.68a9.029,9.029,0,0,0-3.249-3.26,5.967,5.967,0,0,1,11.925,0A9.029,9.029,0,0,0,88.107,371.947Zm13.758,7.487H89.885v-2.995a5.99,5.99,0,1,1,11.979,0Z\" transform=\"translate(-24 -359.96)\" fill=\"#85c72e\"></path></g></g><g id=\"Group_50\" data-name=\"Group 50\"><g id=\"Group_49\" data-name=\"Group 49\"><path id=\"Path_34\" data-name=\"Path 34\" d=\"M88.347,0H1.5A1.5,1.5,0,0,0,0,1.5v5.99a1.5,1.5,0,0,0,1.5,1.5H4.492v40.43a1.5,1.5,0,0,0,1.5,1.5H33.5l.69,4.492H32.943a1.5,1.5,0,0,0-1.5,1.5v5.99a1.5,1.5,0,0,0,1.5,1.5H56.9a1.5,1.5,0,0,0,1.5-1.5V56.9a1.5,1.5,0,0,0-1.5-1.5H55.653l.69-4.492H83.855a1.5,1.5,0,0,0,1.5-1.5V8.984h2.995a1.5,1.5,0,0,0,1.5-1.5V1.5A1.5,1.5,0,0,0,88.347,0ZM55.4,61.394H34.44V58.4H55.4ZM34.689,38.932H55.155L52.622,55.4h-15.4ZM29.62,35.938l-.749-2.995h32.1l-.749,2.995ZM82.357,47.917H56.8l1.382-8.984h3.207A1.5,1.5,0,0,0,62.846,37.8l1.5-5.99a1.5,1.5,0,0,0-1.452-1.86H59.9V25.456a1.5,1.5,0,0,0-.439-1.059L56.452,21.39a4.419,4.419,0,0,0,.449-1.924,4.492,4.492,0,1,0-4.492,4.492,4.419,4.419,0,0,0,1.924-.449L56.9,26.076v3.872H32.943V26.076l2.568-2.567a4.419,4.419,0,0,0,1.924.449,4.492,4.492,0,1,0-4.492-4.492,4.419,4.419,0,0,0,.449,1.924L30.385,24.4a1.5,1.5,0,0,0-.437,1.059v4.492H26.953a1.5,1.5,0,0,0-1.452,1.86L27,37.8a1.5,1.5,0,0,0,1.452,1.135h3.207l1.382,8.984H7.487V8.984h74.87ZM53.907,19.466a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,53.907,19.466Zm-17.969,0a1.5,1.5,0,1,1,1.5,1.5A1.5,1.5,0,0,1,35.938,19.466ZM86.849,5.99H2.995V2.995H86.849Z\" fill=\"#85c72e\"></path></g></g></svg><h3>451</h3>", 2);
var _hoisted_14 = {
  "class": "col-6 col-md-3 stat mb-5"
};
var _hoisted_15 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"89.844\" height=\"89.844\" viewBox=\"0 0 89.844 89.844\"><g id=\"online-conference\" transform=\"translate(-1 -1)\"><path id=\"Path_35\" data-name=\"Path 35\" d=\"M15.449,29.982H64.718a1.449,1.449,0,0,0,1.449-1.449V2.449A1.449,1.449,0,0,0,64.718,1H15.449A1.449,1.449,0,0,0,14,2.449V28.533A1.449,1.449,0,0,0,15.449,29.982Zm31.88-2.9H45.88v-2.9h-2.9v2.9h-5.8v-2.9h-2.9v2.9H32.838V22.736a1.451,1.451,0,0,1,1.449-1.449H45.88a1.451,1.451,0,0,1,1.449,1.449ZM16.9,3.9H63.269V27.084H50.227V22.736a4.353,4.353,0,0,0-4.347-4.347H34.287a4.353,4.353,0,0,0-4.347,4.347v4.347H16.9Z\" transform=\"translate(5.838 0)\" fill=\"#85c72e\"></path><path id=\"Path_36\" data-name=\"Path 36\" d=\"M1.636,35.529a1.453,1.453,0,0,0,1.351.146l14.491-5.8a1.451,1.451,0,0,0,.911-1.346V2.449A1.449,1.449,0,0,0,16.4,1.1L1.911,6.9A1.451,1.451,0,0,0,1,8.246V34.329a1.451,1.451,0,0,0,.636,1.2ZM3.9,9.227,15.491,4.59V27.552L3.9,32.189Z\" transform=\"translate(0 0)\" fill=\"#85c72e\"></path><path id=\"Path_37\" data-name=\"Path 37\" d=\"M67.478,6.9,52.987,1.1A1.449,1.449,0,0,0,51,2.449V28.533a1.451,1.451,0,0,0,.911,1.346l14.491,5.8a1.453,1.453,0,0,0,1.351-.146,1.451,1.451,0,0,0,.636-1.2V8.245A1.451,1.451,0,0,0,67.478,6.9Zm-1.987,25.29L53.9,27.552V4.589L65.491,9.227Z\" transform=\"translate(22.454 0)\" fill=\"#85c72e\"></path><path id=\"Path_38\" data-name=\"Path 38\" d=\"M28,8.8v2.9a5.8,5.8,0,1,0,11.593,0V8.8A5.8,5.8,0,1,0,28,8.8Zm2.9,0a2.9,2.9,0,1,1,5.8,0v2.9a2.9,2.9,0,1,1-5.8,0Z\" transform=\"translate(12.125 0.898)\" fill=\"#85c72e\"></path><path id=\"Path_39\" data-name=\"Path 39\" d=\"M42.78,48.58a8.654,8.654,0,0,0,2.405-5.988v-2.9a8.695,8.695,0,1,0-17.389,0v2.9A8.654,8.654,0,0,0,30.2,48.58,10.158,10.158,0,0,0,22,58.533v5.8a1.448,1.448,0,0,0,1.449,1.449H49.533a1.448,1.448,0,0,0,1.449-1.449v-5.8A10.158,10.158,0,0,0,42.78,48.58ZM30.695,39.695a5.8,5.8,0,1,1,11.593,0v2.9a5.8,5.8,0,1,1-11.593,0ZM48.084,62.88h-2.9v-5.8h-2.9v5.8H30.695v-5.8H27.8v5.8H24.9V58.533a7.254,7.254,0,0,1,7.245-7.245h8.695a7.254,7.254,0,0,1,7.245,7.245Z\" transform=\"translate(9.431 13.473)\" fill=\"#85c72e\"></path><path id=\"Path_40\" data-name=\"Path 40\" d=\"M63.78,56.58a8.654,8.654,0,0,0,2.405-5.988v-2.9a8.695,8.695,0,1,0-17.389,0v2.9A8.654,8.654,0,0,0,51.2,56.58,10.158,10.158,0,0,0,43,66.533v5.8a1.448,1.448,0,0,0,1.449,1.449H70.533a1.448,1.448,0,0,0,1.449-1.449v-5.8A10.158,10.158,0,0,0,63.78,56.58ZM51.695,47.695a5.8,5.8,0,1,1,11.593,0v2.9a5.8,5.8,0,1,1-11.593,0ZM69.084,70.88h-2.9v-5.8h-2.9v5.8H51.695v-5.8H48.8v5.8H45.9V66.533a7.254,7.254,0,0,1,7.245-7.245h8.695a7.254,7.254,0,0,1,7.245,7.245Z\" transform=\"translate(18.862 17.066)\" fill=\"#85c72e\"></path><path id=\"Path_41\" data-name=\"Path 41\" d=\"M21.78,56.58a8.654,8.654,0,0,0,2.405-5.988v-2.9a8.695,8.695,0,1,0-17.389,0v2.9A8.654,8.654,0,0,0,9.2,56.58,10.158,10.158,0,0,0,1,66.533v5.8a1.448,1.448,0,0,0,1.449,1.449H28.533a1.448,1.448,0,0,0,1.449-1.449v-5.8A10.158,10.158,0,0,0,21.78,56.58ZM9.695,47.695a5.8,5.8,0,1,1,11.593,0v2.9a5.8,5.8,0,0,1-11.593,0ZM27.084,70.88h-2.9v-5.8h-2.9v5.8H9.695v-5.8H6.8v5.8H3.9V66.533a7.254,7.254,0,0,1,7.245-7.245h8.695a7.254,7.254,0,0,1,7.245,7.245Z\" transform=\"translate(0 17.066)\" fill=\"#85c72e\"></path><path id=\"Path_42\" data-name=\"Path 42\" d=\"M14,27h2.9v2.9H14Z\" transform=\"translate(5.838 11.677)\" fill=\"#85c72e\"></path><path id=\"Path_43\" data-name=\"Path 43\" d=\"M17,27h2.9v2.9H17Z\" transform=\"translate(7.185 11.677)\" fill=\"#85c72e\"></path><path id=\"Path_44\" data-name=\"Path 44\" d=\"M20,27h2.9v2.9H20Z\" transform=\"translate(8.533 11.677)\" fill=\"#85c72e\"></path><path id=\"Path_45\" data-name=\"Path 45\" d=\"M27.389,37.491h1.449a4.353,4.353,0,0,0,4.347-4.347v-5.8A4.353,4.353,0,0,0,28.838,23H14.347A4.353,4.353,0,0,0,10,27.347v5.8a4.353,4.353,0,0,0,4.347,4.347h5.314l5.409,4.057a1.442,1.442,0,0,0,.869.29,1.447,1.447,0,0,0,1.449-1.449Zm-1.449-2.9a1.449,1.449,0,0,0-1.449,1.449v1.449l-3.478-2.608a1.445,1.445,0,0,0-.869-.29h-5.8A1.451,1.451,0,0,1,12.9,33.144v-5.8A1.451,1.451,0,0,1,14.347,25.9H28.838a1.451,1.451,0,0,1,1.449,1.449v5.8a1.451,1.451,0,0,1-1.449,1.449Z\" transform=\"translate(4.042 9.88)\" fill=\"#85c72e\"></path><path id=\"Path_46\" data-name=\"Path 46\" d=\"M48,30h2.9v2.9H48Z\" transform=\"translate(21.107 13.024)\" fill=\"#85c72e\"></path><path id=\"Path_47\" data-name=\"Path 47\" d=\"M45,30h2.9v2.9H45Z\" transform=\"translate(19.76 13.024)\" fill=\"#85c72e\"></path><path id=\"Path_48\" data-name=\"Path 48\" d=\"M42,30h2.9v2.9H42Z\" transform=\"translate(18.413 13.024)\" fill=\"#85c72e\"></path><path id=\"Path_49\" data-name=\"Path 49\" d=\"M46.115,23.29A1.449,1.449,0,0,0,43.8,24.449v2.9H42.347A4.353,4.353,0,0,0,38,31.695v5.8a4.353,4.353,0,0,0,4.347,4.347H56.838a4.353,4.353,0,0,0,4.347-4.347v-5.8a4.353,4.353,0,0,0-4.347-4.347H51.524Zm12.172,8.4v5.8a1.45,1.45,0,0,1-1.449,1.449H42.347A1.45,1.45,0,0,1,40.9,37.491v-5.8a1.451,1.451,0,0,1,1.449-1.449h2.9A1.449,1.449,0,0,0,46.695,28.8V27.348l3.478,2.608a1.445,1.445,0,0,0,.869.29h5.8A1.451,1.451,0,0,1,58.287,31.695Z\" transform=\"translate(16.616 9.88)\" fill=\"#85c72e\"></path></g></svg><h3>442</h3>", 2);
function render(_ctx, _cache) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Statistics')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [_hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Total members')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [_hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Memberships')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [_hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Conferences')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [_hoisted_15, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Workshops')), 1 /* TEXT */)])])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=template&id=42042b28":
/*!***************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=template&id=42042b28 ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "section media-center"
};
var _hoisted_2 = {
  "class": "container"
};
var _hoisted_3 = {
  "class": "row"
};
var _hoisted_4 = {
  "class": "col-10"
};
var _hoisted_5 = {
  "class": "row mt-3"
};
var _hoisted_6 = {
  "class": "nav nav-pills mb-3",
  id: "pills-tab",
  role: "tablist"
};
var _hoisted_7 = {
  "class": "nav-item"
};
var _hoisted_8 = {
  "class": "nav-link active",
  id: "pills-all-tab",
  "data-toggle": "pill",
  href: "#pills-all",
  role: "tab",
  "aria-controls": "pills-all",
  "aria-selected": "true"
};
var _hoisted_9 = {
  "class": "nav-item"
};
var _hoisted_10 = {
  "class": "nav-link",
  id: "pills-photos-tab",
  "data-toggle": "pill",
  href: "#pills-photos",
  role: "tab",
  "aria-controls": "pills-photos",
  "aria-selected": "false"
};
var _hoisted_11 = {
  "class": "nav-item"
};
var _hoisted_12 = {
  "class": "nav-link",
  id: "pills-videos-tab",
  "data-toggle": "pill",
  href: "#pills-videos",
  role: "tab",
  "aria-controls": "pills-videos",
  "aria-selected": "false"
};
var _hoisted_13 = {
  "class": "tab-content",
  id: "pills-all"
};
var _hoisted_14 = {
  "class": "tab-pane fade show active",
  id: "pills-all",
  role: "tabpanel",
  "aria-labelledby": "pills-all-tab"
};
var _hoisted_15 = {
  "class": "row mt-3"
};
var _hoisted_16 = {
  "class": "col-md-4 mb-3"
};
var _hoisted_17 = {
  "class": "post img-popup",
  style: {
    "background": "linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7)), url('https://sju.org.sa/data/media/photos/ksa2022.jpeg')"
  },
  src: "https://sju.org.sa/data/media/photos/ksa2022.jpeg"
};
var _hoisted_18 = {
  "class": "category"
};
var _hoisted_19 = {
  "class": "col-md-4 mb-3"
};
var _hoisted_20 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("iframe", {
  "class": "",
  width: "352",
  height: "260",
  src: "https://www.youtube.com/embed/4pK-npQiW4I",
  title: "YouTube video player",
  frameborder: "0",
  allow: "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture",
  allowfullscreen: ""
}, null, -1 /* HOISTED */);
var _hoisted_21 = [_hoisted_20];
var _hoisted_22 = {
  "class": "tab-pane fade",
  id: "pills-photos",
  role: "tabpanel",
  "aria-labelledby": "pills-photos-tab"
};
var _hoisted_23 = {
  "class": "row mt-3"
};
var _hoisted_24 = {
  "class": "col-md-4 mb-3"
};
var _hoisted_25 = {
  "class": "post img-popup",
  style: {
    "background": "linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7)), url('https://sju.org.sa/data/media/photos/ksa2022.jpeg')"
  },
  src: "https://sju.org.sa/data/media/photos/ksa2022.jpeg"
};
var _hoisted_26 = {
  "class": "category"
};
var _hoisted_27 = {
  "class": "tab-pane fade",
  id: "pills-videos",
  role: "tabpanel",
  "aria-labelledby": "pills-videos-tab"
};
var _hoisted_28 = {
  "class": "row mt-3"
};
var _hoisted_29 = {
  "class": "col-md-4 mb-3"
};
var _hoisted_30 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("iframe", {
  "class": "",
  width: "352",
  height: "260",
  src: "https://www.youtube.com/embed/4pK-npQiW4I",
  title: "YouTube video player",
  frameborder: "0",
  allow: "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture",
  allowfullscreen: ""
}, null, -1 /* HOISTED */);
var _hoisted_31 = [_hoisted_30];
var _hoisted_32 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  id: "modal",
  "class": "modal extend"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "close"
}, "×"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
  "class": "modal-content"
}), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "caption"
})], -1 /* HOISTED */);

function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Studio')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", _hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('All')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", _hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Photos')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", _hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Videos')), 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(6, function (i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Photo')), 1 /* TEXT */)])])]);
  }), 64 /* STABLE_FRAGMENT */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(0, function (x) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, _hoisted_21);
  }), 64 /* STABLE_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(6, function (i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Photo')), 1 /* TEXT */)])])]);
  }), 64 /* STABLE_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(0, function (x) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, _hoisted_31);
  }), 64 /* STABLE_FRAGMENT */))])])])])]), _hoisted_32]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=template&id=f311f62a":
/*!***************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=template&id=f311f62a ***!
  \***************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "homepage"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" News Slider "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["Slider"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" News Slider "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" About the organization "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["AboutUs"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" About the organization "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Media center "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["MediaCenter"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Media center "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Studio "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["Studio"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Studio "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Regulations and Events "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["RegulationsAndEvents"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Regulations and Events "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Membership "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["Membership"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Membership "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Statistics "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["Statistics"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Statistics "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Follow us "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["FollowUs"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Follow us "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("\r\n        POP UP AD MODAL\r\n\r\n        <div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\r\n          <div class=\"modal-dialog\" role=\"document\">\r\n            <div class=\"modal-content\">              \r\n              <div class=\"modal-body\">\r\n                 <img src=\"https://www7.0zz0.com/2022/09/22/14/810690393.jpg\" style=\"width: 100%;\"/>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div> \r\n        ")]);
}

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=style&index=0&id=42042b28&lang=css":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=style&index=0&id=42042b28&lang=css ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.nav-pills .nav-link.active,\r\n.nav-pills .show > .nav-link {\r\n    background-color: #007c42;\r\n    transition: all 0.3s;\n}\n.nav-pills .nav-link:hover {\r\n    background-color: #0aa75d;\r\n    transition: all 0.3s;\r\n    color: #fff;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=style&index=0&id=f311f62a&lang=css":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=style&index=0&id=f311f62a&lang=css ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.modal-dialog {\r\n    max-width: 100% !important;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/api.js":
/*!*****************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/api.js ***!
  \*****************************************************/
/***/ ((module) => {



/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
// eslint-disable-next-line func-names
module.exports = function (cssWithMappingToString) {
  var list = []; // return the list of modules as css string

  list.toString = function toString() {
    return this.map(function (item) {
      var content = cssWithMappingToString(item);

      if (item[2]) {
        return "@media ".concat(item[2], " {").concat(content, "}");
      }

      return content;
    }).join("");
  }; // import a list of modules into the list
  // eslint-disable-next-line func-names


  list.i = function (modules, mediaQuery, dedupe) {
    if (typeof modules === "string") {
      // eslint-disable-next-line no-param-reassign
      modules = [[null, modules, ""]];
    }

    var alreadyImportedModules = {};

    if (dedupe) {
      for (var i = 0; i < this.length; i++) {
        // eslint-disable-next-line prefer-destructuring
        var id = this[i][0];

        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }

    for (var _i = 0; _i < modules.length; _i++) {
      var item = [].concat(modules[_i]);

      if (dedupe && alreadyImportedModules[item[0]]) {
        // eslint-disable-next-line no-continue
        continue;
      }

      if (mediaQuery) {
        if (!item[2]) {
          item[2] = mediaQuery;
        } else {
          item[2] = "".concat(mediaQuery, " and ").concat(item[2]);
        }
      }

      list.push(item);
    }
  };

  return list;
};

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=style&index=0&id=42042b28&lang=css":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=style&index=0&id=42042b28&lang=css ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Studio_vue_vue_type_style_index_0_id_42042b28_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Studio.vue?vue&type=style&index=0&id=42042b28&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=style&index=0&id=42042b28&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Studio_vue_vue_type_style_index_0_id_42042b28_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Studio_vue_vue_type_style_index_0_id_42042b28_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=style&index=0&id=f311f62a&lang=css":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=style&index=0&id=f311f62a&lang=css ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_style_index_0_id_f311f62a_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Index.vue?vue&type=style&index=0&id=f311f62a&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=style&index=0&id=f311f62a&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_style_index_0_id_f311f62a_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_style_index_0_id_f311f62a_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {



var isOldIE = function isOldIE() {
  var memo;
  return function memorize() {
    if (typeof memo === 'undefined') {
      // Test for IE <= 9 as proposed by Browserhacks
      // @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
      // Tests for existence of standard globals is to allow style-loader
      // to operate correctly into non-standard environments
      // @see https://github.com/webpack-contrib/style-loader/issues/177
      memo = Boolean(window && document && document.all && !window.atob);
    }

    return memo;
  };
}();

var getTarget = function getTarget() {
  var memo = {};
  return function memorize(target) {
    if (typeof memo[target] === 'undefined') {
      var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

      if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
        try {
          // This will throw an exception if access to iframe is blocked
          // due to cross-origin restrictions
          styleTarget = styleTarget.contentDocument.head;
        } catch (e) {
          // istanbul ignore next
          styleTarget = null;
        }
      }

      memo[target] = styleTarget;
    }

    return memo[target];
  };
}();

var stylesInDom = [];

function getIndexByIdentifier(identifier) {
  var result = -1;

  for (var i = 0; i < stylesInDom.length; i++) {
    if (stylesInDom[i].identifier === identifier) {
      result = i;
      break;
    }
  }

  return result;
}

function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var index = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3]
    };

    if (index !== -1) {
      stylesInDom[index].references++;
      stylesInDom[index].updater(obj);
    } else {
      stylesInDom.push({
        identifier: identifier,
        updater: addStyle(obj, options),
        references: 1
      });
    }

    identifiers.push(identifier);
  }

  return identifiers;
}

function insertStyleElement(options) {
  var style = document.createElement('style');
  var attributes = options.attributes || {};

  if (typeof attributes.nonce === 'undefined') {
    var nonce =  true ? __webpack_require__.nc : 0;

    if (nonce) {
      attributes.nonce = nonce;
    }
  }

  Object.keys(attributes).forEach(function (key) {
    style.setAttribute(key, attributes[key]);
  });

  if (typeof options.insert === 'function') {
    options.insert(style);
  } else {
    var target = getTarget(options.insert || 'head');

    if (!target) {
      throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
    }

    target.appendChild(style);
  }

  return style;
}

function removeStyleElement(style) {
  // istanbul ignore if
  if (style.parentNode === null) {
    return false;
  }

  style.parentNode.removeChild(style);
}
/* istanbul ignore next  */


var replaceText = function replaceText() {
  var textStore = [];
  return function replace(index, replacement) {
    textStore[index] = replacement;
    return textStore.filter(Boolean).join('\n');
  };
}();

function applyToSingletonTag(style, index, remove, obj) {
  var css = remove ? '' : obj.media ? "@media ".concat(obj.media, " {").concat(obj.css, "}") : obj.css; // For old IE

  /* istanbul ignore if  */

  if (style.styleSheet) {
    style.styleSheet.cssText = replaceText(index, css);
  } else {
    var cssNode = document.createTextNode(css);
    var childNodes = style.childNodes;

    if (childNodes[index]) {
      style.removeChild(childNodes[index]);
    }

    if (childNodes.length) {
      style.insertBefore(cssNode, childNodes[index]);
    } else {
      style.appendChild(cssNode);
    }
  }
}

function applyToTag(style, options, obj) {
  var css = obj.css;
  var media = obj.media;
  var sourceMap = obj.sourceMap;

  if (media) {
    style.setAttribute('media', media);
  } else {
    style.removeAttribute('media');
  }

  if (sourceMap && typeof btoa !== 'undefined') {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  if (style.styleSheet) {
    style.styleSheet.cssText = css;
  } else {
    while (style.firstChild) {
      style.removeChild(style.firstChild);
    }

    style.appendChild(document.createTextNode(css));
  }
}

var singleton = null;
var singletonCounter = 0;

function addStyle(obj, options) {
  var style;
  var update;
  var remove;

  if (options.singleton) {
    var styleIndex = singletonCounter++;
    style = singleton || (singleton = insertStyleElement(options));
    update = applyToSingletonTag.bind(null, style, styleIndex, false);
    remove = applyToSingletonTag.bind(null, style, styleIndex, true);
  } else {
    style = insertStyleElement(options);
    update = applyToTag.bind(null, style, options);

    remove = function remove() {
      removeStyleElement(style);
    };
  }

  update(obj);
  return function updateStyle(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap) {
        return;
      }

      update(obj = newObj);
    } else {
      remove();
    }
  };
}

module.exports = function (list, options) {
  options = options || {}; // Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
  // tags it will allow on a page

  if (!options.singleton && typeof options.singleton !== 'boolean') {
    options.singleton = isOldIE();
  }

  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];

    if (Object.prototype.toString.call(newList) !== '[object Array]') {
      return;
    }

    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDom[index].references--;
    }

    var newLastIdentifiers = modulesToDom(newList, options);

    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];

      var _index = getIndexByIdentifier(_identifier);

      if (stylesInDom[_index].references === 0) {
        stylesInDom[_index].updater();

        stylesInDom.splice(_index, 1);
      }
    }

    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ }),

/***/ "./resources/js/Pages/Home/Components/AboutUs.vue":
/*!********************************************************!*\
  !*** ./resources/js/Pages/Home/Components/AboutUs.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _AboutUs_vue_vue_type_template_id_3a637cae__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AboutUs.vue?vue&type=template&id=3a637cae */ "./resources/js/Pages/Home/Components/AboutUs.vue?vue&type=template&id=3a637cae");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");

const script = {}

;
const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__["default"])(script, [['render',_AboutUs_vue_vue_type_template_id_3a637cae__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Home/Components/AboutUs.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Home/Components/FollowUs.vue":
/*!*********************************************************!*\
  !*** ./resources/js/Pages/Home/Components/FollowUs.vue ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _FollowUs_vue_vue_type_template_id_2d1976fe__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./FollowUs.vue?vue&type=template&id=2d1976fe */ "./resources/js/Pages/Home/Components/FollowUs.vue?vue&type=template&id=2d1976fe");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");

const script = {}

;
const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__["default"])(script, [['render',_FollowUs_vue_vue_type_template_id_2d1976fe__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Home/Components/FollowUs.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Home/Components/MediaCenter.vue":
/*!************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/MediaCenter.vue ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _MediaCenter_vue_vue_type_template_id_71c33412__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MediaCenter.vue?vue&type=template&id=71c33412 */ "./resources/js/Pages/Home/Components/MediaCenter.vue?vue&type=template&id=71c33412");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");

const script = {}

;
const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__["default"])(script, [['render',_MediaCenter_vue_vue_type_template_id_71c33412__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Home/Components/MediaCenter.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Home/Components/Membership.vue":
/*!***********************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Membership.vue ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Membership_vue_vue_type_template_id_46ec9c28__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Membership.vue?vue&type=template&id=46ec9c28 */ "./resources/js/Pages/Home/Components/Membership.vue?vue&type=template&id=46ec9c28");
/* harmony import */ var _Membership_vue_vue_type_script_defer_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Membership.vue?vue&type=script&defer=true&lang=js */ "./resources/js/Pages/Home/Components/Membership.vue?vue&type=script&defer=true&lang=js");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_Membership_vue_vue_type_script_defer_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Membership_vue_vue_type_template_id_46ec9c28__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Home/Components/Membership.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Home/Components/RegulationsAndEvents.vue":
/*!*********************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/RegulationsAndEvents.vue ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _RegulationsAndEvents_vue_vue_type_template_id_b77ea5ce__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RegulationsAndEvents.vue?vue&type=template&id=b77ea5ce */ "./resources/js/Pages/Home/Components/RegulationsAndEvents.vue?vue&type=template&id=b77ea5ce");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");

const script = {}

;
const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__["default"])(script, [['render',_RegulationsAndEvents_vue_vue_type_template_id_b77ea5ce__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Home/Components/RegulationsAndEvents.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Home/Components/Slider.vue":
/*!*******************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Slider.vue ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Slider_vue_vue_type_template_id_8aad069a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Slider.vue?vue&type=template&id=8aad069a */ "./resources/js/Pages/Home/Components/Slider.vue?vue&type=template&id=8aad069a");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");

const script = {}

;
const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__["default"])(script, [['render',_Slider_vue_vue_type_template_id_8aad069a__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Home/Components/Slider.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Home/Components/Statistics.vue":
/*!***********************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Statistics.vue ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Statistics_vue_vue_type_template_id_c0a75216__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Statistics.vue?vue&type=template&id=c0a75216 */ "./resources/js/Pages/Home/Components/Statistics.vue?vue&type=template&id=c0a75216");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");

const script = {}

;
const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_1__["default"])(script, [['render',_Statistics_vue_vue_type_template_id_c0a75216__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Home/Components/Statistics.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Home/Components/Studio.vue":
/*!*******************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Studio.vue ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Studio_vue_vue_type_template_id_42042b28__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Studio.vue?vue&type=template&id=42042b28 */ "./resources/js/Pages/Home/Components/Studio.vue?vue&type=template&id=42042b28");
/* harmony import */ var _Studio_vue_vue_type_script_defer_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Studio.vue?vue&type=script&defer=true&lang=js */ "./resources/js/Pages/Home/Components/Studio.vue?vue&type=script&defer=true&lang=js");
/* harmony import */ var _Studio_vue_vue_type_style_index_0_id_42042b28_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Studio.vue?vue&type=style&index=0&id=42042b28&lang=css */ "./resources/js/Pages/Home/Components/Studio.vue?vue&type=style&index=0&id=42042b28&lang=css");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_Studio_vue_vue_type_script_defer_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Studio_vue_vue_type_template_id_42042b28__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Home/Components/Studio.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Home/Index.vue":
/*!*******************************************!*\
  !*** ./resources/js/Pages/Home/Index.vue ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Index_vue_vue_type_template_id_f311f62a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=f311f62a */ "./resources/js/Pages/Home/Index.vue?vue&type=template&id=f311f62a");
/* harmony import */ var _Index_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Pages/Home/Index.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _Index_vue_vue_type_style_index_0_id_f311f62a_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Index.vue?vue&type=style&index=0&id=f311f62a&lang=css */ "./resources/js/Pages/Home/Index.vue?vue&type=style&index=0&id=f311f62a&lang=css");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_Index_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Index_vue_vue_type_template_id_f311f62a__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Home/Index.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Home/Components/Membership.vue?vue&type=script&defer=true&lang=js":
/*!**********************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Membership.vue?vue&type=script&defer=true&lang=js ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Membership_vue_vue_type_script_defer_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Membership_vue_vue_type_script_defer_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Membership.vue?vue&type=script&defer=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Membership.vue?vue&type=script&defer=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Home/Components/Studio.vue?vue&type=script&defer=true&lang=js":
/*!******************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Studio.vue?vue&type=script&defer=true&lang=js ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Studio_vue_vue_type_script_defer_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Studio_vue_vue_type_script_defer_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Studio.vue?vue&type=script&defer=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=script&defer=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Home/Index.vue?vue&type=script&setup=true&lang=js":
/*!******************************************************************************!*\
  !*** ./resources/js/Pages/Home/Index.vue?vue&type=script&setup=true&lang=js ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Index.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Home/Components/AboutUs.vue?vue&type=template&id=3a637cae":
/*!**************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/AboutUs.vue?vue&type=template&id=3a637cae ***!
  \**************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AboutUs_vue_vue_type_template_id_3a637cae__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AboutUs_vue_vue_type_template_id_3a637cae__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AboutUs.vue?vue&type=template&id=3a637cae */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/AboutUs.vue?vue&type=template&id=3a637cae");


/***/ }),

/***/ "./resources/js/Pages/Home/Components/FollowUs.vue?vue&type=template&id=2d1976fe":
/*!***************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/FollowUs.vue?vue&type=template&id=2d1976fe ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_FollowUs_vue_vue_type_template_id_2d1976fe__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_FollowUs_vue_vue_type_template_id_2d1976fe__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./FollowUs.vue?vue&type=template&id=2d1976fe */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/FollowUs.vue?vue&type=template&id=2d1976fe");


/***/ }),

/***/ "./resources/js/Pages/Home/Components/MediaCenter.vue?vue&type=template&id=71c33412":
/*!******************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/MediaCenter.vue?vue&type=template&id=71c33412 ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MediaCenter_vue_vue_type_template_id_71c33412__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MediaCenter_vue_vue_type_template_id_71c33412__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MediaCenter.vue?vue&type=template&id=71c33412 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/MediaCenter.vue?vue&type=template&id=71c33412");


/***/ }),

/***/ "./resources/js/Pages/Home/Components/Membership.vue?vue&type=template&id=46ec9c28":
/*!*****************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Membership.vue?vue&type=template&id=46ec9c28 ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Membership_vue_vue_type_template_id_46ec9c28__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Membership_vue_vue_type_template_id_46ec9c28__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Membership.vue?vue&type=template&id=46ec9c28 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Membership.vue?vue&type=template&id=46ec9c28");


/***/ }),

/***/ "./resources/js/Pages/Home/Components/RegulationsAndEvents.vue?vue&type=template&id=b77ea5ce":
/*!***************************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/RegulationsAndEvents.vue?vue&type=template&id=b77ea5ce ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RegulationsAndEvents_vue_vue_type_template_id_b77ea5ce__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RegulationsAndEvents_vue_vue_type_template_id_b77ea5ce__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./RegulationsAndEvents.vue?vue&type=template&id=b77ea5ce */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/RegulationsAndEvents.vue?vue&type=template&id=b77ea5ce");


/***/ }),

/***/ "./resources/js/Pages/Home/Components/Slider.vue?vue&type=template&id=8aad069a":
/*!*************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Slider.vue?vue&type=template&id=8aad069a ***!
  \*************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Slider_vue_vue_type_template_id_8aad069a__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Slider_vue_vue_type_template_id_8aad069a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Slider.vue?vue&type=template&id=8aad069a */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Slider.vue?vue&type=template&id=8aad069a");


/***/ }),

/***/ "./resources/js/Pages/Home/Components/Statistics.vue?vue&type=template&id=c0a75216":
/*!*****************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Statistics.vue?vue&type=template&id=c0a75216 ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Statistics_vue_vue_type_template_id_c0a75216__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Statistics_vue_vue_type_template_id_c0a75216__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Statistics.vue?vue&type=template&id=c0a75216 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Statistics.vue?vue&type=template&id=c0a75216");


/***/ }),

/***/ "./resources/js/Pages/Home/Components/Studio.vue?vue&type=template&id=42042b28":
/*!*************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Studio.vue?vue&type=template&id=42042b28 ***!
  \*************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Studio_vue_vue_type_template_id_42042b28__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Studio_vue_vue_type_template_id_42042b28__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Studio.vue?vue&type=template&id=42042b28 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=template&id=42042b28");


/***/ }),

/***/ "./resources/js/Pages/Home/Index.vue?vue&type=template&id=f311f62a":
/*!*************************************************************************!*\
  !*** ./resources/js/Pages/Home/Index.vue?vue&type=template&id=f311f62a ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_template_id_f311f62a__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_template_id_f311f62a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Index.vue?vue&type=template&id=f311f62a */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=template&id=f311f62a");


/***/ }),

/***/ "./resources/js/Pages/Home/Components/Studio.vue?vue&type=style&index=0&id=42042b28&lang=css":
/*!***************************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Components/Studio.vue?vue&type=style&index=0&id=42042b28&lang=css ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Studio_vue_vue_type_style_index_0_id_42042b28_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader/dist/cjs.js!../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Studio.vue?vue&type=style&index=0&id=42042b28&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Components/Studio.vue?vue&type=style&index=0&id=42042b28&lang=css");


/***/ }),

/***/ "./resources/js/Pages/Home/Index.vue?vue&type=style&index=0&id=f311f62a&lang=css":
/*!***************************************************************************************!*\
  !*** ./resources/js/Pages/Home/Index.vue?vue&type=style&index=0&id=f311f62a&lang=css ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_style_index_0_id_f311f62a_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Index.vue?vue&type=style&index=0&id=f311f62a&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Home/Index.vue?vue&type=style&index=0&id=f311f62a&lang=css");


/***/ })

}]);