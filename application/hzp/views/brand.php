<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
                   <table class="table table-striped">
                   <thead>
                      <tr>
                      <th>#</th>
                      <th>品牌名称</th>
                      <th>品牌名称</th>
                      <th>品牌描述</th>
                      <th>排序</th>
                      <th>不显示</th>
                      <th>操作</th> 
                      </tr> 
                    </thead>        
                     <?php foreach($datalist AS $d):?>
                      <tr>
                      <td></td>
                      <td><?php echo $d['brand_name_en']?></td>
                      <td><?php echo $d['brand_name']?></td>
                      <td><?php echo $d['brand_desc']?></td>
                      <td><?php echo $d['sort_order']?></td>
                      <td><?php echo $d['is_show']?></td>
                      <td>
                      
                      <?php if($updateBrand):?>
                      <a class="btn pagebtn" title="修改" href="<?php echo site_url("brand/updateBrand/{$d['brand_id']}") ?>"><i class="icon-pencil"></i></a>
                      <?php endif;?>
                      
                      <!--<a class="btn" href="">删除</a>-->
                      
                      </td>
                      </tr>
                      <?php endforeach?>
                    </table>
				</div>						
				<div class="page"><?php echo isset($pages) ? $pages : ''?></div>						
			</div>
		</div>
	</div>

</div>
