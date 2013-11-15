{include file="header.tpl"}
<div id="addOrder">
	{if $orderCreated}
		<div class="message">{$orderCreated}</div>
	{/if}
	{if $error}
		<div class="error">{$error}</div>
	{/if}
	<form method="post" action="index.php?page=AddOrder">
		<table class="addOrder">
			<tbody>
				<tr>
					<td class="label">
						<label for="orderItem">{$translator->getTranslation('item')}:</label>
					</td>
					<td>
						<input type="text" id="orderItem" name="item" value="{$smarty.post.item}" />
					</td>
				</tr>
				<tr>
					<td class="label">
						<label for="orderAmount">{$translator->getTranslation('amount')}:</label>
					</td>
					<td>
						<input type="text" id="orderAmount" name="amount" value="{$smarty.post.amount}" />
					</td>
				</tr>
				<tr>
					<td class="label">
						<label for="orderPrice">{$translator->getTranslation('singlePrice')}:</label>
					</td>
					<td>
						<input type="text" id="orderPrice" name="price" value="{$smarty.post.price}" />
					</td>
				</tr>
				<tr>
					<td class="label">
						<label for="orderSellingForUser">{$translator->getTranslation('sellingFor')}:</label>
					</td>
					<td>
						<div class="left">
							<input type="text" id="orderSellingForUser" name="sellingForUser" value="{$smarty.post.sellingForUser}" />
						</div>
						<div class="right setSellingForUser">
							<a href="javascript:;" data-username="{$user->getName()}">{$translator->getTranslation('setMyself')}</a>
							<a href="javascript:;" data-username="Corporation">{$translator->getTranslation('setCorporation')}</a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="label">
						<label for="orderCreateDatetime">{$translator->getTranslation('createDatetime')}:</label>
					</td>
					<td>
						<input type="text" id="orderCreateDatetime" name="createDatetime" value="{$smarty.post.createDatetime}" />
					</td>
				</tr>
				<tr>
					<td class="label">
						<label for="orderDuration">{$translator->getTranslation('duration')}:</label>
					</td>
					<td>
						{assign var='duration' value=$user->getOrderDuration()}
						{if $smarty.post.duration}
							{assign var='duration' value=$smarty.post.duration}
						{/if}
						<select id="orderDuration" name="duration">
							{html_options options=$durations selected=$duration}
						</select>
					</td>
				</tr>
				<tr>
					<td class="label"></td>
					<td>
						<input id="orderSaveSettings" type="checkbox" name="saveSettings" value="1" />
						<label for="orderSaveSettings">{$translator->getTranslation('saveSettings')}</label>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						{add_form_salt formName='createOrder'}
						<input type="submit" value="{$translator->getTranslation('createOrder')}" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
{include file="footer.tpl"}