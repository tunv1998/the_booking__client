$(document).ready(function () {
    // Show quận huyện
    $("#city_name").change(function () {
        let provinceId = $(this).find(":selected").val();
        $.ajax({
            url: "./?ctrl=ajax&act=GetOneDistrict",
            method: "POST",
            data: { 'id': provinceId },
            dataType: "JSON",
            success: function (data) {
                $('#district_name').children().remove();
                $('#ward_name').children().remove();
                data.forEach(function (element, index) {
                    $('#district_name').append("<option value='" + element.id + "'>" + element._prefix + " " + element._name + "</option>");
                });
            },
            error(error) {
                console.log(eval(error));
            }
        })

    });
    // Show phường xã
    $("#district_name").change(function () {
        let districtId = $(this).find(":selected").val();
        $.ajax({
            url: "./?ctrl=ajax&act=GetOneWard",
            method: "POST",
            data: { id: districtId },
            dataType: "JSON",
            success: function (data) {
                $('#ward_name').children().remove();
                data.forEach(function (element, index) {
                    $('#ward_name').append("<option value='" + element.id + "'>" + element._prefix + " " + element._name + "</option>");
                });
            },
            error(error) {
                console.log(eval(error));
            }
        })
    });
    //  Thay đổi status khách sạn
    $(".changeHotelStatus").click(function (event) {
        event.preventDefault();
        let confirm = prompt("Nhập YES để xác nhận xóa:");
        let id = $(this).attr('hid');
        if (confirm === "YES") {
            $.ajax({
                url: "./?ctrl=hotel&act=changeStatus&param=hotel" + id,
                method: "GET",
                data: {},
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        alert("Xóa thành công");

                    }
                    else {
                        alert("Xóa thất bại");
                    }
                    location.reload();
                },
                error(error) {
                    console.log(eval(error));
                }
            })
        }
        else {
            alert("Hủy bỏ yêu cầu");
        }
    });
    //  Thay đổi trạng thái phòng
    $(".changeRoomStatus").click(function (event) {
        event.preventDefault();
        let confirm = prompt("Nhập YES để xác nhận xóa:");
        let id = $(this).attr('rid');
        if (confirm === "YES") {
            $.ajax({
                url: "./?ctrl=hotel&act=changeStatus&param=room" + id,
                method: "GET",
                data: {},
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        alert("Xóa thành công");

                    }
                    else {
                        alert("Xóa thất bại");
                    }
                    location.reload();
                },
                error(error) {
                    console.log(eval(error));
                }
            })
        }
        else {
            alert("Hủy bỏ yêu cầu");
        }
    });
    //  Thay đổi trạng thái phòng con
    $(".changeRoomChildStatus").click(function (event) {
        event.preventDefault();
        let confirm = prompt("Nhập YES để xác nhận xóa:");
        let id = $(this).attr('rcid');
        if (confirm === "YES") {
            $.ajax({
                url: "./?ctrl=hotel&act=changeStatus&param=roomchild" + id,
                method: "GET",
                data: {},
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        alert("Xóa thành công");

                    }
                    else {
                        alert("Xóa thất bại");
                    }
                    location.reload();
                },
                error(error) {
                    console.log(eval(error));
                }
            })
        }
        else {
            alert("Hủy bỏ yêu cầu");
        }
    });
    // Thêm loại phòng con
    $("#createRoomChild").click(function (event) {
        event.preventDefault();
        const policyVal = $(".policy input[type='radio']:checked");
        const priceVal = $(".setPrice");
        const pathUrl = $(location).attr('search');
        let name = $("#room-name").val();
        let policy = [];
        let price = [];
        let flag = true;
        let parentId = pathUrl.substr(pathUrl.lastIndexOf("=") + 1, pathUrl.length);
        if(name.length == 0){
            flag == false;
            alert("Tên không được để trống");
        }
        policyVal.each(function (index, value) {
            policy.push($(this).val());
        })
        priceVal.each(function (index, value) {
            let startDate = $(this).children().first().next().children().last().val();
            let endDate = $(this).children().last().prev().children().last().val();
            let priceVal = $(this).children().last().children().last().val();
            price.push([startDate, moment(endDate, "DD-MM-YYYY").format("YYYY-MM-DD"), priceVal]);
        })
        $.each(price, function (index, value) {
            for (let index = 0; index < value.length; index++) {
                const element = value[index];
                if (element == "") {
                    flag = false;
                    alert("Phải nhập giá tiền của phòng");
                }
            }
        })
        if(policy.length == 0){
            alert("Chính sách không thể để trống");
        }
        if (flag) {
            $.ajax({
                url: "./?ctrl=Ajax&act=createRoomChild&param=" + parentId,
                method: "POST",
                data: {
                    'name': name,
                    'policy': policy,
                    'price': price
                },
                success: function (data) {
                    if (data == 0) {
                        alert("Thêm thành công");
                    }
                    else {
                        alert("Thêm thất bại, vui lòng kiểm tra dữ liệu");
                    }
                    window.history.back();
                },
                error(error) {
                    console.log(eval(error));
                }
            })
        }
        else {
            // alert("Dữ liệu rỗng");
        }
    })
    // 
    $(".delRate").click(function () {
        const mark = $(this).parent().parent();
        if ($(this).parent().parent().attr("id") !== "price-0") {
            let confirm = prompt("Nhập 'YES' để xác nhận xóa:");
            if (confirm === "YES") {
                let id = $(this).next().val();
                if (id.length == 0) {
                    $(this).parent().parent().prev().remove();
                    $(this).parent().parent().remove();
                }
                else {
                    const pathUrl = $(location).attr('search');
                    let parentId = pathUrl.substr(pathUrl.lastIndexOf("=") + 1, pathUrl.length);
                    $.ajax({
                        url: "./?ctrl=Ajax&act=deleteRateOneRoomChild&param=" + parentId,
                        method: "POST",
                        data: { 'id': id },
                        success: function (data) {
                            if (data == 0) {
                                mark.prev().remove();
                                mark.remove();
                                alert("Xóa thành công");
                            }
                            else {
                                alert("Xóa thất bại");
                            }
                        },
                        error(error) {
                            console.log(eval(error));
                        }
                    });
                }
            }
            else {
            }
        }
        else {

        }
    });
    // Lấy policy id hiện tại ở edit_room_child
    var oldPolicy = [];
    var oldPrice = [];
    $("#choosePolicy").children().each(function (index, value) {
        if (typeof ($(this).attr('pid')) !== "undefined") {
            oldPolicy.push($(this).attr("pid"));
        }
    })
    // 
    $(".setPrice").each(function (index, value) {
        let startDate = $(this).children().children().eq(3).val();
        let endDate = $(this).children().children().eq(7).val();
        let rate = $(this).children().children().eq(9).val();
        let rateId = $(this).children().children().eq(1).val();
        oldPrice.push([rateId, startDate, moment(endDate, "DD-MM-YYYY").format("YYYY-MM-DD"), rate]);
    })
    // 
    $("#editRoomChild").click(function () {
        let name = $("#room-name").val();
        var policy = [];
        let updatePrice = [];
        let insertPrice = [];
        const pathUrl = $(location).attr('search');
        let parentId = pathUrl.substr(pathUrl.lastIndexOf("=") + 1, pathUrl.length);
        $("#choosePolicy").children().each(function (index, value) {
            if (typeof ($(this).attr('pid')) !== "undefined") {
                policy.push($(this).attr("pid"));
            }
        });
        $(".policy input[type='radio']:checked").each(function (index, value) {
            if (policy.includes($(this).val())) {
            }
            else {
                policy.push($(this).val());
            }
        });
        if (JSON.stringify(policy.sort()) == JSON.stringify(oldPolicy.sort())) {
            policy = [];
        }
        $(".setPrice").each(function (index, value) {
            let startDate = $(this).children().children().eq(3).val();
            let endDate = $(this).children().children().eq(7).val();
            let rate = $(this).children().children().eq(9).val();
            let rateId = $(this).children().children().eq(1).val();
            updatePrice.push([rateId, startDate, moment(endDate, "DD-MM-YYYY").format("YYYY-MM-DD"), rate]);
        })
        if (JSON.stringify(updatePrice) == JSON.stringify(oldPrice)) {
            updatePrice = [];
        }
        $.each(updatePrice, function (index, value) {
            if (value[0] === "") {
                insertPrice.push(value);
                delete (updatePrice[index]);
            }
            else {

            }
        })
        let roomPolicyId = $("#policyId").val().split("-");
        $.ajax({
            url: "./?ctrl=Ajax&act=editRoomChild&param=" + parentId,
            method: "POST",
            data: {
                'name': name,
                'policy': policy,
                'update_price': updatePrice,
                'insert_price': insertPrice,
                'room_policy_id': roomPolicyId,
            },
            success: function (data) {
                if (data == 0) {
                    alert('Cập nhật thành công');
                }
                else {
                    alert('Cập nhật thất bại');
                }
                location.reload();
            },
            error(error) {
                console.log(eval(error));
            }
        });
    });
    // 
    $("#listHotel").change(function () {
        let hotelName = $("#listHotel option:selected").text();
        let hotelId = $(this).val();
        $('.choose-image-modal').children().children().remove();
        $('.hotel-image-active').children().remove();
        $('.room-image').children().remove();
        $('#chooseRoom').children().remove();
        $.ajax({
            url: "./?ctrl=Ajax&act=getAllImageByHotelName",
            method: "POST",
            data: {
                'hotelName': hotelName,
                'hotelId': hotelId,
            },
            dataType: "JSON",
            success: function (data) {
                if (data != -1) {
                    let option = '<option value="" selected>Chọn phòng</option>';
                    $("#chooseRoom").append(option);
                    $.each(data, function (index, value) {
                        if (index == "allImage") {
                            // $('.choose-image-modal').children().append(value);
                        }
                        else if (index == "listRoom") {
                            $("#chooseRoom").append(value);
                        }
                        else if (index == "hotelActive") {
                            $(".hotel-image-active").append(value);
                        }
                        else {

                        }
                    })
                }
                else {
                    alert("Không tìm thấy hình ảnh");
                }
                $('#saveChangeHotel').remove();
                $('.delButton').show();

            },
            error(error) {
                console.log(eval(error));
            }
        });
    });
    $("#chooseRoom").change(function () {
        $(".room-image").children().remove();
        let roomId = $(this).val();
        let hotelName = $("#listHotel option:selected").text();
        $.ajax({
            url: "./?ctrl=Ajax&act=getRoomImage",
            method: "POST",
            data: {
                'roomId': roomId,
                'hotelName': hotelName,
            },
            success: function (data) {
                $('#saveChangeHotel').remove();
                $('.delButton').show();
                if (data != -1) {
                    $(".room-image").append(data);
                }
                else {
                    alert('Dữ liệu trống');
                }
            },
            error(error) {
                console.log(eval(error));
            }
        })
    });
    $('#delHotelImage').click(function () {
        const saveAction = $("#hotelButton").append('<button class="btn btn-primary" id="saveChangeHotel">Lưu</button>');
        saveAction.children().last().click(function () {
            let arr = {};
            $(".hotelName").each(function () {
                if ($(this).prop('checked')) {
                    let id = $(this).val();
                    let value = $(this).prev().attr('src');
                    arr[id] = value;
                    $(this).prop('checked', false)
                }
            })
            let confirm = prompt("Bạn chắc chắn muốn xóa ảnh này, vui lòng nhấn: 'YES'");
            if (confirm === "YES") {
                if (arr.length != 0) {
                    $.ajax({
                        url: "./?ctrl=Ajax&act=delHotelImg",
                        method: "POST",
                        data: {
                            'data': arr,
                        },
                        success: function (data) {
                            if (data == 1) {
                                alert("Cập nhật thành công");
                            }
                            else {

                            }
                        },
                        error(error) {
                            console.log(eval(error));
                        }
                    })
                }
                else {
                    alert('Vui lòng chọn hình ảnh');
                }
            }
            else {
                alert('Hủy xóa');
            }
            $(this).hide();
            $(this).remove();
            $('#delHotelImage').show();
            $(".hotelName").hide();
        })
        $(".hotelName").show();
        $(this).hide();
    });
    $('#delRoomImage').click(function () {
        const saveAction = $("#roomButton").append('<button class="btn btn-primary" id="saveChangeHotel">Lưu</button>');
        saveAction.children().last().click(function () {
            let arr = [];
            $(".roomName").each(function () {
                if ($(this).prop('checked')) {
                    let id = $(this).val();
                    let value = $(this).prev().attr('src');
                    arr[id] = value;
                }
            })
            $(".roomName").prop('checked', false)
            let confirm = prompt("Bạn chắc chắn muốn xóa ảnh này, vui lòng nhấn: 'YES'");
            if (confirm === "YES") {
                if (arr.length != 0) {
                    $.ajax({
                        url: "./?ctrl=Ajax&act=delRoomImg",
                        method: "POST",
                        data: {
                            'data': arr,
                        },
                        success: function (data) {
                            if (data == 1) {
                                alert("Cập nhật thành công");
                            }
                            else {

                            }
                        },
                        error(error) {
                            console.log(eval(error));
                        }
                    })
                }
                else {
                    alert('Vui lòng chọn hình ảnh');
                }
            }
            else {
                alert('Hủy xóa');
            }
            $(this).hide();
            $(this).remove();
            $('#delRoomImage').show();
            $(".roomName").hide();
        })
        $(".roomName").show();
        $(this).hide();
    });
    // 
    $('.hotelChoose').click(function () {
        let ele = "<button type='button' class='btn btn-primary hotelAddToColl' id='saveToColl'>Thêm</button>";
        const nbutton = $('.modal-footer').append(ele);
        $('.choose-image-modal').children().children().remove();
        if (getHotelImageModal()) {
            $('.hotelAddToColl').click(function () {
                let arr = [];
                $('.image-gallery').each(function () {
                    if ($(this).prop('checked')) {
                        let value = $(this).val();
                        arr.push(value);
                    }
                })
                $(".image-gallery").prop('checked', false)
                let confirm = prompt("Bạn chắc chắn muốn thêm ảnh này vào khách sạn, vui lòng nhấn: 'YES'");
                if (confirm === "YES") {
                    let hotelId = $("#listHotel").val();
                    if (arr.length != 0) {
                        $.ajax({
                            url: "./?ctrl=Ajax&act=addImageToHotel",
                            method: "POST",
                            data: {
                                'data': arr,
                                'hotelId': hotelId,
                            },
                            success: function (data) {
                                if (data == 1) {
                                    alert("Cập nhật thành công");
                                }
                                else {

                                }
                                console.log(data);
                            },
                            error(error) {
                                console.log(eval(error));
                            }
                        })
                    }
                    else {
                        alert('Vui lòng chọn hình ảnh');
                    }
                }
                else {
                    alert('Hủy');
                }
            });
        }
        else {

        }
    })
    // 
    $('.roomChoose').click(function () {
        let ele = "<button type= 'button' class='btn btn-primary roomAddToColl' id='saveToColl'>Thêm</button>";
        $('.modal-footer').append(ele);
        let hotelName = $("#listHotel option:selected").text();
        let hotelId = $("#listHotel option:selected").val();
        let roomId = $("#chooseRoom").val();
        $('.choose-image-modal').children().children().remove();
        // 
        if (getRoomImageModal() == 1) {
            // 
            $('.roomAddToColl').click(function () {
                let arr = [];
                $('.image-gallery').each(function () {
                    if ($(this).prop('checked')) {
                        let value = $(this).val();
                        arr.push(value);
                    }
                })
                $(".image-gallery").prop('checked', false);
                let confirm = prompt("Bạn chắc chắn muốn thêm ảnh này vào phòng, vui lòng nhấn: 'YES'");
                if (confirm === "YES") {
                    if (arr.length != 0) {
                        $.ajax({
                            url: "./?ctrl=Ajax&act=addImageToRoom",
                            method: "POST",
                            data: {
                                'data': arr,
                                'hotelId': hotelId,
                                'roomId': roomId,
                            },
                            success: function (data) {
                                if (data == 1) {
                                    alert("Cập nhật thành công");
                                }
                                else {

                                }
                            },
                            error(error) {
                                console.log(eval(error));
                            }
                        })
                    }
                    else {
                        alert('Vui lòng chọn hình ảnh');
                    }
                }
                else {

                }
            });
        }
        else {
            alert("Lỗi ajax");
        }

    })
    // 
    $('#delHotelImageFolder').click(function () {
        const saveAction = $("#hotelButton").append('<button class="btn btn-primary" id="delFImage">Lưu</button>');
        saveAction.children().last().click(function () {
            let arr = [];
            $(".galHotelImage").each(function () {
                if ($(this).prop('checked')) {
                    let value = $(this).prev().attr('src');
                    arr.push(value);
                    $(this).prop('checked', false)
                }
            })
            let confirm = prompt("Bạn chắc chắn muốn xóa ảnh này, vui lòng nhấn: 'YES'");
            if (confirm === "YES") {
                if (arr.length != 0) {
                    $.ajax({
                        url: "./?ctrl=Ajax&act=delHotelImgInFolder",
                        method: "POST",
                        data: {
                            'data': arr,
                        },
                        success: function (data) {
                            if (data == 1) {
                                alert("Cập nhật thành công");
                                getAllImageInFolder();
                            }
                            else {

                            }
                        },
                        error(error) {
                            console.log(eval(error));
                        }
                    })
                }
                else {
                    alert('Vui lòng chọn hình ảnh');
                }
            }
            else {
                alert('Hủy xóa');
            }
            $(this).hide();
            $(this).remove();
            $('#delHotelImageFolder').show();
            $(".galHotelImage").hide();
        })
        $(".galHotelImage").show();
        $(this).hide();
    });
    $('#galListHotel').change(function () {
        let hotelName = $("#galListHotel option:selected").text();
        $(".hotelName").val(hotelName);
        getAllImageInFolder();
    });
    // Booking Detail

    // Edit userinfor
    $("#editUserInfo").on("click", function () {
        $(this).hide();
        $("#saveUserInfo").show();
        $("#outEdit").show();
        $("#fullname,#email,#phoneNumber").prop("disabled", false);
    })
    $("#outEdit").on("click", function () {
        $("#saveUserInfo").hide();
        $(this).hide();
        $("#editUserInfo").show();
        $("#fullname,#email,#phoneNumber").prop("disabled", true);
    })
    // Save user infor
    $("#saveUserInfo").on("click", function () {
        var data = [];
        let name = $("#fullname").val();
        let email = $("#email").val();
        let phone = $("#phoneNumber").val();
        let id = $("#idUser").val();
        let userName = $("#username").val();
        if (name.length == 0 || email.length == 0 || phone.length == 0 || id.length == 0 || userName.length == 0) {
            alert("Dữ liệu rỗng");
        }
        else {
            data = [id, userName, name, email, phone];
        }

        $.ajax({
            url: "./?ctrl=Ajax&act=changeUserInfo",
            method: "POST",
            data: {
                'data': data,
            },
            success: function (data) {
                if (data != -1) {
                    alert("Cập nhật thành công");
                }
                else {
                    alert("Dữ liệu không đổi");
                }
                $("#saveUserInfo").hide();
                $("#editUserInfo").show();
                $("#outEdit").hide();
                $("#fullname,#email,#phoneNumber").prop("disabled", true);
            },
            error(error) {
                console.log(eval(error));
            }
        })
    })
    // 
    $("#fileUpload").on("click", function () {
        $("#uploadConfirm").show();
        $("#uploadConfirm").on("click", function () {
            let files = $("#fileUpload").prop('files')[0];
            let file_data = new FormData();
            file_data.append('file', files);
            if (typeof (files) === "undefined") {
                alert("File rỗng");
            }
            else {
                $.ajax({
                    url: "./?ctrl=ajax&act=uploadProviderAvatar",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: file_data,
                    success: function (data) {
                        if (data != -1) {
                            alert("Cập nhật thành công");
                        }
                        else {
                            alert("Upload thất bại");
                        }
                    },
                    error(error) {
                        console.log(eval(error));
                    }
                })
            }
        })
    })
    // Gia hạn gói
    $("#packageExtend").on('click', function () {
        let dateFrom = $("#packDateFrom").val();
        let dateTo = $("#newDateTo").val();
        let month = $("#addMonthPack").val();
        let packId = $("#packId").val();
        let packHId = $("#packHId").val();
        let price = $("#packPrice").val();
        let confirm = prompt("Nhấn 'YES' để xác nhận");
        if (confirm === 'YES') {
            if (month.length == 0 || month <= 0) {
                alert("Số tháng gia hạn phải > 0");
            }
            else {
                $.ajax({
                    url: "./?ctrl=ajax&act=packExtend",
                    method: "POST",
                    data: {
                        'data': {
                            'packId': packId,
                            'packHId': packHId,
                            'price': price,
                            'month': month,
                            'dateFrom': dateFrom,
                            'dateTo': dateTo
                        }
                    },
                    success: function (data) {
                        if (data != -1) {
                            alert("Gia hạn thành công");
                        }
                        else {
                            alert("Gia hạn thất bạis");
                        }
                        window.location.reload();
                    },
                    error(error) {
                        console.log(eval(error));
                    }
                })
            }
        }

    })
    // Nâng cấp gói 
    $("#upPackage").on("click", function () {
        let level = $("#currentLevel").val();
        let id = $("#selectPack").val();
        let month = $("#upPackMonth").val();
        let currentDay = moment().format("YYYY-MM-DD");
        let dateTo = moment(currentDay).add(month, "M").format("YYYY-MM-DD");
        let packHId = $("#packHId").val();
        let price = $("#selectPack option:selected").attr("p-val");
        let confirm = prompt("Nhấn 'YES' để xác nhận:");
        if (confirm === 'YES') {
            $.ajax({
                url: "./?ctrl=ajax&act=isAllowUpPackage",
                method: "POST",
                data: {
                    'data': {
                        'level': level,
                        'id': id,
                        'upPack': {
                            'packId': id,
                            'packHId': packHId,
                            'price': price,
                            'month': month,
                            'dateFrom': currentDay,
                            'dateTo': dateTo
                        }
                    }
                },
                success: function (data) {
                    console.log(data);
                    if (data != -1) {
                        alert("Cập nhật thành công");
                        window.location.reload();
                    }
                    else {
                        alert("Bạn vừa chọn gói thấp hơn gói hiện tại");
                    }

                },
                error(error) {
                    console.log(eval(error));
                }
            })
        }
    })
    //
    // facilities
    // Get hotel facilities
    $("#facilitiesSelectHotel").change(function () {
        let hotelId = $(this).val();
        hotelId == "" ? hotelId = 0 : hotelId;
        $(".facilities").prop("checked", false);
        $("#changeHotelFacilities").show();
        $.ajax({
            url: "./?ctrl=ajax&act=getHotelFacilitiesById",
            method: "POST",
            dataType: "JSON",
            data: {
                'data': {
                    'id': hotelId
                }
            },
            success: function (data) {
                if (data != -1) {
                    $(".facilities").each(function () {
                        let thisBig = $(this);
                        $.each(data, function (index, value) {
                            if (thisBig.attr("f-id") == value.f_id) {
                                thisBig.val(value.hfd_id);
                                thisBig.prop("checked", true);
                            }
                        })
                    })
                }
            },
            error(error) {
                console.log(eval(error));
            }
        })
        // 
        $.ajax({
            url: "./?ctrl=ajax&act=getListRoom",
            method: "POST",
            dataType: "JSON",
            data: {
                'data': {
                    'id': hotelId
                }
            },
            success: function (data) {
                $("#SelectRoomFacilities").children().remove();
                $("#SelectRoomFacilities").append("<option value=''>Chọn loại phòng</option>");
                $.each(data, function (index, value) {
                    $("#SelectRoomFacilities").append("<option value='" + value.r_id + "'>" + value.r_name + "</option>");
                })
            },
            error(error) {
                console.log(eval(error));
            }
        })
    })
    // facilities user click
    $(".facilities, .room-facilities").on("click", function () {
        if ($(this).prop("checked")) {
            $(this).attr("act", 0);
        }
        else {
            $(this).attr("act", 1);
        }
    })
    // Change Hotel Facilities
    $("#changeHotelFacilities").click(function () {
        let confirm = prompt("Nhấn 'YES' để xác nhận lưu");
        let update = [];
        let addNew = [];
        let hotelId = $("#facilitiesSelectHotel").val();
        if (confirm === "YES") {
            $(".facilities").each(function () {
                if ($(this).val().length != 0 && $(this).attr("act") == 1) {
                    update.push($(this).val());
                }
                if ($(this).val() === "" && $(this).attr("act") == 0) {
                    addNew.push($(this).attr("f-id"));
                }
            })
            if (hotelId.length != 0) {
                $.ajax({
                    url: "./?ctrl=ajax&act=changeHotelFacilities",
                    method: "POST",
                    data: {
                        'hotelId': hotelId,
                        'update': update,
                        'insert': addNew,
                    },
                    success: function (data) {
                        if (data != -1) {
                            alert("Cập nhật thành công");
                        }
                        else {
                            alert("Cập nhật thất bại");
                        }

                    },
                    error(error) {
                        console.log(eval(error));
                    }
                })
            }
            else {
                alert("Lỗi");
            }
        }
    })
    // Room facilities
    $("#SelectRoomFacilities").change(function () {
        let roomId = $(this).val();
        let hotelId = $("#facilitiesSelectHotel").val();
        $(".room-facilities").prop("checked", false);
        $("#changeRoomFacilities").show();
        if (roomId.length != 0 && hotelId.length != 0) {
            $.ajax({
                url: "./?ctrl=ajax&act=getHotelFacilitiesById",
                method: "POST",
                dataType: "JSON",
                data: {
                    'data': {
                        'id': hotelId,
                        'roomId': roomId
                    }
                },
                success: function (data) {
                    console.log(data);
                    if (data != -1) {
                        $(".room-facilities").each(function () {
                            let thisBig = $(this);
                            $.each(data, function (index, value) {
                                if (thisBig.attr("f-id") == value.f_id) {
                                    thisBig.val(value.hfd_id);
                                    thisBig.prop("checked", true);
                                }
                            })
                        })
                    }
                },
                error(error) {
                    console.log(eval(error));
                }
            })
        }
        else {
            $("#changeRoomFacilities").hide();
        }
    })
    // Change Room Facilities
    $("#changeRoomFacilities").click(function () {
        let confirm = prompt("Nhấn 'YES' để xác nhận lưu");
        let update = [];
        let addNew = [];
        let hotelId = $("#facilitiesSelectHotel").val();
        let roomId = $("#SelectRoomFacilities").val();
        if (confirm === "YES") {
            $(".room-facilities").each(function () {
                if ($(this).val().length != 0 && $(this).attr("act") == 1) {
                    update.push($(this).val());
                }
                if ($(this).val() === "" && $(this).attr("act") == 0) {
                    addNew.push($(this).attr("f-id"));
                }
            })
            if (hotelId.length != 0) {
                $.ajax({
                    url: "./?ctrl=ajax&act=changeHotelFacilities",
                    method: "POST",
                    data: {
                        'hotelId': hotelId,
                        'update': update,
                        'insert': addNew,
                        'room': roomId,
                    },
                    success: function (data) {
                        if (data != -1) {
                            alert("Cập nhật thành công");
                        }
                        else {
                            alert("Cập nhật thất bại");
                        }

                    },
                    error(error) {
                        console.log(eval(error));
                    }
                })
            }
            else {
                alert("Lỗi");
            }
        }
    })
    //
    $("#CreateHotel").on("click", function (event) {
        if (checkInputBeforeSubmit() == false) {
            event.preventDefault();
            alert("Dữ liệu rỗng");
        }
        else {
            let hotelName = $("[name=hotelName]").val();
            let city = $("[name=city_name]").val();
            let district = $("[name=district_name]").val();
            let ward = $("[name=ward_name]").val();
            let addressLine = $("[name=hotelAddress]").val();
            let phoneNumber = $("[name=hotelPhoneNum]").val();
            let hotelEmail = $("[name=hotelEmail]").val();
            let website = $("[name=hotelWebsite]").val();
            let hotelStar = $("[name=HotelStar]").val();
            var hotelDes = CKEDITOR.instances.hotelDes.getData();
            let files = $("#fileUpload").prop('files')[0];
            let fileExtend = files.name.split('.').pop();
            if (typeof (files) === "undefined") {
                alert("File rỗng");
            }
            else {
                let flag = true;
                let arr = [hotelName, city, district, ward, addressLine, phoneNumber, hotelEmail, website, hotelStar, hotelDes];
                $.each(arr, function (index, value) {
                    if (value.length == 0) {
                        flag = false;
                    }
                })
                if (flag) {
                    $.ajax({
                        url: "./?ctrl=ajax&act=createHotel",
                        method: "POST",
                        data: {
                            'data': {
                                'hotelName': hotelName,
                                'city_name': city,
                                'district_name': district,
                                'ward_name': ward,
                                'hotelAddress': addressLine,
                                'hotelPhoneNum': phoneNumber,
                                'hotelEmail': hotelEmail,
                                'hotelWebsite': website,
                                'HotelStar': hotelStar,
                                'HotelDes': hotelDes,
                                'fileEx': fileExtend,
                            }
                        },
                        success: function (data) {
                            console.log(data);
                            if (data != -1) {
                                let newName = files.filename = data;
                                let file_data = new FormData();
                                file_data.append('file', files, newName+"."+fileExtend);
                                console.log(newName);
                                $.ajax({
                                    url: "./?ctrl=ajax&act=uploadAvatar",
                                    method: "POST",
                                    processData: false,
                                    contentType: false,
                                    data: file_data,
                                    success: function (data2) {
                                        alert("Thêm mới thành công")
                                    },
                                    error(error) {
                                        console.log(eval(error));
                                    }
                                })
                            }
                            else {
                                alert("Thêm thất bại");
                            }
                        },
                        error(error) {
                            console.log(eval(error));
                        }
                    })
                }
            }
        }
    })
    // add hotel btn
    $(".addHotelBtn").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "./?ctrl=ajax&act=isCreateHotel",
            method: "POST",
            success: function (data) {
                if (data != -1) {
                    window.location.replace("./?ctrl=hotel&act=createhotel");
                }
                else {
                    alert("Bạn đã đạt số khách sạn tối đa, nâng cấp gói để tạo thêm");
                }
            },
            error(error) {
                console.log(eval(error));
            }
        })
    })
    // 
    $(".createRoomChildBtn").click(function (e) {
        e.preventDefault();
        let url = window.location.search;
        let param = url.substr(url.lastIndexOf("param=") + 6, url.length);
        $.ajax({
            url: "./?ctrl=ajax&act=isAllowCreateRoom",
            method: "POST",
            data: {
                'param': param,
            },
            success: function (data) {
                if (data != -1) {
                    window.location.replace("./?ctrl=hotel&act=createroomtype&param=" + param);
                }
                else {
                    alert("Bạn đã đạt số phòng tối đa, nâng cấp gói để tạo thêm");
                }
            },
            error(error) {
                console.log(eval(error));
            }
        })
    })
    // 
    // function
    //
    function getRoomImageModal() {
        let hotelName = $("#listHotel option:selected").text();
        let roomId = $("#chooseRoom").val();
        $.ajax({
            url: "./?ctrl=Ajax&act=getRoomImage",
            method: "POST",
            data: {
                'id': roomId,
                'hotelN': hotelName,
            },
            success: function (data) {
                $(".choose-image-modal").children().append(data);
            },
            error(error) {
                console.log(eval(error));
            }
        })
        return 1;
    }
    function getHotelImageModal() {
        let hotelName = $("#listHotel option:selected").text();
        let hotelId = $("#listHotel option:selected").val();
        $.ajax({
            url: "./?ctrl=Ajax&act=getHotelImage",
            method: "POST",
            data: {
                'id': hotelId,
                'name': hotelName,
            },
            success: function (data) {
                $(".choose-image-modal").children().append(data);
            },
            error(error) {
                console.log(eval(error));
            }
        })
        return 1;
    }
    // 
    function getAllImageInFolder() {
        let hotelName = $("#galListHotel option:selected").text();
        $.ajax({
            url: "./?ctrl=Ajax&act=getAllHotelImageInFolder",
            method: "POST",
            data: {
                'hotelName': hotelName,
            },
            success: function (data) {
                $(".folder-hotel-image").children().remove();
                $('.folder-hotel-image').append(data);
                console.log(1);
            },
            error(error) {
                console.log(eval(error));
            }
        })
    }

});
