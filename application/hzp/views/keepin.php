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
                              <th>单　　价</th>
                              <th>数　　量</th>
                              <th>操作人员</th>
                              <th>时　　间</th> 
                          </tr>
                         </thead>         
                         <?php foreach((array)$datalist AS $d):?>
                          <tr>
                            <td></td>
                              <td><?php echo $d['itme_code']?></td>
                              <td><?php echo $d['price']?></td>
                              <td><?php echo $d['quantity']?></td>
                              <td><?php echo $d['uname']?></td>
                              <td><?php echo date( 'Y-m-d H:i:s',$d['createtime'])?></td>
                          </tr>
                          <?php endforeach?>
                        </table>
				</div>						
				<div class="page"><?php echo isset($pages) ? $pages : ''?></div>						
			</div>
		</div>
	</div>
</div>