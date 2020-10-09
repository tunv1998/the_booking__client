$(document).ready(function () {
    // Out focus
    // Validate email
    $("#email").keyup(function () {
        const emailLength = $(this).val().length;
        if (emailLength > 0 && emailLength < 45) {
            if (checkEmail($(this).val())) {
                validateIsTrue($(this));
            }
            else {
                validateIsFalse($(this));
            }
        }
        else {
            validateIsFalse($(this));
        }
        $('input').focusout(function () {
            $(this).css({
                'box-shadow': 'unset',
            })
        })
    });
    // Validate phone
    $("#phone").keyup(function () {
        const phoneLength = $(this).val().length;
        if (phoneLength > 0 && phoneLength < 20) {
            if (checkPhoneNumber($(this).val())) {
                validateIsTrue($(this));
            }
            else {
                validateIsFalse($(this));
            }
        }
        else {
            validateIsFalse($(this));
        }
        $('input').focusout(function () {
            $(this).css({
                'box-shadow': 'unset',
            })
        })
    });
    // Hotel Name, Room_Type Name
    $("#name").keyup(function () {
        if (inputNotEmpty($(this), 30) && checkProfanity($(this).val())) {
            validateIsTrue($(this));
        }
        else {
            validateIsFalse($(this));
        }
        $('input').focusout(function () {
            $(this).css({
                'box-shadow': 'unset',
            })
        })
    });
    // Hotel website
    $("[name='hotelWebsite']").keyup(function () {
        if (checkWebsite($(this).val())) {
            validateIsTrue($(this));
        }
        else {
            validateIsFalse($(this));
        }
        $('input').focusout(function () {
            $(this).css({
                'box-shadow': 'unset',
            })
        })
    });
    // Hotel star
    $("[name='HotelStar']").keyup(function () {
        if (inputNotEmpty($(this), 4)) {
            if (parseFloat($(this).val()) <= 5 && parseFloat($(this).val()) >= 1) {
                if ((parseFloat($(this).val()) * 4) % 2 == 0) {
                    validateIsTrue($(this));
                }
                else {
                    validateIsFalse($(this));
                }
            }
            else {
                validateIsFalse($(this));
            }
        }
        else {
            validateIsFalse($(this));
        }
        $('input').focusout(function () {
            $(this).css({
                'box-shadow': 'unset',
            })
        })
    });
    // 
    $('#amount-of-room').keyup(function () {
        if (inputNumLimit($(this).val(), 10)) {
            validateIsTrue($(this));
        }
        else {
            validateIsFalse($(this));
        }
    })
    // 
    $('[name="roomtype_guest_limit"]').keyup(function () {
        if (inputNumLimit($(this).val(), 30)) {
            validateIsTrue($(this));
        }
        else {
            validateIsFalse($(this));
        }
    })
    // 
    $('[name="roomtype_dePrice"]').keyup(function () {
        if (inputNumLimit($(this).val(), 50000000)) {
            validateIsTrue($(this));
        }
        else {
            validateIsFalse($(this));
        }
    })
    //
    $('input[type=submit]').click(function (event) {
        if (!checkInputBeforeSubmit()) {
            event.preventDefault();
            alert("Dữ liệu rỗng");
        }
        else {
        }
    })

});
// 
function validateIsTrue(loca) {
    loca.css({
        'border-color': '',
        'border-width': '',
    });
    $(":focus").css('box-shadow', '0 0 0 0.2rem rgba(78, 115, 223, 0.25)');
    loca.attr('vali', 0);
    $('#addBooking').prop("disabled", false);
}
// 
function validateIsFalse(loca) {
    loca.css({
        'border-color': '#e74a3b',
        'border-width': '1.2px',
    });
    $(":focus").css('box-shadow', 'unset');
    loca.attr('vali', 1);
    $('#addBooking').prop("disabled", true);
}
// 
function checkName(name) {
    const re = /[#@!$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/;
    return re.test(name);
}
// 
function checkInputBeforeSubmit() {
    let flag = true;
    $('input[type=text]').each(function (key, value) {
        console.log($(this).val());
        if ($(this).val().length == 0 || $(this).attr("vali") === "1") {
            validateIsFalse($(this));
            flag = false;
        }
    });
    return flag;
}
// 
function checkPhoneNumber(text) {
    if (text.length > 9 && text.length < 13) {
        text = text.replace(/[&\/\\#, +()$~%.'":*?<>{}]/g, "");
        text = text.replace(/^84/g, '0');
        let regex = RegExp(/^0[0-9]{9}$/);
        if (regex.test(text)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
// 
function checkEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
// 
function checkWebsite(name) {
    var regex = /(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/gi;
    return regex.test(name);
}
//
function inputNotEmpty(loca, limit) {
    if (loca.val().length > 0 && loca.val().length < limit) {
        return true;
    }
    return false;
}
//
function inputNumLimit(value, limit) {
    if (parseInt(value) > 0 && parseInt(value) < limit) {
        return true;
    }
    return false;
}
// 
function checkProfanity(text) {
    let arr = ['nứng',
        'loz',
        'lolz',
        'lone',
        'lồz',
        'lồn',
        'Lồn',
        'đĩ',
        'Đĩ',
        'đỉ',
        'cặc',
        'cc',
        'ncc',
        'fuck',
        'Fuck',
        'bitch',
        'Bitch',
        'đụ',
        'Đụ',
        'đm',
        'Đm',
        'ĐM',
        'dm',
        'Dm',
        'DM',
        'đmm',
        'Đmm',
        'dmm',
        'Dmm',
        'cl',
        'clm',
        'clmm',
        'clgt',
        'Clgt',
        'đéo',
        'Đéo',
    ];
    if (text.length != 0) {
        let newArr = text.split(" ");
        for (let index = 0; index < newArr.length; index++) {
            const element = newArr[index];
            if (arr.includes(element)) {
                return false;
            }

        }
    }
    return true;
}