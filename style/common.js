function on_submit(thisform){
　　with(thisform){
　　　　if((username.value == "" || username.value==null)&&
　　　　(password.value==""||password.value==null)) {
　　　　　　alert("用户名和密码不能为空，请重新输入");
　　　　　　return false;
　　　　}else if(username.value=="" ||username.value==null){
　　　　　　alert("用户名不能空，请从新输入");
　　　　　　return false;
　　　　}else if(password.value=="" ||password.value==null){
　　　　　　alert("密码不能为空，请从新输入");
　　　　　　return false;
　　　　}else if(username.value=="admin" || password.value=="admin"){
　　　　　　confirm("登录成功");
　　　　　　return true;
　　　　}else{
　　　　　　alert("用户名和密码输入有误");
　　　　return false;
          }
    }
}
