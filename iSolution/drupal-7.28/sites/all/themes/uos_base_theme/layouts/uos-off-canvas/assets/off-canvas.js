var OBC = (function (OBC, $) {
  OBC.susyOffCanvasToggle = {
    init: function (triggers) {
      $(triggers).click(function (e) {
        e.preventDefault();
        OBC.susyOffCanvasToggle.toggleClasses(this);
        OBC.susyOffCanvasToggle.toggleText(triggers);
      });
      return triggers;
    },
    toggleClasses: function (el) {
      if ($(el).attr('href') === '#menu-btn') {
        $('body').toggleClass('show-left-sidebar');
      }
      return $('body').attr('class');
    },
    toggleText: function (triggers) {
      var left = $(triggers).filter('[href="#menu-btn"]');
      if ($('body').hasClass('show-left-sidebar')) {
        left.text('Hide menu');
      } else {
        left.text('Show menu');
      }
    }
  };

  $(function () {
    OBC.susyOffCanvasToggle.init($('.toggle'));
  });

  return OBC;

}(OBC || {}, jQuery));