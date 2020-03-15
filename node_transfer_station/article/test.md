<div class="postBody">
			
<div id="cnblogs_post_body" class="blogpost-body cnblogs-markdown">
    <h4 id="一写在前头">一、写在前头</h4>
<p>&nbsp;&nbsp;&nbsp;接到某厂电话问什么是事件代理的时候,一开始说addEventListener,然后他说直接绑定新的元素不会报dom不存在的错误吗？然后我就混乱了,我印象中这个方法是可以绑定新节点的。后面才知道,原来他要考察的是事件委托(代理)的原理,他指的是未来还不清楚会创建多少个节点,所以没办法实现给他们注册事件。</p>
<h4 id="二事件委托事件代理的作用">二、事件委托(事件代理)的作用?</h4>
<p>为了方便理解,我先把事件委托的作用写一下。</p>
<ol>
<li>支持为同一个DOM元素注册多个同类型事件</li>
<li>可将事件分成事件捕获和事件冒泡机制</li>
</ol>
<p>例子解析:</p>
<ul>
<li><p>注册多个事件</p>
<blockquote>
<p>用以往注册事件的方法,如果存在多个事件,后注册的事件会覆盖先注册的事件</p>
</blockquote></li>
</ul>
<pre><code class="hljs javascript"><span class="hljs-comment">//index.html</span>
&lt;div id=<span class="hljs-string">"div1"</span>&gt;<span class="xml"><span class="hljs-tag">&lt;/<span class="hljs-name">div</span>&gt;</span></span>

<span class="hljs-built_in">window</span>.onload = <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
    <span class="hljs-keyword">let</span> div1 = <span class="hljs-built_in">document</span>.getElementById(<span class="hljs-string">'div1'</span>);
    div1.onclick = <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
        <span class="hljs-built_in">console</span>.log(<span class="hljs-string">'打印第一次'</span>)
    }
    div1.onclick = <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
        <span class="hljs-built_in">console</span>.log(<span class="hljs-string">'打印第二次'</span>)
    }
}
</code></pre>
<p><img src="https://images2018.cnblogs.com/blog/1414709/201808/1414709-20180818111239686-1865488448.png" alt="onclick"></p>
<p>可以看到第二个点击注册事件覆盖了第一个注册事件,只执行了console.log('打印第二次');</p>
<blockquote>
<p>用addEventListener(type,listener,useCapture)实现</p>
</blockquote>
<ul>
<li>type: 必须,String类型,事件类型</li>
<li>listener: 必须,函数体或者JS方法</li>
<li>useCapture: 可选,boolean类型。指定事件是否发生在捕获阶段。默认为false,事件发生在冒泡阶段</li>
</ul>
<pre><code class="hljs javascript">&lt;div id=<span class="hljs-string">"div1"</span>&gt;<span class="xml"><span class="hljs-tag">&lt;/<span class="hljs-name">div</span>&gt;</span></span>

<span class="hljs-built_in">window</span>.onload = <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
    <span class="hljs-keyword">let</span> div1 = <span class="hljs-built_in">document</span>.getElementById(<span class="hljs-string">'div1'</span>);
    div1.addEventListener(<span class="hljs-string">'click'</span>,<span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
        <span class="hljs-built_in">console</span>.log(<span class="hljs-string">'打印第一次'</span>)
    })
    div1.addEventListener(<span class="hljs-string">'click'</span>,<span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
        <span class="hljs-built_in">console</span>.log(<span class="hljs-string">'打印第二次'</span>)
    })
}</code></pre>
<p><img src="https://images2018.cnblogs.com/blog/1414709/201808/1414709-20180818111811025-1077949187.png" alt="addEventListener"></p>
<p>可以看到两个注册事件都成功触发了。 useCapture是事件委托的关键,我们后面详解</p>
<ul>
<li>事件捕获和事件冒泡机制<br>
</li>
</ul>
<ol>
<li>事件捕获<br>
当一个事件触发后,从Window对象触发,不断经过下级节点,直到目标节点。在事件到达目标节点之前的过程就是捕获阶段。<font color="red">所有经过的节点,都会触发对应的事件</font></li>
<li>事件冒泡<br>
当事件到达目标节点后，会沿着捕获阶段的路线原路返回。同样，<font color="red">所有经过的节点,都会触发对应的事件</font></li>
</ol>
<p><img src="https://images2018.cnblogs.com/blog/1414709/201808/1414709-20180818123542724-735687837.png" alt="事件机制"></p>
<p>通过例子理解两个事件机制:<br>
<font color="#666">例子：假设有body和body节点下的div1均有绑定了一个注册事件.<br>
效果：<br>
&nbsp;&nbsp;&nbsp;&nbsp;当为事件捕获(useCapture:true)时,先执行body的事件,再执行div的事件<br>
&nbsp;&nbsp;&nbsp;&nbsp;当为事件冒泡(useCapture:false)时,先执行div的事件,再执行body的事件</font></p>
<pre><code class="hljs lua">//当useCapture为默认<span class="hljs-literal">false</span>时,为事件冒泡
&lt;body&gt;
    &lt;div id=<span class="hljs-string">"div1"</span>&gt;&lt;/div&gt;
