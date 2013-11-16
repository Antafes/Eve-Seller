{include file="header.tpl"}
<script type="text/javascript">
	// panel 0 is importOrders, panel 1 is addOrder
	var activeTab = {if $smarty.post.createOrder}1{else}0{/if};
</script>
<div id="tabs">
	<ul>
		<li>
			<a href="#marketImport">{$translator->getTranslation('marketImport')}</a>
		</li>
		<li>
			<a href="#addOrder">{$translator->getTranslation('addOrder')}</a>
		</li>
	</ul>
	<div id="marketImport" style="display: none;">
		{if $ordersImported}
			<div class="message">{$ordersImported}</div>
		{/if}
		{if $error}
			<div class="error">{$error}</div>
		{/if}
		<form method="post" action="index.php?page=AddOrder" enctype="multipart/form-data">
			<table>
				<tbody>
					<tr>
						<td>{$translator->getTranslation('file')}</td>
						<td>
							<input type="file" name="marketLog" accept="text/*" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							{add_form_salt formName='importOrders'}
							<input type="submit" value="{$translator->getTranslation('import')}" />
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<div id="addOrder" style="display: none;">
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
							<select id="orderItem" name="item" style="width: 183px;">
								{html_options options=$itemList values=$smarty.post.item}
							</select>
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
</div>
{include file="footer.tpl"}