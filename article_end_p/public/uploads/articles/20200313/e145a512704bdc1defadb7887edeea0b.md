<div id="article_content" class="article_content clearfix">
            <link rel="stylesheet" href="https://csdnimg.cn/release/phoenix/template/css/ck_htmledit_views-833878f763.css">
                            <link rel="stylesheet" href="https://csdnimg.cn/release/phoenix/template/css/ck_htmledit_views-833878f763.css">
                <div class="htmledit_views" id="content_views">
                                            <p>--mysql数据库的十种查询方式</p>

<p><br>
-- (1)查询时起别名<br>
SELECT id AS '编号',NAME AS '姓名',age AS '年龄'<br>
&nbsp;FROM student;</p>

<p><br>
-- (2)查询时添加常量列<br>
SELECT id AS '编号',NAME AS '姓名',age AS '年龄',<br>
'软件工程' AS '班级' FROM student;</p>

<p><br>
-- (3)查询时合并列<br>
-- 注意:只能合并数值列<br>
SELECT id,NAME,age,math,english,<br>
(math+english) AS '总成绩' FROM &nbsp;student;</p>

<p><br>
-- (4)查询时去除重复<br>
SELECT DISTINCT(address) FROM student;<br>
-- 另一种方式<br>
SELECT DISTINCT address FROM student;</p>

<p>-- (5)条件查询<br>
-- 1.逻辑条件(and与 or或)<br>
-- 1.1查询id=1且age=18的学生信息<br>
SELECT * FROM student WHERE id=1 AND age=18;<br>
-- 1.2查询age=18或age=20的学生<br>
SELECT * FROM student WHERE age=18 OR age=20;<br>
-- 1.3查询(id=1且age=18)或者(age=20)的学生<br>
SELECT * FROM student WHERE id=1 AND age=18 OR age = 20;</p>

<p>-- 2.比较条件(&gt; &lt; &gt;= &lt;= = &lt;&gt;(不等于))<br>
-- 2.1查询年龄&gt;=19的学生<br>
SELECT * FROM student WHERE age &gt;= 19;<br>
-- 2.2查询年龄大于等于18且id不为2的学生<br>
SELECT * FROM student WHERE age&gt;=18 AND id&lt;&gt;2;<br>
-- 2.3查询id大于1或者age小于等于19的学生<br>
SELECT * FROM student WHERE id&gt; 1 OR age &lt;=19;<br>
-- 2.4查询姓名不为''空字符串的学生<br>
-- 注意:&lt;&gt;''将空字符串和null都去除了<br>
SELECT * FROM student WHERE NAME &lt;&gt; '';</p>

<p>-- 3.判空条件(is not null不为空，is null为空)<br>
-- 3.1查询姓名为null的学生<br>
SELECT * FROM student WHERE NAME IS NULL;<br>
-- 3.2查询姓名不为null的学生<br>
-- 注意:''空字符串和null是不同的<br>
SELECT * FROM student WHERE NAME IS NOT NULL;</p>

<p>-- 4.模糊查询(like)<br>
-- %表示占位符或统配符，代表任意字符串或什么都不写<br>
-- _表示占位符，代表任意单个字符<br>
-- 4.1查询姓张的学生<br>
SELECT * FROM student WHERE NAME LIKE '张%';<br>
-- 4.2查询姓名中包含'三'的学生<br>
SELECT * FROM student WHERE NAME LIKE '%三%';<br>
-- 4.3查询名字中包含三的学生，且名字为3个字<br>
SELECT * FROM student WHERE NAME LIKE '_三_';</p>

<p>-- (6)聚合函数<br>
-- max()最大值 min()最小值 AVG()平均值&nbsp;<br>
-- round()保留几位小数 count()统计记录数<br>
-- 1.求出数学成绩的最高分<br>
SELECT MAX(math) FROM student;<br>
-- 2.查询数学成绩最高分的学生信息<br>
-- 使用子查询(in),表示在某个范围<br>
SELECT * FROM student WHERE math IN<br>
&nbsp;(SELECT MAX(math) FROM student);<br>
-- 3.求出英语成绩的最低分<br>
SELECT MIN(english) FROM student;<br>
-- 4.求数学成绩的平均成绩<br>
SELECT AVG(math) FROM student;<br>
-- 5.保留2位小数(四舍五入)<br>
SELECT ROUND(math,2) FROM student;<br>
-- 6.统计姓名字段有多少条记录<br>
-- 注意:不包含null数据<br>
SELECT COUNT(NAME) FROM student;<br>
-- 7.查询student里共有多少条记录(数据)<br>
-- *通配符，表示查询所有字段<br>
SELECT COUNT(*) FROM student;</p>

