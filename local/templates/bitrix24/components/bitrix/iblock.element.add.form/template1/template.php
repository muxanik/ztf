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
$arFilter = Array("IBLOCK_ID"=>"32","!SECTION_ID" => "153");
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
<style>
	   .search{
	   position:relative;
	}
	
	.search_result{
	    background: #FFF;
	    border: 1px #ccc solid;
	    width: 200px;
	    border-radius: 4px;
	    overflow-y:scroll;
	    display:none;
		position:absolute;
		z-index:1000;
	}
	
	.search_result li{
	    list-style: none;
	    padding: 5px 5px;
	    color: #000;
	    border-bottom: 1px #ccc solid;
	    cursor: pointer;
	    transition:0.3s;
		font-size:12px;
	}
	
	.search_result li:hover{
	    background: #ff9800;
	}
	</style>

<?CModule::IncludeModule("bxmod.autos");?>
<?$marks = BxmodAutos::GetMarkList(); ?>
  <style>
  .ui-autocomplete-category {
    font-weight: bold;
    padding: .2em .4em;
    margin: .8em 0 .2em;
    line-height: 1.5;
  }
  </style>
  <script>
  $.widget( "custom.catcomplete", $.ui.autocomplete, {
    _create: function() {
      this._super();
      this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
    },
    _renderMenu: function( ul, items ) {
      var that = this,
        currentCategory = "";
      $.each( items, function( index, item ) {
        var li;
        if ( item.category != currentCategory ) {
          ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
          currentCategory = item.category;
        }
        li = that._renderItemData( ul, item );
        if ( item.category ) {
          li.attr( "aria-label", item.category + " : " + item.label );
        }
      });
    }
  });
  </script>
<script>
  $(function() {
    var data = [
<?foreach ($marks as $key => $arMark):?>
<?$models = BxmodAutos::GetModelList ( $arMark["id_car_mark"] );?>
	<?foreach($models as $key1 => $arMark2):?>
		{label: "<?=$arMark["name"];?> <?=$arMark2["name"];?>", category: "<?=$arMark["name"];?>"},
<?endforeach;?>
<?endforeach;?>
    ];
    $( "#tags" ).catcomplete({
      delay: 0,
      source: data
    });
  });
  </script>
<script>
  $(function() {
    var availableTags = [
"4 Racing",
"4Go",
"5ZIGEN",
"885",
"A-Tech",
"ABT",
"AC Schnitzer",
"Ace",
"ADR Design",
"ADV",
"Advan",
"Advanti",
"AEZ",
"AGForged",
"AITL",
"Akito",
"Alba",
"Alcasta",
"Aleks",
"Alessio",
"Alfa Romeo",
"Almex",
"Alpina",
"Alster",
"Aluchrome",
"Alutec",
"AME",
"American Racing",
"Amistad",
"AMS",
"Anhelo",
"Antera",
"Anzio Wheels",
"Apollo",
"AQUA",
"Arcasting",
"Artec",
"Arteria Strada",
"ASA Wheels",
"Asanti",
"Asiss",
"ASW",
"ATP",
"ATS",
"Audi",
"Avangrade",
"AVENUE",
"AVS",
"AWS",
"AZ",
"Azect",
"Azev",
"BADX",
"BANTAJ",
"Barracuda",
"BAZO",
"BBS",
"Berg",
"Beyern",
"Black Racing",
"Black Rhino",
"Blade",
"BLEST",
"Blitz",
"Blows",
"Bluege",
"BMF",
"BMW",
"Bolzanos",
"Borbet",
"Brabus",
"Bradley",
"Breyton",
"Bridgestone",
"Brock",
"BSA",
"Buddy Club P1",
"BWR",
"Cadillac",
"CAM",
"Carlsson",
"Carre",
"Carving head 40",
"Carwel",
"Catwild",
"CEC Wheels",
"Centerline Wheels",
"Chevrolet",
"Clyde",
"CMS",
"Compomotive",
"Conti",
"Coventry",
"Crimson",
"Cross Street",
"CST Zero-1",
"Daewoo",
"Daihatsu",
"Dawning Motorsport",
"Decorsa",
"Delta DL",
"Desmond",
"Detata",
"Devino",
"DEZENT",
"Diablo Wheels",
"DIAL",
"Diamond",
"Dick Cepek",
"Dizzard",
"DJ WHEELS",
"Dotz",
"Dropstars",
"Dunlop",
"EMR",
"Enkei",
"Enzo",
"Erglanz",
"Etabeta",
"Eurodisk",
"Eurosport",
"Extreme Shina",
"Fabulous",
"Ferrari",
"Final Speed",
"Fondmetal",
"Ford",
"Forgiato",
"Forsage",
"Fox",
"FR Design",
"Freemotion",
"Futek",
"G-Corporation",
"G-Mach",
"G-Square",
"General Motors",
"Gialla",
"Gianelle",
"GIANNA",
"Giovanna",
"GodFather",
"GR",
"Grass",
"Grenade",
"GSI",
"Hamann",
"HART",
"Hayes Lemmerz",
"HD Wheels",
"Helo",
"HI-TECH",
"Hipnotic Wheels",
"Honda",
"Hot Stuff",
"HP Design",
"HRE Performance",
"HTL",
"Hummer",
"Hyundai",
"IFree",
"IJITSU",
"Ikon Wheels",
"Impul",
"Incubus",
"Incurve Wheels",
"Infinity",
"Ion",
"Isuzu",
"IWheelz",
"Jaguar",
"Jawa",
"JD",
"Jeep",
"JT",
"K&K",
"K-Racing",
"K-Speed",
"K7",
"Kahn",
"KFZ",
"KIA",
"KMC",
"Koko Kuture",
"Konig",
"Kormetal",
"Kosei",
"Kronprinz",
"Kyoho",
"Kyowa",
"L.A. Connection",
"Larex",
"Lawu",
"League",
"Leasing",
"Leben",
"LegeArtis",
"Legzas",
"Lehrmeister",
"Lenso",
"Lexani",
"Lexus",
"LF Dick",
"Light Sport Wheels",
"Linea",
"Liso",
"Lodio Drive",
"Lorenso",
"LORENZO",
"Lowenhart",
"LSZ",
"Luftbahn",
"Lumarai",
"LX-Mode",
"M&K",
"M'z SPEED",
"Magline",
"Magnetto Wheels",
"Mak",
"Malyce Legendary",
"Mamba OFF Road",
"Manaray",
"Mandrus",
"Marcello",
"MAXX Wheels",
"Mayhem",
"Mazda",
"Mefro",
"Mercedes",
"MHT",
"Mi-tech",
"Mickey Thompson",
"Milli Miglia",
"MIM",
"Mitsubishi",
"MKW",
"MKW OFF-ROAD",
"MLJ",
"MML",
"Modellista",
"Modular Society",
"MOMO",
"Monte Fiore",
"Monza",
"Motec",
"Motegi",
"MOTO Metal",
"MPS",
"MSW",
"MTT Racing",
"MVF",
"Next",
"Nexta",
"Ningbo",
"Nissan",
"Nitro",
"Noble",
"NORDWAY",
"Norfolk",
"NZ Wheels",
"O'Green",
"Oefunger",
"Off-Road-Wheels",
"Opel",
"Oxigin",
"OZ",
"P&W",
"PANTHER",
"PDW Wheels",
"Peugeot",
"PIAA",
"Porsche",
"PRD",
"Primo",
"Pro Comp",
"ProDrive",
"Proma",
"PTW",
"R-Steel",
"Race Ready",
"Racing Hart",
"Radius",
"Raiden",
"Range Rover",
"Rapid",
"Ravrion",
"RAYS",
"RC Design",
"Red Wheel",
"Redbourne",
"Renault",
"Replay",
"Replica",
"RepliKey",
"Reverline",
"Rial",
"Riverside",
"Rodeo Drive",
"Romagna Ruote",
"Ronal",
"Rondell",
"Roner",
"Rota",
"Rotiform",
"Royal Wheels",
"Rozest",
"RR",
"RS Wheels",
"RW",
"Sakura Wheels",
"Salita",
"Sanfox",
"Sant",
"Schmidt",
"Sein",
"SEYEN",
"SH",
"SHLK",
"Skoda",
"Slik",
"SLK",
"Sparco",
"Speedline",
"Spirits",
"Sport Technic",
"Sportmax Racing",
"SportWay",
"SRD Tuning",
"SsangYong",
"SSR",
"SSW",
"Stalker",
"Starform",
"Stark",
"Steel Wheels",
"Steinmetz",
"Stich Precious",
"Stilauto",
"Stonewell",
"Storm Wheels",
"Stranger",
"Strut",
"Subaru",
"Suzuki",
"SW",
"Sword",
"Syms",
"Tailong",
"Team Dynamics",
"Tech-Line",
"Technocast Corsia",
"Tezzen",
"TGRACING",
"TIS",
"TMW",
"Tomason",
"TOMS",
"Toora",
"Top True",
"Topy",
"Touchdown",
"Toyota",
"TRD",
"Trebl",
"TRW",
"TSW",
"Tuff A.T.",
"Tunzzo",
"ULTRA",
"Ultraleggera",
"URAS",
"Urban Racing",
"VAGGIO",
"Valbrem",
"Valente",
"VCT",
"Venerdi",
"Verde",
"Vertini",
"Vianor",
"Victor Equipment",
"Violento",
"Volkswagen",
"Voltec",
"Volvo",
"Vorxtec",
"Vossen",
"Wald",
"Watanabe",
"Weds",
"Wheelegend",
"Wheelworld",
"Wibram",
"Wiger",
"Winners",
"Winning Street Wheel",
"WOLF Wheels",
"Work",
"Worx",
"Wrest",
"WSP",
"X'trike",
"XD Series",
"Xinfa",
"XXR",
"Yamato",
"Yokatta",
"Yokohama",
"YST",
"Yueling wheels",
"Zack",
"Zauber",
"Zeit",
"Zephyr",
"Zepp",
"ZEPPELIN",
"Zina",
"Zinik",
"Zormer",
"ZW",
"ZY",
"ВАЗ",
"ВИКОМ",
"ВСМПО",
"ГАЗ",
"ККЗ",
"КраМЗ",
"КУЛЗ",
"Магалтек",
"Мегалюм",
"Москвич",
"Нива",
"Скад",
"СМК",
"ТЗСК",
"УАЗ",
"ФМЗ",
"Штамповка"
    ];
    $( "#tags1" ).autocomplete({
      source: availableTags
    });
  });
  </script>

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
<script type="text/javascript">
$(document).ready(function(){
 $('.spoiler_links').click(function(){
  $(this).next('.spoiler_body').toggle('normal');
  return false;
 });

});
$(document).ready(function(){   
    $("#statid").on('change', function(){        
        if($(this).find(":selected").val()=='471'){

            $('#modal1').openModal();
        }

    });
});
</script>


  <div id="modal1" class="modal">
    <div class="modal-content">
