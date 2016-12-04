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
<div class="collection">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<?$arFilter = array( "IBLOCK_ID" => 41, "PROPERTY_COMP" => $arItem["ID"], ); 
			$rsItems = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, Array());?>
<div class="collection-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
<div class="row">
	<div class="col s3"><?=$arItem["NAME"];?></div>

<div class="col s5"><table><tbody>
<?while($ob = $rsItems->GetNextElement()){ ?> 
<?$arProps = $ob->GetProperties();?>
<?$arFields = $ob->GetFields();?>
	<tr><td><i class="fa fa-user"></i> <?if(empty($arProps["FIO"]["VALUE"])):?><?=$arFields["NAME"];?><?else:?><?=$arProps["FIO"]["VALUE"]?><?endif;?></td><td><?=$arProps["TEL"]["VALUE"]?></td><td><?=$arProps["EMAIL"]["VALUE"]?></td></tr>
<?}?>
	</tbody>
</table>
</div>
	<div class="col s4"></div>

</div>
</div>
<?endforeach;?>
</div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
