<?php
include 'config.php';

$sql = mysql_query("SELECT *
FROM  `supplier_details`
WHERE STATUS =  'inactive'
AND branch =  'kaybiga'");

while($rs = mysql_fetch_array($sql)) {
    echo $rs['supplier_id']."<br>";
}

//DELETE FROM supplier_details WHERE
//supplier_id='13251'
//or supplier_id='1550'
//or supplier_id='403'
//or supplier_id='13298'
//or supplier_id='208'
//or supplier_id='13309'
//or supplier_id='13368'
//or supplier_id='13274'
//or supplier_id='13319'
//or supplier_id='12438'
//or supplier_id='773'
//or supplier_id='13359'
//or supplier_id='13322'
//or supplier_id='232'
//or supplier_id='36'

//mysql_query("SELECT * supplier_details WHERE
//supplier_id='47'
//or supplier_id='60'
//or supplier_id='92'
//or supplier_id='125'
//or supplier_id='138'
//or supplier_id='192'
//or supplier_id='311'
//or supplier_id='339'
//or supplier_id='378'
//or supplier_id='431'
//or supplier_id='435'
//or supplier_id='444'
//or supplier_id='451'
//or supplier_id='484'
//or supplier_id='493'
//or supplier_id='498'
//or supplier_id='529'
//or supplier_id='626'
//or supplier_id='632'
//or supplier_id='680'
//or supplier_id='693'
//or supplier_id='722'
//or supplier_id='751'
//or supplier_id='753'
//or supplier_id='755'
//or supplier_id='818'
//or supplier_id='875'
//or supplier_id='879'
//or supplier_id='892'
//or supplier_id='937'
//or supplier_id='952'
//or supplier_id='954'
//or supplier_id='985'
//or supplier_id='987'
//or supplier_id='1013'
//or supplier_id='1019'
//or supplier_id='1033'
//or supplier_id='1039'
//or supplier_id='1080'
//or supplier_id='1183'
//or supplier_id='1268'
//or supplier_id='1282'
//or supplier_id='1298'
//or supplier_id='1327'
//or supplier_id='1426'
//or supplier_id='1585'
//or supplier_id='1595'
//or supplier_id='1611'
//or supplier_id='1802'
//or supplier_id='1804'
//or supplier_id='1821'
//or supplier_id='12360'
//or supplier_id='12443'
//or supplier_id='12454'
//or supplier_id='12469'
//or supplier_id='12480'
//or supplier_id='12718'
//or supplier_id='12785'
//or supplier_id='12786'
//or supplier_id='12787'
//or supplier_id='12867'
//or supplier_id='12884'
//or supplier_id='12930'
//or supplier_id='13013'
//or supplier_id='13052'
//or supplier_id='13056'
//or supplier_id='13169'
//or supplier_id='13170'
//or supplier_id='13171'");

//supplier_id='2' or supplier_id='313' or	supplier_id='668' or supplier_id='924' or supplier_id='1343'
//or supplier_id='4' or supplier_id='315' or supplier_id='678' or supplier_id='925' or supplier_id='1575'
//or supplier_id='5' or supplier_id='321' or supplier_id='679' or supplier_id='927' or supplier_id='12761'
//or supplier_id='16' or supplier_id='331' or supplier_id='681' or supplier_id='929' or supplier_id='13378'
//or supplier_id='19' or supplier_id='337' or supplier_id='685' or supplier_id='936'
//or supplier_id='21' or supplier_id='347' or supplier_id='696' or supplier_id='942'
//or supplier_id='25' or supplier_id='357' or supplier_id='698' or supplier_id='945'
//or supplier_id='28' or supplier_id='361' or supplier_id='701' or supplier_id='947'
//or supplier_id='35' or supplier_id='376' or supplier_id='709' or supplier_id='949'
//or supplier_id='39' or supplier_id='383' or supplier_id='710' or supplier_id='961'
//or supplier_id='40' or supplier_id='392' or supplier_id='711' or supplier_id='966'
//or supplier_id='53' or supplier_id='404' or supplier_id='717' or supplier_id='967'
//or supplier_id='59' or supplier_id='410' or supplier_id='721' or supplier_id='979'
//or supplier_id='63' or supplier_id='412' or supplier_id='733' or supplier_id='993'
//or supplier_id='72' or supplier_id='414' or supplier_id='739' or supplier_id='1015'
//or supplier_id='74' or supplier_id='418' or supplier_id='749' or supplier_id='1016'
//or supplier_id='75' or supplier_id='421' or supplier_id='756' or supplier_id='1017'
//or supplier_id='76' or supplier_id='423' or supplier_id='757' or supplier_id='1038'
//or supplier_id='72' or supplier_id='425' or supplier_id='759' or supplier_id='1047'
//or supplier_id='79' or supplier_id='432' or supplier_id='762' or supplier_id='1051'
//or supplier_id='82' or supplier_id='442' or supplier_id='765' or supplier_id='1057'
//or supplier_id='85' or supplier_id='449' or supplier_id='767' or supplier_id='1058'
//or supplier_id='90' or supplier_id='453' or supplier_id='769' or supplier_id='1060'
//or supplier_id='103' or supplier_id='456' or supplier_id='771' or supplier_id='1074'
//or supplier_id='117' or supplier_id='460' or supplier_id='785' or supplier_id='1076'
//or supplier_id='119' or supplier_id='467' or supplier_id='800' or supplier_id='1090'
//or supplier_id='121' or supplier_id='471' or supplier_id='803' or supplier_id='1113'
//or supplier_id='123' or supplier_id='472' or supplier_id='812' or supplier_id='1129'
//or supplier_id='124' or supplier_id='480' or supplier_id='813' or supplier_id='1137'
//or supplier_id='129' or supplier_id='482' or supplier_id='817' or supplier_id='1143'
//or supplier_id='134' or supplier_id='483' or supplier_id='825' or supplier_id='1151'
//or supplier_id='136' or supplier_id='492' or supplier_id='827' or supplier_id='1163'
//or supplier_id='139' or supplier_id='496' or supplier_id='831' or supplier_id='1179'
//or supplier_id='140' or supplier_id='500' or supplier_id='840' or supplier_id='1181'
//or supplier_id='150' or supplier_id='503' or supplier_id='848' or supplier_id='1198'
//or supplier_id='170' or supplier_id='513' or supplier_id='852' or supplier_id='1200'
//or supplier_id='182' or supplier_id='519' or supplier_id='855' or supplier_id='1202'
//or supplier_id='184' or supplier_id='531' or supplier_id='858' or supplier_id='1208'
//or supplier_id='205' or supplier_id='535' or supplier_id='865' or supplier_id='1216'
//or supplier_id='219' or supplier_id='539' or supplier_id='866' or supplier_id='1222'
//or supplier_id='221' or supplier_id='551' or supplier_id='868' or supplier_id='1230'
//or supplier_id='240' or supplier_id='572' or supplier_id='870' or supplier_id='1238'
//or supplier_id='241' or supplier_id='584' or supplier_id='877' or supplier_id='1244'
//or supplier_id='244' or supplier_id='594' or supplier_id='881' or supplier_id='1250'
//or supplier_id='246' or supplier_id='602' or supplier_id='894' or supplier_id='1255'
//or supplier_id='248' or supplier_id='604' or supplier_id='898' or supplier_id='1274'
//or supplier_id='252' or supplier_id='621' or supplier_id='905' or supplier_id='1276'
//or supplier_id='257' or supplier_id='653' or supplier_id='906' or supplier_id='1278'
//or supplier_id='270' or supplier_id='656' or supplier_id='909' or supplier_id='1290'
//or supplier_id='288' or supplier_id='663' or supplier_id='915' or supplier_id='1292'
//or supplier_id='293' or supplier_id='664' or supplier_id='918' or supplier_id='1307'
//or supplier_id='297' or supplier_id='665' or supplier_id='920' or supplier_id='1308'");
//
//mysql_query("DELETE FROM sup_deliveries WHERE
//supplier_id='2' or supplier_id='313' or	supplier_id='668' or supplier_id='924' or supplier_id='1343'
//or supplier_id='4' or supplier_id='315' or supplier_id='678' or supplier_id='925' or supplier_id='1575'
//or supplier_id='5' or supplier_id='321' or supplier_id='679' or supplier_id='927' or supplier_id='12761'
//or supplier_id='16' or supplier_id='331' or supplier_id='681' or supplier_id='929' or supplier_id='13378'
//or supplier_id='19' or supplier_id='337' or supplier_id='685' or supplier_id='936'
//or supplier_id='21' or supplier_id='347' or supplier_id='696' or supplier_id='942'
//or supplier_id='25' or supplier_id='357' or supplier_id='698' or supplier_id='945'
//or supplier_id='28' or supplier_id='361' or supplier_id='701' or supplier_id='947'
//or supplier_id='35' or supplier_id='376' or supplier_id='709' or supplier_id='949'
//or supplier_id='39' or supplier_id='383' or supplier_id='710' or supplier_id='961'
//or supplier_id='40' or supplier_id='392' or supplier_id='711' or supplier_id='966'
//or supplier_id='53' or supplier_id='404' or supplier_id='717' or supplier_id='967'
//or supplier_id='59' or supplier_id='410' or supplier_id='721' or supplier_id='979'
//or supplier_id='63' or supplier_id='412' or supplier_id='733' or supplier_id='993'
//or supplier_id='72' or supplier_id='414' or supplier_id='739' or supplier_id='1015'
//or supplier_id='74' or supplier_id='418' or supplier_id='749' or supplier_id='1016'
//or supplier_id='75' or supplier_id='421' or supplier_id='756' or supplier_id='1017'
//or supplier_id='76' or supplier_id='423' or supplier_id='757' or supplier_id='1038'
//or supplier_id='72' or supplier_id='425' or supplier_id='759' or supplier_id='1047'
//or supplier_id='79' or supplier_id='432' or supplier_id='762' or supplier_id='1051'
//or supplier_id='82' or supplier_id='442' or supplier_id='765' or supplier_id='1057'
//or supplier_id='85' or supplier_id='449' or supplier_id='767' or supplier_id='1058'
//or supplier_id='90' or supplier_id='453' or supplier_id='769' or supplier_id='1060'
//or supplier_id='103' or supplier_id='456' or supplier_id='771' or supplier_id='1074'
//or supplier_id='117' or supplier_id='460' or supplier_id='785' or supplier_id='1076'
//or supplier_id='119' or supplier_id='467' or supplier_id='800' or supplier_id='1090'
//or supplier_id='121' or supplier_id='471' or supplier_id='803' or supplier_id='1113'
//or supplier_id='123' or supplier_id='472' or supplier_id='812' or supplier_id='1129'
//or supplier_id='124' or supplier_id='480' or supplier_id='813' or supplier_id='1137'
//or supplier_id='129' or supplier_id='482' or supplier_id='817' or supplier_id='1143'
//or supplier_id='134' or supplier_id='483' or supplier_id='825' or supplier_id='1151'
//or supplier_id='136' or supplier_id='492' or supplier_id='827' or supplier_id='1163'
//or supplier_id='139' or supplier_id='496' or supplier_id='831' or supplier_id='1179'
//or supplier_id='140' or supplier_id='500' or supplier_id='840' or supplier_id='1181'
//or supplier_id='150' or supplier_id='503' or supplier_id='848' or supplier_id='1198'
//or supplier_id='170' or supplier_id='513' or supplier_id='852' or supplier_id='1200'
//or supplier_id='182' or supplier_id='519' or supplier_id='855' or supplier_id='1202'
//or supplier_id='184' or supplier_id='531' or supplier_id='858' or supplier_id='1208'
//or supplier_id='205' or supplier_id='535' or supplier_id='865' or supplier_id='1216'
//or supplier_id='219' or supplier_id='539' or supplier_id='866' or supplier_id='1222'
//or supplier_id='221' or supplier_id='551' or supplier_id='868' or supplier_id='1230'
//or supplier_id='240' or supplier_id='572' or supplier_id='870' or supplier_id='1238'
//or supplier_id='241' or supplier_id='584' or supplier_id='877' or supplier_id='1244'
//or supplier_id='244' or supplier_id='594' or supplier_id='881' or supplier_id='1250'
//or supplier_id='246' or supplier_id='602' or supplier_id='894' or supplier_id='1255'
//or supplier_id='248' or supplier_id='604' or supplier_id='898' or supplier_id='1274'
//or supplier_id='252' or supplier_id='621' or supplier_id='905' or supplier_id='1276'
//or supplier_id='257' or supplier_id='653' or supplier_id='906' or supplier_id='1278'
//or supplier_id='270' or supplier_id='656' or supplier_id='909' or supplier_id='1290'
//or supplier_id='288' or supplier_id='663' or supplier_id='915' or supplier_id='1292'
//or supplier_id='293' or supplier_id='664' or supplier_id='918' or supplier_id='1307'
//or supplier_id='297' or supplier_id='665' or supplier_id='920' or supplier_id='1308'");


?>

