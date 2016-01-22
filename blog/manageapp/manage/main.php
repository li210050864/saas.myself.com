<div id="main">
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
					<td><?=$row->g_name?></td>
					<td class="sort"><input type="text" class="c-sort" value="<?=$row->g_sort?>" /></td>
					<td><?=$row->g_desc?></td>
					<td><?=$row->g_createtime?></td>
					<td><?=$row->g_updatetime?></td>
					<td><a href="/article/editGroup/<?=$row->id?>">修改</a>&nbsp;<a href="/article/delGroup/<?=$row->id?>">删除</a>&nbsp;<a href="/article/addArticle/<?=$row->id?>">添加文章</a></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="7">没有可显示的数据！</td>
				</tr>
				<?php
				endif;
				?>
			</tbody>
		</table>
	</div>
</div>