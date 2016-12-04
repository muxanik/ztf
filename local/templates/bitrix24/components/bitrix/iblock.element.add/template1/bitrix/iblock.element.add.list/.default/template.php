<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);

$colspan = 2;
if ($arResult["CAN_EDIT"] == "Y") $colspan++;
if ($arResult["CAN_DELETE"] == "Y") $colspan++;
?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?><a href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a><?else:?><?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?><?endif?>

