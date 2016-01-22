<div id='main'>
	<div class='operator'></div>
	<div class='add-art'>
		<h3>添加文章</h3>
		<div>
			<form action='<?=site_url("/article/addArticle/".$artGroudId)?>' method='post' name='addArtForm' id='addArtForm'>
				<p>
					<label>文章标题：</label>
					<input type='text' name='article[title]' value='' class='input-text'/>
				</p>
				<p>
					<label>文章作者：</label>
					<input type='text' name='article[author]' value='' class='input-text' />
				</p>
				<p>
					<label>文章分类：</label>
					<select name='article[artclass]' value='' class='sel-long'>
						<option value=''>--选择文章分类--</option>
					</select>
				</p>
				<p>
					
				</p>
			</form>
		</div>
	</div>
</div>