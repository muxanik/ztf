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
?><div class="row">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<table class="highlight bordered">
<thead>
	<tr><th>Компания</th><th>Контактное лицо</th><th>Телефон</th><th>Email</th>
	</tr>
	</thead>
<tbody>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<tr>
		<td><?=$arItem["PROPERTIES"]["COMPANY"]["VALUE"];?></td>
		<td><?foreach($arItem["PROPERTIES"]["FIO"]["VALUE"] as $key1 =>$arFio):?><?=$arFio;?><br><?endforeach;?></td>
		<td><?foreach($arItem["PROPERTIES"]["TEL"]["VALUE"] as $key2 =>$arTel):?><?=$arTel;?><br><?endforeach;?></td>
		<td><?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"];?></td>
	</tr>



<?endforeach;?>
</tbody>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
<pre>
<?print_r($arResult);?>
</pre>