/**
 * Created by AKITO on 2016/3/3.
 * @return {boolean}
 */
function InputCheck(regForm) {
    if (regForm.user_email.value == "") {
        alert("用户名不可为空!");
        regForm.user_email.focus();
        return false;
    }
    if (regForm.user_password.value == "") {
        alert("必须设定登录密码!");
        regForm.user_password.focus();
        return false;
    }
    if(regForm.user_password.value.length < 6 || regForm.user_password.value.length > 20) {
        alert("密码应由6-20位的字母和数字组成!");
        regForm.user_password.focus();
        return false;
    }
    var reg = /^[0-9a-zA-Z]+$/;
    if(!reg.test(user_password.value)){
        alert("密码应由6-20位的字母和数字组成!");
        return false;
    }
    if (regForm.user_password.value != regForm.user_password_confirm.value) {
        alert("两次密码不一致!");
        regForm.user_password.focus();
        return false;
    }
    if (regForm.user_name.value == "") {
        alert("姓名不可为空!");
        regForm.user_tel.focus();
        return false;
    }
    if (regForm.user_work.value == "") {
        alert("工作单位不可为空!");
        regForm.user_tel.focus();
        return false;
    }
    if (regForm.user_tel.value == "") {
        alert("联系方式不可为空!");
        regForm.user_tel.focus();
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