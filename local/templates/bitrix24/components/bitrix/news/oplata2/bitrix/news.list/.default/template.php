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
?><script src="/bitrix/js/jquery.min.js"></script>
<script src="/bitrix/js/moment.min.js"></script>
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
<?$lmonth=date("d.m.Y", strtotime("$nmonth +1 month -1 day"));?>
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
	<?if(!empty($arProperty["DISPLAY_VALUE"])):?>
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?$newArr = count($arProperty["DISPLAY_VALUE"])?>
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
				<li class="collection-item"><b><?=$arResult["RAB"][$arItem["NAME"]]["2"]*substr($bq, 4);?></b> = <?=$arResult["RAB"][$arItem["NAME"]]["2"];?> × <?=substr($bq, 4);?> (<span style="font-style: italic"><?=stristr($arResult["RAB"][$arItem["NAME"]]["1"],"автор",true);?></span>) <span class="secondary-content">заказ №<?=$arItem["NAME"]?></span></li>
				<?$sum[]=$arResult["RAB"][$arItem["NAME"]]["2"]*substr($bq, 4);?>
			<?endif;?>
<pre>
<?print_r($arProperty);?>
</pre>
	<?endif;?>
	<?endforeach;?>
<pre>

</pre>
<?endforeach;?>
</ul>
</div>
</li>
</ul>
	Итого: <div id="itogo" class="chip teal white-text"><?=number_format(array_sum($sum),0,'',' ');?></div>
	</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
