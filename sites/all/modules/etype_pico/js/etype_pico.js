/* add custom js */
(function ($) {
  'use strict';
  Drupal.behaviors.etypePico = {
    attach: function (context, settings) {
      $('.user-menu a[href="/login"]').addClass('PicoRule PicoSignal');
      $('.user-menu a[href="/subscribe"]').addClass('PicoPlan PicoSignal');
    }
  };
})(jQuery);
