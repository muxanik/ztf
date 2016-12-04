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
<link rel="stylesheet" href="/bitrix/js/fullcalendar.min.css">

<script src="/bitrix/js/fullcalendar.min.js"></script>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<script type="text/javascript">
$(function() {
            $('#calendar1').fullCalendar({
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
                    prev: "--",
                    next: "--",
                    prevYear: "--",
                    nextYear: "--",
                    today: "Сегодня",
                    month: "Месяц",
                    week: "Неделя",
                    day: "День"
                },
		events: [
<?foreach($arResult["ITEMS"] as $arItem):?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
<?$newArr[$arItem["NAME"]]=array($arItem["PROPERTIES"]["PREDO"]["VALUE"],$arItem["PROPERTIES"]["DPREDO"]["VALUE"],$arItem["PROPERTIES"]["OPCAR"]["VALUE"]["0"]);?>
<?$newArr1[$arItem["NAME"]]=array($arItem["PROPERTIES"]["DOPL"]["VALUE"],$arItem["PROPERTIES"]["DDOPL"]["VALUE"],$arItem["PROPERTIES"]["DOPCAR"]["VALUE"]["0"]);?>
<?$newArr2[$arItem["NAME"]]=array($arItem["PROPERTIES"]["DOPL"]["VALUE"],$arItem["PROPERTIES"]["DDOPL"]["VALUE"],$arItem["PROPERTIES"]["DOPCAR"]["VALUE"]["0"],$arItem["PROPERTIES"]["PREDO"]["VALUE"],$arItem["PROPERTIES"]["DPREDO"]["VALUE"],$arItem["PROPERTIES"]["OPCAR"]["VALUE"]["0"]);?>
<?endforeach;?>
<?endforeach;?>
				<?foreach($newArr as $key1 => $newArn):?>
{
title: '<?=$key1;?> <?=$newArn["0"];?> <?if($newArn["2"] == "Да"):?>карта<?else:?>нал<?endif;?>',
start: '<?=date("Y-m-d", strtotime($newArn["1"]));?>'
},
<?endforeach;?>
				<?foreach($newArr1 as $key2 => $newArn1):?>
{
title: '<?=$key2;?> <?=$newArn1["0"];?> <?if($newArn1["2"] == "Да"):?>карта<?else:?>нал<?endif;?>',
start: '<?=date("Y-m-d", strtotime($newArn1["1"]));?>',
color: '#000'
},
<?endforeach;?>
				<?foreach($newArr2 as $key3 => $newArn2):?>
{
title: '<?if($newArn2["2"] == "Да"):?><?=array_sum($newArn2["0"]);?><?else:?><?=array_sum($newArn2["3"]);?><?endif;?>',
start: '<?if($newArn2["2"] == "Да"):?><?=date("Y-m-d", strtotime($newArn2["1"]));?><?else:?><?=date("Y-m-d", strtotime($newArn2["4"]));?><?endif;?>',
color: '#ccc'
},
<?endforeach;?>
		]
            });
    });
</script>
<pre>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?foreach($newArr2 as $key3 => $newArn2):?>
<?$kassad = array(date("d.m.Y",strtotime($newArn2["1"])),date("d.m.Y",strtotime($newArn2["4"])));?>
<?foreach($kassad as $key8):?>
<?if($key8 != "01.01.1970"):?>
<?print_r($key8);?>
<?endif;?>
<?endforeach;?>
<?endforeach;?>
<?endforeach;?>
</pre>

<div id="calendar1"></div>

</div>