/* Article FructCode.com */
$(document).ready(function () {
  $("#btn").click(function () {
    sendAjaxForm("result_form", "ajax_form", "functions.php");
    return false;
  });
});

function sendAjaxForm(result_form, ajax_form, url) {
  $.ajax({
    url: url,
    type: "POST",
    dataType: "html", //формат данных
    data: $("#" + ajax_form).serialize(), // Сеарилизуем объект
    success: function (response) {
      //Данные отправлены успешно
      result = $.parseJSON(response);
      // $(".err").html(result.error);
      if (result.res == true) {
        location.reload();
      } else {
        $(".err").html(result.error);
      }
    },
    error: function (response) {
      // Данные не отправлены
      // errorBox.innerHTML = data.error;
      console.log("BAD");
      $("#result_form").html("Ошибка. Данные не отправлены.");
      // $(".err").html(response.error);
    },
  });
}
