<script type="text/javascript">
<!--
$(document).ready(function(){
  
  $('a[addcard]').click(function(){
    var itme_code = $(this).attr('addcard');
    var action = '<?php echo site_url('goodsbox/cart') ?>';

    $.post(action, {'itme_code':itme_code,'code':'addCart'},
        function(jsonStr) {
    
             jsonObj = eval('('+ jsonStr +')');
    
            if(jsonObj.mod == 'success')
            {
                //清空表单，如果提交成功，就清空表单
                $(":input[type=text]").val('');
                //$(":input[type=hidden]").val('');
                $('#alert_msg').html(jsonObj.msg)
                $('#alert_anc').show().delay(5000).hide(1);
                //$('#alert_anc').html("ok").fadeTo(5000,1).hide(); 
                
            }else{                    
                $('#alert_anc').show().delay(5000).hide(1);
            }          
        });

  });    

});

-->
</script>
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
                          <th>容量</th>
                          <th>名称</th>
                          <th>介绍</th>
                          <th>操作</th>
                          </tr>
                    </thead>
                         <?php foreach((array)$datalist AS $d):?>
                          <tr>
                          <td></td>
                          <td><?php echo $d['itme_code']?></td>
                          <td><?php echo $d['capacity']?></td>
                          <td><?php echo $d['goods_name']?></td>
                          <td><?php echo $d['goods_desc']?></td>
                          <td>
                          <?php if($updateGoods):?>
                          <a class="btn pagebtn" title="修改" href="<?php echo site_url("goods/updateGoods/{$d['itme_code']}") ?>"><i class="icon-pencil"></i></a>
                          <?php endif;?>
                          
                          <!-- 加入购物车 -->
                          <?php if($d['quantity'] < 1):?>                          
                          <a class="btn btn-danger disabled"  title="加入购物车" href="#"><i class="icon-shopping-cart icon-white"></i></a>
                          <?php else:?>
                          <a class="btn btn-danger" addcard='<?=$d['itme_code'] ?>' title="加入购物车" href="#"><i class="icon-shopping-cart icon-white"></i></a>
                          <?php endif;?>
                          <!-- end 加入购物车 -->
                          
                          
                          <?php if($goodsIn):?>
                          <a class="btn pagebtn" title="入库" href="<?php echo site_url("goodsbox/goodsIn/{$d['itme_code']}") ?>">入</a>
                          <?php endif;?>
                          
                          <?php if($goodsOutBox):?>
                          <a class="btn pagebtn <?php echo $d['quantity'] < 1 ? 'disabled ' : ''?>" title="出库" href="<?php echo $d['quantity'] < 1 ? '#' : site_url("goodsbox/goodsOutBox/{$d['itme_code']}") ?>">出</a>
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