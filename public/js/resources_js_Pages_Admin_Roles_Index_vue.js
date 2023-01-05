"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Admin_Roles_Index_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Admin/Roles/Index.vue?vue&type=script&setup=true&lang=js":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Admin/Roles/Index.vue?vue&type=script&setup=true&lang=js ***!
  \*****************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _inertiajs_inertia_vue3__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @inertiajs/inertia-vue3 */ "./node_modules/@inertiajs/inertia-vue3/dist/index.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'Index',
  props: {
    roles: Object
  },
  setup: function setup(__props, _ref) {
    var expose = _ref.expose;
    expose();
    var addForm = (0,_inertiajs_inertia_vue3__WEBPACK_IMPORTED_MODULE_0__.useForm)({
      name: '',
      permissions: {}
    });
    var editForm = (0,_inertiajs_inertia_vue3__WEBPACK_IMPORTED_MODULE_0__.useForm)({
      id: null,
      name: '',
      permissions: {}
    });
    var editRole = function editRole(role) {
      editForm.id = role.id;
      editForm.name = role.name;
      editForm.permissions = Object.keys(role.permissions).length ? role.permissions : {};
    };
    var __returned__ = {
      addForm: addForm,
      editForm: editForm,
      editRole: editRole,
      useForm: _inertiajs_inertia_vue3__WEBPACK_IMPORTED_MODULE_0__.useForm
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Admin/Roles/Index.vue?vue&type=template&id=2af014b2":
/*!**********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Admin/Roles/Index.vue?vue&type=template&id=2af014b2 ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "container-xxl flex-grow-1 container-p-y"
};
var _hoisted_2 = {
  "class": "fw-semibold mb-4"
};
var _hoisted_3 = {
  "class": "mb-4"
};
var _hoisted_4 = {
  "class": "row g-4"
};
var _hoisted_5 = {
  "class": "card h-100"
};
var _hoisted_6 = {
  "class": "card-body"
};
var _hoisted_7 = {
  "class": "d-flex justify-content-between"
};
var _hoisted_8 = {
  "class": "fw-normal mb-2"
};
var _hoisted_9 = {
  "class": "list-unstyled d-flex align-items-center avatar-group mb-0"
};
var _hoisted_10 = ["title"];
var _hoisted_11 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
  "class": "rounded-circle",
  src: "/img/admin.png",
  alt: "Avatar"
}, null, -1 /* HOISTED */);
var _hoisted_12 = [_hoisted_11];
var _hoisted_13 = {
  "class": "d-flex justify-content-between align-items-end mt-1"
};
var _hoisted_14 = {
  "class": "role-heading"
};
var _hoisted_15 = {
  "class": "mb-1"
};
var _hoisted_16 = ["onClick"];
var _hoisted_17 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
  "class": "ti ti-trash ti-sm"
}, null, -1 /* HOISTED */);
var _hoisted_18 = {
  key: 0,
  "class": "col-xl-4 col-lg-6 col-md-6"
};
var _hoisted_19 = {
  "class": "card h-100"
};
var _hoisted_20 = {
  "class": "row h-100"
};
var _hoisted_21 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "col-sm-5"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
  src: "/assets/img/illustrations/add-new-roles.png",
  "class": "img-fluid mt-sm-4 mt-md-0",
  alt: "add-new-roles",
  width: "83"
})])], -1 /* HOISTED */);
var _hoisted_22 = {
  "class": "col-sm-7"
};
var _hoisted_23 = {
  "class": "card-body text-sm-end text-center ps-sm-0"
};
var _hoisted_24 = {
  "data-bs-target": "#addRoleModal",
  "data-bs-toggle": "modal",
  "class": "btn btn-primary mb-2 text-nowrap add-new-role"
};
var _hoisted_25 = {
  "class": "mb-0 mt-1"
};
var _hoisted_26 = {
  "class": "modal fade",
  id: "addRoleModal",
  tabindex: "-1",
  "aria-hidden": "true"
};
var _hoisted_27 = {
  "class": "modal-dialog modal-lg modal-dialog-centered modal-add-new-role"
};
var _hoisted_28 = {
  "class": "modal-content p-3 p-md-5"
};
var _hoisted_29 = {
  type: "button",
  ref: "addFormClose",
  "class": "btn-close btn-pinned",
  "data-bs-dismiss": "modal",
  "aria-label": "Close"
};
var _hoisted_30 = {
  "class": "modal-body"
};
var _hoisted_31 = {
  "class": "text-center mb-4"
};
var _hoisted_32 = {
  "class": "role-title mb-2"
};
var _hoisted_33 = {
  "class": "col-12 mb-4"
};
var _hoisted_34 = {
  "class": "form-label",
  "for": "modalRoleName"
};
var _hoisted_35 = ["placeholder"];
var _hoisted_36 = {
  key: 0,
  "class": "text fs-6 text-danger"
};
var _hoisted_37 = {
  "class": "col-12"
};
var _hoisted_38 = {
  "class": "table-responsive"
};
var _hoisted_39 = {
  "class": "table table-flush-spacing"
};
var _hoisted_40 = {
  "class": "text-nowrap fw-semibold",
  colspan: "2"
};
var _hoisted_41 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
  "class": "ti ti-info-circle",
  "data-bs-toggle": "tooltip",
  "data-bs-placement": "top"
}, null, -1 /* HOISTED */);
var _hoisted_42 = {
  "class": "text-nowrap fw-semibold"
};
var _hoisted_43 = {
  "class": "d-flex"
};
var _hoisted_44 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_45 = {
  "class": "form-check-label",
  "for": "listRole"
};
var _hoisted_46 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_47 = {
  "class": "form-check-label",
  "for": "createRole"
};
var _hoisted_48 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_49 = {
  "class": "form-check-label",
  "for": "updateRole"
};
var _hoisted_50 = {
  "class": "form-check"
};
var _hoisted_51 = {
  "class": "form-check-label",
  "for": "deleteRole"
};
var _hoisted_52 = {
  "class": "text-nowrap fw-semibold"
};
var _hoisted_53 = {
  "class": "d-flex"
};
var _hoisted_54 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_55 = {
  "class": "form-check-label",
  "for": "listAdmin"
};
var _hoisted_56 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_57 = {
  "class": "form-check-label",
  "for": "createAdmin"
};
var _hoisted_58 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_59 = {
  "class": "form-check-label",
  "for": "updateAdmin"
};
var _hoisted_60 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_61 = {
  "class": "form-check-label",
  "for": "deleteAdmin"
};
var _hoisted_62 = {
  "class": "form-check"
};
var _hoisted_63 = {
  "class": "form-check-label",
  "for": "notifyAdmin"
};
var _hoisted_64 = {
  "class": "col-12 text-center mt-4"
};
var _hoisted_65 = {
  type: "submit",
  "class": "btn btn-primary me-sm-3 me-1"
};
var _hoisted_66 = {
  type: "reset",
  "class": "btn btn-label-secondary",
  "data-bs-dismiss": "modal",
  "aria-label": "Close"
};
var _hoisted_67 = {
  "class": "modal fade",
  id: "editRoleModal",
  tabindex: "-1",
  "aria-hidden": "true"
};
var _hoisted_68 = {
  "class": "modal-dialog modal-lg modal-dialog-centered modal-edit-role"
};
var _hoisted_69 = {
  "class": "modal-content p-3 p-md-5"
};
var _hoisted_70 = {
  type: "button",
  ref: "editFormClose",
  "class": "btn-close btn-pinned",
  "data-bs-dismiss": "modal",
  "aria-label": "Close"
};
var _hoisted_71 = {
  "class": "modal-body"
};
var _hoisted_72 = {
  "class": "text-center mb-4"
};
var _hoisted_73 = {
  "class": "role-title mb-2"
};
var _hoisted_74 = {
  "class": "col-12 mb-4"
};
var _hoisted_75 = {
  "class": "form-label",
  "for": "modalRoleName"
};
var _hoisted_76 = ["placeholder", "disabled"];
var _hoisted_77 = {
  key: 0,
  "class": "text text-danger"
};
var _hoisted_78 = {
  "class": "col-12"
};
var _hoisted_79 = {
  "class": "table-responsive"
};
var _hoisted_80 = {
  "class": "table table-flush-spacing"
};
var _hoisted_81 = {
  "class": "text-nowrap fw-semibold",
  colspan: "2"
};
var _hoisted_82 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
  "class": "ti ti-info-circle",
  "data-bs-toggle": "tooltip",
  "data-bs-placement": "top"
}, null, -1 /* HOISTED */);
var _hoisted_83 = {
  "class": "text-nowrap fw-semibold"
};
var _hoisted_84 = {
  "class": "d-flex"
};
var _hoisted_85 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_86 = {
  "class": "form-check-label",
  "for": "editlistRole"
};
var _hoisted_87 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_88 = {
  "class": "form-check-label",
  "for": "editcreateRole"
};
var _hoisted_89 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_90 = {
  "class": "form-check-label",
  "for": "editupdateRole"
};
var _hoisted_91 = {
  "class": "form-check"
};
var _hoisted_92 = {
  "class": "form-check-label",
  "for": "editdeleteRole"
};
var _hoisted_93 = {
  "class": "text-nowrap fw-semibold"
};
var _hoisted_94 = {
  "class": "d-flex"
};
var _hoisted_95 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_96 = {
  "class": "form-check-label",
  "for": "editlistAdmin"
};
var _hoisted_97 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_98 = {
  "class": "form-check-label",
  "for": "editcreateAdmin"
};
var _hoisted_99 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_100 = {
  "class": "form-check-label",
  "for": "editupdateAdmin"
};
var _hoisted_101 = {
  "class": "form-check me-2 me-lg-3"
};
var _hoisted_102 = {
  "class": "form-check-label",
  "for": "editdeleteAdmin"
};
var _hoisted_103 = {
  "class": "form-check"
};
var _hoisted_104 = {
  "class": "form-check-label",
  "for": "editnotifyAdmin"
};
var _hoisted_105 = {
  "class": "col-12 text-center mt-4"
};
var _hoisted_106 = {
  type: "submit",
  "class": "btn btn-primary me-sm-3 me-1"
};
var _hoisted_107 = {
  type: "reset",
  "class": "btn btn-label-secondary",
  "data-bs-dismiss": "modal",
  "aria-label": "Close"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _this = this;
  var _component_Head = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Head");
  var _component_Link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Link");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Head, {
    title: _ctx.__('Roles List')
  }, null, 8 /* PROPS */, ["title"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", _hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Roles List')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", _hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('A role provided access to predefined menus and features so that depending on the assigned role an administrator can have access to what the user needs.')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Role cards "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.roles.data, function (role) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
      "class": "col-xl-4 col-lg-6 col-md-6",
      key: role.id
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h6", _hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Total :count users', {
      count: role.users_count
    })), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_9, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(role.admins, function (admin) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", {
        key: admin.id,
        "data-bs-toggle": "tooltip",
        "data-popup": "tooltip-custom",
        "data-bs-placement": "top",
        title: admin.fullName,
        "class": "avatar avatar-sm pull-up"
      }, _hoisted_12, 8 /* PROPS */, _hoisted_10);
    }), 128 /* KEYED_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", _hoisted_15, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__(role.name)), 1 /* TEXT */), role.can.edit ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("a", {
      key: 0,
      onClick: function onClick($event) {
        return $setup.editRole(role);
      },
      "data-bs-target": "#editRoleModal",
      "data-bs-toggle": "modal",
      "class": "role-add-modal mb-2 text-nowrap add-new-role text-primary cursor-pointer"
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Edit')), 9 /* TEXT, PROPS */, _hoisted_16)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), role.can["delete"] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_Link, {
      key: 0,
      href: _ctx.route('admin.roles.destroy', role.id),
      method: "DELETE",
      as: "span",
      "class": "text-muted cursor-pointer"
    }, {
      "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
        return [_hoisted_17];
      }),
      _: 2 /* DYNAMIC */
    }, 1032 /* PROPS, DYNAMIC_SLOTS */, ["href"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])]);
  }), 128 /* KEYED_FRAGMENT */)), $props.roles.can_create ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [_hoisted_21, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_24, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Add New Role')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", _hoisted_25, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Add role, if it does not exist')), 1 /* TEXT */)])])])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("/ Role cards "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Add Role Modal "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_29, null, 512 /* NEED_PATCH */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_30, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_31, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h3", _hoisted_32, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Add new role')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Add role form "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", {
    "class": "row g-3",
    onSubmit: _cache[10] || (_cache[10] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      $setup.addForm.post(_ctx.route('admin.roles.store'), {
        onSuccess: function onSuccess() {
          $setup.addForm.reset();
          _this.$refs.addFormClose.click();
        }
      });
    }, ["prevent"]))
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_34, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Role Name')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    id: "modalRoleName",
    name: "modalRoleName",
    "class": "form-control",
    placeholder: _ctx.__('Enter a role name'),
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $setup.addForm.name = $event;
    })
  }, null, 8 /* PROPS */, _hoisted_35), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.addForm.name]]), $setup.addForm.errors.name ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_36, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.addForm.errors.name), 1 /* TEXT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Role Permissions')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Permission table "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Access')) + " ", 1 /* TEXT */), _hoisted_41])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_42, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Roles management')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "listRole",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $setup.addForm.permissions['viewAny-role'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.addForm.permissions['viewAny-role']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_45, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('List')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "createRole",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $setup.addForm.permissions['create-role'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.addForm.permissions['create-role']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_47, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Create')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "updateRole",
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $setup.addForm.permissions['update-role'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.addForm.permissions['update-role']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_49, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Edit')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "deleteRole",
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $setup.addForm.permissions['delete-role'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.addForm.permissions['delete-role']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_51, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Delete')), 1 /* TEXT */)])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_52, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Admins management')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "listAdmin",
    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
      return $setup.addForm.permissions['viewAny-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.addForm.permissions['viewAny-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_55, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('List')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_56, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "createAdmin",
    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
      return $setup.addForm.permissions['create-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.addForm.permissions['create-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_57, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Create')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_58, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "updateAdmin",
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return $setup.addForm.permissions['update-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.addForm.permissions['update-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_59, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Edit')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "deleteAdmin",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $setup.addForm.permissions['delete-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.addForm.permissions['delete-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_61, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Delete')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "notifyAdmin",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.addForm.permissions['notify-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.addForm.permissions['notify-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_63, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Notify')), 1 /* TEXT */)])])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Permission table ")]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_64, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_65, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Save')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_66, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Cancel')), 1 /* TEXT */)])], 32 /* HYDRATE_EVENTS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("/ Add role form ")])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("/ Add Role Modal "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Edit Role Modal "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_68, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_69, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_70, null, 512 /* NEED_PATCH */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_72, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h3", _hoisted_73, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Edit role')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Edit role form "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", {
    "class": "row g-3",
    onSubmit: _cache[21] || (_cache[21] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      $setup.editForm.put(_ctx.route('admin.roles.update', $setup.editForm.id), {
        onSuccess: function onSuccess() {
          _this.$refs.editFormClose.click();
        }
      });
    }, ["prevent"]))
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_74, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_75, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Role Name')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    id: "modalRoleName",
    name: "modalRoleName",
    "class": "form-control",
    placeholder: _ctx.__('Enter a role name'),
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $setup.editForm.name = $event;
    }),
    disabled: $setup.editForm.id <= 3
  }, null, 8 /* PROPS */, _hoisted_76), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.editForm.name]]), $setup.editForm.errors.name ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_77, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.editForm.errors.name), 1 /* TEXT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_78, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Role Permissions')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Permission table "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_79, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_80, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_81, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Access')) + " ", 1 /* TEXT */), _hoisted_82])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_83, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Roles management')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_84, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_85, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "editlistRole",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $setup.editForm.permissions['viewAny-role'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.editForm.permissions['viewAny-role']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_86, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('List')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_87, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "editcreateRole",
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $setup.editForm.permissions['create-role'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.editForm.permissions['create-role']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_88, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Create')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_89, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "editupdateRole",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $setup.editForm.permissions['update-role'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.editForm.permissions['update-role']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_90, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Edit')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_91, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "editdeleteRole",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $setup.editForm.permissions['delete-role'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.editForm.permissions['delete-role']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_92, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Delete')), 1 /* TEXT */)])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_93, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Admins management')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_94, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "editlistAdmin",
    "onUpdate:modelValue": _cache[16] || (_cache[16] = function ($event) {
      return $setup.editForm.permissions['viewAny-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.editForm.permissions['viewAny-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_96, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('List')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_97, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "editcreateAdmin",
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $setup.editForm.permissions['create-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.editForm.permissions['create-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_98, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Create')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_99, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "editupdateAdmin",
    "onUpdate:modelValue": _cache[18] || (_cache[18] = function ($event) {
      return $setup.editForm.permissions['update-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.editForm.permissions['update-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_100, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Edit')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_101, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "editdeleteAdmin",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $setup.editForm.permissions['delete-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.editForm.permissions['delete-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_102, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Delete')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_103, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    type: "checkbox",
    id: "editnotifyAdmin",
    "onUpdate:modelValue": _cache[20] || (_cache[20] = function ($event) {
      return $setup.editForm.permissions['notify-admin'] = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.editForm.permissions['notify-admin']]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_104, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Notify')), 1 /* TEXT */)])])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Permission table ")]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_105, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_106, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Save')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_107, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Cancel')), 1 /* TEXT */)])], 32 /* HYDRATE_EVENTS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("/ Edit role form ")])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("/ Edit Role Modal ")])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./resources/js/Pages/Admin/Roles/Index.vue":
/*!**************************************************!*\
  !*** ./resources/js/Pages/Admin/Roles/Index.vue ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Index_vue_vue_type_template_id_2af014b2__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=2af014b2 */ "./resources/js/Pages/Admin/Roles/Index.vue?vue&type=template&id=2af014b2");
/* harmony import */ var _Index_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Pages/Admin/Roles/Index.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,C_laragon_www_sju_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_Index_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Index_vue_vue_type_template_id_2af014b2__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Admin/Roles/Index.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Admin/Roles/Index.vue?vue&type=script&setup=true&lang=js":
/*!*************************************************************************************!*\
  !*** ./resources/js/Pages/Admin/Roles/Index.vue?vue&type=script&setup=true&lang=js ***!
  \*************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Index.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Admin/Roles/Index.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Admin/Roles/Index.vue?vue&type=template&id=2af014b2":
/*!********************************************************************************!*\
  !*** ./resources/js/Pages/Admin/Roles/Index.vue?vue&type=template&id=2af014b2 ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_template_id_2af014b2__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_template_id_2af014b2__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Index.vue?vue&type=template&id=2af014b2 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Admin/Roles/Index.vue?vue&type=template&id=2af014b2");


/***/ })

}]);