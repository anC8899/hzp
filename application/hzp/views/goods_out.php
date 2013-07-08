<script type="text/javascript">
<!--
$(document).ready(function(){  
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
                    $(".input-xlarge").val('');
                    $('#alert_msg').html(jsonObj.msg)
                    $('#alert_anc').show().delay(5000).hide(1);
                    
                }else{ 
                    $('#alert_msg').html(jsonObj.msg)
                    $('#alert_anc').show().delay(5000).hide(1);
                }          
        });        
    });
});
-->
</script>
<div class="main-right" id="base-right"> <?php echo validation_errors(); ?>
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
<?php 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form');
    $active = 'goodsbox/goodsOutBox';
    if($source == 'cart')
    {
        $hidden = array('code' => 'cartGoodsOutBox');
        $active = 'goodsbox/cart'; 
    } 
    echo form_open_multipart($active,$attributes,$hidden);
?>
    <fieldset>
      <legend>商品出库</legend>
      <?php if($itme_code): //如果$itme_code 为空 为从购物车过来提交，如果不为空 为一键出库 ?>
      <div class="control-group">
        <label class="control-label" for="input01">商品编号</label>
        <div class="controls">
        <label for="input01"><?php echo $itme_code ?></label>
          <input type="hidden" name="itme_code"  value="<?php echo $itme_code ?>"/>
          <input type="hidden" name="goods_name"  value="<?php echo $goods_name ?>"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">商品名称</label>
        <div class="controls">
        <label for="input01"><?php echo $goods_name ?></label>
          <p class="help-block"></p>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="input01">数量</label>
        <div class="controls">
          <input type="text" name="quantity" class="span2" value=""/>
          <p class="help-block"></p>
        </div>
      </div>
      <?php endif; ?>
      <div class="control-group">
        <label class="control-label" for="input01">客户姓名</label>
        <div class="controls">
         <input type="text" name="wusername" class="span2" value=""/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">联系电话</label>
        <div class="controls">
          <input type="text" name="phone" class="span2" value="" maxlength="11"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">实收金额</label>
        <div class="controls">
          <input type="text" name="amount" class="span2" value="<?=$price?>"/>
          <p class="help-block"></p>
        </div>
      </div>       
      <div class="control-group">
        <label class="control-label" for="input01">物流公司</label>
        <div class="controls">
            <select name="wuliu_com" class="span2" >
                <?php foreach($wuliu AS $wl):?>
                <option value="<?=$wl['wlname']?>"><?=$wl['wlname']?></option>
                <?php endforeach?>
            </select>
          <p class="help-block"></p>
        </div>
      </div> 

     <div class="control-group">
        <label class="control-label" for="input01">物流地址</label>
        <div class="controls">
          <input type="text" name="address" class="input-xlarge" value=""/>
          <p class="help-block"></p>
        </div>
      </div>     
      <div class="control-group">
        <label class="control-label" for="textarea">备注信息</label>
        <div class="controls">
         <textarea rows="3" class="input-xlarge" name="remarks" ></textarea>
        </div>
      </div>

      <div class="form-actions">
        <button class="btn btn-primary" data-toggle="modal" href="#" id="submit">保存更改</button>
        <!--<button class="btn" >取消</button>-->
      </div>
    </fieldset>
  </form>
				</div>					
			</div>
		</div>
	</div>

</div>