- 部署：
    - monitor@192.168.10.101;
    - url 地址: http://qmm.xxxxxxxx-inc.cn:8675/index.php; 
    - apache:/home/monitor/work/apache/httpd.sh start stop
    - yii 框架:/home/monitor/work/yii-1.1.15.022a51 
    - yii app: /home/monitor/work/yii_monitor_sys 
    - mysql: mysql -umonitor -pdmqa714monitor -hqmm.db.in.xxxxxxxx.cn -P3320 monitor

- 升级：
    - apache  ./httpd.sh stop
    - 更新yii app
    - apache ./httpd.sh start