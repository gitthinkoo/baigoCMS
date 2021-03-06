<?php
return "<h3>附件</h3>
    <p class=\"text-info\">接口说明</p>
    <p>用于显示附件详细信息。</p>

    <p class=\"text-info\">URL</p>
    <p><span class=\"text-primary\">http://www.domain.com/bg_api/api.php?mod=attach</span></p>

    <p class=\"text-info\">HTTP 请求方式</p>
    <p>GET</p>

    <p class=\"text-info\">返回格式</p>
    <p>JSON</p>

    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">请求参数</div>
        <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                        <th class=\"text-nowrap\">名称</th>
                        <th class=\"text-nowrap\">类型</th>
                        <th class=\"text-nowrap\">必须</th>
                        <th>具体描述</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=\"text-nowrap\">act_get</td>
                        <td class=\"text-nowrap\">string</td>
                        <td class=\"text-nowrap\">true</td>
                        <td>接口调用动作，值只能为 read。</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">app_id</td>
                        <td class=\"text-nowrap\">int</td>
                        <td class=\"text-nowrap\">true</td>
                        <td>应用的 APP ID，后台创建应用时生成的 ID。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=admin&act_get=app#show\">查看应用</a>。</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">app_key</td>
                        <td class=\"text-nowrap\">string</td>
                        <td class=\"text-nowrap\">true</td>
                        <td>应用的 APP KEY，后台创建应用时生成的 KEY。详情查看 <a href=\"{BG_URL_HELP}ctl.php?mod=admin&act_get=app#show\">查看应用</a>。</td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">attach_id</td>
                        <td class=\"text-nowrap\">int</td>
                        <td class=\"text-nowrap\">true</td>
                        <td>附件 ID</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <p>&nbsp;</p>

    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">返回结果</div>
        <div class=\"table-responsive\">
            <table class=\"table table-bordered\">
                <thead>
                    <tr>
                        <th class=\"text-nowrap\">名称</th>
                        <th class=\"text-nowrap\">类型</th>
                        <th class=\"text-nowrap\">说明</th>
                        <th>备注</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=\"text-nowrap\">attach_id</td>
                        <td class=\"text-nowrap\">int</td>
                        <td class=\"text-nowrap\">附件 ID</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">attach_name</td>
                        <td class=\"text-nowrap\">string</td>
                        <td class=\"text-nowrap\">附件原始文件名</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">attach_time</td>
                        <td class=\"text-nowrap\">int</td>
                        <td class=\"text-nowrap\">上传时间戳</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">attach_ext</td>
                        <td class=\"text-nowrap\">string</td>
                        <td class=\"text-nowrap\">扩展名</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">attach_size</td>
                        <td class=\"text-nowrap\">int</td>
                        <td class=\"text-nowrap\">附件大小</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">attach_url</td>
                        <td class=\"text-nowrap\">string</td>
                        <td class=\"text-nowrap\">附件 URL</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td class=\"text-nowrap\">缩略图</td>
                        <td colspan=\"3\">详情请看 <a href=\"#thumb\">缩略图</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <p>&nbsp;</p>
    <div class=\"text-right\">
        <a href=\"#top\">
            <span class=\"glyphicon glyphicon-chevron-up\"></span>
            top
        </a>
    </div>
    <hr>
    <p>&nbsp;</p>

    <a name=\"thumb\"></a>
    <h3>缩略图</h3>
    <p>
        在上传图片时，系统会根据缩略图的设置自动生成缩略图，系统生成缩略图以后，需要在适当的地方给予显示，如：文章列表等处，一般缩略图信息包含在 <code>attachRow</code> 对象中。
    </p>
    <p>
        以文章列表为例，缩略图位于 <code>{articleRows[0].attachRow}</code>，此对象包含了第一篇文章的所有图片信息，包括原始图片、多个缩略图等，如果我们要显示某一个尺寸的缩略图，我们需要得到调用键名，调用键名位于 <a href=\"{BG_URL_HELP}ctl.php?mod=admin&act_get=attach#thumb\">附件管理</a> 中的缩略图部分，如果我们要显示系统默认的 100x100 的缩略图，代码为 <code>{articleRows[0].attachRow.thumb_100_100_cut}</code>。
    </p>

    <p>&nbsp;</p>

    <h4>返回结果示例</h4>
    <p>
<pre><code class=\"language-javascript\">{
    &quot;attach_id&quot;: &quot;2662&quot;, //附件 ID
    &quot;attach_name&quot;: &quot;20080228_765bd81512e1d286d713fnYZzWPWCwbf.jpg&quot;, //原始文件名
    &quot;attach_time&quot;: &quot;1438308616&quot;,  //上传时间
    &quot;attach_ext&quot;: &quot;jpg&quot;,  //扩展名
    &quot;attach_mime&quot;: &quot;image/jpeg&quot;,  //MIME
    &quot;attach_size&quot;: &quot;42996&quot;, //大小
    &quot;attach_type&quot;: &quot;image&quot;, //附件类型
    &quot;attach_url&quot;: &quot;/cms/bg_attach/2015/07/2662.jpg&quot;,  //附件 URL
    &quot;thumb_100_100_cut&quot;: &quot;/cms/bg_attach/2015/07/2662_100_100_cut.jpg&quot;, //缩略图
    &quot;thumb_150_2000_ratio&quot;: &quot;/cms/bg_attach/2015/07/2662_150_2000_ratio.jpg&quot;,
    &quot;thumb_200_200_ratio&quot;: &quot;/cms/bg_attach/2015/07/2662_200_200_ratio.jpg&quot;,
    &quot;thumb_500_500_cut&quot;: &quot;/cms/bg_attach/2015/07/2662_500_500_cut.jpg&quot;,
    &quot;alert&quot;: &quot;y070102&quot;
}</code></pre>
    </p>";