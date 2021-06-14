

## Project directory structure

[ Environmental requirements ]
ThinkPHP3.1 requires the support of PHP5.2.0 and above, and can run in any system environment.
Because this upload of the video requires ffmag to support all php5.5 used
[ deploy ]
ThinkPHP does not need to be installed. After downloading the ThinkPHP core package or the full version, copy the decompressed directory to
WEB server or WEB directory is fine.
Based on the ThinkPHP3.1 kernel used in this development, the extension supports the ffmag video decoding function of the component
```
.
|-- Public        ------------------------UI Resource Directory
|   |--admin   -----------------Backend UI resource directory
|       |-- css        ------------------------Website css style directory
|       |-- editor        ------------------------Background input frame style catalog
|       |--images        ------------------------Backstage icon picture catalog
|       |--js        ------------------------Call the js directory in the background
|       |--src        ------------------------Call the js directory in the background
|   |--css        ------------------------Website css style directory
|   |--images        ------------------------Website Icon Image Directory 
|   |--js        ------------------------Website call js directory
|   |--upload         ------------------------Website image upload directory
|--Runtime   -----------------It contains some files generated when the program is running
   |-- Cache
   |-- Data
   |-- Temp
   |-- Logs
|--ThinkPHP   -----------------ThinkPHP framework core file directory
|--Uploads   -----------------The main storage directory for uploading user works
|   |--files   -----------------User source file storage directory
|   |--himg   -----------------Large picture storage directory    - -Temporarily useless‘’
|   |--images   -----------------User's work screenshot storage directory
|   |--video   -----------------User's work preview video storage directory
|-- home        ------------------------Home directory module 
|   |--Common   -----------------Basic function library directory 
|       |-- common.php ------------ Commonly used functions 函数， D(),U(),M(),C() ...
|   |-- Conf----------------------------config configuration file   M()Call database table
|       |-- config.php
|   |-- Lib-------------------------------Module Controller Catalog
|       |-- Action------------------------Module view file directory
|           |-- AjaxAction.class.php------------------Ajax real-time data call, such as user download judgment, sign-in
|           |-- CommonAction.class.php-----------------------Extended controller, such as email verification and website information
|           |-- CustomAction.class.php
|           |-- IndexAction.class.php
|           |-- ModelAction.class.php-----------------------List page, instantiated model
|           |-- PublicAction.class.php-----------------------Data control
|           |-- SearchAction.class.php-----------------------Category list pass value
|           |-- ServiceAction.class.php -----------------------User operation master control
|           |-- SingleAction.class.php -----------------------Reference control 
|           |-- TestAction.class.php
|           |-- UploadAction.class.php ----------------------Upload video file master control 
|       |-- Model------------------------Module model catalog 
|           |-- ChatModel.class.php -----------------------Works Pagination
|           |-- TradeCustomModel.class.php 
|           |-- TradeCustomModel.class.php -----------------------Query paging
|           |-- ClassifyModel.class.php -----------------------Call the classification model
|           |-- ClassifyModel.class.php -----------------------Download information to get a list of favorite information
|           |-- OpusFavoriteModel.class.php -----------------------Get a list of favorite information
|           |-- OpusModel.class.php -----------------------Homepage list of works
|           |-- UserAccountModel.class.php -----------------------Update user
|           |-- UserConsumeModel.class.php -----------------------Homepage list of works
|           |-- UserFocusModel.class.php -----------------------Get follow information
|           |-- UserFocusModel.class.php -----------------------Get follow information
|           |-- UserModel.class.php -----------------------User Info
|   |--Runtime   -----------------It contains some files generated when the program is running
|       |-- Cache
|       |-- Data
|       |-- Temp
|       |-- Logs
|   |--Tpl -----------------TP frame front-end template
|       |--mall
|           |--Index
|               |--index.html------------- home page template
|           |--Info
|               |--index.html------------- User Information Modification Template
|               |--password.html------------- User Password Modification Template
|               |--password.html------------- User Password Modification Template
|       |   |--Model
|               |--index.html------------- user search video detail template
|               |--loading.html------------- video download template
|               |--model.html------------- user video playback page template
|       |   |--Public
|               |--404
|               |--footer.html------------- bottom reference template
|               |--forget_1.html------------- Password Retrieval Reference Template
|               |--forget_2.html------------- Password Retrieval Reference Template
|               |--forget_3.html------------- Password Retrieval Reference Template
|               |--forget_4.html------------- Password Retrieval Reference Template
|               |--head.html------------- header reference template
|               |--login.html------------- Login Reference Template
|               |--register.html------------- Registration Reference Template
|               |--right.html------------- right-hand information reference template
|               |--userheader.html------------- User Center Top Reference Template
|               |--usermsg.html------------- User Center Top Reference Template
|       |   |--Search
|               |--index.html------------- Search Reference Template
|       |   |--Service
|               |--Content
|                   |--collect_focus.html------------- my collection
|                   |--down_upload.html------------- Download
|               |--Information
|                   |--modify_data.html------------- information changes
|                   |--renzheng_data.html------------- Real Name Certification
|                   |--station_message.html------------- my news
|               |--Quick
|                   |--material_upload.html------------- upload works
|               |--close.html------------- Close Window
|               |--index.html------------- Personal Management Centre
|               |--main.html------------- Member Management Centre
|               |--materialupload.html------------- member upload
|               |--upload.html------------- member upload
|           |--Single
|               |--about.html------------- on
|               |--agreement.html------------- terms agreement
|               |--personal.html------------- personal Homepage
--
|--Admin ------------------------ Website Background Home
|   |--Conf----------------------------Config configuration file
|       |--config.php
|   |--Runtime ----------------- contains some files generated by the program runtime
|       |--Cache
|       |--Data
|       |--Temp
|       |--Logs
|   |--Lib------------------------------- Module Controller Directory
|       |--Action------------------------ Module View File Directory
|           |--AccountAction.class.php -- User L currency purchase record
|           |--AdminAction.class.php -- Management Information Modification
|           |--ClassifyAction.class.php - Category Management
|           |--CommonAction.class.php -- site information modification
|           |--IndexAction.class.php -- site information modification
|           |--IndexAction.class.php ---background home module
|           |--UserFocusModel.class.php1------ Message management module
|           |--UserFocusModel.class.php1------ Message management module
|           |--UserFocusModel.class.php0- Mailbox Management Module
|           |--UserModel.class.php9---- AIA Management Module
|           |--UserModel.class.php8-- Work Management Module
|           |--UserModel.class.php7- login management module
|           |--UserModel.class.php6------ upload management module
|           |--UserModel.class.php5-- Certification management module
|       |--Model------------------------ module model directory (M database operations)
|           |--UserModel.class.php4
|           |--UserModel.class.php3---- news
|           |--UserModel.class.php2- queries
|           |--UserModel.class.php1-- upload
|           |--UserModel.class.php0- Download
|           |--OpusFavoriteModel.class.php - Collection
|           |--OpusModel.class.php - Search
|           |--SysAdsModel.class.php - Search
|           |--SysLinkModel.class.php - Search
|           |--TradeCustomModel.class.php - Search
|           |--UserAccountModel.class.php - Update
|           |--UserConsumeModel.class.php - Search
|           |--UserFocusModel.class.php - attention
|           |--UserModel.class.php - users
|           |--UserRechargeModel.class.php - Search
|   |--Tpl -----------------TP frame front-end template
|       |--Admin
|           |--cache.html ------------------ cache
|           |--person.html ------------------ management account changes
|       |--Classify
|           |--cache.html ------------------ Works Management
|           |--sort.html ------------------ Works Management
|       |--Index
|           |--data.html ------------------ home page data
|           |--detailset.html ------------------ announcement setup
|           |--from.html ------------------ announcement setup
|           |--index.html ------------------ management system interface
|           |--tab.html ------------------ announcement interface
|           |--welcome.html ------------------ left interface
|       |--Information
|           |--do_edit.html ------------------ Information Centre
|           |--edit.html ------------------ Information Centre
|           |--feedback.html ------------------ feedback
|           |--replay.html ------------------ Information Centre
|       |--Interface
|           |--Validate
|           |--edit.html ------------------ interface
|       |--Link
|           |--add.html ------------------ Cooperation Management
|           |--edit.html ------------------ Cooperation Links
|           |--index.html ------------------ cooperation
|       |--Opus
|           |--count.html ------------------ Works Management
|           |--down.html ------------------ Download
|           |--index.html ------------------ works
|           |--upload.html ------------------ Works List
|           |--upload-fuben.html ------------------ upload records
``
|--aaa.png ------------------------ Preview Video Watermark Call Picture
|--admin.php ------------------------ user background access
|--backstage.php ------------------------ThinkPHP Entry Document
|--ffmpeg.exe ------------------------ffmpeg call run file
|--ffmpeg.exe ------------------------ffmpeg call run file
|--index.php ------------------------ThinkPHP Entry Document
|--progress.php ------------------------session cache settings
|--swfobject.js
```
>This system is a ThinkPHP3.1 kernel, by calling the ThinkPHP3.1 module. The webpage uses ajax instant messaging data to realize quick response to the page, and realizes functions such as video decoding, uploading, segmentation, compression, and preview video with the help of ffmag.
  The security of the data is verified through the operation of the M database and the token.



##test

### Work upload test
When testing uploading works using ffmag, each ffmag calling component on the page and the page ajax data interaction are simply tested. Test whether the user's work upload/service request/test to save the work is normal...


