<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
<?php 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form');
    echo form_open_multipart('goodsbox/goodsInBox',$attributes);
?>
    <fieldset>
      <legend>商品入库</legend>
      <div class="control-group">
        <label class="control-label" for="input01">商品编号</label>
        <div class="controls">
          <input type="text" name="itme_code" class="input-xlarge" value="<?php echo $goods['itme_code'] ?>"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">商品单价</label>
        <div class="controls">
          <input type="text" name="price" class="input-xlarge" value=""/>
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
        <label class="control-label">品牌</label>
        <div class="controls">
          <span class="input-xlarge uneditable-input"><?php echo $goods['brand_name'] ?></span>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">分类</label>
        <div class="controls">
         <span class="input-xlarge uneditable-input"><?php echo $goods['cat_name'] ?></span>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">关键字</label>
        <div class="controls">
          <span class="input-xlarge uneditable-input"><?php echo $goods['keywords'] ?></span>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">容量</label>
        <div class="controls">
          <span class="input-xlarge uneditable-input"><?php echo $goods['capacity'] ?></span>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">名称</label>
        <div class="controls">
          <span class="input-xlarge uneditable-input"><?php echo $goods['goods_name'] ?></span>
          <p class="help-block"></p>
        </div>
      </div>      
      <div class="control-group">
        <label class="control-label" for="textarea">介绍</label>
        <div class="controls">
         <textarea rows="10" class="input-xlarge" disabled="true" ><?php echo $goods['goods_desc'] ?></textarea>
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