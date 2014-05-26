//= require jquery/dist/jquery.js
//= require fastclick/lib/fastclick.js
//= require foundation/js/foundation.js
//= include app.js

// foundation

$(document).foundation();

// FastClick

window.addEventListener('load', function() {
    FastClick.attach(document.body);
    FastClick.attach(document.getElementByCLass('selection'));
    FastClick.attach(document.getElementByTagName('input'));
    FastClick.attach(document.getElementByTagName('label'));
}, false);
