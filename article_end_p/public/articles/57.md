<div id="article_content" class="article_content clearfix">
            <link rel="stylesheet" href="https://csdnimg.cn/release/phoenix/template/css/ck_htmledit_views-833878f763.css">
                                        <link rel="stylesheet" href="https://csdnimg.cn/release/phoenix/template/css/ck_htmledit_views-833878f763.css">
                <div class="htmledit_views" id="content_views">
                                            <p>更多精彩技术分享请浏览本人博客：<a href="https://blog.csdn.net/wohiusdashi">https://blog.csdn.net/wohiusdashi</a></p>

<h1><a name="t0"></a></h1>

<h1><a name="t1"></a><a name="t1"></a>一、安装YUM Repo</h1>

<h3><a name="t2"></a><a name="t2"></a>1、由于CentOS 的yum源中没有mysql，需要到mysql的官网下载yum repo配置文件。</h3>

<p>下载命令：</p>

<p>wget https://dev.mysql.com/get/mysql57-community-release-el7-9.noarch.rpm</p>

<h3><a name="t3"></a><a name="t3"></a>2、然后进行repo的安装：</h3>

<p>rpm -ivh mysql57-community-release-el7-9.noarch.rpm</p>

<p>执行完成后会在/etc/yum.repos.d/目录下生成两个repo文件mysql-community.repo&nbsp;mysql-community-source.repo</p>

<h1><a name="t4"></a><a name="t4"></a>二、使用yum命令即可完成安装</h1>

<p><strong>注意：必须进入到 /etc/yum.repos.d/目录后再执行以下脚本</strong></p>

<h3><a name="t5"></a><a name="t5"></a>1、安装命令：</h3>

<p>yum install mysql-server</p>

<h3><a name="t6"></a><a name="t6"></a>2、启动msyql：</h3>

<p>systemctl start mysqld #启动MySQL</p>

<h3><a name="t7"></a><a name="t7"></a>3、获取安装时的临时密码（在第一次登录时就是用这个密码）：</h3>

<p>grep 'temporary password' /var/log/mysqld.log</p>

<h3><a name="t8"></a><a name="t8"></a>4、倘若没有获取临时密码，则</h3>

<p>4.1、删除原来安装过的mysql残留的数据</p>

<p>rm -rf /var/lib/mysql</p>

<p>4.2.再启动mysql</p>

<p>systemctl start mysqld #启动MySQL</p>

<h1><a name="t9"></a><a name="t9"></a>三、登录：</h1>

<h3><a name="t10"></a><a name="t10"></a>1、方式一（已验证）：</h3>

<p>mysql -u root -p</p>

<p>然后输入密码（刚刚获取的临时密码）</p>

<h3><a name="t11"></a><a name="t11"></a>2、方式二（未验证）：</h3>

<p>进入mysql数据库</p>

<p>root@test:/home# mysql -uroot -proot&nbsp; &nbsp;&lt;uroot是用户名，proot是密码&gt;</p>

<p>如：</p>

<p>root@test:/home# mysql -root -XXXX</p>

<h3><a name="t12"></a><a name="t12"></a>3、若登录不了，则进行以下配置，跳过登录验证</h3>

<p>3.1、重置密码的第一步就是跳过MySQL的密码认证过程，方法如下：</p>

<p>3.2、vim /etc/my.cnf(注：windows下修改的是my.ini)</p>

<p>在文档内搜索mysqld定位到[mysqld]文本段：</p>

<p>/mysqld(在vim编辑状态下直接输入该命令可搜索文本内容)</p>

<p>在[mysqld]后面任意一行添加“skip-grant-tables”用来跳过密码验证的过程，如下图所示：</p>

<p><img alt="" class="has" height="247" src="https://img-blog.csdnimg.cn/20190417160900803.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dvaGl1c2Rhc2hp,size_16,color_FFFFFF,t_70" width="620"></p>

