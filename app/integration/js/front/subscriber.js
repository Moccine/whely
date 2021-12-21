let $ = require('jquery');
$(document).ready(function() {

  $("#menu-presentation").click(() => {
    (this.parentElement.style.height === '50px' || this.parentElement.style.height === '')
      ? this.parentElement.style.height = '150px'
      : this.parentElement.style.height = '50px';
  });


  $.ajax({
    url: "/subscriber/form/template",
  }).done((data) => {
    let $form = $('body').find("#subscriber-form");
    $form.html(data.template);
    $form.find('button').click((e) => {
      validateSubscription();
      console.log(e)
    });
  })
});

function validateSubscription() {

  var footer_name = document.getElementById("newsletter_name");
  var footer_email_address = document.getElementById("newsletter_email");

  if (footer_name.value == "") {
    footer_name.className = "input error";
    return false;
  } else if (footer_email_address.value == "") {
    footer_email_address.className = "input error";
    return false;
  } else if (checkcontact(footer_email_address.value) == false) {
    footer_email_address.className = "input error";
    return false;
  } else {

    $.ajax({
      type: "POST",
      url: '/add/news/letter/suscriber',
      data: $("#subscribe_form").serialize(),
      success: function(data) {
        console.log(data);
        if (data.msg === 'success') {
          footer_name.className = "input";
          footer_name.value = "";
          footer_email_address.className = "input";
          footer_email_address.value = "";

          $("#subscribe_form").hide();
          document.getElementById("subscribe_error").innerHTML = '';
          document.getElementById("subscribe_success").innerHTML = '';
          document.getElementById("subscribe_success").style.display = "block";
          document.getElementById("subscribe_success").innerHTML = "Je vous remercie! Nous vous contacterons sous peu.";
          $("#subscribe_error").addClass('text-success')

        } else {
          document.getElementById("subscribe_error").innerHTML = '';
          document.getElementById("subscribe_success").innerHTML = '';
          document.getElementById("subscribe_error").style.display = "block";
          document.getElementById("subscribe_error")
          document.getElementById("subscribe_error").innerHTML = data.msg;
          $("#subscribe_error").addClass('text-danger')
        }
      }

    });

  }
}
