<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css">
    <title>Document</title>
    
    <style type="text/css">
        html, body { height:100%; padding:0; margin:0; overflow:hidden; }
    </style>
</head>
<body>
    <div id="gantt_here" style='width:100%; height:100%;'></div>

    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <script src="https://export.dhtmlx.com/gantt/api.js"></script>

    <script type="text/javascript">
        gantt.config.xml_date = "%Y-%m-%d";
        gantt.init("gantt_here");

        gantt.i18n.setLocale("es");
        gantt.config.scale_unit = "month";
        gantt.config.step = 1;
        gantt.config.date_scale = "%F, %Y";
        gantt.config.scale_height = 50;
        gantt.config.subscales = [
            {unit:"day", step:1, date:"%j, %D" }
        ];
        gantt.config.columns = [
            {name:"text", label:"Asignación", width:"*", tree:true, align:"left" },
            {name:"start_date", label:"Fecha Inicio", align:"right" },
        ];
        
        gantt.config.grid_resize = true;
        gantt.config.grid_width = 350;
        gantt.config.show_unscheduled = true;
        gantt.config.sort = false;
        gantt.config.order_branch = false;
        gantt.config.order_branch_free = false;
        gantt.config.fit_tasks = true;
        gantt.config.fit_subtasks = true;
        gantt.config.show_progress = false;
        gantt.config.show_grid = true;
        gantt.config.show_chart = true;
        gantt.config.show_links = true;
        gantt.config.show_task_cells = true;
        gantt.config.readonly = true;
        gantt.config.drag_links = false;
        gantt.config.drag_progress = false;
        

        /*gantt.exportToExcel({
             name:"Diagrama.xlsx", 
                columns:[
                    { id:"text",  header:"Title", width:150 },
                    { id:"start_date",  header:"Start date", width:250, type:"date" }
                ],
                server:"https://myapp.com/myexport/gantt",
                callback: function(res){
                    alert(res.url);
                },
                visual:true,
                cellColors:true,
                date_format: "dddd d, mmmm yyyy"
        });*/

        gantt.load("data_tasks_gantt");
    </script>
</body>
</html>