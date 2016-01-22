<div id="main">
	<div class="operator">
		<a href="/cartoon/add">添加漫画组</a>
	</div>
	<div class="list">
		<table>
			<thead>
				<tr>
					<th width="80px;">全选<input type="checkbox" id="checkAll"></th>
					<th width="30px">ID</th>
					<th width="150px">组名称</th>
					<th width="100px">排序</th>
					<th width="400px">描述</th>
					<th width="150px">创建时间</th>
					<th width="150px">修改时间</th>
					<th width="150px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($rows):
					foreach ($rows->result() as $row):
				?>
				<tr>
					<td><input type="checkbox" id="class_"></td>
					<td><?=$row->id?></td>
					<td><?=$row->cartoon_classname?></td>
					<td class="sort"><input type="text" class="c-sort" value="<?=$row->cartoon_classorder?>" /></td>
					<td><?=$row->cartoon_classdesc?></td>
					<td><?=$row->createtime?></td>
					<td><?=$row->updatetime?></td>
					<td>
						<a href="<?php echo site_url('/cartoon/edit/'.$row->id)?>">编辑</a>&nbsp;
						<a href="<?php echo site_url('/cartoon/del/'.$row->id)?>">删除</a>&nbsp;
						<a href="/cartoon/addcart">添加漫画</a>
						<a href="/cartoon/cartlist/<?=$row->id?>">查看</a>
					</td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="8" style="text-align:center">没有可显示的数据！</td>
				</tr>
				<?php
				endif;
				?>
			</tbody>
		</table>
	</div>
</div>