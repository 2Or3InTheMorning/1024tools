set names utf8mb4;

CREATE TABLE `tools` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(1024) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tools` VALUES (1,'JSON格式化','JSON格式化、JSON压缩、JSON在线解析、JSON验证','format.json',1,'json、json格式化、json检验、json在线格式化、jsongsh、jsongeshihua',1);
INSERT INTO `tools` VALUES (2,'Base64编码解码','Base64解码、Base64编码、base64加密解密','convert.base64',1,'Base64解码、Base64编码、base64加密解密、base64encode/base64decode',1);
INSERT INTO `tools` VALUES (3,'ASCII码表','ASCII表、ASCII码表、ASCII码查询','manual.ascii',1,'ASCII表、ASCII码表、ASCII码查询',1);
INSERT INTO `tools` VALUES (4,'URL编码解码','URL解码、URL编码、urlencode、urldecode','convert.urlencode',1,'URL编码解码、URL解码、URL编码、urlencode/urldecode',1);
INSERT INTO `tools` VALUES (5,'Markdown在线编辑器','Markdown在线编辑、实时预览、markdown转html','convert.markdown',1,'Markdown在线编辑、实时预览、md',1);
INSERT INTO `tools` VALUES (6,'Http Headers查看','Http Headers查看、HTTP请求头查看、HTTP响应头查看','http.header',1,'Http Headers查看、HTTP请求头查看、HTTP响应头查看、httpheaders、useragent、ua、user-agent',1);
INSERT INTO `tools` VALUES (7,'jQuery文档','jQuery文档、jQuery在线速查表','manual.jquery',1,'jQuery中文文档、jQuery速查表、jQuery在线手册 jqueryapis jquerydocs jquery apis jquery docs',1);
INSERT INTO `tools` VALUES (8,'IP查询','IP查询、IP地址查询、IP归属地查询','http.ip',1,'IP查询、IP地址查询、IP归属地查询、ipaddress',1);
INSERT INTO `tools` VALUES (9,'XML/JSON转换','XML转JSON、JSON转XML、JSON/XML互转','convert.xmljson',1,'XML转JSON、JSON转XML、JSON/XML互转、xmljsonxml json2xml2json jsonxml xmljson',1);
INSERT INTO `tools` VALUES (10,'HTTP状态码','HTTP状态码、HTTP Status Code、HTTP常见状态码查询','manual.httpStatusCode',1,'HTTP状态码、HTTP Status Code、HTTP常见状态码查询 httpstatuscode http-status-code http status code',1);
INSERT INTO `tools` VALUES (11,'LESS编译','LESS编译、LESS转换为CSS、LESS编译为CSS','convert.less',1,'LESS编译、LESS转换为CSS、LESS编译为CSS lesscss',1);
INSERT INTO `tools` VALUES (12,'HASH计算/MD5/SHA1','Hash在线计算、md5计算、sha1计算、sha256计算、sha512计算','encrypt.hash',1,'Hash在线计算、md5计算、sha1计算、sha256计算、sha512计算md2 md4 md5 sha1 sha224 sha256 sha384 sha512 ripemd128 ripemd160 ripemd256 ripemd320 whirlpool tiger128,3 tiger160,3 tiger192,3 tiger128,4 tiger160,4 tiger192,4 snefru snefru256 gost adler32 crc32 crc32b fnv132 fnv164 joaat haval128,3 haval160,3 haval192,3 haval224,3 haval256,3 haval128,4 haval160,4 haval192,4 haval224,4 haval256,4 haval128,5 haval160,5 haval192,5 haval224,5 haval256,5',1);
INSERT INTO `tools` VALUES (13,'代码高亮/着色/美化','代码高亮、代码着色、在线美化','format.highlight',1,'代码高亮、代码着色、在线美化 codehighlight hl',1);
INSERT INTO `tools` VALUES (14,'HMAC计算','HMAC计算、HMAC-MD5、HMAC-SHA1、HMAC-SHA256、HMAC-SHA512在线计算','encrypt.hmac',1,'hmac、hmac-sha1 hmac-md5 hmac-sha256 hmac-512',1);
INSERT INTO `tools` VALUES (15,'随机数/密码生成','随机数生成、随机字符串生成、random、密码生成器','extra.random',1,'随机数生成、随机字符串生成、random、密码生成器',1);
INSERT INTO `tools` VALUES (16,'SQL格式化/压缩','SQL格式化、SQL压缩、SQL高亮、SQL FORMATTER','format.sql',1,'SQL格式化、SQL压缩、SQL高亮、SQLFORMATTER',1);
INSERT INTO `tools` VALUES (17,'UNIX时间戳转换','UNIX时间戳转换、UNIX时间戳普通时间相互转换、unix timestamp转换','convert.timestamp',1,'unix timestamp time stamp unix时间戳 unixshijianchuo',1);
INSERT INTO `tools` VALUES (18,'UUID生成','UUID生成、UUID在线生成','extra.uuid',1,'UUID在线生成',1);
INSERT INTO `tools` VALUES (19,'PHP反序列化','PHP在线反序列化工具 unserialize serialize','convert.unserialize',1,'php在线反序列化工具 php unserialize serialize phpfanxuliehua',1);

CREATE TABLE `typos` (
  `id` int(10) UNSIGNED NOT NULL,
  `typo` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `typo` (`typo`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `typos` VALUES (1,'xml2json','convert.xmljson');
INSERT INTO `typos` VALUES (2,'json2xml','convert.xmljson');
INSERT INTO `typos` VALUES (3,'jsonxml','convert.xmljson');
INSERT INTO `typos` VALUES (4,'ipaddress','http.ip');
INSERT INTO `typos` VALUES (5,'headers','http.header');
INSERT INTO `typos` VALUES (9,'md','convert.markdown');
INSERT INTO `typos` VALUES (10,'xmltojson','convert.xmljson');
INSERT INTO `typos` VALUES (11,'jsontoxml','convert.xmljson');
INSERT INTO `typos` VALUES (12,'jsonformat','format.json');
INSERT INTO `typos` VALUES (13,'base64encode','convert.base64');
INSERT INTO `typos` VALUES (14,'base64decode','convert.base64');
INSERT INTO `typos` VALUES (15,'base64_encode','convert.base64');
INSERT INTO `typos` VALUES (16,'base64_decode','convert.base64');
INSERT INTO `typos` VALUES (17,'base64-encode','convert.base64');
INSERT INTO `typos` VALUES (18,'base64-decode','convert.base64');
INSERT INTO `typos` VALUES (19,'url_encode','convert.urlencode');
INSERT INTO `typos` VALUES (20,'url_decode','convert.urlencode');
INSERT INTO `typos` VALUES (21,'url-encode','convert.urlencode');
INSERT INTO `typos` VALUES (22,'url-decode','convert.urlencode');
INSERT INTO `typos` VALUES (23,'jq','manual.jquery');
INSERT INTO `typos` VALUES (24,'md2','encrypt.hash');
INSERT INTO `typos` VALUES (25,'md4','encrypt.hash');
INSERT INTO `typos` VALUES (26,'md5','encrypt.hash');
INSERT INTO `typos` VALUES (27,'sha1','encrypt.hash');
INSERT INTO `typos` VALUES (28,'sha224','encrypt.hash');
INSERT INTO `typos` VALUES (29,'sha256','encrypt.hash');
INSERT INTO `typos` VALUES (30,'sha384','encrypt.hash');
INSERT INTO `typos` VALUES (31,'sha512','encrypt.hash');
INSERT INTO `typos` VALUES (32,'ripemd128','encrypt.hash');
INSERT INTO `typos` VALUES (33,'ripemd160','encrypt.hash');
INSERT INTO `typos` VALUES (34,'ripemd256','encrypt.hash');
INSERT INTO `typos` VALUES (35,'ripemd320','encrypt.hash');
INSERT INTO `typos` VALUES (36,'whirlpool','encrypt.hash');
INSERT INTO `typos` VALUES (37,'tiger128,3','encrypt.hash');
INSERT INTO `typos` VALUES (38,'tiger160,3','encrypt.hash');
INSERT INTO `typos` VALUES (39,'tiger192,3','encrypt.hash');
INSERT INTO `typos` VALUES (40,'tiger128,4','encrypt.hash');
INSERT INTO `typos` VALUES (41,'tiger160,4','encrypt.hash');
INSERT INTO `typos` VALUES (42,'tiger192,4','encrypt.hash');
INSERT INTO `typos` VALUES (43,'snefru','encrypt.hash');
INSERT INTO `typos` VALUES (44,'snefru256','encrypt.hash');
INSERT INTO `typos` VALUES (45,'gost','encrypt.hash');
INSERT INTO `typos` VALUES (46,'adler32','encrypt.hash');
INSERT INTO `typos` VALUES (47,'crc32','encrypt.hash');
INSERT INTO `typos` VALUES (48,'crc32b','encrypt.hash');
INSERT INTO `typos` VALUES (49,'fnv132','encrypt.hash');
INSERT INTO `typos` VALUES (50,'fnv164','encrypt.hash');
INSERT INTO `typos` VALUES (51,'joaat','encrypt.hash');
INSERT INTO `typos` VALUES (52,'haval128,3','encrypt.hash');
INSERT INTO `typos` VALUES (53,'haval160,3','encrypt.hash');
INSERT INTO `typos` VALUES (54,'haval192,3','encrypt.hash');
INSERT INTO `typos` VALUES (55,'haval224,3','encrypt.hash');
INSERT INTO `typos` VALUES (56,'haval256,3','encrypt.hash');
INSERT INTO `typos` VALUES (57,'haval128,4','encrypt.hash');
INSERT INTO `typos` VALUES (58,'haval160,4','encrypt.hash');
INSERT INTO `typos` VALUES (59,'haval192,4','encrypt.hash');
INSERT INTO `typos` VALUES (60,'haval224,4','encrypt.hash');
INSERT INTO `typos` VALUES (61,'haval256,4','encrypt.hash');
INSERT INTO `typos` VALUES (62,'haval128,5','encrypt.hash');
INSERT INTO `typos` VALUES (63,'haval160,5','encrypt.hash');
INSERT INTO `typos` VALUES (64,'haval192,5','encrypt.hash');
INSERT INTO `typos` VALUES (65,'haval224,5','encrypt.hash');
INSERT INTO `typos` VALUES (66,'haval256,5','encrypt.hash');
INSERT INTO `typos` VALUES (67,'hl','format.highlight');
INSERT INTO `typos` VALUES (68,'hightlight','format.highlight');
INSERT INTO `typos` VALUES (69,'codehighlight','format.highlight');
INSERT INTO `typos` VALUES (70,'rand','extra.random');
INSERT INTO `typos` VALUES (71,'ramdom','extra.random');
INSERT INTO `typos` VALUES (72,'ramdon','extra.random');
INSERT INTO `typos` VALUES (73,'ramd','extra.random');
INSERT INTO `typos` VALUES (74,'sqlformatter','format.sql');
INSERT INTO `typos` VALUES (75,'sql-format','format.sql');
INSERT INTO `typos` VALUES (76,'sql-formatter','format.sql');
INSERT INTO `typos` VALUES (77,'sql','format.sql');
INSERT INTO `typos` VALUES (78,'sqlformater','format.sql');
INSERT INTO `typos` VALUES (79,'sql-formater','format.sql');
INSERT INTO `typos` VALUES (80,'time-stamp','convert.timestamp');
INSERT INTO `typos` VALUES (81,'unix-timestamp','convert.timestamp');
INSERT INTO `typos` VALUES (82,'unix_timestamp','convert.timestamp');
INSERT INTO `typos` VALUES (83,'unixtime','convert.timestamp');
INSERT INTO `typos` VALUES (84,'unix_time','convert.timestamp');
INSERT INTO `typos` VALUES (85,'unix_time_stamp','convert.timestamp');
INSERT INTO `typos` VALUES (86,'serialize','convert.unserialize');