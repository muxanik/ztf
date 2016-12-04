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
?><?
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

	<?endforeach;?>
	<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?if(in_array($name2, $arProperty["VALUE"])):?>

		<?$tt=substr_replace($pid,"T",-1);?>
		<?foreach($arItem["PROPERTIES"][$tt]["VALUE"] as $key):?>
		<?if(strtotime($key)<=strtotime($lmonth) and strtotime($key)>=strtotime($nmonth)):?>
		<?$bq=stristr($arProperty["NAME"],"тор ");?>
		<?$cena=stristr($arProperty["NAME"],"автор",true);?>
	<li class="collection-item"><b><?if($cena == "Прочие работы "):?><?=$arItem["PROPERTIES"]["PRRABZ"]["VALUE"]["0"]*substr($bq, 4);?><?$sum[]=$arItem["PROPERTIES"]["PRRABZ"]["VALUE"]["0"]*substr($bq, 4);?><?else:?><?=substr($bq, 4);?><?$sum[]=1*substr($bq, 4);?><?endif;?>&#8381;</b> <span style="font-style:italic;">(<?=$cena;?>)</span> <span style="color: blue;font-size: 10px;"><?=$key;?></span><span class="secondary-content">заказ № <?=$arItem["NAME"];?></span></li>

		<?endif;?>
		<?endforeach;?>
		<?print_r($ii);?>

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

	<?endforeach;?>
	<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?if(in_array($name2, $arProperty["VALUE"])):?>

		<?$tt=substr_replace($pid,"T",-1);?>
		<?foreach($arItem["PROPERTIES"][$tt]["VALUE"] as $key):?>
		<?if(strtotime($key)<=$esegod and strtotime($key)>=strtotime($segod)):?>
		<?$bq=stristr($arProperty["NAME"],"тор ");?>
		<?$cena=stristr($arProperty["NAME"],"автор",true);?>
	<li class="collection-item"><b><?if($cena == "Прочие работы "):?><?=$arItem["PROPERTIES"]["PRRABT"]["VALUE"];?><?else:?><?=substr($bq, 4);?><?endif;?>&#8381;</b> <span style="font-style:italic;">(<?=$cena;?>)</span> <span style="color: blue;font-size: 10px;"><?=$key;?></span><span class="secondary-content">заказ № <?=$arItem["NAME"];?></span></li>
		<?$sum1[]=1*substr($bq, 4);?>
		<?endif;?>
		<?endforeach;?>
		<?print_r($ii);?>

		<?endif;?>
	<?endforeach;?>

<?endforeach;?>


</ul>
</div>
</li>
</ul>

	Заработано за день: <div id="itogo" class="chip teal white-text"><?=number_format(array_sum($sum1),0,'',' ');?></div>
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



<script src="/bitrix/js/moment.min.js"></script>
<link rel="stylesheet" href="/bitrix/js/fullcalendar.min.css">

<script src="/bitrix/js/fullcalendar.min.js"></script>

<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<script type="text/javascript">
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                firstDay: 1,

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                monthNames: ['Январь','Февраль','Март','Апрель','Май','οюнь','οюль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
                monthNamesShort: ['Янв.','Фев.','Март','Апр.','Май','Июнь','Июль','Авг.','Сент.','Окт.','Ноя.','Дек.'],
                dayNames: ["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],
                dayNamesShort: ["ВС","ПН","ВТ","СР","ЧТ","ПТ","СБ"],
                buttonText: {
                    prev: "<<<",
                    next: ">>>",
                    prevYear: "<<<",
                    nextYear: ">>>",
                    today: "Сегодня",
                    month: "Месяц",
                    week: "Неделя",
                    day: "День"
                },
		events: [
<?foreach($arResult["ITEMS"] as $arItem):?>



	<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?if(in_array($name2, $arProperty["VALUE"])):?>

		<?$tt=substr_replace($pid,"T",-1);?>
		<?foreach($arItem["PROPERTIES"][$tt]["VALUE"] as $key):?>
		<?if(strtotime($key)<=strtotime($lmonth) and strtotime($key)>=strtotime($nmonth)):?>
		<?$bq=stristr($arProperty["NAME"],"тор ");?>
		<?$cena=stristr($arProperty["NAME"],"автор",true);?>

			{
				title: '<?=$cena;?> заказ № <?=$arItem["NAME"];?>',
				start: '<?=date("Y-m-d",strtotime($key));?>'
			},



		<?endif;?>
		<?endforeach;?>
		<?print_r($ii);?>

		<?endif;?>
	<?endforeach;?>





<?endforeach;?>


		]
            });
    });
</script>


<div id="calendar"></div>




</div>

<?

$arGroupAvalaible = array(1);
$arGroups = CUser::GetUserGroup($USER->GetID());
$result_intersect = array_intersect($arGroupAvalaible, $arGroups);
if(!empty($result_intersect)):



endif;

?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>