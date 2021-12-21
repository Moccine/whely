let $ = require('jquery');
let form = $("#contact-form-main2");
let submitButton = form.find(".submit-btn")

$(document).ready(function() {
  submitButton.prop("disabled", true);
  form.find('input').change(() => {
    checkInput()
  })
});
let checkInput = () => {
  form.find('input').each((index, input) => {
    $(input).removeClass('error');
    if (!$(input).val()) {
      $(input).addClass('error');
    } else {
      submitButton.prop("disabled", false);
      submitButton.click(() => {

        $.ajax({
          type: "POST",
          url: "/whelly/send/mai",
          data: $(form).serialize(),
          success:  () => {
            console.log('serdtfyuhijo')
            $( "#loader").hide();
            $( "#success").slideDown( "slow" );
            setTimeout(function() {
              $( "#success").slideUp( "slow" );
            }, 3000);
            form.reset();
          },
          error: function() {
            $( "#loader").hide();
            $( "#error").slideDown( "slow" );
            setTimeout(function() {
              $( "#error").slideUp( "slow" );
            }, 3000);
          }
        });
      })
    }
  });
};