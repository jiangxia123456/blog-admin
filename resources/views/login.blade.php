<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>开始使用layui</title>
    <link rel="stylesheet" href="{{asset('/css/layui.css')}}">
</head>
<body>

<div class="layui-container" style="margin-topbac">
    <div class="layui-row">
        <form class="layui-form" action="/toLogin" method="post">
            @csrf
            <div class="layui-form-item">
                <label class="layui-form-label">用户名：</label>
                <div class="layui-input-block">
                    <input type="text" name="username" required  lay-verify="required" placeholder="请输入用户名"  autocomplete="off" class="layui-input" style="width: 190px;" >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码：</label>
                <div class="layui-input-inline">
                    <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <input type="submit" class="layui-btn" lay-submit lay-filter="formDemo" value="登录" name="login"/>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- 你的HTML代码 -->

<script type="text/javascript"   src="{{asset('/js/layui.js')}}"></script>
<script>

</script>
</body>
</html>
