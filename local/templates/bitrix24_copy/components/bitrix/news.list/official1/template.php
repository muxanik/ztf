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
<table width="100%" cellspacing="0" cellpadding="5">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

<?global $USER;?>
<?$gname = $USER->GetFullName();?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):
			if($pid=="DOC_TYPE")
				continue;
			?>

	<?if(in_array($gname, $arProperty["DISPLAY_VALUE"])):?>
<tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">


	<td valign="top" width="100%">

			<small><?echo $arItem["NAME"]?>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=count($arProperty["DISPLAY_VALUE"]);?> 
			<?else:?>
				<?=count($arProperty["DISPLAY_VALUE"]);?>
			<?endif?>
			</small><br />

	</td>
</tr>
<?endif;?>
<?endforeach;?>
<?endforeach;?>
</table>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
