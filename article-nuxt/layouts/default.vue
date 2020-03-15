<template>
  <div>
    <!--头部-->
    <div id="blog-header">
      <img src="../assets/img/logo.png" width="500px" />
    </div>
    <!--导航-->
    <div id="blog-nav">
      <ul class="clearfix">
        <li>
          <nuxt-link class="nav"  to="/">首页</nuxt-link>
        </li>
        <li>
          <nuxt-link class="nav"  to="/article_list/html">HTML</nuxt-link>
        </li>
        <li>
          <nuxt-link class="nav" to="/article_list/css">CSS</nuxt-link>
        </li>
        <li>
          <nuxt-link class="nav" to="/article_list/javascript">JavaScript</nuxt-link>
        </li>
        <li>
          <nuxt-link class="nav" to="/article_list/vue">Vue</nuxt-link>
        </li>
        <li>
          <nuxt-link class="nav" to="/article_list/nodejs">Nodejs</nuxt-link>
        </li>
        <li>
          <nuxt-link class="nav" to="/article_list/php">PHP</nuxt-link>
        </li>
        <li>
          <nuxt-link class="nav" to="/article_list/linux">Linux</nuxt-link>
        </li>
        <li>
          <nuxt-link class="nav" to="/article_list/life">人生趣事</nuxt-link>
        </li>
        <!-- <li>
          <nuxt-link class="nav" to="/article_list/book">书籍推荐</nuxt-link>
        </li> -->
        <li>
          <nuxt-link class="nav" to="/video_study">教学视频</nuxt-link>
        </li>
      </ul>
    </div>
    <div id="blog-body">
      <nuxt />
    </div>
    <script type="text/javascript" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js">
			!function(){function n(n,e,t){return n.getAttribute(e)||t}function e(n){return document.getElementsByTagName(n)}
			function t(){var t=e("script"),o=t.length,i=t[o-1];return{l:o,z:n(i,"zIndex",-1),o:n(i,"opacity",.5),c:n(i,"color","0,0,0")
			,n:n(i,"count",99)}}function o(){a=m.width=window.innerWidth||document.documentElement.clientWidth||document.body.clientWidt
			h,c=m.height=window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight}function i(){r.clearRect
			(0,0,a,c);var n,e,t,o,m,l;s.forEach(function(i,x){for(i.x+=i.xa,i.y+=i.ya,i.xa*=i.x>a||i.x<0?-1:1,i.ya*=i.y>c||i.y<0?-1:1,r.
			fillRect(i.x-.5,i.y-.5,1,1),e=x+1;e<u.length;e++)n=u[e],null!==n.x&&null!==n.y&&(o=i.x-n.x,m=i.y-n.y,l=o*o+m*m,l<n.max&&(n===
			y&&l>=n.max/2&&(i.x-=.03*o,i.y-=.03*m),t=(n.max-l)/n.max,r.beginPath(),r.lineWidth=t/2,r.strokeStyle="rgba("+d.c+","+(t+.2)+")
			",r.moveTo(i.x,i.y),r.lineTo(n.x,n.y),r.stroke()))}),x(i)}var a,c,u,m=document.createElement("canvas"),d=t(),l="c_n"+d.l,r=m.
			getContext("2d"),x=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.
			oRequestAnimationFrame||window.msRequestAnimationFrame||function(n){window.setTimeout(n,1e3/45)},w=Math.random,y={x:null,y:nul
			l,max:2e4};m.id=l,m.style.cssText="position:fixed;top:0;left:0;z-index:"+d.z+";opacity:"+d.o,e("body")[0].appendChild(m),o(),
			window.οnresize=o,window.οnmοusemοve=function(n){n=n||window.event,y.x=n.clientX,y.y=n.clientY},window.οnmοuseοut=function(){y
			.x=null,y.y=null};for(var s=[],f=0;d.n>f;f++){var h=w()*a,g=w()*c,v=2*w()-1,p=2*w()-1;s.push({x:h,y:g,xa:v,ya:p,max:6e3})}u=
			s.concat([y]),setTimeout(function(){i()},100)}();
			</script>
  </div>
</template>

<script>
import $ from "jquery";
export default {
  mounted () {
    $(".nav").click(()=>{
      $(this).attr("class","active") 
    })
  },
  methods: {
    a(){
      console.log(1)
    }
  }
}
</script>

<style>

</style>
