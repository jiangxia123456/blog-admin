@include("admin.header")
<html>
<body>
<div class="x-body">
    <form class="layui-form" method="post" action="/admin/to_atricle_edit">
        @csrf
        <div class="layui-form-item">
            <label for="username" class="layui-form-label" name="title">
                <span class="x-red">*</span>文章标题
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="title" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$result->title}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label" name="read_number">
                <span class="x-red">*</span>阅读次数
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="read_number" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$result->read_number}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>标签
            </label>
            <div class="layui-input-inline">
                <select id="shipping" name="sort" class="valid">
                    @foreach($tag as $tags)
                        <option value="{{$tags->id}}" <?php if($tags->id == $tagId){ echo "selected";} ?> >{{$tags->tag_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
        <label for="username" class="layui-form-label">
            <span class="x-red">*</span>分类
        </label>
        <div class="layui-input-inline">
            <select id="shipping" name="sort" class="valid">
                @foreach($category as $cate)
                    <option value="{{$cate->id}}" <?php if($cate->id == $category_id){ echo "selected";} ?> >{{$cate->name}}</option>
                @endforeach
            </select>
        </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>置顶状态
            </label>
            <div class="layui-input-inline">
                <select id="shipping" name="top_status" class="valid">
                    <option value="0" name="top_status">否</option>
                    <option value="1" name="top_status">是</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>发布状态
            </label>
            <div class="layui-input-inline">

                <select id="shipping" name="status" class="valid">
                    <option value="0" name="status">发布</option>
                    <option value="1" name="status">不发布</option>
                </select>
            </div>
        </div>


            <div class="layui-form-item">
                <label for="username" class="layui-form-label" name="read_number">
                    <span class="x-red">*</span>更新时间
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="username" name="updated_at" required="" lay-verify="required"
                           autocomplete="off" class="layui-input" value="{{$result->updated_at}}">
                </div>
            </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>作者
            </label>
            <div class="layui-input-inline">

                <select id="shipping" name="author" class="valid">
                    @foreach($users as $user)
                    <option value="{{$user->id}}" <?php if($user->id == $result->user_id){ echo "selected"; } ?> >{{$user->username}}</option>
                    @endforeach
                </select>
            </div>
        </div>
                {!! UEditor::css() !!}
                {!! UEditor::content() !!}
                {!! UEditor::js() !!}
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="" type="submit">
                增加
            </button>
        </div>
    </form>

</div>
<script type="text/javascript">

    var ue = UE.getEditor('ueditor'); //用辅助方法生成的话默认id是ueditor

    /* 自定义路由 */
    /*
    var serverUrl=UE.getOrigin()+'/ueditor/test'; //你的自定义上传路由
    var ue = UE.getEditor('ueditor',{'serverUrl':serverUrl}); //如果不使用默认路由，就需要在初始化就设定这个值
    */

    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });
</script>
<script>

    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        //自定义验证规则
        form.verify({
            nikename: function(value){
                if(value.length < 5){
                    return '昵称至少得5个字符啊';
                }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
        });

        // //监听提交
        // form.on('submit(add)', function(data){
        //     console.log(data);
        //     //发异步，把数据提交给php
        //     layer.alert("增加成功", {icon: 6},function () {
        //         // 获得frame索引
        //         var index = parent.layer.getFrameIndex(window.name);
        //         //关闭当前frame
        //         parent.layer.close(index);
        //     });
        //     return false;
        // });


    });
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>
