<script type="text/javascript">
<!--
$(document).ready(function(){
        
  /*ajax 提交数据加提示信息 */
	$('select').on('change', function () {
	   var name = $(this).attr('name');
       if('category' == name)
       {
        return false;
       }
       var valu = $(this).attr('value');
        $.post('<?php echo site_url('Category/ajaxCategory')?>', {name:name,value:valu},
            function(Str) {
                if(name == 'base_cate')
                {
                     $("select[name=category]").html('<option>请选择..</option>'+Str);        
                }else{
                    
                    $("#cate").html(Str);                    
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
<?php 
    $hidden = array('cat_id' => $cate['cat_id']); 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form');
    echo form_open_multipart('category/update_category',$attributes,$hidden);
?>
    <fieldset>
      <legend>添加分类</legend>
      <div class="control-group">
        <label class="control-label" for="select01">分类</label>
        <div class="controls">
            <select name="base_cate">
                <option>请选择..</option>
                <?php foreach($base_cate AS $bc):?>
                <option value="<?=$bc['bid']?>"><?=$bc['cate_name']?></option>
                <?php endforeach?>
            </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="select01"></label>
        <div class="controls">
            <select name="category">
            <option>请选择..</option>
            </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">关键字</label>
        <div class="controls">
          <input type="text" name="cate_name" class="input-medium" value="<?php echo $cate['cate_name'] ?>" />
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