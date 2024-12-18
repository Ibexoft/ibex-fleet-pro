function deleteAdminConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
$(".adminSwitch1").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});

$(".driverStatusChange").click(function () {
  var element = $(this);
  var id = $(this).attr("id");
  if ($(this).prop("checked") == true) {
    var status = 1;
  } else if ($(this).prop("checked") == false) {
    var status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      } else {
        let p = document.createElement("p");
        p.classList.add("alert");
        p.classList.add("alert-danger");
        p.innerHTML = obj1.message;
        let a = document.createElement("a");
        a.href = "#";
        a.classList.add("close");
        a.setAttribute("data-dismiss", "alert");
        a.setAttribute("aria-label", "close");
        a.innerHTML = "&times;";
        p.appendChild(a);
        document.getElementById("error").appendChild(p);
        element.prop("checked", !element.prop("checked"));
      }
    },
  });
});

function deleteDriverConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", resp.message, "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
function deleteVehicleConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", resp.message, "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
$(".vehicleSwitch1").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});
function deleteMaintenanceConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
$(".maintenanceSwitch1").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});
function deleteInsuranceConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
$(".insuranceSwitch1").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});
function deleteWorkShopConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
$(".workshopSwitch1").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});
function deletebookingConfirmation(id, url) {
  swal
    .fire({
      title: "Cancel Booking?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, Cancel it!",
      cancelButtonText: "No!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", "Booking has been cancelled.", "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}

$(".bookingStatusChange").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});

function deleteRoles(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}

$(".roleStatus").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});

$(".userSwitch1").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});

function deleteUserConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
$(".fineStatusChange").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});

function deleteFineConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}

$(".returnActualData").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});
function deleteIncompanyConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", resp.message, "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
$(".trackingStatus").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});
function deleteMaintenanceTypeConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
function deleteWorkshopTypeConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
$(".adminSwitch1").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      obj1 = JSON.parse(data);
      if (obj1.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(obj1.message);
        window.location.reload();
      }
    },
  });
});
$(".WTSwitch").click(function () {
  if ($(this).prop("checked") == true) {
    var id = $(this).attr("id");
    status = 1;
  } else if ($(this).prop("checked") == false) {
    var id = $(this).attr("id");
    status = 0;
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST",
    url: $(this).attr("data-url"),
    data: {
      id: id,
      status: status,
    },
    success: function (data) {
      if (data.success == 1) {
        $(".successAlert").css("display", "block");
        $(".successMessage").html(data.message);
        window.location.reload();
      }
    },
  });
});
function deleteTrackingConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}
function deletecontractConfirmation(id, url) {
  swal
    .fire({
      title: "Delete?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: url,
            data: { id: id },
            success: function (resp) {
              if (resp.success) {
                swal.fire("Done!", resp.message, "success");
                window.location.reload();
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            },
            error: function (resp) {
              swal.fire("Error!", "Something went wrong.", "error");
            },
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}

function toggleAllRoles() {
  let checkboxes = document.getElementsByClassName("custom-control-input");
  let toggleBtn = document.getElementById("toggle-btn");
  for (let checkbox of checkboxes) {
    toggleBtn.checked ? (checkbox.checked = true) : (checkbox.checked = false);
  }
}

function changeButtonTextAndLink(text, link) {
  var btn = document.getElementById("datatable-button");
  btn.innerHTML = text;
  btn.href = link;
}

function returnNowConfirmation(url) {
  swal
    .fire({
      title: "Return?",
      icon: "question",
      text: "Please ensure and then confirm!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes, return it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#cc3333",
    })
    .then(
      function (e) {
        if (e.value === true) {
          window.location.href = url;
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}

$(".clickable-row").click(function (e) {
  if ($(e.target).is("td, th") && $(e.target).children().length === 0) {
    window.location = $(this).data("href");
  }
});

function isDomainOnly(url) {
  const urlObject = new URL(url);
  return urlObject.pathname === "/dashboard" && urlObject.search === "";
}

const currentURL = window.location.href;

if (isDomainOnly(currentURL)) {
  var salesGraphChartCanvas = $("#line-chart").get(0).getContext("2d");

  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    type: "POST",
    url: "/booking-graph",
    success: function (resp) {
      if (resp.success) {
        var labels = resp.labels;
        var data = resp.data;
        var salesGraphChartData = {
          labels: labels,
          datasets: [
            {
              label: "Bookings",
              fill: false,
              borderWidth: 2,
              lineTension: 0,
              spanGaps: true,
              borderColor: "#cc3333",
              pointRadius: 3,
              pointHoverRadius: 7,
              pointColor: "#cc3333",
              pointBackgroundColor: "#cc3333",
              data: data,
            },
          ],
        };

        var salesGraphChartOptions = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false,
          },
          scales: {
            xAxes: [
              {
                ticks: {
                  fontColor: "#cc3333",
                },
                gridLines: {
                  display: false,
                  color: "#cc3333",
                  drawBorder: false,
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  stepSize: 1,
                  fontColor: "#5d5252",
                },
                gridLines: {
                  display: true,
                  color: "#eee",
                  drawBorder: false,
                },
              },
            ],
          },
        };

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesGraphChart = new Chart(salesGraphChartCanvas, {
          // lgtm[js/unused-local-variable]
          type: "line",
          data: salesGraphChartData,
          options: salesGraphChartOptions,
        });
      }
    },
  });
}
function goBack() {
  // Your logic here if needed
  window.history.back();
}

function removeImage(btn) {
  btn.parentNode.previousElementSibling.value = 1;
  btn.parentNode.remove();
}

function getVehicleOwner(id) {
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    type: "POST",
    // I want url to be vehilce-owner intead of maintenance/get-vehicle-owner
    url: "/get-vehicle-owner",
    data: {
      id: id,
    },
    success: function (resp) {
      if (resp.success) {
        $("#paid_by").val(
          resp.owner.c_first_name + (resp.owner.c_last_name ? " " + resp.owner.c_last_name : "")
        );
        $("#paid_by_id").val(resp.owner.customer_id);
      }
    },
  });
}

