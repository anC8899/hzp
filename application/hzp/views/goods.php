<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
                    <table class="table table-striped">
                    <thead>
                          <tr>
                          <th>#</th>
                          <th>商品编号</th>
                          <th>容　　量</th>
                          <th>名　　称</th>
                          <th>介　　绍</th>
                          <th>操作</th>
                          </tr>
                    </thead>
                         <?php foreach($datalist AS $d):?>
                          <tr>
                          <td></td>
                          <td><?php echo $d['itme_code']?></td>
                          <td><?php echo $d['capacity']?></td>
                          <td><?php echo $d['goods_name']?></td>
                          <td><?php echo $d['goods_desc']?></td>
                          <td>
                          <?php if($updateGoods):?>
                          <a class="btn pagebtn" title="修改" href="<?php echo site_url("goods/updateGoods/{$d['goods_id']}") ?>"><i class="icon-pencil"></i></a>
                          <?php endif;?>
                          <?php if($goodsIn):?>
                          <a class="btn pagebtn" title="入库" href="<?php echo site_url("goodsbox/goodsIn/{$d['itme_code']}") ?>">入库</a>
                          <?php endif;?>
                          
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