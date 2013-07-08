<script type="text/javascript">
<!--
$(document).ready(function(){
  
  $('a[wlid]').click(function(){
    var wl_id = $(this).attr('wlid');
    $('#wl_id').val(wl_id);
    $('#fahuoModal').on('show',function(){});
  })    
   	$('#submit').on('click', function () {
	   var $form = $("#form");
        var action = $form.attr("action");

        $.post(action, $form.serialize(),
            function(jsonStr) {

                 jsonObj = eval('('+ jsonStr +')');
                 
                if(jsonObj.mod == 'success')
                {
                    //清空表单，如果提交成功，就清空表单
                    $(":input[type=text]").val('');
                    //$(":input[type=hidden]").val('');
                    $('#alert_msg').html(jsonObj.msg)
                    $('#alert_anc').show().delay(5000).hide(1);
                    
                }else{                    
                    $('#alert_anc').show().delay(5000).hide(1);
                }          
        });
        $('#fahuoModal').modal('hide');
    });
});

-->
</script>
<style type="text/css">
<!--
.table li span {    display: block;    float: left;}
-->
</style>
<!--  发货信息 -->
<div class="modal fade" id="fahuoModal" style="display: none; width: 300px;margin-left: -150px;">
  <div class="modal-header">
    <a class="close" data-dismiss="modal" id="110">×</a>
    <h3>提示</h3>
  </div>
  <div class="modal-body">
<?php 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form');
    echo form_open_multipart('goodsbox/wuliufahuo',$attributes);
?>
<div style="display:none">
    <input type="hidden" id="wl_id" name="wl_id" value="0" />
</div>
  <fieldset>
  <div class="control-group">
  <label class="control-label" for="input01" style="width: 80px;">物流公司</label>
    <div class="controls" style="margin-left: 100px;">
        <select name="wuname" class="span2" >
            <?php foreach((array)$wuliu AS $wl):?>
            <option value="<?=$wl['wlname']?>"><?=$wl['wlname']?></option>
            <?php endforeach?>
        </select>
    </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input01" style="width: 80px;">物流单号</label>
        <div class="controls" style="margin-left: 100px;">
          <input type="text" name="w_ordernumber" id="wl11" class="span2" value="<?php echo $cate['keywords'] ?>" />
          <p class="help-block"></p>
        </div>
      </div>
  </fieldset>
</form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <a href="#" class="btn btn-primary" id="submit">确定发货</a>
  </div>
</div>
<!-- end 发货信息 -->

<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
                    <table class="table table-condensed" id="score">
<?php foreach($datalist AS $d): $amount=0; $quantity =0; ?> 

<? if(!$goodsinfo[$d['wl_id']]): continue;endif; ?>
<?php foreach($goodsinfo[$d['wl_id']] AS $goods):?>    
<tr>
<td>编号</td><td><?=$goods['itme_code']?></td><td>商品</td><td><?=$goods['goods_name']?></td><td>数量</td><td><?php echo $goods['quantity']; $quantity +=$goods['quantity'];?></td><td>价格</td><td><?php echo $goods['price']; ;?></td>
</tr>
<?php endforeach?>  
<tr>
<td>姓名</td><td><?=$d['wusername']?></td><td>电话</td><td><?=$d['phone']?></td><td>总数量</td><td><?=$quantity?></td><td>实收金额</td><td><span class="badge"><?=$d['amount']?></span></td>
</tr>
<tr>
<td>地址</td><td colspan="5"><?=$d['address']?></td><td>物流</td><td><?=$d['wuliu_company']?></td>
</tr>
<tr>
<td>备注</td><td colspan="5"><?php echo  '['.$d['wuliu_com'].'] '?><?=$d['remarks']?></td><td>单号</td><td><?=$d['w_ordernumber']?></td>
</tr>
<tr style="background-color: #CCCCCC;">
<td>操作人</td><td><?=$d['uname']?></td><td></td><td></td><td>时间</td><td><?=date( 'Y-m-d H:i:s',$d['create_time'])?></td>
<td><a class="btn btn-mini <?php echo $d['status'] ? 'disabled' : ''?>" title="取消订单" href="<?php echo  $d['status'] ? '#' : site_url("goodsbox/cancelOutBox/{$d['wl_id']}") ?>"><?php echo  $d['status'] ? '已' : ''?>取消</a></td>
<td><a class="btn btn-mini"  data-toggle="modal" href="#fahuoModal" wlid="<?=$d['wl_id']?>"><?php echo $d['w_ordernumber'] ? '已' :'' ?>发货</a></td>
</tr>    
<?php endforeach?>                    
</table>

				</div>						
				<div class="page"><?php echo isset($pages) ? $pages : ''?></div>						
			</div>
		</div>
	</div>
</div>