<p>3.3、保存文档并退出：</p>

<p>#:wq</p>

<p>3.4、<strong>接下来我们需要重启MySQL：</strong></p>

<h1><a name="t13"></a><a name="t13"></a>四、登录成功后修改密码</h1>

<h3><a name="t14"></a><a name="t14"></a>1、注意：这里会进行密码强度校验（密码设置时必须包含大小写字母、特殊符号、数字，并且长度大于8位）</h3>

<h3><a name="t15"></a><a name="t15"></a>2、如不满足以上条件则会报错，如下图：</h3>

<p>密码策略问题异常信息：</p>

<p>ERROR 1819 (HY000): Your password does not satisfy the current policy requirements</p>

<p><img alt="" class="has" height="273" src="https://img-blog.csdnimg.cn/20190417161754664.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dvaGl1c2Rhc2hp,size_16,color_FFFFFF,t_70" width="787"></p>

<p>&nbsp;</p>

<h3><a name="t16"></a><a name="t16"></a>3、解决办法：</h3>

<p>3.1、查看 mysql 初始的密码策略，</p>

<p>&nbsp;</p>

<p>输入语句 “ SHOW VARIABLES LIKE 'validate_password%'; ” 进行查看，</p>

<p>如下图：</p>

<p><img alt="" class="has" height="234" src="https://img-blog.csdnimg.cn/20190417161937367.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dvaGl1c2Rhc2hp,size_16,color_FFFFFF,t_70" width="503"></p>

<p>3.2、首先需要设置密码的验证强度等级，设置 validate_password_policy 的全局参数为 LOW 即可，</p>

<p>输入设值语句 “ set global validate_password_policy=LOW; ” 进行设值，</p>

<p>3.3、当前密码长度为 8 ，如果不介意的话就不用修改了，按照通用的来讲，设置为 6 位的密码，设置 validate_password_length 的全局参数为 6 即可，</p>

<p>输入设值语句 “ set global validate_password_length=6; ” 进行设值，</p>

<p>3.4、现在可以为 mysql 设置简单密码了，只要满足六位的长度即可，</p>

<p>输入修改语句 “ ALTER USER 'root'@'localhost' IDENTIFIED BY '123456';&nbsp;” 可以看到修改成功，表示密码策略修改成功了！！！</p>

<p>3.5、注：在默认密码的长度最小值为 4 ，由 大/小写字母各一个 + 阿拉伯数字一个 + 特殊字符一个，</p>

<p>只要设置密码的长度小于 3 ，都将自动设值为 4 ，</p>

<p>3.6、关于 mysql 密码策略相关参数；</p>

<p>1）、validate_password_length &nbsp;固定密码的总长度；</p>

<p>2）、validate_password_dictionary_file 指定密码验证的文件路径；</p>

<p>3）、validate_password_mixed_case_count &nbsp;整个密码中至少要包含大/小写字母的总个数；</p>

<p>4）、validate_password_number_count &nbsp;整个密码中至少要包含阿拉伯数字的个数；</p>

<p>5）、validate_password_policy 指定密码的强度验证等级，默认为 MEDIUM；</p>

<p>关于 validate_password_policy 的取值：</p>

<p>LOW：只验证长度；</p>

<p>1/MEDIUM：验证长度、数字、大小写、特殊字符；</p>

<p>2/STRONG：验证长度、数字、大小写、特殊字符、字典文件；</p>

<p>6）、validate_password_special_char_count 整个密码中至少要包含特殊字符的个数；</p>

<p>&nbsp;</p>

<h1><a name="t17"></a><a name="t17"></a>五、修改密码</h1>

<h3><a name="t18"></a><a name="t18"></a>1、方式一（已验证）：</h3>

<p>ALTER USER 'root'@'localhost' IDENTIFIED BY '@abcd123456';&nbsp;</p>

