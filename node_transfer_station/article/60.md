<div class="postbody">
            
<div id="cnblogs_post_body" class="blogpost-body ">
    <p>首先，我用navicat去远程链接我虚拟机中的MySQL，链接测试失败。</p>
<p>　　然后在虚拟机中查看网络端口信息：</p>
<p>　　#netstat -ntpl</p>
<p>注意：需要提前安装：yum install net-tools，否则报错：-bash: netstat: command not found&nbsp;</p>
<p><img src="https://img2018.cnblogs.com/blog/1073044/201905/1073044-20190525120705915-722933473.png" alt=""></p>
<p>之后查看了防火墙的状态，发现3306端口的数据包都是丢弃状态</p>
<p>　　#iptables&nbsp;-vnL</p>
<p>注意：需要提前安装：yum install iptables* -y</p>
<p>这里要清除防火墙中链中的规则</p>
<p>　　#iptables&nbsp;-F</p>
<p>&nbsp;</p>
<h2>&nbsp;直接授权(推荐)</h2>
<p>　　从任何主机上使用root用户，密码：youpassword（你的root密码）连接到mysql服务器：<br>　　# mysql -u root -proot&nbsp;<br>　　mysql&gt;GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'youpassword' WITH GRANT OPTION;</p>
<p>&nbsp;</p>
<h2>连接MySQL</h2>
<p>在客户端创建连接</p>
<p><img src="https://img2018.cnblogs.com/blog/1073044/201905/1073044-20190525122201605-635490689.png" alt=""></p>
<p>输入虚拟机的ip地址，这个地址需要从虚拟机获取，虚拟机输入ip addr</p>
<p><img src="https://img2018.cnblogs.com/blog/1073044/201905/1073044-20190525144126559-1564685008.png" alt=""></p>
<p>&nbsp;</p>
<p>&nbsp;然后看到ens33中的inet&nbsp;就是ip地址</p>
<p>&nbsp;</p>
<p><img src="https://img2018.cnblogs.com/blog/1073044/201905/1073044-20190525122559394-1008369908.png" alt=""></p>
<p>&nbsp;测试连接，ok</p>
<p><img src="https://img2018.cnblogs.com/blog/1073044/201905/1073044-20190525144320131-1145227332.png" alt="" width="365" height="412"></p>
<p>&nbsp;</p>
</div>
<div id="MySignature"></div>
<div class="clear"></div>
