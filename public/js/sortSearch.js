/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 37);
/******/ })
/************************************************************************/
/******/ ({

/***/ 37:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(38);


/***/ }),

/***/ 38:
/***/ (function(module, exports) {

/** * Change visibility field decode code */
$(document).on('click', '.toggle-password', function () {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

var sortCode = $('#app-sort');
var appendBox = $('.app-append-block');
var searchField = $('#js-search');
/** * onChange query to db  ajax ( sort ) */
sortCode.on('change', function () {
  getSecretCodes($(this).find('option:selected').attr('title'), $(this).val());
  searchField.val('');
});

/** * onChange query to db  ajax (search) */
$('#js-search-click').on('click', function () {
  getSecretCodes(searchField.attr('title'), searchField.val());
  $('select option:eq(0)').prop("selected", "selected");
});

/** * Search and sort codes ajax * * @type {*|jQuery|HTMLElement} */
function getSecretCodes(operator, value) {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: "POST",
    url: '/sort',
    data: {
      'operator': operator,
      'value': value
    },
    success: function success(data) {
      appendBox.find('.app-code-block').remove();
      appendCodes(data);
    }
  });
}

function appendCodes(data) {

  if (!isEmpty(data)) {
    appendBox.append('<div class="app-code-block">' + '<p>Not have saved secret codes.</p>' + '</div>');
  } else {
    for (var code in data) {
      appendBox.append('<div class="mb-3 app-code-block">' + '<div class="badge-info"><b>' + data[code].secret_code.code_name + '</b></div>' + '<div class="badge-danger">' + data[code].secret_code.secret_code + '</div>' + '<div>' + '<input id="' + data[code].id + '" type="password" class="form-control" name="password" value="' + returnValue(data[code].secret_code.decode) + '" disabled="">' + '<span toggle="#' + data[code].id + '" class="fa fa-fw fa-eye fa-2x field-icon toggle-password"></span>' + '</div>' + '</div>');
    }
  }
}

/** * Generate string with secret decode code * * @param data * @returns {string} */
function returnValue(data) {
  var decodeCode = '';
  for (var decode in data) {
    decodeCode += data[decode].decode_code + ' ';
  }
  return decodeCode;
}

/** * Check what returned from back-end * * @param object * @returns {boolean} */
function isEmpty(object) {
  for (var key in object) {
    if (object.hasOwnProperty(key)) return true;
  }return false;
}

/***/ })

/******/ });