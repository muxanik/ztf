<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?
foreach ($arResult["PROPERTY_LIST_FULL"] as $propertyID):?>
<? if ($propertyID["CODE"]=='SMYV') {?>
<?
$arProp['PROPERTY_TYPE'] = 'S';
$arSelect = array('ID','NAME');
$arFilter = Array(
"IBLOCK_ID"=>$propertyID["LINK_IBLOCK_ID"] );
$dbAllElements = CIBlockSection::GetList(Array("SORT"=>"ASC"),$arFilter,$arSelect);

while($arElement = $dbAllElements->Fetch()) {$arAllElements[$arElement['ID']] = array('ID'=>$arElement['ID'],'VALUE'=>$arElement['NAME']); }

$arProp['ENUM'] = $arAllElements;
$arProp['NAME'] = $propertyID['NAME'];
$arProp['CODE'] = $propertyID['CODE'];
$arProp['MULTIPLE'] = $propertyID['MULTIPLE'];
$arProp['LIST_TYPE'] = '';

$arResult['PROPERTY_LIST_FULL'][$propertyID['ID']] = $arProp;
if (!in_array($propertyID['ID'], $arResult["PROPERTY_LIST"]))
$arResult["PROPERTY_LIST"][] = $propertyID['ID'];
?>
<?}?>
<?endforeach;?>
