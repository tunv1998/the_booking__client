$(document).ready(function () {
  // listroom show price
  $(".roomChildPrice").each(function () {
    let roomPrice = $(this);
    $(".priceModal").each(function () {
      let roomPriceModal = $(this);
      if (roomPrice.attr('price') == roomPriceModal.attr('price')) {
        roomPrice.text(roomPriceModal.text());
      }
    })
  })
  // Hiển thị tên file upload
  $('#fileUpload').change(function () {
    var i = $(this).prev('label').clone();
    var file = $('#fileUpload')[0].files[0].name;
    $(this).prev('label').text(file);
  });
  // Create-room-child --> custom policy radio
  $(".radio-policy").click(function () {
    let radioContent = $(this).text();
    let radioGroup = $(this).prev().attr('name');
    $("#choosePolicy").children().each(function (index, value) {
      if ($(this).attr("group") == radioGroup) {
        $(this).remove();
      }
    })
    var newElement = $("<div></div>");
    newElement.addClass("badge badge-primary mr-3 mb-3");
    newElement.text(radioContent);
    newElement.attr("group", radioGroup);
    newElement.attr("style", "font-size: 1rem;");
    $("#choosePolicy").append(newElement);
  });
  // validate ngày tháng
  $('.from-date').change(function () {
    const parent = $(this).parent();
    if ($(this).val() != 0) {
      let input = $(this).val();
      let count = parent.next().children().last();
      let show = parent.next().next().children().last();
      var now = moment(input, 'YYYY-MM-DD').add(count.val(), 'days').locale('vi').format('LL');
      show.val(now);
      const minNext = parent.parent().next().next().children().children().eq(3);
      const fdDate = parent.next().next().children().last().val();
      let dayProcess = moment(fdDate, "DD-MM-YYYY").format("YYYY-MM-DD")
      if (typeof (minNext.attr('min')) != "undefined") {
        minNext.attr("min", moment(dayProcess, "YYYY-MM-DD").format('YYYY-MM-DD'));
        minNext.val(moment(dayProcess, "YYYY-MM-DD").add(1, 'days').format('YYYY-MM-DD'));

      }

    }
    else {
    }
  });
  $('.count_date').keyup(function () {
    const parent = $(this).parent();
    const date = parent.prev().children().last();
    if (date.val() != 0) {
      let input = date.val();
      let count = $(this).val();
      let show = parent.next().children().last();
      var now = moment(input, 'YYYY-MM-DD').add(count, 'days').locale('vi').format('LL');
      show.val(now);
      const rowTiep = parent.parent().next().next().children().children().eq(3);
      const getDate = parent.next().children().last().val();
      let dayProcess = moment(getDate, "DD-MM-YYYY").format("YYYY-MM-DD")
      if (typeof (rowTiep.attr('min')) != "undefined") {
        rowTiep.attr("min", moment(dayProcess, "YYYY-MM-DD").format('YYYY-MM-DD'));
        rowTiep.val(moment(dayProcess, "YYYY-MM-DD").add(1, 'days').format('YYYY-MM-DD'));
      }

    }
    else {
    }
  });
  $(".createNewDate").click(function () {
    const block = $("#price-0").clone(true, true);
    const count = $('#setPrice .row').length
    $('<hr>').appendTo("#setPrice");
    block.attr('id', 'price-' + count);
    const min = block.children().next().children().next().first();
    block.children().children().eq(1).val("");
    block.children().children().eq(5).val("0");
    block.children().children().eq(7).val("");
    block.children().children().eq(9).val("");
    block.appendTo('#setPrice');
    const getMin = block.prev().prev().children().last().prev().children().last().val();
    let dayProcess = moment(getMin, "DD-MM-YYYY").format("YYYY-MM-DD")
    if (getMin.length != 0 || typeof (getMin) != "undefined") {
      min.attr("min", moment(dayProcess, "YYYY-MM-DD").format('YYYY-MM-DD'));
      min.val(moment(dayProcess, "YYYY-MM-DD").add(1, 'days').format('YYYY-MM-DD'));
    }
  });
  // 
  $("#delCreate").click(function () {
    if ($(this).parent().parent().attr("id") !== "price-0") {
      $(this).parent().parent().prev().remove();
      $(this).parent().parent().remove();
    }
    else {

    }
  });
  // Hành động khi đóng modal bootstrap
  $('#chooseImage').on('hidden.bs.modal', function (e) {
    $("#saveToColl").remove();
    $(".image-gallery").prop('checked', false)
  })
  // custom upload
  $(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    let name = fileName.substring(0, 20);
    $(this).siblings(".custom-file-label").addClass("selected").html("Đã chọn");
  });
  // Preview file image
  $('#fileUpload').change(function (event) {
    const uploadFile = event.target.files;
    let flag = true;
    let typeArr = ['jpg', 'jpeg', 'png'];
    $.each(uploadFile, function (index, value) {
      let extendFile = value.type.substring(value.type.lastIndexOf('/') + 1, value.type.length);
      if (!typeArr.includes(extendFile) || value.size > 200000) {
        flag = false;
        alert('File được chọn phải là file ảnh và kích thước < 200 KB');
        $('#fileUpload').val('');
      }
    })
    if (flag && $(this).attr("class") == "custom-file-input userAvatar") {
      userPreviewImg(uploadFile[0]);
    }
    else if (flag) {
      $('#uploadFile').show();
      $(".preUpload").children().remove();
      // Fill Hotel Name
      $("#hotelName").val($("#galListHotel option:selected").text());
      $.each(uploadFile, function (index, value) {
        previewFileImage(uploadFile[index]);
      })
    }
  })
  // package
  $("#addMonthPack").keyup(function () {
    let currentVal = $(this).val();
    let packPrice = parseFloat($("#packPrice").val());
    const currentDateTo = moment($("#packDateTo").val(), "YYYY-MM-DD");
    let newDateTo = currentDateTo.add(currentVal, "M").format('YYYY-MM-DD');
    if (currentVal >= 0) {
      $("#newDateTo").val(newDateTo);
      $("#needPrice").text(new Intl.NumberFormat().format(packPrice * currentVal) + "đ");
    }
  })
  // Up package
  $("#upPackMonth").keyup(function () {
    let val = $(this).val();
    let price = $("#selectPack option:selected").attr("p-val");
    if (val > 0 && val.length > 0) {
      $("#needPay").val(val * price + "đ");
    }
    else {
      $("#needPay").val(0);
    }
  })
  $("#selectPack").change(function () {
    $("#upPackMonth").val(0);
    $("#needPay").val(0);
  })
  // 
  $(".roomTypeImg").on('click', function () {
    let src = $(this).attr('src');
    if (src.length != 0) {
      $(".roomTypeImg").each(function () {
        if ($(this).css("opacity") == 0.6) {
          $(this).css("opacity", 1)
        }
      })
      $(this).css('opacity', 0.6);
      let loca = $(this).parent().parent().parent().prev().prev().children();
      loca.attr('src', src);
    }
  })
  // Add header color
  $(".header-room-type").each(function (index) {
    $(this).css("background-color", "#f8f9fa");
  })
  // Add atl img
  $("img").each(function () {
    $(this).attr('alt', "Ảnh")
  })
  // 
  // function
  function previewFileImage(file) {
    const reader = new FileReader();
    reader.onload = function (event) {
      let src = event.target.result;
      let img = "<img alt='Ảnh' class='img-responsive mw-100 mb-3 mr-3' src='" + src + "' style='width: 120px;height: 100px'><img>";
      $(".preUpload").append(img);
    }
    reader.readAsDataURL(file);
  }
  function userPreviewImg(file) {
    $("#userImg").children().remove();
    const reader = new FileReader();
    reader.onload = function (event) {
      let src = event.target.result;
      let img = "<img class='img-responsive mw-100' src='" + src + "'><img>";
      $("#userImg").append(img);
    }
    reader.readAsDataURL(file);
  }
})