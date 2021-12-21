let $ = require('jquery');
let name = $("request_call_back_name");
let email = $("request_call_back_email");
let phone = $("request_call_back_phone");
let subject = $("request_call_back_subject");
$(document).ready(function () {
    let $form = $('body').find("#request-call-back");
    let $ajaxSuccess =  $('.request-a-callback-form-success')
    let $ajaxFailed =  $('.request-a-callback-form-failed')
    $ajaxSuccess.hide()
    $ajaxFailed.hide()
    let submitButton = $(".submit-request-call-back")
    submitButton.on('click', (e) => {
        // check name
        let $name = $form.find('#request_call_back_name');
        $name.removeClass('input error')
        $form.find(".form-error").hide()
        if ($name.val() === "") {
            $name.addClass('input error')
            return false;
        }


        // check phone
        let $phone = $form.find('#request_call_back_phone');
        $phone.removeClass('input error')
        if (!isValidFrenchPhoneNumber($phone.val())) {
            $phone.addClass('input error');
            return false;
        }

        //validate email
        let $email = $form.find('#request_call_back_email');
        let pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        if (!pattern.test($email.val())) {
            $email.addClass('input error');
            return false;
        }
        // check subject
        let $subject = $form.find('#request_call_back_subject')
        if ($subject.val() === 'Choisir votre objectif') {
            $subject.addClass('input error')
             $ajaxSuccess.hide()
             $ajaxFailed.html('Choisir votre objectif').show()
            return false;
        }


        $.ajax({
            type: "POST",
            url: '/add/request/call/back',
            data: $form.serialize(),
            success: function (data) {
                if (data.msg === 'success') {
                    $ajaxFailed.hide()
                   $ajaxSuccess.html('Ajouter avec success').show();
                }else {
                    $ajaxSuccess.hide()
                    $ajaxFailed.html(data.msg).show();
                }
                $form.find('input').each((index, value) => {
                    $(value).val("");
                })

            }
        });
    })
//---------------------------------------------------


    $form.find('button').click((e) => {
        validateSubscription();
    });
});

function validateSubscription() {


    if (name.value === "") {
        name.className = "input error";
        return false;
    } else if (email.value === "") {
        email.className = "input error";
        return false;
    } else if (phone.value === "") {
        phone.className = "input error";
        return false;
    } else if (checkcontact(email.value) === false) {
        email.className = "input error";
        return false;
    } else {

        $.ajax({
            type: "POST",
            url: '"/add/request/call/back',
            data: $("#subscribe_form").serialize(),
            success: function (data) {
                if (data.msg === 'success') {
                    name.className = "input";
                    name.value = "";
                    email.className = "input";
                    email.value = "";
                    phone.className = "input";
                    phone.value = "";
                    subject.className = "input";
                    subject.value = "";

                    $("#subscribe_form").hide();
                    $("subscribe_error").innerHTML = '';
                    $("subscribe_success").innerHTML = '';
                    $("subscribe_success").style.display = "block";
                    $("subscribe_success").innerHTML = "Je vous remercie! Nous vous contacterons sous peu.";
                    $("#subscribe_error").addClass('text-success')

                } else {
                    $("subscribe_error").innerHTML = '';
                    $("subscribe_success").innerHTML = '';
                    $("subscribe_error").style.display = "block";
                    $("subscribe_error")
                    $("subscribe_error").innerHTML = data.msg;
                    $("#subscribe_error").addClass('text-danger')
                }
            }

        });

    }
}

const isValidFrenchPhoneNumber = (phonenumber) => {
    //      07 70 00 00 00
    // +224 657 66 66 31
    const metropolitanFranceReg = new RegExp(/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/)
    const overseasFranceReg = new RegExp(/^(?:(?:\+|00)224|0)\s*[1-9](?:[\s.-]*\d{2}){5}$/)
   // const overseasFranceReg = new RegExp(/^(?:(?:\+|00|0)((224|692)|(263|693)|508|(5|6)90|(5|6)94|(5|6|7)96|681|687|689))(?:[\s.-]*\d{2}){3,4}$/)
    // src: https://en.wikipedia.org/wiki/Telephone_numbers_in_France
    // 262, 263 = La Réunion, Mayotte and IO territories ; 508 = Saint-Pierre-et-Miquelon
    // 590 = Guadeloupe, Saint-Martin et Saint-Barthélemy ; 594 = French Guiana (Guyane) ; 596 = Martinique
    // 681 = Wallis-et-Futuna ; 687 = Nouvelle-Calédonie
    // 689 = French Polynesia
    return metropolitanFranceReg.test(phonenumber) || overseasFranceReg.test(phonenumber);
}