<script src="<?php //echo base_url("style/js/bootstrap-tab.js");?>"></script>
<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line"> 
                    <ul id="tab" class="nav nav-pills">
                    <?php foreach($datalist[0] AS $cat):?>
                        <li class="<?php echo $cat['checked'] ? 'active' : '';?>"><a href="#cat_<?php echo $cat['cat_id']?>" data-toggle="tab"><?php echo $cat['cat_name']?></a></li>
                    <?php endforeach?>
                    </ul>
                                 
                    <div id="myTabContent" class="tab-content">
                    <?php foreach($datalist[0] AS $cat):?>
                        <div class="tab-pane fade <?php echo $cat['checked'] ? ' active in' : '';?>" id="cat_<?php echo $cat['cat_id']?>">
                          <p>
                            <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                  <th>分类关键字</th>
                                  <th>排序</th>
                                  <th>是否显示</th>
                                  <th>操作</th>
                              </tr>
                             </thead>          
                             <?php 
                             if($datalist[$cat['cat_id']]):
                             foreach($datalist[$cat['cat_id']] AS $d):
                             ?>
                              <tr>
                                    <td></td>
                                  <td><?php echo $d['keywords']?></td>
                                  <td><?php echo $d['sort_order']?></td>
                                  <td><?php echo $d['is_show']?></td>
                                  <td>
                                  <?php if($updateCategory):?>
                                  <a class="btn pagebtn" title="修改" href="<?php echo site_url("category/updateCategory/{$d['cat_id']}") ?>"><i class="icon-pencil"></i></a>
                                  <?php endif;?>
                                  <!--<a class="btn" href="">删除</a>-->
                                  </td>
                              </tr>
                              <?php                               
                              endforeach;
                              endif;
                              ?>
                            </table>
                          </p>
                        </div>
                        <?php endforeach?>
                      </div>                                 
                    <script>
                      $(function () {
                        $('.tabs a:last').tab('show')
                      })
                    </script>                           

				</div>						
										
			</div>
		</div>

	</div>

</div>