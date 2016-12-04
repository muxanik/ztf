<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?> 
<form id="form1" name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
<?=$arResult["FORM_ACTION"]?>
	<?foreach($arResult["ITEMS"] as $arItem):
		if(array_key_exists("HIDDEN", $arItem)):
			echo $arItem["INPUT"];
		endif;
	endforeach;?>
	<table class="data-table" cellspacing="0" cellpadding="2">
	<thead>
		<tr>
			<td colspan="2" align="center"><?=GetMessage("IBLOCK_FILTER_TITLE")?></td>
		</tr>
	</thead>
	<tbody>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
				<tr>
					<td valign="top"><?=$arItem["NAME"]?>:</td>
					<td valign="top"><?=$arItem["INPUT"]?></td>
				</tr>
			<?endif?>
		<?endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">
<?CUtil::InitJSCore(Array('ajax'));?>
<script type="text/javascript">
BX.ajax({
	method: 'GET'},
   $('#finde').click(function(){
BX.ajax.insertToNode('<?=$arResult["FORM_ACTION"]?>', BX('ggh'));//ajax-загрузка контента из url, у меня он помещён в "Короткие ссылки" /bitrix/admin/short_uri_admin.php?lang=ru

   });


</script>
				<button type="submit" id="finde" name="set_filter" value="Y" class="btn btn-info">Save changes</button>
				<input  type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" /><input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;<input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" /></td>

		</tr>
	</tfoot>
	</table>
</form>
