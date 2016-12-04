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
<?$name2 = $USER->GetFullName();?>
<script src="/bitrix/js/jquery.min.js"></script>
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

		<?$bq=stristr($arProperty["NAME"],"тор ");?>
		<?$cena=stristr($arProperty["NAME"],"автор",true);?>

			{
				title: '<?=$cena;?> заказ № <?=$arItem["NAME"];?>',
				start: '<?=date("Y-m-d",strtotime($key));?>'
			},




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