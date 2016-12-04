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
<?
// для js-файлов
$APPLICATION->AddHeadScript('https://code.jquery.com/jquery-2.1.1.min.js');


$APPLICATION->AddHeadScript('/bitrix/js/numeral.min.js');
$APPLICATION->AddHeadScript('/bitrix/js/jquery-calx-2.2.5.min.js');
$APPLICATION->AddHeadScript('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js');
$APPLICATION->AddHeadScript('/bitrix/js/materialize.min.js');


// для css-файлов
$APPLICATION->SetAdditionalCSS("https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css");
$APPLICATION->SetAdditionalCSS("/bitrix/js/materialize.css");

?>
<script>
$(document).ready(function(){
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
  });
</script>
<?$name2 = $_GET['name'];?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?$nmonth=$_GET['date'];?>
<?$lmonth=date("d.m.Y", strtotime("$nmonth +1 month -1 day +23 hours"));?>
<?$segod=date("d.n.Y");?>
<?$esegod=strtotime("$segod +23 hours");?>

	<a class="btn" href="/zakazy/oplata.php">Вернуться к выбору сотрудника</a><br>
<div class="row">
<div class="col s6">
  <ul class="collapsible" data-collapsible="accordion">
    <li>
		<div class="collapsible-header">Показатели за текущий месяц: для <?=$_GET['name'];?></div>
<div class="collapsible-body">
<ul class="collection">

<?foreach($arResult["ITEMS"] as $arItem):?>

	<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		<?if(in_array($name2, $arProperty["VALUE"])):?>
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?$newArr = count(array_keys($arProperty["DISPLAY_VALUE"], $name2))?>
			<?else:?>
				<?$newArr = count($arProperty["DISPLAY_VALUE"])?>
			<?endif;?>
			<?$nn=$arProperty["ID"]+1?>
			<?$arResult["RAB"] = array();?>
			<?$res = CIBlockElement::GetProperty(32, $arItem["ID"], "sort", "asc", Array("ID"=>$nn));
			while ($ob = $res->GetNext())    {
				$arResult["RAB"][$arItem["NAME"]] = array(date("Y-m-d", strtotime($ob['VALUE'])),$arProperty["NAME"],$newArr);
			}?>
			<?if(strtotime($arResult["RAB"][$arItem["NAME"]]["0"])<=strtotime($lmonth) and strtotime($arResult["RAB"][$arItem["NAME"]]["0"])>=strtotime($nmonth)):?>
				<?$bq=stristr($arResult["RAB"][$arItem["NAME"]]["1"],"тор ");?> 
				<?if(stristr($arResult["RAB"][$arItem["NAME"]]["1"],"автор",true) == "Прочие работы "):?>
				<?$arResult["RAB"][$arItem["NAME"]]["2"] = $arItem["PROPERTIES"]["PRRABZ"]["VALUE"]["0"];?>
				<?endif;?>
				<li class="collection-item"><b><?=$arResult["RAB"][$arItem["NAME"]]["2"]*substr($bq, 4);?></b> = <?=$arResult["RAB"][$arItem["NAME"]]["2"];?> × <?=substr($bq, 4);?> (<span style="font-style: italic"><?=stristr($arResult["RAB"][$arItem["NAME"]]["1"],"автор",true);?></span>) <span class="secondary-content">заказ №<?=$arItem["NAME"]?></span></li>
				<?$sum[]=$arResult["RAB"][$arItem["NAME"]]["2"]*substr($bq, 4);?>
			<?endif;?>
		<?endif;?>
	<?endforeach;?>

<?endforeach;?>

</ul>
</div>
</li>
</ul>

	Заработано за месяц: <div id="itogo" class="chip teal white-text"><?=number_format(array_sum($sum),0,'',' ');?></div>
	</div>
<div class="col s6">
  <ul class="collapsible" data-collapsible="accordion">
    <li>
		<div class="collapsible-header">Показатели за текущий день: для <?=$_GET['name'];?></div>
<div class="collapsible-body">
<ul class="collection">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		<?if(in_array($name2, $arProperty["VALUE"])):?>
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?$newArr1 = count(array_keys($arProperty["DISPLAY_VALUE"], $name2))?>
			<?else:?>
				<?$newArr1 = count($arProperty["DISPLAY_VALUE"])?>
			<?endif;?>
			<?$nn1=$arProperty["ID"]+1?>
			<?$arResult["RAB"] = array();?>
			<?$res1 = CIBlockElement::GetProperty(32, $arItem["ID"], "sort", "asc", Array("ID"=>$nn1));
			while ($ob1 = $res1->GetNext())
			{
				$arResult["RAB"][$arItem["NAME"]] = array(date("Y-m-d", strtotime($ob1['VALUE'])),$arProperty["NAME"],$newArr1);
			}?>
			<?if(strtotime($arResult["RAB"][$arItem["NAME"]]["0"])<=$esegod and strtotime($arResult["RAB"][$arItem["NAME"]]["0"])>=strtotime($segod)):?>
				<?$bq1=stristr($arResult["RAB"][$arItem["NAME"]]["1"],"тор ");?>
				<li class="collection-item"><b><?=$arResult["RAB"][$arItem["NAME"]]["2"]*substr($bq1, 4);?></b> = <?=$arResult["RAB"][$arItem["NAME"]]["2"];?> × <?=substr($bq1, 4);?> (<span style="font-style: italic"><?=stristr($arResult["RAB"][$arItem["NAME"]]["1"],"автор",true);?></span>) <span class="secondary-content">заказ №<?=$arItem["NAME"]?></span></li>
				<?$sum1[]=$arResult["RAB"][$arItem["NAME"]]["2"]*substr($bq1, 4);?>
			<?endif;?>
		<?endif;?>
	<?endforeach;?>
<?endforeach;?>
</ul>
</div>
</li>
</ul>

	За сегодня: <div id="seg" class="chip"><?=number_format(array_sum($sum1),0,'',' ');?></div><br>
	</div>
</div>
<div class="row">
<div class="col s6">
  <ul class="collapsible" data-collapsible="accordion">
    <li>
		<div class="collapsible-header">Переделки: для <?=$_GET['name'];?></div>
<div class="collapsible-body">
<ul class="collection">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] = "Переделка"):?>

		<?foreach($arItem["PROPERTIES"]["IDCLIENT"]["VALUE"] as $key):?>
			<?if($key === $name2):?>
			<?$sum3[] = $arItem["PROPERTIES"]["PREDPRICE"]["VALUE"];?>
			<li class="collection-item"><?=$arItem["PROPERTIES"]["PREDPRICE"]["VALUE"];?> - <?=$arItem["NAME"];?></li>

			<?endif;?>
		<?endforeach;?>
<?endif;?>
<?endforeach;?>
</ul>
</div>
</li>
</ul>

	Вычет за переделки: <div id="seg" class="chip" style="color:red;">-<?=number_format(array_sum($sum3),0,'',' ');?></div><br>
<?$result=array_sum($sum)-array_sum($sum3)?>
	Итого: <div id="alll" class="chip"><?=number_format($result,0,'',' ');?></div> 
	</div>
</div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
