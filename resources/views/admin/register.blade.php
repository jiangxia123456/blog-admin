<html>
@include("admin.header")

<body class="login-bg">
    
    <div class="login">
        <div class="message">管理注册</div>
        <div id="darkbannerwrap"></div>
        <form method="post" class="layui-form" class="layui-form" action="/toRegister" >
            @csrf
            @if ( !empty($username) )
            <p style="text-align: center;color: red">{{ $username[0] }}</p>
            @endif
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            @if ( !empty($password) )
            <p style="text-align: center;color: red">{{ $password[0] }}</p>
            @endif
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="二次密码"  type="password" class="layui-input">
            <hr class="hr15">
            @if ( !empty($captcha) )
            <p style="text-align: center;color: red">{{ $captcha[0] }}</p>
            @endif
            <input  name="captcha" placeholder="验证码"  lay-verify="required" class="layui-input" style="width: 40%;float: left">
            <img id="captcha" src="{{captcha_src()}}" style="float: left;margin-left:20px" name="captcha" onclick="updateCode()">
            <hr class="hr15">
            <input value="注册" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        var i =1;
        updateCode = function(){
            let captcha = document.getElementById("captcha");
            var src = captcha.getAttribute("src");
            i++;
            var newSrc = src + i;
            captcha.src = newSrc;
        };

        $(function  () {
            // layui.use('form', function(){
            //   var form = layui.form;
            //   // layer.msg('玩命卖萌中', function(){
            //   //   //关闭后的操作
            //   //   });
            //   //监听提交
            //   form.on('submit(login)', function(data){
            //     // alert(888)
            //     layer.msg(JSON.stringify(data.field),function(){
            //         location.href='index.html'
            //     });
            //     return false;
            //   });
            // });
        })


        
    </script>

</body>
</html>