&lt;/body&gt;

window.onload = <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span></span>{
    let body = document.querySelector(<span class="hljs-string">'body'</span>);
    let div1 = document.getElementById(<span class="hljs-string">'div1'</span>);
    body.addEventListener(<span class="hljs-string">'click'</span>,<span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span></span>{
        console.<span class="hljs-built_in">log</span>(<span class="hljs-string">'打印body'</span>)
    })
    div1.addEventListener(<span class="hljs-string">'click'</span>,<span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span></span>{
        console.<span class="hljs-built_in">log</span>(<span class="hljs-string">'打印div1'</span>)
    })
}

//结果:打印div1  打印body</code></pre>
<p><img src="https://images2018.cnblogs.com/blog/1414709/201808/1414709-20180818125402271-1569816971.png" alt="事件冒泡"></p>
<pre><code class="hljs lua">//当useCapture为<span class="hljs-literal">true</span>时,为事件捕获
&lt;body&gt;
    &lt;div id=<span class="hljs-string">"div1"</span>&gt;&lt;/div&gt;
&lt;/body&gt;

window.onload = <span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span></span>{
    let body = document.querySelector(<span class="hljs-string">'body'</span>);
    let div1 = document.getElementById(<span class="hljs-string">'div1'</span>);
    body.addEventListener(<span class="hljs-string">'click'</span>,<span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span></span>{
        console.<span class="hljs-built_in">log</span>(<span class="hljs-string">'打印body'</span>)
    },<span class="hljs-literal">true</span>)
    div1.addEventListener(<span class="hljs-string">'click'</span>,<span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span></span>{
        console.<span class="hljs-built_in">log</span>(<span class="hljs-string">'打印div1'</span>)
    })
}

//结果:打印body   打印div1</code></pre>
<p><img src="https://images2018.cnblogs.com/blog/1414709/201808/1414709-20180818125622131-318728159.png" alt="事件捕获"></p>
<h4 id="三事件委托和新增节点绑定事件的关系">三、事件委托和新增节点绑定事件的关系？</h4>
<p>事件委托的优点:</p>
<ol>
<li>提高性能:每一个函数都会占用内存空间，只需添加一个事件处理程序代理所有事件,所占用的内存空间更少。</li>
<li>动态监听:使用事件委托可以自动绑定动态添加的元素,即新增的节点不需要主动添加也可以一样具有和其他元素一样的事件。<br>
例子解析:</li>
</ol>
<pre><code class="hljs xml"><span class="hljs-tag">&lt;<span class="hljs-name">script</span>&gt;</span><span class="javascript">
    <span class="hljs-built_in">window</span>.onload = <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
        <span class="hljs-keyword">let</span> div = <span class="hljs-built_in">document</span>.getElementById(<span class="hljs-string">'div'</span>);
        
        div.addEventListener(<span class="hljs-string">'click'</span>,<span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params">e</span>)</span>{
            <span class="hljs-built_in">console</span>.log(e.target)
        })
        
        <span class="hljs-keyword">let</span> div3 = <span class="hljs-built_in">document</span>.createElement(<span class="hljs-string">'div'</span>);
        div3.setAttribute(<span class="hljs-string">'class'</span>,<span class="hljs-string">'div3'</span>)
        div3.innerHTML = <span class="hljs-string">'div3'</span>;
        div.appendChild(div3)
    }
</span><span class="hljs-tag">&lt;/<span class="hljs-name">script</span>&gt;</span>


<span class="hljs-tag">&lt;<span class="hljs-name">body</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-name">div</span> <span class="hljs-attr">id</span>=<span class="hljs-string">"div"</span>&gt;</span>
        <span class="hljs-tag">&lt;<span class="hljs-name">div</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"div1"</span>&gt;</span>div1<span class="hljs-tag">&lt;/<span class="hljs-name">div</span>&gt;</span>
        <span class="hljs-tag">&lt;<span class="hljs-name">div</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"div2"</span>&gt;</span>div2<span class="hljs-tag">&lt;/<span class="hljs-name">div</span>&gt;</span>
    <span class="hljs-tag">&lt;/<span class="hljs-name">div</span>&gt;</span>