function addMaintenance() {
  let area = document.getElementById("maintenance-area");
  let counter = document.querySelectorAll(".maintenance-types").length;
  let div = document.createElement("div");
  div.classList.add("maintenance-types");
  div.classList.add("mt-3");
  let new_div = document.createElement("div");
  let row = document.createElement("div");
  row.classList.add("row");
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    type: "POST",
    url: "/settings/get-maintenance-types",
    success: function (resp) {
      content = ` 
            <div class="col-md-6">
              <div class="form-group">
                  <label>Maintenance Type<span aria-hidden="true"
                      class="required">*</span></label>
                <select required id="maintenance_type[]" name="maintenance_type[]"
                    class="form-control">
                    option value="">Select Type</option>
                    ${resp.maintenance_types.map(
        (type) =>
          `<option value="${type.maintenance_type_id}">${type.maintenance_type_name}</option>`
      )}
                </select>
              </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Labour time taken in minutes<span aria-hidden="true"
                            class="required">*</span></label>
                    <input type="number" step="any" required class="form-control"
                        id="labour_time[]" name="labour_time[]"
                        placeholder="Labour time taken in minutes">
                </div>
            </div>
            <div class="col-md-1 d-flex justify-content-end align-items-center">
                <i class="fa fa-minus-circle fa-2x text-primary cursor-pointer"
                    onclick="removeMaintenance(this)" aria-hidden="true"></i>
            </div>`;

      row.innerHTML = content;
      new_div.innerHTML = `
                      <div id="maintenance-item-area">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Parts used<span aria-hidden="true"
                                            class="required">*</span></label>
                                    <input type="text" required name="m_part_used[${counter}][]"
                                        id="m_part_used[]" class="form-control"
                                        placeholder="Part #">
                                </div>
                            </div>
                            <div class="col-md-2"> 
                                <div class="form-group">
                                    <label>RRP ($)<span aria-hidden="true"
                                            class="required">*</span></label>
                                    <input type="number" step="0.01" required
                                        class="form-control" id="m_rrp[]" name="m_rrp[${counter}][]"
                                        placeholder="RRP ($)">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Qty<span aria-hidden="true"
                                            class="required">*</span></label>
                                    <input type="number" step="any" required
                                        class="form-control" id="m_qty[]" name="m_qty[${counter}][]"
                                        placeholder="Qty">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Invoice<span aria-hidden="true"
                                            class="required">*</span></label>
                                    <input type="number" step="0.01" required
                                        class="form-control" readonly id="m_invoice[]"
                                        placeholder="Invoice">
                                </div>
                            </div>
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <i class="fa fa-minus-circle text-primary cursor-pointer"
                                    onclick="removeMaintenanceItem(this)" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right invoice-border">
                            <button type="button" class="btn btn-primary my-3"
                                id="add-maintenance-item" onclick="addMaintenanceItem(this)">Add
                                Maintenance Item</button>
                        </div>
                    </div>
      `;
      div.appendChild(row);
      div.appendChild(new_div);
      area.appendChild(div);
      addMaintenanceEventListeners();
    },
  });
}

function addMaintenanceItem(btn) {
  let area = btn.parentNode.parentNode.previousElementSibling;
  let counter = document.querySelectorAll(".maintenance-types").length - 1;
  let div = document.createElement("div");
  div.classList.add("row");
  content = ` 
          <div class="col-md-4">
            <div class="form-group">
                <label>Parts used<span aria-hidden="true"
                        class="required">*</span></label>
                <input type="text" required id="m_part_used[]" name="m_part_used[${counter}][]"
                    class="form-control" placeholder="Part #">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
                <label>RRP ($)<span aria-hidden="true"
                        class="required">*</span></label>
                <input type="number" step="0.01" required class="form-control"
                    id="m_rrp[]" name="m_rrp[${counter}][]" placeholder="RRP ($)">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
                <label>Qty<span aria-hidden="true" class="required">*</span></label>
                <input type="number" step="any" required class="form-control"
                    id="m_qty[]" name="m_qty[${counter}][]" placeholder="Qty">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Invoice<span aria-hidden="true"
                        class="required">*</span></label>
                <input type="number" step="0.01" required class="form-control"
                    readonly id="m_invoice[]" placeholder="Invoice">
            </div>
          </div>
          <div class="col-md-1 d-flex justify-content-center align-items-center">
            <i class="fa fa-minus-circle text-primary cursor-pointer" onclick="removeMaintenanceItem(this)"
                aria-hidden="true"></i>
          </div>`;
  div.innerHTML = content;
  area.appendChild(div);
  addMaintenanceEventListeners();
}

function removeMaintenanceItem(btn) {
  let area = document.getElementById("maintenance-item-area");
  let maintenanceItems = area.childElementCount;

  if (maintenanceItems <= 1) {
    swal.fire("Error!", "At least one maintenance item is required.", "error");
  } else {
    btn.parentNode.parentNode.remove();
  }
  reIndexMaintenance();
}

function removeMaintenance(btn) {
  let maintenance_types = document.querySelectorAll(".maintenance-types");
  if (maintenance_types.length > 1) {
    btn.parentNode.parentNode.parentNode.remove();
  } else {
    swal.fire("Error!", "At least one maintenance type is required.", "error");
  }
  reIndexMaintenance();
  calculateMaintenanceCost();
}

function calculateMaintenanceCost() {
  let labourTotal = 0;
  let inputs = document.querySelectorAll('input[name="labour_time[]"]');
  for (let i = 0; i < inputs.length; i++) {
    if (inputs[i].value) {
      labourTotal += parseFloat(inputs[i].value);
    }
  }
  let partsTotal = 0;
  let m_invoice = document.querySelectorAll('input[id="m_invoice[]"]');
  for (let i = 0; i < m_invoice.length; i++) {
    if (m_invoice[i].value) {
      partsTotal += parseFloat(m_invoice[i].value);
    }
  }
  let total = ((labourTotal / 60) * 55 + partsTotal).toFixed(2);

  document.getElementById("total-repair-time").innerHTML = "$" + total;
}

function addMaintenanceEventListeners() {
  let inputs = document.querySelectorAll('input[name="labour_time[]"]');
  for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("input", calculateMaintenanceCost);
  }
  let rrp = document.querySelectorAll('input[id="m_rrp[]"]');
  for (let i = 0; i < rrp.length; i++) {
    rrp[i].addEventListener("input", function () {
      calculateMaintenanceInvoice(this);
    });
  }

  let qty = document.querySelectorAll('input[id="m_qty[]"]');
  for (let i = 0; i < qty.length; i++) {
    qty[i].addEventListener("input", function () {
      calculateMaintenanceInvoice(this);
    });
  }
}

var workshopCounter = -1;

function addWorkshop() {
  let area = document.getElementById("workshop-area");
  let card = document.createElement("div");
  card.classList.add("card");
  card.classList.add("p-3");
  card.classList.add("inverted-box-shadow");
  let div = document.createElement("div");
  let totaldiv = document.createElement("div");
  div.classList.add("workshops");
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    type: "POST",
    url: "/settings/get-workshops",
    success: function (resp) {
      content = ` <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Workshop<span aria-hidden="true"
                            class="required">*</span></label>
                          <select required name="workshop_id[${workshopCounter}]" class="form-control" required>
                            <option value="">Select Workshop</option>
                            ${resp.workshops.map(
        (workshop) =>
          `<option value="${workshop.workshop_id}">${workshop.workshop_name}</option>`
      )}
                        </select>
                    </div>
                </div>
                <div class='col-md-5'>
                    <div class="form-group">
                        <label>Clock On - Clock Off<span aria-hidden="true"
                                class="required">*</span></label>
                            <input type='text' class="form-control datetimes" name="workshop_time[${workshopCounter}]" />
                    </div>
                </div>
                <div class="col-md-1 d-flex justify-content-end align-items-center">
                    <i class="fa fa-minus-circle fa-2x text-primary cursor-pointer" onclick="removeWorkshop(this)"
                        aria-hidden="true"></i>
                </div>
              </div>
              <div id="workshop-item-area">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Parts used<span aria-hidden="true"
                                    class="required">*</span></label>
                            <input type="text" required id="part_used[]"
                                name="part_used[]" class="form-control" placeholder="Part #">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>RRP ($)<span aria-hidden="true"
                                    class="required">*</span></label>
                            <input type="number" step="0.01" required
                                class="form-control" id="rrp[]" name="rrp[]"
                                placeholder="RRP ($)">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Qty<span aria-hidden="true"
                                    class="required">*</span></label>
                            <input type="number" step="any" required
                                class="form-control" id="qty[]" name="qty[]"
                                placeholder="Qty">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Invoice<span aria-hidden="true"
                                    class="required">*</span></label>
                            <input type="number" step="0.01" required
                                class="form-control" readonly id="invoice[]"
                                placeholder="Invoice">
                        </div>
                    </div>
                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                        <i class="fa fa-minus-circle text-primary cursor-pointer"
                            onclick="removeWorkshopItem(this)" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right invoice-border">
                    <button type="button" class="btn btn-primary my-3" id="add-workshop-item"
                    onclick="addWorkshopItem(this)">Add Workshop Item</button>
                </div>
            </div>`;

      div.innerHTML = content;
      totaldiv.innerHTML = `<div class="row">
                              <div class="col-md-12 invoice-border">
                                <div class="d-flex justify-content-start">
                                    <span class="d-flex align-items-center justify-content-center">
                                        <strong> Workshop Invoice: </strong><span id="workshop-invoice[]"
                                            class="mx-1">$0</span>
                                    </span>
                                </div>
                              </div>
                            </div>`;
      card.appendChild(div);
      card.appendChild(totaldiv);
      area.appendChild(card);
      addWorkshopEventListeners();
      reIndexWorkshops();
      workshopCounter++;
    },
  });
}

