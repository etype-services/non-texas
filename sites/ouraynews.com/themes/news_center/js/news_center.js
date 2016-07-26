
// Auto-Fill Plugin
// Written by Joe Sak http://www.joesak.com/2008/11/19/a-jquery-function-to-auto-fill-input-fields-and-clear-them-on-click/
(function($){
  $.fn.autofill = function(options){
    var defaults = {
      value:'',
      defaultTextColor:"#AAAAAA",
      activeTextColor:"#000000",
      password: false
    };
    var options = $.extend(defaults,options);
    return this.each(function(){
      var obj=$(this);
      obj.css({color:options.defaultTextColor})
        .val(options.value)
        .focus(function(){
          if(obj.val()==options.value){
            obj.val("").css({color:options.activeTextColor});
            if (options.password && obj.attr('type') == 'text') {
              obj.attr('type', 'password');
            }
          }
        })
        .blur(function(){
          if(obj.val()==""){
            obj.css({color:options.defaultTextColor}).val(options.value);
            if (options.password && obj.attr('type') == 'password') {
              obj.attr('type', 'text');
            }
          }
        });
    });
  };
})(jQuery);

(function ($) {
Drupal.behaviors.newscenter = {
  attach: function (context) {
    $('#search-block-form .form-text', context).autofill({
      value: "Search Articles ..."
    });
  } 
};
})(jQuery);

(function ($) {
Drupal.behaviors.newsletter = {
  attach: function (context) {
    $('.block-simplenews #edit-mail', context).autofill({
      value: "Your Email Address"
    });
  }
};

})(jQuery);
  
(function ($) {
Drupal.behaviors.newscenterbox = {
  attach: function (context) {
    $('#search-block-form--2 .form-text', context).autofill({
      value: "Search Articles ..."
    });
  } 
};
})(jQuery);


(function ($) {
    Drupal.behaviors.classifiedform = {
        attach: function (context) {
            var wordCounts = {};
            $("#edit-submitted-up-to-15-words-4-weeks-only-25").keyup(function() {
                var matches = this.value.match(/\b/g);
                var ap = 0;
                wordCounts[this.id] = matches ? matches.length / 2 : 0;
                var finalCount = 0;
                $.each(wordCounts, function(k, v) {
                    finalCount += v;
                });
                if (finalCount >= 15) {
                    if (ap == 0) {
                        ap = 1;
                        $("#webform-component-up-to-15-words-4-weeks-only-25 > label").append(' Max word count reached');
                    }

                }
            }).keyup();
        }
    };
})(jQuery);
