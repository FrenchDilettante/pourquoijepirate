<ul class="pagination">
<? $ecart = 7; $curpage = $p/10; ?>
	<li>
	<? if ($curpage != 0) { ?>
		<a href="<? echo $page_url ?>">1 &lt;&lt;</a>
	<? } else { ?>
		1 &lt;&lt;
	<? } ?>
	</li>
<? for ($i=($curpage-$ecart > 1 ? $curpage-$ecart+1 : 1); $i<($curpage+$ecart < $count + 1 ? $curpage+$ecart: $count); $i++) { ?>
	<li>
	<? if ($i == ($curpage)) { ?>
		<? echo $i + 1; ?>
	<? } else { ?>
		<a href="<? echo $page_url ?>?p=<? echo $i ?>"><? echo $i + 1; ?></a>
	<? } ?>
	</li>
<? } ?>
	<li>
	<? if ($curpage != $count-1) { ?>
		<a href="<? echo $page_url ?>?p=<? echo $count - 1 ?>">&gt;&gt; <? echo $count ?></a>
	<? } else { ?>
		&gt;&gt; <? echo $count ?>
	<? } ?>
	</li>
</ul>