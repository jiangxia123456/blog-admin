@include("admin.header")
  <html>
  <body>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
          <input type="text" name="username"  placeholder="文章标题" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
{{--        <a class="layui-btn" href="/admin/article_add" ><i class="layui-icon"></i>添加</a>--}}
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>文章标题</th>
            <th>内容</th>
            <th>阅读次数</th>
            <th>置顶状态</th>
            <th>发布状态</th>
            <th>发布时间</th>
            <th>更新时间</th>
            <th>作者</th>
            <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $item){ ?>
          <tr>
              <td><?php echo $item->title; ?></td>
              <td><?php echo $item->content?mb_substr($item->content,0,5):""; ?></td>
              <td><?php echo $item->read_number; ?></td>
              <td><?php echo $item->top_num; ?></td>
              <td><?php echo $item->status; ?></td>
              <td><?php echo $item->created_at; ?></td>
              <td><?php echo $item->updated_at; ?></td>
              <td><?php echo $item->user_id; ?></td>
            <td class="td-manage">
                <a _href="/admin/article_edit">
                    <i class="layui-icon">&#xe63c;</i>
                </a>
                <a _href="/admin/article_delete">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
          </tr>
        <?php } ?>

       <!-- @foreach ($data as $item)
        <tr>
       <td>{{ $item->title  }}</td>
            <td></td>
            <td>{{ $item->read_number  }}</td>
            <td>{{ $item->top_num  }}</td>
            <td>{{ $item->status  }}</td>
            <td>{{ $item->created_at  }}</td>
            <td>{{ $item->updated_at  }}</td>
            <td>{{ $item->user_id  }}</td>
            <td class="td-manage">
                <a title="查看"  onclick="x_admin_show('编辑','order-view.html')" href="javascript:;">
                    <i class="layui-icon">&#xe63c;</i>
                </a>
                <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        @endforeach
        -->
        </tbody>
      </table>
      <div class="page">
        <div>
          <a class="prev" href="">&lt;&lt;</a>
          <a class="num" href="">1</a>
          <span class="current">2</span>
          <a class="num" href="">3</a>
          <a class="num" href="">489</a>
          <a class="next" href="">&gt;&gt;</a>
        </div>
      </div>

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>