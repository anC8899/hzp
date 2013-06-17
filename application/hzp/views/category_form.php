<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
<?php 
    $hidden = array('cat_id' => $cate['cat_id']); 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form');
    echo form_open_multipart('category/update_category',$attributes,$hidden);
?>
    <fieldset>
      <legend>添加分类</legend>
      <div class="control-group">
        <label class="control-label" for="select01">分类名称</label>
        <div class="controls">
            <select name="parent_id">
                <?php foreach($cat AS $c):?>
                <option value="<?php echo $c['cat_id']?>"><?php echo $c['cat_name']?></option>
                <?php endforeach?>
            </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">关键字</label>
        <div class="controls">
          <input type="text" name="keywords" class="input-medium" value="<?php echo $cate['keywords'] ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">排序</label>
        <div class="controls">
          <input type="text" name="sort_order" class="input-mini" value="<?php echo $cate['sort_order'] ?>"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="optionsCheckbox">显示</label>
        <div class="controls">
          <label class="checkbox">
          <input type="checkbox" name="is_show" <?php echo $cate['is_show'] ? '' : 'checked="checked"';?> />
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