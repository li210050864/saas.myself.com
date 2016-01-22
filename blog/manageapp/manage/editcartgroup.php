<div id="main">
	<div class="operator">
		<a href="/cartoon/add">添加漫画组</a>
		<a href="/cartoon/add">添加漫画</a>
	</div>
	<div class='adddiv'>
		<h4>添加漫画组</h4>
		<form action='<?php echo site_url("/cartoon/edit/$cartoonData->id")?>' method='post' name='addCartClassFrom' id='addCartClassFrom'>
			<p>
				<label>名称</label>
				<input type='text' name='cartclass[cartoon_classname]' value='<?=$cartoonData->cartoon_classname?>'/>
				<span class='tip'>* 请添加漫画组名称</span>
			</p>
			<p>
				<label>描述</label>
				<input type='text' class='desc' name='cartclass[cartoon_classdesc]' value='<?=$cartoonData->cartoon_classdesc?>'/>
				<span class='tip'>* 请添加漫画组描述，漫画组描述不能超过120个汉字</span>
			</p>
			<p>
				<label>排序</label>
				<input type='text' calss='order' name='cartclass[cartoon_classorder]' value='<?=$cartoonData->cartoon_classorder?>'/>
				<span class='tip'>* 请添加漫画组排序</span>
			</p>
			<p>
				<input type='submit' class='input-btn' name='submit' value='修改' />
			</p>
		</form>
	</div>
</div>