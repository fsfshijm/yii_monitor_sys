#!/bin/bash

PNAME=yii_monitor_sys
VERSION=0.1.11

rm -rf target
mkdir target

SCRATCH_DIR="$PNAME-$VERSION"

cd target
mkdir $SCRATCH_DIR

# 在这里将需要发布的文件，放到scratch目录下
cp -r ../assets  ../build.sh  ../css  ../images  ../index.php  ../js  ../protected  ../README.md  ../themes ../lib $SCRATCH_DIR
#cp -r  ../css ../images ../index.php ../js ../lib ../protected ../themes $SCRATCH_DIR
sed -i -e "s/xxxxxxxx-206.xxxxxxxx-inc.cn/your_domain_name/g" $SCRATCH_DIR/protected/views/objects/view.php
sed -i -e "s/xxxxxxxx-206.xxxxxxxx-inc.cn/your_domain_name/g" $SCRATCH_DIR/protected/views/site/index.php
sed -i -e "s/xxxxxxxx-200.xxxxxxxx-inc.cn/your_db_name/g" $SCRATCH_DIR/protected/config/main.php
sed -i -e "s/port=3306/port=3320/g" $SCRATCH_DIR/protected/config/main.php
sed -i -e "s/'username' => 'qa'/'username' => 'monitor'/g" $SCRATCH_DIR/protected/config/main.php
#mkdir $SCRATCH_DIR/assets
mkdir -p $SCRATCH_DIR/protected/runtime

# 删除log日志信息
#rm -rf $SCRATCH_DIR/protected/runtime/*
rm -f $SCRATCH_DIR/protected/runtime/application.log

# 删除svn目录
find . -name '.svn' -exec rm -rf {} \; 2>/dev/null
find . -name *~ -exec rm -rf {} \; 2>/dev/null

tar czf $SCRATCH_DIR.tar.gz $SCRATCH_DIR
# 运行时目录，需要在puppet的配置中去设置0777权限
#fpm -s dir -t rpm -n $PNAME -v $VERSION --epoch=`date +%s` --prefix=/usr/local/xxxxxxxx/prog.d $SCRATCH_DIR

rm -rf $SCRATCH_DIR

