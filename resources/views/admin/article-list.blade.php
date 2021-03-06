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
              <td ondblclick="updateTitle(this)">
                  <span ><?php echo $item->title; ?></span>
                  <input type="text" value="{{ $item->title }}" class="layui-input" style="display:none" onkeyup="postTile(event,this,{{ $item->id }})" >
              </td>
              <td><?php echo $item->content?mb_substr($item->content,0,5):""; ?></td>
              <td><?php echo $item->read_number; ?></td>
              <td><?php echo $item->top_num; ?></td>
              <td><?php echo $item->status; ?></td>
              <td><?php echo $item->created_at; ?></td>
              <td><?php echo $item->updated_at; ?></td>
              <td><?php echo $item->user_id; ?></td>
            <td class="td-manage">

                    <a href="/admin/article_edit?id=<?php echo $item->id; ?>">
                    <i class="layui-icon">&#xe63c;</i>
                </a>
                <a _href="/admin/article_delete?id=<?php echo $item->id; ?>" onclick="delete_article({{ $item->id }})">
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
          {{ $data->links() }}
      </div>

    </div>
    <script>
        function updateTitle(obj){
            // obj == 点击的td
            $(obj).children("span").hide();
            $(obj).children("input").show();
        }



        function postTile(event,obj,article_id){
            if(event.keyCode ==13){
                var title = $(obj).val();
                $.ajax({
                    url:"/admin/article_update_title",
                    type:"post",
                    dataType:"json",
                    data:{
                        "title":title,
                        "id":article_id,
                        "_token":"{{ csrf_token() }}"
                    },
                    success:function (result) {
                        if(result.code == 200){
                            alert(result.message);
                            $(obj).hide();
                            $(obj).siblings("span").text(title).show();
                        }else{
                            alert(result.message);
                        }

                    },
                    error:function (error) {

                    }
                })
            }

        }
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
      function delete_article(id) {
          layer.confirm('你确定要删除吗？',function(index){
              // ajax 异步请求
              $.ajax({
                  url: "/admin/article_delete", //  请求的地址
                  type: 'get',                  // 请求的方式
                  dataType: 'json',             // 请求数据的类型 json xml
                  data: {                       // 传过去的数据
                    "id":id
                  },
                  success: function(result){       // http code = 200 请求成功返回的结果
                      if(result.code == 400){
                          alert(result.message)
                      }else{
                          alert(result.message);
                          window.location.reload();
                      }

                  },
                  error: function(error){         // 错误返回的结果
                    console.log("失败了："+error)
                  }
              })
          });
      }
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