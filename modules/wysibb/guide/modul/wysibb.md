# WysiBB editor

Moduł jest helperem umożliwiającym korzystanie z edytora bbcode [WysiBB](http://www.wysibb.com/). Pełna dokumentacja znajduje się pod adresem [http://www.wysibb.com/docs](http://www.wysibb.com/docs)

<!-- Подключение WysiBB -->
<script src="/media/js/wysibb/jquery.wysibb.js" charset="utf-8"></script>
<script src="/media/js/wysibb/lang/pl.js"></script>
<link rel="stylesheet" href="/media/js/wysibb/theme/default/wbbtheme.css" type="text/css" />
<script>
$(document).ready(function() {
 var wbbOpt = {
autoresize:			true,
resize_maxheight:	300,
loadPageStyles:		false,
  lang: "pl"
 }
 $("#editor").wysibb(wbbOpt);
});
</script>
<textarea id="editor"></textarea>
