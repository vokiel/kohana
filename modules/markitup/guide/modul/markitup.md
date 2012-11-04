# Markitup

Markitup to prosty i użyteczny edytor obsługujący między innymi bbcode i markdown, korzystajacy z jQuery. Oficjalna strona tego edytora: [http://markitup.jaysalvat.com/](http://markitup.jaysalvat.com/).

Poniżej demo korzystające z ikonek i stylu dostępnego w Twitter Bootstrap.

<script src="/media/js/markitup/jquery.markitup.js"></script>
<script src="/media/js/markitup/sets/default/set.js"></script>
<link rel="stylesheet" href="/media/js/markitup/sets/default/style.css" type="text/css" />
<script>
$(document).ready(function() {
$('#editor').markItUp(mySettings)
});
</script>
<textarea class="span8" rows="10" id="editor"></textarea>

