(function($){
  $(document).ready(function(){
    $('.wil-convert').on('click', function(event) {
      event.preventDefault();
      const $this = $(this);
      $this.html('Converting');


      $.ajax({
        type: 'POST',
        data:{
          action: $this.data('action')
        },
        url: ajaxurl,
        success: response => {
          $this.html('Convert now');
          alert(response.data.msg);
        }
      });
    });
  })
})(jQuery);
