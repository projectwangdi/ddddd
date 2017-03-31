<?php
header("Content-type:text/html;charset:utf-8");
mysql_connect('127.0.0.1','root','')or die('数据库连接失败');
mysql_select_db('message1')or die('选择数据库失败');
mysql_query('set names utf-8');
if(isset($_POST['button'])&&(!empty($_POST))){
	if($_POST['id']){
	    $id=trim($_POST['id']);
	    if(empty($id)){
			echo "<script>alert('参数错误');location=location</script>";exit;
		}
		$name =trim($_POST['name']);
	if(empty($name)){
		echo "<script>alert('留言者名不能为空');location=location</script>";exit;
	}
	$email =trim($_POST['email']);
	if(empty($email)){
		echo "<script>alert('联系邮箱不能为空');location=location</script>";exit;
	}
	$title =trim($_POST['title']);
	if(empty($title)){
		echo "<script>alert('留言标题不能为空');location=location</script>";exit;
	}
	$content =trim($_POST['content']);
	if(empty($content)){
		echo "<script>alert('留言内容不能为空');location=location</script>";exit;
	}
	$xiugai =mysql_query("update `message` set name ='".$name."',email ='".$email."',title ='".$title."',content ='".$content."' where id=".$id);
	// var_dump($xiugai);exit;
	if($xiugai){
		echo "<script>alert('修改成功');location.href='index.php';</script>";exit;
	}else{
		echo "<script>alert('修改失败');location.href='index.php';</script>";exit;

	}
	}
	$name =trim($_POST['name']);
	if(empty($name)){
		echo "<script>alert('留言者名不能为空');location=location</script>";exit;
	}
	$email =trim($_POST['email']);
	if(empty($email)){
		echo "<script>alert('联系邮箱不能为空');location=location</script>";exit;
	}
	$title =trim($_POST['title']);
	if(empty($title)){
		echo "<script>alert('留言标题不能为空');location=location</script>";exit;
	}
	$content =trim($_POST['content']);
	if(empty($content)){
		echo "<script>alert('留言内容不能为空');location=location</script>";exit;
	}
	$create_time =time();
	$jia="insert into `message`(`name`,`email`,`title`,`content`,`create_time`)values('".$name."','".$email."','".$title."','".$content."','".$create_time."')";
	$jiajia= mysql_query($jia);
	if($jiajia){
		echo "<script>alert('留言成功');location=location</script>";exit;
	}else{
		echo "<script>alert('留言失败');location=location</script>";exit;
	}
}
if(isset($_GET['action']) && $_GET['action']=='delete'&& $_GET['id']>0){
	$id=intval($_GET['id']);//intval转为整形
    $dada ='select * from `message` where id='.$id;
    $dadada=mysql_query($dada);
    $dadadadada=mysql_fetch_assoc($dadada);
    // var_dump($dadadadada);exit;
    if(empty($dadadadada)){
   echo "<script>alert('找不到数据');location.href='index.php';</script>";exit;
    }
	$del =('delete from `message` where id='.$id);
	$shan=mysql_query($del);
	if($shan !==false){

		echo "<script>alert('删除成功');location.href='index.php';</script>";exit;
	}else{
		echo "<script>alert('删除失败');ocation.href='index.php';</script>";exit;
	}
}
if(isset($_GET['action']) && $_GET['action']=='update'&& $_GET['id']>0){

     $id =trim($_GET['id']);
     $upda=mysql_query('select *from `message` where id= '.$id.' limit 0,1');
     // $update=mysql_fetch_assoc($upda);
	 // var_dump($update);exit;
	 $dataone=array();
	 while ($dd=mysql_fetch_assoc($upda)) {
	 $dataone[]=$dd;
	 }
	 if(empty($dataone)){
	 	echo "<script>alert('参数错误');location.href='index.php';</script>";exit;
	 }
	 // var_dump($dataone);exit;
}

$res='select * from `message` order by create_time desc';
$aa=mysql_query($res);
$data =array();
while ($bb=mysql_fetch_assoc($aa)) {
	$data[] =$bb;
}
// var_dump($data);exit

?>
<?php
// var_dump($aa);exit
?>


