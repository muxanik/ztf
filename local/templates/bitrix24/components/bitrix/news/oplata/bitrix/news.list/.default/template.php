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
<script src="/bitrix/js/jquery.min.js"></script>
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
<table>
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
				<tr><td><?=$arResult["RAB"][$arItem["NAME"]]["2"]*substr($bq, 4);?></td> <td><?=$arResult["RAB"][$arItem["NAME"]]["2"];?></td> <td><?=substr($bq, 4);?></td> <td><span style="font-style: italic"><?=stristr($arResult["RAB"][$arItem["NAME"]]["1"],"автор",true);?></span></td></tr>
				<?$sum[]=$arResult["RAB"][$arItem["NAME"]]["2"]*substr($bq, 4);?>
			<?endif;?>
		<?endif;?>
	<?endforeach;?>
<?endforeach;?>
	</table>
</ul>
</div>
</li>
</ul>
	Итого: <div id="itogo" class="chip teal white-text"><?=number_format(array_sum($sum),0,'',' ');?></div>
	</div>
<div class="col s6">
  <ul class="collapsible" data-collapsible="accordion">
    <li>
		<div class="collapsible-header">Показатели за текущий день: для <?=$_GET['name'];?></div>
<div class="collapsible-body">
<ul class="collection">

</ul>
</div>
</li>
</ul>

	За сегодня: <div id="seg" class="chip"><?=number_format(array_sum($sum1),0,'',' ');?></div><br>
	</div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>

<?

$arGroupAvalaible = array(1);
$arGroups = CUser::GetUserGroup($USER->GetID());
$result_intersect = array_intersect($arGroupAvalaible, $arGroups);
if(!empty($result_intersect)):



endif;

?>
