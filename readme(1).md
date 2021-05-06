# Backend

## install project dependencies

```
cd server
npm install
or yarn install
```

## run project

```
cd server
npm run start
or yarn start
```

> terminal console http://127.0.0.1:5100/api and Connected to mongodb success, backend run success

# Fronend

## install project dependencies

```
cd client
npm install
or yarn install
```

## run project

```
cd client
npm run start
or yarn start
```

> terminal console Local: http://localhost:3000 , fronend run success

### Pack Project

```
cd client
npm run build
or yarn build
```

## Project directory structure

[ 要求 ]
ThinkPHP3.1需要PHP5.2.0以上版本支持，可以运行在任何系统环境下面。 
因本次上传视频需要ffmag支持所有使用的php5.5
[ 安装 ]
ThinkPHP无需安装，下载ThinkPHP核心包或者完整版之后，把解压后的目录拷贝到
你的WEB服务器或者WEB目录即可。
本次开发用的ThinkPHP3.1内核为基础，扩展支持组件ffmag视频解码功能
```
.
|-- home        ------------------------主目录模块 
|   |--Common   -----------------基础函数库目录  里面放置一些自己写的函数
|       |-- common.php ------------ 定义的常用的 函数， D(),U(),M(),C() ...
|   |-- Conf----------------------------config配置文件   M()调用数据库表
|       |-- config.php
|   |-- Lib-------------------------------模块控制器目录
|       |-- Action------------------------模块视图文件目录
|           |-- AjaxAction.class.php------------------Ajax即时数据调用 如用户下载判断 签到
|           |-- CommonAction.class.php-----------------------扩展控制器 如果邮箱验证和网站信息
|           |-- CustomAction.class.php
|           |-- IndexAction.class.php
|           |-- ModelAction.class.php-----------------------列表页 实例化模型
|           |-- PublicAction.class.php-----------------------数据控制 如登录 邮箱发送随机验证数据及回传
|           |-- SearchAction.class.php-----------------------类目列表传值
|           |-- ServiceAction.class.php -----------------------用户操作主控制 如 关注 收藏 导航 上传
|           |-- SingleAction.class.php -----------------------引用控制 
|           |-- TestAction.class.php
|           |-- UploadAction.class.php ----------------------上传视频文件主控制 限制文件大小 格式 判断是否重复 解码 保存视频文件
|       |-- Model------------------------模块模型目录 (M 数据库的操作)
|           |-- ChatModel.class.php -----------------------作品分页
|           |-- TradeCustomModel.class.php 
|           |-- TradeCustomModel.class.php -----------------------查询分页
|           |-- ClassifyModel.class.php -----------------------调用分类模型
|           |-- ClassifyModel.class.php -----------------------下载信息获取收藏信息列表
|           |-- OpusFavoriteModel.class.php -----------------------获取收藏信息列表
|           |-- OpusModel.class.php -----------------------首页作品列表
|           |-- UserAccountModel.class.php -----------------------更新用户
|           |-- UserConsumeModel.class.php -----------------------首页作品列表
|           |-- UserFocusModel.class.php -----------------------获取关注信息
|           |-- UserFocusModel.class.php -----------------------获取关注信息
|           |-- UserModel.class.php -----------------------用户信息
|   |--Runtime   -----------------里面包含程序运行时产生的一些文件
|       |-- Cache
|       |-- Data
|       |-- Temp
|       |-- Logs
|   |--Tpl   -----------------TP框架前端模板html
|       |-- mall
|           |-- Index
|               |-- index.html-------------首页模板
|           |-- Info
|               |-- index.html-------------用户信息修改模板
|               |-- password.html-------------用户密码修改模板
|               |-- password.html-------------用户密码修改模板
|       |   |-- Model
|               |-- index.html-------------用户搜索视频详细信息模板
|               |-- loading.html-------------视频下载模板
|               |-- model.html-------------用户视频播放页面模板
|       |   |-- Public
|               |-- 404.html
|               |-- footer.html-------------底部引用模板
|               |-- forget_1.html-------------密码找回引用模板
|               |-- forget_2.html-------------密码找回引用模板
|               |-- forget_3.html-------------密码找回引用模板
|               |-- forget_4.html-------------密码找回引用模板
|               |-- head.html-------------头部引用模板
|               |-- login.html-------------登录引用模板
|               |-- register.html-------------注册引用模板
|               |-- right.html-------------右侧信息引用模板
|               |-- userheader.html-------------用户中心顶部引用模板
|               |-- usermsg.html-------------用户中心顶部引用模板
|       |   |-- Search
|               |-- index.html-------------搜索引用模板
|       |   |-- Service
|               |-- Content
|                   |-- collect_focus.html-------------我的收藏
|                   |-- down_upload.html-------------下载
|               |-- Information
|                   |-- modify_data.html-------------信息修改
|                   |-- renzheng_data.html-------------实名认证
|                   |-- station_message.html-------------我的消息
|               |-- Quick
|                   |-- material_upload.html-------------上传作品
|               |-- close.html-------------关闭窗口
|               |-- index.html-------------个人管理中心
|               |-- main.html-------------会员管理中心
|               |-- materialupload.html-------------会员上传
|               |-- upload.html-------------会员上传
|           |-- Single
|               |-- about.html-------------关于
|               |-- agreement.html-------------条款协议
|               |-- personal.html-------------个人空间
--
|-- Admin        ------------------------网站后台主目录 
|   |-- Conf----------------------------config配置文件   M()调用数据库表
|       |-- config.php
|   |--Runtime   -----------------里面包含程序运行时产生的一些文件
|       |-- Cache
|       |-- Data
|       |-- Temp
|       |-- Logs
|   |-- Lib-------------------------------模块控制器目录
|       |-- Action------------------------模块视图文件目录
|           |-- AccountAction.class.php------------------用户L币购买记录
|           |-- AdminAction.class.php------------------管理信息修改
|           |-- ClassifyAction.class.php------------------类目管理
|           |-- CommonAction.class.php------------------站点信息修改
|           |-- IndexAction.class.php------------------站点信息修改
|           |-- IndexAction.class.php------------------后台首页模块
|           |-- InformationAction.class.php------------------消息管理模块
|           |-- InformationAction.class.php------------------消息管理模块
|           |-- InterfaceAction.class.php------------------邮箱管理模块
|           |-- LinkAction.class.php------------------友联管理模块
|           |-- OpusAction.class.php------------------作品管理模块
|           |-- PublicAction.class.php------------------登录管理模块
|           |-- UploadAction.class.php------------------上传管理模块
|           |-- UserAction.class.php------------------认证管理模块
|       |-- Model------------------------模块模型目录 (M 数据库的操作)
|           |-- AdminAccountModel.class.php
|           |-- ChatModel.class.php        ------------------消息
|           |-- ClassifyModel.class.php    ------------------查询
|           |-- NewsModel.class.php        ------------------上传
|           |-- OpusDownloadModel.class.php------------------下载
|           |-- OpusFavoriteModel.class.php------------------收藏
|           |-- OpusModel.class.php        ------------------搜索
|           |-- SysAdsModel.class.php------------------搜索
|           |-- SysLinkModel.class.php------------------搜索
|           |-- TradeCustomModel.class.php------------------搜索
|           |-- UserAccountModel.class.php------------------更新
|           |-- UserConsumeModel.class.php------------------搜索
|           |-- UserFocusModel.class.php  ------------------关注
|           |-- UserModel.class.php  ------------------用户
|           |-- UserRechargeModel.class.php  ------------------搜索
|   |-- Tpl   -----------------TP框架前端模板html
|       |-- Admin
|           |-- cache.html  ------------------缓存
|           |-- person.html  ------------------管理账号修改
|       |-- Classify
|           |-- cache.html  ------------------作品管理
|           |-- sort.html  ------------------作品管理
|       |-- Index
|           |-- data.html  ------------------首页数据
|           |-- detailset.html  ------------------公告设置
|           |-- from.html  ------------------公告设置
|           |-- index.html  ------------------管理系统界面
|           |-- tab.html  ------------------公告界面
|           |-- welcome.html  ------------------左侧界面
|       |-- Information
|           |-- do_edit.html  ------------------信息中心
|           |-- edit.html  ------------------信息中心
|           |-- feedback.html  ------------------反馈
|           |-- replay.html  ------------------消息中心
|       |-- Interface
|           |-- Validate
|               |-- edit.html  ------------------接口
|       |-- Link
|           |-- add.html  ------------------合作管理
|           |-- edit.html  ------------------合作链接
|           |-- index.html  ------------------合作
|       |-- Opus
|           |-- count.html  ------------------作品管理
|           |-- down.html  ------------------下载
|           |-- index.html  ------------------作品
|           |-- upload.html  ------------------作品列表
|           |-- upload-fuben.html  ------------------上传记录


```

