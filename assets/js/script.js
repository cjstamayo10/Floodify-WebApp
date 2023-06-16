$(document).ready(function () {
  function loadMessages() {
    $.get("fetch-user-message-management", function (data) {
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
    if (message !== "" && barangay !== "Select Brgy." && user_name !== "") {
      $.post("send-user-message-management", { barangay: barangay, user_name: user_name, message: message }, function () {
        $("#barangay").val("Select Brgy.");
        $("#user_name").val("");
        $("#message").val("");
        loadMessages();
      });
    }
  });
  setInterval(loadMessages, 1000);
});