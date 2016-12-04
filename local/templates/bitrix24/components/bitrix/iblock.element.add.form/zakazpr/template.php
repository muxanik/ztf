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
$arFilter = Array("IBLOCK_ID"=>"32","SECTION_ID" => "153");
$res = CIBlockElement::GetList(Array("NAME"=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();

}
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
$(document).ready(function() {
    $('select').material_select();

});
</script>




<script src="/bitrix/js/jquery.maskedinput.min.js" type="text/javascript"></script>
<script src="/bitrix/js/jquery.validate.js" type="text/javascript"></script>
<script src="/bitrix/js/list.min.js" type="text/javascript"></script>




<script>

jQuery(function($){

   $("#telform").mask("8(999) 999-9999",{autoclear: false});
   $("#dkart").mask("00999");
   $("#dateform").mask("99.99.9999",{placeholder:"дд/мм/гггг"});
   $("#chas").mask("99-99",{placeholder:"чч-мм"});

});
	</script>

<form id="calx1" name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>

<span data-cell="TM1" id="seychas"><?$sm="-1";
$time=strtotime("now".$sm." hour");
echo date('H:i:s d.m.Y',$time);?></span>
<style>
input:invalid + label {
    color: #fff !important;
	background:red !important;
}
</style>

<div class="row zaz">
<input type="hidden" name="PROPERTY[IBLOCK_SECTION][]" value="153">
<script>
$( document ).ready(function() {

$(".nebolee").click(function(){
    $(this).hide();
});

});
	</script>

	<div class="col s12" style="display:none;"> 
<div class="col s6">
<div class="form-group">
<label class="col s3 control-label">Статус заказа</label>
	<div class="col s9"><select id="statid" data-cell="RR1" name="PROPERTY[149]">
<?$stat =0;?>
								<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
									<?


										foreach ($arResult["PROPERTY_LIST_FULL"]["149"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												foreach ($arResult["ELEMENT_PROPERTIES"]["149"] as $elKey => $arElEnum)
												{
													if ($key == $arElEnum["VALUE"])
													{
														$checked = true;
														break;
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}
											?>
								<option id="stat-<?=$stat++;?>" value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
											<?
										}
									?>
		</select></div>
	</div>
	</div>

	</div>
<div class="col s12"> 


<div class="col s4">
	</div>
  <div class="col s6 offset-s6">
<div class="card-panel">
<div class="box-header with-border">
	<h6>Заявка № (<?if(empty($arResult["ELEMENT"]["NAME"])):?>новая заявка<?else:?>следующий номер <?=$arFields["NAME"]+1;?><?endif;?>)</h6></div>

<div class="box-body">
<div class="form-group">

	<input <?if(empty($arResult["ELEMENT"]["NAME"])):?>data-cell="NZ1"<?else:?><?endif;?> type="text" name="PROPERTY[NAME][0]" size="25" value="<?if(empty($arResult["ELEMENT"]["NAME"])):?><?=$arFields["NAME"]+1;?><?else:?><?=$arResult["ELEMENT"]["NAME"]?><?endif;?>"> 
<br><label>
	Дата: <?=$arResult["ELEMENT"]["DATE_CREATE"]?></label>
	  </div>
   </div>
	  </div>
	</div>
<?$in = 0;?>
	<div class="ceh"> <a class="btn" href="/zakazy/" >Вернуться к заказам</a> 
  <div class="row"> 
    <div class="col s3"> 
    		<div class="card hoverable" style="height: 280px;;;text-align:center;">
<div class="card-image teal white-text" style="padding:5px;">
	<h6 class="box-title">Выполнен вход:</h6></div> 
				<span data-cell="UP1"><?global $USER;echo $USER->GetFullName();?></span>
     <a href="/panel/ceh.php?logout=yes" onmouseover="BX.hint(this, 'Выход пользователя из системы. (&amp;nbsp;Ctrl+Alt+O&amp;nbsp;) ')" >Выйти</a> 
				<br><span data-cell="TN1" id="seychas" style="display:none;"><?$sm="-1";
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
<input data-cell="A1" id="tags" type="text" name="PROPERTY[374][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["374"]["0"]["VALUE"]?>">
<label for="tags">Что нужно сделать?</label>
	</div>
<div class="input-field">
<input data-cell="A2" id="time"  type="text" name="PROPERTY[377][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["377"]["0"]["VALUE"]?>">
<label for="time">Затраченное время</label>
</div>

<div class="input-field">
<input data-cell="A11" id="tags1" type="text" name="PROPERTY[374][1]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["374"]["1"]["VALUE"]?>">
<label for="tags1">Что нужно сделать(2)?</label>
	</div>
<div class="input-field">
<input data-cell="A22" id="time1"  type="text" name="PROPERTY[377][1]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["377"]["1"]["VALUE"]?>">
<label for="time1">Затраченное время(2)</label>
</div>
<input hidden data-cell="A3"  type="text" name="PROPERTY[375][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["375"]["0"]["VALUE"]?>">
<input hidden data-cell="A4" type="text" name="PROPERTY[376][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["376"]["0"]["VALUE"]?>">
<input hidden data-cell="A33"  type="text" name="PROPERTY[375][1]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["375"]["1"]["VALUE"]?>">
<input hidden data-cell="A44" type="text" name="PROPERTY[376][1]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["376"]["1"]["VALUE"]?>">
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
$( document ).ready( function ()
{
	$('#calx1').calx({
autoCalculateTrigger : 'keyup',
		data: {
			A3 :{formula: 'IF(A2>0,UP1,0)'},
			A4 :{formula: 'IF(A2>0,TM1,0)'},
			A33 :{formula: 'IF(A22>0,UP1,0)'},
			A44 :{formula: 'IF(A22>0,TM1,0)'},
			NZ1 :{formula: 'IF(RR1=469,2222,<?if(empty($arResult["ELEMENT"]["NAME"])):?>IF(RR1=471,NZ9,<?endif;?><?if(empty($arResult["ELEMENT"]["NAME"])):?>"ПР"&<?=substr($arFields["NAME"],2)+1;?><?else:?><?if($arResult["ELEMENT"]["NAME"] =="2222"):?><?=$arFields["NAME"]+1;?><?else:?><?=$arResult["ELEMENT"]["NAME"]?><?endif;?><?endif;?>)<?if(empty($arResult["ELEMENT"]["NAME"])):?>)<?endif;?>'},

		}

	}); 
	});
</script>
<script>
var options = {
    valueNames: [ 'new_id' ]
};

var hackerList = new List('dialog', options);
</script>
<div style="clear:both"></div>
