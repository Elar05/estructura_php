// Consultar los permisos del tipo de usuario y checkear los inputs
// Poner el id del tipo de usuario en el input hidden
$(document).on("click", "button.permissions", function () {
  $(".actionCheck").prop("checked", false);

  let typeUserId = $(this).data("id");
  $("#typeUserId").val(typeUserId);

  $.post(
    "typeuser/getPermissions",
    { typeUserId },
    function (data, textStatus, jqXHR) {
      if ("permissions" in data) {
        const { permissions } = data;
        if (permissions.length > 0) {
          let actions = $(".actionCheck");
          for (let i = 0; i < actions.length; i++) {
            const checkboxValue = Number(actions[i].value);
            if (permissions.includes(checkboxValue)) {
              actions[i].checked = true;
            }
          }
        }
      } else {
        console.log(data.error);
      }
    },
    "json"
  );
});

// Agregar o quitar el permiso del tipo de usuario
$(document).on("click", ".actionCheck", function () {
  let actionId = $(this).val(),
    typeUserId = $("#typeUserId").val();
  $.post(
    "typeuser/storePermission",
    {
      actionId,
      typeUserId,
    },
    function (data, textStatus, jqXHR) {
      if ("success" in data) {
        swal({
          title: data.success,
          text: "",
          type: "success",
        });
      } else {
        swal({
          title: data.error,
          text: "",
          type: "error",
        });
      }
    },
    "json"
  );
});