function addWorkshopItem(btn) {
  let area = btn.parentNode.parentNode.previousElementSibling;
  let counter = document.querySelectorAll(".workshops").length - 1;
  let div = document.createElement("div");
  div.classList.add("row");
  content = ` 
          <div class="col-md-4">
            <div class="form-group">
                <label>Parts used<span aria-hidden="true"
                        class="required">*</span></label>
                <input type="text" required id="part_used[]" name="part_used[${counter}][]"
                    class="form-control" placeholder="Part #">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
                <label>RRP ($)<span aria-hidden="true"
                        class="required">*</span></label>
                <input type="number" step="0.01" required class="form-control"
                    id="rrp[]" name="rrp[${counter}][]" placeholder="RRP ($)">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
                <label>Qty<span aria-hidden="true" class="required">*</span></label>
                <input type="number" step="any" required class="form-control"
                    id="qty[]" name="qty[${counter}][]" placeholder="Qty">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Invoice<span aria-hidden="true"
                        class="required">*</span></label>
                <input type="number" step="0.01" required class="form-control"
                    readonly id="invoice[]" placeholder="Invoice">
            </div>
          </div>
          <div class="col-md-1 d-flex justify-content-center align-items-center">
            <i class="fa fa-minus-circle text-primary cursor-pointer" onclick="removeWorkshopItem(this)"
                aria-hidden="true"></i>
          </div>`;
  div.innerHTML = content;
  area.appendChild(div);
  addWorkshopEventListeners();
}

function removeWorkshopItem(btn) {
  let area = document.getElementById("workshop-item-area");
  let workshopItems = area.childElementCount;

  if (workshopItems <= 1) {
    swal.fire("Error!", "At least one workshop item is required.", "error");
  } else {
    btn.parentNode.parentNode.remove();
  }
}

function removeWorkshop(btn) {
  let area = document.getElementById("workshop-area");
  let workshopCards = area.childElementCount;

  if (workshopCards <= 1) {
    swal.fire("Error!", "At least one workshop is required.", "error");
  } else {
    btn.parentNode.parentNode.parentNode.parentNode.remove();
    reIndexWorkshops();
  }
}

function calculateTotalInvoice() {
  let total = 0;
  let invoices = document.querySelectorAll('input[id="invoice[]"]');
  for (let i = 0; i < invoices.length; i++) {
    if (invoices[i].value) {
      total += parseFloat(invoices[i].value);
    }
  }
  document.getElementById("all-workshops-total").innerHTML = "$" + total;
}

function calculateWorkshopInvoice(element) {
  let parentElement = element.parentNode.parentNode.parentNode;
  let total = 0;
  let invoices = parentElement.querySelectorAll('input[id="invoice[]"]');
  for (let i = 0; i < invoices.length; i++) {
    if (invoices[i].value) {
      total += parseFloat(invoices[i].value);
    }
  }
  parentElement.querySelector('span[id="workshop-invoice[]"]').innerHTML =
    "$" + total;
  calculateTotalInvoice();
}

function calculateInvoice(input) {
  let parentElement = input.parentNode.parentNode.parentNode;
  let rrp = parentElement.querySelector('input[id="rrp[]"]').value;
  let qty = parentElement.querySelector('input[id="qty[]"]').value;
  let invoice = parentElement.querySelector('input[id="invoice[]"]');
  invoice.value = rrp * qty;
  calculateWorkshopInvoice(parentElement);
}

function calculateMaintenanceInvoice(input) {
  let parentElement = input.parentNode.parentNode.parentNode;
  let rrp = parentElement.querySelector('input[id="m_rrp[]"]').value;
  let qty = parentElement.querySelector('input[id="m_qty[]"]').value;
  let invoice = parentElement.querySelector('input[id="m_invoice[]"]');
  invoice.value = rrp * qty;
  calculateMaintenanceCost();
}

function addWorkshopEventListeners() {
  let rrp = document.querySelectorAll('input[id="rrp[]"]');
  for (let i = 0; i < rrp.length; i++) {
    rrp[i].addEventListener("input", function () {
      calculateInvoice(this);
    });
  }

  let qty = document.querySelectorAll('input[id="qty[]"]');
  for (let i = 0; i < qty.length; i++) {
    qty[i].addEventListener("input", function () {
      calculateInvoice(this);
    });
  }
  $("input.datetimes:not(.initialized)").each(function () {
    var $this = $(this); // Cache the current jQuery object for efficiency
    var dataValue = $this.data("value"); // Read the data-value attribute
    var dates = dataValue ? dataValue.split(" - ") : [];
    var startDate =
      dates.length === 2
        ? moment(dates[0], "YYYY-MM-DD HH:mm:ss")
        : moment().startOf("hour");
    var endDate =
      dates.length === 2
        ? moment(dates[1], "YYYY-MM-DD HH:mm:ss")
        : moment().startOf("hour").add(32, "hour");

    // Now that we have the start and end dates in moment objects, initialize the daterangepicker
    $this
      .daterangepicker({
        timePicker: true,
        startDate: startDate,
        endDate: endDate,
        locale: {
          format: "DD-MM-YYYY hh:mm A", // The display format in the input
        },
      })
      .addClass("initialized");
  });
}

function reIndexMaintenance() {
  let maintenances = document.querySelectorAll(".maintenance-types");
  maintenances.forEach((maintenance, index) => {
    maintenance.querySelector(
      'id^="m_part_used["'
    ).name = `m_part_used[${index}][]`;
    maintenance.querySelector('id^="m_rrp["').name = `m_rrp[${index}][]`;
    maintenance.querySelector('id^="m_qty["').name = `m_qty[${index}][]`;
  });
}

