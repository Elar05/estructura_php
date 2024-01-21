$(document).ready(function () {
  let websocket = new WebSocket("ws://localhost:8080");

  websocket.onopen = () => {
    console.log("Connection established");
  };

  websocket.onmessage = (e) => {
    let data = JSON.parse(e.data);

    const { userSender, message, userResponder } = data;

    if ($("#userSender").val() === userSender) {
      appendMessage(message);
    }

    if ($("#userResponder").val() === userResponder) {
      appendMessage(message, "");
    }
  };

  websocket.onclose = () => {
    console.log("Connection Closed!");
  };

  // Listar mensajes del chat activo
  $(document).on("click", ".chat-user", function () {
    $(".chat-user").removeClass("active");
    $(this).addClass("active");

    $("#userChatActive").text($(this).data("name"));
    $("#userChatActiveStatus").text($(this).data("status"));

    let userResponder = $(this).data("id");
    $("#userResponder").val(userResponder);

    // Consultar historial
    $.ajax({
      type: "post",
      url: "chat/getHistory",
      data: { userResponder },
      dataType: "json",
      success: function (response) {
        if ("chats" in response) {
          response.chats.forEach((chat) => {
            let clase =
              chat.user_sender_id === userResponder ? "" : "admin_chat";
            appendMessage(chat.message, clase);
          });

          scrollToLastMessage();
        }
      },
    });

    $("#chat-content").removeClass("d-none");
    $("#chat-messages").empty();
  });

  // Envair mensaje
  $("#send-message").click(function () {
    let message = $("#text-message").val(),
      userResponder = $("#userResponder").val(),
      userSender = $("#userSender").val();

    if (message === "") {
      swal({
        title: "Escribe gil",
        text: "",
        type: "error",
      });
      return;
    }

    websocket.send(JSON.stringify({ userSender, message, userResponder }));
    $("#text-message").val("");
  });

  function appendMessage(message, clase = "admin_chat") {
    $("#chat-messages").append(`
      <li class="chat-item clearfix ${clase} mb-3">
        <div class="chat-body clearfix mr-3">
          <p class="mb-1">${message}</p>
          <div class="chat_time">00:00</div>
        </div>
      </li>
    `);
    scrollToLastMessage();
  }

  function scrollToLastMessage() {
    let chatMessages = document.getElementById("chat-messages");

    // Obtener el último elemento li dentro del ul
    let ultimoMensaje = chatMessages.lastElementChild;

    if (ultimoMensaje) {
      // Hacer scroll hacia el último elemento
      ultimoMensaje.scrollIntoView();
    }
  }
});