<!DOCTYPE html>
<html>
<head>
<title>留言-hovertree</title>
<meta charset="utf-8"/>
<style type="text/css">
  .cle{ clear:both;}
  #content{margin:10px auto;width:800px; overflow:hidden; border-radius:5px; background:url(img/bj.jpg);}
  #content #postBt{ float:right; margin-left:15px;}
  #content #clearBt{ float:right;}
  #content input{border-radius:5px;}
  /*table{opacity:0.3;}*/
  #comment{margin-left:310px;width:800px;margin:10px auto;}
  #comment p{margin-bottom:10px; padding:10px; height:45px; line-height:40px; border-radius:5px; background:url(img/bj.jpg) no-repeat;}
  #comment p .msg{ float:left; margin:0px; padding:0px;}
  #comment p .datetime{ float:right;margin:0px; padding:0px;color:#999;}
</style>
</head>
<body>
<div id="content">
    <h2>留言</h2>
	<form action="index.php" method="post">
		<table height="277">
			<tr>
				<td>留 言 者：</td>
				<td><input name="name" type="text" style="width:500px" value="
				<?php
               if(isset($_GET['action']) && $_GET['action']=='update'&& $_GET['id']){
                	echo $dataone[0]['name'];
                }else{
                   echo '';
                }
				?>" /></td>
			</tr>
			
			<tr>
				<td>联系邮箱：</td>
				<td><input name="email" type="text" style="width:500px" value="<?php
               if(isset($_GET['action']) && $_GET['action']=='update'&& $_GET['id']){
                	echo $dataone[0]['email'];
                }else{
                   echo '';
                }
				?>"/></td>
			</tr>
			<tr>
				<td>留言标题：</td>
				<td><input name="title" type="text" style="width:500px"value="
				<?php
               if(isset($_GET['action']) && $_GET['action']=='update'&& $_GET['id']){
                	echo $dataone[0]['title'];
                }else{
                   echo '';
                }
				?>" />
				</td>
			</tr>
			
			<tr id="post">
				<td>内&nbsp;&nbsp;容：</td>
				<td><textarea name="content" style="width:500px;height:200px;border-radius:5px; color:#999;">
					<?php
               if(isset($_GET['action']) && $_GET['action']=='update'&& $_GET['id']){
                	echo $dataone[0]['content'];
                }else{
                   echo '';
                }
				?>
				</textarea></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>
				  <input name="id" type="hidden" value="<?php
               if(isset($_GET['action']) && $_GET['action']=='update'&& $_GET['id']){
                	echo $dataone[0]['id'];
                }else{
                   echo '';
                }
				?>"/>
				  <input id="postBt" name="button" type="submit" value="提交"/>
				  <input id="clearBt" type="reset" value="清空所有已保存的数据" />
				</td>
			</tr>        
		</table>
	</form>
</div>
<div id="comment">
	<table>
		<tr>
			<td>ID&nbsp;</td>
			<td>留言者&nbsp;</td>
			<td>email&nbsp;</td>
			<td>时间&nbsp;</td>
			<td>标题&nbsp;</td>
			<td>内容&nbsp;</td>
			<td>楼层&nbsp;</td>
			<td>操作&nbsp;</td>
		</tr>
		<?php
$i=1;
		?>
		
		<?php
        foreach ($data as $key => $value) {
      
		?>
		<tr>
			<td><?php echo $value['id'];?>&nbsp;</td>
			<td><?php echo $value['name'];?>&nbsp;</td>			
			<td><?php echo $value['email'];?>&nbsp;</td>			
			<td><?php echo date('Y-m-d',$value['create_time']);?>&nbsp;</td>
			<td><?php echo $value['title']?>&nbsp;</td>
			<td><?php echo mb_substr($value['content'],0,10,'utf-8')?>.....&nbsp;</td>
			<td><?php echo $i."楼"?></td>
			<td><a href="index.php?action=delete&id=<?=$value['id']?>">删除</a>&nbsp;<a href="index.php?action=update&id=<?=$value['id']?>">编辑</a></td>
		</tr>
		<?php
		$i++;
            }
		?>
	</table>
</div>
</body>
</html>