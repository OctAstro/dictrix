<?php
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ?
"https://" : "http://";
?>
<!doctype html>
<html>
	<head>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width initial-scale=1'>
		<title>API使用说明</title>
		<link
			  rel="stylesheet"
			  href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"
			  integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
			  crossorigin="anonymous" />

		<link href="https://fonts.googleapis.com/css?family=Rubik:300,500,700" rel="stylesheet" />
		<style>
            body {
                font-family: 'Rubik', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                font-size: calc(10px + 0.33vw);
                -webkit-font-smoothing: antialiased;
                padding: 5vh 10vw;
                color: #121314;
            }

            h1 {
                font-size: 4.5em;
                font-weight: 500;
                margin-bottom: 0;
            }

            h2 {
                font-size: 2.5em;
                font-weight: 500;
                margin-bottom: 0;
            }

            p {
                font-size: 1.6em;
                font-weight: 300;
                line-height: 1.4;
            }

            span.code {
                font-size: 0.8em;
                font-weight: 300;
                line-height: 1.4;
                background:#a7dfc6;
                border-radius: 10px;
                text-align: center;
                padding: 3px 15px 3px 15px;
            }

            p.author {
                font-size: 1.6em;
                font-weight: 300;
                line-height: 1.4;
                max-width: 28em;
                text-align: right;
            }

            .footer{
                font-size: 1em;
                font-weight: 300;
                line-height: 1.4;
                max-width: 30em;
            }

            a {
                text-decoration: none;
                color: #121314;
                position: relative;
            }

            a:after {
                content: '';
                position: absolute;
                z-index: -1;
                top: 60%;
                left: -0.1em;
                right: -0.1em;
                bottom: 0;
                transition: top 200ms cubic-bezier(0, 0.8, 0.13, 1);
                background-color: rgba(79, 192, 141, 0.5);
            }

            a:hover:after {
                top: -2%;
            }
		</style>

	</head>
	<body>
		<h1>API使用说明</h1>
		<h2>输出格式</h2>

		<p>
			<strong>1.Json格式</strong>
		</p>
		<p>
			<span class="code">
				<?php echo $protocol . $_SERVER['HTTP_HOST'] ?>/api</span>
		</p>
		<p>随机输出一条语录，包含完整的语录信息：一句ID(id)，一句出处(author)，创建者(creator)，一句正文(dictum)</p>

		<p>
			<table class="mdui-table mdui-table-hoverable">
				<thead>
					<tr>
						<th>返回参数名称</th>
						<th>描述</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>id</td>
						<td>一句ID</td>
					</tr>
					<tr>
						<td>author</td>
						<td>一句出处</td>
					</tr>
					<tr>
						<td>creator</td>
						<td>创建者</td>
					</tr>
					<tr>
						<td>dictum</td>
						<td>一句正文</td>
					</tr>
				</tbody>
			</table>

		</p>

		<p>
			<strong>2.纯文本</strong>
		</p>
		<p>
			<span class="code">
				<?php echo $protocol . $_SERVER['HTTP_HOST'] ?>/api/?type=text</span>
		</p>
		<p>随机输出一条语录，包含<strong>句子正文</strong>。</p>

		<p>
			<strong>3.JS格式</strong>
		</p>
		<p>
			<span class="code">
				<?php echo $protocol . $_SERVER['HTTP_HOST'] ?>/api/?type=js</span>
		</p>
		<p>随机输出一条语录，包含<strong>句子{dictum}——作者{author}</strong>的js代码。</p>
		<p>将下面的代码插入任意位置，将自动替换为一句：</p>
		<p>
			<span class="code">&lt;script src=&quot;
				<?php echo $protocol . $_SERVER['HTTP_HOST'] ?>/api/?type=js&quot;&gt;&lt;/script&gt;&lt;script&gt;dictum();&lt;/script&gt;</span>
		</p>

		<p>
			<strong>4.自定义格式</strong>
		</p>
		<p>
			<span class="code">
				<?php echo $protocol . $_SERVER['HTTP_HOST'] ?>/api/?type=custom</span>
		</p>
		<p>随机输出一条语录，可自定义格式。</p>
		<table class="mdui-table mdui-table-hoverable">
			<thead>
				<tr>
					<th>关键字</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<strong>[uid]</strong>
					</td>
					<td>语句ID(id)</td>
				</tr>
				<tr>
					<td>
						<strong>[dictum]</strong>
					</td>
					<td>语句(dictum)</td>
				</tr>
				<tr>
					<td>
						<strong>[author]</strong>
					</td>
					<td>作者(author)</td>
				</tr>
				<tr>
					<td>
						<strong>[creator]</strong>
					</td>
					<td>上传者(creator)</td>
				</tr>
			</tbody>
		</table>
		<p>
			<span class="code">实例:
				<?php echo $protocol . $_SERVER['HTTP_HOST'] ?>/api/?type=custom&custom=来自 [creator] 的第 [uid] 条嘲讽: [author]说过: [dictum]</span>
		</p>
		<p>
			<a href='../'>返回主页</a>
		</p>
		<h2 class="mdui-text-color-theme"></h2>

		</div>
		</div>
		<script
				src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
				integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
				crossorigin="anonymous"></script>
	</body>
</html>