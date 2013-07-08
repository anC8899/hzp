<script type="text/javascript">
<!--
$(document).ready(function(){
  
   	$('#updateCart').on('click', function () {
	   var $form = $("#form");
        var action = $form.attr("action");
        //alert($form.serialize());
        $.post(action, $form.serialize(),
            function(jsonStr) {

                 jsonObj = eval('('+ jsonStr +')');
                 
                //alert(jsonObj.msg);
                if(jsonObj.mod == 'success')
                {
                    $('#alert_msg').html(jsonObj.msg)
                    $('#alert_anc').show().delay(5000).hide(1);
                    top.location.reload();
                    
                }else{
                    $('#alert_msg').html(jsonObj.msg)
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
<?php //echo form_open('goodsbox/cart'); ?>
<?php 
    $hidden = array('code' => 'updateCart'); 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form');
    echo form_open_multipart('goodsbox/cart',$attributes,$hidden);
?>
<table cellpadding="6" cellspacing="1" style="width:100%" border="0" class="table">
<tr>
  <th>数量</th>
  <th>商品信息</th>
  <th style="text-align:right">单价</th>
  <th style="text-align:right">总价</th>
  <th></th>
</tr>
<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>

 <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
 
 <tr>
   <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5','class'=>'span1')); ?></td>
   <td>
  <?php echo $items['name']; ?>
     
   <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
     
    <p>
     <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
      
      <strong>规格/容量:</strong> <?php echo $option_value; ?><br />
          
     <?php endforeach; ?>
    </p>
    
   <?php endif; ?>    
   </td>
   <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
   <td style="text-align:right">￥<?php echo $this->cart->format_number($items['subtotal']); ?></td>
   <td style="text-align: right;"><a class="btn" href='<?php echo site_url('goodsbox/cart?code=delCartGoods&rowid='.$items['rowid'])?>' >删除</a></td>
 </tr>
<?php $i++; ?>

<?php endforeach; ?>

<tr>
  <td colspan="3"> </td>
  <td class="right"><strong>总金额</strong></td>
  <td class="right">￥<?php echo $this->cart->format_number($this->cart->total()); ?></td>
</tr>

</table>
<div class="form-actions">
<?php if($this->cart->total_items()): ?>
<button class="btn btn-primary" data-toggle="modal" id="updateCart">更新购物车</button>
<a class="btn" href='<?php echo site_url('goodsbox/cart?code=subOrder') ?>' >提交订单</a>
<?php endif?>
</div>

				</div>						
				<div class="page"><?php echo isset($pages) ? $pages : ''?></div>						
			</div>
		</div>
	</div>

</div>
