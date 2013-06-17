<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line"> 
<?php 
    $hidden = array('brandid' => $brand['brand_id']); 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form');
    echo form_open_multipart('brand/update_brand',$attributes,$hidden);
?>
    <fieldset>
      <legend>添加品牌</legend>
      <div class="control-group">
        <label class="control-label" for="input01">品牌名称</label>
        <div class="controls">
          <input type="text" name="brand_name_en" class="input-xlarge" value="<?php echo $brand['brand_name_en'] ?>" /> ( 英 )
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">品牌名称</label>
        <div class="controls">
          <input type="text" name="brand_name" class="input-xlarge" value="<?php echo $brand['brand_name'] ?>" /> ( 中 )
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="textarea">品牌描述</label>
        <div class="controls">
          <textarea rows="3" class="input-xlarge" name="brand_desc"><?php echo $brand['brand_desc'] ?></textarea>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">排序</label>
        <div class="controls">
          <input type="text" name="sort_order" class="input-mini" value="<?php echo $brand['sort_order'] ?>"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="optionsCheckbox">显示</label>
        <div class="controls">
          <label class="checkbox">
          <input type="checkbox" name="is_show" <?php echo $brand['is_show'] ? '' : 'checked="checked"';?> />
	           默认勾选为显示，不勾选为不显示
          </label>
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