function reIndexWorkshops() {
  // Find all workshop elements
  const workshops = document.querySelectorAll(".workshops");
  // Iterate through each workshop
  workshops.forEach((workshop, index) => {
    // Update workshop related inputs
    workshop.setAttribute("id", `${index}`);
    workshop.querySelector(
      '[name^="workshop_id["]'
    ).name = `workshop_id[${index}]`;
    workshop.querySelector(
      '[name^="workshop_time["]'
    ).name = `workshop_time[${index}]`;

    // Update parts related inputs within each workshop
    const parts = workshop.querySelectorAll('[name^="part_used["]');
    parts.forEach((part) => {
      part.name = `part_used[${index}][]`;
    });

    const rrps = workshop.querySelectorAll('[name^="rrp["]');
    rrps.forEach((rrp) => {
      rrp.name = `rrp[${index}][]`;
    });

    const qtys = workshop.querySelectorAll('[name^="qty["]');
    qtys.forEach((qty) => {
      qty.name = `qty[${index}][]`;
    });
  });

  workshopCounter = workshops.length;
}

function availabilityCheck(booking_id) {
  let startingDate = $("#starting_date").val();
  let endingDate = $("#ending_date").val();
  if (startingDate && endingDate) {
    let formData = new FormData();
    formData.append("starting_date", startingDate);
    formData.append("ending_date", endingDate);
    if (booking_id) {
      formData.append("booking_id", booking_id);
    }
    formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
    $.ajax({
      url: "/booking-availability",
      type: "POST",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.success) {
          var vehicle_select = document.getElementById("vehicle_reg_id");
          let vehicle_value = vehicle_select.value;
          var driver_select = document.getElementById("driver_id");
          let driver_value = driver_select.value;
          vehicle_select.innerHTML = `<option value="">Select Vehicle</option>`;
          driver_select.innerHTML = `<option value="">Select Driver</option>`;
          for (const vehicleId in data.vehicles) {
            if (data.vehicles.hasOwnProperty(vehicleId)) {
              const vehicle = data.vehicles[vehicleId];
              vehicle_select.innerHTML += `<option value="${vehicle.vehicle_id
                }" ${vehicle.vehicle_id == vehicle_value ? "selected" : ""}>${vehicle.vehicle_registration_no
                }</option>`;
            }
          }
          for (const driverId in data.drivers) {
            if (data.drivers.hasOwnProperty(driverId)) {
              const driver = data.drivers[driverId];
              driver_select.innerHTML += `<option value="${driver.driver_id}" ${driver.driver_id == driver_value ? "selected" : ""}>${driver.first_name ? driver.first_name : ""} ${driver.last_name}</option>`;
            }
          }
        } else {
          swal.fire("Error", data.message, "error");
        }
      },
    });
  }
}
function changeInputName(name) {
  if (name === "passport_image") {
    document.getElementById("radio-span").innerHTML = "Passport";
  } else {
    document.getElementById("radio-span").innerHTML = "Medicare";
  }
  removeDocImage(
    "passport_img_name",
    "passportPreviewImage",
    "passport-remove-container",
    "passport_image"
  );
}

function ServiceKMCheck(input) {
  var odo_meter = parseFloat($("#odo_meter").val());
  var next_service = parseFloat($("#next_service").val());

  if (!isNaN(odo_meter) && !isNaN(next_service)) {
    if (odo_meter >= next_service) {
      if (input.id === "odo_meter") {
        $("#odo_meter").val("");
        $("#odo-meter-error").removeClass("d-none");
      } else {
        $("#next_service").val("");
        $("#next-service-error").removeClass("d-none");
      }
    } else {
      $("#odo-meter-error").addClass("d-none");
      $("#next-service-error").addClass("d-none");
    }
  }
}
function EntityType() {
  var entityInfo = document.getElementById("entity_info");
  var selectedValue = $("#entity_type_select").find(":selected").val();
  if (selectedValue == "Trust") {
    $('#field-container').removeClass("d-none");
    entityInfo.textContent = "Trust Info";

    // hide fields
    $(".showACN").css("display", "none");
    $(".f_name").css("display", "none");
    $(".l_name").css("display", "none");
    $(".c_name").css("display", "none");
    $(".company_name").css("display", "none");
    $(".showContactPerson").css("display", "none");
    $(".dob").css("display", "none");
    $(".showACN").css("display", "none");

    // show fields
    $(".trustee_names").css("display", "block");
    $(".trust_name").css("display", "block");
    $(".trustee_names").css("display", "block");
    $(".showCRN").css("display", "block");
    $(".showABN").css("display", "block");

    // remover required attribute
    $("#crn").prop("required", "");
    $("#f_name").prop("required", "");
    $("#l_name").prop("required", "");
    $("#date_of_birth").prop("required", "");
    $("#company_name").prop("required", "");
    $("#company_contact_person").prop("required", "");
    $("#acn").prop("required", "");

    // remover required attribute
    $("#trust_name").prop("required", "true");
    $("#trustee_contact_person").prop("required", "true");
    // add disabled attribute
    $("#select_none").prop("disabled", "true");
    var trustee_label = $("#trustee_label")
    var value = $("#trustee_label").text();
    if (value === "Individual") {
      $("#trustee_company").val("");
      $("#trustee_company").prop("required", "");
      $("#trustee_company_div").css("display", "none");
    } else {
      $("#trustee_company").prop("required", true);
      $("#trustee_company_div").css("display", "block");
    }
  } else if (selectedValue == "Individual") {
    $('#field-container').removeClass("d-none");
    entityInfo.textContent = "Personal Info";

    // hide fields
    $(".showACN").css("display", "none");
    $(".showABN").css("display", "none");
    $(".c_name").css("display", "none");
    $(".company_name").css("display", "none");
    $(".trust_name").css("display", "none");
    $(".trustee_names").css("display", "none");
    $(".dob").css("display", "none");

    // show fields
    $(".showContactPerson").css("display", "block");
    $(".showCRN").css("display", "block");
    $(".f_name").css("display", "block");
    $(".l_name").css("display", "block");
    $(".dob").css("display", "block");

    // remover required attribute
    $("#acn").prop("required", "");
    $("#crn").prop("required", "");
    $("#contact_person").prop("required", "");
    $("#company_name").prop("required", "");
    $("#company_contact_person").prop("required", "");
    $("#trust_name").prop("required", "");
    $("#abn").prop("required", "");
    $("#trustee_contact_person").prop("required", "");
    $("#trustee_company").prop("required", "");

    // remover required attribute
    $("#f_name").prop("required", "true");
    $("#l_name").prop("required", "true");
    $("#date_of_birth").prop("required", "true");

    // add disabled attribute
    $("#select_none").prop("disabled", "true");
  } else if (selectedValue == "Company") {
    $('#field-container').removeClass("d-none");
    entityInfo.textContent = "Company Info";

    // hide fields
    $(".showContactPerson").css("display", "none");
    $(".trust_name").css("display", "none");
    $(".trustee_names").css("display", "none");
    $(".f_name").css("display", "none");
    $(".l_name").css("display", "none");
    $(".dob").css("display", "none");

    // show fields
    $(".showCRN").css("display", "block");
    $(".showACN").css("display", "block");
    $(".showABN").css("display", "block");
    $(".c_name").css("display", "block");
    $(".company_name").css("display", "block");

    // remover required attribute
    $("#trust_name").prop("required", "");
    $("#trustee_contact_person").prop("required", "");
    $("#f_name").prop("required", "");
    $("#l_name").prop("required", "");
    $("#date_of_birth").prop("required", "");

    // remover required attribute
    $("#company_name").prop("required", "true");
    $("#company_contact_person").prop("required", "true");
    $("#crn").prop("required", "true");
    $("#acn").prop("required", "true");
    $("#abn").prop("required", "true");


    $("#trustee_contact_person").prop("required", "");
    $("#trustee_company").prop("required", "");

    // add disabled attribute
    $("#select_none").prop("disabled", "true");
  } else {
    $('#field-container').addClass("d-none");
  }
}