<h3><a name="t19"></a><a name="t19"></a>2、方式二（未验证）</h3>

<p>set password=password("yourpassword");&nbsp;</p>

<h1><a name="t20"></a><a name="t20"></a>六、开启远程控制</h1>

<p>MySQL默认是没有开启远程控制的，必须添加远程访问的用户，即默认是只能自己访问，别的机器是访问不了的。</p>

<h3><a name="t21"></a><a name="t21"></a>1、方式一（已验证）：</h3>

<p>　&nbsp; &nbsp;1.1、连接服务器: mysql -u root -p</p>

<p>　　1.2、看当前所有数据库：show databases;</p>

<p>　　1.3、进入mysql数据库：use mysql;</p>

<p>　　1.4、查看mysql数据库中所有的表：show tables;</p>

<p>　　1.5、查看user表中的数据：select Host, User,Password from user;</p>

<p>　　1.6、修改user表中的Host:&nbsp; &nbsp;update user set Host='%' where User='root';&nbsp;&nbsp;</p>

<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 说明：&nbsp;% 代表任意的客户端,可替换成具体IP地址。</p>

<p>　　1.7、最后刷新一下：flush privileges;</p>

<p><strong>&nbsp; &nbsp; &nbsp; &nbsp;1.</strong><strong>8、注意：一定要记得在写sql的时候要在语句完成后加上" ; "</strong></p>

<h3><a name="t22"></a><a name="t22"></a>2、方式二（未验证）：</h3>

<h3><a name="t23"></a><a name="t23"></a>1、使用 grant&nbsp;命令</h3>

<p>grant&nbsp;all privileges on 数据库名.表名 to 创建的用户名(root)@"%" identified by "密码";</p>

<h3><a name="t24"></a><a name="t24"></a>2、格式说明：</h3>

<p>数据库名.表名 如果写成*.*代表授权所有的数据库 flush privileges; #刷新刚才的内容</p>

<p>如：</p>

<p>grant all privileges on *.* to root@"113.123.123.1" identified by "123456789";</p>

<p>@ 后面是访问mysql的客户端IP地址（或是 主机名） % 代表任意的客户端，如果填写 localhost 为本地访问（那此用户就不能远程访问该mysql数据库了）</p>

<p></p>

<h1><a name="t25"></a><a name="t25"></a>&nbsp;七、其他配置</h1>

<h3><a name="t26"></a><a name="t26"></a>1、设置安全选项：</h3>

<p>mysql_secure_installation</p>

<h3><a name="t27"></a><a name="t27"></a>2、关闭MySQL</h3>

<p>systemctl stop mysqld&nbsp;</p>

<h3><a name="t28"></a><a name="t28"></a>3、重启MySQL</h3>

<p>systemctl restart mysqld&nbsp;</p>

<h3><a name="t29"></a><a name="t29"></a>4、查看MySQL运行状态</h3>

<p>systemctl status mysqld&nbsp;</p>

<h3><a name="t30"></a><a name="t30"></a>5、设置开机启动</h3>

<p>systemctl enable mysqld&nbsp;</p>

<h3><a name="t31"></a><a name="t31"></a>6、关闭开机启动</h3>

<p>systemctl disable mysqld&nbsp;</p>

<h3><a name="t32"></a><a name="t32"></a>7、配置默认编码为utf8：</h3>

<p>vi /etc/my.cnf #添加 [mysqld] character_set_server=utf8 init_connect='SET NAMES utf8'</p>

<p>其他默认配置文件路径：&nbsp;</p>

<p>配置文件：/etc/my.cnf 日志文件：/var/log//var/log/mysqld.log 服务启动脚本：/usr/lib/systemd/system/mysqld.service socket文件：/var/run/mysqld/mysqld.pid</p>

<h3><a name="t33"></a><a name="t33"></a>8、查看版本</h3>

<p>select version();</p>



<p></p>

<p></p>
                                    </div>
                                                