<h4>Необходимо указать номер заказа который переделываем</h4>
  <div class="row">
    <div class="input-field col s6">
      <input value="" id="first_name2" type="text" class="validate" data-cell="NZ9">
      <label class="active" for="first_name2">Номер заказа который переделываем</label>
    </div>
  </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">ОК</a>
    </div>
  </div>

<style type="text/css">
 .spoiler_body {display:none; cursor:pointer;}
</style>
<style>

#ajax-add-raboty {
    display: none;
    width: 1000px; 
    min-height : 400px;
#ajax-add-shema {
    display: none;
    width: 1000px; 
    min-height : 400px;
#ajax-add-shema1 {
    display: none;
    width: 1000px; 
    min-height : 400px;
}

</style>
<script type="text/javascript">
<!--
BX.ready(function(){
   var schema = new BX.PopupWindow("raboty", null, {
      content: BX('ajax-add-raboty'),//Контейнер
      closeIcon: {right: "20px", top: "10px"},//Иконка закрытия
      titleBar: {content: BX.create("span", {html: '<b>Выполненные работы</b>', 'props': {'className': 'access-title-bar'}})},//Название окна 
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        draggable: {restrict: true},//Окно можно перетаскивать на странице
      /*Если потребуется, можно использовать кнопки управления формой        
        buttons: [
         new BX.PopupWindowButton({
            text: "Отправить",
            className: "popup-window-button-accept",
            events: {click: f unction(){
               BX.ajax.submit(BX("myForm"), f unction(data){ // отправка данных из формы с id="myForm" в файл из action="..."
                  BX('ajax-add-schema').innerHTML = data;
                });
            }}
         }),
         new BX.PopupWindowButton({
            text: "Закрыть",
            className: "webform-button-link-cancel",
            events: {click: f unction(){
               this.popupWindow.close();// закрытие окна
            }}
         })
         ]
   */}); 
   $('#loading1').click(function(){
	   BX.ajax.insertToNode('/zakazy/include/zakaz.php?edit=Y&CODE=<?=$arResult["ELEMENT"]["ID"];?>', BX('ajax-add-raboty'));//ajax-загрузка контента из url, у меня он помещён в "Короткие ссылки" /bitrix/admin/short_uri_admin.php?lang=ru
      //Можно использовать такой адрес /include/schema.php      
      schema.show(); //отображение окна
   });
});
//-->
</script>

<a class="waves-effect waves-light btn" id="loading1">Смотреть текущие работы</a> 
<div id="ajax-add-raboty"></div>

<div style="clear:both;"></div>
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
<script>
$( document ).ready(function() {

$(".nebolee").click(function(){
    $(this).hide();
});

});
	</script>
<div class="col s2" style="position: fixed; top:45px; width: 230px; left: 0; padding: 5px;z-index:1000;">
	<img src="/upload/img/nebolee2.gif" width="230" class="nebolee">
	</div>
	<div class="col s2" style="position: fixed; top:205px; width: 230px; left: 0; padding: 5px;z-index:1000;">
<ul class="collapsible white-text blue-grey" data-collapsible="accordion">
<li>
<div class="collapsible-header white-text blue-grey active">
	<h5>Калькуляция</h5></div>

	<div class="collapsible-body" style="padding:0 10px;">
Подитог 
    <br />
	<b><input  data-cell="Z1" data-formula="I1" /> </b>
    <br />
   Предварительная стоиомость: 
    <br />
   <b><input data-cell="Z2" data-formula="IF(M1=0,((AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+IP7-((AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+IP7)*SK1/100)+(C1*E1-(C1*E1)*SK1/100)+(F1*G1-(F1*G1)*SK2/100)+(H1*K1-(H1*K1)*SK2/100)+(L1-L1*SK3/100)+N1+(O1-O1*SK1/100)+VZ2+(P1-P1*SK1/100),((AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+IP7-((AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+IP7)*SK1/100)+(C1*E1-(C1*E1)*SK1/100)+(F1*G1-(F1*G1)*SK2/100)+(H1*K1-(H1*K1)*SK2/100)+(L1*M1-(L1*M1)*SK3/100)+N1+(O1-O1*SK1/100)+VZ2+(P1-P1*SK1/100))"/> </b>
    <br />
   Экономия: <b><input data-cell="PRED3" data-formula="I1-I2" /> </b>
    <br />
	Min предоплата: <b><input data-cell="PRED4" data-formula="Z2/2" /> </b>
	<br />
	Осталось доплатить: <b><input data-cell="PRED5" data-formula="Z2-PD1-DD1" /> </b><br>
		Приблизительно дней: <b><input data-cell="PRED6" data-formula="POK2+POL2+REM2+SHN2+SBR2"/> </b>
<br>
		Ответственный: 
<div class="form-group">

	<div class="col s12"><select id="otvid" name="PROPERTY[368]">
