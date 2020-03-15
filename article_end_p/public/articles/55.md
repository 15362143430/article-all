<div id="article_content" class="article_content clearfix">
            <link rel="stylesheet" href="https://csdnimg.cn/release/phoenix/template/css/ck_htmledit_views-833878f763.css">
                                        <div id="content_views" class="markdown_views prism-dracula">
                    <!-- flowchart 箭头图标 勿删 -->
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <path stroke-linecap="round" d="M5,0 0,2.5 5,5z" id="raphael-marker-block" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                    </svg>
                                            <h2><a name="t0"></a><a id="windowLinux_0"></a>小白如何在window电脑上安装Linux系统（虚拟机）</h2>
<p><strong>一、软件准备。</strong></p>
<p><em>1、 VMware软件</em></p>
<ul>
<li>下载地址1（迅雷）：<a href="http://forspeed.onlinedown.net/down/vmware15.zip" rel="nofollow">http://forspeed.onlinedown.net/down/vmware15.zip</a></li>
<li>下载地址2（网盘-提取码：eom3）：<a href="https://pan.baidu.com/s/1UpiQjV4io4bmrMna0irLAg" rel="nofollow">https://pan.baidu.com/s/1UpiQjV4io4bmrMna0irLAg</a></li>
</ul>
<p><em>2、Linux系统</em></p>
<ul>
<li>Ubuntu16.04版本下载（提取码：nxdf）：<a href="https://pan.baidu.com/s/16ncSr8AqNEzMxN68_48z6A" rel="nofollow">https://pan.baidu.com/s/16ncSr8AqNEzMxN68_48z6A</a></li>
<li>Ubuntu18.04版本下载（提取码：erhb）： <a href="https://pan.baidu.com/s/1Yvf1a711W84JrmjMeqELig" rel="nofollow">https://pan.baidu.com/s/1Yvf1a711W84JrmjMeqELig</a></li>
</ul>
<p><strong>二、VMware软件安装</strong></p>
<p><em>1、解压VMware压缩包得到下图所示文件：</em><br>
<img src="https://img-blog.csdnimg.cn/20190321123911267.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
<em>2、打开安装包</em><br>
<img src="https://img-blog.csdnimg.cn/2019032112405527.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
<em>3、按照安装指示完成安装，安装过程中会重置网络，出现网络断开的现象，属于正常现象。</em></p>
<p><em>4、打开VMware，出现输入密钥界面，这时候就要用到密钥生成器了，由于我已经破解成功，就不截密钥界面了，密钥生成器界面如下：</em></p>
<p><img src="https://img-blog.csdnimg.cn/20190321130320498.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"></p>
<ul>
<li>点击Generate键生成密匙，复制左侧密匙粘贴在VMware密匙界面里，回车确认即可破解软件</li>
</ul>
<p><strong>三、在VMware上安装linux系统</strong></p>
<p><em>1、打开VMware界面如下所示</em><br>
<img src="https://img-blog.csdnimg.cn/20190321130720667.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
<em>2、点击创建新的虚拟机</em><br>
<img src="https://img-blog.csdnimg.cn/20190321130904305.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"></p>
<ul>
<li>选择自定义安装，点击下一步</li>
</ul>
<p><em>3、继续选择下一步</em><br>
<img src="https://img-blog.csdnimg.cn/20190321160544263.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
4、<em>选择光盘映像文件，导入的文件为下载的Ubuntu18.04（或者Ubuntu16.04）Linux系统，然后点击下一步：</em><br>
<img src="https://img-blog.csdnimg.cn/20190321160752953.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
<em>5、输入你的信息，然后点击下一步</em><br>
<img src="https://img-blog.csdnimg.cn/20190321160942374.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"></p>
<p><em>6、输入你的虚拟机名称，按照惯例名称一般不要出现中文，并选择虚拟机部署的位置，然后点击下一部</em><br>
<img src="https://img-blog.csdnimg.cn/2019032116130074.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
<em>7、依据你电脑的情况选择分配给这台虚拟机的CPU，如果不清楚自己的电脑情况，建议选少一点，不然运行起来对主系统速度影响会很大。然后点击下一步</em></p>
<p><img src="https://img-blog.csdnimg.cn/20190321161511352.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
<em>8、调整你想要分配给虚拟机的内存，分配原则和上面一样，一般电脑总运行内存4G，调整完成后点击下一步。</em><br>
<img src="https://img-blog.csdnimg.cn/20190321161747293.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
<em>9、如无特殊情况，使用网络地址转换，然后点击下一步</em><br>
<img src="https://img-blog.csdnimg.cn/20190321161919540.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
10、I/O控制器类型选择默认类型，然后点击下一步<br>
<img src="https://img-blog.csdnimg.cn/20190321162047978.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
11、磁盘类型选择默认类型，然后点击下一步<br>
<img src="https://img-blog.csdnimg.cn/20190321162132541.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
12、如无特殊情况，选择创建新的虚拟磁盘，然后点击下一步<br>
<img src="https://img-blog.csdnimg.cn/20190321162239640.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
13、选择分配给磁盘的大小，分配原则与CPU、内存一样。选择将虚拟磁盘存储为一个文件，方便管理，然后点击下一步<br>
<img src="https://img-blog.csdnimg.cn/20190321162438772.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
14、给磁盘文件命名，一般不要出现中文，然后点击下一步<br>
<img src="https://img-blog.csdnimg.cn/20190321162541784.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
15、核对虚拟机的各种参数，然后点击完成，虚拟机即会自动安装完成<br>
<img src="https://img-blog.csdnimg.cn/20190321162636593.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"></p>
<p>16、安装完成后打开虚拟机如图所示，一般点击全屏以自适应屏幕大小<br>
<img src="https://img-blog.csdnimg.cn/20190321163111610.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NDE0NTMwMA==,size_16,color_FFFFFF,t_70" alt="在这里插入图片描述"><br>
<strong>到此Linux虚拟机安装完成</strong></p>

                                   