/* Article FructCode.com */
$(document).ready(function () {
  $("#btn_sign-in").click(function () {
    sendAjaxForm("result_form", "sign_in", "functions.php");
    return false;
  });
  $("#btn_sign-up").click(function () {
    sendAjaxForm("result_form", "sign_up", "registration.php");
    return false;
  });
});

function sendAjaxForm(result_form, ajax_form, url) {
  $.ajax({
    url: url,
    type: "POST",
    dataType: "html", //формат данных
    data: $("." + ajax_form).serialize(), // Сеарилизуем объект
    success: function (response) {
      result = $.parseJSON(response);
      if (result.res == true) {
        location.reload();
      } else {
        $(".err").html(result.error);
        $(".errLogin").html(result.errorLogin);
        $(".errEmail").html(result.errorEmail);
        $(".errPassword").html(result.errorPassword);
      }
    },
    error: function (response) {
      // Данные не отправлены
      // errorBox.innerHTML = data.error;
      console.log("BAD");
      $("#fatal_error").html("Ошибка. Данные не отправлены.");
      // $(".err").html(response.error);
    },
  });
}
