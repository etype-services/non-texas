/* add custom js */
(function ($) {
  'use strict';
  Drupal.behaviors.etypePico = {
    attach: function (context, settings) {
      $('#user-menu a[href="/pico-login"]').addClass('PicoRule PicoSignal');
      $('#user-menu a[href="/pico=subscribe"]').addClass('PicoPlan PicoSignal');
    }
  };
})(jQuery);
