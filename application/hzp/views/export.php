<?php
	header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:filename=".date("Y-m-d H:i:s",time()).".xls");
?>
          <table class="table table-striped table-bordered table-condensed">
          <tr>
          <td>姓名</td>
          <td>性别</td>
          <td>身份证号码</td>
          <td>手机号码</td>          
          <td>手机型号</td>
          <td>智能</td>
          <td>运营商</td>
          <td>月消费流量</td>
          <td>姓名</td>
          <td>联系电话</td>
          <td>收货地址</td>
          <td>提交时间</td></tr>
         <?php foreach($datalist AS $d):?>
          <tr>
          <td><?php echo $d['username']?></td>
          <td><?php echo $d['gender'] == '1'? '男':'女';?></td>
          <td><?php echo ','.$d['idcard']?></td>
          <td><?php echo $d['phone_number']?></td>
          <td><?php echo $d['phone_type']?></td>
          <td><?php echo $d['is_smart']== '1'? '是':'否';?></td>
          <td><?php echo $d['operator']?></td>
          <td><?php echo $d['month_traffic']?></td>
          <td><?php echo $d['u_name']?></td>
          <td><?php echo $d['contact_number']?></td>
          <td>浙江省、杭州市、<?php echo $d['district']?>、<?php echo $d['street']?></td>
          <td> <?php echo date( 'Y-m-d H:i:s',$d['createtime'])?></td>
          </tr>
          <?php endforeach?>
        </table>
          