
function checkPhone(phone) {
    var regExp = /^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/;
    phonenumber = document.querySelector("#"+phone.id);
    if (!regExp.test(phone.value)) {
        phonenumber.setCustomValidity("Vui lòng nhập đúng định dạng 0123456789");
    }
    else {
        phonenumber.setCustomValidity("");
    }
}
function checkName(name) {
    var regExp = /(^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễếệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]+$)/i;
    name = document.querySelector("#"+name.id);
    if (!regExp.test(name.value)) {
        name.setCustomValidity("Vui lòng không nhập số và kí tự đặc biệt");
    }
    else {
        name.setCustomValidity("");
    }
}
function checkPassword(password){
    var regExp = /(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$)/i;
    password = document.querySelector("#"+password.id);
    if (!regExp.test(password.value)) {
        password.setCustomValidity("Mật khẩu cần có tối thiếu 8 kí tự, 1 chữ hoa 1 chữ thường và 1 chữ số");
    }
    else {
        password.setCustomValidity("");
    }
}
function checkConfirmPassword(password){
    confirmpassword = document.querySelector("#"+password.id);
    password = document.querySelector("#register-password");
    if (confirmpassword.value != password.value) {
        confirmpassword.setCustomValidity("Mật khẩu không chính xác");
    }
    else {
        confirmpassword.setCustomValidity("");
    }
}