function PopulateContactPerson(value) {
  var trustee_label = $("#trustee_label");
  if (value === "Individual") {
    url = "/settings/get-owners";
    trustee_label.text("Individual");
    $("#trustee_company").val("");
    $("#trustee_company").prop("required", "");
    $("#trustee_company_div").css("display", "none");
  } else {
    url = "/settings/get-companies";
    trustee_label.text("Company Contact Person");
    $("#trustee_company").prop("required", true);
    $("#trustee_company_div").css("display", "block");
  }
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: url,
    cache: false,
    contentType: false,
    processData: false,
    method: "POST",
    success: function (data) {

      if (value === "Individual") {
        var select = $("#trustee_contact_person");
        var selectedId = select.data("id");
        select.empty();
        select.append('<option value="">Select Individual</option>');
      } else {
        var select = $("#trustee_company");
        var selectedId = select.data("id");
        select.empty();
        select.append('<option value="">Select Company</option>');
        var new_select = $("#trustee_contact_person");
        new_select.find("option").each(function () {
          if ($(this).val() === "") {
            $(this).text("Select Contact Person");
          }
        });
      }
      $.each(data.owners, function (index, item) {
        select.append(
          '<option value="' +
          item.customer_id +
          '" ' +
          (item.customer_id == selectedId ? "selected" : "") +
          ">" +
          item.c_first_name +
          (item.c_last_name ? " " + item.c_last_name : "") +
          "</option>"
        );
      });
      EntityType();
    },
  });

}

const content = document.getElementById('comment_content');
const toggleButton = document.getElementById('toggleButton');
const caretIcon = document.getElementById('caret_icon');
let isExpanded = false;

// Function to check if the content overflows and show the toggle button if needed
function checkOverflow() {
  if (!content) {
    return false;
  }
  if (content.scrollHeight > content.clientHeight) {
    toggleButton.style.display = 'block'; // Show the toggle button
  } else {
    toggleButton.style.display = 'none'; // Hide the toggle button
  }
}

// Function to toggle the 'rotate' class
function toggleRotateClass() {
  caretIcon.classList.toggle('rotate');
}

// Initially check overflow
if (content) {
  checkOverflow();
}

toggleButton?.addEventListener('click', function () {
  if (content.style.height > '60px') {
    toggleButton.style.display = 'block'
  }
  if (isExpanded) {
    content.style.maxHeight = '100px'; // Adjust the max height as needed
    content.style.display = '-webkit-box';
    toggleButton.innerHTML = 'Show More <i class="fas fa-caret-down"></i>';
    toggleRotateClass();
  } else {
    content.style.maxHeight = '100%'; // Remove max height to show all content
    content.style.display = 'block';
    toggleButton.innerHTML = 'Show Less <i class="fas fa-caret-up"></i>';
    toggleRotateClass();
  }
  isExpanded = !isExpanded;
});

// Event listener for window resize to recheck overflow
window.addEventListener('resize', checkOverflow);

function disableSelectFirstOption(selectElement) {
  var firstOption = selectElement.options[0];
  firstOption.disabled = true;
  firstOption.removeAttribute('selected');
}

function fetchOwners(type, url, id) {
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: url,
    data: {
      type: type,
      id: id,
    },
    method: "POST",
    success: function (data) {
      var select = $("#vehicle_owner");
      select.removeAttr("disabled");
      var selectedId = select.data("id");
      select.empty();
      if (id == undefined) {
        select.append('<option value="">Select Vehicle Owner</option>');
      } else {
        select.append('<option value="" disabled>Select Vehicle Owner</option>');
      }
      $.each(data.owners, function (index, item) {
        select.append(
          '<option value="' +
          item.customer_id +
          '" ' +
          (item.customer_id == selectedId ? "selected" : "") +
          ">" +
          item.c_first_name +
          (item.c_last_name ? " " + item.c_last_name : "") +
          (type == "Trust" ? " ( " +
            (item.get_company != null ? 'C-' + item.get_company.c_first_name :
              'I-' + item.contact_person.c_first_name +
              (item.contact_person.c_last_name ? ' ' + item.contact_person.c_last_name : "")) +
            " )"
            : "") +
          "</option>"
        );
      });
    },
  });
}
document.addEventListener("DOMContentLoaded", function () {
  const body = document.getElementById('main-body');
  const content = document.getElementById('content-wrapper');
  const button = document.querySelector('[data-widget="pushmenu"]');
  const sidebar = document.getElementById('main-sidebar');

  if (window.innerWidth >= 992 && window.innerWidth <= 1140) {
    body.classList.add('sidebar-collapse')

    button.addEventListener('click', function () {
      body.classList.toggle('sidebar-collapse');
    });

    body.addEventListener('click', function () {
      body.classList.add('sidebar-collapse');
    });
  }
});


