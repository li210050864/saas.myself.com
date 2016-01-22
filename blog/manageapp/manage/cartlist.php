<div id="main">
	<div class="operator">
		<a href="/cartoon/addCart">添加漫画</a>
	</div>
	<div class="list">
		<table>
			<thead>
				<tr>
					<th width="80px;">全选<input type="checkbox" id="checkAll"></th>
					<th width="30px">ID</th>
					<th width="150px">漫画名称</th>
					<th width="200px">漫画标题</th>
					<th width="80px">排序</th>
					<th width="120px">作者</th>
					<th width="100px">来源</th>
					<th width="80px">版本</th>
					<th width="200px">公司</th>
					<th width="100px">发布时间</th>
					<th width="100px">国家</th>
					<th width="150px">创建时间</th>
					<th width="150px">修改时间</th>
					<th width="150px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($rows):
					foreach ($rows as $row):
				?>
				<tr>
					<td><input type="checkbox" id="class_"></td>
					<td><?=$row->id?></td>
					<td><?=$row->cartoon_name?></td>
					<td><?=$row->cartoon_title?></td>
					<td class="sort"><input type="text" class="c-sort" value="<?=$row->cartoon_order?>" /></td>
					<td><?=$row->cartoon_author?></td>
					<td><?=$row->cartoon_src?></td>
					<td><?=$row->cartoon_version?></td>
					<td><?=$row->cartoon_company?></td>
					<td><?=date('Y-m-d',strtotime($row->cartoon_publish))?></td>
					<td><?=$row->cartoon_country?></td>
					<td><?=$row->createtime?></td>
					<td><?=$row->updatetime?></td>
					<td>
						<a href="<?php echo site_url('/cartoon/editCart/'.$row->id.'/'.$row->cartoon_class)?>">编辑</a>&nbsp;
						<a href="<?php echo site_url('/cartoon/delCart/'.$row->id)?>">删除</a>&nbsp;
						<a href="/cartoon/cartpiclist/<?=$row->id?>">查看漫画</a>
					</td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="14" style="text-align:center">没有可显示的数据！</td>
				</tr>
				<?php
				endif;
				?>
			</tbody>
		</table>
	</div>
</div>