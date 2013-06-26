<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
<?php 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form');
    echo form_open_multipart('goodsbox/goodsOutBox',$attributes);
?>
    <fieldset>
      <legend>商品出库</legend>
      <div class="control-group">
        <label class="control-label" for="input01">商品编号</label>
        <div class="controls">
          <input type="text" name="itme_code" class="input-xlarge" value="<?php echo $itme_code ?>"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">数量</label>
        <div class="controls">
          <input type="text" name="quantity" class="input-xlarge" value=""/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">客户姓名</label>
        <div class="controls">
         <input type="text" name="wusername" class="input-xlarge" value=""/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">联系电话</label>
        <div class="controls">
          <input type="text" name="phone" class="input-xlarge" value=""/>
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
        <label class="control-label" for="input01">物流公司</label>
        <div class="controls">
          <input type="text" name="wuliu_company" class="input-xlarge" value=""/>
          <p class="help-block"></p>
        </div>
      </div>      
      <div class="control-group">
        <label class="control-label" for="textarea">备注信息</label>
        <div class="controls">
         <textarea rows="10" class="input-xlarge" name="remarks" ></textarea>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">实收金额</label>
        <div class="controls">
          <input type="text" name="amount" class="input-xlarge" value=""/>
          <p class="help-block"></p>
        </div>
      </div> 
      <div class="form-actions">
        <button class="btn btn-primary" data-toggle="modal" href="#myModal">保存更改</button>
        <!--<button class="btn" >取消</button>-->
      </div>
    </fieldset>
  </form>
				</div>					
			</div>
		</div>
	</div>

</div>