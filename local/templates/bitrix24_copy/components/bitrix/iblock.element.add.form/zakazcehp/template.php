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

if (!empty($arResult["ERRORS"])):?>	<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<?
$arSelect = Array("NAME");
$arFilter = Array("IBLOCK_ID"=>"32", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();

}

?> 
<?$az=date("d.m.Y", strtotime($arResult["ELEMENT_PROPERTIES"]["347"]["0"]["VALUE"]))?><br>
<?$za=date("d.m.Y", strtotime($arResult["ELEMENT"]["TIMESTAMP_X"]));?>
<?$zz = date("d.m.Y");?>

<?if(!empty($arResult["ELEMENT_PROPERTIES"]["347"]["0"]["VALUE"])):?><?$dvyd=$az;?><?else:?><?$dvyd=$za;?><?endif;?><?$interval=$dvyd-$zz;?>

<?if (!in_array($arResult["ELEMENT_PROPERTIES"]["149"]["0"]["VALUE_ENUM"], array('Принят','Переделка','Плюс минус'), true ) && $interval < 0):?>
<p>Заблудился? Не умничай тут!</p>
<?else:?>

<script src="/bitrix/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="/bitrix/js/materialize.css">
<script src="/bitrix/js/materialize.min.js"></script>
<form id="calx1" name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
<?$in = 0;?>
	<div class="ceh"> <a class="btn" href="/zakazy/" >Вернуться к заказам</a> 
  <div class="row"> 
    <div class="col s3"> 
    		<div class="card hoverable" style="height: 280px;;;text-align:center;">
<div class="card-image teal white-text" style="padding:5px;">
	<h6 class="box-title">Выполнен вход:</h6></div> 
				<span data-cell="UP1"><?global $USER;echo $USER->GetFullName();?></span>
     <a href="/panel/ceh.php?logout=yes" onmouseover="BX.hint(this, 'Выход пользователя из системы. (&amp;nbsp;Ctrl+Alt+O&amp;nbsp;) ')" >Выйти</a> 
				<br><span data-cell="TM1" id="seychas" style="display:none;"><?$sm="-1";
$time=strtotime("now".$sm." hour");
echo date('H:i:s d.m.Y',$time);?></span>
<div>Заказ № <?=$arResult["ELEMENT"]["NAME"]?> <br>Работы:<br>
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"])):?>Покраска<br><?endif;?>
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"])):?>Полировка<br><?endif;?>
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["138"]["0"]["VALUE"]) or !empty($arResult["ELEMENT_PROPERTIES"]["137"]["0"]["VALUE"])):?>Ремонт<br><?endif;?>
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["143"]["0"]["VALUE"])):?>Шиномонтаж<br><?endif;?>
<?if(!empty($arResult["ELEMENT_PROPERTIES"]["117"]["0"]["VALUE"])):?><?=$arResult["ELEMENT_PROPERTIES"]["117"]["0"]["VALUE"]?><?endif;?>
</div>
</div></div>

    <div class="col s3"> 
<div class="card hoverable" style="height: 280px;">
<div class="card-image teal white-text" style="padding:5px;">
	<h6 class="box-title">Задача:</h6></div>
<div class="card-content">
<div class="input-field">
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["374"]["0"]["VALUE"])):?><span>Задача: <?=$arResult["ELEMENT_PROPERTIES"]["374"]["0"]["VALUE"]?></span><?else:?><input data-cell="A1" id="tags" type="text" name="PROPERTY[374][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["374"]["0"]["VALUE"]?>">
<label for="tags">Что сделано?</label><?endif;?>
	</div>
<div class="input-field">
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["377"]["0"]["VALUE"])):?><span>Затрачено времени: <?=$arResult["ELEMENT_PROPERTIES"]["377"]["0"]["VALUE"]?> минут</span><?else:?><input data-cell="A2" id="time"  type="text" name="PROPERTY[377][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["377"]["0"]["VALUE"]?>">
	<label for="time">Затраченное время</label><?endif;?>
</div>
<?if(!empty($arResult["ELEMENT_PROPERTIES"]["375"]["0"]["VALUE"])):?><span>Выполнил: <?=$arResult["ELEMENT_PROPERTIES"]["375"]["0"]["VALUE"]?></span><?endif;?>
<input hidden data-cell="A3"  type="text" name="PROPERTY[375][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["375"]["0"]["VALUE"]?>">
<input hidden data-cell="A4" type="text" name="PROPERTY[376][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["376"]["0"]["VALUE"]?>">
	</div>
	</div>
	  </div></div>
	<div class="col s12 card" style="position:fixed; bottom:0;width:72%;z-index:1000;margin:0;">



