<? 
foreach ($arResult["PROPERTY_LIST_FULL"] as $propertyID):?> 
<? if ($propertyID["CODE"]=='COMP') {?> 
<? 
//заменяем тип "Е" на тип "L", чтобы сработала соотв. ветка шаблона компоненты, отображающая select 
$arProp['PROPERTY_TYPE'] = 'L'; 
$arSelect = array('ID','NAME');	
$arFilter = Array( 
"IBLOCK_ID"=>$propertyID["LINK_IBLOCK_ID"] ); 
//получаем список элементов, которые должны отображаться в комбобоксе (можно использовать в качестве iblock-code значение $arProp['LINK_IBLOCK_ID'], использовать нужные фильтры, если не все элементы нужны в комбобоксе) 
$dbAllElements = CIBlockElement::GetList(Array("SORT"=>"ASC"),$arFilter,$arSelect); 
while($arElement = $dbAllElements->Fetch()) 
{ 
$arAllElements[$arElement['ID']] = array('VALUE'=>$arElement['NAME']); 
} 
//записываем полученный массив в 'ENUM' 
$arProp['ENUM'] = $arAllElements; 
$arProp['NAME'] = $propertyID['NAME']; 
$arProp['CODE'] = $propertyID['CODE']; 
$arProp['CODE'] = $propertyID['CODE']; 
$arProp['MULTIPLE'] = $propertyID['MULTIPLE']; 
$arProp['LIST_TYPE'] = 'L'; 

//добавляем наше свойство к уже существующим свойствам в $arResult 
$arResult['PROPERTY_LIST_FULL'][$propertyID['ID']] = $arProp; 
if (!in_array($propertyID['ID'], $arResult["PROPERTY_LIST"])) 
$arResult["PROPERTY_LIST"][] = $propertyID['ID']; 
?> 
<? } ?> 
<?endforeach;?>