<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>更改操作</title>
</head>
<body>
<?php foreach ($result as $item){ ?>
<form method="post" action="/admin/to_atricle_edit">
    文章标题：<input type="text" name="title" value="<?=$item->title?>"/><br/><br/>
    内容：<input type="text" name="content" value="<?= $item->content?mb_substr($item->content,0,5):"";?>"/><br/><br/>
    阅读次数：<input type="text" name="red_num" value="<?=$item->read_number?>"/><br/><br/>
    置顶状态：<input type="text" name="top_status" value="<?=$item->top_num?>"/><br/><br/>
    发布状态：<input type="text" name="status" value="<?=$item->status?>"/><br/><br/>
    发布时间：<input type="text" name="create_time" value="<?=$item->created_at?>"/><br/><br/>
    更新时间：<input type="text" name="updated_time" value="<?=$item->updated_at?>"/><br/><br/>
    作者:<input type="text" name="author" value="<?=$item->user_id?>"/><br/><br/>
    <input type="submit" value="提交" name="tj"/>
</form>
<?php } ?>

</body>
</html>