<input class="btn red darken-2" type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
					<?if (strlen($arParams["LIST_URL"]) > 0):?>
						<input class="btn light-blue darken-1" type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" />
		<a class="btn orange" href="/zakazy/">Вернуться к заказам</a><a style="float:right" class="btn btn-warning" href="/zakazy/?ELEMENT_ID=<?=$arResult["ELEMENT"]["ID"];?>">Перейти к версии для печати</a>
					<?endif?>
</div>


		  </form>




<script>
var options = {
    valueNames: [ 'new_id' ]
};

var hackerList = new List('dialog', options);
</script>
<div style="clear:both"></div>

<?$mas = array (201,204,207,210,213,216,219,222,225,228,231,234,237,240,243,246,249,252,255,258,261,264,267,270,273,276,279,282,285,326,329,332,359,362,365);?>
<?$k1 = 0; ?>

<?foreach ($mas as $rkey):?>
<script>
$('.property-<?=$rkey?>-0').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-0').val('Да');
        $('.property<?=$rkey+1?>-0').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-0').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-0').val('');
        $('.property<?=$rkey+1?>-0').val('');
		$('.property<?=$rkey+2?>-0').val('');
    }
});
$('.property-<?=$rkey?>-1').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-1').val('Да');
        $('.property<?=$rkey+1?>-1').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-1').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-1').val('');
        $('.property<?=$rkey+1?>-1').val('');
		$('.property<?=$rkey+2?>-1').val('');
    }
});
$('.property-<?=$rkey?>-2').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-2').val('Да');
        $('.property<?=$rkey+1?>-2').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-2').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-2').val('');
        $('.property<?=$rkey+1?>-2').val('');
		$('.property<?=$rkey+2?>-2').val('');
    }
});
$('.property-<?=$rkey?>-3').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-3').val('Да');
        $('.property<?=$rkey+1?>-3').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-3').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-3').val('');
        $('.property<?=$rkey+1?>-3').val('');
		$('.property<?=$rkey+2?>-3').val('');
    }
});
$('.property-<?=$rkey?>-4').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-4').val('Да');
        $('.property<?=$rkey+1?>-4').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-4').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-4').val('');
        $('.property<?=$rkey+1?>-4').val('');
		$('.property<?=$rkey+2?>-4').val('');
    }
});
$('.property-<?=$rkey?>-5').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-5').val('Да');
        $('.property<?=$rkey+1?>-5').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-5').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-5').val('');
        $('.property<?=$rkey+1?>-5').val('');
		$('.property<?=$rkey+2?>-5').val('');
    }
});
$('.property-<?=$rkey?>-6').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-6').val('Да');
        $('.property<?=$rkey+1?>-6').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-6').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-6').val('');
        $('.property<?=$rkey+1?>-6').val('');
		$('.property<?=$rkey+2?>-6').val('');
    }
});
$('.property-<?=$rkey?>-7').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-7').val('Да');
        $('.property<?=$rkey+1?>-7').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-7').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-7').val('');
        $('.property<?=$rkey+1?>-7').val('');
		$('.property<?=$rkey+2?>-7').val('');
    }
});
</script> 

<?endforeach;?>  
<script src="/bitrix/js/jquery-calx-2.2.5.min.js" type="text/javascript"></script>
<script src="/bitrix/js/numeral.min.js" type="text/javascript"></script>
<script>
$( document ).ready( function ()
{
	$('#calx1').calx({
autoCalculateTrigger : 'keyup',
		data: {
			A3 :{formula: 'IF(A2>0,UP1,0)'},
			A4 :{formula: 'IF(A2>0,TM1,0)'},
			NZ1 :{formula: 'IF(RR1=469,2222,<?if(empty($arResult["ELEMENT"]["NAME"])):?>IF(RR1=471,NZ9,<?endif;?><?if(empty($arResult["ELEMENT"]["NAME"])):?>"ПР"&<?=substr($arFields["NAME"],2)+1;?><?else:?><?if($arResult["ELEMENT"]["NAME"] =="2222"):?><?=$arFields["NAME"]+1;?><?else:?><?=$arResult["ELEMENT"]["NAME"]?><?endif;?><?endif;?>)<?if(empty($arResult["ELEMENT"]["NAME"])):?>)<?endif;?>'},

		}

	}); 
	});
</script>
<?endif;?>
<pre>
<?print_r($arResult);?>
</pre>