<?$stat =0;?>
								<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
									<?


										foreach ($arResult["PROPERTY_LIST_FULL"]["368"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												foreach ($arResult["ELEMENT_PROPERTIES"]["368"] as $elKey => $arElEnum)
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
								<option id="otv-<?=$stat++;?>" value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
											<?
										}
									?>
		</select></div>
	</div>

</div>

	</li>
<li>
<div class="collapsible-header white-text blue-grey">
	<h5>Сроки</h5></div>

	<div class="collapsible-body" style="padding:0 10px;">
		Покраска в 1 цвет <span class="right">5 дней</span><br>
		Покраска в 2 цвета <span class="right">10 дней</span><br>
		Комб. полировка <span class="right">15 дней</span><br>
		Полная полировка <span class="right">10 дней</span><br>
		<hr>
		Дополнительно:<br>
		Правка <span class="right">+1 день</span><br>
		Шиномонтаж <span class="right">+1 день</span><br>
		Сборка разборка <span class="right">+2 дня</span><br>
</div>
	</li>
<li>
<div class="collapsible-header white-text blue-grey">
	<h5>Инфо</h5></div>

	<div class="collapsible-body" style="padding:0 10px;">
		Кол-во заказов: <b><input id="SZ1"/> </b>
		Сумма заказов: <b><input id="SZ2" /> </b>

</div>
	</li>
	</ul>

	</div>

<div class="col s12"> 
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

<div  class="col s6 form-group">
  <ul class="collapsible" data-collapsible="accordion">
    <li>
		<div class="collapsible-header">Из за кого переделываем?</div>
<div class="collapsible-body">
<ul class="collection">

<li class="collection-item">
					<?$zx= 1; $zxz=1;
foreach ($arResult["PROPERTY_LIST_FULL"]["345"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["345"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["345"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="A<?=$zx++;?>" type="checkbox" name="PROPERTY[345][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> </p>
											<?
										}?>
	</li>
</ul>
</div>
</li>
</ul>
	</div>
  <div style="text-align: center;"> 
    <p style="font-size: 24px;">Бланк заказа (счет форма)</p>
   </div>
	</div>

  <div class="col s4"><img id="bxid_954255" src="http://thomifelgen.ru/bitrix/templates/thomifelgen/img/logo.png" width="183" height="70"  /></div>

  <div class="col s4 offset-s4">
<div class="card-panel">
<div class="box-header with-border">
	<h6>Заявка № (<?if(empty($arResult["ELEMENT"]["NAME"])):?>новая заявка<?else:?>следующий номер <?=$arFields["NAME"]+1;?><?endif;?>)</h6></div>

<div class="box-body">
<div class="form-group">

	<input data-cell="NZ1" type="text" name="PROPERTY[NAME][0]" size="25" value="<?if(empty($arResult["ELEMENT"]["NAME"])):?><?=$arFields["NAME"]+1;?><?else:?><?=$arResult["ELEMENT"]["NAME"]?><?endif;?>"> 
<br><label>
	Дата: <?=$arResult["ELEMENT"]["DATE_CREATE"]?></label>
	  </div>
   </div>
	  </div>
	</div>
<script>
  $(document).ready(function(){
$('.modal-trigger').leanModal();
  });
</script>
<div class="col s5">
<div class="card hoverable">
	<div class="card-image light-green" style="padding:5px;">
		<h5>Контактная информация</h5></div>
<div class="divider"></div>

<a class="waves-effect waves-light btn" id="loading2">Новая компания</a>
<style>
<!--
#ajax-add-schema {display:none; width:1024px; min-height:578px;}
-->
</style>
<script type="text/javascript">
<!--
BX.ready(function(){
   var schema = new BX.PopupWindow("schema2", null, {
      content: BX('ajax-add-schema1'),//Контейнер
      closeIcon: {right: "20px", top: "10px"},//Иконка закрытия
      titleBar: {content: BX.create("span", {html: '<b>Добавить нового клиента</b>', 'props': {'className': 'access-title-bar'}})},//Название окна 
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        draggable: {restrict: true},//Окно можно перетаскивать на странице
      /*Если потребуется, можно использовать кнопки управления формой        
        buttons: [
         new BX.PopupWindowButton({
            text: "Отправить",
            className: "popup-window-button-accept",
            events: {click: f unction(){
               BX.ajax.submit(BX("myForm"), f unction(data){ // отправка данных из формы с id="myForm" в файл из action="..."
                  BX('ajax-add-schema').innerHTML = data;
                });
            }}
         }),
         new BX.PopupWindowButton({
            text: "Закрыть",
            className: "webform-button-link-cancel",
            events: {click: f unction(){
               this.popupWindow.close();// закрытие окна
            }}
         })
         ]
   */}); 
   $('#loading2').click(function(){
	   BX.ajax.insertToNode('/zakazy/ncomp.php?edit=Y', BX('ajax-add-schema1'));//ajax-загрузка контента из url, у меня он помещён в "Короткие ссылки" /bitrix/admin/short_uri_admin.php?lang=ru
      //Можно использовать такой адрес /include/schema.php      
      schema.show(); //отображение окна
   });
});
//-->
</script>


<div id="ajax-add-schema1"></div> 



<a class="waves-effect waves-light btn" id="loading">Новый клиент</a> 
<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	".default", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_news",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_news" => array(
			0 => "41",
		),
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "20",
		"USE_LANGUAGE_GUESS" => "Y"
	),
	false
);?>

<style>
<!--
#ajax-add-schema {display:none; width:1024px; min-height:578px;}
-->
</style>
<script type="text/javascript">
<!--
BX.ready(function(){
   var schema = new BX.PopupWindow("schema", null, {
      content: BX('ajax-add-schema'),//Контейнер
      closeIcon: {right: "20px", top: "10px"},//Иконка закрытия
      titleBar: {content: BX.create("span", {html: '<b>Добавить нового клиента</b>', 'props': {'className': 'access-title-bar'}})},//Название окна 
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        draggable: {restrict: true},//Окно можно перетаскивать на странице
      /*Если потребуется, можно использовать кнопки управления формой        
        buttons: [
         new BX.PopupWindowButton({
            text: "Отправить",
            className: "popup-window-button-accept",
            events: {click: f unction(){
               BX.ajax.submit(BX("myForm"), f unction(data){ // отправка данных из формы с id="myForm" в файл из action="..."
                  BX('ajax-add-schema').innerHTML = data;
                });
            }}
         }),
         new BX.PopupWindowButton({
            text: "Закрыть",
            className: "webform-button-link-cancel",
            events: {click: f unction(){
               this.popupWindow.close();// закрытие окна
            }}
         })
         ]
   */}); 
   $('#loading').click(function(){
	   BX.ajax.insertToNode('/zakazy/nclient.php?edit=Y', BX('ajax-add-schema'));//ajax-загрузка контента из url, у меня он помещён в "Короткие ссылки" /bitrix/admin/short_uri_admin.php?lang=ru
      //Можно использовать такой адрес /include/schema.php      
      schema.show(); //отображение окна
   });
});
//-->
</script>

<div class="card-content">
<div class="form-group">


<div id="ajax-add-schema"></div>

<div class="col s12" style="padding-bottom:10px;"></div>


	</div>
<script>
function setFocus() {
    var editor = $('#title-search-input');
    var value = editor.val();
    editor.val("");
    editor.focus();
    editor.val(value);
}
</script>
	<script>
$(function(){
	    
	//Живой поиск

	$('.who').bind("keyup", function() {
	    if(this.value.length >= 2){
	        $.ajax({
	            type: 'post',
	            url: "/zakazy/js/search.php", //Путь к обработчику
				data: {'ref':this.value},
	            response: 'text',
	            success: function(data){
	                $("#search_result").html(data).fadeIn(); //Выводим полученые данные в списке
	           }
	       })
	    }
	})
	    

	    
	//При выборе результата поиска, прячем список и заносим выбранный результат в input
	$("#search_result").on("click", "li", function(){
	    s_user = $(this).text();
	    //$(".who").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
	    $("#search_result").fadeOut();
	})

	$('.who1').bind("keyup", function() {
	    if(this.value.length >= 2){
	        $.ajax({
	            type: 'post',
	            url: "/zakazy/js/search1.php", //Путь к обработчику
				data: {'ref1':this.value},
	            response: 'text',
	            success: function(data){
	                $("#search_result1").html(data).fadeIn(); //Выводим полученые данные в списке
	           }
	       })
	    }
	})
	    

	    
	//При выборе результата поиска, прячем список и заносим выбранный результат в input
	$("#search_result1").on("click", "li", function(){
	    s_user = $(this).text();
	    //$(".who").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
	    $("#search_result1").fadeOut();
	})	

	$('.who2').bind("keyup", function() {
	    if(this.value.length >= 2){
	        $.ajax({
	            type: 'post',
	            url: "/zakazy/js/search2.php", //Путь к обработчику
				data: {'ref2':this.value},
	            response: 'text',
	            success: function(data){
	                $("#search_result2").html(data).fadeIn(); //Выводим полученые данные в списке
	           }
	       })
	    }
	})
	    

	    
	//При выборе результата поиска, прячем список и заносим выбранный результат в input
	$("#search_result2").on("click", "li", function(){
	    s_user = $(this).text();
	    //$(".who").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
	    $("#search_result2").fadeOut();
	})	

	$('.who3').bind("keyup", function() {
	    if(this.value.length >= 2){
	        $.ajax({
	            type: 'post',
	            url: "/zakazy/js/search3.php", //Путь к обработчику
				data: {'ref3':this.value},
	            response: 'text',
	            success: function(data){
	                $("#search_result3").html(data).fadeIn(); //Выводим полученые данные в списке
	           }
	       })
	    }
	})
	    

	    
	//При выборе результата поиска, прячем список и заносим выбранный результат в input
	$("#search_result3").on("click", "li", function(){
	    s_user = $(this).text();
	    //$(".who").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
	    $("#search_result3").fadeOut();
	})	

	})
</script>
<div class="">
<label for="partnerf">Партнер</label>
<input class="who1" data-cell="P18" id="partnerf" type="text" name="PROPERTY[115][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["115"]["0"]["VALUE"]?>">
<input hidden name="ref1" data-formula="P18"> 
<ul id="search_result1" class="search_result"></ul>
<input type="button" value="Найти" onclick="setFocus();" />
	</div>
<div class="">
<label for="fiof">Ф.И.О.</label>
	<input class="who" data-cell="P17" id="fiof" type="text" name="PROPERTY[116][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["116"]["0"]["VALUE"]?>">
<input hidden name="ref" data-formula="P17"> 
<ul id="search_result" class="search_result"></ul>
<input type="button" value="Найти" onclick="setFocus();" />
	</div>
<div class="">
<label for="emailf">Телефон</label>
<input  class="who2" data-cell="P22" id="telform" type="text" name="PROPERTY[185][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["185"]["0"]["VALUE"]?>">
<input hidden name="ref2" data-formula="P22"> 
<ul id="search_result2" class="search_result"></ul>
	</div>
<div class="">
<label for="emailf">Email</label>
<input id="emailf" type="text" name="PROPERTY[186][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["186"]["0"]["VALUE"]?>">

	</div>
<script>
function process1() { 
    document.getElementById("title-search-input").value = document.getElementById("dkart").value; 
    var editor = $('#title-search-input');
    var value = editor.val();
    editor.val("");
    editor.focus();
    editor.val(value)
} 
	</script>
<div class="">
	<label for="dkart">№ ДК</label> <span id="tekskid" style="color:red;"></span>
<input class="who3" data-cell="P23" id="dkart" type="text" name="PROPERTY[187][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["187"]["0"]["VALUE"]?>">
<input hidden name="ref3" data-formula="P23"> 
<ul id="search_result3" class="search_result"></ul>
<input type="button" value="Найти" onclick="process1();" />
	</div>
	<label>Дополнительная информация</label>

<textarea class="materialize-textarea" cols="30" rows="4" name="PROPERTY[117][0]"><?=$arResult["ELEMENT_PROPERTIES"]["117"]["0"]["VALUE"]?></textarea>
	</div>



</div>
</div>
    <div class="col s7">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#iots">Информация о ТС</a></li>
        <li class="tab col s3"><a href="#ioiz">Информация о изделии</a></li>
        <li class="tab col s3"><a href="#compl">Комплектация</a></li>
      </ul>
    </div>
	<div id="iots" class="col s7" style="display:flex;">
<div class="card hoverable">
	<div class="card-image light-green" style="padding:5px;">
		<h5>Информация о ТС</h5></div>
<div class="divider"></div>
<div class="card-content">
<div style="width:44%;float:left;">
	<div class="col s12">

					<?$ttr = 1; foreach ($arResult["PROPERTY_LIST_FULL"]["118"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["118"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["118"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
		<p><input data-cell="TTR<?=$ttr++;?>" type="checkbox" name="PROPERTY[118][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?
										}?>
</div>
	</div>
<div style="width:44%;float:left;">

	<div class="col s12">
<?$ta= 1;
foreach ($arResult["PROPERTY_LIST_FULL"]["188"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["188"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["188"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
		<p><input data-cell="TA<?=$ta++;?>" type="checkbox" name="PROPERTY[188][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> </p>
											<?
										}?>
	</div></div><p></p>
	<div style="clear:both;"></div>

<div class="input-field">
<input id="tags" type="text" name="PROPERTY[119][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["119"]["0"]["VALUE"]?>">
<label for="tags">Марка ТС</label>
	</div>
<div class="input-field">
<input id="colf" type="text" data-cell="E1" name="PROPERTY[120][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["120"]["0"]["VALUE"]?>">
<label for="colf">Кол-во дисков/деталей</label>
</div>
	<div class="col s12"></div>
<div class="input-field">
	<select id="radf" data-cell="R1" name="PROPERTY[123]">
								<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
									<?


										foreach ($arResult["PROPERTY_LIST_FULL"]["123"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												foreach ($arResult["ELEMENT_PROPERTIES"]["123"] as $elKey => $arElEnum)
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
								<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
											<?
										}
									?>
		</select>
<label for="radf">R</label>
	</div>
</div>
</div>
	</div>
    <div id="ioiz" class="col s7" style="display:flex;">
<div class="card hoverable">
	<div class="card-image light-green" style="padding:5px;">
		<h5>Информация о изделии</h5></div>
<div class="divider"></div>
<div class="card-content">
<div class="input-field">
	<input id="tags1" type="text" name="PROPERTY[122][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["122"]["0"]["VALUE"]?>">
<label for="tags1">Марка дисков</label>
	</div>

	<div class="form-group" style="width:44%;float:left;">
	<label class="col s12 control-label">Материал дисков</label>
	<div class="col s12">					<?foreach ($arResult["PROPERTY_LIST_FULL"]["124"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["124"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["124"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
		<p><input class="with-gap" type="radio" name="PROPERTY[124]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?
										}?></div>
	</div>
<div class="form-group" style="width:51%;float:left;">
	<label class="col s12 control-label">Части диска</label>
	<div class="col s12">

					<?$chd=1; $chdd=1; foreach ($arResult["PROPERTY_LIST_FULL"]["125"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["125"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["125"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
		<p><input data-cell="CHD<?=$chd++;?>" type="checkbox" name="PROPERTY[125][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label>  <span class="pull-right"><input type="hidden" style="height:20px;" size="4" data-cell="CHDD<?=$chdd++;?>"></span></p>
											<?
										}?>
<p></p>
</div>
</div>
</div>

</div>
</div>
	<div id="compl" class="col s7" style="display:flex;">
<div class="card hoverable">
	<div class="card-image light-green" style="padding:5px;">
		<h5>Комплектация</h5></div>
<div class="divider"></div>
<div class="card-content">
	<div class="row" style="width:45%;float:left">
	<label class="col s12 control-label">Колпачки</label>
	<div class="col s12">					<?foreach ($arResult["PROPERTY_LIST_FULL"]["126"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["126"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["126"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
		<p><input class="with-gap"  type="radio" name="PROPERTY[126]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?
										}?></div>


<div class="col s12"><div class="input-field">
	<input id="kolpf" type="text" name="PROPERTY[150][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["150"]["0"]["VALUE"]?>">
<label for="kolpf">Кол-во</label></div></div>
	</div>
	<div class="row" style="width:55%;float:left;">
	<label class="col s12 control-label">Ниппель</label>
	<div class="col s12">					<?foreach ($arResult["PROPERTY_LIST_FULL"]["127"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["127"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["127"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
		<p><input class="with-gap" type="radio" name="PROPERTY[127]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?
										}?>

<div class="col s12"><div class="input-field">
<input id="nipf" type="text" name="PROPERTY[151][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["151"]["0"]["VALUE"]?>">
<label for="nipf">Кол-во ниппелей</label>
	</div></div></div>
	</div>

</div>

</div>
</div>


	<div class="col s12"></div> 
	<div class="col s3" style="position:relative;">
<div class="card hoverable">
	<div class="card-image amber darken-2" style="padding:5px;">
		<h5>Покраска <span class="badge" style="background: #fff;color: black;border-radius: 20px;">-<span data-formula="SK1"></span>%</span></h5>
	</div>
<div class="divider"></div>
<div class="card-content">
<div class="form-group">
	<label>Коррозия</label>
					<?foreach ($arResult["PROPERTY_LIST_FULL"]["152"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["152"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["152"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input type="checkbox" name="PROPERTY[152]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?
										}?>
	</div>
<div class="form-group">
	<label>Что красим</label><br>
					<?$j= 1; $jj=1;
foreach ($arResult["PROPERTY_LIST_FULL"]["128"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["128"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["128"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="A<?=$j++;?>" type="checkbox" name="PROPERTY[128][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> <span class="badge"><input style="height:20px;" size="4" data-cell="AA<?=$jj++;?>"></span></p>
											<?
										}?>
	</div>
<div class="input-field">
	<input id="nestpf" data-cell="AA10" type="text" name="PROPERTY[310][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["310"]["0"]["VALUE"]?>">
	<label for="nestpf">Нестандартная</label>
	</div>
	<div class="divider"></div>
<div class="form-group" style="width:53%;float:left;">
	<label>Лак</label><br>
					<?foreach ($arResult["PROPERTY_LIST_FULL"]["130"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["130"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["130"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input class="with-gap" type="radio" name="PROPERTY[130]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> </p>
											<?
										}?>

	</div>
<div class="input-field" style="width:44%;float:left;">
	<input id="collf" type="text" name="PROPERTY[304][0]" size="10" value="<?=$arResult["ELEMENT_PROPERTIES"]["304"]["0"]["VALUE"]?>">
	<label for="collf">Цвет лака</label>
	</div>
	<div style="clear:both;"></div>
	<div class="divider"></div>
	<div class="input-field" style="width:44%;float:left;">
	<input id="col1f" type="text" name="PROPERTY[129][0]" size="10" value="<?=$arResult["ELEMENT_PROPERTIES"]["129"]["0"]["VALUE"]?>">
	<label for="col1f">Цвет 1</label>
	</div>
	<div class="input-field" style="width:49%;float:left;padding-left:10px;">
	<input data-cell="CL2" id="col2f" type="text" name="PROPERTY[190][0]" size="10" value="<?=$arResult["ELEMENT_PROPERTIES"]["190"]["0"]["VALUE"]?>">
	<label for="col2f">Цвет 2</label>
	</div>
	<div style="clear:both;"></div>
<div class="input-field">
	<label for="prpokf">Стоимость покраски</label>
	<input id="prpokf" data-cell="B1" data-formula="SUM(AA1:AA10)" type="text" name="PROPERTY[131][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]?>">
	</div>
	<div class="col-sm-12"></div>
<div class="input-field">
	<label for="maskf">Маскировка</label>
	<input id="maskf" type="text" data-cell="MA1" name="PROPERTY[132][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["132"]["0"]["VALUE"]?>">

	</div>


<div class="form-group">
	<label>Что маскируем</label><br>
					<?$jf= 1; $jjf = 1;
foreach ($arResult["PROPERTY_LIST_FULL"]["355"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["355"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["355"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="II<?=$jf++;?>" type="checkbox" name="PROPERTY[355][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> <span class="badge"><input style="height:20px;" size="4" data-cell="IU<?=$jjf++;?>"></span></p>
											<?
										}?>
	<label for="maskf1">Маскировка произвольно</label>
	<input id="maskf1" type="text" data-cell="IU6" name="PROPERTY[382][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["382"]["0"]["VALUE"]?>">
	</div>
	</div>
	</div>
<input  type="hidden" data-cell="POK2" data-formula="IF(AND(MA1>0,B1>0),10,IF(B1>0,5,0))">
</div>

	<div class="col s3" style="position:relative">
<div class="card hoverable">
<div class="card-image blue darken-3" style="padding:5px;">
	<h5>Полировка <span class="badge" style="background: #fff;color: black;border-radius: 20px;">-<span data-formula="SK1"></span>%</span></h5></div>
<div class="divider"></div>
<div class="card-content">
<div class="form-group">
	<label>Что полируем</label><br>
					<?$h = 1; $hh = 1; foreach ($arResult["PROPERTY_LIST_FULL"]["133"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["133"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["133"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="PL<?=$h++;?>" type="checkbox" name="PROPERTY[133][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> <span class="badge"><input style="height:20px;" size="4" data-cell="PP<?=$hh++;?>"></span></p>
											<?
										}?>
	</div>
<div class="input-field">
	<input id="nspolf" data-cell="PP11" type="text" name="PROPERTY[311][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["311"]["0"]["VALUE"]?>">
	<label for="nspolf">Нестандартная</label>
	</div>
<div class="form-group" style="width:53%;float:left;">
	<label>Лак</label><br>
					<?foreach ($arResult["PROPERTY_LIST_FULL"]["134"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["134"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["134"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input class="with-gap" type="radio" name="PROPERTY[134]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?
										}?>
	</div>
<div class="input-field" style="width:44%;float:left;">
	<input id="clakpolf" type="text" name="PROPERTY[305][0]" size="10" value="<?=$arResult["ELEMENT_PROPERTIES"]["305"]["0"]["VALUE"]?>">
	<label for="clakpolf">Цвет лака</label><br>
	</div>
	<div style="clear:both;"></div>
<div class="input-field">
	<input id="prpolf" type="text" data-cell="C1" data-formula="SUM(PP1:PP11)" name="PROPERTY[153][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"]?>">
	<label for="prpolf">Стоимость полировки</label>
	</div>
<input  type="hidden" data-cell="POL2" data-formula="IF(AND(POK2=0,C1>0),10,IF(AND(POK2=10,C1>0),5,IF(AND(POK2=5,C1>0),10,0)))">
	</div>


</div>
<div class="card white-text teal hoverable">
<div class="card-image" style="padding:5px;">
	<h6>Скидка на основные услуги</h6></div>

<div class="card-content teal">
<div class="form-group">
	<label></label>
	<input type="text" data-cell="SK1" name="PROPERTY[135][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["135"]["0"]["VALUE"]?>">
	</div>
	</div>
</div>
	</div>
	<div class="col s3" style="position:relative;">
<div class="card hoverable">
<div class="card-image brown lighten-1" style="padding:5px;">
	<h5>Ремонт <span class="badge" style="background: #fff;color: black;border-radius: 20px;">-<span data-formula="SK2"></span>%</span></h5></div>
<div class="divider"></div>
<div class="card-content">
<div class="form-group">
	<label>Потребность</label><br>

					<?$re = 1; $re1 = 1; foreach ($arResult["PROPERTY_LIST_FULL"]["136"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["136"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["136"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="RE<?=$re++;?>" type="checkbox" name="PROPERTY[136][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> <span class="badge"><input style="height:20px;" size="4" data-cell="RP<?=$re1++;?>"></span></p>
											<?
										}?>
	</div>
<div class="input-field">
	<input type="text" data-cell="F1" data-formula="IF(RE5=0,SUM(RP1:RP3),0)" name="PROPERTY[138][0]" id="property_138" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["138"]["0"]["VALUE"]?>">
	<label for="property_138">Стоимость ремонта</label>
</div>
<div class="input-field">
	<input id="nadremf" type="text" data-cell="FF1" name="PROPERTY[191][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["191"]["0"]["VALUE"]?>">
	<label for="nadremf">Надбавка за ремонт</label>
	</div>
	<div class="col s12"></div>
<div class="input-field">
	<input type="text" data-cell="G1" name="PROPERTY[154][0]" id="property_154" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["154"]["0"]["VALUE"]?>">
	<label for="property_154">Количество дисков в ремонт</label>
	</div>
	<div class="col s12"></div>
<div class="input-field">
	<input id="svarpf" type="text" data-cell="H1" name="PROPERTY[137][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["137"]["0"]["VALUE"]?>">
	<label for="svarpf">Сварка</label>
	</div>
<div class="input-field">
	<input id="svarkf" type="text" data-cell="K1" name="PROPERTY[155][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["155"]["0"]["VALUE"]?>">
	<label for="svarkf">Сварка кол-во</label>
	</div>

<input type="hidden" data-cell="REM2" data-formula="IF(F1>0,1,0)">
</div>
</div>


  <ul class="collapsible" data-collapsible="accordion">
    <li>
		<div class="collapsible-header brown lighten-1<?if(!empty($arResult["ELEMENT_PROPERTIES"]["358"]["0"]["VALUE"])):?> active<?endif;?>" style="padding-top:7px;">	<h5 style="margin: 0;">Колпачки <span class="badge" style="background: #fff;color: black;border-radius: 20px;">-<span data-formula="SK1"></span>%</span></h5></div>
      <div class="collapsible-body noptag" style="padding: 15px;display: block;">
<div class="card-content">
<div class="form-group">
	<label>Действия</label><br>

					<?$iz = 1; $iz1=1;  foreach ($arResult["PROPERTY_LIST_FULL"]["356"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["356"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["356"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="IZ<?=$iz++;?>" type="checkbox" name="PROPERTY[356][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> <span class="badge"><input style="height:20px;" size="4" data-cell="IP<?=$iz1++;?>"></span></p>
											<?
										}?>
	</div>


<div class="input-field">
	<input type="text" data-cell="IK1" name="PROPERTY[357][0]" id="property_888" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["357"]["0"]["VALUE"]?>">
	<label for="property_888">Количество</label>
	</div>
<div class="input-field">
	<input type="text" data-cell="IP7" name="PROPERTY[358][0]" id="property_889" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["358"]["0"]["VALUE"]?>">
	<label for="property_889">Стоимость колпачков</label>
</div>


</div>
</div>
    </li>

  </ul>
<div class="card white-text teal hoverable">
<div class="card-image" style="padding:5px;">

	<h6>Скидка на ремонт</h6></div>

<div class="card-content teal">
<div class="form-group">
	<label></label>
	<input type="text" data-cell="SK2" name="PROPERTY[139][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["139"]["0"]["VALUE"]?>">
	</div>
	</div></div>
	</div>

	<div class="col s3" style="position:relative;">
<div class="card hoverable">
<div class="card-image grey darken-3 white-text" style="padding:5px;">
	<h5>Шиномонтаж <span class="badge" style="background: #fff;color: black;border-radius: 20px;">-<span data-formula="SK3"></span>%</span></h5></div>
<div class="divider"></div>
<div class="card-content">
<div class="form-group">
	<label>Этапы</label><br>

					<?$sh = 1; $shp = 1; $ww=339; $ww1=339; $ww2=1; $ww3=0; foreach ($arResult["PROPERTY_LIST_FULL"]["140"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["140"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["140"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="SH<?=$sh++;?>" type="checkbox" name="PROPERTY[140][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> <input style="width:10%;position: absolute;right: 73px;height: 20px;" type="text" data-cell="WW<?=$ww2++;?>" name="PROPERTY[<?=$ww++;?>][0]" size="4" value="<?=$arResult["ELEMENT_PROPERTIES"][$ww1++]["0"]["VALUE"]?>"><span class="badge"><input style="height:20px;width:44px;" size="4" data-cell="SHP<?=$shp++;?>"></span></p>
											<?
										}?>
	</div>
<div class="input-field">
	<input id="chas" type="text" name="PROPERTY[141][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["141"]["0"]["VALUE"]?><?if(!empty($_GET["time"])):?><?=$_GET["time"];?><?endif;?>">
	<label for="chas">Время записи</label><span style="font-size:10px">часы приема (11-00; 13-00; 16-00; 18-00)</span>
	</div>
<div class="input-field">
	<input id="shpf" type="text" data-cell="L1" data-formula="IF(M1=0,SHP1*WW1+SHP2*WW2+SHP3*WW3+SHP4*WW4+SHP5*WW5+SHP6*WW6,SUM(SHP1:SHP7))" name="PROPERTY[143][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["143"]["0"]["VALUE"]?>">
	<label for="shpf">Стоимость шиномонтажа</label>
	</div>
	<div class="col-sm-12"></div>
<div class="input-field">
	<input id="shkf" type="text" data-cell="M1" name="PROPERTY[156][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["156"]["0"]["VALUE"]?>">
	<label for="shkf">Количество дисков в шиномонтаж</label>
	</div>


<input  type="hidden" data-cell="SHN2" data-formula="IF(L1>0,1,0)">
</div>
</div>
<div class="card white-text teal hoverable">
<div class="card-image" style="padding:5px;">
	<h6>Скидка на шиномонтаж</h6></div>
<div class="card-content teal">
<div class="form-group">
	<label></label>
	<input type="text" data-cell="SK3" name="PROPERTY[142][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["142"]["0"]["VALUE"]?>">
	</div>
		</div></div>
	</div>
<div class="col s12"></div>
	<div class="col s3" style="position:relative;">
<div class="card hoverable">
<div class="card-image light-blue darken-1 white-text" style="padding:5px;">
	<h6>Доставка</h6></div>
<div class="card-content">
<div class="form-group">
					<?$dos=1; $dosp=1; foreach ($arResult["PROPERTY_LIST_FULL"]["144"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["144"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["144"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="DOS<?=$dos++;?>" type="checkbox" name="PROPERTY[144][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> <span class="badge"><input style="height:20px;" size="4" data-cell="DOSP<?=$dosp++;?>"></span></p>
											<?
										}?>
	</div>
<div class="form-group">
	<label>КМ за МКАД</label>

<input type="text" name="PROPERTY[189][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["189"]["0"]["VALUE"]?>" data-cell="KM1">
	</div>
<div class="form-group">
	<label>Стоимость</label>
	<input type="text" data-cell="N1" name="PROPERTY[157][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["157"]["0"]["VALUE"]?>">
	</div>
</div>
</div>
	</div>
<div class="col s3">
<div class="card hoverable">
<div class="card-image light-blue darken-1 white-text" style="padding:5px;">
	<h6>Рест./замена болтов <span class="badge" style="background: #fff;color: black;border-radius: 20px;">-<span data-formula="SK1"></span>%</span></h6></div>
<div class="card-content">
<div class="form-group">
					<?foreach ($arResult["PROPERTY_LIST_FULL"]["145"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["145"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["145"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="REST1" type="checkbox" name="PROPERTY[145]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?
										}?>
	</div>
<div class="form-group">
	<label>Стоимость</label>
	<input type="text" data-cell="O1" data-formula="IF(REST1>0, 3000,0)" name="PROPERTY[158][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["158"]["0"]["VALUE"]?>">
	</div>
</div>
</div>
	</div>
<div class="col s3">
<div class="card hoverable">
<div class="card-image light-blue darken-1 white-text" style="padding:5px;">
	<h6>Сборка/разборка <span class="badge" style="background: #fff;color: black;border-radius: 20px;">-<span data-formula="SK1"></span>%</span></h6></div> 
<div class="card-content">
<div class="form-group">
	<input type="text" data-cell="P1" data-formula="IF(AND(HF1=0,HF2=0,HF3=0),SUM(CHDD1:CHDD3)*E1,IF(HF1>0,SUM(CHDD1:CHDD3)*E1/2,IF(HF2>0,SUM(CHDD1:CHDD3)*E1/2,IF(HF3>0,0,0))))" name="PROPERTY[146][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["146"]["0"]["VALUE"]?>">
	</div>
<input type="hidden" data-cell="SBR2" data-formula="IF(P1>0,2,0)">
<div class="form-group">
	<label>Потребность</label><br>
					<?$q= 1; $qq=1;
foreach ($arResult["PROPERTY_LIST_FULL"]["338"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["338"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["338"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="HF<?=$q++;?>" type="checkbox" name="PROPERTY[338][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?
										}?>
	</div>
</div>
</div>
	</div>
<div class="col s3">
<div class="card hoverable">
<div class="card-image light-blue darken-1 white-text" style="padding:5px;">
	<h6>Прочее <span class="badge" style="background: #fff;color: black;border-radius: 20px;">-<span data-formula="SK1"></span>%</span></h6></div> 
<div class="card-content">
<div class="input-field">
	<input id="pronf" type="text" name="PROPERTY[316][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["316"]["0"]["VALUE"]?>">
<label for="pronf">Название</label>
</div>
<div class="input-field">
	<input id="propf" data-cell="VZ1" type="text" name="PROPERTY[317][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["317"]["0"]["VALUE"]?>">
	<input  data-cell="VZ2" data-formula="IF(PJ2>0,VZ1,VZ1*((100-SK1)/100))" type="text" name="PROPERTY[317][1]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["317"]["1"]["VALUE"]?>">
<label for="propf">Стоимость</label>
	</div>
<div class="form-group">
	<label>Требуется макет диска</label>
					<?$pro = 1;  foreach ($arResult["PROPERTY_LIST_FULL"]["322"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["322"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["322"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input data-cell="PJ<?=$pro++;?>" type="checkbox" name="PROPERTY[322][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label> </p>
											<?
										}?>
	</div>
</div>
</div>
	</div>



	<div class="col s12"></div>
  <div class="col s2">
<div class="card hoverable">
<div class="card-image  light-green lighten-2 white-text" style="padding:5px;">
	<h6>Подитог</h6></div>
<div class="card-content">
<div class="form-group">
<input type="text" data-cell="I1" data-formula="IF(M1=0,(AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+C1*E1+F1*G1+H1*K1+L1+N1+O1+P1+VZ1+IP7,(AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+C1*E1+F1*G1+H1*K1+L1*M1+N1+O1+P1+VZ1+IP7)" name="PROPERTY[147][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["147"]["0"]["VALUE"]?>">
	</div></div></div></div>

<div class="col s3">
<div class="card hoverable">
<div class="card-image  light-green lighten-2 white-text" style="padding:5px;">
	<h6>Предварительная стоимость:</h6></div>
<div class="card-content">
	<input type="text" data-cell="I2" data-formula="IF(M1=0,((AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+IP7-((AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+IP7)*SK1/100)+(C1*E1-(C1*E1)*SK1/100)+(F1*G1-(F1*G1)*SK2/100)+(H1*K1-(H1*K1)*SK2/100)+(L1-L1*SK3/100)+N1+(O1-O1*SK1/100)+VZ2+(P1-P1*SK1/100),((AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+IP7-((AA1+AA2+AA3+AA4+AA5+AA7+AA8+AA9+AA10+MA1)*E1+AA6+IP7)*SK1/100)+(C1*E1-(C1*E1)*SK1/100)+(F1*G1-(F1*G1)*SK2/100)+(H1*K1-(H1*K1)*SK2/100)+(L1*M1-(L1*M1)*SK3/100)+N1+(O1-O1*SK1/100)+VZ2+(P1-P1*SK1/100))" name="PROPERTY[159][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["159"]["0"]["VALUE"]?>">
	</div>
	</div>
	</div>
<div class="col s2">

<div class="card hoverable">
<div class="card-image  light-green lighten-2 white-text" style="padding:5px;">
	<h6>Предоплата</h6></div>
<div class="card-content">

<input data-cell="PD1" type="text" name="PROPERTY[160][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["160"]["0"]["VALUE"]?>">
<input <?if(empty($arResult["ELEMENT_PROPERTIES"]["160"]["0"]["VALUE"])):?>data-formula="IF(PD1>0,TM1,0)"<?endif;?> type="hidden" name="PROPERTY[306][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["306"]["0"]["VALUE"]?>">
					<?foreach ($arResult["PROPERTY_LIST_FULL"]["308"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["308"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["308"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input type="checkbox" name="PROPERTY[308][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?if($arEnum["VALUE"] == "Да"):?>Терминал<?else:?><?=$arEnum["VALUE"]?><?endif;?></label> </p>
											<?
										}?>
	</div>
	</div>
	</div>
<div class="col s2">
<div class="card hoverable">
<div class="card-image  light-green lighten-2 white-text" style="padding:5px;">
	<h6>Доплата</h6></div>
<div class="card-content">
<input data-cell="DD1" type="text" name="PROPERTY[161][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["161"]["0"]["VALUE"]?>">
<input <?if(empty($arResult["ELEMENT_PROPERTIES"]["161"]["0"]["VALUE"])):?>data-formula="IF(DD1>0,TM1,0)"<?endif;?> type="hidden" name="PROPERTY[307][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["307"]["0"]["VALUE"]?>">
					<?foreach ($arResult["PROPERTY_LIST_FULL"]["309"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["309"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["309"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
	<p><input type="checkbox" name="PROPERTY[309][<?=$key?>]" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?if($arEnum["VALUE"] == "Да"):?>Терминал<?else:?><?=$arEnum["VALUE"]?><?endif;?></label></p>
											<?
										}?>
	</div>
	</div>
	</div>
<div class="col s3">
<div class="card hoverable">
<div class="card-image  light-green lighten-2 white-text" style="padding:5px;">
	<h6>Ориентировочная дата выдачи:</h6></div>
<div class="card-content">
<div class="col s9"><div class="input-field"><input id="dateform" type="text" name="PROPERTY[DATE_ACTIVE_TO][0]" size="25" value="<?=$arResult["ELEMENT"]["DATE_ACTIVE_TO"]?><?if(!empty($_GET["date"])):?><?=$_GET["date"];?><?endif;?>"><label for="dateform">Введите дату</label></div></div><div class="col s3"><img src="/bitrix/js/main/core/images/calendar-icon.gif" alt="Календарь" class="calendar-icon" onclick="BX.calendar({node:this, field:'PROPERTY[DATE_ACTIVE_TO][0]', form: 'iblock_add', bTime: false, currentTime: '1452789889', bHideTime: false});" onmouseover="BX.addClass(this, 'calendar-icon-hover');" onmouseout="BX.removeClass(this, 'calendar-icon-hover');" border="0"></div>

	<input type="hidden" data-formula="<?if(empty($arResult["ELEMENT_PROPERTIES"]["347"]["0"]["VALUE"])):?>IF(RR1=364,TM1,0)<?endif;?>" type="text" name="PROPERTY[347][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["347"]["0"]["VALUE"]?>">
<?CUtil::InitJSCore(Array('ajax'));?>



<a class="waves-effect waves-light btn" id="loadingc">Календарь</a>
<script type="text/javascript">
<!--
BX.ready(function(){
   var schema = new BX.PopupWindow("calend", null, {
      content: BX('ajax-add-calend'),//Контейнер
      closeIcon: {right: "20px", top: "10px"},//Иконка закрытия
      titleBar: {content: BX.create("span", {html: '<b>Календарь</b>', 'props': {'className': 'access-title-bar'}})},//Название окна 
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        draggable: {restrict: true},//Окно можно перетаскивать на странице
      /*Если потребуется, можно использовать кнопки управления формой        
        buttons: [
         new BX.PopupWindowButton({
            text: "Отправить",
            className: "popup-window-button-accept",
            events: {click: f unction(){
               BX.ajax.submit(BX("myForm"), f unction(data){ // отправка данных из формы с id="myForm" в файл из action="..."
                  BX('ajax-add-schema').innerHTML = data;
                });
            }}
         }),
         new BX.PopupWindowButton({
            text: "Закрыть",
            className: "webform-button-link-cancel",
            events: {click: f unction(){
               this.popupWindow.close();// закрытие окна
            }}
         })
         ]
   */}); 
   $('#loadingc').click(function(){
	   BX.ajax.insertToNode('/zakazy/calendarz.php', BX('ajax-add-calend'));//ajax-загрузка контента из url, у меня он помещён в "Короткие ссылки" /bitrix/admin/short_uri_admin.php?lang=ru
      //Можно использовать такой адрес /include/schema.php      
      schema.show(); //отображение окна
   });
});
//-->
</script>
<style>

#ajax-add-calend {
    display: none;
    width: 1000px; 
    min-height : 400px;
}

</style>
<div id="ajax-add-calend"></div>
  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content" id="content1">

      <p>Скоро загрузится календарь</p>
<script type="text/javascript">
BX.ready(function(){
   $('.modal-trigger').click(function(){
BX.ajax.insertToNode('/zakazy/calendarz.php', BX('content1'));//ajax-загрузка контента из url, у меня он помещён в "Короткие ссылки" /bitrix/admin/short_uri_admin.php?lang=ru

   });
});

</script>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">ОК</a>
    </div>
  </div>
  <!-- Modal Structure -->
  <div id="modal2" class="modal modal-fixed-footer">
    <div class="modal-content" id="content2">

      <p>Скоро загрузится форма добавления</p>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">ОК</a>
    </div>
  </div>
  <!-- Modal Structure -->
  <div id="modal3" class="modal modal-fixed-footer">
    <div class="modal-content" id="content3">

      <p>Скоро загрузится список клиентов</p>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">ОК</a>
    </div>
  </div>
	</div>
	</div>
	</div>

	<div class="col s12 card" style="position:fixed; bottom:0;width:72%;z-index:1000;margin:0;">

<input class="btn red darken-2" type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
					<?if (strlen($arParams["LIST_URL"]) > 0):?>
						<input class="btn light-blue darken-1" type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" />
		<a class="btn orange" href="/zakazy/">Вернуться к заказам</a><a style="float:right" class="btn btn-warning" href="/zakazy/?ELEMENT_ID=<?=$arResult["ELEMENT"]["ID"];?>">Перейти к версии для печати</a>
					<?endif?>
</div>
<style>
ul.brands-list{
	float: left;
	width: 90px;
	margin: 10px 0 0 6px;
}
</style>
<div id="dialog" title=""  style="width:690px;background:#fff;">

</div>
		  </form>

<script type="text/javascript">
$( document ).ready(function() {
function setFocus(){ document.getElementById("title-search-input").focus();}
});
</script>


<script>
$( document ).ready( function ()
{
	$('#calx1').calx({
autoCalculateTrigger : 'keyup',
		data: {
			AA1 : {formula : 'IF(TTR1>0,IF(AND(R1<338, R1>0, A1>0),3000,IF(AND(R1=338, A1>0),3600,IF(AND(R1=442, A1>0),4200,IF(AND(R1=443, A1>0),4500,IF(AND(R1=444, A1>0),4950,IF(AND(R1=445, A1>0),5500,IF(AND(R1>445, A1>0),6000,0))))))),IF(TTR2>0,IF(AND(R1<338, R1>0, A1>0),3500,IF(AND(R1=338, A1>0),4100,IF(AND(R1=442, A1>0),4700,IF(AND(R1=443, A1>0),5000,IF(AND(R1=444, A1>0),5450,IF(AND(R1=445, A1>0),5450,IF(AND(R1>445, A1>0),5450,0))))))),0))'},
			AA2 : {formula : 'IF(AND(R1>0, A2>0),2200,0)'},
			AA3 : {formula : 'IF(AND(R1>0, A3>0),2200,0)'},
			AA4 : {formula : 'IF(AND(R1>0, A4>0),3300,0)'},
			AA5 : {formula : 'IF(AND(A5>0),500,0)'},
			AA6 : {formula : 'IF(AND(A6>0),1500,0)'},
			AA7 : {formula : 'IF(AND(R1<337,R1>0, A7>0),2200,IF(AND(R1=337,A7>0),2250,IF(AND(R1=338,A7>0),2400,IF(AND(R1=442, A7>0),2650,IF(AND(R1=443, A7>0),2900,IF(AND(R1=444, A7>0),3200,IF(AND(R1=445, A7>0),3400,IF(AND(R1=446, A7>0),3650,IF(AND(R1=447, A7>0),3900,IF(AND(R1=448, A7>0),4150,IF(AND(R1=449, A7>0),4400,IF(AND(R1=450, A7>0),4650,0))))))))))),0)'},
			AA8 : {formula : 'IF(AND(A8>0),7000,0)'},
			AA9 : {formula : 'IF(AND(A9>0),500,0)'},
			PP1 : {formula : 'IF(TTR1>0,IF(AND(R1<338, R1>0, PL1>0),9000,IF(AND(R1=338, PL1>0),9500,IF(AND(R1=442, PL1>0),9900,IF(AND(R1=443, PL1>0),10500,IF(AND(R1=444, PL1>0),11500,IF(AND(R1=445, PL1>0),12500,IF(AND(R1=446, PL1>0),13500,IF(AND(R1=447, PL1>0),13500,IF(AND(R1=448, PL1>0),13500,IF(AND(R1>448, PL1>0),13500,0)))))))))),IF(TTR2>0,IF(AND(R1<338, R1>0, PL1>0),10000,IF(AND(R1=338, PL1>0),10500,IF(AND(R1=442, PL1>0),10900,IF(AND(R1=443, PL1>0),11500,IF(AND(R1=444, PL1>0),12500,IF(AND(R1>=446, PL1>0),12500,0)))))),0))'},
			PP2 : {formula : 'IF(AND(R1<338, PL2>0),3300,IF(AND(R1=338, PL2>0),3500,IF(AND(R1=442, PL2>0),3700,IF(AND(R1=443, PL2>0),3900,IF(AND(R1=444, PL2>0),4400,IF(AND(R1=445, PL2>0),4950,IF(AND(R1=446, PL2>0),5500,IF(AND(R1=447, PL2>0),5500,IF(AND(R1=448, PL2>0),5500,IF(AND(R1=449, PL2>0),5500,IF(AND(R1=450, PL2>0),5500,0)))))))))))'},
			PP3 : {formula : 'IF(AND(R1<338, PL3>0),3300,IF(AND(R1=338, PL3>0),3500,IF(AND(R1=442, PL3>0),3700,IF(AND(R1=443, PL3>0),3900,IF(AND(R1=444, PL3>0),4400,IF(AND(R1=445, PL3>0),4950,IF(AND(R1=446, PL3>0),5500,IF(AND(R1=447, PL3>0),5500,IF(AND(R1=448, PL3>0),5500,IF(AND(R1=449, PL3>0),5500,IF(AND(R1=450, PL3>0),5500,0)))))))))))'},
			PP4 : {formula : 'IF(AND(R1<338, PL4>0),3300,IF(AND(R1=338, PL4>0),3500,IF(AND(R1=442, PL4>0),3700,IF(AND(R1=443, PL4>0),3900,IF(AND(R1=444, PL4>0),4400,IF(AND(R1=445, PL4>0),4950,IF(AND(R1=446, PL4>0),5500,IF(AND(R1=447, PL4>0),5500,IF(AND(R1=448, PL4>0),5500,IF(AND(R1=449, PL4>0),5500,IF(AND(R1=450, PL4>0),5500,0)))))))))))'},
			PP5 : {formula : 'IF(AND(R1<337, R1>0, PL5>0),7000,IF(AND(R1>=337, R1<445, PL5>0),7000,IF(AND(R1>=445, PL5>0),7000,0)))'},
			PP6 : {formula : 'IF(AND(R1<337, R1>0, PL6>0),7000,IF(AND(R1>=337, R1<445, PL6>0),7000,IF(AND(R1>=445, PL6>0),7000,0)))'},
			PP7 : {formula : 'IF(AND(PL7>0),1500,0)'},
			PP8 : {formula : 'IF(AND(PL8>0),1000,0)'},
			PP9 : {formula : 'IF(AND(PL9>0),1250,0)'},
			PP10 : {formula : 'IF(AND(PL10>0),18000,0)'},
			RP1 : {formula : 'IF(TTR1>0,IF(AND(R1=334, RE1>0),1600+FF1,IF(AND(R1=335, RE1>0),1600+FF1,IF(AND(R1=336, RE1>0),1600+FF1,IF(AND(R1=337, RE1>0),1600+FF1,IF(AND(R1=338, RE1>0),1900+FF1,IF(AND(R1=442, RE1>0),2200+FF1,IF(AND(R1=443, RE1>0),2500+FF1,IF(AND(R1=444, RE1>0),2800+FF1,IF(AND(R1=445, RE1>0),3100+FF1,IF(AND(R1=446, RE1>0),3500+FF1,IF(AND(R1=447, RE1>0),3500+FF1,IF(AND(R1=448, RE1>0),3500+FF1,IF(AND(R1=449, RE1>0),3500+FF1,IF(AND(R1=450, RE1>0),3500+FF1,0)))))))))))))),IF(AND(TTR2>0,RE1>0),2500+FF1,0))'},
			RP2 : {formula : 'IF(AND(RE2>0),250,0)'},
			RP3 : {formula : 'IF(AND(RE3>0),250,0)'},
			SHP1 : {formula : 'IF(TA1>0,IF(AND(R1<335, SH1>0),60,IF(AND(R1=335, SH1>0),75,IF(AND(R1=336, SH1>0),85,IF(AND(R1=337, SH1>0),95,IF(AND(R1=338, SH1>0),125,IF(AND(R1=442, SH1>0),140,IF(AND(R1=443, SH1>0),165,IF(AND(R1=444, SH1>0),185,IF(AND(R1=445, SH1>0),210,IF(AND(R1=446, SH1>0),225,IF(AND(R1=447, SH1>0),315,IF(AND(R1=448, SH1>0),315,IF(AND(R1>448, SH1>0),315,0))))))))))))),IF(AND(R1<336, SH1>0),95,IF(AND(R1=336, SH1>0),95,IF(AND(R1=337, SH1>0),110,IF(AND(R1=338, SH1>0),140,IF(AND(R1=442, SH1>0),155,IF(AND(R1=443, SH1>0),185,IF(AND(R1=444, SH1>0),220,IF(AND(R1=445, SH1>0),255,IF(AND(R1=446, SH1>0),280,IF(AND(R1=447, SH1>0),390,IF(AND(R1=448, SH1>0),570,IF(AND(R1=449, SH1>0),570,IF(AND(R1=450, SH1>0),570,0))))))))))))))'},
			SHP2 : {formula : 'IF(TTR1>0,IF(TA1>0,IF(AND(R1=334, SH2>0),120,IF(AND(R1=335, SH2>0),150,IF(AND(R1=336, SH2>0),170,IF(AND(R1=337, SH2>0),190,IF(AND(R1=338, SH2>0),250,IF(AND(R1=442, SH2>0),280,IF(AND(R1=443, SH2>0),330,IF(AND(R1=444, SH2>0),370,IF(AND(R1=445, SH2>0),420,IF(AND(R1=446, SH2>0),450,IF(AND(R1=447, SH2>0),630,IF(AND(R1=448, SH2>0),630,IF(AND(R1=449, SH2>0),630,IF(AND(R1=450, SH2>0),630,0)))))))))))))),IF(AND(R1=334, SH2>0),190,IF(AND(R1=335, SH2>0),190,IF(AND(R1=336, SH2>0),190,IF(AND(R1=337, SH2>0),220,IF(AND(R1=338, SH2>0),280,IF(AND(R1=442, SH2>0),310,IF(AND(R1=443, SH2>0),370,IF(AND(R1=444, SH2>0),440,IF(AND(R1=445, SH2>0),510,IF(AND(R1=446, SH2>0),560,IF(AND(R1=447, SH2>0),780,IF(AND(R1=448, SH2>0),1140,IF(AND(R1=449, SH2>0),1140,IF(AND(R1=450, SH2>0),1140,0))))))))))))))),IF(AND(TTR2>0,SH2>0),300,0))'},
			SHP3 : {formula : 'IF(TTR1>0,IF(SH3>0,90,0),IF(AND(TTR2>0,SH3>0),100,0))'},
			SHP4 : {formula : 'IF(TTR1>0,IF(TA1>0,IF(AND(R1=334, SH4>0),120,IF(AND(R1=335, SH4>0),150,IF(AND(R1=336, SH4>0),170,IF(AND(R1=337, SH4>0),190,IF(AND(R1=338, SH4>0),250,IF(AND(R1=442, SH4>0),280,IF(AND(R1=443, SH4>0),330,IF(AND(R1=444, SH4>0),370,IF(AND(R1=445, SH4>0),420,IF(AND(R1=446, SH4>0),450,IF(AND(R1=447, SH4>0),630,IF(AND(R1=448, SH4>0),630,IF(AND(R1=449, SH4>0),630,IF(AND(R1=450, SH4>0),630,0)))))))))))))),IF(AND(R1=334, SH4>0),190,IF(AND(R1=335, SH4>0),190,IF(AND(R1=336, SH4>0),190,IF(AND(R1=337, SH4>0),220,IF(AND(R1=338, SH4>0),280,IF(AND(R1=442, SH4>0),310,IF(AND(R1=443, SH4>0),370,IF(AND(R1=444, SH4>0),440,IF(AND(R1=445, SH4>0),510,IF(AND(R1=446, SH4>0),560,IF(AND(R1=447, SH4>0),780,IF(AND(R1=448, SH4>0),1140,IF(AND(R1=449, SH4>0),1140,IF(AND(R1=450, SH4>0),1140,0))))))))))))))),IF(AND(TTR2>0,SH4>0),300,0))'},
			SHP5 : {formula : 'IF(TTR1>0,IF(TA1>0,IF(AND(R1=334, SH5>0),120,IF(AND(R1=335, SH5>0),150,IF(AND(R1=336, SH5>0),170,IF(AND(R1=337, SH5>0),190,IF(AND(R1=338, SH5>0),250,IF(AND(R1=442, SH5>0),280,IF(AND(R1=443, SH5>0),330,IF(AND(R1=444, SH5>0),370,IF(AND(R1=445, SH5>0),420,IF(AND(R1=446, SH5>0),450,IF(AND(R1=447, SH5>0),630,IF(AND(R1=448, SH5>0),630,IF(AND(R1=449, SH5>0),630,IF(AND(R1=450, SH5>0),630,0)))))))))))))),IF(AND(R1=334, SH5>0),190,IF(AND(R1=335, SH5>0),190,IF(AND(R1=336, SH5>0),190,IF(AND(R1=337, SH5>0),220,IF(AND(R1=338, SH5>0),280,IF(AND(R1=442, SH5>0),310,IF(AND(R1=443, SH5>0),370,IF(AND(R1=444, SH5>0),440,IF(AND(R1=445, SH5>0),510,IF(AND(R1=446, SH5>0),560,IF(AND(R1=447, SH5>0),780,IF(AND(R1=448, SH5>0),1140,IF(AND(R1=449, SH5>0),1140,IF(AND(R1=450, SH5>0),1140,0))))))))))))))),IF(AND(TTR2>0,SH5>0),300,0))'},
			SHP6 : {formula : 'IF(TA1>0,IF(AND(R1<335, SH6>0),60,IF(AND(R1=335, SH6>0),75,IF(AND(R1=336, SH6>0),85,IF(AND(R1=337, SH6>0),95,IF(AND(R1=338, SH6>0),125,IF(AND(R1=442, SH6>0),140,IF(AND(R1=443, SH6>0),165,IF(AND(R1=444, SH6>0),185,IF(AND(R1=445, SH6>0),210,IF(AND(R1=446, SH6>0),225,IF(AND(R1=447, SH6>0),315,IF(AND(R1=448, SH6>0),315,IF(AND(R1>448, SH6>0),315,0))))))))))))),IF(AND(R1<336, SH6>0),95,IF(AND(R1=336, SH6>0),95,IF(AND(R1=337, SH6>0),110,IF(AND(R1=338, SH6>0),140,IF(AND(R1=442, SH6>0),155,IF(AND(R1=443, SH6>0),185,IF(AND(R1=444, SH6>0),220,IF(AND(R1=445, SH6>0),255,IF(AND(R1=446, SH6>0),280,IF(AND(R1=447, SH6>0),390,IF(AND(R1=448, SH6>0),570,IF(AND(R1=449, SH6>0),570,IF(AND(R1=450, SH6>0),570,0))))))))))))))'},
			SHP7 : {formula : 'IF(TTR1>0,IF(TA1>0,IF(AND(R1=334, SH7>0),480,IF(AND(R1=335, SH7>0),600,IF(AND(R1=336, SH7>0),680,IF(AND(R1=337, SH7>0),760,IF(AND(R1=338, SH7>0),1000,IF(AND(R1=442, SH7>0),1120,IF(AND(R1=443, SH7>0),1320,IF(AND(R1=444, SH7>0),1480,IF(AND(R1=445, SH7>0),1680,IF(AND(R1=446, SH7>0),1800,IF(AND(R1=447, SH7>0),2520,IF(AND(R1=448, SH7>0),2520,IF(AND(R1=449, SH7>0),2520,IF(AND(R1=450, SH7>0),2520,0)))))))))))))),IF(AND(R1=334, SH7>0),760,IF(AND(R1=335, SH7>0),760,IF(AND(R1=336, SH7>0),760,IF(AND(R1=337, SH7>0),880,IF(AND(R1=338, SH7>0),1120,IF(AND(R1=442, SH7>0),1240,IF(AND(R1=443, SH7>0),1480,IF(AND(R1=444, SH7>0),1760,IF(AND(R1=445, SH7>0),2040,IF(AND(R1=446, SH7>0),2240,IF(AND(R1=447, SH7>0),3120,IF(AND(R1=448, SH7>0),4560,IF(AND(R1=449, SH7>0),4560,IF(AND(R1=450, SH7>0),4560,0))))))))))))))),IF(AND(TTR2>0,SH7>0),700,0))'},
			CHDD1 : {formula : 'IF(CHD1>0,0,0)'},
			CHDD2 : {formula : 'IF(CHD2>0,1500,0)'},
			CHDD3 : {formula : 'IF(CHD3>0,2000,0)'},
			DOSP1 : {formula : 'IF(DOS4>0, 0,IF(DOS1>0,1000,0))'},
			DOSP2 : {formula : 'IF(DOS4>0, 0,IF(DOS2>0,1500+KM1*25,0))'},
			DOSP3 : {formula : 'IF(DOS3>0,2,0)'},
			N1 : {formula: 'IF(DOS3<=0,SUM(DOSP1:DOSP2),SUM(DOSP1:DOSP2)*DOSP3)'},
			IP7 : {formula: 'SUM(IP1:IP5)*IK1'},
			IP1 :{formula: 'IF(IZ1>0,1500,0)'},
			IP2 :{formula: 'IF(IZ2>0,1500,0)'},
			IP3 :{formula: 'IF(IZ3>0,500,0)'},
			IP4 :{formula: 'IF(IZ4>0,500,0)'},
			NZ1 :{formula: 'IF(RR1=469,<?if(empty($arResult["ELEMENT"]["NAME"])):?>2222<?else:?><?=$arResult["ELEMENT"]["NAME"]?><?endif;?>,<?if(empty($arResult["ELEMENT"]["NAME"])):?>IF(RR1=471,NZ9,<?endif;?><?if(empty($arResult["ELEMENT"]["NAME"])):?><?=$arFields["NAME"]+1;?><?else:?><?if($arResult["ELEMENT"]["NAME"] =="2222"):?><?=$arFields["NAME"]+1;?><?else:?><?=$arResult["ELEMENT"]["NAME"]?><?endif;?><?endif;?>)<?if(empty($arResult["ELEMENT"]["NAME"])):?>)<?endif;?>'},
			IU1 :{formula: 'IF(II1>0,2000,0)'},
			IU2 :{formula: 'IF(II2>0,1000,0)'},
			IU3 :{formula: 'IF(II3>0,500,0)'},
			MA1 :{formula: 'SUM(IU1:IU7)'},
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