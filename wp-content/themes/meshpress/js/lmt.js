//habanero.js

var habanero = {

    orderTriggers: function(){
      var $trigger = $('#delivery a.button.open');
      var $triggerClosed = $('a.button.closed');
      var $message = $('#closed_reason').text();
      var $messageWithHours = $('#closed_with_hours').text();
      $trigger.on('click touchend', function(e){
        var $flyout = $(this).siblings('.delivery-flyout');
        e.preventDefault();
        $flyout.toggleClass('active');
      });
      $triggerClosed.on('click touchend', function(e){
        e.preventDefault();
        alert($messageWithHours);
      });
    },//orderTriggers

    carousel: function(){
        var owl = $('.owl-carousel');
        owl.owlCarousel({
          items: 1,
          loop: true,
          autoplay: true,
          autoplayTimeout: 4000,
          navigation: false,
          dots: false,
          autoplayHoverPause: true
        });
        $('.play').on('click', function() {
          owl.trigger('play.owl.autoplay', [1000])
        })
        $('.stop').on('click', function() {
          owl.trigger('stop.owl.autoplay')
        })
    },//carousel

    priceMatch: function(){
      var $price = $('form').find('input[name="product_amount_1"]');
      $price.each(function(){
        $value = $(this).val();
        $menuValue = $(this).parents('.merchantOne').siblings('.content').find('.price');
        $menuValue2 = $(this).parents('form').siblings('h4');
        $menuValue.text('$' + $value);
        $menuValue2.text('$' + $value);
      });
    },//priceMatch

    extraFields: function(){
      //this function creates dropdowns for available meat choices via ACF and then populates a text field with these selections from merchantOne. The input must start as a text input and then become hidden with a "meat-target" class.
      var $needsPicker = $('.meat-picker');
      $needsPicker.each(function(){
        var $meatSelects = $(this).find('.meat-selects');
        var $select1 = $meatSelects.find('.meat-select:nth-child(1)');
        var $select2 = $meatSelects.find('.meat-select:nth-child(2)');
        var $select3 = $meatSelects.find('.meat-select:nth-child(3)');
          $select1.on('change', function(){
            var $meatTarget = $(this).parents('.meat-selects').siblings('.merchantOne').find('input.meat-target');
            var $item1 = $select1.val();
            var $item2 = $select2.val();
            var $item3 = $select3.val();
            $meatTarget.val($item1 + ', ' + $item2 + ', ' + $item3);
          });
          $select2.on('change', function(){
            var $meatTarget = $(this).parents('.meat-selects').siblings('.merchantOne').find('input.meat-target');
            var $item1 = $select1.val();
            var $item2 = $select2.val();
            var $item3 = $select3.val();
            $meatTarget.val($item1 + ', ' + $item2 + ', ' + $item3);
          });
          $select3.on('change', function(){
            var $meatTarget = $(this).parents('.meat-selects').siblings('.merchantOne').find('input.meat-target');
            var $item1 = $select1.val();
            var $item2 = $select2.val();
            var $item3 = $select3.val();
            $meatTarget.val($item1 + ', ' + $item2 + ', ' + $item3);
          });
      })
    },//extraFields

    meatExclusion: function(){
      var $orderSelect = $('.menu-item select');
      $orderSelect.each(function(){
        var $options = $(this).find('option');
        $options.each(function(){
          var $value = $(this).val();
          if (~$value.indexOf("Lengua")) {
            console.log('Out of that meat.');
            $(this).remove();
          }
        });
      });
    },

    modalClose: function(){
      var $modal = $('.overlay');
      var $closeTrigger = $modal.find('.modal-close a');
      $closeTrigger.on('click touchend', function(e){
        $modal.remove();
        e.preventDefault();
      });
    }

}

$(document).ready(function(){
    habanero.orderTriggers();
    habanero.extraFields();
    habanero.meatExclusion();
    habanero.carousel();
    habanero.priceMatch();
    habanero.modalClose();
});
