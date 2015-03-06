<?php

namespace Home\Controller;
use Jpgraph;

class GraphController extends BaseController{

	function 3dpie(){
		vendor("Jpgraph\jpgraph");
		vendor('jpgraph\jpgraph_pie');
		vendor('jpgraph\jpgraph_pie3d');

		$gDateLocale = new \DateLocale();
		$data = array(40,60,0,0);

		$graph = new \PieGraph(500,300);
		$graph->SetShadow();

		$graph->title->Set("去你妹的中文乱码");
		$graph->title->SetFont(FF_SIMSUN,FS_BOLD);
		$graph->legend->SetFont(FF_SIMSUN,FS_BOLD);

		$p1 = new \PiePlot3D($data);
		$p1->SetSize(0.35);
		$p1->SetCenter(0.48);
		$p1->SetLegends(array("glod","money","阅历","经验"));

		$graph->Add($p1);
		$graph->Stroke();
	}
}