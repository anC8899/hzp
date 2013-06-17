<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
                   <table class="table table-striped">
                   <thead>
                      <tr>
                      <th>#</th>
                      <th>账号</th>
                      <th>用户名称</th>
                      <th>组</th>
                      <th>操作</th>
                      </tr>
                   </thead>        
                     <?php foreach($datalist AS $d):?>
                      <tr>
                      <td></td>
                      <td><?php echo $d['username']?></td>
                      <td><?php echo $d['uname']?></td>
                      <td><?php echo $d['groupname']?></td>
                      <td>
                      <?php if($updateUser):?>
                      <a class="btn pagebtn" title="修改" href="<?php echo site_url("users/updateUser/{$d['userid']}") ?>"><i class="icon-pencil"></i></a>
                      <?php endif;?>
                      <?php if($isActivUser):?>
                      <a class="btn pagebtn" title="启用/停用" style="color: <?php echo $d['is_activ'] ? '' : 'red';  ?>;" href="<?php echo base_url("index.php/users/isActivUser?id={$d['userid']}&activ={$d['is_activ']}") ?>">停</a></td>
                      <?php endif;?>
                      </tr>
                      <?php endforeach?>
                    </table>
				</div>                					
					<div class="page"><?php echo isset($pages) ? $pages : '';?></div>					
			</div>
		</div>
	</div>
</div>
