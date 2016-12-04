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

if (!empty($arResult["ERRORS"])):?>
	<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
<div class="row">
<div class="collection col s6">
	<div class="collection-item"><div class="row"><div class="col s6">Что сделано:</div> <div class="col s6"><input type="text" name="PROPERTY[NAME][0]" size="25" value=""></div></div></div>
	<div class="collection-item"><div class="row"><div class="col s6">Затраченное время(минут):</div> <div class="col s6"><p class="range-field"><input type="range" name="PROPERTY[354][0]"  min="1" max="300" value="1"></p></div></div></div>
	<div class="collection-item"><div class="row"><div class="col s6">Номер заказа:</div> <div class="col s6"><input type="text" name="PROPERTY[353][0]" size="25" value=""></div></div></div>
	<div class="collection-item"><div class="row"><div class="col s6">Комментарий:</div> <div class="col s6"><textarea cols="30" rows="5" name="PROPERTY[PREVIEW_TEXT][0]"></textarea></div></div></div>
	<div class="collection-item"><div class="row"><div class="col s12"><input class="btn" type="submit" name="iblock_submit" value="Сохранить"></div></div></div>
</div>
</div>
</form>