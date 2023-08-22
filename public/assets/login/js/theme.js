

(function($) {
    "use strict";


        $(".showicon").click(function() {
          $(".passwordhide").attr("type", "text");
          $(".showicon").hide();
          $(".hideicon").show();
      });
      $(".hideicon").click(function() {
          $(".passwordhide").attr("type", "password");
          $(".hideicon").hide();
          $(".showicon").show();
      });



})(jQuery);