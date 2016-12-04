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
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<table class="striped">
<thead>
	<tr>
		<th>Что сделано
		</th>
		<th>Затраченное время
		</th>
		<th>Кем сделано
		</th>
		<th>Номер заказа
		</th>
		<th>Комментарий
		</th>
		<th>Когда сделано
		</th>
	</tr>
	</thead>
<tbody>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

<tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">

<td>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
	</td>




<td>
	<?=$arItem["PROPERTIES"]["VREMYA"]["VALUE"];?> минут
	</td>
<td>
<?$a = explode(") ",$arItem["CREATED_USER_NAME"]);?><?=$a[1];?>
	</td>
<td>
<?=$arItem["PROPERTIES"]["N_ZAK"]["VALUE"];?>
	</td>
<td>
<?=$arItem["PREVIEW_TEXT"];?>
	</td>
<td>
<?=$arItem["DATE_CREATE"];?>
	</td>
	</tr>

<?endforeach;?>
	</tbody>
	</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>