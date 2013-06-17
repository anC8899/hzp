<!DOCTYPE HTML><head>
	<meta http-equiv="content-type" content="text/html"  charset="utf-8"/>
	<title>杭州联通-流量G时代,随意流量王,万人大体验</title>
</head>
<!-- Bootstrap -->
<link href="<?php echo base_url('style/css/bootstrap.min.css');?>" rel="stylesheet" media="screen" />
<script src="<?php echo base_url("style/js/jquery.min.js");?>"></script>
<script src="<?php echo base_url("style/js/vanadium.js");?>"></script>
<style type="text/css">
<!--
body{
    
    margin: 0;
    padding: 0;
    background:#d0d5cd;
}
#center{ 
    MARGIN-RIGHT: auto;
    MARGIN-LEFT: auto; 
    width:997px;
    vertical-align:middle;
}
.divbg{
    background:#fff;
    padding-left: 180px;
    padding-right: 200px;
    
}
select{
    width:165px;
}
div,ul{
	margin: 0;
	padding: 0;
}
.webtop{
	width:997px;
	height:618px;
	background-image: url(<?php echo base_url('style/image/webtop.gif');?>);
	background-repeat: no-repeat;
	}
.nav{
    
    width: 957px;
    height:39px;
    padding-left: 40px;
	background-image:url(<?php echo base_url('style/image/navbg.jpg');?>);
	background-repeat: repeat-x; 
    margin-bottom: 0px;   
}
#nav li{
    height: 33px;
    width: 139px;
	float: left;
	list-style-type: none;
    padding-left: 40px;
    padding-top: 5px;
}
#nav li a{
	color: #FFF;
	font-family: "宋体", "微软雅黑", "黑体";
	font-size: 22px;
	font-style: normal;
	font-weight: bold;
	text-decoration: none;
}
#activity_bg{
	height:597px;
	background-image:url(<?php echo base_url('style/image/activity_bg.jpg');?>);
	background-repeat: no-repeat;
}
.activt{
	background-image: url(<?php echo base_url('style/image/navred1.png');?>);
	background-repeat: no-repeat;	
}
.activb{
	background-image: url(<?php echo base_url('style/image/navred2.png');?>);
	background-repeat: no-repeat;
}
.noactivt{
	background-image: url(<?php echo base_url('style/image/navb2.png');?>);
	background-repeat: no-repeat;
}
.noactivb{
	background-image: url(<?php echo base_url('style/image/navb1.png');?>);
	background-repeat: no-repeat;
}
#qq{
	position: absolute;
	z-index: 10;
	top: 5px;
	right: 210px;
}	
-->
</style>
<script>
/*
 *本插件原作者Vanadium,原文请移步前往http://vanadiumjs.com/查看
 *本插件由Mr.Think中文整理,Mr.Think的博客:http://MrThink.net/
 *转载及使用请务必注明原作者.
*/
$(function(){
	//必填项加红*,Mr.Think添加,原插件无
    $("input[class*=:required]").after("<span> *</span>")
});
 //弹出信息样式设置
