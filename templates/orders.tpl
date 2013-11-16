{include file="header.tpl"}
<div id="ownOrders">
	<div class="subMenu">
		<form method="get" action="index.php">
			<input type="hidden" name="page" value="Orders" />
			{if $sellingForList && count($sellingForList) > 1}
				<label for="filterOrders">{$translator->getTranslation('filter')}:</label>
				<select id="filterOrders" name="filterOrders">
					<option value="">{$translator->getTranslation('all')}</option>
					{foreach from=$sellingForList item='sellingFor'}
						<option value="{$sellingFor}"{if $sellingFor == $smarty.get.filterOrders} selected="selected"{/if}>{$sellingFor}</option>
					{/foreach}
				</select>
			{/if}
		</form>
	</div>
	<table class="orders">
		<thead>
			<tr>
				<th class="item">
					<a href="index.php?page=Orders&amp;filterOrders={$smarty.get.filterOrders}&amp;orderBy=typeName">{$translator->getTranslation('item')}</a>
				</th>
				<th class="singlePrice">
					<a href="index.php?page=Orders&amp;filterOrders={$smarty.get.filterOrders}&amp;orderBy=price">{$translator->getTranslation('singlePrice')}</a>
				</th>
				<th class="amount">
					<a href="index.php?page=Orders&amp;filterOrders={$smarty.get.filterOrders}&amp;orderBy=amount">{$translator->getTranslation('amount')}</a>
				</th>
				<th class="amountSold">
					<a href="index.php?page=Orders&amp;filterOrders={$smarty.get.filterOrders}&amp;orderBy=amountSold">{$translator->getTranslation('amountSold')}</a>
				</th>
				<th class="sum">
					<a href="index.php?page=Orders&amp;filterOrders={$smarty.get.filterOrders}&amp;orderBy=sum">{$translator->getTranslation('sum')}</a>
				</th>
				<th class="sellingFor">
					<a href="index.php?page=Orders&amp;filterOrders={$smarty.get.filterOrders}&amp;orderBy=sellingForUser">{$translator->getTranslation('sellingFor')}</a>
				</th>
				<th class="createDatetime">
					<a href="index.php?page=Orders&amp;filterOrders={$smarty.get.filterOrders}&amp;orderBy=createDatetime">{$translator->getTranslation('createDatetime')}</a>
				</th>
				<th class="endDatetime">
					<a href="index.php?page=Orders&amp;filterOrders={$smarty.get.filterOrders}&amp;orderBy=endDatetime">{$translator->getTranslation('endDatetime')}</a>
				</th>
				<th class="sold"></th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$orders item='order'}
				<tr class="{cycle values='odd,even'}">
					<td class="item">{$order->getItem()->getTypeName()}</td>
					<td class="singlePrice">{$order->getFormattedPrice()}</td>
					<td class="amount">{$order->getFormattedAmount()}</td>
					<td class="amountSold">{$order->getFormattedAmountSold()}</td>
					<td class="sum">{$order->getFormattedSum()}</td>
					<td class="sellingFor">
						<a href="index.php?page=Orders&amp;filterOrders={$order->getSellingForUser()}&amp;orderBy={$smarty.get.orderBy}">{$order->getSellingForUser()}</a>
					</td>
					<td class="createDatetime">{$order->getFormattedCreateDatetime()}</td>
					<td class="endDatetime">{$order->getFormattedEndDatetime()}</td>
					<td class="sold">
						<a href="javascript:;" data-orderid="{$order->getOrderId()}">{$translator->getTranslation('markAsSold')}</a>
					</td>
				</tr>
			{foreachelse}
				<tr>
					<td class="noOrders" colspan="9">{$translator->getTranslation('noOrders')}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
</div>
<div id="soldDialog" style="display: none;">
	<form method="post" action="index.php?page=Orders&amp;filterOrders={$smarty.get.filterOrders}&amp;orderBy={$smarty.get.orderBy}">
		<table>
			<tbody>
				<tr class="item">
					<td class="label">{$translator->getTranslation('item')}:</td>
					<td></td>
				</tr>
				<tr class="offeredAmount">
					<td class="label">{$translator->getTranslation('offeredAmount')}:</td>
					<td></td>
				</tr>
				<tr class="amountSold">
					<td class="label">{$translator->getTranslation('amountSold')}:</td>
					<td></td>
				</tr>
				<tr class="amount">
					<td class="label">{$translator->getTranslation('amount')}:</td>
					<td>
						<input type="text" name="amount" />
					</td>
				</tr>
				<tr>
					<td class="label"></td>
					<td>
						<input type="submit" value="{$translator->getTranslation('markAsSold')}" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
{include file="footer.tpl"}