/**
 * Created by AKITO on 2016/3/3.
 * @return {boolean}
 */
function InputCheck(regForm) {
    if (regForm.old_password.value == "") {
        alert("请输入旧密码!");
        regForm.old_password.focus();
        return false;
    }
    if (regForm.new_password.value == "" && regForm.new_password_confirm.value == "") {
        alert("请输入新密码!");
        regForm.old_password.focus();
        return false;
    }
    if(regForm.new_password.value != regForm.new_password_confirm.value){
        alert("新密码不一致!");
        regForm.new_password.focus();
        return false;
    }
    if(regForm.old_password.value == regForm.new_password.value) {
        alert("新旧密码相同不需要修改!");
        regForm.new_password.focus();
        return false;
    }
    if(regForm.new_password.value.length < 6 || regForm.new_password.value.length > 20) {
        alert("新密码应由6-20位的字母和数字组成!");
        regForm.new_password.focus();
        return false;
    }
    var reg = /^[0-9a-zA-Z]+$/;
    if(reg.test(new_password.value)){
        return true;
    }
    else {
        alert("密码只能由数字和字母组成");
        return false;
    }
}