>这个系统是一个ThinkPHP3.1内核，通过调用ThinkPHP3.1模块。网页用ajax即时通讯数据，实现页面快速响应，借助ffmag实现视频解码上传分割图片压缩预览视频等功能。
通过M 数据库的操作，及令牌验证数据的安全性。

## UML流程图
###用户案例
网站的主要功能包括:用户登录、注册、邮箱验证、退出、用户中心、上传作品、签到、接收消息、实名认证、作品下载、作品收藏、作家关注、视频预览、视频播放、管理作品、作品审核、实名审核、删除作品、首页展示。，如下图所示
！[](./doc/images/user_case.jpg)
###用户登录
用户登录一个序列图，打开浏览器，输入用户名和密码，点击登录，通过M 数据库的操作。判断用户是否注册，密码是否正确，并将请求通过ajax即时通讯数据返回给前端页面调用方
！[](./doc/images/signin.jpg)
###用户注册
用户注册一个序列图，打开浏览器，输入用户相关注册信息，输入邮箱，点击发送邮箱验证，通过邮箱获取的验证码判断用户邮箱是否注册，如果没有直接下方输入接收到的验证码点击注册，并将请求通过ajax即时通讯数据返回给前端页面调用方完成注册操作。
！[](./doc/images/signin.jpg)
###用户中心
用户中心一个序列图，用户相关信息显示及二级菜单收藏、消息、关注、认证、下载、发布作品等操作。
！[](./doc/images/add_project.jpg)
### 作品上传

用户中心一个序列图，分为源码压缩包上传（支持rar/zip）、视频上传（AE、pr、mp4、wav）常规上传操作。依次选择源码包上传显示进度条提示上传成功、视频上传显示进度条提示上传成功操作，作品和源码上传通过文件身份MD5码验证是否重复来杜绝作品泛滥上传问题。序列图如下。
！[](./doc/images/chat.jpg)

##测试

### 作品上传测试
当测试使用ffmag上传作品时，页面上的每个ffmag调用组件和页面ajax数据交互都经过简单的测试。测试用户作品上传/服务请求/测试保存作品是否正常...