function showModalOnFormSubmit(pdfPlaceholder, a, b, c, d) {
  $('#booking-form').on('submit', function (event) {
    event.preventDefault();

    // Collect form data
    const startingDate = $('#starting_date').val();
    const endingDate = $('#ending_date').val();
    const vehicleText = $('#vehicle_reg_id option:selected').text();
    const driverText = $('#driver_id option:selected').text();
    const amount = $('#amount').val();
    const comments = $('#comments').val();
    const bondHeld = $('select[name="bond_held"] option:selected').text() == 'Bond Held By' ? 'N/A' : $('select[name="bond_held"] option:selected').text();
    const bondAmount = ($('#bond_amount').val() == 0 || $('#bond_amount').val() == '') ? 'N/A' : $('#bond_amount').val();

    // Collect file inputs
    const contractImage = $('#contract_image')[0].files[0];
    const ezidebitImage = $('#ezidebit_image')[0].files[0];
    const insuranceDeclarationImage = $('#insurance_declaration_image')[0].files[0];
    const handoverChecklistImage = $('#handover_checklist_image')[0].files[0];

    const contractImageChanged = $('#changed_contract_image').val();
    const ezidebitImageChanged = $('#changed_ezidebit_image').val();
    const insuranceDeclarationImageChanged = $('#changed_insurance_declaration_image').val();
    const handoverChecklistImageChanged = $('#changed_handover_checklist_image').val();

    // Function to create file preview
    const createFilePreview = (file) => {
      if (!file) return '';
      const fileType = file.type.split('/')[0];
      const fileName = file.name;
      if (fileType === 'image') {
        return `<div><img src="${URL.createObjectURL(file)}" class="img-fluid"><small>${fileName}</small></div>`;
      } else {
        return `<div><img src="${pdfPlaceholder}" class="img-fluid"><small>${fileName}</small></div>`;
      }
    };

    const checkFileFormat = (flag, src) => {
      if (!src) return '';
      var fileName = src.split('/').pop();
      // Extract the extension from the file name
      var extension = fileName.split('.').pop();
      if (extension != 'pdf') {
        return `<div><img src="${src}" class="img-fluid"></div>`;
      } else {
        return `<div><img src="${pdfPlaceholder}" class="img-fluid"></div>`;
      }
    }

    // Generate file previews
    const contractPreview = contractImage ? createFilePreview(contractImage) : checkFileFormat(contractImageChanged, a);
    const ezidebitPreview = ezidebitImage ? createFilePreview(ezidebitImage) : checkFileFormat(ezidebitImageChanged, b);
    const insuranceDeclarationPreview = insuranceDeclarationImage ? createFilePreview(insuranceDeclarationImage) : checkFileFormat(insuranceDeclarationImageChanged, c);
    const handoverChecklistPreview = handoverChecklistImage ? createFilePreview(handoverChecklistImage) : checkFileFormat(handoverChecklistImageChanged, d);

    // Populate modal body
    let modalBody = `
    <div class="card">
        <div class="card-header">
            <h4 class="dashboard-title">Booking</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="profile-data">
                        <div class="data-key">Vehicle Registration:</div>
                        <div class="data-value">${vehicleText}</div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="profile-data">
                        <div class="data-key">Start Date:</div>
                        <div class="data-value">${startingDate}</div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="profile-data">
                        <div class="data-key">End Date:</div>
                        <div class="data-value">${endingDate}</div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="profile-data">
                        <div class="data-key">Bond Held By:</div>
                        <div class="data-value">${bondHeld}</div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="profile-data">
                        <div class="data-key">Bond Amount:</div>
                        <div class="data-value">${bondAmount}</div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="profile-data">
                        <div class="data-key">Driver:</div>
                        <div class="data-value">${driverText}</div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="profile-data">
                        <div class="data-key">Weekly Rent:</div>
                        <div class="data-value">${amount}</div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="profile-data">
                        <div class="data-key">Comments:</div>
                        <div class="data-value">
                            <div id="comment_content">
                                ${comments}
                            </div>
                            <button id="toggleButton">
                                Show More
                                <i class="fas fa-caret-down" id="caret_icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
`;

    // Check if there are any document previews
    if (contractPreview || ezidebitPreview || insuranceDeclarationPreview || handoverChecklistPreview) {
      let documentContent = '<div class="card"><div class="card-header"><h4 class="dashboard-title">Documents</h4></div><div class="card-body"><div class="row">';

      if (contractPreview) {
        documentContent += `
            <div class="col-6">
                <p>Contract</p>
                <div class="doc-wrapper confirm-doc-wrapper text-center mb-4">
                    ${contractPreview}
                </div>
            </div>
        `;
      }

      if (ezidebitPreview) {
        documentContent += `
            <div class="col-6">
                <p>EziDebit Form</p>
                <div class="doc-wrapper confirm-doc-wrapper text-center mb-4">
                    ${ezidebitPreview}
                </div>
            </div>
        `;
      }

      if (insuranceDeclarationPreview) {
        documentContent += `
            <div class="col-6">
                <p>Insurance Declaration</p>
                <div class="doc-wrapper confirm-doc-wrapper text-center mb-4">
                    ${insuranceDeclarationPreview}
                </div>
            </div>
        `;
      }

      if (handoverChecklistPreview) {
        documentContent += `
            <div class="col-6">
                <p>Handover Checklist</p>
                <div class="doc-wrapper confirm-doc-wrapper text-center mb-4">
                    ${handoverChecklistPreview}
                </div>
            </div>
        `;
      }

      documentContent += '</div></div></div>';
      modalBody += documentContent;
    }

    $('.modal-body').html(modalBody);

    // Show the modal
    $('#exampleModal').modal('show');
  });
}

function submitFormOnSaveChanges(storeUrl, bookingsUrl) {
  document.getElementById('saveChangesButton').addEventListener('click', function () {
    availabilityCheck();
    $('#booking-form').off('submit').on('submit', function (e) {
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: storeUrl,
        type: 'POST',
        data: formData,
        beforeSend: function () {
          Swal.fire({
            title: 'Please Wait',
            html: 'Processing...',
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            },
            customClass: {
              loader: 'custom-loader'
            }
          });
        },
        success: function (data) {
          if (data.success) {
            window.location.href = bookingsUrl;
          } else {
            Swal.fire("Error", data.message, "error");
          }
        },
        error: function (data) {
          if (data.responseJSON && data.responseJSON.errors) {
            const errors = data.responseJSON.errors;
            let errorMessage = '<ol>';
            for (const key in errors) {
              if (errors.hasOwnProperty(key)) {
                const errorMessages = errors[key];
                errorMessages.forEach(message => {
                  errorMessage += `<li>${message}</li>`;
                });
              }
            }
            errorMessage += '</ol>';
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              html: errorMessage,
            });
          } else {
            Swal.fire("Error", "An error occurred", "error");
          }
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });

    // Manually trigger the form submission
    $('#booking-form').submit();
  });
}


function handleDragOver(event) {
  event.preventDefault();
  event.stopPropagation();
  event.currentTarget.classList.add('dragover');
}

function handleDragLeave(event) {
  event.preventDefault();
  event.stopPropagation();
  event.currentTarget.classList.remove('dragover');
}

function handleDrop(event, imgId) {
  event.preventDefault();
  event.stopPropagation();
  event.currentTarget.classList.remove('dragover');
  const files = event.dataTransfer.files;

  if (files.length) {
    document.getElementById(imgId).files = files;
    const changeEvent = new Event('change');
    document.getElementById(imgId).dispatchEvent(changeEvent);
  }
}


