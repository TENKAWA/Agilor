/**
 * Created by AKITO on 2016/3/4.
 * @return {boolean}
 */
function InputCheck(regForm) {
    if (regForm.user_email.value == "") {
        alert("账号不可为空!");
        regForm.user_email.focus();
        return false;
    }
    if (regForm.user_password.value == "") {
        alert("登录密码不可为空!");
        regForm.user_password.focus();
        return false;
    }
    var filter;
    filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(filter.test(user_email.value)) {
        return true;
    }
    else {
        alert("邮箱格式不正确!");
        regForm.user_email.focus();
        return false;
    }
}