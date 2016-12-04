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
<link rel="stylesheet" href="/bitrix/js/fullcalendar.min.css">

<script src="/bitrix/js/fullcalendar.min.js"></script>
<?$name2 = $USER->GetFullName();?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<script type="text/javascript">
        $(document).ready(function() {
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

				<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
<?$newArr = count(array_keys($arProperty["DISPLAY_VALUE"], $name2))?>
				<?else:?>
<?$newArr = count($arProperty["DISPLAY_VALUE"])?>
<?endif;?>
<?$nn=$arProperty["ID"]+1?>
<?$arResult["RAB"] = array();?>
<?
$res = CIBlockElement::GetProperty(32, $arItem["ID"], "sort", "asc", Array("ID"=>$nn));
 while ($ob = $res->GetNext())
    {

				$arResult["RAB"][$arItem["NAME"]] = array(date("Y-m-d", strtotime($ob['VALUE'])),$arProperty["NAME"],$newArr);
    }?>
			{
				title: '<?=$arResult["RAB"][$arItem["NAME"]]["2"];?>х<?=stristr($arResult["RAB"][$arItem["NAME"]]["1"],"автор",true);?> <?=$arItem["NAME"]?>',
				start: '<?=$arResult["RAB"][$arItem["NAME"]]["0"];?>'
			},

		<?endforeach;?>
<?endforeach;?>


		]
            });
    });
</script>


<div id="calendar1"></div>



<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>