Vanadium.config = {
    valid_class: 'rightformcss',//验证正确时表单样式
    invalid_class: 'failformcss',//验证失败时该表单样式
    message_value_class: 'msgvaluecss',//这个样式是弹出信息中调用值的样式
    advice_class: 'failmsg',//验证失败时文字信息的样式
    prefix: ':',
    separator: ';',
    reset_defer_timeout: 100
}
//验证类型及弹出信息设置
Vanadium.Type = function(className, validationFunction, error_message, message, init) {
  this.initialize(className, validationFunction, error_message, message, init);
};
Vanadium.Type.prototype = {
  initialize: function(className, validationFunction, error_message, message, init) {
    this.className = className;
    this.message = message;
    this.error_message = error_message;
    this.validationFunction = validationFunction;
    this.init = init;
  },
  test: function(value) {
    return this.validationFunction.call(this, value);
  },
  validMessage: function() {
    return this.message;
  },
  invalidMessage: function() {
    return this.error_message;
  },
  toString: function() {
    return "className:" + this.className + " message:" + this.message + " error_message:" + this.error_message
  },
  init: function(parameter) {
    if (this.init) {
      this.init(parameter);
    }
  }
};
Vanadium.setupValidatorTypes = function() {
Vanadium.addValidatorType('empty', function(v) {
    return  ((v == null) || (v.length == 0));
  });
//***************************************以下为验证方法,使用时可仅保留用到的判断
Vanadium.addValidatorTypes([
	//匹配大小写的等值
    ['equal', function(v, p) {
      return v == p;
    }, function (_v, p) {
      return '输入的值必须与<span class="' + Vanadium.config.message_value_class + '">' + p + '相符\(区分大小写\)</span>.'
    }],
    //不匹配大小写的等值
    ['equal_ignore_case', function(v, p) {
      return v.toLowerCase() == p.toLowerCase();
    }, function (_v, p) {
      return '输入的值必须与<span class="' + Vanadium.config.message_value_class + '">' + p + '相符\(不区分大小写\)</span>.'
    }],
    //是否为空
    ['required', function(v) {
      return !Vanadium.validators_types['empty'].test(v);
    }, '此项不可为空!'],
    ['idcard', function(v) {
      return checkParseIdCard(v);
    }, '号码不正确!'],
    //强制选中 
    ['accept', function(v, _p, e) {
      return e.element.checked;
    }, '必须接受!'],
    //
    ['integer', function(v) {
      if (Vanadium.validators_types['empty'].test(v)) return true;
      var f = parseFloat(v);
      return (!isNaN(f) && f.toString() == v && Math.round(f) == f);
    }, '请输入一个正确的整数值.'],
    //数字
    ['number', function(v) {
      return Vanadium.validators_types['empty'].test(v) || (!isNaN(v) && !/^\s+$/.test(v));
    }, '请输入一个正确的数字.'],
    //
    ['digits', function(v) {
      return Vanadium.validators_types['empty'].test(v) || !/[^\d]/.test(v);
    }, '请输入一个非负整数,含0.'],
    //只能输入英文字母
    ['alpha', function (v) {
      return Vanadium.validators_types['empty'].test(v) || /^[a-zA-Z\u00C0-\u00FF\u0100-\u017E\u0391-\u03D6]+$/.test(v)   //% C0 - FF (? - ?); 100 - 17E (? - ?); 391 - 3D6 (? - ?)
    }, '请输入英文字母.'],
    //仅限ASCII编码模式下输入英文字母
    ['asciialpha', function (v) {
      return Vanadium.validators_types['empty'].test(v) || /^[a-zA-Z]+$/.test(v)   //% C0 - FF (? - ?); 100 - 17E (? - ?); 391 - 3D6 (? - ?)
    }, '请在ASCII下输入英文字母.'],
	//英文字母或正数
    ['alphanum', function(v) {
      return Vanadium.validators_types['empty'].test(v) || !/\W/.test(v)
    }, '请输入英文字母或正数.'],
	//邮箱验证
    ['email', function (v) {
      return (Vanadium.validators_types['empty'].test(v) || /\w{1,}[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/.test(v))
    }, '邮箱格式不正确,请检查.正确格式例如mrthink@gmail.com'],
    //网址
    ['url', function (v) {
      return Vanadium.validators_types['empty'].test(v) || /^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i.test(v)
    }, '请输入正确的网址,比如:http://www.mrthink.net'],
    //日期格式
    ['date_au', function(v) {
      if (Vanadium.validators_types['empty'].test(v)) return true;
      var regex = /^(\d{2})\/(\d{2})\/(\d{4})$/;
      if (!regex.test(v)) return false;
      var d = new Date(v.replace(regex, '$2/$1/$3'));
      return ( parseInt(RegExp.$2, 10) == (1 + d.getMonth()) ) && (parseInt(RegExp.$1, 10) == d.getDate()) && (parseInt(RegExp.$3, 10) == d.getFullYear() );
    }, '请输入正确的日期格式,比如:28/05/2010.'],
    //输入固定长度字符串
    ['length',
      function (v, p) {
        if (p === undefined) {
          return true
        } else {
          return v.length == parseInt(p)
        }
        ;
      },
      function (_v, p) {
        return '输入字符长度等于<span class="' + Vanadium.config.message_value_class + '">' + p + '</span>个.'
      }
    ],
    //
    ['min_length',
      function (v, p) {
        if (p === undefined) {
          return true
        } else {
          return v.length >= parseInt(p)
        }
        ;
      },
      function (_v, p) {
        return '输入字符长度不低于<span class="' + Vanadium.config.message_value_class + '">' + p + '</span>个.'
      }
    ],
    ['max_length',
      function (v, p) {
        if (p === undefined) {
          return true
        } else {
          return v.length <= parseInt(p)
        }
        ;
      },
      function (_v, p) {
        return '输入字符长度不大于<span class="' + Vanadium.config.message_value_class + '">' + p + '</span>个.'
      }
    ],
	//判断密码是相同
    ['same_as',
      function (v, p) {
        if (p === undefined) {
          return true
        } else {
          var exemplar = document.getElementById(p);
          if (exemplar)
            return v == exemplar.value;
          else
            return false;
        }
        ;
      },
      function (_v, p) {
        var exemplar = document.getElementById(p);
        if (exemplar)
          return '两次密码输入不相同.';
        else
          return '没有可参考值!'
      },
      "",
      function(validation_instance) {
        var exemplar = document.getElementById(validation_instance.param);
        if (exemplar){
          jQuery(exemplar).bind('validate', function(){
            jQuery(validation_instance.element).trigger('validate');
          });
        }
      }
    ],
	//ajax判断是否存在值
    ['ajax',
      function (v, p, validation_instance, decoration_context, decoration_callback) {
        if (Vanadium.validators_types['empty'].test(v)) return true;
        if (decoration_context && decoration_callback) {
          jQuery.getJSON(p, {value: v, id: validation_instance.element.id}, function(data) {
            decoration_callback.apply(decoration_context, [[data], true]);
          });
        }
        return true;
      }]
    ,
	//正则匹配,此用法不甚理解
    ['format',
      function(v, p) {
        var params = p.match(/^\/(((\\\/)|[^\/])*)\/(((\\\/)|[^\/])*)$/);        
        if (params.length == 7) {
          var pattern = params[1];
          var attributes = params[4];
          try
          {
            var exp = new RegExp(pattern, attributes);
            return exp.test(v);
          }
          catch(err)
          {
            return false
          }
        } else {
          return false
        }
      },
      function (_v, p) {
        var params = p.split('/');
        if (params.length == 3 && params[0] == "") {
          return '号码15位或18位.';
        } else {
          return '身份号码格式错误.';
        }
      }
    ]
  ])
  if (typeof(VanadiumCustomValidationTypes) !== "undefined" && VanadiumCustomValidationTypes) Vanadium.addValidatorTypes(VanadiumCustomValidationTypes);
};
function checkParseIdCard(val) {
    
	var val = trim(val);
	var msg = checkIdcard(val);
	if (msg != "验证通过!") {
		//alert(msg);
    //stopDefault(e); 
		return false;
	}
return true;
//	var birthdayValue;
//	var sexId;
//	var sexText;
//	var age;
//
//	if (15 == val.length) { //15位身份证号码
//		birthdayValue = val.charAt(6) + val.charAt(7);
//		if (parseInt(birthdayValue) < 10) {
//			birthdayValue = '20' + birthdayValue;
//		} else {
//			birthdayValue = '19' + birthdayValue;
//		}
//		birthdayValue = birthdayValue + '-' + val.charAt(8) + val.charAt(9)
//				+ '-' + val.charAt(10) + val.charAt(11);
//		if (parseInt(val.charAt(14) / 2) * 2 != val.charAt(14)) {
//			sexId = "1";
//			sexText = "男";
//		} else {
//			sexId = "2";
//			sexText = "女";
//		}
//	}
//	if (18 == val.length) { //18位身份证号码
//		birthdayValue = val.charAt(6) + val.charAt(7) + val.charAt(8)
//				+ val.charAt(9) + '-' + val.charAt(10) + val.charAt(11) + '-'
//				+ val.charAt(12) + val.charAt(13);
//		if (parseInt(val.charAt(16) / 2) * 2 != val.charAt(16)) {
//			sexId = "1";
//			sexText = "男";
//		} else {
//			sexId = "2";
//			sexText = "女";
//		}
//	}
//	//年龄
//	var dt1 = new Date(birthdayValue.replace("-", "/"));
//	var dt2 = new Date();
//	var age = dt2.getFullYear() - dt1.getFullYear();
//	var m = dt2.getMonth() - dt1.getMonth();
//	if (m < 0)
//		age--;
//	alert(birthdayValue + sexId + sexText + age);
}
function checkIdcard(idcard) {

 	var Errors = new Array("验证通过!", "身份证号码位数不对!", "身份证号码出生日期超出范围或含有非法字符!",
 			"身份证号码校验错误!", "身份证地区非法!");

  	var area={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",
  	  23:"黑龙江",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",
  	  41:"河南",42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",
  	  52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",
  	  71:"台湾",81:"香港",82:"澳门",91:"国外"} 
  	var idcard, Y, JYM;
  	var S, M;
  	var idcard_array = new Array();
  	idcard_array = idcard.split("");
  	//地区检验 
  	if (area[parseInt(idcard.substr(0, 2))] == null)
  		return Errors[4];

	//身份号码位数及格式检验 
	switch (idcard.length) {
	case 15:
		if ((parseInt(idcard.substr(6, 2)) + 1900) % 4 == 0
				|| ((parseInt(idcard.substr(6, 2)) + 1900) % 100 == 0 && (parseInt(idcard
						.substr(6, 2)) + 1900) % 4 == 0)) {
			ereg = /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/; //测试出生日期的合法性 
		} else {
			ereg = /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/; //测试出生日期的合法性 
		}
		if (ereg.test(idcard))
			return Errors[0];
		else
			return Errors[2];
		break;
	case 18:
		//18位身份号码检测 
		//出生日期的合法性检查  
		//闰年月日:((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9])) 
		//平年月日:((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8])) 
		if (parseInt(idcard.substr(6, 4)) % 4 == 0
				|| (parseInt(idcard.substr(6, 4)) % 100 == 0 && parseInt(idcard
						.substr(6, 4)) % 4 == 0)) {
			ereg = /^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/; //闰年出生日期的合法性正则表达式 
		} else {
			ereg = /^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/; //平年出生日期的合法性正则表达式 
		}
		if (ereg.test(idcard)) {//测试出生日期的合法性 
			//计算校验位 
			S = (parseInt(idcard_array[0]) + parseInt(idcard_array[10])) * 7
					+ (parseInt(idcard_array[1]) + parseInt(idcard_array[11]))* 9
					+ (parseInt(idcard_array[2]) + parseInt(idcard_array[12]))* 10
					+ (parseInt(idcard_array[3]) + parseInt(idcard_array[13]))* 5
					+ (parseInt(idcard_array[4]) + parseInt(idcard_array[14]))* 8
					+ (parseInt(idcard_array[5]) + parseInt(idcard_array[15]))* 4
					+ (parseInt(idcard_array[6]) + parseInt(idcard_array[16]))* 2
					+ parseInt(idcard_array[7]) * 1
					+ parseInt(idcard_array[8]) * 6 
					+ parseInt(idcard_array[9]) * 3;
			Y = S % 11;
			M = "F";
			JYM = "10X98765432";
			M = JYM.substr(Y, 1); //判断校验位 
			if (M == idcard_array[17])
				return Errors[0]; //检测ID的校验位 
			else
				return Errors[3];
		} else
			return Errors[2];
		break;
	default:
		return Errors[1];
		break;
	}
}

 /**  
  * 验证18位数身份证号码中的生日是否是有效生日  
  * @param idCard 18位书身份证字符串  
  * @return  
  */  
function isValidityBrithBy18IdCard(idCard18){   
    var year =  idCard18.substring(6,10);   
    var month = idCard18.substring(10,12);   
    var day = idCard18.substring(12,14);   
    var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
    // 这里用getFullYear()获取年份，避免千年虫问题   
    if(temp_date.getFullYear()!=parseFloat(year)   
          ||temp_date.getMonth()!=parseFloat(month)-1   
          ||temp_date.getDate()!=parseFloat(day)){   
            return false;   
    }else{   
        return true;   
    }   
}   
  /**  
   * 验证15位数身份证号码中的生日是否是有效生日  
   * @param idCard15 15位书身份证字符串  
   * @return  
   */  
function isValidityBrithBy15IdCard(idCard15){   
      var year =  idCard15.substring(6,8);   
      var month = idCard15.substring(8,10);   
      var day = idCard15.substring(10,12);   
      var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
      // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法   
      if(temp_date.getYear()!=parseFloat(year)   
              ||temp_date.getMonth()!=parseFloat(month)-1   
              ||temp_date.getDate()!=parseFloat(day)){   
                return false;   
        }else{   
            return true;   
        }   
  }   
//去掉字符串头尾空格   
function trim(str) {   
    return str.replace(/(^\s*)|(\s*$)/g, "");   
}



function getRadioValue(name){
    var radioes = document.getElementsByName(name);
    for(var i=0;i<radioes.length;i++)
    {
         if(radioes[i].checked){
          return radioes[i].value;
         }
    }
    return false;
}
function dump_obj(myObject) {  
  var s = "";  
  for (var property in myObject) {  
   s = s + "\n "+property +": " + myObject[property] ;  
  }  
  //alert(s);  
  return s;
}

// 说明：Javascript 中阻止浏览器默认操作   
  
function stopDefault( e ) {   
 // Prevent the default browser action (W3C)   
 if ( e && e.preventDefault )   
     e.preventDefault();   
    // A shortcut for stoping the browser action in IE   
   else   
       window.event.returnValue = false;   
   return false;   
}  
</script>
<body>
<div id="center">
<div class="webtop"></div>
<div class="nav">
<ul id="nav">
<li class="noactivt"><a href="<?php echo base_url('index.htm');?>">活动介绍</a></li>
<li class="noactivb"><a href="<?php echo base_url('activity.htm');?>">产品介绍</a></li>
<li class="activt"><a href="#">在线申请</a></li>
<li class="noactivb"><a href="http://dskb.hangzhou.com.cn/special/syllw/upload.shtml" target="_blank">视频上传</a></li>
<li class="noactivt"><a href="<?php echo base_url('zjlist.htm');?>">中奖名单</a></li>
</ul>
</div>
<div class="divbg">
<?php echo form_open('index/applynow',array('class'=>"form-horizontal")); ?>
  <fieldset>
    <legend>申请条件</legend>
    <div class="control-group">
      <label class="control-label" for="input01">姓名:</label>
      <div class="controls">
        <input  id="checkempty" type="text" maxlength="6" class=":required input-xlarge" name="username"/>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input01">性别:</label>
      <div class="controls">
            <select id="select01" name="gender">
                <option value="1">男</option>
                <option value="2">女</option>
    </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input01">身份证号码:</label>
      <div class="controls">
      <input type="text" maxlength="18" class=":required :idcard  input-xlarge" name="idcard" />
      <p class="help-block">一个身份证号码,只限申请一次</p>	

      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input01">手机号码:</label>
      <div class="controls">
        <input type="text" maxlength="11" class=":required  input-xlarge" name="phone_number">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input01">手机型号:</label>
      <div class="controls">
      <select id="select01" name="is_smart" style="width: 100px;" >
                <option value="1">智能机</option>
                <option value="2"> 非智能机</option>
        </select>
        <input type="text" class=":required input-xlarge" maxlength="20" name="phone_type" style="width: 165px;" />

      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input01">运营商:</label>

              <div class="controls">
            <select id="select01" name="operator">
                <option value="中国联通">中国联通</option>
                <option value="中国电信">中国电信</option>
                <option value="中国移动">中国移动</option>
    </select>
    <p class="help-block">目前所用手机号码归属运营商</p>
    </div>        
      </div>
    <div class="control-group">
      <label class="control-label" for="input01">月消费流量:</label>

              <div class="controls">
            <select id="select01" name="month_traffic">
                <option>0M</option>
                <option>1M-100M</option>
                <option>101M-500M</option>
                <option>501M-1000M</option>
                <option>1000M以上</option>
    </select>
    <p class="help-block">目前每月手机所消费流量</p>
    </div>        
    </div>
<legend>物流信息</legend>
    <div class="control-group">
      <label class="control-label" for="input01">姓名:</label>
      <div class="controls">
        <input type="text" class=":required input-xlarge" maxlength="6" name="u_name"/>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input01">联系电话:</label>
      <div class="controls">
           <input type="text" class=":required input-xlarge" maxlength="11" name="contact_number"/>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="input01">收货地址:</label>
      
      <div class="controls">浙江省、杭州市、
      <select name="district">
      <option value="上城区">上城区</option>
      <option value="下城区">下城区</option>
      <option value="江干区">江干区</option>
      <option value="拱墅区">拱墅区</option>
      <option value="西湖区">西湖区</option>
      <option value="滨江区">滨江区</option><option value="萧山区">萧山区</option>
      <option value="余杭区">余杭区</option><option value="桐庐县">桐庐县</option>
      <option value="淳安县">淳安县</option><option value="建德市">建德市</option>
      <option value="富阳市">富阳市</option><option value="临安市">临安市</option>
      <option value="其它区">其它区</option>
      </select> 
      </div>
      
    </div>
        <div class="control-group">      
      <div class="controls"><input type="text" class=":required input-xlarge" maxlength="200" name="street"/>    
      </div>      
    </div>
    <p class="help-block">本次活动仅限居住在杭州的用户参加，杭州以外用户请勿填写，谢谢合作！</p>
    <div class="form-actions">
            <button type="submit" class="btn btn-primary">提交申请</button>
            <button class="btn">取消</button>
          </div>
  </fieldset>
</form>
</div>
<div style="background-color: #FFF; padding-left: 45%;">
<a href="http://sighttp.qq.com/authd?IDKEY=5f0dbdfa2c7b06fa6350b72a1f830572f66815efb64dedb5" target="_blank"><img border="0" src="http://wpa.qq.com/imgd?IDKEY=5f0dbdfa2c7b06fa6350b72a1f830572f66815efb64dedb5&amp;pic=47" /></a>
<script language="javascript" type="text/javascript" src="http://js.users.51.la/15359049.js"></script>
<noscript><a href="http://www.51.la/?15359049" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/15359049.asp" style="border:none" /></a></noscript>

</div>
</div>
<div id="qq">
<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=177010011&site=qq&menu=yes"><img border="0" src="<?php echo base_url('style/image/qq.png');?>" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
</div>

</body>
</html>