// Comments on booking detail page
function addComment(event, Id, name, url, deleteUrl, type) {
  event.preventDefault();

  // Collect form data
  const comment = $('#comment-input').val();
  $('#comment-input').val('');

  if (comment.trim() == "") {
    return false;
  }

  const commentInput = document.querySelector('.booking-add-comment-input');
  const commentButton = document.querySelector('.booking-add-comment-button');
  commentButton.classList.remove('show');
  commentInput.blur();

  let currentDate = new Date();

  let options = {
    timeZone: 'Australia/Brisbane',
    year: '2-digit',
    month: '2-digit',
    day: '2-digit',
    hour: 'numeric',
    minute: '2-digit',
    hour12: true
  };

  let formattedTime = currentDate.toLocaleString('en-AU', options);

  formattedTime = formattedTime.replace(/\//g, '-');

  formattedTime = formattedTime.replace(',', '').toUpperCase();

  let dataFields;
  if(type == 'booking') {
    dataFields = {
      booking_id: Id
    }
  }
  if(type == 'fine') {
    dataFields = {
      fine_id: Id
    }
  }

  $.ajax({
    url: url,
    type: 'POST',
    data: {
      _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
      comment: comment,
      ...dataFields
    },
    success: function (response) {
      const nameParts = name.trim().split(' ');
      let nameInitials = nameParts[0][0].toUpperCase();
      // Extract the first letter of the last name if it exists
      nameInitials += nameParts.length > 1 ? nameParts[1][0].toUpperCase() : '';

      let updatedDeleteUrl = deleteUrl.replace(':commentId', response.commentId);
      let commentCard = `
          <div id="comment-${response.commentId}" class="my-2">
            <div class="media">
                <div class="img-size-50 mr-3 img-circle bg-danger d-flex justify-content-center align-items-center" style="width: 40px; height: 40px">
                    <span>${nameInitials}</span>
                </div>
                <div class="media-body">
                    <div class="">
                        <div class="d-flex justify-content-between align-items-center">
                                <div class="text-sm">
                                  <span class="mr-2">${name}</span> <br class="d-sm-none"> <span class="text-xs text-muted"><i class="far fa-clock"></i> ${formattedTime}</span>
                                </div>
                                <div class="dropdown">
                                    <button class="action-button" type="button" id="actionsDropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <!-- Three vertical dots icon -->
                                        <i class="fas fa-ellipsis-v fa-xs"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionsDropdown1" style="">
                                        <a class="dropdown-item" href="#" onclick="showEditCommentModal(event,'${response.commentId}', '${Id}'); return false;">Edit</a>
                                        <a class="dropdown-item" href="#" onclick="deleteComment(event, '${response.commentId}', '${Id}', '${updatedDeleteUrl}', '${type}'); return false;">Delete</a>
                                    </div>
                                </div>
                        </div>
                        <p id="comment-${response.commentId}-text" class="pr-3 mt-1"></p>
                    </div>
                </div>
            </div>
          </div>
          `
        ;
      $('#comments').prepend(commentCard);
      $(`#comment-${response.commentId}-text`).text(comment);
    },
    error: function (xhr) {
      swal.fire("Error!", "Something went wrong.", "error");
    }
  });
}

function deleteComment(event, commentId, bookingId, url, type) {
  event.preventDefault(); // Prevent default anchor behavior

  // Send AJAX request to delete comment

  swal
    .fire({
      // title: "?",
      icon: "question",
      text: `Do you want to delete this ${type === 'booking' ? "Comment" : "Note"}?`,
      showCancelButton: !0,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: !0,
      confirmButtonColor: "#dc3545",
    })
    .then(
      function (e) {
        if (e.value === true) {
          $.ajax({
            url: url,
            type: 'DELETE',
            data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
              // Remove the comment from the frontend
              $('#comment-' + commentId).remove();
            },
            error: function (xhr) {
              console.error('Error:', xhr.responseText);
              if (xhr.status === 403) {
                swal.fire("Error!", "Unauthorized. you can not delete this comment", "error");
              } else {
                swal.fire("Error!", "Something went wrong.", "error");
              }
            }
          });
        } else {
          e.dismiss;
        }
      },
      function (dismiss) {
        return false;
      }
    );
}

function showEditCommentModal(event, commentId, bookingId) {
  let url = `/comment/update/${commentId}`
  let commentText = $(`#comment-${commentId}-text`).text();
  let modalBody = `
      <div class="form-group col-12">
              <input type="type" value="${commentText}" id="comment-edit-input"
                  name="comment" class="form-control" placeholder="Type here">
              <input type="hidden" id="edit-url" value="${url}">
              <input type="hidden" id="comment-id" value="${commentId}">
        </div>

    `

  $('.modal-body').html(modalBody);
  // Show the modal
  $('#exampleModal').modal('show');
}

function editComment(event) {
  event.preventDefault();  // Prevent default form submission

  let updatedComment = $('#comment-edit-input').val();
  let commentTextId = $('#comment-id').val();

  let url = $('#edit-url').val();
  $.ajax({
    url: url,
    type: 'POST',
    data: {
      _token: $('meta[name="csrf-token"]').attr('content'),
      comment: updatedComment
    },
    success: function (response) {
      // Update the comment in the frontend
      $(`#comment-${commentTextId}-text`).text(response.comment);
      swal.fire("Done!", response.message, "success")
        .then(
          function (e) {
            $('#exampleModal').modal('hide');
          },
          function (dismiss) {
            return false;
          }
        );
    },
    error: function (xhr) {
      if (xhr.status === 403) {
        swal.fire("Error!", "Unauthorized. you can not edit this comment", "error");
      } else {
        swal.fire("Error!", "Something went wrong.", "error");
      }
      $('#exampleModal').modal('hide');
    }
  });



}


function addCommentButtonToggle() {
  const commentInput = document.querySelector('.booking-add-comment-input');
  const commentButton = document.querySelector('.booking-add-comment-button');

  const handleFocusIn = () => {
    commentButton.classList.add('show');
  };

  const handleFocusOut = (event) => {
    // Check if the newly focused element is neither the input nor the button
    const comment = $('#comment-input').val().trim();
    if (comment !== "") {
      return false;
    }
    if (!commentInput.contains(event.relatedTarget) && !commentButton.contains(event.relatedTarget)) {
      commentButton.classList.remove('show');
    }
  };

  commentInput.addEventListener('focusin', handleFocusIn);
  commentButton.addEventListener('focusin', handleFocusIn);

  commentInput.addEventListener('focusout', handleFocusOut);
  commentButton.addEventListener('focusout', handleFocusOut);
}

// Booking end reminder
$(document).ready(function () {
  const remindLaterBtn = $('#remind-later-btn');
  const reminderAlert = $('#reminderAlert');
  let bookingId = $('#bookingId').val();

  remindLaterBtn.on('click', function () {
    const currentTime = new Date().getTime();
    const remindLaterTime = currentTime + 6 * 60 * 60 * 1000; // remind after 6 hours
    localStorage.setItem(`remindMeLaterTime-${bookingId}`, remindLaterTime);
  });

  function shouldShowReminder() {
    const remindMeLaterTime = localStorage.getItem(`remindMeLaterTime-${bookingId}`);
    const currentTime = new Date().getTime();
    return (!remindMeLaterTime || currentTime >= parseInt(remindMeLaterTime))
  }
  shouldShowReminder() ? reminderAlert.show() : reminderAlert.hide();

  const countdownElement = $('#countdown');
  let remainingTime = $('#remainingTime').val();

  function updateCountdown() {
    if (remainingTime <= 0) {
      localStorage.removeItem(`remindMeLaterTime-${bookingId}`);
      reminderAlert.hide();
      return;
    }

    let hours = Math.floor(remainingTime / 3600);
    let minutes = Math.floor((remainingTime % 3600) / 60);
    let seconds = remainingTime % 60;

    countdownElement.html(`This booking ends in ${hours}h ${minutes}m ${seconds}s`);
    remainingTime--;
  }

  updateCountdown();
  setInterval(updateCountdown, 1000);
});

function parseStringDate(dateStr) {
  // creates date object from format DD-MM-YYYY to YYYY-MM-DD
  var parts = dateStr.split('-');
  return new Date(parts[2], parts[1] - 1, parts[0]);
}


// Select2
function initializeSelect2Dropdown(id, placeholder) {
  $(id).select2({
    placeholder: placeholder,
    allowClear: true,
    sorter: function (data) {
      let selectVehicleOption = data.filter(option => option.id === "");
      let sortedData = data.filter(option => option.id !== "").sort(function (a, b) {
        return a.text.localeCompare(b.text);
      });
      return selectVehicleOption.concat(sortedData);
    }
  });
  $(id).on('select2:open', function (e) {
    $('input.select2-search__field').prop('placeholder', 'Search');
  });
}

