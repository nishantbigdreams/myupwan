  var number_format_dec = '.'; var number_format_th = ''; var number_format_point = '2'; var store_language = 'en'; var xcart_web_dir = "/demo/templates/classic/41-babystore"; var images_dir = "/demo/templates/classic/41-babystore/skin/common_files/images"; var alt_images_dir = "/demo/templates/classic/41-babystore/skin/babystore/images"; var lbl_no_items_have_been_selected = 'No items have been selected'; var current_area = 'C'; var currency_format = "$x"; var lbl_product_minquantity_error = "Sorry, the minimum order quantity for this product is {{min}}."; var lbl_product_maxquantity_error = "Sorry, the maximum order quantity for this product is {{max}}."; var txt_out_of_stock = "Out of stock"; var lbl_product_quantity_type_error = "You can specify a number from {{min}} to {{max}}."; var is_limit = true; var lbl_required_field_is_empty = "The required field \'~~field~~\' is empty!"; var lbl_field_required = "Field is required"; var lbl_field_format_is_invalid = "The format of the \'~~field~~\' field is invalid."; var txt_required_fields_not_completed = "The following required fields have not been completed: {{fields}} Do you wish to submit the form with these fields empty?"; var lbl_blockui_default_message = "Please wait..."; var lbl_error = 'Error'; var lbl_warning = 'Warning'; var lbl_information = 'Information'; var lbl_ok = 'OK'; var lbl_yes = 'Yes'; var lbl_no = 'No'; var txt_minicart_total_note = 'Order subtotal does not cover discounts and extra costs like shipping charges, etc. The final cost of the order will be calculated at the checkout page.'; var txt_ajax_error_note = 'An error occurred while processing a request. Please <a href=\"javascript:void(0);\" onclick=\"javascript:window.location.reload();\">refresh the page.<a><br /><br />If the problem still persists after refreshing the page please <a href=\"javascript:void(0);\" onclick=\"javascript:self.location=\'help.php?section=contactus&amp;mode=update\'\">contact us<\/a> on the matter.';  var txt_email_invalid = "Email address is invalid! Please correct"; var email_validation_regexp = new RegExp("^[a-z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z](?:[a-z0-9-]*[a-z0-9])$", "gi");  var is_admin_editor = false; var  topMessageDelay = []; topMessageDelay['i'] = 10*1000; topMessageDelay['w'] = 60*1000; topMessageDelay['e'] = 0*1000; 
 /*  * Constants used in product notifications widgets  */ var ProductNotificationWidget_CONST = {   /* Language variables */   PROD_NOTIF_EMAIL_REGEXP: new RegExp("^[a-z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z](?:[a-z0-9-]*[a-z0-9])$", "gi"),   ERR_PROD_NOTIF_EMAIL: "Invalid email address!",   ERR_SUBMIT_PROD_NOTIF_UNKNOWN: "Error",   MSG_SUBMIT_PROD_NOTIF_OK: "You have been subscribed",   MSG_PROD_NOTIF_ALREADY_SUBSCRIBED: "You already subscribed",   LBL_PROD_NOTIF_EMAIL_DEFAULT: "e-mail",   /* Config variables */   PROD_NOTIF_L_AMOUNT: 3,   /* HTML elements IDs */   ROOT_ELEMENT_ID_PREFIX: 'prod_notif_',   REQUEST_BUTTON_ELEMENT_ID_PREFIX: 'prod_notif_request_button_',   EMAIL_INPUT_ELEMENT_ID_PREFIX: 'prod_notif_email_',   SUBMIT_BUTTON_ELEMENT_ID_PREFIX: 'prod_notif_submit_button_',   SUBMIT_WAITING_ELEMENT_ID_PREFIX: 'prod_notif_submit_waiting_',   MESSAGE_ELEMENT_ID_PREFIX: 'prod_notif_submit_message_',   /* CSS class names */   ERROR_MSG_CSS: "prod-notif-request-submit-error-message",   INVALID_EMAIL_CSS: "prod-notif-email-error",   DEFAULT_EMAIL_CSS: "prod-notif-email-default-value",   /* Widget behavior */   REQUEST_FORM_SLIDE_DELAY: 300,   PROD_NOTIF_SUBMIT_PHP: "/demo/templates/classic/41-babystore/product_notifications.php",   PROD_NOTIF_SUBMIT_MODE: "subscribe" }; 
/* vim: set ts=2 sw=2 sts=2 et: */
/**
 * Common JavaScript variables and functions
 * 
 * @category   X-Cart
 * @package    X-Cart
 * @subpackage ____sub_package____
 * @author     Ruslan R. Fazlyev <rrf@x-cart.com> 
 * @copyright  Copyright (c) 2001-2014 Qualiteam software Ltd <info@x-cart.com>
 * @license    http://www.x-cart.com/license.php X-Cart license agreement
 * @version    58ab7bdc89b3d4cd894ef7d853bcc6f0c4dcca6b, v41 (xcart_4_6_2), 2014-02-03 17:25:33, common.js, aim
 * @link       http://www.x-cart.com/
 * @see        ____file_see____
 */

/**
 * Enviroment identificator
 */
var localIsDOM = document.getElementById ? true: false;
var localIsJava = navigator.javaEnabled();
var localIsStrict = document.compatMode == 'CSS1Compat';
var localPlatform = navigator.platform;
var localVersion = "0";
var localBrowser = "";
var localBFamily = "";
var isHttps = false;

if (window.opera && localIsDOM) {
  localBFamily = localBrowser = "Opera";
  if (navigator.userAgent.search(/^.*Opera.([\d.]+).*$/) != - 1) localVersion = navigator.userAgent.replace(/^.*Opera.([\d.]+).*$/, "$1");
  else if (window.print) localVersion = "6";
  else localVersion = "5";

} else { 

  if (document.all && document.all.item)
    localBFamily = localBrowser = 'MSIE';
}

if (navigator.appName == "Netscape") {

  localBFamily = "NC";

  if (!localIsDOM) {
    localBrowser = 'Netscape';
    localVersion = navigator.userAgent.replace(/^.*Mozilla.([\d.]+).*$/, "$1");

    if (localVersion != '') localVersion = "4";

  }
  else if (navigator.userAgent.indexOf("Chrome") >= 0) localBrowser = 'Chrome';
  else if (navigator.userAgent.indexOf("Safari") >= 0) localBrowser = 'Safari';
  else if (navigator.userAgent.indexOf("Netscape") >= 0) localBrowser = 'Netscape';
  else if (navigator.userAgent.indexOf("Firefox") >= 0) localBrowser = 'Firefox';
  else localBrowser = 'Mozilla';

}

if (navigator.userAgent.indexOf("MSMSGS") >= 0)
  localBrowser = "WMessenger";
else if (navigator.userAgent.indexOf("e2dk") >= 0)
  localBrowser = "Edonkey";
else if (navigator.userAgent.indexOf("Gnutella") + navigator.userAgent.indexOf("Gnucleus") >= 0)
  localBrowser = "Gnutella";
else if (navigator.userAgent.indexOf("KazaaClient") >= 0)
  localBrowser = "Kazaa";

if (localVersion == '0' && localBrowser != '') {
  var rg = new RegExp("^.*" + localBrowser + ".([\\d.]+).*$");
  localVersion = navigator.userAgent.replace(rg, "$1");
}

var localIsCookie = ((localBrowser == 'Netscape' && localVersion == '4') 
  ? (document.cookie != '') 
  : navigator.cookieEnabled);

var isHttps = document.location.protocol == "https:";

function change_antibot_image(id) {
  var image = document.getElementById(id);
  if (image) {
    var src = xcart_web_dir + "/antibot_image.php?tmp=" + Math.random() + "&section=" + id + "&regenerate=Y";
    setTimeout(
    function() {
      image.src = src;
    },
    200);
  }
  $('#antibot_input_str', $(image).parents('form')[0]).val('');
}

/**
 * Get real inner width (jsel- JQuery selector)
 */
function getRealWidth(jsel) {
  var sw = $(jsel).prop('scrollWidth');

  if ($.browser.opera) 
    return sw;

  var pl = parseInt($(jsel).css('padding-left'));

  if (!isNaN(pl)) sw -= pl;

  var pr = parseInt($(jsel).css('padding-right'));

  if (!isNaN(pr)) 
    sw -= pr;

  return sw;
}

/**
 * Show note next to element
 */
function showNote(id, next_to, is_js_opc) {
  if ( typeof showNote.isReadyToShow == 'undefined' ) {
      showNote.isReadyToShow = true;
  }

  if (undefined === is_js_opc) {
    is_js_opc = false;
  }

  if (
    showNote.isReadyToShow 
    && $('#' + id).css('display') == 'none'
  ) {
    showNote.isReadyToShow = false;

    var div = $('#' + id).get();
    $('#' + id).remove();
    $('body').append(div);

    if (is_js_opc) {
      // overlay payment/shipping block on OPC page
      $('#' + id).css('z-index', '1100');
    }

    $('#' + id).show();

    var sw = getRealWidth('#' + id);

    $('#' + id).css('left', $(next_to).offset().left + $(next_to).width() + 'px');
    $('#' + id).css('top', $(next_to).offset().top + 'px');

    if (sw > $('#' + id).width()) { 
      $('#' + id).css('width', sw + 'px');
    }
    showNote.isReadyToShow = true;
  }
}

/**
 * Find element by classname
 */
function getElementsByClassName(clsName) {
  var elem, cls;
  var arr = [];
  var elems = document.getElementsByTagName("*");

  for (var i = 0; (elem = elems[i]); i++) {
    if (elem.className == clsName) {
      arr[arr.length] = elem;
    }
  }

  return arr;
}

function getProperDimensions(old_x, old_y, new_x, new_y, crop) {

  if (old_x <= 0 || old_y <= 0 || (new_x <= 0 && new_y <= 0) || (crop && old_x <= new_x && old_y <= new_y)) 
    return [old_x, old_y];

  var k = 1;

  if (new_x <= 0) {
    k = (crop && old_y <= new_y) ? 1: new_y / old_y;

  } else if (new_y <= 0) {
    k = (crop && old_x <= new_x) ? 1: new_x / old_x;

  } else {

    var _kx = new_x / old_x;
    var _ky = new_y / old_y;

    k = crop ? Math.min(_kx, _ky, 1) : Math.min(_kx, _ky);
  }

  return [round(k * old_x), round(k * old_y)];

}
/**
 * Opener/Closer HTML block
 */
function visibleBox(id, skipOpenClose) {
  elm1 = document.getElementById("open" + id);
  elm2 = document.getElementById("close" + id);
  elm3 = document.getElementById("box" + id);

  if (!elm3) return false;

  if (skipOpenClose) {
    elm3.style.display = (elm3.style.display == "") ? "none": "";

  } else if (elm1) {
    if (elm1.style.display == "") {
      elm1.style.display = "none";

      if (elm2) elm2.style.display = "";

      elm3.style.display = "none";
      var class_objs = getElementsByClassName('DialogBox');
      for (var i = 0; i < class_objs.length; i++) {
        class_objs[i].style.height = "1%";
      }

    } else {
      elm1.style.display = "";
      if (elm2) elm2.style.display = "none";

      elm3.style.display = "";
    }
  }

  return true;
}

function switchVisibleBox(id) {
  var box = document.getElementById(id);
  var plus = document.getElementById(id + '_plus');
  var minus = document.getElementById(id + '_minus');
  if (!box || ! plus || ! minus) return false;

  if (box.style.display == 'none') {
    box.style.display = '';
    plus.style.display = 'none';
    minus.style.display = '';

  } else {
    box.style.display = 'none';
    minus.style.display = 'none';
    plus.style.display = '';
  }

  return true;
}

/**
 * URL encode
 */
function urlEncode(url) {
  return url.replace(/\s/g, "+").replace(/&/, "&amp;").replace(/"/, "&quot;")
}

/**
 * Math.round() wrapper
 */
function round(n, p) {
  if (isNaN(n)) n = parseFloat(n);

  if (!p || isNaN(p)) return Math.round(n);

  p = Math.pow(10, p);
  return Math.round(n * p) / p;
}

/**
 * Price format
 */
function price_format(price, thousand_delim, decimal_delim, precision, currency) {

  thousand_delim = (arguments.length > 1 && thousand_delim !== false) 
    ? thousand_delim 
    : number_format_th;

  decimal_delim = (arguments.length > 2 && decimal_delim !== false) 
    ? decimal_delim 
    : number_format_dec;

  precision = (arguments.length > 3 && precision !== false) 
    ? precision 
    : number_format_point;

  currency = (arguments.length > 4 && currency !== false) 
    ? currency_format 
    : "x";

  if (precision > 0) {
    precision = Math.pow(10, precision);
    price = Math.round(price * precision) / precision;
    var top = Math.floor(price);
    var bottom = Math.round((price - top) * precision) + precision;
  } else {
    var top = Math.round(price);
    var bottom = 0;
  }

  top = top + "";
  bottom = bottom + "";
  var cnt = 0;
  for (var x = top.length; x >= 0; x--) {
    if (cnt % 3 == 0 && cnt > 0 && x > 0) top = top.substr(0, x) + thousand_delim + top.substr(x, top.length);
    cnt++;
  }

  return currency.replace("x", (bottom > 0) ? (top + decimal_delim + bottom.substr(1, bottom.length)) : top);
}

/**
 * Substitute
 */
function substitute(lbl) {
  var rg;
  for (var x = 1; x < arguments.length; x += 2) {
    if (isset(arguments[x]) && isset(arguments[x + 1])) {
      lbl = lbl.replace(new RegExp("\\{\\{" + arguments[x] + "\\}\\}", "gi"), arguments[x + 1])
               .replace(new RegExp('~~' + arguments[x] + '~~', "gi"), arguments[x + 1]);
    }
  }
  return lbl;
}

function getWindowOutWidth(w) {
  if (!w) 
    w = window;

  return localBFamily == "MSIE" ? w.document.body.clientWidth: w.outerWidth;
}

function getWindowOutHeight(w) {
  if (!w) 
    w = window;

  return localBFamily == "MSIE" ? w.document.body.clientHeight: w.outerHeight;
}

function getWindowWidth(w) {
  if (!w) 
    w = window;

  return localBFamily == "MSIE" ? w.document.body.clientWidth: w.innerWidth;
}

function getWindowHeight(w) {
  if (!w) 
    w = window;

  return localBFamily == "MSIE" ? w.document.body.clientHeight: w.innerHeight;
}

function getDocumentHeight(w) {
  if (!w) 
    w = window;

  return Math.max(w.document.documentElement.scrollHeight, w.document.body.scrollHeight);
}

function getDocumentWidth(w) {
  if (!w) 
    w = window;

  return Math.max(w.document.documentElement.scrollWidth, w.document.body.scrollWidth);
}

/**
 * Check list of checkboxes
 */
function checkMarks(form, reg, lbl) {
  var is_exist = false;

  if (!form || form.elements.length == 0) 
    return true;

  for (var x = 0; x < form.elements.length; x++) {
    if (form.elements[x].name.search(reg) == 0 && form.elements[x].type == 'checkbox' && ! form.elements[x].disabled) {
      is_exist = true;

      if (form.elements[x].checked) 
        return true;
    }
  }

  if (!is_exist) 
    return true;

  if (lbl) {
    alert(lbl);

  } else if (lbl_no_items_have_been_selected) {
    alert(lbl_no_items_have_been_selected);

  }

  return false;
}

/**
 * Submit form with specified value of 'mode' parmaeters
 */
function submitForm(formObj, formMode, e) {
  if (!e && typeof(window.event) != 'undefined') e = event;

  if (e) {
    if (e.stopPropagation) e.stopPropagation();
    else e.cancelBubble = true;
  }

  if (!formObj) 
    return false;

  if (formObj.tagName != "FORM") {
    if (!formObj.form) 
      return false;

    formObj = formObj.form;
  }

  if (formObj.mode) formObj.mode.value = formMode;

  if (typeof(window.$) != 'undefined') {
    var r = $(formObj).triggerHandler('submit');
    if (r === false) 
      return false;
  }

  return formObj.submit();
}

/**
 * Convert number from current format
 * (according to 'Input and display format for floating comma numbers' option)
 * to float number
 */
function convert_number(num) {
  var regDec = new RegExp(reg_quote(number_format_dec), "gi");
  var regTh = new RegExp(reg_quote(number_format_th), "gi");
  var pow = Math.pow(10, parseInt(number_format_point));

  num = parseFloat(num.replace(" ", "").replace(regTh, "").replace(regDec, "."));
  return Math.round(num * pow) / pow;
}

/**
 * Check string as number
 * (according to 'Input and display format for floating comma numbers' option)
 */
function check_is_number(num) {
  var regDec = new RegExp(reg_quote(number_format_dec), "gi");
  var regTh = new RegExp(reg_quote(number_format_th), "gi");

  num = num.replace(" ", "").replace(regTh, "").replace(regDec, ".");

  return (num.search(/^[+-]?[0-9]+(\.[0-9]+)?$/) != - 1);
}

/**
 * Qutation for RegExp class
 */
function reg_quote(s) {
  return s.replace(/\./g, "\\.").replace(/\//g, "\\/").replace(/\*/g, "\\*").replace(/\+/g, "\\+").replace(/\[/g, "\\[").replace(/\]/g, "\\]");
}

function setCookie(name, value, path, expires, domain) {
  if (typeof(expires) == 'object') {
    try {
      var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      if (days[expires.getDay()] && months[expires.getMonth()]) expires = days[expires.getDay()] + " " + expires.getDate() + "-" + months[expires.getMonth()] + "-" + expires.getFullYear() + " " + expires.getHours() + ":" + expires.getMinutes() + ":" + expires.getSeconds() + " GMT";
    } catch(e) {}
  }

  if (typeof(expires) != 'string') expires = false;
  if (typeof(domain) != 'string') domain = false;

  if ('function' == typeof window.func_is_allowed_cookie && !func_is_allowed_cookie(name)) {
    deleteCookie(name);
  } else {
  document.cookie = name + "=" + escape(value) + (expires ? "; expires=" + expires: "") + (path ? "; path=" + path: "") + (domain ? "; domain=" + domain: "");
  }
}

function getCookie(name) {
  if (document.cookie.length > 0) {
    start = document.cookie.indexOf(name + "=");
    if (start != - 1) {
      start = start + name.length + 1;
      end = document.cookie.indexOf(";", start);
      if (end == - 1) end = document.cookie.length;

      return unescape(document.cookie.substring(start, end));
    }
  }

  return false;
}

function deleteCookie(name) {
  document.cookie = name + "=0; expires=Fri, 31 Dec 1999 23:59:59 GMT;";
}

/**
 * Clone object
 */
function cloneObject(orig) {
  var r = {};
  for (var i in orig) {
    if (hasOwnProperty(orig, i)) r[i] = orig[i];
  }

  return r;
}

/**
 * getElementById() wrapper
 */
function _getById(id) {
  if (typeof(id) != 'string' || ! id) return false;

  var obj = document.getElementById(id);
  if (obj && obj.id != id) {
    obj = false;
    for (var i = 0; i < document.all.length && obj === false; i++) {
      if (document.all[i].id == id) obj = document.all[i];
    }
  }

  return obj;
}

// undefined or not
function isset(obj) {
  return typeof(obj) != 'undefined' && obj !== null;
}

// Check - variable is function or not
function isFunction(f) {
  return (typeof(f) == 'function' || (typeof(f) == 'object' && (f + "").search(/\s*function /) === 0));
}

// Get text length without \r
function getPureLength(text) {
  return (text && text.replace) ? text.replace(new RegExp("\r", "g"), '').length: - 1;
}

// Ge text area selection limits
function getTASelection(t) {
  if (document.selection) {
    t.focus();
    var sel1 = document.selection.createRange();
    var sel2 = sel1.duplicate();
    sel2.moveToElementText(t);
    var selText = sel1.text;
    var c = String.fromCharCode(1);
    sel1.text = c;
    var index = sel2.text.indexOf(c);
    t.selectionStart = getPureLength((index == - 1) ? sel2.text: sel2.text.substring(0, index));
    t.selectionEnd = getPureLength(selText) + t.selectionStart;
    sel1.moveStart('character', - 1);
    sel1.text = selText;
  }

  return [t.selectionStart, t.selectionEnd];
}

// Insert string to text area to current position
function insert2TA(t, str) {
  if (!t) return false;

  var pos = getTASelection(t);
  var p;
  if (!isNaN(pos[0])) {
    t.value = t.value.substr(0, pos[0]) + str + t.value.substr(pos[0]);
    p = pos[0];

  } else {
    p = getPureLength(t.value);
    t.value += str;
  }

  setTACursorPos(t, p);

  return p;
}

// Set cursor pointer to specified postion for text area 
function setTACursorPos(t, begin, end) {
  if (!t || ! t.tagName || t.tagName.toUpperCase() != 'TEXTAREA') 
    return false;

  if (isNaN(begin)) {
    begin = 0;

  } else if (getPureLength(t.value) < begin) {
    begin = getPureLength(t.value);
    end = begin;
  }

  if (isNaN(end)) end = begin;

  if (document.selection) {
    var sel = t.createTextRange();
    sel.collapse(true);
    sel.moveStart('character', begin);
    sel.moveEnd('character', end - begin);
    sel.select();

  } else if (!isNaN(t.selectionStart)) {
    t.selectionStart = begin;
    t.selectionEnd = end;
  }

  if (t.focus) t.focus();

  return true;
}

/**
 * Position functions
 */
function posGetPageOffset(o) {
  var l = 0;
  var t = 0;
  do {
    l += o.offsetLeft;
    t += o.offsetTop;
  } while ((o = o.offsetParent));
  return {
    left: l,
    top: t
  };
}

function getMethod(method, obj) {
  var args = [];
  for (var i = 2; i < arguments.length; i++)
  args[args.length] = arguments[i];

  if (!obj) obj = window;

  return function() {
    if (!isFunction(method)) method = obj[method];

    return method.apply ? method.apply(obj, args) : method();
  }
}

function lockForm(form) {
  if (form.locked) 
    return false;

  form.locked = true;

  setTimeout(
  function() {
    form.locked = false;
  },
  1000);

  return true;
}

function getPopupControl(elm) {
  var e = elm;
  while (e && e.tagName && ! e._popupControl)
  e = e.parentNode;

  return (e && e._popupControl) ? e._popupControl: false;
}

function parse_url(url) {
  if (!url || url.constructor != String) 
    return false;

  var m = url.match(/^(([^:\/?#]+):)?(\/\/([^\/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?/);
  if (!m) 
    return false;

  var res = {
    scheme: m[2],
    host: m[4],
    path: m[5],
    query: m[7],
    fragment: m[9]
  };

  if (res.host) {
    m = res.host.match(/^(?:([^:]+):)?([^@]+)@(.+)$/);
    if (m) {
      res.host = m[3];
      res.user = m[1] ? m[1] : m[2];
      res.password = m[1] ? m[2] : false;
    }
  }

  return res;
}

function getImgSrc(elm) {

  if (!elm || ! elm.tagName || elm.tagName.toUpperCase() != 'IMG' || ! elm.src) 
    return false;

  if ($.browser.msie && elm.src.search(/\/spacer\.gif$/) != - 1 && elm.filters['DXImageTransform.Microsoft.AlphaImageLoader']) 
    return elm.filters['DXImageTransform.Microsoft.AlphaImageLoader'].src;

  return elm.src;
}

function extend(c, p) {
  var f = function() {}
  f.prototype = p.prototype;
  c.prototype = new f();
  c.prototype.constructor = c;
  c.superclass = p.prototype;
}

function hasOwnProperty(obj, prop) {
  if (typeof(obj) != 'undefined' && Object.prototype.hasOwnProperty) 
    return obj.hasOwnProperty(prop);

  return typeof(obj[prop]) != 'undefined' && obj.constructor.prototype[prop] !== obj[prop];
}

var hint_timer = new Array();

function skipDefaultValue(form) {
  $('input.default-value', form).each(function() {
    this.value = '';
  })
  return true;
}

function initResetDefault() {
  $('input.default-value').bind('focus', function() {
    if (!this.isReseted) {
      this.defaultValue = this.value;
      this.value = '';
      $(this).removeClass('default-value');
      this.isReseted = true;
    }
    return true;
  }).bind('change', function() {
    this.isContentIsChanged = true;
    return true;
  }).bind('blur', function() {
    if (this.isReseted && ! this.isContentIsChanged && this.defaultValue) {
      this.value = this.defaultValue;
      $(this).addClass('default-value');
      this.isReseted = false;
    }
    return true;
  }).each(
  function() {
    if (!this.form.isSetReset) {
      $(this.form).bind('submit', function() {
        $('input.default-value', this).each(
        function() {
          this.value = '';
        });
        return true;
      });
      this.form.isSetReset = true;
    }
  });
}

if (window.addEventListener) 
  window.addEventListener('load', initResetDefault, false);
else if (window.attachEvent) 
  window.attachEvent('onload', initResetDefault);

var popup_html_editor_text;

/*
  Debug window (require jQuery)
  Usage:
    debug().html('example');
    debug().html('example', 10);
    debug().add('second string')
    debug().clean();
    debug().hide();
    debug().show();
    debug().row(0).html('example');
    debug().row(0).add('second part');
    debug().row(0).remove();
    debug().opacity(0.1);
*/
var debug = function() {
  var debug_panel = false;

  return function() {

    if (typeof(window.$) == 'undefined') 
      return false;

    if (!debug_panel) {
      debug_panel = $(document.createElement('DIV')).
      css({
        position: 'absolute',
        border: '1px solid black',
        backgroundColor: 'white',
        display: 'none',
        top: '0px',
        left: '0px',
        width: '200px',
        height: '200px',
        overflow: 'auto',
        padding: '5px',
        margin: '0px'
      }).get(0);

      document.body.appendChild(debug_panel);

      debug_panel.defaultOpacity = 0.9;
      debug_panel.ttl = 0;
      debug_panel._extend_create = false;
      debug_panel._ttlTO = false;
      debug_panel._rowsLength = 0;

      /* Replace window content */
      debug_panel.html = function(str, ttl) {
        this._getBox().innerHTML = str;
        this.show();
        this.startTTL(arguments.length > 1 ? ttl: this.ttl);
      }

      /* Add new string */
      debug_panel.add = function(str, ttl) {
        this._getBox().innerHTML += str + "<br />\n";
        this.show();
        this.startTTL(arguments.length > 1 ? ttl: this.ttl);
      }

      /* Get row (old or new) */
      debug_panel.row = function(i) {
        var row = $('div:eq(' + i + ')', this._getBox()).get(0);
        if (!row) {
          for (var x = this._rowsLength; x < i + 1; x++) {
            row = this._getBox().appendChild(document.createElement('DIV'));
            row.remove = this._removeRow;
            row.html = this._htmlRow;
            row.add = this._addRow;
            row.box = this;
          }

          this._rowsLength = i + 1;
        }

        return row;
      }

      /* Remove row */
      debug_panel._removeRow = function() {
        if (this.parentNode) {
          this.box._rowsLength--;
          this.parentNode.removeChild(this);
        }
      }

      /* Replace row content */
      debug_panel._htmlRow = function(str, ttl) {
        this.innerHTML = str;
        this.box.show();
        this.box.startTTL(arguments.length > 1 ? ttl: this.parentNode.ttl);
      }

      /* Add content ot row */
      debug_panel._addRow = function(str, ttl) {
        this.innerHTML += str;
        this.box.show();
        this.box.startTTL(arguments.length > 1 ? ttl: this.parentNode.ttl);
      }

      /* Clean window content */
      debug_panel.clean = function() {
        this._rowsLength = 0;
        this._getBox().innerHTML = '';
      }

      /* Hide window */
      debug_panel.hide = function() {
        this.style.display = 'none';
      }

      /* Show window */
      debug_panel.show = function() {
        this.style.display = '';
      }

      /* Set window opacity */
      debug_panel.opacity = function(level) {
        level = parseFloat(level);
        if (isNaN(level) || level < 0 || level > 1) return false;

        level = Math.round(level * 100) / 100;
        if ($.browser.msie) {
          this.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity = ' + (level * 100) + ')';
        } else {
          this.style.opacity = level;
        }

        return true;
      }

      /* Start window auto-hide timer */
      debug_panel.startTTL = function(ttl) {
        if (this._ttlTO) clearTimeout(this._ttlTO);

        if (ttl <= 0) return false;

        var o = this;
        this._ttlTO = setTimeout(function() {
          o.hide();
        },
        ttl * 1000);

        return true;
      }

      /* Extend debug panel */
      debug_panel.extend = function() {
        if (this._extend_create) return true;

        var scripts = document.getElementsByTagName('SCRIPT');
        var m;
        var path = false;
        for (var i = 0; i < scripts.length && ! path; i++) {
          if (scripts[i].src && (m = scripts[i].src.match(/^(.+\/)common.js/))) path = m[1];
        }

        if (!path) return false;

        var s = document.createElement('SCRIPT');
        s.src = path + 'debug.js';
        document.body.appendChild(s);

        this._extend_create = true;

        return true;
      }

      /* Check - debug extended or not */
      debug_panel.is_extended = function() {
        return this._extend_create && typeof(window._debug_is_extended) != 'undefined' && _debug_is_extended;
      }

      debug_panel._getBox = function() {
        return this;
      }

      if (debug_panel.defaultOpacity > 0 && debug_panel.defaultOpacity <= 1) {
        debug_panel.opacity(debug_panel.defaultOpacity);
      }

    }

    /* Extend debug panel methods */
    if (typeof(window.debug_panel_ext_methods) != 'undefined' && debug_panel_ext_methods) {
      for (var i = 0; i < debug_panel_ext_methods.length; i++) {
        debug_panel[debug_panel_ext_methods[i]] = debug_panel_ext[debug_panel_ext_methods[i]];
      }

      if (typeof(debug_panel_ext.init) != 'undefined') debug_panel_ext.init.call(debug_panel);

      debug_panel_ext_methods = false;
      debug_panel_ext = false;
    }

    return debug_panel;
  }
} ();

/**
 * Popup wrapper
 */
function popup(url, width, height) {
  window.open(
  url, 'popup', 'width=' + width + ',height=' + height + ',toolbar=no,status=no,scrollbars=yes,resizable=no,menubar=no,location=no,direction=no');
}

/**
 * Dialog tools specific toggle function.
 * 
 * @param string active_panel    left ("In this section"), right ("See also") or help panel that should be activated
 * 
 * @return void
 * @see    ____func_see____
 * @since  4.4.0
 */
function dialog_tools_activate(active) {
  $('.dialog-tools-header li').each(function () {
    var e = $(this);

    e.toggleClass('dialog-tools-nonactive', !e.hasClass('dialog-header-' + active));
  })

  $('.dialog-tools-box .dialog-tools-content').each(function () {
    var e = $(this);

    e.toggleClass('hidden', !e.hasClass('dialog-tools-' + active));
  })
}

/**
 * Check form fields (CSS class-based) 
 * 
 * @return void
 * @see    ____func_see____
 */
function checkFormFields() {

  var errFields = [];

  if (!this.tagName || this.tagName.toUpperCase() != 'FORM') {

    if (
      arguments.length > 0
      && arguments[0]
      && arguments[0].tagName
      && arguments[0].tagName.toUpperCase() == 'FORM'
    ) {
      return checkFormFields.call(arguments[0]);
    }

    return true;
  }

  var error_found = err = empty = first_obtained_err = false;
  var frm = this;
    
  $('label[for]', frm).each(function() {
    err = empty = false;

    if (!this.htmlFor) {
      return;
    }

    var f = $('#' + this.htmlFor, frm).get(0);

    if (!f || f.disabled) {
      return;
    }

    if ($(f).is(':hidden')) {
      return;
    }

    var errMsg = lbl_required_field_is_empty;

    var r = (
      $(f).hasClass('input-required')
      || $(this).hasClass('data-required')
      || (
        $(this).parent('td').hasClass('data-name')
        && $(this).closest('tr').find('td.data-required').length > 0
      )
      || ( /* for ideal_responsive */
        $(this).parent('div').hasClass('data-name')
        && $(this).parent('div').next('div.data-required').length > 0
      )
    );

    var fType = false;

    if (f.className) {
      var m = $(f).attr('class').replace(/input-required/, '').match(/input-([a-z]+)/);
      if (m) {
        fType = m[1];
      }
    }

    if (!fType && !r) { 
      return;
    }

    if (r && $.trim($(f).val()) == '') {
      err = true;
      empty = true;

    } else if (fType) {

      var val = $(f).val().replace(/^\s+/g, '').replace(/\s+$/g, '');

      errMsg = lbl_field_format_is_invalid;

      switch (fType) {

      case 'email':
        if (val.search(email_validation_regexp) == - 1) {
          err = true;
          errMsg = txt_email_invalid;
        }
        break;

      case 'int':
        err = val.search(/^[-+]?\d+$/) == - 1;
        break;

      case 'uint':
        err = val.search(/^\+?\d+$/) == - 1;
        break;

      case 'intz':
        err = val.search(/^[-+]?\d+$/) == - 1 || val == '0';
        break;

      case 'uintz':
        err = val.search(/^\+?\d+$/) == - 1 || val == '0';
        break;

      case 'double':
        err = val.search(/^[-+]?(?:\d+|\.\d+|\d+\.|\d+\.\d+)$/) == - 1;
        break;

      case 'udouble':
        err = val.search(/^\+?(?:\d+|\.\d+|\d+\.|\d+\.\d+)$/) == - 1;
        break;

      case 'doublez':
        err = val.search(/^[-+]?(?:\d+|\.\d+|\d+\.|\d+\.\d+)$/) == - 1 || val.search(/^[-+]?[0\.]+$/) != - 1;
        break;

      case 'udoublez':
        err = val.search(/^\+?(?:\d+|\.\d+|\d+\.|\d+\.\d+)$/) == - 1 || val.search(/^\+?[0\.]+$/) != - 1;
        break;

      case 'ip':
        err = val.search(/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/) == - 1;
        break;
      }
    }

    if (err) {
      error_found = true;
      if (!first_obtained_err) {
        markErrorField(f, empty ? lbl_field_required: '');
      } else {
        markErrorField(f, errMsg == txt_email_invalid ? txt_email_invalid : '');
      }

      if (
        !first_obtained_err
        || is_admin_editor
      ) {
        $(f).focus();
      }

      if (is_admin_editor) {
        if (errFields.length < 20) 
          errFields[errFields.length] = $(this).html();
      }
      else {
        if (!first_obtained_err) {
          xAlert(substitute(errMsg,
            'field',
            $(this).html()),
            lbl_warning,
            'W'
          );
          first_obtained_err = true;
        }
        return;
      }
    }

  });

  if (error_found && !is_admin_editor) {

    return false;

  } else if (errFields.length > 0) {

    return confirm(substitute(txt_required_fields_not_completed, 'fields', "\n\t" + errFields.join(",\n\t") + "\n\n"));

  }

  return true;
}

/**
 * Highlight error field (CSS-based)
 * 
 * @param object  $f        Field object
 * @param string  $errLabel Error label
 * 
 * @return void
 * @see    ____func_see____
 */
function markErrorField(f, errLabel) {

  if (!f || f == 'undefined') {
    return true;
  }
  /* div.address-field is used for ideal_responsive/customer/main/address_fields.tpl */
  var container = $(f).parents('tr, .field-container, div.address-field')[0];

  if (container && container != 'undefined' && ! $(container).hasClass('fill-error')) {
    $(container).addClass('fill-error');

    if (errLabel && errLabel != '') {
      $(document.createElement('div')).attr('class', 'error-label').appendTo($(f).parent()).html(errLabel);
    }

    $(f).bind('keydown', function(event) {
      if (event.keyCode == '13') {
        event.preventDefault();
      }
      if ($.trim($(this).val() + String.fromCharCode(event.keyCode)) != '') {
        $(container).removeClass('fill-error').find('div.error-label').remove();
        $(this).unbind('keydown');
      }
    });
  }

}

/**
 * Mark empty required form fields
 * 
 * @param form $form Form object
 * 
 * @return void
 * @see    ____func_see____
 */
function markEmptyFields(form) {

  if (!form) {
    return;
  }

  /* div.address-field is used for ideal_responsive/customer/main/address_fields.tpl */
  $(form).find('.data-required').each(function() {
    var parentObj = $(this).parents('tr, .field-container, div.address-field')[0];

    if (!parentObj || parentObj == 'undefined') {
      return;
    }

    $(parentObj).find('input, textarea, select').each(function() {
      if (this.value == '') {
        markErrorField(this);
      }
    });
  });
}

/**
 * Apply checking of the required fields of the form
 * on submit automatically
 * 
 * @param form $form Form DOM object
 * 
 * @return bool
 * @see    ____func_see____
 */
function applyCheckOnSubmit(form) {

  if (!form) {
    return true;
  }

  var defaultAction = false;

  if (undefined !== form.onsubmit && form.onsubmit && form.onsubmit.constructor != String) {
    var defaultAction = form.onsubmit;
    form.onsubmit = null;
  }

  $(form).submit(function() {
    if (checkFormFields(form)) {
      if (defaultAction != false) {
        return defaultAction.call(form);
      }
      return true;
    }
    return false;
  });
}

/**
 * Custom alert using jQuery UI
 * 
 * @param string $msg    Message
 * @param string $header Alert header
 * 
 * @return void
 * @see    ____func_see____
 */
function xAlert(msg, header, type, options) {

  var buttons = {};
  buttons[lbl_ok] = function() {
    $(this).dialog('close').dialog('destroy').remove();
  }

  var typeClass = '';
  if (type) {
    type = type.toLowerCase();
    typeClass = ' type-' + type;
    if (!header) {
      switch (type) {
        case 'i': header = lbl_information; break;
        case 'w': header = lbl_warning; break;
        case 'e': header = lbl_error; break;
      }    
    }
  }

  var dialogOpts = {
    dialogClass: typeClass,
    modal: $('.ui-widget-overlay').length <= 0,
    title: undefined === header ? '': header,
    buttons: buttons
  };

  if (undefined !== options) {
    for (var i in options) {
      dialogOpts[i] = options[i];
    }
  }

  $(document.createElement('div')).attr('class', 'xalertbox').html(msg).dialog(dialogOpts);

}

/**
 * Custom confirm using jQuery UI
 * 
 * @param string   $msg      Message
 * @param string   $callback Callback on confirm
 * @param string   $header   Confirmation header text
 * 
 * @return void
 * @see    ____func_see____
 */
function xConfirm(msg, callback, header) {

  var buttons = {};
  buttons[lbl_no] = function() {
    $(this).dialog('destroy').remove();
  }
  buttons[lbl_yes] = function() {
    if (undefined !== callback && callback != '') {
      eval(callback);
    }
    $(this).dialog('destroy').remove();
  }

  $(document.createElement('div')).attr('class', 'xalertbox').html(msg).dialog({
    modal: $('.ui-widget-overlay').length <= 0,
    title: undefined === header ? '': header,
    buttons: buttons
  });

}

/**
 * Custom dialog with reload buttons using jQuery UI
 *
 * @param string   $msg      Message
 * @param string   $header   Confirmation header text
 *
 * @return void
 * @see    ____func_see____
 */
function xReload(msg, header, type) {

  var buttons = {};
  buttons[lbl_ok] = function() {
    window.location.reload();
  }

  var typeClass = ' type-' + type;

  $(document.createElement('div')).attr('class', 'xalertbox').html(msg).dialog({
    dialogClass: typeClass,
    modal: $('.ui-widget-overlay').length <= 0,
    title: undefined === header ? '': header,
    buttons: buttons
  });

  $('.ui-icon.ui-icon-closethick').click(
    function() {
      window.location.reload();
    }
  );
}

/**
 * Check if browser supports HTML5 storage. Can be replaced by Modernizr.localstorage
 *
 * @return boolean
 * @see    ____func_see____
 */
function isLocalStorageSupported() {
  try {
    return 'localStorage' in window && window['localStorage'] !== null;
  } catch (e) {
    return false;
  }
}

/**
 * Returns the version of Internet Explorer or a -1
 * (indicating the use of another browser).
 * 
 * The function is depricated use feature detect http://api.jquery.com/jQuery.support/ or http://modernizr.com/
 *
 * @return number
 * @see    ____func_see____
 */
function getInternetExplorerVersion()
{
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer')
    {
        var ua = navigator.userAgent;
        var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
        rv = parseFloat( RegExp.$1 );
    }
    return rv;
}

/* vim: set ts=2 sw=2 sts=2 et: */
/**
 * Browser identificator script, sends statistics
 * 
 * @category   X-Cart
 * @package    X-Cart
 * @subpackage JS Library
 * @author     Ruslan R. Fazlyev <rrf@x-cart.com> 
 * @version    ec2ca39cb71eff2cf859558b4f67f561a1b9efe4, v2 (xcart_4_4_0_beta_2), 2010-05-27 13:43:06, browser_identificator.js, igoryan
 * @link       http://www.x-cart.com/
 * @see        ____file_see____
 */

// Nandu
// var scriptNode = document.createElement("script");
// scriptNode.type = "text/javascript";
// setTimeout(
//   function() {
//     if (!scriptNode)
//       return;

//     scriptNode.src = xcart_web_dir + "/adaptive.php?send_browser=" +
//       (localIsDOM ? "Y" : "N") + (localIsStrict ? "Y" : "N") + (localIsJava ? "Y" : "N") + "|" + 
//       localBrowser + "|" + 
//       localVersion + "|" + 
//       localPlatform + "|" + 
//       (localIsCookie ? "Y" : "N") + "|" + 
//       screen.width + "|" + 
//       screen.height + "|" + 
//       current_area;
//     document.getElementsByTagName('head')[0].appendChild(scriptNode);
//   },
//   3000
// );

/*! jQuery v1.10.2 | (c) 2005, 2013 jQuery Foundation, Inc. | jquery.org/license
//@ sourceMappingURL=../../skin/common_files/lib/jquery-1.10.2.min.map
*/
// Nandu
/*
(function(e,t){var n,r,i=typeof t,o=e.location,a=e.document,s=a.documentElement,l=e.jQuery,u=e.$,c={},p=[],f="1.10.2",d=p.concat,h=p.push,g=p.slice,m=p.indexOf,y=c.toString,v=c.hasOwnProperty,b=f.trim,x=function(e,t){return new x.fn.init(e,t,r)},w=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,T=/\S+/g,C=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,N=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,k=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,E=/^[\],:{}\s]*$/,S=/(?:^|:|,)(?:\s*\[)+/g,A=/\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,j=/"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,D=/^-ms-/,L=/-([\da-z])/gi,H=function(e,t){return t.toUpperCase()},q=function(e){(a.addEventListener||"load"===e.type||"complete"===a.readyState)&&(_(),x.ready())},_=function(){a.addEventListener?(a.removeEventListener("DOMContentLoaded",q,!1),e.removeEventListener("load",q,!1)):(a.detachEvent("onreadystatechange",q),e.detachEvent("onload",q))};x.fn=x.prototype={jquery:f,constructor:x,init:function(e,n,r){var i,o;if(!e)return this;if("string"==typeof e){if(i="<"===e.charAt(0)&&">"===e.charAt(e.length-1)&&e.length>=3?[null,e,null]:N.exec(e),!i||!i[1]&&n)return!n||n.jquery?(n||r).find(e):this.constructor(n).find(e);if(i[1]){if(n=n instanceof x?n[0]:n,x.merge(this,x.parseHTML(i[1],n&&n.nodeType?n.ownerDocument||n:a,!0)),k.test(i[1])&&x.isPlainObject(n))for(i in n)x.isFunction(this[i])?this[i](n[i]):this.attr(i,n[i]);return this}if(o=a.getElementById(i[2]),o&&o.parentNode){if(o.id!==i[2])return r.find(e);this.length=1,this[0]=o}return this.context=a,this.selector=e,this}return e.nodeType?(this.context=this[0]=e,this.length=1,this):x.isFunction(e)?r.ready(e):(e.selector!==t&&(this.selector=e.selector,this.context=e.context),x.makeArray(e,this))},selector:"",length:0,toArray:function(){return g.call(this)},get:function(e){return null==e?this.toArray():0>e?this[this.length+e]:this[e]},pushStack:function(e){var t=x.merge(this.constructor(),e);return t.prevObject=this,t.context=this.context,t},each:function(e,t){return x.each(this,e,t)},ready:function(e){return x.ready.promise().done(e),this},slice:function(){return this.pushStack(g.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(e){var t=this.length,n=+e+(0>e?t:0);return this.pushStack(n>=0&&t>n?[this[n]]:[])},map:function(e){return this.pushStack(x.map(this,function(t,n){return e.call(t,n,t)}))},end:function(){return this.prevObject||this.constructor(null)},push:h,sort:[].sort,splice:[].splice},x.fn.init.prototype=x.fn,x.extend=x.fn.extend=function(){var e,n,r,i,o,a,s=arguments[0]||{},l=1,u=arguments.length,c=!1;for("boolean"==typeof s&&(c=s,s=arguments[1]||{},l=2),"object"==typeof s||x.isFunction(s)||(s={}),u===l&&(s=this,--l);u>l;l++)if(null!=(o=arguments[l]))for(i in o)e=s[i],r=o[i],s!==r&&(c&&r&&(x.isPlainObject(r)||(n=x.isArray(r)))?(n?(n=!1,a=e&&x.isArray(e)?e:[]):a=e&&x.isPlainObject(e)?e:{},s[i]=x.extend(c,a,r)):r!==t&&(s[i]=r));return s},x.extend({expando:"jQuery"+(f+Math.random()).replace(/\D/g,""),noConflict:function(t){return e.$===x&&(e.$=u),t&&e.jQuery===x&&(e.jQuery=l),x},isReady:!1,readyWait:1,holdReady:function(e){e?x.readyWait++:x.ready(!0)},ready:function(e){if(e===!0?!--x.readyWait:!x.isReady){if(!a.body)return setTimeout(x.ready);x.isReady=!0,e!==!0&&--x.readyWait>0||(n.resolveWith(a,[x]),x.fn.trigger&&x(a).trigger("ready").off("ready"))}},isFunction:function(e){return"function"===x.type(e)},isArray:Array.isArray||function(e){return"array"===x.type(e)},isWindow:function(e){return null!=e&&e==e.window},isNumeric:function(e){return!isNaN(parseFloat(e))&&isFinite(e)},type:function(e){return null==e?e+"":"object"==typeof e||"function"==typeof e?c[y.call(e)]||"object":typeof e},isPlainObject:function(e){var n;if(!e||"object"!==x.type(e)||e.nodeType||x.isWindow(e))return!1;try{if(e.constructor&&!v.call(e,"constructor")&&!v.call(e.constructor.prototype,"isPrototypeOf"))return!1}catch(r){return!1}if(x.support.ownLast)for(n in e)return v.call(e,n);for(n in e);return n===t||v.call(e,n)},isEmptyObject:function(e){var t;for(t in e)return!1;return!0},error:function(e){throw Error(e)},parseHTML:function(e,t,n){if(!e||"string"!=typeof e)return null;"boolean"==typeof t&&(n=t,t=!1),t=t||a;var r=k.exec(e),i=!n&&[];return r?[t.createElement(r[1])]:(r=x.buildFragment([e],t,i),i&&x(i).remove(),x.merge([],r.childNodes))},parseJSON:function(n){return e.JSON&&e.JSON.parse?e.JSON.parse(n):null===n?n:"string"==typeof n&&(n=x.trim(n),n&&E.test(n.replace(A,"@").replace(j,"]").replace(S,"")))?Function("return "+n)():(x.error("Invalid JSON: "+n),t)},parseXML:function(n){var r,i;if(!n||"string"!=typeof n)return null;try{e.DOMParser?(i=new DOMParser,r=i.parseFromString(n,"text/xml")):(r=new ActiveXObject("Microsoft.XMLDOM"),r.async="false",r.loadXML(n))}catch(o){r=t}return r&&r.documentElement&&!r.getElementsByTagName("parsererror").length||x.error("Invalid XML: "+n),r},noop:function(){},globalEval:function(t){t&&x.trim(t)&&(e.execScript||function(t){e.eval.call(e,t)})(t)},camelCase:function(e){return e.replace(D,"ms-").replace(L,H)},nodeName:function(e,t){return e.nodeName&&e.nodeName.toLowerCase()===t.toLowerCase()},each:function(e,t,n){var r,i=0,o=e.length,a=M(e);if(n){if(a){for(;o>i;i++)if(r=t.apply(e[i],n),r===!1)break}else for(i in e)if(r=t.apply(e[i],n),r===!1)break}else if(a){for(;o>i;i++)if(r=t.call(e[i],i,e[i]),r===!1)break}else for(i in e)if(r=t.call(e[i],i,e[i]),r===!1)break;return e},trim:b&&!b.call("\ufeff\u00a0")?function(e){return null==e?"":b.call(e)}:function(e){return null==e?"":(e+"").replace(C,"")},makeArray:function(e,t){var n=t||[];return null!=e&&(M(Object(e))?x.merge(n,"string"==typeof e?[e]:e):h.call(n,e)),n},inArray:function(e,t,n){var r;if(t){if(m)return m.call(t,e,n);for(r=t.length,n=n?0>n?Math.max(0,r+n):n:0;r>n;n++)if(n in t&&t[n]===e)return n}return-1},merge:function(e,n){var r=n.length,i=e.length,o=0;if("number"==typeof r)for(;r>o;o++)e[i++]=n[o];else while(n[o]!==t)e[i++]=n[o++];return e.length=i,e},grep:function(e,t,n){var r,i=[],o=0,a=e.length;for(n=!!n;a>o;o++)r=!!t(e[o],o),n!==r&&i.push(e[o]);return i},map:function(e,t,n){var r,i=0,o=e.length,a=M(e),s=[];if(a)for(;o>i;i++)r=t(e[i],i,n),null!=r&&(s[s.length]=r);else for(i in e)r=t(e[i],i,n),null!=r&&(s[s.length]=r);return d.apply([],s)},guid:1,proxy:function(e,n){var r,i,o;return"string"==typeof n&&(o=e[n],n=e,e=o),x.isFunction(e)?(r=g.call(arguments,2),i=function(){return e.apply(n||this,r.concat(g.call(arguments)))},i.guid=e.guid=e.guid||x.guid++,i):t},access:function(e,n,r,i,o,a,s){var l=0,u=e.length,c=null==r;if("object"===x.type(r)){o=!0;for(l in r)x.access(e,n,l,r[l],!0,a,s)}else if(i!==t&&(o=!0,x.isFunction(i)||(s=!0),c&&(s?(n.call(e,i),n=null):(c=n,n=function(e,t,n){return c.call(x(e),n)})),n))for(;u>l;l++)n(e[l],r,s?i:i.call(e[l],l,n(e[l],r)));return o?e:c?n.call(e):u?n(e[0],r):a},now:function(){return(new Date).getTime()},swap:function(e,t,n,r){var i,o,a={};for(o in t)a[o]=e.style[o],e.style[o]=t[o];i=n.apply(e,r||[]);for(o in t)e.style[o]=a[o];return i}}),x.ready.promise=function(t){if(!n)if(n=x.Deferred(),"complete"===a.readyState)setTimeout(x.ready);else if(a.addEventListener)a.addEventListener("DOMContentLoaded",q,!1),e.addEventListener("load",q,!1);else{a.attachEvent("onreadystatechange",q),e.attachEvent("onload",q);var r=!1;try{r=null==e.frameElement&&a.documentElement}catch(i){}r&&r.doScroll&&function o(){if(!x.isReady){try{r.doScroll("left")}catch(e){return setTimeout(o,50)}_(),x.ready()}}()}return n.promise(t)},x.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(e,t){c["[object "+t+"]"]=t.toLowerCase()});function M(e){var t=e.length,n=x.type(e);return x.isWindow(e)?!1:1===e.nodeType&&t?!0:"array"===n||"function"!==n&&(0===t||"number"==typeof t&&t>0&&t-1 in e)}r=x(a),function(e,t){var n,r,i,o,a,s,l,u,c,p,f,d,h,g,m,y,v,b="sizzle"+-new Date,w=e.document,T=0,C=0,N=st(),k=st(),E=st(),S=!1,A=function(e,t){return e===t?(S=!0,0):0},j=typeof t,D=1<<31,L={}.hasOwnProperty,H=[],q=H.pop,_=H.push,M=H.push,O=H.slice,F=H.indexOf||function(e){var t=0,n=this.length;for(;n>t;t++)if(this[t]===e)return t;return-1},B="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",P="[\\x20\\t\\r\\n\\f]",R="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",W=R.replace("w","w#"),$="\\["+P+"*("+R+")"+P+"*(?:([*^$|!~]?=)"+P+"*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|("+W+")|)|)"+P+"*\\]",I=":("+R+")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|"+$.replace(3,8)+")*)|.*)\\)|)",z=RegExp("^"+P+"+|((?:^|[^\\\\])(?:\\\\.)*)"+P+"+$","g"),X=RegExp("^"+P+"*,"+P+"*"),U=RegExp("^"+P+"*([>+~]|"+P+")"+P+"*"),V=RegExp(P+"*[+~]"),Y=RegExp("="+P+"*([^\\]'\"]*)"+P+"*\\]","g"),J=RegExp(I),G=RegExp("^"+W+"$"),Q={ID:RegExp("^#("+R+")"),CLASS:RegExp("^\\.("+R+")"),TAG:RegExp("^("+R.replace("w","w*")+")"),ATTR:RegExp("^"+$),PSEUDO:RegExp("^"+I),CHILD:RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+P+"*(even|odd|(([+-]|)(\\d*)n|)"+P+"*(?:([+-]|)"+P+"*(\\d+)|))"+P+"*\\)|)","i"),bool:RegExp("^(?:"+B+")$","i"),needsContext:RegExp("^"+P+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+P+"*((?:-\\d)?\\d*)"+P+"*\\)|)(?=[^-]|$)","i")},K=/^[^{]+\{\s*\[native \w/,Z=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,et=/^(?:input|select|textarea|button)$/i,tt=/^h\d$/i,nt=/'|\\/g,rt=RegExp("\\\\([\\da-f]{1,6}"+P+"?|("+P+")|.)","ig"),it=function(e,t,n){var r="0x"+t-65536;return r!==r||n?t:0>r?String.fromCharCode(r+65536):String.fromCharCode(55296|r>>10,56320|1023&r)};try{M.apply(H=O.call(w.childNodes),w.childNodes),H[w.childNodes.length].nodeType}catch(ot){M={apply:H.length?function(e,t){_.apply(e,O.call(t))}:function(e,t){var n=e.length,r=0;while(e[n++]=t[r++]);e.length=n-1}}}function at(e,t,n,i){var o,a,s,l,u,c,d,m,y,x;if((t?t.ownerDocument||t:w)!==f&&p(t),t=t||f,n=n||[],!e||"string"!=typeof e)return n;if(1!==(l=t.nodeType)&&9!==l)return[];if(h&&!i){if(o=Z.exec(e))if(s=o[1]){if(9===l){if(a=t.getElementById(s),!a||!a.parentNode)return n;if(a.id===s)return n.push(a),n}else if(t.ownerDocument&&(a=t.ownerDocument.getElementById(s))&&v(t,a)&&a.id===s)return n.push(a),n}else{if(o[2])return M.apply(n,t.getElementsByTagName(e)),n;if((s=o[3])&&r.getElementsByClassName&&t.getElementsByClassName)return M.apply(n,t.getElementsByClassName(s)),n}if(r.qsa&&(!g||!g.test(e))){if(m=d=b,y=t,x=9===l&&e,1===l&&"object"!==t.nodeName.toLowerCase()){c=mt(e),(d=t.getAttribute("id"))?m=d.replace(nt,"\\$&"):t.setAttribute("id",m),m="[id='"+m+"'] ",u=c.length;while(u--)c[u]=m+yt(c[u]);y=V.test(e)&&t.parentNode||t,x=c.join(",")}if(x)try{return M.apply(n,y.querySelectorAll(x)),n}catch(T){}finally{d||t.removeAttribute("id")}}}return kt(e.replace(z,"$1"),t,n,i)}function st(){var e=[];function t(n,r){return e.push(n+=" ")>o.cacheLength&&delete t[e.shift()],t[n]=r}return t}function lt(e){return e[b]=!0,e}function ut(e){var t=f.createElement("div");try{return!!e(t)}catch(n){return!1}finally{t.parentNode&&t.parentNode.removeChild(t),t=null}}function ct(e,t){var n=e.split("|"),r=e.length;while(r--)o.attrHandle[n[r]]=t}function pt(e,t){var n=t&&e,r=n&&1===e.nodeType&&1===t.nodeType&&(~t.sourceIndex||D)-(~e.sourceIndex||D);if(r)return r;if(n)while(n=n.nextSibling)if(n===t)return-1;return e?1:-1}function ft(e){return function(t){var n=t.nodeName.toLowerCase();return"input"===n&&t.type===e}}function dt(e){return function(t){var n=t.nodeName.toLowerCase();return("input"===n||"button"===n)&&t.type===e}}function ht(e){return lt(function(t){return t=+t,lt(function(n,r){var i,o=e([],n.length,t),a=o.length;while(a--)n[i=o[a]]&&(n[i]=!(r[i]=n[i]))})})}s=at.isXML=function(e){var t=e&&(e.ownerDocument||e).documentElement;return t?"HTML"!==t.nodeName:!1},r=at.support={},p=at.setDocument=function(e){var n=e?e.ownerDocument||e:w,i=n.defaultView;return n!==f&&9===n.nodeType&&n.documentElement?(f=n,d=n.documentElement,h=!s(n),i&&i.attachEvent&&i!==i.top&&i.attachEvent("onbeforeunload",function(){p()}),r.attributes=ut(function(e){return e.className="i",!e.getAttribute("className")}),r.getElementsByTagName=ut(function(e){return e.appendChild(n.createComment("")),!e.getElementsByTagName("*").length}),r.getElementsByClassName=ut(function(e){return e.innerHTML="<div class='a'></div><div class='a i'></div>",e.firstChild.className="i",2===e.getElementsByClassName("i").length}),r.getById=ut(function(e){return d.appendChild(e).id=b,!n.getElementsByName||!n.getElementsByName(b).length}),r.getById?(o.find.ID=function(e,t){if(typeof t.getElementById!==j&&h){var n=t.getElementById(e);return n&&n.parentNode?[n]:[]}},o.filter.ID=function(e){var t=e.replace(rt,it);return function(e){return e.getAttribute("id")===t}}):(delete o.find.ID,o.filter.ID=function(e){var t=e.replace(rt,it);return function(e){var n=typeof e.getAttributeNode!==j&&e.getAttributeNode("id");return n&&n.value===t}}),o.find.TAG=r.getElementsByTagName?function(e,n){return typeof n.getElementsByTagName!==j?n.getElementsByTagName(e):t}:function(e,t){var n,r=[],i=0,o=t.getElementsByTagName(e);if("*"===e){while(n=o[i++])1===n.nodeType&&r.push(n);return r}return o},o.find.CLASS=r.getElementsByClassName&&function(e,n){return typeof n.getElementsByClassName!==j&&h?n.getElementsByClassName(e):t},m=[],g=[],(r.qsa=K.test(n.querySelectorAll))&&(ut(function(e){e.innerHTML="<select><option selected=''></option></select>",e.querySelectorAll("[selected]").length||g.push("\\["+P+"*(?:value|"+B+")"),e.querySelectorAll(":checked").length||g.push(":checked")}),ut(function(e){var t=n.createElement("input");t.setAttribute("type","hidden"),e.appendChild(t).setAttribute("t",""),e.querySelectorAll("[t^='']").length&&g.push("[*^$]="+P+"*(?:''|\"\")"),e.querySelectorAll(":enabled").length||g.push(":enabled",":disabled"),e.querySelectorAll("*,:x"),g.push(",.*:")})),(r.matchesSelector=K.test(y=d.webkitMatchesSelector||d.mozMatchesSelector||d.oMatchesSelector||d.msMatchesSelector))&&ut(function(e){r.disconnectedMatch=y.call(e,"div"),y.call(e,"[s!='']:x"),m.push("!=",I)}),g=g.length&&RegExp(g.join("|")),m=m.length&&RegExp(m.join("|")),v=K.test(d.contains)||d.compareDocumentPosition?function(e,t){var n=9===e.nodeType?e.documentElement:e,r=t&&t.parentNode;return e===r||!(!r||1!==r.nodeType||!(n.contains?n.contains(r):e.compareDocumentPosition&&16&e.compareDocumentPosition(r)))}:function(e,t){if(t)while(t=t.parentNode)if(t===e)return!0;return!1},A=d.compareDocumentPosition?function(e,t){if(e===t)return S=!0,0;var i=t.compareDocumentPosition&&e.compareDocumentPosition&&e.compareDocumentPosition(t);return i?1&i||!r.sortDetached&&t.compareDocumentPosition(e)===i?e===n||v(w,e)?-1:t===n||v(w,t)?1:c?F.call(c,e)-F.call(c,t):0:4&i?-1:1:e.compareDocumentPosition?-1:1}:function(e,t){var r,i=0,o=e.parentNode,a=t.parentNode,s=[e],l=[t];if(e===t)return S=!0,0;if(!o||!a)return e===n?-1:t===n?1:o?-1:a?1:c?F.call(c,e)-F.call(c,t):0;if(o===a)return pt(e,t);r=e;while(r=r.parentNode)s.unshift(r);r=t;while(r=r.parentNode)l.unshift(r);while(s[i]===l[i])i++;return i?pt(s[i],l[i]):s[i]===w?-1:l[i]===w?1:0},n):f},at.matches=function(e,t){return at(e,null,null,t)},at.matchesSelector=function(e,t){if((e.ownerDocument||e)!==f&&p(e),t=t.replace(Y,"='$1']"),!(!r.matchesSelector||!h||m&&m.test(t)||g&&g.test(t)))try{var n=y.call(e,t);if(n||r.disconnectedMatch||e.document&&11!==e.document.nodeType)return n}catch(i){}return at(t,f,null,[e]).length>0},at.contains=function(e,t){return(e.ownerDocument||e)!==f&&p(e),v(e,t)},at.attr=function(e,n){(e.ownerDocument||e)!==f&&p(e);var i=o.attrHandle[n.toLowerCase()],a=i&&L.call(o.attrHandle,n.toLowerCase())?i(e,n,!h):t;return a===t?r.attributes||!h?e.getAttribute(n):(a=e.getAttributeNode(n))&&a.specified?a.value:null:a},at.error=function(e){throw Error("Syntax error, unrecognized expression: "+e)},at.uniqueSort=function(e){var t,n=[],i=0,o=0;if(S=!r.detectDuplicates,c=!r.sortStable&&e.slice(0),e.sort(A),S){while(t=e[o++])t===e[o]&&(i=n.push(o));while(i--)e.splice(n[i],1)}return e},a=at.getText=function(e){var t,n="",r=0,i=e.nodeType;if(i){if(1===i||9===i||11===i){if("string"==typeof e.textContent)return e.textContent;for(e=e.firstChild;e;e=e.nextSibling)n+=a(e)}else if(3===i||4===i)return e.nodeValue}else for(;t=e[r];r++)n+=a(t);return n},o=at.selectors={cacheLength:50,createPseudo:lt,match:Q,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(e){return e[1]=e[1].replace(rt,it),e[3]=(e[4]||e[5]||"").replace(rt,it),"~="===e[2]&&(e[3]=" "+e[3]+" "),e.slice(0,4)},CHILD:function(e){return e[1]=e[1].toLowerCase(),"nth"===e[1].slice(0,3)?(e[3]||at.error(e[0]),e[4]=+(e[4]?e[5]+(e[6]||1):2*("even"===e[3]||"odd"===e[3])),e[5]=+(e[7]+e[8]||"odd"===e[3])):e[3]&&at.error(e[0]),e},PSEUDO:function(e){var n,r=!e[5]&&e[2];return Q.CHILD.test(e[0])?null:(e[3]&&e[4]!==t?e[2]=e[4]:r&&J.test(r)&&(n=mt(r,!0))&&(n=r.indexOf(")",r.length-n)-r.length)&&(e[0]=e[0].slice(0,n),e[2]=r.slice(0,n)),e.slice(0,3))}},filter:{TAG:function(e){var t=e.replace(rt,it).toLowerCase();return"*"===e?function(){return!0}:function(e){return e.nodeName&&e.nodeName.toLowerCase()===t}},CLASS:function(e){var t=N[e+" "];return t||(t=RegExp("(^|"+P+")"+e+"("+P+"|$)"))&&N(e,function(e){return t.test("string"==typeof e.className&&e.className||typeof e.getAttribute!==j&&e.getAttribute("class")||"")})},ATTR:function(e,t,n){return function(r){var i=at.attr(r,e);return null==i?"!="===t:t?(i+="","="===t?i===n:"!="===t?i!==n:"^="===t?n&&0===i.indexOf(n):"*="===t?n&&i.indexOf(n)>-1:"$="===t?n&&i.slice(-n.length)===n:"~="===t?(" "+i+" ").indexOf(n)>-1:"|="===t?i===n||i.slice(0,n.length+1)===n+"-":!1):!0}},CHILD:function(e,t,n,r,i){var o="nth"!==e.slice(0,3),a="last"!==e.slice(-4),s="of-type"===t;return 1===r&&0===i?function(e){return!!e.parentNode}:function(t,n,l){var u,c,p,f,d,h,g=o!==a?"nextSibling":"previousSibling",m=t.parentNode,y=s&&t.nodeName.toLowerCase(),v=!l&&!s;if(m){if(o){while(g){p=t;while(p=p[g])if(s?p.nodeName.toLowerCase()===y:1===p.nodeType)return!1;h=g="only"===e&&!h&&"nextSibling"}return!0}if(h=[a?m.firstChild:m.lastChild],a&&v){c=m[b]||(m[b]={}),u=c[e]||[],d=u[0]===T&&u[1],f=u[0]===T&&u[2],p=d&&m.childNodes[d];while(p=++d&&p&&p[g]||(f=d=0)||h.pop())if(1===p.nodeType&&++f&&p===t){c[e]=[T,d,f];break}}else if(v&&(u=(t[b]||(t[b]={}))[e])&&u[0]===T)f=u[1];else while(p=++d&&p&&p[g]||(f=d=0)||h.pop())if((s?p.nodeName.toLowerCase()===y:1===p.nodeType)&&++f&&(v&&((p[b]||(p[b]={}))[e]=[T,f]),p===t))break;return f-=i,f===r||0===f%r&&f/r>=0}}},PSEUDO:function(e,t){var n,r=o.pseudos[e]||o.setFilters[e.toLowerCase()]||at.error("unsupported pseudo: "+e);return r[b]?r(t):r.length>1?(n=[e,e,"",t],o.setFilters.hasOwnProperty(e.toLowerCase())?lt(function(e,n){var i,o=r(e,t),a=o.length;while(a--)i=F.call(e,o[a]),e[i]=!(n[i]=o[a])}):function(e){return r(e,0,n)}):r}},pseudos:{not:lt(function(e){var t=[],n=[],r=l(e.replace(z,"$1"));return r[b]?lt(function(e,t,n,i){var o,a=r(e,null,i,[]),s=e.length;while(s--)(o=a[s])&&(e[s]=!(t[s]=o))}):function(e,i,o){return t[0]=e,r(t,null,o,n),!n.pop()}}),has:lt(function(e){return function(t){return at(e,t).length>0}}),contains:lt(function(e){return function(t){return(t.textContent||t.innerText||a(t)).indexOf(e)>-1}}),lang:lt(function(e){return G.test(e||"")||at.error("unsupported lang: "+e),e=e.replace(rt,it).toLowerCase(),function(t){var n;do if(n=h?t.lang:t.getAttribute("xml:lang")||t.getAttribute("lang"))return n=n.toLowerCase(),n===e||0===n.indexOf(e+"-");while((t=t.parentNode)&&1===t.nodeType);return!1}}),target:function(t){var n=e.location&&e.location.hash;return n&&n.slice(1)===t.id},root:function(e){return e===d},focus:function(e){return e===f.activeElement&&(!f.hasFocus||f.hasFocus())&&!!(e.type||e.href||~e.tabIndex)},enabled:function(e){return e.disabled===!1},disabled:function(e){return e.disabled===!0},checked:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&!!e.checked||"option"===t&&!!e.selected},selected:function(e){return e.parentNode&&e.parentNode.selectedIndex,e.selected===!0},empty:function(e){for(e=e.firstChild;e;e=e.nextSibling)if(e.nodeName>"@"||3===e.nodeType||4===e.nodeType)return!1;return!0},parent:function(e){return!o.pseudos.empty(e)},header:function(e){return tt.test(e.nodeName)},input:function(e){return et.test(e.nodeName)},button:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&"button"===e.type||"button"===t},text:function(e){var t;return"input"===e.nodeName.toLowerCase()&&"text"===e.type&&(null==(t=e.getAttribute("type"))||t.toLowerCase()===e.type)},first:ht(function(){return[0]}),last:ht(function(e,t){return[t-1]}),eq:ht(function(e,t,n){return[0>n?n+t:n]}),even:ht(function(e,t){var n=0;for(;t>n;n+=2)e.push(n);return e}),odd:ht(function(e,t){var n=1;for(;t>n;n+=2)e.push(n);return e}),lt:ht(function(e,t,n){var r=0>n?n+t:n;for(;--r>=0;)e.push(r);return e}),gt:ht(function(e,t,n){var r=0>n?n+t:n;for(;t>++r;)e.push(r);return e})}},o.pseudos.nth=o.pseudos.eq;for(n in{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})o.pseudos[n]=ft(n);for(n in{submit:!0,reset:!0})o.pseudos[n]=dt(n);function gt(){}gt.prototype=o.filters=o.pseudos,o.setFilters=new gt;function mt(e,t){var n,r,i,a,s,l,u,c=k[e+" "];if(c)return t?0:c.slice(0);s=e,l=[],u=o.preFilter;while(s){(!n||(r=X.exec(s)))&&(r&&(s=s.slice(r[0].length)||s),l.push(i=[])),n=!1,(r=U.exec(s))&&(n=r.shift(),i.push({value:n,type:r[0].replace(z," ")}),s=s.slice(n.length));for(a in o.filter)!(r=Q[a].exec(s))||u[a]&&!(r=u[a](r))||(n=r.shift(),i.push({value:n,type:a,matches:r}),s=s.slice(n.length));if(!n)break}return t?s.length:s?at.error(e):k(e,l).slice(0)}function yt(e){var t=0,n=e.length,r="";for(;n>t;t++)r+=e[t].value;return r}function vt(e,t,n){var r=t.dir,o=n&&"parentNode"===r,a=C++;return t.first?function(t,n,i){while(t=t[r])if(1===t.nodeType||o)return e(t,n,i)}:function(t,n,s){var l,u,c,p=T+" "+a;if(s){while(t=t[r])if((1===t.nodeType||o)&&e(t,n,s))return!0}else while(t=t[r])if(1===t.nodeType||o)if(c=t[b]||(t[b]={}),(u=c[r])&&u[0]===p){if((l=u[1])===!0||l===i)return l===!0}else if(u=c[r]=[p],u[1]=e(t,n,s)||i,u[1]===!0)return!0}}function bt(e){return e.length>1?function(t,n,r){var i=e.length;while(i--)if(!e[i](t,n,r))return!1;return!0}:e[0]}function xt(e,t,n,r,i){var o,a=[],s=0,l=e.length,u=null!=t;for(;l>s;s++)(o=e[s])&&(!n||n(o,r,i))&&(a.push(o),u&&t.push(s));return a}function wt(e,t,n,r,i,o){return r&&!r[b]&&(r=wt(r)),i&&!i[b]&&(i=wt(i,o)),lt(function(o,a,s,l){var u,c,p,f=[],d=[],h=a.length,g=o||Nt(t||"*",s.nodeType?[s]:s,[]),m=!e||!o&&t?g:xt(g,f,e,s,l),y=n?i||(o?e:h||r)?[]:a:m;if(n&&n(m,y,s,l),r){u=xt(y,d),r(u,[],s,l),c=u.length;while(c--)(p=u[c])&&(y[d[c]]=!(m[d[c]]=p))}if(o){if(i||e){if(i){u=[],c=y.length;while(c--)(p=y[c])&&u.push(m[c]=p);i(null,y=[],u,l)}c=y.length;while(c--)(p=y[c])&&(u=i?F.call(o,p):f[c])>-1&&(o[u]=!(a[u]=p))}}else y=xt(y===a?y.splice(h,y.length):y),i?i(null,a,y,l):M.apply(a,y)})}function Tt(e){var t,n,r,i=e.length,a=o.relative[e[0].type],s=a||o.relative[" "],l=a?1:0,c=vt(function(e){return e===t},s,!0),p=vt(function(e){return F.call(t,e)>-1},s,!0),f=[function(e,n,r){return!a&&(r||n!==u)||((t=n).nodeType?c(e,n,r):p(e,n,r))}];for(;i>l;l++)if(n=o.relative[e[l].type])f=[vt(bt(f),n)];else{if(n=o.filter[e[l].type].apply(null,e[l].matches),n[b]){for(r=++l;i>r;r++)if(o.relative[e[r].type])break;return wt(l>1&&bt(f),l>1&&yt(e.slice(0,l-1).concat({value:" "===e[l-2].type?"*":""})).replace(z,"$1"),n,r>l&&Tt(e.slice(l,r)),i>r&&Tt(e=e.slice(r)),i>r&&yt(e))}f.push(n)}return bt(f)}function Ct(e,t){var n=0,r=t.length>0,a=e.length>0,s=function(s,l,c,p,d){var h,g,m,y=[],v=0,b="0",x=s&&[],w=null!=d,C=u,N=s||a&&o.find.TAG("*",d&&l.parentNode||l),k=T+=null==C?1:Math.random()||.1;for(w&&(u=l!==f&&l,i=n);null!=(h=N[b]);b++){if(a&&h){g=0;while(m=e[g++])if(m(h,l,c)){p.push(h);break}w&&(T=k,i=++n)}r&&((h=!m&&h)&&v--,s&&x.push(h))}if(v+=b,r&&b!==v){g=0;while(m=t[g++])m(x,y,l,c);if(s){if(v>0)while(b--)x[b]||y[b]||(y[b]=q.call(p));y=xt(y)}M.apply(p,y),w&&!s&&y.length>0&&v+t.length>1&&at.uniqueSort(p)}return w&&(T=k,u=C),x};return r?lt(s):s}l=at.compile=function(e,t){var n,r=[],i=[],o=E[e+" "];if(!o){t||(t=mt(e)),n=t.length;while(n--)o=Tt(t[n]),o[b]?r.push(o):i.push(o);o=E(e,Ct(i,r))}return o};function Nt(e,t,n){var r=0,i=t.length;for(;i>r;r++)at(e,t[r],n);return n}function kt(e,t,n,i){var a,s,u,c,p,f=mt(e);if(!i&&1===f.length){if(s=f[0]=f[0].slice(0),s.length>2&&"ID"===(u=s[0]).type&&r.getById&&9===t.nodeType&&h&&o.relative[s[1].type]){if(t=(o.find.ID(u.matches[0].replace(rt,it),t)||[])[0],!t)return n;e=e.slice(s.shift().value.length)}a=Q.needsContext.test(e)?0:s.length;while(a--){if(u=s[a],o.relative[c=u.type])break;if((p=o.find[c])&&(i=p(u.matches[0].replace(rt,it),V.test(s[0].type)&&t.parentNode||t))){if(s.splice(a,1),e=i.length&&yt(s),!e)return M.apply(n,i),n;break}}}return l(e,f)(i,t,!h,n,V.test(e)),n}r.sortStable=b.split("").sort(A).join("")===b,r.detectDuplicates=S,p(),r.sortDetached=ut(function(e){return 1&e.compareDocumentPosition(f.createElement("div"))}),ut(function(e){return e.innerHTML="<a href='#'></a>","#"===e.firstChild.getAttribute("href")})||ct("type|href|height|width",function(e,n,r){return r?t:e.getAttribute(n,"type"===n.toLowerCase()?1:2)}),r.attributes&&ut(function(e){return e.innerHTML="<input/>",e.firstChild.setAttribute("value",""),""===e.firstChild.getAttribute("value")})||ct("value",function(e,n,r){return r||"input"!==e.nodeName.toLowerCase()?t:e.defaultValue}),ut(function(e){return null==e.getAttribute("disabled")})||ct(B,function(e,n,r){var i;return r?t:(i=e.getAttributeNode(n))&&i.specified?i.value:e[n]===!0?n.toLowerCase():null}),x.find=at,x.expr=at.selectors,x.expr[":"]=x.expr.pseudos,x.unique=at.uniqueSort,x.text=at.getText,x.isXMLDoc=at.isXML,x.contains=at.contains}(e);var O={};function F(e){var t=O[e]={};return x.each(e.match(T)||[],function(e,n){t[n]=!0}),t}x.Callbacks=function(e){e="string"==typeof e?O[e]||F(e):x.extend({},e);var n,r,i,o,a,s,l=[],u=!e.once&&[],c=function(t){for(r=e.memory&&t,i=!0,a=s||0,s=0,o=l.length,n=!0;l&&o>a;a++)if(l[a].apply(t[0],t[1])===!1&&e.stopOnFalse){r=!1;break}n=!1,l&&(u?u.length&&c(u.shift()):r?l=[]:p.disable())},p={add:function(){if(l){var t=l.length;(function i(t){x.each(t,function(t,n){var r=x.type(n);"function"===r?e.unique&&p.has(n)||l.push(n):n&&n.length&&"string"!==r&&i(n)})})(arguments),n?o=l.length:r&&(s=t,c(r))}return this},remove:function(){return l&&x.each(arguments,function(e,t){var r;while((r=x.inArray(t,l,r))>-1)l.splice(r,1),n&&(o>=r&&o--,a>=r&&a--)}),this},has:function(e){return e?x.inArray(e,l)>-1:!(!l||!l.length)},empty:function(){return l=[],o=0,this},disable:function(){return l=u=r=t,this},disabled:function(){return!l},lock:function(){return u=t,r||p.disable(),this},locked:function(){return!u},fireWith:function(e,t){return!l||i&&!u||(t=t||[],t=[e,t.slice?t.slice():t],n?u.push(t):c(t)),this},fire:function(){return p.fireWith(this,arguments),this},fired:function(){return!!i}};return p},x.extend({Deferred:function(e){var t=[["resolve","done",x.Callbacks("once memory"),"resolved"],["reject","fail",x.Callbacks("once memory"),"rejected"],["notify","progress",x.Callbacks("memory")]],n="pending",r={state:function(){return n},always:function(){return i.done(arguments).fail(arguments),this},then:function(){var e=arguments;return x.Deferred(function(n){x.each(t,function(t,o){var a=o[0],s=x.isFunction(e[t])&&e[t];i[o[1]](function(){var e=s&&s.apply(this,arguments);e&&x.isFunction(e.promise)?e.promise().done(n.resolve).fail(n.reject).progress(n.notify):n[a+"With"](this===r?n.promise():this,s?[e]:arguments)})}),e=null}).promise()},promise:function(e){return null!=e?x.extend(e,r):r}},i={};return r.pipe=r.then,x.each(t,function(e,o){var a=o[2],s=o[3];r[o[1]]=a.add,s&&a.add(function(){n=s},t[1^e][2].disable,t[2][2].lock),i[o[0]]=function(){return i[o[0]+"With"](this===i?r:this,arguments),this},i[o[0]+"With"]=a.fireWith}),r.promise(i),e&&e.call(i,i),i},when:function(e){var t=0,n=g.call(arguments),r=n.length,i=1!==r||e&&x.isFunction(e.promise)?r:0,o=1===i?e:x.Deferred(),a=function(e,t,n){return function(r){t[e]=this,n[e]=arguments.length>1?g.call(arguments):r,n===s?o.notifyWith(t,n):--i||o.resolveWith(t,n)}},s,l,u;if(r>1)for(s=Array(r),l=Array(r),u=Array(r);r>t;t++)n[t]&&x.isFunction(n[t].promise)?n[t].promise().done(a(t,u,n)).fail(o.reject).progress(a(t,l,s)):--i;return i||o.resolveWith(u,n),o.promise()}}),x.support=function(t){var n,r,o,s,l,u,c,p,f,d=a.createElement("div");if(d.setAttribute("className","t"),d.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",n=d.getElementsByTagName("*")||[],r=d.getElementsByTagName("a")[0],!r||!r.style||!n.length)return t;s=a.createElement("select"),u=s.appendChild(a.createElement("option")),o=d.getElementsByTagName("input")[0],r.style.cssText="top:1px;float:left;opacity:.5",t.getSetAttribute="t"!==d.className,t.leadingWhitespace=3===d.firstChild.nodeType,t.tbody=!d.getElementsByTagName("tbody").length,t.htmlSerialize=!!d.getElementsByTagName("link").length,t.style=/top/.test(r.getAttribute("style")),t.hrefNormalized="/a"===r.getAttribute("href"),t.opacity=/^0.5/.test(r.style.opacity),t.cssFloat=!!r.style.cssFloat,t.checkOn=!!o.value,t.optSelected=u.selected,t.enctype=!!a.createElement("form").enctype,t.html5Clone="<:nav></:nav>"!==a.createElement("nav").cloneNode(!0).outerHTML,t.inlineBlockNeedsLayout=!1,t.shrinkWrapBlocks=!1,t.pixelPosition=!1,t.deleteExpando=!0,t.noCloneEvent=!0,t.reliableMarginRight=!0,t.boxSizingReliable=!0,o.checked=!0,t.noCloneChecked=o.cloneNode(!0).checked,s.disabled=!0,t.optDisabled=!u.disabled;try{delete d.test}catch(h){t.deleteExpando=!1}o=a.createElement("input"),o.setAttribute("value",""),t.input=""===o.getAttribute("value"),o.value="t",o.setAttribute("type","radio"),t.radioValue="t"===o.value,o.setAttribute("checked","t"),o.setAttribute("name","t"),l=a.createDocumentFragment(),l.appendChild(o),t.appendChecked=o.checked,t.checkClone=l.cloneNode(!0).cloneNode(!0).lastChild.checked,d.attachEvent&&(d.attachEvent("onclick",function(){t.noCloneEvent=!1}),d.cloneNode(!0).click());for(f in{submit:!0,change:!0,focusin:!0})d.setAttribute(c="on"+f,"t"),t[f+"Bubbles"]=c in e||d.attributes[c].expando===!1;d.style.backgroundClip="content-box",d.cloneNode(!0).style.backgroundClip="",t.clearCloneStyle="content-box"===d.style.backgroundClip;for(f in x(t))break;return t.ownLast="0"!==f,x(function(){var n,r,o,s="padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;",l=a.getElementsByTagName("body")[0];l&&(n=a.createElement("div"),n.style.cssText="border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px",l.appendChild(n).appendChild(d),d.innerHTML="<table><tr><td></td><td>t</td></tr></table>",o=d.getElementsByTagName("td"),o[0].style.cssText="padding:0;margin:0;border:0;display:none",p=0===o[0].offsetHeight,o[0].style.display="",o[1].style.display="none",t.reliableHiddenOffsets=p&&0===o[0].offsetHeight,d.innerHTML="",d.style.cssText="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;",x.swap(l,null!=l.style.zoom?{zoom:1}:{},function(){t.boxSizing=4===d.offsetWidth}),e.getComputedStyle&&(t.pixelPosition="1%"!==(e.getComputedStyle(d,null)||{}).top,t.boxSizingReliable="4px"===(e.getComputedStyle(d,null)||{width:"4px"}).width,r=d.appendChild(a.createElement("div")),r.style.cssText=d.style.cssText=s,r.style.marginRight=r.style.width="0",d.style.width="1px",t.reliableMarginRight=!parseFloat((e.getComputedStyle(r,null)||{}).marginRight)),typeof d.style.zoom!==i&&(d.innerHTML="",d.style.cssText=s+"width:1px;padding:1px;display:inline;zoom:1",t.inlineBlockNeedsLayout=3===d.offsetWidth,d.style.display="block",d.innerHTML="<div></div>",d.firstChild.style.width="5px",t.shrinkWrapBlocks=3!==d.offsetWidth,t.inlineBlockNeedsLayout&&(l.style.zoom=1)),l.removeChild(n),n=d=o=r=null)}),n=s=l=u=r=o=null,t
}({});var B=/(?:\{[\s\S]*\}|\[[\s\S]*\])$/,P=/([A-Z])/g;function R(e,n,r,i){if(x.acceptData(e)){var o,a,s=x.expando,l=e.nodeType,u=l?x.cache:e,c=l?e[s]:e[s]&&s;if(c&&u[c]&&(i||u[c].data)||r!==t||"string"!=typeof n)return c||(c=l?e[s]=p.pop()||x.guid++:s),u[c]||(u[c]=l?{}:{toJSON:x.noop}),("object"==typeof n||"function"==typeof n)&&(i?u[c]=x.extend(u[c],n):u[c].data=x.extend(u[c].data,n)),a=u[c],i||(a.data||(a.data={}),a=a.data),r!==t&&(a[x.camelCase(n)]=r),"string"==typeof n?(o=a[n],null==o&&(o=a[x.camelCase(n)])):o=a,o}}function W(e,t,n){if(x.acceptData(e)){var r,i,o=e.nodeType,a=o?x.cache:e,s=o?e[x.expando]:x.expando;if(a[s]){if(t&&(r=n?a[s]:a[s].data)){x.isArray(t)?t=t.concat(x.map(t,x.camelCase)):t in r?t=[t]:(t=x.camelCase(t),t=t in r?[t]:t.split(" ")),i=t.length;while(i--)delete r[t[i]];if(n?!I(r):!x.isEmptyObject(r))return}(n||(delete a[s].data,I(a[s])))&&(o?x.cleanData([e],!0):x.support.deleteExpando||a!=a.window?delete a[s]:a[s]=null)}}}x.extend({cache:{},noData:{applet:!0,embed:!0,object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"},hasData:function(e){return e=e.nodeType?x.cache[e[x.expando]]:e[x.expando],!!e&&!I(e)},data:function(e,t,n){return R(e,t,n)},removeData:function(e,t){return W(e,t)},_data:function(e,t,n){return R(e,t,n,!0)},_removeData:function(e,t){return W(e,t,!0)},acceptData:function(e){if(e.nodeType&&1!==e.nodeType&&9!==e.nodeType)return!1;var t=e.nodeName&&x.noData[e.nodeName.toLowerCase()];return!t||t!==!0&&e.getAttribute("classid")===t}}),x.fn.extend({data:function(e,n){var r,i,o=null,a=0,s=this[0];if(e===t){if(this.length&&(o=x.data(s),1===s.nodeType&&!x._data(s,"parsedAttrs"))){for(r=s.attributes;r.length>a;a++)i=r[a].name,0===i.indexOf("data-")&&(i=x.camelCase(i.slice(5)),$(s,i,o[i]));x._data(s,"parsedAttrs",!0)}return o}return"object"==typeof e?this.each(function(){x.data(this,e)}):arguments.length>1?this.each(function(){x.data(this,e,n)}):s?$(s,e,x.data(s,e)):null},removeData:function(e){return this.each(function(){x.removeData(this,e)})}});function $(e,n,r){if(r===t&&1===e.nodeType){var i="data-"+n.replace(P,"-$1").toLowerCase();if(r=e.getAttribute(i),"string"==typeof r){try{r="true"===r?!0:"false"===r?!1:"null"===r?null:+r+""===r?+r:B.test(r)?x.parseJSON(r):r}catch(o){}x.data(e,n,r)}else r=t}return r}function I(e){var t;for(t in e)if(("data"!==t||!x.isEmptyObject(e[t]))&&"toJSON"!==t)return!1;return!0}x.extend({queue:function(e,n,r){var i;return e?(n=(n||"fx")+"queue",i=x._data(e,n),r&&(!i||x.isArray(r)?i=x._data(e,n,x.makeArray(r)):i.push(r)),i||[]):t},dequeue:function(e,t){t=t||"fx";var n=x.queue(e,t),r=n.length,i=n.shift(),o=x._queueHooks(e,t),a=function(){x.dequeue(e,t)};"inprogress"===i&&(i=n.shift(),r--),i&&("fx"===t&&n.unshift("inprogress"),delete o.stop,i.call(e,a,o)),!r&&o&&o.empty.fire()},_queueHooks:function(e,t){var n=t+"queueHooks";return x._data(e,n)||x._data(e,n,{empty:x.Callbacks("once memory").add(function(){x._removeData(e,t+"queue"),x._removeData(e,n)})})}}),x.fn.extend({queue:function(e,n){var r=2;return"string"!=typeof e&&(n=e,e="fx",r--),r>arguments.length?x.queue(this[0],e):n===t?this:this.each(function(){var t=x.queue(this,e,n);x._queueHooks(this,e),"fx"===e&&"inprogress"!==t[0]&&x.dequeue(this,e)})},dequeue:function(e){return this.each(function(){x.dequeue(this,e)})},delay:function(e,t){return e=x.fx?x.fx.speeds[e]||e:e,t=t||"fx",this.queue(t,function(t,n){var r=setTimeout(t,e);n.stop=function(){clearTimeout(r)}})},clearQueue:function(e){return this.queue(e||"fx",[])},promise:function(e,n){var r,i=1,o=x.Deferred(),a=this,s=this.length,l=function(){--i||o.resolveWith(a,[a])};"string"!=typeof e&&(n=e,e=t),e=e||"fx";while(s--)r=x._data(a[s],e+"queueHooks"),r&&r.empty&&(i++,r.empty.add(l));return l(),o.promise(n)}});var z,X,U=/[\t\r\n\f]/g,V=/\r/g,Y=/^(?:input|select|textarea|button|object)$/i,J=/^(?:a|area)$/i,G=/^(?:checked|selected)$/i,Q=x.support.getSetAttribute,K=x.support.input;x.fn.extend({attr:function(e,t){return x.access(this,x.attr,e,t,arguments.length>1)},removeAttr:function(e){return this.each(function(){x.removeAttr(this,e)})},prop:function(e,t){return x.access(this,x.prop,e,t,arguments.length>1)},removeProp:function(e){return e=x.propFix[e]||e,this.each(function(){try{this[e]=t,delete this[e]}catch(n){}})},addClass:function(e){var t,n,r,i,o,a=0,s=this.length,l="string"==typeof e&&e;if(x.isFunction(e))return this.each(function(t){x(this).addClass(e.call(this,t,this.className))});if(l)for(t=(e||"").match(T)||[];s>a;a++)if(n=this[a],r=1===n.nodeType&&(n.className?(" "+n.className+" ").replace(U," "):" ")){o=0;while(i=t[o++])0>r.indexOf(" "+i+" ")&&(r+=i+" ");n.className=x.trim(r)}return this},removeClass:function(e){var t,n,r,i,o,a=0,s=this.length,l=0===arguments.length||"string"==typeof e&&e;if(x.isFunction(e))return this.each(function(t){x(this).removeClass(e.call(this,t,this.className))});if(l)for(t=(e||"").match(T)||[];s>a;a++)if(n=this[a],r=1===n.nodeType&&(n.className?(" "+n.className+" ").replace(U," "):"")){o=0;while(i=t[o++])while(r.indexOf(" "+i+" ")>=0)r=r.replace(" "+i+" "," ");n.className=e?x.trim(r):""}return this},toggleClass:function(e,t){var n=typeof e;return"boolean"==typeof t&&"string"===n?t?this.addClass(e):this.removeClass(e):x.isFunction(e)?this.each(function(n){x(this).toggleClass(e.call(this,n,this.className,t),t)}):this.each(function(){if("string"===n){var t,r=0,o=x(this),a=e.match(T)||[];while(t=a[r++])o.hasClass(t)?o.removeClass(t):o.addClass(t)}else(n===i||"boolean"===n)&&(this.className&&x._data(this,"__className__",this.className),this.className=this.className||e===!1?"":x._data(this,"__className__")||"")})},hasClass:function(e){var t=" "+e+" ",n=0,r=this.length;for(;r>n;n++)if(1===this[n].nodeType&&(" "+this[n].className+" ").replace(U," ").indexOf(t)>=0)return!0;return!1},val:function(e){var n,r,i,o=this[0];{if(arguments.length)return i=x.isFunction(e),this.each(function(n){var o;1===this.nodeType&&(o=i?e.call(this,n,x(this).val()):e,null==o?o="":"number"==typeof o?o+="":x.isArray(o)&&(o=x.map(o,function(e){return null==e?"":e+""})),r=x.valHooks[this.type]||x.valHooks[this.nodeName.toLowerCase()],r&&"set"in r&&r.set(this,o,"value")!==t||(this.value=o))});if(o)return r=x.valHooks[o.type]||x.valHooks[o.nodeName.toLowerCase()],r&&"get"in r&&(n=r.get(o,"value"))!==t?n:(n=o.value,"string"==typeof n?n.replace(V,""):null==n?"":n)}}}),x.extend({valHooks:{option:{get:function(e){var t=x.find.attr(e,"value");return null!=t?t:e.text}},select:{get:function(e){var t,n,r=e.options,i=e.selectedIndex,o="select-one"===e.type||0>i,a=o?null:[],s=o?i+1:r.length,l=0>i?s:o?i:0;for(;s>l;l++)if(n=r[l],!(!n.selected&&l!==i||(x.support.optDisabled?n.disabled:null!==n.getAttribute("disabled"))||n.parentNode.disabled&&x.nodeName(n.parentNode,"optgroup"))){if(t=x(n).val(),o)return t;a.push(t)}return a},set:function(e,t){var n,r,i=e.options,o=x.makeArray(t),a=i.length;while(a--)r=i[a],(r.selected=x.inArray(x(r).val(),o)>=0)&&(n=!0);return n||(e.selectedIndex=-1),o}}},attr:function(e,n,r){var o,a,s=e.nodeType;if(e&&3!==s&&8!==s&&2!==s)return typeof e.getAttribute===i?x.prop(e,n,r):(1===s&&x.isXMLDoc(e)||(n=n.toLowerCase(),o=x.attrHooks[n]||(x.expr.match.bool.test(n)?X:z)),r===t?o&&"get"in o&&null!==(a=o.get(e,n))?a:(a=x.find.attr(e,n),null==a?t:a):null!==r?o&&"set"in o&&(a=o.set(e,r,n))!==t?a:(e.setAttribute(n,r+""),r):(x.removeAttr(e,n),t))},removeAttr:function(e,t){var n,r,i=0,o=t&&t.match(T);if(o&&1===e.nodeType)while(n=o[i++])r=x.propFix[n]||n,x.expr.match.bool.test(n)?K&&Q||!G.test(n)?e[r]=!1:e[x.camelCase("default-"+n)]=e[r]=!1:x.attr(e,n,""),e.removeAttribute(Q?n:r)},attrHooks:{type:{set:function(e,t){if(!x.support.radioValue&&"radio"===t&&x.nodeName(e,"input")){var n=e.value;return e.setAttribute("type",t),n&&(e.value=n),t}}}},propFix:{"for":"htmlFor","class":"className"},prop:function(e,n,r){var i,o,a,s=e.nodeType;if(e&&3!==s&&8!==s&&2!==s)return a=1!==s||!x.isXMLDoc(e),a&&(n=x.propFix[n]||n,o=x.propHooks[n]),r!==t?o&&"set"in o&&(i=o.set(e,r,n))!==t?i:e[n]=r:o&&"get"in o&&null!==(i=o.get(e,n))?i:e[n]},propHooks:{tabIndex:{get:function(e){var t=x.find.attr(e,"tabindex");return t?parseInt(t,10):Y.test(e.nodeName)||J.test(e.nodeName)&&e.href?0:-1}}}}),X={set:function(e,t,n){return t===!1?x.removeAttr(e,n):K&&Q||!G.test(n)?e.setAttribute(!Q&&x.propFix[n]||n,n):e[x.camelCase("default-"+n)]=e[n]=!0,n}},x.each(x.expr.match.bool.source.match(/\w+/g),function(e,n){var r=x.expr.attrHandle[n]||x.find.attr;x.expr.attrHandle[n]=K&&Q||!G.test(n)?function(e,n,i){var o=x.expr.attrHandle[n],a=i?t:(x.expr.attrHandle[n]=t)!=r(e,n,i)?n.toLowerCase():null;return x.expr.attrHandle[n]=o,a}:function(e,n,r){return r?t:e[x.camelCase("default-"+n)]?n.toLowerCase():null}}),K&&Q||(x.attrHooks.value={set:function(e,n,r){return x.nodeName(e,"input")?(e.defaultValue=n,t):z&&z.set(e,n,r)}}),Q||(z={set:function(e,n,r){var i=e.getAttributeNode(r);return i||e.setAttributeNode(i=e.ownerDocument.createAttribute(r)),i.value=n+="","value"===r||n===e.getAttribute(r)?n:t}},x.expr.attrHandle.id=x.expr.attrHandle.name=x.expr.attrHandle.coords=function(e,n,r){var i;return r?t:(i=e.getAttributeNode(n))&&""!==i.value?i.value:null},x.valHooks.button={get:function(e,n){var r=e.getAttributeNode(n);return r&&r.specified?r.value:t},set:z.set},x.attrHooks.contenteditable={set:function(e,t,n){z.set(e,""===t?!1:t,n)}},x.each(["width","height"],function(e,n){x.attrHooks[n]={set:function(e,r){return""===r?(e.setAttribute(n,"auto"),r):t}}})),x.support.hrefNormalized||x.each(["href","src"],function(e,t){x.propHooks[t]={get:function(e){return e.getAttribute(t,4)}}}),x.support.style||(x.attrHooks.style={get:function(e){return e.style.cssText||t},set:function(e,t){return e.style.cssText=t+""}}),x.support.optSelected||(x.propHooks.selected={get:function(e){var t=e.parentNode;return t&&(t.selectedIndex,t.parentNode&&t.parentNode.selectedIndex),null}}),x.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){x.propFix[this.toLowerCase()]=this}),x.support.enctype||(x.propFix.enctype="encoding"),x.each(["radio","checkbox"],function(){x.valHooks[this]={set:function(e,n){return x.isArray(n)?e.checked=x.inArray(x(e).val(),n)>=0:t}},x.support.checkOn||(x.valHooks[this].get=function(e){return null===e.getAttribute("value")?"on":e.value})});var Z=/^(?:input|select|textarea)$/i,et=/^key/,tt=/^(?:mouse|contextmenu)|click/,nt=/^(?:focusinfocus|focusoutblur)$/,rt=/^([^.]*)(?:\.(.+)|)$/;function it(){return!0}function ot(){return!1}function at(){try{return a.activeElement}catch(e){}}x.event={global:{},add:function(e,n,r,o,a){var s,l,u,c,p,f,d,h,g,m,y,v=x._data(e);if(v){r.handler&&(c=r,r=c.handler,a=c.selector),r.guid||(r.guid=x.guid++),(l=v.events)||(l=v.events={}),(f=v.handle)||(f=v.handle=function(e){return typeof x===i||e&&x.event.triggered===e.type?t:x.event.dispatch.apply(f.elem,arguments)},f.elem=e),n=(n||"").match(T)||[""],u=n.length;while(u--)s=rt.exec(n[u])||[],g=y=s[1],m=(s[2]||"").split(".").sort(),g&&(p=x.event.special[g]||{},g=(a?p.delegateType:p.bindType)||g,p=x.event.special[g]||{},d=x.extend({type:g,origType:y,data:o,handler:r,guid:r.guid,selector:a,needsContext:a&&x.expr.match.needsContext.test(a),namespace:m.join(".")},c),(h=l[g])||(h=l[g]=[],h.delegateCount=0,p.setup&&p.setup.call(e,o,m,f)!==!1||(e.addEventListener?e.addEventListener(g,f,!1):e.attachEvent&&e.attachEvent("on"+g,f))),p.add&&(p.add.call(e,d),d.handler.guid||(d.handler.guid=r.guid)),a?h.splice(h.delegateCount++,0,d):h.push(d),x.event.global[g]=!0);e=null}},remove:function(e,t,n,r,i){var o,a,s,l,u,c,p,f,d,h,g,m=x.hasData(e)&&x._data(e);if(m&&(c=m.events)){t=(t||"").match(T)||[""],u=t.length;while(u--)if(s=rt.exec(t[u])||[],d=g=s[1],h=(s[2]||"").split(".").sort(),d){p=x.event.special[d]||{},d=(r?p.delegateType:p.bindType)||d,f=c[d]||[],s=s[2]&&RegExp("(^|\\.)"+h.join("\\.(?:.*\\.|)")+"(\\.|$)"),l=o=f.length;while(o--)a=f[o],!i&&g!==a.origType||n&&n.guid!==a.guid||s&&!s.test(a.namespace)||r&&r!==a.selector&&("**"!==r||!a.selector)||(f.splice(o,1),a.selector&&f.delegateCount--,p.remove&&p.remove.call(e,a));l&&!f.length&&(p.teardown&&p.teardown.call(e,h,m.handle)!==!1||x.removeEvent(e,d,m.handle),delete c[d])}else for(d in c)x.event.remove(e,d+t[u],n,r,!0);x.isEmptyObject(c)&&(delete m.handle,x._removeData(e,"events"))}},trigger:function(n,r,i,o){var s,l,u,c,p,f,d,h=[i||a],g=v.call(n,"type")?n.type:n,m=v.call(n,"namespace")?n.namespace.split("."):[];if(u=f=i=i||a,3!==i.nodeType&&8!==i.nodeType&&!nt.test(g+x.event.triggered)&&(g.indexOf(".")>=0&&(m=g.split("."),g=m.shift(),m.sort()),l=0>g.indexOf(":")&&"on"+g,n=n[x.expando]?n:new x.Event(g,"object"==typeof n&&n),n.isTrigger=o?2:3,n.namespace=m.join("."),n.namespace_re=n.namespace?RegExp("(^|\\.)"+m.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,n.result=t,n.target||(n.target=i),r=null==r?[n]:x.makeArray(r,[n]),p=x.event.special[g]||{},o||!p.trigger||p.trigger.apply(i,r)!==!1)){if(!o&&!p.noBubble&&!x.isWindow(i)){for(c=p.delegateType||g,nt.test(c+g)||(u=u.parentNode);u;u=u.parentNode)h.push(u),f=u;f===(i.ownerDocument||a)&&h.push(f.defaultView||f.parentWindow||e)}d=0;while((u=h[d++])&&!n.isPropagationStopped())n.type=d>1?c:p.bindType||g,s=(x._data(u,"events")||{})[n.type]&&x._data(u,"handle"),s&&s.apply(u,r),s=l&&u[l],s&&x.acceptData(u)&&s.apply&&s.apply(u,r)===!1&&n.preventDefault();if(n.type=g,!o&&!n.isDefaultPrevented()&&(!p._default||p._default.apply(h.pop(),r)===!1)&&x.acceptData(i)&&l&&i[g]&&!x.isWindow(i)){f=i[l],f&&(i[l]=null),x.event.triggered=g;try{i[g]()}catch(y){}x.event.triggered=t,f&&(i[l]=f)}return n.result}},dispatch:function(e){e=x.event.fix(e);var n,r,i,o,a,s=[],l=g.call(arguments),u=(x._data(this,"events")||{})[e.type]||[],c=x.event.special[e.type]||{};if(l[0]=e,e.delegateTarget=this,!c.preDispatch||c.preDispatch.call(this,e)!==!1){s=x.event.handlers.call(this,e,u),n=0;while((o=s[n++])&&!e.isPropagationStopped()){e.currentTarget=o.elem,a=0;while((i=o.handlers[a++])&&!e.isImmediatePropagationStopped())(!e.namespace_re||e.namespace_re.test(i.namespace))&&(e.handleObj=i,e.data=i.data,r=((x.event.special[i.origType]||{}).handle||i.handler).apply(o.elem,l),r!==t&&(e.result=r)===!1&&(e.preventDefault(),e.stopPropagation()))}return c.postDispatch&&c.postDispatch.call(this,e),e.result}},handlers:function(e,n){var r,i,o,a,s=[],l=n.delegateCount,u=e.target;if(l&&u.nodeType&&(!e.button||"click"!==e.type))for(;u!=this;u=u.parentNode||this)if(1===u.nodeType&&(u.disabled!==!0||"click"!==e.type)){for(o=[],a=0;l>a;a++)i=n[a],r=i.selector+" ",o[r]===t&&(o[r]=i.needsContext?x(r,this).index(u)>=0:x.find(r,this,null,[u]).length),o[r]&&o.push(i);o.length&&s.push({elem:u,handlers:o})}return n.length>l&&s.push({elem:this,handlers:n.slice(l)}),s},fix:function(e){if(e[x.expando])return e;var t,n,r,i=e.type,o=e,s=this.fixHooks[i];s||(this.fixHooks[i]=s=tt.test(i)?this.mouseHooks:et.test(i)?this.keyHooks:{}),r=s.props?this.props.concat(s.props):this.props,e=new x.Event(o),t=r.length;while(t--)n=r[t],e[n]=o[n];return e.target||(e.target=o.srcElement||a),3===e.target.nodeType&&(e.target=e.target.parentNode),e.metaKey=!!e.metaKey,s.filter?s.filter(e,o):e},props:"altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(e,t){return null==e.which&&(e.which=null!=t.charCode?t.charCode:t.keyCode),e}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(e,n){var r,i,o,s=n.button,l=n.fromElement;return null==e.pageX&&null!=n.clientX&&(i=e.target.ownerDocument||a,o=i.documentElement,r=i.body,e.pageX=n.clientX+(o&&o.scrollLeft||r&&r.scrollLeft||0)-(o&&o.clientLeft||r&&r.clientLeft||0),e.pageY=n.clientY+(o&&o.scrollTop||r&&r.scrollTop||0)-(o&&o.clientTop||r&&r.clientTop||0)),!e.relatedTarget&&l&&(e.relatedTarget=l===e.target?n.toElement:l),e.which||s===t||(e.which=1&s?1:2&s?3:4&s?2:0),e}},special:{load:{noBubble:!0},focus:{trigger:function(){if(this!==at()&&this.focus)try{return this.focus(),!1}catch(e){}},delegateType:"focusin"},blur:{trigger:function(){return this===at()&&this.blur?(this.blur(),!1):t},delegateType:"focusout"},click:{trigger:function(){return x.nodeName(this,"input")&&"checkbox"===this.type&&this.click?(this.click(),!1):t},_default:function(e){return x.nodeName(e.target,"a")}},beforeunload:{postDispatch:function(e){e.result!==t&&(e.originalEvent.returnValue=e.result)}}},simulate:function(e,t,n,r){var i=x.extend(new x.Event,n,{type:e,isSimulated:!0,originalEvent:{}});r?x.event.trigger(i,null,t):x.event.dispatch.call(t,i),i.isDefaultPrevented()&&n.preventDefault()}},x.removeEvent=a.removeEventListener?function(e,t,n){e.removeEventListener&&e.removeEventListener(t,n,!1)}:function(e,t,n){var r="on"+t;e.detachEvent&&(typeof e[r]===i&&(e[r]=null),e.detachEvent(r,n))},x.Event=function(e,n){return this instanceof x.Event?(e&&e.type?(this.originalEvent=e,this.type=e.type,this.isDefaultPrevented=e.defaultPrevented||e.returnValue===!1||e.getPreventDefault&&e.getPreventDefault()?it:ot):this.type=e,n&&x.extend(this,n),this.timeStamp=e&&e.timeStamp||x.now(),this[x.expando]=!0,t):new x.Event(e,n)},x.Event.prototype={isDefaultPrevented:ot,isPropagationStopped:ot,isImmediatePropagationStopped:ot,preventDefault:function(){var e=this.originalEvent;this.isDefaultPrevented=it,e&&(e.preventDefault?e.preventDefault():e.returnValue=!1)},stopPropagation:function(){var e=this.originalEvent;this.isPropagationStopped=it,e&&(e.stopPropagation&&e.stopPropagation(),e.cancelBubble=!0)},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=it,this.stopPropagation()}},x.each({mouseenter:"mouseover",mouseleave:"mouseout"},function(e,t){x.event.special[e]={delegateType:t,bindType:t,handle:function(e){var n,r=this,i=e.relatedTarget,o=e.handleObj;return(!i||i!==r&&!x.contains(r,i))&&(e.type=o.origType,n=o.handler.apply(this,arguments),e.type=t),n}}}),x.support.submitBubbles||(x.event.special.submit={setup:function(){return x.nodeName(this,"form")?!1:(x.event.add(this,"click._submit keypress._submit",function(e){var n=e.target,r=x.nodeName(n,"input")||x.nodeName(n,"button")?n.form:t;r&&!x._data(r,"submitBubbles")&&(x.event.add(r,"submit._submit",function(e){e._submit_bubble=!0}),x._data(r,"submitBubbles",!0))}),t)},postDispatch:function(e){e._submit_bubble&&(delete e._submit_bubble,this.parentNode&&!e.isTrigger&&x.event.simulate("submit",this.parentNode,e,!0))},teardown:function(){return x.nodeName(this,"form")?!1:(x.event.remove(this,"._submit"),t)}}),x.support.changeBubbles||(x.event.special.change={setup:function(){return Z.test(this.nodeName)?(("checkbox"===this.type||"radio"===this.type)&&(x.event.add(this,"propertychange._change",function(e){"checked"===e.originalEvent.propertyName&&(this._just_changed=!0)}),x.event.add(this,"click._change",function(e){this._just_changed&&!e.isTrigger&&(this._just_changed=!1),x.event.simulate("change",this,e,!0)})),!1):(x.event.add(this,"beforeactivate._change",function(e){var t=e.target;Z.test(t.nodeName)&&!x._data(t,"changeBubbles")&&(x.event.add(t,"change._change",function(e){!this.parentNode||e.isSimulated||e.isTrigger||x.event.simulate("change",this.parentNode,e,!0)}),x._data(t,"changeBubbles",!0))}),t)},handle:function(e){var n=e.target;return this!==n||e.isSimulated||e.isTrigger||"radio"!==n.type&&"checkbox"!==n.type?e.handleObj.handler.apply(this,arguments):t},teardown:function(){return x.event.remove(this,"._change"),!Z.test(this.nodeName)}}),x.support.focusinBubbles||x.each({focus:"focusin",blur:"focusout"},function(e,t){var n=0,r=function(e){x.event.simulate(t,e.target,x.event.fix(e),!0)};x.event.special[t]={setup:function(){0===n++&&a.addEventListener(e,r,!0)},teardown:function(){0===--n&&a.removeEventListener(e,r,!0)}}}),x.fn.extend({on:function(e,n,r,i,o){var a,s;if("object"==typeof e){"string"!=typeof n&&(r=r||n,n=t);for(a in e)this.on(a,n,r,e[a],o);return this}if(null==r&&null==i?(i=n,r=n=t):null==i&&("string"==typeof n?(i=r,r=t):(i=r,r=n,n=t)),i===!1)i=ot;else if(!i)return this;return 1===o&&(s=i,i=function(e){return x().off(e),s.apply(this,arguments)},i.guid=s.guid||(s.guid=x.guid++)),this.each(function(){x.event.add(this,e,i,r,n)})},one:function(e,t,n,r){return this.on(e,t,n,r,1)},off:function(e,n,r){var i,o;if(e&&e.preventDefault&&e.handleObj)return i=e.handleObj,x(e.delegateTarget).off(i.namespace?i.origType+"."+i.namespace:i.origType,i.selector,i.handler),this;if("object"==typeof e){for(o in e)this.off(o,n,e[o]);return this}return(n===!1||"function"==typeof n)&&(r=n,n=t),r===!1&&(r=ot),this.each(function(){x.event.remove(this,e,r,n)})},trigger:function(e,t){return this.each(function(){x.event.trigger(e,t,this)})},triggerHandler:function(e,n){var r=this[0];return r?x.event.trigger(e,n,r,!0):t}});var st=/^.[^:#\[\.,]*$/,lt=/^(?:parents|prev(?:Until|All))/,ut=x.expr.match.needsContext,ct={children:!0,contents:!0,next:!0,prev:!0};x.fn.extend({find:function(e){var t,n=[],r=this,i=r.length;if("string"!=typeof e)return this.pushStack(x(e).filter(function(){for(t=0;i>t;t++)if(x.contains(r[t],this))return!0}));for(t=0;i>t;t++)x.find(e,r[t],n);return n=this.pushStack(i>1?x.unique(n):n),n.selector=this.selector?this.selector+" "+e:e,n},has:function(e){var t,n=x(e,this),r=n.length;return this.filter(function(){for(t=0;r>t;t++)if(x.contains(this,n[t]))return!0})},not:function(e){return this.pushStack(ft(this,e||[],!0))},filter:function(e){return this.pushStack(ft(this,e||[],!1))},is:function(e){return!!ft(this,"string"==typeof e&&ut.test(e)?x(e):e||[],!1).length},closest:function(e,t){var n,r=0,i=this.length,o=[],a=ut.test(e)||"string"!=typeof e?x(e,t||this.context):0;for(;i>r;r++)for(n=this[r];n&&n!==t;n=n.parentNode)if(11>n.nodeType&&(a?a.index(n)>-1:1===n.nodeType&&x.find.matchesSelector(n,e))){n=o.push(n);break}return this.pushStack(o.length>1?x.unique(o):o)},index:function(e){return e?"string"==typeof e?x.inArray(this[0],x(e)):x.inArray(e.jquery?e[0]:e,this):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(e,t){var n="string"==typeof e?x(e,t):x.makeArray(e&&e.nodeType?[e]:e),r=x.merge(this.get(),n);return this.pushStack(x.unique(r))},addBack:function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}});function pt(e,t){do e=e[t];while(e&&1!==e.nodeType);return e}x.each({parent:function(e){var t=e.parentNode;return t&&11!==t.nodeType?t:null},parents:function(e){return x.dir(e,"parentNode")},parentsUntil:function(e,t,n){return x.dir(e,"parentNode",n)},next:function(e){return pt(e,"nextSibling")},prev:function(e){return pt(e,"previousSibling")},nextAll:function(e){return x.dir(e,"nextSibling")},prevAll:function(e){return x.dir(e,"previousSibling")},nextUntil:function(e,t,n){return x.dir(e,"nextSibling",n)},prevUntil:function(e,t,n){return x.dir(e,"previousSibling",n)},siblings:function(e){return x.sibling((e.parentNode||{}).firstChild,e)},children:function(e){return x.sibling(e.firstChild)},contents:function(e){return x.nodeName(e,"iframe")?e.contentDocument||e.contentWindow.document:x.merge([],e.childNodes)}},function(e,t){x.fn[e]=function(n,r){var i=x.map(this,t,n);return"Until"!==e.slice(-5)&&(r=n),r&&"string"==typeof r&&(i=x.filter(r,i)),this.length>1&&(ct[e]||(i=x.unique(i)),lt.test(e)&&(i=i.reverse())),this.pushStack(i)}}),x.extend({filter:function(e,t,n){var r=t[0];return n&&(e=":not("+e+")"),1===t.length&&1===r.nodeType?x.find.matchesSelector(r,e)?[r]:[]:x.find.matches(e,x.grep(t,function(e){return 1===e.nodeType}))},dir:function(e,n,r){var i=[],o=e[n];while(o&&9!==o.nodeType&&(r===t||1!==o.nodeType||!x(o).is(r)))1===o.nodeType&&i.push(o),o=o[n];return i},sibling:function(e,t){var n=[];for(;e;e=e.nextSibling)1===e.nodeType&&e!==t&&n.push(e);return n}});function ft(e,t,n){if(x.isFunction(t))return x.grep(e,function(e,r){return!!t.call(e,r,e)!==n});if(t.nodeType)return x.grep(e,function(e){return e===t!==n});if("string"==typeof t){if(st.test(t))return x.filter(t,e,n);t=x.filter(t,e)}return x.grep(e,function(e){return x.inArray(e,t)>=0!==n})}function dt(e){var t=ht.split("|"),n=e.createDocumentFragment();if(n.createElement)while(t.length)n.createElement(t.pop());return n}var ht="abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",gt=/ jQuery\d+="(?:null|\d+)"/g,mt=RegExp("<(?:"+ht+")[\\s/>]","i"),yt=/^\s+/,vt=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,bt=/<([\w:]+)/,xt=/<tbody/i,wt=/<|&#?\w+;/,Tt=/<(?:script|style|link)/i,Ct=/^(?:checkbox|radio)$/i,Nt=/checked\s*(?:[^=]|=\s*.checked.)/i,kt=/^$|\/(?:java|ecma)script/i,Et=/^true\/(.*)/,St=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,At={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],area:[1,"<map>","</map>"],param:[1,"<object>","</object>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:x.support.htmlSerialize?[0,"",""]:[1,"X<div>","</div>"]},jt=dt(a),Dt=jt.appendChild(a.createElement("div"));At.optgroup=At.option,At.tbody=At.tfoot=At.colgroup=At.caption=At.thead,At.th=At.td,x.fn.extend({text:function(e){return x.access(this,function(e){return e===t?x.text(this):this.empty().append((this[0]&&this[0].ownerDocument||a).createTextNode(e))},null,e,arguments.length)},append:function(){return this.domManip(arguments,function(e){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var t=Lt(this,e);t.appendChild(e)}})},prepend:function(){return this.domManip(arguments,function(e){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var t=Lt(this,e);t.insertBefore(e,t.firstChild)}})},before:function(){return this.domManip(arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this)})},after:function(){return this.domManip(arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this.nextSibling)})},remove:function(e,t){var n,r=e?x.filter(e,this):this,i=0;for(;null!=(n=r[i]);i++)t||1!==n.nodeType||x.cleanData(Ft(n)),n.parentNode&&(t&&x.contains(n.ownerDocument,n)&&_t(Ft(n,"script")),n.parentNode.removeChild(n));return this},empty:function(){var e,t=0;for(;null!=(e=this[t]);t++){1===e.nodeType&&x.cleanData(Ft(e,!1));while(e.firstChild)e.removeChild(e.firstChild);e.options&&x.nodeName(e,"select")&&(e.options.length=0)}return this},clone:function(e,t){return e=null==e?!1:e,t=null==t?e:t,this.map(function(){return x.clone(this,e,t)})},html:function(e){return x.access(this,function(e){var n=this[0]||{},r=0,i=this.length;if(e===t)return 1===n.nodeType?n.innerHTML.replace(gt,""):t;if(!("string"!=typeof e||Tt.test(e)||!x.support.htmlSerialize&&mt.test(e)||!x.support.leadingWhitespace&&yt.test(e)||At[(bt.exec(e)||["",""])[1].toLowerCase()])){e=e.replace(vt,"<$1></$2>");try{for(;i>r;r++)n=this[r]||{},1===n.nodeType&&(x.cleanData(Ft(n,!1)),n.innerHTML=e);n=0}catch(o){}}n&&this.empty().append(e)},null,e,arguments.length)},replaceWith:function(){var e=x.map(this,function(e){return[e.nextSibling,e.parentNode]}),t=0;return this.domManip(arguments,function(n){var r=e[t++],i=e[t++];i&&(r&&r.parentNode!==i&&(r=this.nextSibling),x(this).remove(),i.insertBefore(n,r))},!0),t?this:this.remove()},detach:function(e){return this.remove(e,!0)},domManip:function(e,t,n){e=d.apply([],e);var r,i,o,a,s,l,u=0,c=this.length,p=this,f=c-1,h=e[0],g=x.isFunction(h);if(g||!(1>=c||"string"!=typeof h||x.support.checkClone)&&Nt.test(h))return this.each(function(r){var i=p.eq(r);g&&(e[0]=h.call(this,r,i.html())),i.domManip(e,t,n)});if(c&&(l=x.buildFragment(e,this[0].ownerDocument,!1,!n&&this),r=l.firstChild,1===l.childNodes.length&&(l=r),r)){for(a=x.map(Ft(l,"script"),Ht),o=a.length;c>u;u++)i=l,u!==f&&(i=x.clone(i,!0,!0),o&&x.merge(a,Ft(i,"script"))),t.call(this[u],i,u);if(o)for(s=a[a.length-1].ownerDocument,x.map(a,qt),u=0;o>u;u++)i=a[u],kt.test(i.type||"")&&!x._data(i,"globalEval")&&x.contains(s,i)&&(i.src?x._evalUrl(i.src):x.globalEval((i.text||i.textContent||i.innerHTML||"").replace(St,"")));l=r=null}return this}});function Lt(e,t){return x.nodeName(e,"table")&&x.nodeName(1===t.nodeType?t:t.firstChild,"tr")?e.getElementsByTagName("tbody")[0]||e.appendChild(e.ownerDocument.createElement("tbody")):e}function Ht(e){return e.type=(null!==x.find.attr(e,"type"))+"/"+e.type,e}function qt(e){var t=Et.exec(e.type);return t?e.type=t[1]:e.removeAttribute("type"),e}function _t(e,t){var n,r=0;for(;null!=(n=e[r]);r++)x._data(n,"globalEval",!t||x._data(t[r],"globalEval"))}function Mt(e,t){if(1===t.nodeType&&x.hasData(e)){var n,r,i,o=x._data(e),a=x._data(t,o),s=o.events;if(s){delete a.handle,a.events={};for(n in s)for(r=0,i=s[n].length;i>r;r++)x.event.add(t,n,s[n][r])}a.data&&(a.data=x.extend({},a.data))}}function Ot(e,t){var n,r,i;if(1===t.nodeType){if(n=t.nodeName.toLowerCase(),!x.support.noCloneEvent&&t[x.expando]){i=x._data(t);for(r in i.events)x.removeEvent(t,r,i.handle);t.removeAttribute(x.expando)}"script"===n&&t.text!==e.text?(Ht(t).text=e.text,qt(t)):"object"===n?(t.parentNode&&(t.outerHTML=e.outerHTML),x.support.html5Clone&&e.innerHTML&&!x.trim(t.innerHTML)&&(t.innerHTML=e.innerHTML)):"input"===n&&Ct.test(e.type)?(t.defaultChecked=t.checked=e.checked,t.value!==e.value&&(t.value=e.value)):"option"===n?t.defaultSelected=t.selected=e.defaultSelected:("input"===n||"textarea"===n)&&(t.defaultValue=e.defaultValue)}}x.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(e,t){x.fn[e]=function(e){var n,r=0,i=[],o=x(e),a=o.length-1;for(;a>=r;r++)n=r===a?this:this.clone(!0),x(o[r])[t](n),h.apply(i,n.get());return this.pushStack(i)}});function Ft(e,n){var r,o,a=0,s=typeof e.getElementsByTagName!==i?e.getElementsByTagName(n||"*"):typeof e.querySelectorAll!==i?e.querySelectorAll(n||"*"):t;if(!s)for(s=[],r=e.childNodes||e;null!=(o=r[a]);a++)!n||x.nodeName(o,n)?s.push(o):x.merge(s,Ft(o,n));return n===t||n&&x.nodeName(e,n)?x.merge([e],s):s}function Bt(e){Ct.test(e.type)&&(e.defaultChecked=e.checked)}x.extend({clone:function(e,t,n){var r,i,o,a,s,l=x.contains(e.ownerDocument,e);if(x.support.html5Clone||x.isXMLDoc(e)||!mt.test("<"+e.nodeName+">")?o=e.cloneNode(!0):(Dt.innerHTML=e.outerHTML,Dt.removeChild(o=Dt.firstChild)),!(x.support.noCloneEvent&&x.support.noCloneChecked||1!==e.nodeType&&11!==e.nodeType||x.isXMLDoc(e)))for(r=Ft(o),s=Ft(e),a=0;null!=(i=s[a]);++a)r[a]&&Ot(i,r[a]);if(t)if(n)for(s=s||Ft(e),r=r||Ft(o),a=0;null!=(i=s[a]);a++)Mt(i,r[a]);else Mt(e,o);return r=Ft(o,"script"),r.length>0&&_t(r,!l&&Ft(e,"script")),r=s=i=null,o},buildFragment:function(e,t,n,r){var i,o,a,s,l,u,c,p=e.length,f=dt(t),d=[],h=0;for(;p>h;h++)if(o=e[h],o||0===o)if("object"===x.type(o))x.merge(d,o.nodeType?[o]:o);else if(wt.test(o)){s=s||f.appendChild(t.createElement("div")),l=(bt.exec(o)||["",""])[1].toLowerCase(),c=At[l]||At._default,s.innerHTML=c[1]+o.replace(vt,"<$1></$2>")+c[2],i=c[0];while(i--)s=s.lastChild;if(!x.support.leadingWhitespace&&yt.test(o)&&d.push(t.createTextNode(yt.exec(o)[0])),!x.support.tbody){o="table"!==l||xt.test(o)?"<table>"!==c[1]||xt.test(o)?0:s:s.firstChild,i=o&&o.childNodes.length;while(i--)x.nodeName(u=o.childNodes[i],"tbody")&&!u.childNodes.length&&o.removeChild(u)}x.merge(d,s.childNodes),s.textContent="";while(s.firstChild)s.removeChild(s.firstChild);s=f.lastChild}else d.push(t.createTextNode(o));s&&f.removeChild(s),x.support.appendChecked||x.grep(Ft(d,"input"),Bt),h=0;while(o=d[h++])if((!r||-1===x.inArray(o,r))&&(a=x.contains(o.ownerDocument,o),s=Ft(f.appendChild(o),"script"),a&&_t(s),n)){i=0;while(o=s[i++])kt.test(o.type||"")&&n.push(o)}return s=null,f},cleanData:function(e,t){var n,r,o,a,s=0,l=x.expando,u=x.cache,c=x.support.deleteExpando,f=x.event.special;for(;null!=(n=e[s]);s++)if((t||x.acceptData(n))&&(o=n[l],a=o&&u[o])){if(a.events)for(r in a.events)f[r]?x.event.remove(n,r):x.removeEvent(n,r,a.handle);
u[o]&&(delete u[o],c?delete n[l]:typeof n.removeAttribute!==i?n.removeAttribute(l):n[l]=null,p.push(o))}},_evalUrl:function(e){return x.ajax({url:e,type:"GET",dataType:"script",async:!1,global:!1,"throws":!0})}}),x.fn.extend({wrapAll:function(e){if(x.isFunction(e))return this.each(function(t){x(this).wrapAll(e.call(this,t))});if(this[0]){var t=x(e,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&t.insertBefore(this[0]),t.map(function(){var e=this;while(e.firstChild&&1===e.firstChild.nodeType)e=e.firstChild;return e}).append(this)}return this},wrapInner:function(e){return x.isFunction(e)?this.each(function(t){x(this).wrapInner(e.call(this,t))}):this.each(function(){var t=x(this),n=t.contents();n.length?n.wrapAll(e):t.append(e)})},wrap:function(e){var t=x.isFunction(e);return this.each(function(n){x(this).wrapAll(t?e.call(this,n):e)})},unwrap:function(){return this.parent().each(function(){x.nodeName(this,"body")||x(this).replaceWith(this.childNodes)}).end()}});var Pt,Rt,Wt,$t=/alpha\([^)]*\)/i,It=/opacity\s*=\s*([^)]*)/,zt=/^(top|right|bottom|left)$/,Xt=/^(none|table(?!-c[ea]).+)/,Ut=/^margin/,Vt=RegExp("^("+w+")(.*)$","i"),Yt=RegExp("^("+w+")(?!px)[a-z%]+$","i"),Jt=RegExp("^([+-])=("+w+")","i"),Gt={BODY:"block"},Qt={position:"absolute",visibility:"hidden",display:"block"},Kt={letterSpacing:0,fontWeight:400},Zt=["Top","Right","Bottom","Left"],en=["Webkit","O","Moz","ms"];function tn(e,t){if(t in e)return t;var n=t.charAt(0).toUpperCase()+t.slice(1),r=t,i=en.length;while(i--)if(t=en[i]+n,t in e)return t;return r}function nn(e,t){return e=t||e,"none"===x.css(e,"display")||!x.contains(e.ownerDocument,e)}function rn(e,t){var n,r,i,o=[],a=0,s=e.length;for(;s>a;a++)r=e[a],r.style&&(o[a]=x._data(r,"olddisplay"),n=r.style.display,t?(o[a]||"none"!==n||(r.style.display=""),""===r.style.display&&nn(r)&&(o[a]=x._data(r,"olddisplay",ln(r.nodeName)))):o[a]||(i=nn(r),(n&&"none"!==n||!i)&&x._data(r,"olddisplay",i?n:x.css(r,"display"))));for(a=0;s>a;a++)r=e[a],r.style&&(t&&"none"!==r.style.display&&""!==r.style.display||(r.style.display=t?o[a]||"":"none"));return e}x.fn.extend({css:function(e,n){return x.access(this,function(e,n,r){var i,o,a={},s=0;if(x.isArray(n)){for(o=Rt(e),i=n.length;i>s;s++)a[n[s]]=x.css(e,n[s],!1,o);return a}return r!==t?x.style(e,n,r):x.css(e,n)},e,n,arguments.length>1)},show:function(){return rn(this,!0)},hide:function(){return rn(this)},toggle:function(e){return"boolean"==typeof e?e?this.show():this.hide():this.each(function(){nn(this)?x(this).show():x(this).hide()})}}),x.extend({cssHooks:{opacity:{get:function(e,t){if(t){var n=Wt(e,"opacity");return""===n?"1":n}}}},cssNumber:{columnCount:!0,fillOpacity:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":x.support.cssFloat?"cssFloat":"styleFloat"},style:function(e,n,r,i){if(e&&3!==e.nodeType&&8!==e.nodeType&&e.style){var o,a,s,l=x.camelCase(n),u=e.style;if(n=x.cssProps[l]||(x.cssProps[l]=tn(u,l)),s=x.cssHooks[n]||x.cssHooks[l],r===t)return s&&"get"in s&&(o=s.get(e,!1,i))!==t?o:u[n];if(a=typeof r,"string"===a&&(o=Jt.exec(r))&&(r=(o[1]+1)*o[2]+parseFloat(x.css(e,n)),a="number"),!(null==r||"number"===a&&isNaN(r)||("number"!==a||x.cssNumber[l]||(r+="px"),x.support.clearCloneStyle||""!==r||0!==n.indexOf("background")||(u[n]="inherit"),s&&"set"in s&&(r=s.set(e,r,i))===t)))try{u[n]=r}catch(c){}}},css:function(e,n,r,i){var o,a,s,l=x.camelCase(n);return n=x.cssProps[l]||(x.cssProps[l]=tn(e.style,l)),s=x.cssHooks[n]||x.cssHooks[l],s&&"get"in s&&(a=s.get(e,!0,r)),a===t&&(a=Wt(e,n,i)),"normal"===a&&n in Kt&&(a=Kt[n]),""===r||r?(o=parseFloat(a),r===!0||x.isNumeric(o)?o||0:a):a}}),e.getComputedStyle?(Rt=function(t){return e.getComputedStyle(t,null)},Wt=function(e,n,r){var i,o,a,s=r||Rt(e),l=s?s.getPropertyValue(n)||s[n]:t,u=e.style;return s&&(""!==l||x.contains(e.ownerDocument,e)||(l=x.style(e,n)),Yt.test(l)&&Ut.test(n)&&(i=u.width,o=u.minWidth,a=u.maxWidth,u.minWidth=u.maxWidth=u.width=l,l=s.width,u.width=i,u.minWidth=o,u.maxWidth=a)),l}):a.documentElement.currentStyle&&(Rt=function(e){return e.currentStyle},Wt=function(e,n,r){var i,o,a,s=r||Rt(e),l=s?s[n]:t,u=e.style;return null==l&&u&&u[n]&&(l=u[n]),Yt.test(l)&&!zt.test(n)&&(i=u.left,o=e.runtimeStyle,a=o&&o.left,a&&(o.left=e.currentStyle.left),u.left="fontSize"===n?"1em":l,l=u.pixelLeft+"px",u.left=i,a&&(o.left=a)),""===l?"auto":l});function on(e,t,n){var r=Vt.exec(t);return r?Math.max(0,r[1]-(n||0))+(r[2]||"px"):t}function an(e,t,n,r,i){var o=n===(r?"border":"content")?4:"width"===t?1:0,a=0;for(;4>o;o+=2)"margin"===n&&(a+=x.css(e,n+Zt[o],!0,i)),r?("content"===n&&(a-=x.css(e,"padding"+Zt[o],!0,i)),"margin"!==n&&(a-=x.css(e,"border"+Zt[o]+"Width",!0,i))):(a+=x.css(e,"padding"+Zt[o],!0,i),"padding"!==n&&(a+=x.css(e,"border"+Zt[o]+"Width",!0,i)));return a}function sn(e,t,n){var r=!0,i="width"===t?e.offsetWidth:e.offsetHeight,o=Rt(e),a=x.support.boxSizing&&"border-box"===x.css(e,"boxSizing",!1,o);if(0>=i||null==i){if(i=Wt(e,t,o),(0>i||null==i)&&(i=e.style[t]),Yt.test(i))return i;r=a&&(x.support.boxSizingReliable||i===e.style[t]),i=parseFloat(i)||0}return i+an(e,t,n||(a?"border":"content"),r,o)+"px"}function ln(e){var t=a,n=Gt[e];return n||(n=un(e,t),"none"!==n&&n||(Pt=(Pt||x("<iframe frameborder='0' width='0' height='0'/>").css("cssText","display:block !important")).appendTo(t.documentElement),t=(Pt[0].contentWindow||Pt[0].contentDocument).document,t.write("<!doctype html><html><body>"),t.close(),n=un(e,t),Pt.detach()),Gt[e]=n),n}function un(e,t){var n=x(t.createElement(e)).appendTo(t.body),r=x.css(n[0],"display");return n.remove(),r}x.each(["height","width"],function(e,n){x.cssHooks[n]={get:function(e,r,i){return r?0===e.offsetWidth&&Xt.test(x.css(e,"display"))?x.swap(e,Qt,function(){return sn(e,n,i)}):sn(e,n,i):t},set:function(e,t,r){var i=r&&Rt(e);return on(e,t,r?an(e,n,r,x.support.boxSizing&&"border-box"===x.css(e,"boxSizing",!1,i),i):0)}}}),x.support.opacity||(x.cssHooks.opacity={get:function(e,t){return It.test((t&&e.currentStyle?e.currentStyle.filter:e.style.filter)||"")?.01*parseFloat(RegExp.$1)+"":t?"1":""},set:function(e,t){var n=e.style,r=e.currentStyle,i=x.isNumeric(t)?"alpha(opacity="+100*t+")":"",o=r&&r.filter||n.filter||"";n.zoom=1,(t>=1||""===t)&&""===x.trim(o.replace($t,""))&&n.removeAttribute&&(n.removeAttribute("filter"),""===t||r&&!r.filter)||(n.filter=$t.test(o)?o.replace($t,i):o+" "+i)}}),x(function(){x.support.reliableMarginRight||(x.cssHooks.marginRight={get:function(e,n){return n?x.swap(e,{display:"inline-block"},Wt,[e,"marginRight"]):t}}),!x.support.pixelPosition&&x.fn.position&&x.each(["top","left"],function(e,n){x.cssHooks[n]={get:function(e,r){return r?(r=Wt(e,n),Yt.test(r)?x(e).position()[n]+"px":r):t}}})}),x.expr&&x.expr.filters&&(x.expr.filters.hidden=function(e){return 0>=e.offsetWidth&&0>=e.offsetHeight||!x.support.reliableHiddenOffsets&&"none"===(e.style&&e.style.display||x.css(e,"display"))},x.expr.filters.visible=function(e){return!x.expr.filters.hidden(e)}),x.each({margin:"",padding:"",border:"Width"},function(e,t){x.cssHooks[e+t]={expand:function(n){var r=0,i={},o="string"==typeof n?n.split(" "):[n];for(;4>r;r++)i[e+Zt[r]+t]=o[r]||o[r-2]||o[0];return i}},Ut.test(e)||(x.cssHooks[e+t].set=on)});var cn=/%20/g,pn=/\[\]$/,fn=/\r?\n/g,dn=/^(?:submit|button|image|reset|file)$/i,hn=/^(?:input|select|textarea|keygen)/i;x.fn.extend({serialize:function(){return x.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var e=x.prop(this,"elements");return e?x.makeArray(e):this}).filter(function(){var e=this.type;return this.name&&!x(this).is(":disabled")&&hn.test(this.nodeName)&&!dn.test(e)&&(this.checked||!Ct.test(e))}).map(function(e,t){var n=x(this).val();return null==n?null:x.isArray(n)?x.map(n,function(e){return{name:t.name,value:e.replace(fn,"\r\n")}}):{name:t.name,value:n.replace(fn,"\r\n")}}).get()}}),x.param=function(e,n){var r,i=[],o=function(e,t){t=x.isFunction(t)?t():null==t?"":t,i[i.length]=encodeURIComponent(e)+"="+encodeURIComponent(t)};if(n===t&&(n=x.ajaxSettings&&x.ajaxSettings.traditional),x.isArray(e)||e.jquery&&!x.isPlainObject(e))x.each(e,function(){o(this.name,this.value)});else for(r in e)gn(r,e[r],n,o);return i.join("&").replace(cn,"+")};function gn(e,t,n,r){var i;if(x.isArray(t))x.each(t,function(t,i){n||pn.test(e)?r(e,i):gn(e+"["+("object"==typeof i?t:"")+"]",i,n,r)});else if(n||"object"!==x.type(t))r(e,t);else for(i in t)gn(e+"["+i+"]",t[i],n,r)}x.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(e,t){x.fn[t]=function(e,n){return arguments.length>0?this.on(t,null,e,n):this.trigger(t)}}),x.fn.extend({hover:function(e,t){return this.mouseenter(e).mouseleave(t||e)},bind:function(e,t,n){return this.on(e,null,t,n)},unbind:function(e,t){return this.off(e,null,t)},delegate:function(e,t,n,r){return this.on(t,e,n,r)},undelegate:function(e,t,n){return 1===arguments.length?this.off(e,"**"):this.off(t,e||"**",n)}});var mn,yn,vn=x.now(),bn=/\?/,xn=/#.*$/,wn=/([?&])_=[^&]*/,Tn=/^(.*?):[ \t]*([^\r\n]*)\r?$/gm,Cn=/^(?:about|app|app-storage|.+-extension|file|res|widget):$/,Nn=/^(?:GET|HEAD)$/,kn=/^\/\//,En=/^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,Sn=x.fn.load,An={},jn={},Dn="*/".concat("*");try{yn=o.href}catch(Ln){yn=a.createElement("a"),yn.href="",yn=yn.href}mn=En.exec(yn.toLowerCase())||[];function Hn(e){return function(t,n){"string"!=typeof t&&(n=t,t="*");var r,i=0,o=t.toLowerCase().match(T)||[];if(x.isFunction(n))while(r=o[i++])"+"===r[0]?(r=r.slice(1)||"*",(e[r]=e[r]||[]).unshift(n)):(e[r]=e[r]||[]).push(n)}}function qn(e,n,r,i){var o={},a=e===jn;function s(l){var u;return o[l]=!0,x.each(e[l]||[],function(e,l){var c=l(n,r,i);return"string"!=typeof c||a||o[c]?a?!(u=c):t:(n.dataTypes.unshift(c),s(c),!1)}),u}return s(n.dataTypes[0])||!o["*"]&&s("*")}function _n(e,n){var r,i,o=x.ajaxSettings.flatOptions||{};for(i in n)n[i]!==t&&((o[i]?e:r||(r={}))[i]=n[i]);return r&&x.extend(!0,e,r),e}x.fn.load=function(e,n,r){if("string"!=typeof e&&Sn)return Sn.apply(this,arguments);var i,o,a,s=this,l=e.indexOf(" ");return l>=0&&(i=e.slice(l,e.length),e=e.slice(0,l)),x.isFunction(n)?(r=n,n=t):n&&"object"==typeof n&&(a="POST"),s.length>0&&x.ajax({url:e,type:a,dataType:"html",data:n}).done(function(e){o=arguments,s.html(i?x("<div>").append(x.parseHTML(e)).find(i):e)}).complete(r&&function(e,t){s.each(r,o||[e.responseText,t,e])}),this},x.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(e,t){x.fn[t]=function(e){return this.on(t,e)}}),x.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:yn,type:"GET",isLocal:Cn.test(mn[1]),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":Dn,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":x.parseJSON,"text xml":x.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(e,t){return t?_n(_n(e,x.ajaxSettings),t):_n(x.ajaxSettings,e)},ajaxPrefilter:Hn(An),ajaxTransport:Hn(jn),ajax:function(e,n){"object"==typeof e&&(n=e,e=t),n=n||{};var r,i,o,a,s,l,u,c,p=x.ajaxSetup({},n),f=p.context||p,d=p.context&&(f.nodeType||f.jquery)?x(f):x.event,h=x.Deferred(),g=x.Callbacks("once memory"),m=p.statusCode||{},y={},v={},b=0,w="canceled",C={readyState:0,getResponseHeader:function(e){var t;if(2===b){if(!c){c={};while(t=Tn.exec(a))c[t[1].toLowerCase()]=t[2]}t=c[e.toLowerCase()]}return null==t?null:t},getAllResponseHeaders:function(){return 2===b?a:null},setRequestHeader:function(e,t){var n=e.toLowerCase();return b||(e=v[n]=v[n]||e,y[e]=t),this},overrideMimeType:function(e){return b||(p.mimeType=e),this},statusCode:function(e){var t;if(e)if(2>b)for(t in e)m[t]=[m[t],e[t]];else C.always(e[C.status]);return this},abort:function(e){var t=e||w;return u&&u.abort(t),k(0,t),this}};if(h.promise(C).complete=g.add,C.success=C.done,C.error=C.fail,p.url=((e||p.url||yn)+"").replace(xn,"").replace(kn,mn[1]+"//"),p.type=n.method||n.type||p.method||p.type,p.dataTypes=x.trim(p.dataType||"*").toLowerCase().match(T)||[""],null==p.crossDomain&&(r=En.exec(p.url.toLowerCase()),p.crossDomain=!(!r||r[1]===mn[1]&&r[2]===mn[2]&&(r[3]||("http:"===r[1]?"80":"443"))===(mn[3]||("http:"===mn[1]?"80":"443")))),p.data&&p.processData&&"string"!=typeof p.data&&(p.data=x.param(p.data,p.traditional)),qn(An,p,n,C),2===b)return C;l=p.global,l&&0===x.active++&&x.event.trigger("ajaxStart"),p.type=p.type.toUpperCase(),p.hasContent=!Nn.test(p.type),o=p.url,p.hasContent||(p.data&&(o=p.url+=(bn.test(o)?"&":"?")+p.data,delete p.data),p.cache===!1&&(p.url=wn.test(o)?o.replace(wn,"$1_="+vn++):o+(bn.test(o)?"&":"?")+"_="+vn++)),p.ifModified&&(x.lastModified[o]&&C.setRequestHeader("If-Modified-Since",x.lastModified[o]),x.etag[o]&&C.setRequestHeader("If-None-Match",x.etag[o])),(p.data&&p.hasContent&&p.contentType!==!1||n.contentType)&&C.setRequestHeader("Content-Type",p.contentType),C.setRequestHeader("Accept",p.dataTypes[0]&&p.accepts[p.dataTypes[0]]?p.accepts[p.dataTypes[0]]+("*"!==p.dataTypes[0]?", "+Dn+"; q=0.01":""):p.accepts["*"]);for(i in p.headers)C.setRequestHeader(i,p.headers[i]);if(p.beforeSend&&(p.beforeSend.call(f,C,p)===!1||2===b))return C.abort();w="abort";for(i in{success:1,error:1,complete:1})C[i](p[i]);if(u=qn(jn,p,n,C)){C.readyState=1,l&&d.trigger("ajaxSend",[C,p]),p.async&&p.timeout>0&&(s=setTimeout(function(){C.abort("timeout")},p.timeout));try{b=1,u.send(y,k)}catch(N){if(!(2>b))throw N;k(-1,N)}}else k(-1,"No Transport");function k(e,n,r,i){var c,y,v,w,T,N=n;2!==b&&(b=2,s&&clearTimeout(s),u=t,a=i||"",C.readyState=e>0?4:0,c=e>=200&&300>e||304===e,r&&(w=Mn(p,C,r)),w=On(p,w,C,c),c?(p.ifModified&&(T=C.getResponseHeader("Last-Modified"),T&&(x.lastModified[o]=T),T=C.getResponseHeader("etag"),T&&(x.etag[o]=T)),204===e||"HEAD"===p.type?N="nocontent":304===e?N="notmodified":(N=w.state,y=w.data,v=w.error,c=!v)):(v=N,(e||!N)&&(N="error",0>e&&(e=0))),C.status=e,C.statusText=(n||N)+"",c?h.resolveWith(f,[y,N,C]):h.rejectWith(f,[C,N,v]),C.statusCode(m),m=t,l&&d.trigger(c?"ajaxSuccess":"ajaxError",[C,p,c?y:v]),g.fireWith(f,[C,N]),l&&(d.trigger("ajaxComplete",[C,p]),--x.active||x.event.trigger("ajaxStop")))}return C},getJSON:function(e,t,n){return x.get(e,t,n,"json")},getScript:function(e,n){return x.get(e,t,n,"script")}}),x.each(["get","post"],function(e,n){x[n]=function(e,r,i,o){return x.isFunction(r)&&(o=o||i,i=r,r=t),x.ajax({url:e,type:n,dataType:o,data:r,success:i})}});function Mn(e,n,r){var i,o,a,s,l=e.contents,u=e.dataTypes;while("*"===u[0])u.shift(),o===t&&(o=e.mimeType||n.getResponseHeader("Content-Type"));if(o)for(s in l)if(l[s]&&l[s].test(o)){u.unshift(s);break}if(u[0]in r)a=u[0];else{for(s in r){if(!u[0]||e.converters[s+" "+u[0]]){a=s;break}i||(i=s)}a=a||i}return a?(a!==u[0]&&u.unshift(a),r[a]):t}function On(e,t,n,r){var i,o,a,s,l,u={},c=e.dataTypes.slice();if(c[1])for(a in e.converters)u[a.toLowerCase()]=e.converters[a];o=c.shift();while(o)if(e.responseFields[o]&&(n[e.responseFields[o]]=t),!l&&r&&e.dataFilter&&(t=e.dataFilter(t,e.dataType)),l=o,o=c.shift())if("*"===o)o=l;else if("*"!==l&&l!==o){if(a=u[l+" "+o]||u["* "+o],!a)for(i in u)if(s=i.split(" "),s[1]===o&&(a=u[l+" "+s[0]]||u["* "+s[0]])){a===!0?a=u[i]:u[i]!==!0&&(o=s[0],c.unshift(s[1]));break}if(a!==!0)if(a&&e["throws"])t=a(t);else try{t=a(t)}catch(p){return{state:"parsererror",error:a?p:"No conversion from "+l+" to "+o}}}return{state:"success",data:t}}x.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/(?:java|ecma)script/},converters:{"text script":function(e){return x.globalEval(e),e}}}),x.ajaxPrefilter("script",function(e){e.cache===t&&(e.cache=!1),e.crossDomain&&(e.type="GET",e.global=!1)}),x.ajaxTransport("script",function(e){if(e.crossDomain){var n,r=a.head||x("head")[0]||a.documentElement;return{send:function(t,i){n=a.createElement("script"),n.async=!0,e.scriptCharset&&(n.charset=e.scriptCharset),n.src=e.url,n.onload=n.onreadystatechange=function(e,t){(t||!n.readyState||/loaded|complete/.test(n.readyState))&&(n.onload=n.onreadystatechange=null,n.parentNode&&n.parentNode.removeChild(n),n=null,t||i(200,"success"))},r.insertBefore(n,r.firstChild)},abort:function(){n&&n.onload(t,!0)}}}});var Fn=[],Bn=/(=)\?(?=&|$)|\?\?/;x.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var e=Fn.pop()||x.expando+"_"+vn++;return this[e]=!0,e}}),x.ajaxPrefilter("json jsonp",function(n,r,i){var o,a,s,l=n.jsonp!==!1&&(Bn.test(n.url)?"url":"string"==typeof n.data&&!(n.contentType||"").indexOf("application/x-www-form-urlencoded")&&Bn.test(n.data)&&"data");return l||"jsonp"===n.dataTypes[0]?(o=n.jsonpCallback=x.isFunction(n.jsonpCallback)?n.jsonpCallback():n.jsonpCallback,l?n[l]=n[l].replace(Bn,"$1"+o):n.jsonp!==!1&&(n.url+=(bn.test(n.url)?"&":"?")+n.jsonp+"="+o),n.converters["script json"]=function(){return s||x.error(o+" was not called"),s[0]},n.dataTypes[0]="json",a=e[o],e[o]=function(){s=arguments},i.always(function(){e[o]=a,n[o]&&(n.jsonpCallback=r.jsonpCallback,Fn.push(o)),s&&x.isFunction(a)&&a(s[0]),s=a=t}),"script"):t});var Pn,Rn,Wn=0,$n=e.ActiveXObject&&function(){var e;for(e in Pn)Pn[e](t,!0)};function In(){try{return new e.XMLHttpRequest}catch(t){}}function zn(){try{return new e.ActiveXObject("Microsoft.XMLHTTP")}catch(t){}}x.ajaxSettings.xhr=e.ActiveXObject?function(){return!this.isLocal&&In()||zn()}:In,Rn=x.ajaxSettings.xhr(),x.support.cors=!!Rn&&"withCredentials"in Rn,Rn=x.support.ajax=!!Rn,Rn&&x.ajaxTransport(function(n){if(!n.crossDomain||x.support.cors){var r;return{send:function(i,o){var a,s,l=n.xhr();if(n.username?l.open(n.type,n.url,n.async,n.username,n.password):l.open(n.type,n.url,n.async),n.xhrFields)for(s in n.xhrFields)l[s]=n.xhrFields[s];n.mimeType&&l.overrideMimeType&&l.overrideMimeType(n.mimeType),n.crossDomain||i["X-Requested-With"]||(i["X-Requested-With"]="XMLHttpRequest");try{for(s in i)l.setRequestHeader(s,i[s])}catch(u){}l.send(n.hasContent&&n.data||null),r=function(e,i){var s,u,c,p;try{if(r&&(i||4===l.readyState))if(r=t,a&&(l.onreadystatechange=x.noop,$n&&delete Pn[a]),i)4!==l.readyState&&l.abort();else{p={},s=l.status,u=l.getAllResponseHeaders(),"string"==typeof l.responseText&&(p.text=l.responseText);try{c=l.statusText}catch(f){c=""}s||!n.isLocal||n.crossDomain?1223===s&&(s=204):s=p.text?200:404}}catch(d){i||o(-1,d)}p&&o(s,c,p,u)},n.async?4===l.readyState?setTimeout(r):(a=++Wn,$n&&(Pn||(Pn={},x(e).unload($n)),Pn[a]=r),l.onreadystatechange=r):r()},abort:function(){r&&r(t,!0)}}}});var Xn,Un,Vn=/^(?:toggle|show|hide)$/,Yn=RegExp("^(?:([+-])=|)("+w+")([a-z%]*)$","i"),Jn=/queueHooks$/,Gn=[nr],Qn={"*":[function(e,t){var n=this.createTween(e,t),r=n.cur(),i=Yn.exec(t),o=i&&i[3]||(x.cssNumber[e]?"":"px"),a=(x.cssNumber[e]||"px"!==o&&+r)&&Yn.exec(x.css(n.elem,e)),s=1,l=20;if(a&&a[3]!==o){o=o||a[3],i=i||[],a=+r||1;do s=s||".5",a/=s,x.style(n.elem,e,a+o);while(s!==(s=n.cur()/r)&&1!==s&&--l)}return i&&(a=n.start=+a||+r||0,n.unit=o,n.end=i[1]?a+(i[1]+1)*i[2]:+i[2]),n}]};function Kn(){return setTimeout(function(){Xn=t}),Xn=x.now()}function Zn(e,t,n){var r,i=(Qn[t]||[]).concat(Qn["*"]),o=0,a=i.length;for(;a>o;o++)if(r=i[o].call(n,t,e))return r}function er(e,t,n){var r,i,o=0,a=Gn.length,s=x.Deferred().always(function(){delete l.elem}),l=function(){if(i)return!1;var t=Xn||Kn(),n=Math.max(0,u.startTime+u.duration-t),r=n/u.duration||0,o=1-r,a=0,l=u.tweens.length;for(;l>a;a++)u.tweens[a].run(o);return s.notifyWith(e,[u,o,n]),1>o&&l?n:(s.resolveWith(e,[u]),!1)},u=s.promise({elem:e,props:x.extend({},t),opts:x.extend(!0,{specialEasing:{}},n),originalProperties:t,originalOptions:n,startTime:Xn||Kn(),duration:n.duration,tweens:[],createTween:function(t,n){var r=x.Tween(e,u.opts,t,n,u.opts.specialEasing[t]||u.opts.easing);return u.tweens.push(r),r},stop:function(t){var n=0,r=t?u.tweens.length:0;if(i)return this;for(i=!0;r>n;n++)u.tweens[n].run(1);return t?s.resolveWith(e,[u,t]):s.rejectWith(e,[u,t]),this}}),c=u.props;for(tr(c,u.opts.specialEasing);a>o;o++)if(r=Gn[o].call(u,e,c,u.opts))return r;return x.map(c,Zn,u),x.isFunction(u.opts.start)&&u.opts.start.call(e,u),x.fx.timer(x.extend(l,{elem:e,anim:u,queue:u.opts.queue})),u.progress(u.opts.progress).done(u.opts.done,u.opts.complete).fail(u.opts.fail).always(u.opts.always)}function tr(e,t){var n,r,i,o,a;for(n in e)if(r=x.camelCase(n),i=t[r],o=e[n],x.isArray(o)&&(i=o[1],o=e[n]=o[0]),n!==r&&(e[r]=o,delete e[n]),a=x.cssHooks[r],a&&"expand"in a){o=a.expand(o),delete e[r];for(n in o)n in e||(e[n]=o[n],t[n]=i)}else t[r]=i}x.Animation=x.extend(er,{tweener:function(e,t){x.isFunction(e)?(t=e,e=["*"]):e=e.split(" ");var n,r=0,i=e.length;for(;i>r;r++)n=e[r],Qn[n]=Qn[n]||[],Qn[n].unshift(t)},prefilter:function(e,t){t?Gn.unshift(e):Gn.push(e)}});function nr(e,t,n){var r,i,o,a,s,l,u=this,c={},p=e.style,f=e.nodeType&&nn(e),d=x._data(e,"fxshow");n.queue||(s=x._queueHooks(e,"fx"),null==s.unqueued&&(s.unqueued=0,l=s.empty.fire,s.empty.fire=function(){s.unqueued||l()}),s.unqueued++,u.always(function(){u.always(function(){s.unqueued--,x.queue(e,"fx").length||s.empty.fire()})})),1===e.nodeType&&("height"in t||"width"in t)&&(n.overflow=[p.overflow,p.overflowX,p.overflowY],"inline"===x.css(e,"display")&&"none"===x.css(e,"float")&&(x.support.inlineBlockNeedsLayout&&"inline"!==ln(e.nodeName)?p.zoom=1:p.display="inline-block")),n.overflow&&(p.overflow="hidden",x.support.shrinkWrapBlocks||u.always(function(){p.overflow=n.overflow[0],p.overflowX=n.overflow[1],p.overflowY=n.overflow[2]}));for(r in t)if(i=t[r],Vn.exec(i)){if(delete t[r],o=o||"toggle"===i,i===(f?"hide":"show"))continue;c[r]=d&&d[r]||x.style(e,r)}if(!x.isEmptyObject(c)){d?"hidden"in d&&(f=d.hidden):d=x._data(e,"fxshow",{}),o&&(d.hidden=!f),f?x(e).show():u.done(function(){x(e).hide()}),u.done(function(){var t;x._removeData(e,"fxshow");for(t in c)x.style(e,t,c[t])});for(r in c)a=Zn(f?d[r]:0,r,u),r in d||(d[r]=a.start,f&&(a.end=a.start,a.start="width"===r||"height"===r?1:0))}}function rr(e,t,n,r,i){return new rr.prototype.init(e,t,n,r,i)}x.Tween=rr,rr.prototype={constructor:rr,init:function(e,t,n,r,i,o){this.elem=e,this.prop=n,this.easing=i||"swing",this.options=t,this.start=this.now=this.cur(),this.end=r,this.unit=o||(x.cssNumber[n]?"":"px")},cur:function(){var e=rr.propHooks[this.prop];return e&&e.get?e.get(this):rr.propHooks._default.get(this)},run:function(e){var t,n=rr.propHooks[this.prop];return this.pos=t=this.options.duration?x.easing[this.easing](e,this.options.duration*e,0,1,this.options.duration):e,this.now=(this.end-this.start)*t+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),n&&n.set?n.set(this):rr.propHooks._default.set(this),this}},rr.prototype.init.prototype=rr.prototype,rr.propHooks={_default:{get:function(e){var t;return null==e.elem[e.prop]||e.elem.style&&null!=e.elem.style[e.prop]?(t=x.css(e.elem,e.prop,""),t&&"auto"!==t?t:0):e.elem[e.prop]},set:function(e){x.fx.step[e.prop]?x.fx.step[e.prop](e):e.elem.style&&(null!=e.elem.style[x.cssProps[e.prop]]||x.cssHooks[e.prop])?x.style(e.elem,e.prop,e.now+e.unit):e.elem[e.prop]=e.now}}},rr.propHooks.scrollTop=rr.propHooks.scrollLeft={set:function(e){e.elem.nodeType&&e.elem.parentNode&&(e.elem[e.prop]=e.now)}},x.each(["toggle","show","hide"],function(e,t){var n=x.fn[t];x.fn[t]=function(e,r,i){return null==e||"boolean"==typeof e?n.apply(this,arguments):this.animate(ir(t,!0),e,r,i)}}),x.fn.extend({fadeTo:function(e,t,n,r){return this.filter(nn).css("opacity",0).show().end().animate({opacity:t},e,n,r)},animate:function(e,t,n,r){var i=x.isEmptyObject(e),o=x.speed(t,n,r),a=function(){var t=er(this,x.extend({},e),o);(i||x._data(this,"finish"))&&t.stop(!0)};return a.finish=a,i||o.queue===!1?this.each(a):this.queue(o.queue,a)},stop:function(e,n,r){var i=function(e){var t=e.stop;delete e.stop,t(r)};return"string"!=typeof e&&(r=n,n=e,e=t),n&&e!==!1&&this.queue(e||"fx",[]),this.each(function(){var t=!0,n=null!=e&&e+"queueHooks",o=x.timers,a=x._data(this);if(n)a[n]&&a[n].stop&&i(a[n]);else for(n in a)a[n]&&a[n].stop&&Jn.test(n)&&i(a[n]);for(n=o.length;n--;)o[n].elem!==this||null!=e&&o[n].queue!==e||(o[n].anim.stop(r),t=!1,o.splice(n,1));(t||!r)&&x.dequeue(this,e)})},finish:function(e){return e!==!1&&(e=e||"fx"),this.each(function(){var t,n=x._data(this),r=n[e+"queue"],i=n[e+"queueHooks"],o=x.timers,a=r?r.length:0;for(n.finish=!0,x.queue(this,e,[]),i&&i.stop&&i.stop.call(this,!0),t=o.length;t--;)o[t].elem===this&&o[t].queue===e&&(o[t].anim.stop(!0),o.splice(t,1));for(t=0;a>t;t++)r[t]&&r[t].finish&&r[t].finish.call(this);delete n.finish})}});function ir(e,t){var n,r={height:e},i=0;for(t=t?1:0;4>i;i+=2-t)n=Zt[i],r["margin"+n]=r["padding"+n]=e;return t&&(r.opacity=r.width=e),r}x.each({slideDown:ir("show"),slideUp:ir("hide"),slideToggle:ir("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(e,t){x.fn[e]=function(e,n,r){return this.animate(t,e,n,r)}}),x.speed=function(e,t,n){var r=e&&"object"==typeof e?x.extend({},e):{complete:n||!n&&t||x.isFunction(e)&&e,duration:e,easing:n&&t||t&&!x.isFunction(t)&&t};return r.duration=x.fx.off?0:"number"==typeof r.duration?r.duration:r.duration in x.fx.speeds?x.fx.speeds[r.duration]:x.fx.speeds._default,(null==r.queue||r.queue===!0)&&(r.queue="fx"),r.old=r.complete,r.complete=function(){x.isFunction(r.old)&&r.old.call(this),r.queue&&x.dequeue(this,r.queue)},r},x.easing={linear:function(e){return e},swing:function(e){return.5-Math.cos(e*Math.PI)/2}},x.timers=[],x.fx=rr.prototype.init,x.fx.tick=function(){var e,n=x.timers,r=0;for(Xn=x.now();n.length>r;r++)e=n[r],e()||n[r]!==e||n.splice(r--,1);n.length||x.fx.stop(),Xn=t},x.fx.timer=function(e){e()&&x.timers.push(e)&&x.fx.start()},x.fx.interval=13,x.fx.start=function(){Un||(Un=setInterval(x.fx.tick,x.fx.interval))},x.fx.stop=function(){clearInterval(Un),Un=null},x.fx.speeds={slow:600,fast:200,_default:400},x.fx.step={},x.expr&&x.expr.filters&&(x.expr.filters.animated=function(e){return x.grep(x.timers,function(t){return e===t.elem}).length}),x.fn.offset=function(e){if(arguments.length)return e===t?this:this.each(function(t){x.offset.setOffset(this,e,t)});var n,r,o={top:0,left:0},a=this[0],s=a&&a.ownerDocument;if(s)return n=s.documentElement,x.contains(n,a)?(typeof a.getBoundingClientRect!==i&&(o=a.getBoundingClientRect()),r=or(s),{top:o.top+(r.pageYOffset||n.scrollTop)-(n.clientTop||0),left:o.left+(r.pageXOffset||n.scrollLeft)-(n.clientLeft||0)}):o},x.offset={setOffset:function(e,t,n){var r=x.css(e,"position");"static"===r&&(e.style.position="relative");var i=x(e),o=i.offset(),a=x.css(e,"top"),s=x.css(e,"left"),l=("absolute"===r||"fixed"===r)&&x.inArray("auto",[a,s])>-1,u={},c={},p,f;l?(c=i.position(),p=c.top,f=c.left):(p=parseFloat(a)||0,f=parseFloat(s)||0),x.isFunction(t)&&(t=t.call(e,n,o)),null!=t.top&&(u.top=t.top-o.top+p),null!=t.left&&(u.left=t.left-o.left+f),"using"in t?t.using.call(e,u):i.css(u)}},x.fn.extend({position:function(){if(this[0]){var e,t,n={top:0,left:0},r=this[0];return"fixed"===x.css(r,"position")?t=r.getBoundingClientRect():(e=this.offsetParent(),t=this.offset(),x.nodeName(e[0],"html")||(n=e.offset()),n.top+=x.css(e[0],"borderTopWidth",!0),n.left+=x.css(e[0],"borderLeftWidth",!0)),{top:t.top-n.top-x.css(r,"marginTop",!0),left:t.left-n.left-x.css(r,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){var e=this.offsetParent||s;while(e&&!x.nodeName(e,"html")&&"static"===x.css(e,"position"))e=e.offsetParent;return e||s})}}),x.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(e,n){var r=/Y/.test(n);x.fn[e]=function(i){return x.access(this,function(e,i,o){var a=or(e);return o===t?a?n in a?a[n]:a.document.documentElement[i]:e[i]:(a?a.scrollTo(r?x(a).scrollLeft():o,r?o:x(a).scrollTop()):e[i]=o,t)},e,i,arguments.length,null)}});function or(e){return x.isWindow(e)?e:9===e.nodeType?e.defaultView||e.parentWindow:!1}x.each({Height:"height",Width:"width"},function(e,n){x.each({padding:"inner"+e,content:n,"":"outer"+e},function(r,i){x.fn[i]=function(i,o){var a=arguments.length&&(r||"boolean"!=typeof i),s=r||(i===!0||o===!0?"margin":"border");return x.access(this,function(n,r,i){var o;return x.isWindow(n)?n.document.documentElement["client"+e]:9===n.nodeType?(o=n.documentElement,Math.max(n.body["scroll"+e],o["scroll"+e],n.body["offset"+e],o["offset"+e],o["client"+e])):i===t?x.css(n,r,s):x.style(n,r,i,s)},n,a?i:t,a,null)}})}),x.fn.size=function(){return this.length},x.fn.andSelf=x.fn.addBack,"object"==typeof module&&module&&"object"==typeof module.exports?module.exports=x:(e.jQuery=e.$=x,"function"==typeof define&&define.amd&&define("jquery",[],function(){return x}))})(window);
*/
/*! jQuery Migrate v1.2.1 | (c) 2005, 2013 jQuery Foundation, Inc. and other contributors | jquery.org/license */
jQuery.migrateMute===void 0&&(jQuery.migrateMute=!0),function(e,t,n){function r(n){var r=t.console;i[n]||(i[n]=!0,e.migrateWarnings.push(n),r&&r.warn&&!e.migrateMute&&(r.warn("JQMIGRATE: "+n),e.migrateTrace&&r.trace&&r.trace()))}function a(t,a,i,o){if(Object.defineProperty)try{return Object.defineProperty(t,a,{configurable:!0,enumerable:!0,get:function(){return r(o),i},set:function(e){r(o),i=e}}),n}catch(s){}e._definePropertyBroken=!0,t[a]=i}var i={};e.migrateWarnings=[],!e.migrateMute&&t.console&&t.console.log&&t.console.log("JQMIGRATE: Logging is active"),e.migrateTrace===n&&(e.migrateTrace=!0),e.migrateReset=function(){i={},e.migrateWarnings.length=0},"BackCompat"===document.compatMode&&r("jQuery is not compatible with Quirks Mode");var o=e("<input/>",{size:1}).attr("size")&&e.attrFn,s=e.attr,u=e.attrHooks.value&&e.attrHooks.value.get||function(){return null},c=e.attrHooks.value&&e.attrHooks.value.set||function(){return n},l=/^(?:input|button)$/i,d=/^[238]$/,p=/^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,f=/^(?:checked|selected)$/i;a(e,"attrFn",o||{},"jQuery.attrFn is deprecated"),e.attr=function(t,a,i,u){var c=a.toLowerCase(),g=t&&t.nodeType;return u&&(4>s.length&&r("jQuery.fn.attr( props, pass ) is deprecated"),t&&!d.test(g)&&(o?a in o:e.isFunction(e.fn[a])))?e(t)[a](i):("type"===a&&i!==n&&l.test(t.nodeName)&&t.parentNode&&r("Can't change the 'type' of an input or button in IE 6/7/8"),!e.attrHooks[c]&&p.test(c)&&(e.attrHooks[c]={get:function(t,r){var a,i=e.prop(t,r);return i===!0||"boolean"!=typeof i&&(a=t.getAttributeNode(r))&&a.nodeValue!==!1?r.toLowerCase():n},set:function(t,n,r){var a;return n===!1?e.removeAttr(t,r):(a=e.propFix[r]||r,a in t&&(t[a]=!0),t.setAttribute(r,r.toLowerCase())),r}},f.test(c)&&r("jQuery.fn.attr('"+c+"') may use property instead of attribute")),s.call(e,t,a,i))},e.attrHooks.value={get:function(e,t){var n=(e.nodeName||"").toLowerCase();return"button"===n?u.apply(this,arguments):("input"!==n&&"option"!==n&&r("jQuery.fn.attr('value') no longer gets properties"),t in e?e.value:null)},set:function(e,t){var a=(e.nodeName||"").toLowerCase();return"button"===a?c.apply(this,arguments):("input"!==a&&"option"!==a&&r("jQuery.fn.attr('value', val) no longer sets properties"),e.value=t,n)}};var g,h,v=e.fn.init,m=e.parseJSON,y=/^([^<]*)(<[\w\W]+>)([^>]*)$/;e.fn.init=function(t,n,a){var i;return t&&"string"==typeof t&&!e.isPlainObject(n)&&(i=y.exec(e.trim(t)))&&i[0]&&("<"!==t.charAt(0)&&r("$(html) HTML strings must start with '<' character"),i[3]&&r("$(html) HTML text after last tag is ignored"),"#"===i[0].charAt(0)&&(r("HTML string cannot start with a '#' character"),e.error("JQMIGRATE: Invalid selector string (XSS)")),n&&n.context&&(n=n.context),e.parseHTML)?v.call(this,e.parseHTML(i[2],n,!0),n,a):v.apply(this,arguments)},e.fn.init.prototype=e.fn,e.parseJSON=function(e){return e||null===e?m.apply(this,arguments):(r("jQuery.parseJSON requires a valid JSON string"),null)},e.uaMatch=function(e){e=e.toLowerCase();var t=/(chrome)[ \/]([\w.]+)/.exec(e)||/(webkit)[ \/]([\w.]+)/.exec(e)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e)||/(msie) ([\w.]+)/.exec(e)||0>e.indexOf("compatible")&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e)||[];return{browser:t[1]||"",version:t[2]||"0"}},e.browser||(g=e.uaMatch(navigator.userAgent),h={},g.browser&&(h[g.browser]=!0,h.version=g.version),h.chrome?h.webkit=!0:h.webkit&&(h.safari=!0),e.browser=h),a(e,"browser",e.browser,"jQuery.browser is deprecated"),e.sub=function(){function t(e,n){return new t.fn.init(e,n)}e.extend(!0,t,this),t.superclass=this,t.fn=t.prototype=this(),t.fn.constructor=t,t.sub=this.sub,t.fn.init=function(r,a){return a&&a instanceof e&&!(a instanceof t)&&(a=t(a)),e.fn.init.call(this,r,a,n)},t.fn.init.prototype=t.fn;var n=t(document);return r("jQuery.sub() is deprecated"),t},e.ajaxSetup({converters:{"text json":e.parseJSON}});var b=e.fn.data;e.fn.data=function(t){var a,i,o=this[0];return!o||"events"!==t||1!==arguments.length||(a=e.data(o,t),i=e._data(o,t),a!==n&&a!==i||i===n)?b.apply(this,arguments):(r("Use of jQuery.fn.data('events') is deprecated"),i)};var j=/\/(java|ecma)script/i,w=e.fn.andSelf||e.fn.addBack;e.fn.andSelf=function(){return r("jQuery.fn.andSelf() replaced by jQuery.fn.addBack()"),w.apply(this,arguments)},e.clean||(e.clean=function(t,a,i,o){a=a||document,a=!a.nodeType&&a[0]||a,a=a.ownerDocument||a,r("jQuery.clean() is deprecated");var s,u,c,l,d=[];if(e.merge(d,e.buildFragment(t,a).childNodes),i)for(c=function(e){return!e.type||j.test(e.type)?o?o.push(e.parentNode?e.parentNode.removeChild(e):e):i.appendChild(e):n},s=0;null!=(u=d[s]);s++)e.nodeName(u,"script")&&c(u)||(i.appendChild(u),u.getElementsByTagName!==n&&(l=e.grep(e.merge([],u.getElementsByTagName("script")),c),d.splice.apply(d,[s+1,0].concat(l)),s+=l.length));return d});var Q=e.event.add,x=e.event.remove,k=e.event.trigger,N=e.fn.toggle,T=e.fn.live,M=e.fn.die,S="ajaxStart|ajaxStop|ajaxSend|ajaxComplete|ajaxError|ajaxSuccess",C=RegExp("\\b(?:"+S+")\\b"),H=/(?:^|\s)hover(\.\S+|)\b/,A=function(t){return"string"!=typeof t||e.event.special.hover?t:(H.test(t)&&r("'hover' pseudo-event is deprecated, use 'mouseenter mouseleave'"),t&&t.replace(H,"mouseenter$1 mouseleave$1"))};e.event.props&&"attrChange"!==e.event.props[0]&&e.event.props.unshift("attrChange","attrName","relatedNode","srcElement"),e.event.dispatch&&a(e.event,"handle",e.event.dispatch,"jQuery.event.handle is undocumented and deprecated"),e.event.add=function(e,t,n,a,i){e!==document&&C.test(t)&&r("AJAX events should be attached to document: "+t),Q.call(this,e,A(t||""),n,a,i)},e.event.remove=function(e,t,n,r,a){x.call(this,e,A(t)||"",n,r,a)},e.fn.error=function(){var e=Array.prototype.slice.call(arguments,0);return r("jQuery.fn.error() is deprecated"),e.splice(0,0,"error"),arguments.length?this.bind.apply(this,e):(this.triggerHandler.apply(this,e),this)},e.fn.toggle=function(t,n){if(!e.isFunction(t)||!e.isFunction(n))return N.apply(this,arguments);r("jQuery.fn.toggle(handler, handler...) is deprecated");var a=arguments,i=t.guid||e.guid++,o=0,s=function(n){var r=(e._data(this,"lastToggle"+t.guid)||0)%o;return e._data(this,"lastToggle"+t.guid,r+1),n.preventDefault(),a[r].apply(this,arguments)||!1};for(s.guid=i;a.length>o;)a[o++].guid=i;return this.click(s)},e.fn.live=function(t,n,a){return r("jQuery.fn.live() is deprecated"),T?T.apply(this,arguments):(e(this.context).on(t,this.selector,n,a),this)},e.fn.die=function(t,n){return r("jQuery.fn.die() is deprecated"),M?M.apply(this,arguments):(e(this.context).off(t,this.selector||"**",n),this)},e.event.trigger=function(e,t,n,a){return n||C.test(e)||r("Global events are undocumented and deprecated"),k.call(this,e,t,n||document,a)},e.each(S.split("|"),function(t,n){e.event.special[n]={setup:function(){var t=this;return t!==document&&(e.event.add(document,n+"."+e.guid,function(){e.event.trigger(n,null,t,!0)}),e._data(this,n,e.guid++)),!1},teardown:function(){return this!==document&&e.event.remove(document,n+"."+e._data(this,n)),!1}}})}(jQuery,window);
/*! jQuery UI - v1.10.3 - 2013-10-10
* http://jqueryui.com
* Includes: jquery.ui.core.js, jquery.ui.widget.js, jquery.ui.mouse.js, jquery.ui.position.js, jquery.ui.draggable.js, jquery.ui.resizable.js, jquery.ui.button.js, jquery.ui.datepicker.js, jquery.ui.dialog.js, jquery.ui.tabs.js, jquery.ui.effect.js, jquery.ui.effect-blind.js
* Copyright 2013 jQuery Foundation and other contributors; Licensed MIT */

(function(t,e){function n(e,n){var r,s,o,a=e.nodeName.toLowerCase();return"area"===a?(r=e.parentNode,s=r.name,e.href&&s&&"map"===r.nodeName.toLowerCase()?(o=t("img[usemap=#"+s+"]")[0],!!o&&i(o)):!1):(/input|select|textarea|button|object/.test(a)?!e.disabled:"a"===a?e.href||n:n)&&i(e)}function i(e){return t.expr.filters.visible(e)&&!t(e).parents().addBack().filter(function(){return"hidden"===t.css(this,"visibility")}).length}var r=0,s=/^ui-id-\d+$/;t.ui=t.ui||{},t.extend(t.ui,{version:"1.10.3",keyCode:{BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38}}),t.fn.extend({focus:function(e){return function(n,i){return"number"==typeof n?this.each(function(){var e=this;setTimeout(function(){t(e).focus(),i&&i.call(e)},n)}):e.apply(this,arguments)}}(t.fn.focus),scrollParent:function(){var e;return e=t.ui.ie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?this.parents().filter(function(){return/(relative|absolute|fixed)/.test(t.css(this,"position"))&&/(auto|scroll)/.test(t.css(this,"overflow")+t.css(this,"overflow-y")+t.css(this,"overflow-x"))}).eq(0):this.parents().filter(function(){return/(auto|scroll)/.test(t.css(this,"overflow")+t.css(this,"overflow-y")+t.css(this,"overflow-x"))}).eq(0),/fixed/.test(this.css("position"))||!e.length?t(document):e},zIndex:function(n){if(n!==e)return this.css("zIndex",n);if(this.length)for(var i,r,s=t(this[0]);s.length&&s[0]!==document;){if(i=s.css("position"),("absolute"===i||"relative"===i||"fixed"===i)&&(r=parseInt(s.css("zIndex"),10),!isNaN(r)&&0!==r))return r;s=s.parent()}return 0},uniqueId:function(){return this.each(function(){this.id||(this.id="ui-id-"+ ++r)})},removeUniqueId:function(){return this.each(function(){s.test(this.id)&&t(this).removeAttr("id")})}}),t.extend(t.expr[":"],{data:t.expr.createPseudo?t.expr.createPseudo(function(e){return function(n){return!!t.data(n,e)}}):function(e,n,i){return!!t.data(e,i[3])},focusable:function(e){return n(e,!isNaN(t.attr(e,"tabindex")))},tabbable:function(e){var i=t.attr(e,"tabindex"),r=isNaN(i);return(r||i>=0)&&n(e,!r)}}),t("<a>").outerWidth(1).jquery||t.each(["Width","Height"],function(n,i){function r(e,n,i,r){return t.each(s,function(){n-=parseFloat(t.css(e,"padding"+this))||0,i&&(n-=parseFloat(t.css(e,"border"+this+"Width"))||0),r&&(n-=parseFloat(t.css(e,"margin"+this))||0)}),n}var s="Width"===i?["Left","Right"]:["Top","Bottom"],o=i.toLowerCase(),a={innerWidth:t.fn.innerWidth,innerHeight:t.fn.innerHeight,outerWidth:t.fn.outerWidth,outerHeight:t.fn.outerHeight};t.fn["inner"+i]=function(n){return n===e?a["inner"+i].call(this):this.each(function(){t(this).css(o,r(this,n)+"px")})},t.fn["outer"+i]=function(e,n){return"number"!=typeof e?a["outer"+i].call(this,e):this.each(function(){t(this).css(o,r(this,e,!0,n)+"px")})}}),t.fn.addBack||(t.fn.addBack=function(t){return this.add(null==t?this.prevObject:this.prevObject.filter(t))}),t("<a>").data("a-b","a").removeData("a-b").data("a-b")&&(t.fn.removeData=function(e){return function(n){return arguments.length?e.call(this,t.camelCase(n)):e.call(this)}}(t.fn.removeData)),t.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()),t.support.selectstart="onselectstart"in document.createElement("div"),t.fn.extend({disableSelection:function(){return this.bind((t.support.selectstart?"selectstart":"mousedown")+".ui-disableSelection",function(t){t.preventDefault()})},enableSelection:function(){return this.unbind(".ui-disableSelection")}}),t.extend(t.ui,{plugin:{add:function(e,n,i){var r,s=t.ui[e].prototype;for(r in i)s.plugins[r]=s.plugins[r]||[],s.plugins[r].push([n,i[r]])},call:function(t,e,n){var i,r=t.plugins[e];if(r&&t.element[0].parentNode&&11!==t.element[0].parentNode.nodeType)for(i=0;r.length>i;i++)t.options[r[i][0]]&&r[i][1].apply(t.element,n)}},hasScroll:function(e,n){if("hidden"===t(e).css("overflow"))return!1;var i=n&&"left"===n?"scrollLeft":"scrollTop",r=!1;return e[i]>0?!0:(e[i]=1,r=e[i]>0,e[i]=0,r)}})})(jQuery);(function(t,e){var i=0,a=Array.prototype.slice,n=t.cleanData;t.cleanData=function(e){for(var i,a=0;null!=(i=e[a]);a++)try{t(i).triggerHandler("remove")}catch(s){}n(e)},t.widget=function(i,a,n){var s,r,o,l,c={},d=i.split(".")[0];i=i.split(".")[1],s=d+"-"+i,n||(n=a,a=t.Widget),t.expr[":"][s.toLowerCase()]=function(e){return!!t.data(e,s)},t[d]=t[d]||{},r=t[d][i],o=t[d][i]=function(t,i){return this._createWidget?(arguments.length&&this._createWidget(t,i),e):new o(t,i)},t.extend(o,r,{version:n.version,_proto:t.extend({},n),_childConstructors:[]}),l=new a,l.options=t.widget.extend({},l.options),t.each(n,function(i,n){return t.isFunction(n)?(c[i]=function(){var t=function(){return a.prototype[i].apply(this,arguments)},e=function(t){return a.prototype[i].apply(this,t)};return function(){var i,a=this._super,s=this._superApply;return this._super=t,this._superApply=e,i=n.apply(this,arguments),this._super=a,this._superApply=s,i}}(),e):(c[i]=n,e)}),o.prototype=t.widget.extend(l,{widgetEventPrefix:r?l.widgetEventPrefix:i},c,{constructor:o,namespace:d,widgetName:i,widgetFullName:s}),r?(t.each(r._childConstructors,function(e,i){var a=i.prototype;t.widget(a.namespace+"."+a.widgetName,o,i._proto)}),delete r._childConstructors):a._childConstructors.push(o),t.widget.bridge(i,o)},t.widget.extend=function(i){for(var n,s,r=a.call(arguments,1),o=0,l=r.length;l>o;o++)for(n in r[o])s=r[o][n],r[o].hasOwnProperty(n)&&s!==e&&(i[n]=t.isPlainObject(s)?t.isPlainObject(i[n])?t.widget.extend({},i[n],s):t.widget.extend({},s):s);return i},t.widget.bridge=function(i,n){var s=n.prototype.widgetFullName||i;t.fn[i]=function(r){var o="string"==typeof r,l=a.call(arguments,1),c=this;return r=!o&&l.length?t.widget.extend.apply(null,[r].concat(l)):r,o?this.each(function(){var a,n=t.data(this,s);return n?t.isFunction(n[r])&&"_"!==r.charAt(0)?(a=n[r].apply(n,l),a!==n&&a!==e?(c=a&&a.jquery?c.pushStack(a.get()):a,!1):e):t.error("no such method '"+r+"' for "+i+" widget instance"):t.error("cannot call methods on "+i+" prior to initialization; "+"attempted to call method '"+r+"'")}):this.each(function(){var e=t.data(this,s);e?e.option(r||{})._init():t.data(this,s,new n(r,this))}),c}},t.Widget=function(){},t.Widget._childConstructors=[],t.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{disabled:!1,create:null},_createWidget:function(e,a){a=t(a||this.defaultElement||this)[0],this.element=t(a),this.uuid=i++,this.eventNamespace="."+this.widgetName+this.uuid,this.options=t.widget.extend({},this.options,this._getCreateOptions(),e),this.bindings=t(),this.hoverable=t(),this.focusable=t(),a!==this&&(t.data(a,this.widgetFullName,this),this._on(!0,this.element,{remove:function(t){t.target===a&&this.destroy()}}),this.document=t(a.style?a.ownerDocument:a.document||a),this.window=t(this.document[0].defaultView||this.document[0].parentWindow)),this._create(),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:t.noop,_getCreateEventData:t.noop,_create:t.noop,_init:t.noop,destroy:function(){this._destroy(),this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(t.camelCase(this.widgetFullName)),this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName+"-disabled "+"ui-state-disabled"),this.bindings.unbind(this.eventNamespace),this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus")},_destroy:t.noop,widget:function(){return this.element},option:function(i,a){var n,s,r,o=i;if(0===arguments.length)return t.widget.extend({},this.options);if("string"==typeof i)if(o={},n=i.split("."),i=n.shift(),n.length){for(s=o[i]=t.widget.extend({},this.options[i]),r=0;n.length-1>r;r++)s[n[r]]=s[n[r]]||{},s=s[n[r]];if(i=n.pop(),a===e)return s[i]===e?null:s[i];s[i]=a}else{if(a===e)return this.options[i]===e?null:this.options[i];o[i]=a}return this._setOptions(o),this},_setOptions:function(t){var e;for(e in t)this._setOption(e,t[e]);return this},_setOption:function(t,e){return this.options[t]=e,"disabled"===t&&(this.widget().toggleClass(this.widgetFullName+"-disabled ui-state-disabled",!!e).attr("aria-disabled",e),this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus")),this},enable:function(){return this._setOption("disabled",!1)},disable:function(){return this._setOption("disabled",!0)},_on:function(i,a,n){var s,r=this;"boolean"!=typeof i&&(n=a,a=i,i=!1),n?(a=s=t(a),this.bindings=this.bindings.add(a)):(n=a,a=this.element,s=this.widget()),t.each(n,function(n,o){function l(){return i||r.options.disabled!==!0&&!t(this).hasClass("ui-state-disabled")?("string"==typeof o?r[o]:o).apply(r,arguments):e}"string"!=typeof o&&(l.guid=o.guid=o.guid||l.guid||t.guid++);var c=n.match(/^(\w+)\s*(.*)$/),d=c[1]+r.eventNamespace,h=c[2];h?s.delegate(h,d,l):a.bind(d,l)})},_off:function(t,e){e=(e||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,t.unbind(e).undelegate(e)},_delay:function(t,e){function i(){return("string"==typeof t?a[t]:t).apply(a,arguments)}var a=this;return setTimeout(i,e||0)},_hoverable:function(e){this.hoverable=this.hoverable.add(e),this._on(e,{mouseenter:function(e){t(e.currentTarget).addClass("ui-state-hover")},mouseleave:function(e){t(e.currentTarget).removeClass("ui-state-hover")}})},_focusable:function(e){this.focusable=this.focusable.add(e),this._on(e,{focusin:function(e){t(e.currentTarget).addClass("ui-state-focus")},focusout:function(e){t(e.currentTarget).removeClass("ui-state-focus")}})},_trigger:function(e,i,a){var n,s,r=this.options[e];if(a=a||{},i=t.Event(i),i.type=(e===this.widgetEventPrefix?e:this.widgetEventPrefix+e).toLowerCase(),i.target=this.element[0],s=i.originalEvent)for(n in s)n in i||(i[n]=s[n]);return this.element.trigger(i,a),!(t.isFunction(r)&&r.apply(this.element[0],[i].concat(a))===!1||i.isDefaultPrevented())}},t.each({show:"fadeIn",hide:"fadeOut"},function(e,i){t.Widget.prototype["_"+e]=function(a,n,s){"string"==typeof n&&(n={effect:n});var r,o=n?n===!0||"number"==typeof n?i:n.effect||i:e;n=n||{},"number"==typeof n&&(n={duration:n}),r=!t.isEmptyObject(n),n.complete=s,n.delay&&a.delay(n.delay),r&&t.effects&&t.effects.effect[o]?a[e](n):o!==e&&a[o]?a[o](n.duration,n.easing,s):a.queue(function(i){t(this)[e](),s&&s.call(a[0]),i()})}})})(jQuery);(function(e){var t=!1;e(document).mouseup(function(){t=!1}),e.widget("ui.mouse",{version:"1.10.3",options:{cancel:"input,textarea,button,select,option",distance:1,delay:0},_mouseInit:function(){var t=this;this.element.bind("mousedown."+this.widgetName,function(e){return t._mouseDown(e)}).bind("click."+this.widgetName,function(a){return!0===e.data(a.target,t.widgetName+".preventClickEvent")?(e.removeData(a.target,t.widgetName+".preventClickEvent"),a.stopImmediatePropagation(),!1):undefined}),this.started=!1},_mouseDestroy:function(){this.element.unbind("."+this.widgetName),this._mouseMoveDelegate&&e(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate)},_mouseDown:function(a){if(!t){this._mouseStarted&&this._mouseUp(a),this._mouseDownEvent=a;var i=this,r=1===a.which,n="string"==typeof this.options.cancel&&a.target.nodeName?e(a.target).closest(this.options.cancel).length:!1;return r&&!n&&this._mouseCapture(a)?(this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){i.mouseDelayMet=!0},this.options.delay)),this._mouseDistanceMet(a)&&this._mouseDelayMet(a)&&(this._mouseStarted=this._mouseStart(a)!==!1,!this._mouseStarted)?(a.preventDefault(),!0):(!0===e.data(a.target,this.widgetName+".preventClickEvent")&&e.removeData(a.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(e){return i._mouseMove(e)},this._mouseUpDelegate=function(e){return i._mouseUp(e)},e(document).bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate),a.preventDefault(),t=!0,!0)):!0}},_mouseMove:function(t){return e.ui.ie&&(!document.documentMode||9>document.documentMode)&&!t.button?this._mouseUp(t):this._mouseStarted?(this._mouseDrag(t),t.preventDefault()):(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=this._mouseStart(this._mouseDownEvent,t)!==!1,this._mouseStarted?this._mouseDrag(t):this._mouseUp(t)),!this._mouseStarted)},_mouseUp:function(t){return e(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,t.target===this._mouseDownEvent.target&&e.data(t.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(t)),!1},_mouseDistanceMet:function(e){return Math.max(Math.abs(this._mouseDownEvent.pageX-e.pageX),Math.abs(this._mouseDownEvent.pageY-e.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return!0}})})(jQuery);(function(t,e){function i(t,e,i){return[parseFloat(t[0])*(p.test(t[0])?e/100:1),parseFloat(t[1])*(p.test(t[1])?i/100:1)]}function a(e,i){return parseInt(t.css(e,i),10)||0}function n(e){var i=e[0];return 9===i.nodeType?{width:e.width(),height:e.height(),offset:{top:0,left:0}}:t.isWindow(i)?{width:e.width(),height:e.height(),offset:{top:e.scrollTop(),left:e.scrollLeft()}}:i.preventDefault?{width:0,height:0,offset:{top:i.pageY,left:i.pageX}}:{width:e.outerWidth(),height:e.outerHeight(),offset:e.offset()}}t.ui=t.ui||{};var s,r=Math.max,o=Math.abs,l=Math.round,c=/left|center|right/,d=/top|center|bottom/,h=/[\+\-]\d+(\.[\d]+)?%?/,u=/^\w+/,p=/%$/,g=t.fn.position;t.position={scrollbarWidth:function(){if(s!==e)return s;var i,a,n=t("<div style='display:block;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),r=n.children()[0];return t("body").append(n),i=r.offsetWidth,n.css("overflow","scroll"),a=r.offsetWidth,i===a&&(a=n[0].clientWidth),n.remove(),s=i-a},getScrollInfo:function(e){var i=e.isWindow?"":e.element.css("overflow-x"),a=e.isWindow?"":e.element.css("overflow-y"),n="scroll"===i||"auto"===i&&e.width<e.element[0].scrollWidth,s="scroll"===a||"auto"===a&&e.height<e.element[0].scrollHeight;return{width:s?t.position.scrollbarWidth():0,height:n?t.position.scrollbarWidth():0}},getWithinInfo:function(e){var i=t(e||window),a=t.isWindow(i[0]);return{element:i,isWindow:a,offset:i.offset()||{left:0,top:0},scrollLeft:i.scrollLeft(),scrollTop:i.scrollTop(),width:a?i.width():i.outerWidth(),height:a?i.height():i.outerHeight()}}},t.fn.position=function(e){if(!e||!e.of)return g.apply(this,arguments);e=t.extend({},e);var s,p,f,_,m,D,k=t(e.of),y=t.position.getWithinInfo(e.within),v=t.position.getScrollInfo(y),w=(e.collision||"flip").split(" "),b={};return D=n(k),k[0].preventDefault&&(e.at="left top"),p=D.width,f=D.height,_=D.offset,m=t.extend({},_),t.each(["my","at"],function(){var t,i,a=(e[this]||"").split(" ");1===a.length&&(a=c.test(a[0])?a.concat(["center"]):d.test(a[0])?["center"].concat(a):["center","center"]),a[0]=c.test(a[0])?a[0]:"center",a[1]=d.test(a[1])?a[1]:"center",t=h.exec(a[0]),i=h.exec(a[1]),b[this]=[t?t[0]:0,i?i[0]:0],e[this]=[u.exec(a[0])[0],u.exec(a[1])[0]]}),1===w.length&&(w[1]=w[0]),"right"===e.at[0]?m.left+=p:"center"===e.at[0]&&(m.left+=p/2),"bottom"===e.at[1]?m.top+=f:"center"===e.at[1]&&(m.top+=f/2),s=i(b.at,p,f),m.left+=s[0],m.top+=s[1],this.each(function(){var n,c,d=t(this),h=d.outerWidth(),u=d.outerHeight(),g=a(this,"marginLeft"),D=a(this,"marginTop"),M=h+g+a(this,"marginRight")+v.width,x=u+D+a(this,"marginBottom")+v.height,C=t.extend({},m),I=i(b.my,d.outerWidth(),d.outerHeight());"right"===e.my[0]?C.left-=h:"center"===e.my[0]&&(C.left-=h/2),"bottom"===e.my[1]?C.top-=u:"center"===e.my[1]&&(C.top-=u/2),C.left+=I[0],C.top+=I[1],t.support.offsetFractions||(C.left=l(C.left),C.top=l(C.top)),n={marginLeft:g,marginTop:D},t.each(["left","top"],function(i,a){t.ui.position[w[i]]&&t.ui.position[w[i]][a](C,{targetWidth:p,targetHeight:f,elemWidth:h,elemHeight:u,collisionPosition:n,collisionWidth:M,collisionHeight:x,offset:[s[0]+I[0],s[1]+I[1]],my:e.my,at:e.at,within:y,elem:d})}),e.using&&(c=function(t){var i=_.left-C.left,a=i+p-h,n=_.top-C.top,s=n+f-u,l={target:{element:k,left:_.left,top:_.top,width:p,height:f},element:{element:d,left:C.left,top:C.top,width:h,height:u},horizontal:0>a?"left":i>0?"right":"center",vertical:0>s?"top":n>0?"bottom":"middle"};h>p&&p>o(i+a)&&(l.horizontal="center"),u>f&&f>o(n+s)&&(l.vertical="middle"),l.important=r(o(i),o(a))>r(o(n),o(s))?"horizontal":"vertical",e.using.call(this,t,l)}),d.offset(t.extend(C,{using:c}))})},t.ui.position={fit:{left:function(t,e){var i,a=e.within,n=a.isWindow?a.scrollLeft:a.offset.left,s=a.width,o=t.left-e.collisionPosition.marginLeft,l=n-o,c=o+e.collisionWidth-s-n;e.collisionWidth>s?l>0&&0>=c?(i=t.left+l+e.collisionWidth-s-n,t.left+=l-i):t.left=c>0&&0>=l?n:l>c?n+s-e.collisionWidth:n:l>0?t.left+=l:c>0?t.left-=c:t.left=r(t.left-o,t.left)},top:function(t,e){var i,a=e.within,n=a.isWindow?a.scrollTop:a.offset.top,s=e.within.height,o=t.top-e.collisionPosition.marginTop,l=n-o,c=o+e.collisionHeight-s-n;e.collisionHeight>s?l>0&&0>=c?(i=t.top+l+e.collisionHeight-s-n,t.top+=l-i):t.top=c>0&&0>=l?n:l>c?n+s-e.collisionHeight:n:l>0?t.top+=l:c>0?t.top-=c:t.top=r(t.top-o,t.top)}},flip:{left:function(t,e){var i,a,n=e.within,s=n.offset.left+n.scrollLeft,r=n.width,l=n.isWindow?n.scrollLeft:n.offset.left,c=t.left-e.collisionPosition.marginLeft,d=c-l,h=c+e.collisionWidth-r-l,u="left"===e.my[0]?-e.elemWidth:"right"===e.my[0]?e.elemWidth:0,p="left"===e.at[0]?e.targetWidth:"right"===e.at[0]?-e.targetWidth:0,g=-2*e.offset[0];0>d?(i=t.left+u+p+g+e.collisionWidth-r-s,(0>i||o(d)>i)&&(t.left+=u+p+g)):h>0&&(a=t.left-e.collisionPosition.marginLeft+u+p+g-l,(a>0||h>o(a))&&(t.left+=u+p+g))},top:function(t,e){var i,a,n=e.within,s=n.offset.top+n.scrollTop,r=n.height,l=n.isWindow?n.scrollTop:n.offset.top,c=t.top-e.collisionPosition.marginTop,d=c-l,h=c+e.collisionHeight-r-l,u="top"===e.my[1],p=u?-e.elemHeight:"bottom"===e.my[1]?e.elemHeight:0,g="top"===e.at[1]?e.targetHeight:"bottom"===e.at[1]?-e.targetHeight:0,f=-2*e.offset[1];0>d?(a=t.top+p+g+f+e.collisionHeight-r-s,t.top+p+g+f>d&&(0>a||o(d)>a)&&(t.top+=p+g+f)):h>0&&(i=t.top-e.collisionPosition.marginTop+p+g+f-l,t.top+p+g+f>h&&(i>0||h>o(i))&&(t.top+=p+g+f))}},flipfit:{left:function(){t.ui.position.flip.left.apply(this,arguments),t.ui.position.fit.left.apply(this,arguments)},top:function(){t.ui.position.flip.top.apply(this,arguments),t.ui.position.fit.top.apply(this,arguments)}}},function(){var e,i,a,n,s,r=document.getElementsByTagName("body")[0],o=document.createElement("div");e=document.createElement(r?"div":"body"),a={visibility:"hidden",width:0,height:0,border:0,margin:0,background:"none"},r&&t.extend(a,{position:"absolute",left:"-1000px",top:"-1000px"});for(s in a)e.style[s]=a[s];e.appendChild(o),i=r||document.documentElement,i.insertBefore(e,i.firstChild),o.style.cssText="position: absolute; left: 10.7432222px;",n=t(o).offset().left,t.support.offsetFractions=n>10&&11>n,e.innerHTML="",i.removeChild(e)}()})(jQuery);(function(e){e.widget("ui.draggable",e.ui.mouse,{version:"1.10.3",widgetEventPrefix:"drag",options:{addClasses:!0,appendTo:"parent",axis:!1,connectToSortable:!1,containment:!1,cursor:"auto",cursorAt:!1,grid:!1,handle:!1,helper:"original",iframeFix:!1,opacity:!1,refreshPositions:!1,revert:!1,revertDuration:500,scope:"default",scroll:!0,scrollSensitivity:20,scrollSpeed:20,snap:!1,snapMode:"both",snapTolerance:20,stack:!1,zIndex:!1,drag:null,start:null,stop:null},_create:function(){"original"!==this.options.helper||/^(?:r|a|f)/.test(this.element.css("position"))||(this.element[0].style.position="relative"),this.options.addClasses&&this.element.addClass("ui-draggable"),this.options.disabled&&this.element.addClass("ui-draggable-disabled"),this._mouseInit()},_destroy:function(){this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"),this._mouseDestroy()},_mouseCapture:function(t){var a=this.options;return this.helper||a.disabled||e(t.target).closest(".ui-resizable-handle").length>0?!1:(this.handle=this._getHandle(t),this.handle?(e(a.iframeFix===!0?"iframe":a.iframeFix).each(function(){e("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({width:this.offsetWidth+"px",height:this.offsetHeight+"px",position:"absolute",opacity:"0.001",zIndex:1e3}).css(e(this).offset()).appendTo("body")}),!0):!1)},_mouseStart:function(t){var a=this.options;return this.helper=this._createHelper(t),this.helper.addClass("ui-draggable-dragging"),this._cacheHelperProportions(),e.ui.ddmanager&&(e.ui.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(),this.offsetParent=this.helper.offsetParent(),this.offsetParentCssPosition=this.offsetParent.css("position"),this.offset=this.positionAbs=this.element.offset(),this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left},this.offset.scroll=!1,e.extend(this.offset,{click:{left:t.pageX-this.offset.left,top:t.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()}),this.originalPosition=this.position=this._generatePosition(t),this.originalPageX=t.pageX,this.originalPageY=t.pageY,a.cursorAt&&this._adjustOffsetFromHelper(a.cursorAt),this._setContainment(),this._trigger("start",t)===!1?(this._clear(),!1):(this._cacheHelperProportions(),e.ui.ddmanager&&!a.dropBehaviour&&e.ui.ddmanager.prepareOffsets(this,t),this._mouseDrag(t,!0),e.ui.ddmanager&&e.ui.ddmanager.dragStart(this,t),!0)},_mouseDrag:function(t,a){if("fixed"===this.offsetParentCssPosition&&(this.offset.parent=this._getParentOffset()),this.position=this._generatePosition(t),this.positionAbs=this._convertPositionTo("absolute"),!a){var i=this._uiHash();if(this._trigger("drag",t,i)===!1)return this._mouseUp({}),!1;this.position=i.position}return this.options.axis&&"y"===this.options.axis||(this.helper[0].style.left=this.position.left+"px"),this.options.axis&&"x"===this.options.axis||(this.helper[0].style.top=this.position.top+"px"),e.ui.ddmanager&&e.ui.ddmanager.drag(this,t),!1},_mouseStop:function(t){var a=this,i=!1;return e.ui.ddmanager&&!this.options.dropBehaviour&&(i=e.ui.ddmanager.drop(this,t)),this.dropped&&(i=this.dropped,this.dropped=!1),"original"!==this.options.helper||e.contains(this.element[0].ownerDocument,this.element[0])?("invalid"===this.options.revert&&!i||"valid"===this.options.revert&&i||this.options.revert===!0||e.isFunction(this.options.revert)&&this.options.revert.call(this.element,i)?e(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){a._trigger("stop",t)!==!1&&a._clear()}):this._trigger("stop",t)!==!1&&this._clear(),!1):!1},_mouseUp:function(t){return e("div.ui-draggable-iframeFix").each(function(){this.parentNode.removeChild(this)}),e.ui.ddmanager&&e.ui.ddmanager.dragStop(this,t),e.ui.mouse.prototype._mouseUp.call(this,t)},cancel:function(){return this.helper.is(".ui-draggable-dragging")?this._mouseUp({}):this._clear(),this},_getHandle:function(t){return this.options.handle?!!e(t.target).closest(this.element.find(this.options.handle)).length:!0},_createHelper:function(t){var a=this.options,i=e.isFunction(a.helper)?e(a.helper.apply(this.element[0],[t])):"clone"===a.helper?this.element.clone().removeAttr("id"):this.element;return i.parents("body").length||i.appendTo("parent"===a.appendTo?this.element[0].parentNode:a.appendTo),i[0]===this.element[0]||/(fixed|absolute)/.test(i.css("position"))||i.css("position","absolute"),i},_adjustOffsetFromHelper:function(t){"string"==typeof t&&(t=t.split(" ")),e.isArray(t)&&(t={left:+t[0],top:+t[1]||0}),"left"in t&&(this.offset.click.left=t.left+this.margins.left),"right"in t&&(this.offset.click.left=this.helperProportions.width-t.right+this.margins.left),"top"in t&&(this.offset.click.top=t.top+this.margins.top),"bottom"in t&&(this.offset.click.top=this.helperProportions.height-t.bottom+this.margins.top)},_getParentOffset:function(){var t=this.offsetParent.offset();return"absolute"===this.cssPosition&&this.scrollParent[0]!==document&&e.contains(this.scrollParent[0],this.offsetParent[0])&&(t.left+=this.scrollParent.scrollLeft(),t.top+=this.scrollParent.scrollTop()),(this.offsetParent[0]===document.body||this.offsetParent[0].tagName&&"html"===this.offsetParent[0].tagName.toLowerCase()&&e.ui.ie)&&(t={top:0,left:0}),{top:t.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if("relative"===this.cssPosition){var e=this.element.position();return{top:e.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:e.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0,right:parseInt(this.element.css("marginRight"),10)||0,bottom:parseInt(this.element.css("marginBottom"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var t,a,i,r=this.options;return r.containment?"window"===r.containment?(this.containment=[e(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,e(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,e(window).scrollLeft()+e(window).width()-this.helperProportions.width-this.margins.left,e(window).scrollTop()+(e(window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top],undefined):"document"===r.containment?(this.containment=[0,0,e(document).width()-this.helperProportions.width-this.margins.left,(e(document).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top],undefined):r.containment.constructor===Array?(this.containment=r.containment,undefined):("parent"===r.containment&&(r.containment=this.helper[0].parentNode),a=e(r.containment),i=a[0],i&&(t="hidden"!==a.css("overflow"),this.containment=[(parseInt(a.css("borderLeftWidth"),10)||0)+(parseInt(a.css("paddingLeft"),10)||0),(parseInt(a.css("borderTopWidth"),10)||0)+(parseInt(a.css("paddingTop"),10)||0),(t?Math.max(i.scrollWidth,i.offsetWidth):i.offsetWidth)-(parseInt(a.css("borderRightWidth"),10)||0)-(parseInt(a.css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(t?Math.max(i.scrollHeight,i.offsetHeight):i.offsetHeight)-(parseInt(a.css("borderBottomWidth"),10)||0)-(parseInt(a.css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relative_container=a),undefined):(this.containment=null,undefined)},_convertPositionTo:function(t,a){a||(a=this.position);var i="absolute"===t?1:-1,r="absolute"!==this.cssPosition||this.scrollParent[0]!==document&&e.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent;return this.offset.scroll||(this.offset.scroll={top:r.scrollTop(),left:r.scrollLeft()}),{top:a.top+this.offset.relative.top*i+this.offset.parent.top*i-("fixed"===this.cssPosition?-this.scrollParent.scrollTop():this.offset.scroll.top)*i,left:a.left+this.offset.relative.left*i+this.offset.parent.left*i-("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():this.offset.scroll.left)*i}},_generatePosition:function(t){var a,i,r,n,s=this.options,o="absolute"!==this.cssPosition||this.scrollParent[0]!==document&&e.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,d=t.pageX,u=t.pageY;return this.offset.scroll||(this.offset.scroll={top:o.scrollTop(),left:o.scrollLeft()}),this.originalPosition&&(this.containment&&(this.relative_container?(i=this.relative_container.offset(),a=[this.containment[0]+i.left,this.containment[1]+i.top,this.containment[2]+i.left,this.containment[3]+i.top]):a=this.containment,t.pageX-this.offset.click.left<a[0]&&(d=a[0]+this.offset.click.left),t.pageY-this.offset.click.top<a[1]&&(u=a[1]+this.offset.click.top),t.pageX-this.offset.click.left>a[2]&&(d=a[2]+this.offset.click.left),t.pageY-this.offset.click.top>a[3]&&(u=a[3]+this.offset.click.top)),s.grid&&(r=s.grid[1]?this.originalPageY+Math.round((u-this.originalPageY)/s.grid[1])*s.grid[1]:this.originalPageY,u=a?r-this.offset.click.top>=a[1]||r-this.offset.click.top>a[3]?r:r-this.offset.click.top>=a[1]?r-s.grid[1]:r+s.grid[1]:r,n=s.grid[0]?this.originalPageX+Math.round((d-this.originalPageX)/s.grid[0])*s.grid[0]:this.originalPageX,d=a?n-this.offset.click.left>=a[0]||n-this.offset.click.left>a[2]?n:n-this.offset.click.left>=a[0]?n-s.grid[0]:n+s.grid[0]:n)),{top:u-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+("fixed"===this.cssPosition?-this.scrollParent.scrollTop():this.offset.scroll.top),left:d-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():this.offset.scroll.left)}},_clear:function(){this.helper.removeClass("ui-draggable-dragging"),this.helper[0]===this.element[0]||this.cancelHelperRemoval||this.helper.remove(),this.helper=null,this.cancelHelperRemoval=!1},_trigger:function(t,a,i){return i=i||this._uiHash(),e.ui.plugin.call(this,t,[a,i]),"drag"===t&&(this.positionAbs=this._convertPositionTo("absolute")),e.Widget.prototype._trigger.call(this,t,a,i)},plugins:{},_uiHash:function(){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}}),e.ui.plugin.add("draggable","connectToSortable",{start:function(t,a){var i=e(this).data("ui-draggable"),r=i.options,n=e.extend({},a,{item:i.element});i.sortables=[],e(r.connectToSortable).each(function(){var a=e.data(this,"ui-sortable");a&&!a.options.disabled&&(i.sortables.push({instance:a,shouldRevert:a.options.revert}),a.refreshPositions(),a._trigger("activate",t,n))})},stop:function(t,a){var i=e(this).data("ui-draggable"),r=e.extend({},a,{item:i.element});e.each(i.sortables,function(){this.instance.isOver?(this.instance.isOver=0,i.cancelHelperRemoval=!0,this.instance.cancelHelperRemoval=!1,this.shouldRevert&&(this.instance.options.revert=this.shouldRevert),this.instance._mouseStop(t),this.instance.options.helper=this.instance.options._helper,"original"===i.options.helper&&this.instance.currentItem.css({top:"auto",left:"auto"})):(this.instance.cancelHelperRemoval=!1,this.instance._trigger("deactivate",t,r))})},drag:function(t,a){var i=e(this).data("ui-draggable"),r=this;e.each(i.sortables,function(){var n=!1,s=this;this.instance.positionAbs=i.positionAbs,this.instance.helperProportions=i.helperProportions,this.instance.offset.click=i.offset.click,this.instance._intersectsWith(this.instance.containerCache)&&(n=!0,e.each(i.sortables,function(){return this.instance.positionAbs=i.positionAbs,this.instance.helperProportions=i.helperProportions,this.instance.offset.click=i.offset.click,this!==s&&this.instance._intersectsWith(this.instance.containerCache)&&e.contains(s.instance.element[0],this.instance.element[0])&&(n=!1),n})),n?(this.instance.isOver||(this.instance.isOver=1,this.instance.currentItem=e(r).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item",!0),this.instance.options._helper=this.instance.options.helper,this.instance.options.helper=function(){return a.helper[0]},t.target=this.instance.currentItem[0],this.instance._mouseCapture(t,!0),this.instance._mouseStart(t,!0,!0),this.instance.offset.click.top=i.offset.click.top,this.instance.offset.click.left=i.offset.click.left,this.instance.offset.parent.left-=i.offset.parent.left-this.instance.offset.parent.left,this.instance.offset.parent.top-=i.offset.parent.top-this.instance.offset.parent.top,i._trigger("toSortable",t),i.dropped=this.instance.element,i.currentItem=i.element,this.instance.fromOutside=i),this.instance.currentItem&&this.instance._mouseDrag(t)):this.instance.isOver&&(this.instance.isOver=0,this.instance.cancelHelperRemoval=!0,this.instance.options.revert=!1,this.instance._trigger("out",t,this.instance._uiHash(this.instance)),this.instance._mouseStop(t,!0),this.instance.options.helper=this.instance.options._helper,this.instance.currentItem.remove(),this.instance.placeholder&&this.instance.placeholder.remove(),i._trigger("fromSortable",t),i.dropped=!1)})}}),e.ui.plugin.add("draggable","cursor",{start:function(){var t=e("body"),a=e(this).data("ui-draggable").options;t.css("cursor")&&(a._cursor=t.css("cursor")),t.css("cursor",a.cursor)},stop:function(){var t=e(this).data("ui-draggable").options;t._cursor&&e("body").css("cursor",t._cursor)}}),e.ui.plugin.add("draggable","opacity",{start:function(t,a){var i=e(a.helper),r=e(this).data("ui-draggable").options;i.css("opacity")&&(r._opacity=i.css("opacity")),i.css("opacity",r.opacity)},stop:function(t,a){var i=e(this).data("ui-draggable").options;i._opacity&&e(a.helper).css("opacity",i._opacity)}}),e.ui.plugin.add("draggable","scroll",{start:function(){var t=e(this).data("ui-draggable");t.scrollParent[0]!==document&&"HTML"!==t.scrollParent[0].tagName&&(t.overflowOffset=t.scrollParent.offset())},drag:function(t){var a=e(this).data("ui-draggable"),i=a.options,r=!1;a.scrollParent[0]!==document&&"HTML"!==a.scrollParent[0].tagName?(i.axis&&"x"===i.axis||(a.overflowOffset.top+a.scrollParent[0].offsetHeight-t.pageY<i.scrollSensitivity?a.scrollParent[0].scrollTop=r=a.scrollParent[0].scrollTop+i.scrollSpeed:t.pageY-a.overflowOffset.top<i.scrollSensitivity&&(a.scrollParent[0].scrollTop=r=a.scrollParent[0].scrollTop-i.scrollSpeed)),i.axis&&"y"===i.axis||(a.overflowOffset.left+a.scrollParent[0].offsetWidth-t.pageX<i.scrollSensitivity?a.scrollParent[0].scrollLeft=r=a.scrollParent[0].scrollLeft+i.scrollSpeed:t.pageX-a.overflowOffset.left<i.scrollSensitivity&&(a.scrollParent[0].scrollLeft=r=a.scrollParent[0].scrollLeft-i.scrollSpeed))):(i.axis&&"x"===i.axis||(t.pageY-e(document).scrollTop()<i.scrollSensitivity?r=e(document).scrollTop(e(document).scrollTop()-i.scrollSpeed):e(window).height()-(t.pageY-e(document).scrollTop())<i.scrollSensitivity&&(r=e(document).scrollTop(e(document).scrollTop()+i.scrollSpeed))),i.axis&&"y"===i.axis||(t.pageX-e(document).scrollLeft()<i.scrollSensitivity?r=e(document).scrollLeft(e(document).scrollLeft()-i.scrollSpeed):e(window).width()-(t.pageX-e(document).scrollLeft())<i.scrollSensitivity&&(r=e(document).scrollLeft(e(document).scrollLeft()+i.scrollSpeed)))),r!==!1&&e.ui.ddmanager&&!i.dropBehaviour&&e.ui.ddmanager.prepareOffsets(a,t)}}),e.ui.plugin.add("draggable","snap",{start:function(){var t=e(this).data("ui-draggable"),a=t.options;t.snapElements=[],e(a.snap.constructor!==String?a.snap.items||":data(ui-draggable)":a.snap).each(function(){var a=e(this),i=a.offset();this!==t.element[0]&&t.snapElements.push({item:this,width:a.outerWidth(),height:a.outerHeight(),top:i.top,left:i.left})})},drag:function(t,a){var i,r,n,s,o,d,u,l,h,c,m=e(this).data("ui-draggable"),p=m.options,f=p.snapTolerance,g=a.offset.left,y=g+m.helperProportions.width,x=a.offset.top,k=x+m.helperProportions.height;for(h=m.snapElements.length-1;h>=0;h--)o=m.snapElements[h].left,d=o+m.snapElements[h].width,u=m.snapElements[h].top,l=u+m.snapElements[h].height,o-f>y||g>d+f||u-f>k||x>l+f||!e.contains(m.snapElements[h].item.ownerDocument,m.snapElements[h].item)?(m.snapElements[h].snapping&&m.options.snap.release&&m.options.snap.release.call(m.element,t,e.extend(m._uiHash(),{snapItem:m.snapElements[h].item})),m.snapElements[h].snapping=!1):("inner"!==p.snapMode&&(i=f>=Math.abs(u-k),r=f>=Math.abs(l-x),n=f>=Math.abs(o-y),s=f>=Math.abs(d-g),i&&(a.position.top=m._convertPositionTo("relative",{top:u-m.helperProportions.height,left:0}).top-m.margins.top),r&&(a.position.top=m._convertPositionTo("relative",{top:l,left:0}).top-m.margins.top),n&&(a.position.left=m._convertPositionTo("relative",{top:0,left:o-m.helperProportions.width}).left-m.margins.left),s&&(a.position.left=m._convertPositionTo("relative",{top:0,left:d}).left-m.margins.left)),c=i||r||n||s,"outer"!==p.snapMode&&(i=f>=Math.abs(u-x),r=f>=Math.abs(l-k),n=f>=Math.abs(o-g),s=f>=Math.abs(d-y),i&&(a.position.top=m._convertPositionTo("relative",{top:u,left:0}).top-m.margins.top),r&&(a.position.top=m._convertPositionTo("relative",{top:l-m.helperProportions.height,left:0}).top-m.margins.top),n&&(a.position.left=m._convertPositionTo("relative",{top:0,left:o}).left-m.margins.left),s&&(a.position.left=m._convertPositionTo("relative",{top:0,left:d-m.helperProportions.width}).left-m.margins.left)),!m.snapElements[h].snapping&&(i||r||n||s||c)&&m.options.snap.snap&&m.options.snap.snap.call(m.element,t,e.extend(m._uiHash(),{snapItem:m.snapElements[h].item})),m.snapElements[h].snapping=i||r||n||s||c)}}),e.ui.plugin.add("draggable","stack",{start:function(){var t,a=this.data("ui-draggable").options,i=e.makeArray(e(a.stack)).sort(function(t,a){return(parseInt(e(t).css("zIndex"),10)||0)-(parseInt(e(a).css("zIndex"),10)||0)});i.length&&(t=parseInt(e(i[0]).css("zIndex"),10)||0,e(i).each(function(a){e(this).css("zIndex",t+a)}),this.css("zIndex",t+i.length))}}),e.ui.plugin.add("draggable","zIndex",{start:function(t,a){var i=e(a.helper),r=e(this).data("ui-draggable").options;i.css("zIndex")&&(r._zIndex=i.css("zIndex")),i.css("zIndex",r.zIndex)},stop:function(t,a){var i=e(this).data("ui-draggable").options;i._zIndex&&e(a.helper).css("zIndex",i._zIndex)}})})(jQuery);(function(e){function t(e){return parseInt(e,10)||0}function i(e){return!isNaN(parseInt(e,10))}e.widget("ui.resizable",e.ui.mouse,{version:"1.10.3",widgetEventPrefix:"resize",options:{alsoResize:!1,animate:!1,animateDuration:"slow",animateEasing:"swing",aspectRatio:!1,autoHide:!1,containment:!1,ghost:!1,grid:!1,handles:"e,s,se",helper:!1,maxHeight:null,maxWidth:null,minHeight:10,minWidth:10,zIndex:90,resize:null,start:null,stop:null},_create:function(){var t,i,a,r,s,n=this,o=this.options;if(this.element.addClass("ui-resizable"),e.extend(this,{_aspectRatio:!!o.aspectRatio,aspectRatio:o.aspectRatio,originalElement:this.element,_proportionallyResizeElements:[],_helper:o.helper||o.ghost||o.animate?o.helper||"ui-resizable-helper":null}),this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i)&&(this.element.wrap(e("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({position:this.element.css("position"),width:this.element.outerWidth(),height:this.element.outerHeight(),top:this.element.css("top"),left:this.element.css("left")})),this.element=this.element.parent().data("ui-resizable",this.element.data("ui-resizable")),this.elementIsWrapper=!0,this.element.css({marginLeft:this.originalElement.css("marginLeft"),marginTop:this.originalElement.css("marginTop"),marginRight:this.originalElement.css("marginRight"),marginBottom:this.originalElement.css("marginBottom")}),this.originalElement.css({marginLeft:0,marginTop:0,marginRight:0,marginBottom:0}),this.originalResizeStyle=this.originalElement.css("resize"),this.originalElement.css("resize","none"),this._proportionallyResizeElements.push(this.originalElement.css({position:"static",zoom:1,display:"block"})),this.originalElement.css({margin:this.originalElement.css("margin")}),this._proportionallyResize()),this.handles=o.handles||(e(".ui-resizable-handle",this.element).length?{n:".ui-resizable-n",e:".ui-resizable-e",s:".ui-resizable-s",w:".ui-resizable-w",se:".ui-resizable-se",sw:".ui-resizable-sw",ne:".ui-resizable-ne",nw:".ui-resizable-nw"}:"e,s,se"),this.handles.constructor===String)for("all"===this.handles&&(this.handles="n,e,s,w,se,sw,ne,nw"),t=this.handles.split(","),this.handles={},i=0;t.length>i;i++)a=e.trim(t[i]),s="ui-resizable-"+a,r=e("<div class='ui-resizable-handle "+s+"'></div>"),r.css({zIndex:o.zIndex}),"se"===a&&r.addClass("ui-icon ui-icon-gripsmall-diagonal-se"),this.handles[a]=".ui-resizable-"+a,this.element.append(r);this._renderAxis=function(t){var i,a,r,s;t=t||this.element;for(i in this.handles)this.handles[i].constructor===String&&(this.handles[i]=e(this.handles[i],this.element).show()),this.elementIsWrapper&&this.originalElement[0].nodeName.match(/textarea|input|select|button/i)&&(a=e(this.handles[i],this.element),s=/sw|ne|nw|se|n|s/.test(i)?a.outerHeight():a.outerWidth(),r=["padding",/ne|nw|n/.test(i)?"Top":/se|sw|s/.test(i)?"Bottom":/^e$/.test(i)?"Right":"Left"].join(""),t.css(r,s),this._proportionallyResize()),e(this.handles[i]).length},this._renderAxis(this.element),this._handles=e(".ui-resizable-handle",this.element).disableSelection(),this._handles.mouseover(function(){n.resizing||(this.className&&(r=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)),n.axis=r&&r[1]?r[1]:"se")}),o.autoHide&&(this._handles.hide(),e(this.element).addClass("ui-resizable-autohide").mouseenter(function(){o.disabled||(e(this).removeClass("ui-resizable-autohide"),n._handles.show())}).mouseleave(function(){o.disabled||n.resizing||(e(this).addClass("ui-resizable-autohide"),n._handles.hide())})),this._mouseInit()},_destroy:function(){this._mouseDestroy();var t,i=function(t){e(t).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()};return this.elementIsWrapper&&(i(this.element),t=this.element,this.originalElement.css({position:t.css("position"),width:t.outerWidth(),height:t.outerHeight(),top:t.css("top"),left:t.css("left")}).insertAfter(t),t.remove()),this.originalElement.css("resize",this.originalResizeStyle),i(this.originalElement),this},_mouseCapture:function(t){var i,a,r=!1;for(i in this.handles)a=e(this.handles[i])[0],(a===t.target||e.contains(a,t.target))&&(r=!0);return!this.options.disabled&&r},_mouseStart:function(i){var a,r,s,n=this.options,o=this.element.position(),d=this.element;return this.resizing=!0,/absolute/.test(d.css("position"))?d.css({position:"absolute",top:d.css("top"),left:d.css("left")}):d.is(".ui-draggable")&&d.css({position:"absolute",top:o.top,left:o.left}),this._renderProxy(),a=t(this.helper.css("left")),r=t(this.helper.css("top")),n.containment&&(a+=e(n.containment).scrollLeft()||0,r+=e(n.containment).scrollTop()||0),this.offset=this.helper.offset(),this.position={left:a,top:r},this.size=this._helper?{width:d.outerWidth(),height:d.outerHeight()}:{width:d.width(),height:d.height()},this.originalSize=this._helper?{width:d.outerWidth(),height:d.outerHeight()}:{width:d.width(),height:d.height()},this.originalPosition={left:a,top:r},this.sizeDiff={width:d.outerWidth()-d.width(),height:d.outerHeight()-d.height()},this.originalMousePosition={left:i.pageX,top:i.pageY},this.aspectRatio="number"==typeof n.aspectRatio?n.aspectRatio:this.originalSize.width/this.originalSize.height||1,s=e(".ui-resizable-"+this.axis).css("cursor"),e("body").css("cursor","auto"===s?this.axis+"-resize":s),d.addClass("ui-resizable-resizing"),this._propagate("start",i),!0},_mouseDrag:function(t){var i,a=this.helper,r={},s=this.originalMousePosition,n=this.axis,o=this.position.top,d=this.position.left,u=this.size.width,h=this.size.height,l=t.pageX-s.left||0,c=t.pageY-s.top||0,m=this._change[n];return m?(i=m.apply(this,[t,l,c]),this._updateVirtualBoundaries(t.shiftKey),(this._aspectRatio||t.shiftKey)&&(i=this._updateRatio(i,t)),i=this._respectSize(i,t),this._updateCache(i),this._propagate("resize",t),this.position.top!==o&&(r.top=this.position.top+"px"),this.position.left!==d&&(r.left=this.position.left+"px"),this.size.width!==u&&(r.width=this.size.width+"px"),this.size.height!==h&&(r.height=this.size.height+"px"),a.css(r),!this._helper&&this._proportionallyResizeElements.length&&this._proportionallyResize(),e.isEmptyObject(r)||this._trigger("resize",t,this.ui()),!1):!1},_mouseStop:function(t){this.resizing=!1;var i,a,r,s,n,o,d,u=this.options,h=this;return this._helper&&(i=this._proportionallyResizeElements,a=i.length&&/textarea/i.test(i[0].nodeName),r=a&&e.ui.hasScroll(i[0],"left")?0:h.sizeDiff.height,s=a?0:h.sizeDiff.width,n={width:h.helper.width()-s,height:h.helper.height()-r},o=parseInt(h.element.css("left"),10)+(h.position.left-h.originalPosition.left)||null,d=parseInt(h.element.css("top"),10)+(h.position.top-h.originalPosition.top)||null,u.animate||this.element.css(e.extend(n,{top:d,left:o})),h.helper.height(h.size.height),h.helper.width(h.size.width),this._helper&&!u.animate&&this._proportionallyResize()),e("body").css("cursor","auto"),this.element.removeClass("ui-resizable-resizing"),this._propagate("stop",t),this._helper&&this.helper.remove(),!1},_updateVirtualBoundaries:function(e){var t,a,r,s,n,o=this.options;n={minWidth:i(o.minWidth)?o.minWidth:0,maxWidth:i(o.maxWidth)?o.maxWidth:1/0,minHeight:i(o.minHeight)?o.minHeight:0,maxHeight:i(o.maxHeight)?o.maxHeight:1/0},(this._aspectRatio||e)&&(t=n.minHeight*this.aspectRatio,r=n.minWidth/this.aspectRatio,a=n.maxHeight*this.aspectRatio,s=n.maxWidth/this.aspectRatio,t>n.minWidth&&(n.minWidth=t),r>n.minHeight&&(n.minHeight=r),n.maxWidth>a&&(n.maxWidth=a),n.maxHeight>s&&(n.maxHeight=s)),this._vBoundaries=n},_updateCache:function(e){this.offset=this.helper.offset(),i(e.left)&&(this.position.left=e.left),i(e.top)&&(this.position.top=e.top),i(e.height)&&(this.size.height=e.height),i(e.width)&&(this.size.width=e.width)},_updateRatio:function(e){var t=this.position,a=this.size,r=this.axis;return i(e.height)?e.width=e.height*this.aspectRatio:i(e.width)&&(e.height=e.width/this.aspectRatio),"sw"===r&&(e.left=t.left+(a.width-e.width),e.top=null),"nw"===r&&(e.top=t.top+(a.height-e.height),e.left=t.left+(a.width-e.width)),e},_respectSize:function(e){var t=this._vBoundaries,a=this.axis,r=i(e.width)&&t.maxWidth&&t.maxWidth<e.width,s=i(e.height)&&t.maxHeight&&t.maxHeight<e.height,n=i(e.width)&&t.minWidth&&t.minWidth>e.width,o=i(e.height)&&t.minHeight&&t.minHeight>e.height,d=this.originalPosition.left+this.originalSize.width,u=this.position.top+this.size.height,h=/sw|nw|w/.test(a),l=/nw|ne|n/.test(a);return n&&(e.width=t.minWidth),o&&(e.height=t.minHeight),r&&(e.width=t.maxWidth),s&&(e.height=t.maxHeight),n&&h&&(e.left=d-t.minWidth),r&&h&&(e.left=d-t.maxWidth),o&&l&&(e.top=u-t.minHeight),s&&l&&(e.top=u-t.maxHeight),e.width||e.height||e.left||!e.top?e.width||e.height||e.top||!e.left||(e.left=null):e.top=null,e},_proportionallyResize:function(){if(this._proportionallyResizeElements.length){var e,t,i,a,r,s=this.helper||this.element;for(e=0;this._proportionallyResizeElements.length>e;e++){if(r=this._proportionallyResizeElements[e],!this.borderDif)for(this.borderDif=[],i=[r.css("borderTopWidth"),r.css("borderRightWidth"),r.css("borderBottomWidth"),r.css("borderLeftWidth")],a=[r.css("paddingTop"),r.css("paddingRight"),r.css("paddingBottom"),r.css("paddingLeft")],t=0;i.length>t;t++)this.borderDif[t]=(parseInt(i[t],10)||0)+(parseInt(a[t],10)||0);r.css({height:s.height()-this.borderDif[0]-this.borderDif[2]||0,width:s.width()-this.borderDif[1]-this.borderDif[3]||0})}}},_renderProxy:function(){var t=this.element,i=this.options;this.elementOffset=t.offset(),this._helper?(this.helper=this.helper||e("<div style='overflow:hidden;'></div>"),this.helper.addClass(this._helper).css({width:this.element.outerWidth()-1,height:this.element.outerHeight()-1,position:"absolute",left:this.elementOffset.left+"px",top:this.elementOffset.top+"px",zIndex:++i.zIndex}),this.helper.appendTo("body").disableSelection()):this.helper=this.element},_change:{e:function(e,t){return{width:this.originalSize.width+t}},w:function(e,t){var i=this.originalSize,a=this.originalPosition;return{left:a.left+t,width:i.width-t}},n:function(e,t,i){var a=this.originalSize,r=this.originalPosition;return{top:r.top+i,height:a.height-i}},s:function(e,t,i){return{height:this.originalSize.height+i}},se:function(t,i,a){return e.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[t,i,a]))},sw:function(t,i,a){return e.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[t,i,a]))},ne:function(t,i,a){return e.extend(this._change.n.apply(this,arguments),this._change.e.apply(this,[t,i,a]))},nw:function(t,i,a){return e.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[t,i,a]))}},_propagate:function(t,i){e.ui.plugin.call(this,t,[i,this.ui()]),"resize"!==t&&this._trigger(t,i,this.ui())},plugins:{},ui:function(){return{originalElement:this.originalElement,element:this.element,helper:this.helper,position:this.position,size:this.size,originalSize:this.originalSize,originalPosition:this.originalPosition}}}),e.ui.plugin.add("resizable","animate",{stop:function(t){var i=e(this).data("ui-resizable"),a=i.options,r=i._proportionallyResizeElements,s=r.length&&/textarea/i.test(r[0].nodeName),n=s&&e.ui.hasScroll(r[0],"left")?0:i.sizeDiff.height,o=s?0:i.sizeDiff.width,d={width:i.size.width-o,height:i.size.height-n},u=parseInt(i.element.css("left"),10)+(i.position.left-i.originalPosition.left)||null,h=parseInt(i.element.css("top"),10)+(i.position.top-i.originalPosition.top)||null;i.element.animate(e.extend(d,h&&u?{top:h,left:u}:{}),{duration:a.animateDuration,easing:a.animateEasing,step:function(){var a={width:parseInt(i.element.css("width"),10),height:parseInt(i.element.css("height"),10),top:parseInt(i.element.css("top"),10),left:parseInt(i.element.css("left"),10)};r&&r.length&&e(r[0]).css({width:a.width,height:a.height}),i._updateCache(a),i._propagate("resize",t)}})}}),e.ui.plugin.add("resizable","containment",{start:function(){var i,a,r,s,n,o,d,u=e(this).data("ui-resizable"),h=u.options,l=u.element,c=h.containment,m=c instanceof e?c.get(0):/parent/.test(c)?l.parent().get(0):c;m&&(u.containerElement=e(m),/document/.test(c)||c===document?(u.containerOffset={left:0,top:0},u.containerPosition={left:0,top:0},u.parentData={element:e(document),left:0,top:0,width:e(document).width(),height:e(document).height()||document.body.parentNode.scrollHeight}):(i=e(m),a=[],e(["Top","Right","Left","Bottom"]).each(function(e,r){a[e]=t(i.css("padding"+r))}),u.containerOffset=i.offset(),u.containerPosition=i.position(),u.containerSize={height:i.innerHeight()-a[3],width:i.innerWidth()-a[1]},r=u.containerOffset,s=u.containerSize.height,n=u.containerSize.width,o=e.ui.hasScroll(m,"left")?m.scrollWidth:n,d=e.ui.hasScroll(m)?m.scrollHeight:s,u.parentData={element:m,left:r.left,top:r.top,width:o,height:d}))},resize:function(t){var i,a,r,s,n=e(this).data("ui-resizable"),o=n.options,d=n.containerOffset,u=n.position,h=n._aspectRatio||t.shiftKey,l={top:0,left:0},c=n.containerElement;c[0]!==document&&/static/.test(c.css("position"))&&(l=d),u.left<(n._helper?d.left:0)&&(n.size.width=n.size.width+(n._helper?n.position.left-d.left:n.position.left-l.left),h&&(n.size.height=n.size.width/n.aspectRatio),n.position.left=o.helper?d.left:0),u.top<(n._helper?d.top:0)&&(n.size.height=n.size.height+(n._helper?n.position.top-d.top:n.position.top),h&&(n.size.width=n.size.height*n.aspectRatio),n.position.top=n._helper?d.top:0),n.offset.left=n.parentData.left+n.position.left,n.offset.top=n.parentData.top+n.position.top,i=Math.abs((n._helper?n.offset.left-l.left:n.offset.left-l.left)+n.sizeDiff.width),a=Math.abs((n._helper?n.offset.top-l.top:n.offset.top-d.top)+n.sizeDiff.height),r=n.containerElement.get(0)===n.element.parent().get(0),s=/relative|absolute/.test(n.containerElement.css("position")),r&&s&&(i-=n.parentData.left),i+n.size.width>=n.parentData.width&&(n.size.width=n.parentData.width-i,h&&(n.size.height=n.size.width/n.aspectRatio)),a+n.size.height>=n.parentData.height&&(n.size.height=n.parentData.height-a,h&&(n.size.width=n.size.height*n.aspectRatio))},stop:function(){var t=e(this).data("ui-resizable"),i=t.options,a=t.containerOffset,r=t.containerPosition,s=t.containerElement,n=e(t.helper),o=n.offset(),d=n.outerWidth()-t.sizeDiff.width,u=n.outerHeight()-t.sizeDiff.height;t._helper&&!i.animate&&/relative/.test(s.css("position"))&&e(this).css({left:o.left-r.left-a.left,width:d,height:u}),t._helper&&!i.animate&&/static/.test(s.css("position"))&&e(this).css({left:o.left-r.left-a.left,width:d,height:u})}}),e.ui.plugin.add("resizable","alsoResize",{start:function(){var t=e(this).data("ui-resizable"),i=t.options,a=function(t){e(t).each(function(){var t=e(this);t.data("ui-resizable-alsoresize",{width:parseInt(t.width(),10),height:parseInt(t.height(),10),left:parseInt(t.css("left"),10),top:parseInt(t.css("top"),10)})})};"object"!=typeof i.alsoResize||i.alsoResize.parentNode?a(i.alsoResize):i.alsoResize.length?(i.alsoResize=i.alsoResize[0],a(i.alsoResize)):e.each(i.alsoResize,function(e){a(e)})},resize:function(t,i){var a=e(this).data("ui-resizable"),r=a.options,s=a.originalSize,n=a.originalPosition,o={height:a.size.height-s.height||0,width:a.size.width-s.width||0,top:a.position.top-n.top||0,left:a.position.left-n.left||0},d=function(t,a){e(t).each(function(){var t=e(this),r=e(this).data("ui-resizable-alsoresize"),s={},n=a&&a.length?a:t.parents(i.originalElement[0]).length?["width","height"]:["width","height","top","left"];e.each(n,function(e,t){var i=(r[t]||0)+(o[t]||0);i&&i>=0&&(s[t]=i||null)}),t.css(s)})};"object"!=typeof r.alsoResize||r.alsoResize.nodeType?d(r.alsoResize):e.each(r.alsoResize,function(e,t){d(e,t)})},stop:function(){e(this).removeData("resizable-alsoresize")}}),e.ui.plugin.add("resizable","ghost",{start:function(){var t=e(this).data("ui-resizable"),i=t.options,a=t.size;t.ghost=t.originalElement.clone(),t.ghost.css({opacity:.25,display:"block",position:"relative",height:a.height,width:a.width,margin:0,left:0,top:0}).addClass("ui-resizable-ghost").addClass("string"==typeof i.ghost?i.ghost:""),t.ghost.appendTo(t.helper)},resize:function(){var t=e(this).data("ui-resizable");t.ghost&&t.ghost.css({position:"relative",height:t.size.height,width:t.size.width})},stop:function(){var t=e(this).data("ui-resizable");t.ghost&&t.helper&&t.helper.get(0).removeChild(t.ghost.get(0))}}),e.ui.plugin.add("resizable","grid",{resize:function(){var t=e(this).data("ui-resizable"),i=t.options,a=t.size,r=t.originalSize,s=t.originalPosition,n=t.axis,o="number"==typeof i.grid?[i.grid,i.grid]:i.grid,d=o[0]||1,u=o[1]||1,h=Math.round((a.width-r.width)/d)*d,l=Math.round((a.height-r.height)/u)*u,c=r.width+h,m=r.height+l,p=i.maxWidth&&c>i.maxWidth,f=i.maxHeight&&m>i.maxHeight,g=i.minWidth&&i.minWidth>c,y=i.minHeight&&i.minHeight>m;i.grid=o,g&&(c+=d),y&&(m+=u),p&&(c-=d),f&&(m-=u),/^(se|s|e)$/.test(n)?(t.size.width=c,t.size.height=m):/^(ne)$/.test(n)?(t.size.width=c,t.size.height=m,t.position.top=s.top-l):/^(sw)$/.test(n)?(t.size.width=c,t.size.height=m,t.position.left=s.left-h):(t.size.width=c,t.size.height=m,t.position.top=s.top-l,t.position.left=s.left-h)}})})(jQuery);(function(e){var t,a,r,i,n="ui-button ui-widget ui-state-default ui-corner-all",s="ui-state-hover ui-state-active ",o="ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",d=function(){var t=e(this);setTimeout(function(){t.find(":ui-button").button("refresh")},1)},u=function(t){var a=t.name,r=t.form,i=e([]);return a&&(a=a.replace(/'/g,"\\'"),i=r?e(r).find("[name='"+a+"']"):e("[name='"+a+"']",t.ownerDocument).filter(function(){return!this.form})),i};e.widget("ui.button",{version:"1.10.3",defaultElement:"<button>",options:{disabled:null,text:!0,label:null,icons:{primary:null,secondary:null}},_create:function(){this.element.closest("form").unbind("reset"+this.eventNamespace).bind("reset"+this.eventNamespace,d),"boolean"!=typeof this.options.disabled?this.options.disabled=!!this.element.prop("disabled"):this.element.prop("disabled",this.options.disabled),this._determineButtonType(),this.hasTitle=!!this.buttonElement.attr("title");var s=this,o=this.options,l="checkbox"===this.type||"radio"===this.type,c=l?"":"ui-state-active",h="ui-state-focus";null===o.label&&(o.label="input"===this.type?this.buttonElement.val():this.buttonElement.html()),this._hoverable(this.buttonElement),this.buttonElement.addClass(n).attr("role","button").bind("mouseenter"+this.eventNamespace,function(){o.disabled||this===t&&e(this).addClass("ui-state-active")}).bind("mouseleave"+this.eventNamespace,function(){o.disabled||e(this).removeClass(c)}).bind("click"+this.eventNamespace,function(e){o.disabled&&(e.preventDefault(),e.stopImmediatePropagation())}),this.element.bind("focus"+this.eventNamespace,function(){s.buttonElement.addClass(h)}).bind("blur"+this.eventNamespace,function(){s.buttonElement.removeClass(h)}),l&&(this.element.bind("change"+this.eventNamespace,function(){i||s.refresh()}),this.buttonElement.bind("mousedown"+this.eventNamespace,function(e){o.disabled||(i=!1,a=e.pageX,r=e.pageY)}).bind("mouseup"+this.eventNamespace,function(e){o.disabled||(a!==e.pageX||r!==e.pageY)&&(i=!0)})),"checkbox"===this.type?this.buttonElement.bind("click"+this.eventNamespace,function(){return o.disabled||i?!1:undefined}):"radio"===this.type?this.buttonElement.bind("click"+this.eventNamespace,function(){if(o.disabled||i)return!1;e(this).addClass("ui-state-active"),s.buttonElement.attr("aria-pressed","true");var t=s.element[0];u(t).not(t).map(function(){return e(this).button("widget")[0]}).removeClass("ui-state-active").attr("aria-pressed","false")}):(this.buttonElement.bind("mousedown"+this.eventNamespace,function(){return o.disabled?!1:(e(this).addClass("ui-state-active"),t=this,s.document.one("mouseup",function(){t=null}),undefined)}).bind("mouseup"+this.eventNamespace,function(){return o.disabled?!1:(e(this).removeClass("ui-state-active"),undefined)}).bind("keydown"+this.eventNamespace,function(t){return o.disabled?!1:((t.keyCode===e.ui.keyCode.SPACE||t.keyCode===e.ui.keyCode.ENTER)&&e(this).addClass("ui-state-active"),undefined)}).bind("keyup"+this.eventNamespace+" blur"+this.eventNamespace,function(){e(this).removeClass("ui-state-active")}),this.buttonElement.is("a")&&this.buttonElement.keyup(function(t){t.keyCode===e.ui.keyCode.SPACE&&e(this).click()})),this._setOption("disabled",o.disabled),this._resetButton()},_determineButtonType:function(){var e,t,a;this.type=this.element.is("[type=checkbox]")?"checkbox":this.element.is("[type=radio]")?"radio":this.element.is("input")?"input":"button","checkbox"===this.type||"radio"===this.type?(e=this.element.parents().last(),t="label[for='"+this.element.attr("id")+"']",this.buttonElement=e.find(t),this.buttonElement.length||(e=e.length?e.siblings():this.element.siblings(),this.buttonElement=e.filter(t),this.buttonElement.length||(this.buttonElement=e.find(t))),this.element.addClass("ui-helper-hidden-accessible"),a=this.element.is(":checked"),a&&this.buttonElement.addClass("ui-state-active"),this.buttonElement.prop("aria-pressed",a)):this.buttonElement=this.element},widget:function(){return this.buttonElement},_destroy:function(){this.element.removeClass("ui-helper-hidden-accessible"),this.buttonElement.removeClass(n+" "+s+" "+o).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()),this.hasTitle||this.buttonElement.removeAttr("title")},_setOption:function(e,t){return this._super(e,t),"disabled"===e?(t?this.element.prop("disabled",!0):this.element.prop("disabled",!1),undefined):(this._resetButton(),undefined)},refresh:function(){var t=this.element.is("input, button")?this.element.is(":disabled"):this.element.hasClass("ui-button-disabled");t!==this.options.disabled&&this._setOption("disabled",t),"radio"===this.type?u(this.element[0]).each(function(){e(this).is(":checked")?e(this).button("widget").addClass("ui-state-active").attr("aria-pressed","true"):e(this).button("widget").removeClass("ui-state-active").attr("aria-pressed","false")}):"checkbox"===this.type&&(this.element.is(":checked")?this.buttonElement.addClass("ui-state-active").attr("aria-pressed","true"):this.buttonElement.removeClass("ui-state-active").attr("aria-pressed","false"))},_resetButton:function(){if("input"===this.type)return this.options.label&&this.element.val(this.options.label),undefined;var t=this.buttonElement.removeClass(o),a=e("<span></span>",this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(t.empty()).text(),r=this.options.icons,i=r.primary&&r.secondary,n=[];r.primary||r.secondary?(this.options.text&&n.push("ui-button-text-icon"+(i?"s":r.primary?"-primary":"-secondary")),r.primary&&t.prepend("<span class='ui-button-icon-primary ui-icon "+r.primary+"'></span>"),r.secondary&&t.append("<span class='ui-button-icon-secondary ui-icon "+r.secondary+"'></span>"),this.options.text||(n.push(i?"ui-button-icons-only":"ui-button-icon-only"),this.hasTitle||t.attr("title",e.trim(a)))):n.push("ui-button-text-only"),t.addClass(n.join(" "))}}),e.widget("ui.buttonset",{version:"1.10.3",options:{items:"button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"},_create:function(){this.element.addClass("ui-buttonset")},_init:function(){this.refresh()},_setOption:function(e,t){"disabled"===e&&this.buttons.button("option",e,t),this._super(e,t)},refresh:function(){var t="rtl"===this.element.css("direction");this.buttons=this.element.find(this.options.items).filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map(function(){return e(this).button("widget")[0]}).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(t?"ui-corner-right":"ui-corner-left").end().filter(":last").addClass(t?"ui-corner-left":"ui-corner-right").end().end()},_destroy:function(){this.element.removeClass("ui-buttonset"),this.buttons.map(function(){return e(this).button("widget")[0]}).removeClass("ui-corner-left ui-corner-right").end().button("destroy")}})})(jQuery);(function(e,t){function a(){this._curInst=null,this._keyEvent=!1,this._disabledInputs=[],this._datepickerShowing=!1,this._inDialog=!1,this._mainDivId="ui-datepicker-div",this._inlineClass="ui-datepicker-inline",this._appendClass="ui-datepicker-append",this._triggerClass="ui-datepicker-trigger",this._dialogClass="ui-datepicker-dialog",this._disableClass="ui-datepicker-disabled",this._unselectableClass="ui-datepicker-unselectable",this._currentClass="ui-datepicker-current-day",this._dayOverClass="ui-datepicker-days-cell-over",this.regional=[],this.regional[""]={closeText:"Done",prevText:"Prev",nextText:"Next",currentText:"Today",monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],dayNamesMin:["Su","Mo","Tu","We","Th","Fr","Sa"],weekHeader:"Wk",dateFormat:"mm/dd/yy",firstDay:0,isRTL:!1,showMonthAfterYear:!1,yearSuffix:""},this._defaults={showOn:"focus",showAnim:"fadeIn",showOptions:{},defaultDate:null,appendText:"",buttonText:"...",buttonImage:"",buttonImageOnly:!1,hideIfNoPrevNext:!1,navigationAsDateFormat:!1,gotoCurrent:!1,changeMonth:!1,changeYear:!1,yearRange:"c-10:c+10",showOtherMonths:!1,selectOtherMonths:!1,showWeek:!1,calculateWeek:this.iso8601Week,shortYearCutoff:"+10",minDate:null,maxDate:null,duration:"fast",beforeShowDay:null,beforeShow:null,onSelect:null,onChangeMonthYear:null,onClose:null,numberOfMonths:1,showCurrentAtPos:0,stepMonths:1,stepBigMonths:12,altField:"",altFormat:"",constrainInput:!0,showButtonPanel:!1,autoSize:!1,disabled:!1},e.extend(this._defaults,this.regional[""]),this.dpDiv=i(e("<div id='"+this._mainDivId+"' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))}function i(t){var a="button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";return t.delegate(a,"mouseout",function(){e(this).removeClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&e(this).removeClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&e(this).removeClass("ui-datepicker-next-hover")}).delegate(a,"mouseover",function(){e.datepicker._isDisabledDatepicker(n.inline?t.parent()[0]:n.input[0])||(e(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"),e(this).addClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&e(this).addClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&e(this).addClass("ui-datepicker-next-hover"))})}function s(t,a){e.extend(t,a);for(var i in a)null==a[i]&&(t[i]=a[i]);return t}e.extend(e.ui,{datepicker:{version:"1.10.3"}});var n,r="datepicker";e.extend(a.prototype,{markerClassName:"hasDatepicker",maxRows:4,_widgetDatepicker:function(){return this.dpDiv},setDefaults:function(e){return s(this._defaults,e||{}),this},_attachDatepicker:function(t,a){var i,s,n;i=t.nodeName.toLowerCase(),s="div"===i||"span"===i,t.id||(this.uuid+=1,t.id="dp"+this.uuid),n=this._newInst(e(t),s),n.settings=e.extend({},a||{}),"input"===i?this._connectDatepicker(t,n):s&&this._inlineDatepicker(t,n)},_newInst:function(t,a){var s=t[0].id.replace(/([^A-Za-z0-9_\-])/g,"\\\\$1");return{id:s,input:t,selectedDay:0,selectedMonth:0,selectedYear:0,drawMonth:0,drawYear:0,inline:a,dpDiv:a?i(e("<div class='"+this._inlineClass+" ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")):this.dpDiv}},_connectDatepicker:function(t,a){var i=e(t);a.append=e([]),a.trigger=e([]),i.hasClass(this.markerClassName)||(this._attachments(i,a),i.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp),this._autoSize(a),e.data(t,r,a),a.settings.disabled&&this._disableDatepicker(t))},_attachments:function(t,a){var i,s,n,r=this._get(a,"appendText"),o=this._get(a,"isRTL");a.append&&a.append.remove(),r&&(a.append=e("<span class='"+this._appendClass+"'>"+r+"</span>"),t[o?"before":"after"](a.append)),t.unbind("focus",this._showDatepicker),a.trigger&&a.trigger.remove(),i=this._get(a,"showOn"),("focus"===i||"both"===i)&&t.focus(this._showDatepicker),("button"===i||"both"===i)&&(s=this._get(a,"buttonText"),n=this._get(a,"buttonImage"),a.trigger=e(this._get(a,"buttonImageOnly")?e("<img/>").addClass(this._triggerClass).attr({src:n,alt:s,title:s}):e("<button type='button'></button>").addClass(this._triggerClass).html(n?e("<img/>").attr({src:n,alt:s,title:s}):s)),t[o?"before":"after"](a.trigger),a.trigger.click(function(){return e.datepicker._datepickerShowing&&e.datepicker._lastInput===t[0]?e.datepicker._hideDatepicker():e.datepicker._datepickerShowing&&e.datepicker._lastInput!==t[0]?(e.datepicker._hideDatepicker(),e.datepicker._showDatepicker(t[0])):e.datepicker._showDatepicker(t[0]),!1}))},_autoSize:function(e){if(this._get(e,"autoSize")&&!e.inline){var t,a,i,s,n=new Date(2009,11,20),r=this._get(e,"dateFormat");r.match(/[DM]/)&&(t=function(e){for(a=0,i=0,s=0;e.length>s;s++)e[s].length>a&&(a=e[s].length,i=s);return i},n.setMonth(t(this._get(e,r.match(/MM/)?"monthNames":"monthNamesShort"))),n.setDate(t(this._get(e,r.match(/DD/)?"dayNames":"dayNamesShort"))+20-n.getDay())),e.input.attr("size",this._formatDate(e,n).length)}},_inlineDatepicker:function(t,a){var i=e(t);i.hasClass(this.markerClassName)||(i.addClass(this.markerClassName).append(a.dpDiv),e.data(t,r,a),this._setDate(a,this._getDefaultDate(a),!0),this._updateDatepicker(a),this._updateAlternate(a),a.settings.disabled&&this._disableDatepicker(t),a.dpDiv.css("display","block"))},_dialogDatepicker:function(t,a,i,n,o){var c,d,l,u,h,p=this._dialogInst;return p||(this.uuid+=1,c="dp"+this.uuid,this._dialogInput=e("<input type='text' id='"+c+"' style='position: absolute; top: -100px; width: 0px;'/>"),this._dialogInput.keydown(this._doKeyDown),e("body").append(this._dialogInput),p=this._dialogInst=this._newInst(this._dialogInput,!1),p.settings={},e.data(this._dialogInput[0],r,p)),s(p.settings,n||{}),a=a&&a.constructor===Date?this._formatDate(p,a):a,this._dialogInput.val(a),this._pos=o?o.length?o:[o.pageX,o.pageY]:null,this._pos||(d=document.documentElement.clientWidth,l=document.documentElement.clientHeight,u=document.documentElement.scrollLeft||document.body.scrollLeft,h=document.documentElement.scrollTop||document.body.scrollTop,this._pos=[d/2-100+u,l/2-150+h]),this._dialogInput.css("left",this._pos[0]+20+"px").css("top",this._pos[1]+"px"),p.settings.onSelect=i,this._inDialog=!0,this.dpDiv.addClass(this._dialogClass),this._showDatepicker(this._dialogInput[0]),e.blockUI&&e.blockUI(this.dpDiv),e.data(this._dialogInput[0],r,p),this},_destroyDatepicker:function(t){var a,i=e(t),s=e.data(t,r);i.hasClass(this.markerClassName)&&(a=t.nodeName.toLowerCase(),e.removeData(t,r),"input"===a?(s.append.remove(),s.trigger.remove(),i.removeClass(this.markerClassName).unbind("focus",this._showDatepicker).unbind("keydown",this._doKeyDown).unbind("keypress",this._doKeyPress).unbind("keyup",this._doKeyUp)):("div"===a||"span"===a)&&i.removeClass(this.markerClassName).empty())},_enableDatepicker:function(t){var a,i,s=e(t),n=e.data(t,r);s.hasClass(this.markerClassName)&&(a=t.nodeName.toLowerCase(),"input"===a?(t.disabled=!1,n.trigger.filter("button").each(function(){this.disabled=!1}).end().filter("img").css({opacity:"1.0",cursor:""})):("div"===a||"span"===a)&&(i=s.children("."+this._inlineClass),i.children().removeClass("ui-state-disabled"),i.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!1)),this._disabledInputs=e.map(this._disabledInputs,function(e){return e===t?null:e}))},_disableDatepicker:function(t){var a,i,s=e(t),n=e.data(t,r);s.hasClass(this.markerClassName)&&(a=t.nodeName.toLowerCase(),"input"===a?(t.disabled=!0,n.trigger.filter("button").each(function(){this.disabled=!0}).end().filter("img").css({opacity:"0.5",cursor:"default"})):("div"===a||"span"===a)&&(i=s.children("."+this._inlineClass),i.children().addClass("ui-state-disabled"),i.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!0)),this._disabledInputs=e.map(this._disabledInputs,function(e){return e===t?null:e}),this._disabledInputs[this._disabledInputs.length]=t)},_isDisabledDatepicker:function(e){if(!e)return!1;for(var t=0;this._disabledInputs.length>t;t++)if(this._disabledInputs[t]===e)return!0;return!1},_getInst:function(t){try{return e.data(t,r)}catch(a){throw"Missing instance data for this datepicker"}},_optionDatepicker:function(a,i,n){var r,o,c,d,l=this._getInst(a);return 2===arguments.length&&"string"==typeof i?"defaults"===i?e.extend({},e.datepicker._defaults):l?"all"===i?e.extend({},l.settings):this._get(l,i):null:(r=i||{},"string"==typeof i&&(r={},r[i]=n),l&&(this._curInst===l&&this._hideDatepicker(),o=this._getDateDatepicker(a,!0),c=this._getMinMaxDate(l,"min"),d=this._getMinMaxDate(l,"max"),s(l.settings,r),null!==c&&r.dateFormat!==t&&r.minDate===t&&(l.settings.minDate=this._formatDate(l,c)),null!==d&&r.dateFormat!==t&&r.maxDate===t&&(l.settings.maxDate=this._formatDate(l,d)),"disabled"in r&&(r.disabled?this._disableDatepicker(a):this._enableDatepicker(a)),this._attachments(e(a),l),this._autoSize(l),this._setDate(l,o),this._updateAlternate(l),this._updateDatepicker(l)),t)},_changeDatepicker:function(e,t,a){this._optionDatepicker(e,t,a)},_refreshDatepicker:function(e){var t=this._getInst(e);t&&this._updateDatepicker(t)},_setDateDatepicker:function(e,t){var a=this._getInst(e);a&&(this._setDate(a,t),this._updateDatepicker(a),this._updateAlternate(a))},_getDateDatepicker:function(e,t){var a=this._getInst(e);return a&&!a.inline&&this._setDateFromField(a,t),a?this._getDate(a):null},_doKeyDown:function(t){var a,i,s,n=e.datepicker._getInst(t.target),r=!0,o=n.dpDiv.is(".ui-datepicker-rtl");if(n._keyEvent=!0,e.datepicker._datepickerShowing)switch(t.keyCode){case 9:e.datepicker._hideDatepicker(),r=!1;break;case 13:return s=e("td."+e.datepicker._dayOverClass+":not(."+e.datepicker._currentClass+")",n.dpDiv),s[0]&&e.datepicker._selectDay(t.target,n.selectedMonth,n.selectedYear,s[0]),a=e.datepicker._get(n,"onSelect"),a?(i=e.datepicker._formatDate(n),a.apply(n.input?n.input[0]:null,[i,n])):e.datepicker._hideDatepicker(),!1;case 27:e.datepicker._hideDatepicker();break;case 33:e.datepicker._adjustDate(t.target,t.ctrlKey?-e.datepicker._get(n,"stepBigMonths"):-e.datepicker._get(n,"stepMonths"),"M");break;case 34:e.datepicker._adjustDate(t.target,t.ctrlKey?+e.datepicker._get(n,"stepBigMonths"):+e.datepicker._get(n,"stepMonths"),"M");break;case 35:(t.ctrlKey||t.metaKey)&&e.datepicker._clearDate(t.target),r=t.ctrlKey||t.metaKey;break;case 36:(t.ctrlKey||t.metaKey)&&e.datepicker._gotoToday(t.target),r=t.ctrlKey||t.metaKey;break;case 37:(t.ctrlKey||t.metaKey)&&e.datepicker._adjustDate(t.target,o?1:-1,"D"),r=t.ctrlKey||t.metaKey,t.originalEvent.altKey&&e.datepicker._adjustDate(t.target,t.ctrlKey?-e.datepicker._get(n,"stepBigMonths"):-e.datepicker._get(n,"stepMonths"),"M");break;case 38:(t.ctrlKey||t.metaKey)&&e.datepicker._adjustDate(t.target,-7,"D"),r=t.ctrlKey||t.metaKey;break;case 39:(t.ctrlKey||t.metaKey)&&e.datepicker._adjustDate(t.target,o?-1:1,"D"),r=t.ctrlKey||t.metaKey,t.originalEvent.altKey&&e.datepicker._adjustDate(t.target,t.ctrlKey?+e.datepicker._get(n,"stepBigMonths"):+e.datepicker._get(n,"stepMonths"),"M");break;case 40:(t.ctrlKey||t.metaKey)&&e.datepicker._adjustDate(t.target,7,"D"),r=t.ctrlKey||t.metaKey;break;default:r=!1}else 36===t.keyCode&&t.ctrlKey?e.datepicker._showDatepicker(this):r=!1;r&&(t.preventDefault(),t.stopPropagation())},_doKeyPress:function(a){var i,s,n=e.datepicker._getInst(a.target);return e.datepicker._get(n,"constrainInput")?(i=e.datepicker._possibleChars(e.datepicker._get(n,"dateFormat")),s=String.fromCharCode(null==a.charCode?a.keyCode:a.charCode),a.ctrlKey||a.metaKey||" ">s||!i||i.indexOf(s)>-1):t},_doKeyUp:function(t){var a,i=e.datepicker._getInst(t.target);if(i.input.val()!==i.lastVal)try{a=e.datepicker.parseDate(e.datepicker._get(i,"dateFormat"),i.input?i.input.val():null,e.datepicker._getFormatConfig(i)),a&&(e.datepicker._setDateFromField(i),e.datepicker._updateAlternate(i),e.datepicker._updateDatepicker(i))}catch(s){}return!0},_showDatepicker:function(t){if(t=t.target||t,"input"!==t.nodeName.toLowerCase()&&(t=e("input",t.parentNode)[0]),!e.datepicker._isDisabledDatepicker(t)&&e.datepicker._lastInput!==t){var a,i,n,r,o,c,d;a=e.datepicker._getInst(t),e.datepicker._curInst&&e.datepicker._curInst!==a&&(e.datepicker._curInst.dpDiv.stop(!0,!0),a&&e.datepicker._datepickerShowing&&e.datepicker._hideDatepicker(e.datepicker._curInst.input[0])),i=e.datepicker._get(a,"beforeShow"),n=i?i.apply(t,[t,a]):{},n!==!1&&(s(a.settings,n),a.lastVal=null,e.datepicker._lastInput=t,e.datepicker._setDateFromField(a),e.datepicker._inDialog&&(t.value=""),e.datepicker._pos||(e.datepicker._pos=e.datepicker._findPos(t),e.datepicker._pos[1]+=t.offsetHeight),r=!1,e(t).parents().each(function(){return r|="fixed"===e(this).css("position"),!r}),o={left:e.datepicker._pos[0],top:e.datepicker._pos[1]},e.datepicker._pos=null,a.dpDiv.empty(),a.dpDiv.css({position:"absolute",display:"block",top:"-1000px"}),e.datepicker._updateDatepicker(a),o=e.datepicker._checkOffset(a,o,r),a.dpDiv.css({position:e.datepicker._inDialog&&e.blockUI?"static":r?"fixed":"absolute",display:"none",left:o.left+"px",top:o.top+"px"}),a.inline||(c=e.datepicker._get(a,"showAnim"),d=e.datepicker._get(a,"duration"),a.dpDiv.zIndex(e(t).zIndex()+1),e.datepicker._datepickerShowing=!0,e.effects&&e.effects.effect[c]?a.dpDiv.show(c,e.datepicker._get(a,"showOptions"),d):a.dpDiv[c||"show"](c?d:null),e.datepicker._shouldFocusInput(a)&&a.input.focus(),e.datepicker._curInst=a))}},_updateDatepicker:function(t){this.maxRows=4,n=t,t.dpDiv.empty().append(this._generateHTML(t)),this._attachHandlers(t),t.dpDiv.find("."+this._dayOverClass+" a").mouseover();var a,i=this._getNumberOfMonths(t),s=i[1],r=17;t.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""),s>1&&t.dpDiv.addClass("ui-datepicker-multi-"+s).css("width",r*s+"em"),t.dpDiv[(1!==i[0]||1!==i[1]?"add":"remove")+"Class"]("ui-datepicker-multi"),t.dpDiv[(this._get(t,"isRTL")?"add":"remove")+"Class"]("ui-datepicker-rtl"),t===e.datepicker._curInst&&e.datepicker._datepickerShowing&&e.datepicker._shouldFocusInput(t)&&t.input.focus(),t.yearshtml&&(a=t.yearshtml,setTimeout(function(){a===t.yearshtml&&t.yearshtml&&t.dpDiv.find("select.ui-datepicker-year:first").replaceWith(t.yearshtml),a=t.yearshtml=null},0))},_shouldFocusInput:function(e){return e.input&&e.input.is(":visible")&&!e.input.is(":disabled")&&!e.input.is(":focus")},_checkOffset:function(t,a,i){var s=t.dpDiv.outerWidth(),n=t.dpDiv.outerHeight(),r=t.input?t.input.outerWidth():0,o=t.input?t.input.outerHeight():0,c=document.documentElement.clientWidth+(i?0:e(document).scrollLeft()),d=document.documentElement.clientHeight+(i?0:e(document).scrollTop());return a.left-=this._get(t,"isRTL")?s-r:0,a.left-=i&&a.left===t.input.offset().left?e(document).scrollLeft():0,a.top-=i&&a.top===t.input.offset().top+o?e(document).scrollTop():0,a.left-=Math.min(a.left,a.left+s>c&&c>s?Math.abs(a.left+s-c):0),a.top-=Math.min(a.top,a.top+n>d&&d>n?Math.abs(n+o):0),a},_findPos:function(t){for(var a,i=this._getInst(t),s=this._get(i,"isRTL");t&&("hidden"===t.type||1!==t.nodeType||e.expr.filters.hidden(t));)t=t[s?"previousSibling":"nextSibling"];return a=e(t).offset(),[a.left,a.top]},_hideDatepicker:function(t){var a,i,s,n,o=this._curInst;!o||t&&o!==e.data(t,r)||this._datepickerShowing&&(a=this._get(o,"showAnim"),i=this._get(o,"duration"),s=function(){e.datepicker._tidyDialog(o)},e.effects&&(e.effects.effect[a]||e.effects[a])?o.dpDiv.hide(a,e.datepicker._get(o,"showOptions"),i,s):o.dpDiv["slideDown"===a?"slideUp":"fadeIn"===a?"fadeOut":"hide"](a?i:null,s),a||s(),this._datepickerShowing=!1,n=this._get(o,"onClose"),n&&n.apply(o.input?o.input[0]:null,[o.input?o.input.val():"",o]),this._lastInput=null,this._inDialog&&(this._dialogInput.css({position:"absolute",left:"0",top:"-100px"}),e.blockUI&&(e.unblockUI(),e("body").append(this.dpDiv))),this._inDialog=!1)},_tidyDialog:function(e){e.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")},_checkExternalClick:function(t){if(e.datepicker._curInst){var a=e(t.target),i=e.datepicker._getInst(a[0]);(a[0].id!==e.datepicker._mainDivId&&0===a.parents("#"+e.datepicker._mainDivId).length&&!a.hasClass(e.datepicker.markerClassName)&&!a.closest("."+e.datepicker._triggerClass).length&&e.datepicker._datepickerShowing&&(!e.datepicker._inDialog||!e.blockUI)||a.hasClass(e.datepicker.markerClassName)&&e.datepicker._curInst!==i)&&e.datepicker._hideDatepicker()}},_adjustDate:function(t,a,i){var s=e(t),n=this._getInst(s[0]);this._isDisabledDatepicker(s[0])||(this._adjustInstDate(n,a+("M"===i?this._get(n,"showCurrentAtPos"):0),i),this._updateDatepicker(n))},_gotoToday:function(t){var a,i=e(t),s=this._getInst(i[0]);this._get(s,"gotoCurrent")&&s.currentDay?(s.selectedDay=s.currentDay,s.drawMonth=s.selectedMonth=s.currentMonth,s.drawYear=s.selectedYear=s.currentYear):(a=new Date,s.selectedDay=a.getDate(),s.drawMonth=s.selectedMonth=a.getMonth(),s.drawYear=s.selectedYear=a.getFullYear()),this._notifyChange(s),this._adjustDate(i)},_selectMonthYear:function(t,a,i){var s=e(t),n=this._getInst(s[0]);n["selected"+("M"===i?"Month":"Year")]=n["draw"+("M"===i?"Month":"Year")]=parseInt(a.options[a.selectedIndex].value,10),this._notifyChange(n),this._adjustDate(s)},_selectDay:function(t,a,i,s){var n,r=e(t);e(s).hasClass(this._unselectableClass)||this._isDisabledDatepicker(r[0])||(n=this._getInst(r[0]),n.selectedDay=n.currentDay=e("a",s).html(),n.selectedMonth=n.currentMonth=a,n.selectedYear=n.currentYear=i,this._selectDate(t,this._formatDate(n,n.currentDay,n.currentMonth,n.currentYear)))},_clearDate:function(t){var a=e(t);this._selectDate(a,"")},_selectDate:function(t,a){var i,s=e(t),n=this._getInst(s[0]);a=null!=a?a:this._formatDate(n),n.input&&n.input.val(a),this._updateAlternate(n),i=this._get(n,"onSelect"),i?i.apply(n.input?n.input[0]:null,[a,n]):n.input&&n.input.trigger("change"),n.inline?this._updateDatepicker(n):(this._hideDatepicker(),this._lastInput=n.input[0],"object"!=typeof n.input[0]&&n.input.focus(),this._lastInput=null)},_updateAlternate:function(t){var a,i,s,n=this._get(t,"altField");n&&(a=this._get(t,"altFormat")||this._get(t,"dateFormat"),i=this._getDate(t),s=this.formatDate(a,i,this._getFormatConfig(t)),e(n).each(function(){e(this).val(s)}))},noWeekends:function(e){var t=e.getDay();return[t>0&&6>t,""]},iso8601Week:function(e){var t,a=new Date(e.getTime());return a.setDate(a.getDate()+4-(a.getDay()||7)),t=a.getTime(),a.setMonth(0),a.setDate(1),Math.floor(Math.round((t-a)/864e5)/7)+1},parseDate:function(a,i,s){if(null==a||null==i)throw"Invalid arguments";if(i="object"==typeof i?""+i:i+"",""===i)return null;var n,r,o,c,d=0,l=(s?s.shortYearCutoff:null)||this._defaults.shortYearCutoff,u="string"!=typeof l?l:(new Date).getFullYear()%100+parseInt(l,10),h=(s?s.dayNamesShort:null)||this._defaults.dayNamesShort,p=(s?s.dayNames:null)||this._defaults.dayNames,g=(s?s.monthNamesShort:null)||this._defaults.monthNamesShort,_=(s?s.monthNames:null)||this._defaults.monthNames,f=-1,m=-1,D=-1,k=-1,y=!1,v=function(e){var t=a.length>n+1&&a.charAt(n+1)===e;return t&&n++,t},M=function(e){var t=v(e),a="@"===e?14:"!"===e?20:"y"===e&&t?4:"o"===e?3:2,s=RegExp("^\\d{1,"+a+"}"),n=i.substring(d).match(s);if(!n)throw"Missing number at position "+d;return d+=n[0].length,parseInt(n[0],10)},b=function(a,s,n){var r=-1,o=e.map(v(a)?n:s,function(e,t){return[[t,e]]}).sort(function(e,t){return-(e[1].length-t[1].length)});if(e.each(o,function(e,a){var s=a[1];return i.substr(d,s.length).toLowerCase()===s.toLowerCase()?(r=a[0],d+=s.length,!1):t}),-1!==r)return r+1;throw"Unknown name at position "+d},w=function(){if(i.charAt(d)!==a.charAt(n))throw"Unexpected literal at position "+d;d++};for(n=0;a.length>n;n++)if(y)"'"!==a.charAt(n)||v("'")?w():y=!1;else switch(a.charAt(n)){case"d":D=M("d");break;case"D":b("D",h,p);break;case"o":k=M("o");break;case"m":m=M("m");break;case"M":m=b("M",g,_);break;case"y":f=M("y");break;case"@":c=new Date(M("@")),f=c.getFullYear(),m=c.getMonth()+1,D=c.getDate();break;case"!":c=new Date((M("!")-this._ticksTo1970)/1e4),f=c.getFullYear(),m=c.getMonth()+1,D=c.getDate();break;case"'":v("'")?w():y=!0;break;default:w()}if(i.length>d&&(o=i.substr(d),!/^\s+/.test(o)))throw"Extra/unparsed characters found in date: "+o;if(-1===f?f=(new Date).getFullYear():100>f&&(f+=(new Date).getFullYear()-(new Date).getFullYear()%100+(u>=f?0:-100)),k>-1)for(m=1,D=k;;){if(r=this._getDaysInMonth(f,m-1),r>=D)break;m++,D-=r}if(c=this._daylightSavingAdjust(new Date(f,m-1,D)),c.getFullYear()!==f||c.getMonth()+1!==m||c.getDate()!==D)throw"Invalid date";return c},ATOM:"yy-mm-dd",COOKIE:"D, dd M yy",ISO_8601:"yy-mm-dd",RFC_822:"D, d M y",RFC_850:"DD, dd-M-y",RFC_1036:"D, d M y",RFC_1123:"D, d M yy",RFC_2822:"D, d M yy",RSS:"D, d M y",TICKS:"!",TIMESTAMP:"@",W3C:"yy-mm-dd",_ticksTo1970:1e7*60*60*24*(718685+Math.floor(492.5)-Math.floor(19.7)+Math.floor(4.925)),formatDate:function(e,t,a){if(!t)return"";var i,s=(a?a.dayNamesShort:null)||this._defaults.dayNamesShort,n=(a?a.dayNames:null)||this._defaults.dayNames,r=(a?a.monthNamesShort:null)||this._defaults.monthNamesShort,o=(a?a.monthNames:null)||this._defaults.monthNames,c=function(t){var a=e.length>i+1&&e.charAt(i+1)===t;return a&&i++,a},d=function(e,t,a){var i=""+t;if(c(e))for(;a>i.length;)i="0"+i;return i},l=function(e,t,a,i){return c(e)?i[t]:a[t]},u="",h=!1;if(t)for(i=0;e.length>i;i++)if(h)"'"!==e.charAt(i)||c("'")?u+=e.charAt(i):h=!1;else switch(e.charAt(i)){case"d":u+=d("d",t.getDate(),2);break;case"D":u+=l("D",t.getDay(),s,n);break;case"o":u+=d("o",Math.round((new Date(t.getFullYear(),t.getMonth(),t.getDate()).getTime()-new Date(t.getFullYear(),0,0).getTime())/864e5),3);break;case"m":u+=d("m",t.getMonth()+1,2);break;case"M":u+=l("M",t.getMonth(),r,o);break;case"y":u+=c("y")?t.getFullYear():(10>t.getYear()%100?"0":"")+t.getYear()%100;break;case"@":u+=t.getTime();break;case"!":u+=1e4*t.getTime()+this._ticksTo1970;break;case"'":c("'")?u+="'":h=!0;break;default:u+=e.charAt(i)}return u},_possibleChars:function(e){var t,a="",i=!1,s=function(a){var i=e.length>t+1&&e.charAt(t+1)===a;return i&&t++,i};for(t=0;e.length>t;t++)if(i)"'"!==e.charAt(t)||s("'")?a+=e.charAt(t):i=!1;else switch(e.charAt(t)){case"d":case"m":case"y":case"@":a+="0123456789";break;case"D":case"M":return null;case"'":s("'")?a+="'":i=!0;break;default:a+=e.charAt(t)}return a},_get:function(e,a){return e.settings[a]!==t?e.settings[a]:this._defaults[a]},_setDateFromField:function(e,t){if(e.input.val()!==e.lastVal){var a=this._get(e,"dateFormat"),i=e.lastVal=e.input?e.input.val():null,s=this._getDefaultDate(e),n=s,r=this._getFormatConfig(e);try{n=this.parseDate(a,i,r)||s}catch(o){i=t?"":i}e.selectedDay=n.getDate(),e.drawMonth=e.selectedMonth=n.getMonth(),e.drawYear=e.selectedYear=n.getFullYear(),e.currentDay=i?n.getDate():0,e.currentMonth=i?n.getMonth():0,e.currentYear=i?n.getFullYear():0,this._adjustInstDate(e)}},_getDefaultDate:function(e){return this._restrictMinMax(e,this._determineDate(e,this._get(e,"defaultDate"),new Date))},_determineDate:function(t,a,i){var s=function(e){var t=new Date;return t.setDate(t.getDate()+e),t},n=function(a){try{return e.datepicker.parseDate(e.datepicker._get(t,"dateFormat"),a,e.datepicker._getFormatConfig(t))}catch(i){}for(var s=(a.toLowerCase().match(/^c/)?e.datepicker._getDate(t):null)||new Date,n=s.getFullYear(),r=s.getMonth(),o=s.getDate(),c=/([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,d=c.exec(a);d;){switch(d[2]||"d"){case"d":case"D":o+=parseInt(d[1],10);break;case"w":case"W":o+=7*parseInt(d[1],10);break;case"m":case"M":r+=parseInt(d[1],10),o=Math.min(o,e.datepicker._getDaysInMonth(n,r));break;case"y":case"Y":n+=parseInt(d[1],10),o=Math.min(o,e.datepicker._getDaysInMonth(n,r))}d=c.exec(a)}return new Date(n,r,o)},r=null==a||""===a?i:"string"==typeof a?n(a):"number"==typeof a?isNaN(a)?i:s(a):new Date(a.getTime());return r=r&&"Invalid Date"==""+r?i:r,r&&(r.setHours(0),r.setMinutes(0),r.setSeconds(0),r.setMilliseconds(0)),this._daylightSavingAdjust(r)},_daylightSavingAdjust:function(e){return e?(e.setHours(e.getHours()>12?e.getHours()+2:0),e):null},_setDate:function(e,t,a){var i=!t,s=e.selectedMonth,n=e.selectedYear,r=this._restrictMinMax(e,this._determineDate(e,t,new Date));e.selectedDay=e.currentDay=r.getDate(),e.drawMonth=e.selectedMonth=e.currentMonth=r.getMonth(),e.drawYear=e.selectedYear=e.currentYear=r.getFullYear(),s===e.selectedMonth&&n===e.selectedYear||a||this._notifyChange(e),this._adjustInstDate(e),e.input&&e.input.val(i?"":this._formatDate(e))},_getDate:function(e){var t=!e.currentYear||e.input&&""===e.input.val()?null:this._daylightSavingAdjust(new Date(e.currentYear,e.currentMonth,e.currentDay));return t},_attachHandlers:function(t){var a=this._get(t,"stepMonths"),i="#"+t.id.replace(/\\\\/g,"\\");t.dpDiv.find("[data-handler]").map(function(){var t={prev:function(){e.datepicker._adjustDate(i,-a,"M")},next:function(){e.datepicker._adjustDate(i,+a,"M")},hide:function(){e.datepicker._hideDatepicker()},today:function(){e.datepicker._gotoToday(i)},selectDay:function(){return e.datepicker._selectDay(i,+this.getAttribute("data-month"),+this.getAttribute("data-year"),this),!1},selectMonth:function(){return e.datepicker._selectMonthYear(i,this,"M"),!1},selectYear:function(){return e.datepicker._selectMonthYear(i,this,"Y"),!1}};e(this).bind(this.getAttribute("data-event"),t[this.getAttribute("data-handler")])})},_generateHTML:function(e){var t,a,i,s,n,r,o,c,d,l,u,h,p,g,_,f,m,D,k,y,v,M,b,w,C,I,x,N,Y,S,A,T,F,j,K,O,E,P,L,R=new Date,W=this._daylightSavingAdjust(new Date(R.getFullYear(),R.getMonth(),R.getDate())),H=this._get(e,"isRTL"),U=this._get(e,"showButtonPanel"),z=this._get(e,"hideIfNoPrevNext"),B=this._get(e,"navigationAsDateFormat"),J=this._getNumberOfMonths(e),q=this._get(e,"showCurrentAtPos"),V=this._get(e,"stepMonths"),G=1!==J[0]||1!==J[1],Q=this._daylightSavingAdjust(e.currentDay?new Date(e.currentYear,e.currentMonth,e.currentDay):new Date(9999,9,9)),$=this._getMinMaxDate(e,"min"),X=this._getMinMaxDate(e,"max"),Z=e.drawMonth-q,et=e.drawYear;if(0>Z&&(Z+=12,et--),X)for(t=this._daylightSavingAdjust(new Date(X.getFullYear(),X.getMonth()-J[0]*J[1]+1,X.getDate())),t=$&&$>t?$:t;this._daylightSavingAdjust(new Date(et,Z,1))>t;)Z--,0>Z&&(Z=11,et--);for(e.drawMonth=Z,e.drawYear=et,a=this._get(e,"prevText"),a=B?this.formatDate(a,this._daylightSavingAdjust(new Date(et,Z-V,1)),this._getFormatConfig(e)):a,i=this._canAdjustMonth(e,-1,et,Z)?"<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='"+a+"'><span class='ui-icon ui-icon-circle-triangle-"+(H?"e":"w")+"'>"+a+"</span></a>":z?"":"<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='"+a+"'><span class='ui-icon ui-icon-circle-triangle-"+(H?"e":"w")+"'>"+a+"</span></a>",s=this._get(e,"nextText"),s=B?this.formatDate(s,this._daylightSavingAdjust(new Date(et,Z+V,1)),this._getFormatConfig(e)):s,n=this._canAdjustMonth(e,1,et,Z)?"<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='"+s+"'><span class='ui-icon ui-icon-circle-triangle-"+(H?"w":"e")+"'>"+s+"</span></a>":z?"":"<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='"+s+"'><span class='ui-icon ui-icon-circle-triangle-"+(H?"w":"e")+"'>"+s+"</span></a>",r=this._get(e,"currentText"),o=this._get(e,"gotoCurrent")&&e.currentDay?Q:W,r=B?this.formatDate(r,o,this._getFormatConfig(e)):r,c=e.inline?"":"<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>"+this._get(e,"closeText")+"</button>",d=U?"<div class='ui-datepicker-buttonpane ui-widget-content'>"+(H?c:"")+(this._isInRange(e,o)?"<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>"+r+"</button>":"")+(H?"":c)+"</div>":"",l=parseInt(this._get(e,"firstDay"),10),l=isNaN(l)?0:l,u=this._get(e,"showWeek"),h=this._get(e,"dayNames"),p=this._get(e,"dayNamesMin"),g=this._get(e,"monthNames"),_=this._get(e,"monthNamesShort"),f=this._get(e,"beforeShowDay"),m=this._get(e,"showOtherMonths"),D=this._get(e,"selectOtherMonths"),k=this._getDefaultDate(e),y="",M=0;J[0]>M;M++){for(b="",this.maxRows=4,w=0;J[1]>w;w++){if(C=this._daylightSavingAdjust(new Date(et,Z,e.selectedDay)),I=" ui-corner-all",x="",G){if(x+="<div class='ui-datepicker-group",J[1]>1)switch(w){case 0:x+=" ui-datepicker-group-first",I=" ui-corner-"+(H?"right":"left");break;case J[1]-1:x+=" ui-datepicker-group-last",I=" ui-corner-"+(H?"left":"right");break;default:x+=" ui-datepicker-group-middle",I=""}x+="'>"}for(x+="<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix"+I+"'>"+(/all|left/.test(I)&&0===M?H?n:i:"")+(/all|right/.test(I)&&0===M?H?i:n:"")+this._generateMonthYearHeader(e,Z,et,$,X,M>0||w>0,g,_)+"</div><table class='ui-datepicker-calendar'><thead>"+"<tr>",N=u?"<th class='ui-datepicker-week-col'>"+this._get(e,"weekHeader")+"</th>":"",v=0;7>v;v++)Y=(v+l)%7,N+="<th"+((v+l+6)%7>=5?" class='ui-datepicker-week-end'":"")+">"+"<span title='"+h[Y]+"'>"+p[Y]+"</span></th>";for(x+=N+"</tr></thead><tbody>",S=this._getDaysInMonth(et,Z),et===e.selectedYear&&Z===e.selectedMonth&&(e.selectedDay=Math.min(e.selectedDay,S)),A=(this._getFirstDayOfMonth(et,Z)-l+7)%7,T=Math.ceil((A+S)/7),F=G?this.maxRows>T?this.maxRows:T:T,this.maxRows=F,j=this._daylightSavingAdjust(new Date(et,Z,1-A)),K=0;F>K;K++){for(x+="<tr>",O=u?"<td class='ui-datepicker-week-col'>"+this._get(e,"calculateWeek")(j)+"</td>":"",v=0;7>v;v++)E=f?f.apply(e.input?e.input[0]:null,[j]):[!0,""],P=j.getMonth()!==Z,L=P&&!D||!E[0]||$&&$>j||X&&j>X,O+="<td class='"+((v+l+6)%7>=5?" ui-datepicker-week-end":"")+(P?" ui-datepicker-other-month":"")+(j.getTime()===C.getTime()&&Z===e.selectedMonth&&e._keyEvent||k.getTime()===j.getTime()&&k.getTime()===C.getTime()?" "+this._dayOverClass:"")+(L?" "+this._unselectableClass+" ui-state-disabled":"")+(P&&!m?"":" "+E[1]+(j.getTime()===Q.getTime()?" "+this._currentClass:"")+(j.getTime()===W.getTime()?" ui-datepicker-today":""))+"'"+(P&&!m||!E[2]?"":" title='"+E[2].replace(/'/g,"&#39;")+"'")+(L?"":" data-handler='selectDay' data-event='click' data-month='"+j.getMonth()+"' data-year='"+j.getFullYear()+"'")+">"+(P&&!m?"&#xa0;":L?"<span class='ui-state-default'>"+j.getDate()+"</span>":"<a class='ui-state-default"+(j.getTime()===W.getTime()?" ui-state-highlight":"")+(j.getTime()===Q.getTime()?" ui-state-active":"")+(P?" ui-priority-secondary":"")+"' href='#'>"+j.getDate()+"</a>")+"</td>",j.setDate(j.getDate()+1),j=this._daylightSavingAdjust(j);x+=O+"</tr>"}Z++,Z>11&&(Z=0,et++),x+="</tbody></table>"+(G?"</div>"+(J[0]>0&&w===J[1]-1?"<div class='ui-datepicker-row-break'></div>":""):""),b+=x}y+=b}return y+=d,e._keyEvent=!1,y},_generateMonthYearHeader:function(e,t,a,i,s,n,r,o){var c,d,l,u,h,p,g,_,f=this._get(e,"changeMonth"),m=this._get(e,"changeYear"),D=this._get(e,"showMonthAfterYear"),k="<div class='ui-datepicker-title'>",y="";if(n||!f)y+="<span class='ui-datepicker-month'>"+r[t]+"</span>";else{for(c=i&&i.getFullYear()===a,d=s&&s.getFullYear()===a,y+="<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>",l=0;12>l;l++)(!c||l>=i.getMonth())&&(!d||s.getMonth()>=l)&&(y+="<option value='"+l+"'"+(l===t?" selected='selected'":"")+">"+o[l]+"</option>");y+="</select>"}if(D||(k+=y+(!n&&f&&m?"":"&#xa0;")),!e.yearshtml)if(e.yearshtml="",n||!m)k+="<span class='ui-datepicker-year'>"+a+"</span>";else{for(u=this._get(e,"yearRange").split(":"),h=(new Date).getFullYear(),p=function(e){var t=e.match(/c[+\-].*/)?a+parseInt(e.substring(1),10):e.match(/[+\-].*/)?h+parseInt(e,10):parseInt(e,10);
return isNaN(t)?h:t},g=p(u[0]),_=Math.max(g,p(u[1]||"")),g=i?Math.max(g,i.getFullYear()):g,_=s?Math.min(_,s.getFullYear()):_,e.yearshtml+="<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>";_>=g;g++)e.yearshtml+="<option value='"+g+"'"+(g===a?" selected='selected'":"")+">"+g+"</option>";e.yearshtml+="</select>",k+=e.yearshtml,e.yearshtml=null}return k+=this._get(e,"yearSuffix"),D&&(k+=(!n&&f&&m?"":"&#xa0;")+y),k+="</div>"},_adjustInstDate:function(e,t,a){var i=e.drawYear+("Y"===a?t:0),s=e.drawMonth+("M"===a?t:0),n=Math.min(e.selectedDay,this._getDaysInMonth(i,s))+("D"===a?t:0),r=this._restrictMinMax(e,this._daylightSavingAdjust(new Date(i,s,n)));e.selectedDay=r.getDate(),e.drawMonth=e.selectedMonth=r.getMonth(),e.drawYear=e.selectedYear=r.getFullYear(),("M"===a||"Y"===a)&&this._notifyChange(e)},_restrictMinMax:function(e,t){var a=this._getMinMaxDate(e,"min"),i=this._getMinMaxDate(e,"max"),s=a&&a>t?a:t;return i&&s>i?i:s},_notifyChange:function(e){var t=this._get(e,"onChangeMonthYear");t&&t.apply(e.input?e.input[0]:null,[e.selectedYear,e.selectedMonth+1,e])},_getNumberOfMonths:function(e){var t=this._get(e,"numberOfMonths");return null==t?[1,1]:"number"==typeof t?[1,t]:t},_getMinMaxDate:function(e,t){return this._determineDate(e,this._get(e,t+"Date"),null)},_getDaysInMonth:function(e,t){return 32-this._daylightSavingAdjust(new Date(e,t,32)).getDate()},_getFirstDayOfMonth:function(e,t){return new Date(e,t,1).getDay()},_canAdjustMonth:function(e,t,a,i){var s=this._getNumberOfMonths(e),n=this._daylightSavingAdjust(new Date(a,i+(0>t?t:s[0]*s[1]),1));return 0>t&&n.setDate(this._getDaysInMonth(n.getFullYear(),n.getMonth())),this._isInRange(e,n)},_isInRange:function(e,t){var a,i,s=this._getMinMaxDate(e,"min"),n=this._getMinMaxDate(e,"max"),r=null,o=null,c=this._get(e,"yearRange");return c&&(a=c.split(":"),i=(new Date).getFullYear(),r=parseInt(a[0],10),o=parseInt(a[1],10),a[0].match(/[+\-].*/)&&(r+=i),a[1].match(/[+\-].*/)&&(o+=i)),(!s||t.getTime()>=s.getTime())&&(!n||t.getTime()<=n.getTime())&&(!r||t.getFullYear()>=r)&&(!o||o>=t.getFullYear())},_getFormatConfig:function(e){var t=this._get(e,"shortYearCutoff");return t="string"!=typeof t?t:(new Date).getFullYear()%100+parseInt(t,10),{shortYearCutoff:t,dayNamesShort:this._get(e,"dayNamesShort"),dayNames:this._get(e,"dayNames"),monthNamesShort:this._get(e,"monthNamesShort"),monthNames:this._get(e,"monthNames")}},_formatDate:function(e,t,a,i){t||(e.currentDay=e.selectedDay,e.currentMonth=e.selectedMonth,e.currentYear=e.selectedYear);var s=t?"object"==typeof t?t:this._daylightSavingAdjust(new Date(i,a,t)):this._daylightSavingAdjust(new Date(e.currentYear,e.currentMonth,e.currentDay));return this.formatDate(this._get(e,"dateFormat"),s,this._getFormatConfig(e))}}),e.fn.datepicker=function(t){if(!this.length)return this;e.datepicker.initialized||(e(document).mousedown(e.datepicker._checkExternalClick),e.datepicker.initialized=!0),0===e("#"+e.datepicker._mainDivId).length&&e("body").append(e.datepicker.dpDiv);var a=Array.prototype.slice.call(arguments,1);return"string"!=typeof t||"isDisabled"!==t&&"getDate"!==t&&"widget"!==t?"option"===t&&2===arguments.length&&"string"==typeof arguments[1]?e.datepicker["_"+t+"Datepicker"].apply(e.datepicker,[this[0]].concat(a)):this.each(function(){"string"==typeof t?e.datepicker["_"+t+"Datepicker"].apply(e.datepicker,[this].concat(a)):e.datepicker._attachDatepicker(this,t)}):e.datepicker["_"+t+"Datepicker"].apply(e.datepicker,[this[0]].concat(a))},e.datepicker=new a,e.datepicker.initialized=!1,e.datepicker.uuid=(new Date).getTime(),e.datepicker.version="1.10.3"})(jQuery);(function(e){var t={buttons:!0,height:!0,maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0,width:!0},a={maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0};e.widget("ui.dialog",{version:"1.10.3",options:{appendTo:"body",autoOpen:!0,buttons:[],closeOnEscape:!0,closeText:"close",dialogClass:"",draggable:!0,hide:null,height:"auto",maxHeight:null,maxWidth:null,minHeight:150,minWidth:150,modal:!1,position:{my:"center",at:"center",of:window,collision:"fit",using:function(t){var a=e(this).css(t).offset().top;0>a&&e(this).css("top",t.top-a)}},resizable:!0,show:null,title:null,width:300,beforeClose:null,close:null,drag:null,dragStart:null,dragStop:null,focus:null,open:null,resize:null,resizeStart:null,resizeStop:null},_create:function(){this.originalCss={display:this.element[0].style.display,width:this.element[0].style.width,minHeight:this.element[0].style.minHeight,maxHeight:this.element[0].style.maxHeight,height:this.element[0].style.height},this.originalPosition={parent:this.element.parent(),index:this.element.parent().children().index(this.element)},this.originalTitle=this.element.attr("title"),this.options.title=this.options.title||this.originalTitle,this._createWrapper(),this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog),this._createTitlebar(),this._createButtonPane(),this.options.draggable&&e.fn.draggable&&this._makeDraggable(),this.options.resizable&&e.fn.resizable&&this._makeResizable(),this._isOpen=!1},_init:function(){this.options.autoOpen&&this.open()},_appendTo:function(){var t=this.options.appendTo;return t&&(t.jquery||t.nodeType)?e(t):this.document.find(t||"body").eq(0)},_destroy:function(){var e,t=this.originalPosition;this._destroyOverlay(),this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach(),this.uiDialog.stop(!0,!0).remove(),this.originalTitle&&this.element.attr("title",this.originalTitle),e=t.parent.children().eq(t.index),e.length&&e[0]!==this.element[0]?e.before(this.element):t.parent.append(this.element)},widget:function(){return this.uiDialog},disable:e.noop,enable:e.noop,close:function(t){var a=this;this._isOpen&&this._trigger("beforeClose",t)!==!1&&(this._isOpen=!1,this._destroyOverlay(),this.opener.filter(":focusable").focus().length||e(this.document[0].activeElement).blur(),this._hide(this.uiDialog,this.options.hide,function(){a._trigger("close",t)}))},isOpen:function(){return this._isOpen},moveToTop:function(){this._moveToTop()},_moveToTop:function(e,t){var a=!!this.uiDialog.nextAll(":visible").insertBefore(this.uiDialog).length;return a&&!t&&this._trigger("focus",e),a},open:function(){var t=this;return this._isOpen?(this._moveToTop()&&this._focusTabbable(),undefined):(this._isOpen=!0,this.opener=e(this.document[0].activeElement),this._size(),this._position(),this._createOverlay(),this._moveToTop(null,!0),this._show(this.uiDialog,this.options.show,function(){t._focusTabbable(),t._trigger("focus")}),this._trigger("open"),undefined)},_focusTabbable:function(){var e=this.element.find("[autofocus]");e.length||(e=this.element.find(":tabbable")),e.length||(e=this.uiDialogButtonPane.find(":tabbable")),e.length||(e=this.uiDialogTitlebarClose.filter(":tabbable")),e.length||(e=this.uiDialog),e.eq(0).focus()},_keepFocus:function(t){function a(){var t=this.document[0].activeElement,a=this.uiDialog[0]===t||e.contains(this.uiDialog[0],t);a||this._focusTabbable()}t.preventDefault(),a.call(this),this._delay(a)},_createWrapper:function(){this.uiDialog=e("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front "+this.options.dialogClass).hide().attr({tabIndex:-1,role:"dialog"}).appendTo(this._appendTo()),this._on(this.uiDialog,{keydown:function(t){if(this.options.closeOnEscape&&!t.isDefaultPrevented()&&t.keyCode&&t.keyCode===e.ui.keyCode.ESCAPE)return t.preventDefault(),this.close(t),undefined;if(t.keyCode===e.ui.keyCode.TAB){var a=this.uiDialog.find(":tabbable"),i=a.filter(":first"),r=a.filter(":last");t.target!==r[0]&&t.target!==this.uiDialog[0]||t.shiftKey?t.target!==i[0]&&t.target!==this.uiDialog[0]||!t.shiftKey||(r.focus(1),t.preventDefault()):(i.focus(1),t.preventDefault())}},mousedown:function(e){this._moveToTop(e)&&this._focusTabbable()}}),this.element.find("[aria-describedby]").length||this.uiDialog.attr({"aria-describedby":this.element.uniqueId().attr("id")})},_createTitlebar:function(){var t;this.uiDialogTitlebar=e("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog),this._on(this.uiDialogTitlebar,{mousedown:function(t){e(t.target).closest(".ui-dialog-titlebar-close")||this.uiDialog.focus()}}),this.uiDialogTitlebarClose=e("<button></button>").button({label:this.options.closeText,icons:{primary:"ui-icon-closethick"},text:!1}).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar),this._on(this.uiDialogTitlebarClose,{click:function(e){e.preventDefault(),this.close(e)}}),t=e("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar),this._title(t),this.uiDialog.attr({"aria-labelledby":t.attr("id")})},_title:function(e){this.options.title||e.html("&#160;"),e.text(this.options.title)},_createButtonPane:function(){this.uiDialogButtonPane=e("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"),this.uiButtonSet=e("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane),this._createButtons()},_createButtons:function(){var t=this,a=this.options.buttons;return this.uiDialogButtonPane.remove(),this.uiButtonSet.empty(),e.isEmptyObject(a)||e.isArray(a)&&!a.length?(this.uiDialog.removeClass("ui-dialog-buttons"),undefined):(e.each(a,function(a,i){var r,n;i=e.isFunction(i)?{click:i,text:a}:i,i=e.extend({type:"button"},i),r=i.click,i.click=function(){r.apply(t.element[0],arguments)},n={icons:i.icons,text:i.showText},delete i.icons,delete i.showText,e("<button></button>",i).button(n).appendTo(t.uiButtonSet)}),this.uiDialog.addClass("ui-dialog-buttons"),this.uiDialogButtonPane.appendTo(this.uiDialog),undefined)},_makeDraggable:function(){function t(e){return{position:e.position,offset:e.offset}}var a=this,i=this.options;this.uiDialog.draggable({cancel:".ui-dialog-content, .ui-dialog-titlebar-close",handle:".ui-dialog-titlebar",containment:"document",start:function(i,r){e(this).addClass("ui-dialog-dragging"),a._blockFrames(),a._trigger("dragStart",i,t(r))},drag:function(e,i){a._trigger("drag",e,t(i))},stop:function(r,n){i.position=[n.position.left-a.document.scrollLeft(),n.position.top-a.document.scrollTop()],e(this).removeClass("ui-dialog-dragging"),a._unblockFrames(),a._trigger("dragStop",r,t(n))}})},_makeResizable:function(){function t(e){return{originalPosition:e.originalPosition,originalSize:e.originalSize,position:e.position,size:e.size}}var a=this,i=this.options,r=i.resizable,n=this.uiDialog.css("position"),s="string"==typeof r?r:"n,e,s,w,se,sw,ne,nw";this.uiDialog.resizable({cancel:".ui-dialog-content",containment:"document",alsoResize:this.element,maxWidth:i.maxWidth,maxHeight:i.maxHeight,minWidth:i.minWidth,minHeight:this._minHeight(),handles:s,start:function(i,r){e(this).addClass("ui-dialog-resizing"),a._blockFrames(),a._trigger("resizeStart",i,t(r))},resize:function(e,i){a._trigger("resize",e,t(i))},stop:function(r,n){i.height=e(this).height(),i.width=e(this).width(),e(this).removeClass("ui-dialog-resizing"),a._unblockFrames(),a._trigger("resizeStop",r,t(n))}}).css("position",n)},_minHeight:function(){var e=this.options;return"auto"===e.height?e.minHeight:Math.min(e.minHeight,e.height)},_position:function(){var e=this.uiDialog.is(":visible");e||this.uiDialog.show(),this.uiDialog.position(this.options.position),e||this.uiDialog.hide()},_setOptions:function(i){var r=this,n=!1,s={};e.each(i,function(e,i){r._setOption(e,i),e in t&&(n=!0),e in a&&(s[e]=i)}),n&&(this._size(),this._position()),this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option",s)},_setOption:function(e,t){var a,i,r=this.uiDialog;"dialogClass"===e&&r.removeClass(this.options.dialogClass).addClass(t),"disabled"!==e&&(this._super(e,t),"appendTo"===e&&this.uiDialog.appendTo(this._appendTo()),"buttons"===e&&this._createButtons(),"closeText"===e&&this.uiDialogTitlebarClose.button({label:""+t}),"draggable"===e&&(a=r.is(":data(ui-draggable)"),a&&!t&&r.draggable("destroy"),!a&&t&&this._makeDraggable()),"position"===e&&this._position(),"resizable"===e&&(i=r.is(":data(ui-resizable)"),i&&!t&&r.resizable("destroy"),i&&"string"==typeof t&&r.resizable("option","handles",t),i||t===!1||this._makeResizable()),"title"===e&&this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))},_size:function(){var e,t,a,i=this.options;this.element.show().css({width:"auto",minHeight:0,maxHeight:"none",height:0}),i.minWidth>i.width&&(i.width=i.minWidth),e=this.uiDialog.css({height:"auto",width:i.width}).outerHeight(),t=Math.max(0,i.minHeight-e),a="number"==typeof i.maxHeight?Math.max(0,i.maxHeight-e):"none","auto"===i.height?this.element.css({minHeight:t,maxHeight:a,height:"auto"}):this.element.height(Math.max(0,i.height-e)),this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option","minHeight",this._minHeight())},_blockFrames:function(){this.iframeBlocks=this.document.find("iframe").map(function(){var t=e(this);return e("<div>").css({position:"absolute",width:t.outerWidth(),height:t.outerHeight()}).appendTo(t.parent()).offset(t.offset())[0]})},_unblockFrames:function(){this.iframeBlocks&&(this.iframeBlocks.remove(),delete this.iframeBlocks)},_allowInteraction:function(t){return e(t.target).closest(".ui-dialog").length?!0:!!e(t.target).closest(".ui-datepicker").length},_createOverlay:function(){if(this.options.modal){var t=this,a=this.widgetFullName;e.ui.dialog.overlayInstances||this._delay(function(){e.ui.dialog.overlayInstances&&this.document.bind("focusin.dialog",function(i){t._allowInteraction(i)||(i.preventDefault(),e(".ui-dialog:visible:last .ui-dialog-content").data(a)._focusTabbable())})}),this.overlay=e("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo()),this._on(this.overlay,{mousedown:"_keepFocus"}),e.ui.dialog.overlayInstances++}},_destroyOverlay:function(){this.options.modal&&this.overlay&&(e.ui.dialog.overlayInstances--,e.ui.dialog.overlayInstances||this.document.unbind("focusin.dialog"),this.overlay.remove(),this.overlay=null)}}),e.ui.dialog.overlayInstances=0,e.uiBackCompat!==!1&&e.widget("ui.dialog",e.ui.dialog,{_position:function(){var t,a=this.options.position,i=[],r=[0,0];a?(("string"==typeof a||"object"==typeof a&&"0"in a)&&(i=a.split?a.split(" "):[a[0],a[1]],1===i.length&&(i[1]=i[0]),e.each(["left","top"],function(e,t){+i[e]===i[e]&&(r[e]=i[e],i[e]=t)}),a={my:i[0]+(0>r[0]?r[0]:"+"+r[0])+" "+i[1]+(0>r[1]?r[1]:"+"+r[1]),at:i.join(" ")}),a=e.extend({},e.ui.dialog.prototype.options.position,a)):a=e.ui.dialog.prototype.options.position,t=this.uiDialog.is(":visible"),t||this.uiDialog.show(),this.uiDialog.position(a),t||this.uiDialog.hide()}})})(jQuery);(function(e,t){function i(){return++s}function a(e){return e.hash.length>1&&decodeURIComponent(e.href.replace(r,""))===decodeURIComponent(location.href.replace(r,""))}var s=0,r=/#.*$/;e.widget("ui.tabs",{version:"1.10.3",delay:300,options:{active:null,collapsible:!1,event:"click",heightStyle:"content",hide:null,show:null,activate:null,beforeActivate:null,beforeLoad:null,load:null},_create:function(){var t=this,i=this.options;this.running=!1,this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all").toggleClass("ui-tabs-collapsible",i.collapsible).delegate(".ui-tabs-nav > li","mousedown"+this.eventNamespace,function(t){e(this).is(".ui-state-disabled")&&t.preventDefault()}).delegate(".ui-tabs-anchor","focus"+this.eventNamespace,function(){e(this).closest("li").is(".ui-state-disabled")&&this.blur()}),this._processTabs(),i.active=this._initialActive(),e.isArray(i.disabled)&&(i.disabled=e.unique(i.disabled.concat(e.map(this.tabs.filter(".ui-state-disabled"),function(e){return t.tabs.index(e)}))).sort()),this.active=this.options.active!==!1&&this.anchors.length?this._findActive(i.active):e(),this._refresh(),this.active.length&&this.load(i.active)},_initialActive:function(){var i=this.options.active,a=this.options.collapsible,s=location.hash.substring(1);return null===i&&(s&&this.tabs.each(function(a,r){return e(r).attr("aria-controls")===s?(i=a,!1):t}),null===i&&(i=this.tabs.index(this.tabs.filter(".ui-tabs-active"))),(null===i||-1===i)&&(i=this.tabs.length?0:!1)),i!==!1&&(i=this.tabs.index(this.tabs.eq(i)),-1===i&&(i=a?!1:0)),!a&&i===!1&&this.anchors.length&&(i=0),i},_getCreateEventData:function(){return{tab:this.active,panel:this.active.length?this._getPanelForTab(this.active):e()}},_tabKeydown:function(i){var a=e(this.document[0].activeElement).closest("li"),s=this.tabs.index(a),r=!0;if(!this._handlePageNav(i)){switch(i.keyCode){case e.ui.keyCode.RIGHT:case e.ui.keyCode.DOWN:s++;break;case e.ui.keyCode.UP:case e.ui.keyCode.LEFT:r=!1,s--;break;case e.ui.keyCode.END:s=this.anchors.length-1;break;case e.ui.keyCode.HOME:s=0;break;case e.ui.keyCode.SPACE:return i.preventDefault(),clearTimeout(this.activating),this._activate(s),t;case e.ui.keyCode.ENTER:return i.preventDefault(),clearTimeout(this.activating),this._activate(s===this.options.active?!1:s),t;default:return}i.preventDefault(),clearTimeout(this.activating),s=this._focusNextTab(s,r),i.ctrlKey||(a.attr("aria-selected","false"),this.tabs.eq(s).attr("aria-selected","true"),this.activating=this._delay(function(){this.option("active",s)},this.delay))}},_panelKeydown:function(t){this._handlePageNav(t)||t.ctrlKey&&t.keyCode===e.ui.keyCode.UP&&(t.preventDefault(),this.active.focus())},_handlePageNav:function(i){return i.altKey&&i.keyCode===e.ui.keyCode.PAGE_UP?(this._activate(this._focusNextTab(this.options.active-1,!1)),!0):i.altKey&&i.keyCode===e.ui.keyCode.PAGE_DOWN?(this._activate(this._focusNextTab(this.options.active+1,!0)),!0):t},_findNextTab:function(t,i){function a(){return t>s&&(t=0),0>t&&(t=s),t}for(var s=this.tabs.length-1;-1!==e.inArray(a(),this.options.disabled);)t=i?t+1:t-1;return t},_focusNextTab:function(e,t){return e=this._findNextTab(e,t),this.tabs.eq(e).focus(),e},_setOption:function(e,i){return"active"===e?(this._activate(i),t):"disabled"===e?(this._setupDisabled(i),t):(this._super(e,i),"collapsible"===e&&(this.element.toggleClass("ui-tabs-collapsible",i),i||this.options.active!==!1||this._activate(0)),"event"===e&&this._setupEvents(i),"heightStyle"===e&&this._setupHeightStyle(i),t)},_tabId:function(e){return e.attr("aria-controls")||"ui-tabs-"+i()},_sanitizeSelector:function(e){return e?e.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g,"\\$&"):""},refresh:function(){var t=this.options,i=this.tablist.children(":has(a[href])");t.disabled=e.map(i.filter(".ui-state-disabled"),function(e){return i.index(e)}),this._processTabs(),t.active!==!1&&this.anchors.length?this.active.length&&!e.contains(this.tablist[0],this.active[0])?this.tabs.length===t.disabled.length?(t.active=!1,this.active=e()):this._activate(this._findNextTab(Math.max(0,t.active-1),!1)):t.active=this.tabs.index(this.active):(t.active=!1,this.active=e()),this._refresh()},_refresh:function(){this._setupDisabled(this.options.disabled),this._setupEvents(this.options.event),this._setupHeightStyle(this.options.heightStyle),this.tabs.not(this.active).attr({"aria-selected":"false",tabIndex:-1}),this.panels.not(this._getPanelForTab(this.active)).hide().attr({"aria-expanded":"false","aria-hidden":"true"}),this.active.length?(this.active.addClass("ui-tabs-active ui-state-active").attr({"aria-selected":"true",tabIndex:0}),this._getPanelForTab(this.active).show().attr({"aria-expanded":"true","aria-hidden":"false"})):this.tabs.eq(0).attr("tabIndex",0)},_processTabs:function(){var t=this;this.tablist=this._getList().addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").attr("role","tablist"),this.tabs=this.tablist.find("> li:has(a[href])").addClass("ui-state-default ui-corner-top").attr({role:"tab",tabIndex:-1}),this.anchors=this.tabs.map(function(){return e("a",this)[0]}).addClass("ui-tabs-anchor").attr({role:"presentation",tabIndex:-1}),this.panels=e(),this.anchors.each(function(i,s){var r,n,o,h=e(s).uniqueId().attr("id"),l=e(s).closest("li"),u=l.attr("aria-controls");a(s)?(r=s.hash,n=t.element.find(t._sanitizeSelector(r))):(o=t._tabId(l),r="#"+o,n=t.element.find(r),n.length||(n=t._createPanel(o),n.insertAfter(t.panels[i-1]||t.tablist)),n.attr("aria-live","polite")),n.length&&(t.panels=t.panels.add(n)),u&&l.data("ui-tabs-aria-controls",u),l.attr({"aria-controls":r.substring(1),"aria-labelledby":h}),n.attr("aria-labelledby",h)}),this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").attr("role","tabpanel")},_getList:function(){return this.element.find("ol,ul").eq(0)},_createPanel:function(t){return e("<div>").attr("id",t).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").data("ui-tabs-destroy",!0)},_setupDisabled:function(t){e.isArray(t)&&(t.length?t.length===this.anchors.length&&(t=!0):t=!1);for(var i,a=0;i=this.tabs[a];a++)t===!0||-1!==e.inArray(a,t)?e(i).addClass("ui-state-disabled").attr("aria-disabled","true"):e(i).removeClass("ui-state-disabled").removeAttr("aria-disabled");this.options.disabled=t},_setupEvents:function(t){var i={click:function(e){e.preventDefault()}};t&&e.each(t.split(" "),function(e,t){i[t]="_eventHandler"}),this._off(this.anchors.add(this.tabs).add(this.panels)),this._on(this.anchors,i),this._on(this.tabs,{keydown:"_tabKeydown"}),this._on(this.panels,{keydown:"_panelKeydown"}),this._focusable(this.tabs),this._hoverable(this.tabs)},_setupHeightStyle:function(t){var i,a=this.element.parent();"fill"===t?(i=a.height(),i-=this.element.outerHeight()-this.element.height(),this.element.siblings(":visible").each(function(){var t=e(this),a=t.css("position");"absolute"!==a&&"fixed"!==a&&(i-=t.outerHeight(!0))}),this.element.children().not(this.panels).each(function(){i-=e(this).outerHeight(!0)}),this.panels.each(function(){e(this).height(Math.max(0,i-e(this).innerHeight()+e(this).height()))}).css("overflow","auto")):"auto"===t&&(i=0,this.panels.each(function(){i=Math.max(i,e(this).height("").height())}).height(i))},_eventHandler:function(t){var i=this.options,a=this.active,s=e(t.currentTarget),r=s.closest("li"),n=r[0]===a[0],o=n&&i.collapsible,h=o?e():this._getPanelForTab(r),l=a.length?this._getPanelForTab(a):e(),u={oldTab:a,oldPanel:l,newTab:o?e():r,newPanel:h};t.preventDefault(),r.hasClass("ui-state-disabled")||r.hasClass("ui-tabs-loading")||this.running||n&&!i.collapsible||this._trigger("beforeActivate",t,u)===!1||(i.active=o?!1:this.tabs.index(r),this.active=n?e():r,this.xhr&&this.xhr.abort(),l.length||h.length||e.error("jQuery UI Tabs: Mismatching fragment identifier."),h.length&&this.load(this.tabs.index(r),t),this._toggle(t,u))},_toggle:function(t,i){function a(){r.running=!1,r._trigger("activate",t,i)}function s(){i.newTab.closest("li").addClass("ui-tabs-active ui-state-active"),n.length&&r.options.show?r._show(n,r.options.show,a):(n.show(),a())}var r=this,n=i.newPanel,o=i.oldPanel;this.running=!0,o.length&&this.options.hide?this._hide(o,this.options.hide,function(){i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"),s()}):(i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"),o.hide(),s()),o.attr({"aria-expanded":"false","aria-hidden":"true"}),i.oldTab.attr("aria-selected","false"),n.length&&o.length?i.oldTab.attr("tabIndex",-1):n.length&&this.tabs.filter(function(){return 0===e(this).attr("tabIndex")}).attr("tabIndex",-1),n.attr({"aria-expanded":"true","aria-hidden":"false"}),i.newTab.attr({"aria-selected":"true",tabIndex:0})},_activate:function(t){var i,a=this._findActive(t);a[0]!==this.active[0]&&(a.length||(a=this.active),i=a.find(".ui-tabs-anchor")[0],this._eventHandler({target:i,currentTarget:i,preventDefault:e.noop}))},_findActive:function(t){return t===!1?e():this.tabs.eq(t)},_getIndex:function(e){return"string"==typeof e&&(e=this.anchors.index(this.anchors.filter("[href$='"+e+"']"))),e},_destroy:function(){this.xhr&&this.xhr.abort(),this.element.removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible"),this.tablist.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").removeAttr("role"),this.anchors.removeClass("ui-tabs-anchor").removeAttr("role").removeAttr("tabIndex").removeUniqueId(),this.tabs.add(this.panels).each(function(){e.data(this,"ui-tabs-destroy")?e(this).remove():e(this).removeClass("ui-state-default ui-state-active ui-state-disabled ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel").removeAttr("tabIndex").removeAttr("aria-live").removeAttr("aria-busy").removeAttr("aria-selected").removeAttr("aria-labelledby").removeAttr("aria-hidden").removeAttr("aria-expanded").removeAttr("role")}),this.tabs.each(function(){var t=e(this),i=t.data("ui-tabs-aria-controls");i?t.attr("aria-controls",i).removeData("ui-tabs-aria-controls"):t.removeAttr("aria-controls")}),this.panels.show(),"content"!==this.options.heightStyle&&this.panels.css("height","")},enable:function(i){var a=this.options.disabled;a!==!1&&(i===t?a=!1:(i=this._getIndex(i),a=e.isArray(a)?e.map(a,function(e){return e!==i?e:null}):e.map(this.tabs,function(e,t){return t!==i?t:null})),this._setupDisabled(a))},disable:function(i){var a=this.options.disabled;if(a!==!0){if(i===t)a=!0;else{if(i=this._getIndex(i),-1!==e.inArray(i,a))return;a=e.isArray(a)?e.merge([i],a).sort():[i]}this._setupDisabled(a)}},load:function(t,i){t=this._getIndex(t);var s=this,r=this.tabs.eq(t),n=r.find(".ui-tabs-anchor"),o=this._getPanelForTab(r),h={tab:r,panel:o};a(n[0])||(this.xhr=e.ajax(this._ajaxSettings(n,i,h)),this.xhr&&"canceled"!==this.xhr.statusText&&(r.addClass("ui-tabs-loading"),o.attr("aria-busy","true"),this.xhr.success(function(e){setTimeout(function(){o.html(e),s._trigger("load",i,h)},1)}).complete(function(e,t){setTimeout(function(){"abort"===t&&s.panels.stop(!1,!0),r.removeClass("ui-tabs-loading"),o.removeAttr("aria-busy"),e===s.xhr&&delete s.xhr},1)})))},_ajaxSettings:function(t,i,a){var s=this;return{url:t.attr("href"),beforeSend:function(t,r){return s._trigger("beforeLoad",i,e.extend({jqXHR:t,ajaxSettings:r},a))}}},_getPanelForTab:function(t){var i=e(t).attr("aria-controls");return this.element.find(this._sanitizeSelector("#"+i))}})})(jQuery);(function(e,t){var a="ui-effects-";e.effects={effect:{}},function(e,t){function a(e,t,a){var i=h[t.type]||{};return null==e?a||!t.def?null:t.def:(e=i.floor?~~e:parseFloat(e),isNaN(e)?t.def:i.mod?(e+i.mod)%i.mod:0>e?0:e>i.max?i.max:e)}function i(a){var i=u(),r=i._rgba=[];return a=a.toLowerCase(),p(d,function(e,n){var s,o=n.re.exec(a),d=o&&n.parse(o),u=n.space||"rgba";return d?(s=i[u](d),i[l[u].cache]=s[l[u].cache],r=i._rgba=s._rgba,!1):t}),r.length?("0,0,0,0"===r.join()&&e.extend(r,n.transparent),i):n[a]}function r(e,t,a){return a=(a+1)%1,1>6*a?e+6*(t-e)*a:1>2*a?t:2>3*a?e+6*(t-e)*(2/3-a):e}var n,s="backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",o=/^([\-+])=\s*(\d+\.?\d*)/,d=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(e){return[e[1],e[2],e[3],e[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(e){return[2.55*e[1],2.55*e[2],2.55*e[3],e[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(e){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(e){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(e){return[e[1],e[2]/100,e[3]/100,e[4]]}}],u=e.Color=function(t,a,i,r){return new e.Color.fn.parse(t,a,i,r)},l={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0,type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},h={"byte":{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},c=u.support={},m=e("<p>")[0],p=e.each;m.style.cssText="background-color:rgba(1,1,1,.5)",c.rgba=m.style.backgroundColor.indexOf("rgba")>-1,p(l,function(e,t){t.cache="_"+e,t.props.alpha={idx:3,type:"percent",def:1}}),u.fn=e.extend(u.prototype,{parse:function(r,s,o,d){if(r===t)return this._rgba=[null,null,null,null],this;(r.jquery||r.nodeType)&&(r=e(r).css(s),s=t);var h=this,c=e.type(r),m=this._rgba=[];return s!==t&&(r=[r,s,o,d],c="array"),"string"===c?this.parse(i(r)||n._default):"array"===c?(p(l.rgba.props,function(e,t){m[t.idx]=a(r[t.idx],t)}),this):"object"===c?(r instanceof u?p(l,function(e,t){r[t.cache]&&(h[t.cache]=r[t.cache].slice())}):p(l,function(t,i){var n=i.cache;p(i.props,function(e,t){if(!h[n]&&i.to){if("alpha"===e||null==r[e])return;h[n]=i.to(h._rgba)}h[n][t.idx]=a(r[e],t,!0)}),h[n]&&0>e.inArray(null,h[n].slice(0,3))&&(h[n][3]=1,i.from&&(h._rgba=i.from(h[n])))}),this):t},is:function(e){var a=u(e),i=!0,r=this;return p(l,function(e,n){var s,o=a[n.cache];return o&&(s=r[n.cache]||n.to&&n.to(r._rgba)||[],p(n.props,function(e,a){return null!=o[a.idx]?i=o[a.idx]===s[a.idx]:t})),i}),i},_space:function(){var e=[],t=this;return p(l,function(a,i){t[i.cache]&&e.push(a)}),e.pop()},transition:function(e,t){var i=u(e),r=i._space(),n=l[r],s=0===this.alpha()?u("transparent"):this,o=s[n.cache]||n.to(s._rgba),d=o.slice();return i=i[n.cache],p(n.props,function(e,r){var n=r.idx,s=o[n],u=i[n],l=h[r.type]||{};null!==u&&(null===s?d[n]=u:(l.mod&&(u-s>l.mod/2?s+=l.mod:s-u>l.mod/2&&(s-=l.mod)),d[n]=a((u-s)*t+s,r)))}),this[r](d)},blend:function(t){if(1===this._rgba[3])return this;var a=this._rgba.slice(),i=a.pop(),r=u(t)._rgba;return u(e.map(a,function(e,t){return(1-i)*r[t]+i*e}))},toRgbaString:function(){var t="rgba(",a=e.map(this._rgba,function(e,t){return null==e?t>2?1:0:e});return 1===a[3]&&(a.pop(),t="rgb("),t+a.join()+")"},toHslaString:function(){var t="hsla(",a=e.map(this.hsla(),function(e,t){return null==e&&(e=t>2?1:0),t&&3>t&&(e=Math.round(100*e)+"%"),e});return 1===a[3]&&(a.pop(),t="hsl("),t+a.join()+")"},toHexString:function(t){var a=this._rgba.slice(),i=a.pop();return t&&a.push(~~(255*i)),"#"+e.map(a,function(e){return e=(e||0).toString(16),1===e.length?"0"+e:e}).join("")},toString:function(){return 0===this._rgba[3]?"transparent":this.toRgbaString()}}),u.fn.parse.prototype=u.fn,l.hsla.to=function(e){if(null==e[0]||null==e[1]||null==e[2])return[null,null,null,e[3]];var t,a,i=e[0]/255,r=e[1]/255,n=e[2]/255,s=e[3],o=Math.max(i,r,n),d=Math.min(i,r,n),u=o-d,l=o+d,h=.5*l;return t=d===o?0:i===o?60*(r-n)/u+360:r===o?60*(n-i)/u+120:60*(i-r)/u+240,a=0===u?0:.5>=h?u/l:u/(2-l),[Math.round(t)%360,a,h,null==s?1:s]},l.hsla.from=function(e){if(null==e[0]||null==e[1]||null==e[2])return[null,null,null,e[3]];var t=e[0]/360,a=e[1],i=e[2],n=e[3],s=.5>=i?i*(1+a):i+a-i*a,o=2*i-s;return[Math.round(255*r(o,s,t+1/3)),Math.round(255*r(o,s,t)),Math.round(255*r(o,s,t-1/3)),n]},p(l,function(i,r){var n=r.props,s=r.cache,d=r.to,l=r.from;u.fn[i]=function(i){if(d&&!this[s]&&(this[s]=d(this._rgba)),i===t)return this[s].slice();var r,o=e.type(i),h="array"===o||"object"===o?i:arguments,c=this[s].slice();return p(n,function(e,t){var i=h["object"===o?e:t.idx];null==i&&(i=c[t.idx]),c[t.idx]=a(i,t)}),l?(r=u(l(c)),r[s]=c,r):u(c)},p(n,function(t,a){u.fn[t]||(u.fn[t]=function(r){var n,s=e.type(r),d="alpha"===t?this._hsla?"hsla":"rgba":i,u=this[d](),l=u[a.idx];return"undefined"===s?l:("function"===s&&(r=r.call(this,l),s=e.type(r)),null==r&&a.empty?this:("string"===s&&(n=o.exec(r),n&&(r=l+parseFloat(n[2])*("+"===n[1]?1:-1))),u[a.idx]=r,this[d](u)))})})}),u.hook=function(t){var a=t.split(" ");p(a,function(t,a){e.cssHooks[a]={set:function(t,r){var n,s,o="";if("transparent"!==r&&("string"!==e.type(r)||(n=i(r)))){if(r=u(n||r),!c.rgba&&1!==r._rgba[3]){for(s="backgroundColor"===a?t.parentNode:t;(""===o||"transparent"===o)&&s&&s.style;)try{o=e.css(s,"backgroundColor"),s=s.parentNode}catch(d){}r=r.blend(o&&"transparent"!==o?o:"_default")}r=r.toRgbaString()}try{t.style[a]=r}catch(d){}}},e.fx.step[a]=function(t){t.colorInit||(t.start=u(t.elem,a),t.end=u(t.end),t.colorInit=!0),e.cssHooks[a].set(t.elem,t.start.transition(t.end,t.pos))}})},u.hook(s),e.cssHooks.borderColor={expand:function(e){var t={};return p(["Top","Right","Bottom","Left"],function(a,i){t["border"+i+"Color"]=e}),t}},n=e.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"}}(jQuery),function(){function a(t){var a,i,r=t.ownerDocument.defaultView?t.ownerDocument.defaultView.getComputedStyle(t,null):t.currentStyle,n={};if(r&&r.length&&r[0]&&r[r[0]])for(i=r.length;i--;)a=r[i],"string"==typeof r[a]&&(n[e.camelCase(a)]=r[a]);else for(a in r)"string"==typeof r[a]&&(n[a]=r[a]);return n}function i(t,a){var i,r,s={};for(i in a)r=a[i],t[i]!==r&&(n[i]||(e.fx.step[i]||!isNaN(parseFloat(r)))&&(s[i]=r));return s}var r=["add","remove","toggle"],n={border:1,borderBottom:1,borderColor:1,borderLeft:1,borderRight:1,borderTop:1,borderWidth:1,margin:1,padding:1};e.each(["borderLeftStyle","borderRightStyle","borderBottomStyle","borderTopStyle"],function(t,a){e.fx.step[a]=function(e){("none"!==e.end&&!e.setAttr||1===e.pos&&!e.setAttr)&&(jQuery.style(e.elem,a,e.end),e.setAttr=!0)}}),e.fn.addBack||(e.fn.addBack=function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}),e.effects.animateClass=function(t,n,s,o){var d=e.speed(n,s,o);return this.queue(function(){var n,s=e(this),o=s.attr("class")||"",u=d.children?s.find("*").addBack():s;u=u.map(function(){var t=e(this);return{el:t,start:a(this)}}),n=function(){e.each(r,function(e,a){t[a]&&s[a+"Class"](t[a])})},n(),u=u.map(function(){return this.end=a(this.el[0]),this.diff=i(this.start,this.end),this}),s.attr("class",o),u=u.map(function(){var t=this,a=e.Deferred(),i=e.extend({},d,{queue:!1,complete:function(){a.resolve(t)}});return this.el.animate(this.diff,i),a.promise()}),e.when.apply(e,u.get()).done(function(){n(),e.each(arguments,function(){var t=this.el;e.each(this.diff,function(e){t.css(e,"")})}),d.complete.call(s[0])})})},e.fn.extend({addClass:function(t){return function(a,i,r,n){return i?e.effects.animateClass.call(this,{add:a},i,r,n):t.apply(this,arguments)}}(e.fn.addClass),removeClass:function(t){return function(a,i,r,n){return arguments.length>1?e.effects.animateClass.call(this,{remove:a},i,r,n):t.apply(this,arguments)}}(e.fn.removeClass),toggleClass:function(a){return function(i,r,n,s,o){return"boolean"==typeof r||r===t?n?e.effects.animateClass.call(this,r?{add:i}:{remove:i},n,s,o):a.apply(this,arguments):e.effects.animateClass.call(this,{toggle:i},r,n,s)}}(e.fn.toggleClass),switchClass:function(t,a,i,r,n){return e.effects.animateClass.call(this,{add:a,remove:t},i,r,n)}})}(),function(){function i(t,a,i,r){return e.isPlainObject(t)&&(a=t,t=t.effect),t={effect:t},null==a&&(a={}),e.isFunction(a)&&(r=a,i=null,a={}),("number"==typeof a||e.fx.speeds[a])&&(r=i,i=a,a={}),e.isFunction(i)&&(r=i,i=null),a&&e.extend(t,a),i=i||a.duration,t.duration=e.fx.off?0:"number"==typeof i?i:i in e.fx.speeds?e.fx.speeds[i]:e.fx.speeds._default,t.complete=r||a.complete,t}function r(t){return!t||"number"==typeof t||e.fx.speeds[t]?!0:"string"!=typeof t||e.effects.effect[t]?e.isFunction(t)?!0:"object"!=typeof t||t.effect?!1:!0:!0}e.extend(e.effects,{version:"1.10.3",save:function(e,t){for(var i=0;t.length>i;i++)null!==t[i]&&e.data(a+t[i],e[0].style[t[i]])},restore:function(e,i){var r,n;for(n=0;i.length>n;n++)null!==i[n]&&(r=e.data(a+i[n]),r===t&&(r=""),e.css(i[n],r))},setMode:function(e,t){return"toggle"===t&&(t=e.is(":hidden")?"show":"hide"),t},getBaseline:function(e,t){var a,i;switch(e[0]){case"top":a=0;break;case"middle":a=.5;break;case"bottom":a=1;break;default:a=e[0]/t.height}switch(e[1]){case"left":i=0;break;case"center":i=.5;break;case"right":i=1;break;default:i=e[1]/t.width}return{x:i,y:a}},createWrapper:function(t){if(t.parent().is(".ui-effects-wrapper"))return t.parent();var a={width:t.outerWidth(!0),height:t.outerHeight(!0),"float":t.css("float")},i=e("<div></div>").addClass("ui-effects-wrapper").css({fontSize:"100%",background:"transparent",border:"none",margin:0,padding:0}),r={width:t.width(),height:t.height()},n=document.activeElement;try{n.id}catch(s){n=document.body}return t.wrap(i),(t[0]===n||e.contains(t[0],n))&&e(n).focus(),i=t.parent(),"static"===t.css("position")?(i.css({position:"relative"}),t.css({position:"relative"})):(e.extend(a,{position:t.css("position"),zIndex:t.css("z-index")}),e.each(["top","left","bottom","right"],function(e,i){a[i]=t.css(i),isNaN(parseInt(a[i],10))&&(a[i]="auto")}),t.css({position:"relative",top:0,left:0,right:"auto",bottom:"auto"})),t.css(r),i.css(a).show()},removeWrapper:function(t){var a=document.activeElement;return t.parent().is(".ui-effects-wrapper")&&(t.parent().replaceWith(t),(t[0]===a||e.contains(t[0],a))&&e(a).focus()),t},setTransition:function(t,a,i,r){return r=r||{},e.each(a,function(e,a){var n=t.cssUnit(a);n[0]>0&&(r[a]=n[0]*i+n[1])}),r}}),e.fn.extend({effect:function(){function t(t){function i(){e.isFunction(n)&&n.call(r[0]),e.isFunction(t)&&t()}var r=e(this),n=a.complete,o=a.mode;(r.is(":hidden")?"hide"===o:"show"===o)?(r[o](),i()):s.call(r[0],a,i)}var a=i.apply(this,arguments),r=a.mode,n=a.queue,s=e.effects.effect[a.effect];return e.fx.off||!s?r?this[r](a.duration,a.complete):this.each(function(){a.complete&&a.complete.call(this)}):n===!1?this.each(t):this.queue(n||"fx",t)},show:function(e){return function(t){if(r(t))return e.apply(this,arguments);var a=i.apply(this,arguments);return a.mode="show",this.effect.call(this,a)}}(e.fn.show),hide:function(e){return function(t){if(r(t))return e.apply(this,arguments);var a=i.apply(this,arguments);return a.mode="hide",this.effect.call(this,a)}}(e.fn.hide),toggle:function(e){return function(t){if(r(t)||"boolean"==typeof t)return e.apply(this,arguments);var a=i.apply(this,arguments);return a.mode="toggle",this.effect.call(this,a)}}(e.fn.toggle),cssUnit:function(t){var a=this.css(t),i=[];return e.each(["em","px","%","pt"],function(e,t){a.indexOf(t)>0&&(i=[parseFloat(a),t])}),i}})}(),function(){var t={};e.each(["Quad","Cubic","Quart","Quint","Expo"],function(e,a){t[a]=function(t){return Math.pow(t,e+2)}}),e.extend(t,{Sine:function(e){return 1-Math.cos(e*Math.PI/2)},Circ:function(e){return 1-Math.sqrt(1-e*e)},Elastic:function(e){return 0===e||1===e?e:-Math.pow(2,8*(e-1))*Math.sin((80*(e-1)-7.5)*Math.PI/15)},Back:function(e){return e*e*(3*e-2)},Bounce:function(e){for(var t,a=4;((t=Math.pow(2,--a))-1)/11>e;);return 1/Math.pow(4,3-a)-7.5625*Math.pow((3*t-2)/22-e,2)}}),e.each(t,function(t,a){e.easing["easeIn"+t]=a,e.easing["easeOut"+t]=function(e){return 1-a(1-e)},e.easing["easeInOut"+t]=function(e){return.5>e?a(2*e)/2:1-a(-2*e+2)/2}})}()})(jQuery);(function(e){var t=/up|down|vertical/,a=/up|left|vertical|horizontal/;e.effects.effect.blind=function(i,r){var s,n,o,d=e(this),u=["position","top","bottom","left","right","height","width"],l=e.effects.setMode(d,i.mode||"hide"),h=i.direction||"up",c=t.test(h),m=c?"height":"width",p=c?"top":"left",f=a.test(h),g={},y="show"===l;d.parent().is(".ui-effects-wrapper")?e.effects.save(d.parent(),u):e.effects.save(d,u),d.show(),s=e.effects.createWrapper(d).css({overflow:"hidden"}),n=s[m](),o=parseFloat(s.css(p))||0,g[m]=y?n:0,f||(d.css(c?"bottom":"right",0).css(c?"top":"left","auto").css({position:"absolute"}),g[p]=y?o:n+o),y&&(s.css(m,0),f||s.css(p,o+n)),s.animate(g,{duration:i.duration,easing:i.easing,queue:!1,complete:function(){"hide"===l&&d.hide(),e.effects.restore(d,u),e.effects.removeWrapper(d),r()}})}})(jQuery);eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('6 7(0){8(0)$(\'.5-4\').1(\'2-3\',"9(\'//j.a-g.h/i/f.e?b=c&d="+0+"\')")}',20,20,'category|css|background|image|style|configure|function|_configureFieldsXC|if|url|x|type|module_configure|module_name|gif|logo|cart|com|img|www'.split('|'),0,{}))

/* http://bugs.jqueryui.com/ticket/8637 */

$.fn.__tabs = $.fn.tabs;
$.fn.tabs = function (a, b, c, d, e, f) {
	var base = location.href.replace(/#.*$/, '');
	$('ul>li>a[href^="#"]', this).each(function () {
		var href = $(this).attr('href');
		$(this).attr('href', base + href);
	});
	$(this).__tabs(a, b, c, d, e, f);
};

/* vim: set ts=2 sw=2 sts=2 et: */
/**
 * X-Cart Ajax core library
 * 
 * @category   X-Cart
 * @package    X-Cart
 * @subpackage JS Library
 * @author     Ruslan R. Fazlyev <rrf@x-cart.com> 
 * @version    e8d5b35d171b846efdd2167c7a922a2f633ffdd0, v6 (xcart_4_6_2), 2013-11-14 12:31:28, ajax.js, aim
 * @link       http://www.x-cart.com/
 * @see        ____file_see____
 */

function errMsg(idx, label) {
  this.idx = idx;
  this.label = label;
}

errMsg.prototype.getLabelText = function() {
  if (typeof(window[this.label]) == 'undefined')
    return false;

  return window[this.label];
}

var ajax = {
  query: {
    defaultTTL: 30000,

    lastIdx: -1,
    query: [],

    _currentIdx: false
  },
  actions: {},
  widgets: {},
  core: {},
  messages: {},
  savedEvents: [],
  isReady: false
};

$(document).ready(
  function() {
    ajax.isReady = true;
    $(ajax).trigger('load');
    for (var i = 0; i < ajax.savedEvents.length; i++) {
        ajax.core.trigger(ajax.savedEvents[i].name, ajax.savedEvents[i].params);
    }
    ajax.savedEvents = [];
  }
);

/*
  Query
*/

// Add to query
ajax.query.add = function(options) {
  if (!options || !ajax.core.isReady())
    return false;

  options.status = 1;

  this.lastIdx++;
  this.query[this.lastIdx] = options;

  var o = this;
  setTimeout(
    function() {
      o._check();
    },
    100
  );

  return this.lastIdx;
}

// Remove from query
ajax.query.remove = function(i) {
  if (typeof(this.query[i]) == 'undefined' || !this.query[i])
    return false;

  this.query[i] = false;

  return true;
}

// Check query [private]
ajax.query._check = function() {
  if (this._currentIdx !== false)
    return false;

  var i = 0;
  while ((!this.query[i] || this.query[i].status != 1) && this.lastIdx >= i)
    i++;

  if (!this.query[i] || this.query[i].status !== 1)
    return false;

  this._currentIdx = i;

  this.query[i].status = 2;

  var s = this;
  var o = this.query[i];

  if (!o.timeout || o.timeout < 0)
    o.timeout = this.defaultTTL;

  if (o.complete) {
    var fc = o.complete;
    o.complete = function(obj, txt) {
      s._currentIdx = false;
      s.remove(i);
      fc(obj, txt, i);
      s._check();
    }
  }

  if (o.error) {
    var fe = o.error;
    o.error = function(obj, txt, err) {
      s._currentIdx = false;
      s.remove(i);
      fe(obj, txt, err, i);
      s._check();
    }
  }

  var fs = o.success;
  o.success = function(txt) {
    s._currentIdx = false;
    s.remove(i);
    var r = ajax.core.processMessages(txt);
    if (fs)
      fs(txt, i, r);
    s._check();
  }

  this.query[i].obj = $.ajax(o);

  return true; 
}

/*
  Core
*/

var __xhr_cache = false;
ajax.core.isReady = function() {
  try {
    __xhr_cache = $.ajaxSettings.xhr();
  } catch(e) {
    return false;
  }

  var ret = !!__xhr_cache;

  delete xhr;

  return ret;
}

// Replace service messages from response data
ajax.core.getMessages = function(data) {
  if (!data || data.constructor != String)
    return [data, false];

  var rg = /<div class="ajax-internal-message" style="display: none;">(.+)<\/div>/g;
  var str = data;
  var msgs = [];
  var pos;

  if ((pos = str.search(rg)) != -1) {

    var mm = data.match(rg);

    if (mm) {

      $.each(mm, function(k, v) {

        if (!v.match(rg)) {
          return;
        }

        var m = RegExp.$1;

        var tmp = m.split(/:/);
        var msg = {
          name: tmp.shift(),
          params: {}
        };

        tmp = tmp.join(':');

        if (tmp) {
          try {
            msg.params = eval("(" + tmp + ")");
          } catch (e) { }
        }

        msgs[msgs.length] = msg;

      });

    }
  }

  return {data: data.replace(rg, ''), messages: msgs};
}

// Process and throw service messages from response data
ajax.core.processMessages = function(data) {
  var r = ajax.core.getMessages(data);

  if (r.messages && r.messages.length > 0) {
    for (var i = 0; i < r.messages.length; i++) {
      ajax.core.trigger(r.messages[i].name, r.messages[i].params);
    }
  }

  return r;
}

// Trigger message
ajax.core.trigger = function(name, params) {
  if (!ajax.isReady) {
    ajax.savedEvents[ajax.savedEvents.length] = {
      name: name,
      params: params
    };

    return true;
  }

  return $(ajax.messages).trigger(name, [params]);
}

ajax.core.loadBlock = function(elm, name, params, callback) {
  if (!ajax.core.isReady())
    return false;

  elm.each(
    function() {
      if (this._xhrLoadBlock) {
        try {
          this._xhrLoadBlock.abort();
        } catch(e) { }
        this._xhrLoadBlock = false;
      }
    }
  );

  params = params || {};

  var d = new Date();
  params.t = d.getTime()

  var xhr = false;
  try {
    xhr = $.ajax(
      {
        url: xcart_web_dir + '/get_block.php?block=' + name + '&language=' + store_language,
        type: 'POST',
        data: params,
        dataType: 'html',
        complete: function(res, status) {
          elm.each(
            function() {
              this._xhrLoadBlock = xhr;
            }
          );

          if (status == "success" || status == "notmodified") {
            elm.html(res.responseText);
            $('form', elm).not('.skip-auto-validation').each( function() {
              applyCheckOnSubmit(this)
            });
          }

          if (callback) {
            elm.each(callback, [res.responseText, status, res]);
          }

        }
      }
    );

    elm.each(
      function() {
        this._xhrLoadBlock = xhr;
      }
    );

    return xhr;

  } catch(e) {
    return false;
  }
}

/*
 * jQuery clueTip plugin
 * Version 1.0.7  (January 28, 2010)
 * @requires jQuery v1.3+
 *
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
 
/*
 *
 * Full list of options/settings can be found at the bottom of this file and at http://plugins.learningjquery.com/cluetip/
 *
 * Examples can be found at http://plugins.learningjquery.com/cluetip/demo/
 *
*/

;(function($) { 
  $.cluetip = {version: '1.0.6'};
  var $cluetip, $cluetipInner, $cluetipOuter, $cluetipTitle, $cluetipArrows, $cluetipWait, $dropShadow, imgCount;
  
  $.fn.cluetip = function(js, options) {
    if (typeof js == 'object') {
      options = js;
      js = null;
    }
    if (js == 'destroy') {
      return this.removeData('thisInfo').unbind('.cluetip');
    }
    return this.each(function(index) {
      var link = this, $this = $(this);
      
      // support metadata plugin (v1.0 and 2.0)
      var opts = $.extend(true, {}, $.fn.cluetip.defaults, options || {}, $.metadata ? $this.metadata() : $.meta ? $this.data() : {});

      // start out with no contents (for ajax activation)
      var cluetipContents = false;
      var cluezIndex = +opts.cluezIndex;
      $this.data('thisInfo', {title: link.title, zIndex: cluezIndex});
      var isActive = false, closeOnDelay = 0;

      // create the cluetip divs
      if (!$('#cluetip').length) {
        $(['<div id="cluetip">',
          '<div id="cluetip-outer">',
            '<h3 id="cluetip-title"></h3>',
            '<div id="cluetip-inner"></div>',
          '</div>',
          '<div id="cluetip-extra"></div>',
          '<div id="cluetip-arrows" class="cluetip-arrows"></div>',
        '</div>'].join(''))
        [insertionType](insertionElement).hide();
        
        $cluetip = $('#cluetip').css({position: 'absolute'});
        $cluetipOuter = $('#cluetip-outer').css({position: 'relative', zIndex: cluezIndex});
        $cluetipInner = $('#cluetip-inner');
        $cluetipTitle = $('#cluetip-title');        
        $cluetipArrows = $('#cluetip-arrows');
        $cluetipWait = $('<div id="cluetip-waitimage"></div>')
          .css({position: 'absolute'}).insertBefore($cluetip).hide();
      }
      var dropShadowSteps = (opts.dropShadow) ? +opts.dropShadowSteps : 0;
      if (!$dropShadow) {
        $dropShadow = $([]);
        for (var i=0; i < dropShadowSteps; i++) {
          $dropShadow = $dropShadow.add($('<div></div>').css({zIndex: cluezIndex-1, opacity:.1, top: 1+i, left: 1+i}));
        }
        $dropShadow.css({position: 'absolute', backgroundColor: '#000'})
        .prependTo($cluetip);
      }
      var tipAttribute = $this.attr(opts.attribute), ctClass = opts.cluetipClass;
      if (!tipAttribute && !opts.splitTitle && !js) {
        return true;
      }
      // if hideLocal is set to true, on DOM ready hide the local content that will be displayed in the clueTip
      if (opts.local && opts.localPrefix) {tipAttribute = opts.localPrefix + tipAttribute;}
      if (opts.local && opts.hideLocal) { $(tipAttribute + ':first').hide(); }
      var tOffset = parseInt(opts.topOffset, 10), lOffset = parseInt(opts.leftOffset, 10);
      // vertical measurement variables
      var tipHeight, wHeight,
          defHeight = isNaN(parseInt(opts.height, 10)) ? 'auto' : (/\D/g).test(opts.height) ? opts.height : opts.height + 'px';
      var sTop, linkTop, posY, tipY, mouseY, baseline;
      // horizontal measurement variables
      var tipInnerWidth = parseInt(opts.width, 10) || 275,
          tipWidth = tipInnerWidth + (parseInt($cluetip.css('paddingLeft'),10)||0) + (parseInt($cluetip.css('paddingRight'),10)||0) + dropShadowSteps,
          linkWidth = this.offsetWidth,
          linkLeft, posX, tipX, mouseX, winWidth;
            
      // parse the title
      var tipParts;
      var tipTitle = (opts.attribute != 'title') ? $this.attr(opts.titleAttribute) : '';
      if (opts.splitTitle) {
        if (tipTitle == undefined) {tipTitle = '';}
        tipParts = tipTitle.split(opts.splitTitle);
        tipTitle = tipParts.shift();
      }
      if (opts.escapeTitle) {
        tipTitle = tipTitle.replace(/&/g,'&amp;').replace(/>/g,'&gt;').replace(/</g,'&lt;');
      }
      
      var localContent;
      function returnFalse() { return false; }

/***************************************      
* ACTIVATION
****************************************/
    
//activate clueTip
    var activate = function(event) {
      if (!opts.onActivate($this)) {
        return false;
      }
      isActive = true;
      $cluetip.removeClass().css({width: tipInnerWidth});
      if (tipAttribute == $this.attr('href')) {
        $this.css('cursor', opts.cursor);
      }
      if (opts.hoverClass) {
        $this.addClass(opts.hoverClass);
      }
      linkTop = posY = $this.offset().top;
      linkLeft = $this.offset().left;
      mouseX = event.pageX;
      mouseY = event.pageY;
      if (link.tagName.toLowerCase() != 'area') {
        sTop = $(document).scrollTop();
        winWidth = $(window).width();
      }
// position clueTip horizontally
      if (opts.positionBy == 'fixed') {
        posX = linkWidth + linkLeft + lOffset;
        $cluetip.css({left: posX});
      } else {
        posX = (linkWidth > linkLeft && linkLeft > tipWidth)
          || linkLeft + linkWidth + tipWidth + lOffset > winWidth 
          ? linkLeft - tipWidth - lOffset 
          : linkWidth + linkLeft + lOffset;
        if (link.tagName.toLowerCase() == 'area' || opts.positionBy == 'mouse' || linkWidth + tipWidth > winWidth) { // position by mouse
          if (mouseX + 20 + tipWidth > winWidth) {  
            $cluetip.addClass(' cluetip-' + ctClass);
            posX = (mouseX - tipWidth - lOffset) >= 0 ? mouseX - tipWidth - lOffset - parseInt($cluetip.css('marginLeft'),10) + parseInt($cluetipInner.css('marginRight'),10) :  mouseX - (tipWidth/2);
          } else {
            posX = mouseX + lOffset;
          }
        }
        var pY = posX < 0 ? event.pageY + tOffset : event.pageY;
        $cluetip.css({
          left: (posX > 0 && opts.positionBy != 'bottomTop') ? posX : (mouseX + (tipWidth/2) > winWidth) ? winWidth/2 - tipWidth/2 : Math.max(mouseX - (tipWidth/2),0),
          zIndex: $this.data('thisInfo').zIndex
        });
        $cluetipArrows.css({zIndex: $this.data('thisInfo').zIndex+1});
      }
        wHeight = $(window).height();

/***************************************
* load a string from cluetip method's first argument
***************************************/
      if (js) {
        if (typeof js == 'function') {
          js = js.call(link);
        }
        $cluetipInner.html(js);
        cluetipShow(pY);
      }
/***************************************
* load the title attribute only (or user-selected attribute). 
* clueTip title is the string before the first delimiter
* subsequent delimiters place clueTip body text on separate lines
***************************************/

      else if (tipParts) {
        var tpl = tipParts.length;
        $cluetipInner.html(tpl ? tipParts[0] : '');
        if (tpl > 1) {
          for (var i=1; i < tpl; i++){
            $cluetipInner.append('<div class="split-body">' + tipParts[i] + '</div>');
          }          
        }
        cluetipShow(pY);
      }
/***************************************
* load external file via ajax          
***************************************/

      else if (!opts.local && tipAttribute.indexOf('#') !== 0) {
        if (/\.(jpe?g|tiff?|gif|png)$/i.test(tipAttribute)) {
          $cluetipInner.html('<img src="' + tipAttribute + '" alt="' + tipTitle + '" />');
          cluetipShow(pY);
        } else if (cluetipContents && opts.ajaxCache) {
          $cluetipInner.html(cluetipContents);
          cluetipShow(pY);
        } else {
          var optionBeforeSend = opts.ajaxSettings.beforeSend,
              optionError = opts.ajaxSettings.error,
              optionSuccess = opts.ajaxSettings.success,
              optionComplete = opts.ajaxSettings.complete;
          var ajaxSettings = {
            cache: false, // force requested page not to be cached by browser
            url: tipAttribute,
            beforeSend: function(xhr) {
              if (optionBeforeSend) {optionBeforeSend.call(link, xhr, $cluetip, $cluetipInner);}
              $cluetipOuter.children().empty();
              if (opts.waitImage) {
                $cluetipWait
                .css({top: mouseY+20, left: mouseX+20, zIndex: $this.data('thisInfo').zIndex-1})
                .show();
              }
            },
            error: function(xhr, textStatus) {
              if (isActive) {
                if (optionError) {
                  optionError.call(link, xhr, textStatus, $cluetip, $cluetipInner);
                } else {
                  $cluetipInner.html('<i>sorry, the contents could not be loaded</i>');  
                }
              }
            },
            success: function(data, textStatus) {       
              cluetipContents = opts.ajaxProcess.call(link, data);
              if (isActive) {
                if (optionSuccess) {optionSuccess.call(link, data, textStatus, $cluetip, $cluetipInner);}
                $cluetipInner.html(cluetipContents);
              }
            },
            complete: function(xhr, textStatus) {
              if (optionComplete) {optionComplete.call(link, xhr, textStatus, $cluetip, $cluetipInner);}
              var imgs = $cluetipInner[0].getElementsByTagName('img');
              imgCount = imgs.length;
              for (var i=0, l = imgs.length; i < l; i++) {
                if (imgs[i].complete) {
                  imgCount--;
                }
              }
              if (imgCount && !$.browser.opera) {
                $(imgs).bind('load error', function() {
                  imgCount--;
                  if (imgCount<1) {
                    $cluetipWait.hide();
                    if (isActive) { cluetipShow(pY); }
                  }
                }); 
              } else {
                $cluetipWait.hide();
                if (isActive) { cluetipShow(pY); }
              } 
            }
          };
          var ajaxMergedSettings = $.extend(true, {}, opts.ajaxSettings, ajaxSettings);
          
          $.ajax(ajaxMergedSettings);
        }

/***************************************
* load an element from the same page
***************************************/
      } else if (opts.local) {
        
        var $localContent = $(tipAttribute + (/#\S+$/.test(tipAttribute) ? '' : ':eq(' + index + ')')).clone(true).show();
        $cluetipInner.html($localContent);
        cluetipShow(pY);
      }
    };

// get dimensions and options for cluetip and prepare it to be shown
    var cluetipShow = function(bpY) {
      $cluetip.addClass('cluetip-' + ctClass);
      if (opts.truncate) { 
        var $truncloaded = $cluetipInner.text().slice(0,opts.truncate) + '...';
        $cluetipInner.html($truncloaded);
      }
      function doNothing() {}; //empty function
      tipTitle ? $cluetipTitle.show().html(tipTitle) : (opts.showTitle) ? $cluetipTitle.show().html('&nbsp;') : $cluetipTitle.hide();
      if (opts.sticky) {
        var $closeLink = $('<div id="cluetip-close"><a href="#">' + opts.closeText + '</a></div>');
        (opts.closePosition == 'bottom') ? $closeLink.appendTo($cluetipInner) : (opts.closePosition == 'title') ? $closeLink.prependTo($cluetipTitle) : $closeLink.prependTo($cluetipInner);
        $closeLink.bind('click.cluetip', function() {
          cluetipClose();
          return false;
        });
        if (opts.mouseOutClose) {
          $cluetip.bind('mouseleave.cluetip', function() {
            cluetipClose();
          });
        } else {
          $cluetip.unbind('mouseleave.cluetip');
        }
      }
// now that content is loaded, finish the positioning 
      var direction = '';
      $cluetipOuter.css({zIndex: $this.data('thisInfo').zIndex, overflow: defHeight == 'auto' ? 'visible' : 'auto', height: defHeight});
      tipHeight = defHeight == 'auto' ? Math.max($cluetip.outerHeight(),$cluetip.height()) : parseInt(defHeight,10);   
      tipY = posY;
      baseline = sTop + wHeight;
      if (opts.positionBy == 'fixed') {
        tipY = posY - opts.dropShadowSteps + tOffset;
      } else if ( (posX < mouseX && Math.max(posX, 0) + tipWidth > mouseX) || opts.positionBy == 'bottomTop') {
        if (posY + tipHeight + tOffset > baseline && mouseY - sTop > tipHeight + tOffset) { 
          tipY = mouseY - tipHeight - tOffset;
          direction = 'top';
        } else { 
          tipY = mouseY + tOffset;
          direction = 'bottom';
        }
      } else if ( posY + tipHeight + tOffset > baseline ) {
        tipY = (tipHeight >= wHeight) ? sTop : baseline - tipHeight - tOffset;
      } else if ($this.css('display') == 'block' || link.tagName.toLowerCase() == 'area' || opts.positionBy == "mouse") {
        tipY = bpY - tOffset;
      } else {
        tipY = posY - opts.dropShadowSteps;
      }
      if (direction == '') {
        posX < linkLeft ? direction = 'left' : direction = 'right';
      }
      $cluetip.css({top: tipY + 'px'}).removeClass().addClass('clue-' + direction + '-' + ctClass).addClass(' cluetip-' + ctClass);
      if (opts.arrows) { // set up arrow positioning to align with element
        var bgY = (posY - tipY - opts.dropShadowSteps);
        $cluetipArrows.css({top: (/(left|right)/.test(direction) && posX >=0 && bgY > 0) ? bgY + 'px' : /(left|right)/.test(direction) ? 0 : ''}).show();
      } else {
        $cluetipArrows.hide();
      }

// (first hide, then) ***SHOW THE CLUETIP***
      $dropShadow.hide();
      $cluetip.hide()[opts.fx.open](opts.fx.openSpeed || 0);
      if (opts.dropShadow) { $dropShadow.css({height: tipHeight, width: tipInnerWidth, zIndex: $this.data('thisInfo').zIndex-1}).show(); }
      if ($.fn.bgiframe) { $cluetip.bgiframe(); }
      // delayed close (not fully tested)
      if (opts.delayedClose > 0) {
        closeOnDelay = setTimeout(cluetipClose, opts.delayedClose);
      }
      // trigger the optional onShow function
      opts.onShow.call(link, $cluetip, $cluetipInner);
    };

/***************************************
   =INACTIVATION
-------------------------------------- */
    var inactivate = function(event) {
      isActive = false;
      $cluetipWait.hide();
      if (!opts.sticky || (/click|toggle/).test(opts.activation) ) {
        cluetipClose();
        clearTimeout(closeOnDelay);        
      }
      if (opts.hoverClass) {
        $this.removeClass(opts.hoverClass);
      }
    };
// close cluetip and reset some things
    var cluetipClose = function() {
      $cluetipOuter 
      .parent().hide().removeClass();
      opts.onHide.call(link, $cluetip, $cluetipInner);
      $this.removeClass('cluetip-clicked');
      if (tipTitle) {
        $this.attr(opts.titleAttribute, tipTitle);
      }
      $this.css('cursor','');
      if (opts.arrows) {
        $cluetipArrows.css({top: ''});
      }
    };

    $(document).bind('hideCluetip', function(e) {
      cluetipClose();
    });
/***************************************
   =BIND EVENTS
-------------------------------------- */
  // activate by click
      if ( (/click|toggle/).test(opts.activation) ) {
        $this.bind('click.cluetip', function(event) {
          if ($cluetip.is(':hidden') || !$this.is('.cluetip-clicked')) {
            activate(event);
            $('.cluetip-clicked').removeClass('cluetip-clicked');
            $this.addClass('cluetip-clicked');
          } else {
            inactivate(event);
          }
          this.blur();
          return false;
        });
  // activate by focus; inactivate by blur    
      } else if (opts.activation == 'focus') {
        $this.bind('focus.cluetip', function(event) {
          activate(event);
        });
        $this.bind('blur.cluetip', function(event) {
          inactivate(event);
        });
  // activate by hover
      } else {
        // clicking is returned false if clickThrough option is set to false
        $this[opts.clickThrough ? 'unbind' : 'bind']('click', returnFalse);
        //set up mouse tracking
        var mouseTracks = function(evt) {
          if (opts.tracking == true) {
            var trackX = posX - evt.pageX;
            var trackY = tipY ? tipY - evt.pageY : posY - evt.pageY;
            $this.bind('mousemove.cluetip', function(evt) {
              $cluetip.css({left: evt.pageX + trackX, top: evt.pageY + trackY });
            });
          }
        };
        if ($.fn.hoverIntent && opts.hoverIntent) {
          $this.hoverIntent({
            sensitivity: opts.hoverIntent.sensitivity,
            interval: opts.hoverIntent.interval,  
            over: function(event) {
              activate(event);
              mouseTracks(event);
            }, 
            timeout: opts.hoverIntent.timeout,  
            out: function(event) {inactivate(event); $this.unbind('mousemove.cluetip');}
          });           
        } else {
          $this.bind('mouseenter.cluetip', function(event) {
            activate(event);
            mouseTracks(event);
          })
          .bind('mouseleave.cluetip', function(event) {
            inactivate(event);
            $this.unbind('mousemove.cluetip');
          });
        }
        $this.bind('mouseover.cluetip', function(event) {
          $this.attr('title','');
        }).bind('mouseleave.cluetip', function(event) {
          $this.attr('title', $this.data('thisInfo').title);
        });
      }
    });
  };
  
/*
 * options for clueTip
 *
 * each one can be explicitly overridden by changing its value. 
 * for example: $.fn.cluetip.defaults.width = 200; 
 * would change the default width for all clueTips to 200. 
 *
 * each one can also be overridden by passing an options map to the cluetip method.
 * for example: $('a.example').cluetip({width: 200}); 
 * would change the default width to 200 for clueTips invoked by a link with class of "example"
 *
 */
  
  $.fn.cluetip.defaults = {  // set up default options
    width:            275,      // The width of the clueTip
    height:           'auto',   // The height of the clueTip
    cluezIndex:       999,      // Sets the z-index style property of the clueTip
    positionBy:       'auto',   // Sets the type of positioning: 'auto', 'mouse','bottomTop', 'fixed'
    topOffset:        15,       // Number of px to offset clueTip from top of invoking element
    leftOffset:       15,       // Number of px to offset clueTip from left of invoking element
    local:            false,    // Whether to use content from the same page for the clueTip's body
    localPrefix:      null,       // string to be prepended to the tip attribute if local is true
    hideLocal:        true,     // If local option is set to true, this determines whether local content
                                // to be shown in clueTip should be hidden at its original location
    attribute:        'rel',    // the attribute to be used for fetching the clueTip's body content
    titleAttribute:   'title',  // the attribute to be used for fetching the clueTip's title
    splitTitle:       '',       // A character used to split the title attribute into the clueTip title and divs
                                // within the clueTip body. more info below [6]
    escapeTitle:      false,    // whether to html escape the title attribute
    showTitle:        true,     // show title bar of the clueTip, even if title attribute not set
    cluetipClass:     'default',// class added to outermost clueTip div in the form of 'cluetip-' + clueTipClass.
    hoverClass:       '',       // class applied to the invoking element onmouseover and removed onmouseout
    waitImage:        true,     // whether to show a "loading" img, which is set in jquery.cluetip.css
    cursor:           'help',
    arrows:           false,    // if true, displays arrow on appropriate side of clueTip
    dropShadow:       true,     // set to false if you don't want the drop-shadow effect on the clueTip
    dropShadowSteps:  6,        // adjusts the size of the drop shadow
    sticky:           false,    // keep visible until manually closed
    mouseOutClose:    false,    // close when clueTip is moused out
    activation:       'hover',  // set to 'click' to force user to click to show clueTip
                                // set to 'focus' to show on focus of a form element and hide on blur
    clickThrough:     false,    // if true, and activation is not 'click', then clicking on link will take user to the link's href,
                                // even if href and tipAttribute are equal
    tracking:         false,    // if true, clueTip will track mouse movement (experimental)
    delayedClose:     0,        // close clueTip on a timed delay (experimental)
    closePosition:    'top',    // location of close text for sticky cluetips; can be 'top' or 'bottom' or 'title'
    closeText:        'Close',  // text (or HTML) to to be clicked to close sticky clueTips
    truncate:         0,        // number of characters to truncate clueTip's contents. if 0, no truncation occurs
    
    // effect and speed for opening clueTips
    fx: {             
                      open:       'show', // can be 'show' or 'slideDown' or 'fadeIn'
                      openSpeed:  ''
    },     

    // settings for when hoverIntent plugin is used             
    hoverIntent: {    
                      sensitivity:  3,
              			  interval:     50,
              			  timeout:      0
    },

    // short-circuit function to run just before clueTip is shown. 
    onActivate:       function(e) {return true;},
    // function to run just after clueTip is shown. 
    onShow:           function(ct, ci){},
    // function to run just after clueTip is hidden.
    onHide:           function(ct, ci){},
    // whether to cache results of ajax request to avoid unnecessary hits to server    
    ajaxCache:        true,  

    // process data retrieved via xhr before it's displayed
    ajaxProcess:      function(data) {
                        data = data.replace(/<(script|style|title)[^<]+<\/(script|style|title)>/gm, '').replace(/<(link|meta)[^>]+>/g,'');
                        return data;
    },                

    // can pass in standard $.ajax() parameters. Callback functions, such as beforeSend, 
    // will be queued first within the default callbacks. 
    // The only exception is error, which overrides the default
    ajaxSettings: {
                      // error: function(ct, ci) { /* override default error callback */ }
                      // beforeSend: function(ct, ci) { /* called first within default beforeSend callback }
                      dataType: 'html'
    },
    debug: false
  };


/*
 * Global defaults for clueTips. Apply to all calls to the clueTip plugin.
 *
 * @example $.cluetip.setup({
 *   insertionType: 'prependTo',
 *   insertionElement: '#container'
 * });
 * 
 * @property
 * @name $.cluetip.setup
 * @type Map
 * @cat Plugins/tooltip
 * @option String insertionType: Default is 'appendTo'. Determines the method to be used for inserting the clueTip into the DOM. Permitted values are 'appendTo', 'prependTo', 'insertBefore', and 'insertAfter'
 * @option String insertionElement: Default is 'body'. Determines which element in the DOM the plugin will reference when inserting the clueTip.
 *
 */
   
  var insertionType = 'appendTo', insertionElement = 'body';

  $.cluetip.setup = function(options) {
    if (options && options.insertionType && (options.insertionType).match(/appendTo|prependTo|insertBefore|insertAfter/)) {
      insertionType = options.insertionType;
    }
    if (options && options.insertionElement) {
      insertionElement = options.insertionElement;
    }
  };
  
})(jQuery);

/* vim: set ts=2 sw=2 sts=2 et: */
/**
 * Top message functions
 * 
 * @category   X-Cart
 * @package    X-Cart
 * @subpackage JS Library
 * @author     Ruslan R. Fazlyev <rrf@x-cart.com> 
 * @version    f2c96ddb72c96605401a2025154fc219a84e9e75, v4 (xcart_4_6_1), 2013-08-19 12:16:49, top_message.js, random
 * @link       http://www.x-cart.com/
 * @see        ____file_see____
 */

/* f2c96ddb72c96605401a2025154fc219a84e9e75, v4 (xcart_4_6_1), 2013-08-19 12:16:49, top_message.js, random */

function showTopMessage(content, type, anchor) {

  if (type === undefined) {
    type = 'I';
  }

  type = type.toLowerCase();

  $('#top-message').remove();

  if (type == 'e') {
    content = '<em>' + lbl_error + ':</em> ' + content;
  } else if (type == 'w') {
    content = '<em>' + lbl_warning + ':</em> ' + content;
  }

  var corners = ' ui-corner-bottom';
  var iframe_style = '';
  if (top !== self) {
    corners = ' ui-corner-all';
    iframe_style = ' class="inside-iframe"';
  }

  $('body').prepend('<div id="top-message"' + iframe_style + ' style="display: none;"><div class="box' + corners + ' message-' + type + '"><a href="javascript: void(0);" class="close-link" onclick="javascript: $(\'#top-message\').hide();"><img src="'+ images_dir + '/spacer.gif" class="close-img" /></a>' + content + '</div>');

  if (anchor) {
    $('#top-message > div.box').append('<div class="anchor"><a href="#' + anchor +'">' + lbl_go_to_last_edit_section + '<img src="' + images_dir + '/spacer.gif" alt="" /></a></div>');
  }

  if (topMessageDelay[type]) {
    $("#top-message").fadeIn('slow').delay(topMessageDelay[type]).fadeOut('slow');
  } else {
    $("#top-message").fadeIn('slow');
  }

}

/* vim: set ts=2 sw=2 sts=2 et: */
/**
 * Popup modal dialog widget
 * 
 * @category   X-Cart
 * @package    X-Cart
 * @subpackage JS Library
 * @author     Ruslan R. Fazlyev <rrf@x-cart.com> 
 * @version    df07adee291d462827fbe587b7684ab509c64a27, v34 (xcart_4_6_5), 2014-07-17 21:01:28, popup_open.js, aim
 * @link       http://www.x-cart.com/
 * @see        ____file_see____
 */

/**
 * Extend UI dialog widget
 */

$.extend($.ui.dialog.prototype, {

  // Load content from script
  load: function(src, title, postData) {

    var o = this;

    $(ajax.messages).unbind('popupDialogCall');

    $(ajax.messages).bind(
      'popupDialogCall',
      function(e, data) {

        switch (data.action) {

          case 'message':
            o.showMessage(data.message);
            o.element.unblock();
            break;

          case 'load':
            o.loadContent(data.src);
            break;
          
          case 'close':
            o.close();
            break;
          
          case 'jsCall':
            if (data.toEval) {
              eval(data.toEval);
            }
            break;
 
        }
      }
    );

    return this.loadContent(src, postData);
  },

  callback: function(state, a, b, c, d) {

    if (!state) {
      xAlert(txt_ajax_error_note, lbl_error, 'E');
      return false;
    }

    return this.onload(a, 'success');
  },

  // Get remove content
  loadContent: function (src, postData) {

    src += (src.search(/\?/) === -1 ? '?' : '&') + 'open_in_layer=Y&is_ajax_request=Y&keep_https=Y';
    var o = this;

    if (postData === undefined) {
      var _type = 'GET';
      var _data = {};
    } else {
      var _type = 'POST';
      var _data = postData;
    }

    return ajax.query.add(
      {
        type: _type,
        url: src,
        data: _data,
        success: function(a, b, c, d) {
          return o.callback(true, a, b, c, d);
        },
        error: function(a, b, c, d) {
          this.close();
          return o.callback(false, a, b, c, d);
        }
      }
    ) !== false;

  },
 
  // Onsubmit handler
  submitHandler: function(f) {

    if (undefined !== f.onsubmit && f.onsubmit && f.onsubmit.constructor != String && !f.onsubmit()) {
        return true;
    }

    if (!checkFormFields(f)) {
      return true;
    }

    var elm = $(f).parents('.popup-dialog').get(0);
   
    $(elm).block();

    var url = f.action;
    url += (url.search(/\?/) === -1 ? '?' : '&') + 'open_in_layer=Y&is_ajax_request=Y&keep_https=Y';

    var o = this;

    return ajax.query.add(
      {
        type: f.method ? f.method.toUpperCase() : 'GET',
        url: url,
        data: $(f).serialize(),
        success: function(a, b, c, d) {
          return o.callback(true, a, b, c, d);
        },
        error: function(a, b, c, d) {
          return o.callback(false, a, b, c, d);
        }
      }
    ) !== false;    

  },

  // Link onclick handler
  clickHandler: function(l) {

    var url = l.href;
    url += (url.search(/\?/) === -1 ? '?' : '&') + 'open_in_layer=Y&is_ajax_request=Y&keep_https=Y';

    var o = this;

    return ajax.query.add(
      {
        type: 'GET',
        url: url,
        data: {},
        success: function(a, b, c, d) {
          return o.callback(true, a, b, c, d);
        },
        error: function(a, b, c, d) {
          return o.callback(false, a, b, c, d);
        }
      }
    ) !== false;    
  },

  // Process onload method
  onload: function(data, s) {

    if (s != 'success') {
      return false;
    }
    
    if (!this.processResponse(data)) {

      if (this.insertData(data)) {
        this.processInsertData();
        this.activate();
        // WA for Firefox.For some reason autofocus html5 attr does not work for Firefox
        $('form', this.element).find("input[autofocus]").eq(0).focus();
      }

    }

    return true;
  },

  // Activate window
  activate: function() {

    if (!this.isOpen()) {
      this.open();
    }

    this.element.unblock();

    if (this.option('height') > this.option('maxHeight')) {
      this.option('height', this.option('maxHeight'));
    }
    
    if (this.option('width') > this.option('maxWidth')) {
      this.option('width', this.option('maxWidth'));
    }
    
    this._position('center');
   
  },

  // Show message
  showMessage: function(data) {
    
    if (data === undefined || !data.type || !data.content) {
      return false;
    }

    var msgbox = $('.ajax-popup-error-message', this.element).get(0);

    if (msgbox !== undefined) {
      var icon = $(document.createElement('span')).attr('class', 'ui-icon ' + (data.type == 'I' ? 'ui-icon-info' : 'ui-icon-alert'));
      var text = $(msgbox).children('p').get(0);

      if (data.type == 'I') {
        $(msgbox).removeClass('ui-state-error').addClass('ui-state-highlight');
      } else {
        $(msgbox).removeClass('ui-state-highlight').addClass('ui-state-error');
      }

      $(msgbox).width(this.element.width());

      $(text).html(data.content).prepend(icon);
      if ($(msgbox).not(':visible')) {
        $(msgbox).show();
      }
    }

  },

  // Process service signatures from AJAX response
  processResponse: function(data) {

    if (!data)
      return false;

    var m, l;

    if (data.search(/\/\* CMD: opener_reload \*\//) != -1) {
      // Opener window reload
      this.close();
      window.location.reload();
      return true;
    }
    
    if (data.search(/\/\* CMD: opener_relocate \*\//) != -1) {
      // Opener window redirect
      this.close();
      if (m = data.match(/window.parent.location = '([^']+)'/)) { 
        window.location = m[1];
      }
      return true;
    }

    if (data.search(/\/\* CMD: window_close \*\//) != -1) {
      // Close current window
      this.close();
      return true;
    }

    try {
      if ((m = data.match(/<meta http-equiv="Refresh" content="[0-9]+;URL=([^"]+)" \/>/)) || (this._ajax && (l = this._ajax.getResponseHeader('Location')))) {

        // Redirect
        if (m)
          l = m[1];

        this.load(l);
        return true;
      }
    } catch (e) { }

    return false;
  },

  // Parse page html and insert content
  insertData: function(data) {

    var m;
    data = data.replace(/\r/g, '');
    m = data.match(new RegExp("<!-- MAIN -->\n*((?:.*\n)+.*)<!-- \/MAIN -->"));
    if (!m)
      m = data.match(new RegExp("<body[^>]*>\n*((?:.*\n)+.*)<\/body>", 'i'));

    if (!m)
      return false;

    this.element.html(m[1]);

    if (m = data.match(new RegExp("<title>(.+)<\/title>"))) {
      this.setTitle(m[1]);
      this.element.find('h1:first').hide();
      this.element.prepend('<div class="ajax-popup-error-message ui-state-highlight ui-corner-all"><p><span class="ui-icon ui-icon-info"></span></p></div>');
    }

    return true;
  },

  // Set dialog title
  setTitle: function(title) {
    $(".ui-dialog-title", this.uiDialogTitlebar).html(title ? title : '');
  },

  // Bind handlers on some events
  processInsertData: function() {

    $(this).trigger('onload');

    var o = this; 

    $('form', this.element).bind('submit', function() {
      return !o.submitHandler(this);
    });

    $('a:not([href^="javascript:"])', this.element).not(".external_link").bind('click', function() {
      return !o.clickHandler(this);
    });

    return true;
  }

});


/**
 * Popup dialog class (jQuery UI dialog) 
 */

function popupOpen(src, title, params, postData) {

  // Close existing dialog
  $('.popup-dialog').dialog('destroy').remove();

  var popup = $(document.createElement('div'))
    .attr('class', 'popup-dialog')
    .css('display', 'none')
    .appendTo('body');

  var dialogOpts = {
    modal:     true, 
    autoOpen:  true,
    draggable: false,
    resizable: false,
    width:     'auto',
    height:    'auto',
    position:  {my : 'center center', at : 'center center'},
    maxHeight: 600,
    maxWidth:  800,
    closeOnEscape: true
  };

  if (undefined !== params) {
    for (var i in params) {
      dialogOpts[i] = params[i];
    }
  }

  try {
    $(popup)
      .dialog(dialogOpts)
      .block()
      .dialog('load', src, title, postData);

  } catch(e) {
    return false;
  }

  // Small hack to close a dialog on window.close() call
  window.close = function() {
    $(popup).dialog('close');
  }

  return true;
}

/*
* jQuery BlockUI; v20131009
* http://jquery.malsup.com/block/
* Copyright (c) 2013 M. Alsup; Dual licensed: MIT/GPL
*/
(function(){"use strict";function e(e){function o(o,i){var s,h,k=o==window,v=i&&void 0!==i.message?i.message:void 0;if(i=e.extend({},e.blockUI.defaults,i||{}),!i.ignoreIfBlocked||!e(o).data("blockUI.isBlocked")){if(i.overlayCSS=e.extend({},e.blockUI.defaults.overlayCSS,i.overlayCSS||{}),s=e.extend({},e.blockUI.defaults.css,i.css||{}),i.onOverlayClick&&(i.overlayCSS.cursor="pointer"),h=e.extend({},e.blockUI.defaults.themedCSS,i.themedCSS||{}),v=void 0===v?i.message:v,k&&b&&t(window,{fadeOut:0}),v&&"string"!=typeof v&&(v.parentNode||v.jquery)){var y=v.jquery?v[0]:v,m={};e(o).data("blockUI.history",m),m.el=y,m.parent=y.parentNode,m.display=y.style.display,m.position=y.style.position,m.parent&&m.parent.removeChild(y)}e(o).data("blockUI.onUnblock",i.onUnblock);var g,I,w,U,x=i.baseZ;g=r||i.forceIframe?e('<iframe class="blockUI" style="z-index:'+x++ +';display:none;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="'+i.iframeSrc+'"></iframe>'):e('<div class="blockUI" style="display:none"></div>'),I=i.theme?e('<div class="blockUI blockOverlay ui-widget-overlay" style="z-index:'+x++ +';display:none"></div>'):e('<div class="blockUI blockOverlay" style="z-index:'+x++ +';display:none;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>'),i.theme&&k?(U='<div class="blockUI '+i.blockMsgClass+' blockPage ui-dialog ui-widget ui-corner-all" style="z-index:'+(x+10)+';display:none;position:fixed">',i.title&&(U+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(i.title||"&nbsp;")+"</div>"),U+='<div class="ui-widget-content ui-dialog-content"></div>',U+="</div>"):i.theme?(U='<div class="blockUI '+i.blockMsgClass+' blockElement ui-dialog ui-widget ui-corner-all" style="z-index:'+(x+10)+';display:none;position:absolute">',i.title&&(U+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(i.title||"&nbsp;")+"</div>"),U+='<div class="ui-widget-content ui-dialog-content"></div>',U+="</div>"):U=k?'<div class="blockUI '+i.blockMsgClass+' blockPage" style="z-index:'+(x+10)+';display:none;position:fixed"></div>':'<div class="blockUI '+i.blockMsgClass+' blockElement" style="z-index:'+(x+10)+';display:none;position:absolute"></div>',w=e(U),v&&(i.theme?(w.css(h),w.addClass("ui-widget-content")):w.css(s)),i.theme||I.css(i.overlayCSS),I.css("position",k?"fixed":"absolute"),(r||i.forceIframe)&&g.css("opacity",0);var C=[g,I,w],S=k?e("body"):e(o);e.each(C,function(){this.appendTo(S)}),i.theme&&i.draggable&&e.fn.draggable&&w.draggable({handle:".ui-dialog-titlebar",cancel:"li"});var O=f&&(!e.support.boxModel||e("object,embed",k?null:o).length>0);if(u||O){if(k&&i.allowBodyStretch&&e.support.boxModel&&e("html,body").css("height","100%"),(u||!e.support.boxModel)&&!k)var E=d(o,"borderTopWidth"),T=d(o,"borderLeftWidth"),M=E?"(0 - "+E+")":0,B=T?"(0 - "+T+")":0;e.each(C,function(e,o){var t=o[0].style;if(t.position="absolute",2>e)k?t.setExpression("height","Math.max(document.body.scrollHeight, document.body.offsetHeight) - (jQuery.support.boxModel?0:"+i.quirksmodeOffsetHack+') + "px"'):t.setExpression("height",'this.parentNode.offsetHeight + "px"'),k?t.setExpression("width",'jQuery.support.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"'):t.setExpression("width",'this.parentNode.offsetWidth + "px"'),B&&t.setExpression("left",B),M&&t.setExpression("top",M);else if(i.centerY)k&&t.setExpression("top",'(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"'),t.marginTop=0;else if(!i.centerY&&k){var n=i.css&&i.css.top?parseInt(i.css.top,10):0,s="((document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "+n+') + "px"';t.setExpression("top",s)}})}if(v&&(i.theme?w.find(".ui-widget-content").append(v):w.append(v),(v.jquery||v.nodeType)&&e(v).show()),(r||i.forceIframe)&&i.showOverlay&&g.show(),i.fadeIn){var j=i.onBlock?i.onBlock:c,H=i.showOverlay&&!v?j:c,z=v?j:c;i.showOverlay&&I._fadeIn(i.fadeIn,H),v&&w._fadeIn(i.fadeIn,z)}else i.showOverlay&&I.show(),v&&w.show(),i.onBlock&&i.onBlock();if(n(1,o,i),k?(b=w[0],p=e(i.focusableElements,b),i.focusInput&&setTimeout(l,20)):a(w[0],i.centerX,i.centerY),i.timeout){var W=setTimeout(function(){k?e.unblockUI(i):e(o).unblock(i)},i.timeout);e(o).data("blockUI.timeout",W)}}}function t(o,t){var s,l=o==window,a=e(o),d=a.data("blockUI.history"),c=a.data("blockUI.timeout");c&&(clearTimeout(c),a.removeData("blockUI.timeout")),t=e.extend({},e.blockUI.defaults,t||{}),n(0,o,t),null===t.onUnblock&&(t.onUnblock=a.data("blockUI.onUnblock"),a.removeData("blockUI.onUnblock"));var r;r=l?e("body").children().filter(".blockUI").add("body > .blockUI"):a.find(">.blockUI"),t.cursorReset&&(r.length>1&&(r[1].style.cursor=t.cursorReset),r.length>2&&(r[2].style.cursor=t.cursorReset)),l&&(b=p=null),t.fadeOut?(s=r.length,r.stop().fadeOut(t.fadeOut,function(){0===--s&&i(r,d,t,o)})):i(r,d,t,o)}function i(o,t,i,n){var s=e(n);if(!s.data("blockUI.isBlocked")){o.each(function(){this.parentNode&&this.parentNode.removeChild(this)}),t&&t.el&&(t.el.style.display=t.display,t.el.style.position=t.position,t.parent&&t.parent.appendChild(t.el),s.removeData("blockUI.history")),s.data("blockUI.static")&&s.css("position","static"),"function"==typeof i.onUnblock&&i.onUnblock(n,i);var l=e(document.body),a=l.width(),d=l[0].style.width;l.width(a-1).width(a),l[0].style.width=d}}function n(o,t,i){var n=t==window,l=e(t);if((o||(!n||b)&&(n||l.data("blockUI.isBlocked")))&&(l.data("blockUI.isBlocked",o),n&&i.bindEvents&&(!o||i.showOverlay))){var a="mousedown mouseup keydown keypress keyup touchstart touchend touchmove";o?e(document).bind(a,i,s):e(document).unbind(a,s)}}function s(o){if("keydown"===o.type&&o.keyCode&&9==o.keyCode&&b&&o.data.constrainTabKey){var t=p,i=!o.shiftKey&&o.target===t[t.length-1],n=o.shiftKey&&o.target===t[0];if(i||n)return setTimeout(function(){l(n)},10),!1}var s=o.data,a=e(o.target);return a.hasClass("blockOverlay")&&s.onOverlayClick&&s.onOverlayClick(o),a.parents("div."+s.blockMsgClass).length>0?!0:0===a.parents().children().filter("div.blockUI").length}function l(e){if(p){var o=p[e===!0?p.length-1:0];o&&o.focus()}}function a(e,o,t){var i=e.parentNode,n=e.style,s=(i.offsetWidth-e.offsetWidth)/2-d(i,"borderLeftWidth"),l=(i.offsetHeight-e.offsetHeight)/2-d(i,"borderTopWidth");o&&(n.left=s>0?s+"px":"0"),t&&(n.top=l>0?l+"px":"0")}function d(o,t){return parseInt(e.css(o,t),10)||0}e.fn._fadeIn=e.fn.fadeIn;var c=e.noop||function(){},r=/MSIE/.test(navigator.userAgent),u=/MSIE 6.0/.test(navigator.userAgent)&&!/MSIE 8.0/.test(navigator.userAgent);document.documentMode||0;var f=e.isFunction(document.createElement("div").style.setExpression);e.blockUI=function(e){o(window,e)},e.unblockUI=function(e){t(window,e)},e.growlUI=function(o,t,i,n){var s=e('<div class="growlUI"></div>');o&&s.append("<h1>"+o+"</h1>"),t&&s.append("<h2>"+t+"</h2>"),void 0===i&&(i=3e3);var l=function(o){o=o||{},e.blockUI({message:s,fadeIn:o.fadeIn!==void 0?o.fadeIn:700,fadeOut:o.fadeOut!==void 0?o.fadeOut:1e3,timeout:o.timeout!==void 0?o.timeout:i,centerY:!1,showOverlay:!1,onUnblock:n,css:e.blockUI.defaults.growlCSS})};l(),s.css("opacity"),s.mouseover(function(){l({fadeIn:0,timeout:3e4});var o=e(".blockMsg");o.stop(),o.fadeTo(300,1)}).mouseout(function(){e(".blockMsg").fadeOut(1e3)})},e.fn.block=function(t){if(this[0]===window)return e.blockUI(t),this;var i=e.extend({},e.blockUI.defaults,t||{});return this.each(function(){var o=e(this);i.ignoreIfBlocked&&o.data("blockUI.isBlocked")||o.unblock({fadeOut:0})}),this.each(function(){"static"==e.css(this,"position")&&(this.style.position="relative",e(this).data("blockUI.static",!0)),this.style.zoom=1,o(this,t)})},e.fn.unblock=function(o){return this[0]===window?(e.unblockUI(o),this):this.each(function(){t(this,o)})},e.blockUI.version=2.66,e.blockUI.defaults={message:"<h1>Please wait...</h1>",title:null,draggable:!0,theme:!1,css:{padding:0,margin:0,width:"30%",top:"40%",left:"35%",textAlign:"center",color:"#000",border:"3px solid #aaa",backgroundColor:"#fff",cursor:"wait"},themedCSS:{width:"30%",top:"40%",left:"35%"},overlayCSS:{backgroundColor:"#000",opacity:.6,cursor:"wait"},cursorReset:"default",growlCSS:{width:"350px",top:"10px",left:"",right:"10px",border:"none",padding:"5px",opacity:.6,cursor:"default",color:"#fff",backgroundColor:"#000","-webkit-border-radius":"10px","-moz-border-radius":"10px","border-radius":"10px"},iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank",forceIframe:!1,baseZ:1e3,centerX:!0,centerY:!0,allowBodyStretch:!0,bindEvents:!0,constrainTabKey:!0,fadeIn:200,fadeOut:400,timeout:0,showOverlay:!0,focusInput:!0,focusableElements:":input:enabled:visible",onBlock:null,onUnblock:null,onOverlayClick:null,quirksmodeOffsetHack:4,blockMsgClass:"blockMsg",ignoreIfBlocked:!1};var b=null,p=[]}"function"==typeof define&&define.amd&&define.amd.jQuery?define(["jquery"],e):e(jQuery)})();
$.blockUI.defaults.message = '<span class="waiting">' + lbl_blockui_default_message + '</span>';
$.blockUI.defaults.theme = false;
$.blockUI.defaults.draggable = false;

$.blockUI.defaults.css.width = '200px';
$.blockUI.defaults.css.top = '';
$.blockUI.defaults.css.left = '';

$.blockUI.defaults.overlayCSS.backgroundColor = '#212121';
$.blockUI.defaults.overlayCSS.opacity = 0.3;
$.blockUI.defaults.overlayCSS.cursor = 'default';

$.blockUI.defaults.growlCSS.left = '0px';
$.blockUI.defaults.growlCSS.right = '0px';
$.blockUI.defaults.growlCSS.border = 'solid 1px #aaa';
$.blockUI.defaults.growlCSS.opacity = 0.9;
$.blockUI.defaults.growlCSS.cursor = null;
$.blockUI.defaults.growlCSS.color = '#000';
$.blockUI.defaults.growlCSS.backgroundColor = '#fff';
$.blockUI.defaults.growlCSS['-webkit-border-radius'] = '3px';
$.blockUI.defaults.growlCSS['-moz-border-radius'] = '3px';
$.blockUI.defaults.growlCSS['border-radius'] = '3px';

$.blockUI.defaults.fadeIn = 0;
$.blockUI.defaults.fadeOut = 0;

/*!
 * jQuery Cycle Plugin (with Transition Definitions)
 * Examples and documentation at: http://jquery.malsup.com/cycle/
 * Copyright (c) 2007-2009 M. Alsup
 * Version: 2.73 (04-NOV-2009)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Requires: jQuery v1.2.6 or later
 *
 * Originally based on the work of:
 *	1) Matt Oakes
 *	2) Torsten Baldes (http://medienfreunde.com/lab/innerfade/)
 *	3) Benjamin Sterling (http://www.benjaminsterling.com/experiments/jqShuffle/)
 */
;(function($) {

var ver = '2.73';

// if $.support is not defined (pre jQuery 1.3) add what I need
if ($.support == undefined) {
	$.support = {
		opacity: !($.browser.msie)
	};
}

function debug(s) {
	if ($.fn.cycle.debug)
		log(s);
}		
function log() {
	if (window.console && window.console.log)
		window.console.log('[cycle] ' + Array.prototype.join.call(arguments,' '));
	//$('body').append('<div>'+Array.prototype.join.call(arguments,' ')+'</div>');
};

// the options arg can be...
//   a number  - indicates an immediate transition should occur to the given slide index
//   a string  - 'stop', 'pause', 'resume', or the name of a transition effect (ie, 'fade', 'zoom', etc)
//   an object - properties to control the slideshow
//
// the arg2 arg can be...
//   the name of an fx (only used in conjunction with a numeric value for 'options')
//   the value true (only used in conjunction with a options == 'resume') and indicates
//	 that the resume should occur immediately (not wait for next timeout)

$.fn.cycle = function(options, arg2) {
	var o = { s: this.selector, c: this.context };

	// in 1.3+ we can fix mistakes with the ready state
	if (this.length === 0 && options != 'stop') {
		if (!$.isReady && o.s) {
			log('DOM not ready, queuing slideshow');
			$(function() {
				$(o.s,o.c).cycle(options,arg2);
			});
			return this;
		}
		// is your DOM ready?  http://docs.jquery.com/Tutorials:Introducing_$(document).ready()
		log('terminating; zero elements found by selector' + ($.isReady ? '' : ' (DOM not ready)'));
		return this;
	}

	// iterate the matched nodeset
	return this.each(function() {
		var opts = handleArguments(this, options, arg2);
		if (opts === false)
			return;

		// stop existing slideshow for this container (if there is one)
		if (this.cycleTimeout)
			clearTimeout(this.cycleTimeout);
		this.cycleTimeout = this.cyclePause = 0;

		var $cont = $(this);
		var $slides = opts.slideExpr ? $(opts.slideExpr, this) : $cont.children();
		var els = $slides.get();
		if (els.length < 2) {
			log('terminating; too few slides: ' + els.length);
			return;
		}

		var opts2 = buildOptions($cont, $slides, els, opts, o);
		if (opts2 === false)
			return;

		var startTime = opts2.continuous ? 10 : getTimeout(opts2.currSlide, opts2.nextSlide, opts2, !opts2.rev);

		// if it's an auto slideshow, kick it off
		if (startTime) {
			startTime += (opts2.delay || 0);
			if (startTime < 10)
				startTime = 10;
			debug('first timeout: ' + startTime);
			this.cycleTimeout = setTimeout(function(){go(els,opts2,0,!opts2.rev)}, startTime);
		}
	});
};

// process the args that were passed to the plugin fn
function handleArguments(cont, options, arg2) {
	if (cont.cycleStop == undefined)
		cont.cycleStop = 0;
	if (options === undefined || options === null)
		options = {};
	if (options.constructor == String) {
		switch(options) {
		case 'stop':
			cont.cycleStop++; // callbacks look for change
			if (cont.cycleTimeout)
				clearTimeout(cont.cycleTimeout);
			cont.cycleTimeout = 0;
			$(cont).removeData('cycle.opts');
			return false;
		case 'pause':
			cont.cyclePause = 1;
			return false;
		case 'resume':
			cont.cyclePause = 0;
			if (arg2 === true) { // resume now!
				options = $(cont).data('cycle.opts');
				if (!options) {
					log('options not found, can not resume');
					return false;
				}
				if (cont.cycleTimeout) {
					clearTimeout(cont.cycleTimeout);
					cont.cycleTimeout = 0;
				}
				go(options.elements, options, 1, 1);
			}
			return false;
		case 'prev':
		case 'next':
			var opts = $(cont).data('cycle.opts');
			if (!opts) {
				log('options not found, "prev/next" ignored');
				return false;
			}
			$.fn.cycle[options](opts);
			return false;
		default:
			options = { fx: options };
		};
		return options;
	}
	else if (options.constructor == Number) {
		// go to the requested slide
		var num = options;
		options = $(cont).data('cycle.opts');
		if (!options) {
			log('options not found, can not advance slide');
			return false;
		}
		if (num < 0 || num >= options.elements.length) {
			log('invalid slide index: ' + num);
			return false;
		}
		options.nextSlide = num;
		if (cont.cycleTimeout) {
			clearTimeout(cont.cycleTimeout);
			cont.cycleTimeout = 0;
		}
		if (typeof arg2 == 'string')
			options.oneTimeFx = arg2;
		go(options.elements, options, 1, num >= options.currSlide);
		return false;
	}
	return options;
};

function removeFilter(el, opts) {
	if (!$.support.opacity && opts.cleartype && el.style.filter) {
		try { el.style.removeAttribute('filter'); }
		catch(smother) {} // handle old opera versions
	}
};

// one-time initialization
function buildOptions($cont, $slides, els, options, o) {
	// support metadata plugin (v1.0 and v2.0)
	var opts = $.extend({}, $.fn.cycle.defaults, options || {}, $.metadata ? $cont.metadata() : $.meta ? $cont.data() : {});
	if (opts.autostop)
		opts.countdown = opts.autostopCount || els.length;

	var cont = $cont[0];
	$cont.data('cycle.opts', opts);
	opts.$cont = $cont;
	opts.stopCount = cont.cycleStop;
	opts.elements = els;
	opts.before = opts.before ? [opts.before] : [];
	opts.after = opts.after ? [opts.after] : [];
	opts.after.unshift(function(){ opts.busy=0; });

	// push some after callbacks
	if (!$.support.opacity && opts.cleartype)
		opts.after.push(function() { removeFilter(this, opts); });
	if (opts.continuous)
		opts.after.push(function() { go(els,opts,0,!opts.rev); });

	saveOriginalOpts(opts);

	// clearType corrections
	if (!$.support.opacity && opts.cleartype && !opts.cleartypeNoBg)
		clearTypeFix($slides);

	// container requires non-static position so that slides can be position within
	if ($cont.css('position') == 'static')
		$cont.css('position', 'relative');
	if (opts.width)
		$cont.width(opts.width);
	if (opts.height && opts.height != 'auto')
		$cont.height(opts.height);

	if (opts.startingSlide)
		opts.startingSlide = parseInt(opts.startingSlide);

	// if random, mix up the slide array
	if (opts.random) {
		opts.randomMap = [];
		for (var i = 0; i < els.length; i++)
			opts.randomMap.push(i);
		opts.randomMap.sort(function(a,b) {return Math.random() - 0.5;});
		opts.randomIndex = 0;
		opts.startingSlide = opts.randomMap[0];
	}
	else if (opts.startingSlide >= els.length)
		opts.startingSlide = 0; // catch bogus input
	opts.currSlide = opts.startingSlide = opts.startingSlide || 0;
	var first = opts.startingSlide;

	// set position and zIndex on all the slides
	$slides.css({position: 'absolute', top:0, left:0}).hide().each(function(i) {
		var z = first ? i >= first ? els.length - (i-first) : first-i : els.length-i;
		$(this).css('z-index', z)
	});

	// make sure first slide is visible
	$(els[first]).css('opacity',1).show(); // opacity bit needed to handle restart use case
	removeFilter(els[first], opts);

	// stretch slides
	if (opts.fit && opts.width)
		$slides.width(opts.width);
	if (opts.fit && opts.height && opts.height != 'auto')
		$slides.height(opts.height);

	// stretch container
	var reshape = opts.containerResize && !$cont.innerHeight();
	if (reshape) { // do this only if container has no size http://tinyurl.com/da2oa9
		var maxw = 0, maxh = 0;
		for(var j=0; j < els.length; j++) {
			var $e = $(els[j]), e = $e[0], w = $e.outerWidth(), h = $e.outerHeight();
			if (!w) w = e.offsetWidth;
			if (!h) h = e.offsetHeight;
			maxw = w > maxw ? w : maxw;
			maxh = h > maxh ? h : maxh;
		}
		if (maxw > 0 && maxh > 0)
			$cont.css({width:maxw+'px',height:maxh+'px'});
	}

	if (opts.pause)
		$cont.hover(function(){this.cyclePause++;},function(){this.cyclePause--;});

	if (supportMultiTransitions(opts) === false)
		return false;

	// apparently a lot of people use image slideshows without height/width attributes on the images.
	// Cycle 2.50+ requires the sizing info for every slide; this block tries to deal with that.
	var requeue = false;
	options.requeueAttempts = options.requeueAttempts || 0;
	$slides.each(function() {
		// try to get height/width of each slide
		var $el = $(this);
		this.cycleH = (opts.fit && opts.height) ? opts.height : $el.height();
		this.cycleW = (opts.fit && opts.width) ? opts.width : $el.width();

		if ( $el.is('img') ) {
			// sigh..  sniffing, hacking, shrugging...  this crappy hack tries to account for what browsers do when
			// an image is being downloaded and the markup did not include sizing info (height/width attributes);
			// there seems to be some "default" sizes used in this situation
			var loadingIE	= ($.browser.msie  && this.cycleW == 28 && this.cycleH == 30 && !this.complete);
			var loadingFF	= ($.browser.mozilla && this.cycleW == 34 && this.cycleH == 19 && !this.complete);
			var loadingOp	= ($.browser.opera && ((this.cycleW == 42 && this.cycleH == 19) || (this.cycleW == 37 && this.cycleH == 17)) && !this.complete);
			var loadingOther = (this.cycleH == 0 && this.cycleW == 0 && !this.complete);
			// don't requeue for images that are still loading but have a valid size
			if (loadingIE || loadingFF || loadingOp || loadingOther) {
				if (o.s && opts.requeueOnImageNotLoaded && ++options.requeueAttempts < 100) { // track retry count so we don't loop forever
					log(options.requeueAttempts,' - img slide not loaded, requeuing slideshow: ', this.src, this.cycleW, this.cycleH);
					setTimeout(function() {$(o.s,o.c).cycle(options)}, opts.requeueTimeout);
					requeue = true;
					return false; // break each loop
				}
				else {
					log('could not determine size of image: '+this.src, this.cycleW, this.cycleH);
				}
			}
		}
		return true;
	});

	if (requeue)
		return false;

	opts.cssBefore = opts.cssBefore || {};
	opts.animIn = opts.animIn || {};
	opts.animOut = opts.animOut || {};

	$slides.not(':eq('+first+')').css(opts.cssBefore);
	if (opts.cssFirst)
		$($slides[first]).css(opts.cssFirst);

	if (opts.timeout) {
		opts.timeout = parseInt(opts.timeout);
		// ensure that timeout and speed settings are sane
		if (opts.speed.constructor == String)
			opts.speed = $.fx.speeds[opts.speed] || parseInt(opts.speed);
		if (!opts.sync)
			opts.speed = opts.speed / 2;
		while((opts.timeout - opts.speed) < 250) // sanitize timeout
			opts.timeout += opts.speed;
	}
	if (opts.easing)
		opts.easeIn = opts.easeOut = opts.easing;
	if (!opts.speedIn)
		opts.speedIn = opts.speed;
	if (!opts.speedOut)
		opts.speedOut = opts.speed;

	opts.slideCount = els.length;
	opts.currSlide = opts.lastSlide = first;
	if (opts.random) {
		opts.nextSlide = opts.currSlide;
		if (++opts.randomIndex == els.length)
			opts.randomIndex = 0;
		opts.nextSlide = opts.randomMap[opts.randomIndex];
	}
	else
		opts.nextSlide = opts.startingSlide >= (els.length-1) ? 0 : opts.startingSlide+1;

	// run transition init fn
	if (!opts.multiFx) {
		var init = $.fn.cycle.transitions[opts.fx];
		if ($.isFunction(init))
			init($cont, $slides, opts);
		else if (opts.fx != 'custom' && !opts.multiFx) {
			log('unknown transition: ' + opts.fx,'; slideshow terminating');
			return false;
		}
	}

	// fire artificial events
	var e0 = $slides[first];
	if (opts.before.length)
		opts.before[0].apply(e0, [e0, e0, opts, true]);
	if (opts.after.length > 1)
		opts.after[1].apply(e0, [e0, e0, opts, true]);

	if (opts.next)
		$(opts.next).bind(opts.prevNextEvent,function(){return advance(opts,opts.rev?-1:1)});
	if (opts.prev)
		$(opts.prev).bind(opts.prevNextEvent,function(){return advance(opts,opts.rev?1:-1)});
	if (opts.pager)
		buildPager(els,opts);

	exposeAddSlide(opts, els);

	return opts;
};

// save off original opts so we can restore after clearing state
function saveOriginalOpts(opts) {
	opts.original = { before: [], after: [] };
	opts.original.cssBefore = $.extend({}, opts.cssBefore);
	opts.original.cssAfter  = $.extend({}, opts.cssAfter);
	opts.original.animIn	= $.extend({}, opts.animIn);
	opts.original.animOut   = $.extend({}, opts.animOut);
	$.each(opts.before, function() { opts.original.before.push(this); });
	$.each(opts.after,  function() { opts.original.after.push(this); });
};

function supportMultiTransitions(opts) {
	var i, tx, txs = $.fn.cycle.transitions;
	// look for multiple effects
	if (opts.fx.indexOf(',') > 0) {
		opts.multiFx = true;
		opts.fxs = opts.fx.replace(/\s*/g,'').split(',');
		// discard any bogus effect names
		for (i=0; i < opts.fxs.length; i++) {
			var fx = opts.fxs[i];
			tx = txs[fx];
			if (!tx || !txs.hasOwnProperty(fx) || !$.isFunction(tx)) {
				log('discarding unknown transition: ',fx);
				opts.fxs.splice(i,1);
				i--;
			}
		}
		// if we have an empty list then we threw everything away!
		if (!opts.fxs.length) {
			log('No valid transitions named; slideshow terminating.');
			return false;
		}
	}
	else if (opts.fx == 'all') {  // auto-gen the list of transitions
		opts.multiFx = true;
		opts.fxs = [];
		for (p in txs) {
			tx = txs[p];
			if (txs.hasOwnProperty(p) && $.isFunction(tx))
				opts.fxs.push(p);
		}
	}
	if (opts.multiFx && opts.randomizeEffects) {
		// munge the fxs array to make effect selection random
		var r1 = Math.floor(Math.random() * 20) + 30;
		for (i = 0; i < r1; i++) {
			var r2 = Math.floor(Math.random() * opts.fxs.length);
			opts.fxs.push(opts.fxs.splice(r2,1)[0]);
		}
		debug('randomized fx sequence: ',opts.fxs);
	}
	return true;
};

// provide a mechanism for adding slides after the slideshow has started
function exposeAddSlide(opts, els) {
	opts.addSlide = function(newSlide, prepend) {
		var $s = $(newSlide), s = $s[0];
		if (!opts.autostopCount)
			opts.countdown++;
		els[prepend?'unshift':'push'](s);
		if (opts.els)
			opts.els[prepend?'unshift':'push'](s); // shuffle needs this
		opts.slideCount = els.length;

		$s.css('position','absolute');
		$s[prepend?'prependTo':'appendTo'](opts.$cont);

		if (prepend) {
			opts.currSlide++;
			opts.nextSlide++;
		}

		if (!$.support.opacity && opts.cleartype && !opts.cleartypeNoBg)
			clearTypeFix($s);

		if (opts.fit && opts.width)
			$s.width(opts.width);
		if (opts.fit && opts.height && opts.height != 'auto')
			$slides.height(opts.height);
		s.cycleH = (opts.fit && opts.height) ? opts.height : $s.height();
		s.cycleW = (opts.fit && opts.width) ? opts.width : $s.width();

		$s.css(opts.cssBefore);

		if (opts.pager)
			$.fn.cycle.createPagerAnchor(els.length-1, s, $(opts.pager), els, opts);

		if ($.isFunction(opts.onAddSlide))
			opts.onAddSlide($s);
		else
			$s.hide(); // default behavior
	};
}

// reset internal state; we do this on every pass in order to support multiple effects
$.fn.cycle.resetState = function(opts, fx) {
	fx = fx || opts.fx;
	opts.before = []; opts.after = [];
	opts.cssBefore = $.extend({}, opts.original.cssBefore);
	opts.cssAfter  = $.extend({}, opts.original.cssAfter);
	opts.animIn	= $.extend({}, opts.original.animIn);
	opts.animOut   = $.extend({}, opts.original.animOut);
	opts.fxFn = null;
	$.each(opts.original.before, function() { opts.before.push(this); });
	$.each(opts.original.after,  function() { opts.after.push(this); });

	// re-init
	var init = $.fn.cycle.transitions[fx];
	if ($.isFunction(init))
		init(opts.$cont, $(opts.elements), opts);
};

// this is the main engine fn, it handles the timeouts, callbacks and slide index mgmt
function go(els, opts, manual, fwd) {
	// opts.busy is true if we're in the middle of an animation
	if (manual && opts.busy && opts.manualTrump) {
		// let manual transitions requests trump active ones
		$(els).stop(true,true);
		opts.busy = false;
	}
	// don't begin another timeout-based transition if there is one active
	if (opts.busy)
		return;

	var p = opts.$cont[0], curr = els[opts.currSlide], next = els[opts.nextSlide];

	// stop cycling if we have an outstanding stop request
	if (p.cycleStop != opts.stopCount || p.cycleTimeout === 0 && !manual)
		return;

	// check to see if we should stop cycling based on autostop options
	if (!manual && !p.cyclePause &&
		((opts.autostop && (--opts.countdown <= 0)) ||
		(opts.nowrap && !opts.random && opts.nextSlide < opts.currSlide))) {
		if (opts.end)
			opts.end(opts);
		return;
	}

	// if slideshow is paused, only transition on a manual trigger
	if (manual || !p.cyclePause) {
		var fx = opts.fx;
		// keep trying to get the slide size if we don't have it yet
		curr.cycleH = curr.cycleH || $(curr).height();
		curr.cycleW = curr.cycleW || $(curr).width();
		next.cycleH = next.cycleH || $(next).height();
		next.cycleW = next.cycleW || $(next).width();

		// support multiple transition types
		if (opts.multiFx) {
			if (opts.lastFx == undefined || ++opts.lastFx >= opts.fxs.length)
				opts.lastFx = 0;
			fx = opts.fxs[opts.lastFx];
			opts.currFx = fx;
		}

		// one-time fx overrides apply to:  $('div').cycle(3,'zoom');
		if (opts.oneTimeFx) {
			fx = opts.oneTimeFx;
			opts.oneTimeFx = null;
		}

		$.fn.cycle.resetState(opts, fx);

		// run the before callbacks
		if (opts.before.length)
			$.each(opts.before, function(i,o) {
				if (p.cycleStop != opts.stopCount) return;
				o.apply(next, [curr, next, opts, fwd]);
			});

		// stage the after callacks
		var after = function() {
			$.each(opts.after, function(i,o) {
				if (p.cycleStop != opts.stopCount) return;
				o.apply(next, [curr, next, opts, fwd]);
			});
		};

		if (opts.nextSlide != opts.currSlide) {
			// get ready to perform the transition
			opts.busy = 1;
			if (opts.fxFn) // fx function provided?
				opts.fxFn(curr, next, opts, after, fwd);
			else if ($.isFunction($.fn.cycle[opts.fx])) // fx plugin ?
				$.fn.cycle[opts.fx](curr, next, opts, after);
			else
				$.fn.cycle.custom(curr, next, opts, after, manual && opts.fastOnEvent);
		}

		// calculate the next slide
		opts.lastSlide = opts.currSlide;
		if (opts.random) {
			opts.currSlide = opts.nextSlide;
			if (++opts.randomIndex == els.length)
				opts.randomIndex = 0;
			opts.nextSlide = opts.randomMap[opts.randomIndex];
		}
		else { // sequence
			var roll = (opts.nextSlide + 1) == els.length;
			opts.nextSlide = roll ? 0 : opts.nextSlide+1;
			opts.currSlide = roll ? els.length-1 : opts.nextSlide-1;
		}

		if (opts.pager)
			$.fn.cycle.updateActivePagerLink(opts.pager, opts.currSlide);
	}

	// stage the next transtion
	var ms = 0;
	if (opts.timeout && !opts.continuous)
		ms = getTimeout(curr, next, opts, fwd);
	else if (opts.continuous && p.cyclePause) // continuous shows work off an after callback, not this timer logic
		ms = 10;
	if (ms > 0)
		p.cycleTimeout = setTimeout(function(){ go(els, opts, 0, !opts.rev) }, ms);
};

// invoked after transition
$.fn.cycle.updateActivePagerLink = function(pager, currSlide) {
	$(pager).each(function() {
		$(this).find('a').removeClass('activeSlide').filter('a:eq('+currSlide+')').addClass('activeSlide');
	});
};

// calculate timeout value for current transition
function getTimeout(curr, next, opts, fwd) {
	if (opts.timeoutFn) {
		// call user provided calc fn
		var t = opts.timeoutFn(curr,next,opts,fwd);
		while ((t - opts.speed) < 250) // sanitize timeout
			t += opts.speed;
		debug('calculated timeout: ' + t + '; speed: ' + opts.speed);
		if (t !== false)
			return t;
	}
	return opts.timeout;
};

// expose next/prev function, caller must pass in state
$.fn.cycle.next = function(opts) { advance(opts, opts.rev?-1:1); };
$.fn.cycle.prev = function(opts) { advance(opts, opts.rev?1:-1);};

// advance slide forward or back
function advance(opts, val) {
	var els = opts.elements;
	var p = opts.$cont[0], timeout = p.cycleTimeout;
	if (timeout) {
		clearTimeout(timeout);
		p.cycleTimeout = 0;
	}
	if (opts.random && val < 0) {
		// move back to the previously display slide
		opts.randomIndex--;
		if (--opts.randomIndex == -2)
			opts.randomIndex = els.length-2;
		else if (opts.randomIndex == -1)
			opts.randomIndex = els.length-1;
		opts.nextSlide = opts.randomMap[opts.randomIndex];
	}
	else if (opts.random) {
		if (++opts.randomIndex == els.length)
			opts.randomIndex = 0;
		opts.nextSlide = opts.randomMap[opts.randomIndex];
	}
	else {
		opts.nextSlide = opts.currSlide + val;
		if (opts.nextSlide < 0) {
			if (opts.nowrap) return false;
			opts.nextSlide = els.length - 1;
		}
		else if (opts.nextSlide >= els.length) {
			if (opts.nowrap) return false;
			opts.nextSlide = 0;
		}
	}

	if ($.isFunction(opts.prevNextClick))
		opts.prevNextClick(val > 0, opts.nextSlide, els[opts.nextSlide]);
	go(els, opts, 1, val>=0);
	return false;
};

function buildPager(els, opts) {
	var $p = $(opts.pager);
	$.each(els, function(i,o) {
		$.fn.cycle.createPagerAnchor(i,o,$p,els,opts);
	});
   $.fn.cycle.updateActivePagerLink(opts.pager, opts.startingSlide);
};

$.fn.cycle.createPagerAnchor = function(i, el, $p, els, opts) {
	var a;
	if ($.isFunction(opts.pagerAnchorBuilder))
		a = opts.pagerAnchorBuilder(i,el);
	else
		a = '<a href="#">'+'<div class="image-selector"><div class="image-selector-inner"></div></div>'+'</a>';              //changed
		
	if (!a)
		return;
	var $a = $(a);
	// don't reparent if anchor is in the dom
	if ($a.parents('body').length === 0) {
		var arr = [];
		if ($p.length > 1) {
			$p.each(function() {
				var $clone = $a.clone(true);
				$(this).append($clone);
				arr.push($clone[0]);
			});
			$a = $(arr);
		}
		else {
			$a.appendTo($p);
		}
	}

	$a.bind(opts.pagerEvent, function(e) {
		e.preventDefault();
		opts.nextSlide = i;
		var p = opts.$cont[0], timeout = p.cycleTimeout;
		if (timeout) {
			clearTimeout(timeout);
			p.cycleTimeout = 0;
		}
		if ($.isFunction(opts.pagerClick))
			opts.pagerClick(opts.nextSlide, els[opts.nextSlide]);
		go(els,opts,1,opts.currSlide < i); // trigger the trans
		return false;
	});
	
	if (opts.pagerEvent != 'click')
		$a.click(function(){return false;}); // supress click
	
	if (opts.pauseOnPagerHover)
		$a.hover(function() { opts.$cont[0].cyclePause++; }, function() { opts.$cont[0].cyclePause--; } );
};

// helper fn to calculate the number of slides between the current and the next
$.fn.cycle.hopsFromLast = function(opts, fwd) {
	var hops, l = opts.lastSlide, c = opts.currSlide;
	if (fwd)
		hops = c > l ? c - l : opts.slideCount - l;
	else
		hops = c < l ? l - c : l + opts.slideCount - c;
	return hops;
};

// fix clearType problems in ie6 by setting an explicit bg color
// (otherwise text slides look horrible during a fade transition)
function clearTypeFix($slides) {
	function hex(s) {
		s = parseInt(s).toString(16);
		return s.length < 2 ? '0'+s : s;
	};
	function getBg(e) {
		for ( ; e && e.nodeName.toLowerCase() != 'html'; e = e.parentNode) {
			var v = $.css(e,'background-color');
			if (v.indexOf('rgb') >= 0 ) {
				var rgb = v.match(/\d+/g);
				return '#'+ hex(rgb[0]) + hex(rgb[1]) + hex(rgb[2]);
			}
			if (v && v != 'transparent')
				return v;
		}
		return '#ffffff';
	};
	$slides.each(function() { $(this).css('background-color', getBg(this)); });
};

// reset common props before the next transition
$.fn.cycle.commonReset = function(curr,next,opts,w,h,rev) {
	$(opts.elements).not(curr).hide();
	opts.cssBefore.opacity = 1;
	opts.cssBefore.display = 'block';
	if (w !== false && next.cycleW > 0)
		opts.cssBefore.width = next.cycleW;
	if (h !== false && next.cycleH > 0)
		opts.cssBefore.height = next.cycleH;
	opts.cssAfter = opts.cssAfter || {};
	opts.cssAfter.display = 'none';
	$(curr).css('zIndex',opts.slideCount + (rev === true ? 1 : 0));
	$(next).css('zIndex',opts.slideCount + (rev === true ? 0 : 1));
};

// the actual fn for effecting a transition
$.fn.cycle.custom = function(curr, next, opts, cb, speedOverride) {
	var $l = $(curr), $n = $(next);
	var speedIn = opts.speedIn, speedOut = opts.speedOut, easeIn = opts.easeIn, easeOut = opts.easeOut;
	$n.css(opts.cssBefore);
	if (speedOverride) {
		if (typeof speedOverride == 'number')
			speedIn = speedOut = speedOverride;
		else
			speedIn = speedOut = 1;
		easeIn = easeOut = null;
	}
	var fn = function() {$n.animate(opts.animIn, speedIn, easeIn, cb)};
	$l.animate(opts.animOut, speedOut, easeOut, function() {
		if (opts.cssAfter) $l.css(opts.cssAfter);
		if (!opts.sync) fn();
	});
	if (opts.sync) fn();
};

// transition definitions - only fade is defined here, transition pack defines the rest
$.fn.cycle.transitions = {
	fade: function($cont, $slides, opts) {
		$slides.not(':eq('+opts.currSlide+')').css('opacity',0);
		opts.before.push(function(curr,next,opts) {
			$.fn.cycle.commonReset(curr,next,opts);
			opts.cssBefore.opacity = 0;
		});
		opts.animIn	   = { opacity: 1 };
		opts.animOut   = { opacity: 0 };
		opts.cssBefore = { top: 0, left: 0 };
	}
};

$.fn.cycle.ver = function() { return ver; };

// override these globally if you like (they are all optional)
$.fn.cycle.defaults = {
	fx:			  'fade', // name of transition effect (or comma separated names, ex: fade,scrollUp,shuffle)
	timeout:	   4000,  // milliseconds between slide transitions (0 to disable auto advance)
	timeoutFn:	 null,  // callback for determining per-slide timeout value:  function(currSlideElement, nextSlideElement, options, forwardFlag)
	continuous:	   0,	  // true to start next transition immediately after current one completes
	speed:		   1000,  // speed of the transition (any valid fx speed value)
	speedIn:	   null,  // speed of the 'in' transition
	speedOut:	   null,  // speed of the 'out' transition
	next:		   null,  // selector for element to use as click trigger for next slide
	prev:		   null,  // selector for element to use as click trigger for previous slide
	prevNextClick: null,  // callback fn for prev/next clicks:	function(isNext, zeroBasedSlideIndex, slideElement)
	prevNextEvent:'click',// event which drives the manual transition to the previous or next slide
	pager:		   null,  // selector for element to use as pager container
	pagerClick:	   null,  // callback fn for pager clicks:	function(zeroBasedSlideIndex, slideElement)
	pagerEvent:	  'click', // name of event which drives the pager navigation
	pagerAnchorBuilder: null, // callback fn for building anchor links:  function(index, DOMelement)
	before:		   null,  // transition callback (scope set to element to be shown):	 function(currSlideElement, nextSlideElement, options, forwardFlag)
	after:		   null,  // transition callback (scope set to element that was shown):  function(currSlideElement, nextSlideElement, options, forwardFlag)
	end:		   null,  // callback invoked when the slideshow terminates (use with autostop or nowrap options): function(options)
	easing:		   null,  // easing method for both in and out transitions
	easeIn:		   null,  // easing for "in" transition
	easeOut:	   null,  // easing for "out" transition
	shuffle:	   null,  // coords for shuffle animation, ex: { top:15, left: 200 }
	animIn:		   null,  // properties that define how the slide animates in
	animOut:	   null,  // properties that define how the slide animates out
	cssBefore:	   null,  // properties that define the initial state of the slide before transitioning in
	cssAfter:	   null,  // properties that defined the state of the slide after transitioning out
	fxFn:		   null,  // function used to control the transition: function(currSlideElement, nextSlideElement, options, afterCalback, forwardFlag)
	height:		  'auto', // container height
	startingSlide: 0,	  // zero-based index of the first slide to be displayed
	sync:		   1,	  // true if in/out transitions should occur simultaneously
	random:		   0,	  // true for random, false for sequence (not applicable to shuffle fx)
	fit:		   0,	  // force slides to fit container
	containerResize: 1,	  // resize container to fit largest slide
	pause:		   0,	  // true to enable "pause on hover"
	pauseOnPagerHover: 0, // true to pause when hovering over pager link
	autostop:	   0,	  // true to end slideshow after X transitions (where X == slide count)
	autostopCount: 0,	  // number of transitions (optionally used with autostop to define X)
	delay:		   0,	  // additional delay (in ms) for first transition (hint: can be negative)
	slideExpr:	   null,  // expression for selecting slides (if something other than all children is required)
	cleartype:	   !$.support.opacity,  // true if clearType corrections should be applied (for IE)
	cleartypeNoBg: false, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides)
	nowrap:		   0,	  // true to prevent slideshow from wrapping
	fastOnEvent:   0,	  // force fast transitions when triggered manually (via pager or prev/next); value == time in ms
	randomizeEffects: 1,  // valid when multiple effects are used; true to make the effect sequence random
	rev:		   0,	 // causes animations to transition in reverse
	manualTrump:   true,  // causes manual transition to stop an active transition instead of being ignored
	requeueOnImageNotLoaded: true, // requeue the slideshow if any image slides are not yet loaded
	requeueTimeout: 250   // ms delay for requeue
};

})(jQuery);


/*!
 * jQuery Cycle Plugin Transition Definitions
 * This script is a plugin for the jQuery Cycle Plugin
 * Examples and documentation at: http://malsup.com/jquery/cycle/
 * Copyright (c) 2007-2008 M. Alsup
 * Version:	 2.72
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 */
(function($) {

//
// These functions define one-time slide initialization for the named
// transitions. To save file size feel free to remove any of these that you
// don't need.
//
$.fn.cycle.transitions.none = function($cont, $slides, opts) {
	opts.fxFn = function(curr,next,opts,after){
		$(next).show();
		$(curr).hide();
		after();
	};
}

// scrollUp/Down/Left/Right
$.fn.cycle.transitions.scrollUp = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var h = $cont.height();
	opts.cssBefore ={ top: h, left: 0 };
	opts.cssFirst = { top: 0 };
	opts.animIn	  = { top: 0 };
	opts.animOut  = { top: -h };
};
$.fn.cycle.transitions.scrollDown = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var h = $cont.height();
	opts.cssFirst = { top: 0 };
	opts.cssBefore= { top: -h, left: 0 };
	opts.animIn	  = { top: 0 };
	opts.animOut  = { top: h };
};
$.fn.cycle.transitions.scrollLeft = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var w = $cont.width();
	opts.cssFirst = { left: 0 };
	opts.cssBefore= { left: w, top: 0 };
	opts.animIn	  = { left: 0 };
	opts.animOut  = { left: 0-w };
};
$.fn.cycle.transitions.scrollRight = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var w = $cont.width();
	opts.cssFirst = { left: 0 };
	opts.cssBefore= { left: -w, top: 0 };
	opts.animIn	  = { left: 0 };
	opts.animOut  = { left: w };
};
$.fn.cycle.transitions.scrollHorz = function($cont, $slides, opts) {
	$cont.css('overflow','hidden').width();
	opts.before.push(function(curr, next, opts, fwd) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.cssBefore.left = fwd ? (next.cycleW-1) : (1-next.cycleW);
		opts.animOut.left = fwd ? -curr.cycleW : curr.cycleW;
	});
	opts.cssFirst = { left: 0 };
	opts.cssBefore= { top: 0 };
	opts.animIn   = { left: 0 };
	opts.animOut  = { top: 0 };
};
$.fn.cycle.transitions.scrollVert = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push(function(curr, next, opts, fwd) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.cssBefore.top = fwd ? (1-next.cycleH) : (next.cycleH-1);
		opts.animOut.top = fwd ? curr.cycleH : -curr.cycleH;
	});
	opts.cssFirst = { top: 0 };
	opts.cssBefore= { left: 0 };
	opts.animIn   = { top: 0 };
	opts.animOut  = { left: 0 };
};

// slideX/slideY
$.fn.cycle.transitions.slideX = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$(opts.elements).not(curr).hide();
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.animIn.width = next.cycleW;
	});
	opts.cssBefore = { left: 0, top: 0, width: 0 };
	opts.animIn	 = { width: 'show' };
	opts.animOut = { width: 0 };
};
$.fn.cycle.transitions.slideY = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$(opts.elements).not(curr).hide();
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.animIn.height = next.cycleH;
	});
	opts.cssBefore = { left: 0, top: 0, height: 0 };
	opts.animIn	 = { height: 'show' };
	opts.animOut = { height: 0 };
};

// shuffle
$.fn.cycle.transitions.shuffle = function($cont, $slides, opts) {
	var i, w = $cont.css('overflow', 'visible').width();
	$slides.css({left: 0, top: 0});
	opts.before.push(function(curr,next,opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,true,true);
	});
	// only adjust speed once!
	if (!opts.speedAdjusted) {
		opts.speed = opts.speed / 2; // shuffle has 2 transitions
		opts.speedAdjusted = true;
	}
	opts.random = 0;
	opts.shuffle = opts.shuffle || {left:-w, top:15};
	opts.els = [];
	for (i=0; i < $slides.length; i++)
		opts.els.push($slides[i]);

	for (i=0; i < opts.currSlide; i++)
		opts.els.push(opts.els.shift());

	// custom transition fn (hat tip to Benjamin Sterling for this bit of sweetness!)
	opts.fxFn = function(curr, next, opts, cb, fwd) {
		var $el = fwd ? $(curr) : $(next);
		$(next).css(opts.cssBefore);
		var count = opts.slideCount;
		$el.animate(opts.shuffle, opts.speedIn, opts.easeIn, function() {
			var hops = $.fn.cycle.hopsFromLast(opts, fwd);
			for (var k=0; k < hops; k++)
				fwd ? opts.els.push(opts.els.shift()) : opts.els.unshift(opts.els.pop());
			if (fwd) {
				for (var i=0, len=opts.els.length; i < len; i++)
					$(opts.els[i]).css('z-index', len-i+count);
			}
			else {
				var z = $(curr).css('z-index');
				$el.css('z-index', parseInt(z)+1+count);
			}
			$el.animate({left:0, top:0}, opts.speedOut, opts.easeOut, function() {
				$(fwd ? this : curr).hide();
				if (cb) cb();
			});
		});
	};
	opts.cssBefore = { display: 'block', opacity: 1, top: 0, left: 0 };
};

// turnUp/Down/Left/Right
$.fn.cycle.transitions.turnUp = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.cssBefore.top = next.cycleH;
		opts.animIn.height = next.cycleH;
	});
	opts.cssFirst  = { top: 0 };
	opts.cssBefore = { left: 0, height: 0 };
	opts.animIn	   = { top: 0 };
	opts.animOut   = { height: 0 };
};
$.fn.cycle.transitions.turnDown = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.animIn.height = next.cycleH;
		opts.animOut.top   = curr.cycleH;
	});
	opts.cssFirst  = { top: 0 };
	opts.cssBefore = { left: 0, top: 0, height: 0 };
	opts.animOut   = { height: 0 };
};
$.fn.cycle.transitions.turnLeft = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.cssBefore.left = next.cycleW;
		opts.animIn.width = next.cycleW;
	});
	opts.cssBefore = { top: 0, width: 0  };
	opts.animIn	   = { left: 0 };
	opts.animOut   = { width: 0 };
};
$.fn.cycle.transitions.turnRight = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.animIn.width = next.cycleW;
		opts.animOut.left = curr.cycleW;
	});
	opts.cssBefore = { top: 0, left: 0, width: 0 };
	opts.animIn	   = { left: 0 };
	opts.animOut   = { width: 0 };
};

// zoom
$.fn.cycle.transitions.zoom = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,false,true);
		opts.cssBefore.top = next.cycleH/2;
		opts.cssBefore.left = next.cycleW/2;
		opts.animIn	   = { top: 0, left: 0, width: next.cycleW, height: next.cycleH };
		opts.animOut   = { width: 0, height: 0, top: curr.cycleH/2, left: curr.cycleW/2 };
	});
	opts.cssFirst = { top:0, left: 0 };
	opts.cssBefore = { width: 0, height: 0 };
};

// fadeZoom
$.fn.cycle.transitions.fadeZoom = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,false);
		opts.cssBefore.left = next.cycleW/2;
		opts.cssBefore.top = next.cycleH/2;
		opts.animIn	= { top: 0, left: 0, width: next.cycleW, height: next.cycleH };
	});
	opts.cssBefore = { width: 0, height: 0 };
	opts.animOut  = { opacity: 0 };
};

// blindX
$.fn.cycle.transitions.blindX = function($cont, $slides, opts) {
	var w = $cont.css('overflow','hidden').width();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.animIn.width = next.cycleW;
		opts.animOut.left   = curr.cycleW;
	});
	opts.cssBefore = { left: w, top: 0 };
	opts.animIn = { left: 0 };
	opts.animOut  = { left: w };
};
// blindY
$.fn.cycle.transitions.blindY = function($cont, $slides, opts) {
	var h = $cont.css('overflow','hidden').height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.animIn.height = next.cycleH;
		opts.animOut.top   = curr.cycleH;
	});
	opts.cssBefore = { top: h, left: 0 };
	opts.animIn = { top: 0 };
	opts.animOut  = { top: h };
};
// blindZ
$.fn.cycle.transitions.blindZ = function($cont, $slides, opts) {
	var h = $cont.css('overflow','hidden').height();
	var w = $cont.width();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.animIn.height = next.cycleH;
		opts.animOut.top   = curr.cycleH;
	});
	opts.cssBefore = { top: h, left: w };
	opts.animIn = { top: 0, left: 0 };
	opts.animOut  = { top: h, left: w };
};

// growX - grow horizontally from centered 0 width
$.fn.cycle.transitions.growX = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.cssBefore.left = this.cycleW/2;
		opts.animIn = { left: 0, width: this.cycleW };
		opts.animOut = { left: 0 };
	});
	opts.cssBefore = { width: 0, top: 0 };
};
// growY - grow vertically from centered 0 height
$.fn.cycle.transitions.growY = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.cssBefore.top = this.cycleH/2;
		opts.animIn = { top: 0, height: this.cycleH };
		opts.animOut = { top: 0 };
	});
	opts.cssBefore = { height: 0, left: 0 };
};

// curtainX - squeeze in both edges horizontally
$.fn.cycle.transitions.curtainX = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true,true);
		opts.cssBefore.left = next.cycleW/2;
		opts.animIn = { left: 0, width: this.cycleW };
		opts.animOut = { left: curr.cycleW/2, width: 0 };
	});
	opts.cssBefore = { top: 0, width: 0 };
};
// curtainY - squeeze in both edges vertically
$.fn.cycle.transitions.curtainY = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false,true);
		opts.cssBefore.top = next.cycleH/2;
		opts.animIn = { top: 0, height: next.cycleH };
		opts.animOut = { top: curr.cycleH/2, height: 0 };
	});
	opts.cssBefore = { left: 0, height: 0 };
};

// cover - curr slide covered by next slide
$.fn.cycle.transitions.cover = function($cont, $slides, opts) {
	var d = opts.direction || 'left';
	var w = $cont.css('overflow','hidden').width();
	var h = $cont.height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		if (d == 'right')
			opts.cssBefore.left = -w;
		else if (d == 'up')
			opts.cssBefore.top = h;
		else if (d == 'down')
			opts.cssBefore.top = -h;
		else
			opts.cssBefore.left = w;
	});
	opts.animIn = { left: 0, top: 0};
	opts.animOut = { opacity: 1 };
	opts.cssBefore = { top: 0, left: 0 };
};

// uncover - curr slide moves off next slide
$.fn.cycle.transitions.uncover = function($cont, $slides, opts) {
	var d = opts.direction || 'left';
	var w = $cont.css('overflow','hidden').width();
	var h = $cont.height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,true,true);
		if (d == 'right')
			opts.animOut.left = w;
		else if (d == 'up')
			opts.animOut.top = -h;
		else if (d == 'down')
			opts.animOut.top = h;
		else
			opts.animOut.left = -w;
	});
	opts.animIn = { left: 0, top: 0 };
	opts.animOut = { opacity: 1 };
	opts.cssBefore = { top: 0, left: 0 };
};

// toss - move top slide and fade away
$.fn.cycle.transitions.toss = function($cont, $slides, opts) {
	var w = $cont.css('overflow','visible').width();
	var h = $cont.height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,true,true);
		// provide default toss settings if animOut not provided
		if (!opts.animOut.left && !opts.animOut.top)
			opts.animOut = { left: w*2, top: -h/2, opacity: 0 };
		else
			opts.animOut.opacity = 0;
	});
	opts.cssBefore = { left: 0, top: 0 };
	opts.animIn = { left: 0 };
};

// wipe - clip animation
$.fn.cycle.transitions.wipe = function($cont, $slides, opts) {
	var w = $cont.css('overflow','hidden').width();
	var h = $cont.height();
	opts.cssBefore = opts.cssBefore || {};
	var clip;
	if (opts.clip) {
		if (/l2r/.test(opts.clip))
			clip = 'rect(0px 0px '+h+'px 0px)';
		else if (/r2l/.test(opts.clip))
			clip = 'rect(0px '+w+'px '+h+'px '+w+'px)';
		else if (/t2b/.test(opts.clip))
			clip = 'rect(0px '+w+'px 0px 0px)';
		else if (/b2t/.test(opts.clip))
			clip = 'rect('+h+'px '+w+'px '+h+'px 0px)';
		else if (/zoom/.test(opts.clip)) {
			var top = parseInt(h/2);
			var left = parseInt(w/2);
			clip = 'rect('+top+'px '+left+'px '+top+'px '+left+'px)';
		}
	}

	opts.cssBefore.clip = opts.cssBefore.clip || clip || 'rect(0px 0px 0px 0px)';

	var d = opts.cssBefore.clip.match(/(\d+)/g);
	var t = parseInt(d[0]), r = parseInt(d[1]), b = parseInt(d[2]), l = parseInt(d[3]);

	opts.before.push(function(curr, next, opts) {
		if (curr == next) return;
		var $curr = $(curr), $next = $(next);
		$.fn.cycle.commonReset(curr,next,opts,true,true,false);
		opts.cssAfter.display = 'block';

		var step = 1, count = parseInt((opts.speedIn / 13)) - 1;
		(function f() {
			var tt = t ? t - parseInt(step * (t/count)) : 0;
			var ll = l ? l - parseInt(step * (l/count)) : 0;
			var bb = b < h ? b + parseInt(step * ((h-b)/count || 1)) : h;
			var rr = r < w ? r + parseInt(step * ((w-r)/count || 1)) : w;
			$next.css({ clip: 'rect('+tt+'px '+rr+'px '+bb+'px '+ll+'px)' });
			(step++ <= count) ? setTimeout(f, 13) : $curr.css('display', 'none');
		})();
	});
	opts.cssBefore = { display: 'block', opacity: 1, top: 0, left: 0 };
	opts.animIn	   = { left: 0 };
	opts.animOut   = { left: 0 };
};

})(jQuery);

/*!
 * jQuery Cookie Plugin v1.4.0
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Register as anonymous module.
		define(['jquery'], factory);
	} else {
		// Browser globals.
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {

		// Write
		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));

/*
 * jQuery Tooltip plugin 1.3
 *
 * http://bassistance.de/jquery-plugins/jquery-plugin-tooltip/
 * http://docs.jquery.com/Plugins/Tooltip
 *
 * Copyright (c) 2006 - 2008 JÃ¶rn Zaefferer
 *
 * 4e970ce0f8baae61d24dd49b02b8d4c019be046e, v2 (xcart_4_6_0), 2013-02-21 17:55:05, jquery.tooltip.js, random
 * 
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
 
;(function($) {
	
		// the tooltip element
	var helper = {},
		// the current tooltipped element
		current,
		// the title of the current element, used for restoring
		title,
		// timeout id for delayed tooltips
		tID,
		// IE 5.5 or 6
		IE = $.browser.msie && /MSIE\s(5\.5|6\.)/.test(navigator.userAgent),
		// flag for mouse tracking
		track = false;
	
	$.tooltip = {
		blocked: false,
		defaults: {
			delay: 200,
			fade: false,
			showURL: true,
			extraClass: "",
			top: 15,
			left: 15,
			id: "tooltip"
		},
		block: function() {
			$.tooltip.blocked = !$.tooltip.blocked;
		}
	};
	
	$.fn.extend({
		tooltip: function(settings) {
			settings = $.extend({}, $.tooltip.defaults, settings);
			createHelper(settings);
			return this.each(function() {
					$.data(this, "tooltip", settings);
					this.tOpacity = helper.parent.css("opacity");
					// copy tooltip into its own expando and remove the title
					this.tooltipText = this.title;
					$(this).removeAttr("title");
					// also remove alt attribute to prevent default tooltip in IE
					this.alt = "";
				})
				.mouseover(save)
				.mouseout(hide)
				.click(hide);
		},
		hideWhenEmpty: function() {
			return this.each(function() {
				$(this)[ $(this).html() ? "show" : "hide" ]();
			});
		},
		url: function() {
			return this.attr('href') || this.attr('src');
		}
	});
	
	function createHelper(settings) {
		// there can be only one tooltip helper
		if( helper.parent )
			return;
		// create the helper, h3 for title, div for url
		helper.parent = $('<div id="' + settings.id + '"><h3></h3><div class="body"></div><div class="url"></div></div>')
			// add to document
			.appendTo(document.body)
			// hide it at first
			.hide();
			
		// apply bgiframe if available
		if ( $.fn.bgiframe )
			helper.parent.bgiframe();
		
		// save references to title and url elements
		helper.title = $('h3', helper.parent);
		helper.body = $('div.body', helper.parent);
		helper.url = $('div.url', helper.parent);
	}
	
	function settings(element) {
		return $.data(element, "tooltip");
	}
	
	// main event handler to start showing tooltips
	function handle(event) {
		// show helper, either with timeout or on instant
		if( settings(this).delay )
			tID = setTimeout(show, settings(this).delay);
		else
			show();
		
		// if selected, update the helper position when the mouse moves
		track = !!settings(this).track;
		$(document.body).bind('mousemove', update);
			
		// update at least once
		update(event);
	}
	
	// save elements title before the tooltip is displayed
	function save() {
		// if this is the current source, or it has no title (occurs with click event), stop
		if ( $.tooltip.blocked || this == current || (!this.tooltipText && !settings(this).bodyHandler) )
			return;

		// save current
		current = this;
		title = this.tooltipText;
		
		if ( settings(this).bodyHandler ) {
			helper.title.hide();
			var bodyContent = settings(this).bodyHandler.call(this);
			if (bodyContent.nodeType || bodyContent.jquery) {
				helper.body.empty().append(bodyContent)
			} else {
				helper.body.html( bodyContent );
			}
			helper.body.show();
		} else if ( settings(this).showBody ) {
			var parts = title.split(settings(this).showBody);
			helper.title.html(parts.shift()).show();
			helper.body.empty();
			for(var i = 0, part; (part = parts[i]); i++) {
				if(i > 0)
					helper.body.append("<br/>");
				helper.body.append(part);
			}
			helper.body.hideWhenEmpty();
		} else {
			helper.title.html(title).show();
			helper.body.hide();
		}
		
		// if element has href or src, add and show it, otherwise hide it
		if( settings(this).showURL && $(this).url() )
			helper.url.html( $(this).url().replace('http://', '') ).show();
		else 
			helper.url.hide();
		
		// add an optional class for this tip
		helper.parent.addClass(settings(this).extraClass);

		handle.apply(this, arguments);
	}
	
	// delete timeout and show helper
	function show() {
		tID = null;
		if ((!IE || !$.fn.bgiframe) && settings(current).fade) {
			if (helper.parent.is(":animated"))
				helper.parent.stop().show().fadeTo(settings(current).fade, current.tOpacity);
			else
				helper.parent.is(':visible') ? helper.parent.fadeTo(settings(current).fade, current.tOpacity) : helper.parent.fadeIn(settings(current).fade);
		} else {
			helper.parent.show();
		}
		update();
	}
	
	/**
	 * callback for mousemove
	 * updates the helper position
	 * removes itself when no current element
	 */
	function update(event)	{
		if($.tooltip.blocked)
			return;
		
		if (event && event.target.tagName == "OPTION") {
			return;
		}
		
		// stop updating when tracking is disabled and the tooltip is visible
		if ( !track && helper.parent.is(":visible")) {
			$(document.body).unbind('mousemove', update)
		}
		
		// if no current element is available, remove this listener
		if( current == null ) {
			$(document.body).unbind('mousemove', update);
			return;	
		}
		
		// remove position helper classes
		helper.parent.removeClass("viewport-right").removeClass("viewport-bottom");
		
		var left = helper.parent[0].offsetLeft;
		var top = helper.parent[0].offsetTop;
		if (event) {
			// position the helper 15 pixel to bottom right, starting from mouse position
			left = event.pageX + settings(current).left;
			top = event.pageY + settings(current).top;
			var right='auto';
			if (settings(current).positionLeft) {
				right = $(window).width() - left;
				left = 'auto';
			}
			helper.parent.css({
				left: left,
				right: right,
				top: top
			});
		}
		
		var v = viewport(),
			h = helper.parent[0];
		// check horizontal position
		if (v.x + v.cx < h.offsetLeft + h.offsetWidth) {
			left -= h.offsetWidth + 20 + settings(current).left;
			helper.parent.css({left: left + 'px'}).addClass("viewport-right");
		}
		// check vertical position
		if (v.y + v.cy < h.offsetTop + h.offsetHeight) {
			top -= h.offsetHeight + 20 + settings(current).top;
			helper.parent.css({top: top + 'px'}).addClass("viewport-bottom");
		}
	}
	
	function viewport() {
		return {
			x: $(window).scrollLeft(),
			y: $(window).scrollTop(),
			cx: $(window).width(),
			cy: $(window).height()
		};
	}
	
	// hide helper and restore added classes and the title
	function hide(event) {
		if($.tooltip.blocked)
			return;
		// clear timeout if possible
		if(tID)
			clearTimeout(tID);
		// no more current element
		current = null;
		
		var tsettings = settings(this);
		function complete() {
			helper.parent.removeClass( tsettings.extraClass ).hide().css("opacity", "");
		}
		if ((!IE || !$.fn.bgiframe) && tsettings.fade) {
			if (helper.parent.is(':animated'))
				helper.parent.stop().fadeTo(tsettings.fade, 0, complete);
			else
				helper.parent.stop().fadeOut(tsettings.fade, complete);
		} else
			complete();
		
	}
	
})(jQuery);

/* vim: set ts=2 sw=2 sts=2 et: */
/**
 * Ajax product notification widget
 * 
 * @category   X-Cart
 * @package    Modules
 * @subpackage Product Notification
 * @author     Ruslan R. Fazlyev <rrf@x-cart.com> 
 * @version    572af17946fc92f59611bb3a27492ea64d78fd2c, v3 (xcart_4_5_5), 2012-12-20 15:15:39, product_notification_widget.js, random
 * @link       http://www.x-cart.com/
 * @see        ____file_see____
 */

// Widget :: factory
ProductNotificationWidget = function(productid, variantid, type) {
  // Check if jQuery is used
  if (typeof(window.jQuery) == 'undefined') {
    return false;
  }

  // Check if widget constants defined
  if (typeof(window.ProductNotificationWidget_CONST) == 'undefined') {
    return false;
  }

  // Check parameters
  if (!type || !productid) {
    return false;
  }

  if (
    typeof(variantid) == 'undefined'
    || variantid <= 0
  ) {
    variantid = 0;
  }
  
  // Get HTML widget root element
  var rootElement = $('#' + ProductNotificationWidget_CONST.ROOT_ELEMENT_ID_PREFIX + productid + '_' + type).get(0);
  if (!rootElement) {
    return false;
  }

  // Create an widget object
  if (!rootElement.productNotificationWidget) {
    rootElement.productNotificationWidget = new ProductNotificationWidget.obj(rootElement, productid, variantid, type);
  }

  return rootElement.productNotificationWidget;
}

// Widget :: object
ProductNotificationWidget.obj = function(rootElement, productid, variantid, type) {
  this.rootElement = $(rootElement);
  this.productid = productid;
  this.variantid = variantid;
  this.type = type;

  this.init();
}

/*
 * Properties 
 */
ProductNotificationWidget.obj.prototype.rootElement = false;
ProductNotificationWidget.obj.prototype.type = false;
ProductNotificationWidget.obj.prototype.productid = 0;
ProductNotificationWidget.obj.prototype.variantid = 0;
ProductNotificationWidget.obj.prototype.inStock = 0;
ProductNotificationWidget.obj.prototype.minAmount = 0;
ProductNotificationWidget.obj.prototype.submitButton = false;
ProductNotificationWidget.obj.prototype.requestButton = false;
ProductNotificationWidget.obj.prototype.emailInput = false;
ProductNotificationWidget.obj.prototype.isEmailInputReset = false;
ProductNotificationWidget.obj.prototype.isEmailInputContentChanged = false;

/*
 * Methods
 */

// Initialize widget
ProductNotificationWidget.obj.prototype.init = function() {
  // Define form elements
  this.submitButton = this.rootElement.find('#' + ProductNotificationWidget_CONST.SUBMIT_BUTTON_ELEMENT_ID_PREFIX + this.productid + '_' + this.type);
  this.submitWaiting = this.rootElement.find('#' + ProductNotificationWidget_CONST.SUBMIT_WAITING_ELEMENT_ID_PREFIX + this.productid + '_' + this.type);
  this.emailInput = this.rootElement.find('#' + ProductNotificationWidget_CONST.EMAIL_INPUT_ELEMENT_ID_PREFIX + this.productid + '_' + this.type);
  this.requestButton = $('#' + ProductNotificationWidget_CONST.REQUEST_BUTTON_ELEMENT_ID_PREFIX + this.productid + '_' + this.type);
  this.messageBlock = this.rootElement.find('#' + ProductNotificationWidget_CONST.MESSAGE_ELEMENT_ID_PREFIX + this.productid + '_' + this.type);


  // Define email input initial state
  if (this.emailInput.val() != ProductNotificationWidget_CONST.LBL_PROD_NOTIF_EMAIL_DEFAULT) {
    // Email value is pre-filled
    this.isEmailInputReset = true;
  }
  
  // Bind event handlers
  var s = this;
 
  this.requestButton.click(
    function(data) {
      return s.toggleBody();
    }
  );

  if (typeof(this.requestButton.tooltip) == 'function' && !$.browser.msie) {
    this.requestButton.tooltip(
      {
        id: 'prod_notif_tooltip',
        extraClass: 'prod-notif-tooltip-' + this.type,
        track: false,
        delay: 0,
        showURL: false,
        fade: 200
      }
    );
  }

  this.submitButton.click(
    function(data) {
      return s.submitButton_click();
    }
  );

  this.emailInput.keydown(
    function(event){
        if(event.keyCode == 13){
          event.preventDefault();
          return s.submitButton_click();
        }
    }
  );

  this.emailInput.focus(
    function(data) {
      return s.emailInput_focus();
    }
  );
  
  this.emailInput.change(
    function(data) {
      return s.emailInput_change();
    }
  );
  
  this.emailInput.blur(
    function(data) {
      return s.emailInput_blur();
    }
  );
}

// Refresh widget depending on product/variant data
ProductNotificationWidget.obj.prototype.refresh = function(data) {
  // TODO: object inheritance
  if (typeof(data.inStock) != 'undefined' && data.inStock >= 0) {
    this.inStock = data.inStock;
  }
  if (typeof(data.minAmount) != 'undefined' && data.minAmount >= 0) {
    this.minAmount = data.minAmount;
  }
  
  if ('B' == this.type) {
    if (this.inStock <= 0 || this.inStock < this.minAmount) {
      // Product/variant is out of stock
      this.show();

    } else {
      this.hide();
    }
  }

  if ('L' == this.type) {
    if (this.inStock > ProductNotificationWidget_CONST.PROD_NOTIF_L_AMOUNT) {
      this.show();

    } else {
      this.hide();
    }
  }

}

// Hide widget
ProductNotificationWidget.obj.prototype.hide = function() {
  this.requestButton.hide();
  this.hideBody();
}

// Show widget
ProductNotificationWidget.obj.prototype.show = function() {
  this.hideBody();
  this.clearMessages();
  this.requestButton.show();
}

// Find selected variant
ProductNotificationWidget.obj.prototype.detectProductVariant = function() {
  if (
    typeof variants != 'undefined' 
    && variants
    && typeof getPOValue == 'function'
  ) {
    for (var x in variants) {
      if (!hasOwnProperty(variants, x) || variants[x][1].length == 0) {
        continue;
      }
      variantid = x;
      for (var c in variants[x][1]) {
        if (!hasOwnProperty(variants[x][1], c)) {
          continue;
        }

        if (getPOValue(c) != variants[x][1][c]) {
          variantid = false;
          break;
        }
      }

      if (variantid) {
        this.variantid = variantid;
        break;
      }
    }
  }
}

// Validate e-mail address
ProductNotificationWidget.obj.prototype.checkEmail = function() {
  var email = this.emailInput.val();

  if (!email || 0 == email.length) {
    return false;
  }
  if (email.replace(/^\s+/g, '').replace(/\s+$/g, '').search(ProductNotificationWidget_CONST.PROD_NOTIF_EMAIL_REGEXP) == -1) {
    return false;
  }

  return true;
}

// Show message to customer 
ProductNotificationWidget.obj.prototype.showMessage = function(text, isError) {
  this.messageBlock.html('');
  if (isError) {
    this.messageBlock.addClass(ProductNotificationWidget_CONST.ERROR_MSG_CSS);

  } else {
    this.messageBlock.removeClass(ProductNotificationWidget_CONST.ERROR_MSG_CSS);
  }
  this.messageBlock.html(text);
}

// Clear all messages and error alerts
ProductNotificationWidget.obj.prototype.clearMessages = function() {
  this.emailInput.removeClass(ProductNotificationWidget_CONST.INVALID_EMAIL_CSS);
  this.messageBlock.html('');
}

// Show/hide product notification request form
ProductNotificationWidget.obj.prototype.toggleBody = function() {
  if (this.isBodyVisible) {
    this.hideBody();

  } else {
    this.showBody();
  }
}

// Show product notification request form
ProductNotificationWidget.obj.prototype.showBody = function() {
  this.rootElement.slideDown(ProductNotificationWidget_CONST.REQUEST_FORM_SLIDE_DELAY);
  this.isBodyVisible = true;
}

// Hide product notification request form
ProductNotificationWidget.obj.prototype.hideBody = function() {
  this.rootElement.slideUp('fast');
  this.clearMessages();
  this.isBodyVisible = false;
}

// Send a subscription data to the server by AJAX
ProductNotificationWidget.obj.prototype.submit = function() {
  this.startWaiting();

  // AJAX request
  var s = this;
  $.getJSON(
    ProductNotificationWidget_CONST.PROD_NOTIF_SUBMIT_PHP,
    {
      "mode": ProductNotificationWidget_CONST.PROD_NOTIF_SUBMIT_MODE,
      "productid": this.productid,
      "variantid": this.variantid,
      "type": this.type,
      "email": this.email
    },
    function(response) {
      s.submitCallback(response);
      s.stopWaiting();
    }
  );
}

// Submit callback function
ProductNotificationWidget.obj.prototype.submitCallback = function(response) {
  var isError = false;
  var message = ProductNotificationWidget_CONST.ERR_SUBMIT_PROD_NOTIF_UNKNOWN;
  if (!response) {
    isError = true;

  } else {
    if (typeof response.status != 'undefined') {
      if (0 == response.status) {
        // OK
        message = ProductNotificationWidget_CONST.MSG_SUBMIT_PROD_NOTIF_OK;
      } else if (1 == response.status) {
        // already subscribed
        message = ProductNotificationWidget_CONST.MSG_PROD_NOTIF_ALREADY_SUBSCRIBED;
      } else if (typeof response.message != 'undefined' && response.message.length > 0) {
        // Get error message
        isError = true;
        message = response.message;
      }
    }
  }

  this.showMessage(message, isError);

  return true;
}

// Show waiting image
ProductNotificationWidget.obj.prototype.startWaiting = function() {
  this.emailInput.attr('disabled', 'disabled');
  this.submitButton.hide();
  this.submitWaiting.show();
}

// Show waiting image
ProductNotificationWidget.obj.prototype.stopWaiting = function() {
  this.emailInput.removeAttr('disabled');
  this.submitWaiting.hide();
  this.submitButton.show();
}

// Focus changing event handler for the 'email' input
ProductNotificationWidget.obj.prototype.emailInput_focus = function() {
  this.clearMessages();
  if (!this.isEmailInputReset) {
    this.emailInput.val('');
    this.emailInput.removeClass(ProductNotificationWidget_CONST.DEFAULT_EMAIL_CSS);
    this.isEmailInputReset = true;
  }
  return true;
}

// Text changing event handler for the 'email' input
ProductNotificationWidget.obj.prototype.emailInput_change = function() {
  this.isEmailInputContentChanged = true;
  return true;
}

// 'Blur' event handler for the 'email' input
ProductNotificationWidget.obj.prototype.emailInput_blur = function() {
  if (
    !this.isEmailInputReset
    && !this.isEmailInputContentChanged
  ) {
    this.emailInput.val(ProductNotificationWidget_CONST.LBL_PROD_NOTIF_EMAIL_DEFAULT);
    this.emailInput.addClass(ProductNotificationWidget_CONST.DEFAULT_EMAIL_CSS);
    this.isEmailInputReset = false;
  }
  return true;
}

// Click event handler for submit button
ProductNotificationWidget.obj.prototype.submitButton_click = function() {
  this.clearMessages();

  var err = false;

  // Check email
  if (!this.checkEmail()) {
    this.emailInput.addClass(ProductNotificationWidget_CONST.INVALID_EMAIL_CSS);
    this.showMessage(ProductNotificationWidget_CONST.ERR_PROD_NOTIF_EMAIL, true);
    err = true;
  }

  if (!err) {
    // Determine selected product variant
    this.detectProductVariant();
    this.email = this.emailInput.val();
    this.submit();
  }
  return false;
}

/*
 * Define array of all product notification widgets of the page
 */
ProductNotificationWidgets = [];

/* vim: set ts=2 sw=2 sts=2 et: */
/**
 * Functions for product options module
 * 
 * @category   X-Cart
 * @package    X-Cart
 * @subpackage JS Library
 * @author     Ruslan R. Fazlyev <rrf@x-cart.com> 
 * @version    b6757de99f585499ead8d40338853e1946d58572, v6 (xcart_4_6_0), 2013-02-25 12:31:04, func.js, random
 * @link       http://www.x-cart.com/
 * @see        ____file_see____
 */

var current_taxes = [];
var availObj = document.getElementById('product_avail');

if (typeof useSwitchImageBox === 'undefined') {
  useSwitchImageBox = false;
}
if (useSwitchImageBox) {
  var product_thumbnail = document.getElementById('variantThumbnail');
} else {
  var product_thumbnail = document.getElementById('product_thumbnail');
}

function switchImageBox(imageBoxType) {
  switch (imageBoxType) {
    case 'product':
      $('#productImageBox').show();
      $('#variantImageBox').hide();
      break;
    case 'variant':
      $('#variantImageBox').show();
      $('#productImageBox').hide();
      break;
  }
}

/**
 * Rebuild page if some options is changed
 */
function check_options() {
  var local_taxes = [];
  var is_rebuild_wholesale = false;
  var variantid = false;

  if (typeof(taxes) != 'undefined') {
    for (var t in taxes) {
      if (hasOwnProperty(taxes, t))
        local_taxes[t] = taxes[t][0];
    }
  }
  price = default_price;

  /* Find variant */
  for (var x in variants) {
    if (!hasOwnProperty(variants, x) || variants[x][1].length == 0)
      continue;

    variantid = x;
    for (var c in variants[x][1]) {
      if (!hasOwnProperty(variants[x][1], c))
        continue;

      if (getPOValue(c) != variants[x][1][c]) {
        variantid = false;
        break;
      }
    }

    if (variantid)
      break;
  }

  /* If variant found ... */
  if (variantid) {
    var max_avail = variants[variantid][0][1];
    price = variants[variantid][0][0];
    orig_price = variants[variantid][0][4];
    avail = variants[variantid][0][1];

    /* Get variant wholesale prices */
    if (variants[variantid][3]) {
      product_wholesale = [];
      for (var t in variants[variantid][3]) {
        if (!hasOwnProperty(variants[variantid][3], t))
          continue;

        var _tmp = modi_price(variants[variantid][3][t][2], cloneObject(variants[variantid][3][t][3]), variants[variantid][3][t][4]);
        product_wholesale[t] = [
          variants[variantid][3][t][0], 
          variants[variantid][3][t][1], 
          _tmp[0],
          []
        ];

        /* Get variant wholesale taxes */
        for (var c in _tmp[1]) {
          if (hasOwnProperty(_tmp[1], c))
            product_wholesale[t][3][c] = _tmp[1][c];
        }
      }
      is_rebuild_wholesale = true;
    }

    /* Get variant taxes */
    for (var t in local_taxes) {
      if (hasOwnProperty(local_taxes, t) && variants[variantid][2][t])
        local_taxes[t] = parseFloat(variants[variantid][2][t]);
    }

    if (!product_thumbnail) {
      if (useSwitchImageBox) {
        product_thumbnail = document.getElementById('variantThumbnail');
      } else {
        product_thumbnail = document.getElementById('product_thumbnail');
      }
    }

    /* Change product thumbnail */
    if (product_thumbnail) {
      if (variants[variantid][0][2].src && variants[variantid][0][2]._x > 0 && variants[variantid][0][2]._y > 0) {
        if (getImgSrc(product_thumbnail) != variants[variantid][0][2].src) {

          product_thumbnail.src = variants[variantid][0][2].src;
          product_thumbnail.width = variants[variantid][0][2]._x;
          product_thumbnail.height = variants[variantid][0][2]._y;
          if (typeof(window.saved_product_thumbnail) != 'undefined' && saved_product_thumbnail)
            saved_product_thumbnail = false;

        }

        if (useSwitchImageBox) {
          switchImageBox('variant');
        }

      } else if (useSwitchImageBox && $('#variantImageBox:visible')) {
          switchImageBox('product');
      } else if (getImgSrc(product_thumbnail) != product_image.src) {
        product_thumbnail.src = product_image.src;
        if (product_image.width > 0 && product_image.height > 0) {
          product_thumbnail.width = product_image.width;
          product_thumbnail.height = product_image.height;
          if (typeof(window.saved_product_thumbnail) != 'undefined' && saved_product_thumbnail)
            saved_product_thumbnail = false;
        }

      }

      if (max_image_width > 0 && product_thumbnail.width > max_image_width) {
        product_thumbnail.height = Math.round(product_thumbnail.height*max_image_width/product_thumbnail.width);
        product_thumbnail.width = max_image_width;
      }
      if (max_image_height > 0 && product_thumbnail.height > max_image_height) {
        product_thumbnail.width = Math.round(product_thumbnail.width*max_image_height/product_thumbnail.height);
        product_thumbnail.height = max_image_height;
      }
    }

    /* Change product weight */
    if (document.getElementById('product_weight'))
      document.getElementById('product_weight').innerHTML = price_format(variants[variantid][0][3]);

    if (document.getElementById('product_weight_box'))
      document.getElementById('product_weight_box').style.display = parseFloat(variants[variantid][0][3]) > 0 ? "" : "none";

    /* Change product code */
    if (document.getElementById('product_code'))
      document.getElementById('product_code').innerHTML = variants[variantid][0][5];

  }

  if (pconf_price > 0)
    price = pconf_price;

  /* Find modifiers */
  var _tmp = modi_price(price, local_taxes, orig_price);
  price = _tmp[0];
  local_taxes = _tmp[1];
  if (!variantid) {
    product_wholesale = [];
    for (var t in _product_wholesale) {
      if (!hasOwnProperty(_product_wholesale, t))
        continue;

      _tmp = modi_price(_product_wholesale[t][2], _product_wholesale[t][3].slice(0), _product_wholesale[t][4]);
      product_wholesale[t] = [
        _product_wholesale[t][0],
        _product_wholesale[t][1],
        _tmp[0],
        _tmp[1]
      ];
    }
    is_rebuild_wholesale = true;
  }

  /* Update taxes */
  for (var t in local_taxes) {
    if (!hasOwnProperty(local_taxes, t))
      continue;

    if (document.getElementById('tax_'+t)) {
      document.getElementById('tax_'+t).innerHTML = price_format(Math.max(local_taxes[t], 0));
    }
    current_taxes[t] = local_taxes[t];
  }

  if (is_rebuild_wholesale)
    rebuild_wholesale();

  /* Update form elements */
  /* Update price */
  if (document.getElementById('product_price'))
    document.getElementById('product_price').innerHTML = price_format(Math.max(price, 0));

  /* Update alt. price */
  if (alter_currency_rate > 0 && document.getElementById('product_alt_price')) {
    var altPrice = price*alter_currency_rate;
    document.getElementById('product_alt_price').innerHTML = price_format(Math.max(altPrice, 0));
  }

  /* Update Save % */
  if (document.getElementById('save_percent') && document.getElementById('save_percent_box') && list_price > 0 && dynamic_save_money_enabled) {
    var save_percent = Math.round(100 - (price / list_price) * 100);
    if (save_percent > 0) {
      document.getElementById('save_percent_box').style.display = '';
      document.getElementById('save_percent').innerHTML = save_percent;

    } else {
      document.getElementById('save_percent_box').style.display = 'none';
      document.getElementById('save_percent').innerHTML = '0';
    }
  }

  /* Update product quantity */
  $('.product-quantity-text').html(avail > 0 ? substitute(txt_items_available, "items", (variantid ? avail : product_avail)) : lbl_no_items_available);
  $('.product-quantity-number').html(avail > 0 ? (variantid ? avail : product_avail) : 0);

  if ((mq > 0 && avail > mq+min_avail) || !is_limit)
    avail = mq + min_avail - 1;

  avail = Math.min(mq, avail);

  var select_avail = min_avail;

  /* Update product quantity selector */
  availObj = document.getElementById(quantity_input_box_enabled ? 'product_avail_input' : 'product_avail');

  if (availObj && availObj.tagName.toUpperCase() == 'SELECT') {

    // Select box
    if (!isNaN(min_avail) && !isNaN(avail)) {
      var first_value = -1;
      if (availObj.options[0])
        first_value = availObj.options[0].value;

      if (first_value == min_avail) {

        /* New and old first value in quantities list is equal */
        if ((avail-min_avail+1) != availObj.options.length) {
          if (availObj.options.length > avail-min_avail+1) {
            var cnt = availObj.options.length;
            for (var x = (avail-min_avail+1 < 0 ? 0 : avail-min_avail+1); x < cnt; x++)
              availObj.options[availObj.options.length-1] = null;

          } else {
            var cnt = availObj.options.length;
            for (var x = cnt+min_avail; x <= avail-min_avail+1; x++)
              availObj.options[cnt++] = new Option(x, x);
          }
        }
      } else {

        /* New and old first value in quantities list is differ */
        var cnt = availObj.options.length - 1;
        while (cnt >= 0)
          availObj.options[cnt--] = null;

        cnt = 0;
        for (var x = min_avail; x <= avail; x++)
          availObj.options[cnt++] = new Option(x, x);
      }
      if (availObj.options.length == 0 || min_avail > avail)
        availObj.options[0] = new Option(txt_out_of_stock, 0);
    }
    select_avail = availObj.options[availObj.selectedIndex].value;

  } else if (availObj && availObj.tagName.toUpperCase() == 'INPUT' && availObj.type.toUpperCase() == 'TEXT') {

    // Input box
        if (!isNaN(min_avail) && !isNaN(avail)) {
      availObj.minQuantity = min_avail;
      availObj.maxQuantity = max_avail;
    }

    if (isNaN(parseInt(availObj.value)) || availObj.value == 0) 
       availObj.value = min_avail;
    
      select_avail = availObj.value;
  }



  check_wholesale(select_avail);

  if (alert_msg == 'Y' && min_avail > avail)
    alert(txt_out_of_stock);
  
  /* Show/hide product notifications request forms (Product Notifications module) */
  if (typeof(ProductNotificationWidgets) != 'undefined' && ProductNotificationWidgets) {
    for (var x in ProductNotificationWidgets) {
      if (typeof(ProductNotificationWidgets[x]) != 'undefined' && typeof(ProductNotificationWidgets[x].refresh) == 'function') {
        var refreshData = {
          "inStock": avail,
          "minAmount": min_avail
        };
        ProductNotificationWidgets[x].refresh(refreshData);
      }
    }
  }

  /* Check exceptions */
  var ex_flag = check_exceptions();
  if (!ex_flag && (alert_msg == 'Y'))
    alert(exception_msg);

  if (document.getElementById('exception_msg')) {
    if (ex_flag) {
      document.getElementById('exception_msg').style.display = 'none';

    } else {
      document.getElementById('exception_msg').innerHTML = exception_msg_html;
      document.getElementById('exception_msg').style.display = '';
    }
  }

  return true;
}

/**
 * Calculate product price with price modificators 
 */
function modi_price(_price, _taxes, _orig_price) {
  var return_price = round(_price, 2);

  /* List modificators */
  for (var x2 in modifiers) {
    if (!hasOwnProperty(modifiers, x2))
      continue;

    var value = getPOValue(x2);
    if (!value || !modifiers[x2][value])
      continue;

    /* Get selected option */
    var elm = modifiers[x2][value];
    return_price += parseFloat(elm[1] == '$' ? elm[0] : (_price*elm[0]/100));

    /* Get tax extra charge */
    for (var t2 in _taxes) {
      if (hasOwnProperty(_taxes, t2) && elm[2][t2])
        _taxes[t2] += parseFloat(elm[1] == '$' ? elm[2][t2] : (_orig_price*elm[2][t2]/100));
    }
  }

  return [return_price, _taxes];
}

/**
 * Check product options exceptions
 */
function check_exceptions() {
  if (typeof(exceptions) === 'undefined')
    return true;

  /* List exceptions */
  for (var x in exceptions) {
    if (!hasOwnProperty(exceptions, x) || isNaN(x))
      continue;

    var found = true;
        for (var c in exceptions[x]) {
      if (!hasOwnProperty(exceptions[x], c))
        continue;

      var value = getPOValue(c);
      if (!value)
        return true;

            if (value != exceptions[x][c]) {
        found = false;
        break;
      }
    }
    if (found)
      return false;
  }

  return true;
}

/**
 * Rebuild wholesale tables
 */
function rebuild_wholesale() {
  var div = document.getElementById('wl-prices');
  var wl_table = $('table', div).get(0);
  var wl_taxes = $('div', div).get(0);

  if (!div || !wl_table || !wl_taxes)
    return false;

  /* Clear wholesale span object if product wholesale prices service array is empty */
  var i = wl_table.rows.length - 1;
  while (i > 0)
    wl_table.deleteRow(i--);

  if (!product_wholesale || product_wholesale.length == 0) {
    div.style.display = 'none';
    return false;
  }

  /* Display wholesale prices table */
  var str = '';
  var r;
  for (i in product_wholesale) {
    if (!hasOwnProperty(product_wholesale, i) || product_wholesale[i][0] == 0)
      continue;

    r = wl_table.insertRow(-1);
    insert_text = (product_wholesale[i][1] == 0) ? product_wholesale[i][0] + '+' : (product_wholesale[i][1] - product_wholesale[i][0] > 0 ? product_wholesale[i][0] + '-' + product_wholesale[i][1] : product_wholesale[i][0]);
    r.insertCell(-1).innerHTML = insert_text + '&nbsp;' + (product_wholesale[i][0] == 1 ? lbl_item : lbl_items);
    r.insertCell(-1).innerHTML = price_format(product_wholesale[i][2] < 0 ? 0 : product_wholesale[i][2], false, false, false, true);
  }

  if (wl_table.rows.length <= 1) {
        div.style.display = 'none';
    return false;
  }

    /* Display wholesale prices taxes */
    var display_taxes = false;
  if (taxes.length > 0) {
        for (i in taxes) {
            if (hasOwnProperty(taxes, i) && current_taxes[i] > 0)
        display_taxes = true;
        }
    }

  if (!display_taxes) 
     wl_taxes.style.display = 'none';
  else
    wl_taxes.style.display = '';

    div.style.display = '';

  return true;
}

/**
 * Display current wholesale price as product price
 */
function check_wholesale(qty) {

  if ((typeof(product_wholesale) == 'undefined') ||  product_wholesale.length == 0)
    return true;

  var wl_taxes = current_taxes.slice(0);
  var wl_price = price;
  for (var x = 0; x < product_wholesale.length; x++) {
    if (product_wholesale[x][0] <= qty && (product_wholesale[x][1] >= qty || product_wholesale[x][1] == 0)) {
      wl_price = product_wholesale[x][2];
      wl_taxes = product_wholesale[x][3].slice(0);
    }

    if (document.getElementById('wp' + x)) {
      var wPrice = price-default_price+product_wholesale[x][2];
      document.getElementById('wp' + x).innerHTML = price_format(Math.max(wPrice, 0));
    }
  }

  if (document.getElementById('product_price'))
    document.getElementById('product_price').innerHTML = price_format(Math.max(wl_price, 0));

  if (alter_currency_rate > 0 && document.getElementById('product_alt_price')) {
    document.getElementById('product_alt_price').innerHTML = price_format(Math.max(wl_price * alter_currency_rate, 0));
  }

  /* Update Save % */
  if (document.getElementById('save_percent') && document.getElementById('save_percent_box') && list_price > 0 && dynamic_save_money_enabled) {
    var save_percent = Math.round(100 - (Math.max(wl_price, 0) / list_price) * 100);
    if (save_percent > 0) {
      document.getElementById('save_percent_box').style.display = '';
      document.getElementById('save_percent').innerHTML = save_percent;

    } else {
      document.getElementById('save_percent_box').style.display = 'none';
      document.getElementById('save_percent').innerHTML = '0';
    }
  }


  for (var x in taxes) {
    if (hasOwnProperty(taxes, x) && document.getElementById('tax_'+x) && wl_taxes[x] && current_taxes[x]) {
      document.getElementById('tax_'+x).innerHTML = price_format(Math.max(wl_taxes[x], 0));
    }
  }

  return true;
}

/**
 * Get product option value
 */
function getPOValue(c) {
  if (!document.getElementById('po' + c) || document.getElementById('po' + c).tagName.toUpperCase() != 'SELECT')
    return false;

  return document.getElementById('po'+c).options[document.getElementById('po'+c).selectedIndex].value;
}

/**
 * Get product option object by class name / class id
 */
function product_option(classid) {
  if (!isNaN(classid))
     return document.getElementById("po" + classid);

  if (!names)
    return false;

  for (var x in names) {
    if (!hasOwnProperty(names, x) || names[x]['class_name'] != classid)
      continue;

    return document.getElementById('po' + x);
    }

  return false;
}

/**
 * Get product option value by class name / or class id
 */
function product_option_value(classid) {
  var obj = product_option(classid);
  if (!obj)
    return false;

  if (obj.type != 'select-one')
    return obj.value;

  var classid = parseInt(obj.id.substr(2));
  var optionid = parseInt(obj.options[obj.selectedIndex].value);
  if (names[classid] && names[classid]['options'][optionid])
    return names[classid]['options'][optionid];

  return false;
}

/**
 * Hide the "Options are expired message" and update product in the cart
 */
function close_opts_expire_msg(cartid) {

  var post_params = 'target=cart&mode=update&product_options=1&id=' + cartid;
  var cart_message_box = document.getElementById('cart_message_' + cartid);

  $.ajax({type: 'POST', url: 'popup_poptions.php', data: post_params});
  if (cart_message_box) {
    cart_message_box.style.display = 'none';
  }

  return false;
}


/* vim: set ts=2 sw=2 sts=2 et: */
/**
 * Quantity checking script
 * 
 * @category   X-Cart
 * @package    X-Cart
 * @subpackage JS Library
 * @author     Ruslan R. Fazlyev <rrf@x-cart.com> 
 * @version    d5960331bcf93a12f89be438097ac50a2e861236, v4 (xcart_4_6_4), 2014-06-10 14:58:47, check_quantity.js, aim
 * @link       http://www.x-cart.com/
 * @see        ____file_see____
 */

// Check quantity input box
function check_quantity(id, featured) {

  var inp = document.getElementById('product_avail_' + id + featured);
  if (!inp)
    return true;

  if (isNaN(inp.minQuantity))
    inp.minQuantity = products_data[id].min_quantity;

  if (isNaN(inp.maxQuantity))
    inp.maxQuantity = products_data[id].quantity;

  if (!isNaN(inp.minQuantity) && !isNaN(inp.maxQuantity)) {
    var q = parseInt(inp.value);
    if (isNaN(q)) {
      alert(substitute(lbl_product_quantity_type_error, "min", inp.minQuantity, "max", inp.maxQuantity));
      return false;
    }

    if (q < inp.minQuantity) {
      alert(substitute(lbl_product_minquantity_error, "min", inp.minQuantity));
      return false;
    }

    if (q > inp.maxQuantity && is_limit) {
      if (parseInt(inp.maxQuantity) == 0) {
        alert(txt_out_of_stock);
      } else {
        alert(substitute(lbl_product_maxquantity_error, "max", inp.maxQuantity));
      }
      return false;
    }
  }

  return true;
}

function change_quantity_input_box(inp_id, step, min_amount) {
  inp = document.getElementById(inp_id);
  if (!inp)
    return;
  inp.value = Math.round(parseInt(inp.value) + parseInt(step));
  if (inp.value <= '0')
    inp.value = 0;
    
  return true;
}

/* vim: set ts=2 sw=2 sts=2 et: */

$(function () {

  $(ajax.messages).bind(
    'productAdded',
    function(e, data) {

      $('.ui-dialog-content').dialog('close').dialog('destroy').remove();

      var dialog = $(data.content).not('script');
      var dialogScripts = $(data.content).filter('script');

      dialog.dialog({

        autoOpen: false,
        dialogClass: "product-added",
        modal: true,
        title: data.title,
        width: 575,
        draggable: false,
        resizable: false,
        position:  {my : 'center center', at : 'center center'},
        closeOnEscape: true,

        close: function() {
          dialogScripts.remove();
        },

        open: function () {
          $(".product-added .view-cart").button();
          $(".product-added .continue-shopping").button().click(function () {
            dialog.dialog('close');
            return false;
          });
          $(".product-added .proceed-to-checkout").button().click(function () {
            dialog.dialog('close');
          });
          $('.ui-widget-overlay').click(function () {
            dialog.dialog('close');
          });
        }

      });

      dialogScripts.appendTo('body');
      dialog.dialog('open');

      ajax.widgets.products();
    }
  );

});

    function initDropOutButton() {   if ($(this).hasClass('activated-widget'))     return;   $(this).addClass('activated-widget');   var dropOutBoxObj = $(this).parent().find('.dropout-box');   /* Process the onclick event on a dropout button  */   $(this).click(     function(e) {       e.stopPropagation();       $('.dropout-box').removeClass('current');       dropOutBoxObj         .toggle()         .addClass('current');       $('.dropout-box').not('.current').hide();       if (dropOutBoxObj.offset().top + dropOutBoxObj.height() - $('#center-main').offset().top - $('#center-main').height() > 0) {         dropOutBoxObj.css('bottom', '-2px');       }     }   );   /* Click on a dropout layer keeps the dropout content opened */   $(this).parent().click(     function(e) {       e.stopPropagation();     }   );   /* shift the dropout layer from the right hand side  */   /* if it's out of the main area */   var borderDistance = ($("#center-main").offset().left + $("#center-main").outerWidth()) - ($(this).offset().left + dropOutBoxObj.outerWidth());   if (!isNaN(borderDistance) && borderDistance < 0) {     dropOutBoxObj.css('left', borderDistance+'px');   } } $(document).ready( function() {   $('body').click(     function() {       $('.dropout-box')         .filter(function() { return $(this).css('display') != 'none'; } )         .hide();     }   );   $('div.dropout-container div.drop-out-button').each(initDropOutButton); } );   $(document).ready( function() { $('form').not('.skip-auto-validation').each(function() {   applyCheckOnSubmit(this); }); $(document).on(   'click','a.toggle-link',    function(e) {     $('#' + $(this).attr('id').replace('link', 'box')).toggle();   } ); });   if (products_data == undefined) { var products_data = []; }  var txt_are_you_sure = 'Are you sure?'; 
      $(function(){
        // FB.init({
        //   xfbml: true
        // });
      });
    
      var pinterest_endpoint = "//assets.pinterest.com/pinit.html";
      
        var pinterest_options = {
          att: {
            layout: "count-layout",
            count: "always-show-count"
          },
          endpoint: pinterest_endpoint,
            button: "//pinterest.com/pin/create/button/?",
            vars: {
            req: ["url", "media"],
            opt: ["title", "description"]
          },
          layout: {
            none: {
              width: 43,
              height: 20
            },
            vertical: {
              width: 43,
              height: 58
            },
            horizontal: {
              width: 90,
              height: 20
            }
          }
        }
      
    
/*e1db5cf03524aef7b3d94390d4b4baa6311fd42b, v2 (xcart_4_5_5), 2013-02-07 17:35:38, pinterest.js, aim*/

function pin_it () {
  var o = document,
  c = pinterest_options;

  var r = function (h) {
    var e = c.endpoint,
    m = "?",
    a, i, f, b;
    f = [];
    b = [];
    var j = {},
    g = o.createElement("IFRAME"),
    q = h.getAttribute(c.att.count) || false,
    n = h.getAttribute(c.att.layout) || "horizontal";
    f = h.href.split("?")[1].split("#")[0].split("&");
    a = 0;
    for (i = f.length; a < i; a += 1) {
      b = f[a].split("=");
      j[b[0]] = b[1]
    }
    a = f = 0;
    for (i = c.vars.req.length; a < i; a += 1) {
      b = c.vars.req[a];
      if (j[b]) {
        e = e + m + b + "=" + j[b];
        m = "&"
      }
      f += 1
    }
    if (j.media && j.media.indexOf("http") !== 0) f = 0;
    if (f === i) {
      a = 0;
      for (i = c.vars.opt.length; a < i; a += 1) {
        b = c.vars.opt[a];
        if (j[b]) e = e + m + b + "=" + j[b]
      }
      e = e + "&layout=" + n;
      if (q !== false) e += "&count=1";
      g.setAttribute("src", e);
      g.setAttribute("scrolling", "no");
      g.allowTransparency = true;
      g.frameBorder = 0;
      g.style.border = "none";
      g.style.width = c.layout[n].width + "px";
      g.style.height = c.layout[n].height + "px";
      h.parentNode.replaceChild(g, h)
    } else h.parentNode.removeChild(h)
  };
        
  $('a.pin-it-button').each(function(){
    r(this);
  });
}

      $(function(){
        pin_it();
      });
    