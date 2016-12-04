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

<div class="row" id="ggh">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<div class="card">
	<div class="card-content" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

				<span data-cell="FI1"><?=$arItem["DISPLAY_PROPERTIES"]["FIO"]["VALUE"];?></span><br>
		<?if(!empty($arItem["DISPLAY_PROPERTIES"]["FIO"]["VALUE"])):?><span data-cell="TE1"><?=$arItem["DISPLAY_PROPERTIES"]["TEL"]["VALUE"];?></span><br><?endif;?>
		<?if(!empty($arItem["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"])):?><span data-cell="EM1"><?=$arItem["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"];?></span><br><?endif;?>
		<?if(!empty($arItem["DISPLAY_PROPERTIES"]["DK"]["VALUE"])):?><span data-cell="DK1"><?=$arItem["DISPLAY_PROPERTIES"]["DK"]["VALUE"];?></span><br><?endif;?>
		<?if(!empty($arItem["DISPLAY_PROPERTIES"]["COMPANY"]["VALUE"])):?><span data-cell="CO1"><?=$arItem["DISPLAY_PROPERTIES"]["COMPANY"]["VALUE"];?></span><br><?endif;?>
	</div></div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
