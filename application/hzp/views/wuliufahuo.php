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
        //alert($form.serialize());
        $.post(action, $form.serialize(),
            function(jsonStr) {
                 jsonObj = eval('('+ jsonStr +')');
                //alert(jsonObj.msg);
                if(jsonObj.mod == 'success')
                {
                    //清空表单，如果提交成功，就清空表单
                    $(":input[type=text]").val('');
                    $(":input[type=hidden]").val('');
                    $('#msg').html(jsonObj.msg);
                    
                }else{                    
                    $('#msg').html(jsonObj.msg);
                }          
        });
        $('#fahuoModal').modal('hide');
    });
});
-->
</script>
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
            <?php foreach($wuliu AS $wl):?>
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
                    <table class="table table-striped">
                        <thead>
                          <tr>
                              <th>#</th>
                              <th>商品编号</th>
                              <th>实收金额</th>
                              <th>数量</th>
                              <th>操作人员</th>
                              <th>时间</th> 
                              <th>操作</th>
                          </tr>
                         </thead>         
                         <?php foreach($datalist AS $d):?>                         
                          <tr>
                            <td></td>
                              <td><?php echo $d['itme_code']?></td>
                              <td><?php echo $d['amount']?></td>
                              <td><?php echo $d['quantity']?></td>
                              <td><?php echo $d['uname']?></td>
                              <td><?php echo date( 'Y-m-d H:i:s',$d['createtime'])?></td>
                              <td><a class="btn wlid"  data-toggle="modal" href="#fahuoModal" wlid="<?=$d['wl_id']?>">发货</a></td>
                          </tr>
                          <tr>
                            <td></td>
                              <td><?php echo $d['wusername']?></td>
                              <td><?php echo $d['phone']?></td>
                              <td colspan="3"><?php echo $d['remarks']?></td>
                              <td><!--<a class="btn">打印</a>--></td>
                          </tr>
                          <tr>
                            <td>地址:</td>
                              <td colspan="6"><?php echo $d['address']?></td>
                          </tr>

                          <?php endforeach?>
                        </table>
				</div>						
				<div class="page"><?php echo isset($pages) ? $pages : ''?></div>						
			</div>
		</div>
	</div>
</div>