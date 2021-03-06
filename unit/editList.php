<?php
ob_start();
session_start();
require("../commons/PHP/connectDB.php");

//$user = iconv("TIS-620", "UTF-8", $_REQUEST["user"]);
//$company = iconv("TIS-620", "UTF-8", $_REQUEST["comp"]);
//$language = iconv("TIS-620", "UTF-8", $_REQUEST["lang"]);

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../DHX/dhtmlxGrid/codebase/dhtmlxgrid.css" rel="stylesheet"/>
        <link type="text/css" href="../DHX/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_skyblue.css" rel="stylesheet"/>

        <script type="text/javascript" src="../DHX/dhtmlxGrid/codebase/dhtmlxcommon.js"></script>
        <script type="text/javascript" src="../DHX/dhtmlxGrid/codebase/dhtmlxgrid.js"></script>
        <script type="text/javascript" src="../DHX/dhtmlxGrid/codebase/dhtmlxgridcell.js"></script>
        <script type="text/javascript" src="../DHX/dhtmlxGrid/codebase/ext/dhtmlxgrid_filter.js"></script>

    </head>
    <body>
        <div id="divgrid" width="90%" height='90%' style="background-color:white;overflow:hidden"></div>

        <script>

            function doOnListSelected(id){
                parent.dhxAccordR.cells("plan").attachURL("../unit/unit.php?loginStatus=edit&uid="+id+"&name=system");
                parent.dhxAccordR.openItem("plan");
            }

            function doOnGroupSelected(id){
                var dhxGridList = parent.dhxAccordR.cells("list").attachGrid();
                parent.dhxAccordR.openItem("list");
                dhxGridList.setSkin("light");
                dhxGridList.setImagePath("../imgs/");
                dhxGridList.setHeader("rowId, Name, Numerator, Denominator, Unit, Abbreviation, Class, Type");
                dhxGridList.attachHeader(",,,,,,,#select_filter");
                dhxGridList.setInitWidths("40,140,90,90,70,65,70,70")
                dhxGridList.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro");
                dhxGridList.attachEvent("onRowSelect",doOnListSelected);
                dhxGridList.init();
                dhxGridList.loadXML("../unit/connectDB/load_Update/editListLoad.php?utype="+id);

            }
            mygrid = new dhtmlXGridObject('divgrid');
            mygrid.setSkin("dhx_skyblue");
            mygrid.setImagePath("../imgs/");
            mygrid.setHeader("Class,# of Records");
            mygrid.attachHeader("#select_filter,");
            mygrid.setInitWidths("150,100")
            mygrid.setColTypes("ro,ro");
            mygrid.attachEvent("onRowSelect",doOnGroupSelected);
            mygrid.init();            
            mygrid.loadXML("connectDB/load_Update/editGroupLoad.php");
        </script>
    </body>
</html>
