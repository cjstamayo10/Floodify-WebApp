$(document).ready(function () {
  function loadMessages() {
    $.get("fetch-message-management", function (data) {
      $("#messages").html(data);
      $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
      var latestMessage = $("#messages .message:last");
      if (latestMessage.length) {
        var offset = latestMessage.offset().top - $("#chatbox").offset().top;
        $("#chatbox").scrollTop($("#chatbox").scrollTop() + offset);
      }
    });
  }
  loadMessages();
  $("#send").click(function () {
    var barangay = $("#barangay").val();
    var user_name = $("#user_name").val();
    var message = $("#message").val();
    if (message !== "") {
      $.post(
        "send-message-management",
        { barangay: barangay, user_name: user_name, message: message },
        function () {
          $("#barangay").val("Malabon");
          $("#user_name").val("MDRRMO Admin");
          $("#message").val("");
          loadMessages();
        }
      );
    } 
  });
  $("#clear-all").click(function () {
    $.post("clear-message-management", function () {
      $("#messages").html("");
    });
  });
  setInterval(loadMessages, 1000);
});
