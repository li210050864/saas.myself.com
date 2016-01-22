<div id='main'>
	<div class='adddiv'>
		<form action='<?php echo site_url('cartoon/editCart/'.$cartInfo->id);?>' method='post' class='addCartFrom' id='addCartFrom'>
			<p>
				<label>所属分类：</label>
				<select name='cartoon[cartoon_class]'>
					<option value=''>请选择分类</option>
					<?php
					if ($rows):
						foreach($rows->result() as $row):
					?>
					<option value='<?=$row->id?>' <?php if($row->id == $cartInfo->cartoon_class):?>selected<?php endif?>><?=$row->cartoon_classname?></option>
					<?php
						endforeach;
					endif;
					?>
				</select>
			</p>
			<p>
				<label>名称：</label>
				<input type='text' name='cartoon[cartoon_name]' value='<?=$cartInfo->cartoon_name?>'/>
				<span class='tip'>* 请输入漫画名称</span>
			</p>
			<p>
				<label>标题：</label>
				<input type='text' name='cartoon[cartoon_title]' value='<?=$cartInfo->cartoon_title?>'/>
				<span class='tip'>* 请输入漫画标题</span>
			</p>
			<p>
				<label>作者：</label>
				<input type='text' name='cartoon[cartoon_author]' value='<?=$cartInfo->cartoon_author?>'/>
				<span class='tip'>* 请输入漫画作者</span>
			</p>
			<p>
				<label>版本：</label>
				<input type='text' name='cartoon[cartoon_version]' value='<?=$cartInfo->cartoon_version?>'/>
				<span class='tip'>* 请输入漫画版本号</span>
			</p>
			<p>
				<label>公司：</label>
				<input type='text' name='cartoon[cartoon_company]' value='<?=$cartInfo->cartoon_company?>'/>
				<span class='tip'>* 请输入漫画出版公司</span>
			</p>
			<p>
				<label>出版时间：</label>
				<input type='text' name='cartoon[cartoon_publish]' value='<?=$cartInfo->cartoon_publish?>'/>
				<span class='tip'>* 请输入漫画出版时间</span>
			</p>
			<p>
				<label>国家：</label>
				<input type='text' name='cartoon[cartoon_country]' value='<?=$cartInfo->cartoon_country?>'/>
				<span class='tip'>* 请输入漫画出版国家</span>
			</p>
			<p>
				<label>&nbsp;</label>
				<input id="fileupload" type="button" class='input-btn' value='修改漫画图片'>
				<div id='showpic'></div>
			</p>
			<p>
				<input type='submit' value='编辑' class='input-btn'/>
			</p>
		</form>
	</div>
</div>