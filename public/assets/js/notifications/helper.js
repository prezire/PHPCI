// Generated by CoffeeScript 2.1.1
(function() {
  var Helper;

  Helper = class Helper {
    constructor() {} 

    static param(name, url) {
      var regex, results;
      if (!url) {
        url = window.location.href;
      }
      name = name.replace(/[\[\]]/g, "\\$&");
      regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
      results = regex.exec(url);
      if (!results) {
        return null;
      }
      if (!results[2]) {
        return '';
      }
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

  };

}).call(this);
