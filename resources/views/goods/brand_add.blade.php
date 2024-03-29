<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<base href="/admin/">
<title>商品列表</title>
<link rel="stylesheet" href="css/pintuer.css">
<link rel="stylesheet" href="css/admin.css">
<link rel="stylesheet" href="css/style.css">
<!--<link rel="stylesheet" href="css/ace.min.css">-->
<script src="js/jquery.js"></script>
<script src="js/pintuer.js"></script>
<script src="js/layer/layer.js"></script>
</head>
<body>
<form method="post" action="" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 自营品牌</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
			    <div class="border-b border-bno clearfix">
			      <a href="/goods/cateedit_2" class="button bg-yellow button-small"><span class="icon-plus"></span>添加品牌</a>
			     </div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <!--<li> <a class="button border-main icon-plus-square-o" href="add.html"> 发布文章</a> </li>-->
        <li>
          <input type="text" placeholder=""  class="input" style="width:250px; line-height:17px;display:inline-block" />
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="changesearch()" > 查询</a></li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">编号</th>
        <th>品牌中文名称</th>
        <th>品牌描述</th>
        <th>排序</th>
        <th>是否显示</th>
        <th width="200">操作</th>
      </tr>

   <?php  foreach($list as $key =>$val): ?>
        <tr>
          <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value="" />
           <?php echo $val->id;?></td>
          <td> <?php echo $val->brand_name;?></td>
          <td> <?php echo $val->brand_desc;?></td>
          <td> <?php echo $val->brand_sort;?></td>
          <td> <?php echo $val->is_show;?></td>
          <td><div class="button-group"><a class="button border-main" href="cateedit-2.html"><span class="icon-edit (alias)"></span>编辑</a><a class="button border-red" href="javascript:void(0)" onclick="return del(<?php echo $val->id?>)"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
  <?php endforeach ?>

        
      <tr>
        <td style="text-align:left; padding:19px 0;padding-left:20px;"><input type="checkbox" id="checkall"/>
          全选 </td>
        <td colspan="10" style="text-align:left;padding-left:20px;"><a href="javascript:void(0)" class="button border-red icon-trash-o" style="padding:5px 15px;" onclick="DelSelect()"> 批量删除</a> 
      </tr>
      <tr>
        <td colspan="8"><div class="pagelist"> <a href="">上一页</a> <span class="current">1</span><a href="">2</a><a href="">3</a><a href="">下一页</a><a href="">尾页</a> </div></td>
      </tr>
    </table>
  </div>
</form>

<script type="text/javascript">

//搜索
function changesearch(){	
		
}

//单个删除
function del(id){
	if(confirm("您确定要删除吗?")){

   $.ajax({
     url:'/goods/brand_del',
     data:{id:id,'_token':'{{csrf_token()}}'
},
      type:'POST',
      success:function(){
        alert('删除成功');
        window.location.reload();
    
      }
   })
	}
}

//全选
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

//批量删除
function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;		
		$("#listform").submit();		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

</script>
</body>
</html>