<span class="hljs-tag">&lt;/<span class="hljs-name">body</span>&gt;</span></code></pre>
<p>虽然没有给div1和div2添加点击事件,但是无论是点击div1还是div2,都会打印当前节点。因为其父级绑定了点击事件,点击div1后冒泡上去的时候,执行父级的事件。</p>
<blockquote>
<p>分别点击div1、div2、div3</p>
</blockquote>
<p><img src="https://images2018.cnblogs.com/blog/1414709/201808/1414709-20180818192807997-344061140.png" alt="事件委托"><br>
这样无论后代新增了多少个节点,一样具有这个点击事件的功能。这一个就是考察者想要听到的答案。</p>

</div>
<div id="MySignature"></div>
<div class="clear"></div>
<div id="blog_post_info_block"><div id="BlogPostCategory">
    分类: 
            <a href="https://www.cnblogs.com/soyxiaobi/category/1280252.html" target="_blank">JS/ES6</a></div>


    <div id="blog_post_info">
<div id="green_channel">
        <a href="javascript:void(0);" id="green_channel_digg" onclick="DiggIt(9498357,cb_blogId,1);green_channel_success(this,'谢谢推荐！');">好文要顶</a>
        <a id="green_channel_follow" onclick="follow('cb31c9d1-8b8c-4df2-b7a0-08d5c68e6275');" href="javascript:void(0);">关注我</a>
    <a id="green_channel_favorite" onclick="AddToWz(cb_entryId);return false;" href="javascript:void(0);">收藏该文</a>
    <a id="green_channel_weibo" href="javascript:void(0);" title="分享至新浪微博" onclick="ShareToTsina()"><img src="https://common.cnblogs.com/images/icon_weibo_24.png" alt=""></a>
    <a id="green_channel_wechat" href="javascript:void(0);" title="分享至微信" onclick="shareOnWechat()"><img src="https://common.cnblogs.com/images/wechat.png" alt=""></a>
</div>
<div id="author_profile">
    <div id="author_profile_info" class="author_profile_info">
            <a href="https://home.cnblogs.com/u/soyxiaobi/" target="_blank"><img src="https://pic.cnblogs.com/face/1414709/20180729105950.png" class="author_avatar" alt=""></a>
        <div id="author_profile_detail" class="author_profile_info">
            <a href="https://home.cnblogs.com/u/soyxiaobi/">xiaobe</a><br>
            <a href="https://home.cnblogs.com/u/soyxiaobi/followees/">关注 - 4</a><br>
            <a href="https://home.cnblogs.com/u/soyxiaobi/followers/">粉丝 - 71</a>
        </div>
    </div>
    <div class="clear"></div>
    <div id="author_profile_honor"></div>
    <div id="author_profile_follow">
                <a href="javascript:void(0);" onclick="follow('cb31c9d1-8b8c-4df2-b7a0-08d5c68e6275');return false;">+加关注</a>
    </div>
</div>
<div id="div_digg">
    <div class="diggit" onclick="votePost(9498357,'Digg')">
        <span class="diggnum" id="digg_count">15</span>
    </div>
    <div class="buryit" onclick="votePost(9498357,'Bury')">
        <span class="burynum" id="bury_count">0</span>
    </div>
    <div class="clear"></div>
    <div class="diggword" id="digg_tips">
    </div>
</div>

<script type="text/javascript">
    currentDiggType = 0;
</script></div>
    <div class="clear"></div>
    <div id="post_next_prev">

    <a href="https://www.cnblogs.com/soyxiaobi/p/9489444.html" class="p_n_p_prefix">« </a> 上一篇：    <a href="https://www.cnblogs.com/soyxiaobi/p/9489444.html" title="发布于 2018-08-16 19:46">真刀实战地搭建React+Webpack+Express搭建一个简易聊天室</a>
    <br>
    <a href="https://www.cnblogs.com/soyxiaobi/p/9507798.html" class="p_n_p_prefix">» </a> 下一篇：    <a href="https://www.cnblogs.com/soyxiaobi/p/9507798.html" title="发布于 2018-08-20 20:10">Chrome,你这坑人的默认非安全端口</a>

</div>
</div>
		</div>