<p>-- (7)查询后排序(order by)<br>
-- 注意:order by必须写在where条件的后面<br>
-- asc升序:按照字典序a-z从小到大排序<br>
-- desc降序:按照字典序从大到小排序<br>
-- 1.对英语成绩降序排序<br>
SELECT * FROM student ORDER BY english DESC;<br>
-- 2.对英语成绩降序排序，对数学成绩升序排序<br>
-- 注意:先按照英语成绩降序排序，<br>
-- 当英语成绩相同时按数学成绩升序排序<br>
SELECT * FROM student ORDER BY english DESC,math ASC;<br>
-- 3.对数学成绩进行排序<br>
-- 没有写排序方式，默认按升序排序<br>
-- 默认升序可以省略不写<br>
SELECT *FROM student ORDER BY english,math;</p>

<p><br>
-- (8)分页查询(limit m,n)<br>
-- limit m,n m表示从哪个下标开始，选取n条数据<br>
-- 这里n表示每页显示的条数<br>
-- 对student表里的6条数据分页，每页显示2条，共3页<br>
-- 第一页: 0~1<br>
SELECT * FROM student LIMIT 0,2;<br>
-- limit (1-1)*2,2 &nbsp;limit 0,2<br>
-- 第二页: 2~3<br>
SELECT * FROM student LIMIT 2,2;<br>
-- limit (2-1)*2,2 &nbsp;limit 2,2<br>
-- 第三页: 4~5<br>
SELECT * FROM student LIMIT 4,2;<br>
-- limit (3-1)*2,2 &nbsp;limit 4,2<br>
-- 需求:假如表里有1000条数据，每页显示20条<br>
-- 请问第34页显示的那些数据?<br>
-- 推理分页公式:limit (第几页-1)*n,n<br>
-- limit (34-1)*20,20</p>

<p>-- (9)分组查询(group by)<br>
-- 1.需求:查询每个地区的学生有多少人<br>
-- 显示结果:地区 &nbsp;人数<br>
SELECT address AS '地区',COUNT(*) AS '人数'<br>
&nbsp;FROM student GROUP BY address;</p>

<p>-- (10)分组查询后筛选(having)<br>
-- 2.需求:查询地区人数&gt;=2人的地区<br>
SELECT address AS '地区',COUNT(*) AS '人数'<br>
&nbsp;FROM student GROUP BY address HAVING COUNT(*)&gt;2;</p>

<p>&nbsp;</p>

<p>-- 多表查询<br>
-- 创建学生表<br>
-- 任务:查询学生姓名和所在的班级名称<br>
-- (1)交叉查询(错误)<br>
-- 交叉查询的结果为笛卡尔积(6*3=18)错误<br>
-- 交叉查询会将每种情况都列举出来(错误)<br>
SELECT s.name,c.name FROM student s,class c;</p>

<p>-- (2)内连接查询(最常用)<br>
-- 只有符合连接条件的数据才会显示出来<br>
-- 多表查询的3要素<br>
-- a.要查哪些字段 &nbsp;b.要查哪些表 &nbsp; c.连接条件<br>
SELECT s.name,c.name FROM student s&nbsp;<br>
&nbsp;INNER JOIN class c ON s.classid=c.id;<br>
-- 简写=<br>
SELECT s.name,c.name FROM student s,class c<br>
&nbsp;WHERE s.classid = c.id;<br>
&nbsp;<br>
-- (3)左外连接查询(常用)<br>
-- 左表(student表):左表里的数据全部显示出来<br>
-- 右表(class表):右表只有符合连接条件的数据才会显示<br>
SELECT s.name,c.name FROM student s<br>
&nbsp;LEFT OUTER JOIN class c ON s.classid = c.id;<br>
-- (4)右外连接查询(次常用)<br>
-- 右外连接查询看成是左外连接查询倒过来<br>
-- 左表(class表):左表只有符合连接条件的数据才会显示<br>
-- 右表(student表):右表里的数据全部显示出来<br>
SELECT s.name,c.name FROM class c&nbsp;<br>
&nbsp;RIGHT OUTER JOIN student s ON c.id=s.classid;</p>

<p>-- (5)自连接查询<br>
-- 任务:查询员工名字和其上司姓名<br>
CREATE TABLE employee(<br>
id INT PRIMARY KEY,<br>
NAME VARCHAR(10),<br>
bossid INT<br>
);</p>

<p>-- 插入数据<br>
INSERT INTO employee VALUES (1,'张三',2);<br>
INSERT INTO employee VALUES (2,'李四',3);<br>
INSERT INTO employee VALUES (3,'王五',4);<br>
INSERT INTO employee VALUES (4,'陈六',5);<br>
INSERT INTO employee VALUES (5,'老王',NULL);<br>
SELECT * FROM employee;<br>
-- 任务:查询员工名字和其上司姓名<br>
-- 自连接查询的原理:使用左外连接查询，<br>
-- 只是左表和右表是同一张表<br>
SELECT e1.name,e2.name FROM employee e1&nbsp;<br>
LEFT OUTER JOIN employee e2 ON e1.bossid = e2.id;</p>

<p>&nbsp;</p>                                    </div>
                                                