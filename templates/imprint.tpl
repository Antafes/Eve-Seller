{include file="header.tpl"}
{assign var="mail" value="admin@wafriv.de"}
<div class="imprint">
	<h2>{$translator->getTranslation('imprint')}</h2>
	<div>
		Marian "Neithan" Pollzien<br/>
		Leipziger Stra&szlig;e 29<br/>
		04420 Markranst&auml;dt<br/>
		<a href="mailto:{$mail|escape: 'hex'}">{$translator->getTranslation('email')}</a>
	</div>
</div>
{include file="footer.tpl"}