<div id="menu">
	{if $smarty.session.userId}
		<a class="button" href="index.php?page=Index">{$translator->getTranslation('index')}</a>
		<a class="button" href="index.php?page=AddOrder">{$translator->getTranslation('addOrder')}</a>
		<a class="button" href="index.php?page=Orders">{$translator->getTranslation('orders')}</a>
		<a class="button" href="index.php?page=Options">{$translator->getTranslation('options')}</a>
		{if $isAdmin}
			<a class="button" href="index.php?page=Admin">{$translator->getTranslation('admin')}</a>
		{/if}
	{else}
		<a class="button" href="index.php?page=Login">{$translator->getTranslation('login')}</a>
		<a class="button" href="index.php?page=Register">{$translator->getTranslation('register')}</a>
	{/if}
	{*<a class="button" href="index.php?page=Imprint">{$translator->getTranslation('imprint')}</a>*}
	{if $smarty.session.userId}
		<a class="button" href="index.php?page=Logout">{$translator->getTranslation('logout')}</a>
	{/if}
	<div class="clear"></div>
</div>