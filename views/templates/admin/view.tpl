<div class="panel">
	<h3>
		<i class="icon-cogs"></i>
		{l s='Cache cleaner' mod='ps_cachecleaner'}
	</h3>
	<div class="row">
        {if isset($cleanedCache) && $cleanedCache}
			<div class="alert alert-success">
                {l s='Cache is now clean !' mod='ps_cachecleaner'}
			</div>
        {/if}
		<p>
			<a class="btn btn-default" href="{$clearCacheUrl|escape:'html':'UTF-8'}" title="">
				{l s='Clear the cache !' mod='ps_cachecleaner'}
			</a>
		</p>
	</div>
</div>
