<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>

<head>
<script type="text/javascript" src="http://sm.xxxxxxxx.cn/libs/js/highcharts/3.0.7/js/highcharts.js"></script>
<script type="text/javascript" src="http://sm.xxxxxxxx.cn/libs/js/highcharts/3.0.7/js/modules/exporting.js"></script>
<script type="text/javascript" src="http://xxxxxxxx-202.xxxxxxxx-inc.cn:8675/js/chart/monitor.js"></script>
</head>

<h1>欢迎来到<i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<p>


<p>
<div>
<p>通过该工具，你可以：</p>
<ul>
<li>快速对一个模块运行的各类数据进行监控, 比如对日志进行扫描，对dm303提供的各类数据进行监控并持久化等;</li>
<li>直观的从Web客户端上看到监控数据的历史曲线图;</li>
<li>通过配置即可随意添加同比、环比、绝对值等基本的校验;</li>
<li>如果监控本身运行异常，你也会及时收到提醒</li>
<li>方便的查看各个监控信息，以及运行状况</li>
<li>还有更多功能在持续开发中。。。</li>
</ul>

</div>

<a id="alarms_valid" title="valid" href="<?php
echo $this->createUrl('groups/index');
?>">开始分组浏览</a>

</div>
