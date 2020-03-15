<div id="article_content" class="article_content clearfix">
            <link rel="stylesheet" href="https://csdnimg.cn/release/phoenix/template/css/ck_htmledit_views-833878f763.css">
                                        <link rel="stylesheet" href="https://csdnimg.cn/release/phoenix/template/css/ck_htmledit_views-833878f763.css">
                <div class="htmledit_views" id="content_views">
                                            <p>xshell输入主机地址，输入用户名密码就可以连接该主机，虚拟机由于ip是动态的，所以设置为静态方便今后用xshell连接。</p>

<p>&nbsp;</p>

<p>先查看虚拟机的网络编辑</p>

<p><img alt="" class="has" height="461" src="https://img-blog.csdnimg.cn/20190816103230977.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzM5MzE0MDk5,size_16,color_FFFFFF,t_70" width="806"></p>

<p>查看nat模式，这里的nat模式可以自动分配ip地址，也可以手动设置ip，为了以后连接方便，这里会改为静态ip。这个模式下的虚拟机是可以和主机互相访问，也可以访问外网，但是不能访问主机所在网络的其他计算机。</p>

<p><img alt="" class="has" height="363" src="https://img-blog.csdnimg.cn/20190820105200318.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzM5MzE0MDk5,size_16,color_FFFFFF,t_70" width="573"></p>

<p>&nbsp;</p>

<p>ip，掩码，网关这三个信息需要设置在centos网卡中，后续提到。</p>

<p><img alt="" class="has" height="273" src="https://img-blog.csdnimg.cn/20190820105138138.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzM5MzE0MDk5,size_16,color_FFFFFF,t_70" width="575"></p>

<p>下一步进入虚拟机centos中，进行网卡配置：</p>

<p>查找网卡（不知道网卡名称时，可以输入/etc/sysconfig/network-scripts/ifcfg-进行双击tab会列出），网卡就是ifcfg-ens33</p>

<p><img alt="" class="has" height="166" src="https://img-blog.csdnimg.cn/2019081610580659.png" width="610"></p>

<p>然后vi进去修改</p>

<p><img alt="" class="has" height="241" src="https://img-blog.csdnimg.cn/20190820105343689.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzM5MzE0MDk5,size_16,color_FFFFFF,t_70" width="380"></p>

<p>这两项要修改，</p>

<p>dhcp改为static，静态ip。</p>

<p>onboot该为yes，开机启动。</p>

<p>下面四项要增加</p>

<p><img alt="" class="has" height="319" src="https://img-blog.csdnimg.cn/20190820105433980.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzM5MzE0MDk5,size_16,color_FFFFFF,t_70" width="367"></p>

<p>ip addr根据上面在虚拟机设置中看到的ip地址得来，123是我自定义的一个，范围需要在虚拟机网络配置中查看：</p>

<p><img alt="" class="has" height="513" src="https://img-blog.csdnimg.cn/20191124154720694.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzM5MzE0MDk5,size_16,color_FFFFFF,t_70" width="574"></p>

<p>需要在这里的起始和结束区间内，这个区间是可以修改的。</p>

<p>保存退出，然后重启网卡服务，systemctl restart network</p>

<p>没有报错一般就是成功了，也可以输入systemctl status network查看状态，如果下面有个绿色的active就证明成功。</p>

<p>然后开启ssh：systemctl start sshd，服务状态同上。</p>

<p>输入 ip addr可以查看设置成功的ip地址</p>

<p><img alt="" class="has" height="220" src="https://img-blog.csdnimg.cn/20190820105530119.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzM5MzE0MDk5,size_16,color_FFFFFF,t_70" width="807"></p>

<p>&nbsp;</p>

<p>这时就可以用xshell连接了，输入地址，用户名密码就可以了。</p>
                                    </div>
                                                <div class="more-toolbox">
                <div class="left-toolbox">
                    <ul class="toolbox-list">
                        
                        