function removeSelect2Search(id) {
  $(id).on('select2:open', function (e) {
    $('input.select2-search__field').hide();
  });
}

function toggleCommentField() {
  var selectedStatus = $('#status').val();

  if (selectedStatus === 'Other') {
    $('#comment-field').show();
    $('#comment').attr('required', true);
  } else {
    $('#comment-field').hide();
    $('#comment').removeAttr('required');
    $('#comment').val(null);
  }
}

// toggle Driver First Name field
function toggleDriverFirstNameField(isChecked) {
  const firstNameField = $('#first_name');

  if (isChecked) {
    // Disable the field and remove the "required" attribute
    firstNameField.prop('disabled', true).removeAttr('required');
  } else {
    // Enable the field and add the "required" attribute back
    firstNameField.prop('disabled', false).attr('required', true);
  }
}

function toggleNoticeType() {
  var selectedNoticeType = $('#notice_type').val();

  if(selectedNoticeType === '1'){
    $('#police-state-field').hide();
    $('#council-name-field').hide();
    $('#recovery-company-field').hide();

    $('#police_state').removeAttr('required');
    $('#council_name').removeAttr('required');
    $('#recovery_company').removeAttr('required');

    $('#police_state').val(null);
    $('#council_name').val(null);
    $('#recovery_company').val(null);
  }

  if (selectedNoticeType === '2') {
    $('#police-state-field').show();
    $('#police_state').attr('required', true);

    // Hide other fields and remove required attribute
    $('#council-name-field').hide();
    $('#council_name').removeAttr('required');
    $('#council_name').val(null);

    $('#recovery-company-field').hide();
    $('#recovery_company').removeAttr('required');
    $('#recovery_company').val(null);
  }

  if (selectedNoticeType === '3') {
    $('#council-name-field').show();
    $('#council_name').attr('required', true);

    // Hide other fields and remove required attribute
    $('#police-state-field').hide();
    $('#police_state').removeAttr('required');
    $('#police_state').val(null);

    $('#recovery-company-field').hide();
    $('#recovery_company').removeAttr('required');
    $('#recovery_company').val(null);
  }

  if (selectedNoticeType === '4') {
    $('#recovery-company-field').show();
    $('#recovery_company').attr('required', true);

    // Hide other fields and remove required attribute
    $('#police-state-field').hide();
    $('#police_state').removeAttr('required');
    $('#police_state').val(null);

    $('#council-name-field').hide();
    $('#council_name').removeAttr('required');
    $('#council_name').val(null);
  }

}


// Booking Extend Functionality

// check for valid end date (i.e cannot be before the current end date)
function endDateValidation(bookingId) {
  let currEndingDate = $('#curr-ending-date').val();
  let endingDateInput = $("#ending_date").val();
  // formatting the dates
  let currEndDateParts = currEndingDate.split('-');
  let endDateParts = endingDateInput.split('-');
  
  let currEndDate = new Date(currEndDateParts[2], currEndDateParts[1] - 1, currEndDateParts[0]);
  let endDate = new Date(endDateParts[2], endDateParts[1] - 1, endDateParts[0]);
  // Check if end date is before the current ending date
  if (endDate < currEndDate) {
      $('#error-message').text("The end date must be a date after or equal to current ending date");
      $('button[type="submit"]').prop('disabled', true);
      return false;
  }

  // If dates are valid
  $('#error-message').text("");
  $('button[type="submit"]').prop('disabled', false);
  checkExtendAvailability(bookingId);
  return true;
}

// checking for vehicle availability from the available vehicles
function isVehicleAvailable(vehicles, vehicleId) {
  for (const key in vehicles) {
      if (vehicles.hasOwnProperty(key)) {
          const vehicle = vehicles[key];

          if (vehicle.vehicle_id == vehicleId) {
              return true;
          }
      }
  }
  return false;
}

// checking for driver availability from the available drivers
function isDriverAvailable(drivers, driverId) {
  for (const key in drivers) {
      if (drivers.hasOwnProperty(key)) {
          const driver = drivers[key];

          if (driver.driver_id == driverId) {
              return true;
          }
      }
  }
  return false;
}

// Checking if booking can be extended to the dates provided
function checkExtendAvailability(bookingId) {
  const currEndingDate = "{{ date('d-m-Y', strtotime($booking->end_date)) }}"
  let startingDate = $('#starting_date').val();
  const endingDate = $("#ending_date").val();
  if (currEndingDate === endingDate) { // if date is not changed, do not check availability
      return;
  }
  if (startingDate && endingDate) {
      let formData = new FormData();
      formData.append("starting_date", startingDate);
      formData.append("ending_date", endingDate);
      formData.append("booking_id", bookingId);
      formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
      $('#error-message').text("");
      $.ajax({
          url: "/booking-availability",
          type: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: function(data) {
              if (data.success) {
                  driverId = $('#driver_id').val();
                  vehicleId = $('#vehicle_reg_id').val();
                  if (data.isActive == 0) {
                      $('#error-message').text("You are currently in-active");
                      $('button[type="submit"]').prop('disabled', true);
                      return;
                  }
                  if (!isDriverAvailable(data.drivers, driverId)) {
                      const conflictingBookingId = data.conflictingBooking.booking_id;
                      $('#error-message').html(   
                        `The Driver already has a booking on these dates. <a href='/booking/${conflictingBookingId}' target='_blank' style='color: gray; text-decoration: underline;'>View booking</a> <br>`
                      );
                      $('button[type="submit"]').prop('disabled', true);
                  }
                  if (!isVehicleAvailable(data.vehicles, vehicleId)) {
                      $('#error-message').html(
                          $('#error-message').html() +
                          "The vehicle isn't available at the dates you've selected."
                      );
                      $('button[type="submit"]').prop('disabled', true);
                      return
                  }
                  return
              } else {
                  swal.fire("Error", data.message, "error");
              }
          },
      });
  }
}

// This extends the booking by calling /extend route
function extendBooking(event, bookingId) {
  event.preventDefault();
  const newEndDate = $('#ending_date').val();

  if (newEndDate === "{{ date('d-m-Y', strtotime($booking->end_date)) }}") { // when date is not changed
      $('#extendbookingmodal').modal('hide');
      return;
  }

  $.ajax({
      url: `/booking/${bookingId}/extend`,
      type: 'POST',
      data: {
          new_ending_date: newEndDate,
          _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token here
      },
      success: function(response) {
          console.log(response.message);
          if (response.success) {
              swal.fire('Done', response.message, 'success')
                  .then(function(e) {
                      $('#extendbookingmodal').modal('hide');
                      window.location.reload();
                  })
          } else {
              swal.fire('Error!', response.message, 'error')
                  .then(function(e) {
                      $('#extendbookingmodal').modal('hide');
                  })
          }
      },
      error: function(xhr, status, error) {
          Swal.fire('Error!', 'An error occurred while extending your booking. Please try again.',
              'error')
      }
  });
}

// Booking Extend Functionality