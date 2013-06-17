<div class="main-right" id="base-right">
<!-- toolbox -->
<!--
    <div class="toolbox box">
    <button class="btn btn-primary" href="#">更新管理员权限</button>
    </div>
-->
<!-- toolbox end -->
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
                   <table class="table table-striped">
                   <thead>
                      <tr>
                      <th>#</th>                      
                      <th>组名称</th>
                      <th>操作</th>
                      </tr>
                   </thead>          
                     <?php foreach($datalist AS $d):?>
                      <tr>
                      <td></td>
                      <td><?php echo $d['groupname']?></td>
                      
                      <td>
                      <?php if($usersGroupPurview):?>
                      <a class="btn pagebtn" title="配置权限" href="<?php echo site_url("users/usersGroupPurview/{$d['groupid']}")?>"><i class="icon-cog"></i></a>
                      <?php endif;?>
                      </td>
                      
                      </tr>
                      <?php endforeach?>
                    </table>						
				<div class="page"><?php echo isset($pages) ? $pages : ''?></div>						
			</div>
		</div>
	</div>
 </div>
</div>
