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
                          <th>库存数量</th>
                          </tr>
                    </thead>
                         <?php foreach($datalist AS $d):?>
                          <tr>
                          <td></td>
                          <td><?php echo $d['itme_code']?></td>
                          <td><?php echo $d['capacity']?></td>
                          <td><?php echo $d['goods_name']?></td>
                          <td><?php echo $d['goods_desc']?></td>
                          <td><?php echo $d['quantity'] ? $d['quantity'] : 0?></td>
                          </tr>
                          <?php endforeach?>
                        </table>
				</div>						
				<div class="page"><?php echo isset($pages) ? $pages : ''?></div>						
			</div>
		</div>

	</div>

</div>